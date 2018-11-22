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

  @include("master/sidebar")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Master Item Budget</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">

            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">                    
              <button class="btn btn-primary" onclick="addpekerjaan('{{$budget_type->id}}');">Tambah Item Pekerjaan</button>
              <a href="{{ url('/')}}/budget/master/detail-add" class="btn btn-warning">Kembali</a>
              <table id="example3" class="table table-bordered table-hover">   
              {{ csrf_field() }}              
              <thead class="head_table">
                <tr>
                  <td>No.</td>
                  <td>Coa Pekerjaan</td>
                  <td>Item Pekerjaan</td>
                  <td>Satuan</td>
                  <td>Hapus</td>
                </tr>
              </thead>
              <tbody>               
                @foreach ( $budget_type->details as $key => $value  )
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>
                    @if ( $value->itempekerjaan->code == "225.00" || $value->itempekerjaan->code == "225.01" || $value->itempekerjaan->code == "225.04" || $value->itempekerjaan->code == "225.05")
                      {{ $value->itempekerjaan->code }}
                    @else
                      {{ $value->itempekerjaan->child_item->first()->code or '' }}
                    @endif
                  </td>
                  <td>{{ $value->itempekerjaan->name or '' }}</td>
                  <td>{{ $value->itempekerjaan->details->satuan or '' }}</td>
                  <td><button class="btn btn-danger" onclick="removepekerjaan('{{ $value->id }}')">Hapus</button></td>
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
  @include("master/copyright")

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("budget::master.app")
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
