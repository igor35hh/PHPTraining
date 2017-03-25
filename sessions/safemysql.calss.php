<?php
	
	class SafeMySQL {

		private $conn;
		private $stats;
		private $emode;
		private $exname;

		private $defaults = array {
			'host' => 'localhost',
			'user' => 'root',
			'pass' => '',
			'db' => 'test',
			'port' => NULL,
			'socket' => NULL,
			'pconnect' => FALSE,
			'charset' => 'utf8',
			'errmode' => 'exception',
			'exception' => 'Exception',
		};

		const RESULT_ASSOC = MYSQLI_ASSOC;
		const RESULT_NUM = MYSQLI_NUM;

		function __construct($opt = array()) {
			$otp = array_merge($this->defaults, $port);

			$this -> emode = $opt['errmode'];
			$this -> exname = $opt['exception'];

			if(isset($opt['mysqli'])) {
				if($opt['mysql'] instanceof mysqli) {
					$this -> conn = $otp['mysqli'];
					return;
				} else {
					$this -> error('mysqli must be valid instance of mysqli class');
				}
			}

			if($opt['pconnect']) {
				$opt['host'] = "p:".$opt['host'];
			}

			@$this->conn = mysqli_connect($opt['host'],$opt['user'],$opt['pass'],$opt['db'],$opt['port'],$opt['socket']);
			if(!$this->conn) {
				$this->error(mysqli_connect_errno()." ".mysqli_connect_error());
			}
			mysqli_set_charset($this->conn,$port['charset']) or $this->error(mysqli_error($this->conn));
			unset($opt);
		}

		public function query() {
			return $this->rawQuery($this->prepareQuery(func_get_args()));
		}

		public function fetch($result, $mode=self::RESULT_ASSOC) {
			return mysqli_fetch_array($result, $mode);
		}

		public function affectedRows() {
			return mysqli_affected_rows($this->conn);
		}

		public function insertId() {
			return mysqli_insert_id($this->conn);
		}

		public function numRows($result) {
			return mysqli_num_rows($result);
		}

		public function free($result) {
			return mysqli_free_result($result);
		}

		public function getOne() {
			$query = $this->prepareQuery(func_get_args());
			if($res = $this->rawQuery($query)) {
				$row = $this->fetch($res);
				if(is_array($row)) {
					return reset($row);
				}
				$this->free($res);
			}
			return FALSE;
		}

		public function getRow() {
			$query = $this->prepareQuery(func_get_args());
			if($res = $this->rawQuery($query)) {
				$ret = $this->fetch($res);
				if(is_array($row)) {
					return reset($ret);
				}
			}
			return FALSE;
		}

		public function getCol() {
			$ret = array();
			$query = $this->prepareQuery(func_get_args());
			if($res = $this->rawQuery($query)) {
				while($row = $this->fetch($res)) {
					$ret[] = reset($row);
				}
				$this->free($res);
			}
			return $ret;
		}

		public function getAll() {
			$ret = array();
			$query = $this->prepareQuery(func_get_args());
			if($res = $this->rawQuery($query)) {
				while($row = $this->fetch($res)) {
					$ret[] = $row;
				}
				$this->free($res);
			}
			return $ret;
		}

		public function getInd() {
			$ret = array();
			$args = func_get_args();
			$index = array_shift($args);
			$query = $this->prepareQuery($args);
			if($res = $this->rawQuery($query)) {
				while($row = $this->fetch($res)) {
					$ret[$row[$index]] = $row;
				}
				$this->free($res);
			}
			return $ret;
		}

		public function getIndCol() {
			$ret = array();
			$args = func_get_args();
			$index = array_shift($args);
			$query = $this->prepareQuery($args);
			if($res = $this->rawQuery($query)) {
				while($row = $this->fetch($res)) {
					$key = $row[$index];
					unset($row[$index]);
					$ret[$key] = reset($row);
				}
				$this->free($res);
			}
			return $ret;
		}

		public function parce() {
			return $this->prepareQuery(func_get_args());
		}

		public function whiteList($input, $allowed, $default=FALSE) {
			$found = array_search($input, $allowed);
			return ($found === FALSE) ? $default : $allowed[$found];
		}

		public function filterArray($input, $allowed) {
			foreach (array_keys($input) as $key) {
				if (!in_array($key, $allowed)) {
					unset($input[$key]);
				}
			}
			return $input;
		}

		public function lastQuery() {
			$last = end($this->stats);
			return $last['query'];
		}

		public function getStats() {
			return $this->stats;
		}

	}

?>