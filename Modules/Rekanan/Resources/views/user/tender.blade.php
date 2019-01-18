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
                      <td>Proyek</td>
                      <td>Lokasi</td>
                      <td>Detail</td>
                      <td>No.Kwitansi</td>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach ( $rekanan_group->rekanans as $key => $value )
                    @foreach ( $value->tender_rekanans as $key2 => $value2 )
                    @if ( $value2->tender != "" )
                      <tr>
                        <td>{{ $value2->tender->no or '' }}</td>
                        <td>{{ $value2->tender->name or ''}}</td>
                        <td>{{ $value2->tender->rab->budget_tahunan->budget->project->name or '' }}</td>
                        <td>{{ $value2->tender->rab->budget_tahunan->budget->project->city->name or '' }}</td>
                        <td>
                          @if ( $value2->doc_bayar_status == "1")
                          <a class="btn btn-info" href="{{ url('/')}}/rekanan/user/tender/detail?id={{ $value2->id }}">Detail</a>
                          @else
                          <strong>Harap anda membayar biaya dokumen terlebih dahulu</strong>
                          @endif
                        </td>
                        <td>
                          
                        </td>
                      </tr>
                    @endif
                    @endforeach
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
