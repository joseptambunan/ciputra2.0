/*
Navicat MySQL Data Transfer

Source Server         : 117.53.46.38
Source Server Version : 50561
Source Host           : 117.53.46.38:3306
Source Database       : zadmin_qs

Target Server Type    : MYSQL
Target Server Version : 50561
File Encoding         : 65001

Date: 2019-01-24 07:30:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for budgets
-- ----------------------------
DROP TABLE IF EXISTS budgets;
CREATE TABLE budgets (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pt_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `project_kawasan_id` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `status_active` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `budgets_pt_id_index` (`pt_id`),
  KEY `budgets_department_id_index` (`department_id`),
  KEY `budgets_project_id_index` (`project_id`),
  KEY `budgets_parent_id_index` (`parent_id`),
  KEY `budgets_project_kawasan_id_index` (`project_kawasan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of budgets
-- ----------------------------
INSERT INTO budgets VALUES ('11', '24', '2', '66', null, null, '0011/BDG/CD/X/2018/XXX/XXX', '2018-01-01', '2018-12-31', 'Migration from Project based export at 18 Oct 2018', '2018-10-26 01:08:59', '2018-10-26 01:08:59', '2018-10-28 17:00:00', '1', null, null, null, null, '1');
INSERT INTO budgets VALUES ('13', '24', '2', '66', null, null, '0012/BDG/CD/X/2018/XXX/XXX', '2018-01-01', '2018-12-31', 'Migration from Project based export at 18 Oct 2018', '2018-10-28 22:40:52', '2018-10-28 22:40:52', null, '1', null, null, null, null, '1');
INSERT INTO budgets VALUES ('19', '1', '2', '82', null, null, '0013/BDG/CD/XI/2018/PTD/D01', '2018-11-09', '2027-11-09', 'Fasilitas Kota', '2018-11-09 06:35:30', '2018-11-09 06:35:30', null, '32', null, null, null, null, '1');
INSERT INTO budgets VALUES ('20', '1', '2', '82', null, '13', '0014/BDG/CD/XI/2018/PTD/D01', '2018-11-09', '2027-11-09', 'Kawasan Nusa Dua', '2018-11-09 08:32:44', '2018-11-09 08:32:44', null, '32', null, null, null, null, '1');
INSERT INTO budgets VALUES ('21', '1', '2', '82', null, '14', '0015/BDG/CD/XI/2018/PTD/D01', '2018-11-09', '2027-11-09', 'Kawasan Branwood', '2018-11-09 08:39:21', '2018-11-09 08:39:21', null, '32', null, null, null, null, '1');
INSERT INTO budgets VALUES ('24', '48', '2', '9', null, null, '0016/BDG/CD/XI/2018/XXX/XXX', '2018-11-16', '2018-11-30', 'Faskot', '2018-11-16 17:07:11', '2018-11-16 17:07:11', null, '37', null, null, null, null, '1');
INSERT INTO budgets VALUES ('25', '48', '2', '9', null, '40', '0017/BDG/CD/XI/2018/XXX/XXX', '2018-11-16', '2018-11-30', 'kawasan', '2018-11-16 17:12:00', '2018-11-19 15:29:04', '2018-11-19 15:29:04', '37', null, null, null, null, '1');
INSERT INTO budgets VALUES ('26', '48', '2', '9', null, '41', '0018/BDG/CD/XI/2018/XXX/XXX', '2018-11-16', '2018-11-30', 'kawasan', '2018-11-16 17:25:49', '2018-11-19 16:02:16', '2018-11-19 16:02:16', '37', null, null, null, null, '1');
INSERT INTO budgets VALUES ('27', '48', '2', '9', '25', '40', '0017/BDG/CD/XI/2018/XXX/XXX-R1', '2018-11-16', '2018-11-30', null, '2018-11-19 15:29:04', '2018-11-19 15:29:04', null, '37', null, null, null, null, '1');
INSERT INTO budgets VALUES ('28', '48', '2', '9', '26', '41', '0018/BDG/CD/XI/2018/XXX/XXX-R1', '2018-11-16', '2018-11-30', null, '2018-11-19 16:02:16', '2018-11-19 16:02:16', null, '37', null, null, null, null, '1');
INSERT INTO budgets VALUES ('31', '17', '2', '3', null, '50', '0023/BDG/CD/XII/2018/H/I01', '2018-12-20', '2025-12-31', 'Budget global untuk kawasan Clover Garden Blok CC', '2018-12-20 03:41:43', '2019-01-08 03:44:21', '2019-01-08 03:44:21', '44', null, null, null, null, '1');
INSERT INTO budgets VALUES ('32', '17', '2', '3', null, '49', '0024/BDG/CD/XII/2018/H/I01', '2018-12-20', '2025-12-31', 'Budget cluster P ext 2', '2018-12-20 06:51:32', '2019-01-08 02:36:28', '2019-01-08 02:36:28', '44', null, null, null, null, '1');
INSERT INTO budgets VALUES ('33', '48', '2', '9', null, null, '0025/BDG/CD/XII/2018/XXX/XXX', '2018-12-20', '2018-12-20', null, '2018-12-20 07:06:37', '2018-12-20 07:06:37', null, '1', null, null, null, null, '1');
INSERT INTO budgets VALUES ('34', '17', '2', '3', null, null, '0026/BDG/CD/XII/2018/H/I01', '2018-12-20', '2025-12-31', 'Budget Fas-kot', '2018-12-20 08:50:10', '2018-12-21 03:04:40', '2018-12-21 03:04:40', '44', null, null, null, null, '1');
INSERT INTO budgets VALUES ('35', '27', '2', '61', null, '51', '0027/BDG/CD/XII/2018/I/I15', '2018-12-20', '2024-01-20', 'KAWASAN NEW LIVISTONA', '2018-12-20 09:02:12', '2018-12-20 09:02:12', null, '46', null, null, null, null, '1');
INSERT INTO budgets VALUES ('36', '17', '2', '3', '34', null, '0026/BDG/CD/XII/2018/H/I01-R1', '2018-12-20', '2025-12-31', null, '2018-12-21 03:04:40', '2018-12-21 03:43:02', '2018-12-21 03:43:02', '44', null, null, null, null, '1');
INSERT INTO budgets VALUES ('37', '17', '2', '3', '36', null, '0026/BDG/CD/XII/2018/H/I01-R1-R1', '2018-12-20', '2025-12-31', null, '2018-12-21 03:43:02', '2019-01-08 05:11:12', '2019-01-08 05:11:12', '44', null, null, null, null, '1');
INSERT INTO budgets VALUES ('39', '2', '2', '1', null, null, '0028/BDG/CD/XII/2018/D/D02', '2018-12-21', '2023-12-22', 'Budget Faskot PT Mitrakusuma  Erasemesta', '2018-12-21 06:32:25', '2018-12-21 06:32:25', null, '42', null, null, null, null, '1');
INSERT INTO budgets VALUES ('40', '2', '2', '1', null, '47', '0029/BDG/CD/XII/2018/D/D02', '2018-12-21', '2022-12-31', 'Budget devcost kawasan bukit orchid', '2018-12-21 07:45:25', '2018-12-21 07:45:25', null, '42', null, null, null, null, '1');
INSERT INTO budgets VALUES ('41', '2', '2', '1', null, '48', '0030/BDG/CD/XII/2018/D/D02', '2018-12-21', '2021-12-31', 'Budget kawasan ruko orchid boulevard', '2018-12-21 09:55:04', '2018-12-21 09:55:04', null, '42', null, null, null, null, '1');
INSERT INTO budgets VALUES ('43', '2', '2', '1', null, '46', '0031/BDG/CD/XII/2018/D/D02', '2018-12-26', '2021-12-31', 'Budget Bukit Sakura', '2018-12-26 04:07:03', '2018-12-26 04:07:03', null, '42', null, null, null, null, '1');
INSERT INTO budgets VALUES ('44', '68', '2', '3', null, null, '0032/BDG/CD/XII/2018/H/XXX', '2018-12-26', '2025-12-31', 'Asumsi Devcost Cikeas', '2018-12-26 04:53:18', '2018-12-26 04:53:18', '2018-12-27 00:00:00', '48', null, null, null, null, '1');
INSERT INTO budgets VALUES ('45', '2', '2', '1', null, '45', '0033/BDG/CD/XII/2018/D/D02', '2018-12-26', '2021-12-31', 'Budget Development Cost Bukit Sakura', '2018-12-26 06:30:01', '2018-12-26 06:30:01', null, '42', null, null, null, null, '1');
INSERT INTO budgets VALUES ('46', '17', '2', '3', null, '65', '0034/BDG/CD/XII/2018/H/I01', '2018-12-27', '2018-12-31', 'Budget global blok AA ext', '2018-12-27 10:18:11', '2019-01-08 04:06:40', '2019-01-08 04:06:40', '44', null, null, null, null, '1');
INSERT INTO budgets VALUES ('47', '17', '2', '3', null, '66', '0035/BDG/CD/XII/2018/H/I01', '2018-12-27', '2025-12-31', 'Budget global blok BB', '2018-12-27 10:24:41', '2019-01-08 04:19:05', '2019-01-08 04:19:05', '44', null, null, null, null, '1');
INSERT INTO budgets VALUES ('48', '17', '2', '3', null, '67', '0036/BDG/CD/XII/2018/H/I01', '2018-12-28', '2019-12-31', 'budget con cost 2019', '2018-12-28 01:56:38', '2019-01-08 04:36:52', '2019-01-08 04:36:52', '44', null, null, null, null, '1');
INSERT INTO budgets VALUES ('50', '17', '2', '3', '32', '49', '0024/BDG/CD/XII/2018/H/I01-R1', '2018-12-20', '2025-12-31', 'budget revisi per 8 Jan 2019', '2019-01-08 02:36:28', '2019-01-08 02:36:28', null, '44', null, null, null, null, '1');
INSERT INTO budgets VALUES ('52', '17', '2', '3', '31', '50', '0023/BDG/CD/XII/2018/H/I01-R1', '2018-12-20', '2025-12-31', 'revisi budget per 8Jan2019', '2019-01-08 03:44:21', '2019-01-08 03:44:21', null, '44', null, null, null, null, '1');
INSERT INTO budgets VALUES ('74', '17', '2', '3', '46', '65', '0034/BDG/CD/XII/2018/H/I01-R1', '2018-12-27', '2018-12-31', 'revisi budget per8Jan2019', '2019-01-08 04:06:40', '2019-01-08 04:06:40', null, '44', null, null, null, null, '1');
INSERT INTO budgets VALUES ('75', '25', '2', '60', null, '70', null, '2017-01-01', '2018-08-31', null, '2018-07-13 08:35:13', '2018-10-01 13:05:35', '2018-10-01 13:05:35', '1', null, null, null, null, '1');
INSERT INTO budgets VALUES ('76', '25', '2', '60', null, '71', null, '2017-01-01', '2020-12-31', null, '2018-07-13 08:35:15', '2018-10-01 17:15:27', '2018-10-01 17:15:27', '1', null, null, null, null, '0');
INSERT INTO budgets VALUES ('77', '25', '2', '60', null, '72', null, '2017-01-01', '2020-12-31', null, '2018-07-13 08:35:16', '2018-10-02 11:24:52', '2018-10-02 11:24:52', '1', null, null, null, null, '0');
INSERT INTO budgets VALUES ('78', '25', '2', '60', null, '73', null, '2017-01-01', '2020-12-31', null, '2018-07-13 08:35:18', '2018-10-02 09:20:53', '2018-10-02 09:20:53', '1', null, null, null, null, '0');
INSERT INTO budgets VALUES ('79', '25', '2', '60', null, '74', null, '2017-01-01', '2020-12-31', null, '2018-07-13 08:35:19', '2018-10-02 09:56:33', '2018-10-02 09:56:33', '1', null, null, null, null, '0');
INSERT INTO budgets VALUES ('80', '25', '2', '60', null, '75', null, '2017-01-01', '2020-12-31', null, '2018-07-13 08:35:21', '2018-10-02 12:10:14', '2018-10-02 12:10:14', '1', null, null, null, null, '0');
INSERT INTO budgets VALUES ('81', '25', '2', '60', null, '76', null, '2017-01-01', '2020-12-31', null, '2018-07-13 08:35:23', '2018-10-02 12:24:26', '2018-10-02 12:24:26', '1', null, null, null, null, '0');
INSERT INTO budgets VALUES ('82', '25', '2', '60', null, '77', null, '2017-01-01', '2020-12-31', null, '2018-07-13 08:35:25', '2018-07-13 08:35:25', null, '1', null, null, null, null, '0');
INSERT INTO budgets VALUES ('83', '25', '2', '60', null, '78', null, '2017-01-01', '2020-12-31', null, '2018-07-13 08:35:26', '2018-10-02 12:42:19', '2018-10-02 12:42:19', '1', null, null, null, null, '0');
INSERT INTO budgets VALUES ('85', '25', '2', '60', null, null, '0036/BDG/CD/X/2018/CGCC/JGG', '2018-10-01', '2028-12-31', null, '2018-10-01 15:15:49', '2019-01-08 08:40:32', '2019-01-08 08:40:32', '1', null, null, null, null, '1');
INSERT INTO budgets VALUES ('86', '25', '2', '60', null, '79', '0047/BDG/CD/X/2018/CGCC/CNI', '2018-10-01', '2028-12-31', null, '2018-10-02 14:20:04', '2019-01-08 08:00:56', '2019-01-08 08:00:56', '1', null, null, null, null, '1');
INSERT INTO budgets VALUES ('87', '17', '2', '3', '47', '66', '0035/BDG/CD/XII/2018/H/I01-R1', '2018-12-27', '2025-12-31', 'revisi budget per8Jan2019', '2019-01-08 04:19:05', '2019-01-08 04:19:05', null, '44', null, null, null, null, '1');
INSERT INTO budgets VALUES ('88', '25', '2', '60', '10', null, '0002/BDG-R/CD/VIII/2018/CBD/JGG', '2017-01-01', '2020-12-31', null, '2018-08-09 10:10:59', '2018-08-09 10:10:59', '2018-10-02 07:00:00', '1', null, null, null, null, '0');
INSERT INTO budgets VALUES ('89', '25', '2', '60', '75', '70', '-R1', '2020-01-01', '2025-12-31', null, '2018-10-01 13:05:35', '2019-01-08 08:54:12', '2019-01-08 08:54:12', '1', null, null, null, null, '1');
INSERT INTO budgets VALUES ('90', '25', '2', '60', '76', '71', '-R1', '2017-01-01', '2020-12-31', null, '2018-10-01 17:15:27', '2019-01-08 09:26:05', '2019-01-08 09:26:05', '1', null, null, null, null, '1');
INSERT INTO budgets VALUES ('91', '25', '2', '60', '81', '76', '-R1-R1', '2017-01-01', '2020-12-31', null, '2018-10-01 18:13:01', '2019-01-08 10:25:28', '2019-01-08 10:25:28', '1', null, null, null, null, '1');
INSERT INTO budgets VALUES ('92', '25', '2', '60', '78', '73', '-R1', '2017-01-01', '2020-12-31', null, '2018-10-02 09:20:53', '2019-01-08 09:42:32', '2019-01-08 09:42:32', '1', null, null, null, null, '1');
INSERT INTO budgets VALUES ('93', '25', '2', '60', '79', '74', '-R1', '2017-01-01', '2020-12-31', null, '2018-10-02 09:56:33', '2019-01-08 05:23:07', '2019-01-08 05:23:07', '1', null, null, null, null, '1');
INSERT INTO budgets VALUES ('94', '25', '2', '60', '77', '72', '-R1', '2017-01-01', '2020-12-31', null, '2018-10-02 11:24:52', '2019-01-08 08:42:24', '2019-01-08 08:42:24', '1', null, null, null, null, '1');
INSERT INTO budgets VALUES ('95', '25', '2', '60', '80', '75', '-R1', '2017-01-01', '2020-12-31', null, '2018-10-02 12:10:14', '2019-01-08 06:55:28', '2019-01-08 06:55:28', '1', null, null, null, null, '1');
INSERT INTO budgets VALUES ('96', '25', '2', '6000', '81', '76', '-R1', '2017-01-01', '2020-12-31', null, '2018-10-02 12:24:26', '2018-10-02 12:24:26', null, '1', null, null, null, null, '1');
INSERT INTO budgets VALUES ('97', '17', '2', '3', '48', '67', '0036/BDG/CD/XII/2018/H/I01-R1', '2018-12-28', '2019-12-31', 'revisi budget per 8Jan2019', '2019-01-08 04:36:52', '2019-01-08 04:36:52', null, '44', null, null, null, null, '1');
INSERT INTO budgets VALUES ('98', '17', '2', '3', '37', null, '0026/BDG/CD/XII/2018/H/I01-R1-R1-R1', '2018-12-20', '2025-12-31', 'revisi budget per 8Jan2019', '2019-01-08 05:11:12', '2019-01-08 05:11:12', null, '44', null, null, null, null, '1');
INSERT INTO budgets VALUES ('99', '25', '2', '60', '93', '74', '-R1-R1', '2017-01-01', '2020-12-31', null, '2019-01-08 05:23:07', '2019-01-09 03:56:55', '2019-01-09 03:56:55', '30', null, null, null, null, '1');
INSERT INTO budgets VALUES ('104', '25', '2', '60', '95', '75', '-R1-R1', '2017-01-01', '2020-12-31', 'Revisi budget per 8 Januari 2019', '2019-01-08 06:55:28', '2019-01-08 06:55:28', null, '30', null, null, null, null, '1');
INSERT INTO budgets VALUES ('106', '25', '2', '60', '86', '79', '0047/BDG/CD/X/2018/CGCC/CNI-R2', '2018-10-01', '2028-12-31', 'Revisi Budget per 8 Januari 2019', '2019-01-08 08:00:56', '2019-01-08 08:00:56', null, '30', null, null, null, null, '1');
INSERT INTO budgets VALUES ('107', '25', '2', '60', '85', null, '0036/BDG/CD/X/2018/CGCC/JGG-R1', '2018-10-01', '2028-12-31', 'Revisi budget per 8 Januari 2019', '2019-01-08 08:40:32', '2019-01-08 08:40:32', null, '30', null, null, null, null, '1');
INSERT INTO budgets VALUES ('108', '25', '2', '60', '94', '72', '-R1-R1', '2017-01-01', '2020-12-31', 'Revisi Budget per 8 Januari 2019', '2019-01-08 08:42:24', '2019-01-08 08:42:24', null, '30', null, null, null, null, '1');
INSERT INTO budgets VALUES ('109', '25', '2', '6000', '89', '70', '-R1-R1', '2020-01-01', '2025-12-31', 'Budget revisi per 8 januari 2019', '2019-01-08 08:53:53', '2019-01-08 08:53:53', null, '30', null, null, null, null, '1');
INSERT INTO budgets VALUES ('110', '25', '2', '60', '89', '70', '-R1-R2', '2020-01-01', '2025-12-31', 'Budget revisi per 8 januari 2019', '2019-01-08 08:54:12', '2019-01-08 08:54:12', null, '30', null, null, null, null, '1');
INSERT INTO budgets VALUES ('111', '25', '2', '60', '90', '71', '-R1-R1', '2017-01-01', '2020-12-31', 'Revisi budget per 8 Januari 2019', '2019-01-08 09:26:05', '2019-01-08 09:26:05', null, '30', null, null, null, null, '1');
INSERT INTO budgets VALUES ('112', '25', '2', '60', '92', '73', '-R1-R1', '2017-01-01', '2020-12-31', 'revisi budget per 8 januari 2019', '2019-01-08 09:42:32', '2019-01-08 09:42:32', null, '30', null, null, null, null, '1');
INSERT INTO budgets VALUES ('113', '25', '2', '60', '91', '76', '-R1-R1-R1', '2017-01-01', '2020-12-31', 'Revisi budget per 8 Januari 2019', '2019-01-08 10:25:28', '2019-01-08 10:25:28', null, '30', null, null, null, null, '1');
INSERT INTO budgets VALUES ('114', '17', '2', '3', null, '80', '0054/BDG/CD/I/2019/H/I01', '2019-01-09', '2020-01-01', 'dc and CC', '2019-01-09 02:36:36', '2019-01-09 02:36:36', null, '44', null, null, null, null, '1');
INSERT INTO budgets VALUES ('115', '25', '2', '60', '99', '74', '-R1-R1-R1', '2017-01-01', '2020-12-31', 'revisi budget per 9 januari 2019', '2019-01-09 03:56:55', '2019-01-09 03:56:55', null, '30', null, null, null, null, '1');
INSERT INTO budgets VALUES ('116', '48', '2', '9', null, null, '0056/BDG/CD/I/2019/XXX/XXX', '2019-01-16', '2019-01-31', null, '2019-01-16 04:16:08', '2019-01-16 04:16:08', null, '37', null, null, null, null, '1');
INSERT INTO budgets VALUES ('117', '17', '2', '3', null, '81', '0057/BDG/CD/I/2019/H/I01', '2019-01-17', '2020-01-24', 'budget campur Blok F, AA, Pext, U, RC', '2019-01-17 11:04:11', '2019-01-17 11:04:11', null, '44', null, null, null, null, '1');
INSERT INTO budgets VALUES ('118', '48', '2', '9', null, null, '0058/BDG/CD/I/2019/XXX/XXX', '2019-01-23', '2020-01-30', 'Budget SUN GARDEN', '2019-01-22 10:04:02', '2019-01-22 10:04:02', null, '37', null, null, null, null, '1');
INSERT INTO budgets VALUES ('119', '48', '2', '9', null, null, '0059/BDG/CD/I/2019/XXX/XXX', '2019-01-23', '2020-01-30', 'BUdget SUN GARDEN', '2019-01-23 04:40:17', '2019-01-23 04:40:17', null, '37', null, null, null, null, '1');
