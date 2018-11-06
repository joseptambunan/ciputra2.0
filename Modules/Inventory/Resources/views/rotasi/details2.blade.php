@extends('layouts.master_asset')
@section('css')
 <link href="{{ URL::asset('assets/global/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
 <link href="{{ URL::asset('assets/global/plugins/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
 <link href="{{ URL::asset('assets/global/plugins/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
 <link href="{{ URL::asset('assets/global/plugins/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ URL::asset('assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css')}}" type="text/css"/>

@endsection
@section('content')
<!--ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="#">Home</a></li>
  <li role="presentation"><a href="#">Profile</a></li>
  <li role="presentation"><a href="#">Messages</a></li>
</ul-->

<div class="panel panel-success">
  <div class="panel-heading"><strong>Detail Rotasi Asset :</strong> {{ $rotasi->asset->Item->name }} <a href="{{ url('/rotasi/index') }}" class="btn btn-success pull-right"><i class="fa fa-mail-reply"></i> Back</a>
    <p/></div>
  <div class="panel-body">
    <ul class="nav nav-tabs">
      <li role="presentation" class="active">
        <a href="#tab_asset" data-toggle="tab">Asset</a>
      </li>
      <li role="presentation">
        <a href="#tab_rotasi" data-toggle="tab">Rotasi</a>
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
            <tr>
              <td class="text-center">{{ $rotasi->asset->Item->name }}</td>
              <td class="text-center">{{ $rotasi->barcode }}</td>
              <td class="text-center">{{ $rotasi->asset->created_at }}</td>
              <td class="text-center">{{ $rotasi->asset->updated_at }}</td>
            </tr>
          </tbody>

      </table>
      </div>

      <div id="tab_rotasi" class="tab-pane fade">
        <button class="btn btn-info pull-right" type="button" id="btn-edit"><i class="fa fa-edit"></i> Edit</button>
        <br/>
        <br/>
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
              <th class="text-center">#</th>
              <th class="text-center">From Department</th>
              <th class="text-center">To Department</th>
               <th class="text-center">From Location</th>
              <th class="text-center">To Location</th>
              <th class="text-center">From Room</th>
              <th class="text-center">To Room</th>
              <th class="text-center">Date</th>
            </tr>
          </thead>
          <tbody>
            @foreach($rotasi as $value)
            {{ $value }}
            @endforeach
          </tbody>

      </table>
      </div>
    </div>

    
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

<script type="text/javascript">
  $(document).ready(function()
  {

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