<?php

use Illuminate\Database\Seeder;

class ProjectKawasanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $file = fopen("./public/migrasi/kawasan.csv","r");

	    while(! feof($file)){
	    	$csv_line = fgetcsv($file);
	    	if ( $csv_line != "" ) {
	    		
	    		if ( $csv_line[4] == "" ){
	    			$cluster_id = null;
	    		}else{
	    			$cluster_id = $csv_line[4];
	    		}

  				$newproject_kawasan = new Modules\Project\Entities\ProjectKawasan;
				$newproject_kawasan->project_id = $csv_line[0];
				$newproject_kawasan->code = $csv_line[6];
				$newproject_kawasan->name = $csv_line[1];
				$newproject_kawasan->lahan_status = 1;
				$newproject_kawasan->lahan_luas = $csv_line[2];
				$newproject_kawasan->lahan_sellable = $csv_line[3];
				$newproject_kawasan->is_kawasan = $csv_line[5];
				$newproject_kawasan->description = "Migration from Erem based export at 26 Oct 2018";
				$newproject_kawasan->created_at = date("Y-m-d H:i:s.u");
				$newproject_kawasan->created_by = 1;
				$newproject_kawasan->cluster_id = $cluster_id;
				$newproject_kawasan->save();
	  					  		
	  		}	  			
	  	}
    }
}
