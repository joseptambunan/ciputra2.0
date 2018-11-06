<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_rekanan")

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
             <form action="{{ url('/')}}/rekanan/user/update-rekanan" method="post" name="form1" enctype="multipart/form-data">
              <input type="hidden" name="rekanan_id" value="{{ $rekanan->first()->id }}">
              <input type="hidden" name="rekanan_group_id" value="{{ $rekanan_group->id}}" >
              <h3 class="header">Data Kantor Pusat ( Holding )</h3>
              <div class="col-md-6">
                {{ csrf_field() }}                  
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" class="form-control" value="{{ $rekanan_group->name }}" disabled>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">NPWP</label>
                    <input type="text" class="form-control" value="{{ $rekanan_group->npwp_no }}" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Alamat</label>
                  <textarea class="form-control" name="alamat" cols="30" rows="5">{{ $rekanan_group->npwp_alamat}}</textarea> 
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Kode Pos</label>
                  <input type="text" class="form-control" id="kodepos" name="kodepos" value="{{ $rekanan->first()->surat_kodepos}}" autocomplete="off" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                      <label for="exampleInputEmail1">Nama Penanggung Jawab</label>
                      <input type="text" class="form-control" name="cp_name" value="{{ $rekanan_group->cp_name }}" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Jabatan </label>
                      <input type="text" class="form-control" name="cp_jabatan" value="{{ $rekanan_group->cp_jabatan }}" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nama Saksi </label>
                      <input type="text" class="form-control" name="saksi_name" value="{{ $rekanan_group->saksi_name }}" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Jabatan </label>
                      <input type="text" class="form-control" name="saksi_jabatan" value="{{ $rekanan_group->saksi_jabatan }}" autocomplete="off" required>
                  </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-6">
           <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Perusahaan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" class="form-control" name="email" id="email" autocomplete="off" value="{{ $rekanan->first()->email or '' }}" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Telepon</label>
                  <input type="text" class="form-control" name="telpon" id="telpon" autocomplete="off" value="{{ $rekanan->first()->telp or ''}}" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Fax</label>
                  <input type="text" class="form-control" name="fax" id="fax" autocomplete="off" value="{{ $rekanan->first()->fax or ''}}" required>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>

          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-6">
           <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Tipe Rekanan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                
                <div class="form-group">
                  <label for="exampleInputPassword1">Nomor SIUP</label>
                  <input type="text" class="form-control" id="siup" name="siup" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Upload SIUP ( Harap upload dalam bentuk images )</label>
                  <input type="file" id="siup_img" name="siup_img" required><br>

                  <img src="{{ url('/')}}/assets/rekanan/{{ $rekanan_group->id }}/{{ $rekanan->first()->siup_image}}" style="width: 300px;">
                </div>                
              </div>
              <!-- /.box-body -->
            </form>
          </div>
          <!-- /.box -->
        </div>
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
@include("rekanan::user.app")
</body>
</html>
