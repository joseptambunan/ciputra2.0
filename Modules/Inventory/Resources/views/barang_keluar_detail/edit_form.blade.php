{{ csrf_field() }}
@include('label_global')
@include('pluggins.datetimepicker_pluggin')
@include('pluggins.select2_pluggin')

<div class="col-sm-12">
	<h3>Permintaan Barang Edit</h3>
	<hr>
		@include('form.a',[
			'href'=> url('barang_keluar_detail/index').'?id='.$barangkeluar_detail->barangkeluar_id.'&permintaanbarang_id='.$barangkeluar_detail->barangkeluar->permintaanbarang_id, 
			'caption' => 'Cancel' 
		])
		@include('form.refresh')
	<hr>
</div>

<form method="post" id="id-EditForm" action="{{ url('barang_keluar_detail/edit') }}">

<input type='hidden' id='id' name='id' class='form-control' required value="{{ $barangkeluar_detail->id }}" disabled />

	<table class='table'>
		<tr>
			<td>Barang Keluar No.</td>
			<td>
				<input type='text' id='permintaan_no' name='permintaan_no' class='form-control' placeholder='Project Name' required value="{{ $barangkeluar_detail->barangkeluar->no }}" disabled />
			</td>
		</tr>
		
		<tr>
			<td>Item Barang</td>
			<td>
				<select class='form-control' name='item_id' id='item_id'>
					@foreach($items as $key => $each)
						<option value='{{ $each->id }}' {{ $barangkeluar_detail->item_id == $each->id ? 'selected' : '' }}>{{ $each->name }}</option>
					@endforeach
				</select>
				
				<input type='hidden' id='permintaanbarang_detail_id' name='permintaanbarang_detail_id' value='{{ $barangkeluar_detail->permintaanbarang_detail_id }}' />

				<script type="application/javascript">
				function getItem() {
					var sel_item = document.getElementById('sel_item').value;
					
					var variabel = sel_item.split(',');
					var a = variabel[0];
					var b = variabel[1];
					
					document.getElementById('permintaanbarang_detail_id').value = a;
					document.getElementById('item_id').value = b;
				}
				</script>
			</td>
		</tr>
		
		<tr>
			<td>Warehouse</td>
			<td>
				<select class='form-control' name='warehouse_id' id='warehouse_id'>
					@foreach($warehouses as $key => $each)
						<option value='{{ $each->id }}' {{ $barangkeluar_detail->warehouse_id == $each->id ? 'selected' : '' }}>{{ $each->name }}</option>
					@endforeach
				</select>
			</td>
		</tr>

	</table>
	
</form>


@include('form.submit', ['url' => url('/barang_keluar_detail/edit'), 
	'variables' => [
		'id',
		'permintaanbarang_detail_id',
		'item_id',
		'warehouse_id'
		], 
	'arrays' => [
	],
	'is_edit' => TRUE 
	])