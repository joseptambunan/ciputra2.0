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
      <h1>Data Tender Penawaran</h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">

              <a href="{{ url('/')}}/tender/detail/?id={{ $tenderpenawaran->rekanan->tender->id }}" class="btn btn-warning">Kembali</a>
              <form action="{{ url('/')}}/tender/penawaran-saveedit" method="post" name="form1">
              <input type="hidden" name="tender_id" value="{{ $tenderpenawaran->rekanan->tender->id }}">
              {{ csrf_field() }}
              <h3><center>Rekanan : <strong>{{ $tenderpenawaran->rekanan->rekanan->group->name }}</strong></center></h3>
              <hr>
              <table class="table table-bordered">
               <thead class="head_table">
                 <tr>
                  <td>COA Pekerjaan</td>
                  <td>Item Pekerjaan</td>
                  <td>Volume</td>
                  <td style="width:4%;">Satuan</td>
                  <td>Harga Satuan</td>
                  <td>Subtotal</td>
                 </tr>
                </thead>
                <tbody>
                  @foreach ( $tenderpenawaran->details as $key => $value )
                  <tr>
                    <td>{{ $value->rab_pekerjaan->itempekerjaan->code }}</td>
                    <td>{{ $value->rab_pekerjaan->itempekerjaan->name }}</td>
                    <td><input type="hidden" name="id_[{{$key}}]" value="{{ $value->id }}" class="form-control" /><input type="text" name="volume_[{{$key}}]" value="{{ $value->volume }}" class="form-control" /></td>
                    <td>{{ $value->rab_pekerjaan->satuan }}</td>
                    <td><input type="text" name="nilai_[{{$key}}]" value="{{ number_format($value->nilai) }}" class="form-control" autocomplete="off" /></td>
                    <td>{{ number_format($value->nilai * $value->volume) }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

              <h3 style="color:red;"><strong>Harap upload dengan tipe .pdf,.doc,.docx,.xls,.xlsx</strong></h3>
              <input type="file" name="fileupload"><br>
              <button type="submit" class="btn btn-primary">Simpan</button>
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
