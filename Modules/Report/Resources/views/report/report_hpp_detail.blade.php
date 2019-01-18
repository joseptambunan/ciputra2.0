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
      <h1>HPP Development Cost Report ( detail )</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Proyek <strong>{{ $project->name }}</strong></h3><br>
              <h3 class="box-title">Tahun <strong>{{ date("Y") }}</strong></h3>
            </div>
              
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div class="col-md-3">
                <div class="form-group">
                  <select class="form-control">
                    <label>Tahun </label>
                    @for($i= 2015; $i <= date("Y"); $i++ )
                    <option value="{{ $i}}">{{ $i }}</option>
                    @endfor
                  </select>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary">Cari</button>
                </div>
              </div><br>  
              <table id="example2" class="table  table-bordered table-hover">
                <thead  style="background-color: greenyellow;">
                <tr>
                  <th rowspan="2">Kawasan </th>
                  <th colspan="2">Budget</th>
                  <th colspan="2">Kontrak</th>
                  <th rowspan="3">Proggres Lapangan</th>
                  <th rowspan="3">Proggress BAP</th>
                  <th colspan="2">BAP Terbayar(Rp)</th>
                  <th colspan="3">Saldo</th>
                </tr>
                <tr>            
                  <th>Budget Awal</th>
                  <th>Budget Tahun</th>
                  <th>Kontrak Awal</th>
                  <th>Kontrak Tahun</th>
                  <th>Terbayar Total</th>
                  <th>Terbayar Tahun</th>
                  <th>Budget Awal</th>
                  <th>Budget Tahun</th>
                  <th>Total Kontrak</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ( $project->kawasans as $key => $value )
                  <tr>
                    <td>{{ $value->name }}</td>
                    <td>{{ number_format($value->total_budget) }}</td>
                    <td>{{ number_format($value->total_budget_tahunan) }}</td>                    
                    <td>{{ number_format($value->total_kontrak_proporsional) }}</td>             
                    <td>{{ number_format($value->total_kontrak_tahun_proporsional) }}</td>
                    <td>0</td>
                    <td>0</td>
                    <td>{{ number_format($value->total_terbayar_proporsional) }}</td>                     
                    <td>{{ number_format($value->nilai_terbayar_tahun) }}</td>  
                    <td>{{ number_format($value->total_budget) }}</td>
                    <td>{{ number_format($value->total_budget_tahunan) }}</td>               
                    <td>{{ number_format($value->total_kontrak_proporsional) }}</td>               
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
