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
      <h1>HPP Development Cost Report ( summary )</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Proyek <strong>{{ $project->name }}</strong></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example2" class="table  table-bordered table-hover">
                <thead  style="background-color: greenyellow;">
                <tr>
                  <th rowspan="2">Kawasan </th>
                  <th rowspan="2">Efisiensi</th>
                  <th colspan="2">Luas(m2)</th>
                  <th rowspan="3">Budget Rev(Rp)</th>
                  <th rowspan="3">HPP Rev(Rp/m2)</th>
                  <th rowspan="3">Total Kontrak(Rp)</th>
                  <th rowspan="3">Total Terbayar(Rp)</th>
                </tr>
                <tr>            
                  <th>Netto</th>
                  <th>Brutto</th>
                </tr>
                </thead>
                <tbody>
                  <tr style="background-color: #2e75e8;color:white;font-weight: bolder;">
                    <td></td>
                    <td>
                      @if ( $project->luas > 0 )
                        {{ number_format(($project->netto / $project->luas) * 100 ,2) }} %
                      @else
                          {{ number_format(0 ,2) }} %
                      @endif
                    </td>
                    <td>{{ number_format($project->netto) }}</td>
                    <td>{{ number_format($project->luas) }}</td>
                    <td>{{ number_format($project->total_budget) }}</td>
                    <td>
                      @if ( $project->netto <= 0 )
                         {{ number_format(0,2)}}
                      @else
                         {{ number_format($hpp_akhir = ( $project->total_budget )/ $project->netto,2) }}</h3>
              
                      @endif
                    </td>
                    <td>{{ number_format($project->dev_cost_only) }}</td>
                    <td>{{ number_format($project->nilai_realisasi) }}</td>
                  </tr>
                  @foreach ( $project->kawasans as $key => $value )
                    <tr>
                      <td>{{ $value->name }}</td>
                      <td>
                        @if ( $value->netto_kawasan > 0 )
                        {{ number_format( ($value->netto_kawasan / $value->lahan_luas) * 100,2) }} %
                        @else
                        0 %
                        @endif
                      </td>
                      <td>{{ number_format($value->netto_kawasan )}}</td>
                      <td>{{ number_format($value->lahan_luas)}}</td>
                      <td>{{ number_format($value->total_budget)}}</td>                     
                      <td>
                        @if ( $value->netto_kawasan > 0 )
                        {{ number_format($value->total_budget / $value->netto_kawasan )}}
                        @endif
                      </td>
                      <td>
                        @if ( $value->HppDevCostReportSummary->count() > 0 )
                          {{ number_format($value->HppDevCostReportSummary->last()->total_kontrak )}}
                        @else
                          {{ number_format(0,2)}}
                        @endif
                      </td>
                      <td>
                          @if ( $value->HppDevCostReportSummary->count() > 0 )
                        {{ number_format($value->HppDevCostReportSummary->last()->total_kontrak )}}
                      @else
                        {{ number_format(0,2)}}
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
