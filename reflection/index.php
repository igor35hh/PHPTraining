<?php

	
	class reflClass {
		//public reflect=0;
	}

	$className = "reflClass";
	$class = new ReflectionClass($className);
	$obj = $class->newInstance();
	var_dump($obj);
	echo "the first class <br>";

	$obj = call_user_func_array(array(&$class, "newInstance"), array());
	var_dump($obj);
	echo "the second class <br>";

	function CallMe($who) {
		echo "it is $who <br>";
	}

	$func = new ReflectionFunction('CallMe');
	$func->invoke("Adam");

	class Base {
		private $prop = 0;
		function getBase() {
			return $this->prop;
		}
	}

	class Derive extends Base {
		public $prop = 1;
		function getDerive() {
			return $this->prop;
		}
	}

	$cls = new ReflectionClass('Derive');
	$obj = $cls->newInstance();
	$obj->prop = 2;
	echo "Base {$obj->getBase()} Derive {$obj->getDerive()} <br>";
	var_dump($cls->getProperties());
	echo "<br>";
	var_dump($cls->getMethods());

	echo "<br>";

	$consts = array();
	foreach (get_loaded_extensions() as $key) {
		$ext = new ReflectionExtension($key);
		$consts = array_merge($consts, $ext->getConstants());
	}
	echo "<pre>". var_export($consts, true) ."</pre>";

?>