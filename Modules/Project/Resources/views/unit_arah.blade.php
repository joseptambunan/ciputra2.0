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
      <h1>Data Proyek <strong>{{ $project->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">

            </div>
            <!-- /.box-header -->

            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-6">
                <h3 class="header">Tambah Arah Hadap Bangunan</h3>
                 <form action="{{ url('/')}}/project/save-hadap" method="post" name="form1">
                  <input type="hidden" name="project_id" value="{{ $project->id}}">
                  {{ csrf_field() }}                  
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nama</label>
                      <input type="text" class="form-control" name="arah" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                  </div>
                </form>
              </div>
            </div>

            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">   
              {{ csrf_field() }}              
              <thead class="head_table">
                <tr>
                  <td>Arah</td>
                  <td colspan="2">Perubahan Data</td>
                </tr>
              </thead>
                <tbody>
                 @foreach ( $hadap as $key => $value )                
                 <tr>
                    <td>
                      <span id="label_{{ $value->id }}">{{ $value->name }}</span>
                      <input type="text" name="input_kode{{ $value->id }}" id="input_kode{{ $value->id }}" style="display: none;" value="{{ $value->kode }}">
                    </td>
                    <td><button class="btn btn-danger" onclick="removeunit('{{ $value->id }}','{{ $value->name }}')">Delete</button></td>
                 </tr>
                 @endforeach
                </tbody>
              </table>
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
  function removeunit(id){
    if ( confirm("Apakah anda yakin ingin menghapus unit hadap ini ?")){
      var request = $.ajax({
        url : "{{ url('/')}}/project/delete-hadap",
        dataType : "json",
        data : {
          id : id
        },
        type : "post"
      });

      request.done(function(data){
        if ( data.status == "0"){
          alert("Data telah dihapus");
        }
        window.location.reload();
      });
    }else{
      return false;
    }
  }
</script>
</body>
</html>
