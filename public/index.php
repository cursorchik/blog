<?php

use App\Route;
use Smarty\Smarty;
use App\Controller\HomeController;

require '../vendor/autoload.php';
require 'functions.php';
require 'Route.php';

Route::get('/', [HomeController::class, 'index']);
Route::get('/posts', [HomeController::class, 'getPosts']);
Route::get('/post/{d}', [HomeController::class, 'getPosts']);

$smarty = new Smarty();
$smarty->setTemplateDir(__DIR__ . '/../templates');
$smarty->setConfigDir(__DIR__ . '/../configs');
$smarty->setCompileDir(__DIR__ . '/../templates_c');
$smarty->setCacheDir(__DIR__ . '/../cache');

$smarty->setEscapeHtml(true);

$smarty->assign('name', 'Ned');
$smarty->display('index.tpl');

Route::execute();