<?php

use Illuminate\Database\Seeder;

class UserRekanansTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_rekanans')->delete();
        \DB::statement('SET IDENTITY_INSERT user_rekanans ON');
        \DB::table('user_rekanans')->insert(array (
            0 => 
            array (
                'id' => 5,
                'user_login' => 'rekanan_harapan_jaya',
                'user_name' => 'rekanan_harapan_jaya',
                'is_rekanan' => 1,
                'password' => '$2y$10$5qbkmjanzGeja4qeKUovgOaGy186pagvZwEzMi85KGveRDkRFkeDm',
                'description' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-11-02 03:33:31',
                'updated_at' => '2018-11-02 03:33:31',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'rekanan_group_id' => 768,
            ),
            1 => 
            array (
                'id' => 6,
                'user_login' => 'rekanan_abc',
                'user_name' => 'rekanan_abc',
                'is_rekanan' => 1,
                'password' => '$2y$10$2RTSpf/kGxK1a6A1w3hrAueGRO3vMMbZ.RLj1CMEUVkKdmVlRfiuy',
                'description' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-11-02 08:50:58',
                'updated_at' => '2018-11-02 08:53:48',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'rekanan_group_id' => 769,
            ),
            2 => 
            array (
                'id' => 7,
                'user_login' => 'rekanan_harapan_jaya',
                'user_name' => 'rekanan_harapan_jaya',
                'is_rekanan' => 1,
                'password' => '$2y$10$bMxkU5ociLscHkHU76MjOefpISWwC8pVn2Sy5wEv/yajZwx4mXlcu',
                'description' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-11-03 11:38:41',
                'updated_at' => '2018-11-03 11:38:41',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'rekanan_group_id' => 770,
            ),
            3 => 
            array (
                'id' => 8,
                'user_login' => 'rekanan_harapan',
                'user_name' => 'rekanan_harapan',
                'is_rekanan' => 1,
                'password' => '$2y$10$CepQ3IJxRJ1NZBGwFYReuuiLmlqep3HFcMHIw6Tepu69bJTK17EHi',
                'description' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-11-03 11:39:01',
                'updated_at' => '2018-11-03 11:39:01',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'rekanan_group_id' => 770,
            ),
        ));
        
        
    }
}