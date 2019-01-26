/*
Navicat MySQL Data Transfer

Source Server         : 117.53.46.38
Source Server Version : 50561
Source Host           : 117.53.46.38:3306
Source Database       : zadmin_qs

Target Server Type    : MYSQL
Target Server Version : 50561
File Encoding         : 65001

Date: 2019-01-26 18:22:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for document_types
-- ----------------------------
DROP TABLE IF EXISTS `document_types`;
CREATE TABLE `document_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `head_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of document_types
-- ----------------------------
INSERT INTO `document_types` VALUES ('1', 'Budget', null, '2018-07-27 17:47:45', '2018-08-01 18:00:16', null, null, null, null, null, null);
INSERT INTO `document_types` VALUES ('6', 'BudgetTahunan', null, '2018-07-27 17:49:57', '2018-07-27 17:50:58', null, null, null, null, null, null);
INSERT INTO `document_types` VALUES ('7', 'Workorder', null, '2018-07-27 17:51:07', '2018-08-01 18:01:08', null, null, null, null, null, null);
INSERT INTO `document_types` VALUES ('8', 'Rab', null, '2018-07-27 17:51:19', '2018-07-27 17:51:19', null, null, null, null, null, null);
INSERT INTO `document_types` VALUES ('9', 'Tender', null, '2018-07-27 17:51:24', '2018-08-01 18:00:54', null, null, null, null, null, null);
INSERT INTO `document_types` VALUES ('10', 'Spk', null, '2018-07-27 17:51:49', '2018-07-27 17:51:49', null, null, null, null, null, null);
INSERT INTO `document_types` VALUES ('11', 'Bap', null, '2018-07-27 17:51:56', '2018-07-27 17:51:56', null, null, null, null, null, null);
INSERT INTO `document_types` VALUES ('12', 'Vo', null, '2018-07-27 17:52:01', '2018-07-27 17:52:01', null, null, null, null, null, null);
INSERT INTO `document_types` VALUES ('13', 'Voucher', null, '2018-07-27 17:52:07', '2018-08-01 18:01:29', null, null, null, null, null, null);
INSERT INTO `document_types` VALUES ('14', 'Purchase Requesition', null, '2018-07-27 17:52:22', '2018-08-01 18:02:05', null, null, null, null, null, null);
INSERT INTO `document_types` VALUES ('15', 'Purchase Order', null, '2018-08-01 18:02:18', '2018-08-01 18:02:18', null, null, null, null, null, null);
INSERT INTO `document_types` VALUES ('16', 'TenderRekanan', null, '2018-09-05 14:00:00', '2018-09-05 14:00:00', null, '1', null, null, null, null);
INSERT INTO `document_types` VALUES ('17', 'TenderMenang', null, '2018-09-05 14:00:00', '2018-09-05 14:00:00', null, '1', null, null, null, null);
INSERT INTO `document_types` VALUES ('18', 'BudgetDraft', 'BudgetDraft', '2018-09-19 14:00:00', '2018-09-19 14:00:00', null, '1', null, null, null, null);
