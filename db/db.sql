-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2020 at 06:26 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_group`
--

CREATE TABLE `auth_group` (
  `id` int(11) NOT NULL,
  `group` varchar(255) DEFAULT NULL,
  `definition` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth_group`
--

INSERT INTO `auth_group` (`id`, `group`, `definition`) VALUES
(1, 'xadmin', 'Admin Master'),
(18, 'superadmin', '');

-- --------------------------------------------------------

--
-- Table structure for table `auth_permission`
--

CREATE TABLE `auth_permission` (
  `id` int(11) NOT NULL,
  `permission` varchar(255) DEFAULT NULL,
  `definition` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth_permission`
--

INSERT INTO `auth_permission` (`id`, `permission`, `definition`) VALUES
(127, 'config_view_default', 'Module config'),
(128, 'config_view_logo', 'Module config'),
(129, 'config_view_sosmed', 'Module config'),
(130, 'config_view_system', 'Module config'),
(131, 'config_update_web_name', 'Module config'),
(132, 'config_update_web_domain', 'Module config'),
(133, 'config_update_web_owner', 'Module config'),
(134, 'config_update_email', 'Module config'),
(135, 'config_update_telepon', 'Module config'),
(136, 'config_update_address', 'Module config'),
(137, 'config_update_logo', 'Module config'),
(138, 'config_update_facebook', 'Module config'),
(139, 'config_update_instagram', 'Module config'),
(140, 'config_update_youtube', 'Module config'),
(141, 'config_update_twitter', 'Module config'),
(142, 'config_update_user_log_status', 'Module config'),
(143, 'config_update_maintenance_status', 'Module config'),
(144, 'menu_list', 'Module menu'),
(145, 'menu_add', 'Module menu'),
(146, 'menu_update', 'Module menu'),
(147, 'menu_delete', 'Module menu'),
(148, 'menu_drag_positions', 'Module menu'),
(149, 'user_list', 'Module user'),
(150, 'user_add', 'Module user'),
(152, 'user_update', 'Module user'),
(153, 'user_delete', 'Module user'),
(154, 'groups_list', 'Module groups'),
(155, 'groups_add', 'Module groups'),
(156, 'groups_access', 'Module groups'),
(157, 'groups_update', 'Module groups'),
(158, 'groups_delete', 'Module groups'),
(159, 'permission_list', 'Module permission'),
(160, 'permission_add', 'Module permission'),
(162, 'permission_update', 'Module permission'),
(163, 'permission_delete', 'Module permission'),
(171, 'dashboard__view_profile_user', 'Module dashboard'),
(175, 'dashboard_view_total_user', 'Module dashboard'),
(176, 'dashboard_view_total_group', 'Module dashboard'),
(178, 'user_detail', 'Module user'),
(179, 'config_update_language', 'Module config'),
(180, 'config_update_time_zone', 'Module config'),
(196, 'filemanager_list', 'Module filemanager'),
(197, 'filemanager_add', 'Module filemanager'),
(198, 'filemanager_delete', 'Module filemanager'),
(212, 'sidebar_view_user', 'Module sidebar'),
(213, 'sidebar_view_groups', 'Module sidebar'),
(214, 'sidebar_view_permission', 'Module sidebar'),
(216, 'sidebar_view_management_menu', 'Module sidebar'),
(217, 'sidebar_view_file_manager', 'Module sidebar'),
(218, 'sidebar_view_auth', 'Module sidebar'),
(222, 'sidebar_view_dashboard', 'Module sidebar'),
(223, 'sidebar_view_m-crud_generator', 'Module sidebar'),
(226, 'config_update_encryption_key', 'Module config'),
(227, 'config_update_encryption_url', 'Module config'),
(230, 'config_update_url_suffix', 'Module config'),
(232, 'dashboard_view_total_permission', 'Module dashboard'),
(233, 'dashboard_view_total_filemanager', 'Module dashboard'),
(239, 'config_update_max_upload', 'Module config'),
(271, 'config_update_route_admin', 'Module config'),
(272, 'config_update_logo_mini', 'Module config'),
(273, 'config_update_favicon', 'Module config'),
(274, 'sidebar_view_system', 'Module sidebar'),
(275, 'sidebar_view_crud', 'Module sidebar'),
(276, 'sidebar_view_config', 'Module sidebar'),
(277, 'crud_list', 'Module crud'),
(278, 'crud_delete', 'Module crud'),
(279, 'config_update_route_login', 'Module config'),
(280, 'crud_add', 'Module crud'),
(281, 'crud_update', 'Module crud'),
(282, 'sidebar_view_test', 'Module sidebar'),
(283, 'crud2_list', 'Module crud2'),
(285, 'crud_detail', 'Module crud');

-- --------------------------------------------------------

--
-- Table structure for table `auth_permission_to_group`
--

CREATE TABLE `auth_permission_to_group` (
  `permission_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth_permission_to_group`
--

INSERT INTO `auth_permission_to_group` (`permission_id`, `group_id`) VALUES
(127, 18),
(128, 18),
(129, 18),
(130, 18),
(131, 18),
(132, 18),
(133, 18),
(134, 18),
(135, 18),
(136, 18),
(137, 18),
(138, 18),
(139, 18),
(140, 18),
(141, 18),
(142, 18),
(143, 18),
(179, 18),
(180, 18),
(226, 18),
(227, 18),
(230, 18),
(239, 18),
(271, 18),
(272, 18),
(273, 18),
(279, 18),
(144, 18),
(145, 18),
(146, 18),
(147, 18),
(148, 18),
(149, 18),
(150, 18),
(152, 18),
(153, 18),
(178, 18),
(154, 18),
(155, 18),
(156, 18),
(157, 18),
(158, 18),
(159, 18),
(160, 18),
(162, 18),
(163, 18),
(171, 18),
(175, 18),
(176, 18),
(232, 18),
(233, 18),
(196, 18),
(197, 18),
(198, 18),
(212, 18),
(213, 18),
(214, 18),
(216, 18),
(217, 18),
(218, 18),
(222, 18),
(223, 18),
(274, 18),
(275, 18),
(276, 18),
(277, 18),
(278, 18),
(280, 18),
(281, 18);

-- --------------------------------------------------------

--
-- Table structure for table `auth_user`
--

CREATE TABLE `auth_user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `is_active` enum('0','1') DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `is_delete` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `auth_user`
--

INSERT INTO `auth_user` (`id_user`, `name`, `photo`, `email`, `password`, `token`, `last_login`, `ip_address`, `is_active`, `created`, `modified`, `is_delete`) VALUES
(1, 'Developer', '', 'mpampam@dev.com', '$2y$10$0uNl2k9rRVQLEvXnwNZa3eiqhY7e1LE/uaXsRBnYZZhOY7aWGEgG.', 'wg9sBvrdm03cPfnTYrba5b4mGWEErioH', '2020-11-25 13:11:00', '::1', '1', '2020-02-14 00:01:19', '2020-11-24 04:25:27', '0'),
(15, 'admin', '', 'admin@mail.com', '$2y$10$1mFXVAf771zn7oXgjLQdneoPNT0zBq04blAnse0rqi3DyNjO5/69a', 'd2de6548acb263de1abf2130c22c57937a90cbda87309a09f2eae1ca24ba67f7', '2020-11-15 15:43:00', '::1', '1', '2020-11-10 14:51:57', '2020-11-25 12:08:07', '0');

-- --------------------------------------------------------

--
-- Table structure for table `auth_user_to_group`
--

CREATE TABLE `auth_user_to_group` (
  `id_user` int(11) DEFAULT NULL,
  `id_group` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth_user_to_group`
--

INSERT INTO `auth_user_to_group` (`id_user`, `id_group`) VALUES
(1, 1),
(2, 6),
(3, 2),
(7, 6),
(8, 2),
(9, 2),
(10, 6),
(11, 6),
(12, 6),
(13, 6),
(14, 6),
(15, 18),
(16, 6),
(17, 6),
(18, 6),
(19, 6),
(20, 18);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `ci_user_log`
--

CREATE TABLE `ci_user_log` (
  `id` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `data` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `filemanager`
--

CREATE TABLE `filemanager` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `ket` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `filemanager`
--

INSERT INTO `filemanager` (`id`, `file_name`, `ket`, `created`, `update`) VALUES
(77, '231120043259_logos1.png', 'LOGO APLIKASI', '2020-11-23 04:32:59', NULL),
(79, '231120051100_logo_mini.png', 'LOGO MINI', '2020-11-23 05:11:00', NULL),
(81, '231120051803_favicon.ico', 'FAVICON', '2020-11-23 05:18:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `main_menu`
--

CREATE TABLE `main_menu` (
  `id_menu` int(11) NOT NULL,
  `is_parent` int(11) DEFAULT NULL,
  `menu` varchar(50) DEFAULT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `type` enum('controller','url') DEFAULT NULL,
  `controller` varchar(255) DEFAULT NULL,
  `target` varchar(20) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `is_active` enum('0','1') DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `main_menu`
--

INSERT INTO `main_menu` (`id_menu`, `is_parent`, `menu`, `slug`, `type`, `controller`, `target`, `icon`, `is_active`, `sort`, `created`, `modified`) VALUES
(3, 7, 'management menu', 'management-menu', 'controller', 'main_menu', '', '', '1', 8, '2020-02-15 06:48:31', '2020-11-02 13:33:26'),
(7, 0, 'config', 'config', 'controller', '', '', 'fa fa-cogs', '1', 6, '2020-02-26 06:42:29', '2020-11-23 05:20:01'),
(34, 7, 'system', 'system', 'controller', 'setting', '', '', '1', 7, '2020-10-19 00:25:57', '2020-11-23 05:20:11'),
(36, 0, 'dashboard', 'dashboard', 'controller', 'dashboard', '', 'mdi mdi-laptop', '1', 1, '2020-10-27 08:18:55', '2020-11-09 23:07:13'),
(37, 0, 'auth', 'auth', NULL, '', NULL, 'mdi mdi-account-settings-variant', '1', 2, '2020-10-27 08:45:17', NULL),
(38, 37, 'user', 'user', 'controller', 'user', NULL, 'mdi mdi-account-star', '1', 3, '2020-10-27 08:46:10', '2020-10-27 09:38:05'),
(39, 37, 'groups', 'groups', 'controller', 'group', NULL, '', '1', 4, '2020-10-27 08:48:28', '2020-10-27 20:24:12'),
(40, 37, 'permission', 'permission', 'controller', 'permission', NULL, '', '1', 5, '2020-10-27 08:49:49', '2020-10-29 22:47:10'),
(48, 0, 'm-crud generator', 'm-crud-generator', 'url', 'mcrud', '_blank', 'mdi mdi-xml', '1', 11, '2020-11-01 12:23:11', '2020-11-22 00:06:35'),
(54, 7, 'file manager', 'file-manager', 'controller', 'filemanager', '', 'mdi mdi-folder-multiple-image', '1', 9, '2020-11-08 00:44:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(11) NOT NULL,
  `group` varchar(50) DEFAULT NULL,
  `options` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `group`, `options`, `value`) VALUES
(1, 'general', 'web_name', 'M-CODE CRUD GEBERATOR CODEIGNITER'),
(2, 'general', 'web_domain', 'www.m-code.dev'),
(3, 'general', 'web_owner', 'mpampam.dev/programmer_jalanan'),
(4, 'general', 'email', 'mpampam@dev.com'),
(5, 'general', 'telepon', '085288888888'),
(6, 'general', 'address', 'Jalan apa saja boleh, yang pasti jangan jalan buntu'),
(7, 'general', 'logo', '231120043259_logos1.png'),
(8, 'general', 'logo_mini', '231120051100_logo_mini.png'),
(9, 'general', 'favicon', '231120051803_favicon.ico'),
(50, 'sosmed', 'facebook', 'https://facebook.com/mpampam'),
(51, 'sosmed', 'instagram', 'https://instagram/mpampam'),
(52, 'sosmed', 'youtube', 'https://www.youtube.com/channel/UC1TlTaxRNdwrCqjBJ5zh6TA'),
(53, 'sosmed', 'twitter', 'https://twitter/m_pampam'),
(60, 'config', 'maintenance_status', 'N'),
(61, 'config', 'user_log_status', 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_group`
--
ALTER TABLE `auth_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_permission`
--
ALTER TABLE `auth_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_user`
--
ALTER TABLE `auth_user`
  ADD PRIMARY KEY (`id_user`) USING BTREE;

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`) USING BTREE;

--
-- Indexes for table `ci_user_log`
--
ALTER TABLE `ci_user_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filemanager`
--
ALTER TABLE `filemanager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_menu`
--
ALTER TABLE `main_menu`
  ADD PRIMARY KEY (`id_menu`) USING BTREE;

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_group`
--
ALTER TABLE `auth_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `auth_permission`
--
ALTER TABLE `auth_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;

--
-- AUTO_INCREMENT for table `auth_user`
--
ALTER TABLE `auth_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ci_user_log`
--
ALTER TABLE `ci_user_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `filemanager`
--
ALTER TABLE `filemanager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `main_menu`
--
ALTER TABLE `main_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
