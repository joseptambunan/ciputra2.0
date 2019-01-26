/*
Navicat MySQL Data Transfer

Source Server         : 117.53.46.38
Source Server Version : 50561
Source Host           : 117.53.46.38:3306
Source Database       : zadmin_qs

Target Server Type    : MYSQL
Target Server Version : 50561
File Encoding         : 65001

Date: 2019-01-24 07:47:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for departments
-- ----------------------------
DROP TABLE IF EXISTS departments;
CREATE TABLE departments (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of departments
-- ----------------------------
INSERT INTO departments VALUES ('1', 'CMS', 'ESTAT MANAGEMENT', 'ESTATE', '2018-07-03 22:05:57', '2018-08-01 10:36:44', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('2', 'CD', 'CONSTRUCTION & DEVELOPMENT', 'CONSTRUCTION & DEVELOPMENT', '2018-07-03 22:05:57', '2018-07-03 22:05:57', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('3', 'ENG', 'ENGINEERING', 'ENGINEERING', '2018-07-03 22:05:57', '2018-07-03 22:05:57', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('4', 'EXM', 'EXECUTIVE MANAGEMENT', 'EXECUTIVE MANAGEMENT', '2018-07-03 22:05:57', '2018-07-03 22:05:57', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('5', 'FAM', 'FAMILY CLUB', 'FAMILY CLUB', '2018-07-03 22:05:57', '2018-07-03 22:05:57', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('6', 'FA', 'FINANCE & ACCOUNTING', 'FINANCE & ACCOUNTING', '2018-07-03 22:05:57', '2018-07-03 22:05:57', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('7', 'FBV', 'FOOD & BEVERAGE', 'FOOD & BEVERAGE', '2018-07-03 22:05:57', '2018-07-03 22:05:57', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('8', 'FCT', 'FOOD COURT', 'FOOD COURT', '2018-07-03 22:05:57', '2018-07-03 22:05:57', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('9', 'GCM', 'GOLF COURCE MAINTENANCE', 'GOLF COURCE MAINTENANCE', '2018-07-03 22:05:57', '2018-07-03 22:05:57', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('10', 'GOP', 'GOLF OPERATION', 'GOLF OPERATION', '2018-07-03 22:05:57', '2018-07-03 22:05:57', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('11', 'HKH', 'HOUSE KEEPING & HOTEL', 'HOUSE KEEPING & HOTEL', '2018-07-03 22:05:57', '2018-07-03 22:05:57', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('12', 'HCM', 'HUMAN CAPITAL MANAGEMENT', 'HUMAN CAPITAL MANAGEMENT & GA', '2018-07-03 22:05:57', '2018-10-04 09:01:19', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('13', 'ICT', 'ICT', 'ICT', '2018-07-03 22:05:58', '2018-07-03 22:05:58', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('14', 'LGL', 'LAND & LEGAL', 'LAND & LEGAL', '2018-07-03 22:05:58', '2018-07-03 22:05:58', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('15', 'LA', 'LAND AQUISITION', 'LAND AQUISITION', '2018-07-03 22:05:58', '2018-07-03 22:05:58', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('16', 'LSG', 'LEASING', 'LEASING', '2018-07-03 22:05:58', '2018-07-03 22:05:58', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('17', 'MKT', 'MARKETING', 'MARKETING', '2018-07-03 22:05:58', '2018-07-03 22:05:58', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('18', 'OPR', 'OPERATIONAL', 'OPERATIONAL', '2018-07-03 22:05:58', '2018-07-03 22:05:58', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('19', 'NET', 'NETWORKING', 'NETWORKING', '2018-07-03 22:05:58', '2018-07-03 22:05:58', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('20', 'PER', 'PERMIT', 'PERMIT', '2018-07-03 22:05:58', '2018-07-03 22:05:58', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('21', 'PD', 'PROJECT DEVELOPMENT', 'PROJECT DEVELOPMENT', '2018-07-03 22:05:58', '2018-07-03 22:05:58', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('22', 'PMA', 'PROJECT MANAGEMENT', 'PROJECT MANAGEMENT', '2018-07-03 22:05:58', '2018-07-03 22:05:58', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('23', 'PRM', 'PROMOTION', 'PROMOTION', '2018-07-03 22:05:58', '2018-07-03 22:05:58', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('24', 'SVC', 'SERVICE', 'SERVICE', '2018-07-03 22:05:58', '2018-07-03 22:05:58', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('25', 'TLT', 'TALENT DEVELOPMENT', 'TALENT DEVELOPMENT', '2018-07-03 22:05:58', '2018-07-03 22:05:58', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('26', 'TNT', 'TENANT DESIGN', 'TENANT DESIGN', '2018-07-03 22:05:58', '2018-07-03 22:05:58', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('27', 'TRN', 'TRAINING', 'TRAINING', '2018-07-03 22:05:58', '2018-07-03 22:05:58', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('28', 'WP', 'WATERPARK', 'WATERPARK', '2018-07-03 22:05:58', '2018-07-03 22:05:58', null, '1', null, null, null, null);
INSERT INTO departments VALUES ('29', 'ISS', 'CLEANING SERVICE', null, '2018-07-31 14:02:13', '2018-07-31 14:02:13', null, null, null, null, null, null);
INSERT INTO departments VALUES ('32', 'CM', 'CITY MANAGEMENT', 'SAMA SEPERTI ESTATE', '2018-10-04 09:02:39', '2018-10-04 09:02:39', null, null, null, null, null, null);
