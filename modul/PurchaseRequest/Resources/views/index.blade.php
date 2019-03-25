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
        <button class="col-lg-1 col-md-2 col-sm-2 btn btn-primary" onclick="location.href='{{ url('/')}}/purchaserequest'" style="float: none; border-radius: 20px; padding-left: 0" disabled>
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
              @if($isDepartment!=0)
              <div class="col-md-6" style="margin-bottom: 20px"><br>
                <a href="{{ url('/')}}/purchaserequest/add" class="btn-lg btn-md btn-primary"><i class="glyphicon glyphicon-plus-sign"></i>Tambah Data Purchase Request</a>
              </div>
              @endif
              <div class="col-md-12">
            	<table id="table_data" class="table table-bordered table-hover" style="width: 100%">
                <thead>
                <tr style="background-color: greenyellow;">
                  <th>No</th>
                  <th>Department</th>
                  <th >No. PR</th>
                  <th >Jumlah Item</th>
                  <th>Tanggal Transaksi</th>
                  <th>Tanggal Butuh</th>
                  <th>SPK</th>
                  <th>Status</th>
                  <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                    @php($i=0)
                    @foreach($PR as $key => $value )
                    <tr>
                        <td>{{$i+1}}</td>
                        <td>{{$value->department->name}}</td>
                        @if($value->approval[0]->status->description == "approved")
                          <td><strong style="color:green;">{{$value->no}}</strong></td>
                          @elseif($value->approval[0]->status->description == "delivered")
                          <td><strong style="color:yellow;">{{$value->no}}</strong></td>
                          @elseif($value->approval[0]->status->description == "partial approved")
                          <td><strong style="color:#40E0D0;">{{$value->no}}</strong></td>
                          @elseif($value->approval[0]->status->description == "open")
                          <td><strong style="color:black;">{{$value->no}}</strong></td>
                          @elseif($value->approval[0]->status->description == "rejected")
                          <td><strong style="color:red;">{{$value->no}}</strong></td>
                        @endif
                        <td class="table-align-right">{{$value->details->count()}}</td>
                        <td>{{$value->date}}</td>
                        <td>{{$value->butuh_date}}</td>
                        <td>{{$value->spk}}</td>
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
                        <!-- <td>{{ $value->approval[0]->status->description }}</td> -->
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
<script type="text/javascript">
  $(document).ready(function()
  {
      $('#table_data').DataTable({
        scrollY: "300px",
        //scrollX:true,
        scrollCollapse: true,
        paging: false,
        /*    fixedColumns:   {
                leftColumns: 2
            },*/
            "order": [[ 0, 'asc' ]]
      });
  });
</script>
</body>
</html>
