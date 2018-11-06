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
              <form action="{{ url('/')}}/rekanan/user/savecabang" method="post" name="form1">
                <h3 class="header">Data Cabang <strong>{{ $rekanan_group->name or ''}}</strong></h3>                 
                <input type="hidden" value="{{ $rekanan_group->id}}" name="rekanan_group_id">
                {{ csrf_field() }}                  
                <div class="col-md-6">                  
                    <div class="form-group">
                      <label for="exampleInputEmail1">Kota</label>
                      <select class="select2 form-control" name="kota">
                        @foreach ( $city as $key => $value )
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" class="form-control" name="name" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Alamat Koresponden</label>
                        <input type="text" class="form-control" name="alamat" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kode Post</label>
                        <input type="text" class="form-control" name="kodepost" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" class="form-control" name="email" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Telepon</label>
                        <input type="text" class="form-control" name="telepon" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Fax</label>
                        <input type="text" class="form-control" name="fax" autocomplete="off" required>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nama Penanggung Jawab</label>
                      <input type="text" class="form-control" name="cp_name" value="" autocomplete="off">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Jabatan </label>
                      <input type="text" class="form-control" name="cp_jabatan" value="" autocomplete="off">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nama Saksi </label>
                      <input type="text" class="form-control" name="saksi_name" value="" autocomplete="off">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Jabatan </label>
                      <input type="text" class="form-control" name="saksi_jabatan" value="" autocomplete="off">
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </div>
              </form>
              <div class="col-md-12 table-responsive">
                <table class="table table-bordered">
                  <thead class="head_table">
                    <tr>
                      <td>Nama</td>
                      <td>Kota</td>
                      <td>Alamat</td>
                      <td>Email</td>
                      <td>Telepon</td>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach( $rekanan_group->rekanans as $key => $value )
                    @if ( $value->kelas_id != "")
                    <tr>
                      <td>{{ $value->name or ''}}</td>
                      <td>{{ $value->city->name or '' }}</td>
                      <td>{{ $value->surat_alamat or ''}}</td>
                      <td>{{ $value->email or ''}}</td>
                      <td>{{ $value->telp or ''}}</td>
                    </tr>
                    @endif
                    @endforeach
                  </tbody>
                </table>
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
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
</body>
</html>
