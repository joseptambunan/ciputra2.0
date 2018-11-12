<?php

use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $file = fopen("./public/migrasi/city.csv","r");

	    while(! feof($file)){
	    	$csv_line = fgetcsv($file);
	    	if ( $csv_line != "" ) {
	    		$province_id = \Modules\Country\Entities\Province::where("province_id",$csv_line[3])->first();
		  		$city = new Modules\Country\Entities\City;
		  		$city->name = $csv_line[1];
		  		$city->description = "Migration from Erem based export at 18 Oct 2018";
		  		$city->created_by = 1;
		  		$city->created_at = date("Y-m-d H:i:s.u");
		  		$city->province_id = $province_id->id;
		  		$city->city_id = $csv_line[0];
		  		$city->save();

	  		}	  			

	  	}

        fclose($file);
    }
}
