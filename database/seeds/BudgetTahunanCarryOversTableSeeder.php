<?php

use Illuminate\Database\Seeder;
use Modules\Project\Entities\Project;
use Modules\Budget\Entities\BudgetCarryOver;
use Modules\Budget\Entities\BudgetCarryOverDetail;
use Modules\Budget\Entities\BudgetCarryOverCashflow;

class BudgetTahunanCarryOversTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$start = 0;
        $project_id = 66;
        $project = Project::find($project_id);
        foreach ($project->spks as $key => $value) {
        	if ( $value->date->format("Y") < 2018 ){
        		if ( $value->baps->sum("nilai_bap_2") < $value->nilai ){
        			$sisa = $value->nilai - $value->baps->sum("nilai_bap_2");

        			$budgetDetail = new BudgetCarryOver;
	                $budgetDetail->budget_tahunan_id = 5;
	                $budgetDetail->spk_id = $value->id;
	                $budgetDetail->save();

	                $oktober = (($sisa / 3 ) / $sisa ) * 100 ;
	                $november = (($sisa / 3) / $sisa ) * 100 ;
	                $desember =  (($sisa / 3) / $sisa ) * 100 ;

	                $carry_over_cashflow = new BudgetCarryOverCashflow;
			        $carry_over_cashflow->budget_carry_over_id = $budgetDetail->id;
			        $carry_over_cashflow->created_by = 9999;
			        $carry_over_cashflow->januari = 0;
			        $carry_over_cashflow->februari = 0;
			        $carry_over_cashflow->maret = 0;
			        $carry_over_cashflow->april = 0;
			        $carry_over_cashflow->mei = 0;
			        $carry_over_cashflow->juni = 0;
			        $carry_over_cashflow->juli = 0;
			        $carry_over_cashflow->agustus = 0;
			        $carry_over_cashflow->september = 0;
			        $carry_over_cashflow->oktober = $oktober;
			        $carry_over_cashflow->november = $november;
			        $carry_over_cashflow->desember = $desember;
			        $carry_over_cashflow->save();
        		}
        	}
        }
        echo $start;
    }
}
