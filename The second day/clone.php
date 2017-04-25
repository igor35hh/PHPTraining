<?php

	class Human {

		private static $i = 255550690;

		public $dna;
		public $text;

		public function __construct() {
			$this->dna = self::$i++;
			$this->text = "There is no spoon";
		}

		public function __clone() {
			$this->dna = $this->dna."(cloned)";
		}

	}

?>