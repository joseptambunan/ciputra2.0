<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard </title>
  @include("master/header")
  <!-- Select2 -->  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
              <h3 class="box-title">Tambah Data Budget Proyek</h3>
              <form action="/budget/save-budget" method="post" name="form1">
                {{ csrf_field() }}
              <input type="hidden" name="project_id" name="project_id" value="{{ $project->id }}">
              <div class="form-group">
                <label>Project</label>
                <input type="text" class="form-control" value="{{ $project->name }}" readonly>
              </div>
              <div class="form-group">
                <label>PT</label>
                <select class="form-control" name="pt_id">
                  @foreach ( $project->pt_user as $key => $value )
                  
                  <option value="{{ $value->pt->id }}">{{ $value->pt->name }}</option>
                  
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Department</label>
                <select class="form-control" name="department">
                  @foreach ( $project->pt_user as $key => $value )
                    @foreach ( $value->pt->mapping as $key2 => $value2 )
                      <option value="{{ $value2->department->id }}">{{ $value2->department->name }}</option>
                    @endforeach
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Kawasan</label>
                <input type="checkbox" name="iskawasan" id="iskawasan" onClick="setkawasan();">
                <select class="form-control" name="kawasan" id="kawasan" style="display: none;" >
                  @foreach ( $project->kawasans as $key2 => $value2 )
                  <option value="{{ $value2->id }}">{{ $value2->name }}</option>
                  @endforeach 
                </select>
              </div>
              <div class="form-group">
                <label>Start Date</label>
                <input type="text" class="form-control" name="start_date" id="start_date" autocomplete="off">
              </div>
              <div class="form-group">
                <label>End Date</label>
                <input type="text" class="form-control" name="end_date" id="end_date" autocomplete="off">
              </div>
              <div class="form-group">
                <label>Keterangan Budget</label>
                <input type="text" class="form-control" name="description" autocomplete="off">
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
@include("pt::app")
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  $(function () {
    $("#luas").number(true);
    $("#luas_brutto").number(true);
    $("#luas_netto").number(true);
    $('#start_date').datepicker({
      "dateFormat" : "yy-mm-dd",
      "changeMonth": true,
      "changeYear": true
    });

     $('#end_date').datepicker({
      "dateFormat" : "yy-mm-dd",
      "changeMonth": true,
      "changeYear": true
    });
  });

  function setkawasan(){
    if ( $("#iskawasan").is(":checked")){
      $("#kawasan").show();
    }else{
      $("#kawasan").hide();
    }
  }
</script>
</body>
</html>
