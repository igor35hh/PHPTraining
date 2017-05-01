<?php

	class FileSystemException extends Exception {
		private $name;
		public function __construct($name) {
			parent::__construct($name);
			$this->name = $name;
		}
		public function getName() {return $this->name;}
	}

	class FileNotFoundException extends FileSystemException {};

	class FileWriteException extends FileSystemException {};

	try {
		if(!file_exists("sppon")) {
			throw new FileNotFoundException("sppon", 1);
			
		}
	} catch (FileSystemException $e) {
		echo "file error {$e->getName()} <br>";
	} catch (Exception $e) {
		echo "other error {$e->getDirName()} <br>";
	}

?>