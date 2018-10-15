<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | SIK</title>
   @include("master/header")

  <link rel="stylesheet" href="{{ url('/')}}/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
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
      <h1>Data Surat Instruksi</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                <small></small>
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
              <form action="{{ url('/')}}/spk/sik-store" method="post" name="form1" id="form1">
                {{ csrf_field() }}
                <input type="hidden" name="spk_id" id="spk_id"  value="{{ $spk->id }}">

                <div class="form-group">
                  <label>No. SPK</label>
                  <input type="text" class="form-control" value="{{ $spk->no }}" disabled>
                </div>

                <div class="form-group">
                  <label>Variation Order</label>
                  <input type="checkbox" name="is_vo" id="is_vo" checked> Variation Order
                </div>


                <div class="form-group">
                  <label>Perihal</label>
                  <input type="text" class="form-control" name="perihal" id="perihal" autocomplete="off" required>
                </div>

                <div class="form-group">
                  <textarea class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="content" required></textarea>
                </div>

                  <button class="btn btn-primary" type="button" onClick="cekvalidasi();">Simpan</button>
                  <a href="{{ url('/')}}/spk/detail?id={{ $spk->id }}" class="btn btn-warning">Kembali</a>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
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

<!-- jQuery 3 -->
<script src="{{ url('/') }}/assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ url('/') }}/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="{{ url('/') }}/assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{ url('/') }}/assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('/') }}/assets/dist/js/demo.js"></script>
<!-- CK Editor -->
<script src="{{ url('/') }}/assets/bower_components/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ url('/') }}/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<!-- Select2 -->
<script src="{{ url('/') }}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
    $('.select2').select2()
  });

  function cekvalidasi(){
    if ( $("#perihal").val() == "" ){
      alert("Isi data perihal");
      return false;
    }

    if ( $("#is_vo").is(":checked")) {
      if ( $("#unit_sik").val() == "" ){
        alert("Silahkan isi nama unit anda ? ");
        return false;
      }else{
        $("#form1").submit();
      }
    }
  }

  function setunit(id){
    if ( $("#unit_detail_" + id).is(":checked")){
      $("#unit_sik").val($("#unit_sik").val() + "," + id);
    } else { 
      var str = $("#unit_sik").val();
      var replace = str.replace("," + id, "");
      $("#unit_sik").val(replace);
    }
  }

  function setpekerjaan(id){
    var val = $("#unit_sik").val();
    var split = val.split(",");
    var html = "";
    for ( var i = 0 ; i < split.length; i++){
        if ( split[i] != ""){
          html = "";
          $("#unit_tambah_detail_sik").val($("#unit_tambah_detail_sik").val() + "||" + split[i] + "<>" +  $("#itempekerjaan_id").val());
          html += "<tr class='" + split[i] + "_" + $("#itempekerjaan_id").val() + "'>";
          html += "<td class='" + split[i] + "_" + $("#itempekerjaan_id").val() + "'>Unit " + $("#unit_detail_" + split[i]).attr("data-value") + "</td>" ;
          html += "<td class='" + split[i] + "_" + $("#itempekerjaan_id").val() + "'>" + $("#itempekerjaan_id option:selected").attr('data-value') + "</td>";
          html += "<td class='" + split[i] + "_" + $("#itempekerjaan_id").val() + "'><button type='button' class='btn btn-sm btn-danger' onclick='remove(" + split[i] + ", " +  $("#itempekerjaan_id").val() +")'>Hapus</button><br>" ;
          html +="<input type='radio' name='param_" + split[i] + "_" + $("#itempekerjaan_id").val() +"' class='minimal-red' value='+' checked/> Pekerjaan Tambah<br>";
          html +="<input type='radio' name='param_" + split[i] + "_" + $("#itempekerjaan_id").val() +"' class='minimal-red' value='-'/> Pekerjaan Kurang";
          html += "</td>";
          html += "</tr>";
          $("#pekerjaan_list").append(html);
        }
    }
    
  }

  function remove(id,itempekerjaan_id){
    var val = $("#unit_tambah_detail_sik").val();
    var replace = val.replace( "||" + id + "<>" + itempekerjaan_id, "" );
    $("#unit_tambah_detail_sik").val(replace);
    $("." + id + "_" + itempekerjaan_id ).remove();
  }
</script>
</body>
</html>
