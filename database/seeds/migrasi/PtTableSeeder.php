<?php

use Illuminate\Database\Seeder;

class PtTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $file = fopen("./public/migrasi/project.csv","r");

	    while(! feof($file)){
	    	$csv_line = fgetcsv($file);
	    	if ( $csv_line != "" ) {
	    		if ( $csv_line[14] != NULL ){
	    			$city_id = Modules\Country\Entities\City::where("city_id",$csv_line[14])->get();
	    			if ( count($city_id) > 0 ){
	    				$city = $city_id->first()->id;
	    			}else{
	    				$city = NULL;
	    			}
	    		}else{
	    			$city = NULL;
	    		}

  				$newpt = new Modules\Pt\Entities\Pt;
				$newpt->city_id = $city;
				$newpt->code =  $csv_line[4];
				$newpt->name = $csv_line[5];
				$newpt->address = $csv_line[12];
				$newpt->npwp = $csv_line[13];
				$newpt->phone = $csv_line[15];
				$newpt->rekening = $csv_line[15];
				$newpt->description = "Migration from Erem based export at 18 Oct 2018";
				$newpt->created_at = date("Y-m-d H:i:s.u");
				$newpt->pt_id = $csv_line[0];
				$newpt->save();
	  					  		
	  		}	  			
	  	}

        fclose($file);
    }
}
