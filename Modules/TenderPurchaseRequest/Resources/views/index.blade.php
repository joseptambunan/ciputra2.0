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
          @if(strcmp($user->user_login,"administrator")==0)
          <div class="box box-primary">
            <div class="box-header with-border" data-widget="collapse">
              <h3 class="box-title">
                List Belum Di Tenderkan &nbsp; &nbsp;  
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
            <!-- /.box-header -->
            <div class="box-header with-border" style="background-color:white">
              <div class="col-md-3">
                <button type="button" class="btn btn-block btn-primary btn-lg" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/add'">
                  <i class="fa fa-fw fa-plus"></i>
                  &nbsp;&nbsp;
                  Tambah Tender PR
                </button>
              </div>
            </div>
            <div class="box-body">
                <table id="ListSiapKelompok" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                    <thead>
                      <tr style="background-color: greenyellow;">
                        <th class="table-align-right">No</th>
                        <th>Item</th>
                        <th>Brand</th>
                        <th class="table-align-right">Quantity</th>
                        <th>Satuan</th>
                        <th>Desc</th>
                        <th>Action</th> 
                      </tr>
                      </thead>
                      <tbody>
                          @php($i=0)
                          @foreach($itemSiapTender as $v )
                          @php($i++)
  
                          <tr>
                            <td class="table-align-right">{{$i}}</td>
                            <td>{{$v->itemName}}</td>
                            <td>{{$v->brandName}}</td>
                            <td class="table-align-right">{{$v->quantity}}</td>
                            <td>{{$v->satuanName}}</td>
                            <td>{{$v->description}}</td>                            
                            <td>
                                <button type="button" class="btn btn-block btn-primary" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/pengelompokanDetail/?id={{$v->id}}&back=tenderpurchaserequest'" style="padding-left:0px">
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
          @endif
        </div>
      </div>
      
      <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border" data-widget="collapse">
                <h3 class="box-title">
                  List Telah Di Tenderkan &nbsp; &nbsp;  
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
                          <th class="table-align-right">No Tender</th>
                          <th>Nama Tender</th>
                          <th class="table-align-right">Final Date</th>
                          <th>Pemenang</th> 
                          <th>Status</th> 
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
                            @if($v->approval_action_id !=2)
                            <td class="table-align-right">{{$i}}</td>
                            <td class="table-align-right">{{$v->no}}</td>
                            <td>{{$v->name}}</td>
                            <td class="table-align-right">{{$v->final_date}}</td>
                            <td>{{$v->description}}</td>                            
                            <td>{{ucwords($v->status)}}</td>                            

                              @if(strcmp($user->user_login,"approval1")==0)
                              <td>
                                <button type="button" class="btn btn-block btn-primary" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/approve-tender/?id={{$v->id}}'" style="padding-left:0px">
                                  <i class="fa fa-fw fa-book"></i>
                                  &nbsp;
                                  Approve
                                </button>  
                              </td>
                              @endif
                              
                              <td>
                                <button type="button" class="btn btn-block btn-primary" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/detail/?id={{$v->id}}'" style="padding-left:0px">
                                  <i class="fa fa-fw fa-book"></i>
                                  &nbsp;
                                  Detail
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
    $('#ListSiapKelompok').DataTable();
    $('#ListTelahKelompok').DataTable();
  })

</script>
</body>
</html>
