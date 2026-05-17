<?php

namespace App;

use JetBrains\PhpStorm\NoReturn;

class Route
{
	protected static array $routes = []; // method -> pattern -> [controller, method, params]

	public static function get(string $route, array $callback): void
	{
		self::addRoute('GET', $route, $callback);
	}

	public static function post(string $route, array $callback): void
	{
		self::addRoute('POST', $route, $callback);
	}

	protected static function addRoute(string $method, string $route, array $callback): void
	{
		// Преобразуем параметрические маршруты в регулярное выражение
		// Например, /post/{id} -> /post/(?P<id>[^/]+)
		$pattern = preg_replace('/\{([a-zA-Z0-9_]+)}/', '(?P<$1>[^/]+)', $route);
		$pattern = '#^' . rtrim($pattern, '/') . '/?$#';

		self::$routes[$method][$pattern] = [
			'controller' => $callback[0],
			'method' => $callback[1],
			'original' => $route
		];
	}

	public static function execute(): void
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$uri = rtrim($uri, '/') ?: '/';

		if (!isset(self::$routes[$method])) { self::notFound(); return; }

		foreach (self::$routes[$method] as $pattern => $routeInfo)
		{
			if (preg_match($pattern, $uri, $matches))
			{
				$params = array_filter($matches, fn($key) => !is_numeric($key), ARRAY_FILTER_USE_KEY);

				$controllerClass = $routeInfo['controller'];
				$methodName = $routeInfo['method'];

				if (class_exists($controllerClass))
				{
					$controller = new $controllerClass();
					if (method_exists($controller, $methodName))
					{
						call_user_func_array([$controller, $methodName], $params);
						return;
					}
				}
				break;
			}
		}

		self::notFound();
	}

	#[NoReturn]
	protected static function notFound() : void
	{
		http_response_code(404);
		echo "404 - Page not found";
		exit;
	}
}