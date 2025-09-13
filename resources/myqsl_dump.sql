DROP TABLE IF EXISTS `refresh_tokens`;



CREATE TABLE `refresh_tokens` (
    `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `user_id` int UNSIGNED NOT NULL COMMENT 'User Id',
    `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'Token',
    `expires_at` timestamp NULL DEFAULT NULL COMMENT 'Expiration Date',
    PRIMARY KEY (`id`),
    UNIQUE KEY `ukToken` (`token`),
    UNIQUE KEY `ukUserId` (`user_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;