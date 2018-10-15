<!DOCTYPE html>
<html>
@include('user.header')
<link rel="stylesheet" href="{{ url('/') }}/assets/users/plugins/ionslider/ion.rangeSlider.css">
<!-- ion slider Nice -->
<link rel="stylesheet" href="{{ url('/') }}/assets/users/plugins/ionslider/ion.rangeSlider.skinNice.css">
<!-- bootstrap slider -->
<link rel="stylesheet" href="{{ url('/') }}/assets/users/plugins/bootstrap-slider/slider.css">
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
              <h3 class="card-title">Data Kontrak by Kontraktor</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">              
              <form action="{{ url('/')}}/user/report/search/kontraktor" method="post" name="form1" id="form1">
                
              
              {{ csrf_field() }}
              <input type="hidden" name="project" id="project" value="{{ $project->id }}">
              <h4>Nama Proyek : <strong>{{ $project->name or  '' }}</strong></h4>
              <h4>Periode : <strong>01/01</strong> s/d <strong>{{ date("d/m/Y") }} </strong></h4>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Nama Rekanan</label>
                    <input type="text" class="form-control" name="nama_rekanan" id="nama_rekanan">
                  </div>
                  <div class="form-group">
                    <label>COA Pekerjaan</label>
                    <select class="form-control" name="coa_pekerjaan" id="coa_pekerjaan" multiple>
                      @foreach($itempekerjaan as $key => $value )
                      <option value="{{ $value->id}}" class="itempekerjaan dept_{{ $value->department_id }}" style="display: none;">{{ $value->code}}.{{ $value->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Other Parameter</label>
                    <select class="form-control" name="other_parameter" id="other_parameter">
                      <option value="">( choose parameter )</option>
                      <option value="progress_lapangan">Progress Lapangan</option>
                      <option value="progress_bap">Progress BAP</option>
                      <option value="nilai">Nilai SPK</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="parameter_from" id="parameter_from" placeholder="from">
                      </div>
                      <div class="col-md-4">
                        <input type="text" class="form-control" name="parameter_to" id="parameter_to" placeholder="to">
                      </div>
                    </div><br>
                    <a class="btn btn-success" href="{{ url('/')}}/user/report/document?id={{ $project->id}}">Back</a>
                    <button class="btn btn-warning" id="btn_search">Cari</button>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-group">
                    <label>Department</label><br>
                    <select class="form-control" nname="department" id="department" multiple style="height: 380px;">
                      @foreach($department as $key => $value )
                      <option value="{{ $value->id }}" id="dept_{{$value->id}}">{{ $value->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label style="display: none;">Jenis Pekerjaan</label>
                    <input type="checkbox" name="devcost" id="devcost" data-item='1' style="display: none;">
                    <input type="checkbox" name="concost" id="concost" data-item='2' style="display: none;">
                    <input type="checkbox" name="mktcost" id="mktcost" data-item='3' style="display: none;">
                    <input type="checkbox" name="fascost" id="fascost" data-item='4' style="display: none;">
                    <input type="checkbox" name="hcmcost" id="hcmcost" data-item='5' style="display: none;">
                    <input type="checkbox" name="comcost" id="comcost" data-item='6' style="display: none;">
                  </div>
                </div>
              </div>
             </form>
              <table id="example3" class="table table-bordered" style="font-size: 20px;">
                <thead>                
                <tr style="background-color: #17a2b8;color: white;font-weight: bolder;text-align: center;">
                  <th>Nama Rekanan</th>
                  <th>Tgl SPK</th>
                  <th>Acuan SPK</th>
                  <th>Pekerjaan</th>
                  <th>Proyek / Kawasan</th>
                  <th>Nilai SPK(Rp)</th>
                  <th>Nilai VO(Rp)</th>
                  <th>Total Kontrak(Rp)</th>
                  <th>Total BAP(s)</th>
                  <th>Sisa Kontrak(Rp)</th>
                  <th>Tgl ST1(Rp)</th>
                  <th>Tgl ST2(Rp)</th>
                </tr>
                </thead>
                <tbody>
                  @if ( count($arrResult) > 0 )
                    @for( $i=0; $i < count($arrResult); $i++ )
                    <tr style="background-color: white;">
                    <th>{{ $arrResult[$i]['no_spk']}}</th>
                    <th>{{ $arrResult[$i]['tgl_spk']}}</th>
                    <th>{{ $arrResult[$i]['acuan']}}</th>
                    <th>{{ $arrResult[$i]['pekerjaan'] or ''}}</th>
                    <th>{{ $arrResult[$i]['lokasi']}}</th>
                    <th>{{ $arrResult[$i]['nilai_spk']}}</th>
                    <th>{{ $arrResult[$i]['nilai_vo']}}</th>
                    <th>{{ $arrResult[$i]['total_kontrak']}}</th>
                    <th>{{ $arrResult[$i]['total_bap']}}</th>
                    <th>{{ $arrResult[$i]['sisa_kontrak']}}</th>
                    <th>{{ $arrResult[$i]['st_1']}}</th>
                    <th>{{ $arrResult[$i]['st_2']}}</th>
                    </tr>
                    @endfor
                  @endif
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
<!-- Ion Slider -->

<script src="{{ url('/') }}/assets/users/plugins/ionslider/ion.rangeSlider.min.js"></script>
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
        searching : false
    } );

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('input[name=_token]').val()
        }
    });
    
  });

 
    $("#department").change(function(data){
      $(".itempekerjaan").hide();
      $(".dept_" + $("#department").val()).show();
    })
</script>
</body>
</html>
