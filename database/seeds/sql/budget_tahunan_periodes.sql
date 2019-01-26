/*
Navicat MySQL Data Transfer

Source Server         : 117.53.46.38
Source Server Version : 50561
Source Host           : 117.53.46.38:3306
Source Database       : zadmin_qs

Target Server Type    : MYSQL
Target Server Version : 50561
File Encoding         : 65001

Date: 2019-01-24 07:32:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for budget_tahunan_periodes
-- ----------------------------
DROP TABLE IF EXISTS budget_tahunan_periodes;
CREATE TABLE budget_tahunan_periodes (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `budget_id` int(11) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `itempekerjaan_id` int(11) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `satuan` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai` double(24,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `januari` double DEFAULT NULL,
  `februari` double DEFAULT NULL,
  `maret` double DEFAULT NULL,
  `april` double DEFAULT NULL,
  `mei` double DEFAULT NULL,
  `juni` double DEFAULT NULL,
  `juli` double DEFAULT NULL,
  `agustus` double DEFAULT NULL,
  `september` double DEFAULT NULL,
  `oktober` double DEFAULT NULL,
  `november` double DEFAULT NULL,
  `desember` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `budget_tahunan_periodes_budget_id_index` (`budget_id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of budget_tahunan_periodes
-- ----------------------------
INSERT INTO budget_tahunan_periodes VALUES ('1', '500', null, '252', null, null, null, '2018-12-20 10:23:09', '2018-12-20 10:25:52', null, null, null, null, null, null, '33', '33', '34', '0', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('3', '503', null, '264', null, null, null, '2018-12-21 04:07:23', '2018-12-21 07:21:06', null, null, null, null, null, null, '33', '33', '28', '0', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('4', '503', null, '252', null, null, null, '2018-12-21 04:09:47', '2018-12-21 04:09:47', null, null, null, null, null, null, '0', '0', '0', '0', '0', '30', '30', '40', '0', '0', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('5', '504', null, '63', null, null, null, '2018-12-21 06:55:08', '2018-12-21 06:55:08', null, null, null, null, null, null, '0', '0', '0', '0', '0', '25', '0', '25', '25', '20', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('6', '504', null, '98', null, null, null, '2018-12-21 06:59:26', '2018-12-21 07:05:26', null, null, null, null, null, null, '0', '0', '0', '0', '33', '33', '27', '0', '0', '0', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('7', '504', null, '191', null, null, null, '2018-12-21 07:00:51', '2018-12-21 07:00:51', null, null, null, null, null, null, '0', '0', '0', '0', '33', '33', '29', '0', '0', '0', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('8', '504', null, '219', null, null, null, '2018-12-21 07:02:01', '2018-12-21 07:02:01', null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', '20', '20', '20', '20', '15', '0');
INSERT INTO budget_tahunan_periodes VALUES ('9', '504', null, '224', null, null, null, '2018-12-21 07:03:21', '2019-01-22 06:33:06', null, null, null, null, null, null, '0', '0', '20', '20', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('10', '505', null, '63', null, null, null, '2019-01-08 08:25:14', '2019-01-08 08:25:14', null, null, null, null, null, null, '0', '15', '45', '35', '0', '0', '5', '0', '0', '0', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('11', '505', null, '96', null, null, null, '2019-01-08 08:30:26', '2019-01-08 08:30:26', null, null, null, null, null, null, '0', '0', '0', '0', '0', '15', '80', '0', '0', '5', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('13', '509', null, '9', null, null, null, '2019-01-09 03:11:53', '2019-01-09 03:11:53', null, null, null, null, null, null, '50', '50', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('14', '509', null, '16', null, null, null, '2019-01-09 03:14:50', '2019-01-09 03:14:50', null, null, null, null, null, null, '0', '0', '30', '0', '30', '0', '40', '0', '0', '0', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('15', '509', null, '19', null, null, null, '2019-01-09 03:16:26', '2019-01-09 03:16:26', null, null, null, null, null, null, '0', '0', '0', '0', '15', '25', '25', '30', '0', '0', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('16', '509', null, '22', null, null, null, '2019-01-09 03:19:24', '2019-01-09 03:19:24', null, null, null, null, null, null, '0', '50', '0', '0', '0', '0', '50', '0', '0', '0', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('17', '509', null, '22', null, null, null, '2019-01-09 03:19:24', '2019-01-09 03:19:24', null, null, null, null, null, null, '0', '50', '0', '0', '0', '0', '50', '0', '0', '0', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('18', '509', null, '45', null, null, null, '2019-01-09 03:20:48', '2019-01-09 03:20:48', null, null, null, null, null, null, '0', '15', '80', '0', '0', '0', '0', '5', '0', '0', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('19', '509', null, '63', null, null, null, '2019-01-09 03:22:44', '2019-01-09 03:22:44', null, null, null, null, null, null, '0', '0', '0', '15', '40', '40', '0', '0', '0', '0', '5', '0');
INSERT INTO budget_tahunan_periodes VALUES ('20', '509', null, '96', null, null, null, '2019-01-09 03:24:21', '2019-01-09 03:24:21', null, null, null, null, null, null, '0', '0', '15', '30', '50', '0', '0', '0', '0', '0', '5', '0');
INSERT INTO budget_tahunan_periodes VALUES ('21', '509', null, '141', null, null, null, '2019-01-09 03:26:11', '2019-01-09 03:26:11', null, null, null, null, null, null, '0', '0', '0', '15', '80', '0', '0', '0', '0', '0', '5', '0');
INSERT INTO budget_tahunan_periodes VALUES ('22', '509', null, '171', null, null, null, '2019-01-09 03:28:08', '2019-01-09 03:28:08', null, null, null, null, null, null, '0', '0', '0', '15', '80', '0', '0', '0', '0', '0', '5', '0');
INSERT INTO budget_tahunan_periodes VALUES ('23', '509', null, '189', null, null, null, '2019-01-09 03:29:59', '2019-01-09 03:29:59', null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', null, '0', '15', '80', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('24', '509', null, '222', null, null, null, '2019-01-09 03:32:06', '2019-01-09 03:32:06', null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', '0', '0', '15', '30', '50', '0');
INSERT INTO budget_tahunan_periodes VALUES ('25', '509', null, '222', null, null, null, '2019-01-09 03:32:06', '2019-01-09 03:32:06', null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', '0', '0', '15', '30', '50', '0');
INSERT INTO budget_tahunan_periodes VALUES ('27', '513', null, '22', null, null, null, '2019-01-09 06:33:25', '2019-01-09 06:33:25', null, null, null, null, null, null, '0', '50', '50', '0', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('28', '513', null, '96', null, null, null, '2019-01-09 06:35:46', '2019-01-09 06:45:01', null, null, null, null, null, null, '0', '0', '15', '0', '35', '0', '20', '0', '25', '0', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('29', '513', null, '141', null, null, null, '2019-01-09 06:41:52', '2019-01-09 06:41:52', null, null, null, null, null, null, '0', '15', '0', '0', '35', '0', '0', '25', '0', '0', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('30', '513', null, '203', null, null, null, '2019-01-09 06:43:42', '2019-01-09 06:43:42', null, null, null, null, null, null, '0', '0', '0', '15', '0', '50', '0', '30', '0', '0', '5', '0');
INSERT INTO budget_tahunan_periodes VALUES ('31', '513', null, '215', null, null, null, '2019-01-09 06:47:53', '2019-01-09 06:47:53', null, null, null, null, null, null, '0', '15', '0', '30', '0', '0', '50', '0', '0', '0', '5', '0');
INSERT INTO budget_tahunan_periodes VALUES ('32', '513', null, '63', null, null, null, '2019-01-09 06:49:31', '2019-01-09 06:49:31', null, null, null, null, null, null, '0', '0', '15', '0', '70', '10', '0', '0', '5', '0', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('33', '513', null, '173', null, null, null, '2019-01-09 06:50:55', '2019-01-09 06:50:55', null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', '15', '0', '0', '35', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('34', '504', null, '16', null, null, null, '2019-01-09 08:13:45', '2019-01-09 08:13:45', null, null, null, null, null, null, '0', '25', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('35', '504', null, '45', null, null, null, '2019-01-09 08:15:04', '2019-01-09 08:15:04', null, null, null, null, null, null, '0', '0', '50', '45', '0', '0', '0', '0', '0', '5', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('36', '504', null, '141', null, null, null, '2019-01-09 08:16:49', '2019-01-09 08:16:49', null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '50', '0', '45');
INSERT INTO budget_tahunan_periodes VALUES ('37', '504', null, '252', null, null, null, '2019-01-09 08:18:03', '2019-01-09 08:18:03', null, null, null, null, null, null, '0', '0', '25', '25', '25', '20', '0', '0', '0', '0', '0', '5');
INSERT INTO budget_tahunan_periodes VALUES ('39', '515', null, '22', null, null, null, '2019-01-09 08:31:29', '2019-01-09 08:31:29', null, null, null, null, null, null, '0', '50', '0', '50', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('40', '515', null, '63', null, null, null, '2019-01-09 08:36:50', '2019-01-09 08:36:50', null, null, null, null, null, null, '0', '15', '0', '0', '80', '0', '0', '0', '5', '0', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('41', '515', null, '222', null, null, null, '2019-01-09 08:40:30', '2019-01-09 08:40:30', null, null, null, null, null, null, '0', '0', '0', '15', '0', '80', '0', '0', '5', '0', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('42', '516', null, '45', null, null, null, '2019-01-09 08:53:33', '2019-01-16 11:47:04', null, null, null, null, null, null, '0', '0', '0', '15', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('45', '521', null, '96', null, null, null, '2019-01-09 09:01:50', '2019-01-09 09:01:50', null, null, null, null, null, null, '0', '0', '0', '15', '0', '0', '80', '0', '0', '5', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('47', '520', null, '96', null, null, null, '2019-01-09 09:08:56', '2019-01-09 09:08:56', null, null, null, null, null, null, '0', '0', '0', '15', '0', '0', '80', '0', '0', '5', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('48', '518', null, '45', null, null, null, '2019-01-09 09:10:42', '2019-01-16 11:38:12', null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', '0', '0', '15', '0', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('49', '515', null, '96', null, null, null, '2019-01-09 09:16:42', '2019-01-09 09:16:42', null, null, null, null, null, null, '0', '15', '0', '0', '80', '0', '0', '0', '5', '0', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('51', '515', null, '141', null, null, null, '2019-01-09 09:19:10', '2019-01-09 09:19:10', null, null, null, null, null, null, '0', '0', '0', '0', '0', '0', '0', '25', '25', '25', '25', '0');
INSERT INTO budget_tahunan_periodes VALUES ('52', '519', null, '96', null, null, null, '2019-01-09 09:22:03', '2019-01-09 09:22:03', null, null, null, null, null, null, '0', '0', '0', '15', '0', '0', '80', '0', '0', '5', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('53', '514', null, '255', null, null, null, '2019-01-09 09:28:43', '2019-01-09 09:28:43', null, null, null, null, null, null, '0', '0', '0', '0', '0', '15', '0', '30', '0', '30', '0', '25');
INSERT INTO budget_tahunan_periodes VALUES ('54', '514', null, '263', null, null, null, '2019-01-09 09:31:01', '2019-01-09 09:31:01', null, null, null, null, null, null, '15', '15', '15', '15', '15', '15', '10', '0', '0', '0', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('55', '514', null, '269', null, null, null, '2019-01-09 09:33:32', '2019-01-09 09:33:32', null, null, null, null, null, null, '0', '0', '0', '0', '0', '15', '15', '15', '15', '15', '15', '10');
INSERT INTO budget_tahunan_periodes VALUES ('56', '514', null, '291', null, null, null, '2019-01-09 09:36:37', '2019-01-09 09:36:37', null, null, null, null, null, null, '8', '8', '8', '8', '8', '8', '8', '8', '8', '8', '8', '12');
INSERT INTO budget_tahunan_periodes VALUES ('58', '514', null, '453', null, null, null, '2019-01-09 09:39:59', '2019-01-09 09:39:59', null, null, null, null, null, null, '0', '25', '0', '0', '25', '0', '0', '25', '0', '0', '25', '0');
INSERT INTO budget_tahunan_periodes VALUES ('59', '514', null, '454', null, null, null, '2019-01-09 09:40:55', '2019-01-09 09:40:55', null, null, null, null, null, null, '0', '50', '0', '50', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('62', '523', null, '141', null, null, null, '2019-01-16 11:43:26', '2019-01-16 11:43:26', null, null, null, null, null, null, '0', '2', '0', '0', '4', '0', '0', '3', '0', '0', '3', '0');
INSERT INTO budget_tahunan_periodes VALUES ('63', '514', null, '468', null, null, null, '2019-01-16 12:09:30', '2019-01-16 12:09:30', null, null, null, null, null, null, '0', '0', '0', '0', '15', '0', '0', '0', '0', '50', '0', '0');
INSERT INTO budget_tahunan_periodes VALUES ('64', '523', null, '96', null, null, null, '2019-01-16 12:11:35', '2019-01-16 12:11:35', null, null, null, null, null, null, '0', '1', '0', '6', '3', '3', '4', '5', '3', '3', '0', '0');
