@include('label_global')
@include('pluggins.alertify')
<div id="div_content_page">
	<div class="portlet-body">
		<div class="page-bar">
	        <ul class="page-breadcrumb">
	            <li>
	                <a href="#">Asset</a>
	                <i class="fa fa-arrow-circle-right"></i>
	            </li>
	            <li>
	                <span>Daftar Asset</span>
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
		<hr/>
		 @include('form.refresh')
		 <p/>
		<div class="content-loader">

			<br/>

			<table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap table_master" id="table_asset">
				<thead >
					<tr>
						<th>Category</th>
						<th>Item</th>
						<th>Qty</th>
						<th>Satuan</th>
						<th></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	var gentable = null;
	$(document).ready(function()
	{
		gentable = $('#table_asset').DataTable(
		{
			scrollY:"300px",
		  	//scrollX:true,
	        scrollCollapse: true,
	        paging:false,
	        //fixedColumns: {leftColumns: 2,rightColumns: 1},	
          processing: true,
          ajax: "{{ url('/asset/getListAssets') }}",
          columns:[
                 { data: 'category',name: 'category',"bSortable": false},
				 { data: 'item_name',name: 'item_name',"bSortable": false},
                 { data: 'total',name: 'total',"bSortable": false},
                 { data: 'satuan',name: 'satuan',"bSortable": true},
                 
				 
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
          "columnDefs": [
				{targets:[0],visible:false}
				],
			"order": [[0,'asc']],//,
        	"drawCallback": function ( settings ) {
	            var api = this.api();
	            var rows = api.rows( {page:'current'} ).nodes();
	            var last=null;
	            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
	                if ( last !== group ) {
	                    $(rows).eq( i ).before(
	                        '<tr class="group success"><td colspan="4" style="text-align:left;padding:10px;"><strong>'+group+'</strong></td></tr>'
	                    );
	 
	                    last = group;
	                }
	            });
        	},
        	"initComplete": function(settings, json) {
        			$('.group').nextUntil('.group').css( "display", "none" );
        		}
		});

		var tbody = $('#table_asset tbody');

		tbody.on('click','.group',function()
			{
				$(this).nextUntil('.group').toggle();

			}).find('.group').each(function(i,v){
				var rowCount = $(this).nextUntil('.group').length;
				$(this).find('td:first').append($('<span />', { 'class': 'rowCount-grid' }).append($('<b />', { 'text': ' (' + rowCount + ')' })));
			});

		tbody.on('click','.detail',function()
			{
				var data = gentable.row($(this).parents('tr')).data();
				var id = data.item_id;
				$('#div_content').load("{{ url('/asset/details/') }}"+"/"+id);
			});

	});
</script>