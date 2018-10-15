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
      <h1>Data Proyek <strong>{{ $project->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">              
              <h3 class="box-title">Tambah Data Unit</h3>
              <form action="{{ url('/')}}/project/save-unit" method="post" name="form1">
                {{ csrf_field() }}
              <input type="hidden" name="project_id" name="project_id" value="{{ $blok->kawasan->project->id }}">
              <input type="hidden" name="projectkawasan" name="projectkawasan" value="{{ $blok->kawasan->id }}">
              <input type="hidden" name="blok" name="blok" value="{{ $blok->id }}">

              
              <div class="form-group">
                <label>Starting Number</label>
                <input type='hidden' id='starting_number' name='starting_number' class='form-control' required style="widht:30%" value='{{ count($blok->units) + 1 }}' min="1" />
                <input type='number' class='form-control' required style="widht:30%" value='{{ $start}}{{ count($blok->units) + 1 }}' min="1" />
              </div>
              <div class="form-group">
                <label>Jumlah Unit</label>
                <input type='number' id='quantity' name='quantity' class='form-control' required style="widht:30%" value='1' min="1"  autocomplete="off" />
              </div>
              <div class="form-group">
                <label>PT</label>
                <select class="form-control" name="pt_id" id="pt_id">
                  @foreach ( $project->pt_user as $key6 => $value6)
                  <option value="{{ $value6->pt->id}}">{{ $value6->pt->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label>Unit Type</label>
                <select class="form-control" name="unit_type" id="unit_type">
                  <option>Pilih Type</option>
                  @foreach ( $unittype as $key5 => $value5 )
                  <option value="{{ $value5->id }}">{{ $value5->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Luas Tanah(m2)</label>
                <input type="text" class="form-control" name="luas_tanah" id="luas_tanah"  autocomplete="off">
              </div>
              <div class="form-group">
                <label>Luas Bangunan(m2)</label>
                <input type="text" class="form-control" name="luas_bangunan" id="luas_bangunan"  autocomplete="off">
              </div>
              <div class="form-group">
                <label>Arah Bangunan</label>
                <select class="form-control" name="unit_arah_id" id="unit_arah_id">
                  <option value='1'>Utara</option>
                  <option value='2'>Timur Laut</option>
                  <option value='3'>Timur</option>
                  <option value='4'>Tenggara</option>
                  <option value='5'>Selatan</option>
                  <option value='6'>Barat Daya</option>
                  <option value='7'>Barat</option>
                  <option value='8'>Barat Laut</option>
                </select>
              </div>
              <div class="form-group">
                <label>Hadap Bangunan</label>
                <select class='form-control select2' name='unit_hadap' id='unit_hadap'>
                  @foreach ( $project->hadap as $key3 => $value3 )
                  <option value='{{ $value3->id }}'>{{ $value3->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label>Product Kategori</label>
                <select class='form-control select2' name='tag_kategori' id='tag_kategori'>
                  <option value='B'>Bangunan</option>
                  <option value='K'>Kavling</option>
                </select>
              </div>
              <div class="form-group">
                <label>Status Sellable</label>
                <select class='form-control' name='is_sellable' id='is_sellable'>
                  <option value='1'>Ya</option>
                  <option value='0'>Tidak</option>
                </select>
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <textarea class='form-control' name="description" id="description" cols="45" rows="5" placeholder="Descriptions"></textarea>
              </div>     
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ url('/')}}/project/bloks/?id={{ $blok->kawasan->id }}" class="btn btn-warning">Kembali</a>
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

  $( document ).ready(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-Token': $('input[name=_token]').val()
          }
        });
    });



  $(function () {
    $("#luas").number(true);
  });

  $("#unit_type").change(function(){
    var request = $.ajax({
        url : "{{ url('/')}}/project/getluas",
        data : {
          id : $("#unit_type").val()
        },
        type : "post",
        dataType : "json"
    });

    request.done(function(data){
      $("#luas_tanah").val(data.luas_tanah);
      $("#luas_bangunan").val(data.luas_bangunan);
      $("#luas_tanah").number(true,2);
      $("#luas_bangunan").number(true,2);
    });
  });


</script>
@include("pt::app")
</body>
</html>
