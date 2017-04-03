<?php

	class Model_Category Extends ModelBase {

		public $id;
		public $name;
		public $is_active;

		public function fieldsTable() {
			return array(
				'id' => 'Id',
				'name' => 'Name',
				'is_active' => 'Is Active',
			);
		}

	}

?>