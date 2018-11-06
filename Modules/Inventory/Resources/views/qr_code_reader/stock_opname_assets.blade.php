@extends('layouts.master_asset')
@section('title','Periode OpName')
@section('css')
<link href="{{ URL::asset('assets/global/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/global/plugins/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/global/plugins/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/global/plugins/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css')}}"
<!-- alertify -->
<link href="{{ URL::asset('assets/global/plugins/alertify/css/alertify.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/global/plugins/alertify/css/default.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
      <!-- Main component for a primary marketing message or call to action -->
      <div class="panel panel-success">
      <div class="panel-heading"><strong>Daftar Periode Opname asset</strong></div>
      <div class="panel-body">
        <p/>
        <a href="{{ url('/inventory/opname/listPeriod') }}" class="btn btn-info"><i class="fa fa-mail-reply"> Back</i></a>
        <a href="{{ url('/inventory/opname/create_period') }}" class="btn btn-success" ><i class="fa fa-plus"></i> Add</a>

        <a href="{{url('/inventory/opname/scan_qr_code',$detailPeriod->id)}}" class="btn btn-primary pull-right" type="button" id="btn-next"><i class="fa fa-mail-forward"></i> Lanjut</a>
        <table id="table_data" class="table table-bordered display table_master">
             <!--colgroup>
              <col width="10%">
              <col width="25%">
              <col width="5%">
            </colgroup-->
                <thead style="background-color: #3FD5C0;">
                  <tr>
                    <th class="text-center">Start</th>
                    <th class="text-center">End</th>
                    <th class="text-center">Warehouse</th>
                    <th class="text-center">Desc.</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center">
                      <a href="#" class="editable_header" 
                    data-pk="{{ $detailPeriod->id}}" 
                    data-name="start_opname" 
                    data-url="{{url('/inventory/period_opname/update')}}" 
                    data-original-title="Pilih Tanggal"
                    data-type="date" 
                    data-value="{{ date('Y-m-d',strtotime($detailPeriod->start_opname)) }}" >
                      {{ date('d-m-Y',strtotime($detailPeriod->start_opname)) }}
                    </a>
                    </td>
                    <td class="text-center">
                      <a href="#" class="editable_header" 
                    data-pk="{{ $detailPeriod->id}}" 
                    data-name="end_opname" 
                    data-url="{{url('/inventory/period_opname/update')}}" 
                    data-original-title="Pilih Tanggal"
                    data-type="date" 
                    data-value="{{ date('Y-m-d',strtotime($detailPeriod->end_opname)) }}" >
                      {{ date('d-m-Y',strtotime($detailPeriod->end_opname)) }}
                    </a>
                    </td>
                    <td class="text-center"><a href="#" class="editable_header" data-pk="{{ $detailPeriod->id}}" data-name="warehouse_id" data-url="{{url('/inventory/period_opname/update')}}" data-original-title="Pilih Warehouse" data-type="select" data-value="{{ $detailPeriod->warehouse_id}}" data-source="{{url('/inventory/barangmasuk_hibah_details/warehouse_source')}}">{{ $detailPeriod->warehouse->name }}</a></td>
                    <td class="text-center"><a href="#" class="editable_header" 
                    data-pk="{{ $detailPeriod->id}}" 
                    data-name="description" 
                    data-url="{{url('/inventory/period_opname/update')}}" 
                    data-original-title="Description"
                    data-type="text" 
                    data-value="{{ $detailPeriod->description }}" >{{ $detailPeriod->description }}</a></td>
                  </tr>
                </tbody>
            </table>

            <div class="panel panel-info">
              <div class="panel-heading"><strong>Detail OpName</strong></div>
              <div class="panel-body">
                <table id="datatable-master" class="table table-bordered display table_master">
                   <!--colgroup>
                    <col width="10%">
                    <col width="25%">
                    <col width="5%">
                  </colgroup-->
                      <thead style="background-color: #3FD5C0;">
                        <tr>
                          <th class="text-center">Kode Barang</th>
                          <th class="text-center">Nama</th>
                          <th class="text-center">Desc.</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if($detailPeriod->details->count() > 0)
                          @foreach($detailPeriod->details as $key =>$value)
                          <tr>
                            <td class="text-center">{{ $value->barcode }}</td>
                            <td class="text-center">{{ $value->item->name }}</td>
                            <td class="text-center">{{ $value->description or 'Empty' }}</td>
                          </tr>
                          @endforeach
                        @else
                        <tr>
                          <td class="text-center" colspan="3"> Empty </td>
                        </tr>
                        @endif
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
<script type="text/javascript" src="{{ URL::asset('assets/global/plugins/alertify/js/alertify.min.js')}}"></script>
    <script type="text/javascript">
      var gentable = null;
      $(document).ready(function()
      {

          $.ajaxSetup({
              headers: {
                  'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
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
                  alertify.success('success');
                  //$('#div_content').load("{{ url()->full() }}");
                }
                else
                {
                  alertify.error('Failed');
                }
              }
            }
          );
          
      });
    </script>
@endsection