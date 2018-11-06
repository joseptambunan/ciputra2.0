@extends('layouts.master_asset')
@section('title','Mutasi IN')
@section('css')
<link rel="stylesheet" href="{{ url('/') }}/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 <link href="{{ URL::asset('assets/global/plugins/typeahead/typeahead.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="col-lg-12 col-md-12 col-sm-12">
	<div class="panel panel-success">
	  <div class="panel-heading"><strong>Tambah Mutasi In</strong>
    </div>
	  <div class="panel-body">
      <a href="{{ url('/inventory/mutasi_in/index') }}" class="btn btn-primary pull-right"><i class="fa fa-mail-reply"></i> Kembali</a>
	  	<ul class="nav nav-tabs" id="mytabs">
		  <li role="presentation" >
		  	<a href="#tab_scan" data-toggle="tab">Gambar</a>
		  </li>
      <li role="presentation" class="active">
        <a href="#tab_other" data-toggle="tab">Pihak Luar</a>
      </li>
		</ul>

		<div class="tab-content">
				<div id="tab_scan" class="tab-pane fade">
          <div class="col-md-12 col-lg-12 col-sm-12">
           <div class="col-lg-6 col-md-6 col-sm-6">
            <br/>
            <div class="embed-responsive embed-responsive-4by3">
              <video id="preview" class="embed-responsive-item" autoplay controls></video>
            </div>
          </div>
          
          <div class="col-lg col-md-6 col-sm-6">
            <br/>
            <button class="btn btn-info" id="btn-capture" type="button"><i class="fa fa-toggle-up"></i> OK</button>

             <div class="bs-example" id="bs-corusell" data-example-id="simple-carousel" style="display: none;"> 
              <div class="carousel slide" id="carousel-example-generic" data-ride="carousel"> 
                <ol class="carousel-indicators"> 
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li> 
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li> 
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li> 
                </ol> 
                <div class="carousel-inner" role="listbox"> 
                  <div class="item next left"> 
                    <img id="img1" alt="First slide" src="" data-holder-rendered="true"> 
                  </div> 
                  <div class="item"> 
                    <img id="img2" alt="Second slide" src="" data-holder-rendered="true"> 
                  </div> 
                  <div class="item active left"> 
                    <img id="img3" alt="Third slide" src="" data-holder-rendered="true"> 
                  </div> 
                </div> 
                <a href="#carousel-example-generic" class="left carousel-control" role="button" data-slide="prev"> 
                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> 
                  <span class="sr-only">Awal</span> 
                </a> 
                <a href="#carousel-example-generic" class="right carousel-control" role="button" data-slide="next"> 
                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> 
                  <span class="sr-only">Lanjut</span> 
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

      <div id="tab_other" class="tab-pane fade in active">
        <br/>
        <form action="{{ url('/inventory/mutasi_in/create') }}" method="post" class="form-horizontal form-label-left" id="from_other" autocomplete="off">

             {{ csrf_field() }}

             <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Sumber</label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="input-group">
                  <input type="hidden" name="id_source" value="0" id="id_source" />
                  <input type="text" name="source" id="source" class="form-control" />
                  <div class="input-group-addon">
                    <button class="btn btn-default btn-xs" type="button"><i class="fa fa-building"></i></button>
                  </div>
                </div>
              </div>
            </div>

             <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Pemberi</label>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="input-group">
                  <input type="hidden" name="id_pic_giver" value="0" id="id_pic_giver" />
                  <input type="text" name="giver" id="giver" class="form-control typeaHead" />
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
                  <input type="hidden" name="id_pic_recipient" value="0" id="id_pic_recipient" />
                  <input type="text" name="pic_recipient" id="pic_recipient" class="form-control typeaHead" />
                  <div class="input-group-addon">
                    <button class="btn btn-success btn-xs" type="button"><i class="fa fa-user"></i></button>
                  </div>
                </div>
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Item</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                  <button class="btn btn-success" id="btn-item" type="button"><i class="fa fa-bars"></i> Tambah</button>
              </div>
            </div>     

            <input type="hidden" name="allItemStore" id="allItemStore" />

            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-3">
                <button id="send" type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
                @include('form.a',[
                  'href'=>url('/inventory/mutasi_in/index'), 
                  'caption' => 'Cancel' 
                ])
              </div>
            </div>           
          </form>
      </div>

	    <p/>

     
	    <input type="hidden" name="rowIdx" id="rowIdxPenerimaan" value="-1" />
	    <table id="datatable-master" class="table table-striped table-bordered dt-responsive nowrap">
	              <thead style="background-color: #3FD5C0;">
	                <tr>
	                  <th>#</th>
	                  <th class="text-center">Nama</th>
                    <th class="text-center">Qty</th>
	                  <th class="text-center">Satuan</th>
	                  <th></th>
	                  <th style="display: none;">image</th>
	                </tr>
	              </thead>
	       </table>
	  </div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_satuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pilih Item</h4>
      </div>
      <div class="modal-body">
        <table id="datatable-items" class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap">
      <colgroup>
        <col style="width: 1px;">
        <col>
        <col style="width:120px;">
      </colgroup>
      <thead>
        <tr>
          <th></th>
          <th>Kategori</th>
          <th>Item</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($items as $key => $value)
        <tr>
          <td >
            <input type="hidden" name="rowIdx" id="rowIdxPenerimaan" value="-1" />
           
            <input type="checkbox" name="add_item" id="add_item" class="item_checkbox" value="{{ $value->id }}" />
          </td>
          <td>
            {{ $value->category->name }}
          </td>
          <td>
            {{ $value->name }}
          </td>
          <td>
            <input type="number" name="qty_item" id="qty_item" class="text-right qty_item_add form-control" min="0" value="1" />
          </td>
          <td id="tdsatuan">
            <select name ="allsatuan" id="allsatuan" class="input-satuan">
              @foreach($value->satuans as $key => $satuan)
                <option value="{{ $satuan->id }}">{{$satuan->name}}</option>
              @endforeach
            </select>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

@endsection
@section('scripts')
 <script src="{{ url('/')}}/assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ url('/')}}/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
 
  <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/typeahead/typeahead.bundle.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('assets/global/plugins/typeahead/bootstrap3-typeahead.min.js') }}"></script>
<script type="text/javascript">

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

      function stopWebcam() {
          webcamStream.stop();
      }

      var canvas, ctx,cvs,contxt;

      function _initCamera() {
        // Get the canvas and obtain a context for
        // drawing in it
        //show canvas
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


                    return ("<div class='btn-group' role='group'>" +
                      "<button class='button-delete btn btn-danger btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='left' title='Hapus'><i class='fa fa-trash-o'></i></button>"+

                      "<button class='button-edit btn btn-success btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='top' title='fa-edit'><i class='fa fa-edit'></i></button>"+

                      "<button type='button' class='button-capture btn btn-primary btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='right' title='Capture'><i class='fa fa-toggle-up'></i></button>"+
                      "</div>");
                }
                return data;
            };

            var arrColumnsData = [
                    {'data' : 'id','sClass':'text-center'},

                    { 'data': 'nama_barang','sClass':'text-center' }, //
                    { 'data':'quantity','sClass':'text-right'},
                    {'data': 'satuan','sClass':'text-center'},
                    { 'data': 'item_satuan_id', 'mRender': _renderEditColumnPenerimaan, 'sClass': 'text-center' },
                    {'data' : 'image'}
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
            }).on('click','tr',function()
          {
              $('#datatable-master tbody > tr').removeAttr('style');
              $(this).css('background-color','#63d7f0');
              var index = gentable.row($(this)).index();
              $('#btn-capture').attr('data-id',index);
          }).
          on('click','.button-capture',function()
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
              

              
              /*
              var img_encode = snapshot();
              
              if(data.image.length < 3)
              {
                var split_img = img_encode.substr(img_encode.indexOf(",")+1);

                  if($('#carousel-example-generic').is(':hidden'))
                  {
                    
                    $('#carousel-example-generic').show();
                    $('#img1').show();
                  }
                  else
                  {
                    if($('#img2').is(':hidden'))
                    {
                       
                       $('#img2').show();

                    }
                    else
                    {
                      
                      $('#img3').show();
                    }
                  }
                
                data.image.push(split_img);
                gentable.row($(this).parents('tr')).data(data).draw();
              }
              else
              {
                alertify.alert('Info','Only 3 Images');
              }*/
              
          });
      }

    var _GeneralTable = function (arrColumns) {
            var _coldefs = [{targets:[5],visible:false}];
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

var fnCheckBox = function(trParent,item_id)
{
  
  var item_satuan_id = trParent.find('#allsatuan').val();
  var item_name = trParent.find('td:eq(1)').text().trim();
  var qty = trParent.find('#qty_item').val();
  var idx = trParent.find('#rowIdxPenerimaan').val();
  var selectSatuan = trParent.find('#allsatuan option:selected').text();
  var objAppendTotable = {
      idx : idx,
      objAppend :{
      id: item_id,
      nama_barang: item_name,
      quantity : qty,
      satuan : selectSatuan,
      item_satuan_id : item_satuan_id,
      image : []

    }
  };

  return objAppendTotable;
}


	$(document).ready(function()
  {
    $('min').addClass('active');
      _initCamera();

      $('#mytabs li:eq(0) a').click(function()
      {
          startWebcam();
          alertify.success('please capture');
      });

      $('#mytabs li:eq(1) a').click(function()
      {
        //alertify.success('Webcam Stop');
          //stopWebcam();
          
      });

         _initTable();

          $('#datatable-items').DataTable({
            scrollY:        "300px",
              //scrollX:true,
              scrollCollapse: true,
              paging:         false,
              "order": [[ 0, 'asc' ]],
              columnDefs: [
                        { "visible": false, "targets": 1 }
                      ],
                "order": [[ 1, 'asc' ]],
            "drawCallback": function ( settings ) {
                    var api = this.api();
                    var rows = api.rows( {page:'current'} ).nodes();
                    var last=null;
                    api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                      if ( last !== group ) {
                        $(rows).eq( i ).before(
                          '<tr class="group success"><td><input type="checkbox" class="parent_checkbox" /></td><td colspan="4" class="text-left"><strong>'+group+'</strong></td></tr>'
                        );
                       /// $(rows)
                        last = group;
                      }
                    });  
                }
          });

      var tBody = $('#datatable-items tbody');

      tBody.on('click','.item_checkbox',function()
      {
          var item_id = $(this).val();
          if($(this).is(':checked'))
          {
            var trParent = $(this).parents('tr');
            var objAppendTotable = fnCheckBox(trParent,item_id);
            
            if(objAppendTotable.idx == -1)
            {
              gentable.row.add(objAppendTotable.objAppend);
            }

            gentable.draw();
          }
          else
          {
            var alldata = gentable.rows().data();
            $(alldata).each(function(i,v){
              if(v.id == item_id)
              {
                gentable.row(i).remove().draw();
              }
            });
          }
      }).on('input','.qty_item_add',function(){
          var qty = $(this).val();
          var tr = $(this).parents('tr');
          var _iditem = tr.find('input[type=checkbox]').val();
          var alldata = gentable.rows().data();
            $(alldata).each(function(i,v){
              if(v.id == _iditem)
              {
                var getData = gentable.row(i).data();
                getData.quantity = qty;
                gentable.row(i).data(getData).draw();

              }
            });
    }).on('click','.parent_checkbox',function()
      {
         var groupParent = $(this).parents('.group');
         if($(this).is(':checked'))
         {
           groupParent.nextUntil('.group').each(function()
           {
            $(this).find('input[type="checkbox"]').prop('checked',true);
            var id_item = $(this).find('input[type="checkbox"]').val();
            var objItems = fnCheckBox($(this),id_item);
            if(objItems.idx == -1)
            {
              gentable.row.add(objItems.objAppend);
            }

            gentable.draw();
            //console.log(objItems);
           });
         }
         else
         {
          groupParent.nextUntil('.group').each(function()
           {
              $(this).find('input[type="checkbox"]').prop('checked',false);
              var id_item = $(this).find('input[type="checkbox"]').val();
              var alldata = gentable.rows().data();
              $(alldata).each(function(i,v){
                  if(v.id == id_item)
                  {
                    gentable.row(i).remove().draw();
                  }
                });
             });
         }
         
      }).
    on('change','.input-satuan',function()
    {
          var satuan_id = $(this).val();
          var satuan_text = $(this).find('option:selected').text();
          var tr = $(this).parents('tr');
          var _iditem = tr.find('input[type=checkbox]').val();
          var alldata = gentable.rows().data();
            $(alldata).each(function(i,v){
              if(v.id == _iditem)
              {
                var getData = gentable.row(i).data();
                getData.satuan = satuan_text;
                getData.item_satuan_id = satuan_id;
                gentable.row(i).data(getData).draw();

              }
            }); 
    });

        


      //lookup PIC
      var sourceEngine = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    remote: {
                          url: '/inventory/getUsers/type_user?q=%QUERY%',
                          wildcard: '%QUERY%'
                      }
                  });

      sourceEngine.initialize();

      var $inputType = $('.typeaHead');

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
            //$('#id_pic_giver').val(item.id);
            //console.log($(this)[0].$element.context;
            return item.user_name;
        }
      });

     //lookup source
      var engine = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    remote: {
                          url: '/inventory/getmembers/type_member?q=%QUERY%',
                          wildcard: '%QUERY%'
                      }
                  });

      engine.initialize();
      $('#source').typeahead({
        items : 4,
        source : engine.ttAdapter(),
        
        displayText : function(item)
        {

            return item.member_name+', '+item.description;
        },
        updater: function(item)
        {
            $('input[name='+$(this)[0].$element.context.id+']').prev().val(item.id);
            return item.member_name;
        },
        afterSelect:function(item)
        {
            $('input[name='+$(this)[0].$element.context.id+']').val(item);
            return item;
        }
      });
      //
      //$('.modal-dialog').draggable();

      $('#modal_satuan').on('show.bs.modal', function() {
          $(this).find('.modal-body').css({
            'max-height': '100%'
          });
      });

      $('#btn-item').click(function()
      {
        $('#modal_satuan').modal('show');
      });

      var sbody = $('#datatable-master tbody');

      sbody.on('click','.button-edit',function()
      {
          $('#modal_satuan').modal('show');
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

     $('#from_other').submit(function(e){
          e.preventDefault();
          var dataNotinsert = '';
          var _dataItems = gentable.data();
          var _alldataItemSend = [];

          $(_dataItems).each(function(i,v){
              _alldataItemSend.push(v);
          });
          $('#allItemStore').val(JSON.stringify(_alldataItemSend));

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
                $('#from_other').trigger('reset');
                alertify.success('success saved!',4);
                gentable.clear().draw();
                $('#from_other').trigger('reset');

              }
              else
              {
                alertify.error('Failed saved!',3);
              }
            },
            error:function(xhr,status,errormessage)
            {
                alertify.error('Warning '+xhr.responseText);
            },
            complete:function()
            {}
        });
  });

  });

</script>
@endsection