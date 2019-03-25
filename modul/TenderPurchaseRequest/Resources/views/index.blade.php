<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
  <style type="text/css">
    .table-align-right{
      text-align: right;
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
        <button class="col-lg-1 col-md-2 col-sm-2 btn btn-primary" onclick="location.href='{{ url('/')}}/'" style="float: none; border-radius: 20px; padding-left: 0" disabled>
        <i class="fa fa-fw fa-arrow-left"></i>&nbsp;&nbsp;Back
        </button>
        <button class="col-lg-1 col-md-2 col-sm-2 btn btn-primary" onclick="window.location.reload()" style="float: right; border-radius: 20px; padding-left: 0;">
          <i class="fa fa-fw fa-refresh"></i>&nbsp;&nbsp;Refresh
        </button>  
      </div>
    </section>
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <p/>
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#home">Group Tender PR</a></li>
              <li><a data-toggle="tab" href="#menu1">List Barang Yang Akan Ditenderkan</a></li>
              <li><a data-toggle="tab" href="#menu2">Tender</a></li>
            </ul>

            <div class="tab-content">
              <div id="home" class="tab-pane fade in active">
                <div class="box-body">
                  <div class="box-header with-border" style="background-color:white">
                    <div class="col-md-4">
                      <button type="button" class="btn btn-block btn-primary btn-lg" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/add'">
                        <i class="fa fa-fw fa-plus"></i>
                        &nbsp;&nbsp;
                        Tambah Tender PR
                      </button>
                    </div>
                  </div>
                  <table id="ListTelahKelompok" class="table table-bordered table-striped dataTable" role="grid" >
                      <thead style="background-color: greenyellow;">
                        <tr>
                          <th>No Group Tender</th>
                          <th>No PR</th>
                          <th>Item</th>
                          <th>Brand</th>
                          <th class="table-align-right">Quantity</th>
                          <th>Satuan</th>
                          <th>Desc</th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach($itemSiapTender as $key => $v )
                          <tr>
                            <td>{{ $v->no }}</td>
                            <td>{{ $v->nopr }}</td>
                            <td>{{$v->itemName}}</td>
                            <td>{{$v->brandName}}</td>
                            <td class="table-align-right">{{$v->quantity}}</td>
                            <td>{{$v->satuanName}}</td>
                            <td>{{$v->description}}</td>
                           
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
              </div>
              <div id="menu1" class="tab-pane fade">
                <div class="box-body">
                  <div class="box-header with-border" style="background-color:white">
                  <div class="col-md-5">
                    <button type="button" class="btn btn-block btn-primary btn-lg" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/add-penawaran'">
                    <i class="fa fa-fw fa-plus"></i>
                    &nbsp;&nbsp;
                    Buat Pengelompokan Penawaran
                    </button>
                  </div>
                </div>
                  <table id="ListTelahKelompok" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                      <thead>
                        <tr style="background-color: greenyellow;">
                          <th class="table-align-right">No</th>
                          <th>No Tender</th>
                          <th>Tanggal</th>
                          <th>Status Penawaran</th> 
                          <th>Status Pemenang</th> 
                          <th>Status Item Tender</th> 
                          <th>Status Kelompok Tender</th> 
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
                            <td>{{$v["no"]}}</td>
                            <!-- <td>{{$v["name"]}}</td> -->
                            <td>{{$v["final_date"]}}</td>
                            @if($v["status_pemenang_id"] != 0)
                            <td>{{$v["rekanan_name"]}}</td>                            
                            <td>{{$v["status_pemenang"]}}</td>                            
                            @else
                            <td></td>                            
                            <td></td>                            
                            @endif

                            <td>{{ucwords($v["status"])}}</td>                            
                            @if($v["penawaran_group"])
                            <td>Terkelompokkan</td>
                            @else
                            <td>Belum Terkelompokkan</td>
                            @endif
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
              <div id="menu2" class="tab-pane fade">
                <div class="box-body">
                   <div class="box-header with-border" style="background-color:white">
                <div class="col-md-4">
                  <button type="button" class="btn btn-block btn-primary btn-lg" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/add-nilai-penawaran'">
                  <i class="fa fa-fw fa-plus"></i>
                  &nbsp;&nbsp;
                  Tambah Penawaran
                  </button>
                </div>
              </div>
                <table id="ListSiapKelompok" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                    <thead>
                      <tr style="background-color: greenyellow;">
                        <th class="table-align-right">No</th>
                        <th class="table-align-right">No Tenderkan</th>
                        <th class="table-align-right">Jumlah Item </th>
                        <th>Status Penawaran</th>
                        <th>Action</th> 
                      </tr>
                      </thead>
                    
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
@include("pt::app")
<script>
  
  $(function () {
    $('#ListSiapKelompok').DataTable();
    $('#ListTelahKelompok').DataTable({
      scrollY: "300px",
          //scrollX:true,
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
                        '<tr class="group" style="background-color: #3FD5C0;""><td colspan="9"><strong>'+group+'</strong></td></tr>'
                    );
 
                    last = group;
                }
            } );
        }
    });
  });

</script>
</body>
</html>
