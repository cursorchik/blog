<?php

namespace App\Controllers;

use App\Models\PostModel;

class PostController extends BaseController
{
	public function show(array $params): void
	{
		$id = (int)($params['id'] ?? 0);

		$postModel = new PostModel();
		$post = $postModel->getById($id);

		if (!$post) NotFount('Статья не найдена');

		$categoryIds = $postModel->getCategoryIdsForPost($id);
		$similar = $postModel->getSimilarPosts($id, $categoryIds);

		$this->smarty->assign('post', $post);
		$this->smarty->assign('similar_posts', $similar);
		$this->smarty->display('post.tpl');
	}
}