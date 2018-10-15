<!DOCTYPE html>
<html>
@include('user.header')

<style type="text/css">
    #example3 th,
    #example3 td {
        white-space: nowrap;
    }
   

</style>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
 
  <!-- /.navbar -->
  @include('user.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Project <strong>{{ $blok->project->name or '' }}</strong></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/') }}\user\budget\detail?id={{ $blok->project_id }}">Budget</a></li>
              <li class="breadcrumb-item active">Template Pekerjaan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      <a href="{{ url('/') }}/user/budget/unit/?id={{ $blok->project_kawasan_id}}" class="btn btn-warning">Back</a>
    </section>

    <!-- Main content -->
    <input type="hidden" name="project_id" id="project_id" value="{{ $blok->project_id }}"/>
    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}"/>
    <section class="content" style="font-size:17px;">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Document <strong>Budget Kawasan {{ $blok->project_kawasan->name }}</strong></h3>
              
            
            </div>
            <!-- /.card-header -->
            
            <div class="card-body">
              <table id="example2" class="table table-bordered">
                <thead style="background-color: #17a2b8;color:white;font-weight: bolder;;">
                <tr>
                  <th>No</th>
                  <th>Type</th>
                  <th>Construction Cost(Rp)</th>
                  <th>Item Pekerjaan</th>
                </tr>
                </thead>
                <tbody id="content_kawasan" style="background-color: white;">
                  @for ( $i=0; $i < count($template); $i++ )
                  <tr>         
                    <td>{{ $i + 1 }}</td>
                    <td>{{ \App\TemplatePekerjaan::find($template[$i])->name }}</td>
                    <td>{{ number_format(\App\TemplatePekerjaan::find($template[$i])->concost) }}</td>
                    <td><a class="btn btn-primary" href="{{ url('/')}}/user/budget/unit/template/detail?id={{ $template[$i] }}&blok={{ $blok->id }}">Item Pekerjaan</a></td>
                  </tr>
                  @endfor
                </tbody>
              </table><br>

            </div>
            <!-- /.card-body -->

          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.0-alpha
    </div>
    <strong>Copyright &copy; 2014-2018 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>


</div>
<!-- ./wrapper -->
@include('user.footer')
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.4/js/dataTables.fixedColumns.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/fixedcolumns/3.0.2/css/dataTables.fixedColumns.css">
<script type="text/javascript">
  $(document).ready(function() {
    $('#example3').DataTable( {
        scrollY:        300,
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   {
          leftColumns: 1,
        }
    } );
  });

 
</script>

</body>
</html>
