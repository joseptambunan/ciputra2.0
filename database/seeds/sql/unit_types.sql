/*
Navicat MySQL Data Transfer

Source Server         : 117.53.46.38
Source Server Version : 50561
Source Host           : 117.53.46.38:3306
Source Database       : zadmin_qs

Target Server Type    : MYSQL
Target Server Version : 50561
File Encoding         : 65001

Date: 2019-01-24 07:26:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for unit_types
-- ----------------------------
DROP TABLE IF EXISTS unit_types;
CREATE TABLE unit_types (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `luas_bangunan` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `luas_tanah` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `listrik` int(11) DEFAULT NULL,
  `kode` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `building_class` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cluster_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cluster_id` (`cluster_id`)
) ENGINE=InnoDB AUTO_INCREMENT=317 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of unit_types
-- ----------------------------
INSERT INTO unit_types VALUES ('1', '9', '2', '2', '2.00', 'we', '2018-12-17 08:31:10', '2019-01-09 09:40:31', '2019-01-09 09:40:31', '37', '37', '37', null, null, '1', '2', null, null, '42');
INSERT INTO unit_types VALUES ('2', '333', 'TUSCIANA', '0', '68', 'Migration from Erem based export at 18 Oct 2018', '2018-12-20 04:24:01', '2018-12-20 04:24:01', null, '1', null, null, null, null, '2200', '', '5130', 'RE', '4999');
INSERT INTO unit_types VALUES ('3', '333', 'RIVELINA', '140', '88', 'Migration from Erem based export at 18 Oct 2018', '2018-12-20 04:24:01', '2018-12-20 04:24:01', null, '1', null, null, null, null, '3500', '', '5132', 'RE', '49999');
INSERT INTO unit_types VALUES ('4', '3', 'FITTONIA', '101', '105.00', 'Fittonia', '2018-12-21 08:56:59', '2018-12-21 08:56:59', null, '1', null, null, null, null, '1300', 'FITTONIA', null, null, '50');
INSERT INTO unit_types VALUES ('5', '3', 'TRITONA', '67', '72.00', 'TRITONA', '2018-12-21 08:58:00', '2018-12-21 08:58:00', null, '1', null, null, null, null, '1300', 'TRITONA', null, null, '50');
INSERT INTO unit_types VALUES ('6', '3', 'CLARKIA', '53', '55.00', 'CLARKIA', '2018-12-21 08:58:40', '2018-12-21 08:58:40', null, '1', null, null, null, null, '1300', 'CLARKIA', null, null, '50');
INSERT INTO unit_types VALUES ('7', '3', 'TAZETTA', '71', '72.00', 'TAZETTA', '2018-12-21 08:59:17', '2018-12-21 08:59:17', null, '1', null, null, null, null, '1300', 'TAZZETA', null, null, '50');
INSERT INTO unit_types VALUES ('8', '3', 'NOLANA', '46', '46.00', 'NOLANA', '2018-12-21 08:59:51', '2018-12-21 08:59:51', null, '1', null, null, null, null, '1300', 'NOLANA', null, null, '50');
INSERT INTO unit_types VALUES ('9', '3', 'BALLAINE', '99', '160.00', 'BALLAINE', '2018-12-26 00:00:00', '2018-12-26 00:00:00', null, null, null, null, null, null, '0', 'BALLAINE', '0', 'BALLAINE', '50');
INSERT INTO unit_types VALUES ('10', '3', 'ARLINGTON', '191', '190.00', 'Type PEXT2', '2018-12-27 02:19:59', '2018-12-27 02:19:59', null, '44', null, null, null, null, '4400', 'ARLINGTON', null, null, '49');
INSERT INTO unit_types VALUES ('11', '3', 'BALLAINE', '99', '120.00', 'Type PEXT2', '2018-12-27 02:23:01', '2018-12-27 02:23:01', null, '44', null, null, null, null, '3500', 'BALLAINE', null, null, '49');
INSERT INTO unit_types VALUES ('12', '3', 'CRESCENT', '88', '105.00', 'Type PEXT2', '2018-12-27 02:24:48', '2018-12-27 02:24:48', null, '44', null, null, null, null, '3500', 'CRESCENT', null, null, '49');
INSERT INTO unit_types VALUES ('13', '3', 'LINDEN', '71', '90.00', 'Type PEXT2', '2018-12-27 02:28:03', '2018-12-27 02:28:03', null, '44', null, null, null, null, '2200', 'LINDEN', null, null, '49');
INSERT INTO unit_types VALUES ('14', '3', 'DRASHNER', '64', '125.00', 'Type PEXT2', '2018-12-27 02:49:45', '2018-12-27 02:49:45', null, '44', null, null, null, null, '0', 'DRASHNER', null, null, '49');
INSERT INTO unit_types VALUES ('15', '3', 'KAVLING THE DENSE', '0', '125.00', 'Type PEXT2', '2018-12-27 02:51:17', '2018-12-27 02:51:17', null, '44', null, null, null, null, '0', 'P-0', null, null, '49');
INSERT INTO unit_types VALUES ('16', '3', 'KAVLING LAKE LIFE', '0', '205', 'Type PEXT2', '2018-12-27 02:52:39', '2018-12-27 02:56:41', null, '44', '44', null, null, null, '0', 'P27', null, null, '49');
INSERT INTO unit_types VALUES ('17', '3', 'CARRERA', '52', '130.00', 'Type PEXT2', '2018-12-27 02:53:59', '2018-12-27 02:53:59', null, '44', null, null, null, null, '2200', 'P-30', null, null, '49');
INSERT INTO unit_types VALUES ('18', '3333', 'ARLINGTON', '118', '144.00', 'Type PEXT2', '2018-12-27 02:55:08', '2018-12-27 02:55:08', null, '44', null, null, null, null, '2200', 'ARL', null, null, '49999');
INSERT INTO unit_types VALUES ('19', '3', 'KAVLING THE DENSE', '0', '213.00', 'Type PEXT2', '2018-12-27 02:59:39', '2018-12-27 03:01:05', '2018-12-27 03:01:05', '44', '44', '44', null, null, '0', 'P0-A', null, null, '49');
INSERT INTO unit_types VALUES ('20', '3', 'CARLTON', '60', '120.00', 'Type PEXT2', '2018-12-27 03:20:35', '2018-12-27 03:20:35', null, '44', null, null, null, null, '2200', 'CARLTON', null, null, '49');
INSERT INTO unit_types VALUES ('21', '3', 'ALLAMEDA', '67', '123.00', 'Type PEXT2', '2018-12-27 03:27:16', '2018-12-27 03:27:16', null, '44', null, null, null, null, '2200', 'ALLAMEDA', null, null, '49');
INSERT INTO unit_types VALUES ('63', '3', 'VELLOZIA', '99', '136.00', 'Unit non EREMS', '2018-12-28 01:38:59', '2018-12-28 01:38:59', null, '44', null, null, null, null, '3500', 'VELLOZIA', '1044', null, '66');
INSERT INTO unit_types VALUES ('64', '3', 'BALLAINE', '99', '128.00', 'Unit non EREMS', '2018-12-28 01:39:40', '2018-12-28 01:39:40', null, '44', null, null, null, null, '3500', 'BALLAINE', '1362', null, '66');
INSERT INTO unit_types VALUES ('65', '3', 'CASSA', '116', '120.00', 'Unit non EREMS', '2018-12-28 01:40:22', '2018-12-28 01:40:22', null, '44', null, null, null, null, '3500', 'CASSA', '1040', null, '66');
INSERT INTO unit_types VALUES ('66', '3', 'CASPIAN', '71', '96.00', 'Unit non EREMS', '2018-12-28 01:41:01', '2018-12-28 01:41:01', null, '44', null, null, null, null, '2500', 'CASPIAN', '6614', null, '66');
INSERT INTO unit_types VALUES ('67', '3', 'JADIN', '191', '180.00', 'Unit non EREMS', '2018-12-28 01:41:51', '2018-12-28 01:41:51', null, '44', null, null, null, null, '4400', 'JADIN', '6781', null, '66');
INSERT INTO unit_types VALUES ('68', '3', 'VERRE', '69', '94.00', 'Unit non EREMS', '2018-12-28 01:42:35', '2018-12-28 01:42:35', null, '44', null, null, null, null, '2500', 'VERRE', '5304', null, '66');
INSERT INTO unit_types VALUES ('69', '3', 'LOIRE', '96', '126.00', 'Unit non EREMS', '2018-12-28 01:43:28', '2018-12-28 01:43:28', null, '44', null, null, null, null, '3500', 'LOIRE', '969', null, '65');
INSERT INTO unit_types VALUES ('70', '3', 'TUSCIA', '68', '105.00', 'Unit non EREMS', '2018-12-28 01:44:08', '2018-12-28 01:44:08', null, '44', null, null, null, null, '2200', 'TUSCIA', '968', null, '65');
INSERT INTO unit_types VALUES ('71', '3', 'WISTERIA', '64', '123.00', 'Unit non EREMS', '2018-12-28 01:45:30', '2018-12-28 01:45:30', null, '44', null, null, null, null, '2200', 'WISTERIA', null, null, '67');
INSERT INTO unit_types VALUES ('72', '3', 'SERRISA', '93', '92.00', 'Unit non EREMS', '2018-12-28 01:49:50', '2018-12-28 01:49:50', null, '44', null, null, null, null, '3500', 'SERRISA', null, null, '67');
INSERT INTO unit_types VALUES ('73', '3', 'KAVLING AVERSA PARK', '0', '0.00', 'Unit non EREMS', '2018-12-28 02:39:52', '2018-12-28 02:39:52', null, '44', null, null, null, null, '0', 'KAVLING AVERSA PARK', '952', null, '65');
INSERT INTO unit_types VALUES ('74', '3', 'MILTON', '55', '55.00', 'Unit non EREMS', '2018-12-28 02:40:54', '2018-12-28 02:40:54', null, '44', null, null, null, null, '0', 'MILTON', '955', null, '65');
INSERT INTO unit_types VALUES ('75', '3', 'RIALTO', '86', '86.00', 'Unit non EREMS', '2018-12-28 02:41:38', '2018-12-28 02:41:38', null, '44', null, null, null, null, '0', 'RIALTO', '957', null, '65');
INSERT INTO unit_types VALUES ('76', '3', 'MONZA', '72', '61.00', 'Unit non EREMS', '2018-12-28 02:43:47', '2018-12-28 02:43:47', null, '44', null, null, null, null, '1', 'MONZA', '975', null, '65');
INSERT INTO unit_types VALUES ('77', '3', 'KAVLING SPRING LAKE', '0', '0', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 04:26:04', '2018-12-28 04:26:04', null, '1', null, null, null, null, '0', 'BB00', '1035', 'RE', '66');
INSERT INTO unit_types VALUES ('78', '3', 'TRAVIAN', '49', '90', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 04:26:04', '2018-12-28 04:26:04', null, '1', null, null, null, null, '2200', 'BB01', '1036', 'RE', '66');
INSERT INTO unit_types VALUES ('79', '3', 'EVETTE', '78', '90', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 04:26:04', '2018-12-28 04:26:04', null, '1', null, null, null, null, '2200', 'BB02', '1037', 'RE', '66');
INSERT INTO unit_types VALUES ('80', '3', 'TOMA', '57', '105', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 04:26:04', '2018-12-28 04:26:04', null, '1', null, null, null, null, '2200', 'BB03', '1038', 'RE', '66');
INSERT INTO unit_types VALUES ('81', '3', 'ORNA', '90', '105', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 04:26:04', '2018-12-28 04:26:04', null, '1', null, null, null, null, '2200', 'BB04', '1039', 'RE', '66');
INSERT INTO unit_types VALUES ('82', '3', 'ALONA B', '130', '130', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 04:26:04', '2018-12-28 04:26:04', null, '1', null, null, null, null, '2200', 'BB06', '1041', 'RE', '66');
INSERT INTO unit_types VALUES ('83', '3', 'ALONA A', '166', '166', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 04:26:04', '2018-12-28 04:26:04', null, '1', null, null, null, null, '2200', 'BB07', '1042', 'RE', '66');
INSERT INTO unit_types VALUES ('84', '3', 'CASSA A', '135', '180', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 04:26:04', '2018-12-28 04:26:04', null, '1', null, null, null, null, '2200', 'BB08', '1043', 'RE', '66');
INSERT INTO unit_types VALUES ('85', '3', 'VELLOZIA -B', '91', '136', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 04:26:04', '2018-12-28 04:26:04', null, '1', null, null, null, null, '2200', 'BB11', '1046', 'RE', '66');
INSERT INTO unit_types VALUES ('86', '3', 'TECTONA - B', '128', '128', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 04:26:04', '2018-12-28 04:26:04', null, '1', null, null, null, null, '2200', 'F04 ', '1129', 'RE', '66');
INSERT INTO unit_types VALUES ('87', '3', 'GLENDORA', '123', '128', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 04:26:04', '2018-12-28 04:26:04', null, '1', null, null, null, null, '2200', 'M-11', '1273', 'RE', '66');
INSERT INTO unit_types VALUES ('88', '3', 'DIANELLA', '53', '53', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 04:26:04', '2018-12-28 04:26:04', null, '1', null, null, null, null, '2200', 'U10', '5143', 'RE', '66');
INSERT INTO unit_types VALUES ('89', '3', 'DAMAR', '29', '72', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 05:21:43', '2018-12-28 05:21:43', null, '1', null, null, null, null, '0', '', '881', 'RE', null);
INSERT INTO unit_types VALUES ('90', '3', 'KAV ZEPHYR VALLEY', '0', '0', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 05:21:43', '2018-12-28 05:21:43', null, '1', null, null, null, null, '0', '', '1260', 'RE', null);
INSERT INTO unit_types VALUES ('91', '3', 'KAVLING BLOK Q', '0', '0', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 05:21:43', '2018-12-28 05:21:43', null, '1', null, null, null, null, '0', '', '1409', 'RE', null);
INSERT INTO unit_types VALUES ('92', '3', 'DAVIDIA - A', '80', '136', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 05:21:43', '2018-12-28 05:21:43', null, '1', null, null, null, null, '2200', '', '1410', 'RE', null);
INSERT INTO unit_types VALUES ('93', '3', 'DAVIDIA - B', '86', '120', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 05:21:43', '2018-12-28 05:21:43', null, '1', null, null, null, null, '2200', '', '1411', 'RE', null);
INSERT INTO unit_types VALUES ('94', '3', 'DAVIDIA - C', '97', '136', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 05:21:43', '2018-12-28 05:21:43', null, '1', null, null, null, null, '2200', '', '1412', 'RE', null);
INSERT INTO unit_types VALUES ('95', '3', 'ASTILBE - A', '60', '119', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 05:21:43', '2018-12-28 05:21:43', null, '1', null, null, null, null, '2200', '', '1413', 'RE', null);
INSERT INTO unit_types VALUES ('96', '3', 'MANETTIA', '127', '180', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 05:21:43', '2018-12-28 05:21:43', null, '1', null, null, null, null, '2200', '', '1415', 'RE', null);
INSERT INTO unit_types VALUES ('97', '3', 'SERISSA - A', '93', '0', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 05:21:43', '2018-12-28 05:21:43', null, '1', null, null, null, null, '2200', '', '1416', 'RE', null);
INSERT INTO unit_types VALUES ('98', '3', 'SERISSA - B', '93', '0', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 05:21:43', '2018-12-28 05:21:43', null, '1', null, null, null, null, '2200', '', '1417', 'RE', null);
INSERT INTO unit_types VALUES ('99', '3', 'FLORETA', '145', '0', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 05:21:43', '2018-12-28 05:21:43', null, '1', null, null, null, null, '2200', '', '1418', 'RE', null);
INSERT INTO unit_types VALUES ('100', '3', 'KAVLING BLOK Q', '0', '0', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 05:21:43', '2018-12-28 05:21:43', null, '1', null, null, null, null, '0', '', '1419', 'RE', null);
INSERT INTO unit_types VALUES ('101', '3', 'WISTERIA', '64', '0', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 05:21:43', '2018-12-28 05:21:43', null, '1', null, null, null, null, '2200', '', '5145', 'RE', null);
INSERT INTO unit_types VALUES ('102', '3', 'WISTERIA', '64', '0', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 05:21:43', '2018-12-28 05:21:43', null, '1', null, null, null, null, '2200', '', '5146', 'RE', null);
INSERT INTO unit_types VALUES ('220', '1', 'OC01 ', '39', '90', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'OC01 ', '592', 'RE', '47');
INSERT INTO unit_types VALUES ('221', '1', 'OC02 ', '45', '120', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'OC02 ', '593', 'RE', '47');
INSERT INTO unit_types VALUES ('222', '1', 'OC04A', '59', '136', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'OC04A', '594', 'RE', '47');
INSERT INTO unit_types VALUES ('223', '1', 'OC1A ', '39', '120', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'OC1A ', '595', 'RE', '47');
INSERT INTO unit_types VALUES ('224', '1', 'OC2RC', '45', '136', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'OC2RC', '597', 'RE', '47');
INSERT INTO unit_types VALUES ('225', '1', 'OC3A ', '45', '170', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'OC3A ', '598', 'RE', '47');
INSERT INTO unit_types VALUES ('226', '1', 'OC4A ', '59', '160', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'OC4A ', '599', 'RE', '47');
INSERT INTO unit_types VALUES ('227', '1', 'OC4RC', '59', '136', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'OC4RC', '600', 'RE', '47');
INSERT INTO unit_types VALUES ('228', '1', 'OC5RC', '70', '136', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'OC5RC', '601', 'RE', '47');
INSERT INTO unit_types VALUES ('229', '1', 'OC05', '70', '160', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'OC05', '778', 'RE', '47');
INSERT INTO unit_types VALUES ('230', '1', 'OC02A', '45', '136', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'OC02A', '788', 'RE', '47');
INSERT INTO unit_types VALUES ('231', '1', 'KPDAM', '0', '1000', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '0', 'KPDAM', '789', 'RE', null);
INSERT INTO unit_types VALUES ('232', '1', 'CR03', '36', '90', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'CR03', '794', 'RS', null);
INSERT INTO unit_types VALUES ('233', '1', 'OC02A HOEK', '45', '136', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'OC02A HOEK', '803', 'RE', '47');
INSERT INTO unit_types VALUES ('234', '1', 'OC1C', '39', '128', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'OC1C', '878', 'RE', '47');
INSERT INTO unit_types VALUES ('235', '1', 'OC3A', '45', '170', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'OC3A', '879', 'RE', '47');
INSERT INTO unit_types VALUES ('236', '1', 'OC3A H', '45', '170', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'OC3A H', '880', 'RE', '47');
INSERT INTO unit_types VALUES ('237', '1', 'OC03', '45', '160', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'OC03', '2846', 'RE', '47');
INSERT INTO unit_types VALUES ('238', '1', 'ROC01', '71', '75', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '2200', 'ROC01', '6755', 'RE', '48');
INSERT INTO unit_types VALUES ('239', '1', 'ROC02', '56', '60', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '2200', 'ROC02', '6756', 'RE', '48');
INSERT INTO unit_types VALUES ('240', '1', 'ROC03', '56', '60', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '2200', 'ROC03', '6757', 'RE', '48');
INSERT INTO unit_types VALUES ('241', '1', 'SL01', '33', '84', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'SL01', '8860', 'RE', '45');
INSERT INTO unit_types VALUES ('242', '1', 'SL02', '36', '90', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'SL02', '8861', 'RE', '45');
INSERT INTO unit_types VALUES ('243', '1', 'SL03', '36', '105', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'SL03', '8862', 'RE', '45');
INSERT INTO unit_types VALUES ('244', '1', 'SL01H', '33', '84', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'SL01H', '8865', 'RS', '45');
INSERT INTO unit_types VALUES ('245', '1', 'SL02H', '36', '90', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'SL02H', '8866', 'RS', '45');
INSERT INTO unit_types VALUES ('246', '1', 'SL03H', '36', '105', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'SL03H', '8867', 'RS', '45');
INSERT INTO unit_types VALUES ('247', '1', 'SL04', '38', '120', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'SL04', '8868', 'RS', '45');
INSERT INTO unit_types VALUES ('248', '1', 'SL04H', '38', '120', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'SL04H', '8869', 'RS', '45');
INSERT INTO unit_types VALUES ('249', '1', 'SL4RC', '38', '120', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'SL4RC', '9141', 'RE', '45');
INSERT INTO unit_types VALUES ('250', '1', 'SL3RC', '36', '105', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'SL3RC', '9142', 'RE', '45');
INSERT INTO unit_types VALUES ('251', '1', 'SL1RC', '33', '105', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'SL1RC', '9143', 'RE', '45');
INSERT INTO unit_types VALUES ('252', '1', 'OC2G', '45', '160', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'OC2G', '9176', 'RE', '47');
INSERT INTO unit_types VALUES ('253', '1', 'SK01', '35', '90', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'SK01', '9177', 'RE', '46');
INSERT INTO unit_types VALUES ('254', '1', 'SK1A', '35', '102', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'SK1A', '9178', 'RE', '46');
INSERT INTO unit_types VALUES ('255', '1', 'SK02', '39', '120', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'SK02', '9179', 'RE', '46');
INSERT INTO unit_types VALUES ('256', '1', 'SK03', '45', '120', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'SK03', '9180', 'RE', '46');
INSERT INTO unit_types VALUES ('257', '1', 'SK04', '45', '150', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'SK04', '9181', 'RE', '46');
INSERT INTO unit_types VALUES ('258', '1', 'SK4G', '45', '170', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 09:34:17', '2018-12-28 09:34:17', null, '1', null, null, null, null, '1300', 'SK4G', '9182', 'RE', '46');
INSERT INTO unit_types VALUES ('259', '60', 'LEBAR 12 360/288', '288', '360.00', 'Unt', '2019-01-08 03:37:05', '2019-01-08 03:37:05', null, '30', null, null, null, null, '2200', 'LEBAR 12 360/288', null, null, '70');
INSERT INTO unit_types VALUES ('260', '3', 'Ruko I KT', '81', '59.00', 'Ruko IKT', '2019-01-09 02:15:04', '2019-01-09 02:15:04', null, '44', null, null, null, null, '4400', 'RIKT', null, null, '80');
INSERT INTO unit_types VALUES ('261', '60', 'L8 STD', '112', '120.00', 'RUMAH LEBAR 8 - CLUSTER LAGOON RESIDENCE', '2019-01-09 06:57:37', '2019-01-09 06:57:37', null, '30', null, null, null, null, '3500', 'L8 STD', null, null, '74');
INSERT INTO unit_types VALUES ('262', '60', 'L 10 STD A', '135', '180.00', 'RUMAH LEBAR 10 STD A - LAGOON RESIDENCE', '2019-01-09 07:04:06', '2019-01-09 07:04:06', null, '30', null, null, null, null, '4400', 'L 10 STD A', null, null, '74');
INSERT INTO unit_types VALUES ('263', '60', 'L 10 STD B', '185', '180.00', 'RUMAH LEBAR 10 STD B - LAGOON RESIDENCE', '2019-01-09 07:07:26', '2019-01-09 07:07:26', null, '30', null, null, null, null, '4400', 'L 10 STD B', null, null, '74');
INSERT INTO unit_types VALUES ('264', '60', 'L 10 135-150', '135', '150.00', 'RUMAH LEBAR 10 135-150 - LAGOON RESIDENCE', '2019-01-09 07:09:52', '2019-01-09 07:09:52', null, '30', null, null, null, null, '4400', 'L 10 135-150', null, null, '74');
INSERT INTO unit_types VALUES ('265', '60', 'L10 135-180', '135', '180.00', 'RUMAH LEBAR L 10 135-180 - LAGOON RESIDENCE', '2019-01-09 07:12:51', '2019-01-09 07:12:51', null, '30', null, null, null, null, '4400', 'L10 135-180', null, null, '74');
INSERT INTO unit_types VALUES ('266', '60', 'L 10 185-150', '185', '150.00', 'RUMAH LEBAR 10 185-150 - LAGOON RESIDENCE', '2019-01-09 07:18:32', '2019-01-09 07:18:32', null, '30', null, null, null, null, '4400', 'L10 185-150', null, null, '74');
INSERT INTO unit_types VALUES ('267', '60', 'L 10 185-180', '185', '180.00', 'RUMAH LEBAR 10 185-180 - LAGOON RESIDENCE', '2019-01-09 07:21:47', '2019-01-09 07:21:47', null, '30', null, null, null, null, '4400', 'L 10 185-180', null, null, '74');
INSERT INTO unit_types VALUES ('268', '60', 'L6 STD', '63', '72', 'RUMAH LEBAR 6 STD - FRASER PARK', '2019-01-09 07:24:19', '2019-01-09 07:26:19', null, '30', '30', null, null, null, '2200', 'L6 STD', null, null, '75');
INSERT INTO unit_types VALUES ('269', '60', 'L6 STD-10', '63', '60.00', 'RUMAH LEBAR STD 6 -10 - FRASER PARK', '2019-01-09 07:27:06', '2019-01-09 07:27:06', null, '30', null, null, null, null, '2200', 'L6 STD-10', null, null, '75');
INSERT INTO unit_types VALUES ('270', '60', 'L6 STD-15', '63', '90.00', 'RUMAH LEBAR 6 STD-15 - FRASER PARK', '2019-01-09 07:31:38', '2019-01-09 07:31:38', null, '30', null, null, null, null, '2200', 'L6 STD-15', null, null, '75');
INSERT INTO unit_types VALUES ('271', '60', 'L6 STD-92', '63', '92.00', 'RUMAH LEBAR 6 STD-92 - FRASER PARK', '2019-01-09 07:33:48', '2019-01-09 07:33:48', null, '30', null, null, null, null, '2200', 'L6 STD-92', null, null, '75');
INSERT INTO unit_types VALUES ('272', '60', 'L6 STD 56', '56', '72.00', 'RUMAH LUAS 56 STD - FRASER PARK', '2019-01-09 07:36:20', '2019-01-09 07:36:20', null, '30', null, null, null, null, '2200', 'L6 STD 56', null, null, '75');
INSERT INTO unit_types VALUES ('273', '60', 'L6 STD 56-10', '56', '60.00', 'RUMAH LUAS 56 STD-10 - FRASER PARK', '2019-01-09 07:39:57', '2019-01-09 07:41:46', null, '30', '30', null, null, null, '2200', 'L6 56 STD-10', null, null, '75');
INSERT INTO unit_types VALUES ('274', '60', 'L6 STD 56-15', '56', '90.00', 'RUMAH LUAS 56 STD-15 - FRASER PARK', '2019-01-09 07:43:00', '2019-01-09 07:43:00', null, '30', null, null, null, null, '2200', 'L6 STD 56-15', null, null, '75');
INSERT INTO unit_types VALUES ('275', '60', 'L6 BRT', '63', '72.00', 'RUMAH LEBAR 6 BRT - FRASER PARK', '2019-01-09 07:44:43', '2019-01-09 07:44:43', null, '30', null, null, null, null, '2200', 'L6 BRT', null, null, '75');
INSERT INTO unit_types VALUES ('276', '60', 'L56 BRT', '56', '72.00', 'RUMAH LUAS 56 BRT - FRASER PARK', '2019-01-09 07:48:35', '2019-01-09 07:48:35', null, '30', null, null, null, null, '2200', 'L56 BRT', null, null, '75');
INSERT INTO unit_types VALUES ('277', '60', 'L7 STD', '86', '105.00', 'RUMAH LEBAR 7 STD - FRASER PARK', '2019-01-09 07:53:14', '2019-01-09 07:53:14', null, '30', null, null, null, null, '3500', 'L7 STD', null, null, '75');
INSERT INTO unit_types VALUES ('278', '60', 'L7 BRT', '86', '84.00', 'RUMAH LEBAR 7 BRT - FRASER PARK', '2019-01-09 07:56:58', '2019-01-09 07:56:58', null, '30', null, null, null, null, '3500', 'L7 BRT', null, null, '75');
INSERT INTO unit_types VALUES ('279', '60', 'L6 STD', '63', '72.00', 'RUMAH LEBAR 6 STD - BLOK B', '2019-01-09 08:02:40', '2019-01-09 08:02:40', null, '30', null, null, null, null, '2200', 'L6 STD', null, null, '71');
INSERT INTO unit_types VALUES ('280', '60', 'L6 STD-15', '63', '90.00', 'RUMAH LEBAR 6 STD-15 - B', '2019-01-09 08:04:53', '2019-01-09 08:04:53', null, '30', null, null, null, null, '2200', 'L6 STD-15', null, null, '71');
INSERT INTO unit_types VALUES ('281', '60', 'L6 STD-21', '63', '126.00', 'RUMAH L6 STD-21 - BLOK B', '2019-01-09 08:07:47', '2019-01-09 08:07:47', null, '30', null, null, null, null, '2200', 'L 6 STD-21', null, null, '71');
INSERT INTO unit_types VALUES ('282', '60', 'L7 STD', '86', '105.00', 'RUMAH LEBAR 7 STD - BLOK B', '2019-01-09 08:10:37', '2019-01-09 08:10:37', null, '30', null, null, null, null, '3500', 'L7 STD', null, null, '71');
INSERT INTO unit_types VALUES ('283', '60', 'L8 STD-18', '112', '144.00', 'RUMAH L8 STD-18 - BLOK B', '2019-01-09 08:14:27', '2019-01-09 08:25:28', '2019-01-09 08:25:28', '30', '30', '30', null, null, '3500', 'L8 STD-18', null, null, '71');
INSERT INTO unit_types VALUES ('284', '60', 'L7 BRT', '86', '84.00', 'RUMAH LEBAR 7 BRT - BLOK B', '2019-01-09 08:26:10', '2019-01-09 08:26:10', null, '30', null, null, null, null, '3500', 'L7 BRT', null, null, '71');
INSERT INTO unit_types VALUES ('285', '60', 'L7 STD-18', '86', '126.00', 'RUMAH LEBAR 7 STD-18 - BLOK B', '2019-01-09 08:29:54', '2019-01-09 08:29:54', null, '30', null, null, null, null, '3500', 'L7 STD-18', null, null, '71');
INSERT INTO unit_types VALUES ('286', '60', 'L 8 STD', '112', '120.00', 'RUMAH L8 STD - BLOK G', '2019-01-09 08:35:26', '2019-01-09 08:35:26', null, '30', null, null, null, null, '3500', 'L8 STD', null, null, '76');
INSERT INTO unit_types VALUES ('287', '60', 'L12 STD-20', '180', '240.00', 'RUMAH LEBAR 12 STD-20 - BLOK G', '2019-01-09 08:38:54', '2019-01-09 08:38:54', null, '30', null, null, null, null, '4400', 'L12 STD-20', null, null, '76');
INSERT INTO unit_types VALUES ('288', '60', 'L10 185-150', '185', '150.00', 'RUMAH LEBAR 10 185-150 - BLOK G', '2019-01-09 08:42:26', '2019-01-09 08:42:26', null, '30', null, null, null, null, '4400', 'L10 185-150', null, null, '76');
INSERT INTO unit_types VALUES ('289', '60', 'L10 185-180', '185', '180.00', 'RUMAH LEBAR 10 185-180', '2019-01-09 08:45:19', '2019-01-09 08:45:19', null, '30', null, null, null, null, '4400', 'L10 185-180', null, null, '76');
INSERT INTO unit_types VALUES ('290', '60', 'KAV B', '0', '1412.79', 'KAVLING BLOK B', '2019-01-09 08:50:40', '2019-01-09 08:50:40', null, '30', null, null, null, null, '0', 'KAV B', null, null, '71');
INSERT INTO unit_types VALUES ('291', '60', 'KAV G', '0', '319.82', 'KAVLING BLOK G', '2019-01-09 08:52:40', '2019-01-09 08:52:40', null, '30', null, null, null, null, '0', 'KAV G', null, null, '76');
INSERT INTO unit_types VALUES ('292', '60', 'L6 STD', '63', '72.00', 'RUMAH LEBAR 6 STD - BLOK C', '2019-01-09 08:56:04', '2019-01-09 08:56:04', null, '30', null, null, null, null, '2200', 'L6 STD', null, null, '72');
INSERT INTO unit_types VALUES ('293', '60', 'L7 STD', '86', '105.00', 'RUMAH LEBAR 7 STD - BLOK C', '2019-01-09 08:58:07', '2019-01-09 08:58:07', null, '30', null, null, null, null, '3500', 'L7 STD', null, null, '72');
INSERT INTO unit_types VALUES ('294', '60', 'L8 STD', '112', '120.00', 'RUMAH L8 STD - BLOK C', '2019-01-09 09:04:05', '2019-01-09 09:04:05', null, '30', null, null, null, null, '3500', 'L8 STD', null, null, '72');
INSERT INTO unit_types VALUES ('295', '60', 'L8 STD-17', '112', '136.00', 'RUMAH LEBAR 8 STD-17 - BLOK C', '2019-01-09 09:06:23', '2019-01-09 09:06:23', null, '30', null, null, null, null, '3500', 'L8 STD-17', null, null, '72');
INSERT INTO unit_types VALUES ('296', '60', 'L 10 STD-17', '185', '170.00', 'RUMAH LEBAR 10 STD-17 - BLOK C', '2019-01-09 09:09:03', '2019-01-09 09:09:03', null, '30', null, null, null, null, '4400', 'L10 STD-17', null, null, '72');
INSERT INTO unit_types VALUES ('297', '60', 'L10 185-180', '185', '180.00', 'RUMAH L10 185-180 - BLOK C', '2019-01-09 09:11:06', '2019-01-09 09:11:06', null, '30', null, null, null, null, '4400', 'L10 185-180', null, null, '72');
INSERT INTO unit_types VALUES ('298', '60', 'Kav C', '0', '12434.00', 'KAVLING BLOK C', '2019-01-09 09:14:46', '2019-01-09 09:14:46', null, '30', null, null, null, null, '0', 'Kav C', null, null, '72');
INSERT INTO unit_types VALUES ('299', '60', 'L10 185-210', '185', '210.00', 'RUMAH LEBAR 10 185-210', '2019-01-09 09:16:42', '2019-01-09 09:16:42', null, '30', null, null, null, null, '4400', 'L10 185-210', null, null, '73');
INSERT INTO unit_types VALUES ('300', '60', 'L10 185-200', '185', '200.00', 'RUMAH LEBAR 10 185-200 - BLOK D', '2019-01-09 09:20:25', '2019-01-09 09:20:25', null, '30', null, null, null, null, '4400', 'L 10 185-200', null, null, '73');
INSERT INTO unit_types VALUES ('301', '60', 'Kav D', '0', '1678.00', 'KAVLING BLOK D', '2019-01-09 09:22:45', '2019-01-09 09:22:45', null, '30', null, null, null, null, '0', 'Kav D', null, null, '73');
INSERT INTO unit_types VALUES ('302', '60', 'L6 STD', '63', '72.00', 'RUMAH LEBAR 6 STD - BLOK A', '2019-01-09 09:25:59', '2019-01-09 09:25:59', null, '30', null, null, null, null, '2200', 'L6 STD', null, null, '70');
INSERT INTO unit_types VALUES ('303', '60', 'L6 STD-15', '63', '90.00', 'RUMAH LEBAR 6 STD-15', '2019-01-09 09:27:41', '2019-01-09 09:28:33', '2019-01-09 09:28:33', '30', '30', '30', null, null, '2200', 'L6 STD-15', null, null, '70');
INSERT INTO unit_types VALUES ('304', '60', 'L6 STD-15', '63', '90.00', 'RUMAH LEBAR 6 STD-15 - BLOK A', '2019-01-09 09:29:22', '2019-01-09 09:29:22', null, '30', null, null, null, null, '2200', 'L6 STD-15', null, null, '70');
INSERT INTO unit_types VALUES ('305', '60', 'L8 STD', '112', '120.00', 'RUMAH LEBAR 8 STD - BLOK A', '2019-01-09 09:30:44', '2019-01-09 09:30:44', null, '30', null, null, null, null, '3500', 'L8 STD', null, null, '70');
INSERT INTO unit_types VALUES ('306', '60', 'L8 STD-17', '112', '136.00', 'RUMAH LEBAR 8 STD-17 - BLOK A', '2019-01-09 09:32:10', '2019-01-09 09:32:10', null, '30', null, null, null, null, '3500', 'L8 STD-17', null, null, '70');
INSERT INTO unit_types VALUES ('307', '60', 'L8 STD-18', '112', '144.00', 'RUMAH LEBAR 8 STD-18 - BLOK A', '2019-01-09 09:33:14', '2019-01-09 09:33:14', null, '30', null, null, null, null, '3500', 'L8 STD-18', null, null, '70');
INSERT INTO unit_types VALUES ('308', '60', 'L10 185-180', '185', '180.00', 'RUMAH LEBAR 10 185-180 - BLOK A', '2019-01-09 09:34:25', '2019-01-09 09:34:25', null, '30', null, null, null, null, '4400', 'L10 185-180', null, null, '70');
INSERT INTO unit_types VALUES ('309', '9', 'Tipe 80', '80', '100.00', '..', '2019-01-09 09:38:20', '2019-01-09 09:42:08', '2019-01-09 09:42:08', '37', '37', '37', null, null, '1300', '80', null, null, '68');
INSERT INTO unit_types VALUES ('310', '9', 'Tipe 80', '80', '100.00', '..', '2019-01-09 09:42:51', '2019-01-09 09:42:51', null, '37', null, null, null, null, '1300', '80', null, null, '68');
INSERT INTO unit_types VALUES ('311', '60', 'Kav A', '0', '882.73', 'Kavling Blok A', '2019-01-09 09:42:57', '2019-01-09 09:42:57', null, '30', null, null, null, null, '0', 'Kav A', null, null, '70');
INSERT INTO unit_types VALUES ('312', '60', 'L6 56-10', '56', '60.00', 'Unit Rumah', '2019-01-18 11:13:51', '2019-01-18 11:13:51', null, '30', null, null, null, null, '2200', 'L6 56-10', null, null, '75');
INSERT INTO unit_types VALUES ('313', '60', 'L6 56', '56', '72.00', 'Type Baru', '2019-01-18 11:14:43', '2019-01-18 11:14:43', null, '30', null, null, null, null, '2200', 'L6 56', null, null, '75');
INSERT INTO unit_types VALUES ('314', '60', 'L6 56-15', '56', '90.00', 'R', '2019-01-18 11:17:56', '2019-01-18 11:17:56', null, '30', null, null, null, null, '2200', 'L6 56-15', null, null, '75');
INSERT INTO unit_types VALUES ('315', '60', 'L6 56-92', '56', '92.00', 'R', '2019-01-18 11:20:38', '2019-01-18 11:20:38', null, '30', null, null, null, null, '2200', 'L6 56-92', null, null, '75');
INSERT INTO unit_types VALUES ('316', '9', '55', '55', '60.00', 'tipe', '2019-01-22 08:20:48', '2019-01-22 08:20:48', null, '37', null, null, null, null, '1300', '55', null, null, '93');
