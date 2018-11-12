<?php

use Illuminate\Database\Seeder;

class ApprovalsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('approvals')->delete();
        
        
        
    }
}