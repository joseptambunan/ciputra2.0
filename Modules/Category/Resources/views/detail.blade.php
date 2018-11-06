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

  @include("master/sidebar")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Kategori Bangunan</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
   
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-6">
                <h3 class="header">Tambah Kategori <strong>{{ $category->name or ''}}</strong></h3>
            	   <form action="{{ url('/')}}/category/add-detail" method="post" name="form1">
                  <input type="hidden" name="category_id" value="{{ $category->id}}">
                  {{ csrf_field() }}                  
                  <div class="form-group">
                      <label for="exampleInputEmail1">Type </label>
                      <input type="text" class="form-control" name="nama" id="nama" autocomplete="off" required>
                  </div>
                  
                  <div class="box-footer">
                    <i class="fa fa-refresh ld ld-spin" id="loading" style="display: none;"></i>
                    <button type="submit" class="submitbtn btn btn-primary" id="btn_submit">Simpan</button>
                    <a href="{{ url('/')}}/category" class="btn btn-warning">Kembali</a>
                  </div>
              	</form>
              </div>
              <div class="col-md-12">

              <form action="{{ url('/')}}/category/update-percentage" method="post" name="form1">
                {{ csrf_field()}}
                <input type="hidden" class="form-control" name="category_id" id="category_id" autocomplete="off" value="{{ $category->id }}" required>
              	<table id="example3" class="table table-bordered table-hover">
                  <thead>
                    <tr style="background-color: greenyellow;">
                      <th>Tipe </th>
                      <th>Percentage Kenaikan(%)</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ( $details as $key => $value )
                    <tr>
                      <td>                      
                          <input type="hidden" class="nilai_budget form-control" name="id_[{{$key}}]" value="{{ number_format($value->id)}}">                 
                          {{ $value->sub_type}}
                      </td>
                      <td><input type="text" class="nilai_budget form-control" name="percentage_[{{$key}}]" value="{{ number_format($value->percentage,2)}}" required></td>
                      <td><button onclick="removedetail('{{ $value->id}}')" class="btn btn-danger">Hapus</button></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <button type="submit" class="submitbtn btn btn-primary" id="btn_submit">Update Percentage</button>
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
@include("category::app")
<script type="text/javascript">
  $("#btn_submit").click(function(){
    if ( $("#nama").val() != "" ){
      $(".submitbtn").hide();
      $("#loading").show();      
    }
  });
</script>
</body>
</html>
