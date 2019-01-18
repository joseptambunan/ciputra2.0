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

  @include("master/sidebar")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Proyek</h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">              
              <h3 class="box-title">Tambah Data Proyek</h3>
              <form action="{{ url('/')}}/project/add-proyek" method="post" name="form1">
                {{ csrf_field() }}
              <div class="form-group">
                <label>Sub Holding</label>
                <select class="form-control" name="subholding">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>
              <div class="form-group">
                <label>Kode Proyek</label>
                <input type="text" class="form-control" name="code" autocomplete="off">
              </div>
              <div class="form-group">
                <label>Nama Proyek</label>
                <input type="text" class="form-control" name="name" autocomplete="off">
              </div>
              <div class="form-group">
                <label>Luas Brutto(m2)</label>
                <input type="text" class="form-control" name="luas" id="luas" autocomplete="off">
              </div>
              <div class="form-group">
                <label>Telepon Proyek</label>
                <input type="text" class="form-control" name="phone" autocomplete="off">
              </div>
              <div class="form-group">
                <label>Fax Proyek</label>
                <input type="text" class="form-control" name="fax" autocomplete="off">
              </div>
              <div class="form-group">
                <label>Email Proyek</label>
                <input type="text" class="form-control" name="email" autocomplete="off">
              </div>
              <div class="form-group">
                <label>Alamat Proyek</label>
                <textarea class="form-control" name="address" rows="3"></textarea>
              </div>  
              <div class="form-group">
                <label>Kota</label>
                <select class="form-control" name="city_id" required>
                  @foreach( $cities as $data => $value )
                  <option value="{{ $value->id}}">{{ $value->name}}</option>
                  @endforeach
                </select>
              </div> 
              <div class="form-group">
                <label>Kode Pos Proyek</label>
                <input type="text" class="form-control" name="zipcode" autocomplete="off">
              </div> 
              <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" name="description" rows="3"></textarea>
              </div>        
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
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
  });
</script>
@include("pt::app")
</body>
</html>
