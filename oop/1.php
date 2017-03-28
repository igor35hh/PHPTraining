<?php

	class MyClass {
		public $public = 'public';
		protected $protected = 'protected';
		private $private = 'private';

		function printHello() {
			echo $this->public;
			echo $this->protected;
			echo $this->private;
		}
	}

	$obj = new MyClass();
	echo $obj->public;
	echo $obj->protected; //error
	echo $obj->private; //error
	$obj->printHello(); //shows all

	class MyClass2 extends MyClass {
		
		protected $protected = 'protected2'; //we can redeclare only protected and public methods

		function printHello() {
			echo $this->public;
			echo $this->protected;
			echo $this->private;
		}
	}

	$obj = new MyClass2();
	echo $obj->public;
	echo $obj->protected; //error
	echo $obj->private; //undefine
	$obj->printHello(); //shows public and protected

	class BaseClass {
		function __construct() {
			print "the __construct";
		}

		function __destruct() {
			print "Class is deleting ".$this->name;
		}
	}

	class SubClass extends BaseClass {
		function __construct() {
			parent::__construct();
			print "the SubClass's __construct";
		}

		function __destruct() {
			parent::__destruct();
			print "Class is deleting ".$this->name;
		}
	}

	$obj = new BaseClass();
	unset($obj);
	$obj = new SubClass();
	unset($obj);

?>