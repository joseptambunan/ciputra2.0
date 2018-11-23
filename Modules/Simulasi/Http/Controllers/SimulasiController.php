<?php

namespace Modules\Simulasi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Voucher\Entities\Voucher;
use Modules\Tender\Entities\TenderRekanan;

class SimulasiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function __construct()
    {

        $this->middleware('auth');
    }

    public function index()
    {
        $user = \Auth::user();
        $voucher = Voucher::get();
        $terbayar = 0;
        $blm = 0;
        foreach ($voucher as $key => $value) {
            if ( $value->project_id == 66 ){                
                if ( $value->pencairan_date == null ){
                    $blm = $blm + $value->nilai;
                }else{
                    $terbayar = $terbayar + $value->nilai;
                }
            }
        }

        return view('simulasi::index',compact("user","voucher","terbayar","blm"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('simulasi::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        foreach ($request->terbayar as $key => $value) {
            if ( $request->terbayar[$key] != "" ){
                if ( $request[$key] != "on"){
                    $voucher = Voucher::find($request->voucher_id[$key]);
                    $voucher->pencairan_date = date("Y-m-d H:i:s.u");
                    $voucher->save();
                }
            }
        }
        return redirect("simulasi");
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        $user = \Auth::user();
        $tender_rekanan = TenderRekanan::get();
        return view('simulasi::show',compact("user","tender_rekanan"));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('simulasi::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
