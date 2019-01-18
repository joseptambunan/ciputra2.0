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
      <h1>Data Proyek</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <input type="hidden" name="workorder" id="workorder" value="{{ $rab->id }}">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <!-- /.box-header -->
        <div class="box-body">
          Workorder : <strong>{{ $rab->workorder->no }} - {{ $rab->workorder->name }}</strong><br>
          <h3><strong>Nilai Workorder Rp {{ number_format($rab->workorder->nilai)}}</strong></h3>
          <h3><strong>Nilai RAB Rp {{ number_format($rab->nilai) }} </strong></h3>
        </div>
        <!-- /.box-body -->

        <table class="table table-bordered">
          <thead class="head_table">
            <tr>
              <td>COA Pekerjaan</td>
              <td>Item Pekerjaan</td>
              <td>Volume</td>
              <td>Sat</td>
              <td>Hrg Sat</td>
              <td>Subtotal</td>
              <td>Bobot(%)</td>
              <td>Perubahan Data</td>
             </tr>
          </thead>
        </table>
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
  <div class="modal fade" id="modal-info">

   

  </div>
  <!-- /.modal -->


  <!-- /.modal -->
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("rab::app")
<!-- Select2 -->
<script type="text/javascript">

</script>
</body>
</html>
