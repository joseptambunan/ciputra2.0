/*
Navicat MySQL Data Transfer

Source Server         : 117.53.46.38
Source Server Version : 50561
Source Host           : 117.53.46.38:3306
Source Database       : zadmin_qs

Target Server Type    : MYSQL
Target Server Version : 50561
File Encoding         : 65001

Date: 2019-01-24 07:31:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for budget_tahunans
-- ----------------------------
DROP TABLE IF EXISTS budget_tahunans;
CREATE TABLE budget_tahunans (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `budget_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_anggaran` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  `inactive_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `budget_tahunans_budget_id_parent_id_index` (`budget_id`,`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=525 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of budget_tahunans
-- ----------------------------
INSERT INTO budget_tahunans VALUES ('500', '37', null, '0028/BDG-T/CD/XII/2018/H/I01', '2019', 'Budget Fas Kot, Relokasi Pipa Gas PT.Pasundan', '2018-12-20 10:16:36', '2018-12-20 10:16:36', null, null, null, null, null, null);
INSERT INTO budget_tahunans VALUES ('501', '87', null, '0030/BDG-T/CD/XII/2018/H/I01', '2019', null, '2018-12-21 03:21:30', '2018-12-21 03:21:30', null, null, null, null, null, null);
INSERT INTO budget_tahunans VALUES ('502', '37', null, '0031/BDG-T/CD/XII/2018/H/I01', '2019', 'merevisi item budget yg lain belum dimasukkan', '2018-12-21 03:23:05', '2018-12-21 03:23:05', null, null, null, null, null, null);
INSERT INTO budget_tahunans VALUES ('503', '98', null, '0033/BDG-T/CD/XII/2018/H/I01', '2019', 'merevisi item pek yg belum dimasukkan', '2018-12-21 03:59:36', '2018-12-21 03:59:36', null, null, null, null, null, null);
INSERT INTO budget_tahunans VALUES ('504', '52', null, '0034/BDG-T/CD/XII/2018/H/I01', '2019', 'budget defcost cluster CC', '2018-12-21 04:13:04', '2018-12-21 04:13:04', '2019-01-08 00:00:00', null, null, null, null, null);
INSERT INTO budget_tahunans VALUES ('505', '50', null, '0039/BDG-T/CD/XII/2018/H/I01', '2019', null, '2018-12-27 04:07:33', '2018-12-27 04:07:33', null, null, null, null, null, null);
INSERT INTO budget_tahunans VALUES ('506', '74', null, '0043/BDG-T/CD/XII/2018/H/I01', '2019', 'Pembangunan 5 unit rumah, tipe 96=3 unit, tipe 68=2unit', '2018-12-28 03:39:12', '2018-12-28 03:39:12', null, null, null, null, null, null);
INSERT INTO budget_tahunans VALUES ('507', '97', null, '0044/BDG-T/CD/XII/2018/H/I01', '2019', 'Con cost', '2018-12-28 10:35:06', '2018-12-28 10:35:06', null, null, null, null, null, null);
INSERT INTO budget_tahunans VALUES ('508', '5222222', null, '0046/BDG-T/CD/I/2019/H/I01', '2018', null, '2019-01-08 07:18:30', '2019-01-08 07:18:30', null, null, null, null, null, null);
INSERT INTO budget_tahunans VALUES ('509', '114', null, '0056/BDG-T/CD/I/2019/H/I01', '2019', 'DC', '2019-01-09 03:07:23', '2019-01-09 03:07:23', null, null, null, null, null, null);
INSERT INTO budget_tahunans VALUES ('510', '10777', null, '0055/BDG-T/CD/I/2019/XXX/XXX', '2018', 'Budget Tahunan per 2019 - 8 Januari 2019', '2019-01-09 03:23:54', '2019-01-09 03:23:54', null, null, null, null, null, null);
INSERT INTO budget_tahunans VALUES ('512', '99', null, '0057/BDG-T/CD/I/2019/XXX/XXX', '2019', 'budget tahunan 2019', '2019-01-09 03:28:23', '2019-01-09 03:28:23', null, null, null, null, null, null);
INSERT INTO budget_tahunans VALUES ('513', '115', null, '0058/BDG-T/CD/I/2019/XXX/XXX', '2019', null, '2019-01-09 04:24:08', '2019-01-09 06:51:20', null, null, null, null, null, null);
INSERT INTO budget_tahunans VALUES ('514', '107', null, '0059/BDG-T/CD/I/2019/XXX/XXX', '2019', null, '2019-01-09 04:36:25', '2019-01-09 06:22:23', null, null, null, null, null, null);
INSERT INTO budget_tahunans VALUES ('515', '104', null, '0060/BDG-T/CD/I/2019/XXX/XXX', '2019', null, '2019-01-09 04:49:47', '2019-01-09 06:07:56', null, null, null, null, null, null);
INSERT INTO budget_tahunans VALUES ('516', '111', null, '0061/BDG-T/CD/I/2019/XXX/XXX', '2019', 'Budget Tahunan 2019 per 9 Januari 2019', '2019-01-09 05:59:31', '2019-01-09 05:59:31', null, null, null, null, null, null);
INSERT INTO budget_tahunans VALUES ('517', '96', null, '0062/BDG-T/CD/I/2019/XXX/XXX', '2019', 'budget tahunan per 9 januari 2019', '2019-01-09 06:05:20', '2019-01-09 06:05:20', null, null, null, null, null, null);
INSERT INTO budget_tahunans VALUES ('518', '113', null, '0063/BDG-T/CD/I/2019/XXX/XXX', '2019', 'budget tahunan per 9 januari 2019', '2019-01-09 06:08:53', '2019-01-09 06:08:53', null, null, null, null, null, null);
INSERT INTO budget_tahunans VALUES ('519', '110', null, '0064/BDG-T/CD/I/2019/XXX/XXX', '2019', 'budget tahunan per 9 januari 2019', '2019-01-09 07:23:04', '2019-01-09 07:23:04', null, null, null, null, null, null);
INSERT INTO budget_tahunans VALUES ('520', '112', null, '0065/BDG-T/CD/I/2019/XXX/XXX', '2019', 'budget tahunan per 9 januari 2019', '2019-01-09 07:37:01', '2019-01-09 07:37:01', null, null, null, null, null, null);
INSERT INTO budget_tahunans VALUES ('521', '108', null, '0066/BDG-T/CD/I/2019/XXX/XXX', '2019', 'budget tahunan per 9 januari 2019', '2019-01-09 07:54:20', '2019-01-09 07:54:20', null, null, null, null, null, null);
INSERT INTO budget_tahunans VALUES ('522', '877', null, '0059/BDG-T/CD/I/2019/H/I01', '2019', null, '2019-01-16 09:00:30', '2019-01-16 09:00:30', null, null, null, null, null, null);
INSERT INTO budget_tahunans VALUES ('523', '106', null, '0068/BDG-T/CD/I/2019/XXX/XXX', '2019', 'Budget Ruko F', '2019-01-16 11:39:50', '2019-01-16 11:39:50', null, null, null, null, null, null);
INSERT INTO budget_tahunans VALUES ('524', '117', null, '0061/BDG-T/CD/I/2019/H/I01', '2019', 'budget gabungan', '2019-01-17 11:07:05', '2019-01-17 11:07:05', null, null, null, null, null, null);
