/*
Navicat MySQL Data Transfer

Source Server         : 117.53.46.38
Source Server Version : 50561
Source Host           : 117.53.46.38:3306
Source Database       : zadmin_qs

Target Server Type    : MYSQL
Target Server Version : 50561
File Encoding         : 65001

Date: 2019-01-24 07:33:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for budget_tahunan_unit_periodes
-- ----------------------------
DROP TABLE IF EXISTS budget_tahunan_unit_periodes;
CREATE TABLE budget_tahunan_unit_periodes (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `budget_tahunan_unit_id` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
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
  KEY `budget_tahunan_unit_periodes_budget_tahunan_unit_id_index` (`budget_tahunan_unit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of budget_tahunan_unit_periodes
-- ----------------------------
INSERT INTO budget_tahunan_unit_periodes VALUES ('1', '1', null, '44', null, null, null, null, '2018-12-26 09:57:48', '2018-12-26 09:57:48', '0', null, '1', '0', '0', '0', '0', '1', '1', '0', '0', '1');
INSERT INTO budget_tahunan_unit_periodes VALUES ('2', '2', null, '44', null, null, null, null, '2018-12-26 09:57:48', '2018-12-26 09:57:48', '0', null, '17', '2', '2', '0', '1', '1', '0', '2', '2', '1');
INSERT INTO budget_tahunan_unit_periodes VALUES ('3', '3', null, '44', null, null, null, null, '2018-12-26 09:57:48', '2018-12-26 09:57:48', '0', null, '7', '1', '2', '0', '0', '1', '0', '0', '2', '2');
INSERT INTO budget_tahunan_unit_periodes VALUES ('4', '4', null, '44', null, null, null, null, '2018-12-26 09:57:48', '2018-12-26 09:57:48', '0', null, '2', '0', '0', '2', '0', '0', '0', '0', '2', '1');
INSERT INTO budget_tahunan_unit_periodes VALUES ('5', '5', null, '44', null, null, null, null, '2018-12-26 09:57:48', '2018-12-26 09:57:48', '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO budget_tahunan_unit_periodes VALUES ('6', '6', null, '44', null, null, null, null, '2018-12-26 09:57:48', '2018-12-26 09:57:48', '0', null, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO budget_tahunan_unit_periodes VALUES ('7', '7', null, '44', null, null, null, null, '2018-12-27 06:22:16', '2018-12-27 06:22:16', '0', null, '0', '1', '0', '0', '0', '0', '0', '0', '1', '0');
INSERT INTO budget_tahunan_unit_periodes VALUES ('8', '8', null, '44', null, null, null, null, '2018-12-27 06:22:16', '2018-12-27 06:22:16', '0', null, '1', '0', '0', '0', '1', '0', '0', '1', '0', '0');
INSERT INTO budget_tahunan_unit_periodes VALUES ('9', '9', null, '44', null, null, null, null, '2018-12-28 04:11:02', '2018-12-28 04:11:02', '0', null, '0', '0', '1', '0', '0', '1', '1', '0', '0', '0');
INSERT INTO budget_tahunan_unit_periodes VALUES ('10', '10', null, '44', null, null, null, null, '2018-12-28 04:11:02', '2018-12-28 04:11:02', '0', null, '0', '0', '0', '0', '2', '0', '0', '0', '0', '0');
INSERT INTO budget_tahunan_unit_periodes VALUES ('11', '11', null, '44', null, null, null, null, '2019-01-08 08:48:05', '2019-01-08 08:48:05', '0', null, '0', '1', '0', '0', '0', '0', '0', '0', '1', '0');
INSERT INTO budget_tahunan_unit_periodes VALUES ('12', '12', null, '44', null, null, null, null, '2019-01-08 08:48:05', '2019-01-08 08:48:05', '0', null, '1', '0', '0', '0', '1', '0', '0', '1', '0', '0');
INSERT INTO budget_tahunan_unit_periodes VALUES ('13', '13', null, '44', null, null, null, null, '2019-01-08 11:40:28', '2019-01-08 11:40:28', '0', null, '0', '1', '0', '1', '0', '0', '0', '0', '1', '1');
INSERT INTO budget_tahunan_unit_periodes VALUES ('14', '14', null, '44', null, null, null, null, '2019-01-08 11:49:44', '2019-01-08 11:49:44', '0', null, '0', '1', '0', '1', '0', '0', '0', '0', '2', '1');
INSERT INTO budget_tahunan_unit_periodes VALUES ('15', '15', null, '44', null, null, null, null, '2019-01-08 11:49:44', '2019-01-08 11:49:44', '0', null, '0', '0', '1', '0', '0', '0', '0', '0', '0', '1');
INSERT INTO budget_tahunan_unit_periodes VALUES ('16', '16', null, '44', null, null, null, null, '2019-01-08 11:49:44', '2019-01-08 11:49:44', '0', null, '0', '1', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO budget_tahunan_unit_periodes VALUES ('17', '17', null, '44', null, null, null, null, '2019-01-09 04:42:43', '2019-01-09 04:42:43', '0', null, '0', '0', '2', '2', '0', '0', '3', '0', '0', '0');
INSERT INTO budget_tahunan_unit_periodes VALUES ('18', '21', null, '9999', null, null, null, null, '2019-01-16 12:07:28', '2019-01-16 12:07:28', '21', '4', '2', '1', '1', '0', '1', '2', '1', '1', '0', '0');
INSERT INTO budget_tahunan_unit_periodes VALUES ('19', '22', null, '9999', null, null, null, null, '2019-01-16 12:07:28', '2019-01-16 12:07:28', '5', '1', '0', '1', '0', '0', '3', '2', '1', '2', '0', '0');
INSERT INTO budget_tahunan_unit_periodes VALUES ('20', '23', null, '9999', null, null, null, null, '2019-01-16 12:07:28', '2019-01-16 12:07:28', '34', '1', '2', '2', '1', '0', '3', '0', '1', '2', '0', '0');
INSERT INTO budget_tahunan_unit_periodes VALUES ('21', '24', null, '9999', null, null, null, null, '2019-01-16 12:07:28', '2019-01-16 12:07:28', '3', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO budget_tahunan_unit_periodes VALUES ('22', '25', null, '9999', null, null, null, null, '2019-01-16 12:07:28', '2019-01-16 12:07:28', '3', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
INSERT INTO budget_tahunan_unit_periodes VALUES ('23', '26', null, '9999', null, null, null, null, '2019-01-16 12:07:28', '2019-01-16 12:07:28', '8', '1', '0', '2', '1', '0', '0', '0', '1', '0', '0', '0');
INSERT INTO budget_tahunan_unit_periodes VALUES ('24', '27', null, '9999', null, null, null, null, '2019-01-16 12:07:28', '2019-01-16 12:07:28', '22', '0', '1', '1', '1', '0', '1', '2', '1', '2', '0', '0');
INSERT INTO budget_tahunan_unit_periodes VALUES ('25', '28', null, '1', '1', null, null, null, '2019-01-21 00:00:00', '2019-01-21 00:00:00', null, null, '1', null, '1', null, null, null, null, null, null, null);
INSERT INTO budget_tahunan_unit_periodes VALUES ('26', '29', null, '1', '1', null, null, null, '2019-01-22 00:00:00', '2019-01-22 00:00:00', null, null, null, null, null, null, null, null, null, '1', null, null);
INSERT INTO budget_tahunan_unit_periodes VALUES ('27', '30', null, '1', '1', null, null, null, '2019-01-22 00:00:00', '2019-01-22 00:00:00', null, null, null, null, null, null, null, null, null, '1', null, null);
