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
      <h1 style="text-align:center">Data Purchase Request Detail</h1>
    </section>
    <section class="back-button content-header">
      <div class="">
        <button class="col-md-1 col-sm-2 btn btn-primary" onclick="location.href='{{ url('/')}}/purchaserequest'" style="float: none; border-radius: 20px; padding-left: 0">
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
              <div class="col-md-6"><br>
                <!-- <a href="{{ url('/')}}/purchaserequest/add" class="btn-lg btn-primary"><i class="glyphicon glyphicon-plus-sign"></i>Tambah Data Purchase Request</a> -->
              </div>
              <div class="col-md-12">
                @if($approve)
                <div class="row" style="padding-bottom: 20px;margin: 0px 15px">
                  <a href="{{ url('/')}}/purchaserequest/approve/?id={{$pr_id}}&type=approveAll" class="btn btn-success col-md-1 col-md-offset-10">Approve All</a>
                  <a href="{{ url('/')}}/purchaserequest/approve/?id={{$pr_id}}&type=cancelAll" class="btn btn-danger" style="width:7%;margin-left: 1%">Cancel All</a>
                </div>
                @endif
            	<table id="example3" class="table table-bordered table-hover">
                <thead>
                <tr style="background-color: greenyellow;">
                  <th class="table-align-right">No</th>
                  <th>Item Pekerjaan</th>
                  <th>Item</th>
                  <th>Item Satuan Id</th>
                  <th>Brand Id</th>
                  <th class="table-align-right">Kuantitas</th>
                  <th class="table-align-right">Jumlah Recomended Supplier</th>
                  <th>Supplier 1</th>
                  <th>Supplier 2</th>
                  <th>Supplier 3</th>
                  <th>Deskripsi</th>
                  <th>Status</th>
                  @if($approve)
                  <th>Action</th>
                  @endif
                </tr>
                </thead>
                <tbody>
                    <?php
                    ?>
                    @php ($i = 0)
                    @foreach($PRS as $key => $value )
                    @php ($i++)
                    <tr>
                        <td class="table-align-right">{{$i}}</td>
                        <td>{{$value->itemPekerjaanName}}</td>
                        <td>{{$value->itemName}}</td>
                        <td>{{$value->itemSatuanName}}</td>

                        <td>{{$value->brandName}}</td>
                        <td class="table-align-right">{{$value->quantity}}</td>
                        <td class="table-align-right">{{$value->recomended_supplier}}</td>
                        <td>{{$value->r1Name}}</td>
                        <td>{{$value->r2Name}}</td>
                        <td>{{$value->r3Name}}</td>
                        <td>{{$value->description}}</td>
                        <td>{{strtoupper($status[$i-1])}}</td>
                        @if($approve)
                          @if(strtoupper($status[$i-1])=="APPROVED")
                            <td><a href="{{ url('/')}}/purchaserequest/approve/?id={{$value->id}}&type=cancel&pr_id={{$value->purchaserequest_id}}" class="btn btn-danger col-md-12">Cancel</a></td>
                          @elseif((strtoupper($status[$i-1])=="OPEN"))
                            <td><a href="{{ url('/')}}/purchaserequest/approve/?id={{$value->id}}&type=approve&pr_id={{$value->purchaserequest_id}}" class="btn btn-success col-md-12">Approve</a></td>
                          @elseif((strtoupper($status[$i-1])=="CANCELED"))
                            <td><a href="{{ url('/')}}/purchaserequest/approve/?id={{$value->id}}&type=approve&pr_id={{$value->purchaserequest_id}}" class="btn btn-success col-md-12">Approve</a></td>
                          @endif
                        @endif
                    </tr>
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
<!--@include("pt::app")-->
</body>
</html>
