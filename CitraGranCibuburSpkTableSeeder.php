<?php

use Illuminate\Database\Seeder;
use Modules\Spk\Entities\Spk;

class CitraGranCibuburSpkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
    {
        //
        /*\Modules\Spk\Entities\Spk::truncate();
        \Modules\Spk\Entities\SpkDetail::truncate();
        \Modules\Project\Entities\UnitProgress::truncate();
        \Modules\workorder\Entities\Workorder::truncate();
        \Modules\workorder\Entities\WorkorderDetail::truncate();
        \Modules\workorder\Entities\WorkorderBudgetDetail::truncate();
        \Modules\Rab\Entities\Rab::truncate();
        \Modules\Rab\Entities\RabUnit::truncate();
        \Modules\Rab\Entities\RabPekerjaan::truncate();
        \Modules\Tender\Entities\Tender::truncate();
        \Modules\Tender\Entities\TenderUnit::truncate();
        \Modules\Tender\Entities\TenderRekanan::truncate();
        \Modules\Tender\Entities\TenderPenawaran::truncate();
        \Modules\Tender\Entities\TenderPenawaranDetail::truncate();
        \Modules\Tender\Entities\TenderMenang::truncate();
        \Modules\Tender\Entities\TenderMenangDetail::truncate();
        \Modules\Tender\Entities\TenderDocument::truncate();
        \Modules\Tender\Entities\TenderDocumentApproval::truncate();
        \Modules\Spk\Entities\Spk::truncate();
        \Modules\Spk\Entities\SpkDetail::truncate();
        \Modules\Spk\Entities\SpkRetensi::truncate();
        \Modules\Spk\Entities\SpkTermyn::truncate();
        \Modules\Spk\Entities\SpkVoUnit::truncate();*/

        $file = fopen("./public/migrasi/spk.csv","r");
        $start = 0;
	    while(! feof($file)){
	    	$csv_line = fgetcsv($file);
	    	if ( $csv_line != "" ) {
                $check_spk = Spk::where("no",$csv_line[1])->get();
                if ( count($check_spk) >= 0 ){
                    $pt = \Modules\Pt\Entities\Pt::find(17);
                    $no_wo = \App\Helpers\Document::new_number('WO', 2,$csv_line[0]).$pt->code;
                    $unit = $csv_line[21];

                    //$no_spk = \App\Helpers\Document::new_number('SPK', 2,60).$pt->code;
                    echo $csv_line[3];
                    $itempekerjaan = \Modules\Pekerjaan\Entities\Itempekerjaan::where("code",$csv_line[3]);
                    if ( $itempekerjaan->count() > 0 ){
                        $itempekerjaan_id  = $itempekerjaan->first()->parent->id;
                        $child = \Modules\Pekerjaan\Entities\Itempekerjaan::find($itempekerjaan_id)->child_item->first();
                        $group_cost = $itempekerjaan->first()->group_cost;
                    }else{
                        $itempekerjaan_id = null ;
                        $group_cost = NULL;
                        $child = NULL;
                    }

                    $yof = explode("-", $csv_line[4]);
    /*
                    $datetime1 = date_create($csv_line[16]);
                    $datetime2 = date_create($csv_line[17]);
                    $interval = date_diff($datetime1, $datetime2);*/
                    $day = "+1";

                    //save to workorder
                    $workorder = new \Modules\Workorder\Entities\Workorder;
                    $workorder->no = $no_wo;
                    $workorder->budget_tahunan_id = $csv_line[0];
                    $workorder->department_from = 2;
                    $workorder->department_to = 2;
                    $workorder->name = $csv_line[5];
                    $workorder->durasi = str_replace("+", "", $day);
                    $workorder->estimasi_nilaiwo = $csv_line[8];
                    $workorder->description = "Migration from Project based export at 18 Oct 2018";
                    $workorder->created_at = date("Y-m-d H:i:s");
                    $workorder->created_by = 1;
                    $workorder->save();

                    $approval_workorder = new \Modules\Approval\Entities\Approval;
                    $approval_workorder->approval_action_id = 6;
                    $approval_workorder->document_id = $workorder->id;
                    $approval_workorder->document_type = "Modules\Workorder\Entities\Workorder";
                    $approval_workorder->total_nilai = $csv_line[8];
                    $approval_workorder->created_at = date("Y-m-d H:i:s");
                    $approval_workorder->created_by = 1;
                    $approval_workorder->save();

                    $workorder_detail = new \Modules\Workorder\Entities\WorkorderDetail;
                    $workorder_detail->workorder_id = $workorder->id;
                    $workorder_detail->asset_id = $unit;
                    $workorder_detail->asset_type = "Modules\Project\Entities\Project";
                    $workorder_detail->description = "Migration from Project based export at 18 Oct 2018";
                    $workorder_detail->created_at = date("Y-m-d H:i:s");
                    $workorder_detail->created_by = 1;
                    $workorder_detail->save();

                    $workorder_budget_detail = new \Modules\Workorder\Entities\WorkorderBudgetDetail;
                    $workorder_budget_detail->workorder_id = $workorder->id;
                    $workorder_budget_detail->itempekerjaan_id = $itempekerjaan_id;
                    $workorder_budget_detail->volume = "1";
                    $workorder_budget_detail->satuan = "ls";
                    $workorder_budget_detail->nilai = $csv_line[8];
                    $workorder_budget_detail->tahun_anggaran = $yof[0];
                    $workorder_budget_detail->created_at = date("Y-m-d H:i:s");
                    $workorder_budget_detail->created_by = 1;
                    $workorder_budget_detail->save();
                    /*==================================================================================================*/

                    //Save to RAB
                    $no_rab = \App\Helpers\Document::new_number('RAB', 2,$csv_line[0]).$pt->code;
                    $rab = new Modules\Rab\Entities\Rab;
                    $rab->no = $no_rab;
                    $rab->workorder_id = $workorder->id;
                    $rab->name = $csv_line[5];
                    $rab->created_by = 1;
                    $rab->created_at = date("Y-m-d H:i:s");
                    $rab->description = "Migration from Project based export at 18 Oct 2018";
                    $rab->budget_tahunan_id = 66;
                    $rab->save();

                    $approval_rab = new \Modules\Approval\Entities\Approval;
                    $approval_rab->approval_action_id = 6;
                    $approval_rab->document_id = $rab->id;
                    $approval_rab->document_type = "Modules\Rab\Entities\Rab";
                    $approval_rab->total_nilai = $csv_line[8];
                    $approval_rab->created_at = date("Y-m-d H:i:s");
                    $approval_rab->created_by = 1;
                    $approval_rab->save();

                    $rab_unit = new Modules\Rab\Entities\RabUnit;
                    $rab_unit->rab_id = $rab->id;
                    $rab_unit->asset_id = $unit;
                    $rab_unit->asset_type = "Modules\Project\Entities\Project";
                    $rab_unit->created_by = 1;
                    $rab_unit->created_at = date("Y-m-d H:i:s");
                    $rab_unit->description = "Migration from Project based export at 18 Oct 2018";
                    $rab_unit->save();

                    $rab_pekerjaan = new Modules\Rab\Entities\RabPekerjaan;
                    $rab_pekerjaan->rab_unit_id = $rab_unit->id;
                    $rab_pekerjaan->itempekerjaan_id = $child->id;
                    $rab_pekerjaan->nilai = $csv_line[8];
                    $rab_pekerjaan->volume = "1";
                    $rab_pekerjaan->satuan = "ls";
                    $rab_pekerjaan->created_by = 1;
                    $rab_pekerjaan->created_at = date("Y-m-d H:i:s");
                    $rab_pekerjaan->description = "Migration from Project based export at 18 Oct 2018";
                    $rab_pekerjaan->save();
                    /*==================================================================================================*/

                    //Save to Tender
                    $no_tender = \App\Helpers\Document::new_number('TENDER', 2,$csv_line[0]).$pt->code;
                    $tender = new Modules\Tender\Entities\Tender;
                    $tender->rab_id = $rab->id;
                    $tender->no = $no_tender;
                    $tender->name = $csv_line[5];
                    $tender->created_by = 1;
                    $tender->created_at = date("Y-m-d H:i:s");
                    $tender->description = "Migration from Project based export at 18 Oct 2018";
                    $tender->sifat_tender = "FIXED PRICE & LUMPSUM";
                    $tender->durasi = str_replace("+", "", $day);
                    $tender->save();

                    $arrDocument = array("Gambar Tender", "BQ / Bill Item", "Spesifikasi Teknis", "Syarat=Syarat Khusus yang harus dilengkapi");
                    for ( $i=0; $i < count($arrDocument); $i++ ){
                        $tender_dokumen = new Modules\Tender\Entities\TenderDocument;
                        $tender_dokumen->tender_id = $tender->id;
                        $tender_dokumen->document_name = $arrDocument[$i];
                        $tender_dokumen->created_by = 1;
                        $tender_dokumen->save(); 

                        $tender_dokumen_approval = new Modules\Tender\Entities\TenderDocumentApproval;
                        $tender_dokumen_approval->tender_document_id = $tender_dokumen->id;
                        $tender_dokumen_approval->user_id = 1;
                        $tender_dokumen_approval->status = "6";
                        $tender_dokumen_approval->created_by = 1;
                        $tender_dokumen_approval->level = 10;
                        $tender_dokumen_approval->save(); 
                    }

                    $approval_tender = new \Modules\Approval\Entities\Approval;
                    $approval_tender->approval_action_id = 6;
                    $approval_tender->document_id = $tender->id;
                    $approval_tender->document_type = "Modules\Tender\Entities\Tender";
                    $approval_tender->total_nilai = $csv_line[8];
                    $approval_tender->created_at = date("Y-m-d H:i:s");
                    $approval_tender->created_by = 1;
                    $approval_tender->save();

                    $rekanan = \Modules\Rekanan\Entities\RekananGroup::where("code",$csv_line[15]);
                    if ( $rekanan->count() > 0 ){
                        $rekanan_id = $rekanan->first()->rekanans->first()->id;
                    }else{
                        $rekanan_group = new Modules\Rekanan\Entities\RekananGroup;
                        $rekanan_group->name = $csv_line[15];
                        $rekanan_group->code = $csv_line[15];
                        $rekanan_group->description = "Migration from Project based export at 18 Oct 2018";
                        $rekanan_group->created_by = 1;
                        $rekanan_group->created_at = date("Y-m-d H:i:s");
                        $rekanan_group->coa_ppn = 10;
                        $rekanan_group->save();

                        $rekanans = new Modules\Rekanan\Entities\Rekanan;
                        $rekanans->rekanan_group_id = $rekanan_group->id;
                        $rekanans->name = $csv_line[15];
                        $rekanans->ppn = 10;
                        $rekanans->description = "Migration from Project based export at 18 Oct 2018";
                        $rekanans->created_by = 1;
                        $rekanans->created_at = date("Y-m-d H:i:s");
                        $rekanans->save();
                        $rekanan_id = $rekanans->id;
                    }
                    $tender_rekanan = new Modules\Tender\Entities\TenderRekanan;
                    $tender_rekanan->tender_id = $tender->id;
                    $tender_rekanan->rekanan_id = $rekanan_id;
                    $tender_rekanan->description = "Migration from Project based export at 18 Oct 2018";
                    $tender_rekanan->created_by = 1;
                    $tender_rekanan->created_at = date("Y-m-d H:i:s");
                    $tender_rekanan->save();

                    $approval_tender_rekanan = new \Modules\Approval\Entities\Approval;
                    $approval_tender_rekanan->approval_action_id = 6;
                    $approval_tender_rekanan->document_id = $tender_rekanan->id;
                    $approval_tender_rekanan->document_type = "Modules\Tender\Entities\TenderRekanan";
                    $approval_tender_rekanan->total_nilai = $csv_line[8];
                    $approval_tender_rekanan->created_at = date("Y-m-d H:i:s");
                    $approval_tender_rekanan->created_by = 1;
                    $approval_tender_rekanan->save();

                    

                    foreach ($tender->rab->units as $key => $value) {                    
                        $tender_unit = new Modules\Tender\Entities\TenderUnit;
                        $tender_unit->tender_id = $tender->id;
                        $tender_unit->rab_unit_id = $value->id;
                        $tender_unit->description = "Migration from Project based export at 18 Oct 2018";
                        $tender_unit->created_by = 1;
                        $tender_unit->created_at = date("Y-m-d H:i:s");  
                        $tender_unit->save();
                    }

                    foreach ($tender->rekanans as $key => $value) {
                        for ( $i=0; $i < 3; $i++ ){
                            $no_penawaran = \App\Helpers\Document::new_number('TENDERPW', 2,60).$pt->code;
                            $tender_penawaran = new Modules\Tender\Entities\TenderPenawaran;
                            $tender_penawaran->tender_rekanan_id = $value->id;
                            $tender_penawaran->no = $no_penawaran ;
                            $tender_penawaran->date = date("Y-m-d");
                            $tender_penawaran->created_by = 1;
                            $tender_penawaran->created_at = date("Y-m-d H:i:s");  
                            $tender_penawaran->save();
                            foreach ($tender->rab->pekerjaans as $key => $value) {
                                $tenderpenawarandetail = new Modules\Tender\Entities\TenderPenawaranDetail;
                                $tenderpenawarandetail->tender_penawaran_id = $tender_penawaran->id;
                                $tenderpenawarandetail->rab_pekerjaan_id = $value->id;
                                $tenderpenawarandetail->keterangan = "Migration from Project based export at 18 Oct 2018";
                                $tenderpenawarandetail->nilai = $csv_line[8];
                                $tenderpenawarandetail->volume = "1";
                                $tenderpenawarandetail->satuan = "ls";
                                $tenderpenawarandetail->created_by = 1;
                                $tenderpenawarandetail->created_at = date("Y-m-d H:i:s");  
                                $tenderpenawarandetail->save();
                            }
                        }

                        foreach ($tender->units as $key2 => $value2) {
                            $tender_menang = new Modules\Tender\Entities\TenderMenang;
                            $tender_menang->tender_rekanan_id = $value->id;
                            $tender_menang->tender_unit_id = $value2->id;
                            $tender_menang->asset_type = "Modules\Project\Entities\Project";
                            $tender_menang->asset_id = $value2->asset_id;
                            $tender_menang->description = "Migration from Project based export at 18 Oct 2018";
                            $tender_menang->created_by = 1;
                            $tender_menang->created_at = date("Y-m-d H:i:s");
                            $tender_menang->save();  
                        }    

                        foreach ($tender->rab->pekerjaans as $key => $value) {
                            $tender_menang_detail = new Modules\Tender\Entities\TenderMenangDetail;
                            $tender_menang_detail->tender_menang_id = $tender_menang->id;
                            $tender_menang_detail->itempekerjaan_id = $child->id;
                            $tender_menang_detail->description = "Migration from Project based export at 18 Oct 2018";
                            $tender_menang_detail->nilai = $csv_line[8];
                            $tender_menang_detail->volume = "1";
                            $tender_menang_detail->satuan = "ls";
                            $tender_menang_detail->created_by = 1;
                            $tender_menang_detail->created_at = date("Y-m-d H:i:s");  
                            $tender_menang_detail->save();
                        }  

                        $no_spk = \App\Helpers\Document::new_number('SPK', 2,$csv_line[0]);
                        $spk = new \Modules\Spk\Entities\Spk;
                        $spk->no = $csv_line[1];
                        $spk->name = $csv_line[5];
                        $spk->project_id = $csv_line[0];
                        $spk->dp_nilai = $csv_line[18];
                        $spk->dp_percent = $csv_line[6];
                        $spk->spk_type_id = 1;
                        $spk->date = $csv_line[4];
                        $spk->start_date = $csv_line[16];
                        $spk->finish_date = $csv_line[17];
                        $spk->matauang = "IDR";
                        $spk->nilai_tukar = 1;
                        $spk->rekanan_id = $rekanan_id;
                        $spk->tender_rekanan_id = $value->id;
                        $spk->description = "[ ".$csv_line[1]." ]Migration from Project based export at 18 Oct 2018";
                        $spk->st_1 = date('Y-m-d', strtotime('+'.$csv_line[10].' day', strtotime($csv_line[17])));
                        if ( $csv_line[12] > 0 ){
                            $spk->st_2 = date('Y-m-d', strtotime('+'.$csv_line[12].' day', strtotime($csv_line[17])));;
                        }else{
                            $spk->st_2 = "";
                        }

                        $spk->save();

                        if ( $csv_line[9] > 0 ){
                            $retensi_percent = $csv_line[9] / 100;
                        }else{
                            $retensi_percent = 0 ;
                        }

                        $spk_retensi = new Modules\Spk\Entities\SpkRetensi;
                        $spk_retensi->spk_id = $spk->id;
                        $spk_retensi->percent = $retensi_percent;
                        $spk_retensi->hari = $csv_line[10];
                        $spk_retensi->save();

                        if ( $csv_line[11] > 0 ){
                            $spk_retensi = new Modules\Spk\Entities\SpkRetensi;
                            $spk_retensi->spk_id = $spk->id;
                            $spk_retensi->percent = $csv_line[11] / 100;
                            $spk_retensi->hari = $csv_line[12];
                            $spk_retensi->save();
                        }


                        $approval_spk = new \Modules\Approval\Entities\Approval;
                        $approval_spk->approval_action_id = 6;
                        $approval_spk->document_id = $spk->id;
                        $approval_spk->document_type = "Modules\Spk\Entities\Spk";
                        $approval_spk->total_nilai = $csv_line[8];
                        $approval_spk->created_at = date("Y-m-d H:i:s");
                        $approval_spk->created_by = 1;
                        $approval_spk->save();

                        if ( $group_cost == 2 ){
                            $spk_f = Spk::find($spk->id);
                            $spk_f->project_kawasan_id = $csv_line[21];
                            $spk_f->save();
                        }

                        $spk_detail = new \Modules\Spk\Entities\SpkDetail;
                        $spk_detail->spk_id = $spk->id;
                        $spk_detail->asset_id = $unit;
                        $spk_detail->asset_type = "Modules\Project\Entities\Project";
                        $spk_detail->created_by = 1;
                        $spk_detail->created_at = date("Y-m-d H:i:s");
                        $spk_detail->save();

                        foreach ($tender->units as $key2 => $value2) {
                            $unit_progress = new \Modules\Project\Entities\UnitProgress;
                            $unit_progress->project_id = $csv_line[0];;
                            $unit_progress->unit_id = $value2->id;
                            $unit_progress->unit_type = "Modules\Project\Entities\Project";
                            $unit_progress->itempekerjaan_id = $child->id;
                            $unit_progress->nilai = "1";
                            $unit_progress->satuan = "ls";
                            $unit_progress->volume = $csv_line[8];
                            $unit_progress->bobot = 100;
                            $unit_progress->progresslapangan_percent = $csv_line[14] / 100;
                            $unit_progress->progressbap_percent = $csv_line[13] / 100;
                            $unit_progress->save();

                            $SpkvoUnit = new Modules\Spk\Entities\SpkvoUnit;
                            $SpkvoUnit->head_id = $spk->id;
                            $SpkvoUnit->spk_detail_id = $spk_detail->id;
                            $SpkvoUnit->head_type = "Modules\Spk\Entities\Spk";
                            $SpkvoUnit->unit_progress_id = $unit_progress->id;
                            $SpkvoUnit->nilai = $csv_line[8];
                            $SpkvoUnit->volume = "1" ;
                            $SpkvoUnit->satuan = "ls";
                            if ( $csv_line[7] > 0 ){
                                $SpkvoUnit->ppn = ( $csv_line[7] / $csv_line[8] ) * 100;
                            }else{
                                $SpkvoUnit->ppn = 0;
                            }
                            $SpkvoUnit->save();  
                        }

                        //Spk Progress
                        $spk_now = \Modules\Spk\Entities\Spk::find($spk->id); 
                        $item_progress = $spk_now->progresses->first()->itempekerjaan->parent->item_progress;
                        if ( count($item_progress) > 0 ){
                            foreach ($item_progress as $key => $value) {
                                $termyn[$key] = "0";
                            }
                            
                            if ( count($spk_now->list_pekerjaan) > 0 ){
                                foreach ($spk_now->list_pekerjaan as $key => $value) {
                                    foreach ($value['termyn'] as $key2 => $value2) {
                                        $termyn[$key2] = $termyn[$key2] + round( ( $value2 * $value['bobot_coa'] ) / 100 , 2);
                                    }
                                }
                            }

                            $spk_termyn = new Modules\Spk\Entities\SpkTermyn;
                            $spk_termyn->spk_id = $spk->id;
                            $spk_termyn->termin = 0; 
                            $spk_termyn->progress = 0 ;        
                            $spk_termyn->status = 1 ;        
                            $spk_termyn->save();

                            foreach ($termyn as $key => $value) {
                                $spk_termyn = new Modules\Spk\Entities\SpkTermyn;
                                $spk_termyn->spk_id = $spk->id;
                                $spk_termyn->termin = $key + 1 ; 
                                $spk_termyn->progress = $termyn[$key] ;
                                $spk_termyn->status = 0 ;
                                $spk_termyn->save();
                            }
                        }                   
                        
                    }           
                }               
	    	}
	    }
    }
}
