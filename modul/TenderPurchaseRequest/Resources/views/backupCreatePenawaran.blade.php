<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin QS | Dashboard </title>
  @include("master/header")
  
  <link rel="stylesheet" href="{{ url('/')}}/assets/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="{{ url('/')}}/assets/selectize/selectize.bootstrap3.css">

    <style>
        .panel-info>.panel-heading {
    color: white;
    background-color: #367fa9;
    border-color: #3c8dbc;
}
.panel-info {
    border-color: #3c8dbc;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice{
    background-color: #3c8dbc;
    border-color: #367fa9;
}
    </style>

    <style>
      * {
        box-sizing: border-box;
      }

      body {
        background-color: #f1f1f1;
      }

      h1 {
        text-align: center;  
      }
      /* Mark input boxes that gets an error on validation: */
      input.invalid,select.invalid,textarea.invalid{
        background-color: #ffdddd;
      }

      /* Hide all steps by default: */
      button:hover {
        opacity: 0.8;
      }

      #prevBtn {
        background-color: #bbbbbb;
      }

      /* Make circles that indicate the steps of the form: */
      .step {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbbbbb;
        border: none;  
        border-radius: 50%;
        display: inline-block;
        opacity: 0.5;
      }

      .step.active {
        opacity: 1;
      }

      /* Mark the steps that are finished and valid: */
      .step.finish {
        background-color: #4CAF50;
      }
      input[type=select-multiple]{
        width:33.3%;
      }

    .optionItem{
      width:24.5%;
    }
    .item{
      color: black;
      background-color: beige;
    }
    select{
      background-color: white;
    }
    .select2-container .select2-search--inline .select2-search__field{
      padding-left: 12px;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__rendered li{
      width: 100%
    }
    input:read-only { 
      background-color: #f5f5f5;
    }
    </style>
</head>
<body id="body" class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  @include("master/sidebar_project")
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Tambah Penawaran Tender {{ $project->name }}</h1>
    </section>
    <section class="content-header">
      <div class="" style="float: none">
        <button class="col-lg-1 col-md-2 col-sm-2 btn btn-primary" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/index_penawaran'" style="float: none; border-radius: 20px; padding-left: 0">
        <i class="fa fa-fw fa-arrow-left"></i>&nbsp;&nbsp;Back
        </button>
        <button class="col-lg-1 col-md-2 col-sm-2 btn btn-primary" onclick="window.location.reload()" style="float: right; border-radius: 20px; padding-left: 0;">
          <i class="fa fa-fw fa-refresh"></i>&nbsp;&nbsp;Refresh
        </button>  
      </div>
    </section>
    <section class="content">
      <div class="box box-default">
          <div id="clone_brand_ditawarkan" style="display: none;">
            <select name="id_brand_ditawarkan" id="id_brand_ditawarkan" class="form-control brand2" style="width: 100%;">
              <option value="">Pilih</option>
            </select>
          </div>
          <!--end clone -->

        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
            @if($errors->any())
            <h4 style="color: red;">{{$errors->first()}}</h4>
            @endif         
              <form id="regForm" action="{{ url('/')}}/tenderpurchaserequest/storePenawaran" method="post" name="form1" autocomplete="off" class="form-horizontal">
                @csrf
                  <div class="form-group">
                    <label class="col-md-3 control-label">No. Tender</label>
                    <input name="idTender" id="idTender" value="" hidden />
                      <div class="col-sm-7">
                        <select id="penawaran" class="form-control" name="penawaran" required>
                          <option value="">Pilih No. Tender</option>
                           @foreach($result_penawaran as $key => $v)
                            <option value="{{$v->id}}">{{$v->no}}</option>
                          @endforeach
                        </select>
                    </div>
                  </div>

                  <!-- <div class="form-group col-md-12">
                    <label class="col-md-12" style="padding-left:0">Penawaran Ke</label>
                    <input type="text" class="form-control" name="index_penawaran" id="index_penawaran" readonly="true">
                  </div> -->

                  <div id="divSupplier" class="form-group">
                    <label class="col-md-3 control-label">Supplier</label>
                    <div class="col-sm-7">
                      <select id="supplier" class="form-control" name="supplier" required="true">
                        <option value="" disabled="" selected="">Pilih Supplier</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Metode Pembayaran</label>
                      <div class="col-sm-7">
                        <div class="input-group">
                          <select id="cara_bayar" class="form-control" name="cara_bayar"  required>
                            <option value="">Pilih</option>
                            @foreach($metode_pembayaran as $value)
                              <option value="{{$value->id}}">{{strtoupper($value->name)}}</option>
                            @endforeach
                          </select>
                          <div class="input-group-addon">Termin</div>
                          <input type="number" class="form-control text-right" id="termin" name="termin" value="1" step="any" min="1">
                          <div class="input-group-addon" id="info_bayar"></div>
                        </div>
                        
                      </div>
                  </div>

                    <input type="hidden" name="all_send" id="all_send" />

                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" id="btn-submit" class="col-md-2 btn btn-primary" >Simpan</button>
                      </div>
                    </div>
                
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home"> Data Item</a></li>
                        <li><a data-toggle="tab" href="#menu1">Pembayaran</a></li>
                    </ul>

                    <div class="tab-content">

                        <div id="home" class="tab-pane fade in active">
                            <br/>
                            <table id="table_data" class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap">
                                <thead style="background: greenyellow;">
                                    <tr>
                                        <th rowspan="2">#</th>
                                        <th colspan="2" class="text-center">PR</th>
                                        <th colspan="1" class="text-center">Rekanan</th>
                                        <th rowspan="2" class="text-center">Qty</th>
                                        <th rowspan="2" class="text-center">Satuan</th>
                                        <th rowspan="2" class="text-center" id="hrga">Harga Satuan (Rp.)</th>
                                        <th rowspan="2" class="text-center">Total (Rp.)</th>
                                        <th rowspan="2" class="text-center" id="hrga">PPN (%)</th>
                                        <th rowspan="2" class="text-center"> Deskripsi</th>
                                        <th rowspan="2" class="text-center">COD</th>
                                    </tr>
                                    <tr>
                                        <th>Item</th>
                                        <th>Brand</th>
                                        <th>Brand</th>
                                    </tr>
                                </thead>
                            </table>

                            <table class="table" id="table_total">
                                <thead>
                                     <tr>
                                        <th class="text-right"><strong>Sub Total (Rp.) :</strong></th><th class="text-right" id="total_keseluruhan_harga">0</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th class="text-right"><strong>PPN (Rp.) :</strong></th><th class="text-right" id="total_ppn">0</th>
                                         <th></th>
                                         <th></th>
                                    </tr>
                                    <tr>
                                        <th class="text-right"><strong>Grand Total (Rp.) :</strong></th><th class="text-right" id="grand_total">0</th>
                                         <th></th>
                                         <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="menu1">
                            <br/>
                            <form class="form-horizontal" method="post" autocomplete="off">
                                @csrf
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Metode Pembayaran</label>
                                        <div class="col-sm-6">
                                            <select id="metode_pembayaran" class="form-input input col-md-12" name="metode_pembayaran" required>
                                            <option value="" disabled="" selected="">Pilih</option>
                                                @foreach($metode_pembayaran as $value)
                                                    <option value="{{$value->id}}">{{strtoupper($value->name)}}</option> 
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group" id="jumlah_cod" hidden="true">
                                        <label class="control-label col-md-4 col-sm-5 col-xs-12" style="padding-left:0">Termin COD</label>
                                            <div id="divPO" class="col-md-7 col-sm-7 col-xs-12" id="addpt">
                                                <input type="number" class="form-control col-md-3" id="lama_cod" name="lama_cod" style="width: 30%" value="1" min="1">
                                                <div class="input-group-addon col-md-4" style="width: 20%;height: 100%;padding: 9px 12px;">
                                                    Termin
                                                </div>
                                            </div>
                                    </div>

                                    <div class="form-group" id="jumlah_termin" hidden>
                                        <label class="control-label col-md-4 col-sm-5 col-xs-12" style="padding-left:0">Termin Pembayaran</label>
                                            <div id="divPO" class="col-md-7 col-sm-7 col-xs-12" id="addpt">
                                                <input type="number" class="form-control col-md-3" id="lama_cicilan" name="lama_cicilan" style="width: 30%" value="1" oninput ="f_list_Termin()" placeholder="" min="1">
                                                <div class="input-group-addon col-md-4" style="width: 20%;height: 100%;padding: 9px 12px;">
                                                    Termin
                                                </div>
                                            </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-10">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="DP" value="DP" id="DP"> DP/Uang Muka (%)
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" id="inputan_DP" hidden>
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-6">
                                            <input type="number" class="form-control col-md-3" id="percentage_dp" name="percentage_dp" style="width: 30%">
                                            <div class="input-group-addon col-md-4 col-sm-6" style="width: 10%;height: 100%;padding: 9px 12px;">
                                              Rp.
                                            </div>
                                            <input type="hidden" name="mnew_dp_value" id="mnew_dp_value" />
                                            <input type="text" class="form-control col-md-4" id="new_dp_value" name="new_dp_value" style="width: 50%" readonly>
                                        </div>
                                    </div>

                                    <div id="list_Termin" hidden>
                                        <div class="form-group sub_list_Termin">
                                            <label class="control-label col-md-4 col-sm-5 col-xs-12" style="padding-left:0">Termin 1</label>
                                                <div id="divPO" class="col-md-7 col-sm-7 col-xs-12" id="addpt" style="margin-bottom: 10px">

                                                    <input type="number" class="form-control col-md-3" id="Termin_1" name="Termin[]" style="width: 30%" value="" min="0">
                                                    <div class="input-group-addon col-md-4 col-sm-6" style="width: 10%;padding: 9px 12px;">
                                                        %
                                                    </div>
                                                </div>
                                        </div>
                                    </div>

                             </form>

                             <table id="table_cod" class="table table-bordered" style="overflow-x: scroll;">
                                <thead>
                                  <tr>
                                    <th>Item</th>
                                    <th>Qty COD 1</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  
                                </tbody>
                              </table>       
                        </div>
                     </div>
          </form>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->
    </div>

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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-bayar">

          <div class="form-group" id="not_cod">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-save"></i> OK</button>
            </div>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

@include("master/footer_table")
@include('form.datatable_helper')
@include('pluggins.alertify')
@include('form.general_form')
@include('pluggins.datetimepicker_pluggin')
<script type="text/javascript" src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js">
</script>
<script type="text/javascript">

  var nilai_termin;
  $.ajaxSetup({
    headers: {
                  'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                }
    });

    $('#penawaran,#supplier').select2();

  const item_struct = $("#list_Termin");
  const a=item_struct[0].innerHTML;
  function f_list_Termin(){
          var jumlah_item_old = $(".sub_list_Termin").length;;
          var jumlah_item_new = $("#lama_cicilan").val();
          if(jumlah_item_new > jumlah_item_old){
              for(i=parseInt(jumlah_item_old)+1;i<=jumlah_item_new;i++){
                  tmp = a.replace('Termin 1','Termin '+i);
                  tmp = tmp.replace(/Termin_1/g,'Termin_'+i);
                  // tmp = tmp.replace(/Termin1/g,'Termin'+i);
                  $("#list_Termin").append(tmp);
              }
          }else if(jumlah_item_new < jumlah_item_old){
              beda_item = jumlah_item_new-jumlah_item_old;
              for(i=jumlah_item_old;i>jumlah_item_new;i--)
                  $(".sub_list_Termin")[$(".sub_list_Termin").length-1].remove();
          }
          
      }


/*$(document).ready(function() {
   $("#metode_pembayaran").change(function() {
        if ($("#metode_pembayaran").val() == 1) {
            $("#list_Termin").hide();
            $("#jumlah_termin").hide();
            $("#jumlah_cod").show();
            $('#group-cod').show();
        }
        else if ($("#metode_pembayaran").val() == 2) {
            $("#list_Termin").show();
            $("#jumlah_termin").show();
            $("#list_COD").hide();
            $("#jumlah_cod").hide();
        }
    });

    $("#DP").change(function() {
        if (!this.checked) {
            $("#inputan_DP").hide();
        }
        else {
            $("#inputan_DP").show();
        }
    });

$('#percentage_dp').on('input',function()
  {
    var dp_percentage = $(this).val();
        if(dp_percentage != '' || dp_percentage != undefined)
        {
            dp_percentage = parseFloat(dp_percentage)/100;
            var po_value = parseFloat($('#grand_total').autoNumeric('get'));

            var dp_value = dp_percentage*po_value;
            // console.log(dp_value);

            $('#new_dp_value').val(dp_value);
            fnSetMoney('#new_dp_value',dp_value);
        }
    
  });


    $("#DP").trigger("change")
});*/

var gentable = null;

var _initTable = function () {

  var _mRender = function(data,type,row)
  {
    if(type == 'display')
    {
      return "<button type='button' class='button-cod btn btn-danger btn-xs' data-toggle='modal' data-target='#myModal'><i class='fa fa-list'></i> COD</button>";
    }

  }
    
    var arrColumns = [
        { 'data': 'id'}, //
        { 'data': 'item_penawaran'}, //
        { 'data': 'brand_penawaran' },
        {'data': 'brand_ditawarkan'},
        {'data': 'quantity', 'sClass': 'text-right total'},
        {'data': 'satuan_name'},
        {'data': 'harga_fase', 'sClass': 'text-right total'},
       // {'data': 'diskon', 'sClass': 'text-right total'},
        {'data': 'total_harga', 'sClass': 'text-right'},
        {'data': 'ppn', 'sClass': 'text-right total'},
        {'data': 'description_item_ditawarkan'},
        {'data':'cod_val','mRender':_mRender}
      ];

    _GeneralTable(arrColumns);

    gentable = $('#table_data').DataTable(datatableDefaultOptions)
    .on('click', '.button-cod',function (d){
      var tr = $(this).parents('tr');
      var data = gentable.row(tr).data();

      $('.modal-title').text('').append(data.item_penawaran);

    }).on('draw',function()
    {
        var tbody = $('#table_data tbody');
        tbody.find('.harga-penawaran').each(function(i,v)
        {
          
          fnSetAutoNumeric($(this));
          fnSetMoney($(this),$(this).val());
        });

        tbody.find('select').select2();
        tbody.find('.total_harga').each(function(i,v)
        {
          
          fnSetAutoNumeric($(this));
          fnSetMoney($(this),$(this).val());
        });

    });
}

var _GeneralTable = function (arrColumns) {
  var _coldefs = [
        {
          "targets":[],
          "visible": false,
          "searchable": false
        }
      ];
  var fixedColumn = {
    leftColumns: 1
  }
  datatableDefaultOptions.searching = false;
  datatableDefaultOptions.aoColumns = arrColumns;
  datatableDefaultOptions.columnDefs = _coldefs;
  datatableDefaultOptions.autoWidth = false;
  datatableDefaultOptions.ordering = false;
  datatableDefaultOptions.scrollX= true;
  //datatableDefaultOptions.scrollY = "700px";
  datatableDefaultOptions.scrollX = true;
  //datatableDefaultOptions.scrollCollapse = true;
  //datatableDefaultOptions.fixedColumns = fixedColumn;
  datatableDefaultOptions.fnDrawCallback = function (oSettings) {
    //show row number
    for (var i = 0, iLen = oSettings.aiDisplay.length; i < iLen; i++) {
      $('td:eq(0)', oSettings.aoData[oSettings.aiDisplay[i]].nTr).html((i + 1) + '.');
    }
  };
}

  /*var fnTotalDiskon = function()
  {
      var totaldiskon = 0;
      $('#table_data > tbody > tr').each(function()
      {
          var temptotal = parseFloat($(this).find('#total_harga').autoNumeric('get'));
          var percentage_disc = $(this).find('#diskon').val();
          var diskon_value = parseFloat(percentage_disc/100)*temptotal;

          totaldiskon+=diskon_value;
      });

      $('#total_diskon').text('').text(totaldiskon);
      fnSetMoney('#total_diskon',totaldiskon);
  }*/

  var fnTotalPpn = function()
  {
      var totalppn = 0;
      $('#table_data > tbody > tr').each(function()
      {
          var temptotal = parseFloat($(this).find('#total_harga').autoNumeric('get'));
          var percentage_ppn = $(this).find('#ppn').val();
          var ppn_value = parseFloat(percentage_ppn/100)*temptotal;

          totalppn+=ppn_value;
      });

      $('#total_ppn').text('').text(totalppn);
      fnSetMoney('#total_ppn',totalppn);
  }

  var fnTotaling = function()
  {
      var totaling = 0;
      $('#table_data > tbody > tr').each(function()
      {
          var temptotal = parseFloat($(this).find('#total_harga').autoNumeric('get'));
          totaling += temptotal;
      });

      $('#total_keseluruhan_harga').text('').text(totaling);
      fnSetMoney('#total_keseluruhan_harga',totaling);
  }

  var fnGrandTotal = function()
  {
      var sub_total = $('#total_keseluruhan_harga').autoNumeric('get');
      /*var ttl_diskon = $('#total_diskon').autoNumeric('get');*/
      var ttl_ppn = $('#total_ppn').autoNumeric('get');

      var grand_total = parseFloat(sub_total)+parseFloat(ttl_ppn);
      $('#grand_total').text('').text(grand_total);

      fnSetMoney('#grand_total',$('#grand_total').text());
  }

  $(document).ready(function(){
    _initTable();

    fnSetAutoNumeric('#total_keseluruhan_harga');
    fnSetMoney('#total_harga',$('#total_harga').text());

    //fnSetAutoNumeric('#total_diskon');
    fnSetAutoNumeric('#total_ppn');
    fnSetAutoNumeric('#grand_total');
    fnSetAutoNumeric('#new_dp_value');

    $('#supplier').change(function(){
      var url = "{{ url('/')}}/tenderpurchaserequest/getItemSupplierPenawaran";
      var supplier_id = parseInt($(this).val());
      var cloneBrandDitawarkan = $('#clone_brand_ditawarkan').clone();
      gentable.clear().draw();
       $.ajax({
              type:'post',
              dataType:'json',
              url:url,
              data:{id : $('#penawaran').val(),supplier_id:supplier_id},
              beforeSend:function()
              {
                waitingDialog.show();
              },
              success:function(data)
              {

                  if(data.data.length > 0) 
                  {
                    
                    var strTdCod = '';
                    $(data.data).each(function(i,v)
                    {
                        var strOption = '';
                        if(Object.keys(data.brand_ditawarkan[i])[0] == v.itemid)
                        {
                          strOption +='<option value="">Semua Brand</option>';
                          for(var j= 0; j < Object.values(data.brand_ditawarkan[i])[0].length;j++)
                          {
                            strOption +='<option value="'+Object.values(data.brand_ditawarkan[i])[0][j].id+'">'+Object.values(data.brand_ditawarkan[i])[0][j].brand_name+'</option>';
                          }

                          cloneBrandDitawarkan.find('select').find('option').remove();
                          cloneBrandDitawarkan.find('select').append(strOption);
                        }
                        
                        strTdCod +='<tr><td>'+v.itemName+'</td><td><input type="number" value="0" min="0" step="any" name="qty_cod1" id="qty_cod1" class="form-control" /></td></tr>';

                        var ItemTable = {
                          id:v.kode,
                          item_penawaran:'<input type="hidden" name="temp_item_id" id="temp_item_id" value="'+v.itemid+'" />'
                          +v.itemName+'<input type="hidden" name="item_penawaran_id" id="item_penawaran_id" value="'+v.itemid+'" />',
                          brand_penawaran:'<input type="hidden" name="temp_brand_id" id="temp_brand_id" value="'+v.brandId+'" />'+v.brandName+
                          '<input type="hidden" name="id_brand_tawar" id="id_brand_tawar" value="'+v.brandId+'" />'+'<input type="hidden" name="volume" id="volume" value="'+v.totalqty+'" />',
                          brand_ditawarkan:cloneBrandDitawarkan.html(),
                          quantity: v.totalqty,
                          satuan_name: v.satuanName,
                          harga_fase:'<input type="text" name="harga_fase" id="harga_fase" value="0" class="harga-penawaran form-control text-right" />'+'<input type="hidden" name="item_satuan_id" id="item_satuan_id" value="'+v.satuan_id+'"/>',
                          diskon:'<input type="number" name="diskon" id="diskon" value="0" class="form-control text-right diskon" />',
                          ppn:'<input type="number" name="ppn" id="ppn" value="0" class="form-control text-right ppn" />',
                          total_harga:'<input type="text" name="total_harga" id="total_harga" value="0" class="text-right total_harga form-control" readonly="true">'+'<input type="hidden" name="pkp_status" id="pkp_status" value="'+data.pkp_status+'" />',
                          description_item_ditawarkan:'<textarea id="deskripsi_item_ditawarkan" name="deskripsi_umum" class="form-input col-md-12" style="min-width: 180px;">'+v.description+'</textarea>'
                        };

                        gentable.row.add(ItemTable);
                    });

                    $('#table_cod tbody').append(strTdCod);
                  }

                  gentable.draw();
                  
              },
              complete:function()
              {
                  waitingDialog.hide();
              }
            }); 
    });

     $('#penawaran').change(function(){
          var url = "{{ url('/')}}/tenderpurchaserequest/getSupplierPenawaran";
          var item = $("#supplier");
          var send = $(this).val();
          //console.log(url + '/' + send);
           $.ajax({
              type:'post',
              dataType:'json',
              url:url,
              data:{id : send},
              beforeSend:function()
              {
                waitingDialog.show();
                gentable.clear().draw();
              },
              success:function(data)
              {
                  var strHtml='';
                  strHtml +='<option value="">Pilih Supplier</option>';
                  if(data.result.length > 0)
                  {
                      alertify.success(data.result.length+ ' supplier ditemukan');
                      
                      for(var i=0;i<data.result.length;i++)
                      {
                          strHtml+='<option value="'+data.result[i].id+'" >'+data.result[i].rekanan_name+'</option>';
                      }
                  }

                  var checkIndex = parseFloat(data.indexPenawaran-data.result.length);
                  var index = 1;
                  if(checkIndex <= 0)
                  {
                    $('#index_penawaran').val(checkIndex);
                  }
                  else
                  {
                    
                  }
                  //
                  item.find('option').remove();
                  item.append(strHtml);
              },
              complete:function()
              {
                  waitingDialog.hide();
              }
            });         
      });



    var tbody = $('#table_data tbody');
    tbody.on('click','input',function()
    {
        $(this).select();
    }).on('keyup','.harga-penawaran',function()
    {
        var tParent = $(this).parents('tr');
        var nilai_harga = $(this).autoNumeric('get');
        var qty = gentable.row(tParent).data().quantity;

        var total = parseFloat(qty*nilai_harga);
        tParent.find('#total_harga').val(total);
        fnSetMoney(tParent.find('#total_harga'),total);
        fnTotaling(tParent.find('.total_harga'));

        fnGrandTotal();
    }).
    on('change','.brand2',function()
    {
         var trParent = $(this).parents('tr');
         var optionval = $(this).val();
         if(optionval != "")
         {
            trParent.find('#id_brand_tawar').val(optionval);
         }
         else
         {
            var id_brand_tetap = trParent.find('#temp_brand_id').val();
            trParent.find('#id_brand_tawar').val(id_brand_tetap);
         }
    }).on('input','.ppn',function()
    {
        fnTotalPpn();
        fnGrandTotal();

    });/*.on('input','.diskon',function()
    {
       // fnTotalDiskon();
        fnGrandTotal();
    });*/


    $('#btn-submit').click(function()
    {
        var _data = [];
        $('#table_data > tbody > tr').each(function(i,v)
        {
            var _objdata = {
              'item_id':$(this).find('#item_penawaran_id').val(),
              'brand_id':$(this).find('#id_brand_tawar').val(),
              'item_satuan_id':$(this).find('#item_satuan_id').val(),
              'volume':$(this).find('#volume').val(),
              'nilai':$(this).find('#harga_fase').autoNumeric('get'),
              'ppn':$(this).find('#ppn').val(),
              // 'disc':$(this).find('#diskon').val()
              'deskripsi':$(this).find('#deskripsi_item_ditawarkan').val()
            };

            _data.push(_objdata);
        });

        $('#all_send').val(JSON.stringify(_data));
    });


    /*var cod_counter = 1;

    $('#lama_cod').data('oldVal',$('#lama_cod').val());

    $('#lama_cod').on('input',function()
    {
        var newVal = $(this).val();
        var oldVal = $(this).data('oldVal');
        var tempOld = oldVal;
        if(newVal > 1){
          if(newVal > oldVal)
          {
              cod_counter++;
              strThead = '<th>Qty COD '+cod_counter+'</th>';
              $('#table_cod thead').find('tr').eq(0).append(strThead);
          }
          else
          {
              cod_counter--;
              $('#table_cod thead').find('tr th:last').remove();
          }
        }
        console.log('nilia baru '+newVal+' nilai lama '+oldVal);
        
    }).focus(function(){
            // assign oldVal data attribute on input focus
            $(this).data('oldVal', $(this).val());
       });*/


      $('#cara_bayar').change(function()
      {
        var txtBayar = $('#cara_bayar option:selected').text();
        $('#info_bayar').text('').text(txtBayar);
        var metode_pembayaran_val = $(this).val();

        if (metode_pembayaran_val == 1 || txtBayar === 'COD') {
            var strCod = '';
            var termin_cod = parseInt($(this).siblings('input[type="number"]').val());

            for (var i = 1; i <= termin_cod ;i++) {
                strCod +='<div class="form-group cod"><label class="col-sm-2 control-label">COD '+i+'</label><div class="col-sm-10">';
                strCod += '<div class="input-group"><div class="input-group-addon">Qty</div>';
                strCod += '<input type="text" class="form-control" id="qty_cod'+i+'" name="qty_cod'+i+'">';
                strCod += '<div class="input-group-addon"><i class="fa fa-calendar"></i></div>';
                strCod += '<input type="text" class="form-control datePicker_" id="tanggal_cod'+i+'" name="tanggal_cod'+i+'">';
                strCod +='</div></div></div>';
            }


            $(strCod).insertBefore($('#form-bayar').find('.form-group'));
            nilai_termin = termin_cod;
        }
        else{
            /*$("#list_Termin").show();
            $("#jumlah_termin").show();
            $("#list_COD").hide();
            $("#jumlah_cod").hide();*/
        }


     });

      $('#termin').on('input',function()
      {

          var mtd_pembayaran = $('#cara_bayar').val();

          if(mtd_pembayaran != null || mtd_pembayaran != '')
          {
            //cod
            
            var txtBayar = $('#cara_bayar option:selected').text();
            if(mtd_pembayaran == 1 || txtBayar === 'COD')
            {
                  console.log(mtd_pembayaran);
                  

                  var termin_cod = parseInt($(this).val());

                  if(nilai_termin > termin_cod)
                  {
                    // cod berkurang
                    $('#not_cod').prev('.form-group').remove();
                  }
                  else
                  {
                      //cod bertambah
                      var strCod = '';
                      var elementCodBefore = $('#form-bayar').find('.cod').length;
                      var totalElement = elementCodBefore+termin_cod;

                      for (var i = elementCodBefore+1; i <= totalElement ;i++) {
                        strCod +='<div class="form-group cod"><label class="col-sm-2 control-label">COD '+i+'</label><div class="col-sm-10">';
                        strCod += '<div class="input-group"><div class="input-group-addon">Qty</div>';
                        strCod += '<input type="text" class="form-control" id="qty_cod'+i+'" name="qty_cod'+i+'">';
                        strCod += '<div class="input-group-addon"><i class="fa fa-calendar"></i></div>';
                        strCod += '<input type="text" class="form-control datePicker_" id="tanggal_cod'+i+'" name="tanggal_cod'+i+'">';
                        strCod +='</div></div></div>';
                      }


                      $(strCod).insertBefore($('#form-bayar').find('.form-group'));
                  }

                  nilai_termin = termin_cod;
              }
          }
          else
          {

          }
      });
    
  });
</script>
</body>
</html>