/*
Navicat MySQL Data Transfer

Source Server         : 117.53.46.38
Source Server Version : 50561
Source Host           : 117.53.46.38:3306
Source Database       : zadmin_qs

Target Server Type    : MYSQL
Target Server Version : 50561
File Encoding         : 65001

Date: 2019-01-25 18:26:51
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for hpp_dev_cost_summary_reports
-- ----------------------------
DROP TABLE IF EXISTS `hpp_dev_cost_summary_reports`;
CREATE TABLE `hpp_dev_cost_summary_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `project_kawasan_id` int(11) DEFAULT NULL,
  `efisiensi` int(11) DEFAULT NULL,
  `luas_netto` double(15,2) DEFAULT NULL,
  `luas_bruto` double(15,2) DEFAULT NULL,
  `total_budget` double(24,2) DEFAULT NULL,
  `hpp_netto` double(15,2) DEFAULT NULL,
  `hpp_bruto` double(15,2) DEFAULT NULL,
  `total_kontrak` double(24,2) DEFAULT NULL,
  `hpp_kontrak_netto` double(15,2) DEFAULT NULL,
  `hpp_kontrak_bruto` double(15,2) DEFAULT NULL,
  `total_kontrak_terbayar` double(24,2) DEFAULT NULL,
  `hpp_realisasi_netto` double(15,2) DEFAULT NULL,
  `hpp_realisasi_bruto` double(15,2) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `delete_by` int(11) DEFAULT NULL,
  `inactive_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `delete_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of hpp_dev_cost_summary_reports
-- ----------------------------
INSERT INTO `hpp_dev_cost_summary_reports` VALUES ('1', '3', null, '54', '84981.90', '156934.00', null, null, null, '4605589133.00', null, null, '2043230596.00', null, null, null, null, null, '2019-01-09 13:57:29', '2019-01-09 06:57:29', '2019-01-09 06:57:29', null, null);
INSERT INTO `hpp_dev_cost_summary_reports` VALUES ('2', '3', '49', '55', '9474.00', '17128.00', null, null, null, '7850496686.00', null, null, '1863057847.00', null, null, null, null, null, '2019-01-09 13:57:29', '2019-01-09 06:57:29', '2019-01-09 06:57:29', null, null);
INSERT INTO `hpp_dev_cost_summary_reports` VALUES ('3', '3', '50', '50', '23201.90', '46868.00', null, null, null, '8391066336.00', null, null, '0.00', null, null, null, null, null, '2019-01-09 13:57:29', '2019-01-09 06:57:29', '2019-01-09 06:57:29', null, null);
INSERT INTO `hpp_dev_cost_summary_reports` VALUES ('4', '3', '65', '81', '5384.00', '6661.00', null, null, null, '2595032508.00', null, null, '6826782277.00', null, null, null, null, null, '2019-01-09 13:57:29', '2019-01-09 06:57:29', '2019-01-09 06:57:29', null, null);
INSERT INTO `hpp_dev_cost_summary_reports` VALUES ('5', '3', '66', '58', '28439.00', '49021.00', null, null, null, '13602513080.00', null, null, '12315547242.00', null, null, null, null, null, '2019-01-09 13:57:29', '2019-01-09 06:57:29', '2019-01-09 06:57:29', null, null);
INSERT INTO `hpp_dev_cost_summary_reports` VALUES ('6', '3', '67', '51', '18070.00', '35700.00', null, null, null, '3854683365.00', null, null, '3656012974.00', null, null, null, null, null, '2019-01-09 13:57:29', '2019-01-09 06:57:29', '2019-01-09 06:57:29', null, null);
INSERT INTO `hpp_dev_cost_summary_reports` VALUES ('7', '3', '80', '27', '413.00', '1556.00', null, null, null, '0.00', null, null, '0.00', null, null, null, null, null, '2019-01-09 13:57:29', '2019-01-09 06:57:29', '2019-01-09 06:57:29', null, null);
INSERT INTO `hpp_dev_cost_summary_reports` VALUES ('8', '60', null, '0', null, null, null, null, null, '32640852032.00', null, null, '48651232939.00', null, null, null, null, null, '2019-01-15 10:39:38', '2019-01-15 03:39:38', '2019-01-15 03:39:38', null, null);
INSERT INTO `hpp_dev_cost_summary_reports` VALUES ('9', '60', '79', '1', '20620.36', '33936.00', null, null, null, '24915087555.00', null, null, null, null, null, null, null, null, '2019-01-15 10:39:45', '2019-01-15 03:39:45', '2019-01-15 03:39:45', null, null);
INSERT INTO `hpp_dev_cost_summary_reports` VALUES ('10', '60', '70', '0', '27294.40', '58977.00', null, null, null, '2615597772.00', null, null, null, null, null, null, null, null, '2019-01-15 10:39:53', '2019-01-15 03:39:53', '2019-01-15 03:39:53', null, null);
INSERT INTO `hpp_dev_cost_summary_reports` VALUES ('11', '60', '71', '1', '23763.69', '44288.00', null, null, null, '0.00', null, null, null, null, null, null, null, null, '2019-01-15 10:40:00', '2019-01-15 03:40:00', '2019-01-15 03:40:00', null, null);
INSERT INTO `hpp_dev_cost_summary_reports` VALUES ('12', '60', '72', '1', '34091.35', '63674.00', null, null, null, '0.00', null, null, null, null, null, null, null, null, '2019-01-15 10:40:08', '2019-01-15 03:40:08', '2019-01-15 03:40:08', null, null);
INSERT INTO `hpp_dev_cost_summary_reports` VALUES ('13', '60', '73', '0', '18028.00', '49289.00', null, null, null, '0.00', null, null, null, null, null, null, null, null, '2019-01-15 10:40:16', '2019-01-15 03:40:16', '2019-01-15 03:40:16', null, null);
INSERT INTO `hpp_dev_cost_summary_reports` VALUES ('14', '60', '74', '1', '19107.02', '37237.00', null, null, null, '5901406000.00', null, null, null, null, null, null, null, null, '2019-01-15 10:40:24', '2019-01-15 03:40:24', '2019-01-15 03:40:24', null, null);
INSERT INTO `hpp_dev_cost_summary_reports` VALUES ('15', '60', '75', '1', '28397.00', '50309.00', null, null, null, '13897081420.00', null, null, null, null, null, null, null, null, '2019-01-15 10:40:31', '2019-01-15 03:40:31', '2019-01-15 03:40:31', null, null);
INSERT INTO `hpp_dev_cost_summary_reports` VALUES ('16', '60', '76', '0', '15547.48', '33079.00', null, null, null, '0.00', null, null, null, null, null, null, null, null, '2019-01-15 10:40:39', '2019-01-15 03:40:39', '2019-01-15 03:40:39', null, null);
INSERT INTO `hpp_dev_cost_summary_reports` VALUES ('17', '60', '77', '0', '0.00', '0.00', null, null, null, '0.00', null, null, null, null, null, null, null, null, '2019-01-15 10:40:39', '2019-01-15 03:40:39', '2019-01-15 03:40:39', null, null);
INSERT INTO `hpp_dev_cost_summary_reports` VALUES ('18', '60', '78', '0', '0.00', '0.00', null, null, null, '0.00', null, null, null, null, null, null, null, null, '2019-01-15 10:40:40', '2019-01-15 03:40:40', '2019-01-15 03:40:40', null, null);
INSERT INTO `hpp_dev_cost_summary_reports` VALUES ('19', '20', null, '0', null, null, null, null, null, '4605589133.00', null, null, '0.00', null, null, null, null, null, '2019-01-19 05:33:44', '2019-01-18 22:33:44', '2019-01-18 22:33:44', null, null);
INSERT INTO `hpp_dev_cost_summary_reports` VALUES ('20', '20', '83', '0', '0.00', '17128.00', null, null, null, '2595032508.00', null, null, null, null, null, null, null, null, '2019-01-19 05:33:45', '2019-01-18 22:33:45', '2019-01-18 22:33:45', null, null);
INSERT INTO `hpp_dev_cost_summary_reports` VALUES ('21', '20', '84', '0', '0.00', '46868.00', null, null, null, '8391066336.00', null, null, null, null, null, null, null, null, '2019-01-19 05:33:46', '2019-01-18 22:33:46', '2019-01-18 22:33:46', null, null);
INSERT INTO `hpp_dev_cost_summary_reports` VALUES ('22', '20', '85', '0', '0.00', '6661.00', null, null, null, '7850496686.00', null, null, null, null, null, null, null, null, '2019-01-19 05:33:46', '2019-01-18 22:33:46', '2019-01-18 22:33:46', null, null);
INSERT INTO `hpp_dev_cost_summary_reports` VALUES ('23', '20', '86', '0', '0.00', '49021.00', null, null, null, '13602513080.00', null, null, null, null, null, null, null, null, '2019-01-19 05:33:47', '2019-01-18 22:33:47', '2019-01-18 22:33:47', null, null);
INSERT INTO `hpp_dev_cost_summary_reports` VALUES ('24', '20', '87', '0', '0.00', '35700.00', null, null, null, '3854683365.00', null, null, null, null, null, null, null, null, '2019-01-19 05:33:48', '2019-01-18 22:33:48', '2019-01-18 22:33:48', null, null);
INSERT INTO `hpp_dev_cost_summary_reports` VALUES ('25', '20', '88', '0', '0.00', '0.00', null, null, null, '0.00', null, null, null, null, null, null, null, null, '2019-01-19 05:33:48', '2019-01-18 22:33:48', '2019-01-18 22:33:48', null, null);
INSERT INTO `hpp_dev_cost_summary_reports` VALUES ('26', '3', '81', '0', '0.00', '0.00', '0.00', null, null, '624604001.00', null, null, null, null, null, '1', '1', null, '2019-01-21 16:52:22', '2019-01-21 00:00:00', '2019-01-21 00:00:00', null, null);
