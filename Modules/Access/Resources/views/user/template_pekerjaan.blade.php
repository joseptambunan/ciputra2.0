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
      <a href="{{ url('/') }}/user/budget/unit/template?id={{ $blok->id}}" class="btn btn-warning">Back</a>
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
            <div class="card-body col-md-4">
              <table id="example1" class="table table-bordered table-striped">
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>Nama</strong></span></td>
                  <td>{{ $template->name }}</td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>Luas Bangunan</strong></span></td>
                  <td>{{ $template->luasbangunan }}</td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>Hpp ( Rp)</strong></span></td>
                  <td>{{ number_format($template->hppbangunanpermeter) }}</td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>Description</strong></span></td>
                  <td>{!! $template->description !!}</td>
                </tr>
              </table><br>
            </div>

            <div class="card-body">
              <table id="example2" class="table table-bordered">
                <thead style="background-color: #17a2b8;color:white;font-weight: bolder;;">
                <tr>
                  <th>No</th>
                  <th>COA</th>
                  <th>Item Pekerjaan</th>
                  <th>Volume</th>
                  <th>Satuan</th>
                  <th>Harga Satuan(Rp)</th>
                  <th>Sub Total(Rp)</th>
                </tr>
                </thead>
                <tbody id="content_kawasan" style="background-color: white;">
                  @foreach($template->budget_details as $key => $value )
                  <tr>         
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->itempekerjaan->code }}</td>
                    <td>{{ $value->itempekerjaan->name }}</td>
                    <td>{{ $value->volume }}</td>
                    <td>{{ $value->satuan }}</td>
                    <td>{{ number_format($value->nilai) }}</td>
                    <td>{{ number_format($value->nilai * $value->volume) }}</td>
                  </tr>
                  @endforeach
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
