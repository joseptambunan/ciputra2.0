ALTER TABLE [ciputraqs].[dbo].[unit_types] ALTER COLUMN cluster_id int NULL;
UPDATE [dbo].[approval_histories]
   SET document_type = 'Modules\Budget\Entities\BudgetTahunan'
 WHERE document_type = 'Modules\\Budget\\Entities\\BudgetTahunan'
GO

UPDATE [dbo].[approval_histories]
   SET document_type = 'Modules\Budget\Entities\Budget'
 WHERE document_type = 'Modules\\Budget\\Entities\\Budget'
GO

UPDATE [dbo].[approval_histories]
   SET document_type = 'Modules\Workorder\Entities\Workorder'
 WHERE document_type = 'Modules\\Workorder\\Entities\\Workorder'
GO

UPDATE [dbo].[approval_histories]
   SET document_type = 'Modules\Rab\Entities\Rab'
 WHERE document_type = 'Modules\\Rab\\Entities\\Rab'
GO

UPDATE [dbo].[approval_histories]
   SET document_type = 'Modules\Spk\Entities\Spk'
 WHERE document_type = 'Modules\\Spk\\Entities\\Spk'
GO

ALTER TABLE dbo.hpp_dev_cost_summary_reports ALTER COLUMN efisiensi DECIMAL (5, 2) ;  
GO 

ALTER TABLE dbo.budget_tahunan_units ADD harga_satuan DECIMAL (24, 2) ;  
GO 

ALTER TABLE dbo.spks ADD project_kawasan_id INT NULL  ;  
GO 

ALTER TABLE dbo.project_histories ADD pt_id INT NULL  ;  
GO

ALTER TABLE dbo.rekanan_groups ADD profile_images VARCHAR(512) NULL  ;  
GO 

ALTER TABLE dbo.rekanan_groups ADD project_id INT NULL  ;  
GO 

ALTER TABLE dbo.rekanan_groups ADD cv VARCHAR(512) NULL  ;  
GO 

ALTER TABLE dbo.project_kawasans ADD id_kawasan_erems INT NULL  ;  
GO 

ALTER TABLE  `pengajuanbiaya_details` ADD  `volume` INT NULL ,
ADD INDEX (  `volume` ) ;

ALTER TABLE  `pengajuanbiaya_details` ADD  `satuan` VARCHAR( 8 ) NULL ;


ALTER TABLE [dbo].[pengajuanbiayas] ADD doc_bayar_status INT NULL  ;  
GO 

ALTER TABLE [dbo].[pengajuanbiayas] ADD doc_bayar_date DATETIME NULL  ;  
GO 

ALTER TABLE dbo.tender_rekanans ALTER COLUMN is_pemenang INT NULL;  
GO 

ALTER TABLE [dbo].[pengajuanbiayas] ADD itempekerjaan_id INT NULL ;  
GO 

ALTER TABLE  `pengajuanbiaya_details` ADD  `pengajuan_biaya_id` INT NULL ,
ADD INDEX (  `pengajuan_biaya_id` ) ;

ALTER TABLE [dbo].[rekanan_supps] ADD saksi_rekanan_name_2 INT NULL ;  
GO 

ALTER TABLE [dbo].[users] ADD is_pic INT NULL  ;  
GO 

ALTER TABLE [dbo].[spks] ADD min_progress_dp INT NULL  ;  
GO 

ALTER TABLE  [dbo].[approval_references]
ADD  param_min  VARCHAR( 8 ) NULL ,
ADD  param_max  VARCHAR( 8 ) NULL ;

ALTER TABLE dbo.baps ALTER COLUMN nilai_bap_1 DECIMAL (25, 2) ;  
GO 

ALTER TABLE dbo.baps ALTER COLUMN nilai_bap_2 DECIMAL (25, 2) ;  
GO 

ALTER TABLE dbo.baps ALTER COLUMN nilai_bap_3 DECIMAL (25, 2) ;  
GO

ALTER TABLE dbo.baps ALTER COLUMN nilai_bap_dibayar DECIMAL (25, 2) ;  
GO 

ALTER TABLE dbo.baps ALTER COLUMN nilai_retensi DECIMAL (25, 2) ;  
GO  

ALTER TABLE dbo.baps ALTER COLUMN percentage_lapangan DECIMAL (25, 2) ;  
GO 

ALTER TABLE dbo.baps ALTER COLUMN percentage_sebelumnyas DECIMAL (25, 2) ;  
GO

ALTER TABLE dbo.units ADD serah_terima_plan DATETIME ;  
GO 

ALTER TABLE dbo.units ADD pembayaran DECIMAL (25, 2) INT NULL ;  
GO 
