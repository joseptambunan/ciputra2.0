<?php

namespace Modules\Spk\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Spk\Entities\Spk;
use Modules\Globalsetting\Entities\Globalsetting;
use Modules\User\Entities\User;
use PDFMerger;
use PDF;


class DownloadsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cetakspk(Request $request){
        $spk = Spk::find($request->id);

        if ( $spk->memo_cara_bayar == "" ){
            $data = $spk;
            $start = 0;
            $ttd_pertama = "";
            $ttd_kedua = "";
            $tmp_ttd_pertama = array();
            $ppn = Globalsetting::where("parameter","ppn")->first()->value;
            $list_ttd = array();

            $list_ttd[0]["user_name"] = "";
            $list_ttd[0]["user_jabatan"] = "";
            /*if ( $spk->approval != "" ){
                $min = $spk->approval->histories->min("no_urut");
                if ( $spk->approval->histories != "" ){
                    foreach ($spk->approval->histories as $key => $value) {
                        if ( $min == $value->no_urut){
                            $list_ttd[0]["user_name"] = $value->user->user_name;
                            $list_ttd[0]["user_jabatan"] = $value->user->user_jabatan;
                        }
                    }
                }
            }*/

            $sipp = "";
            

            $doc_spk = PDF::loadView('spk::cetakan',compact("spk","list_ttd","ppn","sipp"))->setPaper('a4', 'portrait');
            $doc_spk->save(storage_path().'/spk/'.$spk->no_.'.pdf');
            $public_path = storage_path().'/spk/'.$spk->no.'.pdf';
            $doc_spk->addPDF($public_path, 'all');
            $doc_spk->merge('download', $spk->no.".pdf");

            $spk->memo_cara_bayar = $spk_no.".pdf";
            $spk->save();

        }else{
            $doc_spk = new PDFMerger;
            $public_path = public_path().'/spk/'.$spk->memo_cara_bayar.'.pdf';
            $doc_spk->addPDF($public_path, 'all');
            $doc_spk->merge('download', $spk->no.".pdf");
        }
    }
}
