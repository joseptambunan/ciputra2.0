@include('label_global')
@include('pluggins.editable_plugin')
<div id="div_content_page">
	<div class="portlet-body">
		<div class="page-bar">
	        <ul class="page-breadcrumb">
	            <li>
	                <a href="#">Inventory</a>
	                <i class="fa fa-arrow-circle-right"></i>
	            </li>
	            <li>
	                <a href="#">Asset</a>
	                <i class="fa fa-arrow-circle-right"></i>
	            </li>
	            <li>
	                <span>Details</span>
	            </li>
	        </ul>
	        <div class="page-toolbar">
	            <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
	                <i class="icon-calendar"></i>&nbsp;
	                <span class="thin uppercase hidden-xs"></span>&nbsp;
	                <i class="fa fa-angle-down"></i>
	            </div>
	        </div>
	    </div>
	    <h3 class="page-title">
				{{ $projectname }}
			</h3>
			<button class="btn btn-primary" id="btn-back" data-id="{{ $item_id }}"><i class="fa fa-reply"></i> Kembali</button>
			@include('form.refresh')
		<hr />
		<br/>
		<div class="content-loader">
			{{ csrf_field() }}
			<input type="hidden" name="asset_id" id="asset_id" value="{{ $asset_id }}" />
			<div class="col-lg-12 col-md-12 col-xs-12">
				<div class="panel panel-success">
			 		<div class="panel-heading"><strong>Rotasi {{ $item_name }}</strong></div>
				 	<div class="panel-body">
						<table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap" id="detail_asset">
							<thead style="background: #3FD5C0;">
								<tr>
					              <th rowspan="2" class="text-center">Pemberi</th>
					              <th rowspan="2" class="text-center">Penerima</th>
					              <th colspan="2" class="text-center">Departmen</th>
					              <th colspan="2" class="text-center">Kepada Ruangan/Lokasi</th>
					              <th rowspan="2" class="text-center">Tanggal</th>
					            </tr>
					            <tr>
					            	<td>Dari</td><td>Tujuan</td><td>Dari</td><td>Tujuan</td>
					            </tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<br />
</div>
<script type="text/javascript">
	var gentable = null;
	$(document).ready(function()
	{
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-Token': $('input[name=_token]').val()
		    }
		});

		var asset_id = $('#asset_id').val();
		gentable = $('#detail_asset').DataTable({
	        paging:false,
	        //fixedColumns: {leftColumns: 2,rightColumns: 1},	
	          processing: true,
	          ajax: "{{ url('/asset/getDetailTransactionPerItem/') }}"+"/"+asset_id,
	          columns:[
	          		 { data: 'pemberi',name: 'pemberi',"bSortable": true},
	                 { data: 'penerima',name: 'penerima',"className":"text-right","bSortable": false},
	                 { data: 'from_departement',name: 'from_departement',"className":"text-right","bSortable": false},
					 { data: 'to_department',name: 'to_department',"className":"text-right","bSortable": false},
	                 { data: 'from_room',name: 'from_room',"className":"text-right","bSortable": false},
	                 
					 { data: 'to_room',name: 'to_room',"className":"text-right","bSortable": false},
					 { data: 'date',name: 'date',"bSortable": false}	                
	          ],
	          "columnDefs": [],
	          "order": [[ 0, 'asc' ]],
		});

		$('#btn-back').click(function()
		{
			var id = $(this).attr('data-id');
			$('#div_content').load("{{ url('/asset/details/') }}"+"/"+id);
		});
	});
</script>