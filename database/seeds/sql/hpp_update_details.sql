/*
Navicat MySQL Data Transfer

Source Server         : 117.53.46.38
Source Server Version : 50561
Source Host           : 117.53.46.38:3306
Source Database       : zadmin_qs

Target Server Type    : MYSQL
Target Server Version : 50561
File Encoding         : 65001

Date: 2019-01-24 07:36:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for hpp_update_details
-- ----------------------------
DROP TABLE IF EXISTS hpp_update_details;
CREATE TABLE hpp_update_details (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hpp_update_id` int(11) DEFAULT NULL,
  `budget_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hpp_update_id` (`hpp_update_id`),
  KEY `budget_id` (`budget_id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of hpp_update_details
-- ----------------------------
INSERT INTO hpp_update_details VALUES ('1', '1', '31', '2018-12-20 09:32:10', '2018-12-20 09:32:10', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('2', '1', '32', '2018-12-20 09:32:10', '2018-12-20 09:32:10', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('3', '1', '34', '2018-12-20 09:32:10', '2018-12-20 09:32:10', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('4', '2', '31', '2018-12-21 03:20:10', '2018-12-21 03:20:10', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('5', '2', '32', '2018-12-21 03:20:10', '2018-12-21 03:20:10', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('6', '2', '36', '2018-12-21 03:20:10', '2018-12-21 03:20:10', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('7', '3', '31', '2018-12-21 03:49:59', '2018-12-21 03:49:59', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('8', '3', '32', '2018-12-21 03:49:59', '2018-12-21 03:49:59', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('9', '3', '37', '2018-12-21 03:49:59', '2018-12-21 03:49:59', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('10', '4', '39', '2018-12-28 03:35:23', '2018-12-28 03:35:23', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('11', '4', '40', '2018-12-28 03:35:23', '2018-12-28 03:35:23', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('12', '4', '41', '2018-12-28 03:35:23', '2018-12-28 03:35:23', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('13', '4', '43', '2018-12-28 03:35:23', '2018-12-28 03:35:23', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('14', '4', '45', '2018-12-28 03:35:23', '2018-12-28 03:35:23', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('15', '5', '50', '2019-01-11 07:50:12', '2019-01-11 07:50:12', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('16', '5', '52', '2019-01-11 07:50:12', '2019-01-11 07:50:12', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('17', '5', '74', '2019-01-11 07:50:12', '2019-01-11 07:50:12', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('18', '5', '87', '2019-01-11 07:50:12', '2019-01-11 07:50:12', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('19', '5', '97', '2019-01-11 07:50:12', '2019-01-11 07:50:12', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('20', '5', '98', '2019-01-11 07:50:12', '2019-01-11 07:50:12', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('21', '5', '114', '2019-01-11 07:50:12', '2019-01-11 07:50:12', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('22', '6', '82', '2019-01-15 03:57:27', '2019-01-15 03:57:27', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('23', '6', '104', '2019-01-15 03:57:27', '2019-01-15 03:57:27', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('24', '6', '106', '2019-01-15 03:57:27', '2019-01-15 03:57:27', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('25', '6', '107', '2019-01-15 03:57:27', '2019-01-15 03:57:27', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('26', '6', '108', '2019-01-15 03:57:27', '2019-01-15 03:57:27', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('27', '6', '110', '2019-01-15 03:57:27', '2019-01-15 03:57:27', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('28', '6', '111', '2019-01-15 03:57:27', '2019-01-15 03:57:27', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('29', '6', '112', '2019-01-15 03:57:27', '2019-01-15 03:57:27', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('30', '6', '113', '2019-01-15 03:57:27', '2019-01-15 03:57:27', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('31', '6', '115', '2019-01-15 03:57:27', '2019-01-15 03:57:27', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('32', '7', '82', '2019-01-15 04:01:29', '2019-01-15 04:01:29', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('33', '7', '104', '2019-01-15 04:01:29', '2019-01-15 04:01:29', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('34', '7', '106', '2019-01-15 04:01:29', '2019-01-15 04:01:29', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('35', '7', '107', '2019-01-15 04:01:29', '2019-01-15 04:01:29', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('36', '7', '108', '2019-01-15 04:01:29', '2019-01-15 04:01:29', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('37', '7', '110', '2019-01-15 04:01:29', '2019-01-15 04:01:29', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('38', '7', '111', '2019-01-15 04:01:29', '2019-01-15 04:01:29', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('39', '7', '112', '2019-01-15 04:01:29', '2019-01-15 04:01:29', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('40', '7', '113', '2019-01-15 04:01:29', '2019-01-15 04:01:29', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('41', '7', '115', '2019-01-15 04:01:29', '2019-01-15 04:01:29', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('42', '9', '50', '2019-01-17 08:05:27', '2019-01-17 08:05:27', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('43', '9', '52', '2019-01-17 08:05:27', '2019-01-17 08:05:27', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('44', '9', '74', '2019-01-17 08:05:27', '2019-01-17 08:05:27', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('45', '9', '87', '2019-01-17 08:05:27', '2019-01-17 08:05:27', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('46', '9', '97', '2019-01-17 08:05:27', '2019-01-17 08:05:27', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('47', '9', '98', '2019-01-17 08:05:27', '2019-01-17 08:05:27', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('48', '9', '114', '2019-01-17 08:05:27', '2019-01-17 08:05:27', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('49', '10', '50', '2019-01-18 03:01:28', '2019-01-18 03:01:28', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('50', '10', '52', '2019-01-18 03:01:28', '2019-01-18 03:01:28', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('51', '10', '74', '2019-01-18 03:01:28', '2019-01-18 03:01:28', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('52', '10', '87', '2019-01-18 03:01:28', '2019-01-18 03:01:28', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('53', '10', '97', '2019-01-18 03:01:28', '2019-01-18 03:01:28', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('54', '10', '98', '2019-01-18 03:01:28', '2019-01-18 03:01:28', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('55', '10', '114', '2019-01-18 03:01:28', '2019-01-18 03:01:28', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('56', '10', '117', '2019-01-18 03:01:28', '2019-01-18 03:01:28', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('57', '11', '50', '2019-01-18 03:24:41', '2019-01-18 03:24:41', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('58', '11', '52', '2019-01-18 03:24:41', '2019-01-18 03:24:41', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('59', '11', '74', '2019-01-18 03:24:41', '2019-01-18 03:24:41', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('60', '11', '87', '2019-01-18 03:24:41', '2019-01-18 03:24:41', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('61', '11', '97', '2019-01-18 03:24:41', '2019-01-18 03:24:41', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('62', '11', '98', '2019-01-18 03:24:41', '2019-01-18 03:24:41', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('63', '11', '114', '2019-01-18 03:24:41', '2019-01-18 03:24:41', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('64', '11', '117', '2019-01-18 03:24:41', '2019-01-18 03:24:41', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('65', '12', '50', '2019-01-21 03:51:21', '2019-01-21 03:51:21', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('66', '12', '52', '2019-01-21 03:51:21', '2019-01-21 03:51:21', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('67', '12', '74', '2019-01-21 03:51:21', '2019-01-21 03:51:21', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('68', '12', '87', '2019-01-21 03:51:21', '2019-01-21 03:51:21', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('69', '12', '97', '2019-01-21 03:51:21', '2019-01-21 03:51:21', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('70', '12', '98', '2019-01-21 03:51:21', '2019-01-21 03:51:21', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('71', '12', '114', '2019-01-21 03:51:21', '2019-01-21 03:51:21', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('72', '12', '117', '2019-01-21 03:51:21', '2019-01-21 03:51:21', '1', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('73', '13', '24', '2019-01-23 07:37:01', '2019-01-23 07:37:01', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('74', '13', '27', '2019-01-23 07:37:01', '2019-01-23 07:37:01', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('75', '13', '28', '2019-01-23 07:37:01', '2019-01-23 07:37:01', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('76', '13', '33', '2019-01-23 07:37:01', '2019-01-23 07:37:01', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('77', '13', '116', '2019-01-23 07:37:01', '2019-01-23 07:37:01', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('78', '13', '118', '2019-01-23 07:37:01', '2019-01-23 07:37:01', '24', null, null, null, null, null);
INSERT INTO hpp_update_details VALUES ('79', '13', '119', '2019-01-23 07:37:01', '2019-01-23 07:37:01', '24', null, null, null, null, null);
