@extends('layouts.master_asset')
@section('title','Periode OpName')
@section('css')
  <link href="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="panel panel-success">
          <div class="panel-heading">
            Periode OpName
          </div>
          <div class="panel-body">
            <form action="{{ url('/inventory/opname/store_period') }}" method="post" class="form-horizontal form-label-left" id="form_data">
    
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Periode</label>
                    <div class="col-md-7 col-sm-7 col-xs-12">
                      {{ csrf_field() }}
                      <div class="input-group" id="dtpicker">
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        <input type="text" name="periode" id="periode" class="form-control"/>
                        <input type="hidden" name="start_opname" id="start_opname" value="{{date('Y-m-d')}}" />
                        <input type="hidden" name="end_opname" id="end_opname" value="{{date('Y-m-d')}}" />
                      </div>
                    </div>
                  </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Gudang</label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <select class='form-control select2' name='warehouse_id' id='warehouse_id'>
                    <option value=""></option>
                    @foreach($warehouses as $key => $value)
                      <option value='{{ $value->id }}'>{{ $value->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                  <div class="col-md-7 col-sm-7 col-xs-12">
                    <textarea class='form-control' name="description" id="description" cols="45" rows="5" placeholder="Description"></textarea>
                  </div>
                </div>
                
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                  <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> OK</button>
                  <button id="reset" type="reset" class="btn btn-warning"><i class="fa fa-times"></i> Reset</button>
                  <a href="{{ url('/inventory/opname/listPeriod') }}" class="btn btn-danger"><i class="fa fa-reply"></i> Back</a>
                </div>
              </div>
            </form>
          </div>
        </div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ URL::asset('assets/global/plugins/moment.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}"></script>
 <script src="{{ URL::asset('vendor/jsvalidation/js/jsvalidation.min.js')}}" type='text/javascript'></script>
  {!! JsValidator::formRequest('Modules\Inventory\Http\Requests\RequestPeriodeOpName', '#form_data') !!}
<script type="text/javascript">
      var dtpicker = null;
      $(document).ready(function()
      {
          $('#stop').addClass('active');
          $('#periode').daterangepicker({
            //startDate: moment().subtract('days', 29),
           // endDate: moment(),
           format: 'DD/MM/YYYY',
            dateLimit: { days: 60 },
            showDropdowns: true,
            showWeekNumbers: true,
            
            separator: ' to '
          }
            ,function(start,end)
            {
              $('#start_opname').val(start.format('YYYY-MM-DD'));
              $('#end_opname').val(end.format('YYYY-MM-DD'));
            });
          
          $('#cancel').click(function()
          {
              window.location.href = "{{ url('/inventory/opname/listPeriod') }}";
          });
      });
    </script>
@endsection