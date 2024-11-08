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
      <h1>Data Bank</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
   
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-6">
                <a href="{{ url('/')}}/rekanan/add" class="btn btn-primary">Tambah Rekanan</a>
                <a href="{{ url('/')}}/rekanan/usulan" class="btn btn-warning">Daftar Usulan Proyek</a>
              </div>
              <div class="col-md-12">
            	<table id="example3" class="table table-bordered table-hover">
                <thead>
                <tr style="background-color: greenyellow;">
                  <th>Nama</th>
                  <th>Spesifikasi</th>
                  <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                  @foreach( $rekanan_group as $key => $value )
                  <tr>
                    <td>{{ $value->name or ''}}</td>
                    <td></td>
                    <td><a href="{{ url('/')}}/rekanan/detail?id={{ $value->id }}" class="btn btn-success">Detail</a></td>
                  </tr>
                  @endforeach
                </tbody>
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
  @include("master/copyright")

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("bank::app")
</body>
</html>
