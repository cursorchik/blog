<?php

namespace App\Models;

class CategoryModel extends BaseModel
{
	public function getAllWithRecentPosts(): array
	{
		$categories = $this->db->fetchAll("
            SELECT 
                `id`,
                `name`,
                `description`
            FROM `categories`
            ORDER BY `id`
        ");

		foreach ($categories as &$category)
		{
			$category['recent_posts'] = $this->db->fetchAll("
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
                ORDER BY `p`.`created_at` DESC
                LIMIT 3
            ", ['cat_id' => $category['id']]);
		}
		return $categories;
	}

	public function getById(int $id): ?array
	{
		return $this->db->fetch("
            SELECT 
                `id`,
                `name`,
                `description`
            FROM `categories`
            WHERE `id` = :id
        ", ['id' => $id]);
	}
}