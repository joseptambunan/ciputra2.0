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

  @include("master/sidebar")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Proyek</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Proyek</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <a href="{{ url('/')}}/project/add" class="btn-lg btn-primary"><i class="glyphicon glyphicon-plus-sign"></i>Tambah Data Proyek</a>
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr style="background-color: greenyellow;">
                  <th>Proyek </th>
                  <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                @foreach ( $project as $key => $value )
                <tr>
                  <td>{{ $value->name }}</td>                  
                  <td>
                    <a href="{{ url('/')}}/project/detail-update/?id={{ $value->id }}" class="btn btn-success">Detail</a>
                    <a href="{{ url('/')}}/project/detail/?id={{ $value->id }}" class="btn btn-info">Dashboard</a>
                  </td>
                </tr>
                @endforeach
              </table>
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
</body>
</html>
