<?php

class Router {
	public static function start() {
		$url = isset($_GET['url']) ? explode('/', $_GET['url']) : ['login', 'index'];

		$controllerName = ucfirst($url[0]) . 'Controller';
		$method = $url[1] ?? 'index';

		require_once __DIR__ . '/../app/controllers/' . $controllerName . '.php';
		$controller = new $controllerName;

		call_user_func_array([$controller, $method], array_slice($url, 2));
	}
}

// Model = SELECT * from usuarios
// controller 
// view = php