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
			                <a href="{{ url('/inventory/permintaan_barang/index') }}">Permintaan Barang : {{ $permintaan->no}}</a>
			            </li>
			            <li>
			            	<a href="{{ url('/inventory/barang_keluar/index').'?id='.$permintaan->id }}">Barang Keluar {{ $barangkeluars->no }}</a>
			            </li>
			            <li>
			            	<span>Detail</span>
			            </li>
			        </ul>
            <!-- /.box-header -->
            <div class="box-body">
            	<strong>Detail Barang Keluar</strong>
            	@include('form.a',
				[
					'href' => url('/inventory/barang_keluar/index').'?id='.$permintaan->id,
					'class'=>'pull-right',
					'caption' => 'Kembali'
				])
              <div class="col-md-12">
              	<ul class="nav nav-tabs">
				  <li role="presentation" class="active">
				  	<a href="#tab_permintaan" data-toggle="tab">Dokumen Permintaan</a>
				  </li>
				  <li role="presentation">
				  	<a href="#tab_barangkeluar" data-toggle="tab">Dokumen Barang Keluar</a>
				  </li>
				</ul>
	
				<hr />
				<div class="tab-content">
					<div id="tab_permintaan" class="tab-pane fade in active">
						<div class="col-lg-12 col-md-12 col-xs-12">
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
								<strong>: {{ $permintaan->user->user_name }}</strong>
								<br/>
								<strong>: {{ date('d-m-Y',strtotime($permintaan->date)) }}</strong>
								<br/>
								<strong>: {{ $permintaan->StatusPermintaan->name  or '-' }}</strong>
							</div>

						</div>
					</div>

				</div>
					</div>
					<div id="tab_barangkeluar" class="tab-pane fade">
						<div class="col-lg-12 col-md-12 col-xs-12">
							<div class="panel panel-success">
								<div class="panel-heading"><strong>Barang Keluar No : {{ $barangkeluars->no }}</strong></div>
								<div class="panel-body">
									<div class="col-lg-3 col-md-3 col-xs-6">
										
										<strong>Konfirmasi Kepala Gudang</strong>
										<br/>
										<strong>Konfirmasi Peminta</strong>
									</div>
									<div class="col-lg-3 col-md-3 col-xs-6">
										
										<strong>: {{ $barangkeluars->confirmed_by_warehouseman ? 'sudah' : 'belum' }}</strong>
										<br/>
										<strong>: {{ $barangkeluars->confirmed_by_requester ? 'sudah' : 'belum'}}</strong>
									</div>

									<div class="col-lg-3 col-md-3 col-xs-6">
										<strong>Tanggal</strong>
										<br/>
										<strong>Description</strong>
									</div>
									<div class="col-lg-3 col-md-3 col-xs-6">
										<strong>: <a href="#" class="editable_header" 
										data-pk="{{ $barangkeluars->id}}" 
										data-name="date" 
										data-url="{{url('/barang_keluar/edit')}}" 
										data-original-title="Pilih"
										data-type="date"
										data-value="{{ date('Y-m-d',strtotime($barangkeluars->date)) }}">
										{{ date('d-m-Y',strtotime($barangkeluars->date)) }}</a></strong>
										<br/>
										<strong>: <a href="#" class="editable_header" 
										data-pk="{{ $barangkeluars->id}}" 
										data-name="description" 
										data-url="{{url('/barang_keluar/edit')}}" 
										data-original-title="Pilih"
										data-type="textarea"
										data-value="{{ $barangkeluars->description }}">{{ $barangkeluars->description or '-' }}</a></strong>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
				@include('inventory::barang_keluar_detail.datatable')

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
@include('pluggins.alertify')
<script type="text/javascript" charset="utf-8">
	$.fn.editable.defaults.mode = 'inline';
	$(document).ready(function() {
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

		$.ajaxSetup({
		    headers: {
		        'X-CSRF-Token': $('input[name=_token]').val()
		    }
		});
		$('.editable_header').editable({
				ajaxOptions: {
				    type: 'post',
				    dataType: 'json'
				},
				success:function(data)
				{
					if(data.return==1)
					{
						var _url = "{{ url()->full() }}";
						_url = _url.replace(/&amp;/,'&');

						$('#div_content').load(_url);
					}
				}
			}
		);

		$(".delete-link").click(function() {
		var id = $(this).attr("id");
		var del_id = id;
		var parent = $(this).parent("td").parent("tr");
		var token = $('input[name=_token]').val();
		
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
						$.post('{{ url('/inventory/barang_keluar_detail/delete') }}', 
						{
							id:del_id,
							_token: token
						}, 
						function(data) {
							parent.fadeToggle('fast');
						});	
						
						$("#div_message").html('<div class="custom-alerts alert alert-warning fade in">Sucessfully delete on '+ formattedtoday +'</div>');
					}
				},
				cancelAction: function () {
					
				}
			}
		});
		return false;
	});
	
	$(".edit-link").click(function() {
		var id = $(this).attr("id");
		var edit_id = id;
		var permintaanbarang_id = $("#permintaanbarang_id").val().trim();
		var barangkeluar_id = $("#barangkeluar_id").val().trim();
		var token = $('input[name=_token]').val();
		
		$.confirm({
			title: 'Confirm Edit ?',
			icon: 'fa fa-edit',
			content: 'Are you sure edit Key ID '+edit_id+ ' !',
			autoClose: 'cancelAction|8000',
			buttons: {
				deleteUser: {
					text: 'Edit',
					btnClass: 'btn btn-info',
					action: function () {
						$(".content-loader").fadeToggle('fast', function() {
							$(".content-loader").fadeIn('fast');
							$(".content-loader").load('{{ url('/inventory/barang_keluar_detail/edit_form') }}'+'?id='+edit_id+'&permintaanbarang_id='+permintaanbarang_id+'&barangkeluar_id='+barangkeluar_id);
							
							$("#btn-add").hide();
							$("#btn-view").show();
						});
					}
				},
				cancelAction: function () {
					
				}
			}
		});
		return false;
	});
	
	$(".create_price-link").click(function() {
		var id = $(this).attr("id");
		var view_id = id;
		var permintaanbarang_id = $("#permintaanbarang_id").val().trim();
		var barangkeluar_id = $("#barangkeluar_id").val().trim();
		var token = $('input[name=_token]').val();
		
		$.confirm({
			title: 'Confirm Create Price ?',
			icon: 'fa glyphicon glyphicon-pencil',
			content: 'Are you sure Create Price Key ID '+view_id+ ' !',
			autoClose: 'cancelAction|8000',
			buttons: {
				deleteUser: {
					text: 'Create',
					btnClass: 'btn green',
					action: function () {
						$("#div_content_page").fadeToggle('fast', function() {
							$("#div_content_page").fadeIn('fast');
							$("#div_content_page").load('{{ url('/inventory/barang_keluar_detail_prices/index') }}'+'?id='+view_id+'&permintaanbarang_id='+permintaanbarang_id+'&barangkeluar_id='+barangkeluar_id);
							
							$("#btn-add").hide();
							$("#btn-view").show();
						});
					}
				},
				cancelAction: function () {}
			}
		});
		return false;
	});

	var body = $('#table_data tbody');

	body.on('click','.button-give',function()
	{
		var id = $(this).attr('data-id');
		var button = $(this);
		var _url = "{{ url('/inventory/barang_keluar_detail/sent') }}";
		var token = $('input[name=_token]').val();
		var _data = {
			id:id,
			_token:token
		};

		var td = button.parent('td');
		
		$.ajax({
			type:'post',
			url :_url,
			data:_data,
			dataType:'json',
			success:function(get)
			{
				if(get)
				{
					alertify.success('Berhasil');
					td.text('Tuntas');
					button.remove();
				}
			}
		});
	});
	});
</script>

</body>
</html>



