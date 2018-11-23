<?php

use Illuminate\Database\Seeder;
use Modules\Budget\Entities\Budget;
use Modules\Budget\Entities\BudgetTahunan;

class BudgetTahunansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = fopen("./public/migrasi/bizpark/budget_tahunan.csv","r");
        /*$budget = Budget::find(13);
        $budget_tahunan                 = new BudgetTahunan;
        $budget_tahunan->budget_id      = 13;
        $budget_tahunan->no             = \App\Helpers\Document::new_number('BDG-T', $budget->department->id,$budget->project->id).$budget->pt->code;
        $budget_tahunan->tahun_anggaran = 2018;
        $budget_tahunan->description    =  "Migration from Project based export at 18 Oct 2018";
        $budget_tahunan->save();*/

        while(! feof($file)){
	    	$csv_line = fgetcsv($file);
	    	if ( $csv_line != "" ) {
	    		$itempekerjaan = Modules\Pekerjaan\Entities\Itempekerjaan::where("code",trim($csv_line[0]))->get();
	    		if ( count($itempekerjaan) > 0 ){
	    			$parent = $itempekerjaan->first()->parent->id;
	    			$budget_detail = new Modules\Budget\Entities\BudgetTahunanDetail;
			  		$budget_detail->budget_tahunan_id = 5;
			  		$budget_detail->itempekerjaan_id = $parent;
			  		$budget_detail->nilai = $csv_line[1];
			  		$budget_detail->volume = 1;
			  		$budget_detail->satuan = 'ls';
			  		$budget_detail->description = "Migration from Project based export at 18 Oct 2018";
			  		$budget_detail->created_by = 1;
			  		$budget_detail->created_at = date("Y-m-d H:i:s.u");
			  		$budget_detail->save();
	    		}
	    	}
	    }

	    
    }
}
