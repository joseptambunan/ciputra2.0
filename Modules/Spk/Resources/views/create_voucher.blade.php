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
      <h1>Data SPK</h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">   

              <h3 class="box-title">Detail Data SPK</h3>           
              <form action="{{ url('/')}}/spk/voucher-save" method="post" name="form1">
              <input type="hidden" name="bap_id" value="{{ $bap->id }}">
              {{ csrf_field() }}
              <div class="form-group">
                <label>No BAP</label>
                <input type="text" value="{{ $bap->no }}" class="form-control" readonly>
              </div>
              <div class="form-group">
                <label>Nilai BAP</label>
                <input type="text" value="{{ number_format($bap->nilai) }}" class="form-control" readonly>
              </div>    
              <div class="form-group">
                <label>Rekanan</label>
                <input type="text" value="{{ $bap->spk->rekanan->group->name }}" class="form-control" readonly>
              </div> 
              <div class="form-group">
                <label>Jatuh Tempo</label>
                <input type="text" value="{{ $bap->spk->rekanan->group->name }}" class="form-control" readonly>
              </div>  
               <div class="form-group">
                <label>Rekening</label>
                <select class="form-control" name="rekening">
                  @foreach ( $bap->spk->rekanan->rekenings as $key => $value )
                  <option value="{{ $value->id}}"> {{ $value->bank->name }} - {{ $value->no }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Nilai DPP</label>
                <input type="text" value="{{ number_format($bap->nilai,2) }}" class="form-control" readonly>
              </div>     
              <div class="form-group">
                <label>Nilai PPN</label>
                <input type="text" value="{{ $bap->nilai_ppn,2 }}" class="form-control" readonly>
              </div>
              <div class="form-group">
                <label>Nilai PPh</label>
                <input type="text" value="{{ $bap->nilai_pph,2 }}" class="form-control" readonly>
              </div>
              <div class="form-group">
                <label>Nilai Sertifikat</label>
                <input type="text" value="{{ number_format($bap->nilai,2) }}" class="form-control" readonly>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col --> 
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
@include("spk::app")

</body>
</html>
