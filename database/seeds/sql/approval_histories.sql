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

Date: 2019-01-23 17:15:18
*/


-- ----------------------------
-- Table structure for approval_histories
-- ----------------------------
DROP TABLE [dbo].[approval_histories]
GO
CREATE TABLE [dbo].[approval_histories] (
[id] int NOT NULL ,
[user_id] int NULL ,
[approval_id] int NULL ,
[document_type_id] int NULL ,
[approval_action_id] int NOT NULL DEFAULT ('0') ,
[no_urut] int NULL ,
[durasi] int NULL ,
[document_id] int NULL ,
[document_type] nvarchar(191) NULL ,
[description] nvarchar(191) NULL ,
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
-- Records of approval_histories
-- ----------------------------

-- ----------------------------
-- Indexes structure for table approval_histories
-- ----------------------------
CREATE INDEX [approval_histories_document_id_user_id_index] ON [dbo].[approval_histories]
([document_id] ASC, [user_id] ASC) 
GO

-- ----------------------------
-- Primary Key structure for table approval_histories
-- ----------------------------
ALTER TABLE [dbo].[approval_histories] ADD PRIMARY KEY ([id])
GO
