<!DOCTYPE html>
<html>
@include('user.header')
<body class="hold-transition sidebar-mini">
<div class="wrapper">
 
  <!-- /.navbar -->
  @include('user.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content" style="font-size:17px;">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">              
              <a class="btn btn-warning" href="{{ url('/')}}/user/report/document?id={{ $project->id}}">Back</a>
              <h3 class="card-title">Data Report HPP Development Cost( Summary )</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <h4>Nama Proyek : <strong>{{ $project->name or  '' }}</strong></h4>
              <h4>Periode : 01/01/2018 <strong>s/d</strong> {{ date("d/m/Y") }} </h4>
              <table id="example3" class="table table-bordered" style="font-size: 20px;">
                <thead style="text-align: center;">
                  <tr style="background-color: #17a2b8;color: white;font-weight: bolder;">
                    <th rowspan="2">Kawasan</th>
                    <th rowspan="2">Efisiensi(%)</th>
                    <th colspan="2">Luas(m2)</th>
                    <th rowspan="2">Total Budget(Rp)</th>
                    <th colspan="2">Hpp Budget(Rp/m2)</th>
                    <th rowspan="2">Total Kontrak(Rp)</th>
                    <th colspan="2">Hpp Kontrak(Rp/m2)</th>
                    <th rowspan="2">Total Terbayar(Rp)</th>
                    <th colspan="2">Hpp Realisasi(Rp/m2)</th>
                  </tr>
                  <tr style="background-color: #17a2b8;color: white;font-weight: bolder;">
                    <th>Netto</th>
                    <th>Bruto</th>
                    <th>Netto</th>
                    <th>Bruto</th>
                    <th>Netto</th>
                    <th>Bruto</th>
                    <th>Netto</th>
                    <th>Bruto</th>
                  </tr>                  
                  <tr style="text-align: right; background-color: aquamarine;font-weight: bolder;">
                    <td style="text-align: left;background-color: aquamarine">Total</td>
                    <td style="text-align: right;background-color: aquamarine">{{ number_format($nilai_total['efisiensi'],4) * 100}}</td>
                    <td>{{ number_format($nilai_total['total_luas_netto'],2)}}</td>
                    <td>{{ number_format($project->luas,2)}}</td>
                    <td>{{ number_format($nilai_total['total_budget_dev_Cost'],2)}}</td>
                    <td>{{ number_format($nilai_total['total_hpp_netto'],2)}}</td>
                    <td>{{ number_format($nilai_total['total_hpp_bruto'],2)}}</td>                    
                    <td>{{ number_format($nilai_total['total_kontrak'],2)}}</td>
                    <td>{{ number_format($nilai_total['total_hpp_kontrak_netto'],2)}}</td>
                    <td>{{ number_format($nilai_total['total_hpp_kontrak_bruto'],2)}}</td>
                    <td>{{ number_format($nilai_total['total_terbayar'],2)}}</td>
                    <td>{{ number_format($nilai_total['total_hpp_realisasi_netto'],2)}}</td>
                    <td>{{ number_format($nilai_total['total_hpp_realisasi_bruto'],2)}}</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $project->kawasans as $key => $value )                    
                    @foreach ( $value->HppDevCostReportSummary as $key2 => $value2 )
                    <tr style="text-align: right;">
                      <td style="text-align: left;background-color: grey;color:white;">{!! $value->name or '' !!}</td>
                      <td style="text-align: right;background-color: white">{{ number_format(($value->lahan_sellable / $value->lahan_luas )* 100,2) }}</td>
                      <td>{{ number_format($value->lahan_sellable,2) }}</td>
                      <td>{{ number_format($value->lahan_luas,2) }}</td>
                      <td>{{ number_format($value2->total_budget,2) }}</td>
                      <td>{{ number_format($value2->hpp_netto,2) }}</td>
                      <td>{{ number_format($value2->hpp_bruto,2) }}</td>
                      <td>{{ number_format($value2->total_kontrak,2) }}</td>
                      <td>{{ number_format($value2->hpp_kontrak_netto,2) }}</td>
                      <td>{{ number_format($value2->hpp_kontrak_bruto,2) }}</td>
                      <td>{{ number_format($value2->total_terbayar,2) }}</td>
                      <td>{{ number_format($value2->hpp_realisasi_netto,2) }}</td>
                      <td>{{ number_format($value2->hpp_realisasi_bruto,2) }}</td>
                    </tr>
                    @endforeach
                  @endforeach
                 
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.0-alpha
    </div>
    <strong>Copyright &copy; 2014-2018 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>


</div>
<!-- ./wrapper -->
@include('user.footer')
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.4/js/dataTables.fixedColumns.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/fixedcolumns/3.0.2/css/dataTables.fixedColumns.css">
<script type="text/javascript">
  $(document).ready(function() {
    $('#example3').DataTable( {
        scrollY:        600,
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   {
            leftColumns: 2
        },
        ordering  : false
    } );

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('input[name=_token]').val()
        }
    });
   
  });


</script>
</body>
</html>
