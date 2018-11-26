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

              <form action="{{ url('/')}}/budget/cashflow/save-revitem" method="post" name="form1" id="form1">  
                <div class="form-group">                  
                  <button type="submit" class="btn btn-info">Submit</button>
                  <a class="btn btn-warning" href="{{ url('/')}}/budget/cashflow/detail-cashflow?id={{ $budget->id }}">Kembali</a>
                </div>
                {{ csrf_field() }}
                <input type="hidden" name="budget_id" id="budget_id" value="{{ $budget->id }}">
                <table class="table">
                  <thead class="head_table">
                    <tr>
                      <td>COA</td>
                      <td>Item Pekerjaan</td>
                      <td>Volume</td>
                      <td>Satuan</td>
                      <td>Harga Satuan</td>
                      <td>Referensi</td>
                    </tr>
                  </thead>
                  <tbody id="itemlist">
                    @php $start=0; @endphp
                    @if ( count($itempekerjaan->child_item) > 0 )
                    @foreach ( $itempekerjaan->child_item as $key3 => $value3 )   
                      @php
                        $budgettw = \Modules\Budget\Entities\BudgetDetail::where("itempekerjaan_id",$value3->id)->where("budget_id",$budget->budget->id)->get();
                        $budgetth = Modules\Budget\Entities\BudgetTahunanDetail::where("itempekerjaan_id",$value3->id)->where("budget_tahunan_id",$budget->id)->get();
                      @endphp                          
                      <tr>
                        <td><strong> {{ $value3->code }} </strong></td>
                        <td>{{ $value3->name }} </td>
                        @if ( count($budgetth) > 0 )
                          <td><input type='hidden' class='form-control' name='budgetdetail[{{ $start }}]' value='{{ $budgetth->first()->id }}'/><input type='hidden' class='form-control' name='item_id[{{ $start }}]' value='{{ $value3->id }}'/><input type='text' class='form-control' name='Volume_[{{ $start }}]' value='{{ $budgetth->first()->volume }}' autocomplete="off" /></td>
                          <td><input type='text' class='form-control' name='satuan_[{{ $start }}]' value="{{ $value3->details->satuan or 'ls' }}" autocomplete="off" required /></td>
                          <td>
                            @if ( $budgetth->first()->nilai > 0 )
                              <input type='text' class='form-control nilai_budget' name='nilai_[{{ $start }}]' value='{{ $budgetth->first()->nilai }}' autocomplete="off" />
                            @else
                              @if ( count($value3->harga) > 0 )
                                <input type='text' class='form-control nilai_budget' name='nilai_[{{ $start }}]' value='{{ number_format($value3->harga->last()->nilai )}}' autocomplete="off" />
                              @else
                                <input type='text' class='form-control nilai_budget' name='nilai_[{{ $start }}]' value='{{ number_format(0) }}' autocomplete="off" />
                              @endif
                            @endif
                          </td>
                        @else
                           <td><input type='hidden' class='form-control' name='budgetdetail[{{ $start }}]' value=''/><input type='hidden' class='form-control' name='item_id[{{ $start }}]' value='{{ $value3->id }}'/><input type='text' class='form-control' name='Volume_[{{ $start }}]' value=''/></td>
                            <td><input type='text' class='form-control ' name='satuan_[{{ $start }}]' value="{{ $value3->details->satuan or 'ls' }}" autocomplete="off" required /></td>
                            @if ( count($value3->harga) > 0 )
                            <td><input type='text' class='form-control nilai_budget' name='nilai_[{{ $start }}]' value='{{ number_format($value3->harga->last()->nilai )}}' autocomplete="off" /></td>
                            @else
                            <td><input type='text' class='form-control nilai_budget' name='nilai_[{{ $start }}]' value='{{ number_format(0) }}' autocomplete="off" /></td>
                            @endif
                            
                        @endif
                        @if ( $value3->harga != "" )
                        <td><a href="{{ url('/')}}/budget/cashflow/referensi?id={{ $value3->id }}&budget_tahunan_id={{ $budget->id }}" class="btn btn-warning">Referensi Harga</a></td>
                        @endif
                      </tr>
                      @php $start++; @endphp                  
                    @endforeach
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
@include("pt::app")
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="{{ url('/')}}/assets/plugins/jquery.number.min"></script>
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
  }
  $(".nilai_budget").number(true);

</script>
</body>
</html>
