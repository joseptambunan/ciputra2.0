<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        \ DB::statement('SET IDENTITY_INSERT categories ON');
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 3,
                'name' => 'RS',
                'luas' => NULL,
                'paremeter' => NULL,
                'created_at' => '2018-10-30 10:09:06',
                'created_by' => 1,
                'updated_at' => '2018-10-30 10:09:06',
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_by' => NULL,
                'inactive_at' => NULL,
            ),
            1 => 
            array (
                'id' => 4,
                'name' => 'RE',
                'luas' => NULL,
                'paremeter' => NULL,
                'created_at' => '2018-10-30 10:09:28',
                'created_by' => 1,
                'updated_at' => '2018-10-30 10:09:28',
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_by' => NULL,
                'inactive_at' => NULL,
            ),
            2 => 
            array (
                'id' => 5,
                'name' => 'Ruko',
                'luas' => NULL,
                'paremeter' => NULL,
                'created_at' => '2018-10-30 10:09:33',
                'created_by' => 1,
                'updated_at' => '2018-10-30 10:09:33',
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_by' => NULL,
                'inactive_at' => NULL,
            ),
            3 => 
            array (
                'id' => 6,
                'name' => 'Gudang',
                'luas' => NULL,
                'paremeter' => NULL,
                'created_at' => '2018-10-30 10:09:37',
                'created_by' => 1,
                'updated_at' => '2018-10-30 10:09:37',
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_by' => NULL,
                'inactive_at' => NULL,
            ),
            4 => 
            array (
                'id' => 9,
                'name' => 'RSS',
                'luas' => NULL,
                'paremeter' => NULL,
                'created_at' => '2018-10-31 05:45:44',
                'created_by' => 1,
                'updated_at' => '2018-10-31 05:45:44',
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_by' => NULL,
                'inactive_at' => NULL,
            ),
        ));
        
        
    }
}