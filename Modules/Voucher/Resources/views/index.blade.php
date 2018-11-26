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
              <h3 class="box-title">Data Voucher </h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <a href="{{ url('/')}}/voucher/add" class="btn-lg btn-primary"><i class="glyphicon glyphicon-plus-sign"></i>Tambah Data Voucher</a>
              <table id="example2" class="table table-bordered table-hover">
                <thead class="head_table">
                <tr>
                  <th>No. Voucher </th>
                  <th>Department From</th>
                  <th>Nilai</th>
                  <th>Tanggal</th>
                  <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                  @php $nilai = 0; @endphp
                  @foreach ( $project->voucher as $key => $value )    
                  @php $nilai = $nilai + $value->details->sum('nilai'); @endphp              
                  <tr>
                    <td>{{ $value->no }}</td>
                    <td>{{ $value->department->name }}</td>
                    <td style="text-align: right;">{{ number_format($value->details->sum('nilai') ) }}</td>
                    <td>{{ $value->created_at }}</td>
                    <td>
                      <a href="{{ url('/')}}/voucher/show?id={{ $value->id }}" class="btn btn-warning">Detail
                    </td>                   
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{ number_format($nilai)}}
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
