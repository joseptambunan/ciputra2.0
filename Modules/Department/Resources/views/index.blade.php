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
      <h1>Data Departemen</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
   
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-6">
                <h3 class="header">Tambah Departemen</h3>
            	<form action="{{ url('/')}}/department/add-department" method="post" name="form1">
                  {{ csrf_field() }}                  
                  <div class="form-group">
                      <label for="exampleInputEmail1">Kode Departemen</label>
                      <input type="text" class="form-control" name="code">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nama Departemen</label>
                      <input type="text" class="form-control" name="department">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Keterangan</label>
                      <textarea name="keterangan" class="form-control" rows="3"> </textarea>
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
              	</form>
              </div>
              <div class="col-md-12">
            	<table id="example3" class="table table-bordered table-hover">
                <thead>
                <tr style="background-color: greenyellow;">
                  <th>Kode Departmen </th>
                  <th>Departemen </th>
                  <th>Perubahan Data</th>
                </tr>
                </thead>
                <tbody>
                @foreach ( $department as $key => $value )
                <tr>
                  <td>
                    <span class="labels" id="label_dept_{{ $value->id}}">{{ $value->code }}</span>
                    <input type="text" id="dept_code_{{ $value->id }}" style="display: none;" value="{{ $value->code}}" data-attribute="{{ $value->id }}" class="form-control col-xs-4">
                  </td> 
                  <td>
                  	<span class="labels" id="label_{{ $value->id}}">{{ $value->name }}</span>
                  	<input type="text" id="dept_{{ $value->id }}" style="display: none;" value="{{ $value->name}}" data-attribute="{{ $value->id }}" class="form-control col-xs-4">
                  </td>                  
                  <td>
                  	<button class="btn btn-warning" id="btn_status_{{ $value->id }}" onclick="showedit('{{ $value->id}}');">Ubah</button>
                  	<button class="btn btn-success" id="btn_save_{{ $value->id }}" onclick="saveEdit('{{ $value->id}}','{{ $value->name}}');" style="display: none;">Ubah</button>
                  	<button href="#" onclick="deleteDept('{{ $value->id}}','{{ $value->name }}')" class="btn btn-danger">Hapus</button>
                  </td>
                </tr>
                @endforeach
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
@include("department::app")
</body>
</html>
