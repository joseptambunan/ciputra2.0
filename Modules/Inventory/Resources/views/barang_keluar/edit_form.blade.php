@include('label_global')
@include('pluggins.datetimepicker_pluggin')
@include('pluggins.select2_pluggin')

<div class="col-sm-12">
	<h3>Barang Keluar Edit</h3>
	<hr>
		@include('form.a',[
			'href'=> url('barang_keluar/index').'?id='.$permintaan->id, 
			'caption' => 'Cancel' 
		])
		@include('form.refresh')
	<hr>
</div>
<form method="post" id="id-EditForm" action="{{ url('barang_keluar/edit') }}">
{{ csrf_field() }}
<input type='hidden' id='id' name='id' value='{{ $barang_keluar->id }}' />
<table class='table'>
		<tr>
			<td>Permintaan Barang No.</td>
			<td>
				<input type="hidden" name="permintaanbarang_id" id="permintaanbarang_id" value="{{ $permintaan->id }}" />
				<input type='text' id='permintaan_no' name='permintaan_no' class='form-control' placeholder='Project Name' required value="{{ $permintaan->no}}" readonly="true" />
			</td>
		</tr>
		<tr>
			<td>No</td>
			<td>
				<input type='text' id='no' name='no' class='form-control' placeholder='No.' required value='{{ $barang_keluar->no }}' />
			</td>
		</tr>

		<tr>
			<td>Date</td>
			<td>
				<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
					<input type="text" class="form-control" name='date' id='date' readonly required value="{{ date('Y-m-d', strtotime($barang_keluar->date)) }}">
					<span class="input-group-btn">
					<btn class="btn default" type="button">
					<i class="fa fa-calendar"></i>
					</btn>
					</span>
				</div>
			</td>
		</tr>
		
		<tr>
			<td>Status</td>
			<td>
				<select class='form-control select2' name='approval_status_id' id='approval_status_id'>
					<option value='0' {{ ($barang_keluar->approval_status_id == 0) ? 'selected' : '' }}>Open</option>
					<option value='1' {{ ($barang_keluar->approval_status_id == 1) ? 'selected' : '' }}>Deliver</option>
					<option value='2' {{ ($barang_keluar->approval_status_id == 2) ? 'selected' : '' }}>In-Progress</option>
					<option value='3' {{ ($barang_keluar->approval_status_id == 3) ? 'selected' : '' }}>On-Hold</option>
					<option value='4' {{ ($barang_keluar->approval_status_id == 4) ? 'selected' : '' }}>Release</option>
					<option value='5' {{ ($barang_keluar->approval_status_id == 5) ? 'selected' : '' }}>Approved</option>
					<option value='6' {{ ($barang_keluar->approval_status_id == 6) ? 'selected' : '' }}>Rejected</option>
					<option value='7' {{ ($barang_keluar->approval_status_id == 7) ? 'selected' : '' }}>Close</option>
					<option value='8' {{ ($barang_keluar->approval_status_id == 8) ? 'selected' : '' }}>Cancel</option>
					<option value='9' {{ ($barang_keluar->approval_status_id == 9) ? 'selected' : '' }}>Active</option>
					<option value='10' {{ ($barang_keluar->approval_status_id == 10) ? 'selected' : '' }}>Inactive</option>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>Descriptions</td>
		  <td>
				<textarea class='form-control' name="description" id="description" cols="45" rows="5" placeholder="Descriptions">{{ $barang_keluar->description }}</textarea>
			</td>
		</tr>

	</table>
	<div align="center">
		<button type="submit" class="btn green showtoast">
			<span class="fa fa-save"></span> Save
		</button>
	</div>
</form>



<script type="application/javascript">
	$(function() {
		$('#id-EditForm').submit(function(e)
		{
			e.preventDefault();
			var url 	= $(this).attr('action');
			var data 	= $(this).serialize();
			$('#id-EditForm input').attr('disabled','disabled');
			$.ajax({
				type:'POST',
				dataType:'json',
				url:url,
				data:data,
				beforeSend:function()
				{
					
				},
				success:function(get)
				{
					if(parseInt(get.return)==1)
					{
						$('#div_content').load("{{ url('/barang_keluar/index') }}?id="+parseInt(get.id));
					}
				},
				error:function(xhr,status,message)
				{
					console.log(message);
					$("#div_message").html('<div class="custom-alerts alert alert-danger fade in">Please fill value on ( '+xhr.responseText+')</div>');
				},
				complete:function()
				{
					$('#id-SaveForm input').removeAttr('disabled');
				}
			});
		});
	});
</script>