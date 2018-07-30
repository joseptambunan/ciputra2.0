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
              <h3 class="box-title">Tambah COA Item</h3>
              <form action="{{ url('/')}}/pekerjaan/add-pekerjaan" method="post" name="form1">
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
                <label>Code Pekerjaan</label>
                <input type="text" class="form-control" name="code">
              </div>
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="name">
              </div>
              <div class="form-group">
                <label>Department</label>
                <select class="form-control" name="department">
                  @foreach ( $department as $key => $value)
                  <option value="{{ $value->id }}">{{ $value->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Ppn</label>
                <input type="text" class="form-control" name="ppn" value="10" id="ppn">
              </div>
              <div class="form-group">
                <label>Tag</label>
                <select class='form-control' name='tag' id="tag">
                  <option value='0'>Item Pekerjaan Unit</option>
                  <option value='1'>Item Pekerjaan Non Unit</option>
                  <option value='2'>Others</option>
                </select>
              </div>
              <div class="form-group">
                <label>Group Cost</label>
                <select class='form-control' name='group_cost' id="group_cost">
                  @foreach ( $budgetgroup as $key2 => $value2 )
                  <option value="{{ $value2->id }}">{{ $value2->name }}</option>
                  @endforeach
                </select>
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
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script type="text/javascript">
  $(function () {
    $("#ppn").number(true);
  });
</script>
@include("pt::app")
</body>
</html>
