{{ csrf_field() }}

<table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column table_master" id="table_data">
	
	<thead>
		<tr>
			<th>No</th>
			<th>Category</th>
			<th>Name</th>
			<!--<th>Satuan</th>-->
			<th>Warning Satuan</th>
			<th>Minimum Stock</th>
			<th>Is Inventory</th>
			<th>Is Consumable</th>
			<th>Default Warehouse</th>
			<th>Description</th>
			<th>Harga</th>
			<th>Satuan</th>
			<th>Edit</th>
			<th>Delete</th>
			<th>Details</th>
		</tr>
	</thead>
	<tbody>
	@foreach($items as $key => $each)
		<tr>
			<td>{{ $key + 1 }}</td>
			<td>{{ $each->category->name or 'not found' }}</td>
			<td>{{ $each->name }}</td>
			<td>
				@if($each->satuan_warning == 0)
					<span style='color:red'>No</span>
				@elseif($each->satuan_warning == 1)
					<span style='color:blue'>Yes</span>
				@endif
			</td>
			<td style='text-align:right'>{{ number_format($each->stock_min, 2) }}</td>
			<td>
				@if($each->is_inventory == 0)
					<span style='color:red'>No</span>
				@elseif($each->is_inventory == 1)
					<span style='color:blue'>Yes</span>
				@endif
			</td>
			<td>
				@if($each->is_consumable == 0)
					<span style='color:red'>No</span>
				@elseif($each->is_consumable == 1)
					<span style='color:blue'>Yes</span>
				@endif
			</td>
			<td>{{ $each->warehouse->name or 'not found' }}</td>
			<td>{{ $each->description }}</td>
			<td align="center">
				<btn id="{{ $each->id }}" href="javascript:;" class="btn btn-xs green harga-link"> 
					<i class="fa fa-pencil-square">&nbsp;Harga</i>
				</btn>
			</td>
			<td align="center">
				<btn id="{{ $each->id }}" href="javascript:;" class="btn btn-xs green satuan-link"> 
					<i class="fa fa-pencil-square">&nbsp;Satuan</i>
				</btn>
			</td>
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
			<td align="center">
				<button data-value="{{$each->id}}" class="btn btn-xs btn-warning btn-detail-items"><i class="fa fa-list"></i> Details</button>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>

<div class="note note-warning">
	<h5 class="block" style="color:#FF8000"><strong>Note <br />
	--------------------<br />
	</strong>
	</h5>
	<span style='color:black'>
	Create Barang : <br />
	1. Please fill <strong>Category</strong> on <strong>Master Data</strong> before continue <br />
	2. Please fill <strong>Warehouse</strong> on <strong>Inventory Menu</strong> before continue <br />
	</span>
</div>

