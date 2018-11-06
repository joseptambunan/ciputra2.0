{{ csrf_field() }}
<table class="table table_master" id="table_data">
	<thead>
		<tr>
			<th>No</th>
			<th style="width: 270px;">Brand</th>
			<th>Tanggal Tambah</th>
			<th>Tanggal Perbarui</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	@foreach($brands as $key => $each)
		<tr>
			<td>{{ $key + 1 }}</td>
			<td><a href="#" class="editable_header" 
				data-pk="{{ $each->id}}" 
				data-name="name" 
				data-url="{{url('/inventory/brand/edit')}}" 
				data-original-title="Nama"
				data-type="text" 
				data-value="{{ $each->name }}">{{ $each->name }}</a></td>
			<td>{{ date('d-m-Y H:m:s',strtotime($each->created_at)) }}</td>
			<td>{{ date('d-m-Y H:m:s',strtotime($each->updated_at)) }}</td>
			<td align="center">
				<button id="{{ $each->id }}" href="#" class="btn btn-xs btn-danger delete-link"><i class="fa fa-trash"></i></button>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>