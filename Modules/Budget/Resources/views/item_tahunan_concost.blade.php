<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard </title>
  @include("master/header")
  <!-- Select2 -->  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="{{ url('/')}}/assets/bower_components/select2/dist/css/select2.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Proyek <strong>{{ $budget_tahunan->budget->project->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12"><h3 class="box-title">Detail Data Budget Tahunan Proyek</h3></div>
            
            <!-- /.col -->
            <div class="col-md-12 table-responsive">
              <form action="{{ url('/')}}/budget/item-saveitemconcost" method="post" name="form1" id="form1">  
                <button class="btn btn-primary" id="btn_submit" type="submit">Simpan</button>
                <a class="btn btn-warning" href="{{ url('/')}}/budget/cashflow/detail-cashflow?id={{ $budget_tahunan->id}}">Kembali</a><br><br>
                {{ csrf_field() }}
                <input type="hidden" name="budget_tahunan_id" id="budget_tahunan_id" value="{{ $budget_tahunan->id }}">
                <table class="table">
                  <thead class="head_table">
                    <tr>
                      <td>COA</td>
                      <td>Item Pekerjaan</td>
                      <td>Volume</td>
                      <td>Satuan</td>
                      <td>Harga Satuan(Rp)</td>
                      <td>Subtotal</td>
                    </tr>
                  </thead>
                  <tbody id="itemlist">
                    @php $start = 0; $volume_master = ""; @endphp
                    @foreach ( $budget_tahunan->details as $key => $value )
                      @if ( $value->itempekerjaans->group_cost == 2 && $value->itempekerjaans->code == "100.00")
                        <tr>
                          <td>{{ $value->itempekerjaans->code or ''}}</td>
                          <td>{{ $value->itempekerjaans->name or ''}}</td>                          
                          <td>
                            <input type="hidden" class="nilai_budget form-control" name="item_id_[{{$start}}]" id="item_id_{{$start}}" value="{{ $value->id}}" required>
                             <input type="hidden" class="nilai_budget form-control" name="volume_[{{$start}}]" id="volume_master_{{$start}}" value="{{ $volume_master}}" required>
                            <input type="text" class="nilai_budget form-control" name="volume_[{{$start}}]" id="volume_{{$start}}" value="{{ $value->volume}}" onKeyUp="cekmaster('{{ $start}}')" required>
                          </td>
                          <td>{{ $value->itempekerjaans->details->satuan }}</td>
                          <td>
                            <input type="hidden" class="form-control" name="nilai_[{{$start}}]" id="nilai_{{$start}}" value="{{ $value->nilai}}">
                            {{ number_format($value->nilai )}}
                          </td>
                          <td><span id="subtotal_{{$start}}">{{ number_format($value->nilai * $value->volume )}}</span></td>
                        </tr>
                        @php $start++; @endphp
                      @endif
                    @endforeach
                  </tbody>
                </table>

                <center><h2>Rencana Pembangunan Unit</h2></center>
                <table class="table table-bordered ">
                  <thead class="head_table">
                    <tr>
                      <td>Unit Type</td>
                      <td>LB/LT</td>
                      <td>Harga Satuan</td>
                      <td>Jumlah Unit</td>
                      <td>Total Luas Unit(m2)</td>
                      <td>Januari</td>
                      <td>Februari</td>
                      <td>Maret</td>
                      <td>April</td>
                      <td>Mei</td>
                      <td>Juni</td>
                      <td>Juli</td>
                      <td>Agustus</td>
                      <td>September</td>
                      <td>Oktober</td>
                      <td>November</td>
                      <td>Desember</td>
                    </tr>
                  </thead>
                  <tbody>
                    @if ( $budget_tahunan->budget->kawasan)
                      @if ( $budget_tahunan->budget_unit->count() <= 0 )
                        @foreach ( $budget_tahunan->budget->kawasan->unit_type as $key => $value )
                          @if ( $value->luas_bangunan > 0 )
                          <tr>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->luas_bangunan or '0'}} / {{ $value->luas_tanah or '0'}}</td>
                            <td><input type="text" class="nilai_budget form-control" name="harga_satuan[{{$key}}]" style="width: 100px;" value="{{ number_format($value->category->nilai )}}" /></td>
                            <td><span id="total_unit_{{$key}}">{{ $value->unit->count() }}</span></td>
                            <td>
                              <input type="hidden" name="unit_type_[{{$key}}]" id="unit_type_{{$key}}" value="{{ $value->id }}">
                              <input type="hidden" name="luas_type_[{{$key}}]" id="luas_type_{{$key}}" value="{{ $value->luas_bangunan * $value->unit->count() }}" data-value="{{ $value->luas_bangunan}}">
                              <input type="hidden" name="total_unit_type[{{$key}}]" id="total_unit_type_{{$key}}" value="{{ $value->unit->count()}}" data-value="">
                              <span class="nilai_budget total_unit" id="total_luas_{{$key}}">{{ $value->unit->count() * $value->luas_bangunan }}</span>
                            </td>
                            <td><input type="text" class="form-control" name="januari_[{{$key}}]" id="januari_{{$key}}" onkeyup="summaryunit('{{ $key}}')" value="{{ $value->unit->count() }}" style="width: 50px;"></td>
                            <td><input type="text" class="form-control" name="fabruari_[{{$key}}]" id="februari_{{$key}}" onkeyup="summaryunit('{{ $key}}')" value="0" style="width: 50px;"></td>
                            <td><input type="text" class="form-control" name="maret_[{{$key}}]" id="maret_{{$key}}" onkeyup="summaryunit('{{ $key}}')" value="0" style="width: 50px;"></td>
                            <td><input type="text" class="form-control" name="april_[{{$key}}]" id="april_{{$key}}" onkeyup="summaryunit('{{ $key}}')" value="0" style="width: 50px;"></td>
                            <td><input type="text" class="form-control" name="mei_[{{$key}}]" id="mei_{{$key}}" onkeyup="summaryunit('{{ $key}}')" value="0" style="width: 50px;"></td>
                            <td><input type="text" class="form-control" name="juni_[{{$key}}]" id="juni_{{$key}}" onkeyup="summaryunit('{{ $key}}')" value="0" style="width: 50px;"></td>
                            <td><input type="text" class="form-control" name="juli_[{{$key}}]" id="juli_{{$key}}" onkeyup="summaryunit('{{ $key}}')" value="0" style="width: 50px;"></td>
                            <td><input type="text" class="form-control" name="agustus_[{{$key}}]" id="agustus_{{$key}}" onkeyup="summaryunit('{{ $key}}')" value="0" style="width: 50px;"></td>
                            <td><input type="text" class="form-control" name="september_[{{$key}}]" id="september_{{$key}}" onkeyup="summaryunit('{{ $key}}')" value="0" style="width: 50px;"></td>
                            <td><input type="text" class="form-control" name="oktober_[{{$key}}]" id="oktober_{{$key}}" onkeyup="summaryunit('{{ $key}}')" value="0" style="width: 50px;"></td>
                            <td><input type="text" class="form-control" name="november_[{{$key}}]" id="november_{{$key}}" onkeyup="summaryunit('{{ $key}}')" value="0" style="width: 50px;"></td>
                            <td><input type="text" class="form-control" name="desember_[{{$key}}]" id="desember_{{$key}}" onkeyup="summaryunit('{{ $key}}')" value="0" style="width: 50px;"></td>
                          </tr>
                          @endif
                        @endforeach
                      @else

                      @endif
                    @endif
                  </tbody>
                </table>
              </form>
            </div>
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
  @include("master/copyright")
  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("budget::app")
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  function summaryunit(id){
    $("#btn_submit").show();
    var total_unit = parseInt($("#januari_" + id).val()) + parseInt($("#februari_" + id).val()) + parseInt($("#maret_" + id).val()) + parseInt($("#april_" + id).val()) + parseInt($("#mei_" + id).val()) + parseInt($("#juni_" + id).val()) + parseInt($("#juli_" + id).val()) + parseInt($("#agustus_" + id).val()) + parseInt($("#september_" + id).val()) + parseInt($("#oktober_" + id).val()) + parseInt($("#november_" + id).val()) + parseInt($("#desember_" + id).val()) ;

    if ( total_unit == "NaN"){
      $("#total_unit_" + id).text(0);
    }else{
     
      if ( parseInt(parseInt(total_unit) * parseInt($("#luas_type_" + id).attr("data-value"))) > parseInt($("#luas_type_" + id).val()) ){
        alert("Unit yang diajukan melebihi jumlah unit yang disediakan");
        $(this).val(0);
        $("#btn_submit").hide();
        return false;
      }else{
        $("#total_unit_" + id).text(total_unit);
        $("#total_unit_type_" + id).val(total_unit);
      }
    }

    $("#total_unit_" + id).number(true);
    var total_luas = parseInt($("#luas_type_" + id).attr("data-value")) * total_unit;
    $("#total_luas_" + id).text(total_luas);
    $("#total_luas_" + id).number(true);

    var sum = 0;
    $('.total_unit').each(function(){
        sum += parseFloat($(this).text().replace(",",""))   ;
    });

    $("#volume_0").val(sum);
    var subtotal_concost = parseInt(sum) * parseInt($("#nilai_0").val());
    $("#subtotal_0").text(subtotal_concost);
    $("#subtotal_0").number(true);
  }

  function cekmaster(id){
    var master = parseInt($("#volume_master_" + id).val());
    var volume_ = parseInt($("#volume_" + id).val());
    if ( volume_ > master){
      alert("Volume anda melebihi luas dari budget global");
      return false;
      $("#volume_" + id).val(0);
    }
  }
</script>
  
</script>
</body>
</html>
