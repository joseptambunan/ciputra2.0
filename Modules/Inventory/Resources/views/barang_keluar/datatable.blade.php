<form id="frmprint" method="post" name="formprint" action="{{ url('/inventory/barang_keluar/print') }}">
	{{ csrf_field() }}
	<input type="hidden" name="barang_keluar_id" id="barang_keluar_id" value="0" />
</form>
<table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap table_master" id="table_data">
	<thead>
		<tr>
			<th>#</th>
			<th>No</th>
			<th>Tanggal</th>
			<th>Detail</th>
			<th>Asset <i class="fa fa-plus"></i></th>
			<th>Persetujuan Gudang</th>
			<th>Penyerahan</th>
			<th></th>
		
		</tr>
	</thead>
	<tbody>
	 @foreach(json_decode($json_barang_keluars) as $key => $each)
		<tr>
			<td>{{ $key + 1 }}</td>
			<td>{{ $each->no }}</td>
			<td>{{ date('d-m-Y', strtotime($each->date)) }}</td>
	
				<td align="center">
					@include('form.a',
						[
							'href' => url('/inventory/barang_keluar_detail/index').'?id='.$each->id.'&permintaanbarang_id='.$each->permintaanbarang_id,
							'caption' => $each->detail_count.' Detail',
							'class' => 'btn-xs'
						])
				</td>
				<td align="center">
					@if($each->confirmed_by_warehouseman && $each->status_barang == 1)
						@include('form.a',
						[
							'href' => url('/inventory/inventarisir/index').'?id='.$each->id,
							'caption' => $each->inventarisir_count.' Mutasi In',
							'class' => 'btn-xs'
						])
					@else
						-

					@endif
				</td>
				<td>
					@if($each->confirmed_by_warehouseman)
						<button class="btn btn-success btn-xs btn-approved" type="button">Sudah</button>
					@else
						<button class="btn btn-success btn-xs btn-approval" data-parent="{{$each->permintaanbarang_id }}"  data-value="{{ $each->id }}" type="button"> Belum</button>
					@endif
				</td>
				<td>
					@if($each->status_sent)
						Tuntas
					@else
						Belum Tuntas
					@endif
				</td>
				<td align="center">
					<button id="{{ $each->id }}" href="javascript:;" class="btn btn-danger btn-xs delete-link"><i class="fa fa-trash-o"></i></butoon>
					<button class="btn btn-primary btn-xs btn-print" data-value="{{ $each->id }}" type="button">
						<i class="fa fa-print"></i>
					</button>
				</td>
		
		</tr>
	@endforeach
	</tbody>
</table>


