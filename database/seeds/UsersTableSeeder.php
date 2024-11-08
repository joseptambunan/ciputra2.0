<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
		
        \DB::table('users')->delete();
         DB::statement('SET IDENTITY_INSERT users ON');
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_login' => 'administrator',
                'user_name' => 'Administrator',
                'is_rekanan' => 1,
                'email' => 'administrator@ciputra.com',
                'user_phone' => NULL,
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$CU/xdfZv4E.SQMyw9JSJCuWBgCoxcmHTwhPHsmT2YXIibeBeNpyge',
                'description' => 'default administrator account',
                'remember_token' => 'tBomOLKgbSpDjMaxCkMVWQP5d3xQRkKRlJhbO00vwLSB3VNx8scrJHHXj7OQ',
                'created_at' => '2018-03-29 04:23:11',
                'updated_at' => '2018-08-15 17:33:56',
                'deleted_at' => NULL,
                'created_by' => NULL,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'user_login' => 'restricted',
                'user_name' => 'Restricted User',
                'is_rekanan' => 0,
                'email' => 'restricted@ciputra.com',
                'user_phone' => NULL,
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$syr13zaNp2BR61TfCgBqMOrUANWrQ.NgvHVMHduA9ykmVDinXmOme',
                'description' => 'restricted user without any privilege',
                'remember_token' => NULL,
                'created_at' => '2018-03-29 04:23:11',
                'updated_at' => '2018-03-29 04:23:11',
                'deleted_at' => '2018-10-05 00:00:00',
                'created_by' => NULL,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'user_login' => 'admin2',
                'user_name' => 'Admin 2',
                'is_rekanan' => 1,
                'email' => 'admin2@gmail.com',
                'user_phone' => NULL,
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$JjTmoUBJ6b3ZB8fNOSDQqeILm7z7nzo4jb4vSe.5u1TOgnYn27wjm',
                'description' => 'Admin 2',
                'remember_token' => NULL,
                'created_at' => '2018-04-05 03:28:54',
                'updated_at' => '2018-04-05 03:28:54',
                'deleted_at' => '2018-10-05 00:00:00',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'user_login' => 'direktur',
                'user_name' => 'DIrektur Utama',
                'is_rekanan' => 1,
                'email' => 'direktur@ciputra.com',
                'user_phone' => NULL,
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$zPHVj8r/maBRi7JcX1N5heeztQUVaxrthHvhQVMSZx4Tw.9lggwD6',
                'description' => 'Direktur',
                'remember_token' => '7dWQGGAh7nk4UkowELN8ZyTkv1MGZzso8Yc95ScPcnnFHVfDRPQSVLV5G5wV',
                'created_at' => '2018-04-05 06:37:38',
                'updated_at' => '2018-04-05 06:37:38',
                'deleted_at' => '2018-10-05 00:00:00',
                'created_by' => 1,
                'updated_by' => 4,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'user_login' => 'manager',
                'user_name' => 'General Manager',
                'is_rekanan' => 1,
                'email' => 'manager@ciputra.com',
                'user_phone' => NULL,
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$L4udJAJMqaImJVjURbl8Ve28dONuOYHjKszvtWlVQDWkI69xiwNIW',
                'description' => 'asdasdasdasscasdfsfsfsdf',
                'remember_token' => '6lvTLaG6e22Ib0KtgceCMgv0yCrcU3Xm1ULSXnfxnrFXxh6GKUzZOEr70mCJ',
                'created_at' => '2018-04-05 06:43:19',
                'updated_at' => '2018-07-30 09:59:58',
                'deleted_at' => '2018-10-05 00:00:00',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'user_login' => 'budi',
                'user_name' => 'Budi',
                'is_rekanan' => 1,
                'email' => 'budi@ciputra.com',
                'user_phone' => NULL,
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$/lUbj/UQcUIiukPf6r3MbOanlf8v.Aavcu57cjvh1nDKC3Ka6dDx.',
                'description' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-04-05 06:49:38',
                'updated_at' => '2018-04-05 06:49:38',
                'deleted_at' => '2018-10-05 00:00:00',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'user_login' => 'indra',
                'user_name' => 'Indra',
                'is_rekanan' => 0,
                'email' => 'indra@ciputra.com',
                'user_phone' => NULL,
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$phMWIsguEjwjYB0Y6TPFouT7EL/J8weK8CMijT9M0xteEsA0MposO',
                'description' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-04-05 06:52:16',
                'updated_at' => '2018-04-05 06:52:16',
                'deleted_at' => '2018-10-05 00:00:00',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'user_login' => 'nani',
                'user_name' => 'Nani',
                'is_rekanan' => 0,
                'email' => 'nani@ciputra.com',
                'user_phone' => NULL,
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$PdAdl80liq.PDFkUPVC/6eEet82sx3Al.azVcvupsWh7YzsuoRqvq',
                'description' => NULL,
                'remember_token' => 'VSAROSHrv9auYik40ASGCUlPaKw1ld5kSqOdhujJkHzwLW81WXoNBlJY7ATC',
                'created_at' => '2018-04-05 06:53:08',
                'updated_at' => '2018-04-05 06:53:08',
                'deleted_at' => '2018-10-05 00:00:00',
                'created_by' => 1,
                'updated_by' => 8,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'user_login' => 'approval1',
                'user_name' => 'Approval',
                'is_rekanan' => 1,
                'email' => 'harun@ciptutra.com',
                'user_phone' => NULL,
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$CU/xdfZv4E.SQMyw9JSJCuWBgCoxcmHTwhPHsmT2YXIibeBeNpyge',
                'description' => NULL,
                'remember_token' => 'GSJbAjKtxYFHpNlLZQxGpUiywQIkNrGiu7f2gW5tRljxpdgQTHIh4R2pAweM',
                'created_at' => '2018-04-05 06:54:20',
                'updated_at' => '2018-07-24 14:52:44',
                'deleted_at' => '2018-10-10 00:00:00',
                'created_by' => 1,
                'updated_by' => 9,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'user_login' => 'arman',
                'user_name' => 'Arman',
                'is_rekanan' => 1,
                'email' => 'arman@ciputra.com',
                'user_phone' => NULL,
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$uV0v2pRL2RA9g6BNDMZ4o.CSaRjSsTpO91wdXKuZ9t3C8wMbkwWqO',
                'description' => NULL,
                'remember_token' => 'BGoQZhmjrZk6XV1NShmQrWbD9rJICGliWv50QPFrWqYlMYz7POpz4py1hiIN',
                'created_at' => '2018-04-05 07:04:24',
                'updated_at' => '2018-04-05 07:04:24',
                'deleted_at' => '2018-10-05 00:00:00',
                'created_by' => 1,
                'updated_by' => 10,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'user_login' => 'taufik',
                'user_name' => 'Taufik',
                'is_rekanan' => 0,
                'email' => 'taufik@ciputra.com',
                'user_phone' => NULL,
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$z1JnxEmuMNmzOA8Loa3H/OsyvbONMbKyiuRxc4qYuxmHORUQc/Qfy',
                'description' => NULL,
                'remember_token' => 'YrG14dIC7tfb9XqZoefCQuC887UsOW7QHbK1wFDuJhZJcvev9HUEzrsYMDlg',
                'created_at' => '2018-04-05 08:41:12',
                'updated_at' => '2018-04-05 08:41:12',
                'deleted_at' => '2018-10-05 00:00:00',
                'created_by' => 1,
                'updated_by' => 11,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'user_login' => 'hidayat1',
                'user_name' => 'Hidayat1',
                'is_rekanan' => 0,
                'email' => 'hidayat1@ciputra.com',
                'user_phone' => NULL,
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$/NrIuFXgxgltPseYKxGQLeC2V1ap1PtJ0aZk9I1cgne24kHpzq0MK',
                'description' => NULL,
                'remember_token' => 'Mnc90qeAEud0ExoovCUR5aAMSpqH0eLaOgMo7TlLim3jWoR6PXayEFas6RAp',
                'created_at' => '2018-04-05 09:04:23',
                'updated_at' => '2018-04-05 09:04:23',
                'deleted_at' => '2018-10-05 00:00:00',
                'created_by' => 1,
                'updated_by' => 12,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'user_login' => 'hidayat2',
                'user_name' => 'Hidayat2',
                'is_rekanan' => 0,
                'email' => 'hidayat2',
                'user_phone' => NULL,
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$wQWdKwB/77B66shU3CaTCe7.jH.fv1QIrD1vtzwraSnW8yHMN8h.C',
                'description' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-04-05 09:05:21',
                'updated_at' => '2018-04-05 09:05:21',
                'deleted_at' => '2018-10-05 00:00:00',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'user_login' => 'hidayat3',
                'user_name' => 'Hidayat3',
                'is_rekanan' => 0,
                'email' => 'hidayat3',
                'user_phone' => NULL,
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$PpGPvUzV7DlLW64pFjaZe.q.49QZveD9J9bnxqcCjeA1KdhaPk686',
                'description' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-04-05 09:05:56',
                'updated_at' => '2018-04-05 09:05:56',
                'deleted_at' => '2018-10-05 00:00:00',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'user_login' => 'nancy',
                'user_name' => 'Nancy',
                'is_rekanan' => 0,
                'email' => 'nancy@ciputra.com',
                'user_phone' => NULL,
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$lJX9RZI55BY.GCNZiO3.ku2mcve8tRdGO5urQhZebzkn8la1WPbES',
                'description' => NULL,
                'remember_token' => 'i2TNP642micxCCJ3J5jXGNeiEFAfitceEMiuVmKjl8LMx7LFa3WovLZgJhBs',
                'created_at' => '2018-04-05 09:12:24',
                'updated_at' => '2018-04-05 09:12:24',
                'deleted_at' => '2018-10-05 00:00:00',
                'created_by' => 1,
                'updated_by' => 15,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'user_login' => 'pic2',
                'user_name' => 'pic2',
                'is_rekanan' => 0,
                'email' => 'pic2@ciputra.com',
                'user_phone' => NULL,
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$ZH6hQtYH7XaR2Naw786aWezCZob3X0oriw3eQLwC4iCsiy0mrKycG',
                'description' => 'For PIC',
                'remember_token' => '2B0h4E7Ly8uHDYGP3I0R9XtWrBgGGkg9JDsvFfl09qB3HxuTqFGPEC5QMIz9',
                'created_at' => '2018-05-28 07:50:56',
                'updated_at' => '2018-05-28 07:50:56',
                'deleted_at' => '2018-10-05 00:00:00',
                'created_by' => 1,
                'updated_by' => 16,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'user_login' => 'zidane',
                'user_name' => 'zidane',
                'is_rekanan' => 1,
                'email' => 'zidane@gmail.com',
                'user_phone' => '08123456789',
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$pl8670PG1aRmbsz52TmKN.QufbfZdkC7svX7cJS4CWfOiiS3IotEm',
                'description' => 'Zinedine Zidane',
                'remember_token' => NULL,
                'created_at' => '2018-07-30 09:47:09',
                'updated_at' => '2018-07-30 09:47:09',
                'deleted_at' => '2018-10-05 00:00:00',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'user_login' => 'tofa@ciputra.com',
                'user_name' => 'tofa',
                'is_rekanan' => 1,
                'email' => 'tofa@ciputra.com',
                'user_phone' => '08123525459',
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$vMMw.UhnyXwSSqQK9jbedeBg0o2FbHG81osDtS6in7ONwn8sA4XrW',
                'description' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-08-01 17:58:04',
                'updated_at' => '2018-08-01 17:59:10',
                'deleted_at' => '2018-10-05 00:00:00',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'user_login' => 'arifiradat',
                'user_name' => 'arifiradat',
                'is_rekanan' => 0,
                'email' => 'arifiradat@ciputra.com',
                'user_phone' => NULL,
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$y15KP3rGb8zRjZRK85ZDoeCs9.mk3dnkqVvWXlegGMF2AjLQ255jG',
                'description' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-08-15 17:35:51',
                'updated_at' => '2018-08-15 17:35:51',
                'deleted_at' => '2018-10-05 00:00:00',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'user_login' => 'bizPark2',
                'user_name' => 'bizPark2',
                'is_rekanan' => 0,
                'email' => 'bizpark2@ciputra.com',
                'user_phone' => '021-22101818',
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$P9JjPiidzMAYHYZDrtCbnux1.D2ug9SBYKYFOSYS.zZLrgiTE.b3m',
                'description' => 'Proyek pergudangan BizPark2',
                'remember_token' => 'DRGl2KcQ2J4PCKY4JoxnmxuYxI8yDg1YEc9kAEqAZJOgTyZ4B8EbcHyDnLkA',
                'created_at' => '2018-09-21 17:46:43',
                'updated_at' => '2018-09-21 17:46:43',
                'deleted_at' => '2018-10-05 00:00:00',
                'created_by' => 1,
                'updated_by' => 20,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'user_login' => 'BizPark3',
                'user_name' => 'BizPark3',
                'is_rekanan' => 1,
                'email' => 'bizpark3@ciputra.com',
                'user_phone' => '081364770433',
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$mO0dq46wisd8M7R7MU3Op.33ZjnPg10uKSburl6IyXFCMKmR7LeAy',
                'description' => NULL,
                'remember_token' => 'JID2JxsYxorI2280OMMOu4V7fyB8iHhsUfCAXkcaBCpp6gQRzWoDR62Ljcmm',
                'created_at' => '2018-09-27 20:50:38',
                'updated_at' => '2018-10-01 17:31:30',
                'deleted_at' => '2018-10-05 00:00:00',
                'created_by' => 1,
                'updated_by' => 21,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'user_login' => 'cbdapprove',
                'user_name' => 'cbdapprove',
                'is_rekanan' => 0,
                'email' => 'cbdapprove@ciputra.com',
                'user_phone' => '081364770433',
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$2fTI5lQuKQKAuLB9oXJCN.RuzkLahoW6/8uRnjtt6WDMjiGRyc3ui',
                'description' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-10-01 17:27:39',
                'updated_at' => '2018-10-01 17:27:39',
                'deleted_at' => '2018-10-05 00:00:00',
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            22 => 
            array (
                'id' => 24,
                'user_login' => 'dircitralandcibubur',
                'user_name' => 'dircitralandcibubur',
                'is_rekanan' => 0,
                'email' => 'citralandcibubur@ciputra.com',
                'user_phone' => NULL,
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$2gx.wR/ai/.gPT9iyRX7TefTDI5m1wNXIbe6e801ibn5s.2AtBIaW',
                'description' => 'User Approval',
                'remember_token' => '3liUB9iYqlNzkSWPRkyCVKbPaIHPzSYngbUtzyaVKrKun8tLXne3VidAsVQc',
                'created_at' => '2018-10-01 17:32:03',
                'updated_at' => '2018-10-05 10:07:50',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => 24,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            23 => 
            array (
                'id' => 25,
                'user_login' => 'assdir',
                'user_name' => 'assdir',
                'is_rekanan' => 0,
                'email' => 'cbddir2@gmail.com',
                'user_phone' => NULL,
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$0MvJvfNSqvpYjYC73u3nAOZ2lmQQlEfxGew/rHEtOjoHVgGfZl1wm',
                'description' => NULL,
                'remember_token' => 'GxZAGd20N3C2j6udDKcRCwrcIDuGG44i9upaykCdbqzWKe9y5g2MUcYOosDg',
                'created_at' => '2018-10-07 12:26:44',
                'updated_at' => '2018-11-09 11:23:52',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => 32,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            24 => 
            array (
                'id' => 26,
                'user_login' => 'cbdgm',
                'user_name' => 'cbdgm',
                'is_rekanan' => 0,
                'email' => 'cbdgm@ciptra.com',
                'user_phone' => '081364770433',
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$CbGhbUBJm/llTEvUNEI5Y.RDrInpTMvmXvWjgxdszsM7CE0ETtPia',
                'description' => NULL,
                'remember_token' => 't1jzbh1UkmOLyWZ2d3zhKd1njjuW7YMBBeR9rDEb2gGCKx0PUZRhMTVFtDgH',
                'created_at' => '2018-10-07 12:28:50',
                'updated_at' => '2018-10-07 12:28:50',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => 26,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            25 => 
            array (
                'id' => 27,
                'user_login' => 'cbdhod',
                'user_name' => 'cbdhod',
                'is_rekanan' => 1,
                'email' => 'cbdhod@ciputra.com',
                'user_phone' => '081364770433',
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$q6DwMkaP1BLp144EhgbB5uuReeJnAwUMNaoEaL/ZCLe6nbRqnU4f6',
                'description' => NULL,
                'remember_token' => 'pIGPUfC76YmZcFcT7icnPokO5L1YbbSpCyJitYlPXh8qRqJJHs0vb955Fh5Z',
                'created_at' => '2018-10-07 12:31:08',
                'updated_at' => '2018-10-07 12:31:37',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => 27,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            26 => 
            array (
                'id' => 28,
                'user_login' => 'sdir',
                'user_name' => 'sdir',
                'is_rekanan' => 0,
                'email' => 'josep.tambunan7@gmail.com',
                'user_phone' => NULL,
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$fKdYg2c64Y3LFUeFzBifm.40eYU73jv3xtA7BVMWDsM/dzvV25sum',
                'description' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-10-07 13:36:34',
                'updated_at' => '2018-11-09 11:42:57',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => 32,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            27 => 
            array (
                'id' => 29,
                'user_login' => 'cbddiv',
                'user_name' => 'cbddiv',
                'is_rekanan' => 0,
                'email' => 'cbddiv@gmail.com',
                'user_phone' => '081364770433',
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$5bCEl.PhQ9AwcxZAXXzPceKDYpFyyJqdmYtFqzIXR4pnc2ETEz.bW',
                'description' => NULL,
                'remember_token' => 'mhgSswlu8XQDIMqgJDb8l4TbgOebfMIcuOqgcdWCI6HQ61nF9U68kwWaqlD9',
                'created_at' => '2018-10-07 14:04:04',
                'updated_at' => '2018-10-07 14:04:04',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => 29,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            28 => 
            array (
                'id' => 30,
                'user_login' => 'cbdadmin',
                'user_name' => 'cbdadmin',
                'is_rekanan' => 0,
                'email' => 'cbdadmin@gmail.com',
                'user_phone' => '081364770433',
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$fVlvX.FWwARlw6Pubpc7mOo/Hsy/A3nZgoRoYUVEexFnLwurlIP32',
                'description' => NULL,
                'remember_token' => 'zEHrJpiqRCJCNWRfmjNwMurue8EhkD0CI1a6Cwek0aMmYiJ3fvBA9uk4tZwH',
                'created_at' => '2018-10-08 03:05:27',
                'updated_at' => '2018-10-08 03:05:27',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => 30,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            29 => 
            array (
                'id' => 31,
                'user_login' => 'bizpark3admin',
                'user_name' => 'bizpark3admin',
                'is_rekanan' => 0,
                'email' => 'bizpark3admin@ciputra.com',
                'user_phone' => '081364770433',
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$RW29z./vt0jhLRxQTYt.BeJu6llsjPwbvSmEsFKss/mYbtS1G.WAS',
                'description' => NULL,
                'remember_token' => 'T3mKuOZHh4fwW1uiNTcVFQ0VG5lAXBmtJjcq9tw5G8hgijF4vW4r2WVSTpqk',
                'created_at' => '2018-10-29 10:22:32',
                'updated_at' => '2018-10-29 10:22:32',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => 31,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            30 => 
            array (
                'id' => 32,
                'user_login' => 'proyekdummyadmin',
                'user_name' => 'proyekdummyadmin',
                'is_rekanan' => 0,
                'email' => 'proyekdummyadmin@gmail.com',
                'user_phone' => '081364770433',
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$4fkWgVB8Hzv3ejnjkXm3WOMOwNc8e1iJ6.QHanXT3a1uDAbtx3USe',
                'description' => NULL,
                'remember_token' => 'esm7YJFSR96gf72NoygrqecNDaU5FNZPIAMONeYtmk7rkzSBaSyKTyBuQtYa',
                'created_at' => '2018-10-30 03:36:49',
                'updated_at' => '2018-10-30 03:36:49',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => 32,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            31 => 
            array (
                'id' => 33,
                'user_login' => 'rekanan_harapan_jaya',
                'user_name' => 'rekanan_harapan_jaya',
                'is_rekanan' => 1,
                'email' => 'josep.tambunan7@gmail.com',
                'user_phone' => NULL,
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$jvhkiUtMic5CB2Rd2sssH.2cPuBJ4dhjNtR1K4kkQHYOO1OeLKaee',
                'description' => NULL,
                'remember_token' => '9YeGtC6hbyqunERlB85bLx4EBJIbi2dK9Dwn6zjRJZlCoTO3HHfdQad6pVLz',
                'created_at' => '2018-11-02 03:33:31',
                'updated_at' => '2018-11-02 03:33:31',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => 33,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            32 => 
            array (
                'id' => 34,
                'user_login' => 'rekanan_abc',
                'user_name' => 'rekanan_abc',
                'is_rekanan' => 1,
                'email' => NULL,
                'user_phone' => NULL,
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$wzZOhtEJOyVBrXO9kAFN7.t.W8kAHTqhnmQqD7JpvUUhE/IsBGyBW',
                'description' => NULL,
                'remember_token' => 'mCk7p8r1XupEw64kIegEAhG1hGs1JqfKj6dNP6KOG5x56a8QZzP9SV4De3Zh',
                'created_at' => '2018-11-02 08:53:48',
                'updated_at' => '2018-11-02 08:53:48',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => 34,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            33 => 
            array (
                'id' => 36,
                'user_login' => 'rekanan_harapan',
                'user_name' => 'rekanan_harapan',
                'is_rekanan' => 1,
                'email' => NULL,
                'user_phone' => NULL,
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$2gx.wR/ai/.gPT9iyRX7TefTDI5m1wNXIbe6e801ibn5s.2AtBIaW',
                'description' => NULL,
                'remember_token' => 'gLN4Eg8091YCqg4Siq9O0v1HjzzWW1C8PCTYZXg8yt43fm2WQlrp5Sn0n3Es',
                'created_at' => '2018-11-03 11:39:01',
                'updated_at' => '2018-11-03 11:39:01',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => 36,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            34 => 
            array (
                'id' => 37,
                'user_login' => 'clpbadmin',
                'user_name' => 'clpbadmin',
                'is_rekanan' => 0,
                'email' => 'clpbadmin@gmail.com',
                'user_phone' => '081364770433',
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$u7UMoJJ/mqIvoP.on0Eq1eZ88c4aqSeaK/8cqV0MNV1MtLhvb/Wxi',
                'description' => NULL,
                'remember_token' => 'S9U5tVhLASOX8nM63uelgWkZPl1pqfd28D161DrbhHx5WYLdoSILtHSF02xz',
                'created_at' => '2018-11-09 11:17:29',
                'updated_at' => '2018-11-09 11:17:29',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => 37,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            35 => 
            array (
                'id' => 38,
                'user_login' => 'dir',
                'user_name' => 'dir',
                'is_rekanan' => 0,
                'email' => 'josep.tambunan7@gmail.com',
                'user_phone' => '081364770433',
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$Kdd8egFVGizodkb.EMKjeO/RLK4VbpUQbm/QaHgGcSmvN3I8AUUna',
                'description' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-11-09 11:44:51',
                'updated_at' => '2018-11-09 11:44:51',
                'deleted_at' => NULL,
                'created_by' => 32,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            36 => 
            array (
                'id' => 39,
                'user_login' => 'proyekdummygm',
                'user_name' => 'proyekdummygm',
                'is_rekanan' => 0,
                'email' => 'josep.tambunan7@gmail.com',
                'user_phone' => '081364770433',
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$VoOKPOIWqVg3//E3DI5TE.A5YoK8ueVVYRUQKzTPDgfs/NFEdJo9G',
                'description' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-11-09 15:52:42',
                'updated_at' => '2018-11-09 15:52:42',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            37 => 
            array (
                'id' => 40,
                'user_login' => 'proyekdummydept',
                'user_name' => 'proyekdummydept',
                'is_rekanan' => 0,
                'email' => 'josep.tambunan7@gmail.com',
                'user_phone' => '081364770433',
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$LgLOGamHTOBl0sCoKfnW/uMss2fFHxr9yPWrhkAqc0PYwJa7bZO2y',
                'description' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-11-09 15:53:51',
                'updated_at' => '2018-11-09 15:53:51',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
            38 => 
            array (
                'id' => 41,
                'user_login' => 'proyekdummydiv',
                'user_name' => 'proyekdummydiv',
                'is_rekanan' => 0,
                'email' => 'josep.tambunan7@gmail.com',
                'user_phone' => '081364770433',
                'digitalsignature' => NULL,
                'photo' => NULL,
                'password' => '$2y$10$7.ze8K.9Iv6M3HFOggKA1uNT9KsFpaLK3a7MeANkAPGdVVDHwChHi',
                'description' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-11-09 15:56:29',
                'updated_at' => '2018-11-09 15:56:29',
                'deleted_at' => NULL,
                'created_by' => 1,
                'updated_by' => NULL,
                'deleted_by' => NULL,
                'inactive_at' => NULL,
                'inactive_by' => NULL,
                'user_id' => NULL,
            ),
        ));
        
        
    }
}