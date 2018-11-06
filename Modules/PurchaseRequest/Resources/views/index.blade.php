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
      <h1 style="text-align:center">Data Purchase Request</h1>
    </section>
    <section class="back-button content-header">
      <div class="" style="float: none">
        <button class="col-md-1 col-sm-2 btn btn-primary" onclick="location.href='{{ url('/')}}/purchaserequest'" style="float: none; border-radius: 20px; padding-left: 0" disabled>
        <i class="fa fa-fw fa-arrow-left"></i>&nbsp;&nbsp;Back
        </button>
        <button class="col-md-1 col-sm-2 btn btn-primary" onclick="window.location.reload()" style="float: right; border-radius: 20px; padding-left: 0;">
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
              @if($isDepartment!=0 and strcmp($user->user_login,"approval1")!=0)
              <div class="col-md-6"><br>
                <a href="{{ url('/')}}/purchaserequest/add" class="btn-lg btn-primary"><i class="glyphicon glyphicon-plus-sign"></i>Tambah Data Purchase Request</a>
              </div>
              @endif
              <div class="col-md-12">
            	<table id="example3" class="table table-bordered table-hover">
                <thead>
                <tr style="background-color: greenyellow;">
                  <th>No</th>
                  <th>Department</th>
                  <th class="table-align-right" >No. PR</th>
                  <th class="table-align-right">Tanggal Transaksi</th>
                  <th class="table-align-right">Tanggal Butuh</th>
                  <th>Status</th>
                  <!-- @if($approve)
                  <th>Approve All</th>
                  <th>Cancel All</th>
                  @endif -->
                  <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                    @php($i=0)
                    @foreach($PR as $key => $value )
                    <tr>
                        <td>{{$i+1}}</td>
                        <td>{{$value->dName}}</td>
                        <td class="table-align-right">{{$value->no}}</td>
                        <td class="table-align-right">{{$value->date}}</td>
                        <td class="table-align-right">{{$value->butuh_date}}</td>
                        <td>{{$status_approval[$i]}}</td>
                        <!-- @if($approve)
                        <td style="text-align: center;"><a href="{{ url('/')}}/purchaserequest/approve/?id={{$value->id}}&type=approveAll" class="btn btn-success">Approve</a></td>
                        <td style="text-align: center;"><a href="{{ url('/')}}/purchaserequest/approve/?id={{$value->id}}&type=cancelAll" class="btn btn-danger ">Cancel</a></td>
                        @endif -->
                        <td style="text-align: center;"><a href="{{ url('/')}}/purchaserequest/detail/?id={{$value->id}}" class="btn btn-success">Detail</a></td>
                    </tr>
                    @php($i++)
                    @endforeach
                </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
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
</body>
</html>
