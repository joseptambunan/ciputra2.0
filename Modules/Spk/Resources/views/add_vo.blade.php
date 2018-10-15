<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | SIK</title>
   @include("master/header")

  <link rel="stylesheet" href="{{ url('/')}}/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <section class="content-header">
      <h1>Data Surat Instruksi</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                <small></small>
              </h3>
            </div>
            <!-- /.box-header -->


            <div class="box-body pad">
              <h4><center>Daftar Variation Order</center></h4>
              <form action="{{ url('/')}}/spk/save-vo" method="post" name="form1">
                {{ csrf_field() }}
              <input type="hidden" name="sik_id" value="{{ $suratinstruksi->id }}">
              <table class="table table-bordered">
                  <thead class="head_table">
                    <tr>
                      <td>Unit</td>
                      <td>Volume</td>
                      <td>Satuan</td>
                      <td>Nilai(Rp)</td>
                      <td>Subtotal</td>
                    </tr>
                  </thead>
                  <tbody id="vo_list">
                    @php $nilai = 0; @endphp
                    @foreach ( $suratinstruksi->units as $key => $value )
                      <input type="hidden" name="spk_detail_id[{{$key}}]" value="{{ $value->spk_detail->id}}">
                      <tr>
                        <td colspan="5"><strong>{{ $value->spk_detail->asset->name }}</strong></td>
                      </tr>
                      @foreach ( $value->items as $key2 => $value2 )
                      <input type="hidden" name="itempekerjaan_id[{{$key2}}]" value="{{ $value2->pekerjaan->id }}">
                      <tr>
                        <td>{{ $value2->pekerjaan->name }}</td>
                        <td><input type="text" class="form-control nilai_budget" name="volume_[{{ $key2 }}]" autocomplete="off"></td>
                        <td><input type="text" class="form-control" name="satuan[{{ $key2 }}]" value="{{ $value2->pekerjaan->rab_pekerjaans->last()->satuan }}" autocomplete="off"></td>
                        <td><input type="text" class="form-control nilai_budget" name="nilai_[{{ $key2 }}]" autocomplete="off"></td>
                        <td><input type="text" class="form-control" name="subtital_[{{ $key2 }}]" autocomplete="off"></td>
                      </tr>
                      @endforeach
                    @endforeach
                  </tbody>
                </table>
                <button type="submit" class="btn btn-primary" id="btn_save_vo">Simpan</button>
              </form>
              <center><h4>Daftar Variation Order {{ $suratinstruksi->id}}</h4></center>


              @foreach ( $suratinstruksi->vos as $key => $value )
                @if ( count($value->progresses) > 0 )
                  <table class="table table-bordered">
                    <thead class="head_table">
                      <tr>
                        <td>Unit</td>
                        <td>Volume</td>
                        <td>Satuan</td>
                        <td>Nilai (Rp)</td>
                        <td>Subtotal</td>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ( $value->unit->items as $key2 => $value2 )
                      <tr>
                        <td>{{ $value->unit->spk_detail->asset->name or '' }}</td>
                        <td>{{ $value2->pekerjaan->name or '' }}</td>
                        <td>{{ $value->progresses->volume or '' }}</td>
                      </tr>
                      @endforeach 
                    </tbody>
                  </table>
                @endif
              @endforeach

            </div>

          </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
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
<script type="text/javascript">
  function getdetail(){
    var request = $.ajax({
      url  : "{{ url('/')}}/spk/detailunit-vo",
      data : {
        id : $("#asset_id").val()
      },
      dataType : "json",
      type : "post"
    });

    request.done(function(data){
      if ( data.status == "0" ){
        $("#vo_list").append(data.html);
        $("#btn_save_vo").show();
      }else{
        alert("Data Pekerjaan tidak ada");
      }
    })
  }
</script>
</body>
</html>
