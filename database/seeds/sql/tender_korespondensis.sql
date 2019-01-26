/*
Navicat MySQL Data Transfer

Source Server         : 117.53.46.38
Source Server Version : 50561
Source Host           : 117.53.46.38:3306
Source Database       : zadmin_qs

Target Server Type    : MYSQL
Target Server Version : 50561
File Encoding         : 65001

Date: 2019-01-26 12:58:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tender_korespondensis
-- ----------------------------
DROP TABLE IF EXISTS `tender_korespondensis`;
CREATE TABLE `tender_korespondensis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tender_rekanan_id` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `diundang_at` datetime DEFAULT NULL,
  `tempat_undangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tender_korespondensis_tender_rekanan_id_index` (`tender_rekanan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tender_korespondensis
-- ----------------------------
INSERT INTO `tender_korespondensis` VALUES ('1', '1892', '0057/UDG/CD/I/2019/H/I01', 'udg', '2019-01-17', '2019-01-24 00:00:00', '', '2019-01-17 07:42:52', '2019-01-17 07:42:52', '2019-01-17 07:42:59', null, '24', '44', null, null, null);
INSERT INTO `tender_korespondensis` VALUES ('2', '1893', '0058/UDG/CD/I/2019/H/I01', 'udg', '2019-01-17', '2019-01-24 00:00:00', '', '2019-01-17 07:42:52', '2019-01-17 07:42:52', '2019-01-17 07:42:59', null, '24', '44', null, null, null);
INSERT INTO `tender_korespondensis` VALUES ('3', '1891', '0059/UDG/CD/I/2019/H/I01', 'udg', '2019-01-17', '2019-01-24 00:00:00', '', '2019-01-17 07:42:52', '2019-01-17 07:42:52', '2019-01-17 07:42:59', null, '24', '44', null, null, null);
INSERT INTO `tender_korespondensis` VALUES ('4', '1891', '', 'sipp', '2019-01-17', '2019-01-17 08:31:15', '', '2019-01-17 08:31:15', '2019-01-17 08:31:15', '2019-01-17 08:31:15', null, '24', null, null, null, null);
INSERT INTO `tender_korespondensis` VALUES ('5', '1893', '', 'sutk', '2019-01-17', '2019-01-17 08:31:15', '', '2019-01-17 08:31:15', '2019-01-17 08:31:15', '2019-01-17 08:31:15', null, '24', null, null, null, null);
INSERT INTO `tender_korespondensis` VALUES ('6', '1892', '', 'sutk', '2019-01-17', '2019-01-17 08:31:15', '', '2019-01-17 08:31:15', '2019-01-17 08:31:15', '2019-01-17 08:31:15', null, '24', null, null, null, null);
INSERT INTO `tender_korespondensis` VALUES ('7', '1895', '0061/UDG/CD/I/2019/H/I01', 'udg', '2019-01-18', '2019-01-25 00:00:00', '', '2019-01-18 06:43:50', '2019-01-18 06:43:50', '2019-01-18 06:46:43', null, '24', '44', null, null, null);
INSERT INTO `tender_korespondensis` VALUES ('8', '1896', '0062/UDG/CD/I/2019/H/I01', 'udg', '2019-01-18', '2019-01-25 00:00:00', '', '2019-01-18 06:43:50', '2019-01-18 06:43:50', '2019-01-18 06:46:43', null, '24', '44', null, null, null);
INSERT INTO `tender_korespondensis` VALUES ('9', '1897', '0063/UDG/CD/I/2019/H/I01', 'udg', '2019-01-18', '2019-01-25 00:00:00', '', '2019-01-18 06:43:50', '2019-01-18 06:43:50', '2019-01-18 06:46:43', null, '24', '44', null, null, null);
INSERT INTO `tender_korespondensis` VALUES ('10', '2482', '0067/UDG/CD/I/2019/H/I01', 'udg', '2019-01-24', '1970-01-01 00:00:00', '', '2019-01-24 09:47:43', '2019-01-24 09:47:43', '2019-01-24 09:47:52', null, '24', '44', null, null, null);
INSERT INTO `tender_korespondensis` VALUES ('11', '2483', '0068/UDG/CD/I/2019/H/I01', 'udg', '2019-01-24', '1970-01-01 00:00:00', '', '2019-01-24 09:47:43', '2019-01-24 09:47:43', '2019-01-24 09:47:52', null, '24', '44', null, null, null);
INSERT INTO `tender_korespondensis` VALUES ('12', '2484', '0069/UDG/CD/I/2019/H/I01', 'udg', '2019-01-24', '1970-01-01 00:00:00', '', '2019-01-24 09:47:43', '2019-01-24 09:47:43', '2019-01-24 09:47:52', null, '24', '44', null, null, null);
INSERT INTO `tender_korespondensis` VALUES ('13', '2485', '0070/UDG/CD/I/2019/H/I01', 'udg', '2019-01-24', '1970-01-01 00:00:00', '', '2019-01-24 09:47:43', '2019-01-24 09:47:43', '2019-01-24 09:47:52', null, '24', '44', null, null, null);
