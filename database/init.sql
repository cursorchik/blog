CREATE TABLE `categories` (
                              `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                              `name` VARCHAR(255) NOT NULL,
                              `description` TEXT,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `posts` (
                         `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                         `title` VARCHAR(255) NOT NULL,
                         `description` TEXT,
                         `content` TEXT NOT NULL,
                         `image` VARCHAR(255) DEFAULT NULL,
                         `views` INT UNSIGNED NOT NULL DEFAULT 0,
                         `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                         PRIMARY KEY (`id`),
                         KEY `idx_created_at` (`created_at`),
                         KEY `idx_views` (`views`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `post_category` (
                                 `post_id` INT UNSIGNED NOT NULL,
                                 `category_id` INT UNSIGNED NOT NULL,
                                 PRIMARY KEY (`post_id`, `category_id`),
                                 FOREIGN KEY (`post_id`) REFERENCES `posts`(`id`),
                                 FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;