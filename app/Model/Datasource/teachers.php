<?php
class Student extends AppModel {
	public $actsAs = array (
			'Tenant.TenantScope' 
	);
	public $validate = array (
			'first_name' => 'notEmpty',
			'last_name' => 'notEmpty',
			'gender' => 'notEmpty' 
	);
	public $belongsTo = array (
			'Enrollment',
	);
	public $hasMany = array (
			'Enrollment',
	);
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct ( $id, $table, $ds );
		$this->virtualFields ['full_name'] = sprintf ( "CONCAT(%s.first_name,' ', %s.last_name)", $this->alias, $this->alias );
	}
	public function getShortStudent($id) {
		$options = array (
				'conditions' => array (
						'Student.id' => $id 
				),
				'contain' => array (
						'Class',
				) 
		);
		
		return $this->find ( 'first', $options );
	}
	public function getFullStudent($id) {
		$options = array (
				'conditions' => array (
						'Student.id' => $id 
				),
				'contain' => array (
						'Class'
						)

		);
		
		return $this->find ( 'first', $options );
	}
	public function getStudent($id, $full_list = false) {
		if ($full_list) {
			return $this->getFullStudent ( $id );
		}
		return $this->getShortStudent ( $id );
	}
	public function createRandom( $count = null) {
		if (empty ( $count )) {
			$count = Configure::read ( "Student.init_count" );
		}
		

		$table = ClassRegistry::init ( 'Option' );
		
		$names = $table->getRandomName ( $count );
		
		$i = 0;
		foreach ( $names as $key => $name ) {
			$this->create ();
			$data = array (
					"first_name" => $name ['first_name'],
					'last_name' => $name ['last_name'],
					'gender' => $name ['gender'],
					'dob' => $name ['dob'],
			);
			if (! $this->save ( $data )) {
				return false;
			}
		}
		return true;
	}
}