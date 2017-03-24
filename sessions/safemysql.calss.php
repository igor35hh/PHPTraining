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


	}

?>