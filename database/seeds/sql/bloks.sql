/*
Navicat MySQL Data Transfer

Source Server         : 117.53.46.38
Source Server Version : 50561
Source Host           : 117.53.46.38:3306
Source Database       : zadmin_qs

Target Server Type    : MYSQL
Target Server Version : 50561
File Encoding         : 65001

Date: 2019-01-23 17:06:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bloks
-- ----------------------------
DROP TABLE IF EXISTS bloks;
CREATE TABLE bloks (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `project_kawasan_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `luas` double(10,2) DEFAULT '1.00',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  `kode` varchar(21) COLLATE utf8mb4_unicode_ci NOT NULL,
  `block_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bloks_project_id_project_kawasan_id_index` (`project_id`,`project_kawasan_id`),
  KEY `blok_id` (`block_id`)
) ENGINE=InnoDB AUTO_INCREMENT=236 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of bloks
-- ----------------------------
INSERT INTO bloks VALUES ('25', '66', '12', 'Blok A', '0.00', 'Migration from Erem based export at 18 Oct 2018', '2018-10-25 22:57:05', '2018-10-25 22:57:05', null, null, null, null, null, null, 'A', '3356');
INSERT INTO bloks VALUES ('26', '66', '12', 'Blok B', '0.00', 'Migration from Erem based export at 18 Oct 2018', '2018-10-25 22:57:05', '2018-10-25 22:57:05', null, null, null, null, null, null, 'B', '3357');
INSERT INTO bloks VALUES ('27', '66', '12', 'Blok C', '0.00', 'Migration from Erem based export at 18 Oct 2018', '2018-10-25 22:57:05', '2018-10-25 22:57:05', null, null, null, null, null, null, 'C', '3358');
INSERT INTO bloks VALUES ('28', '66', '12', 'Blok D', '0.00', 'Migration from Erem based export at 18 Oct 2018', '2018-10-25 22:57:05', '2018-10-25 22:57:05', null, null, null, null, null, null, 'D', '3359');
INSERT INTO bloks VALUES ('29', '66', '12', 'Blok E', '0.00', null, '2018-10-26 00:42:05', '2018-10-26 00:42:05', null, null, null, null, null, null, 'E', '3340');
INSERT INTO bloks VALUES ('31', '82', '13', 'A1', '0.00', null, '2018-10-31 20:36:29', '2018-10-31 20:36:29', null, null, null, null, null, null, 'A', null);
INSERT INTO bloks VALUES ('32', '82', '13', 'A2', '0.00', null, '2018-10-31 21:07:36', '2018-10-31 21:07:36', null, null, null, null, null, null, 'A2', null);
INSERT INTO bloks VALUES ('33', '82', '13', 'A3', '0.00', null, '2018-10-31 21:14:11', '2018-10-31 21:14:11', null, null, null, null, null, null, 'A3', null);
INSERT INTO bloks VALUES ('34', '82', '14', 'A4', '0.00', null, '2018-10-31 21:14:59', '2018-10-31 21:14:59', null, null, null, null, null, null, 'A4', null);
INSERT INTO bloks VALUES ('35', '82', '14', 'A5', '0.00', null, '2018-10-31 21:16:08', '2018-10-31 21:16:08', null, null, null, null, null, null, 'A5', null);
INSERT INTO bloks VALUES ('37', '9', '35', 'C09', '0.00', null, '2018-11-13 12:38:26', '2018-11-13 13:14:11', null, null, null, null, null, null, 'C09', '15300');
INSERT INTO bloks VALUES ('38', '9', '35', 'C10', '0.00', null, '2018-11-13 12:43:02', '2018-11-13 13:22:08', null, null, null, null, null, null, 'C10', '15301');
INSERT INTO bloks VALUES ('39', '9', '35', 'C11', '0.00', null, '2018-11-13 12:47:31', '2018-11-13 12:47:34', null, null, null, null, null, null, 'C11', '15302');
INSERT INTO bloks VALUES ('40', '9', '39', 'D01', '0.00', null, '2018-11-13 12:54:39', '2018-11-13 13:21:13', null, null, null, null, null, null, 'D01', '15303');
INSERT INTO bloks VALUES ('41', '9', '39', 'D02', '0.00', null, '2018-11-13 13:19:25', '2018-11-13 13:19:30', null, null, null, null, null, null, 'D02', '15304');
INSERT INTO bloks VALUES ('42', '9', '41', 'A1', '0.00', null, '2018-11-15 10:09:53', '2018-11-15 10:10:02', null, null, null, null, null, null, 'A1', '15307');
INSERT INTO bloks VALUES ('43', '9', '41', 'A2', '0.00', null, '2018-11-15 10:10:48', '2018-11-15 10:10:52', null, null, null, null, null, null, 'A2', '15308');
INSERT INTO bloks VALUES ('44', '9', '40', 'A3', '0.00', null, '2018-11-15 10:15:19', '2018-11-15 10:15:23', null, null, null, null, null, null, 'A3', '15309');
INSERT INTO bloks VALUES ('45', '9', '40', 'A4', '0.00', null, '2018-11-15 10:15:48', '2018-11-15 10:15:52', null, null, null, null, null, null, 'A4', '15310');
INSERT INTO bloks VALUES ('46', '9', '41', 'A5', '0.00', null, '2018-11-15 10:16:21', '2018-11-15 10:16:22', null, null, null, null, null, null, 'A5', '15311');
INSERT INTO bloks VALUES ('47', '9', '42', '2', '2.00', null, '2018-12-17 08:29:59', '2018-12-17 08:29:59', null, null, null, null, null, null, '2', null);
INSERT INTO bloks VALUES ('69', '3', '50', 'BLOK CC', '0.00', 'Migration from Erem based export at 18 Oct 2018', '2018-12-20 08:55:14', '2018-12-20 08:55:14', null, null, null, null, null, null, 'CLGRD', '15293');
INSERT INTO bloks VALUES ('70', '3', '50', 'CC10', '0.00', null, '2018-12-26 09:20:37', '2018-12-26 09:20:37', null, null, null, null, null, null, 'CC10', null);
INSERT INTO bloks VALUES ('71', '3', '50', 'CC11', '0.00', null, '2018-12-26 09:26:17', '2018-12-26 09:26:17', null, null, null, null, null, null, 'CC11', null);
INSERT INTO bloks VALUES ('72', '3', '50', 'CC12', '0.00', null, '2018-12-26 09:32:42', '2018-12-26 09:32:42', null, null, null, null, null, null, 'CC12', null);
INSERT INTO bloks VALUES ('73', '3', '50', 'CC15', '0.00', null, '2018-12-26 09:34:02', '2018-12-26 09:34:02', null, null, null, null, null, null, 'CC15', null);
INSERT INTO bloks VALUES ('114', '3', '50', 'CC1', '0.00', null, '2018-12-27 07:30:47', '2018-12-27 07:30:47', null, null, null, null, null, null, 'CC1', null);
INSERT INTO bloks VALUES ('115', '3', '50', 'CC2', '0.00', null, '2018-12-27 07:30:59', '2018-12-27 07:30:59', null, null, null, null, null, null, 'CC2', null);
INSERT INTO bloks VALUES ('116', '3', '50', 'CC03', '0.00', null, '2018-12-27 07:31:15', '2018-12-27 07:31:15', null, null, null, null, null, null, 'CC03', null);
INSERT INTO bloks VALUES ('117', '3', '50', 'CC05', '0.00', null, '2018-12-27 07:31:42', '2018-12-27 07:31:42', null, null, null, null, null, null, 'CC05', null);
INSERT INTO bloks VALUES ('118', '3', '50', 'CC06', '0.00', null, '2018-12-27 07:31:59', '2018-12-27 07:31:59', null, null, null, null, null, null, 'CC06', null);
INSERT INTO bloks VALUES ('119', '3', '50', 'CC07', '0.00', null, '2018-12-27 07:32:11', '2018-12-27 07:32:11', null, null, null, null, null, null, 'CC07', null);
INSERT INTO bloks VALUES ('120', '3', '50', 'CC08', '0.00', null, '2018-12-27 07:32:25', '2018-12-27 07:32:25', null, null, null, null, null, null, 'CC08', null);
INSERT INTO bloks VALUES ('121', '3', '50', 'CC09', '0.00', null, '2018-12-27 07:32:53', '2018-12-27 07:32:53', null, null, null, null, null, null, 'CC09', null);
INSERT INTO bloks VALUES ('122', '3', '50', 'CC17', '0.00', null, '2018-12-27 07:48:19', '2018-12-27 07:48:19', null, null, null, null, null, null, 'CC17', null);
INSERT INTO bloks VALUES ('123', '3', '50', 'CC16', '0.00', null, '2018-12-27 08:26:34', '2018-12-27 08:26:34', null, null, null, null, null, null, 'CC16', null);
INSERT INTO bloks VALUES ('124', '3', '65', 'AA05', '0.00', null, '2018-12-28 03:01:51', '2018-12-28 03:01:51', null, null, null, null, null, null, 'AA05', '3406');
INSERT INTO bloks VALUES ('125', '3', '66', 'Blok BB01', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 03:21:44', '2018-12-28 03:21:44', null, null, null, null, null, null, 'BB01', '3424');
INSERT INTO bloks VALUES ('126', '3', '66', 'Blok BB02', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 03:21:44', '2018-12-28 03:21:44', null, null, null, null, null, null, 'BB02', '3425');
INSERT INTO bloks VALUES ('127', '3', '66', 'Blok BB03', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 03:21:44', '2018-12-28 03:21:44', null, null, null, null, null, null, 'BB03', '3426');
INSERT INTO bloks VALUES ('128', '3', '66', 'Blok BB05', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 03:21:44', '2018-12-28 03:21:44', null, null, null, null, null, null, 'BB05', '3427');
INSERT INTO bloks VALUES ('129', '3', '66', 'Blok BB06', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 03:21:44', '2018-12-28 03:21:44', null, null, null, null, null, null, 'BB06', '3428');
INSERT INTO bloks VALUES ('130', '3', '66', 'Blok BB07', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 03:21:44', '2018-12-28 03:21:44', null, null, null, null, null, null, 'BB07', '3429');
INSERT INTO bloks VALUES ('131', '3', '66', 'Blok BB08', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 03:21:44', '2018-12-28 03:21:44', null, null, null, null, null, null, 'BB08', '3430');
INSERT INTO bloks VALUES ('132', '3', '66', 'Blok BB09', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 03:21:44', '2018-12-28 03:21:44', null, null, null, null, null, null, 'BB09', '3431');
INSERT INTO bloks VALUES ('133', '3', '66', 'Blok BB10', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 03:21:44', '2018-12-28 03:21:44', null, null, null, null, null, null, 'BB10', '3432');
INSERT INTO bloks VALUES ('134', '3', '67', 'Blok Q01', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 05:15:51', '2018-12-28 05:15:51', null, null, null, null, null, null, 'Q01', '3615');
INSERT INTO bloks VALUES ('135', '3', '67', 'Blok Q02', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 05:15:51', '2018-12-28 05:15:51', null, null, null, null, null, null, 'Q02', '3616');
INSERT INTO bloks VALUES ('136', '3', '67', 'Blok Q03', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 05:15:51', '2018-12-28 05:15:51', null, null, null, null, null, null, 'Q03', '3617');
INSERT INTO bloks VALUES ('137', '3', '67', 'Blok Q05', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 05:15:51', '2018-12-28 05:15:51', null, null, null, null, null, null, 'Q05', '3618');
INSERT INTO bloks VALUES ('138', '3', '67', 'Blok Q06', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 05:15:51', '2018-12-28 05:15:51', null, null, null, null, null, null, 'Q06', '3619');
INSERT INTO bloks VALUES ('139', '1', '47', 'Blok BE.17', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'BE.17', '2342');
INSERT INTO bloks VALUES ('140', '1', '47', 'Blok BE.11', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'BE.11', '2354');
INSERT INTO bloks VALUES ('141', '1', '47', 'Blok BE.02', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'BE.02', '2372');
INSERT INTO bloks VALUES ('142', '1', '47', 'Blok BE.16', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'BE.16', '2391');
INSERT INTO bloks VALUES ('143', '1', '47', 'Blok BE.12', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'BE.12', '2842');
INSERT INTO bloks VALUES ('144', '1', '47', 'Blok BE.05', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'BE.05', '2867');
INSERT INTO bloks VALUES ('145', '1', '47', 'Blok BE.03', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'BE.03', '2949');
INSERT INTO bloks VALUES ('146', '1', '47', 'BLOK BE.06', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'BE.06', '3350');
INSERT INTO bloks VALUES ('147', '1', '47', 'Blok BE.15', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'BE.15', '3396');
INSERT INTO bloks VALUES ('148', '1', '47', 'BLOK BE.08', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'BE.08', '4941');
INSERT INTO bloks VALUES ('149', '1', '47', 'BLOK BE.09', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'BE.09', '6307');
INSERT INTO bloks VALUES ('150', '1', '48', 'BLOK BE.0A', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'BE.0A', '9750');
INSERT INTO bloks VALUES ('151', '1', '48', 'BLOK BE.0B', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'BLOK ', '9752');
INSERT INTO bloks VALUES ('152', '1', '45', 'BLOK AZ.01', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'AZ.01', '14067');
INSERT INTO bloks VALUES ('153', '1', '45', 'BLOK AZ.10', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'AZ.10', '14068');
INSERT INTO bloks VALUES ('154', '1', '45', 'BLOK AZ.09', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'AZ.09', '14075');
INSERT INTO bloks VALUES ('155', '1', '45', 'BLOK AZ.16', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'AZ.16', '14076');
INSERT INTO bloks VALUES ('156', '1', '45', 'BLOK AZ.17', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'AZ.17', '14079');
INSERT INTO bloks VALUES ('157', '1', '45', 'BLOK AZ.15', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'AZ.15', '14080');
INSERT INTO bloks VALUES ('158', '1', '45', 'BLOK AZ.12', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'AZ.12', '14081');
INSERT INTO bloks VALUES ('159', '1', '45', 'BLOK AZ.11', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'AZ.11', '14082');
INSERT INTO bloks VALUES ('160', '1', '45', 'BLOK AZ.08', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'AZ.08', '14083');
INSERT INTO bloks VALUES ('161', '1', '45', 'BLOK AZ.07', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'AZ.07', '14084');
INSERT INTO bloks VALUES ('162', '1', '45', 'BLOK AZ.05', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'AZ.05', '14085');
INSERT INTO bloks VALUES ('163', '1', '45', 'BLOK AZ.03', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'AZ.03', '14086');
INSERT INTO bloks VALUES ('164', '1', '45', 'BLOK AZ.02', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'AZ.02', '14087');
INSERT INTO bloks VALUES ('165', '1', null, 'BLOK AZ.06', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'AZ.06', '14088');
INSERT INTO bloks VALUES ('166', '1', '47', 'BLOK BE.07', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'BE.07', '15251');
INSERT INTO bloks VALUES ('167', '1', '47', 'BLOK BE.10', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'BE.10', '15281');
INSERT INTO bloks VALUES ('168', '1', '46', 'BLOK BG.01', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'BG.01', '15282');
INSERT INTO bloks VALUES ('169', '1', '46', 'BLOK BG.09', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'BG.09', '15283');
INSERT INTO bloks VALUES ('170', '1', '46', 'BLOK BG.10', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'BG.10', '15284');
INSERT INTO bloks VALUES ('171', '1', '46', 'BLOK BG.16', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'BG.16', '15289');
INSERT INTO bloks VALUES ('172', '1', '46', 'BLOK BG.15', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'BG.15', '15290');
INSERT INTO bloks VALUES ('173', '1', '46', 'BLOK BG.12', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'BG.12', '15291');
INSERT INTO bloks VALUES ('174', '1', null, 'BLOK BG.11', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'BG.11', '15292');
INSERT INTO bloks VALUES ('175', '1', '46', 'BLOK BG.08', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'BG.08', '15411');
INSERT INTO bloks VALUES ('176', '1', '46', 'BLOK BG.06', '0.00', 'Migration from Erem based export at 18 Des 2018', '2018-12-28 07:26:59', '2018-12-28 07:26:59', null, null, null, null, null, null, 'BG.06', '16437');
INSERT INTO bloks VALUES ('177', '1', '47', 'Blok BE01', '0.00', null, '2018-12-28 08:10:01', '2018-12-28 08:10:23', null, null, null, null, null, null, 'BE01', null);
INSERT INTO bloks VALUES ('178', '3', '50', 'CCKVL', '0.00', null, '2018-12-28 08:52:22', '2018-12-28 08:52:22', null, null, null, null, null, null, 'CCKVL', null);
INSERT INTO bloks VALUES ('180', '9', '68', 'Blok A', '2000.00', null, '2018-12-31 09:17:14', '2018-12-31 09:32:36', null, null, null, null, null, null, 'A', null);
INSERT INTO bloks VALUES ('181', '60', '79', 'AR01', '0.00', null, '2018-10-01 22:42:07', '2018-10-01 22:42:07', null, null, null, null, null, null, 'AR', '15267');
INSERT INTO bloks VALUES ('182', '60', '74', 'E01', '0.00', null, '2018-10-01 22:42:53', '2018-10-01 22:42:53', null, null, null, null, null, null, 'E01', '9757');
INSERT INTO bloks VALUES ('183', '60', '74', 'E02', '0.00', null, '2018-10-01 22:43:04', '2018-10-01 22:43:04', null, null, null, null, null, null, 'E02', '9759');
INSERT INTO bloks VALUES ('184', '60', '74', 'E03', '0.00', null, '2018-10-01 22:43:12', '2018-10-01 22:43:12', null, null, null, null, null, null, 'E03', '9760');
INSERT INTO bloks VALUES ('185', '60', '74', 'E05', '0.00', null, '2018-10-01 22:43:23', '2018-10-01 22:43:23', null, null, null, null, null, null, 'E05', '9761');
INSERT INTO bloks VALUES ('186', '60', '74', 'E06', '0.00', null, '2018-10-01 22:43:30', '2018-10-01 22:43:30', null, null, null, null, null, null, 'E06', '9762');
INSERT INTO bloks VALUES ('187', '60', '79', 'ER01', '0.00', null, '2018-10-01 22:43:47', '2018-10-01 22:43:47', null, null, null, null, null, null, 'ER01', '9763');
INSERT INTO bloks VALUES ('188', '60', '79', 'ER02', '0.00', null, '2018-10-01 22:44:06', '2018-10-01 22:44:06', null, null, null, null, null, null, 'ER02', '10797');
INSERT INTO bloks VALUES ('189', '60', '75', 'F01', '0.00', null, '2018-10-01 22:45:21', '2018-10-01 22:45:21', null, null, null, null, null, null, 'F01', '9744');
INSERT INTO bloks VALUES ('190', '60', '75', 'F02', '0.00', null, '2018-10-01 22:45:42', '2018-10-01 22:45:42', null, null, null, null, null, null, 'F02', '9747');
INSERT INTO bloks VALUES ('191', '60', '75', 'F03', '0.00', null, '2018-10-01 22:46:57', '2018-10-01 22:46:57', null, null, null, null, null, null, 'F03', '9748');
INSERT INTO bloks VALUES ('192', '60', '75', 'F05', '0.00', null, '2018-10-01 22:47:15', '2018-10-01 22:47:15', null, null, null, null, null, null, 'F05', '9749');
INSERT INTO bloks VALUES ('193', '60', '75', 'F06', '0.00', null, '2018-10-01 22:47:31', '2018-10-01 22:47:31', null, null, null, null, null, null, 'F06', '9751');
INSERT INTO bloks VALUES ('194', '60', '75', 'F07', '0.00', null, '2018-10-01 22:47:40', '2018-10-01 22:47:40', null, null, null, null, null, null, 'F07', '9753');
INSERT INTO bloks VALUES ('195', '60', '75', 'F08', '0.00', null, '2018-10-01 22:47:52', '2018-10-01 22:47:52', null, null, null, null, null, null, 'F08', '9754');
INSERT INTO bloks VALUES ('196', '60', '75', 'F09', '0.00', null, '2018-10-01 22:48:09', '2018-10-01 22:48:09', null, null, null, null, null, null, 'F09', '15265');
INSERT INTO bloks VALUES ('197', '60', '75', 'F10', '0.00', null, '2018-10-01 22:48:17', '2018-10-01 22:48:17', null, null, null, null, null, null, 'F10', '15256');
INSERT INTO bloks VALUES ('198', '60', '79', 'FR01', '0.00', null, '2018-10-01 22:48:33', '2018-10-01 22:48:33', null, null, null, null, null, null, 'FR01', '9766');
INSERT INTO bloks VALUES ('199', '60', '79', 'FR02', '0.00', null, '2018-10-01 22:49:15', '2018-10-01 22:49:15', null, null, null, null, null, null, 'FR02', '10799');
INSERT INTO bloks VALUES ('200', '60', '79', 'FR03', '0.00', null, '2018-10-01 22:50:02', '2018-10-01 22:50:02', null, null, null, null, null, null, 'FR03', '15264');
INSERT INTO bloks VALUES ('201', '60', '72', 'KVC', '0.00', null, '2018-10-01 22:52:15', '2018-10-01 22:52:15', null, null, null, null, null, null, 'KVC', null);
INSERT INTO bloks VALUES ('202', '60', '73', 'KVD', '0.00', null, '2018-10-01 22:54:24', '2018-10-01 22:54:24', null, null, null, null, null, null, 'KVD', null);
INSERT INTO bloks VALUES ('204', '60', '72', 'KVH', '0.00', null, '2018-10-01 22:55:06', '2018-10-01 22:55:06', null, null, null, null, null, null, 'KVG', null);
INSERT INTO bloks VALUES ('205', '60', '73', 'KVI', '0.00', null, '2018-10-01 22:55:12', '2018-10-01 22:55:12', null, null, null, null, null, null, 'KVI', null);
INSERT INTO bloks VALUES ('207', '60', '79', 'GR03', '0.00', null, '2018-10-01 23:10:04', '2019-01-14 07:51:49', null, null, null, null, null, null, 'ER03', null);
INSERT INTO bloks VALUES ('217', '3', '80', 'I KT', '0.00', null, '2019-01-09 02:10:55', '2019-01-09 02:10:55', null, null, null, null, null, null, 'RIKT', null);
INSERT INTO bloks VALUES ('218', '3', '49', 'P23', '0.00', null, '2019-01-09 04:56:53', '2019-01-09 04:56:53', null, null, null, null, null, null, 'P23', null);
INSERT INTO bloks VALUES ('219', '3', '49', 'P25', '0.00', null, '2019-01-09 04:57:10', '2019-01-09 04:57:10', null, null, null, null, null, null, 'P25', null);
INSERT INTO bloks VALUES ('220', '3', '49', 'P26', '0.00', null, '2019-01-09 04:57:20', '2019-01-09 04:57:20', null, null, null, null, null, null, 'P26', null);
INSERT INTO bloks VALUES ('221', '3', '49', 'P27', '0.00', null, '2019-01-09 04:57:39', '2019-01-09 04:57:39', null, null, null, null, null, null, 'P27', null);
INSERT INTO bloks VALUES ('222', '3', '49', 'P28', '0.00', null, '2019-01-09 04:57:48', '2019-01-09 04:57:48', null, null, null, null, null, null, 'P28', null);
INSERT INTO bloks VALUES ('223', '3', '49', 'P29', '0.00', null, '2019-01-09 04:57:58', '2019-01-09 04:57:58', null, null, null, null, null, null, 'P29', null);
INSERT INTO bloks VALUES ('224', '3', '49', 'P30', '0.00', null, '2019-01-09 04:58:07', '2019-01-09 04:58:07', null, null, null, null, null, null, 'P30', null);
INSERT INTO bloks VALUES ('225', '3', '49', 'P32', '0.00', null, '2019-01-09 04:58:20', '2019-01-09 04:58:20', null, null, null, null, null, null, 'P32', null);
INSERT INTO bloks VALUES ('226', '60', '70', 'A', '16915.00', null, '2019-01-09 10:17:46', '2019-01-09 10:17:46', null, null, null, null, null, null, 'A', null);
INSERT INTO bloks VALUES ('227', '60', '71', 'B', '23764.00', null, '2019-01-09 10:39:05', '2019-01-09 10:39:05', null, null, null, null, null, null, 'B', null);
INSERT INTO bloks VALUES ('228', '60', '70', 'AEXT', '0.00', null, '2019-01-14 06:26:27', '2019-01-14 06:26:27', null, null, null, null, null, null, 'AEXT', null);
INSERT INTO bloks VALUES ('229', '60', '74', 'EB01', '0.00', null, '2019-01-14 07:16:13', '2019-01-14 07:16:13', null, null, null, null, null, null, 'EB01', null);
INSERT INTO bloks VALUES ('230', '60', '76', 'G01', '0.00', null, '2019-01-14 07:23:45', '2019-01-14 07:23:45', null, null, null, null, null, null, 'G01', null);
INSERT INTO bloks VALUES ('231', '60', '79', 'H01', '0.00', null, '2019-01-14 07:25:28', '2019-01-14 07:25:28', null, null, null, null, null, null, 'H01', null);
INSERT INTO bloks VALUES ('232', '60', '78', 'I02', '0.00', null, '2019-01-14 07:27:08', '2019-01-14 07:27:08', null, null, null, null, null, null, 'I01', null);
INSERT INTO bloks VALUES ('233', '60', '79', 'IR', '0.00', null, '2019-01-14 07:39:36', '2019-01-14 07:39:36', null, null, null, null, null, null, 'IR', null);
INSERT INTO bloks VALUES ('234', '3', '81', 'blok campur', '0.00', null, '2019-01-18 03:19:53', '2019-01-18 03:19:53', null, null, null, null, null, null, '11', null);
INSERT INTO bloks VALUES ('235', '9', '93', 'Sun-A', '200.00', null, '2019-01-22 08:16:56', '2019-01-22 08:16:56', null, null, null, null, null, null, 'Sun-A', null);
