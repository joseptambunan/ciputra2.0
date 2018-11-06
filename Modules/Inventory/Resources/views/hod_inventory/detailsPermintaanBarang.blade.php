@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css')}}" type="text/css"/>
@endsection
@section('content')

<br/>
<div class="panel panel-default">
	<div class="panel-heading">
		<button class="btn btn-primary" data-value="{{ $permintaan->id }}" type="button" id="btn_approve"><i class="fa fa-check"></i> Approve</button>

		<a href="{{ url('/inventory/hod_inventory/approval_permintaan') }}" class="btn btn-success pull-right"><i class="fa fa-reply"></i> Back</a>
	</div>

	<div class="panel-body">
		<div class="panel panel-success">
			<div class="panel-heading">Permintaan Barang</div>
			<div class="panel-body">

				<div class="col-lg-1 col-md-1 col-xs-6">

					<strong>Project</strong>
					<br/>
					<strong>Company</strong>
					<br/>
					<strong>Nomor</strong>
				</div>
				<div class="col-lg-3 col-md-3 col-xs-6">
					<strong>: {{ $permintaan->project->name }}</strong>
					<br/>
					<strong>: {{ $permintaan->pt->name }}</strong>
					<br/>
					<strong>: {{ $permintaan->no}}</strong>
				</div>

				<div class="col-lg-1 col-md-1 col-xs-6">
					<strong>SPK</strong>
					<br/>
					<strong>User</strong>
					<br/>
					<strong>Tanggal</strong>
				</div>
				<div class="col-lg-3 col-md-3 col-xs-6">
					<strong>: {{ $permintaan->spk->no or '-' }}</strong>
					<br/>
					<strong>: {{ $permintaan->user->user_name }}</strong>
					<br/>
					<strong>: {{ date('d-m-Y',strtotime($permintaan->date)) }}</strong>
				</div>
				<div class="col-lg-1 col-md-1 col-xs-6">
					<strong>Description</strong>
				</div>
				<div class="col-lg-3 col-md-3 col-xs-6">
					<strong> : {{ $permintaan->description or '-' }}</strong>
				</div>

			</div>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">Detail Permintaan Barang</div>
			<div class="panel-body">
				<table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column table_master" id="table_data">
			
					<thead>
						<tr>
							<th>No</th>
							<th class="text-center">Item Barang</th>
							<th class="text-center">Quantity</th>
							<th class="text-center">Satuan</th>
							<th class="text-center">Butuh Date</th>
							<th class="text-center">Descriptions</th>
							
						</tr>
					</thead>
					<tbody>
					@foreach($permintaan_barang_details as $key => $value)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ $value->item->name or 'not found' }}</td>

							<td style='text-align:right'><a href="#" class="editable_header" 
												data-pk="{{ $value->id}}" 
												data-name="quantity" 
												data-url="{{url('/inventory/inventory/update')}}" 
												data-original-title="Quantity"
												data-type="text" 
												data-value="{{ $value->quantity}}">{{ number_format($value->quantity, 2) }}</a></td>
							<td class="text-center">{{ $value->satuan->name or 'not found' }}</td>
							<td class="text-center">{{ date('d-m-Y', strtotime($value->butuh_date)) }}</td>
							<td>{{ $value->description }}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>


@endsection
@section('scripts')
<script type="text/javascript" src="{{ URL::asset('assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.min.js')}}"></script>
<script type="text/javascript">
	var notify = null;
	$(document).ready(function(){
		$('.editable_header').editable({
				ajaxOptions: {
				    type: 'post',
				    dataType: 'json'
				},
				success:function(data)
				{
					if(data.return==1)
					{
					}
				}
			}
		);

		$('#btn_approve').click(function()
		{
	        var permintaan_id = $(this).attr('data-value');

	        var _datasend = {'id':permintaan_id,_token:$('input[name=_token]').val()};
	        var _url = "{{ url('/inventory/hod_inventory/approvePermintaanbarang') }}"

	          $.ajax({
	                type: 'POST',
	                url: _url,
	                data: _datasend,
	                dataType: 'json',
	                beforeSend:function(){
	                  //code here
	                  notify = new PNotify({text:'Sending Request ...'});
	                },
	                success:function(data){
	                  if(data)
	                  {
	                      notify.update({
	                             title: "Success",
	                             text: "Approved "
	                          });
	                      window.location.href="{{ url('/inventory/user/hod')}}";
	                  }
	                },
	                error:function(xhr,status,errormessage)
	                {
	                      notify.update({
	                             title: "Error",
	                             text: "Terjadi Kesalahan "+xhr.statusText
	                          });
	                }
	            });
		});
	});
</script>
@endsection