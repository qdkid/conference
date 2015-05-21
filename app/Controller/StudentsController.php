<?php 
class StudentsController extends AppController{
		public $helpers = array ('Html', 'Form');
		public function genderChart () {
			$this->set ('genders', $this->Student->find ('all', array ('limit'=> 10)));
		}
	
}

?>