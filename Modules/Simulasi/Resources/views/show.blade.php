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
      <h1>Data Tender</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
   
            <!-- /.box-header -->
            <div class="box-body">
              <form action="{{ url('/')}}/simulasi/update" method="post" name="form1"> 
                {{ csrf_field() }}
                <div class="col-md-12">
               
                <button class="btn btn-primary" type="submit">Simpan</button>
              	<table class="table table-bordered table-hover">
                  <thead>
                  <tr style="background-color: greenyellow;">
                    <th>No.</th>
                    <th>No. Tender </th>
                    <th>Nama Tender </th>
                    <th>Nama Rekanan</th>
                    <th>Project</th>
                    <th>Departemen</th>
                    <th>Status Bayar</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php $start = 0; @endphp
                  @foreach ( $tender_rekanan as $key => $value )
                  @if ( $value->id == 892 )
                    @if ( $value->tender != "" )
                    <tr>
                      <td>{{ $start + 1  }}</td>
                      <td>{{ $value->tender->no }}</td>
                      <td>{{ $value->tender->name }}</td>
                      <td>{{ $value->rekanan->name }}</td>
                      <td>{{ $value->tender->rab->workorder->project->name or '' }}</td>
                      <td>CONSTRUCTION AND DEVELOPMENT</td>
                      <td>
                        @if ( $value->doc_bayar_status == "0" )
                        <input type="checkbox" name="terbayar[{{$start}}]" value="{{ $value->id }}">
                        @else
                        <input type="checkbox" name="terbayar[{{$start}}]" checked> <strong>Terbayar</strong>
                        @endif
                      </td>
                    </tr>
                    @php $start++; @endphp
                    @endif
                  @endif
                  @endforeach
                </tbody>
                </table>
              </form>
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
