<?php

use Illuminate\Database\Seeder;

class ProjectHistoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('project_histories')->delete();
        
        \DB::table('project_histories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'project_id' => 9,
                'luas_dikembangkan' => 50000,
                'luas_non_pengembangan' => 0,
                'created_at' => '2018-12-17 08:24:11',
                'updated_at' => '2018-12-17 08:24:11',
                'created_by' => 37,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'pt_id' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'project_id' => 9,
                'luas_dikembangkan' => 50000,
                'luas_non_pengembangan' => 0,
                'created_at' => '2018-12-17 08:24:19',
                'updated_at' => '2018-12-17 08:24:19',
                'created_by' => 37,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'pt_id' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'project_id' => 1,
                'luas_dikembangkan' => 638455,
                'luas_non_pengembangan' => 0,
                'created_at' => '2018-12-19 09:02:10',
                'updated_at' => '2018-12-19 09:02:10',
                'created_by' => 42,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'pt_id' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'project_id' => 3,
                'luas_dikembangkan' => 63996,
                'luas_non_pengembangan' => 400000,
                'created_at' => '2018-12-20 02:56:19',
                'updated_at' => '2018-12-20 02:56:19',
                'created_by' => 44,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'pt_id' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'project_id' => 3,
                'luas_dikembangkan' => 63996,
                'luas_non_pengembangan' => 400000,
                'created_at' => '2018-12-20 03:00:33',
                'updated_at' => '2018-12-20 03:00:33',
                'created_by' => 44,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'pt_id' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'project_id' => 61,
                'luas_dikembangkan' => 239105,
                'luas_non_pengembangan' => 938000,
                'created_at' => '2018-12-20 07:15:29',
                'updated_at' => '2018-12-20 07:15:29',
                'created_by' => 46,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'pt_id' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'project_id' => 61,
                'luas_dikembangkan' => 239105,
                'luas_non_pengembangan' => 939000,
                'created_at' => '2018-12-20 07:16:45',
                'updated_at' => '2018-12-20 07:16:45',
                'created_by' => 46,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'pt_id' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'project_id' => 1,
                'luas_dikembangkan' => 244214,
                'luas_non_pengembangan' => 400662,
                'created_at' => '2018-12-21 07:04:58',
                'updated_at' => '2018-12-21 07:04:58',
                'created_by' => 42,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'pt_id' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'project_id' => 1,
                'luas_dikembangkan' => 244965,
                'luas_non_pengembangan' => 399911,
                'created_at' => '2018-12-21 07:27:53',
                'updated_at' => '2018-12-21 07:27:53',
                'created_by' => 42,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'pt_id' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'project_id' => 1,
                'luas_dikembangkan' => 237793,
                'luas_non_pengembangan' => 399911,
                'created_at' => '2018-12-26 07:35:28',
                'updated_at' => '2018-12-26 07:35:28',
                'created_by' => 42,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'pt_id' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'project_id' => 3,
                'luas_dikembangkan' => 112313,
                'luas_non_pengembangan' => 400000,
                'created_at' => '2018-12-27 08:54:22',
                'updated_at' => '2018-12-27 08:54:22',
                'created_by' => 44,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'pt_id' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'project_id' => 3,
                'luas_dikembangkan' => 155378,
                'luas_non_pengembangan' => 400000,
                'created_at' => '2018-12-27 09:03:13',
                'updated_at' => '2018-12-27 09:03:13',
                'created_by' => 44,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'pt_id' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'project_id' => 3,
                'luas_dikembangkan' => 156934,
                'luas_non_pengembangan' => 400000,
                'created_at' => '2019-01-09 02:03:09',
                'updated_at' => '2019-01-09 02:03:09',
                'created_by' => 44,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'pt_id' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'project_id' => 60,
                'luas_dikembangkan' => 393755,
                'luas_non_pengembangan' => 0,
                'created_at' => '2019-01-14 07:44:35',
                'updated_at' => '2019-01-14 07:44:35',
                'created_by' => 30,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'pt_id' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'project_id' => 3,
                'luas_dikembangkan' => 162462,
                'luas_non_pengembangan' => 400000,
                'created_at' => '2019-01-18 03:12:55',
                'updated_at' => '2019-01-18 03:12:55',
                'created_by' => 44,
                'updated_by' => NULL,
                'deleted_at' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'pt_id' => NULL,
            ),
        ));
        
        
    }
}