<?php

	class human {

		public $name;
		static $lastname;

		public function __construct($name) {
			$this->name = $name;
			$name = $name; //incorrect, it causes error
		}

		public function classFunc() {};

		function getName() {
			echo $name;			//incorrect
			echo $this->name;	//correct
			$this->classFunc();
			//
			echo self::$lastname;
			echo $this->lastname; //null or error, wrong
		}
	}

	class Klass {
		const STAT = 'S';
		$stat = 'Static';
		public $publ = 'Public';
		private $priv = 'Private';
		protected $prot = 'Protected';

		function __construct() {}

		public function show() {
			print '<br> self::STAT: '.self::STAT; //link to constant
			print '<br> self::$stat: '.self::$stat; //static variable
			print '<br>$this->stat: '.$this->stat; //there will be empty error and a warning
			print '<br>$this->publ: '.$this->publ; //it shows correct
			print '<br>';
		}
		$me = new Klass();
		$me->show();
	}

	class Person {
		private $name;

		public function __construct($name) {
			$this->name = $name;
		}

		public function getName() {
			return $this->name;
		}

		public function getTitle() {
			return $this->getName()." the person";
		}

		public function sayHello() {
			echo "Hello, I'm ".$this->getTitle()."<br>";
		}

		public function sayGoodBye() {
			echo "Goodbey from ".self::getTitle()."<br>";
		}
		public function sayGoodByeStatic() {
			echo "Goodbey from ".static::getTitle()."<br>";
		}
	}

	class Geek extends Person {
		public function __construct($name) {
			parent::__construct($name);
		}

		public function getTitle() {
			return $this->getName()." the geek";
		}
	}

	$geekObj = new Geek("Ludwig");
	$geekObj->sayHello(); //sayHello uses this of Geek hence it causes Geek::getTitle()
	$geekObj->sayGoodBye(); //sayGoodBye uses self that's way virtual table isn't works and it causes parent::getTitle(), next decision can help: use static instead self


?>