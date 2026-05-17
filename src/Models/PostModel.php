<?php

namespace App\Models;

class PostModel extends BaseModel
{
	public function getPostsByCategory(int $categoryId, string $sort = 'created_at', string $order = 'DESC', int $limit = 5, int $offset = 0): array
	{
		$allowedSort = ['created_at', 'views'];
		if (!in_array($sort, $allowedSort)) $sort = 'created_at';
		$order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';

		$sql = "
            SELECT 
                `p`.`id`,
                `p`.`title`,
                `p`.`description`,
                `p`.`content`,
                `p`.`image`,
                `p`.`views`,
                `p`.`created_at`
            FROM `posts` AS `p`
            INNER JOIN `post_category` AS `pc` ON `p`.`id` = `pc`.`post_id`
            WHERE `pc`.`category_id` = :cat_id
            ORDER BY `$sort` $order
            LIMIT :limit OFFSET :offset
        ";

		return $this->db->fetchAll($sql, [
			'cat_id' => $categoryId,
			'limit'  => $limit,
			'offset' => $offset
		]);
	}

	public function getTotalPostsByCategory(int $categoryId): int
	{
		$result = $this->db->fetch("
            SELECT 
                COUNT(*) AS `total`
            FROM `post_category`
            WHERE `category_id` = :cat_id
        ", ['cat_id' => $categoryId]);
		return (int) ($result['total'] ?? 0);
	}

	public function getById(int $id): ?array
	{
		$post = $this->db->fetch("
            SELECT 
                `id`,
                `title`,
                `description`,
                `content`,
                `image`,
                `views`,
                `created_at`
            FROM `posts`
            WHERE `id` = :id
        ", ['id' => $id]);

		if ($post)
		{
			$this->db->execute("
                UPDATE `posts`
                SET `views` = `views` + 1
                WHERE `id` = :id
            ", ['id' => $id]);
		}
		return $post;
	}

	public function getCategoryIdsForPost(int $postId): array
	{
		$rows = $this->db->fetchAll("
            SELECT `category_id`
            FROM `post_category`
            WHERE `post_id` = :post_id
        ", ['post_id' => $postId]);
		return array_column($rows, 'category_id');
	}

	public function getSimilarPosts(int $postId, array $categoryIds, int $limit = 3): array
	{
		if (empty($categoryIds)) return [];

		$placeholders = implode(',', array_fill(0, count($categoryIds), '?'));
		$sql = "
            SELECT DISTINCT
                `p`.`id`,
                `p`.`title`,
                `p`.`description`,
                `p`.`content`,
                `p`.`image`,
                `p`.`views`,
                `p`.`created_at`
            FROM `posts` AS `p`
            INNER JOIN `post_category` AS `pc` ON `p`.`id` = `pc`.`post_id`
            WHERE `pc`.`category_id` IN ($placeholders)
                AND `p`.`id` != ?
            ORDER BY `p`.`created_at` DESC
            LIMIT $limit
        ";

		$params = array_merge($categoryIds, [$postId]);
		return $this->db->fetchAll($sql, $params);
	}
}