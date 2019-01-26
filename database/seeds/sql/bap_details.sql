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

Date: 2019-01-23 17:16:25
*/


-- ----------------------------
-- Table structure for bap_details
-- ----------------------------
DROP TABLE [dbo].[bap_details]
GO
CREATE TABLE [dbo].[bap_details] (
[id] int NOT NULL IDENTITY(1,1) ,
[bap_id] int NULL ,
[asset_id] int NULL ,
[asset_type] nvarchar(191) NULL ,
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
-- Records of bap_details
-- ----------------------------
SET IDENTITY_INSERT [dbo].[bap_details] ON
GO
SET IDENTITY_INSERT [dbo].[bap_details] OFF
GO

-- ----------------------------
-- Indexes structure for table bap_details
-- ----------------------------
CREATE INDEX [bap_details_bap_id_asset_id_index] ON [dbo].[bap_details]
([bap_id] ASC, [asset_id] ASC) 
GO

-- ----------------------------
-- Primary Key structure for table bap_details
-- ----------------------------
ALTER TABLE [dbo].[bap_details] ADD PRIMARY KEY ([id])
GO
