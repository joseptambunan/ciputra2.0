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
      <h1>Data Proyek <strong>{{ $budgets->project->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Dokumen</h3>
              <h3>No. Budget : {{ $budgets->no}}</h3>
              <a href="{{ url('/')}}/report/document/budget/detail/?id={{ $budgets->id}}" class="btn btn-warning">Kembali</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-hover">
                <thead class="head_table">
                  <tr>
                    <td rowspan="2">No.</td>       
                    <td rowspan="2">Item Pekerjaan</td>
                    <td rowspan="2">Volume</td>
                    <td rowspan="2">Satuan</td>
                    <td rowspan="2">Nilai</td>
                    <td rowspan="2">Subtotal</td>
                    <td colspan="2">Referensi</td>
                  </tr>
                  <tr>                  
                    <td>Nilai Terendah</td>
                    <td>Nilai Tertinggi</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $coa as $key => $value )
                  @if ( Modules\Pekerjaan\Entities\Itempekerjaan::find($value['id'])->group_cost == "1")
                  @php $itempekerjaan = Modules\Pekerjaan\Entities\Itempekerjaan::find($value['id']); @endphp
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $itempekerjaan->name }}</td>
                    <td>{{ $value['volume'] }}</td>
                    <td>{{ $value['satuan'] }}</td>
                    <td>{{ number_format($value['nilai']) }}</td>
                    <td>{{ number_format($value['nilai'] * $value['volume']) }}</td>
                    <td>
                      {{ number_format($itempekerjaan->nilai_lowest['nilai']) }}<br>
                      {{ ($itempekerjaan->nilai_lowest['project']) }}
                    </td>
                    <td>
                      {{ number_format($itempekerjaan->nilai_maximum['nilai']) }}<br>
                      {{ $itempekerjaan->nilai_maximum['project'] }}
                    </td>
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
