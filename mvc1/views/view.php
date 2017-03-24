<?php

	define('views_basedir', dirname(__FILE__).'/views/');

	class View {
		function fetchPartial($template, $params = array()) {
			extract($params);
			ob_start();
			include views_basedir.$template.'.php';
			return ob_get_clean();
		}
		function renderPartial($template, $params = array()) {
			echo $this -> fetchPartial($template, $params);
		}
		function fetch($template, $params = array()) {
			$content = $this -> fetchPartial($template, $params);
			return $this->fetchPartial('layout', array('content' => $content));
		}
		function render($template, $params = array()) {
			echo $this -> fetch($template, $params);
		}
	}

	//$view = new View();
	//$posts = get_posts();
	//$view -> render('postList', array('posts' => $posts ));

?>