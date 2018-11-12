<?php

use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $file = fopen("./public/migrasi/type.csv","r");

	    while(! feof($file)){
	    	$csv_line = fgetcsv($file);
	    	if ( $csv_line != "" ) {
	    		
  				$newtype = new Modules\Project\Entities\UnitType;
				$newtype->project_id = $csv_line[0];
				$newtype->name =  $csv_line[1];
				$newtype->luas_bangunan = $csv_line[2];
				$newtype->luas_tanah = $csv_line[3];
				$newtype->listrik = $csv_line[4];
				$newtype->kode = "";
				$newtype->building_class = $csv_line[7];
				$newtype->description = "Migration from Erem based export at 18 Oct 2018";
				$newtype->created_at = date("Y-m-d H:i:s.u");
				$newtype->type_id = $csv_line[6];
				$newtype->save();
	  					  		
	  		}	  			
	  	}

        fclose($file);
    }
}
