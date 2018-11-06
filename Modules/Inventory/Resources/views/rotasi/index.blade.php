@extends('layouts.master_asset')
@section('title','Rotasi')
@section('css')
<link rel="stylesheet" href="{{ url('/') }}/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection
@section('content')
<div class="panel panel-success">
  <div class="panel-heading"><a href="{{ url('/inventory/mutasi_out/index') }}"><strong>Daftar Rotasi</strong></a></div>
  <div class="panel-body">
  	<a href="{{ url('/inventory/rotasi/add') }}" class="btn btn-info"><i class="fa fa-plus"></i> Tambah</a>
    <!--button class="btn btn-success" type="button" id="btn_refresh"><i class="fa fa-refresh"></i> Refresh</button-->
    <p/>
    <table class="table table-bordered display table_master" id="table_master">
      <thead>
        <tr>
          <th class="text-center">#</th>
          <th class="text-center">Item</th>
          <th class="text-center">Barcode</th>
          <th class="text-center">Sumber</th>
          <th class="text-center">Tujuan</th>
          <th class="text-center">Tanggal</th>
          <th></th>
        </tr>
      </thead>
    </table>
  </div>
</div>
@endsection
@section('scripts')
<script src="{{ url('/')}}/assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ url('/')}}/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	var genTable = null;
	$(document).ready(function(){
		genTable = $('#table_master').DataTable(
			{
				  processing: true,
		          ajax: "{{ url('/inventory/rotasi/getData') }}",
		          columns:[
		                 { data: 'no',name: 'no',"className":"text-center","bSortable": true},
						 { data: 'item_name',name: 'item_name',"className":"text-center","bSortable": false},
		                 { data: 'barcode',name: 'barcode',"className":"text-center","bSortable": false},
		                 
						 { data: 'source',name: 'source',"className":"text-center","bSortable": false},
						 { data: 'dest',name: 'dest',"className":"text-center","bSortable": false},
						 {data:'date',name:'date',"className":"text-center","bSortable": false},
		                {
		                  "className": "action text-center",
		                  "data": null,
		                  "bSortable": false,
		                  "defaultContent": "" +
		                  "<div class='' role='group'>" +
		                  
		                  "  <button class='delete btn btn-danger btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='left' title='Hapus'><i class='fa fa-trash-o'></i></button>" +
		                  "<button type=\"button\" class=\"btn btn-success btn-xs detail\" rel='tooltip' data-toggle='tooltip' data-placement='right' title='Detail'><i class='fa fa-list'></i>" +
		                  "<span class=\"sr-only\">Action</span></button>" +
		                  "</div>"
		            }
		          ],
				/*columnDefs: [
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
				}*/
		  }
		);

		var sBody = $('#table_master tbody');
		sBody.on('click','.detail',function()
		{
			var data = genTable.row($(this).parents('tr')).data();
			console.log(data);
			window.location.href="{{ url('/inventory/rotasi/details/') }}"+"/"+data.id;
		});


		/*.on('click','.group',function()
		{
			$(this).nextUntil('.group').toggle();

		}).find('.group').each(function(i,v){
			var rowCount = $(this).nextUntil('.group').length;
			$(this).find('td:first').append($('<span />', { 'class': 'rowCount-grid' }).append($('<b />', { 'text': ' (' + rowCount + ')' })));
		})*/
	});
</script>
@endsection