{{ csrf_field() }}

@if(isset($_GET['id_menu_level']))
	@include('label_global')
	@include('pluggins.select2_pluggin')
@else
	@include('../label_global')
	@include('../pluggins.select2_pluggin')
@endif

<form method="post" id="id-EditForm" action="{{ url('asset/create') }}">
	
	<input type='hidden' id='id' name='id' value='{{ $assets->id }}' />
	
	<table class='table'>
		<tr>
			<td>Barang Keluar No.</td>
			<td>
				<input type='text' id='no' name='no' class='form-control' placeholder='Barang Keluar No.' required value="{{ $barangkeluars->no }}" disabled />
			</td>
		</tr>
		
		<tr>
			<td>Project</td>
			<td>
				<select class='form-control select2' name='project_id' id='project_id'>
					@foreach($projects as $key => $value)
						<option value='{{ $value->id }}' {{ $assets->project_id == $value->id ? 'selected' : '' }}>({{ $value->code }}) - {{ $value->name }}</option>
					@endforeach
				</select>
			</td>
		</tr>
		
		<tr>
			<td>PT</td>
			<td>
				<select class='form-control select2' name='pt_id' id='pt_id'>
					@foreach($pts as $key => $value)
						<option value='{{ $value->id }}' {{ $assets->pt_id == $value->id ? 'selected' : '' }}>({{ $value->code }}) - {{ $value->name }}</option>
					@endforeach
				</select>
			</td>
		</tr>
		
		<tr>
			<td>Desciption</td>
			<td>
				<textarea class='form-control' name="description" id="description" cols="45" rows="5" placeholder="Description">{{ $assets->description }}</textarea>
			</td>
		</tr>

	</table>
	
</form>

<div align="center">
	<btn type="button" class="btn green showtoast" name="btn-save" id="showtoast" onclick='getSave();'>
		<span class="fa fa-save"></span> Update
	</btn>
</div>

<script type="application/javascript">
function getSave() 
{
	var id = $("#id").val();
	var permintaanbarang_id = $("#permintaanbarang_id").val().trim();
	var barangkeluar_id = $("#barangkeluar_id").val().trim();
	
	var project_id = $("#project_id").val();
	var pt_id = $("#pt_id").val();
	var description = $("#description").val();
	
	var token = $('input[name=_token]').val();

	if (project_id == '') 
	{
		$("#div_message").html('<div class="custom-alerts alert alert-danger fade in">Please fill value on ( Projects )</div>');
		return false;
	}
	else {
		$.post("{{ url('asset/edit') }}", 
			{ 
				id: id,
				barangkeluar_id: barangkeluar_id,
				project_id: project_id,
				pt_id: pt_id,
				description: description,
				_token: token
			},
			function(data) 
			{
				$("#div_content_page").fadeOut('slow', function()
				{
					$("#div_content_page").fadeIn('slow');
					$("#div_content_page").load('{{ url('asset/index') }}'+'?update=1&id='+barangkeluar_id+'&permintaanbarang_id='+permintaanbarang_id);
					
				});
			}
		);
		return false;
	}
}
</script>