CREATE TABLE `avatarclientmessages` (
    `avatarclientmessage_id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    `created` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
    `avatar_id` BIGINT(20) UNSIGNED NOT NULL,
    `key` VARCHAR(255) NOT NULL,
    `data` TEXT NOT NULL,
    PRIMARY KEY (`avatarclientmessage_id`),
    KEY `avatar_id` (`avatar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
