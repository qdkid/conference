<?php
class Term extends AppModel {
	public $validate = array (
			'name' => 'notEmpty',
	);
	public function getList () {
		return $this->find ( 'list', array (
				'fields' => array (
						'id',
						'name'
				),
				'order' => array (
						'start_date' => "DESC"
				)
		) );
	}
}