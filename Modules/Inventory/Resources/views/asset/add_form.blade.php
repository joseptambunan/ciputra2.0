@include('label_global')
@include('pluggins.datetimepicker_pluggin')
@include('pluggins.select2_pluggin')

<div class="col-sm-12">
	<h3>Asset Add</h3>
	<hr>
		@include('form.a',[
			'href'=> url('/asset/index').'?id=', 
			'caption' => 'Cancel' 
		])
		@include('form.refresh')
	<hr>
</div>

<form method="post" id="id-SaveForm" action="{{ url('/asset/create') }}">
	{{ csrf_field() }}
	<table class='table'>
		<tr>
			<td>No Inventarisir</td>
			<td>
				<input type='text' id='no_inventarisir' name='no_inventarisir' class='form-control' required value="{{ $InventarisirDetail->inventarisir->no }}" disabled />
			</td>
		</tr>
		
		<tr>
			<td>Status</td>
			<td>
				<select class='form-control select2' name='pt_id' id='pt_id'>
					@foreach($pts as $key => $value)
						<option value='{{ $value->id }}'>({{ $value->code }}) - {{ $value->name }}</option>
					@endforeach
				</select>
			</td>
		</tr>

		<tr>
			<td>From User</td>
			<td>
				<select class='form-control select2' name='project_id' id='project_id'>
					@foreach($projects as $key => $value)
						<option value='{{ $value->id }}'>({{ $value->code }}) - {{ $value->name }}</option>
					@endforeach
				</select>
			</td>
		</tr>

		<tr>
			<td>To User</td>
			<td>
				<select class='form-control select2' name='project_id' id='project_id'>
					@foreach($projects as $key => $value)
						<option value='{{ $value->id }}'>({{ $value->code }}) - {{ $value->name }}</option>
					@endforeach
				</select>
			</td>
		</tr>
		
		<tr>
			<td>From Department</td>
			<td>
				<select class='form-control select2' name='pt_id' id='pt_id'>
					@foreach($pts as $key => $value)
						<option value='{{ $value->id }}'>({{ $value->code }}) - {{ $value->name }}</option>
					@endforeach
				</select>
			</td>
		</tr>

		<tr>
			<td>To Department</td>
			<td>
				<select class='form-control select2' name='pt_id' id='pt_id'>
					@foreach($pts as $key => $value)
						<option value='{{ $value->id }}'>({{ $value->code }}) - {{ $value->name }}</option>
					@endforeach
				</select>
			</td>
		</tr>

		<tr>
			<td>From Unit Sub</td>
			<td>
				<select class='form-control select2' name='pt_id' id='pt_id'>
					@foreach($pts as $key => $value)
						<option value='{{ $value->id }}'>({{ $value->code }}) - {{ $value->name }}</option>
					@endforeach
				</select>
			</td>
		</tr>

		<tr>
			<td>To Unit Sub</td>
			<td>
				<select class='form-control select2' name='pt_id' id='pt_id'>
					@foreach($pts as $key => $value)
						<option value='{{ $value->id }}'>({{ $value->code }}) - {{ $value->name }}</option>
					@endforeach
				</select>
			</td>
		</tr>
		
		<tr>
			<td>From Location</td>
			<td>
				<select class='form-control select2' name='pt_id' id='pt_id'>
					@foreach($pts as $key => $value)
						<option value='{{ $value->id }}'>({{ $value->code }}) - {{ $value->name }}</option>
					@endforeach
				</select>
			</td>
		</tr>

		<tr>
			<td>To Location</td>
			<td>
				<select class='form-control select2' name='pt_id' id='pt_id'>
					@foreach($pts as $key => $value)
						<option value='{{ $value->id }}'>({{ $value->code }}) - {{ $value->name }}</option>
					@endforeach
				</select>
			</td>
		</tr>

		<tr>
			<td>Desciption</td>
			<td>
				<textarea class='form-control' name="description" id="description" cols="45" rows="5" placeholder="Description"></textarea>
			</td>
		</tr>

	</table>
	
</form>


@include('form.submit', ['url' => url('asset/create'), 
'variables' => [
	'permintaanbarang_id',
	'barangkeluar_id',
	'project_id',
	'pt_id',
	'description',
	'token'], 'arrays' => [] ])
