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
      <h1>Data Rekanan</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
   
            <!-- /.box-header -->
            <div class="box-body">
              <form action="{{ url('/')}}/tender/aanwijing/update" method="post" name="form1" id="form1" enctype="multipart/form-data">
                <input type="hidden" name="aanwijing" value="{{ $aanwijing->id}}">
                <input type="hidden" name="tender_id"  value="{{$aanwijing->tender->id}}">
                {{ csrf_field() }}
                <h3 class="header">Aanwijing</h3>  
                <center><span style="font-size: 20px;"><strong>Berita Acara Penjelasan Tender</strong></span></center><br/> 
                <center><span style="font-size: 20px;"><strong>{{ $aanwijing->tender->name }}</strong></span></center><br/>
                <center><span style="font-size: 20px;"><strong>@if ( $aanwijing->tender->project != "" ) {{ $aanwijing->tender->project->name }} @endif</strong></span></center><br/>
                <div class="col-md-7">       	   
                  {{ csrf_field() }}  
                  <span>Hari    :  {{ date("d/M/Y", strtotime($aanwijing->created_at)) }}</span><br/>
                  <span>Tanggal :  {{ date("H:i", strtotime($aanwijing->created_at)) }}</span>
                  <div class="form-group">
                    <label>Tempat</label>
                    <input type="text" class="form-control" name="tempat" value="{{ $aanwijing->tempat }}" required>
                  </div>       	
                  <div class="form-group">
                    <label>Masa Pelaksanaan</label>
                    <input type="text" class="form-control" name="masa_pelaksaan" value="{{ $aanwijing->masa_pelaksanaan }}" autocomplete="off" required>
                  </div><!-- 
                  <div class="form-group">
                    <label>Masa Pemeliharaan</label>
                    <input type="text" class="form-control" name="masa_pemeliharaan" value="{{ $aanwijing->masa_penawaran}}" autocomplete="off" required>
                  </div> -->
                  <div class="form-group">
                    <label>Jaminan Penawaran</label>
                    <input type="text" class="form-control" name="jaminan_penawaran" autocomplete="off" value="{{ $aanwijing->jaminan_penawaran }}" required>
                  </div>
                  <div class="form-group">
                    <label>Jaminan Pelaksanaan</label>
                    <input type="text" class="form-control" name="jaminan_pelaksanaan" autocomplete="off" value="{{ $aanwijing->jaminan_pelaksanaan}}" required>
                  </div>
                  <div class="form-group">
                    <label>Denda Keterlambatan</label>
                    <input type="text" class="form-control" name="denda" autocomplete="off" value="{{ $aanwijing->denda }}" required>
                  </div>                  
                  <div class="form-group">
                    <label>Termin Pembayaran</label>
                    <input type="hidden" id="limit_count" value="0">
                    <input type="text" class="form-control nilai_budget" name="sistem_pembayaran" id="sistem_pembayaran" value="{{ $aanwijing->tender->termyn->count() }}" autocomplete="off" required> <br/>

                    Percent Bayar : <strong> <span id="label_count">100</span>%</strong>
                    <table class="table table-bordered">
                      <thead class="head_table">
                        <tr>
                          <td>No.</td>
                          <td>Termin</td>
                          <td>Persentase Bayar</td>
                        </tr>
                      </thead>
                      <tbody id="list_termyn">
                        @foreach ( $aanwijing->tender->termyn as $key => $value )
                        <tr>
                          <td>{{ $key + 1 }}</td>
                          <td>Termin ke {{ $key + 1 }}</td>
                          <td>{{ $value->termin }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="form-group">
                    <label>Retensi</label>
                    <input type="hidden" name="limit_retensi" id="limit_retensi" value="0">
                    <input type="text" class="form-control" name="retensi" id="retensi" value="{{ $aanwijing->tender->retensi->count() }}" autocomplete="off" required><br/>
                    Percent Retensi : <strong> <span id="label_retensi">{{ $aanwijing->tender->retensi->sum('percent') * 100}}</span>%</strong>
                    <table class="table table-bordered">
                      <thead class="head_table">
                        <tr>
                          <td>No.</td>
                          <td>Retensi(%)</td>
                          <td>Waktu ( hari kalender)</td>
                        </tr>
                      </thead>
                      <tbody id="list_retensi">
                        @foreach( $aanwijing->tender->retensi as $key => $value )
                        <tr>
                          <td>{{ $key + 1 }}</td>
                          <td>{{ number_format($value->percent * 100)}}</td>
                          <td>{{ $value->hari  }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="form-group">  

                    @if ( count($aanwijing->tender->penawarans ) <= 0 )                 
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    @endif
                    <a href="{{ url('/')}}/tender/detail?id={{$aanwijing->tender->id}}" class="btn btn-warning">Kembali</a><br/>
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
      showInputs: false
    })
  });
</script>
</body>
</html>
