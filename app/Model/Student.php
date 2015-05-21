<?php
class Student extends AppModel {
	public $validate = array (
			'first_name' => 'notEmpty',
			'last_name' => 'notEmpty',
			'gender' => 'notEmpty' 
	);
	public $hasMany = array ()

	;
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct ( $id, $table, $ds );
		$this->virtualFields ['full_name'] = sprintf ( "CONCAT(%s.first_name,' ', %s.last_name)", $this->alias, $this->alias );
	}
	public function createRandom($count = null) {
		if (empty ( $count )) {
			$count = Configure::read ( "Student.init_count" );
		}
		
		$table = ClassRegistry::init ( 'Option' );
		
		$names = $table->createRandomName ( $count );
		
		return $this->saveAll ( $names );
	}
	public function getAgeGenderDistribution() {
		$query = "select gender, ceil( timestampdiff(year, dob, curdate()) /5)*5 as age_range, count(id) as total 
				  from students group by gender, age_range order by gender, age_range";
		
		return $this->find ( 'all', array (
				'fields' => array (
						'gender',
						'ceil (timestampdiff(year, dob, curdate())/5)*5 as age_range',
						'count(id) as total' 
				),
				'group' => array (
						'gender',
						'age_range' 
				),
				'order' => array (
						'gender' => 'ASC',
						'age_range' => 'ASC' 
				) 
		) );
	}
}