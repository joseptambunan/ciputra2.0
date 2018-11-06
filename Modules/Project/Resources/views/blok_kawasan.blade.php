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
      <h1>Data Proyek <strong>{{ $projectkawasan->project->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/')}}/project/kawasan/">Kawasan {{ $projectkawasan->name }}</a></li>
                <li class="breadcrumb-item active">Blok</li>
              </ol>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <a href="{{ url('/')}}/project/add-blok?id={{ $projectkawasan->id }}" class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i>Tambah Blok</a>
              <a href="{{ url('/')}}/project/kawasan/" class="btn btn-warning">Kembali</a><br><br>
              <table id="example2" class="table table-bordered table-hover">   
              {{ csrf_field() }}              
              <thead style="background-color: greenyellow;">
                <tr>
                  <td>Progress</td>
                  <td>Unit</td>
                  <td>#</td>
                  <td>Nama</td>
                  <td>Project</td>
                  <td>Kawasan</td>
                  <td>Luas Lahan(m2)</td>
                  <td colspan="9">Dev Cost</td>
                  <td>Con Cost</td>
                  <td colspan="9">Descriptipn</td>
                  <td>Edit</td>
                  <td>Delete</td>
                </tr>
              </thead>
                <tbody>
                 @foreach ( $projectkawasan->bloks as $key => $value )
                
                 <tr>
                    <td>&nbsp;</td>
                    <td><a href="{{ url('/')}}/project/units/?id={{ $value->id }}" class="btn btn-primary">{{ count($value->units) }} Unit</a></td>
                    <td>#</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $projectkawasan->project->name }}</td>
                    <td>{{ $projectkawasan->name }}</td>
                    <td>{{ number_format($value->luas) }}</td>
                    <td colspan="9"></td>
                    <td></td>
                    <td colspan="9"></td>
                    <td><a href="{{ url('/')}}/project/edit-blok?id={{ $value->id }}" class="btn btn-warning">Edit</a></td>
                    <td><button class="btn btn-danger" onclick="removeblok('{{ $value->id }}','{{ $value->name }}')">Delete</button></td>
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
  $('#example3').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false,
      fixedColumns:   {
          leftColumns: 4
      }
    });


</script>
</body>
</html>
