<?php
namespace App\Helpers;
class Document
{

    public static function new_number($doc_type, $department_id) 
    {
        if ($doc_type == 'BAP')  {         # code...

        }

       	$roman         = [
            '01' => 'I',
            '02' => 'II',
            '03' => 'III',
            '04' => 'IV',
            '05' => 'V',
            '06' => 'VI',
            '07' => 'VII',
            '08' => 'VIII',
            '09' => 'IX',
            '10' => 'X',
            '11' => 'XI',
            '12' => 'XII',
        ];



        $department = \Modules\Department\Entities\Department::find($department_id)->code;
        $bulan      = $roman[\Carbon\Carbon::now()->format('m')];
        $tahun      = \Carbon\Carbon::now()->format('Y');
        $project    = \Modules\Project\Entities\Project::find( session('project_id') )->code; 
        // use \Session::put('project', value) in command prompt

        
        if ( isset(\Auth::user()->project_pt_users()->whereProjectId( session('project_id') )->first()->pt) ){
            
            //$pt         = \Auth::user()->project_pt_users()->whereProjectId( session('project_id') )->first()->pt->code;
            $pt = "";
        }else{
            $pt = "";
           
        }

        $doc_last = '/'.$doc_type.'/'.$department.'/'.$bulan.'/'.$tahun.'/'.$project.'/'.$pt;
        $count[0] = \Modules\Budget\Entities\Budget::where('no','LIKE', '%'.'')->count();
        $count[1] = \Modules\Budget\Entities\BudgetTahunan::where('no','LIKE', '%'.$doc_last)->count();
        $count[2] = \Modules\Workorder\Entities\Workorder::where('no','LIKE', '%'.$doc_last)->count();
        $count[3] = \Modules\Rab\Entities\Rab::where('no','LIKE', '%'.$doc_last)->count();
        $count[4] = \Modules\Tender\Entities\Tender::where('no','LIKE', '%'.$doc_last)->withTrashed()->count();
        $count[5] = \Modules\Spk\Entities\Spk::where('no','LIKE', '%'.$doc_last)->withTrashed()->count();
        $count[6] = \Modules\Spk\Entities\Suratinstruksi::where('no','LIKE', '%'.$doc_last)->count();
        $count[7] = \Modules\Spk\Entities\Vo::where('no','LIKE', '%'.$doc_last)->count();
        $count[8] = \Modules\Spk\Entities\Bap::where('no','LIKE', '%'.$doc_last)->withTrashed()->count();
        $count[9] = \Modules\Tender\Entities\TenderRekanan::where('sipp_no','LIKE', '%'.$doc_last)->withTrashed()->count();
		//$count[10] = \App\PermintaanBarang::where('no','LIKE', '%'.$doc_last)->withTrashed()->count();
		//$count[11] = \App\PurchaseRequest::where('no','LIKE', '%'.$doc_last)->withTrashed()->count();
        //$count[12] = \App\Piutang::where('no','LIKE', '%'.$doc_last)->withTrashed()->count();
        $count[13] = \Modules\Tender\Entities\TenderKorespondensi::where('no','LIKE', '%'.$doc_last)->withTrashed()->count();
        //$count[14] = \App\PurchaseOrder::where('no','LIKE','%'.$doc_last)->withTrashed()->count();
        //$count[15] = \App\GoodReceive::where('no','LIKE','%'.$doc_last)->withTrashed()->count();
        //$count[16] = \App\Barangmasuk::where('no','LIKE','%'.$doc_last)->withTrashed()->count();
        //$count[17] = \App\TenderPurchaseRequest::where('no','LIKE','%'.$doc_last)->withTrashed()->count();
        //$count[17] = \App\TenderPurchaseKorespondensi::where('no','LIKE','%'.$doc_last)->withTrashed()->count();*/
        $count[18] = \Modules\Voucher\Entities\Voucher::where('no','LIKE','%'.$doc_last)->withTrashed()->count();
        $number = str_pad( (array_sum($count) + 1) ,4,"0",STR_PAD_LEFT);
        return $number.$doc_last;

    }



    public static function make_approval($class, $id)
    {
        $document = $class::find($id);
        if (($class == 'App\Tender') AND ($document->sumber <> 1) )
        {
            $class = 'App\Nontender';
        }

        /*$globalsetting = \App\GlobalSetting::where('parameter','max_value_multiplier_'.$class)->first();
        if ($globalsetting) // maka ini adalah non-tender atau penunjukan
        {
            $max_value_multiplier = $globalsetting->value;
        }else{
            $max_value_multiplier = 1;
        }*/
        /*$approval = $document->approval()->create([
            'approval_action_id' => 1,      //open
            'total_nilai' => $document->nilai
            //'total_nilai' => $max_value_multiplier * $document->nilai
        ]);*/

        $approval = new \App\Approval;
        $approval->approval_action_id = 1;
        $approval->total_nilai = $document->nilai;
        $approval->document_id = $id;
        $approval->document_type = $class;
        $approval->save();
        self::make_approval_history($approval->id,$class);
        return $document;

    }



    public static function make_approval_history($id)

    {

        $approval = \App\Approval::find($id);
        $document = $approval->document;
        $class = class_basename($document);

        if ( $class == "Purchaseorder"){
            $pt_id = $document->purchaserequest->pt->id;
        }else{
            $pt_id = $document->pt->id;
        }

        if ( $class == "Budget"){
            $department_from = $document->department_from;
        }
        else if ( $class == "Workorder" ){
            $department_from = $document->department_from;
        }else if ( $class == "Tender"){
            $department_from = $document->rab->workorder->department_from;
        }else if ( $class == "Spk"){
            $department_from = $document->tender_rekanan->tender->rab->workorder->department_from;
        }else if ( $class == "Voucher"){
            $department_from = $document->bap->spk->tender_rekanan->tender->rab->workorder->department_from;
        }else if ( $class == "TenderRekanan" ){
            $department_from = $document->department_from;
        }else if ( $class == "Purchaserequest"){
            $department_from = $document->department_id;
        } else if ( $class == "BudgetDraft"){
            $department_from = $document->budget->department_id;
        }
        
        // cari di ApprovalReference, user mana yang akan approve dokumen ini
        // cari berdasarkan document type, nilai min, nilai max
        //$detailDOc = $class::find()
        $approval_references = \Modules\Approval\Entities\ApprovalReference::where('document_type', $class)
                                    ->where('project_id', session('project_id') )
                                    //->where('pt_id', $pt_id )
                                    ->where('min_value', '<=', $approval->total_nilai)
                                    //->where('max_value', '>=', $approval->total_nilai)
                                    ->orderBy('no_urut','ASC')
                                    ->get();
        foreach ($approval_references as $key => $each) 
        {
            /* Departmen ID = 11 is Direksi */
            //$department_id = \App\User::find($each->user_id)->details->first()->mappingperusahaan->department_id;
            //$user_level = \App\User::find($each->user_id)->details->first()->user_level;
            
                $document->approval_histories()->create([
                'no_urut' => $each->no_urut,
                'user_id' => $each->user_id,
                'approval_action_id' => 1, // open
                'approval_id' => $approval->id
                ]);
                                 
            //document->approval->update(['approval_action_id' => 1]);
        }
        return $document;

    }



    public static function make_approval_signature($id,$class){
        $direksi = "";
        $gm = "";
        $dept = "";
        $div = "";
        $flags = 4 ; // Value = 4 menunjukan level terendah direksi
        $document = $class::find($id);
        $signature = array();
        if ( isset($document->approval)){
            foreach( $document->approval->histories as $histories ){          
                if ( $histories->user->details->first()->user_level < 5 ){
                    $direksi = "exist";             
                    if ( $histories->user->details->first()->user_level < $flags ){
                        $flags = $histories->user->details->first()->user_level;
                        $signature["direksi"] = "exist";
                        $signature["user_id"] = $histories->user_id;   
                    }                  
                }
                if ( $histories->user->details->first()->user_level == 5 ){
                    $gm = $histories->user_id;     
                    $signature["gm"] = $gm;          
                }

                if ( $histories->user->details->first()->user_level == 6 ){
                    $dept = $histories->user_id;
                    $signature["dept"] = $dept;
                }

                if ( $histories->user->details->first()->user_level == 7 ){
                    $div = $histories->user_id;
                    $signature["div"] = $histories->user_id;
                }
            }

            return $signature;

        }
    }    

}