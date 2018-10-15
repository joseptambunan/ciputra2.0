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
            <div class="box-body">
              <a href="{{ url('/')}}/project/add-kawasan" class="btn-lg btn-primary"><i class="glyphicon glyphicon-plus-sign"></i>Tambah Kawasan</a>
              <table id="example2" class="table table-bordered table-hover">   
              {{ csrf_field() }}              
              <thead style="background-color: greenyellow;">
                <tr>
                  <td rowspan="3">Progress</td>
                  <td rowspan="3">Blok</td>
                  <td rowspan="3">#</td>
                  <td rowspan="3">Project</td>
                  <td rowspan="3">Kawasan</td>
                  <td rowspan="3">Luas Lahan Brutto</td>
                  <td rowspan="3">Luas Lahan Netto</td>
                  <td rowspan="3">Status Lahan</td>
                  <td colspan="5"><center>Dev Cost</center></td>
                  <td rowspan="3">Edit</td>
                  <td rowspan="3">Delete</td>
                </tr>
                <tr>
                  <td colspan="3">Budget</td>
                  <td rowspan="2">SPK</td>
                  <td rowspan="2">Realisasi</td>
                </tr>
                <tr>
                  <td>Total(Rp)</td>
                  <td>HPP Bruto(Rp/m2)</td>
                  <td>HPP Netto(Rp/m2)</td>
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
                    <td>&nbsp;</td>
                    <td><a href="{{ url('/')}}/project/bloks/?id={{ $value->id }}" class="btn btn-primary">{{ count($value->bloks) }} Blok</a></td>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->project->name }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ number_format($value->lahan_luas) }}</td>
                    <td>{{ number_format($value->netto_kawasan) }}</td>
                    <td><span class="label {{ $arrlabel[$value->lahan_status]['class'] }}">{{ $arrlabel[$value->lahan_status]['label'] }}</span></td>
                    <td>{{ number_format($value->budgets->sum('nilai'),2)}}</td>
                    <td>{{ number_format($value->budgets->sum('nilai') / $value->lahan_luas,2)}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
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
