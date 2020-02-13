
--
-- Core Form - Task Base Fields
--
INSERT INTO `core_form_field` (`Field_ID`, `type`, `label`, `fieldkey`, `tab`, `form`, `class`, `url_view`, `url_list`, `show_widget_left`, `allow_clear`, `readonly`, `tbl_cached_name`, `tbl_class`, `tbl_permission`) VALUES
(NULL, 'select', 'User', 'user_idfs', 'job-base', 'job-single', 'col-md-3', '/user/view/##ID##', '/user/api/list/0', 0, 1, 0, 'user-single', 'OnePlace\\User\\Model\\UserTable','add-OnePlace\\User\\Controller\\UserController'),
(NULL, 'select', 'Contact', 'contact_idfs', 'job-base', 'job-single', 'col-md-3', '/contact/view/##ID##', '/contact/api/list/0', 0, 1, 0, 'contact-single', 'OnePlace\\Contact\\Model\\ContactTable','add-OnePlace\\Contact\\Controller\\ContactController'),
(NULL, 'select', 'Type', 'type_idfs', 'job-base', 'job-single', 'col-md-3', '', '/tag/api/list/job-single/type', 1, 1, 0, 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable', 'add-OnePlace\\Job\\Controller\\TypeController'),
(NULL, 'select', 'Paymentmethod', 'paymentmethod_idfs', 'job-base', 'job-single', 'col-md-3', '', '/tag/api/list/job-single/paymentmethod', 1, 1, 0, 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable', 'add-OnePlace\\Job\\Controller\\PaymentmethodController'),
(NULL, 'select', 'Paymentstate', 'paymentstate_idfs', 'job-base', 'job-single', 'col-md-3', '', '/tag/api/list/job-single/paymentmethod', 0, 1, 0, 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable', 'add-OnePlace\\Job\\Controller\\PaymentstateController'),
(NULL, 'select', 'Deliverymethod', 'deliverymethod_idfs', 'job-base', 'job-single', 'col-md-3', '', '/tag/api/list/job-single/deliverymethod', 1, 1, 0, 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable', 'add-OnePlace\\Job\\Controller\\DeliverymethodController'),
(NULL, 'select', 'State', 'state_idfs', 'job-base', 'job-single', 'col-md-3', '', '/tag/api/list/job-single/state', 1, 1, 0, 'entitytag-single', 'OnePlace\\Tag\\Model\\EntityTagTable', 'add-OnePlace\\Job\\Controller\\StateController');



--
-- permissions
--
INSERT INTO `permission` (`permission_key`, `module`, `label`, `nav_label`, `nav_href`, `show_in_menu`) VALUES
('add', 'OnePlace\\Job\\Controller\\TypeController', 'Add Type', '', '', 0),
('add', 'OnePlace\\Job\\Controller\\PaymentmethodController', 'Add Paymentmethod', '', '', 0),
('add', 'OnePlace\\Job\\Controller\\PaymentstateController', 'Add Paymentstate', '', '', 0),
('add', 'OnePlace\\Job\\Controller\\DeliverymethodController', 'Add Deliverymethod', '', '', 0),
('add', 'OnePlace\\Job\\Controller\\StateController', 'Add State', '', '', 0);


--
-- job Table Custom Tags
--

INSERT IGNORE INTO `core_tag` (`Tag_ID`, `tag_key`, `tag_label`, `created_by`, `created_date`, `modified_by`, `modified_date`) VALUES
(NULL, 'paymentmethod', 'Paymentmethod', '1', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00'),
(NULL, 'paymentstate', 'Paymentstate', '1', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00'),
(NULL, 'deliverymethod', 'Deliverymethod', '1', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00'),
(NULL, 'type', 'Type', '1', '0000-00-00 00:00:00', '1', '0000-00-00 00:00:00');


