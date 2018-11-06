<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
  <link href="{{ URL::asset('assets/global/plugins/typeahead/typeahead.css') }}" rel="stylesheet" type="text/css" />
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{ $project->name }}</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
  
			  <ul class="breadcrumb">
	            <li>
	                <a href="{{ url('/inventory/inventory/stock/view_stock') }}">Inventory</a>
	            </li>
	            <li>
	                <a href="{{ url('/inventory/barangmasuk_hibah/index') }}">Barang Masuk</a>
	            </li>
	            <li>
	                <span>Reject Details</span>
	            </li>
	        </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
				<strong>Nomor Barang Masuk : {{ $BarangMasukHibah->no }} </strong>
		
				@include('form.a',
				[
					'href' => url('/inventory/barangmasuk_hibah/index'),
					'class'=>'pull-right',
					'caption' => 'Kembali'
				])
				<hr />
				<div class="panel panel-success">
			 		<div class="panel-heading"><strong>{{ $BarangMasukHibah->no }}</strong></div>
				 	<div class="panel-body">
				 		<a href="{{ url('/inventory/barangmasuk_hibah/cetakReject',$BarangMasukHibah->id) }}" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</a>
				 		<p/>
						<table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap">
							<thead style="background: #3FD5C0;">
								<tr>
									<th colspan="2" class="text-center">Project</th>
									<th colspan="2" class="text-center">PT </th>
									<th rowspan="2" class="text-center">Tanggal</th>
									<th rowspan="2" class="text-center">Penerima</th>
									<th rowspan="2" class="text-center">Deskripsi</th>
								</tr>
								<tr>
									<th>Dari</th>
									<th>Kepada</th>
									<th>Dari</th>
									<th>Kepada</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										{{ $BarangMasukHibah->from_project->name }}</td>
									<td>{{ $BarangMasukHibah->to_project->name }}</td>
									<td>{{ $BarangMasukHibah->from_pt->name }}</td>
									<td>{{ $BarangMasukHibah->to_pt->name }}</td>
									<td>{{ date('d-m-Y',strtotime($BarangMasukHibah->tanggal_hibah))}}</td>
									<td>{{ $BarangMasukHibah->user_recepient->user_name or '-' }}</td>
									<td>{{ trim($BarangMasukHibah->description) }}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

				<div class="panel panel-success">
			 		<div class="panel-heading">Details </div>
				 	<div class="panel-body">
						<table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap">
								<colgroup>
									<col >
									<col style="width: 155px;">
									<col style="width: 10px;">
									<col>
									<col>
									<col>
									<col>
								</colgroup>
							<thead style="background: #3FD5C0;">
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Item Barang</th>
									<th class="text-center">Qty Reject</th>
									<th class="text-center">Harga(Rp.)</th>
									<th class="text-center">Total(Rp.)</th>
									<th class="text-center">Satuan</th>
									<th class="text-center">Gudang</th>
									<th class="text-center">Description</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@if(count($detailsbarangmasuk) > 0)
								<?php 
									$nomor = count($detailsbarangmasuk)+1;
								?>
									@foreach($detailsbarangmasuk as $key => $value)
									<tr>
										<td>{{ $nomor-=1 }}</td>
										<td>{{ $value->items->name }}</td>
										
										
										<td>{{ $value->total_reject or '0' }}</td>
										<td class="text-right">{{ number_format($value->price,0,',','.') }}</td>
										<td>{{ number_format($value->price*$value->total_reject,0,',','.') }}</td>

										<td>{{ is_null($value->item_satuan) ? $value->item_satuan_id : $value->item_satuan->name }}</td>
										<td>{{ is_null($value->warehouse) ? $value->warehouse_id : $value->warehouse->name }}</td>
										<td>
											{{ $value->description or '-' }}
										</td>
										<td>
											<button data-id="{{ $BarangMasukHibah->id }}" class="btn btn-info btn-details"><i class="fa fa-list"></i></button>
										</td>
									</tr>
									@endforeach
								@else
									<tr>
										<td colspan="11">Empty</td>
									</tr>

								@endif
							</tbody>
						</table>
					</div>
				</div>

</div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
@include("master/footer_table")
@include('pluggins.editable_plugin')	
<script type="text/javascript">
	$(document).ready(function()
	{
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-Token': $('input[name=_token]').val()
		    }
		});

		$('.btn-details').click(function()
		{
			var id = parseInt($(this).attr('data-id'));
			$('#div_content').load("{{ url('/inventory/barangmasuk_hibah/details/')}}/"+id);
		});
		/*$('.editable_header').editable({
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
		);

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