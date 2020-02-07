
--
-- Core Form - Task Base Fields
--
INSERT INTO `core_form_field` (`Field_ID`, `type`, `label`, `fieldkey`, `tab`, `form`, `class`, `url_view`, `url_list`, `show_widget_left`, `allow_clear`, `readonly`, `tbl_cached_name`, `tbl_class`, `tbl_permission`) VALUES
(NULL, 'select', 'User', 'usert_idfs', 'job-base', 'job-single', 'col-md-3', '/user/view/##ID##', '/user/api/list/0', 0, 1, 0, 'user-single', 'OnePlace\\User\\Model\\UserTable','add-OnePlace\\User\\Controller\\UserController'),
(NULL, 'select', 'Contact', 'contact_idfs', 'job-base', 'job-single', 'col-md-3', '/contact/view/##ID##', '/contact/quicksearch', 0, 1, 0, 'contact-single', 'OnePlace\\Contact\\Model\\ContactTable','add-OnePlace\\Contact\\Controller\\ContactController'),
(NULL, 'select', 'Type', 'type_idfs', 'job-base', 'job-single', 'col-md-3', '', '/job/api/list/job-single/type', 1, 1, 0, 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable', 'add-OnePlace\\Job\\Controller\\TypeController'),
--partial contactinfo
--partial positions
(NULL, 'select', 'Paymentmethod', 'paymentmethod_idfs', 'job-base', 'job-single', 'col-md-3', '', '/job/api/list/job-single/paymentmethod', 1, 1, 0, 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable', 'add-OnePlace\\Job\\Controller\\PaymentmethodController'),
(NULL, 'select', 'Paymentstate', 'paymentstate_idfs', 'job-base', 'job-single', 'col-md-3', '', '/job/api/list/job-single/paymentmethod', 0, 1, 0, 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable', 'add-OnePlace\\Job\\Controller\\PaymentstateController'),
(NULL, 'select', 'Deliverymethod', 'deliverymethod_idfs', 'job-base', 'job-single', 'col-md-3', '', '/job/api/list/job-single/deliverymethod', 1, 1, 0, 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable', 'add-OnePlace\\Job\\Controller\\DeliverymethodController'),
(NULL, 'select', 'State', 'state_idfs', 'job-base', 'job-single', 'col-md-3', '', '/job/api/list/job-single/state', 1, 1, 0, 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable', 'add-OnePlace\\Job\\Controller\\StateController');



--
-- permissions
--
INSERT INTO `permission` (`permission_key`, `module`, `label`, `nav_label`, `nav_href`, `show_in_menu`) VALUES
('add', 'OnePlace\\Job\\Controller\\TypeController', 'Add Type', '', '', 0),
('add', 'OnePlace\\Job\\Controller\\PaymentmethodController', 'Add Paymentmethod', '', '', 0),
('add', 'OnePlace\\Job\\Controller\\PaymentstateController', 'Add Paymentstate', '', '', 0),
('add', 'OnePlace\\Job\\Controller\\DeliverymethodController', 'Add Deliverymethod', '', '', 0),
('add', 'OnePlace\\Job\\Controller\\StateController', 'Add State', '', '', 0);


-----------------
-- Job position Table
----------------

INSERT INTO `core_form_field` (`Field_ID`, `type`, `label`, `fieldkey`, `tab`, `form`, `class`, `url_view`, `url_list`, `show_widget_left`, `allow_clear`, `readonly`, `tbl_cached_name`, `tbl_class`, `tbl_permission`) VALUES
(NULL, 'select', 'Job', 'job_idfs', 'jobposition-base', 'jobposition-single', 'col-md-3', '/user/view/##ID##', '/job/api/list/0', 0, 1, 0, 'entitytag-single', 'OnePlace\\Job\\Model\\JobTable','add-OnePlace\\Job\\Controller\\JobController'),
(NULL, 'select', 'Article', 'article_idfs', 'jobposition-base', 'jobposition-single', 'col-md-3', '/article/view/##ID##', '/article/api/list/0', 0, 1, 0, 'entitytag-single', 'OnePlace\\Article\\Model\\ArticleTable','add-OnePlace\\Article\\Controller\\ArticleController'),
(NULL, 'select', 'Variant', 'variant_idfs', 'jobposition-base', 'jobposition-single', 'col-md-3', '', '/job/api/list/jobposition-single/type', 0, 1, 0, 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable', 'add-OnePlace\\Job\\Controller\\VariantController'),
(NULL, 'select', 'Ref', 'ref_idfs', 'jobposition-base', 'jobposition-single', 'col-md-3', '', '/job/api/list/jobposition-single/type', 0, 1, 0, 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable', 'add-OnePlace\\Job\\Controller\\RefController'),
(NULL, 'text', 'Type', 'type', 'jobposition-base', 'jobposition-single', 'col-md-1', '', '', 0, 1, 0, '', '', ''),
(NULL, 'int', 'Sort ID', 'sort_id', 'jobposition-base', 'jobposition-single', 'col-md-1', '', '', 0, 1, 0, '', '', ''),
(NULL, 'float', 'Amount', 'amount', 'jobposition-base', 'jobposition-single', 'col-md-1', '', '', 0, 1, 0, '', '', ''),
(NULL, 'double', 'Price', 'price', 'jobposition-base', 'jobposition-single', 'col-md-1', '', '', 0, 1, 0, '', '', ''),
(NULL, 'float', 'Discount', 'discount', 'jobposition-base', 'jobposition-single', 'col-md-1', '', '', 0, 1, 0, '', '', ''),
(NULL, 'text', 'Discount Type', 'discount_type', 'jobposition-base', 'jobposition-single', 'col-md-1', '', '', 0, 1, 0, '', '', ''),
(NULL, 'text', 'Description', 'description', 'jobposition-base', 'jobposition-single', 'col-md-6', '', '', 0, 1, 0, '', '', '');



--
-- Permissions
--
INSERT INTO `permission` (`permission_key`, `module`, `label`, `nav_label`, `nav_href`, `show_in_menu`) VALUES
('add', 'OnePlace\\Job\\Controller\\PositionController', 'Add', '', '', 0),
('edit', 'OnePlace\\Job\\Controller\\PositionController', 'Edit', '', '', 0),
('index', 'OnePlace\\Job\\Controller\\PositionController', 'Index', 'Jobs', '/job', 1),
('list', 'OnePlace\\Job\\Controller\\ApiController', 'List', '', '', 1),
('view', 'OnePlace\\Job\\Controller\\PositionController', 'View', '', '', 0);

--
-- Job position Form
--
INSERT INTO `core_form` (`form_key`, `label`) VALUES ('jobposition-single', 'Position');

--
-- Job position Index List
--
INSERT INTO `core_index_table` (`table_name`, `form`, `label`) VALUES
('jobposition-index', 'jobposition-single', 'Position Index');

--
-- Job position Tabs
--
INSERT INTO `core_form_tab` (`Tab_ID`, `form`, `title`, `subtitle`, `icon`, `counter`, `sort_id`, `filter_check`, `filter_value`) VALUES
('jobposition-base', 'jobposition-single', 'Position', 'Base', 'fas fa-cogs', '', '0', '', '');

--
-- Job position Buttons
--
INSERT INTO `core_form_button` (`Button_ID`, `label`, `icon`, `title`, `href`, `class`, `append`, `form`, `mode`, `filter_check`, `filter_value`) VALUES
(NULL, 'Save Job', 'fas fa-save', 'Save Position', '#', 'primary saveForm', '', 'jobposition-single', 'link', '', ''),
(NULL, 'Edit Job', 'fas fa-edit', 'Edit Position', '/job/position/edit/##ID##', 'primary', '', 'jobposition-view', 'link', '', ''),
(NULL, 'Add Job', 'fas fa-plus', 'Add Position', '/job/position/add', 'primary', '', 'jobposition-index', 'link', '', '');


--
-- job Table Custom Tags
--
-- todo: add select before and check if tag exists
--
INSERT INTO `core_tag` (`Tag_ID`, `tag_key`, `tag_label`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(NULL, 'paymentmethod', 'Paymentmethod', '1', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00'),
(NULL, 'paymentstate', 'Paymentstate', '1', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00'),
(NULL, 'deliverymethod', 'Deliverymethod', '1', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00'),
(NULL, 'type', 'Type', '1', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00'),
(NULL, 'paymentstate', 'Paymentstate', '1', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00');

--
-- job_position Table Custom Tags
--
INSERT INTO `core_tag` (`Tag_ID`, `tag_key`, `tag_label`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(NULL, 'variant', 'Variant', '1', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00');