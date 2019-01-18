<?php

use Illuminate\Database\Seeder;

class EscrowsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('escrows')->delete();
        
        
        
    }
}