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
  <div class="content-wrapper" style="min-height: 907px;">
    <!-- Content Header (Page header) -->
    
    <section class="content-header">
      <h1 style="text-align:center">Data Purchase Order</h1>

    </section>
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border" data-widget="collapse">
              <h3 class="box-title">
                List Sedang Berjalan &nbsp; &nbsp;  
                <span class="pull-right-container">
                  <small class="label pull-right bg-yellow">1</small>
                </span>
              </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <table id="ListSedangBerjalan" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                    <thead>
                      <tr style="background-color: greenyellow;">
                        <th>No.</th>
                        <th>Nomor PO</th>
                        <th>Tanggal Dibuat</th>
                        <th>Item</th>
                        <th>Desc</th>
                        <th>Action</th> 
                      </tr>
                      </thead>
                      <tbody>
                        @php($i=1)
                        @foreach($PO_POD as $v)
                          <tr>
                            <td>{{$i++}}</td>
                            <td>{{$v->no}}</td>
                            <td>{{$v->date}}</td>
                            <td>{{$v->name}}</td>
                            <td>{{$v->description}}</td>
                            <td>
                                <button type="button" class="btn btn-block btn-primary" onclick="location.href='{{ url('/')}}/purchaseorder/detail/?id={{$v->id}}'" style="padding-left:0px">
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
      
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary collapsed-box">
            <div class="box-header with-border" data-widget="collapse">
              <h3 class="box-title">
                List Telah Selesai &nbsp; &nbsp;  
                <span class="pull-right-container">
                  <small class="label pull-right bg-yellow">1</small>
                </span>
              </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <div class="box-body" style="display: none;">
              
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
</body>
</html>
