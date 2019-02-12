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
      <h1>Data Pengajuan Biaya<strong> {{ $project->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
   
            <!-- /.box-header -->
            <div class="box-body">
              
              <div class="col-md-12 table-responsive">
                <a href="{{ url('/')}}/pengajuanbiaya/create" class="btn btn-primary">Tambah Pengajuan Biaya</a><br><br>
                <table class="table table-bordered">
                  <thead class="head_table">
                    <tr>
                      <td>No.</td>
                      <td>Departement</td>
                      <td>Keterangan</td>
                      <td>Nilai</td>
                      <td>Dibuat Oleh</td>
                      <td>Tanggal</td>
                      <td>Status</td>
                      <td>Detail</td>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ( $pengajuanbiaya as $key => $value )
                    <tr>
                      <td>{{ $value->no or '' }}</td>
                      <td>{{ $value->budget_tahunan->budget->department->name or ''}}</td>
                      <td>{{ $value->description or '' }}</td>
                      <td>{{ number_format($value->nilai) }}</td>
                      <td>{{ $value->created_by }}</td>
                      <td>{{ $value->date }}</td>
                      <td><span class="{{ $arraystatus[$value->status]['class']}}">{{ $arraystatus[$value->status]['label']}}</span></td>
                      <td><a class="btn btn-primary" href="{{ url('/')}}/pengajuanbiaya/detail/?id={{$value->id }}">Detail</a></td>
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

@include("pengajuanbiaya::app")
</body>
</html>
