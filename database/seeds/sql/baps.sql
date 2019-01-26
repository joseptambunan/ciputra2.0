/*
Navicat SQL Server Data Transfer

Source Server         : ces
Source Server Version : 110000
Source Host           : 52.163.117.241:1433
Source Database       : ciputraqs
Source Schema         : dbo

Target Server Type    : SQL Server
Target Server Version : 110000
File Encoding         : 65001

Date: 2019-01-23 17:16:43
*/


-- ----------------------------
-- Table structure for baps
-- ----------------------------
DROP TABLE [dbo].[baps]
GO
CREATE TABLE [dbo].[baps] (
[id] int NOT NULL IDENTITY(1,1) ,
[spk_id] int NULL ,
[date] date NULL ,
[termin] int NULL ,
[no] nvarchar(191) NULL ,
[nilai_administrasi] float(53) NULL ,
[nilai_denda] float(53) NULL ,
[nilai_selisih] float(53) NULL ,
[nilai_talangan] decimal(11,2) NULL ,
[nilai_dp] decimal(11,2) NULL ,
[nilai_bap_1] bigint NULL ,
[nilai_bap_2] bigint NULL ,
[nilai_bap_3] bigint NULL ,
[nilai_bap_dibayar] bigint NULL ,
[nilai_retensi] bigint NOT NULL ,
[nilai_pembayaran_saat_ini] int NULL ,
[created_at] datetime NULL ,
[updated_at] datetime NULL ,
[deleted_at] datetime NULL ,
[created_by] int NULL ,
[updated_by] int NULL ,
[deleted_by] int NULL ,
[inactive_at] datetime NULL ,
[inactive_by] int NULL ,
[spk_retensi_id] int NULL ,
[percentage] decimal(5,2) NULL ,
[percentage_lapangan] int NULL ,
[percentage_sebelumnyas] int NULL ,
[status_voucher] int NOT NULL ,
[nilai_spk] int NULL ,
[nilai_vo] int NULL 
)


GO

-- ----------------------------
-- Records of baps
-- ----------------------------
SET IDENTITY_INSERT [dbo].[baps] ON
GO
SET IDENTITY_INSERT [dbo].[baps] OFF
GO

-- ----------------------------
-- Indexes structure for table baps
-- ----------------------------
CREATE INDEX [baps_spk_id_index] ON [dbo].[baps]
([spk_id] ASC) 
GO

-- ----------------------------
-- Primary Key structure for table baps
-- ----------------------------
ALTER TABLE [dbo].[baps] ADD PRIMARY KEY ([id])
GO
