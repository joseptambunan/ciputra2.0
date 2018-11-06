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
	                <a href="{{ url('/inventory/pengembalian_barang/index') }}">Pengembalian Barang</a>
	            </li>
	            <li>
	                <span>Tambah</span>
	            </li>
	        </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
              	<strong>Pengembalian Barang</strong>
              	@include('form.a',[
					'href'=> url('/inventory/pengembalian_barang/index'),
					'class'=>'pull-right',
					'caption' => 'Kembali' 
				])
<hr/>
<form action="{{ url('/inventory/pengembalian_barang/check_no_permintaan') }}" method="post" class="form-horizontal form-label-left" id="form-check" autocomplete="off">

	{{ csrf_field() }}
	<div class="item form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12">Nomor Ref. Permintaan 
		</label>
		<div class="col-md-7 col-sm-7 col-xs-12">
			<div class="input-group">
				<input type="text" name="nomor_permintaan_barang" id="nomor_permintaan_barang" class="form-control" />
				<div class="input-group-addon">
					<button id="check" type="submit" class="btn btn-danger btn-xs"><i class="fa fa-check"></i> Ok</button>
				</div>
			</div>
		</div>
	</div>

	<div id="selectbox" style="display: none;">
		<select name="remarks" id="remarks">
			@foreach($remarks as $key => $value)
				<option value="{{ $value->id }}">{{ $value->name }}</option>
			@endforeach
		</select>
	</div>
	<div id="warehousebox" style="display: none;">
		<select name="warehouse_idbox" id="warehouse_idbox" class="warehouse_id">
			@foreach($warehouses as $key => $value)
				<option value="{{ $value->id }}">{{ $value->name }}</option>
			@endforeach
		</select>
	</div>

	<!--div class="item form-group">
		<label class="control-label col-md-3 col-sm-3 col-xs-12">Nomor Barang Keluar 
		</label>
		<div class="col-md-7 col-sm-7 col-xs-12">
			<div class="input-group">
				<input type="text" name="nomor_barang_keluar" id="nomor_barang_keluar" class="form-control" />
				<div class="input-group-addon">
					<button id="check" type="submit" class="btn btn-danger btn-xs"><i class="fa fa-check"></i> Check</button>
				</div>
			</div>
		</div>
	</div-->
</form>

<form action="{{ url('/inventory/pengembalian_barang/store') }}" method="post" class="form-horizontal form-label-left" id="form_master">
	{{ csrf_field() }}
	<input type="hidden" name="barangkeluar_id" id="barangkeluar_id">
	<input type="hidden" name="department_id" id="department_id" />
	<input type="hidden" name="allItemStore" id="allItemStore" />
	<div class="ln_solid"></div>
	<div class="form-group">
		<div class="col-md-6 col-md-offset-3">
			<button id="send" type="submit" disabled="disabled" class="btn btn-success">Simpan</button>
			<button id="hide" type="reset" class="btn btn-success">Batal</button>
		</div>
	</div>

</form>


<!--table -->
<table id="datatable_permintaan" class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap table_master">
	<thead>
		<tr>
			<th>#</th>
			<th class="text-center">Nomor Ref.</th>
			<th class="text-center">Tanggal</th>
			<th class="text-center">Desc</th>
			<th></th>
		</tr>
	</thead>
</table>

<!--table -->
<table id="datatable-details" class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap table_master">
	<thead>
		<tr>
			<th class="text-center">#</th>
			<th class="text-center">Item</th>
			<th class="text-center">Qty Pinjam</th>
			<th class="text-center">Qty Kembali</th>
			<th class="text-center">Selisih</th>
			<th class="text-center">Sudah Kembali</th>
			<th class="text-center">Satuan</th>
			<th class="text-center">Warehouse</th>
			<th class="text-center">Keterangan</th>
			<th></th>
		</tr>
	</thead>
</table>
<!-- endof table -->
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
@include('form.datatable_helper')
@include('pluggins.alertify')
<script type="text/javascript">
var gentable_permintaan = null;
var gentable=null;
var _initTableBarangKeluar = function () {
		var _renderPermintaan = function (data, type, row) {
				if (type == 'display') {
					return ('<div class="checkbox"><label><input type="checkbox" class="checkBarangKeluar"></label></div>');
				}
				return data;
			};

		var permintaanColumns = [
				{'data':'id'},
				{ 'data': 'nomor_barang_keluar'}, //
				{ 'data': 'date'},
				{'data': 'desc'},
				{ 'data': 'barangkeluar_id', 'mRender': _renderPermintaan, 'sClass': 'text-center' }
			];

		_GeneralTable(permintaanColumns);

		gentable_permintaan = $('#datatable_permintaan').DataTable(datatableDefaultOptions)
		.on('click', '.button-delete',function (d){
			if (confirm('Hapus item ini ?') == false) {
				return;
			}
			var tr = $(this).closest('tr');
			var row = gentable_permintaan.row(tr);
			row.remove().draw();
		});
}

var _initTablePenerimaan = function () {
		var _renderEdit = function (data, type, row) {
				if (type == 'display') {
					return ("<div class='btn-group' role='group'>" +
					"<button class='button-delete btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></button>"+
					"</div>");
				}
				return data;
			};

		var arrColumns = [
				{ 'data': 'id'}, //
				{ 'data': 'item'},
				{'data': 'qty_pinjam', 'sClass': 'text-right qty_pinjam' },
				{'data': 'qty_kembali', 'sClass': 'text-right qty_kembali' },
				{'data': 'selisih', 'sClass': 'text-right selisih'},
				{'data': 'sudah_kembali', 'sClass': 'text-right sudah_kembali'},
				{'data': 'satuan_name'},
				{'data': 'warehouse'},
				{'data':'remarks'},
				{ 'data': 'item_satuan_id', 'mRender': _renderEdit, 'sClass': 'text-center' }
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
		});
}

var _GeneralTable = function (arrColumns) {
	datatableDefaultOptions.searching = false;
	datatableDefaultOptions.aoColumns = arrColumns;
	datatableDefaultOptions.autoWidth = false;
	datatableDefaultOptions.ordering = false;
	datatableDefaultOptions.fnDrawCallback = function (oSettings) {
		//show row number
		for (var i = 0, iLen = oSettings.aiDisplay.length; i < iLen; i++) {
			$('td:eq(0)', oSettings.aoData[oSettings.aiDisplay[i]].nTr).html((i + 1) + '.');
		}
	};
}

var fnCheckNoBarangKeluar = function (url,data)
{
	$.ajax({
	  		type: 'POST',
	        url: url,
	        data: data,
	        dataType: 'json',
	        beforeSend:function(){
	        	//code here
	        	alertify.success('Checking ...');
	        },
	        success:fnSuccessCallBack,
	        error:function(xhr,status,errormessage)
	        {
	        	alertify.error("Warning :Terjadi Kesalahan "+xhr.statusText);
	        }
  		});
}

var fnCheckPermintaanBarang = function(url,data)
{
	$.ajax({
	  		type: 'POST',
	        url: url,
	        data: data,
	        dataType: 'json',
	        beforeSend:function(){
	        	//code here
	        	alertify.success('Checking ...');
	        },
	        success:fnSuccessNoPermintaan,
	        error:function(xhr,status,errormessage)
	        {
	        	alertify.error("Warning : Terjadi Kesalahan "+xhr.statusText);
	        }
  		});
}

var fnSuccessNoPermintaan = function(get)
{
	$('#department_id').val(get.department_id);
	if(get.data.length > 0)
	{
		$(get.data).each(function(i,v){
			var items = {
				'id':v.barangkeluar_id,
				'nomor_barang_keluar':v.no_barangkeluar,
				'date':v.date,
				'desc':v.desc,
				'barangkeluar_id':v.barangkeluar_id
			}
				gentable_permintaan.row.add(items);
				gentable_permintaan.draw();
		});
	}
	else
	{
		alertify.error("Warning Data Tidak Ditemukan");
	}
	
}

var fnSuccessCallBack = function(data)
{
	var remarkOption = $('#selectbox').clone().html();
	
	if(data.stat)
	{
		$('#barangkeluar_id').val(data.id);
			alertify.success("Success Data Ditemukan sebanyak = " +data.results.length);
		$('#send').removeAttr('disabled');
		$(data.results).each(function(i,v){
			var warehouseOption = $('#warehousebox').clone();
			warehouseOption.find('option[value="'+v.warehouse_id+'"]').attr('selected',true);
			if(v.awalan)
			{
				var items = {
					'id':v.item_id,
					'item':v.item_name,
					'qty_pinjam':v.quantity_pinjam,
					'qty_kembali':'<input class="numinput" type="number" max="'+v.quantity_kembali+'" name="qty_kembali" id="qty_kembali" min="0" value="'+v.quantity_kembali+'" />',
					'selisih':0,
					'sudah_kembali':0,
					'satuan_name':v.satuan_name,
					'warehouse':warehouseOption.html(),
					'remarks':remarkOption,
					'item_satuan_id':v.item_satuan_id
				}
				gentable.row.add(items);
				gentable.draw();
			}
			else
			{
				if(parseInt(v.quantity_pinjam) != parseInt(v.quantity_kembali))
				{
					var items = {
						'id':v.item_id,
						'item':v.item_name,
						'qty_pinjam':v.quantity_pinjam,
						'qty_kembali':'<input class="numinput" type="number" max="'+parseInt(v.quantity_pinjam-v.quantity_kembali)+'" name="qty_kembali" id="qty_kembali" min="0" value="'+parseInt(v.quantity_pinjam-v.quantity_kembali)+'" />',
						'selisih':v.quantity_kembali,
						'sudah_kembali':v.quantity_kembali,
						'satuan_name':v.satuan_name,
						'warehouse':warehouseOption.html(),
						'remarks':remarkOption,
						'item_satuan_id':v.item_satuan_id
					}
					gentable.row.add(items);
					gentable.draw();
				}
				else
				{
					alertify.success('Data Telah ditambahkan semua...');
				}
			}
			
			
		});
	}
	else
	{
		if(parseInt(data.id) > 0)
		{
			alertify.success("Warning Data Sudah disimpan");
		}
		else
		{
			alertify.error("Warning Data Tidak Ditemukan");
		}
		$('#barangkeluar_id').val('');
		$('#send').attr('disabled',true);
		$('#allItemStore').val('');
		gentable.clear().draw();
	}
	
}

 $(document).ready(function(){
 	_initTablePenerimaan();
 	_initTableBarangKeluar();

 	$('#form-check').submit(function(e){
 		e.preventDefault();
 		fnCheckPermintaanBarang($(this).attr('action'),$(this).serialize());
 		//
 	});

 	$('#send').click(function()
 	{
 		var _alldataSend = [];
 		$("#datatable-details > tbody > tr").each(function(i,v)
 		{
 			gentable.row(i).qty_pinjam;
 			var objSend = {
 				barangkeluar_id : $('#barangkeluar_id').val(),
 				department_id : $('#department_id').val(),
 				item_id : gentable.row(i).data().id,
 				quantity_pinjam : gentable.row(i).data().qty_pinjam,
 				quantity_kembali : $(this).find('#qty_kembali').val(),
 				warehouse_id:$(this).find('#warehouse_idbox').val(),
 				remarks : $(this).find('#remarks option:selected').val(),
 				item_satuan_id : gentable.row(i).data().item_satuan_id
 			}
 			_alldataSend.push(objSend);
 		});
 		$('#allItemStore').val(JSON.stringify(_alldataSend)); 
 	});

 	$('#form_master').submit(function(e)
 	{ 
 		  e.preventDefault();

 		  var alldata_send=$(this).serializeArray();

      	  $('#form_master input').attr("disabled", "disabled");

	      $.ajax({
	        type: 'POST',
	        url: $(this).attr('action'),
	        data: alldata_send,
	        dataType: 'json',
	        beforeSend:function(){
	        	alertify.success('Sending ...');
	        },
	        success:function(data){
	        	if(data.stat)
	        	{
	        		window.location.href = "{{ url('/inventory/pengembalian_barang/index') }}";
	        	}
	        	else
	        	{
	        		alertify.error("Warning Terjadi Kesalahan :"+data.errMsg);
	        	}
	        },
	        error:function(xhr,status,errormessage)
	        {
	        	alertify.error("Warning Terjadi Kesalahan : Salah! Harus Refrensi No Permintaan barang.");
	        },
	        complete:function()
	        {
	        	$('#form_master input').removeAttr('disabled');
	          	$('.form-group').removeClass('has-success');
	        }
	      });


 	});

 	var tbody = $('#datatable-details tbody');

 	tbody.on('input','.numinput',function()
 	{
 		var TParent = $(this).parents('tr');
 		var qty_pinjam = parseInt(TParent.find('td:eq(2)').text());

 		var selisih = qty_pinjam - parseInt($(this).val());

 		TParent.find('td:eq(4)').text(selisih);
 	}).
 	on('click','.warehouse_id',function()
 	{
 		//$(this).find('option').removeAttr('selected');
 	});

 	var sBody = $('#datatable_permintaan tbody');

 	sBody.on('click','.checkBarangKeluar',function(){
 		if($(this).is(':checked'))
 		{
 			var data = gentable_permintaan.row($(this).parents('tr')).data();
 			var url = "{{ url('/inventory/pengembalian_barang/check') }}";
 			fnCheckNoBarangKeluar(url,{id:data.id,_token :$('input[name=_token]').val()});
 		}
 		else
 		{
 			var tr = $(this).closest('tr');
			var row = gentable_permintaan.row(tr);
			row.remove().draw();
			gentable.clear().draw();
 		}
 	});


 	$(document).on('click','input',function()
	 {
	 	$(this).select();
	 });
  });
</script>