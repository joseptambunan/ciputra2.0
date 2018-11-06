{{ csrf_field() }}
<table class="table table-striped table-bordered table-hover table-responsive table-checkable nowrap stripe row-border order-column table_master" id="table_data">
	<thead style="background-color: #3FD5C0;">
		<tr>
			<th>#</th>
			<th>Barang</th>
			<th>Qty (Satuan)</th>
			<th>Tanggal</th>
			<th>Asset <i class="fa fa-plus"></i></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($inventarisirDetailCollections as $key => $value)
			<tr>
				<td>{{ $key+1 }}</td>
				<td>{{ $value->item->name }}</td>
				<td class="text-right">{{ $value->quantity." ".$value->satuan->name }}</td>
				<td>{{ date('d/m/Y',strtotime($value->created_at)) }}</td>
				<td>
					@include('form.a',
						[
							'href' => url('/inventory/asset/index').'?id='.$value->id,
							'caption' => $value->assets->count().' asset',
							'class' => 'btn-xs'
						])
				</td>
				<td>
					
					<button id="{{ $value->id }}" class="btn btn-xs btn-danger delete-link"> 
						<i class="fa fa-trash-o"></i>
					</button>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
