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
			<button class="btn btn-primary" id="btn-back"><i class="fa fa-reply"></i> Kembali</button>
			@include('form.refresh')
		<hr />
		<br/>
		<div class="content-loader">
			{{ csrf_field() }}
			<input type="hidden" name="item_id" id="item_id" value="{{ $item_id }}" />
			<div class="col-lg-12 col-md-12 col-xs-12">
				<div class="panel panel-success">
			 		<div class="panel-heading"><strong>{{ $item_name }} = {{ $total }}</strong></div>
				 	<div class="panel-body">
						<table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap" id="detail_asset">
							<colgroup>
								<col style="width: 300px;"/>
								<col/>
								<col/>
								<col/>
								<col />
								<col/>
								<col/>
								<col/>
							</colgroup>
							<thead style="background: #3FD5C0;">
								<tr>
									<th>Departemen</th>
									<th class="text-center">Nilai Perolehan (Rp.)</th>
									<th class="text-center">Nilai Buku (Rp.)</th>
									<th>Batas Umur (Tahun)</th>
									<th>Satuan</th>
									<th>Lokasi</th>
									<th></th>
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

		var item_id = $('#item_id').val();
		gentable = $('#detail_asset').DataTable({
	        paging:false,
	        //fixedColumns: {leftColumns: 2,rightColumns: 1},	
	          processing: true,
	          ajax: "{{ url('/asset/getDetailsPerItem/') }}"+"/"+item_id,
	          columns:[
	          		 { data: 'departemen',name: 'departemen',"bSortable": true},
	                 
	                 { data: 'total_price',name: 'total_price',"className":"text-right","bSortable": false},
	                 
					 { data: 'penyusutan',name: 'penyusutan',"className":"text-right","bSortable": false},
					 { data: 'asset_age',name: 'asset_age',"className":"text-right","bSortable": false},
					 { data: 'satuan',name: 'satuan',"bSortable": false},
					 
					 { data: 'location',name: 'location',"bSortable": false},
	                {
	                  "className": "action text-center",
	                  "data": null,
	                  "bSortable": false,
	                  "defaultContent": "" +
	                  "<div class='' role='group'>" +
	                  "<button type=\"button\" class=\"btn btn-success btn-xs detail\" rel='tooltip' data-toggle='tooltip' data-placement='top' title='Detail'><i class='fa fa-list'></i></button>" +
	                  "</div>"
	            }
	          ],
	          "columnDefs": [{targets:[0],visible:false}],
	          "order": [[ 0, 'asc' ]],
	          "drawCallback": function ( settings ) {
	            var api = this.api();
	            var rows = api.rows( {page:'current'} ).nodes();
	            var last=null;
	            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
	                if ( last !== group ) {
	                    $(rows).eq( i ).before(
	                        '<tr class="group success"><td colspan="8" style="text-align:left;padding:10px;"><strong>'+group+'</strong></td></tr>'
	                    );
	 
	                    last = group;
	                }
	            });
        	}
		});

		var tbody = $('#detail_asset tbody');

		tbody.on('click','.detail',function()
		{
			//detail asset transaction
			var data = gentable.row($(this).parents('tr')).data();
			var asset_id = data.id;
			$('#div_content').load("{{ url('/asset/detailTransaction/') }}"+"/"+asset_id);
		});

		$('#btn-back').click(function()
		{
			var id = $(this).attr('data-id');
			$('#div_content').load("{{ url('/asset/daftarAsset') }}");
		});
	});
</script>