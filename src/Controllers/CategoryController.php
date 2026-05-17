<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\PostModel;
use App\Template;
use Smarty\Exception;

class CategoryController extends BaseController
{
	/**
	 * @throws Exception
	 */
	public function show(array $params): void
	{
		$id = (int)($params['id'] ?? 0);

		$categoryModel = new CategoryModel();
		$category = $categoryModel->getById($id);

		if (!$category) Template::pageNotFound();

		$sort = StringValue('sort', 'created_at');
		$order = StringValue('order', 'DESC');
		$page = IntValue('page', 1);
		$perPage = 5;
		$offset = ($page - 1) * $perPage;

		$postModel = new PostModel();
		$posts = $postModel->getPostsByCategory($id, $sort, $order, $perPage, $offset);
		$totalPosts = $postModel->getTotalPostsByCategory($id);
		$totalPages = ceil($totalPosts / $perPage);

		Template::instance()->assign('category', $category);
		Template::instance()->assign('posts', $posts);
		Template::instance()->assign('current_page', $page);
		Template::instance()->assign('total_pages', $totalPages);
		Template::instance()->assign('sort', $sort);
		Template::instance()->assign('order', $order);
		Template::instance()->display('category.tpl');
	}
}