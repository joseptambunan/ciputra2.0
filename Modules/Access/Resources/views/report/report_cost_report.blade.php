<!DOCTYPE html>
<html>
@include('user.header')
<body class="hold-transition sidebar-mini">
<div class="wrapper">
 
  <!-- /.navbar -->
  @include('user.sidebar')
  <style type="text/css">
    .DTFC_LeftBodyLiner{
      overflow: hidden !important;
    }
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content" style="font-size:17px;">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">              
              <a class="btn btn-warning" href="{{ url('/')}}/user/report/document?id={{ $project->id}}">Back</a>
              <h3 class="card-title">Data Cost Report</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <h4>Nama Proyek : <strong>{{ $project->name or  '' }}</strong></h4>
              <h4>Periode : 01/01/{{ date('Y')}} s/d {{ date("d M Y") }} </h4>
              <table id="example3" class="table table-bordered" style="font-size: 12px;">
                <thead>
                <tr style="background-color: #17a2b8;color: white;font-weight: bolder;overflow: hidden;">
                  <th>Kawasan</th>
                  <th rowspan="3">Tgl SPK</th>
                  <th rowspan="3">Acuan SPK</th>
                  <th rowspan="3">Pekerjaan</th>
                  <th rowspan="3">Rekanan</th>
                  <th rowspan="3">Tgl ST1</th>
                  <th rowspan="3">Tgl ST2</th>
                  <th rowspan="3">RAB/ Budget</th>
                  <th rowspan="2" colspan="3">Kontrak</th>
                  <th rowspan="3">Progress Lapangan</th>
                  <th rowspan="3">Progress BAP</th>
                  <th rowspan="3">BAP Terbayar</th>
                  <th rowspan="2" colspan="2">Saldo</th>
                </tr>
                <tr style="background-color: #17a2b8;color: white;font-weight: bolder;overflow: hidden;">
                  <th>Pekerjaan</th>
                </tr>
                <tr style="background-color: #17a2b8;color: white;font-weight: bolder;overflow: hidden;">
                  <th>Nomor SPK</th>
                  <th>SPK</th>
                  <th>VO</th>
                  <th>Total</th>
                  <th>Budget</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ( $project->kawasans as $key => $value )
                  <tr style="text-transform: uppercase;background-color: grey;color:white;overflow: hidden;">
                    <td style="background-color: grey;" onclick="showchild('{{ $value->id }}');" data-attribute='1' id='btn_{{$value->id}}'><strong>{!! $value->name !!}</strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>                    
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  @foreach( $value->cost_report as $key2 => $value2 )
                  <tr style="text-align: right;background-color: white;" class="itempekerjaan item_{{$value->id}}">
                    <td>{{ $value2->spk->no }}</td>
                    <td>{{ $value2->spk->date->format("d/m/y") }}</td>
                    <td>{{ $value2->spk->description }}</td>
                    <td>{{ $value2->spk->itempekerjaan->name }}</td>
                    <td>{{ $value2->spk->rekanan->name or '' }}</td>
                    <td>{{ $value2->spk->st_1 }}</td>
                    <td>{{ $value2->spk->st_2 }}</td>
                    <td>{{ $value2->spk->st_2->tender_rekanan->tender->rab->nilai or '' }}</td>
                    <td>{{ number_format($value2->spk->nilai,2) }}</td>
                    <td>{{ number_format($value2->spk->nilai_vo,2) }}</td>
                    <td>{{ number_format($value2->spk->nilai + $value2->spk->nilai_vo,2) }}</td>
                    <td>{{ number_format($value2->spk->nilai_progress,2) * 100 }} %</td>                   
                    <td>{{ number_format($value2->spk->nilai_progress_bap,2) * 100 }} %</td>
                    <td>{{ number_format($value2->spk->nilai_progress_bap * $value2->spk->nilai,2) }}</td>
                    <td>{{ number_format($value2->spk->nilai,2) }}</td>
                    <td>{{ number_format( $value2->spk->nilai - ($value2->spk->nilai_progress_bap * $value2->spk->nilai),2) }};</td>
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
        ordering : false,
        fixedColumns : {
          leftColumns : 1
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
