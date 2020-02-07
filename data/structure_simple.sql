
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

