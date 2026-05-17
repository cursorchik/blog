<?php

namespace App;

use JetBrains\PhpStorm\NoReturn;
use Smarty\Exception;
use Smarty\Smarty;

class Template
{
	private static ?Smarty $instance = null;
	public static function instance(): Smarty
	{
		if (!self::$instance)
		{
			Template::$instance = new Smarty();
			Template::$instance->setTemplateDir(__DIR__ . '/../templates');
			Template::$instance->setConfigDir(__DIR__ . '/../configs');
			Template::$instance->setCompileDir(__DIR__ . '/../templates_c');
			Template::$instance->setCacheDir(__DIR__ . '/../cache');
			Template::$instance->setEscapeHtml(true);
		}
		return self::$instance;
	}

	/**
	 * @throws Exception
	 */
	#[NoReturn]
	public static function pageNotFound() : void
	{
		http_response_code(404);
		self::instance()->display('404.tpl');
		die();
	}

	private function __construct()
	{

	}
}