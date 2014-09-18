CREATE TABLE `abac_permissions` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
   `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
   `valueId` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
   `group` int(11) DEFAULT NULL,
   `validator` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
   `validatorOptions` longtext COLLATE utf8_unicode_ci,
   PRIMARY KEY (`id`)
);