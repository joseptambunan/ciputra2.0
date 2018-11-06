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
                <li class="breadcrumb-item"><a href="{{ url('/')}}/project/kawasan/">Kawasan {{ $blok->kawasan->name }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/')}}/project/bloks/?id={{ $blok->kawasan->id}}">Blok {{ $blok->name }}</a></li>
                <li class="breadcrumb-item active">Unit</li>
              </ol>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <a href="{{ url('/')}}/project/add-unit?id={{ $blok->id }}" class="btn-lg btn-primary"><i class="glyphicon glyphicon-plus-sign"></i>Tambah Unit</a><br><br>
              <table id="example2" class="table table-bordered table-hover">   
              {{ csrf_field() }}              
              <thead style="background-color: greenyellow;">
                <tr>
                  <td>Progress</td>
                  <td>#</td>
                  <td>Unit No.</td>
                  <td>Project</td>
                  <td>Kawasan</td>
                  <td>Luas Tanah(m2)</td>
                  <td>Luas Bangunan(m2)</td>
                  <td>Sellable</td>
                  <td>Kategori</td>
                  <td>Type</td>
                  <td>Arah</td>
                  <td>Status</td>
                  <td>ST 1</td>
                  <td>ST 2</td>
                  <td>Edit</td>
                </tr>
              </thead>
                <tbody>
                 @foreach ( $blok->units as $key => $value )
                 @php $arrayAngin = array("1" => "Utara", "2" =>"Timur Laut", "3" => "Timur", "4" => "Tenggara", "5" => "Selatan", "6" => "Barat Daya", "7" => "Barat", "8" => "Barat Laut") @endphp
                 <tr>
                    <td>&nbsp;</td>
                    <td>#</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->blok->project_kawasan->project->name }}</td>
                    <td>{{ $value->blok->project_kawasan->name }}</td>
                    <td>{{ number_format($value->tanah_luas,2) }}</td>
                    <td>{{ number_format($value->bangunan_luas) }}</td>
                    <td>{{ $value->is_sellable ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $value->tag_kategori == 'B' ? 'Bangunan' : 'Kavling'}}</td>
                    <td>{{ $value->type->name or '' }}</td>
                    <td>&nbsp;</td>
                    <td>
                      @if($value->status == 0)
                        <div class="alert-info fade in" style="text-align:center;background-color:#b3ffb3;color:#cc7a00">Open</div>
                      @elseif($value->status == 1)
                        <div class="alert-info fade in" style="text-align:center;background-color:#b3ffb3;color:#cc7a00">Planning</div>
                      @elseif($value->status == 2)
                        <div class="alert-info fade in" style="text-align:center;background-color:#fdfc93;color:#817f01">In Progress</div>
                      @elseif($value->status == 4)
                        <div class="alert-info fade in" style="text-align:center;background-color:#89fda7;color:#038725">Release
                      @elseif($value->status == 5)
                        <div class="alert-info fade in" style="text-align:center;background-color:#97dbfd;color:#036697">Approved</div>
                      @elseif($value->status == 7)
                        <div class="alert-info fade in" style="text-align:center;background-color:#fda8a8;color:#b70101">Rejected</div>
                      @else
                        <div class="alert-info fade in" style="text-align:center;background-color:#fda8a8;color:#b70101">Rejected</div>
                      @endif
                    </td>
                    <td>{{ $value->st1_date }}</td>
                    <td>{{ $value->st2_date }}</td>
                    <td><a class="btn btn-danger" href="{{ url('/')}}/project/edit-unit?id={{ $value->id }}">Edit</a></td>
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
