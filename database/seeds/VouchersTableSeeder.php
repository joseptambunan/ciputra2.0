<?php

use Illuminate\Database\Seeder;
use Modules\Spk\Entities\Bap;
use Modules\Voucher\Entities\Voucher;

class VouchersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $file = fopen("./public/migrasi/bizpark/voucher.csv","r");

        while(! feof($file)){
	    	$csv_line = fgetcsv($file);
	    	if ( $csv_line != "" ) {
	    		$bap = Bap::where("no",$csv_line[0])->get();
	    		if ( count($bap) > 0 ){
	    			foreach ($bap as $key => $value) {
	    				$bap_id = Bap::find($value->id);
	    				if ( $bap_id->spk->project_id == 66 ){	    						    				
			    			$voucher = new Voucher;
			    			$voucher->project_id = 66;
			    			$voucher->head_id = $bap_id->id;
			    			$voucher->head_type = "Bap";
			    			$voucher->rekanan_id = $bap_id->spk->rekanan_id;
			    			$voucher->department_id = 2;
			    			$voucher->pt_id = $bap_id->spk->project->pt->first()->pt->id;
			    			$voucher->date = $csv_line[2]."00:00:00.000";
			    			$voucher->no = $csv_line[1];
			    			$voucher->created_at = date("Y-m-d H:i:s.u");
			    			$voucher->created_by = 9999;
			    			$voucher->save();
	    				}
	    			}
	    		}
    		}
    	}
    }
}
