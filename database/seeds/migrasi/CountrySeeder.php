<?php

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = fopen("./public/migrasi/negara.csv","r");

	    while(! feof($file)){
	    	$csv_line = fgetcsv($file);
	    	if ( $csv_line != "" ) {
		  		$country = new Modules\Country\Entities\Country;
		  		$country->name = $csv_line[4];
		  		$country->description = "Migration from Erem based export at 18 Oct 2018";
		  		$country->created_by = 1;
		  		$country->created_at = date("Y-m-d H:i:s.u");
		  		$country->country_id = $csv_line[0];
		  		$country->save();

	  		}	  			

	  	}

        fclose($file);
    }
}
