<?php

use Illuminate\Database\Seeder;

class SpkTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('spk_types')->delete();
        
        \DB::table('spk_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => 'Pengembalian DP',
                'created_at' => '2019-01-17 00:00:00',
                'updated_at' => '2019-01-17 00:00:00',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'description' => 'Counter Progress',
                'created_at' => '2019-01-17 00:00:00',
                'updated_at' => '2019-01-17 00:00:00',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
        ));
        
        
    }
}