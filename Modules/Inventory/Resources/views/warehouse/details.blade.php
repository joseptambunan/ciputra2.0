<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
             <ul class="breadcrumb">
	            <li>
	                <a href="{{  url('/inventory/inventory/stock/view_stock') }}">Inventory</a>
	            </li>
	            <li>
	            	<a href="{{  url('/inventory/warehouse/index/') }}">Gudang {{ $warehouse->name }}</a>
	                
	            </li>
	            <li><span>Detail</span></li>
	        </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
              	<strong>Detail Gudang {{ $warehouse->name }}</strong>
              	<hr/>
              	@include('form.a',
				[
					'href' => url('/inventory/warehouse/index'),
					'class'=>'pull-right',
					'caption' => ' Kembali'
				])
				@include('form.a',
				[
					'href' => url('/inventory/warehouse/add_form'),
					'caption' => ' Tambah'
				])
				<hr/>
              	<div class="panel panel-success">
			 		<div class="panel-heading"><strong>Details {{ $warehouse->name }}</strong>
			 			<br/></div>

				 	<div class="panel-body">
				 		<button class="btn btn-primary pull-right" id="btn-edit"><i class="fa fa-edit"></i></button><br/>
				 		<div class="col-lg-3 col-md-3 col-xs-6">
				 			<strong>Kode</strong>
							<br/>
							<strong>Nama</strong>
							<br/>
							<strong>Departemen</strong>
							<br/>
							<strong>Kota</strong>
							<br/>
							<strong>Alamat</strong>
							<br/>
							<strong>Ditambahkan pada</strong>
							<br/>
							<strong>Diperbaharui pada</strong>
							
						</div>

						<div class="col-lg-6 col-md-6 col-xs-6">
							<strong>: <a href="#" class="editable_header" 
										data-pk="{{ $warehouse->id}}" 
										data-name="code" 
										data-url="{{url('/inventory/warehouse/update')}}" 
										data-original-title="Kode Gudang"
										data-type="text" 
										data-value="{{ $warehouse->code}}">{{ $warehouse->code or '-' }}</a></strong>
							<br/>
							<strong>: <a href="#" class="editable_header" 
										data-pk="{{ $warehouse->id}}" 
										data-name="name" 
										data-url="{{url('/inventory/warehouse/update')}}" 
										data-original-title="Nama Gudang"
										data-type="text" 
										data-value="{{ $warehouse->name}}">{{ $warehouse->name }}</a></strong>
							<br/>
							<strong>: <a href="#" class="editable_header" 
											data-pk="{{$warehouse->id}}" 
											data-name="department_id" 
											data-url="{{url('/inventory/warehouse/update')}}" 
											data-original-title="Pilih Departemen"
											data-type="select" 
											data-value="{{$warehouse->department_id}}" 
											data-source="{{url('/inventory/general/department_source')}}">{{ $warehouse->department->name or '-' }}</a></strong>
							<br/>
							<strong>: <a href="#" class="editable_header" 
											data-pk="{{$warehouse->id}}" 
											data-name="city_id" 
											data-url="{{url('/inventory/warehouse/update')}}" 
											data-original-title="Pilih Kota"
											data-type="select" 
											data-value="{{$warehouse->city_id}}" 
											data-source="{{url('/inventory/general/city_source')}}">{{ is_null($warehouse->city) ? '-' : $warehouse->city->name }}</a></strong>
							<br/>
							<strong>: <a href="#" class="editable_header" 
											data-pk="{{ $warehouse->id}}" 
											data-name="address" 
											data-url="{{url('/inventory/warehouse/update')}}" 
											data-original-title="Alamat"
											data-type="textarea"
											data-value="{{ $warehouse->address }}">{{ $warehouse->address  or '-' }}</a></strong>
							<br/>
							<strong>: {{ date('d-m-Y H:m:s',strtotime($warehouse->created_at)) }}</strong>
							<br/>
							<strong>: {{ date('d-m-Y H:m:s',strtotime($warehouse->updated_at)) }}</strong>
						</div>

				 	</div>
				 </div>

				 <table class="table table-striped">
					<thead>
						<tr>
							<th>PIC</th>
						</tr>
					</thead>
					<tbody>
						@foreach($warehouse->users as $key => $each)
							<tr>
								<td>
									{{ $each->user_name }}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
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
 @include('pluggins.editable_plugin')
@include('pluggins.alertify')
	<script type="text/javascript" charset="utf-8">
		$.ajaxSetup({
    headers: {
                  'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                }
    });
  $.fn.editable.defaults.mode = 'inline';
		$(document).ready(function()
		{
			
			$('.editable_header').editable({
					disabled:true,
					ajaxOptions: {
					    type: 'post',
					    dataType: 'json'
					},
					success:function(data)
					{
						if(data)
						{
							alertify.success('success updated',3);
						}
					}
				}
			);

			$('#btn-edit').click(function()
			{
				$('.editable_header').editable('toggleDisabled');
			})
		});
	</script>
</body>
</html>