--
-- Base Table
--
CREATE TABLE `job` (
  `Job_ID` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `job`
  ADD PRIMARY KEY (`Job_ID`);

ALTER TABLE `job`
  MODIFY `Job_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Permissions
--
INSERT INTO `permission` (`permission_key`, `module`, `label`, `nav_label`, `nav_href`, `show_in_menu`) VALUES
('add', 'OnePlace\\Job\\Controller\\JobController', 'Add', '', '', 0),
('edit', 'OnePlace\\Job\\Controller\\JobController', 'Edit', '', '', 0),
('index', 'OnePlace\\Job\\Controller\\JobController', 'Index', 'Jobs', '/job', 1),
('list', 'OnePlace\\Job\\Controller\\ApiController', 'List', '', '', 1),
('view', 'OnePlace\\Job\\Controller\\JobController', 'View', '', '', 0);

--
-- Form
--
INSERT INTO `core_form` (`form_key`, `label`) VALUES ('job-single', 'Job');

--
-- Index List
--
INSERT INTO `core_index_table` (`table_name`, `form`, `label`) VALUES
('job-index', 'job-single', 'Job Index');

--
-- Tabs
--
INSERT INTO `core_form_tab` (`Tab_ID`, `form`, `title`, `subtitle`, `icon`, `counter`, `sort_id`, `filter_check`, `filter_value`) VALUES ('job-base', 'job-single', 'Job', 'Base', 'fas fa-cogs', '', '0', '', '');

--
-- Buttons
--
INSERT INTO `core_form_button` (`Button_ID`, `label`, `icon`, `title`, `href`, `class`, `append`, `form`, `mode`, `filter_check`, `filter_value`) VALUES
(NULL, 'Save Job', 'fas fa-save', 'Save Job', '#', 'primary saveForm', '', 'job-single', 'link', '', ''),
(NULL, 'Edit Job', 'fas fa-edit', 'Edit Job', '/job/edit/##ID##', 'primary', '', 'job-view', 'link', '', ''),
(NULL, 'Add Job', 'fas fa-plus', 'Add Job', '/job/add', 'primary', '', 'job-index', 'link', '', '');

--
-- Fields
--
INSERT INTO `core_form_field` (`Field_ID`, `type`, `label`, `fieldkey`, `tab`, `form`, `class`, `url_view`, `url_ist`, `show_widget_left`, `allow_clear`, `readonly`, `tbl_cached_name`, `tbl_class`, `tbl_permission`) VALUES
(NULL, 'text', 'Name', 'label', 'job-base', 'job-single', 'col-md-3', '/job/view/##ID##', '', 0, 1, 0, '', '', '');

COMMIT;