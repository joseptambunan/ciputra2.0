<?php

use Illuminate\Database\Seeder;

class CategoryDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('category_details')->delete();
        \DB::statement('SET IDENTITY_INSERT category_details ON');
        \DB::table('category_details')->insert(array (
            0 => 
            array (
                'id' => 1,
                'category_id' => 3,
            'sub_type' => 'Tipe(C) Ciamik',
                'created_at' => '2018-10-31 06:13:18',
                'created_by' => NULL,
                'updated_at' => '2018-10-31 06:56:16',
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_by' => NULL,
                'inactive_at' => NULL,
                'percentage' => '3.00',
            ),
            1 => 
            array (
                'id' => 2,
                'category_id' => 4,
            'sub_type' => 'Tipe(C) Ciamik',
                'created_at' => '2018-10-31 06:13:41',
                'created_by' => NULL,
                'updated_at' => '2018-10-31 06:53:55',
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_by' => NULL,
                'inactive_at' => NULL,
                'percentage' => '3.00',
            ),
            2 => 
            array (
                'id' => 3,
                'category_id' => 4,
            'sub_type' => 'Tipe(B) Bagus',
                'created_at' => '2018-10-31 06:13:51',
                'created_by' => NULL,
                'updated_at' => '2018-10-31 06:54:33',
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_by' => NULL,
                'inactive_at' => NULL,
                'percentage' => '3.50',
            ),
            3 => 
            array (
                'id' => 4,
                'category_id' => 4,
            'sub_type' => 'Tipe (A)Apik',
                'created_at' => '2018-10-31 06:14:04',
                'created_by' => NULL,
                'updated_at' => '2018-10-31 06:56:05',
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_by' => NULL,
                'inactive_at' => NULL,
                'percentage' => '3.25',
            ),
            4 => 
            array (
                'id' => 5,
                'category_id' => 5,
            'sub_type' => 'Ruko (A)',
                'created_at' => '2018-10-31 06:14:24',
                'created_by' => NULL,
                'updated_at' => '2018-10-31 06:14:24',
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_by' => NULL,
                'inactive_at' => NULL,
                'percentage' => '0.00',
            ),
            5 => 
            array (
                'id' => 6,
                'category_id' => 6,
            'sub_type' => 'Gudang(A)',
                'created_at' => '2018-10-31 06:14:42',
                'created_by' => NULL,
                'updated_at' => '2018-10-31 06:14:42',
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_by' => NULL,
                'inactive_at' => NULL,
                'percentage' => '0.00',
            ),
        ));
        
        
    }
}