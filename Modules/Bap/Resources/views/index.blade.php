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
      <h1>Data Proyek {{ $project->name }}</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data BAP </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead class="head_table">
                <tr>
                  <th>No. BAP </th>
                  <th>No. SPK</th>
                  <th>Department From</th>
                  <th>Nilai</th>
                  <th>Tanggal</th>
                  <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ( $project->spks as $key => $value )
                  @if ( $value->tender != "" )
                  @foreach ( $value->baps as $key2 => $value2 )
                  <tr>
                    <td>{{ $value2->no }}</td>
                    <td><a href="{{ url('/')}}/spk/detail?id={{$value->id}}" class=" btn btn-warning">Detail : {{ $value->no }}</a></td>
                    <td>{{ $value->tender->rab->workorder->departmentFrom->name or '' }}</td>
                    <td>{{ number_format($value2->nilai) }}</td>
                    <td>{{ $value2->created_at }}</td>
                    <td><a href="{{ url('/')}}/bap/detail?id={{ $value2->id }}" class="btn btn-warning">Detail</td>                   
                  </tr>
                  @endforeach
                  @endif
                  @endforeach
                </tbody>
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
@include("spk::app")
</body>
</html>
