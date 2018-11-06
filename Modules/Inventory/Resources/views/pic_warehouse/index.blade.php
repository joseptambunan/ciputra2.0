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
                      <a href="{{ url('/inventory/warehouse/index') }}">{{$users_warehouse->name}}</a>
                  </li>
                  <li>
                  	<span>Detail</span>
                  </li>
              </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">

				<strong> PIC : {{ $users_warehouse->name }}
				</strong>
				@include('form.a',[
						'href'=> url('/inventory/warehouse/index'),
						'class'=>'pull-right',
						'caption' => 'Kembali' 
					])
				<hr />
				

					@include('inventory::pic_warehouse.datatable')
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
@include('pluggins.alertify')
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#table_data').DataTable({
			paging:false
		});

		$(".delete-link").click(function() {
		var user_id 	 = $(this).attr("data-user-id");
		var warehouse_id = $(this).attr("data-warehouse-id");
		var parent = $(this).parents('tr');
		var token = $('input[name=_token]').val();
		
		$.confirm({
			title: 'Confirm Delete ?',
			icon: 'fa fa-warning',
			content: 'Are you sure delete Key ID ' +user_id+ ' !',
			autoClose: 'cancelAction|8000',
			buttons: {
				deleteUser: {
					text: 'Delete',
					btnClass: 'btn-red any-other-class',
					action: function () {
						$.post("{{ url('/inventory/warehouse/pic/delete') }}", 
						{
							user_id:user_id,
							warehouse_id:warehouse_id,
							_token: token
						}, 
						function(data) {
							parent[0].remove();
							alertify.success('success deleted!',2);
						});	
						
					}
				},
				cancelAction: function () {
					
				}
			}
		});
		return false;
	});
	});
</script>