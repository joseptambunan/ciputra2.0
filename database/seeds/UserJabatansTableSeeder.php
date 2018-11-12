<?php

use Illuminate\Database\Seeder;

class UserJabatansTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_jabatans')->delete();
		\DB::statement('SET IDENTITY_INSERT user_jabatans ON');
        \DB::table('user_jabatans')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'DIRUTS',
                'name' => 'Direktur Utama',
                'description' => NULL,
                'created_at' => '2018-03-29 04:23:10',
                'updated_at' => '2018-07-31 20:46:30',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'code' => 'SDIR',
                'name' => 'Senior Direktur',
                'description' => NULL,
                'created_at' => '2018-04-05 06:46:11',
                'updated_at' => '2018-07-31 20:59:05',
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
                'code' => 'DIR',
                'name' => 'Direktur',
                'description' => NULL,
                'created_at' => '2018-04-05 06:46:36',
                'updated_at' => '2018-07-31 20:59:16',
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
                'code' => 'ASSDIR',
                'name' => 'Assosiate Direktur',
                'description' => NULL,
                'created_at' => '2018-04-05 06:46:53',
                'updated_at' => '2018-07-31 20:59:28',
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
                'code' => 'GM',
                'name' => 'General Manager',
                'description' => NULL,
                'created_at' => '2018-04-05 06:47:07',
                'updated_at' => '2018-04-05 06:47:07',
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
                'code' => 'HOD',
                'name' => 'Kepala Departemen',
                'description' => NULL,
                'created_at' => '2018-04-05 08:53:54',
                'updated_at' => '2018-07-30 15:41:17',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'code' => 'HDV',
                'name' => 'Kepala Divisi',
                'description' => NULL,
                'created_at' => '2018-04-05 09:03:55',
                'updated_at' => '2018-07-30 15:41:31',
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
                'code' => 'SPV',
                'name' => 'Pengawas Lapangan',
                'description' => NULL,
                'created_at' => '2018-05-28 07:53:23',
                'updated_at' => '2018-07-31 20:51:26',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            8 => 
            array (
                'id' => 10,
                'code' => 'ADM',
                'name' => 'Administrasi',
                'description' => 'ADMINISTRASI',
                'created_at' => '2018-07-31 20:47:23',
                'updated_at' => '2018-07-31 20:47:51',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            9 => 
            array (
                'id' => 12,
                'code' => 'CSR',
                'name' => 'Kasir',
                'description' => NULL,
                'created_at' => '2018-07-31 20:52:32',
                'updated_at' => '2018-07-31 20:52:32',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            10 => 
            array (
                'id' => 13,
                'code' => 'PM',
                'name' => 'Project Manager',
                'description' => NULL,
                'created_at' => '2018-10-04 16:00:01',
                'updated_at' => '2018-10-04 16:00:01',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
            ),
            11 => 
            array (
                'id' => 15,
                'code' => 'PM',
                'name' => 'Project Manager',
                'description' => 'Project Manager',
                'created_at' => '2018-10-05 10:05:49',
                'updated_at' => '2018-10-05 10:05:49',
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