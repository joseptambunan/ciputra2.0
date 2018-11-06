<?php

use Illuminate\Database\Seeder;

class VoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

       /* \Modules\Spk\Entities\Vo::truncate();
        \Modules\Spk\Entities\Suratinstruksi::truncate();
        \Modules\Spk\Entities\SuratinstruksiUnit::truncate();
        \Modules\Spk\Entities\SuratinstruksiItem::truncate();*/

        $file = fopen("./public/migrasi/vo.csv","r");
        $start = 0;
	    while(! feof($file)){
	    	$csv_line = fgetcsv($file);
	    	if ( $csv_line != "" ) {
                if ( $csv_line[2] != ""){
                    $spk = \Modules\Spk\Entities\Spk::where("no",$csv_line[1])->get();
                    if ( count($spk) > 0 ){
                        $spk_d = \Modules\Spk\Entities\Spk::find($spk->first()->id);
                        $suratinstruksi = new \Modules\Spk\Entities\Suratinstruksi;
                        $suratinstruksi->spk_id = $spk_d->id;
                        $suratinstruksi->date = date("Y-m-d H:i:s");
                        $suratinstruksi->perihal = "Variation Order from : Migration from Erem based export at 18 Oct 2018";
                        $suratinstruksi->content = "Variation Order from : Migration from Erem based export at 18 Oct 2018";
                        $suratinstruksi->type = "sik";
                        $suratinstruksi->save();

                        foreach ($spk_d->details as $key => $value) {
                            $SuratInstruksiUnit = new \Modules\Spk\Entities\SuratInstruksiUnit;
                            $SuratInstruksiUnit->suratinstruksi_id = $suratinstruksi->id;
                            $SuratInstruksiUnit->unit_id = $value->id;
                            $SuratInstruksiUnit->created_by = 1;
                            $SuratInstruksiUnit->save();   

                            $variation_order                            = new \Modules\Spk\Entities\Vo;
                            $variation_order->suratinstruksi_id         = $suratinstruksi->id;
                            $variation_order->suratinstruksi_unit_id    = $SuratInstruksiUnit->id;
                            $variation_order->no                        = null;
                            $variation_order->date                      = date("Y-m-d H:i:s");
                            $variation_order->urutan                    = null;
                            $variation_order->description               = "Migration from Erem based export at 18 Oct 2018";
                            $variation_order->created_by                = 1;
                            $variation_order->created_at                = date("Y-m-d H:i:s");
                            $variation_order->save(); 

                            foreach ($value->details_with_vo as $key2 => $value2) {
                                $newunitprogress = new \Modules\Project\Entities\UnitProgress;
                                $newunitprogress->project_id = $csv_line[0];
                                $newunitprogress->unit_id = $value2->unit_progress->unit_id;
                                $newunitprogress->unit_type = $value2->unit_progress->unit_type;
                                $newunitprogress->itempekerjaan_id = $value2->unit_progress->itempekerjaan->id;
                                $newunitprogress->group_tahapan_id = $key2;
                                $newunitprogress->group_item_id = $key2;
                                $newunitprogress->urutitem = $value2->unit_progress->urutitem;
                                $newunitprogress->termin = $value2->unit_progress->termin;
                                $newunitprogress->nilai = $csv_line[2];
                                $newunitprogress->volume = "1";
                                $newunitprogress->satuan = "ls";
                                $newunitprogress->durasi = "0";
                                $newunitprogress->is_pembangunan = $value2->unit_progress->is_pembangunan;
                                $newunitprogress->progresslapangan_percent = 0;
                                $newunitprogress->progressbap_percent = 0;
                                $newunitprogress->mulai_jadwal_date = date("Y-m-d H:i:s");
                                $newunitprogress->selesai_jadwal_date = null;
                                $newunitprogress->save();

                                $SpkvoUnit = new \Modules\Spk\Entities\SpkvoUnit;
                                $SpkvoUnit->head_id = $variation_order->id;
                                $SpkvoUnit->spk_detail_id = $value2->id;
                                $SpkvoUnit->head_type = "Modules\Spk\Entities\Vo";
                                $SpkvoUnit->unit_progress_id = $newunitprogress->id;
                                $SpkvoUnit->volume = "1";
                                $SpkvoUnit->nilai = $csv_line[2];
                                $SpkvoUnit->satuan = "ls";
                                $SpkvoUnit->ppn = null;
                                $SpkvoUnit->save();  

                                $SuratInstruksiItem = new \Modules\Spk\Entities\SuratInstruksiItem;
                                $SuratInstruksiItem->surat_instruksi_unit_id = $SuratInstruksiUnit->id;
                                $SuratInstruksiItem->itempekerjaan_id = $value2->unit_progress->itempekerjaan[$key];
                                $SuratInstruksiItem->unit_progress_id = $newunitprogress->id;
                                $SuratInstruksiItem->created_by = 1;
                                $SuratInstruksiItem->save();                
                            }                        
                        }
                    }
                }	    		
	    	}
	    }
    }
}
