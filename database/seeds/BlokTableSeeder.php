<?php

use Illuminate\Database\Seeder;

class BlokTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = fopen("./public/migrasi/blok.csv","r");

	    while(! feof($file)){
	    	$csv_line = fgetcsv($file);
	    	if ( $csv_line != "" ) {
	    		if ( $csv_line[1] != NULL ){
	    			$cluster = Modules\Project\Entities\ProjectKawasan::where("cluster_id",$csv_line[1])->get();
	    			if ( count($cluster) > 0 ){
	    				$cluster_id = $cluster->first()->id;
	    			}else{
	    				$cluster_id = NULL;
	    			}
	    		}else{
	    			$cluster_id = NULL;
	    		}

  				$newblok = new Modules\Project\Entities\Blok;
  				$newblok->project_id = $csv_line[0];
				$newblok->project_kawasan_id = $cluster_id;
				$newblok->name = $csv_line[2];
				$newblok->luas = 0;
				$newblok->kode = $csv_line[3];
				$newblok->description = "Migration from Erem based export at 18 Oct 2018";
				$newblok->created_at = date("Y-m-d H:i:s");
				$newblok->block_id = $csv_line[4];
				$newblok->save();
	  					  		
	  		}	  			
	  	}

        fclose($file);
    }
}
