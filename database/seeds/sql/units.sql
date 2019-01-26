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

Date: 2019-01-23 17:17:11
*/


-- ----------------------------
-- Table structure for units
-- ----------------------------
DROP TABLE [dbo].[units]
GO
CREATE TABLE [dbo].[units] (
[id] int NOT NULL IDENTITY(1,1) ,
[blok_id] int NULL ,
[templatepekerjaan_id] int NULL ,
[pt_id] int NULL ,
[peruntukan_id] int NULL ,
[unit_arah_id] int NULL ,
[unit_hadap_id] int NULL ,
[unit_type_id] int NULL ,
[code] nvarchar(191) NULL ,
[name] nvarchar(191) NULL ,
[tanah_luas] float(53) NULL ,
[bangunan_luas] float(53) NULL ,
[is_sellable] bit NOT NULL DEFAULT ('1') ,
[status] int NOT NULL DEFAULT ('0') ,
[tag_kategori] nvarchar(191) NOT NULL DEFAULT ('b') ,
[st1_date] date NULL ,
[st2_date] date NULL ,
[created_at] datetime NULL ,
[updated_at] datetime NULL ,
[deleted_at] datetime NULL ,
[created_by] int NULL ,
[updated_by] int NULL ,
[deleted_by] int NULL ,
[inactive_at] datetime NULL ,
[inactive_by] int NULL ,
[unit_id] int NULL ,
[purchaseletter_id] int NULL ,
[building_class] nvarchar(32) NULL ,
[is_spk] int NULL ,
[cluster_id] int NULL 
)


GO
DBCC CHECKIDENT(N'[dbo].[units]', RESEED, 24)
GO

-- ----------------------------
-- Records of units
-- ----------------------------
SET IDENTITY_INSERT [dbo].[units] ON
GO
INSERT INTO [dbo].[units] ([id], [blok_id], [templatepekerjaan_id], [pt_id], [peruntukan_id], [unit_arah_id], [unit_hadap_id], [unit_type_id], [code], [name], [tanah_luas], [bangunan_luas], [is_sellable], [status], [tag_kategori], [st1_date], [st2_date], [created_at], [updated_at], [deleted_at], [created_by], [updated_by], [deleted_by], [inactive_at], [inactive_by], [unit_id], [purchaseletter_id], [building_class], [is_spk], [cluster_id]) VALUES (N'1', N'2', null, N'48', null, null, null, N'2', N'BWH02/001', N'BWH02/001', N'90', N'36', N'1', N'0', N'B', null, null, N'2018-11-13 11:20:16.623', N'2018-11-13 11:20:16.623', null, N'37', null, null, null, null, null, null, null, null, null)
GO
GO
INSERT INTO [dbo].[units] ([id], [blok_id], [templatepekerjaan_id], [pt_id], [peruntukan_id], [unit_arah_id], [unit_hadap_id], [unit_type_id], [code], [name], [tanah_luas], [bangunan_luas], [is_sellable], [status], [tag_kategori], [st1_date], [st2_date], [created_at], [updated_at], [deleted_at], [created_by], [updated_by], [deleted_by], [inactive_at], [inactive_by], [unit_id], [purchaseletter_id], [building_class], [is_spk], [cluster_id]) VALUES (N'2', N'2', null, N'48', null, null, null, N'2', N'BWH02/002', N'BWH02/002', N'90', N'36', N'1', N'0', N'B', null, null, N'2018-11-13 11:20:31.470', N'2018-11-13 11:20:31.470', null, N'37', null, null, null, null, null, null, null, null, null)
GO
GO
INSERT INTO [dbo].[units] ([id], [blok_id], [templatepekerjaan_id], [pt_id], [peruntukan_id], [unit_arah_id], [unit_hadap_id], [unit_type_id], [code], [name], [tanah_luas], [bangunan_luas], [is_sellable], [status], [tag_kategori], [st1_date], [st2_date], [created_at], [updated_at], [deleted_at], [created_by], [updated_by], [deleted_by], [inactive_at], [inactive_by], [unit_id], [purchaseletter_id], [building_class], [is_spk], [cluster_id]) VALUES (N'3', N'2', null, N'48', null, null, null, N'2', N'BWH02/003', N'BWH02/003', N'90', N'36', N'1', N'1', N'B', null, null, N'2018-11-13 11:21:33.543', N'2018-11-13 11:21:33.543', null, N'37', null, null, null, null, null, null, null, null, null)
GO
GO
INSERT INTO [dbo].[units] ([id], [blok_id], [templatepekerjaan_id], [pt_id], [peruntukan_id], [unit_arah_id], [unit_hadap_id], [unit_type_id], [code], [name], [tanah_luas], [bangunan_luas], [is_sellable], [status], [tag_kategori], [st1_date], [st2_date], [created_at], [updated_at], [deleted_at], [created_by], [updated_by], [deleted_by], [inactive_at], [inactive_by], [unit_id], [purchaseletter_id], [building_class], [is_spk], [cluster_id]) VALUES (N'4', N'3', null, N'48', null, null, null, null, N'BWRF1/001', N'BWRF1/001', N'0', N'0', N'1', N'0', N'B', null, null, N'2019-01-21 02:25:21.460', N'2019-01-21 02:25:21.460', null, N'37', null, null, null, null, null, null, null, null, null)
GO
GO
INSERT INTO [dbo].[units] ([id], [blok_id], [templatepekerjaan_id], [pt_id], [peruntukan_id], [unit_arah_id], [unit_hadap_id], [unit_type_id], [code], [name], [tanah_luas], [bangunan_luas], [is_sellable], [status], [tag_kategori], [st1_date], [st2_date], [created_at], [updated_at], [deleted_at], [created_by], [updated_by], [deleted_by], [inactive_at], [inactive_by], [unit_id], [purchaseletter_id], [building_class], [is_spk], [cluster_id]) VALUES (N'5', N'4', null, N'25', null, null, null, N'4', N'SG02/001', N'SG02/001', N'136', N'70', N'1', N'0', N'B', null, null, N'2019-01-22 08:16:42.937', N'2019-01-22 08:16:42.937', null, N'44', null, null, null, null, null, null, null, null, null)
GO
GO
INSERT INTO [dbo].[units] ([id], [blok_id], [templatepekerjaan_id], [pt_id], [peruntukan_id], [unit_arah_id], [unit_hadap_id], [unit_type_id], [code], [name], [tanah_luas], [bangunan_luas], [is_sellable], [status], [tag_kategori], [st1_date], [st2_date], [created_at], [updated_at], [deleted_at], [created_by], [updated_by], [deleted_by], [inactive_at], [inactive_by], [unit_id], [purchaseletter_id], [building_class], [is_spk], [cluster_id]) VALUES (N'6', N'4', null, N'25', null, null, null, N'4', N'SG02/002', N'SG02/002', N'136', N'70', N'1', N'0', N'B', null, null, N'2019-01-22 08:16:43.060', N'2019-01-22 08:16:43.060', null, N'44', null, null, null, null, null, null, null, null, null)
GO
GO
INSERT INTO [dbo].[units] ([id], [blok_id], [templatepekerjaan_id], [pt_id], [peruntukan_id], [unit_arah_id], [unit_hadap_id], [unit_type_id], [code], [name], [tanah_luas], [bangunan_luas], [is_sellable], [status], [tag_kategori], [st1_date], [st2_date], [created_at], [updated_at], [deleted_at], [created_by], [updated_by], [deleted_by], [inactive_at], [inactive_by], [unit_id], [purchaseletter_id], [building_class], [is_spk], [cluster_id]) VALUES (N'7', N'4', null, N'25', null, null, null, N'4', N'SG02/003', N'SG02/003', N'136', N'70', N'1', N'0', N'B', null, null, N'2019-01-22 08:16:43.067', N'2019-01-22 08:16:43.067', null, N'44', null, null, null, null, null, null, null, null, null)
GO
GO
INSERT INTO [dbo].[units] ([id], [blok_id], [templatepekerjaan_id], [pt_id], [peruntukan_id], [unit_arah_id], [unit_hadap_id], [unit_type_id], [code], [name], [tanah_luas], [bangunan_luas], [is_sellable], [status], [tag_kategori], [st1_date], [st2_date], [created_at], [updated_at], [deleted_at], [created_by], [updated_by], [deleted_by], [inactive_at], [inactive_by], [unit_id], [purchaseletter_id], [building_class], [is_spk], [cluster_id]) VALUES (N'8', N'4', null, N'25', null, null, null, N'4', N'SG02/004', N'SG02/004', N'100', N'0', N'1', N'0', N'B', null, null, N'2019-01-22 09:16:34.250', N'2019-01-22 09:16:34.250', null, N'44', null, null, null, null, null, null, null, null, null)
GO
GO
INSERT INTO [dbo].[units] ([id], [blok_id], [templatepekerjaan_id], [pt_id], [peruntukan_id], [unit_arah_id], [unit_hadap_id], [unit_type_id], [code], [name], [tanah_luas], [bangunan_luas], [is_sellable], [status], [tag_kategori], [st1_date], [st2_date], [created_at], [updated_at], [deleted_at], [created_by], [updated_by], [deleted_by], [inactive_at], [inactive_by], [unit_id], [purchaseletter_id], [building_class], [is_spk], [cluster_id]) VALUES (N'9', N'4', null, N'25', null, null, null, N'4', N'SG02/004', N'SG02/004', N'0', N'0', N'1', N'0', N'B', null, null, N'2019-01-22 09:23:59.917', N'2019-01-22 09:23:59.917', null, N'44', null, null, null, null, null, null, null, null, null)
GO
GO
INSERT INTO [dbo].[units] ([id], [blok_id], [templatepekerjaan_id], [pt_id], [peruntukan_id], [unit_arah_id], [unit_hadap_id], [unit_type_id], [code], [name], [tanah_luas], [bangunan_luas], [is_sellable], [status], [tag_kategori], [st1_date], [st2_date], [created_at], [updated_at], [deleted_at], [created_by], [updated_by], [deleted_by], [inactive_at], [inactive_by], [unit_id], [purchaseletter_id], [building_class], [is_spk], [cluster_id]) VALUES (N'10', N'4', null, N'25', null, null, null, N'4', N'SG02/006', N'SG02/006', N'1', N'1', N'1', N'0', N'B', null, null, N'2019-01-22 09:24:23.200', N'2019-01-22 09:24:23.200', null, N'44', null, null, null, null, null, null, null, null, null)
GO
GO
INSERT INTO [dbo].[units] ([id], [blok_id], [templatepekerjaan_id], [pt_id], [peruntukan_id], [unit_arah_id], [unit_hadap_id], [unit_type_id], [code], [name], [tanah_luas], [bangunan_luas], [is_sellable], [status], [tag_kategori], [st1_date], [st2_date], [created_at], [updated_at], [deleted_at], [created_by], [updated_by], [deleted_by], [inactive_at], [inactive_by], [unit_id], [purchaseletter_id], [building_class], [is_spk], [cluster_id]) VALUES (N'11', N'4', null, N'25', null, null, null, N'4', N'SG02/007', N'SG02/007', N'0', N'0', N'1', N'0', N'B', null, null, N'2019-01-22 09:27:57.717', N'2019-01-22 09:27:57.717', null, N'44', null, null, null, null, null, null, null, null, null)
GO
GO
INSERT INTO [dbo].[units] ([id], [blok_id], [templatepekerjaan_id], [pt_id], [peruntukan_id], [unit_arah_id], [unit_hadap_id], [unit_type_id], [code], [name], [tanah_luas], [bangunan_luas], [is_sellable], [status], [tag_kategori], [st1_date], [st2_date], [created_at], [updated_at], [deleted_at], [created_by], [updated_by], [deleted_by], [inactive_at], [inactive_by], [unit_id], [purchaseletter_id], [building_class], [is_spk], [cluster_id]) VALUES (N'12', N'4', null, N'25', null, null, null, N'4', N'SG02/008', N'SG02/008', N'0', N'0', N'1', N'0', N'B', null, null, N'2019-01-22 09:32:10.090', N'2019-01-22 09:32:10.090', null, N'44', null, null, null, null, null, null, null, null, null)
GO
GO
INSERT INTO [dbo].[units] ([id], [blok_id], [templatepekerjaan_id], [pt_id], [peruntukan_id], [unit_arah_id], [unit_hadap_id], [unit_type_id], [code], [name], [tanah_luas], [bangunan_luas], [is_sellable], [status], [tag_kategori], [st1_date], [st2_date], [created_at], [updated_at], [deleted_at], [created_by], [updated_by], [deleted_by], [inactive_at], [inactive_by], [unit_id], [purchaseletter_id], [building_class], [is_spk], [cluster_id]) VALUES (N'13', N'4', null, N'25', null, null, null, N'4', N'SG02/009', N'SG02/009', N'0', N'0', N'1', N'0', N'B', null, null, N'2019-01-22 09:44:44.677', N'2019-01-22 09:44:44.677', null, N'44', null, null, null, null, null, null, null, null, null)
GO
GO
INSERT INTO [dbo].[units] ([id], [blok_id], [templatepekerjaan_id], [pt_id], [peruntukan_id], [unit_arah_id], [unit_hadap_id], [unit_type_id], [code], [name], [tanah_luas], [bangunan_luas], [is_sellable], [status], [tag_kategori], [st1_date], [st2_date], [created_at], [updated_at], [deleted_at], [created_by], [updated_by], [deleted_by], [inactive_at], [inactive_by], [unit_id], [purchaseletter_id], [building_class], [is_spk], [cluster_id]) VALUES (N'14', N'4', null, N'25', null, null, null, N'4', N'SG02/09', N'SG02/09', N'0', N'0', N'1', N'0', N'B', null, null, N'2019-01-22 09:46:19.560', N'2019-01-22 09:46:19.560', null, N'44', null, null, null, null, null, null, null, null, null)
GO
GO
INSERT INTO [dbo].[units] ([id], [blok_id], [templatepekerjaan_id], [pt_id], [peruntukan_id], [unit_arah_id], [unit_hadap_id], [unit_type_id], [code], [name], [tanah_luas], [bangunan_luas], [is_sellable], [status], [tag_kategori], [st1_date], [st2_date], [created_at], [updated_at], [deleted_at], [created_by], [updated_by], [deleted_by], [inactive_at], [inactive_by], [unit_id], [purchaseletter_id], [building_class], [is_spk], [cluster_id]) VALUES (N'15', N'4', null, N'25', null, null, null, N'4', N'SG02/09', N'SG02/09', N'0', N'0', N'1', N'0', N'B', null, null, N'2019-01-22 09:46:21.800', N'2019-01-22 09:46:21.800', null, N'44', null, null, null, null, null, null, null, null, null)
GO
GO
INSERT INTO [dbo].[units] ([id], [blok_id], [templatepekerjaan_id], [pt_id], [peruntukan_id], [unit_arah_id], [unit_hadap_id], [unit_type_id], [code], [name], [tanah_luas], [bangunan_luas], [is_sellable], [status], [tag_kategori], [st1_date], [st2_date], [created_at], [updated_at], [deleted_at], [created_by], [updated_by], [deleted_by], [inactive_at], [inactive_by], [unit_id], [purchaseletter_id], [building_class], [is_spk], [cluster_id]) VALUES (N'16', N'4', null, N'25', null, null, null, N'4', N'SG02/09', N'SG02/09', N'0', N'0', N'1', N'0', N'B', null, null, N'2019-01-22 09:50:02.593', N'2019-01-22 09:50:02.593', null, N'44', null, null, null, null, null, null, null, null, null)
GO
GO
INSERT INTO [dbo].[units] ([id], [blok_id], [templatepekerjaan_id], [pt_id], [peruntukan_id], [unit_arah_id], [unit_hadap_id], [unit_type_id], [code], [name], [tanah_luas], [bangunan_luas], [is_sellable], [status], [tag_kategori], [st1_date], [st2_date], [created_at], [updated_at], [deleted_at], [created_by], [updated_by], [deleted_by], [inactive_at], [inactive_by], [unit_id], [purchaseletter_id], [building_class], [is_spk], [cluster_id]) VALUES (N'17', N'4', null, N'25', null, null, null, N'4', N'SG02/013', N'SG02/013', N'9', N'9', N'1', N'0', N'B', null, null, N'2019-01-22 09:50:23.677', N'2019-01-22 09:50:23.677', null, N'44', null, null, null, null, null, null, null, null, null)
GO
GO
INSERT INTO [dbo].[units] ([id], [blok_id], [templatepekerjaan_id], [pt_id], [peruntukan_id], [unit_arah_id], [unit_hadap_id], [unit_type_id], [code], [name], [tanah_luas], [bangunan_luas], [is_sellable], [status], [tag_kategori], [st1_date], [st2_date], [created_at], [updated_at], [deleted_at], [created_by], [updated_by], [deleted_by], [inactive_at], [inactive_by], [unit_id], [purchaseletter_id], [building_class], [is_spk], [cluster_id]) VALUES (N'18', N'4', null, N'25', null, null, null, N'4', N'SG02/014', N'SG02/014', N'0', N'0', N'1', N'0', N'B', null, null, N'2019-01-22 09:51:24.740', N'2019-01-22 09:51:24.740', null, N'44', null, null, null, null, null, null, null, null, null)
GO
GO
INSERT INTO [dbo].[units] ([id], [blok_id], [templatepekerjaan_id], [pt_id], [peruntukan_id], [unit_arah_id], [unit_hadap_id], [unit_type_id], [code], [name], [tanah_luas], [bangunan_luas], [is_sellable], [status], [tag_kategori], [st1_date], [st2_date], [created_at], [updated_at], [deleted_at], [created_by], [updated_by], [deleted_by], [inactive_at], [inactive_by], [unit_id], [purchaseletter_id], [building_class], [is_spk], [cluster_id]) VALUES (N'19', N'4', null, N'25', null, null, null, N'4', N'SG02/015', N'SG02/015', N'0', N'9', N'1', N'0', N'B', null, null, N'2019-01-22 09:56:59.417', N'2019-01-22 09:56:59.417', null, N'44', null, null, null, null, null, null, null, null, null)
GO
GO
INSERT INTO [dbo].[units] ([id], [blok_id], [templatepekerjaan_id], [pt_id], [peruntukan_id], [unit_arah_id], [unit_hadap_id], [unit_type_id], [code], [name], [tanah_luas], [bangunan_luas], [is_sellable], [status], [tag_kategori], [st1_date], [st2_date], [created_at], [updated_at], [deleted_at], [created_by], [updated_by], [deleted_by], [inactive_at], [inactive_by], [unit_id], [purchaseletter_id], [building_class], [is_spk], [cluster_id]) VALUES (N'20', N'4', null, N'25', null, null, null, N'4', N'SG02/015', N'SG02/015', N'0', N'9', N'1', N'0', N'B', null, null, N'2019-01-22 10:01:21.480', N'2019-01-22 10:01:21.480', null, N'44', null, null, null, null, null, null, null, null, null)
GO
GO
INSERT INTO [dbo].[units] ([id], [blok_id], [templatepekerjaan_id], [pt_id], [peruntukan_id], [unit_arah_id], [unit_hadap_id], [unit_type_id], [code], [name], [tanah_luas], [bangunan_luas], [is_sellable], [status], [tag_kategori], [st1_date], [st2_date], [created_at], [updated_at], [deleted_at], [created_by], [updated_by], [deleted_by], [inactive_at], [inactive_by], [unit_id], [purchaseletter_id], [building_class], [is_spk], [cluster_id]) VALUES (N'21', N'4', null, N'25', null, null, null, N'4', N'SG02/017', N'SG02/017', N'0', N'0', N'1', N'0', N'B', null, null, N'2019-01-22 10:08:49.383', N'2019-01-22 10:08:49.383', null, N'44', null, null, null, null, null, null, null, null, null)
GO
GO
INSERT INTO [dbo].[units] ([id], [blok_id], [templatepekerjaan_id], [pt_id], [peruntukan_id], [unit_arah_id], [unit_hadap_id], [unit_type_id], [code], [name], [tanah_luas], [bangunan_luas], [is_sellable], [status], [tag_kategori], [st1_date], [st2_date], [created_at], [updated_at], [deleted_at], [created_by], [updated_by], [deleted_by], [inactive_at], [inactive_by], [unit_id], [purchaseletter_id], [building_class], [is_spk], [cluster_id]) VALUES (N'22', N'4', null, N'25', null, null, null, N'4', N'SG02/018', N'SG02/018', N'0', N'0', N'1', N'0', N'B', null, null, N'2019-01-22 10:13:44.703', N'2019-01-22 10:13:44.703', null, N'44', null, null, null, null, null, null, null, null, null)
GO
GO
INSERT INTO [dbo].[units] ([id], [blok_id], [templatepekerjaan_id], [pt_id], [peruntukan_id], [unit_arah_id], [unit_hadap_id], [unit_type_id], [code], [name], [tanah_luas], [bangunan_luas], [is_sellable], [status], [tag_kategori], [st1_date], [st2_date], [created_at], [updated_at], [deleted_at], [created_by], [updated_by], [deleted_by], [inactive_at], [inactive_by], [unit_id], [purchaseletter_id], [building_class], [is_spk], [cluster_id]) VALUES (N'23', N'4', null, N'25', null, null, null, N'4', N'SG02/019', N'SG02/019', N'0', N'0', N'1', N'0', N'B', null, null, N'2019-01-22 10:14:11.727', N'2019-01-22 10:14:11.727', null, N'44', null, null, null, null, null, null, null, null, null)
GO
GO
INSERT INTO [dbo].[units] ([id], [blok_id], [templatepekerjaan_id], [pt_id], [peruntukan_id], [unit_arah_id], [unit_hadap_id], [unit_type_id], [code], [name], [tanah_luas], [bangunan_luas], [is_sellable], [status], [tag_kategori], [st1_date], [st2_date], [created_at], [updated_at], [deleted_at], [created_by], [updated_by], [deleted_by], [inactive_at], [inactive_by], [unit_id], [purchaseletter_id], [building_class], [is_spk], [cluster_id]) VALUES (N'24', N'4', null, N'25', null, null, null, N'4', N'SG02/020', N'SG02/020', N'0', N'0', N'1', N'0', N'B', null, null, N'2019-01-22 10:19:13.327', N'2019-01-22 10:19:13.327', null, N'44', null, null, null, null, null, null, null, null, null)
GO
GO
SET IDENTITY_INSERT [dbo].[units] OFF
GO

-- ----------------------------
-- Indexes structure for table units
-- ----------------------------
CREATE INDEX [units_blok_id_index] ON [dbo].[units]
([blok_id] ASC) 
GO
CREATE INDEX [units_templatepekerjaan_id_index] ON [dbo].[units]
([templatepekerjaan_id] ASC) 
GO
CREATE INDEX [units_pt_id_index] ON [dbo].[units]
([pt_id] ASC) 
GO
CREATE INDEX [units_peruntukan_id_index] ON [dbo].[units]
([peruntukan_id] ASC) 
GO
CREATE INDEX [units_unit_arah_id_index] ON [dbo].[units]
([unit_arah_id] ASC) 
GO
CREATE INDEX [units_unit_type_id_index] ON [dbo].[units]
([unit_type_id] ASC) 
GO

-- ----------------------------
-- Primary Key structure for table units
-- ----------------------------
ALTER TABLE [dbo].[units] ADD PRIMARY KEY ([id])
GO
