<?php

use Illuminate\Database\Seeder;

class BanksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('dbo.banks')->delete();
        \DB::statement('SET IDENTITY_INSERT [dbo].[banks] ON');
        \DB::table('dbo.banks')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Bank Central Asia KCP Sudirman',
                'description' => NULL,
                'created_at' => '2018-07-26 14:26:53',
                'updated_at' => '2018-07-31 23:06:12',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'masking' => 'xxxx-xx-xx-xx',
                'city_id' => 5,
                'estate_id' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Bank Mandiri',
                'description' => NULL,
                'created_at' => '2018-07-26 14:33:06',
                'updated_at' => '2018-07-26 14:41:34',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'masking' => 'xxx-xx-xxxxxxx-x',
                'city_id' => 0,
                'estate_id' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Bank Rakyat Indonesia',
                'description' => NULL,
                'created_at' => '2018-07-26 14:33:14',
                'updated_at' => '2018-07-26 14:42:18',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'masking' => 'xxxx-xx-xxxxxxxx-x',
                'city_id' => 7,
                'estate_id' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Bank Central Asia KCP Ratu Plaza',
                'description' => NULL,
                'created_at' => '2018-07-30 15:55:51',
                'updated_at' => '2018-07-31 23:03:06',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'masking' => 'xxxx-xx-xx-xx',
                'city_id' => 4,
                'estate_id' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'MAYBANK',
                'description' => NULL,
                'created_at' => '2018-07-31 22:51:32',
                'updated_at' => '2018-07-31 22:51:32',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'masking' => 'XXX-XXX-XXXXXXX',
                'city_id' => 4,
                'estate_id' => NULL,
            ),
        ));
        
        
    }
}