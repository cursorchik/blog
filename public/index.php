<?php

use App\Route;
use Smarty\Smarty;

use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Controllers\CategoryController;

require '../vendor/autoload.php';
require 'functions.php';
require 'Route.php';

Route::get('/', [HomeController::class, 'index']);
Route::get('/category/{id}', [CategoryController::class, 'show']);
Route::get('/post/{id}', [PostController::class, 'show']);

Route::execute();