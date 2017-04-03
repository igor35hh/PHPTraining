<?php

	class Setter {
		public $n;
		private $x = array("a" => 1, "b" => 2, "c" => 3);

		function __get($nm) {
			print "read [$nm]\n";

			if(isset($this->x[$nm])) {
				$r = $this->x[$nm];
				print "got: $r\n";
				return $r;
			} else {
				print "Nothing\n";
			}
		}

		function __set($nm, $val) {
			print "write $val to [$nm]\n";

			if(isset($this->x[$nm])) {
				$this->x[$nm] = $val;
				print "ready\n";
			} else {
				print "Nothing\n";
			}
		}

		$foo = new Setter();
		$foo->n = 1;
		$foo->a = 100;
		$foo->a ++;
		$foo->z ++;
		var_dump($foo);
	}

	//overrides methods

	class Caller {
		private $x = array(1,2,3);

		function __call($m, $a) {
			print "it was calling method $m \n";
			var_dump($a);
			return $this->x;
		}
	}

	$foo = new Caller();
	$a = $foo->test(1,"2", 3.5, true);
	var_dump($a);

	//interface

	interface ITemplate {
		public function setVariable($name, $var);
		public function getHTML($template);
	}

	class Template implements ITemplate {
		private $vars = array();

		public function setVariable($name, $var) {
			$this->vars[$name] = $var;
		}

		public function getHTML($template) {
			foreach ($this->vars as $key => $value) {
				$template = str_replace('{'.$key.'}', $value, $template);
			}
			return $template;
		}
	}

	//instanceof
	if($obj instanceof Template) {
		print "$obj is a Template";
	}

	//final

	class BaseClass {
		public function test() {
			echo "was calling method BaseClass::test()\n";
		}

		final public function testYet() {
			echo "was calling method BaseClass::testYet()\n";
		}
	}

	class ChildClass extends BaseClass {
		public function testYet() {
			echo "was calling method ChildClass::testYet()\n"; //there will be fatal error Cannot override
		}
	}

	//final for classes

	final class FClass {

	}

	class BClass extends FClass { //it will be error, imposible extend final class

	}

?>