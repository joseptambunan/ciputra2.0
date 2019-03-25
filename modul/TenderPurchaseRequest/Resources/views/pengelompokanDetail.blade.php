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
        <h1 style="text-align:center">Detil Pengelompokan PR {{ $project->name }}</h1>
    </section>
    <section class="content-header">
      <div class="" style="float: none">
       
        <button class="col-lg-1 col-md-2 col-sm-2 btn btn-primary" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/pengelompokan'" style="float: none; border-radius: 20px; padding-left: 0">
       
        <i class="fa fa-fw fa-arrow-left"></i>&nbsp;&nbsp;Back
        </button>
        <button class="col-lg-1 col-md-2 col-sm-2 btn btn-primary" onclick="window.location.reload()" style="float: right; border-radius: 20px; padding-left: 0;">
          <i class="fa fa-fw fa-refresh"></i>&nbsp;&nbsp;Refresh
        </button>  
      </div>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">
                Pengelompokkan PR
              </h3>
              <div class="box-tools pull-right">
                 @if(strcmp($user->user_login,"administrator")==0)

                   @if($header->collect_rekanan == null)

                      @if($header->approval[0]->approval_action_id == 1)
                        <a class="btn btn-block btn-primary" href="{{ url('/')}}/tenderpurchaserequest/request_approval_tprg?id={{ $header->id }}">
                                <i class="fa fa-fw fa-send-o"></i> Request Approval </a>
                      @endif

                      @if($header->approval[0]->approval_action_id == 2)
                      <a class="btn btn-block btn-warning" href="{{ url('/')}}/tenderpurchaserequest/undo_request?id={{ $header->id }}">
                              <i class="fa fa-fw fa-reply"></i> Undo Request
                        </a>
                      @endif

                      @if($header->approval[0]->approval_action_id == 6)
                        <a class="btn btn-block btn-warning" href="{{ url('/')}}/tenderpurchaserequest/add_oe_pr?id={{ $header->no }}" rel="tooltip" data-toggle="tooltip" data-placement="left" title="Tambah OE">
                                <i class="fa fa-fw fa-plus"></i> OE </a>
                      @endif
                    @endif
                @endif
                  @if(strcmp($user->user_login,"approval1")==0)
                    @if($header->approval[0]->approval_action_id == 2)
                  <a class="btn btn-block btn-primary" href="{{ url('/')}}/tenderpurchaserequest/approve_tprg?id={{ $header->id }}">
                          <i class="fa fa-fw fa-check"></i> Approve 
                    </a>
                    @endif
                 @endif
              </div>  
              
            </div>
            <div class="box-body">
                <table id="header" class="table">
                    <thead>
                      <tr >
                        <th>No Pengelompokan PR</th><th>{{ $header->no }}</th>
                      </tr>
                      <tr>
                        <!-- <th>Status</th><th>{{ strtoupper($header->approval[0]->status->description) }}</th> -->
                        @if($header->approval[0]->status->description == "approved")
                          <th>Status </th> <th> <strong style="color:green;">{{ strtoupper($header->approval[0]->status->description) }}</strong></th>
                          @elseif($header->approval[0]->status->description == "delivered")
                          <th>Status </th> <th> <strong style="color:yellow;">{{ strtoupper($header->approval[0]->status->description) }}</strong></th>
                          @elseif($header->approval[0]->status->description == "partial approved")
                          <th>Status </th> <th> <strong style="color:#40E0D0;">{{ strtoupper($header->approval[0]->status->description) }}</strong></th>
                          @elseif($header->approval[0]->status->description == "open")
                          <th>Status </th> <th> <strong style="color:black;">{{ strtoupper($header->approval[0]->status->description) }}</strong></th>
                          @elseif($header->approval[0]->status->description == "rejected")
                          <th>Status </th> <th> <strong style="color:red;">{{ strtoupper($header->approval[0]->status->description) }}</strong></th>
                        @endif
                      </tr>
                      <tr>
                        <th>Deskripsi</th><th>{{ $header->description }}</th>
                      </tr>
                      </thead>
                     
                  </table>
            </div>
            
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">
                Jumlah Item &nbsp;	&nbsp;	
                <span class="pull-right-container">
                 <small class="label pull-right bg-yellow">{{count($itemDetil)}}</small> 
                </span>
              </h3>
             
              
            </div>
            <div class="box-body">
                <table id="ListSiapKelompok" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                    <thead style="background-color: greenyellow;">
                      <tr >
                        <th >No PR</th>
                        <th>Item</th>
                        <th>Brand</th>
                        <th class="table-align-right">Quantity</th> 
                        <th>Satuan</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php
                          $total_qty = 0;
                        ?>
                        @foreach($itemDetil as $key => $v)
                          <tr>
                              <td>{{$v->nopr}}</td>
                              <td>{{$v->itemName}}</td>
                              <td>{{$v->brandName}}</td>
                              <td class="table-align-right">{{$v->totalqty}}</td>
                              <td>{{$v->satuanName}}</td>

                              <?php
                                $total_qty+=$v->totalqty;
                              ?>
                          </tr>
                        @endforeach
                      </tbody>
                      
                  </table>
            </div>
            
          </div>
        </div>
      </div>
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
<!-- ./wrapper -->

@include("master/footer_table")
@include("pt::app")
<script>
  
  $(function () {
    $('#ListSiapKelompok').DataTable(
      {
          scrollY: "300px",
          info:false,
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
                        '<tr class="group" style="background-color: #3FD5C0;""><td colspan="4"><strong>'+group+'</strong></td></tr>'
                    );
 
                    last = group;
                }
            } );
        },
        initComplete: function () {
        }
      });
  })

</script>
</body>
</html>
