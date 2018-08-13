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

              <h3 class="box-title">Tambah Data Tender</h3>           
              <form action="{{ url('/')}}/tender/save" method="post" name="form1">
                {{ csrf_field() }}
                <div class="form-group">
                  <label>No. RAB</label>
                  <select class="form-control" name="tender_rab">
                    @foreach ( $workorder as $key2 => $value2  )
                      @foreach ( $value2->rabs as $key => $value )
                        @if ( count(Modules\Tender\Entities\Tender::where("rab_id",$value->id)->get()) <= 0 )
                        <option value="{{ $value->id }}">{{ $value->no }} / {{ \Modules\Pekerjaan\Entities\Itempekerjaan::find($value->parent_id)->code }} - {{ \Modules\Pekerjaan\Entities\Itempekerjaan::find($value->parent_id)->name }}</option>
                        @endif
                      @endforeach
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Nama Tender</label>
                  <input type="text" class="form-control" name="tender_name" value="" required>
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
@include("rab::app")
</body>
</html>
