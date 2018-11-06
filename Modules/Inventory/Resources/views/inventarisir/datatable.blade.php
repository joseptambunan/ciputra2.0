{{ csrf_field() }}
<table class="table table-striped table-bordered table-hover table-responsive table-checkable nowrap stripe row-border order-column table_master" id="table_data">
	<thead style="background-color: #3FD5C0;">
		<tr>
			<th>#</th>
			<th>Nomor</th>			
			<th>Pemberi</th>
			<th>Penerima</th>
			<th>Tanggal</th>
			<th>Detail</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($inventarisirCollections as $key => $value)
			<tr>
				<td>{{ $key + 1 }}</td>
				<td>{{ $value->no }}</td>
				
				<td>{{ is_null($value->user_giver) ? '-' : $value->user_giver->user_name }}</td>
				
				<td>{{ is_null($value->user_recipient) ? '-' : $value->user_recipient->user_name }}</td>
				<td>{{ date('d/m/Y', strtotime($value->date)) }}</td>
				<td align="center">
					@include('form.a',
						[
							'href' => url('/inventory/inventarisir_detail/index').'?id='.$value->id,
							'caption' => $value->details->count().' Detail',
							'class' => 'btn-xs'
						])
				</td>
				<td align="center">
					@include('form.a',
					[
						'href' => url('/inventory/inventarisir/edit_form/').'?id='.$value->id,
						'caption' => ' Edit',
						'class' => 'btn-primary btn-xs'
					])
					<button id="{{ $value->id }}" class="btn btn-xs btn-danger delete-link"> 
						<i class="fa fa-trash-o"></i>
					</button>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
