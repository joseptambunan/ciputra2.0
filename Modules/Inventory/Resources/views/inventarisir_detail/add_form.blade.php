@include('label_global')
@include('pluggins.datetimepicker_pluggin')
@include('pluggins.select2_pluggin')
@include('form.general_form')
<div class="col-sm-12">
	<div class="page-bar">
	    <ul class="page-breadcrumb">
	        <li>
	            <a href="#">Inventory</a>
	            <i class="fa fa-arrow-circle-right"></i>
	        </li>
	        <li>
	            <a href="#">Inventarisir</a>
	            <i class="fa fa-arrow-circle-right"></i>
	        </li>
	        <li>
	            <a href="#">Detail</a>
	            <i class="fa fa-arrow-circle-right"></i>
	        </li>
	        <li>
	        	<span>Tambah</span>
	        </li>
	    </ul>
	    <div class="page-toolbar">
	        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
	            <i class="icon-calendar"></i>&nbsp;
	            <span class="thin uppercase hidden-xs"></span>&nbsp;
	            <i class="fa fa-angle-down"></i>
	        </div>
	    </div>
	</div>
	<h3>{{ $projectname }}</h3>
	<hr>
		@include('form.a',[
			'href'=> url('/inventarisir_detail/index').'?id='.$inventarisir_id, 
			'caption' => 'Cancel' 
		])
		@include('form.refresh')
	<hr>
</div>


@if (is_null($BarangKeluarDetail))
	<form method="post" id="id-SaveForm" action="{{ url('inventarisir_detail/create') }}">
	{{ csrf_field() }}
	<input type="hidden" name="inventarisir_id" id="inventarisir_id" value="{{ $inventarisir_id }}" />
		<table class='table'>
			<tr>
				<td>Item Barang</td>
				<td>
					<select class='form-control select2' name='item_id' id='item_id'>
						@foreach($Items as $key => $value)
							<option value='{{ $value->id }}'>{{ $value->name }}</option>
						@endforeach
					</select>
				</td>
			</tr>
				<tr>
					<td>Quantity</td>
					<td>
						<input class="form-control col-md-7 col-xs-12" 
						id="quantity" name="quantity" type="number" min="1" value="1" />
					</td>
				</tr>
			
				<tr>
					<td>Harga</td>
					<td>
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-money"></i> </div>
							<input class="form-control col-md-7 col-xs-12"  id="price" name="price" type="text" />
							<input type="hidden" name="mprice" id="mprice" />
						</div>
					</td>
				</tr>
				<tr>
					<td>Ppn</td>
					<td>
						<div class="input-group">
							<input class="form-control col-md-7 col-xs-12"  id="ppn" name="ppn" type="number" min="1" max="100" value="1" />
							<div class="input-group-addon">%</div>
						</div>
					</td>

				</tr>
				<tr>
					<td></td>
					<td>
						<div class="input-group">
							<div class="input-group-addon">Rp. </div>
							<input class="form-control col-md-7 col-xs-12"  id="ppn-label" name="ppn-label" type="text" readonly="true" />
						</div>
					</td>
				</tr>
				<tr>
					<td>Tanggal Beli</td>
					<td>
						<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
							<input type="text" class="form-control" name='date' id='date' readonly required value="<?php echo date('Y-m-d'); ?>">
							<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
						</div>				
					</td>
				</tr>
		</table>
		<div align="center">
		<button type="submit" class="btn green showtoast" name="btn-save" style="min-width: 100px;">
			ADD
		</button>
	</div>
	</form>
@else
	<form method="post" id="id-SaveForm" action="{{ url('inventarisir_detail/create_other') }}">
		{{ csrf_field() }}
		<input type="hidden" name="inventarisir_id" id="inventarisir_id" value="{{ $inventarisir_id }}" />
		<input type="hidden" name="allItemsSend" id="all_items" value='' />
		<table class="table table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap table_master stripe row-border" id="table_data">
			<thead>
				<tr>
					<th></th>
					<th>Item Barang</th>
					<th>Quantity</th>
					<th>Satuan</th>
					<th>Price</th>
					<th>Ppn</th>
					<th>Ppn value</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				@foreach($BarangKeluarDetail as $key => $each)
					<tr>
						<td>
							<input type="checkbox" name="barangkeluar_detail_id[]" id="barangkeluar_detail_id[]" value="{{ $each->id }}" />
						</td>
						<td>
							{{ $each->item->name }}
						</td>
						<td class="text-right">
							{{ $each->quantity }}
						</td>
						<td>
							{{ $each->satuan->name }}
						</td>
						<td class="text-right">
							Rp. {{ number_format($each->price,0,',','.') }}
						</td>
						<td class="text-right">
							{{ is_null($each->ppn) ? 0 : $each->ppn }}
						</td>
						<td class="text-right">
							Rp. {{ number_format($each->price*$each->ppn/100,0,',','.') }}
						</td>
						<td class="text-right">
							Rp. {{ number_format($each->price-($each->price*$each->ppn/100),0,',','.') }}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<div align="center">
			<button type="submit" class="btn green showtoast" name="btn-save" style="min-width: 100px;">
				ADD
			</button>
		</div>
	</form>
	@endif

@if (is_null($BarangKeluarDetail))
	<script type="text/javascript">
		$(document).ready(function()
		{
			fnSetAutoNumeric('#price');
			fnSetAutoNumeric('#ppn-label');
			$('#price').keyup(function(){
				 var nilai = parseInt($(this).autoNumeric('get'));
				 var ppn = parseInt($('#ppn').val());
				 var ppnNilai = nilai * ppn/100;
				 fnSetMoney('#ppn-label',ppnNilai);
			});
			$('#ppn').keyup(function(){
				var nilai = parseInt($('#price').autoNumeric('get'));
				var ppn = parseInt($(this).val());
				var ppnNilai = nilai * ppn/100;
				fnSetMoney('#ppn-label',ppnNilai);
			}).change(function(){
				var nilai = parseInt($('#price').autoNumeric('get'));
				var ppn = parseInt($(this).val());
				var ppnNilai = nilai * ppn/100;
				fnSetMoney('#ppn-label',ppnNilai);
			});

			$('#id-SaveForm').submit(function(e){
				e.preventDefault();
				var sPrice = $('#price').autoNumeric('get');
				$('#mprice').val(sPrice);

				var _datasend= $(this).serialize();
				var _url =  $(this).attr('action');

				$.ajax({
		            type: 'POST',
		            url: _url,
		            data: _datasend,
		            dataType: 'json',
		            success:function(data){
		              if(data.return == '1')
		              {
		              	$('#div_content').load("{{ url('/inventarisir_detail/index') }}?id="+data.id);
		              }
		            },
		            error:function(xhr,status,errormessage)
		            {
		              alert(status);
		            },
		            complete:function()
		            {
		              
		            }
	          	});
			});
		});
	</script>
@else
	<script type="text/javascript">
		var gentable = null;
		$(document).ready(function()
		{
			gentable = $('#table_data').DataTable(
				{
					"scrollY":"300px",
			        "scrollCollapse": true,
			        "paging":false
				});

			$('#id-SaveForm').submit(function(e){
				e.preventDefault();
				//var _dataItems = gentable.data();

				//var _allItemsSend = [];
				//console.log( _dataItems);
				var _datasend= $(this).serialize();
				var _url =  $(this).attr('action');
				$.ajax({
		            type: 'POST',
		            url: _url,
		            data: _datasend,
		            dataType: 'json',
		            success:function(data){
		              if(data.return == '1')
		              {
		              	$('#div_content').load("{{ url('/inventarisir_detail/index') }}?id="+data.id);
		              }
		            },
		            error:function(xhr,status,errormessage)
		            {
		              alert(xhr.responseText);
		            },
		            complete:function()
		            {
		              
		            }
	          	});
			});

		});
	</script>
@endif


