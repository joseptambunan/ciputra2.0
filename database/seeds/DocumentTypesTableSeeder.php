<?php

use Illuminate\Database\Seeder;

class DocumentTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('document_types')->delete();
        \DB::statement('SET IDENTITY_INSERT document_types ON');
        \DB::table('document_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'head_type' => 'Budget',
                'description' => NULL,
                'created_at' => '2018-07-27 17:47:45',
                'updated_at' => '2018-08-01 18:00:16',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            1 => 
            array (
                'id' => 6,
                'head_type' => 'BudgetTahunan',
                'description' => NULL,
                'created_at' => '2018-07-27 17:49:57',
                'updated_at' => '2018-07-27 17:50:58',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            2 => 
            array (
                'id' => 7,
                'head_type' => 'Workorder',
                'description' => NULL,
                'created_at' => '2018-07-27 17:51:07',
                'updated_at' => '2018-08-01 18:01:08',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            3 => 
            array (
                'id' => 8,
                'head_type' => 'Rab',
                'description' => NULL,
                'created_at' => '2018-07-27 17:51:19',
                'updated_at' => '2018-07-27 17:51:19',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            4 => 
            array (
                'id' => 9,
                'head_type' => 'Tender',
                'description' => NULL,
                'created_at' => '2018-07-27 17:51:24',
                'updated_at' => '2018-08-01 18:00:54',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            5 => 
            array (
                'id' => 10,
                'head_type' => 'Spk',
                'description' => NULL,
                'created_at' => '2018-07-27 17:51:49',
                'updated_at' => '2018-07-27 17:51:49',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            6 => 
            array (
                'id' => 11,
                'head_type' => 'Bap',
                'description' => NULL,
                'created_at' => '2018-07-27 17:51:56',
                'updated_at' => '2018-07-27 17:51:56',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            7 => 
            array (
                'id' => 12,
                'head_type' => 'Vo',
                'description' => NULL,
                'created_at' => '2018-07-27 17:52:01',
                'updated_at' => '2018-07-27 17:52:01',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            8 => 
            array (
                'id' => 13,
                'head_type' => 'Voucher',
                'description' => NULL,
                'created_at' => '2018-07-27 17:52:07',
                'updated_at' => '2018-08-01 18:01:29',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            9 => 
            array (
                'id' => 14,
                'head_type' => 'Purchase Requesition',
                'description' => NULL,
                'created_at' => '2018-07-27 17:52:22',
                'updated_at' => '2018-08-01 18:02:05',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            10 => 
            array (
                'id' => 15,
                'head_type' => 'Purchase Order',
                'description' => NULL,
                'created_at' => '2018-08-01 18:02:18',
                'updated_at' => '2018-08-01 18:02:18',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            11 => 
            array (
                'id' => 16,
                'head_type' => 'TenderRekanan',
                'description' => NULL,
                'created_at' => '2018-09-05 14:00:00',
                'updated_at' => '2018-09-05 14:00:00',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            12 => 
            array (
                'id' => 17,
                'head_type' => 'TenderMenang',
                'description' => NULL,
                'created_at' => '2018-09-05 14:00:00',
                'updated_at' => '2018-09-05 14:00:00',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            13 => 
            array (
                'id' => 18,
                'head_type' => 'BudgetDraft',
                'description' => 'BudgetDraft',
                'created_at' => '2018-09-19 14:00:00',
                'updated_at' => '2018-09-19 14:00:00',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
        ));
        
        
    }
}