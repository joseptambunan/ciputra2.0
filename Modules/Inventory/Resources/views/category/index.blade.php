@include('label_global')
<div id="div_content_page">
	<script type="text/javascript">
		$(document).ready(function(){
			$("#btn-view").hide();
			
			$("#btn-add").click(function(){
				$(".content-loader").fadeToggle('fast');
				$(".content-loader").load("{{ url('category/add_form') }}", function()
				{
					$(".content-loader").fadeIn('fast');
					$("#btn-add").hide();
					$("#btn-view").show();
				});
			});
			
			$("#btn-view").click(function(){
				$("#div_content_page").fadeToggle('fast');
				$("#div_content_page").load('{{ url('category/index') }}', function()
				{
					$("#div_content_page").fadeIn('fast');
				});
			});
			
			$("#btn-refresh").click(function(){
				$("#div_content_page").fadeToggle('fast');
				$("#div_content_page").load('{{ url('category/index') }}', function()
				{
					$("#div_content_page").fadeIn('fast');
				});
			});
		});
	</script>




	<div class="portlet-body">
		<h3 class="page-title"> Kategori
			<small>Informasi Kategori</small>
		</h3>
		<hr />
			<div style='float:right'>
				<btn href="javascript:;" class="btn btn-circle btn-icon-only blue" id="btn-refresh">
					<i class="fa fa-refresh"></i>
				</btn>
			</div>
		
			<btn class="btn sbold green" type="button" id="btn-add"> <span class="glyphicon glyphicon-pencil"></span> &nbsp; Tambah Data</btn>
			<btn class="btn btn-info" type="button" id="btn-view" style="display:none"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; Tampil</btn>
		<hr />
		
		<div id="div_message">
			@if(isset($_GET['update']))
				<div class="custom-alerts alert alert-success fade in"> Succesfully update on <span id='spn_tanggal'></span><script>document.getElementById('spn_tanggal').innerHTML = formattedtoday;</script></div>
			@endif
		</div>
		
		<div class="content-loader">
			@include('category.datatable')
		</div>
    </div>
    <br />
    <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/datatables-rowgrouping/js/jquery.dataTables.rowGrouping.js') }}"></script>
	<script type="text/javascript" charset="utf-8">
		var genTable = null;
		$(document).ready(function() {
			genTable = $('#table_data').DataTable({
				columnDefs: [
		            { "visible": false, "targets": 1 }
		          ],
		        "order": [[ 0, 'asc' ]],
				"drawCallback": function ( settings ) {
		            var api = this.api();
		            var rows = api.rows( {page:'current'} ).nodes();
		            var last=null;
		            api.column(1, {page:'current'} ).data().each( function ( group, i ) {
		              if ( last !== group ) {
		                $(rows).eq( i ).before(
		                  '<tr class="group success"><td colspan="6">'+group+'</td></tr>'
		                );
		               /// $(rows)
		                last = group;
		              }
		            });  
		        },
				"initComplete": function(settings, json) {
					$('.group').nextUntil('.group').css( "display", "none" );
				}	
			});
			
			var sBody = $('#table_data tbody');
			sBody.on('click','.group',function()
			{
				$(this).nextUntil('.group').toggle();

			}).find('.group').each(function(i,v){
				var rowCount = $(this).nextUntil('.group').length;
				$(this).find('td:first').append($('<span />', { 'class': 'rowCount-grid' }).append($('<b />', { 'text': ' (' + rowCount + ')' })));
			});
			$('#table_data')
			.removeClass( 'display' )
			.addClass('table table-bordered');
		});

	</script>
</div>
