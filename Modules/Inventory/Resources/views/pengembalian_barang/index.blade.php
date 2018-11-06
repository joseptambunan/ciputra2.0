<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
  <!--link rel="stylesheet" type="text/css" href="//cdn.datatables.net/fixedcolumns/3.0.2/css/dataTables.fixedColumns.css"-->
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
	                <span>Pengembalian Barang</span>
	            </li>
			        </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
	@include('form.a',
				[
					'href' => url('/inventory/pengembalian_barang/add'),
					'caption' => 'Tambah'
				])
	<hr/>
	<table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap table_master" id="table_data">
			<thead>
				<tr>
					<th>#</th>
					<th>Nomor Barang Keluar</th>
					<th>Item</th>
					<th>Qty Pinjam</th>
					<th>Qty Kembali</th>
					<th>Satuan</th>
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
@include("master/footer_table")
@include('pluggins.alertify')
<script type="text/javascript">
	
	var gentable = null;
	$(document).ready(function(){
		gentable = $('#table_data').DataTable(
		{
		  //scrollY:        "300px",
	      //scrollX:        true,
	      //scrollCollapse: true,
	      //paging:         false,
          processing: true,
          ajax: "{{ url('/inventory/pengembalian_barang/getData') }}",
          columns:[
                 { data: 'nomor',name: 'nomor',"bSortable": true},
                 {data:'no_bk',name:'no_bk',"bSortable":false},
				 { data: 'item_name',name: 'item_name',"bSortable": false},
                 { data: 'qty_pinjam',name: 'qty_pinjam','sClass': 'text-right',"bSortable": false},
                 
				 { data: 'qty_kembali',name: 'qty_kembali','sClass': 'text-right',"bSortable": false},
				 { data: 'satuan_name',name: 'satuan_name','sClass': 'text-right',"bSortable": false}
          ],
          "columnDefs": [{ "visible": false, "targets": 0 }],
          "order": [[ 0, 'asc' ]],
          "drawCallback": function ( settings ) {
		            var api = this.api();
		            var rows = api.rows( {page:'current'} ).nodes();
		            var last=null;
		 
		            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
		                if ( last !== group ) {
		                    $(rows).eq( i ).before(
		                        "<tr class='group success'>"+
		                        "<td colspan='4' style='text-align:left;padding:10px;'><strong>"+group+"</strong></td>"+
		                        "<td style='text-align:right;padding:10px;'>"+
		                        "<button class='delete btn btn-danger btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='right' title='Hapus'><i class='fa fa-trash-o'></i></button>"
		                        +"<button type='button' class='btn btn-success btn-xs detail' rel='tooltip' data-toggle='tooltip' data-placement='top' title='Detail'><i class='fa fa-list'></i></button></td></tr>");
		                        last = group;
		                }
		            } );
		        }
      	});

      var sbody = $('#table_data tbody');

      sbody.on('click','.detail',function()
      {
	      	var data = gentable.row($(this).closest('tr').next('tr')).data();
	      	$('#div_content').load("{{ url('/pengembalian_barang/details/')}}/"+data.barangkeluar_id);
      }).on('click','.delete',function()
      {
      		var getItem = null;
      		getItem = gentable.row($(this).parents('tr')).data();
      		$.confirm({
			title: 'Confirm Delete ?',
			icon: 'fa fa-warning',
			content: 'Are you sure delete Key ID ' +getItem.id+ ' !',
			autoClose: 'cancelAction|8000',
			buttons: {
				deleteUser: {
					text: 'Delete',
					btnClass: 'btn-red any-other-class',
					action: function () {
						$.post("{{ url('/pengembalian_barang/delete') }}", 
						{
							id:getItem.id,
							_token: $('input[name=_token]').val()
						}, 
						function(data) {
							if(data.return=='1')
							{
								gentable.ajax.reload();
							}
						});	
						
						alertify.success("Sucessfully delete");
					}
				},
				cancelAction: function () {
					
				}
			}
		});
      		
      });
      	//tooltip
      $('body').tooltip({
        selector: '[rel=tooltip]'
      });

	});
</script>


