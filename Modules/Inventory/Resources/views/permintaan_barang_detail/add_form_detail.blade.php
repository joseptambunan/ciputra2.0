<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Permintaan Barang</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
          	<ul class="breadcrumb">
                  <li>
                      <a href="{{ url('/inventory/inventory/stock/view_stock') }}">Inventory</a>
                  </li>
                  <li>
                     <a href="{{ url('/inventory/permintaan_barang/index') }}">Permintaan Barang : {{ $permintaan->no }}</a>
                      
                  </li>
                  <li>
                    <a href="{{ url('/inventory/permintaan_barang_detail/index').'?id='.$permintaan->id }}">Detail</a>
                  </li>
                  <li>
                  	<span>Tambah</span>
                  </li>
              </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
			        @include('form.a',[
						'href'=> url('/inventory/permintaan_barang_detail/index')."?id=".$permintaan->id, 
						'caption' => 'Batal' 
					])
					<div class="col-md-3 col-sm-3 col-xs-12" id="clone_butuh_date" style="display: none;">
						<div class="input-group input-medium date datePicker_">
							<input type="text" class="form-control" name='butuh_date' id='butuh_date' required value="<?php echo date('Y-m-d'); ?>">
							<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
						</div>	
					</div>
					<form action="{{ url('/inventory/permintaan_barang_detail/create_all') }}" method="post" class="form-horizontal form-label-left" 
					id="form_data">
						{{ csrf_field() }}
						<input type="hidden" name="allItemStore" id="allItemStore" value="" />
						<input type="hidden" id="permintaanbarang_id" name="permintaanbarang_id" value="{{ $permintaan->id }}" />
						<div class="item form-group">
						    <label class="control-label col-md-4 col-sm-4 col-xs-12">No. Permintaan Barang</label>
						    <div class="col-md-5 col-sm-5 col-xs-12">
						     	<input type='text' id='no' name='no' class='form-control' placeholder='Permintaan Barang No.' value="{{ $permintaan->no }}" readonly="true" />
						    </div>
					  	</div>	 
						<div class="form-group">
							<div class="col-md-6 col-md-offset-3">
								<button id="send-all" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
							</div>
						</div>
					</form>
					<button id="add-item" type="button" class="btn btn-warning"><i class="fa fa-plus"></i> Item</button>
					<table id="datatable-details" class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap">
						
						<thead>
							<tr>
								<th>#</th>
								<th>Item</th>
								<th>Tanggal Dibutuhkan</th>
								<th>Deskripsi</th>
								<th>Qty</th>
								<th>Satuan</th>
								<th></th>
							</tr>
						</thead>
					</table>


<!-- Modal -->
<div class="modal fade" id="modal_satuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pilih Item Barang</h4>
      </div>
      <div class="modal-body">
        <table id="datatable-items" class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap table_master">
			<colgroup>
				<col style="width: 1px;">
				<col>
				<col style="width:120px;">
			</colgroup>
			<thead>
				
				<tr>
					<th></th>
					<th>Kategori</th>
					<th>Item</th>
					<th>Qty</th>
					<th>Satuan</th>
					<th>Tersedia</th>
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
						{{ $value->category->name }}
					</td>
					<td>
						{{ $value->name }}
					</td>
					<td>
						<input type="number" name="qty_item" id="qty_item" class="text-right qty_item_add form-control" min="0" value="0" />
					</td>
					<td id="tdsatuan">
						<select name="allsatuan" id="allsatuan" class="allsatuan">
							<option value="">Pilih</option>
							@foreach($value->satuans as $key => $satuan)
								<option value="{{ $satuan->id }}" data-value="{{ $satuan->konversi }}">{{$satuan->name}}</option>
							@endforeach
						</select>
					</td>
					<td>
						<div class="stock_avaible">{{ is_null($value->stock_avaible) ? $value->stock_afterkonversi :  $value->stock_avaible }}</div> <div class="name_satuan">{{is_null($value->satuan_name_terkecil) ? '-': $value->satuan_name_terkecil}}</div>

						<input type="hidden" id="mstock_avaible" value="{{ is_null($value->stock_avaible) ? $value->stock_afterkonversi :  $value->stock_avaible }}" />
						<input type="hidden" id="msatuan" value="{{is_null($value->satuan_name_terkecil) ? '-': $value->satuan_name_terkecil}}" />
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
<!-- ./wrapper -->

@include("master/footer_table")
@include('pluggins.alertify')
@include('pluggins.datetimepicker_pluggin')
@include('form.datatable_helper')
@include('form.general_form')
<script type="text/javascript">
var gentable=null;
var _initTablePenerimaan = function () {
		var _renderEdit = function (data, type, row) {
				if (type == 'display') {
					return ("<div class='btn-group' role='group'>" +
					"<button class='button-delete btn btn-danger btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='right' title='Hapus'><i class='fa fa-trash-o'></i></button>"+
					"</div>");
				}
				return data;
			};

		var arrColumns = [
				{ 'data': 'id'}, //
				{ 'data': 'item'}, //
				{ 'data': 'butuh_date' }, //
				{ 'data': 'description' }, //
				{'data': 'quantity', 'sClass': 'text-right' },
				{'data':'satuans_item'},
				{ 'data': 'item_satuan_id', 'mRender': _renderEdit }
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
		}).on('change','.allsatuan',function()
		{
			var data = gentable.row($(this).parents('tr')).data();
			console.log(data);
			data.item_satuan_id = $(this).val();

			console.log(data);
		});
}

var _GeneralTable = function (arrColumns) {
	var _coldefs = [];
	datatableDefaultOptions.searching = false;
	datatableDefaultOptions.aoColumns = arrColumns;
	datatableDefaultOptions.columnDefs = _coldefs;
	datatableDefaultOptions.autoWidth = false;
	datatableDefaultOptions.ordering = false;
	datatableDefaultOptions.fnDrawCallback = function (oSettings) {
		//show row number
		for (var i = 0, iLen = oSettings.aiDisplay.length; i < iLen; i++) {
			$('td:eq(0)', oSettings.aoData[oSettings.aiDisplay[i]].nTr).html((i + 1) + '.');
		}
	};
}

var fnCheckBox = function(trParent,item_id)
{
	var item_satuan_id = trParent.find('#allsatuan').val();
	var item_name = trParent.find('td:eq(1)').text().trim();
	var qty = trParent.find('#qty_item').val();
	var butuh_date = $('#clone_butuh_date').clone().html();
	var idx = trParent.find('#rowIdxPenerimaan').val();
	var selectSatuan = trParent.find('#tdsatuan').clone();

	selectSatuan.find('select').find("option[value ='" + item_satuan_id + "']").attr('selected','selected');

	/*selectSatuan.find("option[value = '" + item_satuan_id + "']").attr('selected','selected');
	var selectedHtml = '<select name="allsatuan" id="allsatuan" class="allsatuan">'+selectSatuan.html()+'</select>';*/
	var objAppendTotable = {
		idx : idx,
		objAppend :{
			id: item_id,
			item: item_name,
			butuh_date : butuh_date,
			description:'<textarea name="description" id="description" row="5">'+item_name+'</textarea>',
			quantity : '<input class="text-right" type="number" min="1" style="width:80px;" name="quantity" value="'+qty+'"id="quantity" />',
			satuans_item : selectSatuan.html(),
			item_satuan_id : item_satuan_id
		}
	};

	return objAppendTotable;
}
//document ready function
var number =0;
var tableItems = null;
 $(document).ready(function(){
 	  _initTablePenerimaan();

 	  tableItems = $('#datatable-items').DataTable({
	 	  	scrollY:        "300px",
			scrollCollapse: true,
			paging:         false,
	 	  	columnDefs: [
			            { "visible": false, "targets": 1 }
			          ],
	        "order": [[ 1, 'asc' ]],
			"drawCallback": function ( settings ) {
	            var api = this.api();
	            var rows = api.rows( {page:'current'} ).nodes();
	            var last=null;
	            api.column(1, {page:'current'} ).data().each( function ( group, i ) {
	              if ( last !== group ) {
	                $(rows).eq( i ).before(
	                  '<tr class="group success"><td><input type="checkbox" class="parent_checkbox" /></td><td colspan="4" class="text-left"><strong>'+group+'</strong></td></tr>'
	                );
	               /// $(rows)
	                last = group;
	              }
	            });  
	        },
	        "initComplete":function(settings, json)
	        {
	        	fnSetAutoNumeric('.stock_avaible');
	        }
 	  });
      var tBody = $('#datatable-items tbody');

      tBody.on('click','.item_checkbox',function()
      {
      		
      		var item_id = $(this).val();
      		if($(this).is(':checked'))
      		{
      			var trParent = $(this).parents('tr');
      			var objAppendTotable = fnCheckBox(trParent,item_id);
      			
      			if(objAppendTotable.idx == -1)
      			{
      				gentable.row.add(objAppendTotable.objAppend);
      			}

      			gentable.draw();
      			
      		}
      		else
      		{
      			var alldata = gentable.rows().data();
	 	 		$(alldata).each(function(i,v){
	 	 			if(v.id == item_id)
	 	 			{
	 	 				gentable.row(i).remove().draw();
	 	 			}
	 	 		});
      		}
      }).
      on('input','.qty_item_add',function()
 	 {
 	 	var tr = $(this).parents('tr');
 	 	var qty = parseInt($(this).val());
 	 	qty = qty || 0;
 	 	var qty_tersedia = tr.find('#mstock_avaible').val();
 	 	var konversi = tr.find('#allsatuan option:selected').attr('data-value');
 	 	konversi = konversi || 0;
 	 	var hasil_konversi = parseFloat(qty_tersedia/parseInt(konversi));
 	 	tr.find('input[type=checkbox]').removeAttr('disabled');
 	 	if(qty <= hasil_konversi)
 	 	{
 	 		
 	 		var _iditem = tr.find('input[type=checkbox]').val();

	 	 	var alldata = gentable.rows().data();
	 	 		$(alldata).each(function(i,v){
	 	 			if(v.id == _iditem)
	 	 			{
	 	 				trBody = $('#datatable-details > tbody > tr:eq('+i+')');
	 	 				trBody.find('input[type=number]').val(qty);

	 	 			}
	 	 		});
	 	 }
	 	 else
	 	 {
	 	 	tr.find('input[type=checkbox]').attr('disabled',true);
	 	 	alertify.error('Warning : Stok yang tersedia tidak mencukupi');
	 	 }

 	 	
 	 }).
      on('click','.parent_checkbox',function()
      {
      	 var groupParent = $(this).parents('.group');
      	 if($(this).is(':checked'))
      	 {
      	 	 groupParent.nextUntil('.group').each(function()
	      	 {
	      	 	$(this).find('input[type="checkbox"]').prop('checked',true);
	      	 	var id_item = $(this).find('input[type="checkbox"]').val();
	      	 	var objItems = fnCheckBox($(this),id_item);
	      	 	if(objItems.idx == -1)
      			{
      				gentable.row.add(objItems.objAppend);
      			}

      			gentable.draw();
	      	 });
      	 }
      	 else
      	 {
      	 	groupParent.nextUntil('.group').each(function()
	      	 {
	      	 	$(this).find('input[type="checkbox"]').prop('checked',false);
	      	 	var id_item = $(this).find('input[type="checkbox"]').val();
	      	 	var alldata = gentable.rows().data();
	 	 		$(alldata).each(function(i,v){
	 	 			if(v.id == id_item)
	 	 			{
	 	 				gentable.row(i).remove().draw();
	 	 			}
	 	 		});
	      	 });
      	 }
      	 
      }).
      on('change','.allsatuan',function()
      {
      		var trParent = $(this).parents('tr');
      		var qty_minta = parseInt(trParent.find('.qty_item_add').val());
      		qty_minta = qty_minta || 0;
      		var qty_tersedia = trParent.find('#mstock_avaible').val();
      		var konversi = $(this).find('option:selected').attr('data-value');
      		konversi = konversi || 0;

      		var satuan_name = $(this).find('option:selected').text();
      		

      		var hasil_konversi = parseFloat(qty_tersedia/parseInt(konversi));
      		var objStock = trParent.find('.stock_avaible');
      		if(satuan_name == 'Pilih')
      		{
      			satuan_name = trParent.find('#msatuan').val();
      			hasil_konversi = trParent.find('#mstock_avaible').val();
      		}
      		trParent.find('.name_satuan').text('').text(satuan_name);
      		fnSetMoney(objStock,hasil_konversi);
      		if(qty_minta <= hasil_konversi)
      		{
      			trParent.find('input[type=checkbox]').removeAttr('disabled');
      		}
      		else
      		{
      			trParent.find('input[type=checkbox]').attr('disabled',true);
      		}
      });


      $('#send-all').click(function(){
		 	  var _alldataItemSend =[];
              $("#datatable-details > tbody > tr").each(function(i,v)
              {
              		if($(this).find('td').length >1)
              		{
              			var newdata = gentable.row($(this)).data();
              			var item_id_val =newdata.id;
	              		var date_butuh = $(this).find('#butuh_date').val();
	              		var description = $(this).find('#description').val();
	              		var qty_send = $(this).find("#quantity").val();
	              		var satuan_id_val = newdata.item_satuan_id;
	              		var objSend = {
	              			id_item : item_id_val,
	              			butuh_date:date_butuh,
	              			description:description,
	              			qty :qty_send,
	              			satuan_id : satuan_id_val
	              		}
	              		_alldataItemSend.push(objSend);
              		}
              		
              });

              $('#allItemStore').val(JSON.stringify(_alldataItemSend));    
		 });

       $('#form_data').submit(function(e){
              e.preventDefault();
              var alldata_send=$(this).serializeArray();

              $('#form_data input').attr("disabled", "disabled");
              var strinfo = '';
              $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: alldata_send,
                dataType: 'json',
                beforeSend:function(){
                	//alertify.error('sending ...',3);
                	alertify.success('sending ...');
                },
                success:function(data){
                	if(data.stat=='1')
                	{
                		strinfo +='<ul>';
	                	$(data.informations).each(function(i,v){
	                		strinfo+='<li>'+v.item_name+' = '+v.quantity+'</li>';
	                	});
	                	strinfo +='</ul>';

	                	alertify.success("Success, Data berhasil disimpan "+"berikut ini informasi stock yang anda minta" +strinfo);
	                	
                		window.location.href="{{ url('/inventory/permintaan_barang_detail/index')}}"+ "?id="+data.id;
                	}
                	else
                	{
						alertify.danger('Warning : Anda belum melengkapi data, silahkan lengkapi data - data anda');
                	}
                },
                error:function(xhr,status,errormessage)
                {},
                complete:function()
                {
                	$('#form_data input').removeAttr('disabled');
                  	$('.form-group').removeClass('has-success');
                }
              });
        });


      $('.modal-content').resizable({
		      //alsoResize: ".modal-dialog",
		      minHeight: 600,
		      minWidth: 600
	    });

    	$('.modal-dialog').draggable();

	    $('#modal_satuan').on('show.bs.modal', function() {
		      $(this).find('.modal-body').css({
		        'max-height': '100%'
		      });
	    });

      $('#add-item').click(function()
      {
      	$('#modal_satuan').modal('show');
      });


      gentable.on('draw',function()
	 {
	 	$('.datePicker_').datetimepicker({
	 		format:'YYYY-MM-DD',
	 		allowInputToggle: true
	 	});
	 });

      tableItems.on('draw',function()
      {
      	fnSetAutoNumeric('.stock_avaible');
      });
  });
</script>
</body>
</html>
