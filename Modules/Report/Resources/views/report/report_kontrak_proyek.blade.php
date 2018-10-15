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
              <h3 class="card-title">Data Kontrak by Proyek</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              {{ csrf_field() }}
              <input type="hidden" name="project" id="project" value="{{ $project->id }}">
              <input type="hidden" name="query" id="query" value="">
              <h4>Nama Proyek : <strong>{{ $project->name or  '' }}</strong></h4>
              <h4>Periode : <strong>01/01/{{ date("Y") }}</strong> s/d <strong>{{ date("d/m/Y") }} </strong></h4>
              <div class="row">
                <div class="col-md-3">
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
                      <div class="col-md-6">
                        <input type="text" class="form-control" name="parameter_from" id="parameter_from" placeholder="from">
                      </div>
                      <div class="col-md-6">
                        <input type="text" class="form-control" name="parameter_to" id="parameter_to" placeholder="to">
                      </div>
                    </div><br>
                    <a class="btn btn-success" href="{{ url('/')}}/user/report/document?id={{ $project->id}}">Back</a>
                    <button class="btn btn-info" onclick="window.location.reload();">Reset</button>
                    <button class="btn btn-warning" id="btn_search">Cari</button>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Department</label><br>
                    <select class="form-control" nname="department" id="department" multiple style="height: 380px;">
                      @foreach($department as $key => $value )      
                        @foreach ( $value->pt->mapping as $key2=> $value2)
                            <option value="{{ $value2->department->id }}" id="dept_{{ $value2->department->id}}">{{ $value2->department->name }}</option>   
                        @endforeach                       
                      @endforeach
                    </select>
                  </div>
                  
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Rekanan</label><br>
                    <select class="form-control" nname="rekanan" id="rekanan" multiple style="height: 380px;">
                      @for($i=0; $i < count($rekanan) ; $i++  )
                      <option value="{{ $rekanan[$i]['rekanan_id'] }}" id="dept_{{ $rekanan[$i]['rekanan_id'] }}">{{ $rekanan[$i]['name'] }}</option>
                      @endfor
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
             <!--/form-->
              <table class="table table-bordered" id="example3">
                <thead>                
                <tr style="background-color: #17a2b8;color: white;font-weight: bolder;text-align: center;">
                  <th style="width: 30%;">Proyek / Kawasan</th>
                  <th style="width: 10%;">Tgl SPK</th>
                  <th style="width: 10%;">Acuan SPK</th>
                  <th style="width: 10%;">Pekerjaan</th>
                  <th style="width: 10%;">Nama Rekanan</th>
                  <th style="width: 10%;">Nilai SPK(Rp)</th>
                  <th style="width: 10%;">Nilai VO(Rp)</th>
                  <th style="width: 10%;">Total Kontrak(Rp)</th>
                  <th style="width: 10%;">Total Termyn(s)</th>
                  <th style="width: 10%;">Sisa Kontrak(Rp)</th>
                  <th style="width: 10%;">Tgl ST1</th>
                  <th style="width: 10%;">Tgl ST2</th>
                </tr>
                </thead>
                <tbody id="listresult">

                 
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('input[name=_token]').val()
        }
    });

  });

  $("#btn_search").click(function(){
    $('#example3').DataTable().destroy();
    $("#listresult").html("<span>LOADING...</span>");
    var request = $.ajax({
      url : "{{ url('/')}}/user/report/search/proyek",
      type : "post",
      data : {
        project : $("#project").val(),
        rekanan : $("#rekanan").val(),
        coa_pekerjaan : $("#coa_pekerjaan").val(),
        other_parameter : $("#other_parameter").val(),
        parameter_from : $("#parameter_from").val(),
        parameter_to : $("#parameter_to").val(),
        department : $("#department").val()
      },
      type : "post"
    });

    request.done(function(data){
      $("#listresult").html(data.html); 
      $("#query").val(data.clause);   
      $('#example3').DataTable({
        "scrollY": 600,
        "scrollX": true,
        ordering: false
      });
    })
        
  });

  $("#department").change(function(data){
      $(".itempekerjaan").hide();
      $(".dept_" + $("#department").val()).show();
      
  });

  function showchild(id){
    if ( $("#btn_" +id).attr("data-attribute") == "1" ){
      var request = $.ajax({
        url : "{{ url('/')}}/user/report/search/proyek/itempekerjaan",
        type : "post",
        data : {
          clauses : $("#query").val(),
          id : id,
          type : $("#btn_" + id).attr("data-asset")
        },
        type : "post"
      });

      request.done(function(data){
        $("#work_" + id).html(data.html_pekerjaan);  
        $("#nilai_" + id).html(data.html_nilai_spk);
        $("#nilai_vo_" + id).html(data.html_nilai_vo);  
        $("#total_kontrak_" + id).html(data.html_total_kontrak);
        $("#total_termyn_" + id).html(data.html_total_termyn);
        $("#sisa_kontrak_" + id).html(data.html_sisa_kontrak);

        $("#tgl_spk_" + id).html(data.html_tgl_spk);  
        $("#acuan_spk_" + id).html(data.html_acuan_spk);
        $("#pekerjaan_" + id).html(data.html_pekerjaan_spk);
        $("#rekanan_" + id).html(data.html_nama_rekanan);
        $("#btn_" +id).attr("data-attribute","0");
        $("#add_outline_" + id).hide();
        $("#rem_outline_" + id).show();
      });
    }else{
      $("#work_" + id).html("");  
      $("#nilai_" + id).html("");
      $("#nilai_vo_" + id).html("");  
      $("#total_kontrak_" + id).html("");
      $("#total_termyn_" + id).html("");
      $("#sisa_kontrak_" + id).html("");
      $("#tgl_spk_" + id).html("");  
      $("#acuan_spk_" + id).html("");
      $("#pekerjaan_" + id).html("");
      $("#rekanan_" + id).html("");
      $("#btn_" +id).attr("data-attribute","1");
      $("#add_outline_" + id).show();
      $("#rem_outline_ " + id).hide();
    }
  }

  function spkdetail(id,asset_id){
    if ( $("#label_" + id).attr("data-attribute") == "1" ){      

      var request = $.ajax({
        url : "{{ url('/')}}/user/report/search/proyek/spk",
        type : "post",
        data : {
          clauses : $("#query").val(),
          id : id,
          type : $("#btn_" + asset_id).attr("data-asset"),
          asset_id : asset_id
        },
        type : "post"
      });

      request.done(function(data){
        $("#work_" + id).append(data.html_pekerjaan);  
        $("#nilai_" + id).append(data.html_nilai_spk);
        $("#nilai_vo_" + id).append(data.html_nilai_vo);  
        $("#total_kontrak_" + id).append(data.html_total_kontrak);
        $("#total_termyn_" + id).append(data.html_total_termyn);
        $("#sisa_kontrak_" + id).append(data.html_sisa_kontrak);
        $("#tgl_spk_" + id).append(data.html_tgl_spk);  
        $("#acuan_spk_" + id).append(data.html_acuan_spk);
        $("#pekerjaan_" + id).append(data.html_pekerjaan_spk);
        $("#rekanan_" + id).append(data.html_nama_rekanan);
      });

      $("#label_add_" + id).hide();
      $("#label_remove_" + id).show();
      $("#label_" + id).attr("data-attribute","0");
      $('#example3').DataTable().destroy();
      $('#example3').DataTable({
        "scrollY": 600,
        "scrollX": true,
        ordering: false
      });
    }else{
      $("#label_add_" + id).show();
      $("#label_remove_" + id).hide();
      $("#label_" + id).attr("data-attribute","1");
      $(".child_" + id).remove();
    }
  }
</script>
</body>
</html>
