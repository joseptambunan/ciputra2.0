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
			                <a href="{{ url('/inventory/stock/view_stock') }}">Inventory</a>
			            </li>
			            <li>
			                <span>Ruangan</span>
			            </li>
			        </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">

              	<div class="panel panel-success">
		 		<div class="panel-heading"><strong>Ruangan</strong> </div>
			 	<div class="panel-body">
					<ul class="nav nav-tabs" id="myTabs">
					  <li role="presentation" class="active">
					  	<a href="#tab_list" data-toggle="tab">List</a>
					  </li>
					  <li role="presentation">
					  	<a href="#tab_add" data-toggle="tab">Tambah</a>
					  </li>
					</ul>

					<br/>
					<div class="tab-content">
						  <div id="tab_list" class="tab-pane fade in active">
								<table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap table_master" id="table_data">
									<thead>
										<tr>
											<th>#</th>
											<th>Nama</th>
											
											<th>PT</th>
											<th></th>
										</tr>
									</thead>
								</table>
							</div>

							<div id="tab_add" class="tab-pane fade">
								<form action="{{ url('/inventory/room/store') }}" method="post" class="form-horizontal form-label-left" id="form_data" autocomplete="off">
									<div class="item form-group">
									    <label class="control-label col-md-3 col-sm-3 col-xs-12">Room Name</label>
									    <div class="col-md-5 col-sm-5 col-xs-12">
									    	{{ csrf_field() }}
									    	<input type="hidden" name="id" id="id" />
									    	<input type="text" class="form-control" name="name" id="name" />
									    </div>
								  	</div>

								  	<div class="item form-group">
									    <label class="control-label col-md-3 col-sm-3 col-xs-12">PT</label>
									    <div class="col-md-5 col-sm-5 col-xs-12">
									    	<select class='form-control select2' name='pt_id' id='pt_id'>
									    		<option value="">Pilih</option>
												@foreach($pts as $key => $value)
													<option value='{{ $value->pt->id }}'>({{ $value->pt->code }}) - {{ $value->pt->name }}</option>
												@endforeach
											</select>
									    </div>
								  	</div>

								  	
								  	<div class="ln_solid"></div>
									<div class="form-group">
										<div class="col-md-6 col-md-offset-3">
											<button id="send" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
											<button id="reset" type="reset" class="btn btn-warning"><i class="fa fa-times"></i> Reset</button>
										</div>
									</div>
								</form>
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
@include("master/footer_table")
@include('pluggins.alertify')
<script type="text/javascript">
	var gentable = null;
	$(document).ready(function() {
		var token = $('input[name=_token]').val();

		gentable = $('#table_data').DataTable({
			scrollY:        "300px",
	        scrollCollapse: true,
	        paging:         false,
			  processing: true,
	          ajax: "{{ url('/inventory/room/getData') }}",
	          columns:[
	                 { data: 'no',name: 'no',"bSortable": true},
	                 { data: 'name',name: 'name',"bSortable": false},
	                 { data: 'pt_name',name: 'pt_name',"bSortable": false},
	                {
	                  "className": "action text-center",
	                  "data": null,
	                  "bSortable": false,
	                  "defaultContent": "" +
	                  "<div class='' role='group'>" +
	                  
	                  "<button class='delete btn btn-danger btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='right' title='Hapus'><i class='fa fa-trash-o'></i></button>" +
	                  "<button class='edit btn btn-primary btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='right' title='Edit'><i class='fa fa-edit'></i></button>"+
	                  "</div>"
	            }
	          ],
	          "columnDefs": [],
	          "order": [[ 0, 'asc' ]]//,
	        	//fixedColumns :{leftColumns:1}
		});


		var sbody = $('#table_data tbody');

		sbody.on('click','.edit',function()
		{
			var data = gentable.row($(this).parents('tr')).data();
			$('#name').val(data.name);

			var element = document.getElementById('pt_id');
			element.value = data.pt_id;
			$('#id').val(data.id);
			$('#tab_add').addClass('in active').tab('show');
			$('#myTabs li:eq(1) a').tab('show');
		}).
		on('click','.delete',function()
		{
			var data = gentable.row($(this).parents('tr')).data();
				var id = data.id;

				$.confirm({
				title: 'Confirm Delete ?',
				icon: 'fa fa-warning',
				content: 'Are you sure ' +data.name+ ' ?',
				autoClose: 'cancelAction|8000',
				buttons: {
					deleteUser: {
						text: 'Delete',
						btnClass: 'btn-red any-other-class',
						action: function () {
							$.post("{{ url('/inventory/room/delete') }}", 
							{
								id:id,
								_token: token
							}, 
							function(data) {

								if(data)
								{
									alertify.success('success deleted',2);
									gentable.ajax.reload();
								}
							});	
							
						}
					},
					cancelAction: function () {
						
					}
				}
			});
		});


		$('#form_data').submit(function(e)
		{
			e.preventDefault();
			var _datasend = $(this).serialize();
			var _url = $(this).attr('action');
			$('#form_data input').attr("disabled", "disabled");
			
              $.ajax({
	                type: 'POST',
	                url: _url,
	                data: _datasend,
	                dataType: 'json',
	                beforeSend:function(){
	                	alertify.error('sending ...',4);
	                },
	                success:function(data){
	                	if(data)
	                	{
	                		
	                		alertify.success('success saved!',2);
	                		gentable.ajax.reload();
	                		$('#myTabs li:eq(0) a').tab('show');
	                		$('#form_data').find('#id,#name').val('');
	                		var element = document.getElementById('pt_id');
							element.value = '';
	                	}
	                },
	                error:function(xhr,status,errormessage)
	                {
	                	alertify.error('Warning '+xhr.responseText);
	                },
	                complete:function()
	                {
	                	$('#form_data input').removeAttr('disabled');
	                  	//$('.form-group').removeClass('has-success');
	                }
              });
		});
	});
</script>