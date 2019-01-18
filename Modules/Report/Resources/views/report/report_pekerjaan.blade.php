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
                    <th>Pekerjaan</th>
                    <th rowspan="3">Tgl SPK</th>
                    <th rowspan="3">Acuan SPK</th>
                    <th rowspan="3">Pekerjaan</th>
                    <th rowspan="3">Nama Rekanan</th>
                    <th rowspan="3">Nilai SPK(Rp)</th>
                    <th rowspan="3">Nilai VO(Rp)</th>
                    <th rowspan="3">Total Kontrak(Rp)</th>
                    <th rowspan="3">Total Termyn</th>
                    <th rowspan="3">Sisa Kontrak(Rp)</th>
                    <th rowspan="3">Tgl ST1</th>
                    <th rowspan="3">Tgl ST2</th>
                  </tr>
                  <tr>
                    <th>Proyek / Kawasan</th>
                  </tr>
                  <tr>
                    <th>Nomor SPK</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $array_pekerjaan as $key => $value )
                  <tr>
                    <td><strong>{{ $value['name'] }}</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ number_format($value['total_kontrak'])}}</td>
                    <td>{{ number_format($value['total_vo'])}}</td>
                    <td>{{ number_format($value['total_spk'])}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  @foreach( $value['kawasan'] as $key2 => $value2 )
                    <tr style="background-color: grey;font-weight: bolder;color:white;">
                      <td><i><span>{{ $value2['name']}}</span></i></td>
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
                  @foreach( $array_spk as $key3 => $value3 )
                    @php $nilai_rab = 0; @endphp
                    @if ( $value3['code'] == $value['code'])
                      @if ( $value3['project_kawasan_id'] == $value2['name'])
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
                        <td>{{ $value3['pekerjaan']}}</td>
                        <td>{{ $value3['rekanan']}}</td>
                        <td>{{ number_format($value3['nilai'])}}</td>
                        <td>{{ number_format($value3['nilai_vo'])}}</td>
                        <td>{{ number_format($value3['total'])}}</td>
                        <td>{{ $value3['termyn']}}</td>
                        <td></td>
                        <td>{{ $value3['st_1']}}</td>
                        <td>{{ $value3['st_2']}}</td>
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
