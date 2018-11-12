<?php

use Illuminate\Database\Seeder;

class CategoryProjectsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('category_projects')->delete();
        
        \DB::table('category_projects')->insert(array (
            0 => 
            array (
                'id' => 1,
                'category_detail_id' => 1,
                'unit_type_id' => 76,
                'project_id' => 82,
                'created_by' => 32,
                'created_at' => '2018-10-31 07:02:23',
                'updated_by' => NULL,
                'updated_at' => '2018-10-31 07:02:23',
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            1 => 
            array (
                'id' => 3,
                'category_detail_id' => 3,
                'unit_type_id' => 77,
                'project_id' => 82,
                'created_by' => 32,
                'created_at' => '2018-10-31 08:55:49',
                'updated_by' => NULL,
                'updated_at' => '2018-10-31 08:55:49',
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
        ));
        
        
    }
}