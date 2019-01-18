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
      <h1>Data Proyek <strong>{{ $budget->budget->project->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12"><h3 class="box-title">Detail Data Budget Tahunan</h3></div>
   
            <!-- /.col -->
            <div class="col-md-12">

              <form action="{{ url('/')}}/budget/cashflow/save-item" method="post" name="form1" id="form1">  
                <input type="hidden" name="budget_awal_nilai" id="budget_awal_nilai" value="">
                 <input type="hidden" name="budget_real_value" id="budget_real_value" value="">
                <div class="form-group">                  
                  <button type="submit" class="btn btn-info" id="btn_submit">Submit</button>                  
                  <i class="fa fa-refresh ld ld-spin" id="loading" style="display: none;"></i>
                  <span id="warning_message" class="label-danger" style="display: none;"><strong>Nilai Budget Tahunan melebihi Nilai Budget Global</strong></span>
                  <a class="btn btn-warning" href="{{ url('/')}}/budget/cashflow/detail-cashflow?id={{ $budget->id }}">Kembali</a>
                </div>
                {{ csrf_field() }}
                <h4>Nilai Budget Awal : Rp. <span id="label_budget_awal"><strong></strong></span></h4>
                <input type="hidden" name="budget_id" id="budget_id" value="{{ $budget->id }}">
                <table class="table">
                  <thead class="head_table">
                    <tr>
                      <td>COA</td>
                      <td>Item Pekerjaan</td>
                      <td>Volume</td>
                      <td>Satuan</td>
                      <td>Harga Satuan(Rp)</td>
                      <td>Subtotal(Rp)</td>
                    </tr>
                  </thead>
                  <tbody id="itemlist">
                    <tr>
                      <td colspan="6" style="text-align: right;" ><span id="summary"></span></td>
                    </tr>
                    @php $start=0; $nilai = 0; @endphp
                    @if ( count($itempekerjaan->child_item) > 0 )
                    @foreach ( $itempekerjaan->child_item as $key3 => $value3 )   
                      @php
                        $budgettw = \Modules\Budget\Entities\BudgetDetail::where("itempekerjaan_id",$value3->id)->where("budget_id",$budget->budget->id)->get();

                        $budgetth = Modules\Budget\Entities\BudgetTahunanDetail::where("itempekerjaan_id",$value3->id)->where("budget_tahunan_id",$budget->id)->get();
                        
                      @endphp 

                      <tr>
                        <td><strong> {{ $value3->code }} </strong></td>
                        <td>{{ $value3->name }}</td>
                        @if ( count($budgetth) > 0 )
                          <td>
                            <input type='hidden' class='form-control' name='budgetdetail[{{ $start }}]' value='{{ $budgetth->first()->id }}'/><input type='hidden' class='form-control' name='item_id[{{ $start }}]' value='{{ $value3->id }}'/>
                            <input type='text' class='form-control nilai_budget' name='Volume_[{{ $start }}]' id="Volume_{{ $start }}" value='{{ $budgetth->first()->volume }}' onKeyUp="updateSubtotal('{{$start}}');" style="text-align: right;" autocomplete="off"/></td>
                          <td>
                            <input type='text' class='form-control' name='satuan_[{{ $start }}]' value="{{ $value3->details->satuan or 'ls' }}" autocomplete="off" required />
                          </td>
                          <td>
                            <input type='text' class='form-control nilai_budget ' name='nilai_[{{ $start }}]' id="nilai_{{ $start }}" value='{{ $budgetth->first()->nilai }}' onKeyUp="updateSubtotal('{{$start}}');" autocomplete="off" style="text-align: right;" />
                          </td>
                          <td>
                            <input type="text" class="form-control nilai_budget sub_total" id="sub_total_{{$start}}" name="" value="{{ number_format($budgetth->first()->nilai * $budgetth->first()->volume,2) }}" value="0" style="text-align: right;" autocomplete="off">
                          </td>
                          @php 
                          $start++; 
                          $nilai = $nilai + ($budgetth->first()->nilai * $budgetth->first()->volume); 
                        @endphp  
                        @else
                          <td>
                            <input type='hidden' class='form-control' name='budgetdetail[{{ $start }}]' value=''/>
                            <input type='hidden' class='form-control' name='item_id[{{ $start }}]' value='{{ $value3->id }}'/>
                            <input type='text' class='form-control nilai_budget' name='Volume_[{{ $start }}]' value='0' id="Volume_{{ $start }}" onKeyUp="updateSubtotal('{{$start}}');" style="text-align: right;" autocomplete="off"/>
                          </td>
                          <td>
                            <input type='text' class='form-control ' name='satuan_[{{ $start }}]' value="{{ $value3->details->satuan or 'ls' }}" autocomplete="off" required />
                          </td>
                          <td><input type='text' class='form-control nilai_budget' name='nilai_[{{ $start }}]' id="nilai_{{ $start }}" value='' onKeyUp="updateSubtotal('{{$start}}');" style="text-align: right;" autocomplete="off"/></td>              
                          <td><input type="text" class="form-control nilai_budget sub_total" id="sub_total_{{$start}}" name="" value="0" style="text-align: right;" autocomplete="off"></td>
                          @php $start++; @endphp
                        @endif
                      </tr>


                    @endforeach
                    @endif
                    <input type="hidden" id="tmp_budget" value="{{ $nilai_budget_awal }}">
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
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="{{ url('/')}}/assets/plugins/jquery.number.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  $(function () {
    $("#luas").number(true);
    $("#luas_brutto").number(true);
    $("#luas_netto").number(true);
    $('#start_date').datepicker({
      "dateFormat" : "yy-mm-dd"
    });

     $('#end_date').datepicker({
      "dateFormat" : "yy-mm-dd"
    });
     $("#budget_awal_nilai").val($("#tmp_budget").val());
     $("#summary").text($("#tmp_budget").val());
     $("#summary").number(true);
     $("#label_budget_awal").text($("#tmp_budget").val());
     $("#label_budget_awal").number(true);
     $(".nilai_budget").number(true);

  });

  function setkawasan(){
    if ( $("#iskawasan").is(":checked")){
      $("#kawasan").show();
    }else{
      $("#kawasan").hide();
    }
  }

  $("#coa_id").change(function(){
    $("#itemlist").html("");
    var request = $.ajax({
        url : "{{ url('/')}}/budget/item-detail",
        dataType : "json",
        data : {
          id : $("#coa_id").val()
        },
        type : "post"
    });

    request.done(function(data){
        if ( data.status == "0"){
          $("#itemlist").html(data.html);
        }else{
          alert("Tidak ada detail Item Pekerjaan");
        }
    });
  });

  function formsubmit(){
    $("#form1").submit();
    $("#btn_submit").hide();
    $(".submitbtn").hide();
    $("#loading").show();
  }

  $("#btn_submit").click(function(){
    $(".submitbtn").hide();
    $("#loading").show();
    $("#btn_submit").hide();
  });
  
  function updateSubtotal(id){
    
    var nilai = 0;
    var subtotal = parseInt($("#Volume_" +id).val()) * parseInt($("#nilai_" + id).val());
    $("#sub_total_" +id).val(subtotal);
    $("#sub_total_" + id).number(true);

    $('.sub_total').each(function () {
       nilai = parseInt(nilai) + parseInt(($(this).val()));
    });

    $("#budget_real_value").val(nilai);
    $("#summary").text(nilai);
    $("#summary").number(true);
    if ( parseInt($("#budget_real_value").val()) > parseInt($("#budget_awal_nilai").val()) ){
      $("#warning_message").show();
      $("#btn_submit").hide();
    }else{
      $("#warning_message").hide();
      $("#btn_submit").show();
    }
  }
</script>
</body>
</html>
