<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Purchase Request Detail</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-6"><br>
                <a href="{{ url('/')}}/purchaserequest/add" class="btn-lg btn-primary"><i class="glyphicon glyphicon-plus-sign"></i>Tambah Data Purchase Request</a>
              </div>
              <div class="col-md-12">
            	<table id="example3" class="table table-bordered table-hover">
                <thead>
                <tr style="background-color: greenyellow;">
                  <th>No</th>
                  <th>Item Pekerjaan Id</th>
                  <th>Item</th>
                  <th>Item Satuan Id</th>
                  <th>Brand Id</th>
                  <th>Kuantitas</th>
                  <th>Jumlah Recomended Supplier</th>
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
                        <td>{{$i}}</td>
                        <td>{{$value->itempekerjaan_id}}</td>
                        <td>{{\App\item::select('name')->where('id',$value->item_id)->limit(1)->get()[0]->name}}</td>
                        <td>{{\App\item_satuan::select('name')->where('id',$value->item_satuan_id)->limit(1)->get()[0]->name}}</td>
                        <td>{{\App\brand::select('name')->where('id',$value->brand_id)->limit(1)->get()[0]->name}}</td>
                        <td>{{$value->quantity}}</td>
                        <td>{{$value->recomended_supplier}}</td>
                        <td>{{\App\rekanan_group::select('name')->where('id',$value->rec_1)->limit(1)->get()[0]->name}}</td>
                        <td>
                            {{(isset(\App\rekanan_group::select('name')->where('id',$value->rec_2)->limit(1)->get()[0]->name)?\App\rekanan_group::select('name')->where('id',$value->rec_2)->limit(1)->get()[0]->name:"")}}
                        </td>
                        <td>
                            {{(isset(\App\rekanan_group::select('name')->where('id',$value->rec_3)->limit(1)->get()[0]->name)?\App\rekanan_group::select('name')->where('id',$value->rec_3)->limit(1)->get()[0]->name:"")}}
                        </td>
                        <td>{{$value->description}}</td>
                        <td>{{strtoupper($status[$i-1])}}</td>
                        @if($approve)
                          @if(strtoupper($status[$i-1])=="APPROVED")
                            <td><a href="http://localhost:81/purchaserequest/approve/?id={{$value->id}}&type=cancel&pr_id={{$value->purchaserequest_id}}" class="btn btn-danger col-md-12">Cancel</a></td>
                          @elseif((strtoupper($status[$i-1])=="OPEN"))
                            <td><a href="http://localhost:81/purchaserequest/approve/?id={{$value->id}}&type=approve&pr_id={{$value->purchaserequest_id}}" class="btn btn-success col-md-12">Approve</a></td>
                          @elseif((strtoupper($status[$i-1])=="CANCELED"))
                            <td><a href="http://localhost:81/purchaserequest/approve/?id={{$value->id}}&type=approve&pr_id={{$value->purchaserequest_id}}" class="btn btn-success col-md-12">Approve</a></td>
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
