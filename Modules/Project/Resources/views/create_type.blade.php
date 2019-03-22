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
      <h1>Data Project <strong>{{ $project->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">              
              <h3 class="box-title">Tambah Data Type</h3>
              <form action="{{ url('/')}}/project/save-type" method="post" name="form1">
                {{ csrf_field() }}
              <input type="hidden" name="project_id" value="{{ $project->id }}">   
              <div class="form-group">
                <label>Kode Type</label>
                <input type="text" class="form-control" name="code"  value="" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Nama Type</label>
                <input type="text" class="form-control" name="name"  value="" autocomplete="off">
              </div>
              <div class="form-group">
                <label>Luas Bangunan(m2)</label>
                <input type="text" class="form-control" name="luas" id="luas" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Luas Tanah(m2)</label>
                <input type="text" class="form-control" name="luas_tanah" id="luas_tanah" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Elektrik(watt)</label>
                <input type="text" class="form-control" name="elektrik" id="elektrik" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Lantai</label>
                <input type="text" class="form-control" name="lantai" id="lantai" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Kawasan</label>
                @if ( $project->kawasans != "" )
                <select class="form-control" name="kawasan">
                  @foreach ( $project->kawasans as $key => $value )
                  <option value="{{ $value->id }}">{{ $value->name }}</option>
                  @endforeach
                </select>
                @else
                <h3 style="color:red"><strong>Harap isi data kawasan terlebih dahulu</strong></h3>
                @endif
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <textarea class='form-control' name="description" id="description" cols="45" rows="5" required></textarea>
              </div>     
              <div class="box-footer">
                <i class="fa fa-refresh ld ld-spin" id="loading" style="display: none;"></i>
                <button type="submit" class="submitbtn btn btn-primary" id="btn_submit">Simpan</button>
                <a href="{{ url('/')}}/project/unit-type/?id={{ $project->id }}" class="submitbtn btn btn-warning">Kembali</a>
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
  @include("master/copyright")

  
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
    $("#luas_tanah").number(true,2);
    $("#elektrik").number(true);
  });

  $("#btn_submit").click(function(){
    $(".submitbtn").hide();
    $("#loading").show();
  });

  $(".form-control").keyup(function(){
    $(".submitbtn").show();
    $("#loading").hide();
  })
</script>
@include("pt::app")
</body>
</html>
