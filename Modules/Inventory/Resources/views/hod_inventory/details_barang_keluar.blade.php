@extends('layouts.master')
@section('css')

@endsection
@section('content')

<br/>
<div class="panel panel-default">
	<div class="panel-heading">
		@if(!$barangkeluar->confirmed_by_warehouseman)
			<button class="btn btn-primary" data-value="{{ $barangkeluar->id }}" type="button" id="btn_approve"><i class="fa fa-check"></i> Approve</button>
		
		@endif
	</div>

	<div class="panel-body">

		 <ul class="nav nav-tabs" role="tablist">
		    
		    <li role="presentation" class="active"><a href="#barang_keluar" aria-controls="barang_keluar" role="tab" data-toggle="tab">Barang Keluar</a></li>
		    <li role="presentation" ><a href="#permintaan_barang" aria-controls="permintaan_barang" role="tab" data-toggle="tab">Permintaan Barang</a></li>
		    
		  </ul>
		 <div class="tab-content">
		<div role="tabpanel" class="tab-pane" id="permintaan_barang">
			<br/>
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
					<br/>
					<strong>Status</strong>
				</div>
				<div class="col-lg-3 col-md-3 col-xs-6">
					<strong> : {{ $permintaan->description }}</strong>
					<br/>
					@if($permintaan->status_permintaan == 2)
						<strong> : Asset</strong>
					@elseif($permintaan->status_permintaan == 1)
						<strong> : Pinjam</strong>
					@else
						<strong> : Pakai</strong>
					@endif
				</div>

			</div>
		</div>

	</div>
	<div role="tabpanel" class="tab-pane active" id="barang_keluar">
		<br/>
		<div class="panel panel-success">
			<div class="panel-heading">Barang Keluar</div>
			<div class="panel-body">

				<div class="col-lg-3 col-md-3 col-xs-6">

					<strong>Nomor Barang Keluar</strong>
					<br/>
					<strong>Confirm by Requester</strong>
					<br/>
					<strong>Confirm by Warehouse</strong>
				</div>
				<div class="col-lg-3 col-md-3 col-xs-6">
					<strong>: {{ $barangkeluar->no }}</strong>
					<br/>
					<strong>: {{ $barangkeluar->confirmed_by_requester ? 'Sudah' : 'Belum' }}</strong>
					<br/>
					<strong>: {{ $barangkeluar->confirmed_by_warehouseman  ? 'Sudah' : 'Belum'}}</strong>
				</div>

				<div class="col-lg-1 col-md-1 col-xs-6">
					<strong>Tanggal</strong>
					<br/>
					<strong>Description</strong>
					<br/>
				</div>
				<div class="col-lg-3 col-md-3 col-xs-6">
					<strong>: {{ date('d-m-Y',strtotime($barangkeluar->date)) }}</strong>
					<br/>
					<strong>: {{ $barangkeluar->description }}</strong>
				</div>

			</div>
		</div>

	</div>
	</div>
		<div class="panel panel-primary">
			<div class="panel-heading">Detail Barang Keluar	</div>
			<div class="panel-body">
				<table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column table_master" id="table_data">
			
					<thead>
						<tr>
							<th>No</th>
							<th class="text-center">Item Barang</th>
							<th class="text-center">Qty</th>
							<th class="text-center">Satuan</th>
							<th class="text-center">Warehouse</th>
							<th class="text-center">Butuh Date</th>
							
						</tr>
					</thead>
					<tbody>
					@foreach($barangkeluar->barangkeluardetails as $key => $value)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ $value->item->name or 'not found' }}</td>
							<td style='text-align:right'>{{ number_format($value->quantity, 2) }}</td>
							<td>{{ $value->permintaanbarang_detail->satuan->name }}</td>
							<td>{{ $value->warehouse->name }}</td>
							<td class="text-center">{{ date('d-m-Y', strtotime($value->permintaanbarang_detail->butuh_date)) }}</td>
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

<script type="text/javascript">
	var notify = null;
	$(document).ready(function(){

		$('#btn_approve').click(function()
		{
	        var barang_keluar_id = $(this).attr('data-value');

	        var _datasend = {'id':barang_keluar_id,_token:$('input[name=_token]').val()};
	        var _url = "{{ url('/inventory/hod_inventory/approveBarangKeluar') }}"

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
	                             text: "Approved, Silahkan lakukan pengeluaran barang"
	                          });
	                      window.location.href="{{ url('/inventory/inventory/barangkeluar')}}";
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