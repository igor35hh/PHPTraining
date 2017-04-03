<?php

	class Controller_Article Extends Controller_Base {
		public $layouts = "first_layouts";

		function index() {
			$idArticle = (isset($_GET['id'])) ? (int)$_GET['id'] : false;
			if($idArticle) {
				$select = array(
					'where' => "id = $idArticle"
				);
				$model = new Model_Article($select);
				$article = $model->getOneRow();
			} else {
				$article = false;
			}
			$this->template->vars('article', $article);
			$this->template->view('index');
		}
	}

?>