<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
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
<?php
			$decodeResults = json_decode($results);
			$totalStock = 0;
			$satuanbaku='';
			foreach(json_decode($stockResults) as $key => $value)
			{
				$totalStock +=$value->total_stock;
				$satuanbaku=$value->satuan;
			}
		?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
             <ul class="breadcrumb">
                  <li>
                      <a href="{{ url('/inventory/stock/view_stock') }}">Inventory</a>
                  </li>
                  <li>
                      <a href="{{ url('/inventory/items_project/index') }}">Barang Proyek</a>
                  </li>
                  <li>
                  	<span>Detail {{$decodeResults->name}}</span>
                  </li>
              </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
              	@include('form.a',
				[
					'href' => url('/inventory/items_project/index'),
					'caption' => ' Kembali'
				])
		
		<p/>
				<div class="panel panel-success">
			 		<div class="panel-heading"><strong>{{ $decodeResults->item_category }} -> {{ $decodeResults->name }}</strong></div>
				 	<div class="panel-body">
				 		<div class="col-lg-3 col-md-3 col-xs-6">
				 			<strong>Stock Min.</strong>
							<br/>
							<strong>Total Stock On Hand</strong>
							<br/>
							<strong>Total Stock Avaible</strong>
							<br/>
							<strong>Pemberitahuan Stok Min.</strong>
							<br/>
							<strong>Inventaris</strong>
						</div>

						<div class="col-lg-3 col-md-3 col-xs-6">
							<strong>: {{ $decodeResults->stock_min }} {{ $satuanbaku }}</strong>
							<br/>
							<strong>: {{ $totalStock }} {{ $satuanbaku }}</strong>
							<br/>
							<strong>: {{ $totalStock - (is_null($booking) ? 0 : $booking->booking)}} {{ $satuanbaku }}</strong>
							<br/>
							<strong>: {{ $decodeResults->satuan_warning ? 'Aktif' : 'Tidak Aktif'}}</strong>
							<br/>
							<strong>: {{ $decodeResults->is_inventory ? 'Ya' : 'Tidak' }}</strong>
						</div>

						<div class="col-lg-2 col-md-2 col-xs-6">
							<strong>Pakai Habis</strong>
							<br/>
							<strong>Deksripsi</strong>
						</div>

						<div class="col-lg-3 col-md-3 col-xs-6">
							<strong>: {{ $decodeResults->is_consumable ? 'Ya' : 'Tidak'}}</strong>
							<br/>
							<strong>: {{ $decodeResults->description or '-' }}</strong>
						</div>

						
				 	</div>
				 </div>
				 <div class="panel panel-success">
			 		<div class="panel-heading"><strong>Details Information</strong></div>
				 	<div class="panel-body">
				 		<ul class="nav nav-tabs">
						  <li role="presentation" class="active">
						  	<a href="#tab_stock" data-toggle="tab">Stock</a>
						  </li>
						  <li role="presentation">
						  	<a href="#tab_satuan" data-toggle="tab">Satuan</a>
						  </li>
						</ul>

						<div class="tab-content">
						  <div id="tab_stock" class="tab-pane fade in active">
						    <table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap">
								<thead style="background: #3FD5C0;">
									<tr>
										<th class="text-center">Warehouse</th>
										<th class="text-center">Satuan </th>
										<th class="text-center">Stock On hand</th>								
									</tr>
								</thead>
								<tbody>
									@if(count(json_decode($stockResults)) > 0)
										@foreach(json_decode($stockResults) as $key => $value)
											
											<tr>
												<td>{{ $value->warehouse_name }}</td>
												<td>{{ $value->satuan }}</td>
												<td class="text-right">{{ $value->total_stock }}</td>
											</tr>									
										@endforeach
										
									@else
										<tr>
											<td colspan="3">Empty</td>
										</tr>	
									@endif
								</tbody>
							</table>
						  </div>
						  <div id="tab_satuan" class="tab-pane fade">
						     <table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap">
									<thead style="background: #3FD5C0;">
										<tr>
											<th class="text-center">Satuan</th>							
										</tr>
									</thead>
									<tbody>
										@if(count(json_decode($resultSatuans)) > 0)
											@foreach(json_decode($resultSatuans) as $key => $value)
												
												<tr>
													<td class="text-center">{{ $value->satuan_name }}</td>
												</tr>									
											@endforeach
											
										@else
											<tr>
												<td>Empty</td>
											</tr>	
										@endif
									</tbody>
								</table>
						  </div>
						</div>
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
<!-- ./wrapper -->
@include("master/footer_table")

</body>
</html