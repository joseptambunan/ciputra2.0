{{ csrf_field() }}

@include('label_global')
@include('pluggins.datetimepicker_pluggin')
@include('pluggins.select2_pluggin')

<div class="col-sm-12">
	<h3>Permintaan Barang Detail Edit</h3>
	<hr>
		@include('form.a',[
			'href'=> url('permintaan_barang_detail/index')."?id=".$permintaan_barang_detail->permintaanbarang_id, 
			'caption' => 'Cancel' 
		])
		@include('form.refresh')
	<hr>
</div>

<form method="post" id="id-EditForm" action="{{ url('permintaan_barang_detail/edit') }}">
	<input type="hidden" id="id" name="id" value="{{ $permintaan_barang_detail->id }}">
	<input type="hidden" id="permintaanbarang_id" name="permintaanbarang_id" value="{{ $permintaan_barang_detail->permintaanbarang_id }}"/>
	
	<table class='table'>
		<tr>
			<td>Permintaan Barang No.</td>
			<td>
				<input type='text' id='no' name='no' class='form-control' placeholder='Permintaan Barang No.' required value="{{ $permintaan->no }}" disabled />
			</td>
		</tr>
		
		<tr>
			<td>Item Barang</td>
			<td>
				<select class='form-control select2'  name='item_id' id='item_id'> 
					@foreach($items as $each) 
						<option value='{{ $each->id }}' {{ ($permintaan_barang_detail->item_id == $each->id) ? 'selected' : '' }}>{{ $each->name }}</option> 
					@endforeach 
				</select>
			</td>
		</tr>

		<tr>
			<td>Quantity</td>
			<td>
				<input type='text' id='quantity' name='quantity' class='form-control' placeholder='Quantity' required value='{{ $permintaan_barang_detail->quantity }}' style='width:50%' />
			</td>
		</tr>
		
		<tr>
			<td>Butuh Date</td>
			<td>
				<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
					<input type="text" class="form-control" name='butuh_date' id='butuh_date' readonly required value="{{ date('Y-m-d', strtotime($permintaan_barang_detail->butuh_date)) }}">
					<span class="input-group-btn">
					<btn class="btn default" type="button">
					<i class="fa fa-calendar"></i>
					</btn>
					</span>
				</div>
			</td>
		</tr>
		
		<tr>
			<td>Is Inventarisasi</td>
			<td>
				<select name="is_inventarisasi" id="is_inventarisasi" class="form-control">
					<option></option>
					<option value="1" {{ $permintaan_barang_detail->is_inventarisasi ? 'selected' : "" }}>Ya</option>
					<option value="0" {{ $permintaan_barang_detail->is_inventarisasi ? '' : "selected" }}>Tidak</option>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>Descriptions</td>
			<td>
				<textarea class='form-control' name="description" id="description" cols="45" rows="5" placeholder="Descriptions">{{ $permintaan_barang_detail->description }}</textarea>
			</td>
		</tr>

	</table>

</form>


@include('form.submit', ['url' => url('/permintaan_barang_detail/edit'), 
	'variables' => [
		'id',
		'permintaanbarang_id',
		'item_id',
		'quantity',
		'butuh_date',
		'description',
		'is_inventarisasi'
		], 
	'arrays' => [
		
	],
	'is_edit' => TRUE ])