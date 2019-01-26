/*
Navicat MySQL Data Transfer

Source Server         : 117.53.46.38
Source Server Version : 50561
Source Host           : 117.53.46.38:3306
Source Database       : zadmin_qs

Target Server Type    : MYSQL
Target Server Version : 50561
File Encoding         : 65001

Date: 2019-01-24 07:33:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for budget_tahunan_unit_periode_details
-- ----------------------------
DROP TABLE IF EXISTS budget_tahunan_unit_periode_details;
CREATE TABLE budget_tahunan_unit_periode_details (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` int(11) DEFAULT NULL,
  `januari` int(11) DEFAULT NULL,
  `februari` int(11) DEFAULT NULL,
  `maret` int(11) DEFAULT NULL,
  `april` int(11) DEFAULT NULL,
  `mei` int(11) DEFAULT NULL,
  `juni` int(11) DEFAULT NULL,
  `juli` int(11) DEFAULT NULL,
  `agustus` int(11) DEFAULT NULL,
  `september` int(11) DEFAULT NULL,
  `oktober` int(11) DEFAULT NULL,
  `november` int(11) DEFAULT NULL,
  `desember` int(11) DEFAULT NULL,
  `budget_tahunan_periode` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `budget_tahunan_periode` (`budget_tahunan_periode`),
  KEY `budget_tahunan_periode_2` (`budget_tahunan_periode`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of budget_tahunan_unit_periode_details
-- ----------------------------
INSERT INTO budget_tahunan_unit_periode_details VALUES ('1', '3', '0', '0', '15', '10', '10', '10', '10', '10', '10', '10', '10', '0', '1', '2018-12-26 10:11:09', '2018-12-26 10:11:09');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('2', '3', '0', '0', '15', '10', '10', '10', '10', '10', '10', '10', '10', '0', '2', '2018-12-26 10:14:01', '2018-12-26 10:14:01');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('3', '3', '0', '0', '15', '10', '10', '10', '10', '10', '10', '10', '10', '0', '3', '2018-12-26 10:16:40', '2018-12-26 10:16:40');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('4', '3', '0', '0', '15', '10', '10', '10', '10', '10', '10', '10', '10', '0', '4', '2018-12-26 10:17:32', '2018-12-26 10:17:32');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('5', '4', '0', '0', '0', '15', '10', '10', '10', '10', '10', '10', '10', '10', '2', '2018-12-26 10:18:28', '2018-12-26 10:18:28');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('6', '4', '0', '0', '0', '15', '10', '10', '10', '10', '10', '10', '10', '10', '3', '2018-12-26 10:19:44', '2018-12-26 10:19:44');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('7', '5', '0', '0', '0', '0', '15', '10', '10', '10', '10', '10', '10', '10', '2', '2018-12-26 10:21:15', '2018-12-26 10:21:15');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('8', '5', '0', '0', '0', '0', '15', '10', '10', '10', '10', '10', '10', '10', '3', '2018-12-26 10:24:14', '2018-12-26 10:24:14');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('9', '6', '0', '0', '0', '0', '0', '15', '10', '10', '10', '10', '10', '10', '4', '2018-12-26 10:43:55', '2018-12-26 10:43:55');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('10', '7', '0', '0', '0', '0', '0', '0', '15', '10', '10', '10', '10', '10', '2', '2018-12-26 10:45:06', '2018-12-26 10:45:06');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('11', '8', '0', '0', '0', '0', '0', '0', '0', '15', '10', '10', '10', '10', '1', '2018-12-26 10:46:01', '2018-12-26 10:46:01');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('12', '8', '0', '0', '0', '0', '0', '0', '0', '15', '10', '10', '10', '10', '2', '2018-12-26 10:47:29', '2018-12-26 10:47:29');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('13', '8', '0', '0', '0', '0', '0', '0', '0', '15', '10', '10', '10', '10', '3', '2018-12-26 10:48:17', '2018-12-26 10:48:17');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('14', '9', '0', '0', '0', '0', '0', '0', '0', '0', '15', '10', '10', '10', '1', '2018-12-27 01:40:24', '2018-12-27 01:40:24');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('15', '10', '0', '0', '0', '0', '0', '0', '0', '0', '0', '15', '10', '10', '2', '2018-12-27 01:41:04', '2018-12-27 01:41:04');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('16', '11', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '15', '10', '3', '2018-12-27 01:41:33', '2018-12-27 01:41:33');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('17', '11', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '15', '10', '4', '2018-12-27 01:42:11', '2018-12-27 01:42:11');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('18', '12', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '15', '1', '2018-12-27 01:42:38', '2018-12-27 01:42:38');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('19', '12', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '15', '2', '2018-12-27 01:42:58', '2018-12-27 01:42:58');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('20', '12', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '15', '2', '2018-12-27 01:45:17', '2018-12-27 01:45:17');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('21', '12', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '15', '3', '2018-12-27 01:45:40', '2018-12-27 01:45:40');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('22', '12', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '15', '4', '2018-12-27 01:46:07', '2018-12-27 01:46:07');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('23', '4', '0', '0', '0', '15', '10', '10', '10', '10', '10', '10', '10', '10', '7', '2018-12-27 06:24:12', '2018-12-27 06:24:12');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('24', '11', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '15', '10', '7', '2018-12-27 06:24:44', '2018-12-27 06:24:44');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('25', '3', '0', '0', '15', '10', '10', '10', '10', '10', '10', '10', '10', '0', '8', '2018-12-27 06:25:46', '2018-12-27 06:25:46');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('26', '7', '0', '0', '0', '0', '0', '0', '15', '10', '10', '10', '10', '10', '8', '2018-12-27 06:26:40', '2018-12-27 06:26:40');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('27', '10', '0', '0', '0', '0', '0', '0', '0', '0', '0', '15', '10', '10', '8', '2018-12-27 06:27:10', '2018-12-27 06:27:10');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('28', '5', '0', '0', '0', '0', '15', '10', '10', '10', '10', '10', '10', '10', '9', '2018-12-28 04:13:39', '2018-12-28 04:13:39');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('29', '8', '0', '0', '0', '0', '0', '0', '0', '15', '10', '10', '10', '10', '9', '2018-12-28 04:15:18', '2018-12-28 04:15:18');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('30', '9', '0', '0', '0', '0', '0', '0', '0', '0', '15', '10', '10', '10', '9', '2018-12-28 04:16:31', '2018-12-28 04:16:31');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('31', '7', '0', '0', '0', '0', '0', '0', '15', '10', '10', '10', '10', '10', '10', '2018-12-28 04:17:48', '2018-12-28 04:17:48');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('32', '4', '0', '0', '15', '10', '10', '10', '10', '10', '10', '10', '10', '0', '11111', '2019-01-08 08:50:25', '2019-01-08 08:50:25');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('33', '4', '0', '0', '0', '15', '10', '10', '10', '10', '10', '10', '10', '10', '11111', '2019-01-08 08:52:34', '2019-01-08 08:52:34');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('34', '4', '0', '0', '0', '15', '10', '10', '10', '10', '10', '10', '10', '10', '11', '2019-01-08 08:53:32', '2019-01-08 08:53:32');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('35', '3', '0', '0', '15', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1222', '2019-01-08 08:54:33', '2019-01-08 08:54:33');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('36', '3', '0', '0', '15', '10', '10', '10', '10', '10', '10', '10', '10', '0', '1222', '2019-01-08 08:54:58', '2019-01-08 08:54:58');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('37', '7', '0', '0', '0', '0', '0', '0', '15', '10', '10', '10', '10', '10', '12', '2019-01-08 08:56:00', '2019-01-08 08:56:00');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('38', '10', '0', '0', '0', '0', '0', '0', '0', '0', '0', '15', '10', '10', '12', '2019-01-08 08:57:56', '2019-01-08 08:57:56');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('39', '3', '0', '0', '15', '10', '10', '10', '10', '10', '10', '10', '10', '0', '12', '2019-01-08 09:07:50', '2019-01-08 09:07:50');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('40', '4', '0', '0', '0', '15', '10', '10', '10', '10', '10', '10', '10', '10', '14', '2019-01-09 01:36:27', '2019-01-09 01:36:27');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('41', '6', '0', '0', '0', '0', '0', '15', '10', '10', '10', '10', '10', '10', '14', '2019-01-09 01:37:32', '2019-01-09 01:37:32');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('42', '11', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '15', '10', '14', '2019-01-09 01:40:02', '2019-01-09 01:40:02');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('43', '12', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '15', '14', '2019-01-09 01:41:08', '2019-01-09 01:41:08');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('44', '5', '0', '0', '0', '0', '15', '10', '10', '10', '10', '10', '10', '10', '15', '2019-01-09 01:42:11', '2019-01-09 01:42:11');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('45', '12', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '15', '15', '2019-01-09 01:43:08', '2019-01-09 01:43:08');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('46', '4', '0', '0', '0', '15', '10', '10', '10', '10', '10', '10', '10', '10', '16', '2019-01-09 01:51:36', '2019-01-09 01:51:36');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('47', '5', '0', '0', '0', '0', '15', '10', '10', '10', '10', '10', '10', '10', '17', '2019-01-09 04:43:55', '2019-01-09 04:43:55');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('48', '6', '0', '0', '0', '0', '0', '15', '10', '10', '10', '10', '10', '10', '17', '2019-01-09 04:45:07', '2019-01-09 04:45:07');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('49', '9', '0', '0', '0', '0', '0', '0', '0', '0', '15', '10', '10', '10', '17', '2019-01-09 04:46:10', '2019-01-09 04:46:10');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('50', '1', '0', '0', '15', '0', '0', '0', '0', '30', '0', '0', '0', '0', '18', '2019-01-16 13:20:35', '2019-01-16 13:20:35');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('51', '1', '0', '0', '15', '0', '0', '0', '0', '30', '0', '0', '0', '0', '24', '2019-01-16 23:23:33', '2019-01-16 23:23:33');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('52', '1', '0', '0', '15', '0', '0', '0', '0', '30', '0', '0', '0', '0', '20', '2019-01-16 23:24:30', '2019-01-16 23:24:30');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('53', '2', '0', '0', '15', '0', '0', '0', '0', '30', '0', '0', '0', '0', '18', '2019-01-16 23:26:02', '2019-01-16 23:26:02');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('54', '3', '0', '0', '0', '15', '0', '0', '0', '0', '30', '0', '0', '0', '18', '2019-01-16 23:26:38', '2019-01-16 23:26:38');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('55', '4', '0', '0', '0', '0', '15', '0', '0', '0', '0', '30', '0', '0', '18', '2019-01-16 23:27:21', '2019-01-16 23:27:21');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('56', '5', '0', '0', '0', '0', '0', '15', '0', '0', '0', '0', '30', '0', '18', '2019-01-16 23:28:11', '2019-01-16 23:28:11');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('57', '1', '0', '0', '15', '0', '0', '0', '0', '30', '0', '0', '0', '0', '19', '2019-01-16 23:32:12', '2019-01-16 23:32:12');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('58', '2', '0', '0', '0', '15', '0', '0', '0', '0', '30', '0', '0', '0', '19', '2019-01-16 23:33:11', '2019-01-16 23:33:11');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('59', '4', '0', '0', '0', '0', '0', '15', '0', '0', '0', '0', '30', '0', '19', '2019-01-16 23:33:52', '2019-01-16 23:33:52');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('60', '9', '0', '0', '0', '0', '0', '0', '0', '0', '15', '0', '0', '0', '19', '2019-01-16 23:34:39', '2019-01-16 23:34:39');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('61', '8', '0', '0', '0', '0', '0', '0', '0', '0', '0', '15', '0', '0', '19', '2019-01-16 23:35:14', '2019-01-16 23:35:14');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('62', '5', '0', '0', '0', '0', '0', '0', '15', '0', '0', '0', '0', '0', '20', '2019-01-16 23:40:22', '2019-01-16 23:40:22');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('63', '1', '0', '0', '15', '0', '0', '0', '0', '30', '0', '0', '0', '0', '21', '2019-01-16 23:43:41', '2019-01-16 23:43:41');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('64', '3', '0', '0', '0', '0', '15', '0', '0', '0', '0', '30', '0', '0', '21', '2019-01-16 23:44:24', '2019-01-16 23:44:24');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('65', '1', '0', '0', '15', '0', '0', '0', '0', '30', '0', '0', '0', '0', '22', '2019-01-16 23:45:10', '2019-01-16 23:45:10');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('66', '1', '0', '0', '15', '0', '0', '0', '0', '30', '0', '0', '0', '0', '23', '2019-01-16 23:46:02', '2019-01-16 23:46:02');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('67', '2', '0', '0', '0', '15', '0', '0', '0', '0', '30', '0', '0', '0', '23', '2019-01-16 23:46:40', '2019-01-16 23:46:40');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('68', '4', '0', '0', '0', '0', '0', '15', '0', '0', '0', '0', '30', '0', '23', '2019-01-16 23:47:28', '2019-01-16 23:47:28');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('69', '5', '0', '0', '0', '0', '0', '0', '15', '0', '0', '0', '0', '30', '23', '2019-01-16 23:48:03', '2019-01-16 23:48:03');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('70', '9', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '15', '0', '23', '2019-01-16 23:48:34', '2019-01-16 23:48:34');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('71', '3', '0', '0', '0', '0', '15', '0', '0', '0', '0', '30', '0', '0', '24', '2019-01-16 23:49:47', '2019-01-16 23:49:47');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('72', '4', '0', '0', '0', '0', '0', '15', '0', '0', '0', '0', '30', '0', '24', '2019-01-16 23:50:26', '2019-01-16 23:50:26');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('73', '5', '0', '0', '0', '0', '0', '0', '15', '0', '0', '0', '0', '30', '24', '2019-01-16 23:50:59', '2019-01-16 23:50:59');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('74', '7', '0', '0', '0', '0', '0', '0', '0', '0', '15', '0', '0', '0', '24', '2019-01-16 23:51:44', '2019-01-16 23:51:44');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('75', '9', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '15', '0', '24', '2019-01-16 23:52:50', '2019-01-16 23:52:50');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('76', '10', '0', '0', '0', '0', '0', '0', '0', '0', '0', '15', '0', '0', '24', '2019-01-16 23:53:31', '2019-01-16 23:53:31');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('77', '3', '0', '0', '15', '10', '10', '10', '10', '10', '10', '10', '10', '0', '25', '2019-01-21 13:04:34', '2019-01-21 13:04:34');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('78', '5', '0', '0', '0', '0', '15', '10', '10', '10', '10', '10', '10', '10', '25', '2019-01-21 13:06:12', '2019-01-21 13:06:12');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('79', '10', '0', '0', '0', '0', '0', '0', '0', '0', '0', '15', '10', '10', '26', '2019-01-22 03:28:29', '2019-01-22 03:28:29');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('80', '10', '0', '0', '0', '0', '0', '0', '0', '0', '0', '15', '10', '10', '27', '2019-01-22 03:30:59', '2019-01-22 03:30:59');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('81', '11', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '15', '10', '11', '2019-01-22 03:32:16', '2019-01-22 03:32:16');
INSERT INTO budget_tahunan_unit_periode_details VALUES ('82', '11', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '15', '10', '2', '2019-01-22 03:46:31', '2019-01-22 03:46:31');
