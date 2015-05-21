<?php
class EnrollmentsController extends AppController {
	public function enrollmentChart() {
		$this->loadModel ( "Term" );
		$terms = $this->Term->getList ();
		$this->set ( compact ( 'terms' ) );
	}
	public function getEnrollments($type ='json') {

		$this->autoRender = false;

		if (! $this->request->is ( 'post' ) ||empty( $this->request->data ['term_id'])) {
			return;
		}
				
		$data = $this->Enrollment->getEnrollments ($this->request->data ['term_id']);
		
		$table = array ();
		$table ['cols'] = array (
				array (
						'label' => 'Teacher-CourseCode',
						'type' => 'string'
				),
				array (
						'label' => 'Teacher',
						'type' => 'string'
				),
				array (
						'label' => 'Course Code',
						'type' => 'string'
				),
				array (
						'label' => 'Course',
						'type' => 'string'
				),
				array (
						'label' => 'Max Seats',
						'type' => 'number'
				),
				array (
						'label' => 'Seat Taken',
						'type' => 'number'
				),
				array (
						'label' => 'Dropped',
						'type' => 'number'
				),
				array (
						'label' => 'Reg Ratio',
						'type' => 'number'
				),
				array (
						'label' => 'Drop Ratio',
						'type' => 'number'
				)
		);
		$rows = array ();
		foreach ($data as $value) {
			$temp =array ();
			$temp [] = array ('v' => $value['teacher']."-".$value['code']);
			$temp [] = array ('v' => $value['teacher']);
			$temp [] = array ('v' => $value['code']);
			$temp [] = array ('v' => $value['name']);
			$temp [] = array ('v' => floor($value['max_seats']));
			$temp [] = array ('v' => floor($value['registered']));
			$temp [] = array ('v' => floor($value['dropped']));
			$temp [] = array ('v' => floor($value['reg_ratio']));
			$temp [] = array ('v' => floor($value['drop_ratio']));
			$rows[] = array ('c'=>$temp);
		}
		$table['rows'] = $rows;
		
		echo json_encode($table);
		exit();
	}
}

?>