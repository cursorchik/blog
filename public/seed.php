<?php

require __DIR__ . '/../vendor/autoload.php';


$db = require __DIR__ . '/../database/config.php';

try {
	$categories = [
		['name' => 'PHP', 'description' => 'Все о языке PHP'],
		['name' => 'JavaScript', 'description' => 'JS, фреймворки, браузеры'],
		['name' => 'Docker', 'description' => 'Контейнеризация и оркестрация'],
		['name' => 'Базы данных', 'description' => 'SQL, MySQL, PostgreSQL'],
		['name' => 'Веб-разработка', 'description' => 'HTML, CSS, фронтенд'],
	];

	$categoryIds = [];
	foreach ($categories as $cat)
	{
		$db->execute("
            INSERT INTO `categories` (`name`, `description`)
            VALUES (:name, :desc)
        ", [
			'name' => $cat['name'],
			'desc' => $cat['description']
		]);
		$categoryIds[] = $db->lastInsertId();
	}

	$titles = ['Введение в PHP', 'Современный JS', 'Docker для начинающих', 'Индексы в MySQL', 'Адаптивная верстка'];
	$postIds = [];
	for ($i = 1; $i <= 15; $i++)
	{
		$title = "Статья $i: " . $titles[array_rand($titles)];
		$description = "Краткое описание статьи $i. Это анонс для главной и ленты категории.";
		$content = "Полный текст статьи $i. Здесь много интересного содержания, которое демонстрирует работу блога. Повторяем текст для объема.";
		$views = rand(0, 500);
		$createdAt = date('Y-m-d H:i:s', strtotime("-".rand(0,60)." days"));

		$db->execute("
            INSERT INTO `posts` 
                (`title`, `description`, `content`, `image`, `views`, `created_at`)
            VALUES 
                (:title, :desc, :content, :image, :views, :created)
        ", [
			'title'   => $title,
			'desc'    => $description,
			'content' => $content,
			'image'   => null,
			'views'   => $views,
			'created' => $createdAt
		]);
		$postIds[] = $db->lastInsertId();
	}

	foreach ($postIds as $postId) {
		$numCats = rand(1, 3);
		shuffle($categoryIds);
		$selected = array_slice($categoryIds, 0, $numCats);
		foreach ($selected as $catId) {
			try {
				$db->execute("
                    INSERT INTO `post_category` (`post_id`, `category_id`)
                    VALUES (:post, :cat)
                ", [
					'post' => $postId,
					'cat'  => $catId
				]);
			} catch (\Exception $e) {
				// дубликаты пропускаем
			}
		}
	}

	echo "Seeding completed! Added " . count($categoryIds) . " categories and " . count($postIds) . " posts.\n";

}
catch (\Exception $e)
{
	die("Seeding error: " . $e->getMessage());
}