{{ csrf_field() }}
@include('label_global')
@include('pluggins.datetimepicker_pluggin')
@include('pluggins.select2_pluggin')

<form method="post" id="id-SaveForm" action="{{ url('barang_keluar_detail/create') }}">
	<table class='table'>
		<tr>
			<td>Barang Keluar No.</td>
			<td>
				<input type='text' id='permintaan_no' name='permintaan_no' class='form-control' placeholder='Project Name' required value="{{ $barangkeluar->no }}" disabled />
			</td>
		</tr>
		
		<tr>
			<td>Permintaan Barang</td>
			<td>
				<table width="100%" class='table'>
					<thead>
					  <tr>
						<td></td>
						<td><div align="center"><strong>Item Barang</strong></div></td>
						<td><div align="center"><strong>Quantity</strong></div></td>
						<td><div align="center"><strong>Stock Minimum</strong></div></td>
						<td><div align="center"><strong>Warehouse</strong></div></td>
					  </tr>
					</thead>
					<tbody>
					@foreach($permintaanbarang_details as $key => $value)
					  <tr>
						<td><input type="checkbox" name="chk_permintaan" id="chk_permintaan{{ $value->id }}" onclick="setDisabled{{ $value->id }}();" />
							<input type='hidden' id='permintaanbarang_detail_id' name='permintaanbarang_detail_id' class='form-control' required value='{{ $value->id }}' />
						</td>
						<td>{{ $value->item->name or 'not found' }}
							<input type='hidden' id='item_id{{ $value->id }}' name='x' class='form-control' required value="{{ $value->item->id or '0' }}" />
						</td>
						<td style='text-align:right'>
							{{ number_format($value->quantity, 2) }}
						</td>
						<td  style='text-align:right'>
						</td>
						<td>
							<select class='form-control' name='x' id='warehouse_id{{ $value->id }}'>
								@foreach($warehouses as $key => $each)
									<option value='{{ $each->id }}'>{{ $each->name }}</option>
								@endforeach
							</select>
							
							
							<script type="application/javascript">
							function setDisabled{{ $value->id }}() {
								if (document.getElementById('chk_permintaan{{ $value->id }}').checked == true) {
									document.getElementById('item_id{{ $value->id }}').name = 'item_id';
									document.getElementById('warehouse_id{{ $value->id }}').name = 'warehouse_id';
								}
								else if (document.getElementById('chk_permintaan{{ $value->id }}').checked == false) {
									document.getElementById('item_id{{ $value->id }}').name = 'x';
									document.getElementById('warehouse_id{{ $value->id }}').name = 'x';
								}
							}
							</script>
						</td>
					  </tr>
					@endforeach
					</tbody>
				</table>
				
			</td>
		</tr>

	</table>
	
</form>

<div align="center">
	<btn type="button" class="btn green showtoast" name="btn-save" id="showtoast" onclick='getSave();'>
		<span class="fa fa-save"></span> Save
	</btn>
</div>

<script type="application/javascript">
function getSave() 
{
	var permintaanbarang_id = $("#permintaanbarang_id").val().trim();
	var barangkeluar_id = $("#barangkeluar_id").val().trim();
	
	var permintaanbarang_detail_id = $("input[name^='permintaanbarang_detail_id']").serializeArray();
	var item_id = $("input[name^='item_id']").serializeArray();
	var warehouse_id = $("select[name^='warehouse_id']").serializeArray();
	
	var token = $('input[name=_token]').val();

	if (permintaan_no == '') 
	{
		$("#div_message").html('<div class="custom-alerts alert alert-danger fade in">Please fill value on ( Permintaan No )</div>');
		return false;
	}
	else {
		$.post("{{ url('barang_keluar_detail/create') }}", 
			{ 
				barangkeluar_id: barangkeluar_id,
				permintaanbarang_detail_id: permintaanbarang_detail_id,
				item_id: item_id,
				warehouse_id: warehouse_id,
				_token: token
			},
			function(data) 
			{
				$("#div_message").html('<div class="custom-alerts alert alert-success fade in"> Succesfully saved on '+ formattedtoday +'</div>');
				$("#id-SaveForm")[0].reset();
			}
		);
		return false;
	}
}
</script>