DROP TABLE IF EXISTS `contacts`;



DROP TABLE IF EXISTS `contact_owners`;



DROP TABLE IF EXISTS `users`;



DROP TABLE IF EXISTS `user_roles`;



CREATE TABLE `user_roles` (
    `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'Name',
    `created` datetime NOT NULL COMMENT 'Дата создания',
    `updated` datetime NOT NULL COMMENT 'Дата обновления',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8mb4 COMMENT = 'Пользователи - Роли';



INSERT INTO
    `user_roles` (`id`, `name`, `created`, `updated`)
VALUES
    (1, 'admin', NOW(), NOW()),
    (2, 'user', NOW(), NOW());



CREATE TABLE `users` (
    `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `role_id` int(10) UNSIGNED NOT NULL COMMENT 'Role Id',
    `first_name` varchar(20) DEFAULT NULL COMMENT 'Фамилия',
    `last_name` varchar(20) NOT NULL COMMENT 'Имя',
    `middle_name` varchar(20) DEFAULT NULL COMMENT 'Отчество',
    `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'Email',
    `password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'Password',
    `token` varchar(56) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Token',
    `active_email` datetime DEFAULT NULL COMMENT 'Active email',
    `active_password` datetime DEFAULT NULL COMMENT 'Active password',
    `created` datetime NOT NULL COMMENT 'Дата создания',
    `updated` datetime NOT NULL COMMENT 'Дата обновления',
    PRIMARY KEY (`id`),
    UNIQUE KEY `ukEmail` (`email`),
    UNIQUE KEY `ukToken` (`token`),
    KEY `ixRoleId` (`role_id`),
    KEY `ixActiveEmail` (`active_email`) USING BTREE,
    KEY `ixActivePassword` (`active_password`) USING BTREE,
    CONSTRAINT `fkUserRole` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8mb4 COMMENT = 'Пользователи';



INSERT INTO
    `users` (
        `id`,
        `role_id`,
        `first_name`,
        `last_name`,
        `middle_name`,
        `email`,
        `password`,
        `token`,
        `active_email`,
        `active_password`,
        `created`,
        `updated`
    )
VALUES
    (
        1,
        2,
        'Иванов',
        'Иван',
        'Иванович',
        'user@example.com',
        '$2y$12$E7YZv8u8r3lAfIfR6PvIV.RQFyljrf0YFotBLNymIcMC1XnBshanq',
        'VEVVNE1zMDlid2RwQWdIWTRPaW9EUT09Ojo2+U+kFusUaVbGrd40KLir',
        NULL,
        NULL,
        NOW(),
        NOW()
    );



CREATE TABLE `contact_owners` (
    `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `name` varchar(25) NOT NULL COMMENT 'Владелец контакта',
    `created` datetime NOT NULL COMMENT 'Дата создания',
    `updated` datetime NOT NULL COMMENT 'Дата обновления',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8mb4 COMMENT = 'Контакты - Типы владельцев контакта';



INSERT INTO
    `contact_owners` (`id`, `name`, `created`, `updated`)
VALUES
    (1, 'user', NOW(), NOW());



CREATE TABLE `contacts` (
    `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `owner_id` int(10) UNSIGNED NOT NULL COMMENT 'Owner Id',
    `source_id` int(10) UNSIGNED NOT NULL COMMENT 'Source Id',
    `type_id` int(10) UNSIGNED NOT NULL COMMENT 'Type Id',
    `value` varchar(255) NOT NULL COMMENT 'Значение',
    `created` datetime NOT NULL COMMENT 'Дата создания',
    `updated` datetime NOT NULL COMMENT 'Дата обновления',
    PRIMARY KEY (`id`),
    UNIQUE KEY `ukContact` (`owner_id`, `source_id`, `type_id`, `value`) USING BTREE,
    KEY `ixOwnerId` (`owner_id`),
    KEY `ixSourceId` (`source_id`),
    KEY `ixTypeId` (`type_id`),
    KEY `ixValue` (`value`),
    CONSTRAINT `fkContactOwner` FOREIGN KEY (`owner_id`) REFERENCES `contact_owners` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8mb4 COMMENT = 'Контакты';