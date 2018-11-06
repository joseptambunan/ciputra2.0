<?php

use Illuminate\Database\Seeder;

class BapTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        /*\Modules\Spk\Entities\Bap::truncate();
        \Modules\Spk\Entities\BapDetail::truncate();
        \Modules\Spk\Entities\BapDetailItempekerjaan::truncate();
*/

        $file = fopen("./public/migrasi/bap.csv","r");
        $start = 0;
        $terbayar_percent = 0;
        $lapangan_percent = 0;
	    while(! feof($file)){
	    	$csv_line = fgetcsv($file);
	    	if ( $csv_line != "" ) {

	    		$spk_tmp = \Modules\Spk\Entities\Spk::where("no",$csv_line[1])->get();
	    		if ( count($spk_tmp) > 0 ){
	    			$spk = Modules\Spk\Entities\Spk::find($spk_tmp->first()->id);
	    			$bap = new Modules\Spk\Entities\Bap;
		    		$bap->spk_id = $spk->id;
		    		$bap->date = $csv_line[3];
		    		$bap->termin = $spk->baps->count() + 1;
		    		$bap->no = $csv_line[2];
		    		$bap->nilai_bap_2 = $csv_line[7] - $csv_line[8];
		    		$bap->created_at = date("Y-m-d H:i:s");
		    		$bap->created_by = 1;
		    		$bap->percentage = $csv_line[5];
		    		$bap->percentage_lapangan = $csv_line[6];
		    		$bap->percentage_sebelumnyas = 0;
		    		$bap->status_voucher = 1;
		    		$bap->nilai_retensi = $csv_line[8];
		    		$bap->save();

		    		foreach ($spk->details as $key => $value) {
		    			$bap_detail = new Modules\Spk\Entities\BapDetail;
			    		$bap_detail->bap_id = $bap->id;
			    		$bap_detail->asset_id = $value->asset_id;
			    		$bap_detail->asset_type = "Modules\Project\Entities\Project";
			    		$bap_detail->created_at = date("Y-m-d H:i:s");
			    		$bap_detail->created_by = 1;
			    		$bap_detail->save();	
		    		}
		    		
		    		foreach ($spk->detail_units as $key2 => $value2) {		    			# code...

			    		if ( $csv_line[6] > 0 ){
			    			$terbayar_percent = $csv_line[6] / 100;
			    		}

			    		if ( $csv_line[5] > 0 ){
			    			$lapangan_percent = $csv_line[5] / 100;
			    		}

			    		$bap_detail_itempekerjaan = new Modules\Spk\Entities\BapDetailItempekerjaan;
			    		$bap_detail_itempekerjaan->bap_detail_id = $bap_detail->id;
			    		$bap_detail_itempekerjaan->spkvo_unit_id = $value2->id;;
			    		$bap_detail_itempekerjaan->itempekerjaan_id = $value2->unit_progress->itempekerjaan->id;
			    		$bap_detail_itempekerjaan->terbayar_percent = $terbayar_percent;
			    		$bap_detail_itempekerjaan->lapangan_percent = $lapangan_percent;
			    		$bap_detail_itempekerjaan->created_at = date("Y-m-d H:i:s");
			    		$bap_detail_itempekerjaan->created_by = 1;
			    		$bap_detail_itempekerjaan->save();
		    		}

	    		}	    		
	    	}
	    }	
    }
}
