<?php

use Illuminate\Database\Seeder;

class DivisionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('divisions')->delete();
        
        \DB::table('divisions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'ACC',
                'name' => 'Accounting',
                'description' => 'Accounting',
                'created_at' => '2018-07-03 22:21:04',
                'updated_at' => '2018-07-03 22:21:04',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'code' => 'BUI',
                'name' => 'Building',
                'description' => 'Building',
                'created_at' => '2018-07-03 22:21:04',
                'updated_at' => '2018-07-03 22:21:04',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'code' => 'COL',
                'name' => 'Collection',
                'description' => 'Collection',
                'created_at' => '2018-07-03 22:21:04',
                'updated_at' => '2018-07-03 22:21:04',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'code' => 'CP',
                'name' => 'Contract & Procurement',
                'description' => 'Contract & Procurement',
                'created_at' => '2018-07-03 22:21:04',
                'updated_at' => '2018-07-03 22:21:04',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'code' => 'CR',
                'name' => 'Customer Relation',
                'description' => 'Customer Relation',
                'created_at' => '2018-07-03 22:21:04',
                'updated_at' => '2018-07-03 22:21:04',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'code' => 'FAC',
                'name' => 'Facilities',
                'description' => 'Facilities',
                'created_at' => '2018-07-03 22:21:04',
                'updated_at' => '2018-07-03 22:21:04',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'code' => 'HCM',
                'name' => 'Human Capital Management & GA',
                'description' => 'Human Capital Management & GA',
                'created_at' => '2018-07-03 22:21:04',
                'updated_at' => '2018-07-03 22:21:04',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'code' => 'ICT',
                'name' => 'Information Computer Technologi',
                'description' => 'ICT',
                'created_at' => '2018-07-03 22:21:04',
                'updated_at' => '2018-07-31 15:04:06',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'code' => 'INF',
                'name' => 'Infrastructure',
                'description' => 'Infrastructure',
                'created_at' => '2018-07-03 22:21:04',
                'updated_at' => '2018-07-03 22:21:04',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'code' => 'LAA',
                'name' => 'Land Administration',
                'description' => 'Land Administration',
                'created_at' => '2018-07-03 22:21:05',
                'updated_at' => '2018-07-03 22:21:05',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'code' => 'LAQ',
                'name' => 'Land Aquisition',
                'description' => 'Land Aquisition',
                'created_at' => '2018-07-03 22:21:05',
                'updated_at' => '2018-07-03 22:21:05',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'code' => 'LH',
                'name' => 'Landscape & Housekeeping',
                'description' => 'Landscape & Housekeeping',
                'created_at' => '2018-07-03 22:21:05',
                'updated_at' => '2018-07-03 22:21:05',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'code' => 'LEG',
                'name' => 'Legal & Mortgage',
                'description' => 'Legal & Mortgage',
                'created_at' => '2018-07-03 22:21:05',
                'updated_at' => '2018-07-03 22:21:05',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'code' => 'LIT',
                'name' => 'Litigation',
                'description' => 'Litigation',
                'created_at' => '2018-07-03 22:21:05',
                'updated_at' => '2018-07-03 22:21:05',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'code' => 'PER',
                'name' => 'Permit',
                'description' => 'Permit',
                'created_at' => '2018-07-03 22:21:05',
                'updated_at' => '2018-07-03 22:21:05',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'code' => 'PD',
                'name' => 'Planning & Design',
                'description' => 'Planning & Design',
                'created_at' => '2018-07-03 22:21:05',
                'updated_at' => '2018-07-03 22:21:05',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'code' => 'PRO',
                'name' => 'Promotion',
                'description' => 'Promotion',
                'created_at' => '2018-07-03 22:21:05',
                'updated_at' => '2018-07-03 22:21:05',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'code' => 'PUR',
                'name' => 'Purchasing',
                'description' => 'Purchasing',
                'created_at' => '2018-07-03 22:21:05',
                'updated_at' => '2018-07-03 22:21:05',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'code' => 'RET',
                'name' => 'Retribution',
                'description' => 'Retribution',
                'created_at' => '2018-07-03 22:21:05',
                'updated_at' => '2018-07-03 22:21:05',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'code' => 'SAL',
                'name' => 'Sales',
                'description' => 'Sales',
                'created_at' => '2018-07-03 22:21:05',
                'updated_at' => '2018-07-03 22:21:05',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'code' => 'SEC',
                'name' => 'Security',
                'description' => 'Security',
                'created_at' => '2018-07-03 22:21:05',
                'updated_at' => '2018-07-03 22:21:05',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'code' => 'TAX',
                'name' => 'Tax',
                'description' => 'Tax',
                'created_at' => '2018-07-03 22:21:05',
                'updated_at' => '2018-07-03 22:21:05',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'code' => 'TRE',
                'name' => 'Treasury',
                'description' => 'Treasury',
                'created_at' => '2018-07-03 22:21:05',
                'updated_at' => '2018-07-03 22:21:05',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'code' => 'UTI',
                'name' => 'Utility & Infrastructure',
                'description' => 'Utility & Infrastructure',
                'created_at' => '2018-07-03 22:21:05',
                'updated_at' => '2018-07-03 22:21:05',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'code' => 'WAT',
                'name' => 'Water Supply',
                'description' => 'Water Supply',
                'created_at' => '2018-07-03 22:21:05',
                'updated_at' => '2018-07-03 22:21:05',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'code' => 'WTP',
                'name' => 'Water Park',
                'description' => 'Water Park',
                'created_at' => '2018-07-03 22:21:05',
                'updated_at' => '2018-07-03 22:21:05',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'code' => 'EST',
                'name' => 'Estate',
                'description' => NULL,
                'created_at' => '2018-10-01 13:05:23',
                'updated_at' => '2018-10-01 13:05:23',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
        ));
        
        
    }
}