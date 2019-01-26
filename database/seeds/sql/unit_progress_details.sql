/*
Navicat MySQL Data Transfer

Source Server         : 117.53.46.38
Source Server Version : 50561
Source Host           : 117.53.46.38:3306
Source Database       : zadmin_qs

Target Server Type    : MYSQL
Target Server Version : 50561
File Encoding         : 65001

Date: 2019-01-25 19:27:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for unit_progress_details
-- ----------------------------
DROP TABLE IF EXISTS `unit_progress_details`;
CREATE TABLE `unit_progress_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unit_progress_id` int(11) DEFAULT NULL,
  `pic_rekanan` int(11) DEFAULT NULL,
  `pic_internal` int(11) DEFAULT NULL,
  `progress_date` date DEFAULT NULL,
  `progress_percent` decimal(5,2) DEFAULT NULL,
  `setuju_rekanan_at` datetime DEFAULT NULL,
  `setuju_internal_at` datetime DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `unit_progress_details_unit_progress_id_index` (`unit_progress_id`),
  KEY `unit_progress_details_pic_rekanan_index` (`pic_rekanan`),
  KEY `unit_progress_details_pic_internal_index` (`pic_internal`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of unit_progress_details
-- ----------------------------
INSERT INTO `unit_progress_details` VALUES ('1', '2032', null, null, '2019-01-17', '0.31', null, null, null, '2019-01-17 09:59:01', '2019-01-17 09:59:01', null, '30', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('2', '2026', null, null, '2019-01-17', '0.00', null, null, null, '2019-01-17 11:28:28', '2019-01-17 11:28:28', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('3', '2027', null, null, '2019-01-17', '0.00', null, null, null, '2019-01-17 11:28:28', '2019-01-17 11:28:28', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('4', '2028', null, null, '2019-01-17', '0.00', null, null, null, '2019-01-17 11:28:28', '2019-01-17 11:28:28', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('5', '2029', null, null, '2019-01-17', '0.00', null, null, null, '2019-01-17 11:28:28', '2019-01-17 11:28:28', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('6', '2030', null, null, '2019-01-17', '0.00', null, null, null, '2019-01-17 11:28:28', '2019-01-17 11:28:28', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('7', '2031', null, null, '2019-01-17', '0.00', null, null, null, '2019-01-17 11:28:28', '2019-01-17 11:28:28', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('8', '2033', null, null, '2019-01-17', '0.00', null, null, null, '2019-01-17 11:28:28', '2019-01-17 11:28:28', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('9', '2034', null, null, '2019-01-17', '0.00', null, null, null, '2019-01-17 11:28:28', '2019-01-17 11:28:28', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('10', '2035', null, null, '2019-01-17', '0.50', null, null, null, '2019-01-17 11:28:28', '2019-01-17 11:28:28', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('11', '2036', null, null, '2019-01-17', '0.00', null, null, null, '2019-01-17 11:28:28', '2019-01-17 11:28:28', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('12', '2026', null, null, '2019-01-17', '0.00', null, null, null, '2019-01-17 11:29:11', '2019-01-17 11:29:11', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('13', '2027', null, null, '2019-01-17', '0.00', null, null, null, '2019-01-17 11:29:11', '2019-01-17 11:29:11', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('14', '2028', null, null, '2019-01-17', '0.00', null, null, null, '2019-01-17 11:29:11', '2019-01-17 11:29:11', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('15', '2029', null, null, '2019-01-17', '0.00', null, null, null, '2019-01-17 11:29:11', '2019-01-17 11:29:11', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('16', '2030', null, null, '2019-01-17', '0.00', null, null, null, '2019-01-17 11:29:11', '2019-01-17 11:29:11', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('17', '2031', null, null, '2019-01-17', '0.00', null, null, null, '2019-01-17 11:29:11', '2019-01-17 11:29:11', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('18', '2033', null, null, '2019-01-17', '0.00', null, null, null, '2019-01-17 11:29:11', '2019-01-17 11:29:11', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('19', '2034', null, null, '2019-01-17', '0.00', null, null, null, '2019-01-17 11:29:11', '2019-01-17 11:29:11', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('20', '2035', null, null, '2019-01-17', '0.50', null, null, null, '2019-01-17 11:29:11', '2019-01-17 11:29:11', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('21', '2036', null, null, '2019-01-17', '4.00', null, null, null, '2019-01-17 11:29:11', '2019-01-17 11:29:11', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('22', '2026', null, null, '2019-01-17', '0.00', null, null, null, '2019-01-17 11:29:24', '2019-01-17 11:29:24', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('23', '2027', null, null, '2019-01-17', '0.00', null, null, null, '2019-01-17 11:29:24', '2019-01-17 11:29:24', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('24', '2028', null, null, '2019-01-17', '0.00', null, null, null, '2019-01-17 11:29:24', '2019-01-17 11:29:24', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('25', '2029', null, null, '2019-01-17', '0.00', null, null, null, '2019-01-17 11:29:24', '2019-01-17 11:29:24', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('26', '2030', null, null, '2019-01-17', '0.00', null, null, null, '2019-01-17 11:29:24', '2019-01-17 11:29:24', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('27', '2031', null, null, '2019-01-17', '0.00', null, null, null, '2019-01-17 11:29:24', '2019-01-17 11:29:24', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('28', '2033', null, null, '2019-01-17', '0.00', null, null, null, '2019-01-17 11:29:24', '2019-01-17 11:29:24', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('29', '2034', null, null, '2019-01-17', '0.00', null, null, null, '2019-01-17 11:29:24', '2019-01-17 11:29:24', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('30', '2035', null, null, '2019-01-17', '0.50', null, null, null, '2019-01-17 11:29:24', '2019-01-17 11:29:24', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('31', '2036', null, null, '2019-01-17', '0.50', null, null, null, '2019-01-17 11:29:24', '2019-01-17 11:29:24', null, '44', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('32', '1465', null, null, '2019-01-18', '1.00', null, null, null, '2019-01-18 07:22:49', '2019-01-18 07:22:49', null, '30', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('33', '1513', null, null, '2019-01-18', '1.00', null, null, null, '2019-01-18 07:22:49', '2019-01-18 07:22:49', null, '30', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('34', '54', null, null, '2019-01-23', '0.50', null, null, null, '2019-01-23 07:10:05', '2019-01-23 07:10:05', null, '37', null, null, null, null);
INSERT INTO `unit_progress_details` VALUES ('35', '54', null, null, '2019-01-23', '0.50', null, null, null, '2019-01-23 07:30:23', '2019-01-23 07:30:23', null, '37', null, null, null, null);
