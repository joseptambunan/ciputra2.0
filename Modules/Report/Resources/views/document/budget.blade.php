<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>User QS | Dashboard</title>
  @include("master/header")
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include('master/sidebar_report')

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
              <h3 class="box-title">Data Dokumen</h3>
              <a class="btn btn-warning" href="{{ url('/')}}/report/project/document/?id={{ $project->id }}">Kembali</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example2" class="table table-bordered table-hover">
                <thead  style="background-color: greenyellow;">
                <tr>
                  <th>No. Budget</th>
                  <th>Department</th>
                  <th>Nilai</th>
                  <th>Tahunan</th>
                  <th>Budget Parent</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Tanggal Dibuat</th>
                  <th>Dibuat Oleh</th>
                  <th>Detail</th>
                </tr>                
                </thead>
                <tbody>
                  @foreach ( $project->all_budgets as $key => $value )
                  @if ( $value->nilai > 0 )
                    <tr>
                      <td>{{ $value->no }}</td>
                      <td>{{ $value->department->name }}</td>
                      <td>{{ number_format($value->nilai,2) }}</td>
                      <td><a class="btn btn-sm btn-info">{{ $value->budget_tahunans->count() }} Budget Tahunan</a></td>
                      <td>{{ $value->parent->no or '' }}</td>
                      <td>{{ $value->start_date->format("d/m/Y") }}</td>
                      <td> @if ( $value->deleted_at == null ) {{ $value->end_date->format("d/m/Y") }} @else {{ date("d/m/Y",strtotime($value->deleted_at )) }}  @endif </td>
                      <td>{{ $value->created_at->format("d/m/Y") }}</td>
                      <td>{{ $value->created_by }}</td>
                      <td><a class="btn btn-primary" href="{{ url('/')}}/report/document/budget/detail?id={{ $value->id }}">Detail</a></td>
                    </tr>
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

</body>
</html>
