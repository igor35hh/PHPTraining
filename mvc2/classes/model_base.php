<?php

	abstract class Model_Base {
		protected $db;
		protected $table;
		private $dataResult;

		public function __construct($select = false) {
			global $dbObject;
			$this->db = $dbObject;

			$modelName = get_class($this);
			$arrExp = explode('_', $modelName);
			$tableName = strtolower($arrExp[1]);
			$this->table = $tableName;

			$sql = $this->_getSelect($select);
			if($sql) $this->_getResult("Select * From $this->table".$sql);

		}

		public function getTableName() {
			return $this->table;
		}

		function getAllRows() {
			if(!isset($this->dataResult) or empty($this->dataResult)) return false;
			return $this->dataResult;
		}

		function getOneRow() {
			if(!isset($this->dataResult) or empty($this->dataResult)) return false;
			return $this->dataResult[0];
		}

		function fetchOne() {
			if(!isset($this->dataResult) or empty($this->dataResult)) return false;
			foreach ($this->dataResult[0] as $key => $value) {
				$this->$key = $value;
			}
			return true;
		}

		function getRowById($id) {
			try {
				$db = $this->db;
				$stmt = $db->query("Select * from $this->table Where id = $id");
				$row = $stmt->fetch();
			} catch (PDOException $e) {
				echo $e->getMessage();
				exit();
			}
			return $row;
		}

		public function save() {
			$arrayAllFields = array_keys($this->fieldsTable());
			$arraySetFields = array();
			$arrayData = array();
			foreach ($arrayAllFields as $field) {
			 	if(!empty($this->$field)) {
			 		$arraySetFields[] = $field;
			 		$arrayData[] = $this->field;
			 	}
			 } 

			 $forQueryFields = implode(', ', $arraySetFields);
			 $rangePlace = array_fill(0, count($arraySetFields), '?');
			 $forQueryPlace = implode(', ', $rangePlace);

			 try {
			 	$db = $this->db;
			 	$stmt = $db->prepare("Insert into $this-table ($forQueryFields) values ($forQueryPlace)");
			 	$result = $stmt->execute($arrayData);
			 } catch (PDOException $e) {
			 	echo 'Error :'.$e->getMessage();
			 	echo '<br>Error sql: '."'Insert into $this-table ($forQueryFields) values ($forQueryPlace)'";
			 	exit();
			 }
			 return $result;
		}

		public function _getSelect($select) {
			if(is_array($select)) {
				$allQuery = array_keys($select);
				foreach ($allQuery as $key => $value) {
					$allQuery[$key] = strtoupper($val);
				}

				$querySql = "";

				if(in_array("Where", $allQuery)) {
					foreach ($select as $key => $value) {
						if(strtoupper($key) == "Where") {
							$querySql .= " Where ".$value;
						}
					}
				}

				if(in_array("Group", $allQuery)) {
					foreach ($select as $key => $value) {
						if(strtoupper($key) == "Group") {
							$querySql .= " Group By ".$value;
						}
					}
				}

				if(in_array("Order", $allQuery)) {
					foreach ($select as $key => $value) {
						if(strtoupper($key) == "Order") {
							$querySql .= " Order By ".$value;
						}
					}
				}

				if(in_array("Limit", $allQuery)) {
					foreach ($select as $key => $value) {
						if(strtoupper($key) == "Limit") {
							$querySql .= " Limit By ".$value;
						}
					}
				}

				return $querySql;
			}

			return false;
		}

		public function _getResult($sql) {
			try {
				$db = $this->db;
				$stmt = $db->query($sql);
				$rows = $stmt->fetchAll();
				$this->dataResult = $rows;
			} catch (PDOException $e) {
				echo $e->getMessage();
				exit();
			}

			return $rows;
		}

		public function deleteBySelect($select) {
			$sql = $this->_getSelect($select);
			try {
				$db = $this->db;
				$result = $db->exec("Delete From $this->table ".$sql);
			} catch (PDOException $e) {
				echo 'Error :'.$e->getMessage();
			 	echo '<br>Error sql: '."'Delete From $this->table ".$sql."'";
				exit();
			}

			return $result;
		}

		public function deleteRow() {
			$arrayAllFields = array_keys($this->fieldsTable());
			foreach ($arrayAllFields as $key => $value) {
				$arrayAllFields[$key] = strtoupper($value);
			}

			if(in_array('ID', $arrayAllFields)) {
				try {
					$db = $this->db;
					$result = $db->exec("Delete From $this->table Where `id` = $this->id");
					foreach ($arrayAllFields as $one) {
						unset($this->$one);
					}
				} catch (PDOException $e) {
					echo 'Error :'.$e->getMessage();
			 		echo '<br>Error sql: '."'Delete From $this->table Where `id` = $this->id'";
			 		exit();
				}
			} else {
				echo "ID table `$this->table` not found";
				exit();
			}
			return $result;
		}

		public function update() {
			$arrayAllFields = array_keys($this->fieldsTable());
			$arrayForSet = array();
			foreach ($arrayAllFields as $field) {
				if(!empty($this->$field)) {
					if(strtoupper($field) != 'ID') {
						$arrayForSet[] = $field.'="'.$this->$field.'"';
					} else {
						$whereID = $this->$field;
					}
				}
			}
			if(!isset($arrayForSet) or empty($arrayForSet)) {
				echo "Array data table `$this->table` empty";
				exit();
			}
			if(!isset($whereID) or empty($whereID)) {
				echo "ID table `$this->table` not found";
				exit();
			}
			$strForSet = implode(', ', $arrayForSet);

			try {
				$db = $this->db;
				$stmt = $db->prepare("Update $this->table Set $strForSet Where `id` = $whereID");
				$result = $stmt->execute();
			} catch (PDOException $e) {
				echo 'Error :'.$e->getMessage();
			 	echo '<br>Error sql: '."'Update $this->table Set $strForSet Where `id` = $whereID'";
			 	exit();
			}

			return $result;
			
		}
		
	}

?>