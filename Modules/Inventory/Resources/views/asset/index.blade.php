<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
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
			                <a href="{{ url('/inventory/permintaan_barang/index') }}">Permintaan ...</a>
			            </li>
			            <li>
			            	<a href="{{ url('/inventory/barang_keluar/index').'?id='.$assets[0]->inventarisirDetail->inventarisir->barangkeluar->permintaanbarang_id }}">Barang Keluar ...</a>
			            </li>
			            <li>
			            	<a href="{{ url('$assets[0]->inventarisirDetail->inventarisir->barangkeluar->id') }}">Mutasi IN</a>
			            </li>
			            <li>
			            	<span>Asset No : {{ $assets[0]->inventarisirDetail->inventarisir->no}} </span>
			            </li>
			        </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">

              	<div class="alert alert-success" role="alert">
              		
			    		Asset Dari Nomor Mutasi IN = {{ $assets[0]->inventarisirDetail->inventarisir->no }}
			    	
			    <br/>
			  
			    	Item = {{ $assets[0]->item->name}} 
			    	<br/>
			    	Jumlah  = {{$assets->sum('quantity')." ".$assets[0]->satuan->name }}
			    	<br/>
			    	<strong style="color:#b60606;">Silahkan isi semua data kemudian cetak QrCode</strong>
              	</div>
			    
				<form action="{{ url('/inventory/asset/create_qrCode') }}" name="form-qrcode" id="form-qrcode" method="post">
					{{ csrf_field() }}
					<input type="hidden" name="inventarisir_detail_id" id="inventarisir_detail_id" value="{{ $assets[0]->inventarisir_detail_id }}"/>

					<button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> QrCode</button>

				</form>
				@include('form.a',
							[
								'href' => url('/inventory/inventarisir_detail/index').'?id='.$assets[0]->inventarisirDetail->inventarisir_id,
								'class'=>'pull-right',
								'caption' => 'Kembali'
							])
				<br/>				
				<!--button type="button" class="btn btn-primary" id="btn-editable"><i class="fa fa-edit"></i>
				</button-->
				
				@include('inventory::asset.datatable')
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
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Scan</h4>
      </div>
      <div class="modal-body">
        <div class="embed-responsive embed-responsive-4by3">
        	<video id="preview" class="embed-responsive-item" autoplay controls></video>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default close" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@include("master/footer_table")
<script type="text/javascript" src="{{ URL::asset('assets/global/plugins/instascan/instascan.min.js') }}"></script>
@include('form.general_form')
@include('pluggins.editable_plugin')
@include('pluggins.alertify')
<link href="{{ URL::asset('assets/global/plugins/typeahead/typeahead.css') }}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{ URL::asset('assets/global/plugins/typeahead/bootstrap3-typeahead.min.js') }}"></script>
<script type="text/javascript">
	let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
	var gentable = null;

	var fnEditableUser = function(data,type,row,meta)
	{
		return '<a href="#" class="editable_header" data-pk="'+row.id+'" data-name="to_user_id" data-url="{{url("/inventory/asset/update")}}" data-original-title="Pemegang" data-type="select" data-source="{{ url("/inventory/general/user_source") }}" data-value="'+data+'">'+data+'</a>';
	}

	var fnEditableRoom = function(data,type,row,meta)
	{
		return '<a href="#" class="editable_header" data-pk="'+row.id+'" data-name="to_room_id" data-url="{{url("/inventory/asset/update")}}" data-original-title="Penempatan" data-type="select" data-source="{{ url("/inventory/general/room_source") }}" data-value="'+data+'">'+data+'</a>';
	}

	var fnEditable = function(data,type,row,meta)
	{
		 return '<a href="#" class="editable_price" data-pk="'+row.id+'" data-name="price" data-url="{{url("/inventory/asset/update")}}" data-original-title="Harga" data-type="text" data-value="'+data+'">'+data+'</a>';

	}
	var fnEditablePpn = function(data,type,row,meta)
	{
		 return '<a href="#" class="editable_header" data-pk="'+row.id+'" data-name="ppn" data-url="{{url("/inventory/asset/update")}}" data-original-title="Ppn" data-type="text" data-value="'+data+'">'+data+'</a>';

	}
	var fnEditableDes = function(data,type,row,meta)
	{
		 return '<a href="#" class="editable_header" data-pk="'+row.id+'" data-name="description" data-url="{{url("/inventory/asset/update")}}" data-original-title="Deskripsi" data-type="textarea" data-value="'+data+'">'+data+'</a>';

	}
	var fnEditableAge = function(data,type,row,meta)
	{
		 return '<a href="#" class="editable_age" data-pk="'+row.id+'" data-name="asset_age" data-url="{{url("/inventory/asset/update")}}" data-original-title="Usia" data-type="text" data-value="'+data+'">'+data+'</a>';

	}

	var fnEditNilaiEkonomis = function(data,type,row,meta)
	{
		return '<a href="#" class="editable_nilaiekonomis" data-pk="'+row.id+'" data-name="nilai_ekonomis" data-url="{{url("/inventory/asset/update")}}" data-original-title="Nilai Ekonomis" data-type="text" data-value="'+data+'">'+data+'</a>';
	}
	$.ajaxSetup({
    headers: {
                  'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                }
    });
  $.fn.editable.defaults.mode = 'inline';

	$(document).ready(function()
	{

		gentable = $('#table_data').DataTable(
		{
	        paging:false,
	        searching:false,
          	processing: true,
          	ajax: "{{ url('/inventory/asset/getAssets') }}"+"?id="+parseInt($('#inventarisir_detail_id').val()),
          	columns:[
                 { data: 'no',name: 'no',"bSortable": true},
                 { data: 'satuan_name',name: 'satuan_name',"bSortable": true},
                 { data: 'to_user',name: 'to_user',render:fnEditableUser,"bSortable": true},
                 { data: 'to_room',name: 'to_room',render:fnEditableRoom,"bSortable": true},
                 { data: 'price',name: 'price',"className":"text-right","mRender":fnEditable,"bSortable": true},
                 { data: 'asset_age',name: 'asset_age',"className":"text-right","bSortable": false},
                 { data: 'umur',name: 'umur',"className":"text-right",render:fnEditableAge,"bSortable": true},
				 { data: 'nilai_ekonomis',name: 'nilai_ekonomis',"className":"text-right",render:fnEditNilaiEkonomis,"bSortable": false},
                 /*{ data: 'ppn_value',name: 'ppn_value',"className":"text-right","bSortable": false},
                 
				 { data: 'total_price',name: 'total_price',"className":"text-right","bSortable": false},*/
				 { data: 'description',name: 'description',render:fnEditableDes,"bSortable": false},
				 
                {
                  "className": "action text-center",
                  "data": null,
                  "bSortable": false,
                  "defaultContent": "" +
                  "<div class='' role='group'>" +
                  
                  "<button class='btn-scan btn btn-primary btn-xs' title='Scan'><i class='fa fa-barcode'></i></button>" +
                  "</div>"
            }
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
	                        '<tr class="group success"><td colspan="9" style="text-align:left;padding:10px"><strong>'+group+" "+'Per-satuan</strong></td></tr>'
	                    );
	 
	                    last = group;
	                }
	            } );
	        }
		});

		var sBody = $('#table_data tbody');

		var sHead = $('#table_data thead');
		sBody.on('click','.btn-scan',function()
		{
			var obj = $(this);
			$('#myModal').modal('show');
			var data = gentable.row($(this).parents('tr')).data();
			var new_asset_id = data.id;
			var new_inventarisir_detail_id = $('#inventarisir_detail_id').val();

			var _url = "{{ url('/inventory/asset/is_labeled') }}";

			scanner.addListener('scan', function (content) {
		        var stat = true;
		        var obj = JSON.parse(content);
		        var _datasend = {
		        	'new_asset_id':new_asset_id,
		        	'new_inventarisir_detail_id':new_inventarisir_detail_id,
		        	'old_inventarisir_detail_id':obj.inventarisir_detail_id,
		        	'old_asset_id':obj.asset_id,
		        	'barcode':obj.barcode,
		        	_token : $('input[name=_token]').val()
		        };
		        $.ajax({
					type:'POST',
					url : _url,
					data: _datasend,
					dataType:'json',
					success:function(get)
					{
						if(get.stat)
						{
							$('#myModal').modal('hide');
							alertify.success('Data Benar');
							obj.prop('disabled',true);
						}
						else
						{
							$('#myModal').modal('hide');
							alertify.error('Warning : '+get.msg);
						}
					}
				});
		    });

			Instascan.Camera.getCameras().then(function (cameras) {
				if (cameras.length > 0) {
					scanner.start(cameras[0]);
		        } else {
		          alert('No cameras found.');
		        }
		      }).catch(function (e) {
		        alert(e);
		      });
		});

		sHead.on('click','.btn-qrcode',function()
		{
			var data = gentable.rows().data();
			var _allDataSends = [];
			$(data).each(function(i,v){
				_allDataSends.push(v[2]);
			});

			$('#all-Barcode').val(JSON.stringify(_allDataSends));
			$('#form-qrcode').submit();
		});

		$('.close').click(function()
		{
			scanner.stop();
		});

		$('#myModal').on('hide.bs.modal', function (e) {
			scanner.stop();
		});

		gentable.on('draw',function()
		{
			$('.editable_header').editable({
				//disabled : true,				
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


		    $('.editable_nilaiekonomis').editable({

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

		    $('.editable_nilaiekonomis').on('shown',function(e,editable)
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

		    /*$('.editable_user').editable({
		    	source : '/general/user_source',
		    	select2: {
		            placeholder: 'Pilih Pemegang',
		            allowClear: true,
            		minimumInputLength: 3,
            		id: function (item) {
		                return item.id;
		            },
		            ajax: {
		                url: '{{ url("/general/user_source") }}',
		                dataType: 'json',
		                data: function (term, page) {
		                    //return { query: term };
		                    console.log(term);
		                },
		                results: function (data, page) {
		                	console.log(data);
		                	return { results: data };
		                }
		            },
		            formatResult: function (item) {
		                return item.text;
		            },
		            formatSelection: function (item) {
		                return item.text;
		            }
		        }
		    });
		    $('.editable_place').editable({
		    	source : '/general/room_source',
		    	select2: {
		            placeholder: 'Pilih Pemegang',
		        },
		    });*/
		});

		/*$('#btn-editable').click(function()
		{
			$('.editable_header').editable('toggleDisabled');
		});*/

	});
</script>
</body>
</html>