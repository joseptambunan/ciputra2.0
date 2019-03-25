<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard</title>
  <link rel="stylesheet" href="{{ url('/')}}/assets/selectize/selectize.bootstrap3.css">
  @include("master/header")
  <style type="text/css">
    .table-align-right{
      text-align: right;
    }
    .optionItem{
      width:98%;
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
      <h1 style="text-align:center">Data Tender Purchase Request</h1>
    </section>
    <section class="content-header">
      <div class="" style="float: none">
        <button class="col-md-1 col-sm-2 btn btn-primary" onclick="location.href='{{ url('/')}}/tenderpurchaserequest'" style="float: none; border-radius: 20px; padding-left: 0">
        <i class="fa fa-fw fa-arrow-left"></i>&nbsp;&nbsp;Back
        </button>
        <button class="col-md-1 col-sm-2 btn btn-primary" onclick="window.location.reload()" style="float: right; border-radius: 20px; padding-left: 0;">
          <i class="fa fa-fw fa-refresh"></i>&nbsp;&nbsp;Refresh
        </button>  
      </div>
    </section>
    <section class="content">
      @php($i=0)
      @foreach($rekanan as $v)
      
      <div class="modal fade" id="rekanan{{$v->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              List Item dan Brand - Rekanan {{$v->name}}
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>

            </div>
            
            <div class="modal-body">
              <div class="col-md-12" style="margin-bottom: 15px;margin-top: 15px">
                <button class="btn btn-primary col-md-12" data-toggle="modal" data-target="#addItem{{$v->id}}">
                <i class="fa fa-fw fa-plus"></i>
                &nbsp;&nbsp;
                Tambah Item
                </button>
              </div>
              <div class="container-fluid">
                <div class="col-md-12">
                  <table class="listItem table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                    <thead>
                      <tr>
                        <th>Item</th>
                        <th>Brand</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php($j=0)
                      @foreach($v->item as $v2)
                      <tr>
                        <td>{{$v2->item}}</td>
                        <td>{{$v2->brand}}</td>
                      </tr>
                      @php($j++)
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>    
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="addItem{{$v->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form class="row" action="{{ url('/')}}/tenderpurchaserequest/add-item-pembayaran" method="get">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              Tambah Item - Rekanan {{$v->name}}
              <input name="id_rekanan" value="{{$v->id}}" hidden>
              <input name="id_penawaran" value="{{$no}}" hidden>
              <input name="no" value="{{$no}}" hidden>
              <input name="code" value="{{$code}}" hidden>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <div class="modal-body">
              <div class="container-fluid">
                <div class="col-md-12">
                    
                    <div id="rekanan_1" class="form-rekanan form-group col-md-12">
                      <label class="col-md-12" style="padding-left:0">Rekanan</label>
                      <select id="" name="item[]" class="form-selectize-rekanan input col-md-12" required>
                        <option value="" selected disabled>Pilih Rekanan</option>

                        @foreach($Item as $v2) 
                          @php($flag = 0)
                           @foreach($v->item as $v3)
                            @if(($v3->itemId == $v2["itemId"] and $v3->brandId == $v2["brandId"]))
                              @php($flag=1)
                            @endif
                          @endforeach
                          @if($flag == 0)
                          <option value="{{$v2['itemId']}} - {{$v2['brandId']}}">
                              {{$v2["item"]}} - {{$v2["brand"]}}
                          </option>
                          @endif                    
                        @endforeach
                      </select>
                      </div>
                      <button type="submit" class="col-md-12 btn btn-primary" >Simpan</button>

                  
                </div>
              </div>    
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
        </form>
      </div>
      @php($i++)
      @endforeach
      <!-- Info boxes -->
      <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border" data-widget="collapse">
                <h3 class="box-title">
                  List Tender dengan Code : {{$code}} &nbsp; &nbsp;  
                  <span class="pull-right-container">
                    <small class="label pull-right bg-yellow"></small>
                  </span>
                </h3> 
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse">  
                    <i class="fa fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="box-header with-border" style="background-color:white">
                <div class="col-md-6">
                  <button type="button" class="btn btn-block btn-primary btn-lg" onclick="window.location.href='{{ url('/')}}/tenderpurchaserequest/add-nilai-penawaran?no={{$no}}&code={{$code}}'">
                  <i class="fa fa-fw fa-plus"></i>
                  &nbsp;&nbsp;
                  Tambah Penawaran di List ini
                  </button>
                </div>
                <div class="col-md-6  ">
                  <button type="button" class="btn btn-block btn-primary btn-lg" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/kirim-penawaran?no={{$no}}&code={{$code}}'">
                  <i class="fa fa-fw fa-book"></i>
                  &nbsp;&nbsp;
                  Kirim / Cetak Penawaran
                  </button>
                </div>
                <div class="col-md-12" style="margin-top: 10px">
                  <div class="col-md-4">
                    <button type="button" class="btn btn-block btn-success btn-lg" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/add-penawaran'" disabled>
                    <i class="fa fa-fw fa-plus"></i>
                    &nbsp;&nbsp;
                    Fase Penawaran 1
                    </button>
                  </div>
                  <div class="col-md-4">
                    <button type="button" class="btn btn-block btn-default btn-lg" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/add-penawaran'" disabled>
                    <i class="fa fa-fw fa-plus"></i>
                    &nbsp;&nbsp;
                    Fase Penawaran 2
                    </button>
                  </div>
                  <div class="col-md-4">
                    <button type="button" class="btn btn-block btn-default btn-lg" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/add-penawaran'" disabled>
                    <i class="fa fa-fw fa-plus"></i>
                    &nbsp;&nbsp;
                    Fase Penawaran 3
                    </button>
                  </div>
                </div>
              </div>
              <div class="box-body">
                  <table id="ListTelahKelompok" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                      <thead>
                        <tr style="background-color: greenyellow;">
                          <th class="table-align-right">No.</th>
                          <th class="table-align-right">No. Item Tender</th>
                          <!-- <th>Nama Tender</th> -->
                          <th>Item</th> 
                          <th>Brand</th> 
                          <th>Pemenang</th> 
                          <th>Status Pemenang</th> 
                          <th>Status Item Tender</th> 
                          @if(strcmp($user->user_login,"approval1")==0)
                          <th>Aksi</th> 
                          @endif
                          <th>Detail</th>
                        </tr>
                        </thead>
                        <tbody>
                          @php($i=0)
                          @foreach($TPR as $v )
                          @php($i++)
  
                          <tr>
                            <td class="table-align-right">{{$i}}</td>
                            <td class="table-align-right">{{$v["no"]}}</td>
                            <!-- <td>{{$v["name"]}}</td> -->
                            <td>{{$v["item"]}}</td>
                            <td>{{$v["brand"]}}</td>
                            @if($v["status_pemenang_id"] != 0)
                            <td>{{$v["rekanan_name"]}}</td>                            
                            <td>{{$v["status_pemenang"]}}</td>                            
                            @else
                            <td></td>                            
                            <td></td>                            
                            @endif
                            <td>{{ucwords($v["status"])}}</td>                            

                              @if(strcmp($user->user_login,"approval1")==0)
                              <td>
                                <button type="button" class="btn btn-block btn-primary" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/approve-tender/?id={{$v["id"]}}'" style="padding-left:0px">
                                  <i class="fa fa-fw fa-book"></i>
                                  &nbsp;
                                  Approve
                                </button>  
                              </td>
                              @endif
                              
                              <td>
                                <button type="button" class="btn btn-block btn-primary" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/detail/?id={{$v["id"]}}'" style="padding-left:0px">
                                  <i class="fa fa-fw fa-book"></i>
                                  &nbsp;
                                  Detail
                                </button>  
                              </td>
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
              </div>
              
            </div>
          </div>
        </div>
          <!-- /.row -->
          <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border" data-widget="collapse">
                <h3 class="box-title">
                  List Supplier dan Item dengan Code Tender : {{$code}} &nbsp; &nbsp;  
                  <span class="pull-right-container">
                    <small class="label pull-right bg-yellow"></small>
                  </span>
                </h3> 
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse">  
                    <i class="fa fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="box-body">
                  <table id="ListTelahKelompok" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                      <thead>
                        <tr style="background-color: greenyellow;">
                          <th class="table-align-right">No</th>
                          <th>Supplier</th>
                          <th class="table-align-right">Jumlah Item</th>
                          <th>Detail</th>
                        </tr>
                        </thead>
                        <tbody>
                          <tbody>
                          @php($i=0)
                          @foreach($rekanan as $v )
                          @php($i++)
                            <tr>
                              <td class="table-align-right">{{$i}}</td>
                              <td>{{$v->name}}</td>
                              <td class="table-align-right">{{count($v->item)}}</td>
                              <td>
                                <button class="btn btn-primary col-md-12" data-toggle="modal" data-target="#rekanan{{$v->id}}">
                                  <i class="fa fa-fw fa-book"></i>
                                  &nbsp;
                                  Detail
                                </button>
                                
                                 
                              </td>

                            </tr>
                          @endforeach
                        </tbody>
                    </table>
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
@include("pt::app")
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('/')}}/assets/selectize/selectize-modal.min.js"></script>

<script>
  
  $(function () {
    $('#ListSiapKelompok').DataTable();
    $('#ListTelahKelompok').DataTable();
    $('.listItem').DataTable();

  })
  $("#tender").select2({
      placeholder: "Pilih Tender",
      //closeOnSelect: false

  });
  $('.form-selectize-rekanan').selectize({
    plugins: ['remove_button'],
    maxItems: 100,
    delimiter: ',',
    persist: false,
        });
    $(".selectize-dropdown").css("margin-left", "-15px");

    $(".selectize-dropdown").change(function() {
      if((".selectize-dropdown")[0].style[4] == "top"){
        $(".selectize-dropdown").css("top", "");
      }
    });
</script>
</body>
</html>
