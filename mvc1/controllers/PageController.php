<?php

	class PageController extends Controller {
		function actionShow($url = null) {
			$page = $this -> getPage($url);
			$this -> view -> render('page', array('page' => $page));
		}
	}

?>