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

Date: 2019-01-23 17:16:12
*/


-- ----------------------------
-- Table structure for bap_detail_itempekerjaans
-- ----------------------------
DROP TABLE [dbo].[bap_detail_itempekerjaans]
GO
CREATE TABLE [dbo].[bap_detail_itempekerjaans] (
[id] int NOT NULL IDENTITY(1,1) ,
[bap_detail_id] int NULL ,
[spkvo_unit_id] int NULL ,
[itempekerjaan_id] int NULL ,
[terbayar_percent] float(53) NULL ,
[lapangan_percent] float(53) NULL ,
[created_at] datetime NULL ,
[updated_at] datetime NULL ,
[deleted_at] datetime NULL ,
[created_by] int NULL ,
[updated_by] int NULL ,
[deleted_by] int NULL ,
[inactive_at] datetime NULL ,
[inactive_by] int NULL 
)


GO

-- ----------------------------
-- Records of bap_detail_itempekerjaans
-- ----------------------------
SET IDENTITY_INSERT [dbo].[bap_detail_itempekerjaans] ON
GO
SET IDENTITY_INSERT [dbo].[bap_detail_itempekerjaans] OFF
GO

-- ----------------------------
-- Indexes structure for table bap_detail_itempekerjaans
-- ----------------------------
CREATE INDEX [bap_detail_itempekerjaans_bap_detail_id_itempekerjaan_id_index] ON [dbo].[bap_detail_itempekerjaans]
([bap_detail_id] ASC, [itempekerjaan_id] ASC) 
GO

-- ----------------------------
-- Primary Key structure for table bap_detail_itempekerjaans
-- ----------------------------
ALTER TABLE [dbo].[bap_detail_itempekerjaans] ADD PRIMARY KEY ([id])
GO
