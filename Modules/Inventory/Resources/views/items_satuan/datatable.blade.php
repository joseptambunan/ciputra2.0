<table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column table_master" id="table_data">
	{{ csrf_field() }}
	<thead>
		<tr>
			<th>Item</th>
			<th>Satuan</th>
			<th>Konversi</th>
			<th></th>
			
		</tr>
	</thead>
	<tbody>
	@foreach($items_satuans as $key => $each)
		<tr>
			<td>{{ is_null($each->item) ? 'Kosong' : $each->item->name }}</td>
			<td><a href="#" class="editable_header" 
				data-pk="{{ $each->id}}" 
				data-name="name" 
				data-url="{{url('/inventory/items_satuan/edit')}}" 
				data-original-title="Nama"
				data-type="text" 
				data-value="{{ $each->name }}">{{ $each->name or '-' }}</a></td>
			<td><a href="#" class="editable_header" 
				data-pk="{{ $each->id}}" 
				data-name="konversi" 
				data-url="{{url('/inventory/items_satuan/edit')}}" 
				data-original-title="Konversi"
				data-type="text" 
				data-value="{{ $each->konversi }}">{{ $each->konversi or 0 }}</a></td>
			<td align="center">
				<button id="{{ $each->id }}" href="#" class="btn btn-xs btn-danger delete-link"> 
					<i class="fa fa-times"></i>
				</button>
			</td>
		
		</tr>
	@endforeach
	</tbody>
</table>
