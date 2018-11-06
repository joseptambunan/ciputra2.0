@include('label_global')
@include('pluggins.datatable_pluggin')
@include('pluggins.editable_plugin')
<div id="div_content_page">
	<div class="portlet-body">
		<div class="page-bar">
	        <ul class="page-breadcrumb">
	            <li>
	                <a href="#">Inventory</a>
	                <i class="fa fa-arrow-circle-right"></i>
	            </li>
	            <li>
	                <a href="#">Pengembalian Barang</a>
	                <i class="fa fa-arrow-circle-right"></i>
	            </li>
	            <li>
	                <span>Detail</span>
	            </li>
	        </ul>
	        <div class="page-toolbar">
	            <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
	                <i class="icon-calendar"></i>&nbsp;
	                <span class="thin uppercase hidden-xs"></span>&nbsp;
	                <i class="fa fa-angle-down"></i>
	            </div>
	        </div>
	    </div>
		<br/>
		
			<h3 class="page-title"> 
			{{ $projectname }}
		</h3>
		<hr />
		@include('form.a',
				[
					'href' => url('pengembalian_barang/index'),
					'caption' => 'Back'
				])
			@include('form.refresh')
		<hr />
		<br/>
		<div class="content-loader">
			{{ csrf_field() }}
		<ul class="nav nav-tabs">
	      <li role="presentation" class="active">
	        <a href="#tab_permintaan" data-toggle="tab">Permintaan Barang</a>
	      </li>
	      <li role="presentation">
	        <a href="#tab_barangkeluar" data-toggle="tab">Barang Keluar</a>
	      </li>
	    </ul>
	   <div class="tab-content">
      <div id="tab_permintaan" class="tab-pane fade in active">
		<div class="col-lg-12 col-md-12 col-xs-12">
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
					<strong>: {{ $barangkeluar->permintaanbarang->project->name }}</strong>
					<br/>
					<strong>: {{ $barangkeluar->permintaanbarang->pt->name }}</strong>
					<br/>
					<strong>: {{ $barangkeluar->permintaanbarang->no}}</strong>
				</div>

				<div class="col-lg-1 col-md-1 col-xs-6">
					<strong>SPK</strong>
					<br/>
					<strong>User</strong>
					<br/>
					<strong>Tanggal</strong>
				</div>
				<div class="col-lg-3 col-md-3 col-xs-6">
					<strong>: {{ $barangkeluar->permintaanbarang->spk->no or '-' }}</strong>
					<br/>
					<strong>: {{ $barangkeluar->permintaanbarang->user->user_name }}</strong>
					<br/>
					<strong>: {{ date('d-m-Y',strtotime($barangkeluar->permintaanbarang->date)) }}</strong>
				</div>
				<div class="col-lg-1 col-md-1 col-xs-6">
					<strong>Description</strong>
				</div>
				<div class="col-lg-3 col-md-3 col-xs-6">
					<strong> : {{ $barangkeluar->permintaanbarang->description }}</strong>
				</div>

			</div>
		</div>

	</div>
</div>

 <div id="tab_barangkeluar" class="tab-pane fade in">
	<div class="col-lg-12 col-md-12 col-xs-12">
		<div class="panel panel-success">
			<div class="panel-heading">Barang Keluar</div>
			<div class="panel-body">
				<div class="col-lg-3 col-md-3 col-xs-6">
					<strong>Nomor</strong>
					<br/>
					<strong>Confirmed By Warehouse</strong>
					<br/>
					<strong>Confirmed By Requester</strong>
				</div>
				<div class="col-lg-3 col-md-3 col-xs-6">
					<strong>: {{ $barangkeluar->no }}</strong>
					<br/>
					<strong>: {{ $barangkeluar->confirmed_by_warehouseman ? 'sudah' : 'belum' }}</strong>
					<br/>
					<strong>: {{ $barangkeluar->confirmed_by_requester ? 'sudah' : 'belum'}}</strong>
				</div>

				<div class="col-lg-3 col-md-3 col-xs-6">
					<strong>Tanggal</strong>
					<br/>
					<strong>Description</strong>
				</div>
				<div class="col-lg-3 col-md-3 col-xs-6">
					<strong>: {{ date('d-m-Y',strtotime($barangkeluar->date)) }}</strong>
					<br/>
					<strong>: {{ $barangkeluar->description or '-' }}</strong>
					
				</div>
			</div>
		</div>

	</div>
</div>
			<!-- history -->
	<div class="col-lg-12 col-md-12 col-xs-12">
		<div class="panel panel-success">
	 		<div class="panel-heading"><strong>Pengembalian barang</strong></div>
		 	<div class="panel-body">
				<table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap">
					<colgroup>
	                  <col style="width: 400px;">
	                  <col style="width: 10px;">
	                  <col style="width: 30px;">
	                  <col style="width: 10px;">
	                  <col>
	                  <col>
                </colgroup>
					<thead style="background: #3FD5C0;">
						<tr>
							<th class="text-center">Item Barang</th>
							<th class="text-center">Qty Pinjam/Keluar</th>
							<th class="text-center">Qty Kembali</th>
							<th class="text-center">Qty Terpakai</th>
							<th class="text-center">Satuan</th>
							<th class="text-center">Tanggal</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$tempqty = 0;
						?>
						@for($count = 0;$count < count($lists); $count++)
							<tr>
							<td class="text-left">{{ $lists[$count]['item_name'] }}</td>
							<td class="text-right">{{ $lists[$count]['qty_pinjam']}}</td>
							<td class="text-right">
								<a href="#" class="editable_details" 
								data-pk="{{ $lists[$count]['id']}}" 
								data-name="quantity_kembali" 
								data-url="{{url('/pengembalian_barang/update')}}" 
								data-original-title="Jumlah dikembalikan"
								data-type="text" 
								data-value="{{ $lists[$count]['qty_kembali']}}">

									{{ $lists[$count]['qty_kembali']}}

								</a>
							</td>
							<td class="text-right">{{ $lists[$count]['qty_pinjam'] - ($lists[$count]['qty_kembali']+$tempqty)}}</td>
							<td>
								{{ $lists[$count]['item_satuan'] }}
							</td>
							<td>
								{{ $lists[$count]['date'] }}
							</td>
							<?php
								$tempqty += $lists[$count]['qty_kembali'];
							?>
						</tr>
						@endfor
					</tbody>
				</table>
			</div>
		</div>
	</div>
		</div>
	</div>
	<br />
</div>
<script type="text/javascript">
	$(document).ready(function()
	{
		/*$.ajaxSetup({
		    headers: {
		        'X-CSRF-Token': $('input[name=_token]').val()
		    }
		});

		$('.editable_details').editable({
				ajaxOptions: {
				    type: 'post',
				    dataType: 'json'
				},
				success:function(data)
				{
					if(data.return==1)
					{
						$('#div_content').load("{{ url()->full() }}");
					}
				}
			}
		);*/
	});
</script>