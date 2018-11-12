<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
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
	    		if ( $csv_line[6] != NULL ){
	    			$city_id = Modules\Country\Entities\City::where("name",$csv_line[6])->get();
	    			if ( count($city_id) > 0 ){
	    				$city = $city_id->first()->id;
	    			}else{
	    				$city = NULL;
	    			}
	    		}else{
	    			$city = NULL;
	    		}

  				$newproject = new Modules\Project\Entities\Project;
				$newproject->subholding = 2;
				$newproject->city_id = $city;
				$newproject->code = $csv_line[4];
				$newproject->name = $csv_line[5];
				$newproject->luas = 0;
				$newproject->address = $csv_line[6];
				$newproject->zipcode = $csv_line[7];
				$newproject->phone = $csv_line[9];
				$newproject->fax = $csv_line[6];
				$newproject->email = $csv_line[7];
				$newproject->description = "Migration from Erem based export at 18 Oct 2018";
				$newproject->created_at = date("Y-m-d H:i:s.u");
				$newproject->created_by = 1;
				$newproject->project_id = $csv_line[0];
				$newproject->save();
	  					  		
	  		}	  			
	  	}

        fclose($file);
    }
}
