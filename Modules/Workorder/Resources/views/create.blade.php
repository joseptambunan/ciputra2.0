<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard </title>
  @include("master/header")
    <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('/')}}/assets/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Workorder</h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">   

              <h3 class="box-title">Tambah Data Workorder</h3>           
              <form action="{{ url('/')}}/workorder/save" method="post" name="form1">
                {{ csrf_field() }}
              <div class="form-group">
                <label>Department In Charge</label>
                <select class="form-control" name="department_from">
                  @foreach ( $project->budget_department as $key => $value )                   
                      <option value="{{ $value}}">{{ \Modules\Department\Entities\Department::find($value)->name }}</option>
                  @endforeach
                </select>
              </div>  
              <div class="form-group">
                <label>Department Support</label>
                <select class="form-control" name="department_to">
                  @foreach ( $project->budget_department as $key => $value )                   
                      <option value="{{ $value}}">{{ \Modules\Department\Entities\Department::find($value)->name }}</option>
                  @endforeach
                </select>
              </div>  
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="workorder_name" autocomplete="off" required>
              </div>
               <div class="form-group">
                <label>Keterangan</label>
                <input type="text" class="form-control" name="workorder_description" autocomplete="off">
              </div>                
             
              
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
             <div class="col-md-6">
              <h3>&nbsp;</h3>
              <div class="form-group">
                <label>Durasi Proses WO (Hari Kalender)</label>
                <input type="text" class="form-control" name="workorder_durasi" id="workorder_durasi" value="0" autocomplete="off" required>
              </div> 
              <div class="form-group">
                <label>Start Date</label>
                <input type="text" class="form-control" name="start_date" id="start_date" autocomplete="off" required>
              </div> 
              <div class="form-group">
                <label>End Date</label>
                <input type="text" class="form-control" name="end_date" id="end_date" autocomplete="off" required>
              </div> 
                <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
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
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  $(function () {
    $("#luas").number(true);

    $('#start_date').datepicker({
      "dateFormat" : "yy-mm-dd"
    });

    $('#end_date').datepicker({
      "dateFormat" : "yy-mm-dd"
    });

  });

  $("#start_date").change(function(){
      var date = $('#start_date').datepicker('getDate');
      date.setTime(date.getTime() + (1000 * 60 * 60 * 24 * $("#workorder_durasi").val()));
      $('#end_date').datepicker("setDate", date);
      //$("#end_date").val(tomorrow);
  });

</script>
@include("pt::app")
</body>
</html>
