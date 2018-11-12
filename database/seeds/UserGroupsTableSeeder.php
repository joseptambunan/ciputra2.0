<?php

use Illuminate\Database\Seeder;

class UserGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_groups')->delete();
        \DB::statement('SET IDENTITY_INSERT user_groups ON');
        \DB::table('user_groups')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'administrator',
                'is_rekanan' => 0,
                'description' => 'Group untuk app administrator',
                'created_at' => '2018-04-01 12:48:23',
                'updated_at' => '2018-04-01 12:48:23',
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
                'name' => 'restricted',
                'is_rekanan' => 0,
                'description' => 'Group untuk user tanpa akses apa-apa',
                'created_at' => '2018-04-01 12:48:23',
                'updated_at' => '2018-04-01 12:48:23',
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
                'name' => 'pic',
                'is_rekanan' => 0,
                'description' => 'Group untuk PIC Lapangan',
                'created_at' => '2018-05-28 00:00:00',
                'updated_at' => '2018-05-28 00:00:00',
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