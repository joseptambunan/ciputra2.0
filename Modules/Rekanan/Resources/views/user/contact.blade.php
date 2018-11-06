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
              <div class="col-md-6">
                <h3 class="header">Data Kontak Person</h3>
                 <form action="{{ url('/')}}/rekanan/user/updatecontact" method="post" name="form1">
                  <input type="hidden" value="{{ $rekanan_group->id}}" name="rekanan_group_id">
                  {{ csrf_field() }}                  
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nama Wakil Kantor Pusat</label>
                      <input type="text" class="form-control" name="cp_name" value="{{ $rekanan_group->cp_name }}" autocomplete="off">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Jabatan Wakil Kantor Pusat</label>
                      <input type="text" class="form-control" name="cp_jabatan" value="{{ $rekanan_group->cp_jabatan }}" autocomplete="off">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nama Saksi Kantor Pusat</label>
                      <input type="text" class="form-control" name="saksi_name" value="{{ $rekanan_group->saksi_name }}" autocomplete="off">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Jabatan Saksi Kantor Pusat</label>
                      <input type="text" class="form-control" name="saksi_jabatan" value="{{ $rekanan_group->saksi_jabatan }}" autocomplete="off">
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
              </div>

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
@include("rekanan::user.app")
</body>
</html>
