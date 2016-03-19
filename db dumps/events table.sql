#https://packagecontrol.io/packages/MySQL%20Snippets
/* DROP TABLE IF EXISTS `events_ru`;
 CREATE TABLE `events_ru` (
   `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
   `parent_user_id` int(11) NOT NULL,
   `title_ru` VARCHAR(255)  COLLATE utf8_unicode_ci DEFAULT NULL,
   `slug` VARCHAR(255) NOT NULL,
   `event_type` SMALLINT(4) UNSIGNED,
   `public_access` TINYINT(1) UNSIGNED DEFAULT 0,
   `preview_image` VARCHAR(255),
   `format` TINYINT(1) DEFAULT 0,
    `preview_ru` text COLLATE utf8_unicode_ci DEFAULT NOT NULL,*/

/*   `city_ru` VARCHAR(255) NOT NULL,
   `address_ru` VARCHAR(255) ,
   `place_ru` VARCHAR(255) ,
   `place_details_ru` text COLLATE utf8_unicode_ci DEFAULT NULL,
   `map_url` VARCHAR(255) DEFAULT NULL,*/

/*   `video_url` VARCHAR(255) DEFAULT NULL,
   `video_details` text COLLATE utf8_unicode_ci DEFAULT NULL,*/

/*   `tag` VARCHAR(255) DEFAULT NULL,
   `started_at` int(10) UNSIGNED DEFAULT NULL,
   `ending_at` int(10) UNSIGNED DEFAULT NULL,
   `timezone` VARCHAR(255) NOT NULL,*/

/*   CREATE TABLE `events_contacts`(
   	`contact_person` VARCHAR(255) DEFAULT NULL,
      `contact_phone` VARCHAR(126) DEFAULT NULL,
      `contact_email` VARCHAR(255) DEFAULT NULL,
      `contact_skype` VARCHAR(126) DEFAULT NULL,
      `contact_details_ru` text COLLATE utf8_unicode_ci DEFAULT NULL,
      )*/

/*    CREATE TABLE `events_cost` (
   `cost` VARCHAR(255) DEFAULT NULL,
   `cost_free` TINYINT(1) DEFAULT 0,
   `cost_details_ru` text COLLATE utf8_unicode_ci DEFAULT NULL,
   )
*/
   `end_registration_time` int(10) UNSIGNED DEFAULT NULL,
   `registration_format` TINYINT(1) DEFAULT 0,

   `organizer` VARCHAR(255) DEFAULT NOT NULL,

   `coorganizer` VARCHAR(255) DEFAULT NULL,
   `coorganizer_preview_image` VARCHAR(255),
   `coorganizer_name` VARCHAR(255),
   `coorganizer_url` VARCHAR(255),
   `coorganizer_description` text COLLATE utf8_unicode_ci DEFAULT NULL,








   PRIMARY KEY `pk_id`(`id`)
 ) ENGINE = InnoDB;