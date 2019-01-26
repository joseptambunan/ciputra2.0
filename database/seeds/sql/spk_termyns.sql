/*
Navicat MySQL Data Transfer

Source Server         : 117.53.46.38
Source Server Version : 50561
Source Host           : 117.53.46.38:3306
Source Database       : zadmin_qs

Target Server Type    : MYSQL
Target Server Version : 50561
File Encoding         : 65001

Date: 2019-01-25 18:25:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for spk_termyns
-- ----------------------------
DROP TABLE IF EXISTS `spk_termyns`;
CREATE TABLE `spk_termyns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `spk_id` int(11) DEFAULT NULL,
  `termin` int(11) DEFAULT NULL,
  `progress` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `spk_termyns_spk_id_index` (`spk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of spk_termyns
-- ----------------------------
INSERT INTO `spk_termyns` VALUES ('1', '2361', '0', '0.00', '2019-01-17 09:08:46', '2019-01-17 09:08:46', null, null, null, null, null, null, '1');
INSERT INTO `spk_termyns` VALUES ('2', '2361', '1', '0.00', '2019-01-17 09:08:46', '2019-01-17 09:08:46', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('3', '2361', '2', '11.00', '2019-01-17 09:08:46', '2019-01-17 09:08:46', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('4', '2361', '3', '39.00', '2019-01-17 09:08:46', '2019-01-17 09:08:46', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('5', '2361', '4', '11.00', '2019-01-17 09:08:46', '2019-01-17 09:08:46', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('6', '2361', '5', '39.00', '2019-01-17 09:08:46', '2019-01-17 09:08:46', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('7', '2361', '6', '0.00', '2019-01-17 09:08:46', '2019-01-17 09:08:46', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('8', '2361', '7', '0.00', '2019-01-17 09:08:46', '2019-01-17 09:08:46', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('9', '2361', '8', '0.00', '2019-01-17 09:08:46', '2019-01-17 09:08:46', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('10', '2361', '9', '0.00', '2019-01-17 09:08:46', '2019-01-17 09:08:46', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('11', '2361', '10', '0.00', '2019-01-17 09:08:46', '2019-01-17 09:08:46', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('12', '2362', '0', '0.00', '2019-01-17 09:19:53', '2019-01-17 09:19:53', null, null, null, null, null, null, '1');
INSERT INTO `spk_termyns` VALUES ('13', '2362', '1', '0.00', '2019-01-17 09:19:53', '2019-01-17 09:19:53', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('14', '2362', '2', '11.00', '2019-01-17 09:19:53', '2019-01-17 09:19:53', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('15', '2362', '3', '39.00', '2019-01-17 09:19:53', '2019-01-17 09:19:53', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('16', '2362', '4', '11.00', '2019-01-17 09:19:53', '2019-01-17 09:19:53', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('17', '2362', '5', '39.00', '2019-01-17 09:19:53', '2019-01-17 09:19:53', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('18', '2362', '6', '0.00', '2019-01-17 09:19:53', '2019-01-17 09:19:53', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('19', '2362', '7', '0.00', '2019-01-17 09:19:53', '2019-01-17 09:19:53', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('20', '2362', '8', '0.00', '2019-01-17 09:19:53', '2019-01-17 09:19:53', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('21', '2362', '9', '0.00', '2019-01-17 09:19:53', '2019-01-17 09:19:53', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('22', '2362', '10', '0.00', '2019-01-17 09:19:53', '2019-01-17 09:19:53', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('23', '2364', '0', '0.00', '2019-01-17 09:51:02', '2019-01-17 09:51:02', null, null, null, null, null, null, '1');
INSERT INTO `spk_termyns` VALUES ('24', '2364', '1', '0.00', '2019-01-17 09:51:02', '2019-01-17 09:51:02', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('25', '2364', '2', '11.00', '2019-01-17 09:51:02', '2019-01-17 09:51:02', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('26', '2364', '3', '39.00', '2019-01-17 09:51:02', '2019-01-17 09:51:02', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('27', '2364', '4', '11.00', '2019-01-17 09:51:02', '2019-01-17 09:51:02', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('28', '2364', '5', '39.00', '2019-01-17 09:51:02', '2019-01-17 09:51:02', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('29', '2364', '6', '0.00', '2019-01-17 09:51:02', '2019-01-17 09:51:02', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('30', '2364', '7', '0.00', '2019-01-17 09:51:02', '2019-01-17 09:51:02', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('31', '2364', '8', '0.00', '2019-01-17 09:51:02', '2019-01-17 09:51:02', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('32', '2364', '9', '0.00', '2019-01-17 09:51:02', '2019-01-17 09:51:02', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('33', '2364', '10', '0.00', '2019-01-17 09:51:02', '2019-01-17 09:51:02', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('34', '2363', '0', '0.00', '2019-01-17 09:55:14', '2019-01-17 10:04:14', null, null, null, null, null, null, '3');
INSERT INTO `spk_termyns` VALUES ('35', '2363', '1', '0.00', '2019-01-17 09:55:14', '2019-01-17 10:04:14', null, null, null, null, null, null, '3');
INSERT INTO `spk_termyns` VALUES ('36', '2363', '2', '25.00', '2019-01-17 09:55:14', '2019-01-17 10:04:14', null, null, null, null, null, null, '3');
INSERT INTO `spk_termyns` VALUES ('37', '2363', '3', '25.00', '2019-01-17 09:55:14', '2019-01-17 09:55:14', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('38', '2363', '4', '25.00', '2019-01-17 09:55:14', '2019-01-17 09:55:14', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('39', '2363', '5', '25.00', '2019-01-17 09:55:14', '2019-01-17 09:55:14', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('40', '2363', '6', '0.00', '2019-01-17 09:55:14', '2019-01-17 09:55:14', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('41', '2363', '7', '0.00', '2019-01-17 09:55:14', '2019-01-17 09:55:14', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('42', '2363', '8', '0.00', '2019-01-17 09:55:14', '2019-01-17 09:55:14', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('43', '2363', '9', '0.00', '2019-01-17 09:55:14', '2019-01-17 09:55:14', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('44', '2363', '10', '0.00', '2019-01-17 09:55:14', '2019-01-17 09:55:14', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('56', '2365', '0', '0.00', '2019-01-17 10:09:04', '2019-01-17 11:31:42', null, null, null, null, null, null, '3');
INSERT INTO `spk_termyns` VALUES ('57', '2365', '1', '0.00', '2019-01-17 10:09:04', '2019-01-17 11:31:42', null, null, null, null, null, null, '3');
INSERT INTO `spk_termyns` VALUES ('58', '2365', '2', '11.00', '2019-01-17 10:09:04', '2019-01-17 11:31:42', null, null, null, null, null, null, '3');
INSERT INTO `spk_termyns` VALUES ('59', '2365', '3', '39.00', '2019-01-17 10:09:04', '2019-01-17 10:09:04', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('60', '2365', '4', '11.00', '2019-01-17 10:09:04', '2019-01-17 10:09:04', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('61', '2365', '5', '39.00', '2019-01-17 10:09:04', '2019-01-17 10:09:04', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('62', '2365', '6', '0.00', '2019-01-17 10:09:04', '2019-01-17 10:09:04', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('63', '2365', '7', '0.00', '2019-01-17 10:09:04', '2019-01-17 10:09:04', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('64', '2365', '8', '0.00', '2019-01-17 10:09:04', '2019-01-17 10:09:04', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('65', '2365', '9', '0.00', '2019-01-17 10:09:04', '2019-01-17 10:09:04', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('66', '2365', '10', '0.00', '2019-01-17 10:09:04', '2019-01-17 10:09:04', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('67', '1894', '0', '0.00', '2019-01-18 03:53:54', '2019-01-18 03:53:54', null, null, null, null, null, null, '1');
INSERT INTO `spk_termyns` VALUES ('68', '1894', '1', '15.00', '2019-01-18 03:53:54', '2019-01-18 03:53:54', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('69', '1894', '2', '20.00', '2019-01-18 03:53:54', '2019-01-18 03:53:54', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('70', '1894', '3', '20.00', '2019-01-18 03:53:54', '2019-01-18 03:53:54', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('71', '1894', '4', '23.00', '2019-01-18 03:53:54', '2019-01-18 03:53:54', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('72', '1894', '5', '17.00', '2019-01-18 03:53:54', '2019-01-18 03:53:54', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('73', '1894', '6', '0.00', '2019-01-18 03:53:54', '2019-01-18 03:53:54', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('74', '1894', '7', '0.00', '2019-01-18 03:53:54', '2019-01-18 03:53:54', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('75', '1894', '8', '5.00', '2019-01-18 03:53:54', '2019-01-18 03:53:54', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('76', '1894', '9', '0.00', '2019-01-18 03:53:54', '2019-01-18 03:53:54', null, null, null, null, null, null, '0');
INSERT INTO `spk_termyns` VALUES ('77', '1894', '10', '0.00', '2019-01-18 03:53:54', '2019-01-18 03:53:54', null, null, null, null, null, null, '0');
