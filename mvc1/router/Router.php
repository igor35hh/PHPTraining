<?php
	class Router {
		private $routes;

		function __construct($routesPath) {
			$this -> $routes = include($routesPath);
		}

		function getURI() {
			if(!empty($_SERVER['REQUEST_URI'])) {
				return trim($_SERVER['REQUEST_URI'], '/');
			}
			if(!empty($_SERVER['PATH_INFO'])) {
				return trim($_SERVER['PATH_INFO'], '/');
			}
			if(!empty($_SERVER['QUERY_STRING'])) {
				return trim($_SERVER['QUERY_STRING'], '/');
			}
		}

		function run() {
			$uri = $this -> getURI();

			foreach ($this->routes as $pattern => $route) {
				if(preg_match("~$pattern~", $uri)) {
					$internalRoute = preg_replace("~$pattern~", $route, $uri);
					$segments = explode('/', $internalRoute);
					$controller = ucfirst(array_shift($segments)).'Controller';
					$action = 'action'.ucfirst(array_shift($segments));
					$parameters = $segments;
					$controllerFile = ROOT.'/./controllers/'.$controller.'.php';
					if(file_exists($controllerFile)) {
						include($controllerFile);
					}
					if(!is_callable(array($controller, $action))) {
						header("HTTP/1.0 404 Not Found");
						return;
					}
					call_user_func_array(array($controller, $action), $params);
				}
			}

			header("HTTP/1.0 404 Not Found");
			return;
		}
	}
?>