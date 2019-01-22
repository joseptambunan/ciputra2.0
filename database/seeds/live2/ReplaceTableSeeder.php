<?php

use Illuminate\Database\Seeder;
use Modules\Budget\Entities\BudgetCarryOver;
use Modules\Spk\Entities\Spk;
use Modules\Budget\Entities\BudgetTahunan;
use Modules\Project\Entities\ProjectKawasan;
use Modules\Budget\Entities\BudgetCarryOverCashflow;

class ReplaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projectkawasan = ProjectKawasan::find(81);
        foreach ($projectkawasan->project->spks as $key => $value) {
            if ( $value->itempekerjaan->group_cost == 1 ){
                foreach ($value->details as $key2 => $value2) {
                    if ( $value2->asset_id == $projectkawasan->id ){
                        $carry_over = new BudgetCarryOver;
                        $carry_over->spk_id = $value->id;
                        $carry_over->budget_tahunan_id = 524;
                        $carry_over->save();

                        $carry_over_cash_flow = new BudgetCarryOverCashflow;
                        $carry_over_cash_flow->budget_carry_over_id = $carry_over->id;
                        $carry_over_cash_flow->januari = 20;
                        $carry_over_cash_flow->maret = 20;
                        $carry_over_cash_flow->mei = 20;
                        $carry_over_cash_flow->juli = 20;
                        $carry_over_cash_flow->september = 20;
                        $carry_over_cash_flow->save();
                    }
                }
            }elseif ( $value->itempekerjaan->group_cost == 2 ){
                if ( $value->project_kawasan_id == $projectkawasan->id ){
                    if ( $value2->asset_id == $projectkawasan->id ){
                        $carry_over = new BudgetCarryOver;
                        $carry_over->spk_id = $value->id;
                        $carry_over->budget_tahunan_id = 524;
                        $carry_over->save();

                        $carry_over_cash_flow = new BudgetCarryOverCashflow;
                        $carry_over_cash_flow->budget_carry_over_id = $carry_over->id;
                        $carry_over_cash_flow->januari = 20;
                        $carry_over_cash_flow->maret = 20;
                        $carry_over_cash_flow->mei = 20;
                        $carry_over_cash_flow->juli = 20;
                        $carry_over_cash_flow->september = 20;
                        $carry_over_cash_flow->save();
                    }
                }
            }
        }
    }
}
