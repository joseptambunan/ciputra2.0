
@include('label_global')
@include('pluggins.datetimepicker_pluggin')
@include('pluggins.select2_pluggin')
@include('form.general_form')
<div class="col-sm-12">
	<h3>Inventarisir Detail Edit</h3>
	<hr>
		@include('form.a',[
			'href'=> url('/inventarisir_detail/index').'?id='.$inventarisirDetail->inventarisir_id, 
			'caption' => 'Cancel' 
		])
		@include('form.refresh')
	<hr>
</div>

<form method="post" id="id-SaveForm" action="{{ url('inventarisir_detail/edit') }}">
	{{ csrf_field() }}
	<input type="hidden" name="id" id="id" value="{{ $inventarisirDetail->id }}" />
	<input type="hidden" name="inventarisir_id" id="inventarisir_id" value="{{ $inventarisirDetail->inventarisir_id }}" />
	<table class='table'>
		<tr>
			<td>Item Barang</td>
			<td>
				<select class='form-control select2' name='item_id' id='item_id'>
					@foreach($Items as $key => $value)
						<option value='{{ $value->id }}' {{ ($inventarisirDetail->item_id==$value->id) ? 'selected' : '' }}>{{ $value->name }}</option>
					@endforeach
				</select>
			</td>
		</tr>		
		<tr>
			<td>Quantity</td>
			<td>
				<input class="form-control col-md-7 col-xs-12"  id="quantity" name="quantity" type="number" min="1" value="{{ $inventarisirDetail->quantity }}" />
			</td>
		</tr>
		<tr>
			<td>Harga</td>
			<td>
				<div class="input-group">
					<div class="input-group-addon">Rp. </div>
					<input class="form-control col-md-7 col-xs-12"  id="price" name="price" type="text" value="{{ $inventarisirDetail->price }}"/>
					<input type="hidden" name="mprice" id="mprice" />
				</div>
			</td>
		</tr>
		<tr>
			<td>Ppn</td>
			<td>
				<div class="input-group">
					<input class="form-control col-md-7 col-xs-12"  id="ppn" name="ppn" type="number" min="1" max="100" value="{{ $inventarisirDetail->ppn }}" />
					<div class="input-group-addon">%</div>
				</div>
			</td>

		</tr>
		<tr>
			<td></td>
			<td>
				<div class="input-group">
					<div class="input-group-addon">Rp. </div>
					<input class="form-control col-md-7 col-xs-12" id="ppn-label" name="ppn-label" type="text" readonly="true" />
				</div>
			</td>
		</tr>
		<tr>
			<td>Tanggal Beli</td>
			<td>
				<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
					<input type="text" class="form-control" name='date' id='date' readonly required value="{{ date('Y-m-d',strtotime($inventarisirDetail->purchased_date)) }}">
					<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
				</div>				
			</td>
		</tr>
	</table>
	<div align="center">
		<button type="submit" class="btn green showtoast" name="btn-save" style="min-width: 100px;">
			UPDATE
		</button>
	</div>
</form>
<script type="text/javascript">
	$(document).ready(function()
	{
		fnSetAutoNumeric('#price');
		fnSetAutoNumeric('#ppn-label');

		$('#price').keyup(function(){
			 var nilai = parseInt($(this).autoNumeric('get'));
			 var ppn = parseInt($('#ppn').val());
			 var ppnNilai = nilai * ppn/100;
			 fnSetMoney('#ppn-label',ppnNilai);
		});
		$('#ppn').keyup(function(){
			var nilai = parseInt($('#price').autoNumeric('get'));
			var ppn = parseInt($(this).val());
			var ppnNilai = nilai * ppn/100;
			fnSetMoney('#ppn-label',ppnNilai);
		}).change(function(){
			var nilai = parseInt($('#price').autoNumeric('get'));
			var ppn = parseInt($(this).val());
			var ppnNilai = nilai * ppn/100;
			fnSetMoney('#ppn-label',ppnNilai);
		});

		$('#id-SaveForm').submit(function(e){
			e.preventDefault();
			var sPrice = $('#price').autoNumeric('get');
			$('#mprice').val(sPrice);

			var _datasend= $(this).serialize();
			var _url =  $(this).attr('action');

			$.ajax({
	            type: 'POST',
	            url: _url,
	            data: _datasend,
	            dataType: 'json',
	            success:function(data){
	              if(data.return == '1')
	              {
	              	$('#div_content').load("{{ url('/inventarisir_detail/index') }}"+'?id='+data.id);
	              }
	            },
	            error:function(xhr,status,errormessage)
	            {
	              alert(xhr.responseText);
	            },
	            complete:function()
	            {
	              
	            }
          	});
		});
	});
</script>
<!--table id="datatable-items" class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap">
	<thead>
	  <tr>
		<th>No</th>
	    <th>Item Barang</th>
	    <th>Tangal Beli</th>
	    <th>Quantiry</th>
		<th>Harga</th>
		<th>Ppn</th>
	    <th>Total</th>
	    <th></th>
	  </tr>
	</thead>
</table-->


