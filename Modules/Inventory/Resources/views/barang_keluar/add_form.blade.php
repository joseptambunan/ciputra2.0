<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
      <h1>{{ $project->name }}</h1>
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
			                <a href="{{ url('/inventory/permintaan_barang/index') }}">Permintaan Barang : {{ $permintaanresults[1]}}</a>
			            </li>
			            <li>
			            	<a href="{{ url('/inventory/barang_keluar/index').'?id='.$permintaanresults[0] }}">Barang Keluar</a>
			            </li>
			            <li>
			            	<span>Tambah</span>
			            </li>
			        </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
              	<strong>Tambah Barang Keluar</strong>
              	<hr/>
				<form action="{{ url('/inventory/barang_keluar/create') }}" method="post" class="form-horizontal form-label-left" id="form_data">
					<div class="item form-group">
					    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nomor Permintaan</label>
					    <div class="col-md-7 col-sm-7 col-xs-12">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="barangkeluarid" id="barangkeluarid" />
					    	<input type="hidden" name="permintaanbarang_id" id="permintaanbarang_id" value="{{ $permintaanresults[0]}}" />
					    	<input type='text' id='permintaan_no' name='permintaan_no' class='form-control' placeholder='Project Name' value="{{ $permintaanresults[1]}}" readonly="true" />

					    </div>
				  	</div>

				  	<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal</label>
						<div class="col-md-7 col-sm-7 col-xs-12">
							<div class="input-group input-medium date datePicker_">
								<input type="text" class="form-control" name='date' id='date' required value="<?php echo date('Y-m-d'); ?>">
								<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
							</div>	
						</div>
					</div>

					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi</label>
						<div class="col-md-7 col-sm-7 col-xs-12">
							<textarea class='form-control' name="description" id="description" cols="45" rows="5" placeholder="Description"></textarea>
						</div>
					</div>

					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-6 col-md-offset-3">
							<button id="send" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
							<button id="reset" type="reset" class="btn btn-warning"><i class="fa fa-times"></i> Reset</button>
							@include('form.a',[
								'href'=>url('/inventory/permintaan_barang/index'), 
								'caption' => 'kembali' 
							])
						</div>
					</div>
				</form>
				
</div>
<div id="details" style="display:none;">
					<table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap table_master" id="table_master">
							<thead>
								<tr>
									<th>Item</th>
									<th>Qty</th>
									<th>Gudang</th>
									<th>Qty Tersedia</th>
									<th>Saldo</th>
									<th>Satuan</th>
								</tr>
							</thead>
						</table>
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

@include('pluggins.alertify')

<script type="text/javascript">

	var fnInsertItem = function(_data,url,parent)
	{
		$.ajax({
				type:'POST',
				url : url,
				data: {'data':JSON.stringify(_data),_token : $('input[name=_token]').val()},
				dataType:'json',
				beforeSend:function(){
					alertify.success('sending ...');
				},
				success:function(data)
				{
					if(data)
					{
						alertify.success('success ');
						parent.ajax.reload();


					}
				},
				complete:function()
				{}
			});
	}

	var fnRenderQty = function(data, type, row)
	{
		var strHtml ='';
		if (type == 'display') {
			strHtml +='<input type="number" class="text-right" id="quantity" min="1" name="quantity" max="'+row.total_stock_after_konversi+'" value="'+0+'" />'+row.satuan_name;
		}
		return strHtml;
	}

	var fnRenderWareHouse = function(data, type, row)
	{
		var html ='';
		if (type == 'display') {
			html +='<div class="checkbox"><label>';
			html+='<input class="warehouse_chkbx" type="checkbox" name="warehouse_id" id="warehouse_id" value="'+row.warehouse_id+'" />'+data+'</label></div>';
		}
		return html;
	}

	var fnRenderItemName = function(data, type, row)
	{
		var str = '';
		if(type=='display')
		{
			str+='<input type="hidden" name="qty" id="qty_master" value="'+row.quantity+'" />'+data;
		}
		return str;
	}

	var gentable= null;

	$(document).ready(function(){

		var permintaanbarang_id = $('#permintaanbarang_id').val();
		gentable = $('#table_master').DataTable({
			"lengthChange": false,
			processing: true,
			ajax: "{{ url('/inventory/barang_keluar_detail/getDataTables') }}/"+permintaanbarang_id,
			columns:[
                 { data: 'item_name',name: 'item_name',"bSortable": false},
                 { data: 'total_minta',name: 'total_minta',render:fnRenderQty,"className":"text-right","bSortable": false},
				 { data: 'gudang',name: 'gudang',render:fnRenderWareHouse,"className":"text-center","bSortable": false},

                 { data: 'total_stock_after_konversi',name: 'total_stock_after_konversi',"bSortable": false},
				 { data: 'total_stock_after_konversi',name: 'total_stock_after_konversi',"className":"text-center saldo","bSortable": false},
				 {data: 'satuan_name',name: 'satuan_name',"className":"text-center saldo","bSortable": false}
          ],
			"columnDefs": [
            	{ "visible": false, "targets": 0 }
        	],
        	"order": [[ 0, 'asc' ]],
        	"displayLength": 25,
	        "drawCallback": function ( settings ) {
	            var api = this.api();
	            var rows = api.rows( {page:'current'} ).nodes();
	            var last=null;
	            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
	                if ( last !== group ) {
	                    $(rows).eq( i ).before(
	                        '<tr class="group success"><td colspan="5" style="text-align:left;padding:10px;"><strong>'+group+' = '+api.column(1).data()[0]+' '+api.column(5).data()[0]+'</strong></td></tr>'
	                    );
	 
	                    last = group;
	                }
	            });
	        },
	        "initComplete": function(settings, json) {
	        	
		  }
		});

		var tBody = $('#table_master tbody');
		tBody.on('click','.btn-save',function(){
			
			var TParent = $(this).parents('tr');
			var data = gentable.row($(this).parents('tr')).data();
			if(TParent.find('#warehouse_id').is(':checked'))
			{
				var barangkeluar_id = $('#barangkeluarid').val();
				var permintaanbarang_detail_id = data.permintaanbarang_detail_id;
				var item_id = data.item_id;
				var warehouse_id =  data.warehouse_id;
				var quantity = TParent.find('#quantity').val();
				///var price = data.price;

				var _datasend = {
								
								'barangkeluar_id' :barangkeluar_id,
								'permintaanbarang_detail_id' :permintaanbarang_detail_id,
								'item_id' : item_id,
								'item_satuan_id':data.item_satuan_id,
								'warehouse_id' : warehouse_id,
								'quantity' :quantity ,
								//'price' :price
							};

				objSend.push(_datasend);
				fnInsertItem(objSend,_url,gentable);
			}
			else
			{
				alertify.danger('silahkan pilih gudang');
			}
		}).on('click','.warehouse_chkbx',function(){
			
			var trParent = $(this).parents('tr');
			var data = gentable.row($(this).parents('tr')).data();
			if($(this).is(':checked'))
			{
				var QtyOut = parseInt(trParent.find('#quantity').val());
				if(QtyOut <= data.total_minta && QtyOut !=0)
				{
					var _url = "{!! url('/inventory/barang_keluar_detail/create') !!}";
					var objSend = [];
					var Qtytersedia = parseInt(data.total_stock_after_konversi);
					var selisih = Qtytersedia - QtyOut ;
					trParent.find('.saldo').text('').text(selisih);

					var barangkeluar_id = $('#barangkeluarid').val();
					var permintaanbarang_detail_id = data.permintaan_details_id;
					var item_id = data.item_id;
					var warehouse_id =  data.warehouse_id;
					var quantity = trParent.find('#quantity').val();
					///var price = data.price;

					var _datasend = {
									
									'barangkeluar_id' :barangkeluar_id,
									'permintaanbarang_detail_id' :permintaanbarang_detail_id,
									'item_id' : item_id,
									'item_satuan_id':data.item_satuan_id,
									'warehouse_id' : warehouse_id,
									'quantity' :quantity ,
									//'price' :price
								};

					objSend.push(_datasend);
					fnInsertItem(objSend,_url,gentable);
				}
				else
				{
					alertify.danger('Kuantiti salah');
					$(this).attr('checked',false);
				}
				
			}
			else
			{
				var Qtytersedia = parseInt(data.quantity_tersedia);
				trParent.find('.saldo').text('').text(Qtytersedia);
			}
		}).on('input','.qty_item',function(){
			var trParent = $(this).parents('tr');
			var data = gentable.row($(this).parents('tr')).data();
			var Qtytersedia = parseInt(data.quantity_tersedia);

			var thisVal = parseInt($(this).val());

			var selisih = Qtytersedia - thisVal;
			trParent.find('.saldo').text('').text(selisih);
		});


		$('#form_data').submit(function(e){
			e.preventDefault();
			var _data = $(this).serialize();
			var _url = $(this).attr('action');

              $.ajax({
                type: 'POST',
                url: _url,
                data: _data,
                dataType: 'json',
                beforeSend:function(){
                	alertify.success('Sending ...');
                },
                success:function(data){
                	if(data.stat)
                	{
                		$('#details').show();
                		$('#barangkeluarid').val(data.id);
                		$('#send').remove();
                		$('#reset').remove();
                		$('#description').attr('readonly',true);
                	}
                },
                error:function(xhr,status,errormessage)
                {},
                complete:function()
                {}
              });
		});

		gentable.on('draw.dt',function()
		{
			var checkCount = gentable.data().count();
			if(checkCount <= 0)
			{
				alertify.success('Anda telah Menambahkan Seluru data ...');
				window.location.href="{{ url('/inventory/barang_keluar/index') }}"+"?id="+parseInt($('#permintaanbarang_id').val());
			}
		});

		$('body').tooltip({
          selector: '[rel=tooltip]'
        });
		
	});

</script>

</body>
</html>