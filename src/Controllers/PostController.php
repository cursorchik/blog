<?php

namespace App\Controllers;

use App\Models\PostModel;
use Smarty\Exception;
use App\Template;

class PostController extends BaseController
{
	/**
	 * @throws Exception
	 */
	public function show(array $params): void
	{
		$id = (int)($params['id'] ?? 0);

		$postModel = new PostModel();
		$post = $postModel->getById($id);

		if (!$post) Template::pageNotFound();

		$categoryIds = $postModel->getCategoryIdsForPost($id);
		$similar = $postModel->getSimilarPosts($id, $categoryIds);

		Template::instance()->assign('post', $post);
		Template::instance()->assign('similar_posts', $similar);
		Template::instance()->display('post.tpl');
	}
}