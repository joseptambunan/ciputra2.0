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
              <h3 class="card-title">Data Kontrak by Pekerjaan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <h4>Nama Proyek : <strong>{{ $project->name or  '' }}</strong></h4>
              <h4>Periode : 1 Jan s/d {{ date("d/m/Y") }} </h4>
              <table id="example3" class="table table-bordered" style="font-size: 20px;">
                <thead>
                
                <tr style="background-color: #17a2b8;color: white;font-weight: bolder;text-align: center;">
                  <th>Nama Pekerjaan</th>
                  <th>Tgl SPK</th>
                  <th>Acuan SPK</th>
                  <th>Nama Rekanan</th>
                  <th>Nilai SPK(Rp)</th>
                  <th>Nilai VO(Rp)</th>
                  <th>Total Kontrak(Rp)</th>
                  <th>Total Termyn(s)</th>
                  <th>Sisa Kontrak</th>
                  <th>Tgl ST1</th>
                  <th>Tgl ST2</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ( $itempekerjaan as $key => $value )
                  <tr style="text-align: left;background-color: grey;color:white" >
                    <td style="text-transform: uppercase;"><strong>{!! $value->name !!}</strong></td>
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
                  @foreach ( $kawasans as $key2 => $value2 )
                  <tr style="text-align: left;background-color: white;" >
                    <td><strong>{!! $value2->name !!}</strong></td>
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
                  @foreach ( \App\CostReport::where("itempekerjaan",$value->id)->take(1)->get() as $key3 => $value3 )
                  <tr style="text-align: left;background-color: white;" >
                    <td>&nbsp;&nbsp;&nbsp;{{ $value3->spk->no }} {{ $value->id }}</td>
                    <td>{{ $value3->spk->date->format("d/M/Y")}}</td>
                    <td>{{ $value3->spk->description or '' }}</td>
                    <td>{{ \App\RekananGroup::find($value3->spk->rekanan_id)->name }}</td>
                    <td>{{ number_format($value3->spk->nilai) }}</td>
                    <td>{{ number_format($value3->spk->nilai_vo) }}</td>
                    <td>{{ number_format($value3->spk->nilai + $value3->spk->nilai_vo) }}</td>
                    <td>{{ number_format(count($value3->spk->baps)) }}</td>
                    <td>{{ number_format(($value3->spk->nilai + $value3->spk->nilai_vo )- $value3->spk->report_nilai_bap)}}</td>
                    <td>@if ( $value3->spk->st_1 != "0000-00-00 00:00:00" ){{ $value3->spk->st_1}} @endif</td>
                    <td>@if ( $value3->spk->st_2 != "0000-00-00 00:00:00" ){{ $value3->spk->st_2}} @endif</td>
                  </tr> 
                  @endforeach
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
        ordering : false
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
