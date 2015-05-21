<?php
class Teacher extends AppModel {
	public $validate = array (
			'first_name' => 'notEmpty',
			'last_name' => 'notEmpty',
			'gender' => 'notEmpty' 
	);
	public $belongsTo = array (
	);
	public $hasMany = array (
	);
	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct ( $id, $table, $ds );
		$this->virtualFields ['full_name'] = sprintf ( "CONCAT(%s.first_name,' ', %s.last_name)", $this->alias, $this->alias );
	}
	public function getShortTeacher($id) {
		$options = array (
				'conditions' => array (
						'Teacher.id' => $id 
				),
				'contain' => array (
						'Class' 
				) 
		);
		
		return $this->find ( 'first', $options );
	}
	public function getFullTeacher($id) {
		$options = array (
				'conditions' => array (
						'Teacher.id' => $id 
				),
				'contain' => array (
						'Class' 
				) 
		)
		;
		
		return $this->find ( 'first', $options );
	}
	public function getTeacher($id, $full_list = false) {
		if ($full_list) {
			return $this->getFullTeacher ( $id );
		}
		return $this->getShortTeacher ( $id );
	}
	public function createRandom($count = null) {
		if (empty ( $count )) {
			$count = Configure::read ( "Teacher.init_count" );
		}
		
		$table = ClassRegistry::init ( 'Option' );
		
		$names = $table->createRandomName ( $count );
		
		return $this->saveAll ( $names );
	}
}