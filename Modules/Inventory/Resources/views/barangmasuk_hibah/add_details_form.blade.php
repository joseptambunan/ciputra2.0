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
	                <a href="{{ url('/inventory/inventory/stock/view_stock') }}">Inventory</a>
	            </li>
	            <li>
	                <a href="{{ url('/inventory/barangmasuk_hibah/index') }}">Barang Masuk : {{ $BarangMasukHibah->no }}</a>
	            </li>
	            <li>
	                <span>Tambah Detail</span>
	            </li>
	        </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
              	@include('form.a',[
					'href'=> url('/inventory/barangmasuk_hibah/index'), 
					'caption' => ' Kembali' 
				])
				<hr/>

				<div class="panel panel-success">
		<div class="panel-heading">
		</div>
		<div class="panel-body">
			<div class="col-lg-4 col-md-4 col-xs-12">
				<dl>
				  <dt>Nomor Barang Masuk</dt>
				  <dd>{{ $BarangMasukHibah->no }}</dd>
				  <dt>Tanggal</dt>
				  <dd>{{ date('d-m-Y',strtotime($BarangMasukHibah->tanggal_hibah)) }}</dd>
				  
				  <dt>Total Item</dt>
				  <dd>{{ $BarangMasukHibah->details->where('status',1)->sum('quantity_acuan') }}</dd>
				  
				</dl>
				
			</div>
			<div class="col-lg-4 col-md-4 col-xs-12">
					<dl>
					  <dt>Dari</dt>
					  <dd>{{ is_null($BarangMasukHibah->from_project) ? $BarangMasukHibah->from_project_id : $BarangMasukHibah->from_project->name }}</dd>
					  <dt>Dari PT</dt>
					  <dd>{{ is_null($BarangMasukHibah->from_pt) ? $BarangMasukHibah->from_pt_id : $BarangMasukHibah->from_pt->name }}</dd>
					  <dt>No Refrensi</dt>
					  <dd>{{ $BarangMasukHibah->no_refrensi or '-' }}</dd>
					</dl>
					
			</div>
			<div class="col-lg-4 col-md-4 col-xs-12">
					<dl>
					  <dt>Kepada</dt>
					  <dd>{{ $BarangMasukHibah->to_project->name }}</dd>
					  <dt>Dari PT</dt>
					  <dd>{{ $BarangMasukHibah->to_pt->name or '-' }}</dd>
					  <dt>Description</dt>
					  <dd>{{ $BarangMasukHibah->description or '-' }}</dd>
					</dl>
			</div>
		</div>
	</div>

	<div id="frm" style="display: none;">
<form action="{{ url('/inventory/barangmasuk_hibah/updateQuantity') }}" method="post" class="form-horizontal form-label-left" id="form_data_details">
		<div class="col-lg-6 col-md-6 col-xs-12">
			{{ csrf_field() }}
			<input type="hidden" name="barangmasuk_hibah_id" id="barangmasuk_hibah_id" value="{{ $BarangMasukHibah->id}}" />
			<input type="hidden" name="id" id="id" value="0" /> 
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Item Barang  
				</label>
				<div class="col-md-7 col-sm-7 col-xs-12">
					<input type="text" name="item_barang" id="item_barang" class="form-control" readonly="true" />
					<input type="hidden" name="item_id" id="item_id">
				</div>
			</div>

			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Satuan Barang  
				</label>
				<div class="col-md-7 col-sm-7 col-xs-12">
					<input type="text" name="satuan_barang" id="satuan_barang" class="form-control" readonly="true" />
				</div>
			</div>

			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Quantity Terima
				</label>
				<div class="col-md-5 col-sm-5 col-xs-12">
					<div class="input-group">
						<input class="form-control col-md-7 col-xs-12"  id="quantity" name="quantity" type="number" min="0" />
						<div class="input-group-addon changeSatuan">Satuan</div>
					</div>	
				</div>
			</div>

			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Quantity Reject
				</label>
				<div class="col-md-5 col-sm-5 col-xs-12">
					<div class="input-group">
						<input class="form-control col-md-7 col-xs-12"  id="quantity_reject" name="quantity_reject" type="number" min="0" />
						<div class="input-group-addon changeSatuan">Satuan</div>
					</div>	
				</div>
			</div>

		</div>
		<div class="col-lg-6 col-md-6 col-xs-12">
			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Est. Price  
				</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
					<div class="input-group">
					<input class="form-control col-md-7 col-xs-12"  id="price" name="price" type="text">
					<input id="mprice" name="mprice" type="hidden">
					<div class="input-group-addon">/</div>
					<div class="input-group-addon changeSatuan">Satuan</div>
					</div>	
				</div>
			</div>

			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Gudang  
				</label>
				<div class="col-md-7 col-sm-7 col-xs-12">
					<input type="hidden" name="warehouse_id" id="warehouse_id" />
					<input type="text" name="warehouse_name" id="warehouse_name" class="form-control" readonly="true" />
				</div>
			</div>

			<div class="item form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi 
				</label>
				<div class="col-md-7 col-sm-7 col-xs-12">
					<textarea name="description" id="description" style="height: 100px;width: 330px;"></textarea>
				</div>
			</div>
		</div>
		<div class="ln_solid"></div>
		<div class="form-group">
			<div class="col-md-6 col-md-offset-3">
				<button id="send" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Perubahan</button>
				<button id="hide" type="reset" class="btn btn-success">Reset</button>
			</div>
		</div>
	</form>
</div>

<button id="delivery" type="button" class="btn btn-warning">Deliver</button>
<!--table -->
<table id="datatable-details" class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap">
	<thead>
		<tr>
			<th></th>
			<th>#</th>
			<th>Item</th>
			<th>Qty Acuan</th>
			<th>Qty Terima</th>
			<th>Reject</th>
			<th>Qty Sisa</th>
			<th>Hrg Sat</th>
			<th>Total Nilai</th>
			<th>Satuan</th>
			<th>WareHouse</th>
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
@include('pluggins.datetimepicker_pluggin')
@include('pluggins.select2_pluggin')
@include('form.general_form')
@include('pluggins.alertify')
<script src="{{ URL::asset('vendor/jsvalidation/js/jsvalidation.min.js')}}" type='text/javascript'></script>
{!! JsValidator::formRequest('Modules\Inventory\Http\Requests\RequestBarangMasukHibah', '#form_data') !!}
<script type="text/javascript">
var gentable=null;
 $(document).ready(function(){
 	gentable = $('#datatable-details').DataTable({
		'searching':false,
		'ordering' : false,
		'autoWidth' : false,
 		'paging' : false,
 		"info": false,
 		processing: true,
          ajax: "{{ url('/inventory/barangmasuk_hibah/getDataDetails') }}/"+parseInt($('#barangmasuk_hibah_id').val()),
          columns:[
		          {
		                  "className": "action text-center",
		                  "data": null,
		                  "bSortable": false,
		                  "defaultContent": "" +
		                  "<div class='' role='group'>" +
		                  "  <button class='edit  btn btn-primary btn-xs'><i class='fa fa-edit'></i></button>" +
		                  "</div>"
		            },
                 { data: 'nomor',name: 'nomor',"bSortable": false},
                 { data: 'item_name',name: 'item_name',"bSortable": false},
                 { data: 'quantity_acuan',name: 'quantity_acuan',"className":'text-right',"bSortable": false},
                 { data: 'quantity',name: 'quantity',"className":'text-right',"bSortable": false},
                 { data: 'quantity_reject',name: 'quantity_reject',"className":'text-right',"bSortable": false},
                 { data: 'quantity_sisa',name: 'quantity_sisa',"className":'text-right',"bSortable": false},
                 { data: 'price',name: 'price',"className":'text-right price',"bSortable": false},
                 { data: 'total',name: 'total',"className":'text-right total',"bSortable": false},
				 { data: 'item_satuan',name: 'item_satuan',"className":'text-center',"bSortable": false},
                 { data: 'warehouse_name',name: 'warehouse_name',"bSortable": false}
                
          ],
          "columnDefs": [],
        	"order": [[ 0, 'asc' ]]
 	});

 	sBody = $('#datatable-details tbody');

 	sBody.on('click','.edit',function()
 	{
 		var data = gentable.row($(this).parents('tr')).data();
 		console.log(data);
 		$('#item_barang').val(data.item_name);
 		$('#item_id').val(data.item_id);
 		$('#satuan_barang').val(data.item_satuan);
 		var qty = parseInt(data.quantity_sisa);
 		if(qty>0)
 		{
 			$('#quantity').val(qty).focus();
 			$('#quantity').attr('max',qty);
 			$('#quantity_reject').attr('max',qty);
 		}
 		else
 		{
 			$('#quantity').val(data.quantity_acuan).focus();
 			$('#quantity').attr('max',data.quantity_acuan);
 			$('#quantity_reject').attr('max',data.quantity_acuan);
 		}
 		

 		$('#price').val(data.price);
 		fnSetMoney('#price',data.price);
 		$('#warehouse_id').val(data.warehouse_id);
 		$('#warehouse_name').val(data.warehouse_name);
 		$('#description').val(data.description);
 		$('.changeSatuan').text('').text(data.item_satuan);
 		$('#frm').show('fast');
 	});

 	 fnSetAutoNumeric('#price');

      $('#form_data_details').submit(function(e){
          e.preventDefault();
          var price = $('#price').autoNumeric('get');
          $('#mprice').val(price);
          var _datasend=$(this).serializeArray();
          var _url = $(this).attr('action');
          $('#form_data_details input').attr("disabled", "disabled");
          $.ajax({
            type: 'POST',
            url: _url,
            data: _datasend,
            dataType: 'json',
            beforeSend:function(){
            	//code here
            	alertify.success('Sending ...');
            },
            success:function(data){
            	if(parseInt(data.return) == 1)
            	{
            		alertify.success("Success menyimpan");
            		gentable.ajax.reload();
            		$('#form_data_details').trigger('reset');
            		$('#frm').hide('fast');
            	}
            	else
            	{
            		alertify.error("Warning " +data.errMsg);
            	}
            	return false;
            },
            error:function(xhr,status,errormessage)
            {
            	alertify.error("Warning Terjadi Kesalahan "+xhr.statusText);
            },
            complete:function()
            {
            	$('#form_data_details input').removeAttr('disabled');
              	$('#rowIdxPenerimaan').val(-1);
              	$('.form-group').removeClass('has-success');
            }
          });
      });

      gentable.on('draw',function()
		{
			$('.price').each(function(i,v){
				fnSetAutoNumeric($(this));
			 	fnSetMoney($(this),$(this).text());
			});
			$('.total').each(function(i,v){
				fnSetAutoNumeric($(this));
			 	fnSetMoney($(this),$(this).text());
			});

		});

      $('#hide').click(function()
      {
      	$('#frm').hide('fast');
      });

      $('#delivery').click(function()
      {
      	$.ajax({
      		type: 'POST',
            url: "{{ url('/inventory/barangmasuk_hibah/deliver') }}",
            data: {'id':$('#barangmasuk_hibah_id').val(),_token: $('input[name=_token]').val()},
            dataType: 'json',
            beforeSend:function(){
            	//code here
            	alertify.success('Sending ...');
            },
            success:function(data){
            	if(parseInt(data) == 1)
            	{
            		alertify.success("Success delivered");
            		window.location.href = "{{ url('/inventory/barangmasuk_hibah/index') }}";
            	}
            	else
            	{
            		alertify.error("Error Terjadi Kesalahan Silahkan Periksa kembali data anda!");
            	}
            	return false;
            },
            error:function(xhr,status,errormessage)
            {
            	alertify.error("Error Terjadi Kesalahan "+xhr.statusText);
            }
      	});
      });

      $(document).on('input','#quantity_reject',function()
      {
      		var reject = parseInt($(this).val());
      		
      		var qtysisa = parseInt($('#quantity').attr('max'));
      		var qtyresult = qtysisa - reject;
      		
      		$('#quantity').val('').val(qtyresult);
      });

  });
</script>
</body>
</html>