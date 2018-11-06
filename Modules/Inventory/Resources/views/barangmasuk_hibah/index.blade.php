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
			                <span>Barang Masuk</span>
			            </li>
			        </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
              	<strong>Data Barang Masuk Hibah</strong>
				<strong>
					PT     : {{$pt}}
				</strong>
	
				<hr />
				@include('form.a',
							[
								'href' => url('/inventory/barangmasuk_hibah/add_form'),
								'caption' => 'Tambah'
							])
	<a href="{{ url('/inventory/barangmasuk_hibah/printReport') }}" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</a>
	<br/>

		{{ csrf_field() }}
		<table class="table table-striped table-bordered table-hover table-responsive table-checkable nowrap stripe row-border order-column table_master" id="table_data">
			<thead style="background-color: #3FD5C0;">
				<tr>
					<th rowspan="2">#</th>
					<th rowspan="2">Nomor</th>
					<th colspan="2" style="text-align:center;">DARI</th>
					<th rowspan="2">Tanggal</th>
					<th rowspan="2">Total</th>
					<th rowspan="2">Masuk</th>
					<th rowspan="2">Retur</th>
					<th rowspan="2">Status</th>
					<th rowspan="2"></th>
					<th rowspan="2"></th>
				</tr>
				<tr>
					<th class="text-center">Proyek</th>
					<th class="text-center">PT</th>
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
<!--script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.4/js/dataTables.fixedColumns.min.js"></script-->


<script type="text/javascript">
	var fnSelisih = function(data,type,row)
	{
		var retVal = "";//+"<button class='tambah_item btn btn-primary btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='left' title='Tambah'>"+ data+" <i class='fa fa-plus'></i></button>";
		if (type == 'display') {
			if(row.status == 2)
			{
				retVal = "<button class='tambah_item btn btn-primary btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='left' title='Tambah'><i class='fa fa-check'></i></button> ";
			}
			else
			{
				retVal ="<button class='tambah_item btn btn-primary btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='left' title='Tambah'>"+ data+" <i class='fa fa-plus'></i></button>";
			}
		}
		return retVal;
	}
	var fnLabelStatus = function(data,type,row)
	{
		var retVal = "";
		if (type == 'display') {

			if(parseInt(data)==2)
			{
				retVal ="<label>Approved</label>";
			}
			else if(parseInt(data)==1)
			{
				retVal ="<label>Delivered</label>";
			}
			else
			{
				retVal = "<label>Open</label>";
			}
		}
		return retVal;
	}
	var fnCheckStatus = function(data, type, row)
	{
		var retVal = "<button class='approve btn btn-info btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='left' title='Click to Approve'>Approve</button>";
		if (type == 'display') {
			if(parseInt(data)>1)
			{
				retVal ="<button class='unapprove  btn btn-success btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='left' title='Click to UnApprove'>UnApprove</button>";
			}
		}
		return retVal;
	}
	var gentable = null;
	$(document).ready(function(){
		gentable = $('#table_data').DataTable(
		{
		  	scrollY:"300px",
		  	//scrollX:true,
	        scrollCollapse: true,
	        paging:false,
	        //fixedColumns: {leftColumns: 2,rightColumns: 1},	
          processing: true,
          ajax: "{{ url('/inventory/barangmasuk_hibah/getData') }}",
          columns:[
                 { data: 'nomor',name: 'nomor',"bSortable": false},
                 { data: 'no',name: 'no',"bSortable": true},
				 { data: 'from_project_name',name: 'from_project_name',"bSortable": false},
                 { data: 'from_pt_name',name: 'from_pt_name',"bSortable": false},
                 
				 { data: 'tanggal_hibah',name: 'tanggal_hibah',"bSortable": false},
				 { data: 'total',name: 'total',"className":"text-right","bSortable": false},
				 { data: 'diisi',name: 'diisi',"className":"text-right","bSortable": false},
				 { data: 'reject',name: 'reject',"className":"text-right","bSortable": false},
				 { data: 'status',name:'status',render:fnLabelStatus,"className":"text-center","bSortable":false},
				 
				 { data: 'selisih',name: 'selisih',render:fnSelisih,"className":"text-center","bSortable": false},
                {
                  "className": "action text-center",
                  "data": null,
                  "bSortable": false,
                  "defaultContent": "" +
                  "<div class='' role='group'>" +
                  "<button class='delete btn btn-danger btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='left' title='Hapus'><i class='fa fa-trash-o'></i></button>" +
                  "<button type=\"button\" class=\"btn btn-success btn-xs detail\" rel='tooltip' data-toggle='tooltip' data-placement='left' title='Detail'><i class='fa fa-list'></i></button>" +
                  "<button class='listreject btn btn-warning btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='left' title='Detail Tolak'><i class='fa fa-times-circle-o'></i></button>" +
                  "<button class='print btn btn-primary btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='left' title='Cetakan'><i class='fa fa-print'></i></button>" +
                  "<span class=\"sr-only\">Action</span>" +
                  "</div>"
            }
          ],
          "columnDefs": [],
          "order": [[ 0, 'asc' ]]//,
        	//fixedColumns :{leftColumns:1}
      	});

      var sbody = $('#table_data tbody');

      sbody.on('click','.approve',function(){
	      	var data = gentable.row($(this).parents('tr')).data();
	      	var _datasend ={'id':data.id,_token:$('input[name=_token]').val()};
	      	var _url = "{!! url('/inventory/barangmasuk_hibah/approve') !!}"
	      	$.ajax({
	            type: 'POST',
	            url: _url,
	            data: _datasend,
	            dataType: 'json',
	            beforeSend:function(){
	            	//code here
	            	alertify.success('Sending Request ...');
	            },
	            success:function(data){
	            	if(data.return)
	            	{
	            		alertify.success("Success Approved ");
	            		gentable.ajax.reload();
	            	}
	            	else
	            	{
	            		alertify.success("Error Terjadi Kesalahan");
	            	}
	            },
	            error:function(xhr,status,errormessage)
	            {
	            	alertify.danger('Warning : '+xhr.statusText);
	            }
	        });
	     }).on('click','.unapprove',function(){
		      	var data = gentable.row($(this).parents('tr')).data();
		      	var _datasend ={'id':data.id,_token:$('input[name=_token]').val()};
		      	var _url = "{!! url('/inventory/barangmasuk_hibah/unapprove') !!}"
		      	$.ajax({
		            type: 'POST',
		            url: _url,
		            data: _datasend,
		            dataType: 'json',
		            beforeSend:function(){
		            	//code here
		            	alertify.success('Sending Request ...');
		            },
		            success:function(data){
		            	if(data.return)
		            	{
		            		alertify.success("Success UnApproved, Silahkan Edit ");
		            		gentable.ajax.reload();
		            	}
		            	else
		            	{
		            		alertify.success("Error Terjadi Kesalahan");
		            	}
		            },
		            error:function(xhr,status,errormessage)
		            {
		            	alertify.danger("Error Terjadi Kesalahan "+xhr.statusText);
		            },
		            complete:function()
		            {}
		      });
      }).
      on('click','.detail',function()
      {
      		var data = null;
	      	data = gentable.row($(this).parents('tr')).data();
	      	window.location.href = "{{ url('/inventory/barangmasuk_hibah/details/')}}/"+data.id;
      }).
      on('click','.tambah_item',function()
      {		
      		var getItem = null;
      		getItem = gentable.row($(this).parents('tr')).data();
      		window.location.href="{{ url('/inventory/barangmasuk_hibah/add_details')}}/"+getItem.id;
      })
      .on('click','.delete',function()
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
						$.post("{{ url('/inventory/barangmasuk_hibah/delete') }}", 
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
						
						alertify.success("Sucessfully deleted");
					}
				},
				cancelAction: function () {}
			}
		});
      		
      }).on('click','.listreject',function()
      {
      		var data = gentable.row($(this).parents('tr')).data();
      		window.location.href = "{{ url('/inventory/barangmasuk_hibah/details_reject')}}/"+data.id;
      }).on('click','.print',function()
      {
      		var data = gentable.row($(this).parents('tr')).data();

      		window.location.href="{{ url('/inventory/barangmasuk_hibah/cetakBarangMasuk') }}"+"/"+data.id;
      });
      	//tooltip
      $('body').tooltip({
        selector: '[rel=tooltip]'
      });

	});
</script>

</body>
</html>

