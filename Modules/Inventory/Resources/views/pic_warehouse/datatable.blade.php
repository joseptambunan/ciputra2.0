{{ csrf_field() }}
<table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap" id="table_data">
	<thead>
		<tr>
			<th>No</th>
			<th>Username</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	
		@foreach($users_warehouse->users as $key => $each)
		<tr>
			<td>{{ $key + 1 }}</td>
			<td align="center">
				{{ $each->user_name }}
			</td>
			<td align="center">
				<button data-user-id="{{ $each->id }}" data-warehouse-id="{{ $users_warehouse->id }}" href="#" class="btn btn-xs btn-danger delete-link"> 
					<i class="fa fa-trash"></i>
				</button>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
