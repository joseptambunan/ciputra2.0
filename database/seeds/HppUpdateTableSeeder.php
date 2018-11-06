<?php

use Illuminate\Database\Seeder;

class HppUpdateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arrayProject = array(66);
        foreach ($arrayProject as $key => $value) {
            $project = \Modules\Project\Entities\Project::find($value);
            $hpp_update = $project->hpp_update;
            if ( count($hpp_update) > 0 ){
                $luas_book = $hpp_update->last()->luas_book;
                $luas_erem = $hpp_update->last()->luas_erem;
            }else{
                $luas_book = 0;
                $luas_erem = 0;
            }

            $hpp_update = $project->hpp_update;
            if ( count($hpp_update) > 0 ){
                $luas_book_before = $hpp_update->last()->luas_book;
                $hpp_before = $hpp_update->last()->hpp_book;
            }else{
                $luas_book_before = 0;
                $hpp_before = 0;
            }
            

            $hpp_update = new Modules\Budget\Entities\HppUpdate;
            $hpp_update->project_id = $project->id;
            $hpp_update->nilai_budget = $project->total_budget;
            $hpp_update->luas_book = $luas_book;
            $hpp_update->luas_erem = $luas_erem;
            $hpp_update->created_at = date("Y-m-d H:i:s");
            $hpp_update->created_by = 1;
            $hpp_update->netto = $project->netto;
            $hpp_update->hpp_book = $hpp_before;
            $hpp_update->luas_book_before = $luas_book_before;
            $hpp_update->save();

            foreach ($project->budgets as $key => $value) {
                $hpp_update_detail = new Modules\Budget\Entities\HppUpdateDetail;
                $hpp_update_detail->hpp_update_id = $hpp_update->id;
                $hpp_update_detail->budget_id = $value->id;
                $hpp_update_detail->created_at = date("Y-m-d H:i:s");
                $hpp_update_detail->created_by = 1;
                $hpp_update_detail->save();
            }

            $cek_summary = \Modules\Project\Entities\HppDevCostSummaryReport::where("project_id",$project->id)->get();
            
            if ( count($cek_summary) > 0 ){
              foreach ($project->summary_kontrak as $key => $value) {
                $hpp_dev_cost_summart_report = Modules\Project\Entities\HppDevCostSummaryReport::find($value->id);
                if ( $hpp_dev_cost_summart_report->project_kawasan_id == null ){
                    $hpp_dev_cost_summart_report->project_id = $project->id;
                    $hpp_dev_cost_summart_report->efisiensi = 1;
                    $hpp_dev_cost_summart_report->luas_bruto = $value->lahan_luas;
                    $hpp_dev_cost_summart_report->luas_netto = $value->netto_kawasan;
                    $hpp_dev_cost_summart_report->total_kontrak = $project->total_nilai_kontrak;
                    $hpp_dev_cost_summart_report->total_kontrak_terbayar = $project->nilai_total_bap;
                    $hpp_dev_cost_summart_report->save();
                }else {
                    $hpp_dev_cost_summart_report->project_id = $project->id;
                    $hpp_dev_cost_summart_report->efisiensi = 1;
                    $hpp_dev_cost_summart_report->luas_bruto = $value->lahan_luas;
                    $hpp_dev_cost_summart_report->luas_netto = $value->netto_kawasan;
                    $hpp_dev_cost_summart_report->total_kontrak = 0;
                    $hpp_dev_cost_summart_report->total_kontrak_terbayar = 0;
                    $hpp_dev_cost_summart_report->save();
                }
               
              }
            }else{
              foreach ($project->kawasans as $key => $value) {
                 $hpp_dev_cost_summart_report = new Modules\Project\Entities\HppDevCostSummaryReport;
                 $hpp_dev_cost_summart_report->project_id = $project->id;
                 $hpp_dev_cost_summart_report->project_kawasan_id = $value->id;
                 $hpp_dev_cost_summart_report->efisiensi = 1;
                 $hpp_dev_cost_summart_report->luas_bruto = $value->lahan_luas;
                 $hpp_dev_cost_summart_report->luas_netto = $value->netto_kawasan;
                 $hpp_dev_cost_summart_report->total_kontrak = 0;
                 $hpp_dev_cost_summart_report->total_kontrak_terbayar = 0;
                 $hpp_dev_cost_summart_report->save(); 
              }
            }
            

           $hpp_dev_cost_summart_report = new Modules\Project\Entities\HppDevCostSummaryReport;
           $hpp_dev_cost_summart_report->project_id = $project->id;
           $hpp_dev_cost_summart_report->project_kawasan_id = null;
           $hpp_dev_cost_summart_report->efisiensi = 1;
           $hpp_dev_cost_summart_report->luas_bruto = $value->lahan_luas;
           $hpp_dev_cost_summart_report->luas_netto = 0;
           $hpp_dev_cost_summart_report->total_kontrak = $project->total_nilai_kontrak;
           $hpp_dev_cost_summart_report->total_kontrak_terbayar = $project->nilai_total_bap;
           $hpp_dev_cost_summart_report->save(); 

        }
        
    }
}
