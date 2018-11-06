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

  @include("master/sidebar_rekanan")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Rekanan</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
   
            <!-- /.box-header -->
            <div class="box-body">
              
              <div class="col-md-12 table-responsive">
                <table class="table table-bordered">
                  <thead class="head_table">
                    <tr>
                      <td>No. Tender</td>
                      <td>Pekerjaan</td>
                      <td>Penawaran 1</td>
                      <td>Penawaran 2</td>
                      <td>Penawaran 3</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{ $tender->no }}</td>
                      <td>{{ $tender->name }}</td>
                      <td>
                        @if ( count($tender_rekanan->penawarans) > 0 )
                          <a href="{{ url('/')}}/rekanan/user/tender/penawaran-update?id={{$tender_rekanan->id}}&step=1" class="btn btn-info">Lihat Penawaran</a>
                        @else
                           
                            <a href="{{ url('/')}}/rekanan/user/tender/penawaran-add?id={{$tender_rekanan->id}}&step=1" class="btn btn-warning">Tambah Penawaran</a>
                        @endif
                      </td>
                      <td>
                        @if ( (count($tender->penawarans)) == (count($tender->rekanans) * 2 ))
                          
                          <a href="{{ url('/')}}/rekanan/user/tender/penawaran-step2?id={{$tender_rekanan->penawarans->take(2)->last()->id}}&step=2" class="btn btn-warning">Tambah Penawaran</a>
                      
                        @endif
                      </td>
                      <td>
                        @if ( (count($tender->penawarans)) == (count($tender->rekanans) * 3 ))
                         
                          <a href="{{ url('/')}}/rekanan/user/tender/penawaran-step3?id={{$tender_rekanan->penawarans->last()->id}}&step=3" class="btn btn-warning">Tambah Penawaran</a>
                         
                 
                        @endif
                      </td>
                    </tr>
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
  <!-- /.content-wrapper -->
  @include("master/copyright")
  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("rekanan::user.app")
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
</body>
</html>
