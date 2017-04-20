<?php

class PHP_Autoload {
	static $funcs = array();
	static $ok = true;

	static function register($func) {
		self::$funcs[] =& $func;
	}

	static function unregister($func) {
		$f =& self::$funcs;
		for($i=0; $i<count($f); $i++) {
			if($f[$i] === $func) {
				array_splice($f, $i, 1);
				break;
			}
		}
	}

	static function autoload($classname) {
		static $loading = array();

		if(@$loading[$classname]) {
			return;
		}

		$loading[$classname] = true;

		foreach ($array_reverse(self::$funcs) as $f) {
			if(class_exists($classname)) {
				break;
			}
			if(call_user_func($f, $classname)) {
				break;
			}	
		}

		$loading[$classname] = false;
	}

	if(!function_exists("__autoload")) {
		function __autoload($c) {
			PHP_Autoload::autoload($c);
		} else {
			PHP_Autoload::$ok = false;
		}
	}

}

?>