<?php

use Illuminate\Database\Seeder;

class BudgetTahunanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $file = fopen("./public/migrasi/spk.csv","r");
        while(! feof($file)){
	    	$csv_line = fgetcsv($file);
	    	if ( $csv_line != "" ) {
	    		if ( $csv_line[14] < 100 ){
	    			$coa_ = \Modules\Pekerjaan\Entities\Itempekerjaan::where("code",$csv_line[2]);
	    			if ( count($coa_) > 0 ){
	    				

	    			}
	    		}
	    	}
	    }
    }
}
