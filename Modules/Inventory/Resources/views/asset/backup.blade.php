
{{ csrf_field() }}
<table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap" id="table_data">
	
	<thead>
		<tr>
			<th>#</th>
			<th>Barang</th>
			<th>Qty</th>
			<th>Satuan</th>
			<th>Harga </th>
			<th>
				<form action="{{ url('/asset/create_qrCode') }}" name="form-qrcode" id="form-qrcode" method="post">
				{{ csrf_field() }}
				<input type="hidden" name="allBarcode" id="all-Barcode" value=""/>
				</form>
				<button type="button" class="navy-button sbold blue btn btn-success link btn-xs pull-right btn-qrcode">Cetak QrCode
				</button>
			</th>
		</tr>
	</thead>
	<tbody>
		@foreach($assets as $key => $value)
			<tr>
				<td>{{ $key+1 }}</td>
				<td>{{ $value->item->name }}</td>
				<td>{{ $value->barcode }}</td>
				<td class="price text-right">{{ $value->price }}</td>
				<td class="text-right">
					<div class="">
						@include('form.a',
										[
											'href' => url('/mutasi_out/add').'?id='.$value->id,
											'caption' => ' history',
											'class' => 'btn-xs'
										])
					</div>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
<div id="div_ajax_func"> 
	@include('asset.ajax_load')
</div>

