<?php

use Illuminate\Database\Seeder;
use Modules\Voucher\Entities\VoucherDetail;
use Modules\Voucher\Entities\Voucher;

class VoucherDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$file = fopen("./public/migrasi/bizpark/voucher_detail.csv","r");
        while(! feof($file)){
	    	$csv_line = fgetcsv($file);
	    	if ( $csv_line != "" ) {
	    		$voucher = Voucher::where("no",$csv_line[0])->get();
	    		if ( count($voucher) > 0 ){
	    			$voucher_id = Voucher::find($voucher->first()->id);
	    			$voucher_detail = new VoucherDetail;
	    			$voucher_detail->voucher_id  = $voucher_id->id;
	    			$voucher_detail->coa_id = "11.41.".$voucher_id->bap->spk->itempekerjaan->code;
	    			$voucher_detail->head_id = $voucher_id->id;
	    			$voucher_detail->head_type = "Modules\Voucher\Entities\Voucher";
	    			$voucher_detail->nilai = $csv_line[1];
	    			$voucher_detail->mata_uang = "IDR";
	    			$voucher_detail->kurs = 1;
	    			$voucher_detail->type = 'dpp';
	    			$voucher_detail->created_at = $voucher_id->date;
	    			$voucher_detail->created_by = 999;
	    			$voucher_detail->save();

	    			$voucher_detail = new VoucherDetail;
	    			$voucher_detail->voucher_id  = $voucher_id->id;
	    			$voucher_detail->coa_id = "21.420.210";
	    			$voucher_detail->head_id = $voucher_id->id;
	    			$voucher_detail->head_type = "Modules\Voucher\Entities\Voucher";
	    			$voucher_detail->nilai = $csv_line[2];
	    			$voucher_detail->mata_uang = "IDR";
	    			$voucher_detail->kurs = 1;
	    			$voucher_detail->type = 'ppn';
	    			$voucher_detail->created_at = $voucher_id->date;
	    			$voucher_detail->created_by = 999;
	    			$voucher_detail->save();

	    			$voucher_detail = new VoucherDetail;
	    			$voucher_detail->voucher_id  = $voucher_id->id;
	    			$voucher_detail->coa_id = "21.40.130";
	    			$voucher_detail->head_id = $voucher_id->id;
	    			$voucher_detail->head_type = "Modules\Voucher\Entities\Voucher";
	    			$voucher_detail->nilai = "-".$csv_line[3];
	    			$voucher_detail->mata_uang = "IDR";
	    			$voucher_detail->kurs = 1;
	    			$voucher_detail->type = 'pph';
	    			$voucher_detail->created_at = $voucher_id->date;
	    			$voucher_detail->created_by = 999;
	    			$voucher_detail->save();
	    		}
    		}
    	}
    }
}
