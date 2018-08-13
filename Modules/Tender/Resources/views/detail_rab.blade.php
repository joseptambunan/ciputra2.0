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
              <a href="{{ url('/')}}/tender/detail/?id={{ $rekanan->tender->id }}" class="btn btn-warning">Kembali</a>
              <form action="{{ url('/')}}/tender/penawaran-save" method="post" name="form1">
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
               @if ( $itempekerjaan != "" )
               <tbody>                          
                <tr>
                  <td><strong>{{ $itempekerjaan->code }}</strong></td>
                  <td><strong>{{ $itempekerjaan->name }}</strong></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                @php $start = 0; @endphp
                @foreach ( $itempekerjaan->child_item as $key3 => $value3 )
                <tr>
                  <td><strong>{{ $value3->code }}</strong></td>
                  <td>{{ $value3->name }}</td>
                  @if ( count(Modules\Rab\Entities\RabPekerjaan::where('itempekerjaan_id',$value3->id)->get()) > 0 )
                  <td>
                    <input type="text" name="input_rab_id_[{{ $start}}]" class="form-control" value="">
                    <input type="hidden" name="input_rab_volume_[{{ $start}}]" id="input_rab_volume_{{$start}}" class="form-control" value="{{ Modules\Rab\Entities\RabPekerjaan::where('itempekerjaan_id',$value4->id)->get()->first()->volume }}">
                    <input type="text" class="form-control" value="{{ Modules\Rab\Entities\RabPekerjaan::where('itempekerjaan_id',$value4->id)->get()->first()->volume }}" readonly>
                  </td>
                  <td><input  type="text" name="input_rab_satuan_[{{ $start}}]" class="form-control" value="{{ Modules\Rab\Entities\RabPekerjaan::where('itempekerjaan_id',$value4->id)->get()->first()->satuan }}"></td>
                  <td><input type="text" name="input_rab_nilai_[{{ $start}}]" id="input_rab_nilai_{{ $start}}" class="form-control"></td>
                  @else
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  @php $start++; @endphp
                  @endif
                </tr>
                
                @if ( count($value3->child_item) > 0 )
                  @foreach ( $value3->child_item as $key4 => $value4 )
                  <tr class="class_{{ $value3->id}}">
                    <td><strong>{{ $value4->code }}</strong></td>
                    <td>{{ $value4->name }}</td>
                    <td>
                        <input type="hidden" name="input_rab_id_[{{ $start}}]" class="form-control" value="{{ Modules\Rab\Entities\RabPekerjaan::where('itempekerjaan_id',$value4->id)->get()->first()->id }}">
                         <input type="hidden" name="input_rab_volume_[{{ $start }}]" id="input_rab_volume_{{$start}}" class="form-control vol" value="{{ Modules\Rab\Entities\RabPekerjaan::where('itempekerjaan_id',$value4->id)->get()->first()->volume }}" >
                        <input type="text" class="form-control" value="{{ Modules\Rab\Entities\RabPekerjaan::where('itempekerjaan_id',$value4->id)->get()->first()->volume }}" readonly>
                    </td>
                    <td><input  type="text" name="input_rab_satuan_[{{ $start }}]" class="form-control" value="{{ Modules\Rab\Entities\RabPekerjaan::where('itempekerjaan_id',$value4->id)->get()->first()->satuan }}" style="width: 100%;" readonly></td>
                    <td><input type="text" name="input_rab_nilai_[{{ $start }}]" id="input_rab_nilai_{{ $start}}" class="form-control vol" onKeyUp="showSummary('{{ $start}}')"></td>
                    <td><input type="text"  id="subtotal_{{$start}}"  class="form-control" /></span></td>
                  </tr>
                    @php $start++; @endphp
                    @if ( count($value4->child_item) > 0 )
                      @foreach ( $value4->child_item as $key5 => $value5 )                           
                      <tr class="class_{{ $value3->id}}">
                        <td><strong>{{ $value5->code }}</strong></td>
                        <td>                                    
                            {{ $value5->name }}                             
                        </td>
                        <td>
                            <input type="hidden" name="input_rab_id_[{{ $start}}]" class="form-control" value="{{ Modules\Rab\Entities\RabPekerjaan::where('itempekerjaan_id',$value5->id)->get()->first()->id }}">
                            <input type="text" name="input_rab_volume_[{{ $start}}]" class="form-control vol" value="{{ Modules\Rab\Entities\RabPekerjaan::where('itempekerjaan_id',$value4->id)->get()->first()->volume }}" readonly>
                        </td>
                        <td><input  type="text" name="input_rab_satuan_[{{ $start}}]" class="form-control" value="{{ Modules\Rab\Entities\RabPekerjaan::where('itempekerjaan_id',$value4->id)->get()->first()->satuan }}" style="width: 100%;" readonly></td>
                        <td><input type="text" name="input_rab_nilai_[{{ $start}}]" class="form-control vol" onKeyUp="showSummary('{{ $start}}')"></td>
                        <td><input type="text"  id="subtotal_{{$start}}"  class="form-control" /></td>
                      </tr>
                      @php $start++; @endphp
                      @endforeach
                    @endif
                  @endforeach
                @endif
                @endforeach
              </tbody>
              @endif
            </table>
            <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
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
  })
  function showSummary(id){
    var summary = parseInt($("#input_rab_volume_" + id).val()) * parseInt($("#input_rab_nilai_" + id).val());
    if ( summary == "NaN"){
      $("#subtotal_" + id).text("0");
    }else{
      $("#subtotal_" + id).text(summary);
      $("#subtotal_" + id).number(true);
    }
  }
</script>
</body>
</html>
