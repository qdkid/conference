<?php 
class StudentsController extends AppController{
	
		public function genderChart () {
			$genders = $this->Student->getAgeGenderDistribution();
			$table = array ();
			$table ['cols'] = array (
			    array (
    					'label' => 'Gender-Age Range',
    					'type' => 'string'
    			),
    			array (
    					'label' => 'Gender',
    					'type' => 'string'
    			),
    			array (
    					'label' => 'Age Range',
    					'type' => 'string'
    			),
    			array (
    					'label' => 'Total',
    					'type' => 'number'
    			)
			);		 
			$rows = array ();
			foreach ($genders as $gender) {
				$temp =array ();
				$temp [] = array ('v' => $gender['Student']['gender'].":".$gender[0]['age_range']."-".($gender[0]['age_range']+4));
				$temp [] = array ('v' => $gender['Student']['gender'] =='M'? 'Male' :'Female');
				$temp [] = array ('v' => $gender[0]['age_range']."-".($gender[0]['age_range']+4));
				$temp [] = array ('v' => floor($gender[0]['total']));
				$rows[] = array ('c'=>$temp);
			}
			$table['rows'] = $rows;
			$this->set (compact('genders','table'));
		}
}

?>