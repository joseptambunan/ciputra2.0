<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard </title>
  @include("master/header")
  
    <!-- Select2 -->
  <link href="{{ URL::asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ URL::asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

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
    </style>
</head>
<body id="body" class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  @include("master/sidebar_project")
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Tambah Purchase Order {{ $project->name }}</h1>
    </section>
    <section class="content-header">
      <div class="" style="float: none">
        <button class="col-lg-1 col-md-2 col-sm-2 btn btn-primary" onclick="location.href='{{ url('/')}}/purchaseorder/'" style="float: none; border-radius: 20px; padding-left: 0">
        <i class="fa fa-fw fa-arrow-left"></i>&nbsp;&nbsp;Back
        </button>
        <button class="col-lg-1 col-md-2 col-sm-2 btn btn-primary" onclick="window.location.reload()" style="float: right; border-radius: 20px; padding-left: 0;">
          <i class="fa fa-fw fa-refresh"></i>&nbsp;&nbsp;Refresh
        </button>  
      </div>
    </section>
    <section class="content">
      
      <div class="box box-default">

        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
            @if($errors->any())
              <h4 style="color: red;">{{$errors->first()}}</h4>
            @endif              
              <form id="regForm" action="{{ url('/')}}/purchaseorder/store" method="post" name="form1">
                @csrf
                <input type="hidden" name="allitems" id="allitems" />
                <div class="tab">
                  <h3 class="box-title">Tambah Purchase Order</h3>
                  <div class="form-group col-md-12">
                    <label class="col-md-12" style="padding-left:0">Rekanan - No Penawaran</label>
                    <input name="idTender" value="" hidden>
                    <select id="id_penawaran" class="form-input input col-md-12" name="id_penawaran" required>
                      <option value="">Pilih</option>
                      @foreach($result as $key =>$value)
                        <option value="{{ $value['id'] }}" {{ $value['id']==$id ? 'selected': ''}}>{{ $value['name'] }} - {{ $value['no_penawaran'] }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group col-md-12">
                    <label class="col-md-12" style="padding-left:0">Deskripsi </label>
                    <textarea id="description" class="form-input input col-md-12" name="deskripsi" style="height: 110px;"></textarea>
                  </div>

                  <div class="form-group col-md-12">
                    <table id="datatable-details" class="table table-bordered table-striped dataTable">
                    <thead style="background-color: greenyellow;">
                      <tr>
                        <th>No</th>
                        <th>Item</th>
                        <th>Brand</th>
                        <th>Satuan</th>
                        <th>Qty</th>
                        <th>Harga(Rp.)</th>
                        <!-- <th>Disc. (%)</th> -->
                        <th class="sum">Total(Rp.)</th>
                        <th>PPN(%)</th>
                        <th hidden>PPH(%)</th>
                      </tr>
                      </thead>
                  </table>
                  </div>
                </div>
                <table class="table table_total" id="table_result">
                      <thead>
                        <tr>
                          <th class="text-right">Sub Total (Rp.)</th><th class="text-right sub_total">0</th>
                        </tr>
                        <!-- <tr>
                          <th class="text-right">Total Diskon(Rp.)</th><th class="text-right total_diskon">0</th>
                        </tr> -->
                        <!-- <tr>
                          <th class="text-right">Sub Total Dikurangi Diskon (Rp.)</th><th class="text-right sub_tot_disk">0</th>
                        </tr> -->
                        <tr>
                          <th class="text-right">Total PPN (Rp.)</th><th class="text-right total_ppn">0</th>
                        </tr>
                       <!--  <tr>
                          <th class="text-right">Total PPH (Rp.)</th><th class="text-right total_pph">0</th>
                        </tr> -->
                        <tr>
                          <th class="text-right">Grand Total (Rp.)</th><th class="text-right grand_total">0</th>
                        </tr>
                      </thead>
                </table>
                <button id="btn-submit" type="submit" class="col-md-1 btn btn-primary" >Simpan</button>
                  
                     
              </form>

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-12">
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
@include("master.footer_table")
@include('form.datatable_helper')
@include('form.general_form')
<!-- Select2 -->
<script src="{{ URL::asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $.ajaxSetup({
    headers: {
                  'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                }
    });
    var gentable = null;
  var _initTablePenerimaan = function () {

    var arrColumns = [
        { 'data': 'id'}, //
        { 'data': 'item'}, //
        { 'data': 'brand' }, //
        {'data': 'satuan' },
        {'data': 'quantity', 'sClass': 'text-right'},
        {'data': 'harga', 'sClass': 'text-right total'},
        // {'data': 'diskon', 'sClass': 'text-right'},
        {'data': 'total_harga', 'sClass': 'text-right total'},
        { 'data': 'ppn' , 'sClass': 'text-right' },
        { 'data': 'pph', 'sClass': 'text-right', 'sClass': 'hidden'}
      ];

    _GeneralTable(arrColumns);

    gentable = $('#datatable-details').DataTable(datatableDefaultOptions)
    .on('change','.input_qty',function()
      {

          var tParent = $(this).parents('tr');
          var data = gentable.row(tParent).data();
          var harga = parseFloat(data.harga);
          var qty = $(this).val();
          var qty_max = $(this).attr('max');

          var total_harga = harga*parseFloat(qty);

          var percentage_disc = parseFloat(tParent.find('.input-diskon').val());
          var disc_val = (percentage_disc/100*total_harga);
          //total_harga = total_harga - disc_val;
          
          var ppn_percentage = tParent.find('.input-ppn').val();
          var hit_nilai_ppn = parseFloat(ppn_percentage)/100*total_harga;

          var pph_percentage = tParent.find('.input-pph').val();
          var hit_nilai_pph = parseFloat(pph_percentage)/100*total_harga;

          var html_diskon = '<input type="number" name="diskon" id="diskon" min="0" value="'+percentage_disc+'" class="input-diskon text-right" step=".01" style="width: 100%;" /><input type="hidden" name="nilai_diskon" class="nilai_diskon" id="nilai_diskon" value="'+disc_val+'" />';
          
          var html_ppn ='<input type="number" name="ppn" id="ppn" min="0" value="'+ppn_percentage+'" class="input-ppn text-right" step=".01" style="width: 100%;" /><input type="hidden" name="nilai_pajak" class="nilai_ppn" id="nilai_pajak" value="'+hit_nilai_ppn+'" />';

          var html_pph = '<input type="number" name="pph" id="pph" min="0" class="input-pph text-right" value="'+pph_percentage+'" step=".01" style="width: 100%;" /><input type="hidden" name="nilai_pph" class="nilai_pph" id="nilai_pph" value="'+hit_nilai_pph+'" />';

          var html_qty ='<input type="number" class="text-right input_qty" name="quantity" id="quantity" value="'+qty+'" step="1" min="1" style="width: 100%;" max="'+qty_max+'" />';

          data.total_harga = total_harga;
          data.ppn = html_ppn;
          data.pph = html_pph;
          data.diskon = html_diskon;
          data.quantity = html_qty;

          gentable.row(tParent).data(data).draw();
          
      })
    .on('change','.input-ppn',function()
      {
          var tParent = $(this).parents('tr');
          var data = gentable.row(tParent).data();

          var qty = tParent.find('.input_qty').val();
          var harga = data.harga;
          var total_harga = qty*harga;

          var disc_percentage = parseFloat($(tParent).find('.input-diskon').val());

          var nilai_diskon = (disc_percentage/100)*total_harga;
          var total_harga_disc = total_harga - nilai_diskon;

          var percentage_ppn = parseFloat($(this).val());
          var ppn_value = percentage_ppn/100*total_harga_disc;
          var html_ppn ='<input type="number" name="ppn" id="ppn" min="0" value="'+percentage_ppn+'" class="input-ppn text-right" step=".01" style="width: 100%;" /><input type="hidden" name="nilai_pajak" class="nilai_ppn" id="nilai_pajak" value="'+ppn_value+'" />';

          data.ppn = html_ppn;
          gentable.row(tParent).data(data).draw();

      })
    .on('change','.input-pph',function()
      {
          var tParent = $(this).parents('tr');
          var data = gentable.row(tParent).data();

          var qty = tParent.find('.input_qty').val();
          var harga = data.harga;
          var total_harga = qty*harga;

          var disc_percentage = parseFloat($(tParent).find('.input-diskon').val());

          var nilai_diskon = (disc_percentage/100)*total_harga;
          var total_harga_disc = total_harga - nilai_diskon;

          var percentage_pph = parseFloat($(this).val());
          var pph_value = percentage_pph/100*total_harga_disc;
          var html_pph ='<input type="number" name="pph" id="pph" min="0" class="input-pph text-right" value="'+percentage_pph+'" step=".01" style="width: 100%;" /><input type="hidden" name="nilai_pph" class="nilai_pph" id="nilai_pph" value="'+pph_value+'" />';

          data.pph = html_pph;
          gentable.row(tParent).data(data).draw();
      })
    .on('click','.text-right',function()
    {
        $(this).select();
    })
    .on('change','.input-diskon',function()
    {
          var tParent = $(this).parents('tr');
          var data = gentable.row(tParent).data();

          var harga = parseFloat(data.harga);

          var qty = tParent.find('.input_qty').val();
          //var qty_max = tParent.find('.input_qty').attr('max');

          var total_harga = qty*harga;
          var disc_percentage = parseFloat($(this).val());

          var nilai_diskon = (disc_percentage/100)*total_harga;
          var total_harga_disc = total_harga - nilai_diskon;

          var ppn_percentage = tParent.find('.input-ppn').val();
          var hit_nilai_ppn = parseFloat(ppn_percentage)/100*total_harga_disc;

          var pph_percentage = tParent.find('.input-pph').val();
          var hit_nilai_pph = parseFloat(pph_percentage)/100*total_harga_disc;

          var html_diskon = '<input type="number" name="diskon" id="diskon" min="0" value="'+disc_percentage+'" class="input-diskon text-right" step=".01" style="width: 100%;" /><input type="hidden" name="nilai_diskon" class="nilai_diskon" id="nilai_diskon" value="'+nilai_diskon+'" />';

          var html_ppn ='<input type="number" name="ppn" id="ppn" min="0" value="'+ppn_percentage+'" class="input-ppn text-right" step=".01" style="width: 100%;" /><input type="hidden" name="nilai_pajak" class="nilai_ppn" id="nilai_pajak" value="'+hit_nilai_ppn+'" />';

          var html_pph = '<input type="number" name="pph" id="pph" min="0" class="input-pph text-right" value="'+pph_percentage+'" step=".01" style="width: 100%;" /><input type="hidden" name="nilai_pph" class="nilai_pph" id="nilai_pph" value="'+hit_nilai_pph+'" />';

          data.diskon = html_diskon;
          data.total_harga = total_harga;
          data.ppn = html_ppn;
          data.pph = html_pph;
          gentable.row(tParent).data(data).draw();
    }).
    on('keydown','input[type="number"]',function(e)
    {
        if (e.which === 8 || e.which === 46) {
              e.preventDefault();
          }
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
  datatableDefaultOptions.searching = true;
  datatableDefaultOptions.aoColumns = arrColumns;
  datatableDefaultOptions.columnDefs = _coldefs;
  datatableDefaultOptions.autoWidth = false;
  datatableDefaultOptions.ordering = false;
  //datatableDefaultOptions.scrollY = "300px";
  //datatableDefaultOptions.scrollX = true;
  //datatableDefaultOptions.scrollCollapse = true;
  //datatableDefaultOptions.fixedColumns = fixedColumn;
  datatableDefaultOptions.fnDrawCallback = function (row, data, start, end, display) {
    //show row number
    var api = this.api();

    api.columns('.sum', { page: 'current' }).every(function () {
        var sum = api
            .cells( null, this.index(), { page: 'current'} )
            .render('display')
            .reduce(function (a, b) {
                var x = parseFloat(a) || 0;
                var y = parseFloat(b) || 0;
                return x + y;
            }, 0);

            $('.table_total').find('.sub_total').text('').text(sum);
            fnSetAutoNumeric($('.table_total').find('.sub_total'));
            fnSetMoney($('.table_total').find('.sub_total'),$('.table_total').find('.sub_total').text());
              
    });
  };
  /*datatableDefaultOptions.initComplete= function(settings, json) {
            fnSetAutoNumeric('.money');
            fnSetMoney('.money',$('.money').text());
  };*/
}

  
  $(document).ready(function(){

   
      
      $('#id_penawaran').change(function()
      {
          var _data = {id:parseInt($(this).val())};
          var _url = "{{ url('/purchaseorder/getItemPenawaran') }}";

          $.ajax({
            type:'post',
            dataType:'json',
            url:_url,
            data:_data,
            beforeSend:function()
            {
              waitingDialog.show();
            },
            success:function(data)
            {
              if(data.length > 0){
                gentable.clear().draw();
                sub_total =0;
                grand_total=0;
                $(data).each(function(i,v)
                {

                    //var dpp = parseFloat(100/110)*(v.quantity*v.harga_satuan);
                    var nilai_pajak = parseFloat(v.ppn/100)*(v.quantity*v.harga_satuan);
                    var nilai_pph = parseFloat(v.pph/100)*(v.quantity*v.harga_satuan);
                    var items = {
                      id:v.item_id,
                      item:v.item_name,
                      brand:v.brand_name+'<input type="hidden" name="brand_id" id="brand_id" value="'+v.brand_id+'" />',
                      satuan:v.satuan_name+'<input type="hidden" name="satuan_id" id="satuan_id" value="'+v.satuan_id+'" />',
                      quantity:v.quantity+'<input type="hidden" name="quantity" id="quantity_fix" value="'+v.quantity+'" />',
                      // diskon:'<input type="number" name="diskon" id="diskon" min="0" value="0" class="input-diskon text-right" step=".01" style="width: 100%;" readonly/><input type="hidden" name="nilai_diskon" class="nilai_diskon" id="nilai_diskon" value="0" readonly/>',
                      harga:v.harga_satuan,
                      total_harga:v.quantity*v.harga_satuan,
                      ppn:v.ppn+'<input type="hidden" name="ppn" id="ppn" class="ppn" value="'+v.ppn+'" /><input type="hidden" name="nilai_pajak" id="nilai_pajak" class="nilai_ppn" value="'+nilai_pajak+'" />',
                      // ppn:'<input type="number" name="ppn" id="ppn" min="0" value="'+v.ppn+'" class="input-ppn text-right" step=".01" style="width: 100%;" /><input type="hidden" name="nilai_pajak" class="nilai_ppn" id="nilai_pajak" value="'+nilai_pajak+'" />',
                      pph:'<input type="number" name="pph" id="pph" min="0" class="input-pph text-right" value="'+v.pph+'" step=".01" style="width: 100%;" /><input type="hidden" name="nilai_pph" class="nilai_pph" id="nilai_pph" value="'+nilai_pph+'" />'
                    };

                    gentable.row.add(items);
                });


                gentable.draw();
              }
            },
            complete:function()
            {
              waitingDialog.hide();
              
            }
          });
      });

      
      $('#btn-submit').click(function()
      {
          var _data = [];
          $('#datatable-details > tbody > tr').each(function(i,v)
          {
              var _objdata = {
                'item_id':gentable.row(i).data().id,
                'brand_id':$(this).find('#brand_id').val(),
                'quantity':$(this).find('#quantity_fix').val(),
                'satuan_id':$(this).find('#satuan_id').val(),
                'harga_satuan':gentable.row(i).data().harga,
                'ppn':$(this).find('#ppn').val(),
                'pph':$(this).find('#pph').val(),
                'discount':$(this).find('#diskon').val()
              };

              _data.push(_objdata);
          });

          $('#allitems').val(JSON.stringify(_data));
      });

     _initTablePenerimaan();

      $('select').select2();

      var id_penawaran = $('#id_penawaran').val();
      if(id_penawaran != null)
      {
        $('#id_penawaran').trigger('change');
      }

      var tbody = $('#datatable-details tbody');
      gentable.on('draw',function()
      {
          var total_ppn = 0;
          var total_pph = 0;
          var total_disc = 0;

          tbody.find('.total').each(function()
          {
              fnSetAutoNumeric($(this));
              fnSetMoney($(this),$(this).text());
          });

          tbody.find('.nilai_ppn').each(function()
          {
              total_ppn += parseFloat($(this).val());
          });

          tbody.find('.nilai_pph').each(function()
          {
              total_pph += parseFloat($(this).val());
          });

          tbody.find('.nilai_diskon').each(function()
          {
            total_disc += parseFloat($(this).val());
          });


          $('.total_ppn').text('').text(total_ppn);
          fnSetAutoNumeric($('.total_ppn'));
          fnSetMoney($('.total_ppn'),$('.total_ppn').text());

          $('.total_pph').text('').text(total_pph);
          fnSetAutoNumeric($('.total_pph'));
          fnSetMoney($('.total_pph'),$('.total_pph').text());

          
          var sb_total = parseFloat($('.table_total').find('.sub_total').autoNumeric('get'));

          var sb_total_ku_disc = sb_total - total_disc;

          var grand_total = sb_total_ku_disc+total_ppn;

          fnSetAutoNumeric($('.table_total').find('.total_diskon'));
          $('.table_total').find('.total_diskon').text('').text(total_disc);
          fnSetMoney($('.table_total').find('.total_diskon'),$('.table_total').find('.total_diskon').text());

          fnSetAutoNumeric($('.table_total').find('.sub_tot_disk'));
          $('.table_total').find('.sub_tot_disk').text('').text(sb_total_ku_disc);
          fnSetMoney($('.table_total').find('.sub_tot_disk'),$('.table_total').find('.sub_tot_disk').text());

          
          fnSetAutoNumeric($('.table_total').find('.grand_total'));
          $('.table_total').find('.grand_total').text('').text(grand_total);
          fnSetMoney($('.table_total').find('.grand_total'),$('.table_total').find('.grand_total').text());

      });

  });
</script>
</body>
</html>
