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

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Proyek <strong>{{ $project->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">   

              <h3 class="box-title">Tambah Data RAB dari WO <strong>{{ $workorder->no }}</strong></h3>           
              <form action="{{ url('/')}}/rab/save" method="post" name="form1">
                <input type="hidden" class="form-control" name="rab_wo" value="{{ $workorder->id }}">
                {{ csrf_field() }}
              <div class="form-group">
                <label>Nama RAB</label>
                <input type="text" class="form-control" name="rab_name" autocomplete="off"  value="{{ $workorder->name or ''}}" required>
              </div>
                               
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
              
              <!-- /.form-group -->
            </div>

            </form>
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
@include("rab::app")
</body>
</html>
