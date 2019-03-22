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
              <form action="{{ url('/')}}/project/update-unit" method="post" name="form1">
                {{ csrf_field() }}
              <input type="hidden" name="project_id" id="project_id" value="{{ $unit->blok->kawasan->project->id }}">
              <input type="hidden" name="projectkawasan" id="projectkawasan" value="{{ $unit->blok->kawasan->id }}">
              <input type="hidden" name="blok" value="{{ $unit->blok->id }}">
              <input type="hidden" name="unit" value="{{ $unit->id }}">
              
              <div class="form-group">
                <label>Unit Nomor</label>
                <input type="text" class="form-control" name="unit_nomor" value="{{ $unit->name }}" {{ $readonly }}>
              </div>
              <div class="form-group">
                <label>PT</label>
                <select class="form-control" name="pt_id" id="pt_id" {{ $readonly }}>
                  @foreach ( $project->pt_user as $key6 => $value6)

                  @if ( $value6->id == $user->pt_id )
                    <option value="{{ $value6->pt->id}}" selected>{{ $value6->pt->name }}</option>
                  @else
                    <option value="{{ $value6->pt->id}}">{{ $value6->pt->name }}</option>
                  @endif

                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label>Unit Type</label>
                <select class="form-control" name="unit_type" id="unit_type" {{ $readonly }}>
                  <option value="">Pilih Type</option>
                  @foreach ( $unit->blok->kawasan->unit_type as $key5 => $value5 )
                  @if ( $value5->id  == $unit->unit_type_id)
                  <option value="{{ $value5->id }}" selected>{{ $value5->name }}</option>
                  @else
                  <option value="{{ $value5->id }}">{{ $value5->name }}</option>
                  @endif
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Luas Tanah(m2)</label>
                <input type="text" class="form-control" name="luas_tanah" id="luas_tanah" value="{{ $unit->tanah_luas }}" {{ $readonly }}>
              </div>
              <div class="form-group">
                <label>Luas Bangunan(m2)</label>
                <input type="text" class="form-control" name="luas_bangunan" id="luas_bangunan" value="{{ $unit->bangunan_luas }}" {{ $readonly }}>
              </div>
              <div class="form-group">
                <label>Arah Bangunan </label>
                <select class="form-control" name="unit_arah_id" id="unit_arah_id" {{ $readonly }}>
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
                  @if ( $unit->unit_hadap_id == $value3->id )
                    <option value='{{ $value3->id }}' selected>{{ $value3->name }}</option>
                  @else
                    <option value='{{ $value3->id }}'>{{ $value3->name }}</option>
                  @endif
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label>Product Kategori</label>
                <select class='form-control select2' name='tag_kategori' id='tag_kategori' {{ $readonly }}>
                  @if ( $unit->tag_kategori == "B")
                  <option value='B' selected>Bangunan</option>
                  <option value='K'>Kavling</option>
                  @else
                  <option value='B'>Bangunan</option>
                  <option value='K' selected>Kavling</option>
                  @endif
                </select>
              </div>
              <div class="form-group">
                <label>Status Sellable</label>
                <select class='form-control' name='is_sellable' id='is_sellable'>
                  <option value='1' {{ $sellable_1 }}>Ya</option>
                  <option value='0' {{ $sellable_0 }}>Tidak</option>
                </select>
              </div>

              <div class="form-group">
                <label>Status Unit</label>
                <select class='form-control' name='is_status' id='is_status'>
                  <option value='0'>Planning</option>
                  <option value='1'>Ready for Sale</option>
                </select>
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <textarea class='form-control' name="description" id="description" cols="45" rows="5" placeholder="Descriptions" {{ $readonly }}></textarea>
              </div>     
              <div class="box-footer">
                @if ( $unit->unit_id == "" )
                  <button type="submit" class="btn btn-primary" {{ $readonly }}>Simpan</button>
                @endif
                <a href="{{ url('/')}}/project/units/?id={{ $unit->blok->id }}" class="btn btn-warning">Kembali</a>
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
    });
  });


</script>
@include("pt::app")
</body>
</html>
