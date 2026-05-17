<?php

use JetBrains\PhpStorm\NoReturn;

function dd(mixed $value) : void
{
	echo '<pre>';
	var_export($value);
	echo '<pre/>';
}

function IntValue(string $value, $default = 0) : int
{
	return (int)($_GET[$value] ?? $default) ;
}

function StringValue(string $value, $default = '') : mixed
{
	return $_GET[$value] ?? $default;
}

#[NoReturn]
function NotFount(string $message = null) : never
{
	http_response_code(404);
	die($message ?? "404 - Сраница не найдена");
}