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
  @include("master/sidebar_report")
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Proyek : <strong>{{ $project->name }}</strong></h1>  
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ count($project->spks )}}</h3>
              <p>SPK</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ number_format( $project->percentage_budget )}}<sup style="font-size: 20px">%</sup></h3>
              <p>Budget</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ number_format(count($project->total_rekanan))}}</h3>
              <p>Rekanan</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ number_format($project->total_bap) }}</h3>
              <p>BAP</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#revenue-chart" data-toggle="tab">2018 </a></li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
          <!-- /.box (chat box) -->
          <!-- TO DO List -->
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>
              <h3 class="box-title">Data Umum</h3>     
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @php $total = 0; $hpp_akhir = 0; @endphp
              @foreach ( $project->budgets as $key => $value )
              @if ( $value->deleted_at == "" )
                @php $total = $total + $value->total_dev_cost;@endphp
              @endif
              @endforeach
              <h3>Luas Brutto   : {{ number_format($project->luas)}} m2 </h3>
              <h3>Luas Netto    : {{ number_format($project->netto)}} m2</h3>
              <h3>Sellable      : {{ number_format(($project->netto / $project->luas) * 100 ,2) }} %</h3>
              <h3>Total Budget  : Rp. {{ number_format($total) }} </h3>
              <h3>Total BAP     : Rp. {{ number_format($project->nilai_total_bap,2) }} </h3>
              <h3>Tersisa       : Rp. {{ number_format( $total - $project->nilai_total_bap,2)}}
              @if ( $project->netto <= 0 )
              <h3>HPP Dev Cost  : Rp. {{ number_format(0,2) }} / m2</h3>
              @else
              <h3>HPP Dev Cost  : Rp. {{ number_format($hpp_akhir = $total / $project->netto,2) }} / m2</h3>
              @endif
              <h3>HPP Con Cost  : Rp. {{ number_format(0,2)}} / m2</h3>          
            </div>
          </div>
          <!-- /.box -->
         </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">
          <!-- Calendar -->


          <div class="box box-solid">
            <h3>HPP Update</h3>
            <a href="{{ url('/')}}/report/project/hpp/history?id={{ $project->id}}" class="btn btn-primary">Histroy Budget dan HPP</a><br>
            <table class="table table-borderd">
              <thead class="head_table">
                <tr>
                  <td></td>
                  <td>Budget(Rp)</td>
                  <td>HPP(Rp/m2)</td>
                </tr>
              </thead>
              <tbody>

              @if ( count($project->hpp_update) > 0 )
                <tr>
                  <td>HPP Awal</td>
                  <td>{{ number_format($project->hpp_update->first()->nilai_budget,2)}}</td>
                  <td>{{ number_format( $project->hpp_update->first()->nilai_budget / $project->hpp_update->first()->netto ,2) }}</td>
                </tr>
                <tr>
                  <td>HPP Update QS</td>
                  <td>{{ number_format($project->hpp_update->last()->nilai_budget,2)}}</td>
                  <td>{{ number_format( $project->hpp_netto_akhir,2)}}</td>
                </tr>
                <tr>
                  <td>HPP Update Accounting</td>
                  <td><span id="budget_update"></span></td>
                  <td><span id="hpp_update"></span></td>
                </tr>
              @endif
              </tbody>
            </table>

            <table class="table table-bordered">
              <thead class="head_table">
                <tr>
                  <td>Dev Cost yang sudah dibayar (Rp)</td>
                  <td style="text-align: right;">{{ number_format($project->dev_cost_terbayar,2) }}</td>
                </tr>
                <tr>
                  <td>Dev Cost yang sudah dibebankan ke HPP (Rp)</td>
                  <td style="text-align: right;">{{ number_format($project->dev_cost_dibebankan,2)}}</td>
                </tr>
                <tr>
                  <td>Persediaan Dev Cost (Rp)</td>
                  <td style="text-align: right;">{{ number_format( $project->persediaan_dev_cost ,2)}}</td>
                </tr>
                <tr>
                  <td>Hutang Bayar (Rp)</td>
                  <td style="text-align: right;">{{ number_format( $project->hutang_bayar ,2) }}</td>
                </tr>
                <tr>
                  <td>Hutang Bangun (Rp)</td>
                  <td style="text-align: right;">{{ number_format($project->hutang_bangun ,2) }}</td>
                </tr>
                <tr>
                  <td>Total DevCost (Rp)</td>
                  <td style="text-align: right;">{{ number_format($project->total_devcost,2) }}</td>
                </tr>
                <tr>
                  <td>Luas Gross (m2)</td>
                  <td style="text-align: right;">{{ number_format($project->luas_gross_hpp,2)}} </td>
                </tr>
                 <tr>
                  <td>Luas Rencana Netto (m2)</td>
                  <td style="text-align: right;">{{ number_format($project->luas_rencana_netto_hpp,2)}} </td>
                </tr>
                <tr>
                  <td>Luas yang belum dibukukan ( Sales backlog ) (m2)</td>
                  <td style="text-align: right;">{{ number_format( $project->sales_back_log,2) }}</td>
                </tr>
                <tr>
                  <td>Total Luas Stock Netto (m2)</td>
                  <td style="text-align: right;">{{ number_format( $project->total_stock ,2) }}</td>
                </tr>
                <tr>
                  <td>Nilai Analisa HPP Devcost</td>
                  <td style="text-align: right;">{{ number_format( $project->hpp_devcost_upd ,2 ) }}</td>
                  <input type="hidden" id="tmp_hpp" value="{{ number_format($project->hpp_devcost_upd,2) }}">
                  <input type="hidden" id="tmp_budget" value="{{ number_format($project->total_devcost,2) }}">
                </tr>
              </thead>
            </table>

          </div>

        </section>

        <!-- right col -->

      </div>

      <!-- /.row (main row) -->



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



@include("master/footer")
<script type="text/javascript">
  $("#budget_update").text($("#tmp_budget").val());
  $("#hpp_update").text($("#tmp_hpp").val());

  $("#hpp_update").number(true);
  $("#budget_update").number(true);
</script>
</body>

</html>
