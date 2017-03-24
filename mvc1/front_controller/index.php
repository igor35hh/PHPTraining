<?php
	define('ROOT', dirname(__FILE__));
	require_once(ROOT.'/./router/Router.php');

	$routes = ROOT.'/./router/routes.php';

	$router = new Router($routes);
	$router -> run();
?>