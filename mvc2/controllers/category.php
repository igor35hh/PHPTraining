<?php

	class Controller_Category Extends Controller_Base {
		public $layouts = "first_layouts";

		function index() {
			$idCategory = (isset($_GET['id'])) ? (int)$_GET['id'] : false;
			if($idCategory) {
				$select = array(
					'where' => "is_active = 1 and id_category = $idCategory",
					'order' => "date_create DESC"
				);
				$model = new Model_Category($select);
				$articles = $model->getAllRows();
			} else {
				$articles = false;
			}
			$this->template->vars('articles', $articles);
			$this->template->view('index');
		}
	}

?>