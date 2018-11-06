<?php
namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Inventory\Http\Requests\RequestMutasiInValidationDepartemen;
use Modules\Inventory\Entities\Asset;
use Modules\Inventory\Entities\AssetDetail;
use Modules\Inventory\Entities\AssetTransaction;
use Modules\Inventory\Entities\Item;
use Modules\User\Entities\User;
use Modules\Inventory\Entities\MutasiIn;
use Modules\Inventory\Entities\Member;
use Modules\Project\Entities\Project;
use Modules\Rekanan\Entities\RekananGroup;
use Modules\Inventory\Entities\Globalsetting;
use datatables;
use PDF;

class MutasiInController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $project = Project::find($request->session()->get('project_id'));
    	return view('inventory::mutasi_in.index',compact('project'));
    }

    public function addFromEmployee(Request $request)
    {
        $items  = Item::get();
        $project = Project::find($request->session()->get('project_id'));
        return view('inventory::mutasi_in.add_form_from_employee',compact('items','project'));
    }

    public function addFromProject(Request $request)
    {
        $items  = Item::get();
        $project = Project::find($request->session()->get('project_id'));
        return view('inventory::mutasi_in.add_form_from_proyek',compact('items','project'));
    }

    public function addFromRekanan(Request $request)
    {
        $items  = Item::get();
        $project = Project::find($request->session()->get('project_id'));
        return view('inventory::mutasi_in.add_form_from_rekanan',compact('items','project'));
    }

    public function addFromOther(Request $request)
    {
        $items  = Item::get();
        $project = Project::find($request->session()->get('project_id'));
        return view('inventory::mutasi_in.add_form_from_other',compact('items','project'));
    }

     public function addPost(Request $request)
    {
        $stat = false;
        $action = '';
        $source_data = $request->mutasiin_source;

        $id_pic_giver = $request->id_pic_giver;
        $pic_giver = $request->giver;
        $id_pic_recipient = $request->id_pic_recipient;
        $pic_recipient = $request->pic_recipient;

        $id_source = $request->id_source;
        $source = $request->source;

        $is_project = false;
        $is_employee = false;
        $is_rekanan = false;
        $is_other = false;

        if($source_data == 'employee')
        {
            $id_source = $id_pic_giver;
            $source = $pic_giver;
            $is_employee = true;

        }elseif ($source_data == 'project') {
            # code...
            $is_project = true;

        }
        elseif ($source_data == 'rekanan') {
            # code...
            $is_rekanan = true;
        }
        else
        {
            $is_other = true;
        }

        $id_destination = session('project');
        $destination = Project::find($id_destination)->name;
        $description = $request->description;
        $allItemStore = json_decode($request->allItemStore);

        if(count($allItemStore) > 0)
        {
            for($i =0;$i < count($allItemStore);$i++)
            {
                $action = MutasiIn::create([
                    'id_pic_recipient'=>$id_pic_recipient,
                    'pic_recipient'=>$pic_recipient,
                    'id_pic_giver'=>$id_pic_giver,
                    'name_pic_giver'=>$pic_giver,

                    'item_id'=>$allItemStore[$i]->id,
                    'item_satuan_id'=>$allItemStore[$i]->item_satuan_id,
                    'qty'=>$allItemStore[$i]->quantity,

                    'id_source' =>$id_source,
                    'source'=>$source,

                    'id_destination'=>$id_destination,
                    'destination'=>$destination,

                    'is_from_employee'=>$is_employee,
                    'is_from_project'=>$is_project,
                    'is_from_rekanan'=>$is_rekanan,
                    'is_from_other'=>$is_other,

                    /*'image1'=>count($allItemStore[$i]->image) !=0 ? $allItemStore[$i]->image[0] : null,
                    'image2'=>count($allItemStore[$i]->image) !=0 ? $allItemStore[$i]->image[1] : null,
                    'image3'=>count($allItemStore[$i]->image) !=0 ? $allItemStore[$i]->image[2] : null,*/

                    'confirm_by_warehouseman'=>0,
                    'confirm_by_hod'=>0,
                    'status'=> 0
                ]);
            }
            if($action)
            {
                $stat = true;
            }
        }


        return response()->json(['stat'=>$stat]);
        
    }

    public function createAsset(Request $request)
    {
        $stat = false;
        $projectname = Project::find(session('project'))->name;
        $mutasi_in_id = $request->id;
        $MutasiIn =MutasiIn::find($mutasi_in_id);


        if($MutasiIn != null)
        {
            if ($MutasiIn->assets_morphic->count() <= 0)
            {
                # code...
                for($count = 0; $count < $MutasiIn->qty; $count++)
                {
                    $assets = Asset::create(
                        [
                            'sumber_id'=>$mutasi_in_id,
                            'sumber_type'=>'App\MutasiIn',
                            'item_id'=>$MutasiIn->item_id,
                            'item_satuan_id'=>$MutasiIn->item_satuan_id,
                            'asset_age'=>5,
                            'quantity'=>1,
                            'price'=>0,
                            'asset_age'=>date('Y-m-d',strtotime('+5 years',strtotime(now()))),
                            'ppn'=>Globalsetting::where('parameter','ppn')->first()->value/100,
                            'description'=>$MutasiIn->item->name,
                            'is_labeled'=>0
                        ]
                    );

                    if($assets)
                    {
                        $createAssetTransaction = AssetTransaction::create([
                            'asset_id'=>$assets->id,
                            'from_user_id'=>is_null($MutasiIn->id_pic_giver) ? 0 : $MutasiIn->id_pic_giver,
                            'from_department_id'=>null,
                            'from_unit_sub_id'=>null,
                            'from_location_id'=>null,
                            'from_room_id'=>null,
                            'to_user_id'=>null,
                            'to_department_id'=>null,
                            'to_unit_sub_id'=>null,
                            'to_location_id'=>null,
                            'to_room_id'=>null,
                            'status'=>null,
                            'description'=>null,
                            'received_at'=>date('Y-m-d')
                        ]);

                        if($createAssetTransaction)
                        {
                            $stat = true;
                        }
                    }
                }
            }
            else
            {
                $stat = true;
            }
            

        }

        return response()->json(['stat'=>$stat,'id'=>$mutasi_in_id]);
    }

    public function detail_assets($mutasi_in_id)
    {
        $project = Project::find($request->session()->get('project_id'));
        $item_name = MutasiIn::find($mutasi_in_id)->item->name;
        return view('inventory::mutasi_in.details_asset',compact('mutasi_in_id','item_name','project'));
    }

    public function getAssets($mutasi_in_id)
    {
        $assets = Asset::where([['sumber_id', '=', $mutasi_in_id],['sumber_type','LIKE','%MutasiIn%']])->get();

        $results = [];

        foreach ($assets as $key => $value) {
            # code...
            $age = strtotime($value->asset_age)-strtotime($value->created_at);
            $age_asset = floor($age / (60*60*24*365));
            $totalprice = $value->price+($value->price*$value->ppn);
            $arr = array(
                'id'=>$value->id,
                'no'=>$key+1,
                'to_user'=>is_null($value->asset_transactions[0]->user_to) ? 'Kosong' : $value->asset_transactions[0]->user_to->user_name,
                'to_room'=>is_null($value->asset_transactions[0]->room_to) ? 'Kosong' : $value->asset_transactions[0]->room_to->name,
                'to_department'=>is_null($value->asset_transactions[0]->department_to) ? 'Kosong' : $value->asset_transactions[0]->department_to->name,
                'barcode'=>is_null($value->detail->barcode) ? 'Kosong' : $value->detail->barcode,
                'satuan_name'=>$value->satuan->name,
                'price'=>number_format($value->price,2,".",","),
                'ppn'=>number_format($value->ppn*100,2,".",","),
                'ppn_value'=>number_format($value->price*($value->ppn),2,".",","),
                'total_price'=>number_format($totalprice,2,".",","),
                'asset_age'=>$age_asset,
                'description'=>$value->description
            );

            array_push($results,$arr);
        }

        return datatables()->of($results)->toJson();
    }

    /*public function details(Request $request)
    {
        $asset_id = $request->id;
        $Assets = Asset::find($asset_id);
        return view('mutasi_in.details',compact('Assets'));
    }*/

    public function getSource(Request $request)
    {
        $term = $request->term;
        $source = MutasiOut::select('source')->where('source','like',$term.'%')->get();

        return response()->json($source);
    }

    public function getUsers(Request $request)
    {
        $term = $request->get('q');
        $getusers = User::select('id','user_name')->where('user_name','like','%'.$term.'%')->get();

        return response()->json($getusers);
    }

    public function getMembers(Request $request)
    {
        $term = $request->get('q');
        $getmembers = Member::select('id','member_name','description')->where('member_name','like','%'.$term.'%')->get();

        return response()->json($getmembers);
    }

    public function getRekanan(Request $request)
    {
        $term = $request->get('q');
        $getRekanans = RekananGroup::select('id','name')->where('name','like','%'.$term.'%')->get();

        return response()->json($getRekanans);
    }

    public function getData()
    {
        $lists = MutasiIn::all();
        $is_from = '';
        $source ='';
        $results = [];
        foreach ($lists as $key => $value) {
            # code...
            if($value->is_from_employee)
            {
                $is_from = 'Individu';
                $source = is_null($value->user_giver) ? $value->name_pic_giver : $value->user_giver->user_name;
            }
            else if($value->is_from_rekanan)
            {
                $is_from = 'Rekanan';
                $source = $value->source_rekanan->name;

            }
            else if($value->is_from_project)
            {
                $is_from = "Proyek";
                $source = $value->source_project->name;
            }
            else
            {
                $is_from = "Pihak Luar";
                $source = $value->source_other->member_name;
            }
            $arr = [
                'is_from'=>$is_from,
                'id'=>$value->id,
                'confirm_by_warehouseman'=>$value->confirm_by_warehouseman,
                'source'=>$source,
                'item_name'=>is_null($value->item) ? $value->item_tidak_terdefinisi : $value->item->name,
                'qty'=>$value->qty,
                'giver'=>is_null($value->user_giver) ? $value->name_pic_giver : $value->user_giver->user_name,
                'recipient'=>is_null($value->user_recipient) ? $value->pic_recipient : $value->user_recipient->user_name,
                'satuan'=>is_null($value->satuan) ? $value->satuan_item_tidak_terdefinisi : $value->satuan->name,
                'date'=>date('d-m-Y',strtotime($value->created_at))
            ];

            array_push($results, $arr);
        }

        return datatables()->of($results)->toJson();
    }

    public function details(Request $request, $id)
    {
       $mutasiin = MutasiIn::find($id);
       $project = Project::find($request->session()->get('project_id'));
        return view('inventory::mutasi_in.details',compact('mutasiin','project'));
    }

    public function ProjectTypeAhead(Request $request)
    {
        $term = $request->get('q');
        $getProjects = Project::select('id','name')->where('name','like','%'.$term.'%')->get();

        return response()->json($getProjects);
    }

    public function getMutasiInfromEmployee(Request $request)
    {
        $datas = MutasiIn::where('is_from_employee',1)->get();

        return datatables()->of($datas)->toJson();
    }

    public function getMutasiInfromProyek()
    {
        $datas = MutasiIn::where('is_from_project',1)->get();

        return datatables()->of($datas)->toJson();
    }

    public function getMutasiInfromRekanan()
    {
        $datas = MutasiIn::where('is_from_rekanan',1)->get();

        return datatables()->of($datas)->toJson();
    }

    public function getMutasiInfromOther()
    {
        $datas = MutasiIn::where('is_from_other',1)->get();

        return datatables()->of($datas)->toJson();
    }

    public function generateBarcode()
    {
        $barcode = uniqid(rand());
        $isBarcodeExist = AssetDetail::where('barcode','=',$barcode)->get();
        $counterBarCodeExist = count($isBarcodeExist);
        while($counterBarCodeExist > 0)
        {
            $barcode = uniqid(rand());
            $isBarcodeExist = Asset::where('barcode','=',$barcode)->get();
            $counterBarCodeExist = count($isBarcodeExist);
        }

        return $barcode;
    }

    public function printQrCode($mutasi_in_id)
    {
        $Assets = MutasiIn::find($mutasi_in_id)->assets_morphic;
        $BarcodeInformations = array();
        foreach($Assets as $key => $value)
        {
            $checkAsset_id = AssetDetail::where('asset_id',$value->id)->first();
            if($checkAsset_id == null)
            {
                $barcodeGet = $this->generateBarcode();
                $createAssetDetail = AssetDetail::create([
                    'asset_id'=>$value->id
                    ,'reuse'=>0,
                    'barcode'=>$barcodeGet]);
            
            }

            $arr = array(
                'id'=>$value->detail->id,
                'asset_id'=>$value->id,
                'inventarisir_detail_id'=>'',
                'department_id'=>$value->asset_transactions[0]->to_department_id,
                'project_id'=>session('project'),
                'department_name'=>$value->asset_transactions[0]->department_to->name,
                'id_item'=>$value->item_id,
                'nama_item'=>$value->item->name,
                'item_satuan_id'=>$value->item_satuan_id,
                'satuan_name'=>$value->satuan->name,
                'price'=>$value->price,
                'ppn'=>$value->ppn,
                'barcode'=>$value->detail->barcode,
                'description'=>$value->description,
                'created_at'=>date('d-m-Y',strtotime($value->created_at)),
            );
            array_push($BarcodeInformations,$arr);
            

        }

        $informations = json_encode($BarcodeInformations);
        $pdf = PDF::loadView('asset.print_qr_code',compact('informations'))->setPaper('a4','potrait');
        return $pdf->stream('print_qrcode.pdf');
    }

    public function postDepartment(RequestMutasiInValidationDepartemen $request)
    {
        $assets_id = json_decode($request->asset_id);
        $department_id = $request->department_id;
        $stat = false;
        $msg = '';
        if(count($assets_id) > 0)
        {
            for($count = 0; $count < count($assets_id); $count++)
            {
                $update_department = AssetTransaction::where('asset_id',$assets_id[$count])->first()->update(['to_department_id'=>$department_id]);
                if($update_department)
                {
                    $stat = true;
                }
            }
        }else
        {
            $stat = false;
            $msg = 'Silahkan Pilih Asset !';
        }

        return response()->json(['stat'=>$stat,'msg'=>$msg]);
    }
}
