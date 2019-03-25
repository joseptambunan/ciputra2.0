<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
   <link href="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
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
			                <a href="#">Purchase Order</a>
			            </li>
			            <li>
			                <span>List DP</span>
			            </li>
			        </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
              	<strong>Data DP untuk Purchase Order</strong>
	
				<hr />
				@include('form.a',
							[
								'href' => url('/purchaseorder/create_dp_po'),
								'caption' => 'Tambah',
								'class'=>'pull-right'
							])

	<form class="form-inline" method="post" action="{{ url('/inventory/barangmasuk_hibah/printReport') }}" id="form_cetak">
	  <div class="form-group">
	  	{{ csrf_field() }}
	    <label>Rentang Tanggal </label>
		    <div class="input-group" id="dtpicker">
		        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
		        	<input type="text" name="periode" id="periode" class="form-control"/>
		        	<input type="hidden" name="start_opname" id="start_opname" value="{{date('Y-m-d')}}" />
		        	<input type="hidden" name="end_opname" id="end_opname" value="{{date('Y-m-d')}}" />
		    </div>
	  </div>
	  <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</button>
	</form>
	<hr/>
		
		<table class="table table-striped table-bordered table-hover table-responsive table-checkable nowrap stripe row-border order-column table_master" id="table_data">
			<thead style="background-color: #3FD5C0;">
				<tr>
					<th>Vendor</th>
					<th>Nomor PO</th>
					<th>Total Nilai (Rp.)</th>
					<th>Total DP (%)</th>
					<th>Sisa Pembayaran</th>
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
@include("master/footer_table")
@include('pluggins.alertify')
@include('form.general_form')
<script type="text/javascript">
	var dtpicker = null;
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
          ajax: "{{ url('/purchaseorder/dp/getData') }}",
          columns:[
                 { data: 'vendor',name: 'vendor',"bSortable": false},
                 { data: 'po_number',name: 'po_number',"bSortable": true},
				         { data: 'total_po',name: 'total_po','sClass':'text-right',"bSortable": false},
                 { data: 'total_dp',name: 'total_dp','sClass':'text-right',"bSortable": false},
                 { data: 'saldo',name: 'saldo','sClass':'text-right',"bSortable": false},
                {
                  "className": "action text-center",
                  "data": null,
                  "bSortable": false,
                  "defaultContent": "" +
                  "<div class='' role='group'>" +
                  "<button type=\"button\" class=\"btn btn-success btn-xs detail\" rel='tooltip' data-toggle='tooltip' data-placement='left' title='Detail'><i class='fa fa-list'></i></button>" +
                  
                  "<span class=\"sr-only\">Action</span>" +
                  "</div>"
            }
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
                          '<tr class="group"><td colspan="5"><strong>'+group+'</strong></td></tr>'
                      );
   
                      last = group;
                  }
              } );
          }
      	});

      	
      	//tooltip
      $('body').tooltip({
        selector: '[rel=tooltip]'
      });

      var tbody = $("#table_data tbody");
      gentable.on('draw',function()
      {
          tbody.find('.text-right').each(function(i,v)
          {
            fnSetAutoNumeric($(this));
            fnSetMoney($(this),$(this).text());
            
          });
      });

	});
</script>

</body>
</html>

