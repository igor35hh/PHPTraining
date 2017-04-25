<?php

	class Hooker {

		public $opened = 'opened';

		public function method() {
			echo "Call method.<br>";
		}

		private $vars = array();

		public function __get($name) {
			echo "overload get $name <br>";
			return isset($this->vars[$name]) ? $this->vars[$name] : null;
		}

		public function __set($name, $value) {
			echo "overload set for $name next $value <br>";
			return $this->vars[$name] = trim($value);
		}

		public function __call($name, $args) {
			echo "overload call $name with arguments $args";
			var_dump($args);
			return $args[0];
		}

	}

?>