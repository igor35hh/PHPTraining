<?php

	class FS_File {
		public $path;
		public function __construct($path) {
			$this->path = $path;
		}
		public function getSize() {
			return filesize($this->path);
		}
	}

	class FS_Directory implements IteratorAggregate {
		public $path;
		public function __construct($path) {
			$this->path = $path;
		}
		public function getIterator() {
			return new FS_DirectoryIterator($this);
		}
	}

	class FS_DirectoryIterator implements Iterator {
		private $owner;
		private $d = null;
		private $cur = false;

		public function __construct($owner) {
			$this->owner = $owner;
			$this->d = opendir($owner->path);
			$this->rewind();
		}

		public function rewind() {
			rewinddir($this->d);
			$this->cur = readdir($this->d);
		}

		public function valid() {
			return $this->cur !== false;
		}

		public function key() {
			return $this->cur;
		}

		public function current() {
			$path = $this->owner->path."/".$this->cur;
			return is_dir($path) ? new FS_Directory($path) : new FS_File($path);
		}

		public function next() {
			$this->cur = readdir($this->d);
		}
	}

?>