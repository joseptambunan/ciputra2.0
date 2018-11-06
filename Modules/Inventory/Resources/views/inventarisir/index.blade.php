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
			                <a href="{{ url('/inventory/inventory/stock/view_stock') }}">Inventory</a>
			            </li>
			            <li>
			                <a href="{{ url('/inventory/permintaan_barang/index') }}">Permintaan Barang</a>
			            </li>
			            <li>
			            	<a href="{{ url('/inventory/barang_keluar/index').'?id='.$barangkeluar->permintaanbarang->id }}">Barang Keluar {{ $barangkeluar->no }}</a>
			            </li>
			            <li>
			            	<span>Mutasi IN</span>
			            </li>
			        </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
				<strong>Mutasi IN Dari Nomor Barang Keluar : {{ is_null($barangkeluar) ? '-' : $barangkeluar->no}}</strong>
		
			<hr />
			@if(!is_null($barangkeluar))
				@include('form.a',
					[
						'href' => url('/inventory/inventarisir/add_form').'?id='.$barangkeluar->id,
						'caption' => 'Tambah'
					])

				@include('form.a',
					[
						'href' => url('/inventory/barang_keluar/index').'?id='.$barangkeluar->permintaanbarang_id,
						'caption' => 'Kembali'
					])
				@else
					@include('form.a',
					[
						'href' => url('/inventory/inventarisir/add_form'),
						'caption' => 'Tambah'
					])
			@endif
			<hr/>
			@include('inventory::inventarisir.datatable')
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
@include('pluggins.alertify')
<script type="application/javascript">
	var gentable=null;
	$(document).ready(function()
	{
		gentable = $('#table_data').DataTable(
					{
						paging:         false
						/*scrollY:        "300px",
						scrollX:true,
				        scrollCollapse: true,
				        
				        fixedColumns:   {
				         leftColumns: 3
				        },
				        "order": [[ 0, 'asc' ]]*/
					});

		var sBody =$('#table_data tbody');

		sBody.on('click','.delete-link',function(){
				var del_id = $(this).attr('id');
				var token = $('input[name=_token]').val();
				var parent = $(this).parent("td").parent("tr");
				$.confirm({
				title: 'Confirm Delete ?',
				icon: 'fa fa-warning',
				content: 'Are you sure delete Key ID ' +del_id+ ' !',
				autoClose: 'cancelAction|8000',
				buttons: {
					deleteUser: {
						text: 'Delete',
						btnClass: 'btn-red any-other-class',
						action: function () {
							$.post('{{ url('/inventory/inventarisir/delete') }}', 
							{
								id:del_id,
								_token: token
							}, 
							function(data) {
								console.log(data);
								if(data == '1')
								{
									parent.fadeToggle('fast');
								}
							});
							
							$("#div_message").html('<div class="custom-alerts alert alert-warning fade in">Sucessfully delete on '+ formattedtoday +'</div>');
						}
					},
					cancelAction: function () {}
				}
			});
		});
	});
</script>
</body>
</html>