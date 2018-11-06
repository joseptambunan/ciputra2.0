@extends('layouts.master_asset')
@section('title','Detail Mutasi Out')
@section('css')
<link rel="stylesheet" href="{{ url('/') }}/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="{{ URL::asset('assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css')}}" type="text/css"/>

@endsection
@section('content')
<!--ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="#">Home</a></li>
  <li role="presentation"><a href="#">Profile</a></li>
  <li role="presentation"><a href="#">Messages</a></li>
</ul-->

<div class="panel panel-success">
  <div class="panel-heading"><strong>Detail Mutasi Out Asset :</strong> {{ $mutasi_out->asset->item->name or 'Kosong' }} <a href="{{ url('/inventory/mutasi_out/index') }}" class="btn btn-success pull-right"><i class="fa fa-mail-reply"></i> Kembali</a>
    <p/></div>
  <div class="panel-body">
    <a href="{{ url('/inventory/mutasi_out/add') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</a>
    <ul class="nav nav-tabs">
      <li role="presentation" class="active">
        <a href="#tab_asset" data-toggle="tab">Asset</a>
      </li>
      <li role="presentation">
        <a href="#tab_rotasi" data-toggle="tab">Mutasi Out</a>
      </li>
       <li role="presentation">
        <a href="#tab_image" data-toggle="tab">Image</a>
      </li>
    </ul>
  <br/>
    <div class="tab-content">
      <div id="tab_asset" class="tab-pane fade in active">

        <table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap">
                <!--colgroup>
                  <col style="width: 155px;">
                  <col style="width: 10px;">
                  <col style="width: 10px;">
                  <col>
                  <col>
                  <col>
                  <col>
                </colgroup-->
          <thead style="background: #3FD5C0;">
            <tr>
              <th class="text-center">Item</th>
              <th class="text-center">Barcode</th>
              <th class="text-center">Created at</th>
              <th class="text-center">Updated at</th>
            </tr>
          </thead>
          <tbody>
            @if($mutasi_out->asset != null)
            <tr>
              <td class="text-center">{{ $mutasi_out->asset->item->name or 'Kosong' }}</td>
              <td class="text-center">{{ $mutasi_out->asset->barcode or 'Kosong'}}</td>
              <td class="text-center">{{ $mutasi_out->asset->created_at or 'Kosong'}}</td>
              <td class="text-center">{{ $mutasi_out->asset->updated_at or 'Kosong'}}</td>
            </tr>
            @else
              <tr>
                <td class="text-center" colspan="4">Kosong</td>
                
            </tr>
            @endif
          </tbody>

      </table>
      </div>

      <div id="tab_rotasi" class="tab-pane fade">
        <button class="btn btn-info pull-right" type="button" id="btn-edit"><i class="fa fa-edit"></i> Edit</button>
        <br/>
        <br/>
        <table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap">
          <thead style="background: #3FD5C0;">
            <tr>
              <th class="text-center">Penerima</th>
              <th class="text-center">Pemberi</th>
              <th class="text-center">Tujuan</th>
              <th class="text-center">Date</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-center">{{ $mutasi_out->pic_recipient }}</td>
              <td class="text-center">{{ $mutasi_out->name_pic_giver }}</td>
              <td class="text-center">{{ is_null($mutasi_out->warehouse) ? $mutasi_out->destination : $mutasi_out->warehouse->name }}</td>
              <td class="text-center">{{ date('d-m-Y H:m:s',strtotime($mutasi_out->created_at)) }}</td>
             </tr>
           
          </tbody>

      </table>
      </div>
      <div id="tab_image" class="tab-pane fade">

        <div class="col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8 col-sm-offset-2 col-sm-8">
           <div class="bs-example" data-example-id="simple-carousel"> 
              <div class="carousel slide" id="carousel-example-generic" data-ride="carousel"> 
                <ol class="carousel-indicators"> 
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li> 
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li> 
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li> 
                </ol> 
                <div class="carousel-inner" role="listbox"> 
                    <div class="item next left"> 
                      <img id="img1" alt="First slide" src="data:image/png;base64,{{$mutasi_out->image1}}" data-holder-rendered="true"> 
                    </div>

                    <div class="item"> 
                      <img id="img2" alt="Second slide" src="data:image/png;base64,{{$mutasi_out->image1}}" data-holder-rendered="true"> 
                    </div> 

                    <div class="item active left"> 
                      <img id="img3" alt="Third slide" src="data:image/png;base64,{{$mutasi_out->image1}}" data-holder-rendered="true"> 
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
       </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script src="{{ url('/')}}/assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ url('/')}}/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.min.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function()
  {
    $('#mou').addClass('active');
    $('#btn-edit').click(function()
    {
        
    });
    /*$.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('input[name=_token]').val()
        }
    });
    $('.editable_header').editable({
        ajaxOptions: {
            type: 'post',
            dataType: 'json'
        },
        success:function(data)
        {
          if(data.return==1)
          {
            //$('#div_content').load("{{ url()->full() }}");
          }
        }
      }
    );

    $('.editable_details').editable({
        ajaxOptions: {
            type: 'post',
            dataType: 'json'
        },
        success:function(data)
        {
          if(data.return==1)
          {
            $('#div_content').load("{{ url()->full() }}");
          }
        }
      }
    );*/
  });
</script>
@endsection