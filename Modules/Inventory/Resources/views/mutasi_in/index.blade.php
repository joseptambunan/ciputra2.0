@extends('layouts.master_asset')
@section('title','Mutasi IN')
@section('css')
<link rel="stylesheet" href="{{ url('/') }}/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection
@section('content')
<div class="panel panel-success">
  <div class="panel-heading"><a href="{{ url('/inventory/mutasi_in/index') }}"><strong>Daftar Mutasi IN</strong></a></div>
  <div class="panel-body">
  	
    <button class="btn btn-success" type="button" id="btn_refresh"><i class="fa fa-refresh"></i> Refresh</button>
    <p/>
    <table class="table table-bordered display table_master" id="table_master">
      <thead>
        <tr>
          <th class="text-center">Perolehan</th>
          <th class="text-center">Sumber</th>
          <th class="text-center">Pemberi</th>
          <th class="text-center">Penerima</th>
          <th class="text-center">Item</th>
          <th class="text-center">Qty</th>
          <th class="text-center">Satuan</th>
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
	var fnRenderAsset = function(data,type,row)
	{
		var ret = "<button class='delete btn btn-danger btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='right' title='Hapus'><i class='fa fa-trash-o'></i></button>" +
		                  "<button type=\"button\" class=\"btn btn-success btn-xs detail\" rel='tooltip' data-toggle='tooltip' data-placement='top' title='Detail'><i class='fa fa-list'></i>" +
		                  "<span class=\"sr-only\">Action</span></button>" ;
		if(type == 'display')
		{
			if(data)
			{
				ret = "<button class='asset btn btn-primary btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='right' title='Asset'><i class='fa fa-building'></i></button>" +
				"<button class='delete btn btn-danger btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='right' title='Hapus'><i class='fa fa-trash-o'></i></button>" +
		                  "<button type=\"button\" class=\"btn btn-success btn-xs detail\" rel='tooltip' data-toggle='tooltip' data-placement='top' title='Detail'><i class='fa fa-list'></i>" +
		                  "<span class=\"sr-only\">Action</span></button>"
			}
		}

		return ret;
	}
	var genTable = null;
	$(document).ready(function(){
		$('#min').addClass('active');
		genTable = $('#table_master').DataTable(
		{
				processing: true,
		          ajax: "{{ url('/inventory/mutasi_in/getData') }}",
		          columns:[
		          		{ data: 'is_from',name: 'is_from',"className":"text-center","bSortable": true},
		                 { data: 'source',name: 'source',"className":"text-center","bSortable": false},
						 { data: 'giver',name: 'giver',"className":"text-center","bSortable": false},
		                 { data: 'recipient',name: 'recipient',"className":"text-center","bSortable": false},
		                 
						 { data: 'item_name',name: 'item_name',"className":"text-center","bSortable": false},
						 { data: 'qty',name: 'qty',"className":"text-center","bSortable": false},
						 { data: 'satuan',name: 'satuan',"className":"text-center","bSortable": false},
						 {data:'date',name:'date',"className":"text-center","bSortable": false},
		                {
		                  "className": "action text-center",
		                  data: 'confirm_by_warehouseman',
		                  name: 'confirm_by_warehouseman',
		                  "bSortable": false,
		                  render:fnRenderAsset
		              }
		          ],
		           "columnDefs": [
						{targets:[0],visible:false}
					],
					"order": [[0,'asc']],
		          "drawCallback": function ( settings ) {
			            var api = this.api();
			            var rows = api.rows( {page:'current'} ).nodes();
			            var last=null;
			            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
			                if ( last !== group ) {
			                    $(rows).eq( i ).before(
			                        '<tr class="group success"><td colspan="9" style="text-align:left;padding:10px;"><strong>'+group+'</strong></td></tr>'
			                    );
			 
			                    last = group;
			                }
			            });
		        	}
		  }
		);

	var tbody = $('#table_master tbody');

	tbody.on('click','.asset ',function()
	{
		var data = genTable.row($(this).parents('tr')).data();
		var _datasend = {'id':data.id,_token:$('input[name=_token]').val()};
        var _url = "{{ url('/inventory/mutasi_in/create_asset') }}"

          $.ajax({
                type: 'POST',
                url: _url,
                data: _datasend,
                dataType: 'json',
                beforeSend:function(){
                  //code here
                  alertify.success('sending ...');
                },
                success:function(data){
                  if(data.stat)
                  {
                      alertify.success('success');

                      window.location.href="{{ url('/inventory/mutasi_in/details_assets/') }}"+"/"+data.id;
                  }
                },
                error:function(xhr,status,errormessage)
                {}
            });

	});


	$('#btn_refresh').click(function()
	{
		genTable.ajax.reload();
	});

});
</script>
@endsection