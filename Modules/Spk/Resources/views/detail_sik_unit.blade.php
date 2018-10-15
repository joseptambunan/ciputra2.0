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
  <input type="hidden" name="total_pekerjaan" id="total_pekerjaan" value="{{ $spkDetail->details->count() }}">
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


            <div class="box-body pad">
              <h3><center>Unit <strong>{{ $spkDetail->asset->name }}</strong></center></h3>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default" onclick="setvo()">Set VO</button>
              <a href="{{ url('/')}}/spk/sik-show?id={{ $suratinstruksi->id}}" class="btn btn-warning">Kembali</a>
              <table class="table table-bordered">
                <thead class="head_table">
                  <tr>
                    <td>Set VO</td>
                    <td>Pekerjaan</td>
                    <td>Volume</td>
                    <td>Satuan</td>
                    <td>Nilai</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $spkDetail->details as $key => $value )
                  <tr>
                    <td><input type="checkbox" name="id_check_[{{ $value->id }}]" id="id_check_{{ $key }}" data-value="{{ $value->unit_progress->satuan or '' }}" data-progress="{{ $value->unit_progress->id or '' }}" data-itempekerjaan="{{ $value->unit_progress->itempekerjaan_id or '' }}" data-label="{{ $value->unit_progress->itempekerjaan->name or '' }}"></td>
                    <td>{{ $value->unit_progress->itempekerjaan->name or '' }}</td>
                    <td>{{ number_format($value->unit_progress->volume) }}</td>
                    <td>{{ $value->unit_progress->satuan or '' }}</td>
                    <td>{{ number_format($value->unit_progress->nilai) }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

              <h4><center>Variation Order</center></h4>
              <table class="table table-bordered">
                <thead class="head_table">
                  <tr>
                    <td>Pekerjaan</td>
                    <td>Volume</td>
                    <td>Satuan</td>
                    <td>Nilai</td>
                  </tr>
                </thead>
                <tbody>
                  @if ( count($spkDetail->details_vo) > 0 )
                  @foreach ( $spkDetail->details_vo as $key => $value )
                  <tr>
                    <td>{{ $value->unit_progress->itempekerjaan->name }}</td>
                    <td>{{ number_format($value->unit_progress->volume) }}</td>
                    <td>{{ $value->unit_progress->satuan }}</td>
                    <td>{{ number_format($value->unit_progress->nilai) }}</td>
                  </tr>
                  @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>

  <div class="modal fade" id="modal-default">
    <form action="{{ url('/')}}/spk/save-vo" method="post">
    <input type="hidden" name="suratinstruksi" id="suratinstruksi" value="{{ $suratinstruksi->id}}" >
    <input type="hidden" name="spk_detail" id="spk_detail" value="{{ $spkDetail->id}}" >
    {{ csrf_field() }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Item Pekerjaan</h4>
        </div>
        <div class="modal-body">
            <table class="table table-bordered">
              <thead class="head_table">
                <tr>
                  <td>Item Pekerjaan</td>
                  <td>Volume</td>
                  <td>Satuan</td>
                  <td>Nilai</td>
                </tr>
              </thead>
              <tbody id="body_vo">
                
              </tbody>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="btn_vo_submit" disabled>Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    </form>
    <!-- /.modal-dialog -->
  </div>
        <!-- /.modal -->

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
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  });

  function setvo(){
    html = "";
    for ( var i=0; i < $("#total_pekerjaan").val(); i++ ){
      if ( $("#id_check_" + i).is(":checked")){        
        html += "<tr>";
        html += "<td>" + $("#id_check_" + i).attr("data-label") + "</td>";
        html += "<td>";
        html += "<input type='hidden' name='unit_progress_id[" + i + "]' id='' class='form-control' value='" + $("#id_check_" + i).attr("data-progress") + "'/>" ;
        html += "<input type='hidden' name='itempekerjaan[" + i + "]' id='' class='form-control' value='" + $("#id_check_" + i).attr("data-itempekerjaan") + "'/>" ;
        html += " <input type='text' name='volume_[" + i + "]' id='' class='form-control nilai_budget' autocomplete='off'/>";
        html += "</td>";
        html += "<td>" + "<input type='hidden' name='satuan_[" + i + "]' id='' class='form-control'/>" + $("#id_check_" + i).attr("data-value") +"</td>";
        html += "<td>" + "<input type='text' name='nilai_[" + i + "]' id='' class='form-control nilai_budget' autocomplete='off'/>" + "</td>";
        html += "</tr>";
      }
    }
    $("#body_vo").html(html);
    $(".nilai_budget").number(true);

    if ( $("#body_vo").html() == "" ){
      $("#btn_vo_submit").attr("disabled","disabled");
    }else{
      $("#btn_vo_submit").removeAttr("disabled");
    }
  }
</script>
</body>
</html>
