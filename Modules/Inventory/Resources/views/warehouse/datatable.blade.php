<div class="checkbox">
	<label>
		<input type="checkbox" id="checkall_warehouseall" name="checkall_warehouseall" class="check_all" /> Cek Semua
	</label>
</div>
{{ csrf_field() }}
<table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column table_master" id="table_data">
	<thead>
		<tr>
			<th class="text-center"></th>
			<th>No</th>
			<th>Kode</th>
			<th>Nama</th>
			<th>Kota</th>
			<th>Departemen</th>
			<th>PIC</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($warehouses as $key => $each)
		<tr>
			<td class="text-center"><input type="checkbox" id="warehouse_id" name="warehouse_id" value="{{ $each->id }}" class="check-pic" /></td>
			<td>{{ $key + 1 }}</td>
			<td>{{ $each->code or '-' }}</td>
			<td>{{ $each->name or '-' }}</td>
			<td>{{ $each->city->name or '-' }}</td>
			<td>{{ is_null($each->department) ? '-' : $each->department->name }}</td>
			<td align="center">
				@include('form.a',
						[
							'href' => url('/inventory/warehouse/pic/index').'?id='.$each->id,
							'caption' => 'PiC',
							'class' => 'btn-xs'
						])
			</td>
			<td align="center">
				<div class="">
					
					<button data-id="{{ $each->id }}" class='delete-link btn btn-danger btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='top' title='Delete'><i class='fa fa-trash'></i></button>
					<button data-id="{{ $each->id }}" class='details btn btn-info btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='right' title='Details'><i class='fa fa-list'></i></button>
				</div>
			</td>
			<!--td align="center">
				<btn id="{{ $each->id }}" href="javascript:;" class="btn btn-xs red delete-link"> 
					<i class="fa fa-times">&nbsp;Delete</i>
				</btn>
			</td-->
		</tr>
		@endforeach
	</tbody>
</table>

<!--div class="note note-warning">
	<h5 class="block" style="color:#FF8000"><strong>Catatan <br />
	--------------------<br />
	</strong>
	</h5>
	<span style='color:black'>
	Add Warehouse : <br />
	1. Please fill <strong>Cities </strong> on <strong>Setting Menus > Countries > Province > Cities</strong> before continue <br />
	</span>
	<br />
</div-->
