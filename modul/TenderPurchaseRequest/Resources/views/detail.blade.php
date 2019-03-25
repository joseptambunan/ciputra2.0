<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard</title>
  <link rel="stylesheet" href="{{ url('/')}}/assets/selectize/selectize.bootstrap3.css">

  @include("master/header")
  <style>
    .form-control{
      margin-bottom: 10px;
      border-color: silver;
      border-radius:10px;
    }  
    body .modal-dialog {
        width: 90vw;
    }
    .nav-tabs{
      margin-top: 10px;
      margin-bottom: 15px;
    }
    .optionItem{
      width:24.5%;
    }
    .table-align-right{
      text-align: right;
    }
    .table-align-center{
      text-align: center;
    }
    .table>tbody>tr.info>td, .table>tbody>tr.info>th, .table>tbody>tr>td.info, .table>tbody>tr>th.info, .table>tfoot>tr.info>td, .table>tfoot>tr.info>th, .table>tfoot>tr>td.info, .table>tfoot>tr>th.info, .table>thead>tr.info>td, .table>thead>tr.info>th, .table>thead>tr>td.info, .table>thead>tr>th.info{
      background-color: #00c0ef;
      color: white;
    }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="text-align:center">Item Tender Purchase Request Detail</h1>
    </section>
    <section class="content-header">
      <div class="" style="float: none">
        <button class="col-md-1 col-sm-2 btn btn-primary" onclick="location.href='@if(isset($back)){{ url('/')}}/{{$back}}@else{{ url('/')}}/tenderpurchaserequest/@endif'" style="float: none; border-radius: 20px; padding-left: 0">
        <i class="fa fa-fw fa-arrow-left"></i>&nbsp;&nbsp;Back
        </button>
        <button class="col-md-1 col-sm-2 btn btn-primary" onclick="window.location.reload()" style="float: right; border-radius: 20px; padding-left: 0;">
          <i class="fa fa-fw fa-refresh"></i>&nbsp;&nbsp;Refresh
        </button>  
      </div>
    </section>    <!-- Modal -->
  <div class="modal fade" id="TPRMore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
              <div class="col-md-12">
                  <div class="col-md-12 text-center">
                    <h3>Item Tender Purchase Request</h3>
                    <div class="form-group">
                        <label>No. Item Tender Purchase Request</label>
                        <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$TPR->no}}" readonly="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Id Item Tender</label>
                        <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$TPR->id}}" readonly="">
                    </div>
                    <div class="form-group">
                        <label>Jumlah PR terikat</label>
                        <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$jumlahPR}}" readonly="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <!-- <div class="form-group">
                        <label>Name Item Tender</label>
                        <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$TPR->name}}" readonly="">
                    </div> -->
                    <div class="form-group">
                        <label>Harga Dokumen</label>
                        <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$TPR->harga_dokumen}}" readonly="">
                    </div>
                    <div class="form-group">
                        <label>Sumber</label>
                        <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$TPR->sumber}}" readonly="">
                    </div>
                  </div>
                  <div class="col-md-12 text-center">
                      <h3>Date Detail</h3>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Ambil Dokumen</label>
                        <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$TPR->ambil_doc_date}}" readonly="">
                    </div>
                    <div class="form-group">
                        <label>Penawaran 1</label>
                        <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$TPR->penawaran1_date}}" readonly="">
                    </div>
                    <div class="form-group">
                        <label>penawaran 2</label>
                        <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$TPR->penawaran2_date}}" readonly="">
                    </div>
                    <div class="form-group">
                        <label>penawaran 3</label>
                        <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$TPR->penawaran3_date}}" readonly="">
                    </div>
                    <div class="form-group">
                        <label>Final</label>
                        <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$TPR->final_date}}" readonly="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Undangan melalui {{$TPR->aanwijzing_type}} </label>
                        <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$TPR->aanwijzing_date}}" readonly="">
                    </div>
                    <div class="form-group">
                        <label>Klarifikasi 1</label>
                        <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$TPR->klarifikasi1_date}}" readonly="">
                    </div>
                    <div class="form-group">
                        <label>Klarifikasi 2</label>
                        <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$TPR->klarifikasi2_date}}" readonly="">
                    </div>
                    <div class="form-group">
                        <label>Rekomendasi</label>
                        <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$TPR->recommendation_date}}" readonly="">
                    </div>
                    <div class="form-group">
                        <label>Pengumuman</label>
                        <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$TPR->pengumuman_date}}" readonly="">
                    </div>
                  </div>
                  <div class="col-md-12 text-center">
                      <h3>Recomended Supplier </h3>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                        <label>No. PR</label>
                        @foreach($PRD as $v )
                          <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$v->no}}" readonly="">
                        @endforeach
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                        <label>Rekomendasi Supplier 1</label>
                        @foreach($PRD as $v )
                          <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$v->rekanan1Name}}" readonly="">
                        @endforeach
                    </div>
                    
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                        <label>Rekomendasi Supplier 2</label>
                        @foreach($PRD as $v )
                          <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$v->rekanan2Name}}" readonly="">
                        @endforeach               
                      </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                        <label>Rekomendasi Supplier 3</label>
                        @foreach($PRD as $v )
                          <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$v->rekanan3Name}}" readonly="">
                        @endforeach                    
                      </div>
                  </div>
                  <!-- 
                  <div class="col-md-{{'12/count($rekananPRD)'}}">
                    <div class="form-group">
                        <label>Recomend Suplier {{'$i+1'}}</label>
                        <input type="text" class="col-md-6 form-control" name="rab_id" value="{{'$rekananPRD[$i]->name'}}" readonly="">
                    </div>
                  </div>
                   -->
                  <div class="col-md-12 text-center">
                      <h3>Delivery Date PR Detail </h3>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>No. PR</label>
                        @foreach($PRD as $v )
                          <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$v->no}}" readonly="">
                        @endforeach
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Delivery Date</label>
                        @foreach($PRD as $v )
                          <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$v->delivery_date}}" readonly="">
                        @endforeach
                    </div>
                  </div>
                </div>
            </div>    
            <div class="container-fluid">
              <div class="col-md-12">
                <div class="col-md-12 text-center">
                    <h3>Item</h3>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label>Id - Name</label>
                      <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$PRD[0]->item_id}} - {{$PRD[0]->itemName}}" readonly="">
                  </div>
                  <div class="form-group">
                      <label>Satuan</label>
                      <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$TPRItem->satuanName}}" readonly="">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Brand</label>
                    <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$PRD[0]->brandName}}" readonly="">
                  </div>
                  <div class="form-group">
                    <label>Quantity</label>
                    <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$TPRItem->quantity}}" readonly="">
                  </div>
                </div>
                <div class="col-md-12 text-center">
                  <h3>Description</h3>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Description Item Tender</label>
                    <textarea type="text" class="col-md-6 form-control" name="rab_id" readonly="" rows="5">{{$TPRItem->description}}</textarea>
                  </div>
                </div>
              </div>
            </div>          
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

  <div class="modal fade" id="tambahRekanan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{ url('/')}}/tenderpurchaserequest/add-rekanan" method="get">
      @csrf
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <div class="container-fluid">
                <div class="col-md-12">
                  <div class="col-md-12 text-center">
                      <h3>Item</h3>
                  </div>
                  <div class="col-md-4 col-md-offset-4" hidden>
                    <div class="form-group">
                        <label>Id Item Tender Purchase Request</label>
                        <input type="text" class="col-md-6 form-control" name="id" value="{{$TPR->id}}" readonly="">
                    </div>                  
                  </div>
                  <div class="col-md-4 col-md-offset-4" hidden>
                    <div class="form-group">
                        <label>Rab id</label>
                        <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$TPR->id}}" readonly="">

                    </div>                  
                  </div>

                  <div class="col-md-12">
                    <div id="rekanan_1" class="form-rekanan form-group col-md-12">
                      <label class="col-md-12" style="padding-left:0">Rekanan</label>
                      <select id="form-selectize-rekanan" name="rekanan[]" class="form-selectize-rekanan input col-md-12" required>
                        <option value="" selected disabled>Pilih Rekanan</option>
                        @foreach($rekananList as $key => $value )
                          <option value="{{ $value->id }}" @if(in_array($value->id,$rekananArray)) disabled @endif>{{$value->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
              </div>       
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Add</button>
          </div>
        </div>
      </div>
    </form>
    </div>

  <div class="modal fade" id="tambahPenawaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
        <div class="modal-dialog" role="document">
          <form action="{{url('/')}}/tenderpurchaserequest/tambah-penawaran" method="get">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="col-md-6">Tambah Penawaran</h3>
              <h3 class="col-md-6"><button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button></h3>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                  <div class="col-md-12">
                    <div class="col-md-12">    
                      <div class="col-md-12">
                        <div class="col-md-12 text-center">
                          <h3>Ubah/Tambah Penawaran</h3>
                        </div>
                        <div hidden>
                          <input type="text" class="col-md-6 form-control" name="tpr_id" value="{{$TPR->id}}" readonly="">
                        </div>
                          @php($i=0)
                          <div class="col-md-3 text-center">
                            Rekanan
                          </div>
                          <div class="col-md-3 text-center">
                            Penawaran 1
                          </div>
                          <div class="col-md-3 text-center">
                            Penawaran 2
                          </div>
                          <div class="col-md-3 text-center">
                            Penawaran 3
                          </div>
                          @php($j=0)
                          @foreach($rekanan as $v)

                              <div class="col-md-3">
                                <input type="text" class="col-md-2 form-control" name="name[]" value="{{$v->name}}" disabled>
                              </div>
                              <div class="col-md-3 hidden">
                                <input type="text" class="col-md-2 form-control" name="id_rekanan[]" value="{{$v->tprrId}}">
                              </div>
                              <div class="col-md-3">
                                <input type="number" class="col-md-2 form-control" name="penawaran1[]" value="{{$penawaran[$j]->nilai1}}" style="text-align: right">
                              </div>
                              <div class="col-md-3">
                                <input type="number" class="col-md-2 form-control" name="penawaran2[]" value="{{$penawaran[$j]->nilai2}}" style="text-align: right" @if($penawaran[$j]->nilai1 == null) disabled @endif>
                              </div>
                              <div class="col-md-3">
                                <input type="number" class="col-md-2 form-control" name="penawaran3[]" value="{{$penawaran[$j]->nilai3}}" style="text-align: right" @if($penawaran[$j]->nilai2 == null) disabled @endif>
                              </div>
                              @php($j++)
                          @endforeach   
                      </div>
                    </div>
                  </div>
                </div>       
            </div>
            <div class="modal-footer row">
              <button type="submit" class="btn btn-info col-md-1 col-md-offset-9">Add</button>
              <button type="button" class="btn btn-secondary col-md-1 col-md-offset-1" data-dismiss="modal" style="float:right;margin-right: 90px">Close</button>
            </div>
          </div>
          </form>
        </div>
    </div>


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                  <div class="panel panel-info">
                    <div class="form-group panel-heading"> Data Item Tender Purchase Request </div>
                    <div class="panel-body" style="padding-top: 0px;">
                      <div class="col-md-6">
                        <div class="form-group">
                            <label>No. Item Tender Purchase Request</label>
                            <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$TPR->no}}" readonly="">
                        </div>
                        <div class="form-group">
                            <label>Nama Item</label>
                            <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$PRD[0]->itemName}}" readonly="">
                        </div>
                        <div class="form-group">
                            <label>Brand</label>
                            <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$PRD[0]->brandName}}" readonly="">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Item Tender</label>
                            <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$TPR->name}}" readonly="">
                        </div>
                        <div class="form-group">
                            <label>Kuantitas</label>
                            <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$TPRItem->quantity.' '.$TPRItem->satuanName}}" readonly="">
                        </div>
                        <div class="form-group">
                            <label>Jumlah PR terikat</label>
                            <input type="text" class="col-md-6 form-control" name="rab_id" value="{{$jumlahPR}}" readonly="">
                        </div>
                      </div>
                      <div class="col-md-12" style="margin-top:10px">
                          <button class="btn btn-info col-md-12" data-toggle="modal" data-target="#TPRMore">More</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                  <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#rekanan">Rekanan</a></li>
                    <li><a data-toggle="tab" href="#penawaran">Penawaran</a></li>
                  </ul>
                  <div class="tab-content">
                    <div id="rekanan" class="tab-pane fade in active">
                        <div class="row" style="margin-bottom:15px">
                          @if(strcmp($user->user_login,"approval1")!=0)
                          <div class="col-md-2">
                              @if(strcmp($apporve->status,"approved")==0 && $tender_approve == 6 and strcmp($user->user_login,"approval1")!=0 && $idPemenang==0)
                              <button class="btn btn-info col-md-12" data-toggle="modal" data-target="#tambahRekanan">Tambah Rekanan</button>  
                              @endif
                          </div>
                          @endif  
                          <div class="col-md-2">
                            @if(strcmp($apporve->status,"approved")!=0)
                            @if($pemenang != 0 and strcmp($user->user_login,"approval1")==0)
                            <button class="btn btn-info col-md-12" onclick="window.location.href='{{ url('/')}}/tenderpurchaserequest/approve-pemenang/?id={{$idPemenang}}&tpr_id={{$TPR->id}}'">Approve Pemenang</button>  
                            @endif
                            @endif     
                          </div>  
                        </div>                 
                        <table class="table table-bordered">
                        <thead>
                          <tr class="info">
                            <td>Rekanan</td>
                            <td class="text-center">Status</td>
                            <!-- <td>Action</td> -->
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($rekanan as $v )
                          <tr>
                            <td class="col-md-7" style="vertical-align: middle;">{{$v->name}}</td>
                            <td class="col-md-3 text-center" style="vertical-align: middle;">
                            @if($pemenang == 0)
                              Proses Penawaran
                            @elseif($v->is_pemenang ==0)
                              Kalah
                            @else
                              <form action="{{ url('/')}}/tenderpurchaserequest/add-pemenang" class="col-md-12" style="margin: 0;">
                                Menang
                                @if(strcmp($apporve->status,"approved")==0)
                                 | Telah di Apporve
                                @else
                                 | Belum di Approve
                                @endif
                                <!-- <input name="id" value="{{$v->id}}" hidden><br>
                                <button type="submit" class="btn btn-info form-control" style="width: 50%;margin-top: 10px;margin-bottom: 0">Batal Menang</button> -->
                              </form>
                            @endif
                            </td>
                            <!-- <td class="col-md-2" style="vertical-align: middle; padding: 0; margin: 0">
                              <form action="{{ url('/')}}/tenderpurchaserequest/add-pemenang" style=" margin: 0">
                                <input name="id" value="{{$v->tprrId}}" hidden>
                                <button type="submit" class="btn btn-info form-control" @if($pemenang!=0) disabled style="background-color: #5bc0de"@endif>Tujuk Sebagai Pemenang</button>
                              </form>
                            </td> -->

                          </tr>
                          @endforeach  
                        </tbody>
                      </table>
                    </div>
                    <div id="penawaran" class="tab-pane fade">
                      <div class="row" style="margin-bottom:15px">
                        <div class="col-md-2">
                            @if(strcmp($apporve->status,"approved")!=0  && $tender_approve == 6 && strcmp($user->user_login,"administrator")==0 && $idPemenang==0)
                            <button class="btn btn-info col-md-12" data-toggle="modal" data-target="#tambahPenawaran">Tambah Penawaran</button> 
                            @endif
                        </div>
                      </div>
                      
                      <table class="table table-bordered">
                        <thead>
                          <tr class="info">
                            <th width="25%" rowspan="2" style="text-align: center;vertical-align: middle;">Rekanan</th>
                            <th width="25%" colspan="3" class="table-align-center">Satuan (Rp.)</th>
                            <th width="35%" colspan="3" class="table-align-center">Total (Rp.)</th>
                            <th width="15%" rowspan="2" style="text-align: center;vertical-align: middle;">Action</th>
                          </tr>
                          <tr>
                            <th width="10%" class="table-align-right">Penawaran 1</th>
                            <th width="10%" class="table-align-right">Penawaran 2</th>
                            <th width="10%" class="table-align-right">Penawaran 3</th>
                            <th class="table-align-right">Penawaran 1</th>
                            <th class="table-align-right">Penawaran 2</th>
                            <th class="table-align-right">Penawaran 3</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php($i=0)
                          @foreach($rekanan as $v)
                          <tr>
                            <td class="">{{$v->name}}</td>
                            <td class="table-align-right">{{number_format($penawaran[$i]->nilai1,2)}}</td>
                            <td class="table-align-right">{{number_format($penawaran[$i]->nilai2,2)}}</td>
                            <td class="table-align-right">{{number_format($penawaran[$i]->nilai3,2)}}</td>
                            <td class="table-align-right">{{number_format($penawaran[$i]->nilai1*$TPRItem->quantity,2)}}</td>
                            <td class="table-align-right">{{number_format($penawaran[$i]->nilai2*$TPRItem->quantity,2)}}</td>
                            <td class="table-align-right">{{number_format($penawaran[$i]->nilai3*$TPRItem->quantity,2)}}</td>
                            <td class="">
                            <form action="{{ url('/')}}/tenderpurchaserequest/add-pemenang">
                                <input name="id" value="{{$v->tprrId}}" hidden>
                                <input name="tpr_id" value="{{$TPR->id}}" hidden>

                                <button type="submit" class="btn btn-info form-control" @if($penawaran[$i]->nilai3==null or $idPemenang!=0 or $tender_approve != 6 or strcmp($user->user_login,"administrator")!=0))
                                disabled @endif>Tunjuk Sebagai Pemenang</button>
                               
                            </form>
                            </td>
                          </tr>
                          @php($i++)
                          @endforeach  
                        </tbody>
                      </table>  
                    </div>
                  </div>
                </div>
            </div>
        </div>

      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include("master/footer_table")
<!--@include("pt::app")-->

<script src="{{ url('/')}}/assets/selectize/selectize-modal.min.js"></script>
<script type="text/javascript">
  $('#form-selectize-rekanan').selectize({
    plugins: ['remove_button'],
    maxItems: 100,
    delimiter: ',',
    persist: false,
    create: function(input) {
        return {
            value: input,
            text: input,
        }
    }
    });
    $(".selectize-dropdown").css("margin-left", "-15px");

    $(".selectize-dropdown").change(function() {
      if((".selectize-dropdown")[0].style[4] == "top"){
        $(".selectize-dropdown").css("top", "");
      }
      console.log("aa");
    });
  </script>
</body>
</html>
