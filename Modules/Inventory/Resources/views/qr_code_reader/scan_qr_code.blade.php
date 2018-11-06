@extends('layouts.master_asset')
@section('title','Opname Stock')
@section('css')
<link rel="stylesheet" href="{{ url('/') }}/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection
@section('content')
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="panel panel-success">
    <div class="panel-heading">
       <strong>Opname at {{ $header->warehouse->name }}, Periode : {{ date('d-m-Y',strtotime($header->start_opname)) }} - {{ date('d-m-Y',strtotime($header->end_opname)) }}</strong>
       <a href="{{ url('/inventory/opname/assets',$header->id) }}" class="btn btn-primary pull-right"><i class="fa fa-backward"></i> Details</a>
       <p/>
    </div>
    <div class="panel-body">

      <a href="{{ url('/inventory/opname/listPeriod') }}" class="btn btn-info pull-right"><i class="fa fa-reply"></i> Back</a>
      <ul class="nav nav-tabs">
      <li role="presentation" class="active">
        <a href="#tab_scan" data-toggle="tab">Scan</a>
      </li>  
    </ul>

    <div class="tab-content">
      <div id="tab_scan" class="tab-pane fade in active">
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
      <p/>
        <form action="{{ url('/inventory/opname/store_opname_asset') }}" method="post" id="form_data" name="form_data">
            {{ csrf_field() }}
            <input type="hidden" name="period_op_name_id" id="period_op_name_id" value="{{$header->id}}" />
            <input type="hidden" name="allItemStore" id="allItemStore" />
            <button id="send" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
            
        </form>
      <input type="hidden" name="rowIdx" id="rowIdxPenerimaan" value="-1" />
      <table id="datatable-master" class="table table-striped table-bordered dt-responsive nowrap">
                <thead style="background-color: #3FD5C0;">
                  <tr>
                    <th>#</th>
                    <th class="text-center">Kode Barang</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Dept.</th>
                    <th class="text-center">Lokasi</th>
                    <th></th>
                    <th style="display: none;">Remarks</th>
                    <th style="display: none;">Images</th>
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
        <h4 class="modal-title" id="myModalLabel">Description</h4>
      </div>
      <div class="modal-body">
        <div class="form-horizontal form-label-left">
          <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
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
  <script type="text/javascript">
  let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
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
              //if yes
              var tableItem = {
                id:obj.id,
                kode_barang:obj.barcode,
                nama_barang : obj.nama_item,
                dept : obj.department_name,
                lokasi : obj.location,
                kode_produk :obj.id_item,
                remarks: null,
                image : []
              };
              if(idx== -1)
              {
                gentable.row.add(tableItem);
              }
              gentable.draw();
              alertify.success('Ok, Capture Gambar');

            },
            function(){
              alertify.prompt( 'Description', '', ''
               , function(evt, value) { 
                  var tblItem = {
                      id:obj.id,
                      kode_barang:obj.barcode,
                      nama_barang : obj.nama_item,
                      dept : obj.department_name,
                      lokasi : obj.location,
                      kode_produk :obj.id_item,
                      remarks : value,
                      image : []
                    };
                    if(idx== -1)
                    {
                      gentable.row.add(tblItem);
                    }
                  gentable.draw();
              }
               , function() { alertify.error('Cancel') }).set({labels:{ok:'Ya',cancel:'Batal'}});
          }).set({labels:{ok:'Ya',cancel:'Tutup'}});
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
                    {'data':'lokasi'},
                    { 'data': 'kode_produk', 'mRender': _renderEditColumnPenerimaan, 'sClass': 'text-center' },
                    {'data' : 'remarks'},
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
            }).on('click','tr',function(){
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
              
          }).
          on('click','.button-remarks',function()
          {
              var data = gentable.row($(this).parents('tr')).data();
              var index = gentable.row($(this).parents('tr')).index();
              $('#description').val(data.remarks);
              $('#btn-remarks').attr('data-id',index);
              $('#modal_satuan').show();
          });
      }

    var _GeneralTable = function (arrColumns) {
            var _coldefs = [{targets:[6,7],visible:false}];
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

           //camera 
          _initCamera();
          startWebcam();
          _initTable();

         $('#form_data').submit(function(e){
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
                  if(data.dataExists.length > 0)
                  {
                    dataNotinsert +='<ul>';
                    for(var i=0;i<data.dataExists.length;i++)
                    {
                        dataNotinsert+='<li> Nama : '+data.dataExists[i].item_name+', Barcode : '+data.dataExists[i].barcode+'</li>';
                    }
                    dataNotinsert+='</ul>';
                    alertify.alert('Data Sudah ada pada periode ini',dataNotinsert);
                  }
                  else
                  {
                    if(data.stat)
                    {
                      alertify.success('Success');
                      gentable.clear().draw();
                    }
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