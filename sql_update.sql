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

