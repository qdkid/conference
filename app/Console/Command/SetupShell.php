<?php
class SetupShell extends AppShell {
	public $uses = array (
			'Student',
			'Teacher',
			'Term',
			'Course',
			'ClassSchedule',
			'Enrollment' 
	);
	public function main() {
	}
	public function all() {
		$this->dispatchShell ( 'schema', 'create' );
		$this->insertDummy ();
	}
	public function insertDummy() {
		$this->Student->createRandom ( Configure::read ( "student.init_count" ) );
		$this->Teacher->createRandom ( Configure::read ( "teacher.init_count" ) );
		$this->createDummyClassSchedule ();
		$this->createDummyEnrollment ();
	}
	public function createDummyClassSchedule() {
		$terms = $this->Term->find ( "all" );
		$courses = $this->Course->find ( "all" );
		$teachers = $this->Teacher->find ( "list", array (
				"fields" => array (
						"Teacher.id",
						"Teacher.last_name" 
				) 
		) );
		foreach ( $teachers as $key => $value ) {
			$teacher_ids [] = $key;
		}
		$teacher_count = count ( $teacher_ids );
		
		foreach ( $terms as $term ) {
			$i = 0;
			shuffle ( $teacher_ids );
			foreach ( $courses as $course ) {
				$class_schedules [] = array (
						"course_id" => $course ['Course'] ['id'],
						"term_id" => $term ['Term'] ['id'],
						"max_seats" => mt_rand ( 2, 5 ) * 10,
						"teacher_id" => $teacher_ids [$i ++ % $teacher_count] 
				);
			}
		}
		$this->ClassSchedule->saveAll ( $class_schedules );
	}
	public function createDummyEnrollment() {
		$class_schedules = $this->ClassSchedule->find ( "all" );
		$students = $this->Student->find ( "list", array (
				"fields" => array (
						"Student.id",
						"Student.last_name" 
				) 
		) );
		foreach ( $students as $key => $value ) {
			$student_ids [] = $key;
		}
		
		$enrollments = array ();
		foreach ( $class_schedules as $class ) {
			shuffle ( $student_ids );
			
			$max_seats = $class ['ClassSchedule'] ['max_seats'];
			$random = mt_rand ( 0, $max_seats * 0.5 );
			$status = array_fill ( 0, $max_seats, 'active' );
			for($i = 0; $i < $random; $i ++) {
				$status [$i] = "dropped";
			}
			shuffle ( $status );
			
			for($i = 0; $i < $max_seats; $i ++) {
				$enrollments [] = array (
						"class_schedule_id" => $class ['ClassSchedule'] ['id'],
						"student_id" => $student_ids [$i],
						"status" => $status [$i] 
				);
			}
		}
		$this->Enrollment->saveAll ( $enrollments );
	}
}