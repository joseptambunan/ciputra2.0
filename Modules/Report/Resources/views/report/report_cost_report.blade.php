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
      <h1>Cost Report</h1>

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
              <table id="example2" class="table  table-bordered table-hover" cellpadding="0" cellspacing="0">
                <thead  style="background-color: greenyellow;">
                  <tr>
                    <th>Kawasan</th>
                    <th rowspan="3">Tgl SPK</th>
                    <th rowspan="3">Acuan SPK</th>
                    <th rowspan="3">Pekerjaan</th>
                    <th rowspan="3">Rekanan</th>
                    <th rowspan="3">Tgl ST1</th>
                    <th rowspan="3">Tgl ST2</th>
                    <th rowspan="3">RAB/ Budget(Rp)</th>
                    <th rowspan="2" colspan="3">Kontrak(Rp)</th>
                    <th rowspan="3">Progress Lapangan(%)</th>
                    <th rowspan="3">Progress BAP(%)</th>
                    <th rowspan="3">BAP Terbayar(Rp)</th>
                    <th rowspan="2" colspan="2">Saldo(Rp)</th>
                  </tr>
                  <tr>
                    <th>Pekerjaan</th>
                  </tr>
                  <tr>
                    <th>Nomor SPK</th>
                    <th>SPK</th>
                    <th>VO</th>
                    <th>Total</th>
                    <th>Budget</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $array_costreport as $key => $value )
                    <tr>
                      <td><strong>{{ $value['kawasan'] }}</strong></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    @foreach( $value['itempekerjaan'] as $key2 => $value2 )
                    <tr style="background-color: grey;font-weight: bolder;color:white;">
                      <td><i><span>{{ $value2['name']}}</span></i></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>{{ number_format($value2['total_rab'])}}</td>
                      <td>{{ number_format($value2['total_kontrak'])}}</td>
                      <td>{{ number_format($value2['total_vo'])}}</td>
                      <td>{{ number_format($value2['total_spk'])}}</td>
                      <td>{{ number_format($value2['rata_progress'])}}</td>
                      <td>{{ number_format($value2['rata_diakui'])}}</td>
                      <td>{{ number_format($value2['total_terbayar'])}}</td>
                      <td>{{ number_format($value2['total_saldo_budget'])}}</td>
                      <td>{{ number_format($value2['total_saldo_terbayar'])}}</td>
                    </tr>
                    @foreach( $array_spk as $key3 => $value3 )
                      @php $nilai_rab = 0; @endphp
                      @if ( $value3['code'] == $value2['code'])
                        @if ( $value3['project_kawasan_id'] == $value['kawasan'])
                        <tr>
                          <td>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span>{{ $value3['spk_no']}}</span><br>                            
                            <a href="#" class="btn-xs btn-primary">Detail</a>
                          </td>
                          <td>{{ $value3['date']}}</td>
                          <td>
                            {{ $value3['acuan']}}<br>
                            <a href="#" class="btn-xs btn-primary">Detail</a>
                          </td>
                          <td>{{ $value3['rekanan']}}</td>
                          <td>{{ $value3['st_1']}}</td>
                          <td>{{ $value3['st_2']}}</td>
                          <td>{{ number_format($value3['rab'])}}</td>
                          <td>{{ number_format($value3['nilai'])}}</td>
                          <td>{{ number_format($value3['nilai_vo'])}}</td>
                          <td>{{ number_format($value3['total'])}}</td>
                          <td>{{ number_format($value3['lapangan'],2)}}</td>
                          <td>{{ number_format($value3['diakui'],2)}}</td>
                          <td>{{ number_format($value3['terbayar'])}}</td>
                          <td>{{ number_format($value3['saldo'])}}</td>
                          <td>{{ number_format($value3['sisa'])}}</td>
                        </tr>
                        @endif
                      @endif
                    @endforeach
                    @endforeach
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
 @include("master/copyright")
  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include("master/footer_table")

</body>
</html>
