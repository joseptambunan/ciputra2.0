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
              <h3 class="card-title">Data Report HPP Development Cost( Detail )</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <h4>Nama Proyek : <strong>{{ $project->name or  '' }}</strong></h4>
              <h4>Periode : 1 Jan s/d {{ date("d/m/Y") }} </h4>
              <table id="example3" class="table table-bordered" style="font-size: 20px;" cellpadding="0" cellspacing="0">
                <thead style="text-align: center;">
                <tr style="background-color: #17a2b8;color: white;font-weight: bolder;">
                  <th rowspan="2">&nbsp;</th>
                  <th rowspan="2" style="width: 20%">Kawasan</th>
                  <th colspan="2">Budget(Rp)</th>
                  <th colspan="2">Kontrak(Rp)</th>
                  <th rowspan="2">Prog. Lapangan(%)</th>
                  <th rowspan="2">Prog. BAP(%)</th>
                  <th colspan="2">BAP Terbayar(Rp)</th>
                  <th colspan="3">Saldo(Rp)</th>
                </tr>
                <tr style="background-color: #17a2b8;color: white;font-weight: bolder;">
                  <th>Budget<br>Awal</th>
                  <th>Budget<br>Tahun</th>
                  <th>Kontrak<br>Total</th>
                  <th>Kontrak<br>Tahun</th>
                  <th>Terbayar<br>Total</th>
                  <th>Terbayar<br>Tahun</th>
                  <th>Budget<br>Awal</th>
                  <th>Budget<br>Tahun</th>
                  <th>Sisa<br>Kontrak</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ( $project->kawasans as $key => $value )
                    @php $budget_awal = 0; $kontrak_total = 0; $start = 1; $progress = 0; $start_bap = 1; $bap=0; $bap_terbayar = 0; @endphp
                        @foreach ( $value->HppDevCostReport as $key2 => $value2 )
                        @php $budget_awal = $budget_awal + $value2->budget_awal; @endphp
                        @php $kontrak_total = $kontrak_total + $value2->kontrak_total; @endphp
                        @if ( $value2->progress_lapangan != "0")
                          @php $progress = $progress + $value2->progress_lapangan; @endphp
                          @php $start = $start + 1 ; @endphp
                        @endif
                        @if ( $value2->progress_bap != "0")
                          @php $bap = $bap + $value2->progress_bap; @endphp
                          @php $start_bap = $start_bap + 1 ; @endphp
                        @endif
                        @php $bap_terbayar = $bap_terbayar + $value2->bap_terbayar_total @endphp
                        @endforeach
                        
                    <tr style="text-align: left;background-color: grey;color:white;">
                      <td>{{ $key + 1 }}</td>
                      <td style="text-transform: uppercase;" onclick="showchild('{{ $value->id }}');" data-attribute='1' id='btn_{{$value->id}}'><strong>{!! $value->name or '' !!}</strong></td>
                      <td>{{ number_format($budget_awal,2) }}</td>
                      <td>0</td>
                      <td>{{ number_format($kontrak_total,2) }}</td>
                      <td>0</td>
                      <td>{{ number_format($progress/ $start,2) * 100 }}</td>                    
                      <td>{{ number_format($bap/ $start_bap,2) * 100 }} </td>
                      <td>{{ number_format($bap_terbayar),2 }}</td>
                      <td>0</td>
                      <td>{{ number_format($budget_awal - $kontrak_total,2) }}</td>
                      <td>{{ number_format(0 - 0,2) }}</td>
                      <td>{{ number_format($kontrak_total - $bap_terbayar,2) }}</td>
                    </tr>
                   
                    @foreach ( $value->HppDevCostReport as $key2 => $value2 )
                    <tr style="text-align: right;background-color: white;display: none" class="itempekerjaan item_{{$value->id}}">
                      <td>&nbsp;</td>
                      <td style="text-align: left;">{{ $value2->item->name or ''}}</td>
                      <td>{{ number_format($value2->budget_awal,2) }}</td>
                      <td>{{ number_format($value2->budget_tahun,2) }}</td>
                      <td>{{ number_format($value2->kontrak_total,2)}}</td>
                      <td>{{ number_format($value2->kontrak_tahun,2)}}</td>
                      <td>{{ round($value2->progress_lapangan * 100,2)}}</td>
                      <td>{{ round($value2->progress_bap * 100 ,2)}}</td>
                      <td>{{ number_format($value2->bap_terbayar_total,2) }}</td>
                      <td>{{ number_format($value2->bap_terbayar_tahun,2)}}</td>
                      <td>{{ number_format($value2->budget_awal - $value2->kontrak_total,2)}}</td>
                      <td>{{ number_format($value2->budget_tahun - $value2->bap_terbayar_tahun,2)}}</td>
                      <td>{{ number_format($value2->kontrak_total - $value2->bap_terbayar_total,2)}}</td>
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
        ordering :      false,
        fixedColumns:   {
            leftColumns: 2
        }
    } );

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('input[name=_token]').val()
        }
    });
   
  });

  function showchild(id){
    if ( $("#btn_" +id).attr("data-attribute") == "1"){
      $(".itempekerjaan").hide();
      $(".item_" + id).show(1000);
      $("#btn_" +id).attr("data-attribute","0");
    }else{
      $(".itempekerjaan").hide();
      $(".item_" + id).hide(1000);
      $("#btn_" +id).attr("data-attribute","1");
    }
    
  }
</script>
</body>
</html>
