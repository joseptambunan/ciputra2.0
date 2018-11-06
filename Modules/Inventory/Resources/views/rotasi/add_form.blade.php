@extends('layouts.master_asset')
@section('title','Rotasi')
@section('css')
<link rel="stylesheet" href="{{ url('/') }}/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link href="{{ URL::asset('assets/global/plugins/typeahead/typeahead.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="col-lg-12 col-md-12 col-sm-12">
	<div class="panel panel-success">
	  <div class="panel-heading">
      <strong>Tambah</strong>
    </div>
	  <div class="panel-body">
      <a href="{{ url('/inventory/rotasi/index') }}" class="btn btn-info pull-right"><i class="fa fa-reply"></i> Kembali</a>
	  	<ul class="nav nav-tabs" id="mytabs">
		  <li role="presentation">
		  	<a href="#tab_scan" data-toggle="tab">Scan</a>
		  </li>
		  <li role="presentation" class="active">
		  	<a href="#tab_data" data-toggle="tab">Data</a>
		  </li>

		   <li role="presentation">
		  	<a href="#tab_manual" data-toggle="tab">Manual</a>
		  </li>
		</ul>

		<div class="tab-content">
			<div id="tab_scan" class="tab-pane fade">
			
        <div class="col-md-12 col-lg-12 col-sm-12">
           <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="embed-responsive embed-responsive-4by3">

              <video id="preview" class="embed-responsive-item" autoplay controls></video>

            </div>
          </div>
          
          <div class="col-lg col-md-6 col-sm-6">
            <br/>
            <button class="btn btn-info" id="btn-capture" type="button"><i class="fa fa-toggle-up"></i> Capture</button>

            <div class="bs-example" data-example-id="simple-carousel" style="display: none;" id="bs-corusell"> 
              <div class="carousel slide" id="carousel-example-generic" data-ride="carousel"> 
                <ol class="carousel-indicators"> 
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li> 
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li> 
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li> 
                </ol> <div class="carousel-inner" role="listbox"> 
                  <div class="item next left"> 
                    <img id="img1" alt="First slide [900x500]" src="" data-holder-rendered="true"> 
                  </div> 
                  <div class="item"> 
                    <img id="img2" alt="Second slide [900x500]" src="" data-holder-rendered="true"> 
                  </div> 
                  <div class="item active left"> 
                    <img id="img3" alt="Third slide [900x500]" src="" data-holder-rendered="true"> 
                  </div> 
                </div> 
                <a href="#carousel-example-generic" class="left carousel-control" role="button" data-slide="prev"> 
                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> 
                  <span class="sr-only">Previous</span> 
                </a> 
                <a href="#carousel-example-generic" class="right carousel-control" role="button" data-slide="next"> 
                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> 
                  <span class="sr-only">Next</span> 
                </a> 
              </div> 
            </div>

        <div class="embed-responsive embed-responsive-4by3" id="canvasEmbed">
            <canvas id="showCanvas" width="400" height="350"></canvas>
        </div>

        </div>
        <canvas  id="myCanvas"  width="896" height="504" style="display: none;"></canvas>
        </div>

	   </div>

			<div id="tab_data" class="tab-pane fade in active">
				<br/>
				<form action="{{ url('/inventory/rotasi/create') }}" method="post" class="form-horizontal form-label-left" id="form_data">
		         {{ csrf_field() }}

		        <div class="item form-group">
				    <label class="control-label col-md-3 col-sm-3 col-xs-12">Department Sumber</label>
				    <div class="col-md-4 col-sm-4 col-xs-12">
				    	<select class='form-control select2' name='from_department_id' id='from_department_id'>
							<option value=''>Pilih</option>
							@foreach($Departments as $key => $department)
								<option value='{{ $department->id }}'>{{ $department->code }}</option>
							@endforeach
						</select>
				    </div>
			  	</div>
			  	<div class="item form-group">
				    <label class="control-label col-md-3 col-sm-3 col-xs-12">Department Tujuan</label>
				    <div class="col-md-4 col-sm-4 col-xs-12">
				    	<select class='form-control select2' name='to_department_id' id='to_department_id'>
							<option value=''>Pilih</option>
							@foreach($Departments as $key => $department)
								<option value='{{ $department->id }}'>{{ $department->code }}</option>
							@endforeach
						</select>
				    </div>
			  	</div>

			  	

			  	<div class="item form-group">
				    <label class="control-label col-md-3 col-sm-3 col-xs-12">Ruangan/Lokasi Sumber</label>
				    <div class="col-md-4 col-sm-4 col-xs-12">
              <input type="hidden" name="id_from_room" id="id_from_room"  />
				    	<input type="text" name="from_room" id="from_room" class="form-control search-input" />
              
				    </div>
			  	</div>

			  	<div class="item form-group">
				    <label class="control-label col-md-3 col-sm-3 col-xs-12">Ruangan / Lokasi Tujuan</label>
				    <div class="col-md-4 col-sm-4 col-xs-12">
              <input type="hidden" name="id_to_room" id="id_to_room" />
				    	<input type="text" name="to_room" id="to_room" class="form-control search-input" />
              
				    </div>
			  	</div>

          <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Pemberi</label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="input-group">
                  <input type="hidden" name="giver" id="giver" />
                  <input type="text" name="mgiver" id="mgiver" class="form-control user_typeahead" />
                  <div class="input-group-addon">
                    <button class="btn btn-success btn-xs" type="button"><i class="fa fa-user"></i></button>
                  </div>
                </div>
                
              </div>
            </div>

          
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Penerima</label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="input-group">
                  <input type="hidden" name="recipient" id="recipient" />
                  <input type="text" name="mrecipient" id="mrecipient" class="form-control user_typeahead" />
                  <div class="input-group-addon">
                    <button class="btn btn-success btn-xs" type="button"><i class="fa fa-user"></i></button>
                  </div>
                </div>
                
              </div>
            </div>

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <textarea class="form-control" name="descriptions" id="descriptions"></textarea>
            </div>
          </div>


		         <input type="hidden" name="allItemStore" id="allItemStore" />
		        
		        <div class="ln_solid"></div>
				<div class="form-group">
					<div class="col-md-6 col-md-offset-3">
						<button id="send" type="submit" class="btn btn-info"><i class="fa fa-save"></i> Save</button>
						@include('form.a',[
							'href'=>url('/inventory/rotasi/index'), 
							'caption' => 'Back' 
						])
					</div>
				</div>		         
		    	</form>
			</div>

			<div id="tab_manual" class="tab-pane fade">
        <br/>
        <form action="#" method="post" class="form-horizontal form-label-left" id="form_data_manual">
             {{ csrf_field() }}
            <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Item</label>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <input type="text" name="item_id_name" id="item_id_name" class="form-control" />
            </div>
          </div>
          <input type="hidden" name="allItemStore2" id="allItemStore2" />
            
        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-6 col-md-offset-3">
            
          </div>
        </div>             
          </form>
		  </div>
	  	
	    <p/>
	    <input type="hidden" name="rowIdx" id="rowIdxPenerimaan" value="-1" />
	    <table id="datatable-master" class="table table-striped table-bordered dt-responsive nowrap">
	           <!--colgroup>
	            <col width="10%">
	            <col width="25%">
	            <col width="5%">
	          </colgroup-->
	              <thead style="background-color: #3FD5C0;">
	                <tr>
	                  <th>#</th>
	                  <th class="text-center">Kode</th>
	                  <th class="text-center">Item</th>
	                  <th class="text-center">Dept.</th>
                    <th class="text-center">Dept. Saat Ini</th>
	                  <th class="text-center">Ruangan / Lokasi Skrg</th>
	                  <th></th>
                    <th  style="display: none;">Gambar</th>
	                  <th style="display: none;">Keterangan</th>
	                </tr>
	              </thead>
	       </table>
	  </div>
	</div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal_satuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Deskripsi</h4>
      </div>
      <div class="modal-body">
        <div class="form-horizontal form-label-left">
          <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi</label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <textarea id="description" name="description" rows="6" cols="50"></textarea>
              </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btn-remarks" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script src="{{ url('/')}}/assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ url('/')}}/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/instascan/instascan.min.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('assets/global/plugins/typeahead/typeahead.bundle.min.js') }}"></script>
   <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/typeahead/bootstrap3-typeahead.min.js') }}"></script>
<script type="text/javascript">


  var fngetCurrent = function(obj,remarks,idx)
  {
      var _url = "{{ url('/inventory/rotasi/getCurrentPosition') }}";
      $.ajax({
        type:'post',
        dataType:'json',
        data : {code : obj.asset_id},
        url: _url,
        success:function(data)
        {
            var tableItem = null;
            if(Object.keys(data).length > 0)
            {
                var tableItem = {
                    id:obj.asset_id,
                    kode_barang:obj.barcode,
                    nama_barang : obj.nama_item,
                    dept : obj.department_name,
                    curdept : data.to_department_name,
                    curroom : data.to_room_name,
                    kode_produk :obj.id_item,
                    image : [],
                    remarks:remarks
                  };
            }
            else
            {

              var tableItem = {
                    id:obj.id,
                    kode_barang:obj.barcode,
                    nama_barang : obj.nama_item,
                    dept : obj.department_name,
                    curdept : obj.department_name,
                    curroom : "-",
                    kode_produk :obj.id_item,
                    image : [],
                    remarks:remarks
                  };
            }
            if(idx== -1)
            {
              gentable.row.add(tableItem);
            }
            gentable.draw();
            alertify.success('Ok');
            $('img').attr('src','');
        }

      });
  }

  let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
        //console.log(content);
        var stat = true;
        var obj = JSON.parse(content);

        var idx = $('#rowIdxPenerimaan').val();
        var alldata = gentable.data();
        var desc = null;
        $(alldata).each(function(i,v){
            if(obj.barcode == v.kode_barang)
            {
              stat = false;
              return false;
            }
        });

        if(stat)
        {

          alertify.confirm("Konfirmasi","Data sudah valid",
            function(){
              fngetCurrent(obj,null,idx);
            },
            function(){
              alertify.prompt( 'Description', '', ''
               , function(evt, value) { 
                  fngetCurrent(obj,value,idx);
              }
               , function() { alertify.error('Cancel') }).set({labels:{ok:'Ya',cancel:'Batal'}});
          }).set({labels:{ok:'Ya',cancel:'Belum'}});
        }
        else
        {
          alertify.alert('Info','Data sudah ada');
        }
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


      //initiialize camera
  navigator.getUserMedia = ( navigator.getUserMedia ||
                             navigator.webkitGetUserMedia ||
                             navigator.mozGetUserMedia ||
                             navigator.msGetUserMedia);

      var video;
      var webcamStream;

      function startWebcam() {
        if (navigator.getUserMedia) {
           navigator.getUserMedia (

              // constraints
              {
                 video: true,
                 audio: false
              },

              // successCallback
              function(localMediaStream) {
                  video = document.querySelector('video');
                  video.src = window.URL.createObjectURL(localMediaStream);
                  webcamStream = localMediaStream;
              },

              // errorCallback
              function(err) {
                 console.log("The following error occured: " + err);
              }
           );
        } else {
           console.log("getUserMedia not supported");
        }  
      }

      var canvas, ctx,cvs,contxt;

      function _initCamera() {
        // Get the canvas and obtain a context for
        // drawing in it
        cvs = document.getElementById('showCanvas');
        contxt = cvs.getContext('2d');
        //
        canvas = document.getElementById("myCanvas");
        ctx = canvas.getContext('2d');

      }

       function snapshot() {
         // Draws current image from the video element into the canvas
         
         contxt.drawImage(video,0,0,cvs.width,cvs.height);
         ctx.drawImage(video, 0,0, canvas.width, canvas.height);

         var dataUrl = canvas.toDataURL();
         return dataUrl;
      }

      //datatable
	var _fnlocalDrawCallback = function (oSettings) {
    
            /* Need to redo the counters if filtered or sorted */
            if (oSettings.bSorted || oSettings.bFiltered) {
                for (var i = 0, iLen = oSettings.aiDisplay.length; i < iLen; i++) {
                    $('td:eq(0)', oSettings.aoData[oSettings.aiDisplay[i]].nTr).html((i + 1) + '.');
                }
            }
        };

    var datatable_idUI = {
              "sProcessing":   "Sedang memproses...",
              "sLengthMenu":   "Tampilkan _MENU_ entri",
              "sZeroRecords":  "[tidak ada data]",
              "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
              "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
              "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
              "sInfoPostFix":  "",
              "sSearch":       "Cari: ",
              "sUrl":          "",
              "oPaginate": {
                  "sFirst":    "Pertama",
                  "sPrevious": "Sebelumnya",
                  "sNext":     "Selanjutnya",
                  "sLast":     "Terakhir"
              }
          };

/*default options for datatables.net*/
      var datatableDefaultOptions = {
            "paging": false,
            "searching": false,
            "info": false,
            "fnDrawCallback": _fnlocalDrawCallback,
            "bLengthChange": false,
            "order": [[1, "asc"]],
            "language": datatable_idUI,
           //"footerCallback":_footerCallback,
            "sPaginationType": "bootstrap"
        };

      var gentable = null;
      var _initTable = function () {
            var _renderEditColumnPenerimaan = function (data, type, row) {
                        if (type == 'display') {
                            if(row.remarks == null)
                            {
                              return ("<div class='btn-group' role='group'>" +
                              "<button class='button-delete btn btn-danger btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='left' title='Hapus'><i class='fa fa-trash-o'></i></button>"+
                              "<button class='button-capture btn btn-primary btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='right' title='Capture'><i class='fa fa-toggle-up'></i></button>"+
                              "</div>");
                            }
                            else
                            {
                              return ("<div class='btn-group' role='group'>" +
                                "<button class='button-remarks btn btn-primary btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='left' title='Description'><i class='fa fa-list'></i></button>"+
                                "<button class='button-delete btn btn-danger btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='right' title='Hapus'><i class='fa fa-trash-o'></i></button>"+
                                "<button class='button-capture btn btn-primary btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='right' title='Capture'><i class='fa fa-toggle-up'></i></button>"+
                                "</div>");
                            }                   
                        }
                        return data;
            };

            var arrColumnsData = [
                    {'data' : 'id','sClass':'text-center'},
                    { 'data': 'kode_barang' }, //
                    { 'data': 'nama_barang' }, //
                    {'data': 'dept'},
                    {'data':'curdept'},
                    {'data':'curroom'},
                    { 'data': 'kode_produk', 'mRender': _renderEditColumnPenerimaan, 'sClass': 'text-center' },
                    {'data' : 'image'},
                    {'data': 'remarks'}
                ];

          _GeneralTable(arrColumnsData);
      
          gentable = $('#datatable-master').DataTable(datatableDefaultOptions)
          .on('click', '.button-delete', function (d) {
                    if (confirm('Hapus item ini ?') == false) {
                        return;
                    }
                    var tr = $(this).closest('tr');
                    var row = gentable.row(tr);
               row.remove().draw();
            }).on('click','tr',function(){
              $('#datatable-master tbody > tr').removeAttr('style');
              $(this).css('background-color','#63d7f0');
              var index = gentable.row($(this)).index();
              $('#btn-capture').attr('data-id',index);
          }).on('click','.button-capture',function()
          {
              var tParent = $(this).parents('tr');
              var data = gentable.row($(this).parents('tr')).data();
              var img1 = document.getElementById('img1');
              var img2 = document.getElementById('img2');
              var img3 = document.getElementById('img3');

              if(data.image.length < 1)
              {
                alertify.alert('info','Gambar belum di capture');
              }
              else
              {
                $('#img1').attr('src','data:image/png;base64,'+data.image[0]);
                $('#img2').attr('src','data:image/png;base64,'+data.image[1]);
                $('#img3').attr('src','data:image/png;base64,'+data.image[2]);
                $('#bs-corusell').show();

                contxt.clearRect(0,0,cvs.width,cvs.height);
                $('#canvasEmbed').hide();
              }
              
          }).on('click','.button-remarks',function()
          {
              var data = gentable.row($(this).parents('tr')).data();
              var index = gentable.row($(this).parents('tr')).index();
              $('#description').val(data.remarks);
              $('#btn-remarks').attr('data-id',index);
              $('#modal_satuan').show();
          });
      }

    var _GeneralTable = function (arrColumns) {
            var _coldefs = [{targets:[7,8],visible:false}];
            datatableDefaultOptions.searching = false;
            datatableDefaultOptions.aoColumns = arrColumns;
            datatableDefaultOptions.columnDefs = _coldefs;
            datatableDefaultOptions.autoWidth = false;
            datatableDefaultOptions.ordering = false;
            datatableDefaultOptions.fnDrawCallback = function (oSettings) {
                //show row number
                for (var i = 0, iLen = oSettings.aiDisplay.length; i < iLen; i++) {
                    $('td:eq(0)', oSettings.aoData[oSettings.aiDisplay[i]].nTr).html((i + 1) + '.');
                }
            };
        }

    $(document).ready(function()
    {
      $('#rotasi').addClass('active');
          //camera 
          _initCamera();
          _initTable();

       $('#mytabs li:eq(0) a').click(function()
        {
            startWebcam();
            alertify.success('please capture');
        });

      $('#mytabs li:eq(1) a').click(function()
      {

          
      });

       $('#form_data').submit(function(e){
            e.preventDefault();
            var dataNotinsert = '';
            var _dataItems = gentable.data();
            var _alldataItemSend = [];

            $(_dataItems).each(function(i,v){
                _alldataItemSend.push(v);
            });

            $('#allItemStore').val(JSON.stringify(_alldataItemSend));

            //console.log(JSON.stringify(_alldataItemSend));
            var alldata_send=$(this).serializeArray();

            $.ajax({
              type: 'POST',
              url: $(this).attr('action'),
              data: alldata_send,
              dataType: 'json',
              beforeSend:function(){
                alertify.success('Sending ...');
              },
              success:function(data){
                if(data.stat)
                {
                  $('#form_data').trigger('reset');
                  alertify.success('success saved!',4);
                  gentable.clear().draw();

                }
                else
                {
                  alertify.error('Failed saved!',3);
                }
              },
              error:function(xhr,status,errormessage)
              {
              },
              complete:function()
              {
                $('#form_data input').removeAttr('disabled');
                $('.form-group').removeClass('has-success');
              }
            });
        });


      $('#btn-capture').click(function()
      {
          $('#canvasEmbed').show();
          $('#bs-corusell').hide();
          $('#bs-corusell').find('img').attr('src','');
          var indx = $(this).attr('data-id');
          var data = gentable.row(indx).data();
          if (typeof indx !== typeof undefined && indx !== false) {
              if(data.image.length < 3)
              {
                var img_encode = snapshot();
                var split_img = img_encode.substr(img_encode.indexOf(",")+1);
                data.image.push(split_img);
                gentable.row(indx).data(data).draw();
              }
              else
              {
                alertify.alert('Info','Only 3 Images');
              }
          }
          else
          {
              alertify.alert("Info","Data Belum Dipilih!");
          }
      });

      var sourceEngine = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    remote: {
                          url: '/inventory/getUsers/type_user?q=%QUERY%',
                          wildcard: '%QUERY%'
                      }
                  });
      sourceEngine.initialize();
      var $inputType = $('.user_typeahead');
      $inputType.typeahead({
        items : 4,
        source : sourceEngine.ttAdapter(),
        displayText : function(item)
        {
            return item.user_name;
        },
        updater: function(item)
        {
            $('input[name='+$(this)[0].$element.context.id+']').prev().val(item.id);
            return item.user_name;
        }
      });
      var bestRooms = new Bloodhound({
            remote: {
                url: '/inventory/room/type_room?q=%QUERY%',
                wildcard: '%QUERY%'
            },
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace
        });

      bestRooms.initialize();
        $('.search-input').typeahead({
              items : 4,
              source : bestRooms.ttAdapter(),
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

    $('#btn-remarks').click(function()
     {
        var indx = $(this).attr('data-id');
        var data = gentable.row(indx).data();

        data.remarks = $('#description').val();

        gentable.row(indx).data(data).draw();
     });

    });
</script>
@endsection