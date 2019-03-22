<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Rekanan</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
   
            <!-- /.box-header -->
            <div class="box-body">
              <form action="{{ url('/')}}/tender/rekanan/save" method="post" name="form1" id="form1" enctype="multipart/form-data">
                <input type="hidden" name="tender_id"  value="{{$tender->id}}">
                {{ csrf_field() }}
                <h3 class="header">Tambah Rekanan</h3>     
                <div class="col-md-6">       	   
                  {{ csrf_field() }}                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" value="" autocomplete="off" required >
                  </div>                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">NPWP</label>
                    <input value="" type="text" name="npwp" id="npwp" class="form-control" autocomplete="off" data-inputmask='"mask":"99.999.999.9-999.999"' data-mask required>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" class="form-control" name="email" id="email" autocomplete="off" value="" required>
                  </div> 
                  <div class="form-group">
                    <label for="exampleInputEmail1">Alamat Koresponden</label>
                    <textarea class="form-control" rows="5" cols="30" name="alamat" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Kota</label>
                    <select class="form-control select2" name="kota" required>
                      @foreach($city as $key => $value)
                       <option value="{{ $value->id }}">{{ $value->name }}</option>
                      @endforeach
                    </select>
                  </div> 
                  <div class="form-group">
                    <label>Kategori PPh Rekanan </label>
                    <select class="form-control" name="pph" id="pph">
                      <option value="2">Kecil (2%)</option>
                      <option value="3">Sedang (3%)</option>
                      <option value="3">Besar (3%)</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Sertifikat Rekanan</label>
                    <input type="file" name="sertifikat" id="sertifikat" required>
                  </div>
                  <div class="form-group">
                    <label>Status PKP</label>                    
                    <input type="checkbox" name="pkp" id="pkp" required>
                  </div>
                  <div class="box-footer">
                  <i class="fa fa-refresh ld ld-spin" id="loading" style="display: none;"></i>
                    <button type="submit" class="btn btn-primary submitbtn" id="btn_submit_1">Simpan</button>                    
                    <a href="{{ url('/')}}/tender/rekanan/referensi?id={{$tender->id}}" class="submitbtn btn btn-warning">Kembali</a>
                  </div>           	
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nama Pemilik</label> 
                    <input type="text" class="form-control" name="contact_name" required> 
                  </div>
                  <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" class="form-control" name="contact_position" required>
                  </div>
                  <div class="form-group">
                    <label>Tanggal Survey</label>
                    <input type="text" class="form-control" name="survey_date" id="aanwijzing_date" required>
                  </div>
                  <div class="form-group">
                    <label>Survey Oleh</label>
                    <input type="text" class="form-control" name="survey_name" required>
                  </div>
                  <div class="form-group">
                    <label>Upload NPWP File ( upload hanya format *.jpg, *.png ) </label>
                    <input type="file" name="npwp" required>
                  </div>
                  <div class="form-group">
                    <label>No. SIUP</label>
                    <input type="text" class="form-control" name="siup_no" required>
                  </div>
                  <div class="form-group">
                    <label>Upload SIUP ( upload hanya format *.jpg, *.png )</label>
                    <input type="file" name="siup_file" required>
                  </div>
                </div>
              </form>   
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
@include("tender::app")
<script type="text/javascript">
  $(function () {
    $(".select2").select2();
    
  });
</script>
</body>
</html>
