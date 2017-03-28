<?php

	class MyClass {

		const SUCCESS = "success";
		const FAILURE = "failure";

		static function hello() {
			print "hello";
		}

		function __clone() {
			print "it was cloned";
		}
	}

	print MyClass::SUCCESS;
	echo '<br>';

	print MyClass::hello();
	echo '<br>';

	$obj = new MyClass();

	echo $obj::SUCCESS;
	echo '<br>';

	echo $obj::hello();
	echo '<br>';

	clone $obj;

	class Singlenton {
		static private $instance = NULL;

		private function __construct() {

		}

		static public function getInstance() {
			if(self::$instance == NULL) {
				self::$instance = new Singlenton();
			}
			return self::$instance;
		}
	}

	abstract class AbsClass {
		abstract protected function getValue();

		public function print() {
			print $this->getValue();
		}
	}

	class SomeClass1 extends AbsClass {
		protected function getValue() {
			return "someClass1";
		}
	}

	class SomeClass2 extends AbsClass {
		protected function getValue() {
			return "someClass2";
		}
	}

	$class1 = new SomeClass1();
	$class1->print();

	$class2 = new SomeClass2();
	$class2->print();

	function expectClass(MyClass $obj) {

	}

	$someobj->method()->method2(); 

	//iterators

	class iterClass {
		public $var1 = 'value 1';
		public $var2 = 'value 2';
		public $var3 = 'value 3';

		protected $protected = 'protected';
		private $private = 'private';
	}

	$class = new iterClass();
	foreach ($class as $key => $value) {
		print "$key => $value\n"; //there are only public methods
	}

?>