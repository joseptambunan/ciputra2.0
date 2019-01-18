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
  @include("master/sidebar_report")
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Proyek : <strong>{{ $project->name }}</strong></h1>  
    </section>
     <!-- Main content -->
    <input type="hidden" name="variabel_cash_out" id="variabel_cash_out" value="{{ $variabel_cash_out }}">
    <input type="hidden" name="variabel_carry_over" id="variabel_carry_over" value="{{ $variabel_carry_over }}">
    <input type="hidden" name="variabel_realiasasi" id="variabel_realiasasi" value="{{ $variabel_realiasasi }}">
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
              <h3>{{ number_format( $project->nilai_realisasi /$project->total_budget,2  )}}<sup style="font-size: 20px">%</sup></h3>
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
              <li class="active"><a href="#revenue-chart" data-toggle="tab">All </a></li><!-- 
              <li><a href="#chart1" data-toggle="tab">CarryOut SPK </a></li>
              <li><a href="#chart2" data-toggle="tab">CashOut CarryOver</a></li>
              <li><a href="#chart3" data-toggle="tab">CashOut Realisasi</a></li> -->
            </ul>
            <div class="tab-content no-padding">
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                <div class="chart">
                  <canvas id="areaChart" style="height:250px"></canvas>
                </div>
              </div>
              <div class="chart tab-pane" id="chart1" style="position: relative; height: 300px;">
                <div class="chart">
                  <canvas id="areaChart1" style="height:250px"></canvas>
                </div>
              </div>
              <div class="chart tab-pane" id="chart2" style="position: relative; height: 300px;">
                <div class="chart">
                  <canvas id="areaChart2" style="height:250px"></canvas>
                </div>
              </div>
              <div class="chart tab-pane" id="chart3" style="position: relative; height: 300px;">
                <div class="chart">
                  <canvas id="areaChart3" style="height:250px"></canvas>
                </div>
              </div>
              <div class="box-body">
                <small class="label label-danger">&nbsp;&nbsp;</small>Cash Out SPK<br>                
                <small class="label label-primary">&nbsp;&nbsp;</small>Cash Out CarryOver<br>              
                <small class="label label-warning">&nbsp;&nbsp;</small>Realisasi<br><br>
                <table class="table">
                  <thead class="head_table">
                    <tr>
                      <td>Jenis</td>
                      <td>Rencana</td>
                      <td>Realisasi</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Budget Cash Out SPK</td>
                      <td style="text-align: right;">{{ number_format($nilai_cash_out)}}</td>
                      <td style="text-align: right;">{{ number_format(0)}}</td>
                    </tr>
                    <tr>
                      <td>Budget Cash Out Carry Over</td>
                      <td style="text-align: right;">{{ number_format($nilai_carry_over)}}</td>
                      <td style="text-align: right;">{{ number_format(0)}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
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
              @php $total = 0; $hpp_akhir = 0;@endphp
              @foreach ( $project->budgets as $key => $value )
              @if ( $value->deleted_at == "" )
                @php $total = $total + $value->total_dev_cost;@endphp
              @endif
              @endforeach
              <h3>Luas Brutto ( yang belum bisa dikembangkan )   : {{ number_format($project->luas_nonpengembangan,2) }} m2 </h3>
              <h3>Luas Brutto ( yang bisa dikembangkan )   : {{ number_format($project->luas)}} m2 </h3>
              <h3>Luas Netto     : {{ number_format($project->netto)}} m2</h3>
              @if ( $project->luas > 0 )
              <h3>Sellable       : {{ number_format(($project->netto / $project->luas) * 100 ,2) }} %</h3>
              @else
              <h3>Sellable       : {{ number_format(0 ,2) }} %</h3>
              @endif
              <h3>Total Budget   : Rp. {{ number_format($project->total_budget,2) }} </h3>
              <h3>Total Kontrak  : Rp. {{ number_format($project->nilai_report_realisasi_dev_cost,2) }} </h3>
              <h3>Total BAP      : Rp. {{ number_format($project->nilai_report_terbayar_dev_cost,2) }} </h3>
              <h3>Sisa Budget    : Rp. {{ number_format( $project->total_budget - $project->nilai_report_terbayar_dev_cost,2)}}
              @if ( $project->netto <= 0 )
              <h3>HPP Dev Cost   : Rp. {{ number_format(0,2) }} / m2</h3>
              @else
              <h3>HPP Dev Cost   : Rp. {{ number_format($hpp_akhir = ( $project->total_budget )/ $project->netto,2) }} / m2</h3>
              @endif
              <h3>HPP Con Cost </h3>
              <table class="table table-bordered">
                <thead class="head_table">
                  <tr>
                    <td>Tipe Bangunan (LB/LT)</td>
                    <td>Kategori Bangunan</td>
                    <td>HPP(Rp/m2)</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $project->unittype as $key => $value )
                  <tr>
                    <td>{{ $value->name or ''}} &nbsp;{{ $value->luas_bangunan}} / {{ $value->luas_tanah }}</td>
                    <td>{{ $value->category->category_project->category_detail->category->name or ''}} / {{ $value->category->category_project->category_detail->sub_type or ''}}</td>
                    @if ( $value->category != "" )
                    <td>{{ number_format($value->category->nilai,2)}}</td>
                    @else
                    <td>{{ number_format(0,2)}}</td>
                    @endif
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
         <!-- /.box -->      
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">
         <!-- Calendar -->
          <div class="box box-solid bg-green-gradient">
            <div class="box-header">
              <i class="fa fa-calendar"></i>
              <h3 class="box-title">Calendar</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <!-- button with a dropdown -->
                <div class="btn-group">
                  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bars"></i></button>
                  <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="#">Add new event</a></li>
                    <li><a href="#">Clear events</a></li>
                    <li class="divider"></li>
                    <li><a href="#">View calendar</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <!--The calendar -->
              <div id="calendar" style="width: 100%"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <div class="box box-solid">
            <h4>Input Luas Tanah yang sudah dibukukan</h4>
            <form action="{{ url('/')}}/project/save-hppupdate" method="post" name="form1">
              {{ csrf_field() }}
              <div class="form-group">
                <label>Luas EREM</label>
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                <input type="text" class="form-control" name="luas_erem" autocomplete="off">
              </div>
              <div class="form-group">
                <label>Luas Book</label>
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                <input type="text" class="form-control" name="luas_book" autocomplete="off">
              </div>
              <div class="form-group">
                <button class="btn-primary btn" type="submit">Simpan</button>
              </div>
            
            <h3>HPP Update</h3>

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
                @if ( $project->hpp_update->first()->netto > 0 )
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
                @else
                <tr>
                  <td>HPP Awal</td>
                  <td>{{ number_format($project->hpp_update->first()->nilai_budget,2)}}</td>
                  <td>{{ number_format(0,2) }}</td>
                </tr>
                <tr>
                  <td>HPP Update QS</td>
                  <td>{{ number_format($project->hpp_update->last()->nilai_budget,2)}}</td>
                  <td>{{ number_format( 0,2)}}</td>
                </tr>
                <tr>
                  <td>HPP Update Accounting</td>
                  <td><span id="budget_update"></span></td>
                  <td><span id="hpp_update"></span></td>
                </tr>
                @endif
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
                  <td style="text-align: right;">{{ number_format($project->luas_rencana_netto_hpp,2)}}</td>
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
                  <input type="hidden" id="tmp_hpp" name="tmp_hpp" value="{{ number_format($project->hpp_devcost_upd,2) }}">
                  <input type="hidden" id="tmp_budget" value="{{ number_format($project->total_devcost,2) }}">
                </tr>
              </thead>
            </table>
            </form>
          </div>

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Add the sidebar's background. This div must be placed
      immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>

<!-- ./wrapper -->




</body>

@include("master/footer")
@include("report::chart")
</html>

