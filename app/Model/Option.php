<?php
class Option extends AppModel {
	public $validate = array (
			'name' => 'notEmpty' 
	);
	function getOption($id) {
		$options = array (
				'conditions' => array (
						'Option.id' => $id 
				) 
		)
		;
		return $this->find ( 'first', $options );
	}
	public function getOptions($group, $order_by = 'name') {
		return $this->find ( 'list', array (
				'fields' => array (
						'name',
						'description' 
				),
				'conditions' => array (
						"Option.group_name" => $group 
				),
				'order' => array (
						$order_by => "ASC" 
				) 
		) );
	}
	public function getOptionsByGroup($group_name, $order_by = 'name') {
		$options = $this->find ( 'all', array (
				'fields' => array (
						'group_name',
						'name',
						'description' 
				),
				'conditions' => array (
						"Option.group_name like " => $group_name 
				),
				'order' => array (
						'group_name' => "ASC",
						$order_by => 'ASC' 
				) 
		) );
		
		$data = array ();
		foreach ( $options as $key => $option ) {
			$data [$option ['Option'] ['group_name']] [$option ['Option'] ['name']] = $option ['Option'] ['description'];
		}
		return $data;
	}
	public function createRandomName($count) {
		if (empty ( $count )) {
			$count = 10;
		}
		
		$lastnames = $this->find ( 'list', array (
				'fields' => array (
						'name' 
				),
				'conditions' => array (
						"Option.group_name" => 'last_name' 
				),
		) );
		shuffle ( $lastnames );
		$l_count = count ( $lastnames );
		
		$firstnames = $this->find ( 'all', array (
				'fields' => array (
						'group_name',
						'name',
						'description' 
				),
				'conditions' => array (
						"Option.group_name like " => 'first_name%' 
				) 
		) );
		shuffle ( $firstnames );
		$f_count = count ( $firstnames );
		
		$names = array ();
		$i = 0;
		$begin = strtotime ( (date ( "Y" ) - configure::read("max_age")) . "-01-01" );
		$end = strtotime ( (date ( "Y" )   - configure::read("min_age")) . "-01-01" );
		
		while ( $i < $count ) {
			$firstname = $firstnames [$i % $f_count];
			
			$name = array (
					"first_name" => $firstname ['Option'] ['name'],
					"last_name" => $lastnames [$i % $l_count],
					"gender" => 'M',
					"dob" => date ( "Y-m-d", mt_rand ( $begin, $end ) ) 
			);
			
			if ($firstname ['Option'] ['group_name'] == 'first_name_f') {
				$name ['gender'] = 'F';
			}
			$names [] = $name;
			$i ++;
		}
		return $names;
	}
}