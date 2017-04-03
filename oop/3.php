<?php
	
	function __autoload($class_name) {
		include_once($class_name . "php");
	}

	$obj1 = new MyClass1();
	$obj2 = new MyClass2();

	//exceptions

	class SQLException extends Exception {
		public $problem;
		function _construct($problem) {
			$this->problem = $problem;
		}
	}

	try {
		throw new SQLException("Couldn't connect to database");
	} catch (SQLException $e) {
		print "Caught an exception of sql with problem $obj->problem";
	} catch (Exception $e) {
		print "Caught unrecongbized exeption";
	}

	//comparing

	function bool2str($bool) {
		if($bool === false) {
			return 'FALSE';
		} else {
			return "TRUE";
		}
	}

	function compareObject(&$o1, &$o2) {
		echo 'o1 == o2 : '.bool2str($o1 == $o2)."\n";
		echo 'o1 != o2 : '.bool2str($o1 != $o2)."\n";
		echo 'o1 === o2 : '.bool2str($o1 === $o2)."\n";
		echo 'o1 !== o2 : '.bool2str($o1 !== $o2)."\n";
	}

	class Flag {
		var $flag;

		function Flag($flag = true) {
			$this->flag = $flag;
		}
	}

	class OtherFlag {
		var $flag;

		function OtherFlag($flag = true) {
			$this->flag = $flag;
		}
	}


	$o = new Flag();
	$p = new Flag();
	$q = $o;
	$r = new OtherFlag();

	echo 'two objects the same class';
	compareObject($o, $p);

	echo 'two links the same class';
	compareObject($o, $q);

	echo 'two objects diferent classes';
	compareObject($o, $r);

?>