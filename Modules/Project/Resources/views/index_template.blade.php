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

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Divison</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
   
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-6">
                <h3 class="header">Tambah Template Pekerjaan</h3>
            	   <form action="{{ url('/')}}/project/add-template" method="post" name="form1">
                  <input type="hidden" name="unit_type" value="{{ $unit_type->id }}">
                  {{ csrf_field() }}                  
                  <div class="form-group">
                      <label for="exampleInputEmail1">Kode Template Pekerjaan</label>
                      <input type="text" class="form-control" name="code">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nama Template Pekerjaan</label>
                      <input type="text" class="form-control" name="nama">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Luas Bangunan(m2)</label>
                      <input type="text" class="form-control" name="lb" id="lb" max="{{ $unit_type->luas_bangunan}}" onKeyup="luasbangunan();" value="{{ $unit_type->luas_bangunan}}">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Luas Tanah(m2)</label>
                      <input type="hidden" class="form-control" name="lt" id="lt" value="{{ $unit_type->luas_tanah }}">
                      <input type="text" class="form-control" value="{{ $unit_type->luas_tanah }}" readonly>
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="submitbntn">Simpan</button>
                    <a class="btn btn-warning" href="{{ url('/')}}/project/unit-type">Kembali</a>
                  </div>
              	</form>
              </div>
              <div class="col-md-12">
            	<table id="example3" class="table table-bordered table-hover">
                <thead>
                <tr style="background-color: greenyellow;">
                  <th>Template Pekerjaan </th>
                  <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ( $unit_type->templates as $key => $value )
                  <tr>
                    <td>{{ $value->name }}</td>
                    <td><a class="btn btn-success" href="{{ url('/')}}/project/detail-template/?id={{ $value->id }}">Detail</a></td>
                  </tr>
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
@include("project::app")
<script type="text/javascript">
  function luasbangunan() {

    if ( parseInt($("#lb").val()) > parseInt($("#lt").val()) ) {
      $("#submitbntn").attr("disabled", true);
    }else if ( parseInt($("#lb").val()) <= parseInt($("#lt").val()) ){
      $("#submitbntn").removeAttr("disabled");
    }else if ( parseInt($("#lb").val() == "0" )){
      $("#submitbntn").attr("disabled", true);
    }
  }
</script>
</body>
</html>
