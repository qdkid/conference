<?php
class Course extends AppModel {
	public $validate = array (
			'code' => 'notEmpty',
			'name' => 'notEmpty',
	);
	public $hasMany = array (
			'ClassSchedule' 
	);
}