<?php

namespace App;

use Smarty\Exception;

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
		$pattern = preg_replace('/\{([a-zA-Z0-9_]+)}/', '(?P<$1>[^/]+)', $route);
		$pattern = '#^' . rtrim($pattern, '/') . '/?$#';

		self::$routes[$method][$pattern] = [
			'controller' => $callback[0],
			'method' => $callback[1],
			'original' => $route
		];
	}

	/**
	 * @throws Exception
	 */
	public static function execute(): void
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$uri = rtrim($uri, '/') ?: '/';

		if (!isset(self::$routes[$method])) Template::pageNotFound();

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
						call_user_func_array([$controller, $methodName], [$params]);
						return;
					}
				}
				break;
			}
		}
		Template::pageNotFound();
	}
}