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

  @include("master/sidebar")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>SATUAN</h1>

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
                       <a href="{{ url('/inventory/items/index') }}">Barang</a>
                  </li>
                  <li>
                  	<span>Satuan {{ is_null($items) ? '' : $items->name }}</span>
                  </li>
              </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
              	<strong>Satuan :<span class="text-uppercase">
						@if($request->id)
							{{ $items->name }}
						@else
							semua data barang
						@endif
				</span></strong>
				<br/>
				@if($items != null)
					@include('form.a',[
							'href'=> url('/inventory/items/index').'?id='.$items->id,
							'class'=>'pull-left',
							'caption' => 'Kembali' 
						])
	              	@include('form.a',[
							'href'=> url('/inventory/items_satuan/add_form').'?id='.$items->id,
							'class'=>'pull-right',
							'caption' => 'Tambah' 
						])
				@endif
					<br/>
					<hr/>
              	<input type="hidden" name="item_id" id="item_id" value="{{ is_null($request->id) ? '' : $items->id }}" />
              	
              	@include('inventory::items_satuan.datatable')

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
		var gentable = null;
		  $.ajaxSetup({
    				headers: {
                  'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                }
    });
  $.fn.editable.defaults.mode = 'inline';
		$(document).ready(function() {
			gentable = $('#table_data').DataTable(
			{
				"columnDefs": [
            		{ "visible": false, "targets": 0 }
		        ],
		        "order": [[ 0, 'asc' ]],
		        "drawCallback": function ( settings ) {
			            var api = this.api();
			            var rows = api.rows( {page:'current'} ).nodes();
			            var last=null;
			 
			            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
			                if ( last !== group ) {
			                    $(rows).eq( i ).before(
			                        '<tr class="success group"><td colspan="5" style="text-align:left;padding:10px;"><strong>'+group+'</strong></td></tr>'
			                    );
			 
			                    last = group;
			                }
			            } );
        		}
			});

			$('#project_idcheck').change(function()
			{
				console.log($(this).val());
			});

			$(".delete-link").click(function() {
					var id = $(this).attr("id");
					var del_id = id;
					var parent = $(this).parent("td").parent("tr");
					var token = $('input[name=_token]').val();
					
					$.confirm({
						title: 'Confirm Delete ?',
						icon: 'fa fa-warning',
						content: 'Are you sure delete ?',
						autoClose: 'cancelAction|8000',
						buttons: {
							deleteUser: {
								text: 'Delete',
								btnClass: 'btn-red any-other-class',
								action: function () {
									$.post("{{ url('/inventory/items_satuan/delete') }}", 
									{
										id:del_id,
										_token: token
									}, 
									function(data) {
										if(data)
										{
											parent[0].remove();
											alertify.success('success delete');
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
	
	
	$('.editable_header').editable({
				ajaxOptions: {
				    type: 'post',
				    dataType: 'json'
				},
				success:function(data)
				{
					if(data.return==1)
					{
						alertify.success('success');
					}
				}
			});

		});
	</script>
</body>
</html>
