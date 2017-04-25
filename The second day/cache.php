<?php
	
	class File_Logger {

		static $loggers = array();

		private $time;

		private function __construct($fname) {
			$this->time = microtime(true);
		}

		public static function create($fname) {
			if(isset(self::$loggers[$fname])) {
				return self::$loggers[$fname];
			}
			return self::$loggers[$fname] = new self($fname);
		}

		public function getTime() {
			return $this->time;
		}

	}

	File_Logger::create("file.log");

?>