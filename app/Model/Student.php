<?php
class Student extends AppModel {
	public $validate = array (
			'first_name' => 'notEmpty',
			'last_name' => 'notEmpty',
			'gender' => 'notEmpty' 
	);
	
	public $hasMany = array (
			'Enrollment',
	);
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct ( $id, $table, $ds );
		$this->virtualFields ['full_name'] = sprintf ( "CONCAT(%s.first_name,' ', %s.last_name)", $this->alias, $this->alias );
	}

	public function createRandom( $count = null) {
		if (empty ( $count )) {
			$count = Configure::read ( "Student.init_count" );
		}
		

		$table = ClassRegistry::init ( 'Option' );
		
		$names = $table->createRandomName ( $count );
		
		return $this->saveAll ($names);
	}
}