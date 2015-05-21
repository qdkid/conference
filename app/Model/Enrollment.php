<?php
class Enrollment extends AppModel {
	public $validate = array ();
	public $belongsTo = array (
			'ClassScheule',
			'Student' 
	);
	public function getFinalGradeRange($class_schedule_id) {
		$query = "select class_schedule_id, ceil(final_grade/10)*10 as grade_range , 
				  count(*) as counter from enrollments where status='active' 
				  group by class_schedule_id, grade_range";
	}
	public function getEnrollments($term_id) {
		$query = "select enrollments.class_schedule_id, concat(teachers.first_name,' ',teachers.last_name) as full_name,
				  courses.code, courses.name,enrollments.status, class_schedules.max_seats, 
 				  count(enrollments.id) as total
				  from enrollments inner join class_schedules on enrollments.class_schedule_id=class_schedules.id
                  inner join courses on class_schedules.course_id = courses.id
                  inner join teachers on class_schedules.teacher_id = teachers.id
                  where class_schedules.term_id = ".intval($term_id)."
                  group by enrollments.class_schedule_id, full_name, courses.code, courses.name, enrollments.status,max_seats";
		$results = $this->query ($query);
		$data = array ();
	
		foreach ($results as $result) {
			if (!isset($data[$result['enrollments']['class_schedule_id']])) {
				$data[$result['enrollments']['class_schedule_id']] = array ("teacher" =>$result['0']['full_name'],
					"code" => $result['courses']['code'],
					"name" => $result['courses']['name'],
					"max_seats" => $result['class_schedules']['max_seats'],
					"registered" => 0,
					"dropped" =>0,
					"reg_ratio" => 0,
					"drop_ratio" =>0
				);
			}
			
			if ($result['enrollments']['status'] == 'active') {
				$data[$result['enrollments']['class_schedule_id']]['registered'] = $result[0]['total'];
			} else if ($result['enrollments']['status'] == 'dropped') {
				$data[$result['enrollments']['class_schedule_id']]['dropped'] = $result[0]['total'];
			} 
		}
		
		foreach ($data as $key => $value) {
			$data[$key]['reg_ratio'] = round($data[$key]['registered'] / $data[$key]['max_seats']*100);
			$data[$key]['drop_ratio'] = round($data[$key]['dropped'] /( $data[$key]['dropped']+$data[$key]['registered'])*100);
		}
		return $data;
	}
}