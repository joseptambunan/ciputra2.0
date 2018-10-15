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
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Workorder</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <a href="{{ url('/')}}/workorder/add" class="btn-lg btn-primary"><i class="glyphicon glyphicon-plus-sign"></i>Tambah Data Workorder</a>
              <table id="example2" class="table table-bordered table-hover">
                <thead class="head_table">
                <tr>
                  <th>No. Workorder </th>
                  <th>Nilai</th>
                  <th>Departemen</th>
                  <th>Dibuat oleh</th>
                  <th>Tanggal Dibuat</th>
                  <th>Detail</th>
                  <th>Status Approval</th>
                  <th>RAB</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ( $workorder as $key => $value )
                  <tr>
                    <td>{{ $value->no }}</td>
                    <td>{{ number_format($value->nilai) }}</td>
                    <td>{{ $value->departmentFrom->name }}</td>
                     <td>{{ \App\User::find($value->created_by)->user_name }}</td>
                    <td>{{ $value->created_at }}</td>
                    <td><a href="{{ url('/')}}/workorder/detail/?id={{ $value->id }}" class="btn btn-warning">Detail</a></td>
                    <td>
                      @if ( $value->approval != "" )
                      @php
                        $array = array (
                          "6" => array("label" => "Disetujui", "class" => "label label-success"),
                          "7" => array("label" => "Ditolak", "class" => "label label-danger"),
                          "1" => array("label" => "Dalam Proses", "class" => "label label-warning"),
                          "" => array("label" => "","class" => "")
                        )
                      @endphp
                      <span class="{{ $array[$value->approval->approval_action_id]['class'] }}">{{ $array[$value->approval->approval_action_id]['label'] }}</span>
                      @endif               
                    </td>
                    <td>
                      @if ( $value->approval != "" )
                        @if ( $value->approval->approval_action_id == "6" )
                        <a class="btn btn-warning" href="{{ url('/')}}/rab/?workorder_id={{ $value->id }}">{{ $value->rabs->count() }}RAB</a>
                        @endif
                      @endif
                    </td>
                  </tr>
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
</body>
</html>
