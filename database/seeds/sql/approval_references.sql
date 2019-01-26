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

Date: 2019-01-23 17:15:38
*/


-- ----------------------------
-- Table structure for approval_references
-- ----------------------------
DROP TABLE [dbo].[approval_references]
GO
CREATE TABLE [dbo].[approval_references] (
[id] int NOT NULL IDENTITY(1,1) ,
[user_id] int NULL ,
[project_id] int NULL ,
[pt_id] int NULL ,
[document_type] nvarchar(191) NULL ,
[no_urut] int NULL ,
[min_value] float(53) NULL ,
[max_value] float(53) NULL ,
[description] nvarchar(191) NULL ,
[is_action] bit NOT NULL DEFAULT ('1') ,
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
-- Records of approval_references
-- ----------------------------
SET IDENTITY_INSERT [dbo].[approval_references] ON
GO
SET IDENTITY_INSERT [dbo].[approval_references] OFF
GO

-- ----------------------------
-- Indexes structure for table approval_references
-- ----------------------------
CREATE INDEX [approval_references_user_id_project_id_pt_id_index] ON [dbo].[approval_references]
([user_id] ASC, [project_id] ASC, [pt_id] ASC) 
GO

-- ----------------------------
-- Primary Key structure for table approval_references
-- ----------------------------
ALTER TABLE [dbo].[approval_references] ADD PRIMARY KEY ([id])
GO
