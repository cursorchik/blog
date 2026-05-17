<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\PostModel;

class CategoryController extends BaseController
{
	public function show(array $params): void
	{
		$id = (int)($params['id'] ?? 0);

		$categoryModel = new CategoryModel();
		$category = $categoryModel->getById($id);

		if (!$category) {
			http_response_code(404);
			echo "404 - Категория не найдена";
			return;
		}

		$sort = StringValue('sort', 'created_at');
		$order = StringValue('order', 'DESC');
		$page = IntValue('page', 1);
		$perPage = 5;
		$offset = ($page - 1) * $perPage;

		$postModel = new PostModel();
		$posts = $postModel->getPostsByCategory($id, $sort, $order, $perPage, $offset);
		$totalPosts = $postModel->getTotalPostsByCategory($id);
		$totalPages = ceil($totalPosts / $perPage);

		$this->smarty->assign('category', $category);
		$this->smarty->assign('posts', $posts);
		$this->smarty->assign('current_page', $page);
		$this->smarty->assign('total_pages', $totalPages);
		$this->smarty->assign('sort', $sort);
		$this->smarty->assign('order', $order);
		$this->smarty->display('category.tpl');
	}
}