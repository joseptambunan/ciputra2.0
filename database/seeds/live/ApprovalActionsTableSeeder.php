<?php

use Illuminate\Database\Seeder;

class ApprovalActionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('approval_actions')->delete();
        
        \DB::table('approval_actions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => 'open',
                'created_at' => '2018-03-31 15:48:38',
                'updated_at' => '2018-03-31 15:48:38',
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
                'description' => 'delivered',
                'created_at' => '2018-03-31 15:48:38',
                'updated_at' => '2018-03-31 15:48:38',
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
                'description' => 'in progress',
                'created_at' => '2018-03-31 15:48:38',
                'updated_at' => '2018-03-31 15:48:38',
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
                'description' => 'on hold',
                'created_at' => '2018-03-31 15:48:38',
                'updated_at' => '2018-03-31 15:48:38',
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
                'description' => 'released',
                'created_at' => '2018-03-31 15:48:38',
                'updated_at' => '2018-03-31 15:48:38',
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
                'description' => 'approved',
                'created_at' => '2018-03-31 15:48:38',
                'updated_at' => '2018-03-31 15:48:38',
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
                'description' => 'rejected',
                'created_at' => '2018-03-31 15:48:38',
                'updated_at' => '2018-03-31 15:48:38',
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
                'description' => 'closed',
                'created_at' => '2018-03-31 15:48:38',
                'updated_at' => '2018-03-31 15:48:38',
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
                'description' => 'canceled',
                'created_at' => '2018-03-31 15:48:38',
                'updated_at' => '2018-03-31 15:48:38',
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
                'description' => 'active',
                'created_at' => '2018-03-31 15:48:38',
                'updated_at' => '2018-03-31 15:48:38',
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
                'description' => 'inactive',
                'created_at' => '2018-03-31 15:48:38',
                'updated_at' => '2018-03-31 15:48:38',
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