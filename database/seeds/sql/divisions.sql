/*
Navicat MySQL Data Transfer

Source Server         : 117.53.46.38
Source Server Version : 50561
Source Host           : 117.53.46.38:3306
Source Database       : zadmin_qs

Target Server Type    : MYSQL
Target Server Version : 50561
File Encoding         : 65001

Date: 2019-01-24 07:47:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for divisions
-- ----------------------------
DROP TABLE IF EXISTS divisions;
CREATE TABLE divisions (
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of divisions
-- ----------------------------
INSERT INTO divisions VALUES ('1', 'ACC', 'Accounting', 'Accounting', '2018-07-03 22:21:04', '2018-07-03 22:21:04', null, '1', null, null, null, null);
INSERT INTO divisions VALUES ('2', 'BUI', 'Building', 'Building', '2018-07-03 22:21:04', '2018-07-03 22:21:04', null, '1', null, null, null, null);
INSERT INTO divisions VALUES ('3', 'COL', 'Collection', 'Collection', '2018-07-03 22:21:04', '2018-07-03 22:21:04', null, '1', null, null, null, null);
INSERT INTO divisions VALUES ('4', 'CP', 'Contract & Procurement', 'Contract & Procurement', '2018-07-03 22:21:04', '2018-07-03 22:21:04', null, '1', null, null, null, null);
INSERT INTO divisions VALUES ('5', 'CR', 'Customer Relation', 'Customer Relation', '2018-07-03 22:21:04', '2018-07-03 22:21:04', null, '1', null, null, null, null);
INSERT INTO divisions VALUES ('6', 'FAC', 'Facilities', 'Facilities', '2018-07-03 22:21:04', '2018-07-03 22:21:04', null, '1', null, null, null, null);
INSERT INTO divisions VALUES ('7', 'HCM', 'Human Capital Management & GA', 'Human Capital Management & GA', '2018-07-03 22:21:04', '2018-07-03 22:21:04', null, '1', null, null, null, null);
INSERT INTO divisions VALUES ('8', 'ICT', 'Information Computer Technologi', 'ICT', '2018-07-03 22:21:04', '2018-07-31 15:04:06', null, '1', null, null, null, null);
INSERT INTO divisions VALUES ('9', 'INF', 'Infrastructure', 'Infrastructure', '2018-07-03 22:21:04', '2018-07-03 22:21:04', null, '1', null, null, null, null);
INSERT INTO divisions VALUES ('10', 'LAA', 'Land Administration', 'Land Administration', '2018-07-03 22:21:05', '2018-07-03 22:21:05', null, '1', null, null, null, null);
INSERT INTO divisions VALUES ('11', 'LAQ', 'Land Aquisition', 'Land Aquisition', '2018-07-03 22:21:05', '2018-07-03 22:21:05', null, '1', null, null, null, null);
INSERT INTO divisions VALUES ('12', 'LH', 'Landscape & Housekeeping', 'Landscape & Housekeeping', '2018-07-03 22:21:05', '2018-07-03 22:21:05', null, '1', null, null, null, null);
INSERT INTO divisions VALUES ('13', 'LEG', 'Legal & Mortgage', 'Legal & Mortgage', '2018-07-03 22:21:05', '2018-07-03 22:21:05', null, '1', null, null, null, null);
INSERT INTO divisions VALUES ('14', 'LIT', 'Litigation', 'Litigation', '2018-07-03 22:21:05', '2018-07-03 22:21:05', null, '1', null, null, null, null);
INSERT INTO divisions VALUES ('15', 'PER', 'Permit', 'Permit', '2018-07-03 22:21:05', '2018-07-03 22:21:05', null, '1', null, null, null, null);
INSERT INTO divisions VALUES ('16', 'PD', 'Planning & Design', 'Planning & Design', '2018-07-03 22:21:05', '2018-07-03 22:21:05', null, '1', null, null, null, null);
INSERT INTO divisions VALUES ('17', 'PRO', 'Promotion', 'Promotion', '2018-07-03 22:21:05', '2018-07-03 22:21:05', null, '1', null, null, null, null);
INSERT INTO divisions VALUES ('18', 'PUR', 'Purchasing', 'Purchasing', '2018-07-03 22:21:05', '2018-07-03 22:21:05', null, '1', null, null, null, null);
INSERT INTO divisions VALUES ('19', 'RET', 'Retribution', 'Retribution', '2018-07-03 22:21:05', '2018-07-03 22:21:05', null, '1', null, null, null, null);
INSERT INTO divisions VALUES ('20', 'SAL', 'Sales', 'Sales', '2018-07-03 22:21:05', '2018-07-03 22:21:05', null, '1', null, null, null, null);
INSERT INTO divisions VALUES ('21', 'SEC', 'Security', 'Security', '2018-07-03 22:21:05', '2018-07-03 22:21:05', null, '1', null, null, null, null);
INSERT INTO divisions VALUES ('22', 'TAX', 'Tax', 'Tax', '2018-07-03 22:21:05', '2018-07-03 22:21:05', null, '1', null, null, null, null);
INSERT INTO divisions VALUES ('23', 'TRE', 'Treasury', 'Treasury', '2018-07-03 22:21:05', '2018-07-03 22:21:05', null, '1', null, null, null, null);
INSERT INTO divisions VALUES ('24', 'UTI', 'Utility & Infrastructure', 'Utility & Infrastructure', '2018-07-03 22:21:05', '2018-07-03 22:21:05', null, '1', null, null, null, null);
INSERT INTO divisions VALUES ('25', 'WAT', 'Water Supply', 'Water Supply', '2018-07-03 22:21:05', '2018-07-03 22:21:05', null, '1', null, null, null, null);
INSERT INTO divisions VALUES ('26', 'WTP', 'Water Park', 'Water Park', '2018-07-03 22:21:05', '2018-07-03 22:21:05', null, '1', null, null, null, null);
INSERT INTO divisions VALUES ('27', 'EST', 'Estate', null, '2018-10-01 13:05:23', '2018-10-01 13:05:23', null, null, null, null, null, null);
