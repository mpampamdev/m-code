/*
 Navicat Premium Data Transfer

 Source Server         : root
 Source Server Type    : MySQL
 Source Server Version : 100414
 Source Host           : localhost:3306
 Source Schema         : cms_new

 Target Server Type    : MySQL
 Target Server Version : 100414
 File Encoding         : 65001

 Date: 10/11/2020 13:18:37
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for auth_group
-- ----------------------------
DROP TABLE IF EXISTS `auth_group`;
CREATE TABLE `auth_group`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `definition` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_group
-- ----------------------------
INSERT INTO `auth_group` VALUES (1, 'xadmin', 'Admin Master');
INSERT INTO `auth_group` VALUES (6, 'superadmin', 'All control access');

-- ----------------------------
-- Table structure for auth_permission
-- ----------------------------
DROP TABLE IF EXISTS `auth_permission`;
CREATE TABLE `auth_permission`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `definition` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 231 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_permission
-- ----------------------------
INSERT INTO `auth_permission` VALUES (127, 'config_view_default', 'Module config');
INSERT INTO `auth_permission` VALUES (128, 'config_view_logo', 'Module config');
INSERT INTO `auth_permission` VALUES (129, 'config_view_sosmed', 'Module config');
INSERT INTO `auth_permission` VALUES (130, 'config_view_system', 'Module config');
INSERT INTO `auth_permission` VALUES (131, 'config_update_web_name', 'Module config');
INSERT INTO `auth_permission` VALUES (132, 'config_update_web_domain', 'Module config');
INSERT INTO `auth_permission` VALUES (133, 'config_update_web_owner', 'Module config');
INSERT INTO `auth_permission` VALUES (134, 'config_update_email', 'Module config');
INSERT INTO `auth_permission` VALUES (135, 'config_update_telepon', 'Module config');
INSERT INTO `auth_permission` VALUES (136, 'config_update_address', 'Module config');
INSERT INTO `auth_permission` VALUES (137, 'config_update_logo', 'Module config');
INSERT INTO `auth_permission` VALUES (138, 'config_update_facebook', 'Module config');
INSERT INTO `auth_permission` VALUES (139, 'config_update_instagram', 'Module config');
INSERT INTO `auth_permission` VALUES (140, 'config_update_youtube', 'Module config');
INSERT INTO `auth_permission` VALUES (141, 'config_update_twitter', 'Module config');
INSERT INTO `auth_permission` VALUES (142, 'config_update_user_log_status', 'Module config');
INSERT INTO `auth_permission` VALUES (143, 'config_update_maintenance_status', 'Module config');
INSERT INTO `auth_permission` VALUES (144, 'menu_list', 'Module menu');
INSERT INTO `auth_permission` VALUES (145, 'menu_add', 'Module menu');
INSERT INTO `auth_permission` VALUES (146, 'menu_update', 'Module menu');
INSERT INTO `auth_permission` VALUES (147, 'menu_delete', 'Module menu');
INSERT INTO `auth_permission` VALUES (148, 'menu_drag_positions', 'Module menu');
INSERT INTO `auth_permission` VALUES (149, 'user_list', 'Module user');
INSERT INTO `auth_permission` VALUES (150, 'user_add', 'Module user');
INSERT INTO `auth_permission` VALUES (152, 'user_update', 'Module user');
INSERT INTO `auth_permission` VALUES (153, 'user_delete', 'Module user');
INSERT INTO `auth_permission` VALUES (154, 'groups_list', 'Module groups');
INSERT INTO `auth_permission` VALUES (155, 'groups_add', 'Module groups');
INSERT INTO `auth_permission` VALUES (156, 'groups_access', 'Module groups');
INSERT INTO `auth_permission` VALUES (157, 'groups_update', 'Module groups');
INSERT INTO `auth_permission` VALUES (158, 'groups_delete', 'Module groups');
INSERT INTO `auth_permission` VALUES (159, 'permission_list', 'Module permission');
INSERT INTO `auth_permission` VALUES (160, 'permission_add', 'Module permission');
INSERT INTO `auth_permission` VALUES (162, 'permission_update', 'Module permission');
INSERT INTO `auth_permission` VALUES (163, 'permission_delete', 'Module permission');
INSERT INTO `auth_permission` VALUES (171, 'dashboard__view_profile_user', 'Module dashboard');
INSERT INTO `auth_permission` VALUES (175, 'dashboard_view_total_user', 'Module dashboard');
INSERT INTO `auth_permission` VALUES (176, 'dashboard_view_total_group', 'Module dashboard');
INSERT INTO `auth_permission` VALUES (178, 'user_detail', 'Module user');
INSERT INTO `auth_permission` VALUES (179, 'config_update_language', 'Module config');
INSERT INTO `auth_permission` VALUES (180, 'config_update_time_zone', 'Module config');
INSERT INTO `auth_permission` VALUES (181, 'testing_list', 'Module testing');
INSERT INTO `auth_permission` VALUES (182, 'testing_add', 'Module testing');
INSERT INTO `auth_permission` VALUES (183, 'testing_update', 'Module testing');
INSERT INTO `auth_permission` VALUES (184, 'testing_delete', 'Module testing');
INSERT INTO `auth_permission` VALUES (185, 'testing_detail', 'Module testing');
INSERT INTO `auth_permission` VALUES (186, 'profile_list', 'Module profile');
INSERT INTO `auth_permission` VALUES (187, 'profile_add', 'Module profile');
INSERT INTO `auth_permission` VALUES (188, 'profile_detail', 'Module profile');
INSERT INTO `auth_permission` VALUES (189, 'profile_update', 'Module profile');
INSERT INTO `auth_permission` VALUES (190, 'profile_delete', 'Module profile');
INSERT INTO `auth_permission` VALUES (191, 'test_module_list', 'Module test');
INSERT INTO `auth_permission` VALUES (192, 'test_module_add', 'Module test');
INSERT INTO `auth_permission` VALUES (193, 'test_module_update', 'Module test');
INSERT INTO `auth_permission` VALUES (194, 'test_module_delete', 'Module test');
INSERT INTO `auth_permission` VALUES (195, 'test_module_detail', 'Module test');
INSERT INTO `auth_permission` VALUES (196, 'filemanager_list', 'Module filemanager');
INSERT INTO `auth_permission` VALUES (197, 'filemanager_add', 'Module filemanager');
INSERT INTO `auth_permission` VALUES (198, 'filemanager_delete', 'Module filemanager');
INSERT INTO `auth_permission` VALUES (212, 'sidebar_view_user', 'Module sidebar');
INSERT INTO `auth_permission` VALUES (213, 'sidebar_view_groups', 'Module sidebar');
INSERT INTO `auth_permission` VALUES (214, 'sidebar_view_permission', 'Module sidebar');
INSERT INTO `auth_permission` VALUES (215, 'sidebar_view_config', 'Module sidebar');
INSERT INTO `auth_permission` VALUES (216, 'sidebar_view_management_menu', 'Module sidebar');
INSERT INTO `auth_permission` VALUES (217, 'sidebar_view_file_manager', 'Module sidebar');
INSERT INTO `auth_permission` VALUES (218, 'sidebar_view_auth', 'Module sidebar');
INSERT INTO `auth_permission` VALUES (219, 'sidebar_view_config_system', 'Module sidebar');
INSERT INTO `auth_permission` VALUES (220, 'sidebar_view_test_module', 'Module sidebar');
INSERT INTO `auth_permission` VALUES (222, 'sidebar_view_dashboard', 'Module sidebar');
INSERT INTO `auth_permission` VALUES (223, 'sidebar_view_m-crud_generator', 'Module sidebar');
INSERT INTO `auth_permission` VALUES (226, 'config_update_encryption_key', 'Module config');
INSERT INTO `auth_permission` VALUES (227, 'config_update_encryption_url', 'Module config');
INSERT INTO `auth_permission` VALUES (230, 'config_update_url_suffix', 'Module config');

-- ----------------------------
-- Table structure for auth_permission_to_group
-- ----------------------------
DROP TABLE IF EXISTS `auth_permission_to_group`;
CREATE TABLE `auth_permission_to_group`  (
  `permission_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_permission_to_group
-- ----------------------------
INSERT INTO `auth_permission_to_group` VALUES (127, 6);
INSERT INTO `auth_permission_to_group` VALUES (128, 6);
INSERT INTO `auth_permission_to_group` VALUES (129, 6);
INSERT INTO `auth_permission_to_group` VALUES (130, 6);
INSERT INTO `auth_permission_to_group` VALUES (131, 6);
INSERT INTO `auth_permission_to_group` VALUES (132, 6);
INSERT INTO `auth_permission_to_group` VALUES (133, 6);
INSERT INTO `auth_permission_to_group` VALUES (134, 6);
INSERT INTO `auth_permission_to_group` VALUES (135, 6);
INSERT INTO `auth_permission_to_group` VALUES (136, 6);
INSERT INTO `auth_permission_to_group` VALUES (137, 6);
INSERT INTO `auth_permission_to_group` VALUES (138, 6);
INSERT INTO `auth_permission_to_group` VALUES (139, 6);
INSERT INTO `auth_permission_to_group` VALUES (140, 6);
INSERT INTO `auth_permission_to_group` VALUES (141, 6);
INSERT INTO `auth_permission_to_group` VALUES (142, 6);
INSERT INTO `auth_permission_to_group` VALUES (143, 6);
INSERT INTO `auth_permission_to_group` VALUES (179, 6);
INSERT INTO `auth_permission_to_group` VALUES (180, 6);
INSERT INTO `auth_permission_to_group` VALUES (226, 6);
INSERT INTO `auth_permission_to_group` VALUES (227, 6);
INSERT INTO `auth_permission_to_group` VALUES (228, 6);
INSERT INTO `auth_permission_to_group` VALUES (144, 6);
INSERT INTO `auth_permission_to_group` VALUES (145, 6);
INSERT INTO `auth_permission_to_group` VALUES (146, 6);
INSERT INTO `auth_permission_to_group` VALUES (147, 6);
INSERT INTO `auth_permission_to_group` VALUES (148, 6);
INSERT INTO `auth_permission_to_group` VALUES (149, 6);
INSERT INTO `auth_permission_to_group` VALUES (150, 6);
INSERT INTO `auth_permission_to_group` VALUES (152, 6);
INSERT INTO `auth_permission_to_group` VALUES (153, 6);
INSERT INTO `auth_permission_to_group` VALUES (178, 6);
INSERT INTO `auth_permission_to_group` VALUES (154, 6);
INSERT INTO `auth_permission_to_group` VALUES (155, 6);
INSERT INTO `auth_permission_to_group` VALUES (156, 6);
INSERT INTO `auth_permission_to_group` VALUES (157, 6);
INSERT INTO `auth_permission_to_group` VALUES (158, 6);
INSERT INTO `auth_permission_to_group` VALUES (159, 6);
INSERT INTO `auth_permission_to_group` VALUES (160, 6);
INSERT INTO `auth_permission_to_group` VALUES (162, 6);
INSERT INTO `auth_permission_to_group` VALUES (163, 6);
INSERT INTO `auth_permission_to_group` VALUES (171, 6);
INSERT INTO `auth_permission_to_group` VALUES (175, 6);
INSERT INTO `auth_permission_to_group` VALUES (176, 6);
INSERT INTO `auth_permission_to_group` VALUES (181, 6);
INSERT INTO `auth_permission_to_group` VALUES (182, 6);
INSERT INTO `auth_permission_to_group` VALUES (183, 6);
INSERT INTO `auth_permission_to_group` VALUES (184, 6);
INSERT INTO `auth_permission_to_group` VALUES (185, 6);
INSERT INTO `auth_permission_to_group` VALUES (186, 6);
INSERT INTO `auth_permission_to_group` VALUES (187, 6);
INSERT INTO `auth_permission_to_group` VALUES (188, 6);
INSERT INTO `auth_permission_to_group` VALUES (189, 6);
INSERT INTO `auth_permission_to_group` VALUES (190, 6);
INSERT INTO `auth_permission_to_group` VALUES (191, 6);
INSERT INTO `auth_permission_to_group` VALUES (192, 6);
INSERT INTO `auth_permission_to_group` VALUES (193, 6);
INSERT INTO `auth_permission_to_group` VALUES (194, 6);
INSERT INTO `auth_permission_to_group` VALUES (195, 6);
INSERT INTO `auth_permission_to_group` VALUES (196, 6);
INSERT INTO `auth_permission_to_group` VALUES (197, 6);
INSERT INTO `auth_permission_to_group` VALUES (198, 6);
INSERT INTO `auth_permission_to_group` VALUES (212, 6);
INSERT INTO `auth_permission_to_group` VALUES (213, 6);
INSERT INTO `auth_permission_to_group` VALUES (214, 6);
INSERT INTO `auth_permission_to_group` VALUES (215, 6);
INSERT INTO `auth_permission_to_group` VALUES (216, 6);
INSERT INTO `auth_permission_to_group` VALUES (217, 6);
INSERT INTO `auth_permission_to_group` VALUES (218, 6);
INSERT INTO `auth_permission_to_group` VALUES (219, 6);
INSERT INTO `auth_permission_to_group` VALUES (220, 6);
INSERT INTO `auth_permission_to_group` VALUES (222, 6);
INSERT INTO `auth_permission_to_group` VALUES (223, 6);

-- ----------------------------
-- Table structure for auth_user
-- ----------------------------
DROP TABLE IF EXISTS `auth_user`;
CREATE TABLE `auth_user`  (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `token` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `last_login` datetime(0) NULL DEFAULT NULL,
  `ip_address` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_active` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '1',
  `created` datetime(0) NULL DEFAULT NULL,
  `modified` datetime(0) NULL DEFAULT NULL,
  `is_delete` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of auth_user
-- ----------------------------
INSERT INTO `auth_user` VALUES (1, 'superadmin', 'mpampam@dev.com', '$2y$10$/LXc2T9H9cIfSVT0CSP01.wPWieXSIKqcFNM4CzBEDXx9qhWwsGx6', 'mpampam', '2020-11-10 13:36:00', '::1', '1', '2020-02-14 00:01:19', NULL, '0');

-- ----------------------------
-- Table structure for auth_user_to_group
-- ----------------------------
DROP TABLE IF EXISTS `auth_user_to_group`;
CREATE TABLE `auth_user_to_group`  (
  `id_user` int(11) NULL DEFAULT NULL,
  `id_group` int(11) NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_user_to_group
-- ----------------------------
INSERT INTO `auth_user_to_group` VALUES (1, 1);
INSERT INTO `auth_user_to_group` VALUES (2, 6);
INSERT INTO `auth_user_to_group` VALUES (3, 2);
INSERT INTO `auth_user_to_group` VALUES (7, 6);
INSERT INTO `auth_user_to_group` VALUES (8, 2);
INSERT INTO `auth_user_to_group` VALUES (9, 2);
INSERT INTO `auth_user_to_group` VALUES (10, 6);
INSERT INTO `auth_user_to_group` VALUES (11, 6);
INSERT INTO `auth_user_to_group` VALUES (12, 6);
INSERT INTO `auth_user_to_group` VALUES (13, 6);
INSERT INTO `auth_user_to_group` VALUES (14, 6);

-- ----------------------------
-- Table structure for ci_sessions
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions`  (
  `id` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ip_address` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  INDEX `ci_sessions_timestamp`(`timestamp`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for ci_user_log
-- ----------------------------
DROP TABLE IF EXISTS `ci_user_log`;
CREATE TABLE `ci_user_log`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NULL DEFAULT NULL,
  `ip_address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `controller` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 55 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for filemanager
-- ----------------------------
DROP TABLE IF EXISTS `filemanager`;
CREATE TABLE `filemanager`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `ket` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `created` datetime(0) NULL DEFAULT NULL,
  `update` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of filemanager
-- ----------------------------
INSERT INTO `filemanager` VALUES (14, '20201108015817-image-removebg-p.png', 'Di upload melalu module title', '2020-11-08 01:58:00', NULL);
INSERT INTO `filemanager` VALUES (15, '20201108020110-posisi_standar_a.jpg', 'Di upload melalu module Test Module', '2020-11-08 02:01:00', NULL);
INSERT INTO `filemanager` VALUES (16, '85a8fd633c-529px-BUMN_Hadir.png', 'Di upload melalui module File manager', '2020-11-09 21:39:54', NULL);
INSERT INTO `filemanager` VALUES (17, 'cb5a5cf117-doctor_icon_1348.png', 'Di upload melalui module File manager', '2020-11-09 21:40:18', NULL);

-- ----------------------------
-- Table structure for main_menu
-- ----------------------------
DROP TABLE IF EXISTS `main_menu`;
CREATE TABLE `main_menu`  (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `is_parent` int(11) NULL DEFAULT NULL,
  `menu` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `slug` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `type` enum('controller','url') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `controller` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `target` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `icon` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_active` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sort` int(11) NULL DEFAULT NULL,
  `created` datetime(0) NULL DEFAULT NULL,
  `modified` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_menu`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 55 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of main_menu
-- ----------------------------
INSERT INTO `main_menu` VALUES (3, 7, 'management menu', 'management-menu', 'controller', 'main_menu', '', '', '1', 8, '2020-02-15 06:48:31', '2020-11-02 13:33:26');
INSERT INTO `main_menu` VALUES (7, 0, 'config system', 'config-system', NULL, '', NULL, 'fa fa-cogs', '1', 6, '2020-02-26 06:42:29', '2020-10-27 09:10:41');
INSERT INTO `main_menu` VALUES (34, 7, 'config', 'config', 'controller', 'setting', NULL, '', '1', 7, '2020-10-19 00:25:57', '2020-10-27 09:09:20');
INSERT INTO `main_menu` VALUES (36, 0, 'dashboard', 'dashboard', 'controller', 'dashboard', '', 'mdi mdi-laptop', '1', 1, '2020-10-27 08:18:55', '2020-11-09 23:07:13');
INSERT INTO `main_menu` VALUES (37, 0, 'auth', 'auth', NULL, '', NULL, 'mdi mdi-account-settings-variant', '1', 2, '2020-10-27 08:45:17', NULL);
INSERT INTO `main_menu` VALUES (38, 37, 'user', 'user', 'controller', 'user', NULL, 'mdi mdi-account-star', '1', 3, '2020-10-27 08:46:10', '2020-10-27 09:38:05');
INSERT INTO `main_menu` VALUES (39, 37, 'groups', 'groups', 'controller', 'group', NULL, '', '1', 4, '2020-10-27 08:48:28', '2020-10-27 20:24:12');
INSERT INTO `main_menu` VALUES (40, 37, 'permission', 'permission', 'controller', 'permission', NULL, '', '1', 5, '2020-10-27 08:49:49', '2020-10-29 22:47:10');
INSERT INTO `main_menu` VALUES (48, 0, 'm-crud generator', 'm-crud-generator', 'url', 'http://localhost/ci/mcrud', '_blank', 'mdi mdi-xml', '1', 11, '2020-11-01 12:23:11', '2020-11-06 18:27:33');
INSERT INTO `main_menu` VALUES (54, 7, 'file manager', 'file-manager', 'controller', 'filemanager', '', 'mdi mdi-folder-multiple-image', '1', 9, '2020-11-08 00:44:38', NULL);

-- ----------------------------
-- Table structure for profile
-- ----------------------------
DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `telepon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of profile
-- ----------------------------
INSERT INTO `profile` VALUES (1, 'test', 'contoh@mail.com', '123456', '20201106171648-doctor_icon_134842.png');

-- ----------------------------
-- Table structure for setting
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting`  (
  `id_setting` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `options` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_setting`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES (1, 'general', 'web_name', 'M - CODE');
INSERT INTO `setting` VALUES (2, 'general', 'web_domain', 'https://localhost/ci');
INSERT INTO `setting` VALUES (3, 'general', 'web_owner', 'mpampam');
INSERT INTO `setting` VALUES (4, 'general', 'email', 'mpampam5@gmail.com');
INSERT INTO `setting` VALUES (5, 'general', 'telepon', '085288882994');
INSERT INTO `setting` VALUES (6, 'general', 'address', 'Jalan Muhajirin raya kecamatan tamalate, kota makassar');
INSERT INTO `setting` VALUES (7, 'general', 'logo', 'logos1.png');
INSERT INTO `setting` VALUES (8, 'sosmed', 'facebook', 'https://facebook.com/mpampam');
INSERT INTO `setting` VALUES (9, 'sosmed', 'instagram', 'https://instagram/mpampam');
INSERT INTO `setting` VALUES (10, 'sosmed', 'youtube', 'https://www.youtube.com/channel/UC1TlTaxRNdwrCqjBJ5zh6TA');
INSERT INTO `setting` VALUES (11, 'sosmed', 'twitter', 'https://twitter/m_pampam');
INSERT INTO `setting` VALUES (12, 'config', 'maintenance_status', 'N');
INSERT INTO `setting` VALUES (13, 'config', 'user_log_status', 'N');

SET FOREIGN_KEY_CHECKS = 1;
