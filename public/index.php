<?php

use App\Controllers\CategoryController;
use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Route;

require '../vendor/autoload.php';
require 'functions.php';

Route::get('/', [HomeController::class, 'index']);
Route::get('/category/{id}', [CategoryController::class, 'show']);
Route::get('/post/{id}', [PostController::class, 'show']);

try
{
	Route::execute();
}
catch (\Smarty\Exception $e)
{
	die('Ошибка загрузки страницы');
}