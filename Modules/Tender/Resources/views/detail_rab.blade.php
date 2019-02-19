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
              
              <form action="{{ url('/')}}/tender/penawaran-save" method="post" name="form1" enctype="multipart/form-data">
              <a href="{{ url('/')}}/tender/detail/?id={{ $rekanan->tender->id }}" class="btn btn-warning">Kembali</a>
              <input type="file" name="fileupload"><br>
              <button type="submit" class="btn btn-primary">Simpan</button>
              {{ csrf_field() }}
              <input type="hidden" name="tender_rab_id" value="{{ $rekanan->id }}">
              <h3><center>Rekanan : <strong>{{ $rekanan->rekanan->group->name}}</strong></center></h3>
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
                  @php $start=0; @endphp
                  @foreach( $rekanan->tender->rab->pekerjaans as $key => $value )
                  <tr>
                    <td>{{ $value->itempekerjaan->code }}</td>
                    <td>{{ $value->itempekerjaan->name }}</td>
                    <td><input type="hidden" name="input_rab_id_[{{ $key}}]" class="form-control" value="{{ $value->id }}"><input  type="text" name="input_rab_volume_[{{ $key}}]" id="input_rab_volume_{{ $key}}" class="form-control" value="{{ $value->volume }}" style="width: 100%;" readonly></td>
                    <td>
                      <input  type="hidden" name="input_rab_satuan_[{{ $key}}]"  id="input_rab_satuan_{{ $key}}" class="form-control" value="{{ $value->satuan }}" style="width: 100%;" readonly>
                       <input  type="text" class="form-control" value="{{ $value->satuan }}" style="width: 100%;" readonly>
                    </td>
                    <td><input type="text" name="input_rab_nilai_[{{ $key}}]"  id="input_rab_nilai_{{ $key}}" class="form-control vol"  onKeyUp="showSummary('{{ $key}}')" autocomplete="off" value=""></td>
                    <td><input type="text"  id="subtotal_{{$key}}"  class="form-control" autocomplete="off" /></td>
                  </tr>
                  @php $start = $key; @endphp
                  @endforeach
                  <tr>
                    <td>&nbsp;</td>
                    <td>Lain - Lain</td>
                    <td><input type="hidden" name="input_rab_id_[{{ $start + 1 }}]" class="form-control" value=""><input  type="text" name="input_rab_volume_[{{ $start + 1 }}]" id="input_rab_volume_{{ $start + 1 }}" class="form-control" value="" style="width: 100%;"></td>
                    <td><input  type="text" name="input_rab_satuan_[{{ $start + 1 }}]"  id="input_rab_satuan_{{ $start + 1 }}" class="form-control" value="{{ $value->satuan }}" style="width: 100%;"></td>
                    <td><input type="text" name="input_rab_nilai_[{{ $start + 1 }}]"  id="input_rab_nilai_{{ $start + 1 }}" class="form-control vol" onKeyUp="showSummary('{{ $start + 1 }}')" autocomplete="off"></td>
                    <td><input type="text"  id="subtotal_{{$start + 1 }}"  class="form-control" autocomplete="off"/></td>
                  </tr>
                </tbody>
              </table>
             
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
