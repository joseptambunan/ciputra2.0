/*
Navicat MySQL Data Transfer

Source Server         : 117.53.46.38
Source Server Version : 50561
Source Host           : 117.53.46.38:3306
Source Database       : zadmin_qs

Target Server Type    : MYSQL
Target Server Version : 50561
File Encoding         : 65001

Date: 2019-01-24 07:35:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for hpp_con_cost_summary_reports
-- ----------------------------
DROP TABLE IF EXISTS hpp_con_cost_summary_reports;
CREATE TABLE hpp_con_cost_summary_reports (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `project_kawasan_id` int(11) DEFAULT NULL,
  `total_kontrak` bigint(24) DEFAULT NULL,
  `total_bayar` bigint(24) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`,`project_kawasan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hpp_con_cost_summary_reports
-- ----------------------------
INSERT INTO hpp_con_cost_summary_reports VALUES ('1', '60', '79', '0', '0', '2019-01-18 09:39:45', '2019-01-18 09:39:45', null, null, null, null, null, null);
INSERT INTO hpp_con_cost_summary_reports VALUES ('2', '60', '70', '0', '0', '2019-01-18 09:39:45', '2019-01-18 09:39:45', null, null, null, null, null, null);
INSERT INTO hpp_con_cost_summary_reports VALUES ('3', '60', '71', '0', '0', '2019-01-18 09:39:45', '2019-01-18 09:39:45', null, null, null, null, null, null);
INSERT INTO hpp_con_cost_summary_reports VALUES ('4', '60', '72', '0', '0', '2019-01-18 09:39:45', '2019-01-18 09:39:45', null, null, null, null, null, null);
INSERT INTO hpp_con_cost_summary_reports VALUES ('5', '60', '73', '0', '0', '2019-01-18 09:39:45', '2019-01-18 09:39:45', null, null, null, null, null, null);
INSERT INTO hpp_con_cost_summary_reports VALUES ('6', '60', '74', '0', '0', '2019-01-18 09:39:45', '2019-01-18 09:39:45', null, null, null, null, null, null);
INSERT INTO hpp_con_cost_summary_reports VALUES ('7', '60', '75', '0', '0', '2019-01-18 09:39:45', '2019-01-18 09:39:45', null, null, null, null, null, null);
INSERT INTO hpp_con_cost_summary_reports VALUES ('8', '60', '76', '0', '0', '2019-01-18 09:39:45', '2019-01-18 09:39:45', null, null, null, null, null, null);
INSERT INTO hpp_con_cost_summary_reports VALUES ('9', '60', '77', '0', '0', '2019-01-18 09:39:45', '2019-01-18 09:39:45', null, null, null, null, null, null);
INSERT INTO hpp_con_cost_summary_reports VALUES ('10', '60', '78', '0', '0', '2019-01-18 09:39:45', '2019-01-18 09:39:45', null, null, null, null, null, null);
INSERT INTO hpp_con_cost_summary_reports VALUES ('11', '20', '83', '6453334115', '0', '2019-01-18 22:43:47', '2019-01-18 22:43:47', null, null, null, null, null, null);
INSERT INTO hpp_con_cost_summary_reports VALUES ('12', '20', '84', '10181467137', '0', '2019-01-18 22:43:47', '2019-01-18 22:43:47', null, null, null, null, null, null);
INSERT INTO hpp_con_cost_summary_reports VALUES ('13', '20', '85', '16023033094', '0', '2019-01-18 22:43:47', '2019-01-18 22:43:47', null, null, null, null, null, null);
INSERT INTO hpp_con_cost_summary_reports VALUES ('14', '20', '86', '40026668099', '0', '2019-01-18 22:43:47', '2019-01-18 22:43:47', null, null, null, null, null, null);
INSERT INTO hpp_con_cost_summary_reports VALUES ('15', '20', '87', '20293362060', '0', '2019-01-18 22:43:47', '2019-01-18 22:43:47', null, null, null, null, null, null);
INSERT INTO hpp_con_cost_summary_reports VALUES ('16', '20', '88', '0', '0', '2019-01-18 22:43:47', '2019-01-18 22:43:47', null, null, null, null, null, null);
