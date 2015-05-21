<?php
class Enrollment extends AppModel {
	public $validate = array (
	);
	public $belongsTo = array (
			'ClassScheule',
			'Student' 
	);
	
	public function getFinalGradeRange ($class_schedule_id) {
		
		$query = "select class_schedule_id, ceil(final_grade/10)*10 as grade_range , 
				  count(*) as counter from enrollments where status='active' 
				  group by class_schedule_id, grade_range";
		
	}
	
}