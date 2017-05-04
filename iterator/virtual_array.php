<?php

	class InsensitiveArray implements ArrayAccess {
		public $a  = array();

		public function offsetExists($offset) {
			$offset = strtolower($offset);
			$this->log("offsetExists('$offset')");
			return isset($this->a[$offset]);
		}

		public function offsetGet($offset) {
			$offset = strtolower($offset);
			$this->log("offsetGet('$offset')");
			return isset($this->a[$offset]);
		}

		public function offsetSet($offset, $data) {
			$offset = strtolower($offset);
			$this->log("offsetSet('$offset', '$data')");
			$this->a[$offset] = $data;
		}

		public function offsetUnset($offset) {
			$offset = strtolower($offset);
			$this->log("offsetUnset('$offset')");
			unset($this->array[$offset]);
		}

		public function log($str) {
			echo "$str<br>";
		}

	}

	$a = new InsensitiveArray();
		$a->log("setting value by (statement =)");
		$a['php'] = "there is more than one character";
		$a['php'] = "this value will be overwritten";
		$a->log("get value of element by (statement [])");
		$a->log("<b>Value is: </b> '{$a['PHP']}' ");
		$a->log("check exist of elemnt by (statement isset())");
		$a->log("<b>exists: </b>" . (isset($a['Php']) ? "true" : "false"));
		$a->log("destry elemnt by (statement unset())");
		unset($a['phP']);

?>