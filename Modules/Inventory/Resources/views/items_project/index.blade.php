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
                      <a href="{{ url('/inventory/stock/view_stock') }}">Inventory</a>
                  </li>
                  <li>
                      <span>Barang Proyek</span>
                  </li>
              </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
              	<strong>Barang  Proyek</strong>
              	@include('form.a',[
						'href'=> url('/inventory/items_project/add_form'),
						'class'=>'pull-right',
						'caption' => 'Tambah' 
					])
					<hr/>
              	{{ csrf_field() }}
			<table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column display nowrap table_master" id="table_data" boder="1">
				<thead>
					<tr>
						<th>Kategori</th>
						<th>Barang</th>
						<th>Stok Min.</th>
						<th>Satuan</th>
						<th></th>
					</tr>
				</thead>

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
@include('pluggins.alertify')
<script type="text/javascript" charset="utf-8">

	var gentable = null;
	$(document).ready(function() {
		var token = $('input[name=_token]').val();
		gentable = $('#table_data').DataTable(
		{
			"scrollY":"300px",
			"scrollX": false,
	        "scrollCollapse": true,
	        "paging":false,
	        
			"columnDefs": [
				{targets:[0],visible:false}
				],
			"order": [[0,'asc']],
			"processing": true,
        	"serverSide": true,
        	"ajax": "{{ url('/inventory/items_project/getData') }}",
        	"columns":[
                 	{ data: 'item_category',name: 'item_category',"bSortable": true},
                 	{ data: 'item_name',name: 'item_name',"bSortable": false},
                 	{ data: 'stock_min',name: 'stock_min','className':'text-right',"bSortable": false},
                  	{ data: 'satuan',name:'satuan',"bSortable": false},
	                {
	                  "className": "action text-center",
	                  "data": null,
	                  "bSortable": false,
	                  "defaultContent": "" +
	                  "<div class='' role='group'>" +
	                  " <button class='item_project btn btn-primary btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='top' title='Barang Project'><i class='fa fa-dollar'></i></button>"+
	                  " <button class='edit btn btn-primary btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='top' title='Edit'><i class='fa fa-edit'></i></button>"+
	                  " <button class='delete btn btn-danger btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='right' title='Hapus'><i class='fa fa-trash-o'></i></button>" +
	                  " <button class='btn-detail-items btn btn-warning btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='left' title='Details'><i class='fa fa-list'></i></button>"+
	                  "</div>"
	            	}
          	],
          	"drawCallback": function ( settings ) {
	            var api = this.api();
	            var rows = api.rows( {page:'current'} ).nodes();
	            var last=null;
	            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
	                if ( last !== group ) {
	                    $(rows).eq( i ).before(
	                        '<tr class="group success"><td colspan="6" style="text-align:left;padding:10px;"><strong>'+group+'</strong></td></tr>'
	                    );
	 
	                    last = group;
	                }
	            });
        	},
        	"initComplete": function(settings, json) {
        			$('.group').nextUntil('.group').css( "display", "none" );
        		}	
		});

		/*$('#table_data')
		.removeClass( 'display' )
		.addClass('table table-bordered');*/

		var sbody = $('#table_data tbody');

		sbody.on('click','.btn-detail-items',function()
		{
			var data = gentable.row($(this).parents('tr')).data();
			window.location.href="{{ url('/inventory/items_project/details/') }}/"+data.id;
		}).
		on('click','.edit',function()
		{
			var data = gentable.row($(this).parents('tr')).data();
			var edit_id = data.id;
			
			$.confirm({
				title: 'Confirm Edit ?',
				icon: 'fa fa-edit',
				content: 'Are you sure edit "'+data.item_name+ '" !',
				autoClose: 'cancelAction|8000',
				buttons: {
					deleteUser: {
						text: 'Edit',
						btnClass: 'btn btn-info',
						action: function () {
							window.location.href='{{ url("/inventory/items_project/edit") }}'+'/'+edit_id;
						}
					},
					cancelAction: function () {}
				}
			});
		}).
		on('click','.delete',function()
		{
			var data = gentable.row($(this).parents('tr')).data();
			var del_id = data.id;
			var token = $('input[name=_token]').val();
			$.confirm({
				title: 'Confirm Delete ?',
				icon: 'fa fa-warning',
				content: 'Are you sure delete "' +data.item_name+ '" ?',
				autoClose: 'cancelAction|8000',
				buttons: {
					deleteUser: {
						text: 'Delete',
						btnClass: 'btn-red any-other-class',
						action: function () {
							$.post("{{ url('/inventory/items_project/delete') }}", 
							{
								id:del_id,
								_token: token
							}, 
							function(data) {
								if(data)
								{
									gentable.ajax.reload();
									alertify.success('success deleted!',1);
								}
							});	
						}
					},
					cancelAction: function () {
						
					}
				}
			});
		}).on('click','.price',function(){
			var data = gentable.row($(this).parents('tr')).data();
			var view_id = data.id;
			window.location.href="{{ url('/inventory/items_price/index') }}"+'?id='+view_id;
		}).on('click','.group',function(){
				$(this).nextUntil('.group').toggle();
		}).find('.group').each(function(i,v){
				var rowCount = $(this).nextUntil('.group').length;
				$(this).find('td:first').append($('<span />', { 'class': 'rowCount-grid' }).append($('<b />', { 'text': ' (' + rowCount + ')' })));
		});
	});
</script>
</body>
</html>
