{{ csrf_field() }}

@include('label_global')
@include('pluggins.datetimepicker_pluggin')
@include('pluggins.select2_pluggin')

<div class="col-sm-12">
	<h3>User Warehouse Add</h3>
	<hr>
		@include('form.a',[
			'href'=> url('/warehouse/pic/index').'?id='.$warehouse_id, 
			'caption' => 'Cancel' 
		])
		@include('form.refresh')
	<hr>
</div>

<form method="post" id="id-SaveForm" action="{{ url('/warehouse/pic/store') }}">
	<input type="hidden" name="warehouse_id" id="warehouse_id" value="{{ $warehouse_id }}" />
	<table class='table'>
		<tr>
			<td>User</td>
			<td>
				<select class='form-control select2' name='users_id' id='users_id'>
					@foreach($users as $key => $value)
						<option value='{{ $value->id }}'>{{ $value->user_name }}</option>
					@endforeach
				</select>
			</td>
		</tr>
		
	</table>
	
</form>

@include('form.submit',['url' => url('/warehouse/pic/store'), 
'variables' => ['users_id','warehouse_id'], 'arrays' => [] ])
