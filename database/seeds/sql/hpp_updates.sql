/*
Navicat MySQL Data Transfer

Source Server         : 117.53.46.38
Source Server Version : 50561
Source Host           : 117.53.46.38:3306
Source Database       : zadmin_qs

Target Server Type    : MYSQL
Target Server Version : 50561
File Encoding         : 65001

Date: 2019-01-24 07:36:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for hpp_updates
-- ----------------------------
DROP TABLE IF EXISTS `hpp_updates`;
CREATE TABLE `hpp_updates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `pt_id` int(11) DEFAULT NULL,
  `nilai_budget` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `luas_book` decimal(15,2) DEFAULT NULL,
  `luas_erem` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `netto` int(11) DEFAULT NULL,
  `hpp_book` decimal(11,2) DEFAULT NULL,
  `luas_book_before` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `pt_id` (`pt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of hpp_updates
-- ----------------------------
INSERT INTO `hpp_updates` VALUES ('1', '3', null, '30679983290', '0.00', null, '2018-12-20 09:32:10', '2018-12-20 09:32:10', '24', null, null, null, null, null, '27241', '1126242.91', null);
INSERT INTO `hpp_updates` VALUES ('2', '3', null, '39635622690', '0.00', null, '2018-12-21 03:20:10', '2018-12-21 03:20:10', '24', null, null, null, null, null, '27241', '1454998.81', '1126242.91');
INSERT INTO `hpp_updates` VALUES ('3', '3', null, '29797871290', '0.00', null, '2018-12-21 03:49:59', '2018-12-21 03:49:59', '24', null, null, null, null, null, '27241', '1093861.14', '1454998.81');
INSERT INTO `hpp_updates` VALUES ('4', '1', null, '78635665683', '141584.00', null, '2018-12-28 03:35:23', '2018-12-28 03:35:23', '24', null, null, null, null, null, null, null, null);
INSERT INTO `hpp_updates` VALUES ('5', '3', null, '22899399624', '0.00', null, '2019-01-11 07:50:12', '2019-01-11 07:50:12', '24', null, null, null, null, null, null, null, null);
INSERT INTO `hpp_updates` VALUES ('6', '60', null, '191615209829.0', '0.00', '0.00', '2019-01-15 03:57:27', '2019-01-15 03:57:27', '1', null, null, null, null, null, '186849', null, null);
INSERT INTO `hpp_updates` VALUES ('7', '60', null, '204201093335', '0.00', '0.00', '2019-01-15 04:01:29', '2019-01-15 04:01:29', '1', null, null, null, null, null, '186849', null, null);
INSERT INTO `hpp_updates` VALUES ('8', '60', null, '204201093335', '0.00', '0.00', '2019-01-15 04:08:11', '2019-01-15 04:08:11', null, null, null, null, null, null, '186849', '1092865.18', null);
INSERT INTO `hpp_updates` VALUES ('9', '3', null, '60535272241', '0.00', null, '2019-01-17 08:05:27', '2019-01-17 08:05:27', '24', null, null, null, null, null, null, null, null);
INSERT INTO `hpp_updates` VALUES ('10', '3', null, '60535272241', '0.00', null, '2019-01-18 03:01:27', '2019-01-18 03:01:27', '1', null, null, null, null, null, '84982', null, null);
INSERT INTO `hpp_updates` VALUES ('11', '3', null, '60535272241', '0.00', null, '2019-01-18 03:24:41', '2019-01-18 03:24:41', '1', null, null, null, null, null, '90510', null, null);
INSERT INTO `hpp_updates` VALUES ('12', '3', null, '67547077915', '0.00', null, '2019-01-21 03:51:21', '2019-01-21 03:51:21', '1', null, null, null, null, null, '90510', null, null);
INSERT INTO `hpp_updates` VALUES ('13', '9', null, '8410000000', '62.00', null, '2019-01-23 07:37:01', '2019-01-23 07:37:01', '24', null, null, null, null, null, null, null, null);
