<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard </title>
  @include("master/header")
    <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('/')}}/assets/bower_components/select2/dist/css/select2.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Kawasan</h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">              
              <h3 class="box-title">Tambah Data Kawasan</h3>
              <form action="{{ url('/')}}/project/save-kawasan" method="post" name="form1">
                {{ csrf_field() }}
              <input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}">
              <input type="hidden" name="sub_holding" id="sub_holding" value="{{ $project->subholding }}">
              <input type="hidden" name="project_limit" id="project_limit" value="{{ $limit }}">
              <div class="form-group">
                <label>Project</label>
                <input type="text" class="form-control" value="{{ $project->name }}" readonly>
              </div>
              <div class="form-group">
                <label>Luas Area Bruto Proyek(m2)</label>
                <input type="text" class="form-control" name="project_luas"  value="{{ number_format($project->luas) }}" readonly>
              </div>
              <hr style="border:2px solid;width: 200%;">
              <div class="form-group">
                <label>Kode Kawasan</label>
                <input type="text" class="form-control" name="kode_kawasan" id="kode_kawasan" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Nama Kawasan</label>
                <input type="text" class="form-control" name="nama_kawasan" id="nama_kawasan" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Luas Brutto Kawasan(m2)</label>
                <input type="text" class="form-control" name="luas_brutto" id="luas_brutto" max="{{ $project->luas}}" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Luas Netto Kawasan(m2)</label>
                <input type="text" class="form-control" name="luas_netto" id="luas_netto" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Status Lahan Kawasan</label>
                <select class='form-control' name='lahan_status' id='lahan_status' autocomplete="off">
                  <option value='0'>Open</option>
                  <option value='1'>Deliver</option>
                  <option value='2'>In-Progress</option>
                  <option value='3'>On-Hold</option>
                  <option value='4'>Release</option>
                  <option value='5'>Approved</option>
                  <option value='6'>Rejected</option>
                  <option value='7'>Close</option>
                  <option value='8'>Cancel</option>
                  <option value='9'>Active</option>
                  <option value='10'>Inactive</option>
                </select>
              </div>
              <div class="form-group">
                <label>Tipe Kawasan</label>
                <select class='form-control select2' name='project_type_id' id='project_type_id'>
                  <option value="1">Ruko</option>
                  <option value="2">Perumahan</option>
                  <option value="3">Gudang</option>
                </select>
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <textarea class='form-control' name="description" id="description" cols="45" rows="5" required></textarea>
              </div>  
              <div class="form-group">
                <label>Is Kawasan</label>
                <select name="is_kawasan" id="is_kawasan" class="form-control" >
                  <option value="1">Ya</option>
                  <option value="0">Tidak</option>
                </select>
              </div>    
              <div class="box-footer">                
                <i class="fa fa-refresh ld ld-spin" id="loading" style="display: none;"></i>
                <button type="submit" class="submitbtn btn btn-primary" id="btn_submit">Simpan</button>
                <a href="{{ url('/')}}/project/kawasan" class="submitbtn btn btn-warning">Kembali</a>
              </div>
              </form>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-12">
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->


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

@include("master/footer_table")
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script type="text/javascript">
  $(function () {
    $("#luas").number(true);
    $("#luas_brutto").number(true);
    $("#luas_netto").number(true);
  });

  $("#btn_submit").click(function(){
    $(".submitbtn").hide();
    $("#loading").show();
  });

  $("#luas_brutto").keyup(function(){
    var luas_proyek = parseInt($("#project_limit").val());
    var brutto = $("#luas_brutto").val();
    var values = brutto.replace(",","");
    var limit = parseInt(values);
    if ( limit > luas_proyek ){
      alert("Luas Kawasan sudah melebihi luas proyek");
      $("#luas_brutto").val(0);
    }
  });

  $("#luas_netto").keyup(function(){
    var brutto = parseInt($("#luas_brutto").val());
    var netto = parseInt($("#luas_netto").val());
    if ( netto > brutto ){
      alert("Luas Netto Kawasan ini melebihi Luas Brutto Kawasan ini ");
      $("#luas_netto").val(0);
    }
  });
</script>
@include("pt::app")
</body>
</html>
