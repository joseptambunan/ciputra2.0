<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard </title>


  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
      <h1>Data Proyek <strong>{{ $project->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">   

              <h3 class="box-title">Tambah Data Voucher</h3>           
              <form action="{{ url('/')}}/voucher/save" method="post" name="form1">
                <input type="hidden" name="voucher_type" id="voucher_type" value="general">
                {{ csrf_field() }}
                <div class="form-group">
                  <label>Sumber Dokumen</label>
                  <select class="form-control" name="tender_rab" id="tender_rab">
                    <option value="Pengajuanbiaya">Pengajuan Biaya</option>
                    <option value="Bap">SPK - BAP</option>
                    <option value="PR">Purchasing - GR</option>
                  </select>
                </div>
                <div class="form-group bap" style="display: none;">
                  <label>BAP</label>
                  <select class="form-control " name="bap" id="bap">
                    <option>( pilih bap )</option>
                    @foreach($project->spks as $key => $value )
                      @if ( $value->tender != "" )
                        @foreach ( $value->baps as $key2 => $value2 )
                          @if ( $value2->status_voucher != "1" )
                          <option value="{{ $value2->id }}">{{ $value2->no}}</option>
                          @endif
                        @endforeach
                      @endif
                    @endforeach
                </select>
                </div> 
                <div class="form-group" style="display: none;" id="jenis_voucher">
                  <label>Jenis Voucher ( Retensi )</label>
                  <div  id="ppn">
                    <input type="radio" name="retensi" value="ppn" onClick="getgeneral('retensi');">PPn Retensi
                  </div>
                  <div id="retensi_checklist">
                    <input type="radio" name="retensi" value="dpp" onClick="getgeneral('retensi');" checked> DPP Retensi
                  </div>
                  <span id="label_retensi"></span>
                  <input type="radio" name="retensi" value="prog" onClick="getgeneral('general');">BAP Progress
                </div> 
                <div class="form-group">
                  <label>No. Faktur Pajak</label>
                  <input type="text" name="no_faktur" value="" class="form-control">
                </div>    
                <div class="form-group">
                  <label>Tgl Faktur Pajak</label>
                  <input type="text" name="tgl_faktur" id="tgl_faktur" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                  <label>PPh</label>
                  <select class="form-control" name="pph">
                    @for( $i = 0 ; $i < count($arraypph); $i++ )
                      <option value="{{ $arraypph[$i]['value']}}">{{ $arraypph[$i]['label']}}</option>
                    @endfor
                  </select>
                </div>
                <div class="form-group">
                  <label>SPM</label>
                  <input type="checkbox" name="spm" value="" id="spm" onClick="showsimpan()">Sudah
                </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary"  id="btn_simpan">Simpan</button>
              </div>
              
              <!-- /.form-group -->
            </div>

            </form>
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
@include("voucher::app")
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script type="text/javascript">
 

</script>
</body>
</html>
