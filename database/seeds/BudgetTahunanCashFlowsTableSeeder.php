<?php

use Illuminate\Database\Seeder;
use Modules\Spk\Entities\Spk;
use Modules\Budget\Entities\BudgetTahunanPeriode;
use Modules\Pekerjaan\Entities\Itempekerjaan;

class BudgetTahunanCarryOversTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = fopen("./public/migrasi/bizpark/budget_cash_flow.csv","r");
        while(! feof($file)){
	    	$csv_line = fgetcsv($file);
	    	if ( $csv_line != "" ) {
	    		$spk = Spk::where("no",$csv_line[1])->get();
	    		if ( count($spk) > 0 ){
	    			if ( $spk->first()->baps != "" ){
	    				if ( $spk->first()->baps->sum("nilai_bap_2") >= $spk->first()->nilai ){
	    					$oktober = ( $spk->first()->baps->sum("nilai_bap_2")  /  $spk->first()->nilai ) * 100;
	    					$november = 0;
	    					$desember = 0;
	    				}else{
	    					$oktober = ( $spk->first()->baps->sum("nilai_bap_2")  /  $spk->first()->nilai ) * 100;
	    					$november = (( $spk->first()->baps->sum("nilai_bap_2")  /  $spk->first()->nilai ) * 100) / 2 ;
	    					$desember = (( $spk->first()->baps->sum("nilai_bap_2")  /  $spk->first()->nilai ) * 100) / 2 ;
	    				}

	    				foreach ($spk->first()->baps as $key => $value) {	    
	    					$itempekerjaan = Itempekerjaan::where("code",$csv_line[0])->get();
	    					if ( count($itempekerjaan) > 0 ){
	    						$budgetperiode = new BudgetTahunanPeriode;
						        $budgetperiode->budget_id = 5;
						        $budgetperiode->itempekerjaan_id = $itempekerjaan->first()->parent->id;
						        $budgetperiode->januari = 0;
						        $budgetperiode->februari = 0;
						        $budgetperiode->maret = 0;
						        $budgetperiode->april = 0;
						        $budgetperiode->mei = 0;
						        $budgetperiode->juni = 0;
						        $budgetperiode->juli = 0;
						        $budgetperiode->agustus = 0;
						        $budgetperiode->september = 0;
						        $budgetperiode->oktober = $oktober;
						        $budgetperiode->november = $november;
						        $budgetperiode->desember = $desember;
						        $budgetperiode->save();
	    					}    				
	    				}
	    			}	    			
	    		}
	    	}
	    }
    }
}
