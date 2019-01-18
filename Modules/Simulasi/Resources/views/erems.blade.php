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

  @include("master/sidebar_simulasi")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Proyek</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
   
            <!-- /.box-header -->
            <div class="box-body">
                {{ csrf_field() }}
                <div class="col-md-12">
              	<table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr style="background-color: greenyellow;">
                      <th>No.</th>
                      <th>Nama</th>
                      <th>Detail</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $start = 0; @endphp
                    @foreach ( $project as $key => $value )                     
                      <tr>
                        <td>{{ $start + 1  }}</td>      
                        <td>{{ $value->name}}</td>   
                        <td><a class="btn btn-primary" href="{{ url('/')}}/simulasi/erems/project?id={{$value->id}}">Detail</a></td>    
                      </tr>
                      @php $start++; @endphp
                    @endforeach
                  </tbody>
                </table>
              </div>
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
@include("master/copyright")

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("simulasi::app")
<script type="text/javascript">
  $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
</script>
</body>
</html>
