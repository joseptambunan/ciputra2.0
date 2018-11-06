<table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column" id="table_data" data-page-length='50'>
	{{ csrf_field() }}
	<thead>
		<tr>
			<th>No</th>
			<th>Parent</th>
			<th>Name</th>
			<th>Edit</th>
			<th>Delete</th>
			<th>Created</th>
			<th>Updated</th>
		</tr>
	</thead>
	<tbody>
	@foreach($categories as $key => $each)
		<tr>
			<td class="details-control">{{ $key + 1 }}</td>
			<td>{{ $each->parent->name or 'Parent' }}</td>
			<td>{{ $each->name }}</td>
			<td align="center">
				<btn id="{{ $each->id }}" href="javascript:;" class="btn btn-xs blue edit-link"> 
					<i class="fa fa-edit">&nbsp;Edit</i>
				</btn>
			</td>
			<td align="center">
				<btn id="{{ $each->id }}" href="javascript:;" class="btn btn-xs red delete-link"> 
					<i class="fa fa-times">&nbsp;Delete</i>
				</btn>
			</td>
			<td>
				{{ date('d-m-Y',strtotime($each->created_at)) }}
			</td>
			<td>
				{{ date('d-m-Y',strtotime($each->updated_at)) }}
			</td>
		</tr>
	@endforeach
	</tbody>
</table>

<div id="div_ajax_func"> 
	@include('category.ajax_load')
</div>

<script type="text/javascript">
// set color on not found text
function setNotFound() {
	findAndReplace("not found", function(text){
		return '<span style="'+fontColor+'">' + text + '</span>';
	});
	return false;
};

setNotFound();
</script>