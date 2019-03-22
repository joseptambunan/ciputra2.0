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

  @include("master/sidebar_rekanan")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Item Pekerjaan <strong>{{ $itempekerjaan->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">

              <form action="{{ url('/')}}/rekanan/user/tender/penawaran-update1" method="post" name="form1" enctype="multipart/form-data">
              <input type="hidden" name="penawaran_id" value="{{ $tender_rekanan->penawarans->take($step)->last()->id }}">
              <a href="{{ url('/')}}/rekanan/user/tender/detail/?id={{ $tender_rekanan->id }}" class="btn btn-warning">Kembali</a>
              <button type="submit" class="btn btn-primary">Simpan</button>
              {{ csrf_field() }}
              <input type="hidden" name="tender_id" value="{{ $tender_rekanan->tender->id }}"><br>
              <input type="hidden" name="tender_rekanan" value="{{ $tender_rekanan->id }}">
              <input type="hidden" name="step" value="1">
              <h3><center>Rekanan : <strong>{{ $tender_rekanan->rekanan->name }}</strong></center></h3>
              <span>Nilai : Rp. <strong>{{ number_format($tender_rekanan->penawarans->take($step)->last()->nilai) }}</strong></span>
              <hr>
              <table class="table table-bordered">
               <thead class="head_table">
                 <tr>
                  <td>COA Pekerjaan</td>
                  <td>Item Pekerjaan</td>
                  <td>Volume</td>
                  <td style="width:4%;">Satuan</td>
                  <td>Harga Satuan(Rp)</td>
                  <td>Subtotal(Rp)</td>
                 </tr>
                </thead>
                <tbody>
                  @php $start=0; @endphp
                  @foreach( $tender_rekanan->penawarans->take($step)->last()->details as $key => $value ) 
                    @if ( $value->rab_pekerjaan->volume > 0 )                  
                    <tr>
                      <td>{{ $value->rab_pekerjaan->itempekerjaan->code or '' }}</td>
                      <td>{{ $value->rab_pekerjaan->itempekerjaan->name or '' }}</td>
                      <td>{{ $value->rab_pekerjaan->volume or '' }}</td>                      
                      <td>{{ $value->rab_pekerjaan->satuan or '' }}</td>
                      <td>
                        @if ( count($tender_rekanan->penawarans) > $step )
                        {{ number_format($value->nilai) or '' }}
                        @else
                        <input type="hidden" name="input_rab_id_[{{ $key}}]"  id="input_rab_id_{{ $key}}" class="form-control vol" onKeyUp="showSummary('{{ $key}}')" value="{{ $value->id }}" style="text-align: right;" autocomplete="off">
                        <input type="text" name="input_rab_nilai_[{{ $key}}]"  id="input_rab_nilai_{{ $key}}" class="form-control vol" onKeyUp="showSummary('{{ $key}}')" value="{{ $value->nilai }}" style="text-align: right;" autocomplete="off">
                        @endif
                      </td>
                      <td>{{ number_format($value->nilai * $value->volume) }}</td>
                    </tr>  
                    @endif                 
                  @endforeach
                </tbody>
              </table>

              
              <h6 style="color:black;"><i><strong>Harap upload dengan tipe .pdf,.doc,.docx,.xls,.xlsx</strong></i></h6>
              <input type="file" name="fileupload"><br>
              </form>
            </div>
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
 @include("master/copyright")

  



</div>
<!-- ./wrapper -->

@include("master/footer_table")
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/jquery.number.min.js"></script>
<script type="text/javascript">
  $(".vol").number(true);
</script>
@include("tender::app")
<script type="text/javascript">
  $(function(){
    $(".vol").number(true);
  });

  function showSummary(id){
    var vla = $("#input_rab_nilai_" + id).val();
    console.log($("#input_rab_nilai_" + id).val(),vla);
    var rep = vla.replace(",","");
    var summary = parseInt($("#input_rab_volume_" + id).val()) * parseInt(rep);
    if ( summary == "NaN"){
      $("#subtotal_" + id).val("0");
    }else{
      $("#subtotal_" + id).val(summary);
      $("#subtotal_" + id).number(true);
    }
  }
</script>
</body>
</html>
