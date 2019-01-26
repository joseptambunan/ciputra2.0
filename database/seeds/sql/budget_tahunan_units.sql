/*
Navicat MySQL Data Transfer

Source Server         : 117.53.46.38
Source Server Version : 50561
Source Host           : 117.53.46.38:3306
Source Database       : zadmin_qs

Target Server Type    : MYSQL
Target Server Version : 50561
File Encoding         : 65001

Date: 2019-01-25 19:14:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for budget_tahunan_units
-- ----------------------------
DROP TABLE IF EXISTS `budget_tahunan_units`;
CREATE TABLE `budget_tahunan_units` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `budget_tahunan_id` int(11) DEFAULT NULL,
  `unit_type_id` int(11) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `total_unit` int(11) DEFAULT NULL,
  `satuan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `harga_satuan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `budget_tahunan_units_budget_tahunan_id_index` (`budget_tahunan_id`),
  KEY `budget_tahunan_units_unit_type_id_index` (`unit_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of budget_tahunan_units
-- ----------------------------
INSERT INTO `budget_tahunan_units` VALUES ('1', '504', '4', '404', '4', 'm2', null, '44', null, null, null, null, '2018-12-26 09:57:48', '2018-12-26 09:57:48', '4300000');
INSERT INTO `budget_tahunan_units` VALUES ('2', '504', '5', '1676', '28', 'm2', null, '44', null, null, null, null, '2018-12-26 09:57:48', '2018-12-26 09:57:48', '4300000');
INSERT INTO `budget_tahunan_units` VALUES ('3', '504', '6', '795', '15', 'm2', null, '44', null, null, null, null, '2018-12-26 09:57:48', '2018-12-26 09:57:48', '4300000');
INSERT INTO `budget_tahunan_units` VALUES ('4', '504', '7', '497', '7', 'm2', null, '44', null, null, null, null, '2018-12-26 09:57:48', '2018-12-26 09:57:48', '4300000');
INSERT INTO `budget_tahunan_units` VALUES ('5', '504', '8', '0', '0', 'm2', null, '44', null, null, null, null, '2018-12-26 09:57:48', '2018-12-26 09:57:48', '4300000');
INSERT INTO `budget_tahunan_units` VALUES ('6', '504', '9', '0', '0', 'm2', null, '44', null, null, null, null, '2018-12-26 09:57:48', '2018-12-26 09:57:48', '4300000');
INSERT INTO `budget_tahunan_units` VALUES ('9', '506', '69', '288', '3', 'm2', null, '44', null, null, null, null, '2018-12-28 04:11:02', '2018-12-28 04:11:02', '4400000');
INSERT INTO `budget_tahunan_units` VALUES ('10', '506', '70', '136', '2', 'm2', null, '44', null, null, null, null, '2018-12-28 04:11:02', '2018-12-28 04:11:02', '4400000');
INSERT INTO `budget_tahunan_units` VALUES ('11', '505', '10', '382', '2', 'm2', null, '44', null, null, null, null, '2019-01-08 08:48:05', '2019-01-08 08:48:05', '4300000');
INSERT INTO `budget_tahunan_units` VALUES ('12', '505', '11', '297', '3', 'm2', null, '44', null, null, null, null, '2019-01-08 08:48:05', '2019-01-08 08:48:05', '4300000');
INSERT INTO `budget_tahunan_units` VALUES ('14', '501', '66', '284', '5', 'm2', null, '44', null, null, null, null, '2019-01-08 11:49:44', '2019-01-08 11:49:44', '4300000');
INSERT INTO `budget_tahunan_units` VALUES ('15', '501', '67', '382', '2', 'm2', null, '44', null, null, null, null, '2019-01-08 11:49:44', '2019-01-08 11:49:44', '4300000');
INSERT INTO `budget_tahunan_units` VALUES ('16', '501', '68', '69', '1', 'm2', null, '44', null, null, null, null, '2019-01-08 11:49:44', '2019-01-08 11:49:44', '4300000');
INSERT INTO `budget_tahunan_units` VALUES ('17', '509', '260', '567', '7', 'm2', null, '44', null, null, null, null, '2019-01-09 04:42:43', '2019-01-09 04:42:43', '2500000');
INSERT INTO `budget_tahunan_units` VALUES ('18', '515', '268', '2142', '34', 'm2', null, '9999', null, null, null, null, '2019-01-16 12:01:36', '2019-01-16 12:01:36', '4250000');
INSERT INTO `budget_tahunan_units` VALUES ('19', '515', '268', '2142', '34', 'm2', null, '9999', null, null, null, null, '2019-01-16 12:04:08', '2019-01-16 12:04:08', '4250000');
INSERT INTO `budget_tahunan_units` VALUES ('20', '515', '268', '2142', '34', 'm2', null, '9999', null, null, null, null, '2019-01-16 12:06:13', '2019-01-16 12:06:13', '4250000');
INSERT INTO `budget_tahunan_units` VALUES ('21', '515', '268', '2142', '34', 'm2', null, '9999', null, null, null, null, '2019-01-16 12:07:28', '2019-01-16 12:07:28', '4250000');
INSERT INTO `budget_tahunan_units` VALUES ('22', '515', '269', '945', '15', 'm2', null, '9999', null, null, null, null, '2019-01-16 12:07:28', '2019-01-16 12:07:28', '4100000');
INSERT INTO `budget_tahunan_units` VALUES ('23', '515', '270', '2898', '46', 'm2', null, '9999', null, null, null, null, '2019-01-16 12:07:28', '2019-01-16 12:07:28', '4320000');
INSERT INTO `budget_tahunan_units` VALUES ('24', '515', '271', '252', '4', 'm2', null, '9999', null, null, null, null, '2019-01-16 12:07:28', '2019-01-16 12:07:28', '4320000');
INSERT INTO `budget_tahunan_units` VALUES ('25', '515', '275', '189', '3', 'm2', null, '9999', null, null, null, null, '2019-01-16 12:07:28', '2019-01-16 12:07:28', '4340000');
INSERT INTO `budget_tahunan_units` VALUES ('26', '515', '278', '1118', '13', 'm2', null, '9999', null, null, null, null, '2019-01-16 12:07:28', '2019-01-16 12:07:28', '4330000');
INSERT INTO `budget_tahunan_units` VALUES ('27', '515', '277', '2666', '31', 'm2', null, '9999', null, null, null, null, '2019-01-16 12:07:28', '2019-01-16 12:07:28', '4200000');
INSERT INTO `budget_tahunan_units` VALUES ('28', '507', '71', '128', '2', 'm2', '4400000', '1', '1', '1', null, null, '2019-01-21 00:00:00', '2019-01-21 00:00:00', '4400000');
INSERT INTO `budget_tahunan_units` VALUES ('29', '501', '63', '99', '1', 'm2', '4400000', '1', '1', null, null, null, '2019-01-22 00:00:00', '2019-01-22 00:00:00', '4400000');
INSERT INTO `budget_tahunan_units` VALUES ('30', '501', '65', '116', '1', 'm2', '4400000', '1', '1', null, null, null, '2019-01-22 00:00:00', '2019-01-22 00:00:00', '4400000');
