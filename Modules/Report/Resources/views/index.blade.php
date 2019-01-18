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
              <h3 class="box-title">Biaya Proyek</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example2" class="table  table-bordered table-hover">
                <thead  style="background-color: greenyellow;">
                <tr>
                  <th rowspan="2">Proyek </th>
                  <th rowspan="2">Efisiensi(%)</th>
                  <th colspan="2">Luas(m2)</th>
                  <th colspan="6">Budget Devcost</th>
                  <th colspan="2">Total Kontrak</th>
                  <th colspan="2">Total Terbayar(Rp)</th>
                  <th colspan="2">Hutang Bayar(Rp)</th>
                  <th colspan="2">Hutang Bangun(Rp)</th>                  
                  <th colspan="2">Budget Cash Out YTD(Rp)</th>
                  <th rowspan="3">Detail</th>
                </tr>
                <tr>
                  <th>Netto</th>
                  <th>Brutto</th>                  
                  <th>Devcost Awal(Rp)</th>
                  <th>Devcost Update Acc(Rp)</th>
                  <th>Hpp Awal Netto(Rp/m2)</th>
                  <th>Hpp Awal Brutto(Rp/m2)</th>                  
                  <th>Hpp Update Acc Netto(Rp/m2)</th>
                  <th>Hpp Update Acc Brutto(Rp/m2)</th>
                  <th>Devcost(Rp)</th>
                  <th>Concost(Rp)</th>                  
                  <th>Devcost(Rp)</th>
                  <th>Concost(Rp)</th>                
                  <th>Devcost(Rp)</th>
                  <th>Concost(Rp)</th>                
                  <th>Devcost(Rp)</th>
                  <th>Concost(Rp)</th>               
                  <th>Devcost(Rp)</th>
                  <th>Concost(Rp)</th>
                </tr>
                </thead>
                <tbody>
                @foreach ( $project as $key => $value )
                @if ( $value->project_pts)
                  @php $detail = $value->project_pts->project; @endphp
                  @if ( count($detail->new_hpp_con_cost_summary) > 0 && count($detail->hpp_dev_cost_summary_report) > 0 )
                    <tr>
                      <td>{{ $detail->name }}</td>
                      <td>{{ number_format($detail->efisiensi * 100,2 ) }} %</td>  
                      <td>{{ number_format($detail->netto,2 ) }}</td>  
                      <td>{{ number_format($detail->luas,2)}}</td>
                      <td style="text-align: right;">{{ number_format($detail->budget_dev_cost_awal,2)}}</td>
                      <td style="text-align: right;">{{ number_format($detail->budget_dev_cost_upd,2)}}</td>
                      <td>{{ number_format($detail->hpp_dev_cost_awal_netto,2)}}</td>
                      <td>{{ number_format($detail->hpp_dev_cost_awal_brutto,2)}}</td>
                      <td>{{ number_format($detail->hpp_dev_cost_upd_netto,2)}}</td>
                      <td>{{ number_format($detail->hpp_dev_cost_upd_brutto,2)}}</td>
                      <td style="text-align: right;">{{ number_format($total_kontrak = $detail->hpp_dev_cost_summary_report->last()->total_kontrak,2)}}</td>
                      <td style="text-align: right;">{{ number_format($detail->new_hpp_con_cost_summary->last()->total_kontrak)}}</td>
                      <td style="text-align: right;">{{ number_format($total_terbayar = $detail->hpp_dev_cost_summary_report->last()->total_kontrak_terbayar,2)}}</td>
                      <td style="text-align: right;">{{ number_format($detail->new_hpp_con_cost_summary->last()->total_kontrak_terbayar)}}</td>
                      <td style="text-align: right;">{{ number_format($total_kontrak - $total_terbayar )}}</td>
                      <td style="text-align: right;">{{ number_format($detail->new_hpp_con_cost_summary->last()->total_kontrak - $detail->new_hpp_con_cost_summary->last()->total_kontrak_terbayar)}}</td>
                      <td style="text-align: right;">{{ number_format($detail->budget_dev_cost_upd - $total_kontrak )}}</td>
                      <td style="text-align: right;">{{ number_format($detail->hutang_bangun_con_cost)}}</td>
                      <td style="text-align: right;">{{ number_format($detail->real_cash_out_dev_cost )}}</td>
                      <td style="text-align: right;">{{ number_format($detail->real_cash_out_con_cost )}}</td>
                      <td>
                        <a href="{{ url('/')}}/report/project/detail/?id={{ $detail->id}}" class="btn btn-info">Dashboard</a>
                      </td>
                    </tr>
                  @endif
                @endif
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
