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
('close', 'OnePlace\\Job\\Controller\\JobController', 'Close', '', '', 0),
('paid', 'OnePlace\\Job\\Controller\\JobController', 'Book Payment', '', '', 0),
('index', 'OnePlace\\Job\\Controller\\JobController', 'Index', 'Jobs', '/job', 1),
('list', 'OnePlace\\Job\\Controller\\ApiController', 'List', '', '', 1),
('view', 'OnePlace\\Job\\Controller\\JobController', 'View', '', '', 0),
('dump', 'OnePlace\\Job\\Controller\\ExportController', 'Excel Dump', '', '', 0),
('index', 'OnePlace\\Job\\Controller\\SearchController', 'Search', '', '', 0);

--
-- Form
--
INSERT INTO `core_form` (`form_key`, `label`, `entity_class`, `entity_tbl_class`) VALUES
('job-single', 'Job', 'OnePlace\\Job\\Model\\Job', 'OnePlace\\Job\\Model\\JobTable');

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
(NULL, 'Add Job', 'fas fa-plus', 'Add Job', '/job/add', 'primary', '', 'job-index', 'link', '', ''),
(NULL, 'Export Jobs', 'fas fa-file-excel', 'Export Jobs', '/job/export', 'primary', '', 'job-index', 'link', '', ''),
(NULL, 'Find Jobs', 'fas fa-search', 'Find Jobs', '/job/search', 'primary', '', 'job-index', 'link', '', ''),
(NULL, 'Export Jobs', 'fas fa-file-excel', 'Export Jobs', '#', 'primary initExcelDump', '', 'job-search', 'link', '', ''),
(NULL, 'New Search', 'fas fa-search', 'New Search', '/job/search', 'primary', '', 'job-search', 'link', '', '');

--
-- Fields
--
INSERT INTO `core_form_field` (`Field_ID`, `type`, `label`, `fieldkey`, `tab`, `form`, `class`, `url_view`, `url_list`, `show_widget_left`, `allow_clear`, `readonly`, `tbl_cached_name`, `tbl_class`, `tbl_permission`) VALUES
(NULL, 'text', 'Name', 'label', 'job-base', 'job-single', 'col-md-3', '/job/view/##ID##', '', 0, 1, 0, '', '', '');

--
-- User XP Activity
--
INSERT INTO `user_xp_activity` (`Activity_ID`, `xp_key`, `label`, `xp_base`) VALUES
(NULL, 'job-add', 'Add New Job', '50'),
(NULL, 'job-edit', 'Edit Job', '5'),
(NULL, 'job-export', 'Edit Job', '5');

--
-- Module Icon
--
INSERT INTO `settings` (`settings_key`, `settings_value`) VALUES ('job-icon', 'fas fa-book');

--
-- widgets
--
INSERT INTO `core_widget` (`Widget_ID`, `widget_name`, `label`, `permission`) VALUES
(NULL, 'job_manager', 'Job - Manager', 'index-Job\\Controller\\JobController');



COMMIT;