<?php

use Illuminate\Database\Seeder;

class ProjectPtTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $file = fopen("./public/migrasi/project_pt.csv","r");

        while(! feof($file)){
	    	$csv_line = fgetcsv($file);
	    	if ( $csv_line != "" ) {
	    		
	    		if ( $csv_line[1] != NULL ){
	    			$project = Modules\Project\Entities\Project::where("project_id",$csv_line[1])->get();
	    			if ( count($project) > 0 ){
	    				$project_id = $project->first()->id;
	    			}else{
	    				$project_id = NULL;
	    			}
	    		}else{
	    			$project_id = NULL;
	    		}

	    		if ( $csv_line[2] != NULL ){
	    			$pt = Modules\Pt\Entities\Pt::where("pt_id",$csv_line[2])->get();
	    			if ( count($pt) > 0 ){
	    				$pt_id = $pt->first()->id;
	    			}else{
	    				$pt_id = NULL;
	    			}
	    		}else{
	    			$pt_id = NULL;
	    		}


  				$newprojectpt = new Modules\Project\Entities\ProjectPt;
				$newprojectpt->pt_id = $pt_id;
				$newprojectpt->project_id = $project_id;
				$newprojectpt->description = "Migration from Erem based export at 18 Oct 2018";
				$newprojectpt->created_at = date("Y-m-d H:i:s.u");
				$newprojectpt->created_by = 1;
				$newprojectpt->projectpt_id = $csv_line[0];
				$newprojectpt->save();
	  					  		
	  		}	  			
	  	}

        fclose($file);
    }
}
