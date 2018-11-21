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



