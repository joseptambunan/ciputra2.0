@extends('layouts.master_asset')
@section('title','Mutasi IN')
@section('css')
<link href="{{ URL::asset('assets/global/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/global/plugins/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/global/plugins/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/global/plugins/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ URL::asset('assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css')}}" type="text/css"/>
  <link href="{{ URL::asset('assets/global/plugins/typeahead/typeahead.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="panel panel-success">
  <div class="panel-heading"><a href="{{ url('/mutasi_in/index') }}"><strong>Mutasi IN Detail Asset = {{ $item_name }}</strong></a></div>
  <div class="panel-body">
  	<a href="{{ url('/mutasi_in/index') }}" class="btn btn-primary" ><i class="fa fa-reply"></i> Kembali</a>

  	<button class="btn btn-primary pull-right" id="btn-print" data-value="{{ $mutasi_in_id }}"><i class="fa fa-print"></i> QrCode</button>

  	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<form name="form-department" id="form-department" method="post" action="{{ url('/mutasi_in/details_assets/postDepartment') }}" autocomplete="off">
	  		<div class="input-group">
	  			
	  			<input type="hidden" name="department_id" id="department_id" />
	  			<input type="text" name="department" id="department" class="form-control typeahead" placeholder="Departemen" />
	  			<div class="input-group-addon">
	  				<button type="submit" class="btn btn-warning btn-xs"><i class="fa fa-check"></i></button>
	  			</div>
	  			<input type="hidden" name="asset_id" id="asset_id" />
	  			{{ csrf_field() }}
	  			
	  		</div>
		</form>
  	</div>
    <p/>
    
    <input type="hidden" name="mutasi_in_id" id="mutasi_in_id" value="{{ $mutasi_in_id }}" />
    
   <table class="table table-bordered display table_master" id="table_data">
	<thead>
		<tr>
			<th>#</th>
			<th>Satuan</th>
			<th>Kode</th>
			<th>Departemen</th>
			<th>Pemegang</th>
			<th>Penempatan</th>
			<th>Harga Perolehan (Rp.)</th>
			<!-- <th>Ppn (%)</th>
			<th>Nilai Ppn (Rp.)</th>
			<th>Total Harga (Rp.)</th> -->
			<th>Umur Ekonomis (Tahun)</th>
			<th>Deskripsi</th>
		</tr>
	</thead>
	
</table>
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ URL::asset('assets/global/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL::asset('assets/global/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js')}}" ></script>
<script src="{{ URL::asset('assets/global/plugins/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}" ></script>
<script src="{{ URL::asset('assets/global/plugins/datatables.net-responsive/js/dataTables.responsive.min.js')}}" ></script>
<script src="{{ URL::asset('assets/global/plugins/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}" ></script>
<script src="{{ URL::asset('assets/global/plugins/datatables.net-scroller/js/dataTables.scroller.min.js')}}" ></script>
<script type="text/javascript" src="{{ URL::asset('assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/global/plugins/typeahead/typeahead.bundle.min.js') }}"></script>
 <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/typeahead/bootstrap3-typeahead.min.js') }}"></script>

<script src="{{ URL::asset('vendor/jsvalidation/js/jsvalidation.min.js')}}" type='text/javascript'></script>
{!! JsValidator::formRequest('App\Http\Requests\RequestMutasiInValidationDepartemen', '#form-department') !!}
<script type="text/javascript" src="{{ URL::asset('assets/global/plugins/autonumeric/autoNumeric.js') }}"></script>
<script type="text/javascript">
	
	var gentable = null;
	var arrTransaction = [];
	var priceInput;
	var fnEditableUser = function(data,type,row,meta)
	{
		return '<a href="#" class="editable_header" data-pk="'+row.id+'" data-name="to_user_id" data-url="{{url("/asset/update")}}" data-original-title="Pemegang" data-type="select" data-source="{{ url("/general/user_source") }}" data-value="'+data+'">'+data+'</a>';
	}

	var fnEditableRoom = function(data,type,row,meta)
	{
		return '<a href="#" class="editable_header" data-pk="'+row.id+'" data-name="to_room_id" data-url="{{url("/asset/update")}}" data-original-title="Penempatan" data-type="select" data-source="{{ url("/general/room_source") }}" data-value="'+data+'">'+data+'</a>';
	}

	var fnEditable = function(data,type,row,meta)
	{
		 return '<a href="#" class="editable_price" data-pk="'+row.id+'" data-name="price" data-url="{{url("/asset/update")}}" data-original-title="Harga" data-type="text" data-value="'+data+'">'+data+'</a>';

	}

	var fnEditableAge = function(data,type,row,meta)
	{
		 return '<a href="#" class="editable_age" data-pk="'+row.id+'" data-name="asset_age" data-url="{{url("/asset/update")}}" data-original-title="Usia" data-type="text" data-value="'+data+'">'+data+'</a>';

	}
	var fnEditablePpn = function(data,type,row,meta)
	{
		 return '<a href="#" class="editable_header" data-pk="'+row.id+'" data-name="ppn" data-url="{{url("/asset/update")}}" data-original-title="Ppn" data-type="text" data-value="'+data+'">'+data+'</a>';

	}
	var fnEditableDes = function(data,type,row,meta)
	{
		 return '<input type="hidden" name="higlight" id="higlight" value="0" /><a href="#" class="editable_header" data-pk="'+row.id+'" data-name="description" data-url="{{url("/asset/update")}}" data-original-title="Deskripsi" data-type="textarea" data-value="'+data+'">'+data+'</a>';

	}

	var fnEditableDepartmen = function(data,type,row,meta)
	{
		 return '<a href="#" class="editable_header" data-pk="'+row.id+'" data-name="department_id" data-url="{{url("/asset/update")}}" data-original-title="Ppn" data-type="text" data-value="'+data+'">'+data+'</a>';
	}

	$.fn.editable.defaults.mode = 'inline';
	$(document).ready(function()
	{

		$('#min').addClass('active');
		gentable = $('#table_data').DataTable(
		{
	        paging:false,
          	processing: true,
          	ajax: "{{ url('/mutasi_in/getAssets') }}"+"/"+parseInt($('#mutasi_in_id').val()),
          	columns:[
                 { data: 'no',name: 'no',"bSortable": true},
                 { data: 'satuan_name',name: 'satuan_name',"bSortable": true},
                 { data: 'barcode',name: 'barcode',"bSortable": true},
                 { data: 'to_department',name: 'to_department',"bSortable": true},
                 
                 { data: 'to_user',name: 'to_user',render:fnEditableUser,"bSortable": true},
                 { data: 'to_room',name: 'to_room',render:fnEditableRoom,"bSortable": true},
                 { data: 'price',name: 'price',"className":"text-right","mRender":fnEditable,"bSortable": true},
				 /*{ data: 'ppn',name: 'ppn',"className":"text-right",render:fnEditablePpn,"bSortable": false},
                 { data: 'ppn_value',name: 'ppn_value',"className":"text-right","bSortable": false},
                 
				 { data: 'total_price',name: 'total_price',"className":"text-right","bSortable": false},*/
				 { data: 'asset_age',name: 'asset_age',render:fnEditableAge,"className":"text-right","bSortable": false},
				 { data: 'description',name: 'description',render:fnEditableDes,"bSortable": false}
          ],
          "order": [[ 0, 'asc' ]],
			"columnDefs": [{
                 "visible": false,
				 "searchable": false,
                "orderable": true,
                "targets": 1
        	}],
			"drawCallback": function ( settings ) {
	            var api = this.api();
	            var rows = api.rows( {page:'current'} ).nodes();
	            var last=null;
	 
	            api.column(1, {page:'current'} ).data().each( function ( group, i ) {
	                if ( last !== group ) {
	                    $(rows).eq( i ).before(
	                        '<tr class="group success"><td colspan="10" style="text-align:left;padding:10px"><strong>Per -'+group+" "+'</strong></td></tr>'
	                    );
	 
	                    last = group;
	                }
	            } );
	        },
	        "initComplete": function(settings, json) {
				
			}
		});

		var sBody = $('#table_data tbody');

		sBody.on('click','tr',function()
		{
			if($(this).find('#higlight').length > 0)
			{
				var higlightVal = $(this).find('#higlight').val();
				var asset_id = gentable.row($(this)).data().id;
				if(higlightVal == 1)
				{
					$(this).removeClass('warning');
					$(this).find('#higlight').val(0);
					if(arrTransaction.includes(asset_id) == true)
					{
						var index = arrTransaction.indexOf(asset_id);
						arrTransaction.splice(index,1);
					}
				}
				else
				{
					$(this).addClass('warning');
					$(this).find('#higlight').val(1);
					

					if(arrTransaction.length > 0)
						{
							if(arrTransaction.includes(asset_id) == false)
							{
								arrTransaction.push(asset_id);
							}
						}
						else
						{
							arrTransaction.push(asset_id);
						}
				}

				$('#asset_id').val(JSON.stringify(arrTransaction));
			}
			
		});

		gentable.on('draw',function()
		{
			$('.editable_header').editable({				
		        ajaxOptions: {
		            type: 'post',
		            dataType: 'json'
		        },
		        success:function(data)
		        {
		          if(data.return==1)
		          {
		            alertify.success('success update');
		            gentable.ajax.reload();
		          }
		        }
		      }
		    );

		    $('.editable_price').on('init', function(e, editable) {
		    	//alert('initialized ' + editable.options.name);
		    });

		    $('.editable_price').editable({

		    	display: function(value) {
		    	},
		    	ajaxOptions: {
		            type: 'post',
		            dataType: 'json'
		        },
		        params : function(params)
		        {
		        	params.value = $(priceInput).autoNumeric('get');
		        	return params;
		        },
		        success:function(data)
		        {
		          if(data.return==1)
		          {
		            alertify.success('success update');
		            gentable.ajax.reload();
		          }
		        }
		      
		    });

		    $('.editable_price').on('shown',function(e,editable)
			{
				priceInput = editable.input.$input;
				$(priceInput).autoNumeric('init',{
					  aSign:'',
					  aDec:'.',
					  aSep:',',
					  mDec:'2',
					  vMin:'-99',
					  vMax:'9999999999'
				  });

			});

			$('.editable_age').editable({

		    	display: function(value) {
		    	},
		    	ajaxOptions: {
		            type: 'post',
		            dataType: 'json'
		        },
		        params : function(params)
		        {
		        	params.value = $(priceInput).autoNumeric('get');
		        	return params;
		        },
		        success:function(data)
		        {
		          if(data.return==1)
		          {
		            alertify.success('success update');
		            gentable.ajax.reload();
		          }
		        }
		      
		    });

		    $('.editable_age').on('shown',function(e,editable)
			{
				priceInput = editable.input.$input;
				$(priceInput).autoNumeric('init',{
					  aSign:'',
					  aDec:'.',
					  aSep:',',
					  mDec:'2',
					  vMin:'-99',
					  vMax:'9999999999'
				  });

			});


		});


		/*$('#btn-editable').click(function()
		{
			$('.editable_header').editable('toggleDisabled');
		});*/

		var sourceDepartment = new Bloodhound({
            remote: {
                url: '/general/type_department?q=%QUERY%',
                wildcard: '%QUERY%'
            },
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace
        });

      sourceDepartment.initialize();
        $('.typeahead').typeahead({
              items : 4,
              source : sourceDepartment.ttAdapter(),
              displayText : function(item)
              {
                  return item.name;
              },
              updater: function(item)
              {
                  $('input[name='+$(this)[0].$element.context.id+']').prev().val(item.id);
                  return item.name;
              }
      });

        $('#form-department').submit(function(e)
        {
        	e.preventDefault();

        	var _url = $(this).attr('action');

        	var _data = $(this).serializeArray();

        	$.ajax(
        	{
        		type:'post',
        		dataType:'json',
        		url: _url,
        		data: _data,
        		success: function(data)
        		{
        			if(data.stat)
        			{
        				alertify.success('success menambahkan departemen');
        				$('#datatable-master tbody > tr').removeClass('warning');
        				$('#form-department').trigger('reset');
        				$('#asset_id').val('');
        				arrTransaction = [];
        				gentable.ajax.reload();
        			}
        			else
        			{
        				alertify.error(data.msg);
        			}
        		},
        		error:function(xhr,status,msg)
        		{},
        		complete:function()
        		{
        			
        		}
        	});
        });

        $('#btn-print').click(function()
        {
        	var _url = "{{ url('/mutasi_in/printQrCode') }}";
        	var data = gentable.data();
        	$(data).each(function(i,v)
        	{
        		if(v.to_department == 'Kosong')
        		{
        			alertify.error('Silahkan isi Departemen');
        			return false;
        		}
        	});
        });

	});
</script>
@endsection