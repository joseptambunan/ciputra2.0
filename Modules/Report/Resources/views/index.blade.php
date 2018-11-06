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

  @include('master/sidebar_user')

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
            <div class="box-body table-responsive">
              <table id="example2" class="table  table-bordered table-hover">
                <thead  style="background-color: greenyellow;">
                <tr>
                  <th rowspan="2">Proyek </th>
                  <th rowspan="2">Efisiensi(%)</th>
                  <th colspan="2">Luas(m2)</th>
                  <th rowspan="3">Budget Awal(Rp)</th>
                  <th rowspan="3">Budget Update(Rp)</th>
                  <th colspan="2">HPP Budget Awal (Rp/m2)</th>
                  <th colspan="2">HPP Update(Rp/m2)</th>
                  <th rowspan="3">Total Kontrak(Rp)</th>
                  <th rowspan="3">Total Terbayar(Rp)</th>
                  <th rowspan="3">Detail</th>
                </tr>
                <tr>
                  <th>Netto</th>
                  <th>Brutto</th>
                  <th>Netto</th>
                  <th>Brutto</th>                  
                  <th>Netto</th>
                  <th>Brutto</th>
                </tr>
                </thead>
                <tbody>
                @foreach ( $project as $key => $value )
                @php $detail = $value->project_pts->project; @endphp
                <tr>
                  <td>{{ $detail->name }}</td>
                  <td>{{ number_format($detail->efisiensi * 100,2 ) }} %</td>  
                  <td>{{ number_format($detail->netto,2 ) }}</td>  
                  <td>{{ number_format($detail->luas,2 ) }}</td> 
                  @if ( count($detail->hpp_update) > 0 && $detail->hpp_netto_awal > 0 ) 
                  <td>{{ number_format($detail->hpp_update->first()->nilai_budget,2 ) }}</td> 
                  <td>{{ number_format($detail->total_devcost,2 ) }}</td>

                  <td>{{ number_format($detail->hpp_update->first()->nilai_budget / $detail->netto,2 ) }}</td> 
                  <td>{{ number_format($detail->hpp_update->first()->nilai_budget / $detail->luas,2 ) }}</td>

                  <td>{{ number_format($detail->hpp_devcost_upd,2 ) }}</td> 
                  <td>{{ number_format($detail->hpp_update->last()->nilai_budget / $detail->luas,2 ) }}</td>
                  @else
                  <td>{{ number_format(0,2 ) }}</td>

                  <td>{{ number_format(0,2 ) }}</td> 
                  <td>{{ number_format(0,2 ) }}</td>
                  
                  <td>{{ number_format(0,2 ) }}</td> 
                  <td>{{ number_format(0,2 ) }}</td>
                  @endif
                  <td>{{ number_format($detail->summary_kontrak->sum("total_kontrak"),2 ) }}</td> 
                  <td>{{ number_format($detail->summary_kontrak->sum("total_kontrak_terbayar"),2 ) }}</td>              
                  <td>
                    <a href="{{ url('/')}}/report/project/detail/?id={{ $detail->id}}" class="btn btn-info">Dashboard</a>
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
