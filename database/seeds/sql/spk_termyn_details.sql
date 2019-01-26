/*
Navicat MySQL Data Transfer

Source Server         : 117.53.46.38
Source Server Version : 50561
Source Host           : 117.53.46.38:3306
Source Database       : zadmin_qs

Target Server Type    : MYSQL
Target Server Version : 50561
File Encoding         : 65001

Date: 2019-01-25 18:25:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for spk_termyn_details
-- ----------------------------
DROP TABLE IF EXISTS `spk_termyn_details`;
CREATE TABLE `spk_termyn_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `spk_termyn_id` int(11) NOT NULL,
  `item_pekerjaan_id` int(11) NOT NULL,
  `termyn` int(11) DEFAULT NULL,
  `percentage` decimal(5,2) DEFAULT '0.00',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of spk_termyn_details
-- ----------------------------
