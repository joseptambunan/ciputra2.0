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
      <h1 style="text-align:center">Data Pengelompokan Tender Purchase Request</h1>

    </section>
    <section class="content-header">
      <div class="" style="float: none">
        <button class="col-md-1 col-sm-2 btn btn-primary" onclick="location.href='{{ url('/')}}/'" style="float: none; border-radius: 20px; padding-left: 0" disabled>
        <i class="fa fa-fw fa-arrow-left"></i>&nbsp;&nbsp;Back
        </button>
        <button class="col-md-1 col-sm-2 btn btn-primary" onclick="window.location.reload()" style="float: right; border-radius: 20px; padding-left: 0;">
          <i class="fa fa-fw fa-refresh"></i>&nbsp;&nbsp;Refresh
        </button>  
      </div>
    </section>
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12">
          
          <div class="box box-primary">
            <div class="box-header with-border" data-widget="collapse">
              <h3 class="box-title">
               
              </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                  <i class="fa fa-plus"></i>
                </button>
              </div>         
            </div>
            <!-- /.box-header -->
            

            <div class="box-body">
               <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home"> List Belum Di Kelompokkan &nbsp;  &nbsp;  
                  <span class="pull-right-container">
                    <small class="label pull-right bg-yellow">{{count($itemSiapKelompok)}} item</small>
                  </span></a></li>
                <li><a data-toggle="tab" href="#menu1">List Telah Dikelompokkan &nbsp;&nbsp;  
                  <span class="pull-right-container">
                    <small class="label pull-right bg-yellow">{{count($itemSiapTender)}} item</small>
                  </span></a></li>
              </ul>

              <div class="tab-content">
                <br/>
                <div id="home" class="tab-pane fade in active">
                   @if(strcmp($user->user_login,"administrator")==0)
                    <div class="box-header with-border" style="background-color:white">
                      <div class="col-md-4">
                        <button type="button" class="btn btn-block btn-primary btn-lg" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/pengelompokanAdd'">
                          <i class="fa fa-fw fa-plus"></i> Tambah Kelompok PR </button>
                      </div>
                    </div>
                    @endif
                  <table id="ListSiapKelompok" class="table table-bordered table-striped dataTable" role="grid">
                    <thead>
                      <tr style="background-color: greenyellow;">
                        <th>No PR</th>
                        <th>Departemen</th>
                        <th>Item</th>
                        <th>Brand</th>
                        <th class="table-align-right">Quantity</th>
                        <th>Satuan</th>
                        
                      </tr>
                      </thead>
                      <tbody>
                        @foreach($itemSiapKelompok as $v )
                        <tr>
                          <td>{{$v->prNo}}</td>
                          <td>{{$v->departmentName}}</td>
                          <td>{{$v->itemName}}</td>
                          <td>{{$v->brandName}}</td>
                          <td class="table-align-right">{{$v->quantity}}</td>
                          <td>{{$v->satuanName}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
                </div>
                <div id="menu1" class="tab-pane fade">
                  @if(strcmp($user->user_login,"administrator")==0)
                    <!-- <div class="box-header with-border" style="background-color:white">
                      <div class="col-md-4">
                        <button type="button" class="btn btn-block btn-primary btn-lg" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/pengelompokanAdd'">
                          <i class="fa fa-fw fa-plus"></i> Tambah OE </button>
                      </div>
                    </div> -->
                    @endif
                  <table id="ListTelahKelompok" class="table table-bordered table-striped dataTable" role="grid" >
                      <thead style="background-color: greenyellow;">
                        <tr>
                          <th>No Group Tender</th>
                          
                          <th>Item</th>
                          <th>Brand</th>
                          <th class="table-align-right">Quantity</th>
                          <th>Satuan</th>
                          <th>Desc</th>
                          <th>Status</th>
                          <th>Action</th> 
                          @if(strcmp($user->user_login,"approval1")==0)
                          <th>Approve</th>
                          @endif
                          
                        </tr>
                        </thead>
                        <tbody>
                          @foreach($itemSiapTender as $key => $v )
                          <tr>
                            <td>{{ $v->no }}</td>
                            <td>{{$v->itemName}}</td>
                            <td>{{$v->brandName}}</td>
                            <td class="table-align-right">{{$v->totalqty}}</td>
                            <td>{{$v->satuanName}}</td>
                            <td>{{$v->description}}</td>
                            <td>{{ucfirst($v->approvDescription)}}</td>
                            <td class="text-center">
                                <button type="button" class="btn  btn-primary" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/pengelompokanDetail/?id={{$v->id}}&item_id={{ $v->item_id }}'" style="padding-left:0px">
                                  <i class="fa fa-fw fa-book"></i>
                                  &nbsp;
                                  Detail
                                </button>  
                            </td>
                            @if(strcmp($user->user_login,"approval1")==0)
                            <td>
                              <button type="button" class="btn btn-primary" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/approve-pengelompokan/?id={{$v->id}}&approve=@if(strtoupper($v->approvDescription)=="OPEN") 1 @else 2 @endif'" 
                                style="padding-left:0px"@if(strtoupper($v->approvDescription)!="OPEN") disabled @endif>
                              <i class="fa fa-fw fa-book"></i>
                                &nbsp;
                                Approve
                              </button>  
                            </td>
                            @endif
                          </tr>
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

  <div class="control-sidebar-bg"></div>
</div>

@include("master/footer_table")
@include("pt::app")
<script type="text/javascript">
  var table_group = null;
  $(function () {
    $('#ListSiapKelompok').DataTable(
      {
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
                        '<tr class="group" style="background-color: #3FD5C0;""><td colspan="6"><strong>'+group+'</strong></td></tr>'
                    );
 
                    last = group;
                }
            } );
        }
      });

    var url_oe ="{{ url('/tenderpurchaserequest/add_oe_pr') }}"+"?id=";
    table_group = $('#ListTelahKelompok').DataTable({
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
                  console.log(group);
                    $(rows).eq( i ).before('<tr class="group" style="background-color: #3FD5C0;""><td colspan="10"><strong>'+group+'</strong><a href="'+url_oe+group+'" class="btn btn-warning pull-right"><i class="fa fa-plus"></i> OE</a></td></tr>');
                    last = group;
                }
            } );
        }
    });

   
  });
</script>
</body>
</html>
