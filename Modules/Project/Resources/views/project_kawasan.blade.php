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
      <h4>Total Luas Brutto : {{ number_format($project->luas) }} m2</h4>
      <h4>Total Luas Netto  : {{ number_format( $project->netto) }} m2</h4>
      <h4>Total Unit  : {{ number_format( count($project->units)) }} m2</h4>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Kawasan</li>
              </ol>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <a href="{{ url('/')}}/project/add-kawasan" class="btn-lg btn-primary"><i class="glyphicon glyphicon-plus-sign"></i>Tambah Kawasan</a><br/><br/>
              <table id="example2" class="table table-bordered table-hover ">   
              {{ csrf_field() }}              
              <thead style="background-color: greenyellow;">
                <tr>
                  <td rowspan="3">Kawasan</td>
                  <td rowspan="3">Luas<br/>Lahan Brutto(m2)</td>
                  <td rowspan="3">Luas<br/>Lahan Netto(m2)</td>
                  <td rowspan="3">Jumlah<br/> Blok</td>
                  <td rowspan="3">Jumlah<br/> Unit</td>
                  <td rowspan="3">Status Lahan<br>(PL,UC,F)</td>
                  <td rowspan="3">Edit Blok</td>
                  <td rowspan="3">Edit Kawasan</td>
                  <td rowspan="3">Delete</td>
                </tr>                
              </thead>
                <tbody>
                 @foreach ( $project->kawasans as $key => $value )
                 @php 
                  $arrlabel = array ( 
                   "0" => array("class" => "label-success", "label" => "Open"), 
                   "1" => array("class" => "label-danger", "label", ""), 
                   "2" => array("class" => "label-success", "label" => "Open")
                  ); 
                 @endphp
                 <tr>
                    <td>{{ $value->name }}</td>
                    <td>{{ number_format($value->lahan_luas) }}</td>
                    <td>{{ number_format($value->netto_kawasan) }}</td>
                    <td>{{ number_format($value->bloks->count()) }}</td>
                    <td>{{ number_format($value->units->count()) }}</td>
                    <td>Planning</td>
                    
                    <td><a href="{{ url('/')}}/project/bloks/?id={{ $value->id }}" class="btn btn-primary">Edit</a></td>
                    <td><a class="btn btn-warning" href="{{ url('/')}}/project/edit-kawasan?id={{ $value->id }}">Edit</a></td>
                    <td><button class="btn btn-danger" onclick="removeKawasan('{{ $value->id }}','{{ $value->name }}')">Hapus</button></td>
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
    })


</script>
</body>
</html>
