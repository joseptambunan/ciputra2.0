<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('/')}}/assets/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Pengajuan Biaya<strong> {{ $project->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
   
            <!-- /.box-header -->
            <div class="box-body">
              
              <div class="col-md-12 table-responsive">
                <div class="col-md-12"><h3 class="box-title">Tambah Pengajuan Biaya</h3></div>
                <div class="col-md-6">
                  <form action="{{ url('/')}}/pengajuanbiaya/store" method="post" name="form1" id="form1"> 
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label>No. Budget</label>
                    <select class="form-control select2" name="budget_tahunan" id="budget_tahunan">
                      <option>(pilih budget)</option>
                      @foreach ( $project->budget_tahunans as $key => $value )
                        <option value="{{ $value->id }}">{{ $value->no }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Keterangan(*)</label>
                    <input type="text" class="form-control" name="judul" id="judul" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label>Tanggal Dibutuhkan(*)</label>
                    <input type="text" class="form-control" name="butuh_date" id="butuh_date" autocomplete="off">
                  </div>
                  <div class="form-group" id="itempekerjaan_list">
                    <span id="loadings" style="display: none;">Loading...</span>
                    <label>Item Pekerjaan</label>
                    <select class="form-control select2" name="itempekerjaan_id" id="itempekerjaan_id">
                      
                    </select>
                  </div>

                  <div class="form-group">
                    <i class="fa fa-refresh ld ld-spin" id="loading" style="display: none;"></i>
                    <button class="btn btn-primary" type="button" id="btn_submit">Simpan</button>
                    <a href="{{ url('/')}}/pengajuanbiaya" class="btn btn-warning">Kembali</a>
                  </div>
                  </form> 
                  <span><i>(*) kolom harus diisi</i></span>
                </div>                       
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

@include("pengajuanbiaya::app")
<script type="text/javascript">
  $("#btn_submit").click(function(){
    if ( $("#butuh_date").val() == "" || $("#judul").val() == "" ){
      alert("Silahkan lengkapi judul dan tanggal kebutuhan Pengajuan Biaya");
      return false;
    }else{
      $("#form1").submit();
      $("#loading").show();
      $("#btn_submit").hide();
    }
  })
</script>
</body>
</html>
