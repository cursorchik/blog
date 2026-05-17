<?php

namespace App\Controllers;

use App\Models\CategoryModel;
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
		$this->smarty->assign('categories', $categories);
		$this->smarty->display('index.tpl');
	}
}