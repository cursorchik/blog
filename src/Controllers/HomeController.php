<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Template;
use Smarty\Exception;

class HomeController extends BaseController
{
	/**
	 * @throws Exception
	 */
	public function index(): void
	{
		$model = new CategoryModel();
		$categories = $model->getAllWithRecentPosts();
		Template::instance()->assign('categories', $categories);
		Template::instance()->display('index.tpl');
	}
}