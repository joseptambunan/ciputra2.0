<?php

use Illuminate\Database\Seeder;

class BudgetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = fopen("./public/migrasi/budget.csv","r");
        $start = 0;
	    while(! feof($file)){
	    	$csv_line = fgetcsv($file);
	    	if ( $csv_line != "" ) {
	    		if ( $csv_line[1] != "" ){
	    			$kawasan = Modules\Project\Entities\ProjectKawasan::where("name",$csv_line[1])->where("project_id",$csv_line[0]);
	    			if ( $kawasan->count() > 0 ){
	    				$kawasan_id = $kawasan->first()->id;
	    			}else{
	    				$kawasan_id = null;
	    			}
	    		}else{
	    			$kawasan_id = null;
	    		}

	    		$pt = Modules\Pt\Entities\Pt::find($csv_line[2]);
	    		$no = $number = \App\Helpers\Document::new_number('BDG', 2,60).$pt->code;;

		  		$budget = new Modules\Budget\Entities\Budget;
		  		$budget->pt_id = $csv_line[2];
		  		$budget->department_id = 2;
		  		$budget->project_id = $csv_line[0];
		  		$budget->parent_id = null;
		  		$budget->project_kawasan_id = $kawasan_id;
		  		$budget->no = $no;
		  		$budget->start_date = "2018-01-01 00:00:00";
		  		$budget->end_date = "2018-12-31 23:59:59";

		  		$budget->description = "Migration from Project based export at 18 Oct 2018";
		  		$budget->created_by = 1;
		  		$budget->created_at = date("Y-m-d H:i:s");
		  		$budget->save();

		  		$approval = new Modules\Approval\Entities\Approval;
		  		$approval->approval_action_id = 6;
		  		$approval->document_id = $budget->id;
		  		$approval->document_type = "Modules\Budget\Entities\Budget";
		  		$approval->total_nilai = 0;
		  		$approval->created_at = "2018-10-20 00:00:00";
		  		$approval->created_by = 1;
		  		$approval->save();

		  		$budget_id[$start] = $budget->id;
		  		$start++;
	  		}	  			

	  	}

        fclose($file);
        print_r($budget_id);
    }
}
