<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
  <link href="{{ URL::asset('assets/global/plugins/typeahead/typeahead.css') }}" rel="stylesheet" type="text/css" />
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{ $project->name }}</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
  
			  <ul class="breadcrumb">
	            <li>
	                <a href="{{ url('/inventory/stock/view_stock') }}">Inventory</a>
	            </li>
	            <li>
	                <a href="{{ url('/inventory/barangmasuk_hibah/index') }}">Barang Masuk</a>
	            </li>
	            <li>
	                <span>Tambah</span>
	            </li>
	        </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
              	@include('form.a',[
			'href'=> url('/barangmasuk_hibah/index'), 
			'caption' => 'Kembali' 
		])
		<hr/>
              	<form action="{{ url('/inventory/barangmasuk_hibah/create') }}" method="post" class="form-horizontal form-label-left" 
		id="form_data">

					<div class="col-lg-6 col-md-6 col-xs-12">
						{{ csrf_field() }}
						<input type="hidden" name="current_project_id" id="current_project_id" value="{{ $project->id }}" />
						<input type="hidden" name="allItemStore" id="allItemStore" value="" />
						<div class="item form-group">
						    <label class="control-label col-md-3 col-sm-3 col-xs-12">Dari Project</label>
						    <div class="col-md-7 col-sm-7 col-xs-12">
						     	<input type='text' id='from_project_id' name='from_project_id' class='form-control' value="" />
						     	<input type="hidden" id='mfrom_project_id' name="mfrom_project_id" class="form-control" value="0" />
						    </div>
					  	</div>
					  	<div class="item form-group">
						    <label class="control-label col-md-3 col-sm-3 col-xs-12">Dari PT</label>
						    <div class="col-md-7 col-sm-7 col-xs-12" id="addpt">
						     	<input type='text' id='from_pt_id' name='from_pt_id' class='form-control' value="" />
						    </div>
					  	</div>

					  	<div class="item form-group">
						    <label class="control-label col-md-3 col-sm-3 col-xs-12">No Refrensi</label>
						    <div class="col-md-7 col-sm-7 col-xs-12">
						     	<input type='text' id='no_refrensi' name='no_refrensi' class='form-control' value="" />
						    </div>
					  	</div>

					  	</div>

					  	<div class="col-lg-6 col-md-6 col-xs-12">
				  		<div class="item form-group">
							<label class="control-label col-md-4 col-sm-4 col-xs-12">Penerima  
							</label>
							<div class="col-md-7 col-sm-7 col-xs-12">
								<div class="input-group">
									<input type="hidden" name="pic_id" id="pic_id" value="{{ Auth::user()->id }}" />
									<input type="text" class="form-control typeaHead" name='pic_penerima' id="pic_penerima" value="{{ Auth::user()->user_name }}" />
									<div class="input-group-addon"><i class="fa fa-user"></i></div>
								</div>	
							</div>
						</div>
					  	<div class="item form-group">
							<label class="control-label col-md-4 col-sm-4 col-xs-12">Tgl Barang Masuk  
							</label>
							<div class="col-md-7 col-sm-7 col-xs-12">
								<div class="input-group input-medium date datePicker_">
									<input type="text" class="form-control" name='tanggal_hibah' id='tanggal_hibah' required value="<?php echo date('Y-m-d'); ?>">
									<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
								</div>	
							</div>
						</div>
					  	<div class="item form-group">
							<label class="control-label col-md-4 col-sm-4 col-xs-12">Deskripsi 
							</label>
							<div class="col-md-7 col-sm-7 col-xs-12">
								<textarea name="description" id="description" style="height: 100px;width: 330px;"></textarea>
							</div>
						</div>

					</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-3">
								<button id="send-all" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
								<button id="item_brg" type="button" class="btn btn-primary"><i class="fa fa-list"></i> Item</button>
							</div>
						</div>
					</form>
					<div style="display: none;" id="warehouses" >
	<select name="warehouse_id" id="warehouse_id" class="warehouse_item">
		<option value="">Pilih WareHouse</option>
		@foreach($wareHouses as $key => $value)
			<option value="{{ $value->id }}">{{ $value->name }}</option>
		@endforeach
	</select>
	<span style="color:red;display: none;">silahkan isi</span>
</div>

		<table id="datatable-details" class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap">
			<thead>
				<tr>
					<th>#</th>
					<th>Item</th>
					<th>Deskripsi</th>
					<th>Harga(Rp.)</th>
					<th>Qty</th>
					<th>Total</th>
					<th>Satuan</th>
					<th>Gudang</th>
				</tr>
			</thead>
		</table>
<!-- Modal -->
<div class="modal fade" id="modal_satuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pilih Item Barang</h4>
      </div>
      <div class="modal-body">
        <table id="datatable-items" class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap">
			<colgroup>
				<col style="width: 1px;">
				<col>
				<col style="width:120px;">
			</colgroup>
			<thead>
				
				<tr>
					<th></th>
					<th>Item</th>
					<th>Qty</th>
				</tr>
			</thead>
			<tbody>
				@foreach($items as $key => $value)
				<tr>
					<td >
						<input type="hidden" name="rowIdx" id="rowIdxPenerimaan" value="-1" />
						<input type="checkbox" name="add_item" id="add_item" class="item_checkbox" value="{{ $value->id }}" />
					</td>
					<td>
						{{ $value->name }}
					</td>
					<td>
						<input type="number" name="qty_item" id="qty_item" class="text-right qty_item_add form-control" min="0" value="1" />
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
</div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
@include("master/footer_table")
@include('form.general_form')
@include('pluggins.select2_pluggin')
@include('pluggins.alertify')

@include('form.datatable_helper')
@include('pluggins.datetimepicker_pluggin')

<script src="{{ URL::asset('vendor/jsvalidation/js/jsvalidation.min.js')}}" type='text/javascript'></script>
{!! JsValidator::formRequest('Modules\Inventory\Http\Requests\RequestBarangMasukHibah', '#form_data') !!}
<script type="text/javascript" src="{{ URL::asset('assets/global/plugins/typeahead/typeahead.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/global/plugins/typeahead/bootstrap3-typeahead.min.js') }}"></script>
<script type="text/javascript">
var gentable=null;

/*var fnGetSatuan = function(objData)
{
	var returnValue = null;
	$.ajax({
		    type: 'POST',
		    url: "{{ url('barangmasuk_hibah/changeSatuan') }}",
		    data: objData,
		    async: false,
		    dataType: 'json',
		    success:function(data){
		    	returnValue = data;
		    },
		    error:function(xhr,status,errormessage)
		    {},
		    complete:function(data)
		    {}
  		});
	return returnValue;
}*/


var fnGetPt = function(project_id)
{	
	var strHtml='';
	if(parseInt(project_id) > 0)
	{
		
		strHtml+='<select name="from_pt_id" id="from_pt_id" class="form-control">';
		strHtml+="<option value='0'>Pilih</option>";
		$.get("{{ url('/inventory/barangmasuk_hibah/getPtExist') }}/"+project_id,function(data,status)
		{
			$(data).each(function(i,v){
				strHtml+="<option value='"+v.id+"'>"+v.name+', '+v.code+"</option>";
			});
			strHtml+='</select>';
			$('#addpt').find('input,select').remove().end().append(strHtml);
			
		});
		//$('#addpt').select2();
	}
}

var fnTextPt = function()
{
	$('#mfrom_project_id').val(0);
	var strHtml='';
	strHtml+="<input type='text' id='from_pt_id' name='from_pt_id' class='form-control' />";
	$('#addpt').find('input,select').remove().end().append(strHtml);
}

var _initTablePenerimaan = function () {
		var _renderEdit = function (data, type, row) {
				if (type == 'display') {
					return "<button type='button' class='button-delete btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></button> <button type='button' class='button-add-warehouse btn btn-primary btn-xs'><i class='fa fa-plus'></i></button>";
				}
				return data;
			};

		var arrColumns = [
				{ 'data': 'id'}, //
				{ 'data': 'item'}, //
				{ 'data': 'description' }, //
				{'data': 'price', 'sClass': 'text-right' },
				{'data': 'quantity', 'sClass': 'pull-right' },
				{'data': 'total', 'sClass': 'text-right total'},
				{ 'data': 'satuan' }, //
				
				{ 'data': 'warehouse_id'},
				{ 'data': 'item_satuan_id', 'mRender': _renderEdit}
			];

		_GeneralTable(arrColumns);

		gentable = $('#datatable-details').DataTable(datatableDefaultOptions)
		.on('click', '.button-delete',function (d){
			if (confirm('Hapus item ini ?') == false) {
				return;
			}
			var tr = $(this).closest('tr');
			var row = gentable.row(tr);
			row.remove().draw();
		}).
		on('click','.button-add-warehouse',function()
		{
			var Tparent = $(this).parents('tr');
			var data = gentable.row($(this).parents('tr')).data();
			var priceCurrent = Tparent.find('#price').val();
			data.price = '<input class="text-right pricing"  id="price" name="price" type="text" value="'+priceCurrent+'"><input type="hidden" name="mprice" class="mpricing" />';
			data.price
			gentable.row.add(data).draw();
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
	datatableDefaultOptions.fnDrawCallback = function (oSettings) {
		//show row number
		for (var i = 0, iLen = oSettings.aiDisplay.length; i < iLen; i++) {
			$('td:eq(0)', oSettings.aoData[oSettings.aiDisplay[i]].nTr).html((i + 1) + '.');
		}
	};
}
//document ready function
var tableItems = null;
 $(document).ready(function(){
 	_initTablePenerimaan();
 	

 	 fnSetAutoNumeric('#price');

 	 //datatable item
 	 tableItems = $('#datatable-items').DataTable();

 	 tBodyItems = $('#datatable-items tbody');

 	 tBodyItems.on('click','.item_checkbox',function()
 	 {

 	 	var idx = $(this).prev('input').val();
 	 	var getdata = tableItems.row($(this).parents('tr')).data();
 	 	var qty = $(this).parents('tr').find('input[type=number]').val();
 	 	var id_item = $(this).val();
 	 	var objDataItem ={
 	 					term: id_item
 	 					,_token : $('input[name="_token"]').val()
 	 				};
 	 	
 	 	if($(this).is(':checked'))
 	 	{
 	 		
 	 		var warehouseinput = $('#warehouses').clone().html();

 	 		$.ajax({
 	 			url: "{{url('/inventory/barangmasuk_hibah/changeSatuan')}}",
 	 			type: 'POST',
 	 			data: objDataItem,
 	 			dataType: 'json',
 	 			success: function (data) {
 	 				var elementSatuan = '';
 	 				elementSatuan +='<select name="item_satuan_id" id="item_satuan_id">';
 	 				elementSatuan+='<option value="">Pilih</option>';
 	 				$(data).each(function(i,v)
 	 				{
 	 					elementSatuan+='<option value="'+v.id+'">'+v.name+'</option>';
 	 				});
 	 				elementSatuan+='</select>';
 	 				var tableItem = {
								id:id_item ,
								item: getdata[1],
								description : '<textarea name="description" id="description" style="height: 40px;width: 100px;">'+getdata[1]+'</textarea>'+'<input type="hidden" name="item_id" id="item_id" value="'+id_item+'"/>',
								price : '<input class="text-right pricing"  id="price" name="price" type="text" value="0"><input type="hidden" name="mprice" class="mpricing" />',
								quantity :'<input class="text-right quantity"  id="quantity" name="quantity" style="width:90px;" type="number" min="0" value="'+qty+'" />',
								total:0,
								satuan : elementSatuan,//selectsatuan+'<input type="hidden" name="satuan_item_id" id="satuan_item_id" value="'+satuandata.id+'"/>',
								warehouse_id : warehouseinput,
								item_satuan_id : id_item					
		                  };

		                  	if(idx ==-1)
				 	 		{
				 	 			gentable.row.add(tableItem);
						    }
						    gentable.draw();

 	 			}
 	 		});
 	 	}
 	 	else
 	 	{
 	 		var alldata = gentable.rows().data();
 	 		$(alldata).each(function(i,v){
 	 			if(v.id == id_item)
 	 			{
 	 				gentable.row(i).remove().draw();
 	 			}
 	 		});
 	 	}
 	 }).
 	 on('input','.qty_item_add',function()
 	 {
 	 	var qty = $(this).val();
 	 	var tr = $(this).parents('tr');
 	 	var _iditem = tr.find('input[type=checkbox]').val();
 	 	var alldata = gentable.rows().data();
 	 		$(alldata).each(function(i,v){
 	 			if(v.id == _iditem)
 	 			{
 	 				trBody = $('#datatable-details > tbody > tr:eq('+i+')');
 	 				trBody.find('input[type=number]').val(qty);

 	 			}
 	 		});
 	 });
     
      //autocomplete
	  $('#from_project_id').autocomplete({
            source: function (request, response) {
					$.ajax({
						url: "{{url('/inventory/barangmasuk_hibah/project_autocomplete')}}",
						type: 'POST',
						data: {
								term: $('#from_project_id').val(),
								current_project_id : $('#current_project_id').val(),
								_token : $('input[name="_token"]').val()
							},
						dataType: 'json',
						success: function (data) {
							response($.map(data, function (obj) {
									return {
										label: obj.name,
										value: obj.name+' ,'+obj.code,
										code :obj.code,
										id:obj.id
									}
								}));
							}
						});
					},
			change: function (event, ui) {
						if (ui.item != null) {
							$('#from_project_id').val(ui.item.label+' , '+ui.item.code);
							$('#mfrom_project_id').val(ui.item.id);
							fnGetPt(ui.item.id);
						}
						else
						{
							fnTextPt();
						}
					},
		   select: function (event, ui) {        
			          if (ui.item != null) {
							$('#from_project_id').val(ui.item.label+' , '+ui.item.code);
							$('#mfrom_project_id').val(ui.item.id);
							fnGetPt(ui.item.id);
						}
					else
						{
							fnTextPt();
						}
		          return false;
  			}
		}).data('ui-autocomplete')._renderItem = function (ul, item) {
					//location
			return ($('<li>').append('<a><strong>' + item.label + '</strong>, <strong>'+item.code+'</strong></a>').appendTo(ul));
		};
		

		gentable.on('draw',function()
		{
			$('.pricing').each(function(i,v){
				fnSetAutoNumeric($(this));
			 	fnSetMoney($(this),$(this).val());
			});
			$('.total').each(function(i,v){
				fnSetAutoNumeric($(this));
			 	fnSetMoney($(this),$(this).text());
			});

		});

		sBodyDetails = $('#datatable-details tbody');
		sBodyDetails.on('keyup','.pricing',function(){
			var trParent = $(this).parents('tr');
			var price = $(this).autoNumeric('get');
			var qty = trParent.find('#quantity').val();
			var total = price*qty;
			fnSetMoney(trParent.find('.total'),total);
		})
		.on("input",'.quantity',function()
		{
			var trParent = $(this).parents('tr');
			var qty = $(this).val();
			var price = trParent.find('.pricing').autoNumeric('get');
			var total = price*qty;
			fnSetMoney(trParent.find('.total'),total);
		});

		//on DOM load
		$('body').on('DOMNodeInserted', 'select', function () {
    		$(this).select2();
		});

		$('body').on('DOMNodeInserted', 'input', function () {
    		$('#from_pt_id').select2('destroy');
		});
		//modal

		$('.modal-content').resizable({
		      //alsoResize: ".modal-dialog",
		      minHeight: 300,
		      minWidth: 300
	    });

    	$('.modal-dialog').draggable();

	    $('#modal_satuan').on('show.bs.modal', function() {
		      $(this).find('.modal-body').css({
		        'max-height': '100%'
		      });
	    });

	    $('#item_brg').click(function()
		{
			$('#modal_satuan').modal('show');
		});

		 $('#form_data').submit(function(e){
              e.preventDefault();
              var alldata_send=$(this).serializeArray();

              $('#form_data input').attr("disabled", "disabled");

              $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: alldata_send,
                dataType: 'json',
                beforeSend:function(){
                	alertify.success('Sending ...');
                },
                success:function(data){
                	if(data.return=='1')
                	{
                		window.location.href="{{  url('/inventory/barangmasuk_hibah/index') }}";
                	}
                	else
                	{
                		alertify.error("Warning, Terjadi Kesalahan : anda mungkin belum menambahkan Item ,silahkan periksa data-data anda kembali.");
                	}
                },
                error:function(xhr,status,errormessage)
                {
                	alertify.error("Warning, Data Gagal Disimpan");
                },
                complete:function()
                {
                	$('#form_data input').removeAttr('disabled');
                  	$('.form-group').removeClass('has-success');
                }
              });
          });

		 $('#send-all').click(function(){
			 	  var _alldataItemSend =[];
	              $("#datatable-details > tbody > tr").each(function()
	              {	              		
	              		var warehouse_id_get = $(this).find('#warehouse_id').val();
	              		if(warehouse_id_get != '')
	              		{
	              			var id_barang = $(this).find('#item_id').val();
		              		var int_price = $(this).find('.pricing').autoNumeric('get');
		              		var qty = $(this).find('#quantity').val();
		              		var item_satuan_id = $(this).find('#item_satuan_id').val();
		              		var descriptions = $(this).find('#description').val();

		              		var jsonObj = {
		              			'warehouse_id':warehouse_id_get,
		              			'item_id': id_barang,
		              			'price' : int_price,
		              			'item_satuan_id': item_satuan_id,
		              			'quantity':qty,
		              			'description': descriptions
		              		}
	              			_alldataItemSend.push(jsonObj);

	              		}
	              		else
	              		{
	              			$(this).find('span').show();
	              		}
	              });

              $('#allItemStore').val(JSON.stringify(_alldataItemSend));    
		 });

		 $(document).on('click','input',function()
		 {
		 	$(this).select();
		 });

		 $(document).on('change','.warehouse_item',function()
		 {
		 	if($(this).val()!='')
		 	{
		 		$(this).next('span').hide();
		 	}
		 });

		var sourceEngine = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    remote: {
                          url: '/inventory/getUsers/type_user?q=%QUERY%',
                          wildcard: '%QUERY%'
                      }
                  });

      sourceEngine.initialize();

      var $inputType = $('.typeaHead');

      $inputType.typeahead({
        items : 4,
        source : sourceEngine.ttAdapter(),
        displayText : function(item)
        {
            return item.user_name;
        },
        updater: function(item)
        {
            $('input[name='+$(this)[0].$element.context.id+']').prev().val(item.id);
            //$('#id_pic_giver').val(item.id);
            //console.log($(this)[0].$element.context;
            return item.user_name;
        }
      });


  });
</script>
</body>
</html>