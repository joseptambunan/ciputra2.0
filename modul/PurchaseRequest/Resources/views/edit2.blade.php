<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
    <link rel="stylesheet" href="{{ url('/')}}/assets/bower_components/select2/dist/css/select2.min.css">
  <style type="text/css">
    .table-align-right{
      text-align: right;
    }
    .panel-info>.panel-heading {
      color: white;
      background-color: #367fa9;
      border-color: #3c8dbc;
    }
    .panel-info {
        border-color: #3c8dbc;
    }
    select{
      background-color: white;
      width: 100%;
    }
    .content-header h1{
      text-align: center;
    }
    .select2-selection{
      width: 100%
    }
    .table
    {
        overflow:auto;
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
      <h1 style="text-align:center">Data Purchase Request Detail</h1>
    </section>
    <section class="back-button content-header">
      <div class="">
        <button class="col-lg-1 col-md-2 col-sm-2 btn btn-primary" onclick="location.href='{{ url('/')}}/purchaserequest'" style="float: none; border-radius: 20px; padding-left: 0">
        <i class="fa fa-fw fa-arrow-left"></i>&nbsp;&nbsp;Back
        </button>
        <button class="col-lg-1 col-md-2 col-sm-2 btn btn-primary" onclick="window.location.reload()" style="float: right; border-radius: 20px; padding-left: 0;">
          <i class="fa fa-fw fa-refresh"></i>&nbsp;&nbsp;Refresh
        </button>  
      </div>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
              
              <div class="col-md-12">
                  <div class="panel panel-success">
      <!-- Default panel contents -->
                  <div class="panel-heading" style="height: 55px">
                    <div class="col-md-10">
                      Informasi PR Nomor : <strong>{{ $PRHeader->no }}</strong>
                    </div>
                    <div class="col-md-2">  
                    @if($PRHeader->approval[0]->approval_action_id === 1)
                      <form method="POST" action="{{ url('/')}}/purchaserequest/request_approval" name="form1" autocomplete="off">
                        <input type="" name="id" value="{{$PRHeader->id}}" hidden>
                        {!! csrf_field() !!}
                        <input type="submit" value="Request Approval" class="btn btn-primary pull-right">
                      </form> 
                      <p/>
                      
                      @endif
                    </div>
                    <p/>
                    </div>
                     @if ($PRHeader->approval[0]->approval_action_id <=> 6)
                  <button type="button" class="btn btn-info btn-sm pull-left" data-toggle="modal" data-target="#myModaleditPR" style="margin:2px 15px">Edit PR</button>

                               <div class="modal fade" id="myModaleditPR" role="dialog">
                                 
                                <div class="modal-dialog modal-lg modal-md" style="width:80%;" >
                                
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Tambah Detail</h4>
                                    </div>
                                    <div class="modal-body" id="modal" style="height: 70vh">
                                    <form action="{{ url('/')}}/purchaserequest/editPR" method="post" name="form1" autocomplete="off">
                                      {!! csrf_field() !!}
                                      <input type="" name="id" value="{{$PRHeader->id}}" hidden>
                                      <input type="" name="delivery_date" value="{{$PRHeader->butuh_date}}" hidden>
                                      <input type="" name="department_id" value="{{$PRHeader->department_id}}" hidden>
                                       <div class="form-group col-md-3">
                                        <label class="col-md-12" style="padding-left:0">Budget Tahunan</label>
                                        <select class="form-input col-md-12" list="data_department" name="budget_tahunan"  id="budget_tahunan" autocomplete="off" placeholder="Pilih Budget Tahunan" >
                                          <option value="" selected disabled>Pilih Budget Tahunan</option>
                                              @foreach($budget_no as $key => $v )
                                                <option value="{{ $v[1] }}" {{ $v[1]==$PRHeader->budget_tahunan_id ? 'selected' : '' }}>{{ $v[0]}}</option>
                                              @endforeach
                                        </select>
                                        </div>
                                        <div id="form_waktu_dibutuhkan" class="form-group col-md-3">
                                          <label class="col-md-12" style="padding-left:0">Waktu dibutuhkan</label>
                                          <input class="form-input col-md-12" type="date" name="butuh_date" min="<?=$date?>" value="{{ $PRHeader->butuh_date }}" style="padding-left:15px" required> 
                                        </div>
                                        <div id="form_diskripsi_umum" class="form-group col-md-10">
                                          <label class="col-md-12" style="padding-left:0">Deskripsi Umum</label>
                                          <textarea name="deskripsi_umum" class="form-input col-md-12" required>{{ $PRHeader->description }}</textarea>
                                        </div>
                                        <div id="form_is_urgent" class="form-group col-md-2">
                                          <label class="col-md-12" style="padding-left:0">Mendadak (Urgent)</label>
                                          <div class="radio">
                                            <label><input type="radio" name="is_urgent" value="1">Ya</label>
                                          </div>
                                          <div class="radio">
                                            <label><input type="radio" name="is_urgent" value="0" checked>Tidak</label>
                                          </div>
                                        </div>
                                    <div class="modal-footer">
                                      <input type="submit" value="Edit" class="btn btn-primary pull-right">              
                                    </div>
                                    </form>
                                  </div>
                                  
                                </div>
                              </div>
                              
                            </div>
                  @endif
                    <br/>
                  <!-- List group -->
                  
                  <div class="panel-body">


                  <div class="col-md-6">
                      <div class="panel-body">

                        <label>PR Info</label>
                      </div>
                      <ul class="list-group">
                       
                        <li class="list-group-item">Department : <strong>{{ $PRHeader->department->name }}</strong></li>
                        <li class="list-group-item">PT : <strong>{{ $PRHeader->pt->name }}</strong></li>
                        @if($PRHeader->approval[0]->status->description == "approved")
                          <li class="list-group-item">Status : <strong style="color:green;">{{ strtoupper($PRHeader->approval[0]->status->description) }}</strong></li>
                          @elseif($PRHeader->approval[0]->status->description == "delivered")
                          <li class="list-group-item">Status : <strong style="color:yellow;">{{ strtoupper($PRHeader->approval[0]->status->description) }}</strong></li>
                          @elseif($PRHeader->approval[0]->status->description == "partial approved")
                          <li class="list-group-item">Status : <strong style="color:#40E0D0;">{{ strtoupper($PRHeader->approval[0]->status->description) }}</strong></li>
                          @elseif($PRHeader->approval[0]->status->description == "open")
                          <li class="list-group-item">Status : <strong style="color:black;">{{ strtoupper($PRHeader->approval[0]->status->description) }}</strong></li>
                          @elseif($PRHeader->approval[0]->status->description == "rejected")
                          <li class="list-group-item">Status : <strong style="color:red;">{{ strtoupper($PRHeader->approval[0]->status->description) }}</strong></li>
                        @endif
                        <li class="list-group-item">Tanggal PR Dibuat : <strong>{{ $PRHeader->date }}</strong></li>
                        <li class="list-group-item">Tanggal Dibutuhkan : <strong>{{ $PRHeader->butuh_date }}</strong></li>
                      </ul>
                  </div>
                  <div class="col-md-6">
                    <div class="panel-body">
                      <label>Budget Info</label>
                    </div>
                    <ul class="list-group">
                      <li class="list-group-item" name="budget_tahunan" id="budget_tahunan" value="{{ $PRHeader->budget->no }}">Nomor Budget : <strong>{{ $PRHeader->budget->no }}</strong ></li>
                      <li class="list-group-item">Tahun Budget : <strong>{{ $PRHeader->budget->tahun_anggaran }}</strong></li>
                      <li class="list-group-item">Deskripsi Budget : <strong>{{ $PRHeader->budget->description or 'Kosong' }}</strong></li>

                      <li class="list-group-item">Sisa Budget Sebelum : <strong>{{ $total or 'Kosong' }}</strong></li>
                       <li class="list-group-item">Pengguna Budget Terakhir : <strong>{{ $pengguna_terakhir->department->name or 'Kosong' }}</strong></li>
                       <li class="list-group-item">Jumlah Digunakan terakhir untuk SPK/PO: <strong>{{$totalTerakhir}} </strong></li>
                       <!-- <li class="list-group-item"> Summary:  <strong>Rp. {{$total}}</strong></li> -->
                    </ul>
                  </div>
                  @if ($PRHeader->approval[0]->approval_action_id <=> 6)
                  <button type="button" class="tambah-detail btn btn-info btn-sm pull-left" data-toggle="modal">tambah Item</button>
                               
                  @endif
                </div>
                </div>
              </div>
            </div>
                @if($approve)
                <div class="row" style="padding-bottom: 20px;margin: 0px 15px">
                  <a href="{{ url('/')}}/purchaserequest/approve/?id={{$pr_id}}&type=approveAll" class="btn btn-success col-md-1 col-md-offset-10">Approve All</a>
                  <a href="{{ url('/')}}/purchaserequest/approve/?id={{$pr_id}}&type=cancelAll" class="btn btn-danger" style="width:7%;margin-left: 1%">Cancel All</a>
                </div>
                @endif
              <table id="table_details" class="table table-bordered table-hover">
                <thead style="background-color: greenyellow;">
                <tr>
                  <th rowspan="2" >Category</th>
                  <th rowspan="2" >Item Pekerjaan</th>
                  <th rowspan="2" >Item</th>
                  <th rowspan="2" >Kode Item</th>
                  <th rowspan="2" >Brand</th>
                  <th rowspan="2" >Qty</th>
                  <th rowspan="2" >Satuan</th>
                  <th colspan="3" class="text-center">Rekomendasi Supplier</th>
                  <th rowspan="2">Deskripsi</th>
                  <th rowspan="2">Status</th>
                  @if($approve)
                  <th rowspan="2">Action</th>
                  @endif
                  <th rowspan="2"></th>
                  <th rowspan="2"></th>
                </tr>
                  <tr>
                    <th>Supplier 1</th>
                    <th>Supplier 2</th>
                    <th>Supplier 3</th>
                  </tr>
                </thead>
                <tbody>
                   @php ($i=0)
                    @foreach($PR as $key => $value )
                    @php ($i++)
                    <tr>

                        <td>{{is_null($value->item_project->item->sub_category) ? $value->item_project->item->category->name : $value->item_project->item->sub_category->name}}</td>
                        <td>{{ $value->item_pekerjaan->code }} - {{$value->item_pekerjaan->name or 'Kosong'}}</td>
                        <td>{{$value->item_project->item->name or 'Kosong'}}</td>
                        <td>{{$value->item_project->item->kode or 'Kosong'}}</td>
                        <td>{{$value->brand->name or 'Kosong'}}</td>
                        <td class="table-align-right">{{$value->quantity}}</td>
                        <td>{{$value->item_satuan->name or 'Kosong'}}</td>
                        <td>{{$value->rec1->name or 'Kosong'}}</td>
                        <td>{{$value->rec2->name or 'Kosong'}}</td>
                        <td>{{$value->rec3->name or 'Kosong'}}</td>
                        <td>{{$value->description}}</td>
                         @if($value->approval[0]->status->description == "approved")
                          <td><strong style="color:green;">{{ strtoupper($value->approval[0]->status->description) }}</strong></td>
                          @elseif($value->approval[0]->status->description == "delivered")
                          <td><strong style="color:yellow;">{{ strtoupper($value->approval[0]->status->description) }}</strong></td>
                          @elseif($value->approval[0]->status->description == "partial approved")
                          <td><strong style="color:#40E0D0;">{{ strtoupper($value->approval[0]->status->description) }}</strong></td>
                          @elseif($value->approval[0]->status->description == "open")
                          <td><strong style="color:black;">{{ strtoupper($value->approval[0]->status->description) }}</strong></td>
                          @elseif($value->approval[0]->status->description == "rejected")
                          <td><strong style="color:red;">{{ strtoupper($value->approval[0]->status->description) }}</strong></td>
                        @endif
                        @if($approve)
                          @if($value->approval[0]->approval_action_id == 6)
                            <td><a href="{{ url('/')}}/purchaserequest/approve/?id={{$value->id}}&type=cancel&pr_id={{$value->purchaserequest_id}}" class="btn btn-danger col-md-12">UnApprove</a></td>
                          @else
                            <td><a href="{{ url('/')}}/purchaserequest/approve/?id={{$value->id}}&type=approve&pr_id={{$value->purchaserequest_id}}" class="btn btn-success col-md-12">Approve</a><a href="{{ url('/')}}/purchaserequest/approve/?id={{$value->id}}&type=approve&pr_id={{$value->purchaserequest_id}}" class="btn btn-danger col-md-12">Reject</a></td>
                          @endif
                        @endif
                        <td >@if ($value->approval[0]->approval_action_id <=> 6)
                            <!--  <button type="button" class="edit-modal btn btn-info btn-sm btnedit" data-toggle="modal" data-target="#myModal{{$i}}" id="mb{{$i}}">Edit</button> -->
                             <button class="edit-modal btn btn-info" data-id="{{$value->id}}" data-parentcategory="{{$value->item_project->item->item_category_id}}" data-category="{{$value->item_project->item->sub_item_category_id}}" data-item="{{$value->item_id}}" data-brand="{{$value->brand_id}}" data-kuantitas="{{$value->quantity}}" data-satuan="{{$value->item_satuan_id}}" data-komparasi="{{$value->recomended_supplier}}" data-rec1="{{$value->rec_1}}" data-rec2="{{$value->rec_2}}" data-rec3="{{$value->rec_3}}" data-coa="{{$value->itempekerjaan_id}}" data-deskripsi="{{$value->description}}">
                             
                            <span class="glyphicon glyphicon-edit"></span> Edit</button>
                            @endif

                             
                        </td>
                        <td>@if ($value->approval[0]->approval_action_id <=> 6)
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModaldelete{{$i}}">Delete</button>

                          <!-- Modal -->
                            <div class="modal fade" id="myModaldelete{{$i}}" role="dialog">
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Delete</h4>
                                  </div>
                                  <div class="modal-body">
                                    <p>Are you sure you wish to delete 1 row?</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Tutup</button>
                                    <a type="submit" href="{{ url('/')}}/purchaserequest/delete_detail/?id={{$value->id}}&&PR={{$PRHeader->id}}" class="btn btn-danger pull-right btn-xs btn-delete" data-value="{{ $value->id }}"><i class="fa fa-times"></i> Hapus</a>
                                  </div>
                                </div>

                              </div>
                            </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <!-- <tfoot>
                      <tr>
                  <th rowspan="2">Category</th>
                  <th rowspan="2" >Item Pekerjaan</th>
                  <th rowspan="2" >Item</th>
                  <th rowspan="2" >Kode Item</th>
                  <th rowspan="2" >Brand</th>
                  <th rowspan="2" >Qty</th>
                  <th rowspan="2" >Satuan</th> -->
                  <!-- <th colspan="3" class="text-center">Rekomendasi Supplier</th> -->
                 <!--  <th rowspan="2">Deskripsi</th>
                  <th rowspan="2">Status</th>
                  @if($approve)
                  <th rowspan="2">Action</th>
                  @endif
                  <th rowspan="2"></th>
                  <th rowspan="2"></th>
                </tr>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                  </tfoot> -->
                </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

<!--         </div>
        /.col
      </div> -->
      <!-- /.row -->
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

<div class="modal fade" id="myModaltambah" role="dialog">
                                 
    <div class="modal-dialog modal-lg modal-md" style="width:80%;" >
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" onclick="window.location.reload()">&times;</button>
          <h4 class="modal-title">Tambah Detail</h4>
        </div>
        <div class="modal-body" id="modal" style="height: auto">
        <form action="{{ url('/')}}/purchaserequest/tambah" method="post" name="form1" autocomplete="off">
          {!! csrf_field() !!}
          <input type="" name="id" value="{{$PRHeader->id}}" hidden>
          <input type="" name="delivery_date" value="{{$PRHeader->butuh_date}}" hidden>
          <input type="" name="department_id" value="{{$PRHeader->department_id}}" hidden>
          <div id="list_item" class="col-md-12">
                <div id="list_item" class="col-md-12">
                <div class="sub_list_item form-group col-md-12 panel panel-info">
                <!-- <div class="form-group panel-heading"> Item 1 </div> -->

                <div class="form-group col-md-3">
                  <label class="col-md-12" style="padding-left:0">Kategori</label>
                  <select class="form-control col-md-12 parentcategory_data" name="parentcategory_name[]" id="sub_category_1 parentcategory_name" placeholder="Pilih Item" style="width: 100%" required>
                    <option value="0">All Kategori</option>
                    @foreach($parent_categories as $key => $value)
                      <option data-value="{{ $value['items'] }}" value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                  </select>
                </div>
                
                <div class="form-group col-md-3">
                  <label class="col-md-12" style="padding-left:0">Sub Kategori</label>
                  <select class="form-control col-md-12 category_data" name="category_name[]" id="sub_category_1 category_name" placeholder="Pilih Item" style="width: 100%" required>
                    <option value="0">Sub Kategori</option>
                    @foreach($categories as $key => $value)
                      <option data-value="{{ $value['items'] }}" value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-md-3">
                  <label class="col-md-12" style="padding-left:0">Item</label>
                  <select class="form-control col-md-12 item_data" name="item[]" id="item_id_1 item_id" placeholder="Pilih Item" style="width: 100%" required>
                    <option value="0">All Item</option>
                    @foreach($item_result as $key => $value)
                      <option data-value="{{ $value['category'] }}" value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="col-md-12" style="padding-left:0">Brand</label>
                  <select class="col-md-12 form-control brand_id" id="brand_id" list="data_brand" name="brand[]" autocomplete="off" placeholder="Pilih Brand" style="width: 100%" required>
                    
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label class="col-md-12" style="padding-left:0">Qty</label>
                  <input id="kuantitas1" name="kuantitas[]" type="number" class="form-input col-md-12" placeholder="Input" min="1" style="width: 100%" required>
                </div>
                <div class="form-group col-md-2">
                  <label class="col-md-12" style="padding-left:0">Satuan</label>
                  <select id="satuan_item1" name="satuan[]" class="form-input col-md-12 satuan_item" style="width: 100%" required>
                  </select>
                </div>
                <div id="form_jumlah_komparasi_supplier" class="form-group col-md-12 ">
                  <label class="col-md-12" style="padding-left:0">Jumlah Komparasi Supplier</label>
                      <select id="" name="j_komparasi[]" class="form-input jumlah_komparasi1 col-md-12" onchange="banyak_komparasi(1)" required>
                        <option value="-1" selected disabled>Pilih jumlah suplier (1 - 3)</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                      </select>
                </div>
                <div id="" class="form_komparasi_supplier_1_item1 form-group" hidden>
                  <label class="col-md-12" style="padding-left:0">Komparasi Supplier 1</label>
                  <select id="komparasi_supplier_1" name="komparasi_supplier1_1[]" class="form-input col-md-12" onchange="recomended_supplier(this.value, this.options[this.selectedIndex].text,1,1)" required>
                    <option selected disabled>Pilih Komparasi Supplier 1</option>
                    @foreach($rekanan_group as $key => $value )
                    <option value="{{ $value->id }}">{{ $value->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div id="" class="form_komparasi_supplier_2_item1 form-group" hidden>
                  <label class="col-md-12" style="padding-left:0">Komparasi Supplier 2</label>
                  <select id="komparasi_supplier_2" name="komparasi_supplier1_2[]" class="form-input col-md-12" onchange="recomended_supplier(this.value, this.options[this.selectedIndex].text,2,1)">
                    <option selected disabled>Pilih Komparasi Supplier 2</option>
                    @foreach($rekanan_group as $key => $value )
                    <option value="{{ $value->id }}">{{ $value->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div id="" class="form_komparasi_supplier_3_item1 form-group" hidden>
                  <label class="col-md-12" style="padding-left:0">Komparasi Supplier 3</label>
                  <select id="komparasi_supplier_3" name="komparasi_supplier1_3[]" class="form-input col-md-12" onchange="recomended_supplier(this.value, this.options[this.selectedIndex].text,3,1)">
                    <option selected disabled>Pilih Komparasi Supplier 3</option>
                    @foreach($rekanan_group as $key => $value )
                    <option value="{{ $value->id }}">{{ $value->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-12">
                  <label class="col-md-12" style="padding-left:0">Kode Coa | Item Pekerjaan</label>
                  <select id="data_itempekerjaan1" class="data_itempekerjaan form-input col-md-12" name="coa[]" placeholder="Pilih Item Pekerjaan" required>
                    @foreach($coa as $key => $v )
                            <option value="{{ $v->id }}" {{ $v->id == $PRHeader->budget->itempekerjaan_id ? 'selected' : ''}}>{{ $v->name}}  | {{$v->code}}</option>
                    @endforeach
                  </select>
                </div>
                <div id="form_deskripsi_umum" class="form-group col-md-12">
                  <label class="col-md-12" style="padding-left:0">Deskripsi Item</label>
                  <textarea id="deskripsi_item1" name="deskripsi_item[]" class="form-input col-md-12 item_desk" required></textarea>
                </div>
                </div>
                </div>
              </div>

        <div class="modal-footer">
          <button type="button" id="close" class="btn btn-default" data-dismiss="modal" onclick="window.location.reload()">Tutup</button>
          <input type="submit" value="tambah" class="btn btn-primary pull-right">              
        </div>
        </form>
      </div>
      
    </div>
  </div>
  
</div>


<div class="modal fade" id="editModal" role="dialog">
 
<div class="modal-dialog modal-lg modal-md" style="width:80%;" >

  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" onclick="window.location.reload()">&times;</button>
      <h4 class="modal-title">Edit Detail</h4>
    </div>
    <div class="modal-body" id="modal{{$i}}">
    <form action="{{ url('/')}}/purchaserequest/edit_pr" method="post" name="form1" autocomplete="off">
      {!! csrf_field() !!}
      <input type="" name="id" value="{{$PRHeader->id}}" hidden>
      <input type="" name="department_id" value="{{$PRHeader->department_id}}" hidden>
<!--       <input type="" name="details_id" value="{{$PRHeader->id}}" hidden>
 -->     <div id="list_item" class="col-md-12">
        <div class="sub_list_item form-group col-md-12 panel panel-info">
        <input id="details_id" type="" name="details_id[]" value="" hidden>

         <div class="form-group col-md-3">
              <label class="col-md-12" style="padding-left:0">Kategori</label>
              <select class="form-control col-md-12 parentcategory_data" name="parentcategory_name[]" id="parentcategory_name" placeholder="Pilih Item" style="width: 100%" required>
                <option value="0">All Kategori</option>
                @foreach($parent_categories as $key => $v)
                  <option value="{{ $v->id }}">{{ $v->name }}</option>
                @endforeach
              </select>
          </div>

        <div class="form-group col-md-3">
                <label class="col-md-12" style="padding-left:0">Sub Kategori</label>
                <select class="form-control col-md-12 category_data" name="category_name[]" id="category_name" placeholder="Pilih Item"  style="width: 100%" required>
                  <option value="0">All Sub Kategori</option>
                   @foreach($categories as $key => $v)
                    <option value="{{ $v->id }}">{{ $v->name }}</option>
                  @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label class="col-md-12" style="padding-left:0">Item</label>
                <select class="form-control col-md-12 item_data" name="item[]" id="item_name" placeholder="Pilih Item" style="width: 100%"  required>
                  <option value="0">All Item</option>
                   @foreach($item_result as $key => $v)
                    <option value="{{ $v['id'] }}">{{ $v['name'] }}</option>
                  @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label class="col-md-12" style="padding-left:0">Brand</label>
                  <select class="col-md-12 form-control brand_id" id="brand_idForm" list="data_brand" name="brand[]" placeholder="Pilih Brand" style="width: 100%" required>
                    @foreach($brand as $key => $v)
                    <option value="{{ $v->id }}">{{ $v->name }}</option>
                     @endforeach
                  </select>
            </div>
            <div class="form-group col-md-2">
                <label class="col-md-12" style="padding-left:0">Qty</label>
               <input id="kuantitas" name="kuantitas[]" type="number" value="" class="form-input col-md-12" placeholder="Input" min="1" required>
            </div>
            <div class="form-group col-md-2">
                <label class="col-md-12" style="padding-left:0">Satuan</label>
                <select id="satuan_item" name="satuan[]" class="form-input col-md-12 satuan_item" style="width: 100%" required>
                @foreach($item_satuan as $key => $v)
                <option value="{{ $v->id }}">{{ $v->name }}</option>
                @endforeach
                </select>
            </div>
             <div id="form_jumlah_komparasi_supplier" class="form-group col-md-12 ">
                <label class="col-md-12" style="padding-left:0">Jumlah Komparasi Supplier</label>
                <select id="komparasi" name="j_komparasi[]" class="form-input jumlah_komparasi2 col-md-12" onchange="banyak_komparasi(2)" style="width: 100%" required>
                  @for ($j = 1; $j < 4; $j++)
                    <option value="{{$j}}">{{$j}}</option>
                  @endfor
                </select>
            </div>
            <div id="" class="col-md-4 form_komparasi_supplier_1_item2 form-group" hidden>
                <label class="col-md-12" style="padding-left:0">Komparasi Supplier 1</label>
                <select id="supplier_1" name="komparasi_supplier2_1[]" class="form-input col-md-12" onchange="recomended_supplier(this.value, this.options[this.selectedIndex].text,1,2)" style="width: 100%" required>
                  <option selected disabled>Pilih Komparasi Supplier 1</option>
                   @foreach($rekanan_group as $key => $v )
                      <option value="{{ $v->id }}">{{ $v->name}}</option>
                    @endforeach
                </select>
            </div>
             <div id="" class="col-md-4 form_komparasi_supplier_2_item2 form-group" hidden>
                  <label class="col-md-12" style="padding-left:0">Komparasi Supplier 2</label>
                  <select id="supplier_2" name="komparasi_supplier2_2[]" class="form-input col-md-12" onchange="recomended_supplier(this.value, this.options[this.selectedIndex].text,2,2)"style="width: 100%">
                    <option selected disabled>Pilih Komparasi Supplier 2</option>
                      @foreach($rekanan_group as $key => $v )
                        <option value="{{ $v->id }}">{{ $v->name}}</option>
                      @endforeach
                  </select>
              </div>
              <div id="" class="col-md-4 form_komparasi_supplier_3_item2 form-group" hidden>
                  <label class="col-md-12" style="padding-left:0">Komparasi Supplier 3</label>
                  <select id="supplier_3" name="komparasi_supplier2_3[]" class="form-input col-md-12" onchange="recomended_supplier(this.value, this.options[this.selectedIndex].text,3,2)" style="width: 100%">
                      <option selected disabled>Pilih Komparasi Supplier 3</option>
                      @foreach($rekanan_group as $key => $v )
                        <option value="{{ $v->id }}">{{$v->name}}</option>
                      @endforeach
                </select>
              </div>
              <div class="form-group col-md-12">
                  <label class="col-md-12" style="padding-left:0">Kode Coa | Item Pekerjaan</label>
                  <select id="data_itempekerjaan" class="data_itempekerjaan form-input col-md-12" name="coa[]" placeholder="Pilih Item Pekerjaan" style="width: 100%" required>
                    @foreach($coa as $key => $v )
                        <option value="{{ $v->id }}">{{ $v->name}} | {{$v->code}}</option>
                    @endforeach
                  </select>
              </div>
              <div id="form_deskripsi_umum" class="form-group col-md-12" style="margin-bottom:10px">
                  <label class="col-md-12" style="padding-left:0">Deskripsi Item</label>
                  <textarea id="deskripsi_item" name="deskripsi_item[]" class="form-input col-md-12 item_desk" required>{{ $value->description }}</textarea>
              </div>
      </div>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal" onclick="window.location.reload()">Tutup</button>
      <input type="submit" value="Ubah" class="btn btn-primary pull-right">              
    </div>
    </form>
  </div>
  
</div>
</div>

</div>
<!-- ./wrapper -->

@include("master/footer_table")
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script type="text/javascript">
      $.ajaxSetup({
    headers: {
                  'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                }
    });
  $(document).ready(function()
  {

    // $('select').select2({ width: '100%' });
      $('#table_details').DataTable({
          // .columns.adjust();
          scrollY: "500px",
          scrollX:true,
          scrollCollapse: true,
          paging: false,
          "columnDefs": [
            { "visible": false, "targets": 0 }
          ],
          "order": [[ 0, 'asc' ]],
          "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group" style="background-color: #3FD5C0;""><td colspan="13"><strong>'+group+'</strong></td></tr>'
                    );
 
                    last = group;
                }
            } );
        },
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option>Pilih</select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
      });     
        $('select').select2({
            dropdownAutoWidth : true,
            width: '100%'
        })
 
  });

  // $(document).ready(function() {
  //   $('#table_details').DataTable( {
  //       initComplete: function () {
  //           this.api().columns().every( function () {
  //               var column = this;
  //               var select = $('<select><option value=""></option></select>')
  //                   .appendTo( $(column.footer()).empty() )
  //                   .on( 'change', function () {
  //                       var val = $.fn.dataTable.util.escapeRegex(
  //                           $(this).val()
  //                       );

  //                       column
  //                           .search( val ? '^'+val+'$' : '', true, false )
  //                           .draw();
  //                   } );

  //               column.data().unique().sort().each( function ( d, j ) {
  //                   select.append( '<option value="'+d+'">'+d+'</option>' )
  //               } );
  //           } );
  //       }
  //   } );
  // } );

   const item_struct = $("#list_item");
    var list_recomended_supplier= [];
    const a=item_struct[0].innerHTML;
    var jumlah_item_old = 1;
    var list_satuan = <?php echo($item_satuan)?> ;
    //var list_itempekerjaan = 
    //var list_item = ;
    var budget = <?=$budget?>;
    var budget_tahunan = <?=$budget_tahunan?>;
    var budget_tahunan_detail = <?=$budget_tahunan_detail?>;
    var input_budget = <?=$input_budget_tahunan?>;
    function banyak_komparasi(item){
        $(".form_komparasi_supplier_1_item"+item).removeClass('col-md-12 col-md-6 col-md-4');
        $(".form_komparasi_supplier_2_item"+item).removeClass('col-md-12 col-md-6 col-md-4');
        $(".form_komparasi_supplier_3_item"+item).removeClass('col-md-12 col-md-6 col-md-4');
        $(".form_komparasi_supplier_1_item"+item,".form_komparasi_supplier_2_item"+item,".form_komparasi_supplier_3_item"+item).prop('selectedIndex',0);
        $(".form_komparasi_supplier_1_item"+item).hide();
        $(".form_komparasi_supplier_2_item"+item).hide();
        $(".form_komparasi_supplier_3_item"+item).hide();
        for(i=1;i<=$(".jumlah_komparasi"+item).val();i++){
            $(".form_komparasi_supplier_"+i+"_item"+item).addClass('col-md-'+12/$(".jumlah_komparasi"+item).val());
            $(".form_komparasi_supplier_"+i+"_item"+item).show();
        }
        for(i=1;i<=3;i++)
            if($(".form_komparasi_supplier_"+i+"_item"+item).is(":hidden"))
                $('.form_komparasi_supplier_'+i+'_item'+item+'option:first').prop('selected',true);
        if($(".jumlah_komparasi"+item).val() == 2)
            list_recomended_supplier.splice(2,1);
        if($(".jumlah_komparasi"+item).val() == 1){
            list_recomended_supplier.splice(2,1);
            list_recomended_supplier.splice(1,1);
        }
    }
function filter_budget(val){
      var val = val.substr(0,val.indexOf(" -"));
    }
    function recomended_supplier(val,txt,ind,item){
      console.log(txt);
        list_recomended_supplier[ind] = [val,txt];
      console.log(list_recomended_supplier[ind]);
        for(var j = 1;j<=3;j++){
          
          $("select[name='komparasi_supplier"+item+"_"+j+"[]']").find('option').each(function(){
            $(this).attr("disabled",false);
          });
        }
        for(var i = 1;i<=3;i++){
            val = $("select[name='komparasi_supplier"+item+"_"+i+"[]']").val();
            if(val != null){
                for(var j = 1;j<=3;j++){
                    if(j != i){
                        $("select[name='komparasi_supplier"+item+"_"+j+"[]']").find('option').each(function(){
                            if($(this).val() == val){
                                $(this).attr("disabled",true);
                            }
                        });
                    }
                }
            }

        }
        $("select").select2();
    }

    function create_componen_supplier(value,text){
        var div = document.createElement("div");
        var label = document.createElement("label");
        var input = document.createElement("input");
        input.name = "rs[]";
        input.type = "checkbox";
        input.value = value;
        label.innerHTML = text;
        label.innerHTML = input.outerHTML + label.innerHTML;
        div.classList.add("checkbox");
        div.innerHTML = label.outerHTML;
        return div;
    }
    function filter_satuan(val,item){
        var id_item = val.substr(0,val.indexOf(" -"));
        $(".satuan_item"+item).append(option);
        $(".satuan_item"+item).empty();
        for(var i = 0; i < list_satuan.length;i++){
            if(list_satuan[i].item_id == id_item){
                var option = document.createElement("option");
                option.value = list_satuan[i].id;
                option.innerHTML = list_satuan[i].name;
                $(".satuan_item"+item).append(option);
            }
        }
    }
    function filter_itempekerjaan(val,val2){
        if(val2){
          $("#"+val2).empty();
          var tmp       = document.createElement("option");
          tmp.value     = "";
          tmp.innerHTML = "Pilih Item Pekerjaan";
          tmp.setAttribute("disabled","true");
          tmp.setAttribute("selected","true");
          $("#"+val2).append(tmp);
          for(var i=0;i<budget.length;i++){
            if(budget[i].btId == val){
              var tmp       = document.createElement("option");
              tmp.value     = budget[i].btdItemPekerjaan;
              tmp.innerHTML = budget[i].ipName;
              $("#"+val2).append(tmp);
            }
          }
        }else{
          $(".data_itempekerjaan").empty();
          var tmp       = document.createElement("option");
          tmp.value     = "";
          tmp.innerHTML = "Pilih Item Pekerjaan";
          tmp.setAttribute("disabled","true");
          tmp.setAttribute("selected","true");
          $(".data_itempekerjaan").append(tmp);
          for(var i=0;i<budget.length;i++){
            if(budget[i].btId == val){
              var tmp       = document.createElement("option");
              tmp.value     = budget[i].btdItemPekerjaan;
              tmp.innerHTML = budget[i].ipName;
              $(".data_itempekerjaan").append(tmp);
            }
          }
        }
    }


    function isi_deskripsi_umum(val){
        $("textarea[name='deskripsi_umum']").val(val);
    }
    function isi_deskripsi_item(val,item){
        $("#deskripsi_item"+item).val(val);
    }

    


    $(document).ready(function(){

      var url = "{{ url('/')}}/purchaserequest/getBudgetTahunan";
      var item = $("#budget_tahunan");
      $('#department').change(function(){
        var send = parseInt($(this).val())+"|"+<?=$project->id?>;
        var getjson = $.getJSON(url + '/' + send, function (data) {
          item.addClass("item");
          item.empty();
          var option        = document.createElement("option");
          option.value      = "";
          option.innerHTML  = "Pilih Budget Tahunan";
          option.setAttribute("disabled","true");
          option.setAttribute("selected","true");
          item.append(option);
          for(var i = 0; i <= data.length ; i++){
            if(i<data.length){
              var option        = document.createElement("option");
              option.value      = data[i].id;
              option.innerHTML  = data[i].no;
              item.append(option);
            }else
              item.removeClass("item");
          }
          
        }); 
      });

      $(document).on('change','.parentcategory_data',function(){
       var category_id = $(this).val();
          var _url = "{{ url('/purchaserequest/changeCategoryBaseParent') }}";
          var _data = { parent:category_id };
          var parent_div = $(this).parents('.sub_list_item');
          $.ajax({
              type:'post',
              dataType:'json',
              url:_url,
              data:_data,
              beforeSend:function()
              {
                waitingDialog.show();

              },
              success:function(data)
              {
                  var strItemOption ='';
                
                  if(data.items != null)
                  {
                    parent_div.find('.item_data').find('option').remove();
                    strItemOption +='<option value="0">All Item</option>';
                    $(data.items).each(function(i,v)
                    {
                        strItemOption+='<option value="'+v.itemid+'"">'+v.itemname+'</option>';
                    });
                    parent_div.find('.item_data').append(strItemOption);
                  }
                  
                  if(data.all_categories != null)
                  {
                    parent_div.find('.category_data').find('option').remove();
                      strItemOption='';
                      strItemOption+='<option value="0">All Sub Kategori</option>';
                      $(data.all_categories).each(function(i,v){
                      strItemOption+='<option value="'+v.id+'">'+v.name+'</option>';
                    });
                      
                    parent_div.find('.category_data').append(strItemOption);
                  }



                   if(data.parent_categories != null)
                  {
                    parent_div.find('.parentcategory_data').find('option').remove();
                      strItemOption='';
                      strItemOption+='<option value="0">All Kategori</option>';
                      $(data.parent_categories).each(function(i,v){
                      strItemOption+='<option value="'+v.id+'">'+v.name+'</option>';
                    });
                      
                    parent_div.find('.parentcategory_data').append(strItemOption);
                  }

              },
              complete:function()
              {
                waitingDialog.hide();
              }
          });
      });

      $(document).on('change','.category_data',function(){
          var category_id = $(this).val();
          var _url = "{{ url('/purchaserequest/changeItemBaseCategory') }}";
          var _data = { category_id:category_id };
          var parent_div = $(this).parents('.sub_list_item');
          $.ajax({
              type:'post',
              dataType:'json',
              url:_url,
              data:_data,
              beforeSend:function()
              {
                waitingDialog.show();

              },
              success:function(data)
              {
                  var strItemOption ='';
                
                  if(data.items != null)
                  {
                    parent_div.find('.item_data').find('option').remove();
                    strItemOption +='<option value="0">All Item</option>';
                    $(data.items).each(function(i,v)
                    {
                        strItemOption+='<option value="'+v.itemid+'"">'+v.itemname+'</option>';
                    });
                    parent_div.find('.item_data').append(strItemOption);
                  }
                  
                  if(data.all_categories != null)
                  {
                    parent_div.find('.category_data').find('option').remove();
                      strItemOption='';
                      strItemOption+='<option value="0">All Sub Kategori</option>';
                      $(data.all_categories).each(function(i,v){
                      strItemOption+='<option value="'+v.id+'">'+v.name+'</option>';
                    });
                      
                    parent_div.find('.category_data').append(strItemOption);
                  }

                  if(data.parent_categories != null)
                  {
                    parent_div.find('.parentcategory_data').find('option').remove();
                      strItemOption='';
                      strItemOption+='<option value="0">All Kategori</option>';
                      var id = 0;
                      $(data.parent_categories).each(function(i,v){
                      strItemOption+='<option value="'+v.id+'">'+v.name+'</option>';
                      id = v.id;
                    });
                      
                    parent_div.find('.parentcategory_data').append(strItemOption);
                    parent_div.find('.parentcategory_data').val(id);
                    if(category_id == 0){
                      parent_div.find('.parentcategory_data').val(0).trigger('change.select2');
                    }                                   
                  }




              },
              complete:function()
              {
                waitingDialog.hide();
              }
          });
      });

      $(document).on('change','.item_data',function()
      {
          var item_desk = $(this).val();
          var Eparent = $(this).parents('.sub_list_item');
          var item_split = $(this).val().split("-");
          var getItemId = item_split[0].trim();
          var _url = "{{ url('/purchaserequest/changeBrand') }}"
          $.ajax({
            type:'post',
            dataType:'json',
            url:_url,
            data:{id:getItemId},
            beforeSend:function()
            {
              waitingDialog.show();
            },
            success:function(data)
            {

              Eparent.find('.brand_id').find('option').remove();
              Eparent.find('.satuan_item').find('option').remove();
              Eparent.find('.category_data').find('option').remove();
              Eparent.find('.parentcategory_data').find('option').remove();

              var strHtml = '';
              if(data.brands != null)
              {
                 strHtml+='<option value="0">All Brands</option>';
                  $(data.brands).each(function(i,v)
                  {
                      strHtml+='<option value="'+v.id+'">'+v.name+'</option>';
                  });
                  Eparent.find('.brand_id').append(strHtml);
              }
             
             if(data.satuans != null)
             {
                strHtml='';
                $(data.satuans).each(function(i,v)
                {
                  strHtml+='<option value="'+v.id+'">'+v.name+'</option>';
                });

                Eparent.find('.satuan_item').append(strHtml);
             }
            
            if(data.categories != null)
            {
                strHtml ='';
                strHtml+='<option value="0">All Sub Kategori</option>';
                var id_category = 0;
                $(data.categories).each(function(i,v){
                  strHtml+='<option value="'+v.id+'">'+v.name+'</option>';
                  id_category = v.id;
                });
                Eparent.find('.category_data').append(strHtml);
                Eparent.find('.category_data').val(id_category);
                if(item_desk == 0){
                  Eparent.find('.category_data').val(0).trigger('change.select2');
                }
                
              }

            if(data.parent_categories != null)
            {
                strHtml ='';
                strHtml+='<option value="0">All Kategori</option>';
                var id_category = 0;
                $(data.parent_categories).each(function(i,v){
                  strHtml+='<option value="'+v.id+'">'+v.name+'</option>';
                  id_category = v.id;
                });
                Eparent.find('.parentcategory_data').append(strHtml);
                Eparent.find('.parentcategory_data').val(id_category);
                if(item_desk == 0){
                  Eparent.find('.parentcategory_data').val(0).trigger('change.select2');
                }
                
              }

              if(data.items != null)
            {
                strHtml ='';
                Eparent.find('.item_data').find('option').remove();
                    strHtml +='<option value="0">All Item</option>';
                    $(data.items).each(function(i,v)
                    {
                        strHtml+='<option value="'+v.itemid+'"">'+v.itemname+'</option>';
                    });
                    Eparent.find('.item_data').append(strHtml);
              }

              // Eparent.find('.item_desk').val('Spesifikasi & Deskripsi'+item_split[1]);
            },
            complete:function()
            {
              waitingDialog.hide();
            }
          });

      });

      $('#budget_tahunan').change(function()
      {
          var budget_id = $(this).val();
          var _url = "{{  url('/purchaserequest/filter_item_pekerjaan') }}";
          var _data = {  id:budget_id };
          $.ajax({
            type:'post',
            dataType:'json',
            url:_url,
            data:_data,
            beforeSend:function()
            {
                waitingDialog.show();
            },
            success:function(data)
            {
              var strOption = '';
              strOption +='<option value="">Pilih Item Pekerjaan</option>';
              $(data).each(function(i,v)
              {
                  strOption+='<option value="'+v.id+'">'+v.itempekerjaan+" | "+v.code+'</option>';
              });

              $('.data_itempekerjaan').find('option').remove();
              $('.data_itempekerjaan').append(strOption);
            },
            complete:function()
            {
                waitingDialog.hide();
            }
          });
      });


      $(document).on('click','.btn-delete',function()
      {
          var id = $(this).attr('data-value');
          var parent = $(this).parents('.list_item');
          var _url = "{{  url('/purchaserequest/delete_detail') }}";
          var _data = { id:id };
          $.ajax({
            type:'post',
            dataType:'json',
            url:_url,
            data:_data,
            beforeSend:function()
            {
                waitingDialog.show();
            },
            // success:function(data)
            // {
            //   if(data.stat)
            //   {
            //       parent.remove();
            //       alertify.success('Berhasil dihapus');
            //       $('.modal').modal('hide');

            //   }
            // },
            complete:function()
            {
                waitingDialog.hide();
            }
          });
        });

    });

function openmodal(id){
  var id=id;
  var other="<a onclick='openmodal(1)' style='cursor:pointer'>product 1</a><a onclick='openmodal(2)' style='cursor:pointer'>product 2</a><a onclick='openmodal(3)' style='cursor:pointer' >product 3</a>";
  $('#item_modal').fadeOut("slow",function(){
        $(this).modal('hide')
    }).fadeIn("slow",function(){
        $("#target_title").text(id);
    $("#target_other").html(other);
        $(this).modal('show')
    });
}

// $(document).on('click', '.edit-modal', function() {
//           // $('.modal-title').text('Edit');
//            $('#category_name').val($(this).data('category'));
//           // $('#title_edit').val($(this).data('title'));
//           // $('#content_edit').val($(this).data('content'));
//           // id = $('#id_edit').val();
//           $('#editModal').modal('show');
//       });

$(".edit-modal").click(function(){
  refresh: true,
  $("#details_id").val($(this).attr('data-id'));
  $("#parentcategory_name").val($(this).attr('data-parentcategory'));
  $("#category_name").val($(this).attr('data-category'));
  $("#item_name").val($(this).attr('data-item'));
  $("#brand_idForm").val($(this).attr('data-brand'));
  $("#kuantitas").val($(this).attr('data-kuantitas'));
  $("#satuan_item").val($(this).attr('data-satuan'));
  $("#komparasi").val($(this).attr('data-komparasi'));
  $("#supplier_1").val($(this).attr('data-rec1'));
  $("#supplier_2").val($(this).attr('data-rec2'));
  $("#supplier_3").val($(this).attr('data-rec3'));
  $("#data_itempekerjaan").val($(this).attr('data-coa'));
  $("#deskripsi_item").val($(this).attr('data-deskripsi'));
  banyak_komparasi(2);

  var nilai = $(this).attr('data-komparasi');

  for(i=1;i<=nilai;i++){
            //$(".form_komparasi_supplier_"+i+"_item"+nilai).addClass('col-md-'+12/$(".jumlah_komparasi").val());
            
            $(".form_komparasi_supplier_"+i+"_item2").show();
            $(".form_komparasi_supplier_"+i+"_item2").addClass('col-md-'+12/nilai);
            $(".form_komparasi_supplier_"+i+"_item2").trigger("change");
            
  }

  //$('select').select2('destroy');
//$('select').select2();


  
  $('#editModal').modal('show');
  $('select').select2();
});

$(".tambah-detail").click(function(){
  refresh: true,
  $('#myModaltambah').modal('show');
});

// $('#myModaltambah').on('hidden.bs.modal', function(e) {
//     $(this).find('form').trigger('reset');
// })

// document.getElementById("close").addEventListener("click", function(){ 
//    document.getElementById("myModaltambah").reset();
// });

// $('#editModal').on('hidden.bs.modal', function () {
//      location.reload();
// });

</script>
</body>
</html>
