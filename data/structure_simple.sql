
ALTER TABLE `job` ADD `user_idfs` int(11) NOT NULL DEFAULT '0' AFTER `Job_ID`,
ADD `contact_idfs` int(11) NOT NULL DEFAULT '0' AFTER `user_idfs`,
ADD `type_idfs` int(11) NOT NULL DEFAULT '0' AFTER `contact_idfs`,
ADD `state_idfs` int(11) NOT NULL DEFAULT '0' AFTER `type_idfs`,
ADD `paymentmethod_idfs` int(11) NOT NULL DEFAULT '0' AFTER `state_idfs`,
ADD `paymentstate_idfs` int(11) NOT NULL DEFAULT '1' AFTER `paymentmethod_idfs`,
ADD `payment_session_id` varchar(255)  NOT NULL DEFAULT '' AFTER `paymentstate_idfs`,
ADD `payment_id` varchar(255)  NOT NULL DEFAULT '' AFTER `payment_session_id`,
ADD `deliverymethod_idfs` int(11) NOT NULL DEFAULT '0' AFTER `payment_id`,
ADD `date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `label`,
ADD `description` TEXT NOT NULL DEFAULT '' AFTER `date`,
ADD `project_idfs` int(11) NOT NULL DEFAULT '0' AFTER `description`,
ADD `discount` FLOAT NOT NULL DEFAULT 0 AFTER `date`;


--
-- Job_position Table
--
CREATE TABLE `job_position` (
  `Position_ID` int(11) NOT NULL,
  `job_idfs` int(11) NOT NULL DEFAULT '0',
  `article_idfs` int(11) NOT NULL DEFAULT '0',
  `variant_idfs` int(11) NOT NULL DEFAULT '0',
  `ref_idfs` int(11) NOT NULL DEFAULT '0',
  `ref_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `sort_id` int(4) NOT NULL DEFAULT '0',
  `amount` float NULL DEFAULT 0,
  `price` double NULL DEFAULT 0,
  `discount` float NULL DEFAULT 0,
  `discount_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `job_position`
  ADD PRIMARY KEY (`Position_ID`);

ALTER TABLE `job_position`
  MODIFY `Position_ID` int(11) NOT NULL AUTO_INCREMENT;


