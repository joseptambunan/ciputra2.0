/*
Navicat MySQL Data Transfer

Source Server         : 117.53.46.38
Source Server Version : 50561
Source Host           : 117.53.46.38:3306
Source Database       : zadmin_qs

Target Server Type    : MYSQL
Target Server Version : 50561
File Encoding         : 65001

Date: 2019-01-23 16:53:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for project_histories
-- ----------------------------
DROP TABLE IF EXISTS `project_histories`;
CREATE TABLE `project_histories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `luas_dikembangkan` int(11) DEFAULT NULL,
  `luas_non_pengembangan` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `pt_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `pt_id` (`pt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of project_histories
-- ----------------------------
INSERT INTO `project_histories` VALUES ('1', '9', '50000', '0', '2018-12-17 08:24:11', '2018-12-17 08:24:11', '37', null, null, null, null, null, null);
INSERT INTO `project_histories` VALUES ('2', '9', '50000', '0', '2018-12-17 08:24:19', '2018-12-17 08:24:19', '37', null, null, null, null, null, null);
INSERT INTO `project_histories` VALUES ('3', '1', '638455', '0', '2018-12-19 09:02:10', '2018-12-19 09:02:10', '42', null, null, null, null, null, null);
INSERT INTO `project_histories` VALUES ('4', '3', '63996', '400000', '2018-12-20 02:56:19', '2018-12-20 02:56:19', '44', null, null, null, null, null, null);
INSERT INTO `project_histories` VALUES ('5', '3', '63996', '400000', '2018-12-20 03:00:33', '2018-12-20 03:00:33', '44', null, null, null, null, null, null);
INSERT INTO `project_histories` VALUES ('6', '61', '239105', '938000', '2018-12-20 07:15:29', '2018-12-20 07:15:29', '46', null, null, null, null, null, null);
INSERT INTO `project_histories` VALUES ('7', '61', '239105', '939000', '2018-12-20 07:16:45', '2018-12-20 07:16:45', '46', null, null, null, null, null, null);
INSERT INTO `project_histories` VALUES ('8', '1', '244214', '400662', '2018-12-21 07:04:58', '2018-12-21 07:04:58', '42', null, null, null, null, null, null);
INSERT INTO `project_histories` VALUES ('9', '1', '244965', '399911', '2018-12-21 07:27:53', '2018-12-21 07:27:53', '42', null, null, null, null, null, null);
INSERT INTO `project_histories` VALUES ('10', '1', '237793', '399911', '2018-12-26 07:35:28', '2018-12-26 07:35:28', '42', null, null, null, null, null, null);
INSERT INTO `project_histories` VALUES ('11', '3', '112313', '400000', '2018-12-27 08:54:22', '2018-12-27 08:54:22', '44', null, null, null, null, null, null);
INSERT INTO `project_histories` VALUES ('12', '3', '155378', '400000', '2018-12-27 09:03:13', '2018-12-27 09:03:13', '44', null, null, null, null, null, null);
INSERT INTO `project_histories` VALUES ('13', '3', '156934', '400000', '2019-01-09 02:03:09', '2019-01-09 02:03:09', '44', null, null, null, null, null, null);
INSERT INTO `project_histories` VALUES ('14', '60', '393755', '0', '2019-01-14 07:44:35', '2019-01-14 07:44:35', '30', null, null, null, null, null, null);
INSERT INTO `project_histories` VALUES ('15', '3', '162462', '400000', '2019-01-18 03:12:55', '2019-01-18 03:12:55', '44', null, null, null, null, null, null);
INSERT INTO `project_histories` VALUES ('16', '20', '162462', '400000', '2019-01-18 22:05:46', '2019-01-18 22:05:46', '56', null, null, null, null, null, null);
INSERT INTO `project_histories` VALUES ('17', '9', '50500', '0', '2019-01-22 07:57:53', '2019-01-22 07:57:53', '37', null, null, null, null, null, null);
INSERT INTO `project_histories` VALUES ('18', '9', '80000', '100000', '2019-01-22 08:09:17', '2019-01-22 08:09:17', '37', null, null, null, null, null, null);
