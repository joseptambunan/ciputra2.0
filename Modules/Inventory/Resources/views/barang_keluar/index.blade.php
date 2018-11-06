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
			                <a href="{{ url('/inventory/permintaan_barang/index') }}">Permintaan Barang : {{ is_null($permintaan) ? '' :$permintaan->no }}</a>
			            </li>
			            <li>
			            	<span>Barang Keluar</span>
			            </li>
			        </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
              	
              	@if($permintaan!=null)
					@if($permintaan->status_persetujuan == 1)
						@include('form.a',
							[
								'href' => url('/inventory/barang_keluar/add_form').'?id='.$permintaan->id,
								'class'=>'pull-right',
								'caption' => 'Tambah '
							])
						@include('form.a',
								[
									'href' => url('/inventory/permintaan_barang/index'),
									'class'=>'btn-danger',
									'caption' => 'Kembali'
								])

					@else
						<div class="alert alert-info"><i class="fa fa-info"></i> Status permintaan barang belum disetujui, anda tidak bisa melakukan transaksi barang keluar.</div>
						@include('form.a',
							[
								'href' => url('/inventory/permintaan_barang/index'),
								'caption' => 'Kembali'
							])
					@endif
				@endif

				<hr/>
				<strong>Data Barang Keluar</strong>
				<hr/>
              	@if($permintaan != null)
					<div class="panel panel-success">
						<div class="panel-heading">Permintaan Barang NO <strong>: {{ $permintaan->no}}</strong>
						</div>
						<div class="panel-body">
							
							<div class="col-lg-1 col-md-1 col-xs-1">
								<strong>PT.</strong>
								<br/>
								<strong>SPK</strong>
								<br/>
								<strong>Keterangan</strong>
							</div>
							<div class="col-lg-5 col-md-5 col-xs-5">
								<strong>: {{ $permintaan->pt->name }}</strong>
								<br/>
								<strong>: {{ $permintaan->spk->no or '-' }}</strong>
								<br/>
								<strong> : {{ $permintaan->description or '-' }}</strong>
							</div>

							<div class="col-lg-1 col-md-1 col-xs-1">
								<strong>Pengguna</strong>
								<br/>
								<strong>Tanggal</strong>
								<br/>
								<strong>Status</strong>
								
							</div>
							<div class="col-lg-5 col-md-5 col-xs-5">
								<strong>: {{ $permintaan->user->user_name or 'Kosong' }}</strong>
								<br/>
								<strong>: {{ date('d-m-Y',strtotime($permintaan->date)) }}</strong>
								<br/>
								<strong>: {{ $permintaan->StatusPermintaan->name  or '-' }}</strong>
							</div>

						</div>
					</div>
					@endif
					@include('inventory::barang_keluar.datatable')

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
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		var token = $('input[name=_token]').val();
		$('#table_data').DataTable(
			{
				scrollY:        "300px",
		        scrollCollapse: true,
		        paging:         false,
		        "order": [[ 0, 'asc' ]]
			});
		$('#table_data')
		.removeClass( 'display' )
		.addClass('table table-bordered');

		var sBody = $('#table_data tbody');

		sBody.on('click','.btn-print',function(){
			var id = $(this).attr('data-value');
			$('#barang_keluar_id').val(id);
			$('#frmprint').submit();
		}).
		/*on('click','.btn-approval',function()
		{
			var id = $(this).attr('data-value');

			var _datasend = {permintaan_barang_id:$(this).attr('data-parent'),id:id,_token:$('input[name=_token]').val()}
			$.ajax({
              type: 'POST',
              url: "{{ url('/barang_keluar/approval') }}",
              data: _datasend,
              dataType: 'json',
              beforeSend:function(){},
              success:function(data){
              	if(data.stat)
              	{
              		$('#div_content').load("{{ url('/barang_keluar/index') }}?id="+data.id);
              	}
              },
              error:function(xhr,status,errormessage)
              {},
              complete:function()
              {}
            });
		}).*/
		on('click','.delete-link',function()
		{
			var id = $(this).attr("id");
			var parent = $(this).parents("tr");
			$.confirm({
				title: 'Confirm Delete ?',
				icon: 'fa fa-warning',
				content: 'Are you sure delete?',
				autoClose: 'cancelAction|8000',
				buttons: {
					deleteUser: {
						text: 'Delete',
						btnClass: 'btn-red any-other-class',
						action: function () {
							$.post("{{ url('/inventory/barang_keluar/delete') }}", 
							{
								id:id,
								_token: token
							}, 
							function(data) {
								if(data)
								{
									parent[0].remove();
									alertify.success('success deleted!');
								}
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

</body>
</html>


