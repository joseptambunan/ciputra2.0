<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{ url('/')}}/assets/plugins/timepicker/bootstrap-timepicker.min.css">

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

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
              <form action="{{ url('/')}}/tender/aanwijing/save" method="post" name="form1" id="form1" enctype="multipart/form-data">
                <input type="hidden" name="tender_id"  value="{{$tender->id}}">
                {{ csrf_field() }}
                <h3 class="header">Aanwijing</h3>  
                <center><span style="font-size: 20px;"><strong>Berita Acara Penjelasan Tender</strong></span></center><br/> 
                <center><span style="font-size: 20px;"><strong>{{ $tender->name }}</strong></span></center><br/>
                <center><span style="font-size: 20px;"><strong>@if ( $tender->project != "" ) {{ $tender->project->name }} @endif</strong></span></center><br/>
                <div class="col-md-7">       	   
                  {{ csrf_field() }}                  
                  
                  <div class="form-group">
                    <label>Tempat</label>
                    <input type="text" class="form-control" name="tempat" required>
                  </div>       	
                  <div class="form-group">
                    <label>Masa Pelaksanaan (hari kalender)</label>
                    <input type="text" class="form-control" name="masa_pelaksaan" autocomplete="off" value="{{ $tender->durasi}}" required>
                  </div>
                  <!-- <div class="form-group">
                    <label>Masa Pemeliharaan</label>
                    <input type="text" class="form-control" name="masa_pemeliharaan" autocomplete="off" required>
                  </div> -->
                  <div class="form-group">
                    <label>Jaminan Penawaran(Rp)</label>
                    <input type="text" class="nilai_budget form-control" name="jaminan_penawaran" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label>Jaminan Pelaksanaan(Rp)</label>
                    <input type="text" class="nilai_budget form-control" name="jaminan_pelaksanaan" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label>Denda Keterlambatan(%)</label>
                    <input type="text" class="form-control" name="denda" autocomplete="off" required>
                  </div>                  
                  <div class="form-group">
                    <label>Termin Pembayaran</label>
                    <input type="hidden" id="limit_count" value="0">
                    <input type="text" class="form-control nilai_budget" name="sistem_pembayaran" id="sistem_pembayaran" autocomplete="off" required> <br/>
                    <button class="btn btn-info" type="button" onClick="generateTermyn()">Buat Termin</button>

                    Percent Bayar : <strong> <span id="label_count"></span>%</strong>
                    <table class="table table-bordered">
                      <thead class="head_table">
                        <tr>
                          <td>No.</td>
                          <td>Termin</td>
                          <td>Persentase Bayar</td>
                        </tr>
                      </thead>
                      <tbody id="list_termyn">
                        
                      </tbody>
                    </table>
                  </div>
                  <div class="form-group">
                    <label>Retensi</label>
                    <input type="hidden" name="limit_retensi" id="limit_retensi" value="0">
                    <input type="text" class="form-control" name="retensi" id="retensi" autocomplete="off" required><br/>
                    <button class="btn btn-info" type="button" onClick="generateRetensi();">Buat Retensi</button>
                    Percent Retensi : <strong> <span id="label_retensi"></span>%</strong>
                    <table class="table table-bordered">
                      <thead class="head_table">
                        <tr>
                          <td>No.</td>
                          <td>Retensi</td>
                          <td>Waktu</td>
                        </tr>
                      </thead>
                      <tbody id="list_retensi">
                        
                      </tbody>
                    </table>
                  </div>
                  <div class="form-group">                    
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <a href="{{ url('/')}}/tender/detail?id={{$tender->id}}" class="btn btn-warning">Kembali</a><br/>
                  </div>
                </div>
              </form>   
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
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="{{ url('/')}}/assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
@include("tender::app")
<script type="text/javascript">
  $(function () {
    $(".select2").select2();
    $('.timepicker').timepicker({
      format: 'HH:mm'
    })
  });
</script>
</body>
</html>
