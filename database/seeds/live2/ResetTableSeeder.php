<?php

use Illuminate\Database\Seeder;
use Modules\Project\Entities\Project;
use Modules\Approval\Entities\Approval;
use Modules\Approval\Entities\ApprovalHistories;
use Modules\Spk\Entities\Bap;
use Modules\Voucher\Entities\Voucher;
use Modules\Spk\Entities\Spk;

class ResetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $project = Project::find(24);
        foreach ($project->spks as $key => $value) {
        	
        	/*foreach ($value->approval as $key2 => $value2) {
        		foreach ($value->approval_histories as $key3 => $value3) {
        			$approval_histories = ApprovalHistories::find($value3->id);
        			$approval_histories->delete();
        		}
        		$approval = Approval::find($value2->id);
        		$approval->delete();
        	}

        	foreach( $value->baps as $key4 => $value4 ){
        		foreach ($value4->vouchers as $key5 => $value5) {
        			$voucher = Voucher::find($value5->id);
        			$voucher->delete();
        		}
        		
        		$baps = Bap::find($value4->id);
        		$baps->delete();
        	}*/

            $spk = Spk::find($value->id);
            $spk->no = "";
            $spk->save();

        }
    }
}
