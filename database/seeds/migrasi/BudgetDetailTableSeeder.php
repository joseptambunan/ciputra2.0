<?php

use Illuminate\Database\Seeder;

class BudgetDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = fopen("./public/migrasi/budget_detail.csv","r");
        $start = 0;
	    while(! feof($file)){
	    	$csv_line = fgetcsv($file);
	    	if ( $csv_line != "" ) {
	    		if ( $csv_line[2] != "" && $csv_line[3] != "" && $csv_line[4] != "" && $csv_line[5] != ""){
	    			$itempekerjaan = Modules\Pekerjaan\Entities\Itempekerjaan::where("code",trim($csv_line[2]))->get();
	    			if ( $itempekerjaan->count() > 0 ){
	    				$parent = $itempekerjaan->first()->parent->id;
	    				$budget_detail = new Modules\Budget\Entities\BudgetDetail;
				  		$budget_detail->budget_id = $csv_line[0];
				  		$budget_detail->itempekerjaan_id = $parent;
				  		$budget_detail->nilai = $csv_line[5];
				  		$budget_detail->volume = $csv_line[3];
				  		$budget_detail->satuan = $csv_line[4];
				  		$budget_detail->description = "Migration from Project based export at 18 Oct 2018";
				  		$budget_detail->created_by = 1;
				  		$budget_detail->created_at = date("Y-m-d H:i:s.u");
				  		$budget_detail->save();
	    			}else{
	    				$budget_detail = new Modules\Budget\Entities\BudgetDetail;
				  		$budget_detail->budget_id = $csv_line[0];
				  		$budget_detail->itempekerjaan_id = 900;
				  		$budget_detail->nilai = $csv_line[5];
				  		$budget_detail->volume = $csv_line[3];
				  		$budget_detail->satuan = $csv_line[4];
				  		$budget_detail->description = "Migration from Project based export at 18 Oct 2018";
				  		$budget_detail->created_by = 1;
				  		$budget_detail->created_at = date("Y-m-d H:i:s.u");
				  		$budget_detail->save();
	    			}
	    		}
	  		}	  			

	  	}

        fclose($file);
    }
}
