<?php
class AppSchema extends CakeSchema {
	public function before($event = array()) {
		$db = ConnectionManager::getDataSource ( $this->connection );
		$db->cacheSources = false;
		return true;
	}
	public function after($event = array()) {
		if (isset ( $event ['create'] )) {
			switch ($event ['create']) {
				case 'options' :
					$this->InsertDefaultOptions ();
					break;
				case 'courses' :
					$this->InsertDefaultCourses ();
					break;
				case 'terms' :
					$this->InsertDefaultTerms ();
					break;
			}
		}
	}
	public function InsertDefaultTerms() {
		$table = ClassRegistry::init ( 'Term' );
		$terms = array ();
		for($i = 2012; $i <= 2015; $i ++) {
			$terms [] = array (
					"name" => "Spring " . $i,
					"start_date" => $i . "-01-05",
					"end_date" => $i . "-05-27" 
			);
			$terms [] = array (
					"name" => "Fall " . $i,
					"start_date" => $i . "-08-05",
					"end_date" => $i . "-12-15" 
			);
		}
		$table->saveAll ( $terms );
	}
	public function InsertDefaultCourses() {
		$table = ClassRegistry::init ( 'Course' );
		$courses = array (
				"NUR 111" => "Introduction to Professional Nursing",
				"NUR 112" => "Introduction to Professional Nursing",
				"NUR 155" => "Foundations of Nursing",
				"NUR 155C" => "Foundations of Nursing Clinical",
				"NUR 155L" => "Foundations of Nursing Lab",
				"NUR 167" => "Integrated Concepts of Registered Nursing Practice",
				"NUR 167C" => "Integrated Concepts of Registered Nursing Practice Clinical",
				"NUR 167L" => "Integrated Concepts of Registered Nursing Practice Lab",
				"NUR 170" => "Concepts of Medical/Surgical Nursing",
				"NUR 170C" => "Concepts of Medical/Surgical Nursing Clinical",
				"NUR 170L" => "Concepts of Medical/Surgical Nursing Lab",
				"NUR 200" => "LPN/LVN to RN Role Transition",
				"NUR 202" => "LPN/LVN to RN Role Transition",
				"NUR 210" => "Principles of Pharmacology",
				"NUR 230" => "Concepts of Nursing: The Childbearing/Child Caring Family",
				"NUR 230C" => "Concepts of Nursing: The Childbearing/Child Caring Family",
				"NUR 230L" => "Concepts of Nursing: The Childbearing/Child Caring Family",
				"NUR 231" => "Concepts of Nursing: The Childbearing/Child Caring Family",
				"NUR 231C" => "Concepts of Nursing: The Childbearing/Child Caring Family",
				"NUR 231L" => "Concepts of Nursing: The Childbearing/Child Caring Family",
				"NUR 242" => "Medical/Surgical Nursing Concepts",
				"NUR 242C" => "Medical/Surgical Nursing Concepts Clinical",
				"NUR 242L" => "Medical/Surgical Nursing Concepts Lab",
				"NUR 253" => "Concepts of Mental Health Nursing",
				"NUR 253C" => "Concepts of Mental Health Nursing Clinical",
				"NUR 254" => "Concepts of Nursing: Childbearing and Child Caring Families",
				"NUR 254C" => "Concepts of Nursing: Childbearing and Child Caring Families",
				"NUR 254L" => "Concepts of Nursing: Childbearing and Child Caring Families",
				"NUR 255" => "Concepts of Aging Chronic Illness and Mental Health",
				"NUR 255C" => "Concepts of Aging Chronic Illness and Mental Health Clinical",
				"NUR 255L" => "Concepts of Aging Chronic Illness and Mental Health Lab",
				"NUR 265" => "Advanced Concepts of Medical/Surgical Nursing",
				"NUR 265C" => "Advanced Concepts of Medical/Surgical Nursing Clinical",
				"NUR 265L" => "Advanced Concepts of Medical/Surgical Nursing Lab",
				"NUR 280" => "Transition to Registered Nursing Practice",
				"NUR 280C" => "Transition to Registered Nursing Practice",
				"NUR 280L" => "Transition to Registered Nursing Practice",
				"NUR 300" => "Transition to Baccalaureate Nursing",
				"NUR 310" => "Healthcare Informatics",
				"NUR 320" => "Health Promotion",
				"NUR 330" => "Concepts of Pathophysiology for Nursing",
				"NUR 340" => "Special Topics - Nursing",
				"NUR 400" => "Application of Evidence-Based Research",
				"NUR 410" => "Healthcare Policy & Finance",
				"NUR 420" => "Community Health Nursing",
				"NUR 431" => "Nursing Leadership and Management",
				"NUR 432" => "Nursing Leadership Practicum Experience",
				"NUR 440" => "Critical Issues in Global Health",
				"NUR 441" => "Transcultural Nursing",
				"NUR 442" => "Global Health Field Experience",
				"NUR 480" => "Capstone Course" 
		);
		$records = array ();
		foreach ( $courses as $code => $name ) {
			$record = array (
					"code" => $code,
					"name" => $name 
			);
			
			$records [] = $record;
		}
		$table->saveAll ( $records );
	}
	public function InsertDefaultOptions() {
		$table = ClassRegistry::init ( 'Option' );
		$options = array (
				array (
						'gender',
						'F',
						'Female' 
				),
				array (
						'gender',
						'M',
						'Male' 
				),
				array (
						'last_name',
						'Smith' 
				),
				array (
						'last_name',
						'Johnson' 
				),
				array (
						'last_name',
						'Williams' 
				),
				array (
						'last_name',
						'Jones' 
				),
				array (
						'last_name',
						'Brown' 
				),
				array (
						'last_name',
						'Davis' 
				),
				array (
						'last_name',
						'Miller' 
				),
				array (
						'last_name',
						'Wilson' 
				),
				array (
						'last_name',
						'Moore' 
				),
				array (
						'last_name',
						'Taylor' 
				),
				array (
						'last_name',
						'Anderson' 
				),
				array (
						'last_name',
						'Thomas' 
				),
				array (
						'last_name',
						'Jackson' 
				),
				array (
						'last_name',
						'White' 
				),
				array (
						'last_name',
						'Harris' 
				),
				array (
						'last_name',
						'Martin' 
				),
				array (
						'last_name',
						'Thompson' 
				),
				array (
						'last_name',
						'Garcia' 
				),
				array (
						'last_name',
						'Martinez' 
				),
				array (
						'last_name',
						'Robinson' 
				),
				array (
						'last_name',
						'Clark' 
				),
				array (
						'last_name',
						'Rodriguez' 
				),
				array (
						'last_name',
						'Lewis' 
				),
				array (
						'last_name',
						'Lee' 
				),
				array (
						'last_name',
						'Walker' 
				),
				array (
						'last_name',
						'Hall' 
				),
				array (
						'last_name',
						'Allen' 
				),
				array (
						'last_name',
						'Young' 
				),
				array (
						'last_name',
						'Hernandez' 
				),
				array (
						'last_name',
						'King' 
				),
				array (
						'last_name',
						'Wright' 
				),
				array (
						'last_name',
						'Lopez' 
				),
				array (
						'last_name',
						'Hill' 
				),
				array (
						'last_name',
						'Scott' 
				),
				array (
						'last_name',
						'Green' 
				),
				array (
						'last_name',
						'Adams' 
				),
				array (
						'last_name',
						'Baker' 
				),
				array (
						'last_name',
						'Gonzalez' 
				),
				array (
						'last_name',
						'Nelson' 
				),
				array (
						'last_name',
						'Carter' 
				),
				array (
						'last_name',
						'Mitchell' 
				),
				array (
						'last_name',
						'Perez' 
				),
				array (
						'last_name',
						'Roberts' 
				),
				array (
						'last_name',
						'Turner' 
				),
				array (
						'last_name',
						'Phillips' 
				),
				array (
						'last_name',
						'Campbell' 
				),
				array (
						'last_name',
						'Parker' 
				),
				array (
						'last_name',
						'Evans' 
				),
				array (
						'last_name',
						'Edwards' 
				),
				array (
						'last_name',
						'Collins' 
				),
				array (
						'last_name',
						'Stewart' 
				),
				array (
						'last_name',
						'Sanchez' 
				),
				array (
						'last_name',
						'Morris' 
				),
				array (
						'last_name',
						'Rogers' 
				),
				array (
						'last_name',
						'Reed' 
				),
				array (
						'last_name',
						'Cook' 
				),
				array (
						'last_name',
						'Morgan' 
				),
				array (
						'last_name',
						'Bell' 
				),
				array (
						'last_name',
						'Murphy' 
				),
				array (
						'last_name',
						'Bailey' 
				),
				array (
						'last_name',
						'Rivera' 
				),
				array (
						'last_name',
						'Cooper' 
				),
				array (
						'last_name',
						'Richardson' 
				),
				array (
						'last_name',
						'Cox' 
				),
				array (
						'last_name',
						'Howard' 
				),
				array (
						'last_name',
						'Ward' 
				),
				array (
						'last_name',
						'Torres' 
				),
				array (
						'last_name',
						'Peterson' 
				),
				array (
						'last_name',
						'Gray' 
				),
				array (
						'last_name',
						'Ramirez' 
				),
				array (
						'last_name',
						'James' 
				),
				array (
						'last_name',
						'Watson' 
				),
				array (
						'last_name',
						'Brooks' 
				),
				array (
						'last_name',
						'Kelly' 
				),
				array (
						'last_name',
						'Sanders' 
				),
				array (
						'last_name',
						'Price' 
				),
				array (
						'last_name',
						'Bennett' 
				),
				array (
						'last_name',
						'Wood' 
				),
				array (
						'last_name',
						'Barnes' 
				),
				array (
						'last_name',
						'Ross' 
				),
				array (
						'last_name',
						'Henderson' 
				),
				array (
						'last_name',
						'Coleman' 
				),
				array (
						'last_name',
						'Jenkins' 
				),
				array (
						'last_name',
						'Perry' 
				),
				array (
						'last_name',
						'Powell' 
				),
				array (
						'last_name',
						'Long' 
				),
				array (
						'last_name',
						'Patterson' 
				),
				array (
						'last_name',
						'Hughes' 
				),
				array (
						'last_name',
						'Flores' 
				),
				array (
						'last_name',
						'Washington' 
				),
				array (
						'last_name',
						'Butler' 
				),
				array (
						'last_name',
						'Simmons' 
				),
				array (
						'last_name',
						'Foster' 
				),
				array (
						'last_name',
						'Gonzales' 
				),
				array (
						'last_name',
						'Bryant' 
				),
				array (
						'last_name',
						'Alexander' 
				),
				array (
						'last_name',
						'Russell' 
				),
				array (
						'last_name',
						'Griffin' 
				),
				array (
						'last_name',
						'Diaz' 
				),
				array (
						'last_name',
						'Hayes' 
				),
				array (
						'first_name_m',
						'James' 
				),
				array (
						'first_name_m',
						'John' 
				),
				array (
						'first_name_m',
						'Robert' 
				),
				array (
						'first_name_m',
						'Michael' 
				),
				array (
						'first_name_m',
						'William' 
				),
				array (
						'first_name_m',
						'David' 
				),
				array (
						'first_name_m',
						'Richard' 
				),
				array (
						'first_name_m',
						'Joseph' 
				),
				array (
						'first_name_m',
						'Charles' 
				),
				array (
						'first_name_m',
						'Thomas' 
				),
				array (
						'first_name_m',
						'Christopher' 
				),
				array (
						'first_name_m',
						'Daniel' 
				),
				array (
						'first_name_m',
						'Matthew' 
				),
				array (
						'first_name_m',
						'Donald' 
				),
				array (
						'first_name_m',
						'Anthony' 
				),
				array (
						'first_name_m',
						'Paul' 
				),
				array (
						'first_name_m',
						'Mark' 
				),
				array (
						'first_name_m',
						'George' 
				),
				array (
						'first_name_m',
						'Steven' 
				),
				array (
						'first_name_m',
						'Kenneth' 
				),
				array (
						'first_name_m',
						'Andrew' 
				),
				array (
						'first_name_m',
						'Edward' 
				),
				array (
						'first_name_m',
						'Joshua' 
				),
				array (
						'first_name_m',
						'Brian' 
				),
				array (
						'first_name_m',
						'Kevin' 
				),
				array (
						'first_name_m',
						'Ronald' 
				),
				array (
						'first_name_m',
						'Timothy' 
				),
				array (
						'first_name_m',
						'Jason' 
				),
				array (
						'first_name_m',
						'Jeffrey' 
				),
				array (
						'first_name_m',
						'Gary' 
				),
				array (
						'first_name_m',
						'Ryan' 
				),
				array (
						'first_name_m',
						'Nicholas' 
				),
				array (
						'first_name_m',
						'Eric' 
				),
				array (
						'first_name_m',
						'Jacob' 
				),
				array (
						'first_name_m',
						'Stephen' 
				),
				array (
						'first_name_m',
						'Jonathan' 
				),
				array (
						'first_name_m',
						'Larry' 
				),
				array (
						'first_name_m',
						'Frank' 
				),
				array (
						'first_name_m',
						'Scott' 
				),
				array (
						'first_name_m',
						'Justin' 
				),
				array (
						'first_name_m',
						'Brandon' 
				),
				array (
						'first_name_m',
						'Raymond' 
				),
				array (
						'first_name_m',
						'Gregory' 
				),
				array (
						'first_name_m',
						'Samuel' 
				),
				array (
						'first_name_m',
						'Benjamin' 
				),
				array (
						'first_name_m',
						'Patrick' 
				),
				array (
						'first_name_m',
						'Jack' 
				),
				array (
						'first_name_m',
						'Dennis' 
				),
				array (
						'first_name_m',
						'Jerry' 
				),
				array (
						'first_name_m',
						'Alexander' 
				),
				array (
						'first_name_m',
						'Tyler' 
				),
				array (
						'first_name_m',
						'Henry' 
				),
				array (
						'first_name_m',
						'Douglas' 
				),
				array (
						'first_name_m',
						'Peter' 
				),
				array (
						'first_name_m',
						'Aaron' 
				),
				array (
						'first_name_m',
						'Walter' 
				),
				array (
						'first_name_m',
						'Jose' 
				),
				array (
						'first_name_m',
						'Adam' 
				),
				array (
						'first_name_m',
						'Zachary' 
				),
				array (
						'first_name_m',
						'Harold' 
				),
				array (
						'first_name_m',
						'Nathan' 
				),
				array (
						'first_name_m',
						'Kyle' 
				),
				array (
						'first_name_m',
						'Carl' 
				),
				array (
						'first_name_m',
						'Arthur' 
				),
				array (
						'first_name_m',
						'Gerald' 
				),
				array (
						'first_name_m',
						'Roger' 
				),
				array (
						'first_name_m',
						'Lawrence' 
				),
				array (
						'first_name_m',
						'Keith' 
				),
				array (
						'first_name_m',
						'Albert' 
				),
				array (
						'first_name_m',
						'Jeremy' 
				),
				array (
						'first_name_m',
						'Terry' 
				),
				array (
						'first_name_m',
						'Joe' 
				),
				array (
						'first_name_m',
						'Sean' 
				),
				array (
						'first_name_m',
						'Willie' 
				),
				array (
						'first_name_m',
						'Jesse' 
				),
				array (
						'first_name_m',
						'Austin' 
				),
				array (
						'first_name_m',
						'Christian' 
				),
				array (
						'first_name_m',
						'Ralph' 
				),
				array (
						'first_name_m',
						'Billy' 
				),
				array (
						'first_name_m',
						'Bruce' 
				),
				array (
						'first_name_m',
						'Bryan' 
				),
				array (
						'first_name_m',
						'Roy' 
				),
				array (
						'first_name_m',
						'Eugene' 
				),
				array (
						'first_name_m',
						'Ethan' 
				),
				array (
						'first_name_m',
						'Louis' 
				),
				array (
						'first_name_m',
						'Wayne' 
				),
				array (
						'first_name_m',
						'Jordan' 
				),
				array (
						'first_name_m',
						'Harry' 
				),
				array (
						'first_name_m',
						'Russell' 
				),
				array (
						'first_name_m',
						'Alan' 
				),
				array (
						'first_name_m',
						'Juan' 
				),
				array (
						'first_name_m',
						'Philip' 
				),
				array (
						'first_name_m',
						'Randy' 
				),
				array (
						'first_name_m',
						'Dylan' 
				),
				array (
						'first_name_m',
						'Howard' 
				),
				array (
						'first_name_m',
						'Vincent' 
				),
				array (
						'first_name_m',
						'Bobby' 
				),
				array (
						'first_name_m',
						'Johnny' 
				),
				array (
						'first_name_m',
						'Phillip' 
				),
				array (
						'first_name_m',
						'Shawn' 
				),
				array (
						'first_name_f',
						'Mary' 
				),
				array (
						'first_name_f',
						'Patricia' 
				),
				array (
						'first_name_f',
						'Jennifer' 
				),
				array (
						'first_name_f',
						'Elizabeth' 
				),
				array (
						'first_name_f',
						'Linda' 
				),
				array (
						'first_name_f',
						'Barbara' 
				),
				array (
						'first_name_f',
						'Susan' 
				),
				array (
						'first_name_f',
						'Margaret' 
				),
				array (
						'first_name_f',
						'Jessica' 
				),
				array (
						'first_name_f',
						'Dorothy' 
				),
				array (
						'first_name_f',
						'Sarah' 
				),
				array (
						'first_name_f',
						'Karen' 
				),
				array (
						'first_name_f',
						'Nancy' 
				),
				array (
						'first_name_f',
						'Betty' 
				),
				array (
						'first_name_f',
						'Lisa' 
				),
				array (
						'first_name_f',
						'Sandra' 
				),
				array (
						'first_name_f',
						'Helen' 
				),
				array (
						'first_name_f',
						'Ashley' 
				),
				array (
						'first_name_f',
						'Donna' 
				),
				array (
						'first_name_f',
						'Kimberly' 
				),
				array (
						'first_name_f',
						'Carol' 
				),
				array (
						'first_name_f',
						'Michelle' 
				),
				array (
						'first_name_f',
						'Emily' 
				),
				array (
						'first_name_f',
						'Amanda' 
				),
				array (
						'first_name_f',
						'Melissa' 
				),
				array (
						'first_name_f',
						'Deborah' 
				),
				array (
						'first_name_f',
						'Laura' 
				),
				array (
						'first_name_f',
						'Stephanie' 
				),
				array (
						'first_name_f',
						'Rebecca' 
				),
				array (
						'first_name_f',
						'Sharon' 
				),
				array (
						'first_name_f',
						'Cynthia' 
				),
				array (
						'first_name_f',
						'Kathleen' 
				),
				array (
						'first_name_f',
						'Ruth' 
				),
				array (
						'first_name_f',
						'Anna' 
				),
				array (
						'first_name_f',
						'Shirley' 
				),
				array (
						'first_name_f',
						'Amy' 
				),
				array (
						'first_name_f',
						'Angela' 
				),
				array (
						'first_name_f',
						'Virginia' 
				),
				array (
						'first_name_f',
						'Brenda' 
				),
				array (
						'first_name_f',
						'Pamela' 
				),
				array (
						'first_name_f',
						'Catherine' 
				),
				array (
						'first_name_f',
						'Katherine' 
				),
				array (
						'first_name_f',
						'Nicole' 
				),
				array (
						'first_name_f',
						'Christine' 
				),
				array (
						'first_name_f',
						'Janet' 
				),
				array (
						'first_name_f',
						'Debra' 
				),
				array (
						'first_name_f',
						'Samantha' 
				),
				array (
						'first_name_f',
						'Carolyn' 
				),
				array (
						'first_name_f',
						'Rachel' 
				),
				array (
						'first_name_f',
						'Heather' 
				),
				array (
						'first_name_f',
						'Maria' 
				),
				array (
						'first_name_f',
						'Diane' 
				),
				array (
						'first_name_f',
						'Frances' 
				),
				array (
						'first_name_f',
						'Joyce' 
				),
				array (
						'first_name_f',
						'Julie' 
				),
				array (
						'first_name_f',
						'Emma' 
				),
				array (
						'first_name_f',
						'Evelyn' 
				),
				array (
						'first_name_f',
						'Martha' 
				),
				array (
						'first_name_f',
						'Joan' 
				),
				array (
						'first_name_f',
						'Kelly' 
				),
				array (
						'first_name_f',
						'Christina' 
				),
				array (
						'first_name_f',
						'Lauren' 
				),
				array (
						'first_name_f',
						'Judith' 
				),
				array (
						'first_name_f',
						'Alice' 
				),
				array (
						'first_name_f',
						'Victoria' 
				),
				array (
						'first_name_f',
						'Doris' 
				),
				array (
						'first_name_f',
						'Ann' 
				),
				array (
						'first_name_f',
						'Jean' 
				),
				array (
						'first_name_f',
						'Cheryl' 
				),
				array (
						'first_name_f',
						'Marie' 
				),
				array (
						'first_name_f',
						'Megan' 
				),
				array (
						'first_name_f',
						'Kathryn' 
				),
				array (
						'first_name_f',
						'Andrea' 
				),
				array (
						'first_name_f',
						'Jacqueline' 
				),
				array (
						'first_name_f',
						'Gloria' 
				),
				array (
						'first_name_f',
						'Teresa' 
				),
				array (
						'first_name_f',
						'Janice' 
				),
				array (
						'first_name_f',
						'Sara' 
				),
				array (
						'first_name_f',
						'Rose' 
				),
				array (
						'first_name_f',
						'Hannah' 
				),
				array (
						'first_name_f',
						'Julia' 
				),
				array (
						'first_name_f',
						'Theresa' 
				),
				array (
						'first_name_f',
						'Judy' 
				),
				array (
						'first_name_f',
						'Grace' 
				),
				array (
						'first_name_f',
						'Beverly' 
				),
				array (
						'first_name_f',
						'Denise' 
				),
				array (
						'first_name_f',
						'Marilyn' 
				),
				array (
						'first_name_f',
						'Mildred' 
				),
				array (
						'first_name_f',
						'Amber' 
				),
				array (
						'first_name_f',
						'Danielle' 
				),
				array (
						'first_name_f',
						'Brittany' 
				),
				array (
						'first_name_f',
						'Olivia' 
				),
				array (
						'first_name_f',
						'Diana' 
				),
				array (
						'first_name_f',
						'Jane' 
				),
				array (
						'first_name_f',
						'Lori' 
				),
				array (
						'first_name_f',
						'Madison' 
				),
				array (
						'first_name_f',
						'Tiffany' 
				),
				array (
						'first_name_f',
						'Kathy' 
				),
				array (
						'first_name_f',
						'Tammy' 
				),
				array (
						'first_name_f',
						'Crystal' 
				) 
		);
		$records = array ();
		foreach ( $options as $key => $option ) {
			$record = array (
					"group_name" => $option [0],
					"name" => $option [1],
					"description" => $option [1] 
			);
			if (count ( $option ) == 3) {
				$record ['description'] = $option [2];
			}
			$records [] = $record;
		}
		$table->saveAll ( $records );
	}
	public $cake_sessions = array (
			'id' => array (
					'type' => 'string',
					'null' => false,
					'key' => 'primary' 
			),
			'data' => array (
					'type' => 'text',
					'null' => true,
					'default' => null 
			),
			'expires' => array (
					'type' => 'integer',
					'null' => true,
					'default' => null 
			),
			'indexes' => array (
					'PRIMARY' => array (
							'column' => 'id',
							'unique' => 1 
					) 
			),
			'tableParameters' => array (
					'charset' => 'latin1',
					'collate' => 'latin1_swedish_ci',
					'engine' => 'InnoDB' 
			) 
	);
	public $options = array (
			'id' => array (
					'type' => 'integer',
					'null' => false,
					'default' => 0,
					'unsigned' => false,
					'key' => 'primary' 
			),
			'group_name' => array (
					'type' => 'string',
					'length' => 255,
					'null' => false,
					'collate' => 'latin1_swedish_ci',
					'charset' => 'latin1' 
			),
			'name' => array (
					'type' => 'string',
					'length' => 255,
					'null' => false,
					'collate' => 'latin1_swedish_ci',
					'charset' => 'latin1' 
			),
			'description' => array (
					'type' => 'string',
					'length' => 255,
					'null' => true,
					'collate' => 'latin1_swedish_ci',
					'charset' => 'latin1' 
			),
			'indexes' => array (
					'PRIMARY' => array (
							'column' => 'id',
							'unique' => 1 
					),
					'options_group_name' => array (
							'column' => 'group_name' 
					) 
			),
			'tableParameters' => array (
					'charset' => 'latin1',
					'collate' => 'latin1_swedish_ci',
					'engine' => 'InnoDB' 
			) 
	);
	public $students = array (
			'id' => array (
					'type' => 'biginteger',
					'null' => false,
					'default' => 0,
					'unsigned' => false,
					'key' => 'primary' 
			),
			'first_name' => array (
					'type' => 'string',
					'length' => 255,
					'null' => false,
					'collate' => 'latin1_swedish_ci',
					'charset' => 'latin1' 
			),
			'last_name' => array (
					'type' => 'string',
					'length' => 255,
					'null' => false,
					'collate' => 'latin1_swedish_ci',
					'charset' => 'latin1' 
			),
			'gender' => array (
					'type' => 'string',
					'length' => 5,
					'null' => true,
					'collate' => 'latin1_swedish_ci',
					'charset' => 'latin1' 
			),
			'dob' => array (
					'type' => 'datetime',
					'null' => true 
			),
			'indexes' => array (
					'PRIMARY' => array (
							'column' => 'id',
							'unique' => 1 
					) 
			),
			'tableParameters' => array (
					'charset' => 'latin1',
					'collate' => 'latin1_swedish_ci',
					'engine' => 'InnoDB' 
			) 
	);
	public $teachers = array (
			'id' => array (
					'type' => 'biginteger',
					'null' => false,
					'default' => 0,
					'unsigned' => false,
					'key' => 'primary' 
			),
			'first_name' => array (
					'type' => 'string',
					'length' => 255,
					'null' => false,
					'collate' => 'latin1_swedish_ci',
					'charset' => 'latin1' 
			),
			'last_name' => array (
					'type' => 'string',
					'length' => 255,
					'null' => false,
					'collate' => 'latin1_swedish_ci',
					'charset' => 'latin1' 
			),
			'gender' => array (
					'type' => 'string',
					'length' => 5,
					'null' => true,
					'collate' => 'latin1_swedish_ci',
					'charset' => 'latin1' 
			),
			'dob' => array (
					'type' => 'datetime',
					'null' => true 
			),
			'indexes' => array (
					'PRIMARY' => array (
							'column' => 'id',
							'unique' => 1 
					) 
			),
			'tableParameters' => array (
					'charset' => 'latin1',
					'collate' => 'latin1_swedish_ci',
					'engine' => 'InnoDB' 
			) 
	);
	public $courses = array (
			'id' => array (
					'type' => 'biginteger',
					'null' => false,
					'default' => 0,
					'unsigned' => false,
					'key' => 'primary' 
			),
			'code' => array (
					'type' => 'string',
					'length' => 255,
					'null' => false,
					'collate' => 'latin1_swedish_ci',
					'charset' => 'latin1' 
			),
			'name' => array (
					'type' => 'string',
					'length' => 255,
					'null' => false,
					'collate' => 'latin1_swedish_ci',
					'charset' => 'latin1' 
			),
			'description' => array (
					'type' => 'text',
					'null' => true,
					'collate' => 'latin1_swedish_ci',
					'charset' => 'latin1' 
			),
			'indexes' => array (
					'PRIMARY' => array (
							'column' => 'id',
							'unique' => 1 
					) 
			),
			'tableParameters' => array (
					'charset' => 'latin1',
					'collate' => 'latin1_swedish_ci',
					'engine' => 'InnoDB' 
			) 
	);
	public $terms = array (
			'id' => array (
					'type' => 'biginteger',
					'null' => false,
					'default' => 0,
					'unsigned' => false,
					'key' => 'primary' 
			),
			'name' => array (
					'type' => 'string',
					'length' => 255,
					'null' => false,
					'collate' => 'latin1_swedish_ci',
					'charset' => 'latin1' 
			),
			'start_date' => array (
					'type' => 'datetime',
					'null' => false 
			),
			'end_date' => array (
					'type' => 'datetime',
					'null' => false 
			),
			'description' => array (
					'type' => 'string',
					'length' => 5,
					'null' => true,
					'collate' => 'latin1_swedish_ci',
					'charset' => 'latin1' 
			),
			'indexes' => array (
					'PRIMARY' => array (
							'column' => 'id',
							'unique' => 1 
					) 
			),
			'tableParameters' => array (
					'charset' => 'latin1',
					'collate' => 'latin1_swedish_ci',
					'engine' => 'InnoDB' 
			) 
	);
	public $class_schedules = array (
			'id' => array (
					'type' => 'biginteger',
					'null' => false,
					'default' => 0,
					'unsigned' => false,
					'key' => 'primary' 
			),
			'course_id' => array (
					'type' => 'biginteger',
					'null' => false 
			),
			'teacher_id' => array (
					'type' => 'biginteger',
					'null' => false 
			),
			'term_id' => array (
					'type' => 'biginteger',
					'null' => false 
			),
			'max_seats' => array (
					'type' => 'integer',
					'null' => false,
					'default' => 50 
			),
			'indexes' => array (
					'PRIMARY' => array (
							'column' => 'id',
							'unique' => 1 
					) 
			),
			'tableParameters' => array (
					'charset' => 'latin1',
					'collate' => 'latin1_swedish_ci',
					'engine' => 'InnoDB' 
			) 
	);
	public $enrollments = array (
			'id' => array (
					'type' => 'biginteger',
					'null' => false,
					'default' => 0,
					'unsigned' => false,
					'key' => 'primary' 
			),
			'class_schedule_id' => array (
					'type' => 'biginteger',
					'null' => false 
			),
			'student_id' => array (
					'type' => 'biginteger',
					'null' => false 
			),
			'final_grade' => array (
					'type' => 'float',
					'null' => true,
					'default' => null
			),
			'status' => array (
					'type' => 'string',
					'length' => '25',
					'null' => false,
					'default' => 'active' 
			),
			'indexes' => array (
					'PRIMARY' => array (
							'column' => 'id',
							'unique' => 1 
					) 
			),
			'tableParameters' => array (
					'charset' => 'latin1',
					'collate' => 'latin1_swedish_ci',
					'engine' => 'InnoDB' 
			) 
	);
}