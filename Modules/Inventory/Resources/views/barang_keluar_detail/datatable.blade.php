{{ csrf_field() }}
<table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column table_master" id="table_data">
	
	<thead>
		<tr>
			<th>No</th>
			<th>Item</th>
			<th>Qty</th>
			<th>Satuan</th>
			<th>Gudang</th>
			<th>Penyerahan</th>
			@if($request->id)
				<th></th>
			@endif
		</tr>
	</thead>
	<tbody>
	@foreach($barangkeluar_details as $key => $value)
		<tr>
			<td>{{ $key + 1 }}</td>
			<td>
				<a href="#" class="editable_header" 
					data-pk="{{ $value->id}}" 
					data-name="item_id" 
					data-url="{{url('/barang_keluar_detail/edit')}}" 
					data-original-title="Pilih"
					data-type="select" 
					data-value="{{ $value->item_id}}" 
					data-source="{{ url('/permintaan_barang_detail/item_source') }}">
					{{ $value->item->name or 'not found' }}
				</a>
			</td>
			<td class="text-right">
				<a href="#" class="editable_header" 
					data-pk="{{ $value->id}}" 
					data-name="quantity" 
					data-url="{{url('/barang_keluar_detail/edit')}}"
					data-type="text" 
					data-value="{{ $value->quantity}}">
						{{ $value->quantity or '0' }}
				</a>
			</td>
			<td>
				{{ $value->satuan->name }}
			</td>
			<td>
				<a href="#" class="editable_header" 
					data-pk="{{ $value->id}}" 
					data-name="warehouse_id" 
					data-url="{{url('/barang_keluar_detail/edit')}}" 
					data-original-title="Pilih"
					data-type="select" 
					data-value="{{ $value->warehouse_id}}" 
					data-source="{{ url('/barangmasuk_hibah_details/warehouse_source') }}">
						{{ $value->warehouse->name or '-' }}

				</a>
			</td>
			<td>
				@if($value->is_sent)
					<storng>Tuntas</storng>
				@else
					<button class="btn btn-warning button-give btn-xs" data-id="{{ $value->id }}">Belum Tuntas</button>
				@endif
				
			</td>
			<!--td>Rp. {{ number_format($value->price,2,',','.') }}</td-->
			@if($request->id)
				<!--td align="center">
					@include('form.a',
						[
							'href' => url('/barang_keluar_detail_prices/index').'?id='.$value->id.
							'&permintaanbarang_id='.$value->barangkeluar->permintaanbarang_id.
							'&barangkeluar_id='.$value->barangkeluar_id
							,
							'caption' => 'Create Price',
							'class' => 'btn-xs'
						])
				</td-->
				
				<td align="center">
					<button id="{{ $value->id }}" href="#" class="btn btn-xs btn-danger delete-link"> 
						<i class="fa fa-trash-o"></i>
					</button>
				</td>
			@endif
		</tr>
	@endforeach
	</tbody>
</table>


