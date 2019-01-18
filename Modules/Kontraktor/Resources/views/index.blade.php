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
      <h1>Data Rekanan Proyek <strong> {{ $project->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
   
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-6">
                <h3 class="header">Cek NPWP</h3>            	   
                  {{ csrf_field() }}                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">NPWP</label>
                    <input type="text" name="npwp" id="npwp" class="form-control" autocomplete="off" data-inputmask='"mask":"99.999.999.9-999.999"' data-mask>
                  </div>                  
                  <div class="box-footer">
                  <i class="fa fa-refresh ld ld-spin" id="loading" style="display: none;"></i>
                    <button type="button" onclick="cekNpwp();" class="btn btn-primary submitbtn" id="btn_submit">Cek</button>
                  </div>              	
              </div>

              <div class="col-md-12 table-responsive">
                <table class="table table-bordered">
                  <thead class="head_table">
                    <tr>
                      <td>Nama</td>
                      <td>NPWP</td>
                      <td>Alamat</td>
                      <td>Email</td>
                      <td>Telepon</td>
                      <td>Status</td>
                      <td>Detail</td>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ( $project->rekanans as $key => $value )   
                      @if ( $value->rekanans->count() > 0 )                 
                        <tr>
                          <td>{{ $value->name or ''}}</td>
                          <td>{{ $value->npwp_no or ''}}</td>
                          <td>{{ $value->npwp_alamat or ''}}</td>
                          <td>{{ $value->rekanans->first()->email or ''}}</td>
                          <td>{{ $value->rekanans->first()->telp or ''}}</td>
                          <td>
                            @if ( $value->rekanans->first()->gabung_date == "")
                              <span class="label label-warning">Dalam Pengecekan</span>
                            @else
                              <span class="label label-success">Diterima</span><br>
                              <span>Tanggal : <strong>{{ $value->rekanans->first()->gabung_date }}</strong></span>
                            @endif
                          </td>
                          <td><a class="btn btn-warning" href="{{ url('/')}}/kontraktor/detail/?id={{ $value->id }}">Detail</a></td>
                        </tr>
                      @endif
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

<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
@include("kontraktor::app")
</body>
</html>
