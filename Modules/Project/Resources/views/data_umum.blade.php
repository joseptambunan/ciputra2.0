<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard </title>
  @include("master/header")
    <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('/')}}/assets/bower_components/select2/dist/css/select2.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Proyek</h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">              
              <h3 class="box-title">Edit Data Proyek</h3>
              <form action="{{ url('/')}}/project/updatedata-umum" method="post" name="form1">
              <input type="hidden" name="project_id" value="{{ $project->id }}">
              {{ csrf_field() }}
              <div class="form-group">
                <label>Sub Holding</label>
                <select class="form-control" name="subholding" disabled>
                  <option value="2">2</option>
                </select>
              </div>
              <div class="form-group">
                <label>Kode Proyek</label>
                <input type="text" class="form-control" name="code" value="{{ $project->code }}" disabled>
              </div>
              <div class="form-group">
                <label>Nama Proyek</label>
                <input type="text" class="form-control" name="name" value="{{ $project->name }}" disabled>
              </div>
              <div class="form-group">
                <label>Luas Brutto yang belum ada site plan (m2) </label>
                <input type="text" class="form-control" name="luas_nonpengembangan" id="luas_nonpengembangan" value="{{ number_format($project->luas_nonpengembangan,2) }}">
              </div>
              <div class="form-group">
                <label>Luas Brutto yang ada site plan(m2)</label>
                <input type="text" class="form-control" name="luas" id="luas" value="{{ number_format($project->luas,2) }}">
              </div>
              <div class="form-group">
                <label>Telepon Proyek</label>
                <input type="text" class="form-control" name="phone" value="{{ $project->phone }}">
              </div>
              <div class="form-group">
                <label>Fax Proyek</label>
                <input type="text" class="form-control" name="fax" value="{{ $project->fax }}">
              </div>
              <div class="form-group">
                <label>Email Proyek</label>
                <input type="text" class="form-control" name="email" value="{{ $project->email }}">
              </div>
              <div class="form-group">
                <label>Alamat Proyek</label>
                <textarea class="form-control" name="address" rows="3">{{ $project->address }}</textarea>
              </div>  
              <div class="form-group">
                <label>Kode Pos Proyek</label>
                <input type="text" class="form-control" name="zipcode" value="{{ $project->zipcode }}">
              </div> 
              <div class="form-group">
                <label>Kota</label>
                <select class="form-control select2" name="city_id" required>
                  @foreach( $cities as $data => $value )
                  @if ( $value->id == $project->city_id )
                  <option value="{{ $value->id}}" selected>{{ $value->name}}</option>
                  @else
                  <option value="{{ $value->id}}">{{ $value->name}}</option>
                  @endif
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" name="description" rows="3">{{ $project->description }}</textarea>
              </div>        
              <div class="box-footer" >
                <i class="fa fa-refresh ld ld-spin" id="loading" style="display: none;"></i>
                <button type="submit" id="btn_submit" class="submitbtn btn btn-primary">Simpan</button>
                <a href="{{ url('/')}}/project/" class="submitbtn btn btn-warning">Kembali</a>
              </div>
              </form>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-12">
              <strong>Total Seluruh Tanah Proyek : {{ number_format($project->luas + $project->luas_nonpengembangan) }} m2</strong>
              <table class="table table-bordered table-hover table-responsive">
                <thead class="head_table">
                  <tr>
                    <td>Luas Belum Dikembangkan(m2)</td>
                    <td>Luas Dikembangkan(m2)</td>
                    <td>Tanggal</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $project->history_luas as $key => $value )
                  <tr>
                    <td>{{ number_format($value->luas_non_pengembangan,2) }}</td>
                    <td>{{ number_format($value->luas_dikembangkan,2) }}</td>
                    <td>{{ $value->created_at->format('d/M/Y')}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>  
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->


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
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<!-- Select2 -->
<script type="text/javascript">
  $(function () {
    $("#luas").number(true);
    $('.select2').select2();
    $("#luas_nonpengembangan").number(true);
  });

  $("#btn_submit").click(function(){
    $(".submitbtn").hide();
    $("#loading").show();
  })
</script>
@include("pt::app")
</body>
</html>
