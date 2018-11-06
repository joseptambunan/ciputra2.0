<?php

use Illuminate\Database\Seeder;

class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $file = fopen("./public/migrasi/unit.csv","r");

	    while(! feof($file)){
	    	$csv_line = fgetcsv($file);
	    	if ( $csv_line != "" ) {
	    		if ( $csv_line[0] != NULL ){
	    			$block = Modules\Project\Entities\Blok::where("block_id",$csv_line[0])->get();
	    			if ( count($block) > 0 ){
	    				$block_id = $block->first()->id;
	    			}else{
	    				$block_id = NULL;
	    			}
	    		}else{
	    			$block_id = NULL;
	    		}

	    		if ( $csv_line[1] != NULL ){
	    			$pt = Modules\Pt\Entities\Pt::where("pt_id",$csv_line[1])->get();
	    			if ( count($pt) > 0 ){
	    				$pt_id = $pt->first()->id;
	    			}else{
	    				$pt_id = NULL;
	    			}
	    		}else{
	    			$pt_id = NULL;
	    		}

	    		if ( $csv_line[2] != NULL ){
	    			$type = Modules\Project\Entities\UnitType::where("type_id",$csv_line[2])->get();
	    			if ( count($type) > 0 ){
	    				$type_id = $type->first()->id;
	    			}else{
	    				$type_id = NULL;
	    			}
	    		}else{
	    			$type_id = NULL;
	    		}

	    		if ( $csv_line[9] == "" ){
	    			$unit_id = null;
	    		}else{
	    			$unit_id = $csv_line[9];
	    		}

				$newunit = new Modules\Project\Entities\Unit;
				$newunit->blok_id = $block_id;
				$newunit->pt_id = $pt_id;
				$newunit->unit_type_id = $type_id;
				$newunit->name = $csv_line[4];
				$newunit->tanah_luas = $csv_line[5];
				$newunit->bangunan_luas = $csv_line[6];
				$newunit->is_sellable = $csv_line[7];
				$newunit->created_at = date("Y-m-d H:i:s");
				$newunit->unit_id = $unit_id;
				$newunit->save();
	  					  		
	  		}	  	
	    }
        
    }
}
