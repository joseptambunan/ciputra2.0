@extends('layouts.master')
@section('css')

<link href="{{ URL::asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/global/plugins/datatables/fixedHeader.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ URL::asset('assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css')}}" type="text/css"/>

@endsection
@section('content')
<!--ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="#">Home</a></li>
  <li role="presentation"><a href="#">Profile</a></li>
  <li role="presentation"><a href="#">Messages</a></li>
</ul-->

<div class="panel panel-success">
  <div class="panel-heading"><strong>Detail Barang Masuk Hibah : {{ $BarangMasukHibah->no }}</strong></div>
  <div class="panel-body">
    <a href="{{ url('/inventory/hod_inventory/approval_barangmasukhibah') }}" class="btn btn-success" type="button" id="btn_refresh"><i class="fa fa-mail-reply"></i> Kembali</a>
    <p/>
    
    <table class="table table-bordered display table_master">
      <thead style="background: #3FD5C0;">
        <tr>
          <th colspan="2" class="text-center">Project</th>
          <th colspan="2" class="text-center">PT </th>
          <th rowspan="2" class="text-center">Tanggal</th>
          <th rowspan="2" class="text-center">Description</th>
        </tr>
        <tr>
          <th class="text-center">Dari</th>
          <th class="text-center">Kepada</th>
          <th class="text-center">Dari</th>
          <th class="text-center">Kepada</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <a href="#" class="editable_header" 
            data-pk="{{ $BarangMasukHibah->id}}" 
            data-name="from_project_id" 
            data-url="{{url('/inventory/barangmasuk_hibah/update')}}" 
            data-original-title="Pilih Project"
            data-type="select" 
            data-value="{{ $BarangMasukHibah->from_project_id}}" 
            data-source="{{url('/inventory/barangmasuk_hibah/project_source')}}">{{ $BarangMasukHibah->from_project->name }}</a></td>
          <td><a href="#" class="editable_header" 
            data-pk="{{ $BarangMasukHibah->id}}" 
            data-name="to_project_id" 
            data-url="{{url('/inventory/barangmasuk_hibah/update')}}" 
            data-original-title="Pilih Project"
            data-type="select" 
            data-value="{{ $BarangMasukHibah->to_project_id}}" 
            data-source="{{url('/inventory/barangmasuk_hibah/project_source')}}">{{ $BarangMasukHibah->to_project->name }}</a></td>
          <td><a href="#" class="editable_header" 
            data-pk="{{ $BarangMasukHibah->id}}" 
            data-name="from_pt_id" 
            data-url="{{url('/inventory/barangmasuk_hibah/update')}}" 
            data-original-title="Pilih PT"
            data-type="select" 
            data-value="{{ $BarangMasukHibah->from_pt_id }}" 
            data-source="{{url('/inventory/barangmasuk_hibah/pt_source')}}">{{ $BarangMasukHibah->from_pt->name }}</a></td>
          <td><a href="#" class="editable_header" 
            data-pk="{{ $BarangMasukHibah->id}}" 
            data-name="to_pt_id" 
            data-url="{{url('/inventory/barangmasuk_hibah/update')}}" 
            data-original-title="Pilih PT"
            data-type="select" 
            data-value="{{ $BarangMasukHibah->to_pt_id }}" 
            data-source="{{url('/inventory/barangmasuk_hibah/pt_source')}}">{{ $BarangMasukHibah->to_pt->name }}</a></td>
          <td>
            <a href="#" class="editable_header" 
            data-pk="{{ $BarangMasukHibah->id}}" 
            data-name="tanggal_hibah" 
            data-url="{{url('/inventory/barangmasuk_hibah/update')}}" 
            data-original-title="Pilih Tanggal"
            data-type="date" 
            data-value="{{ date('Y-m-d',strtotime($BarangMasukHibah->tanggal_hibah)) }}" >
              {{ date('d-m-Y',strtotime($BarangMasukHibah->tanggal_hibah))}}
            </a>
          </td>
          <td><a href="#" class="editable_header" 
            data-pk="{{ $BarangMasukHibah->id}}" 
            data-name="description" 
            data-url="{{url('/inventory/barangmasuk_hibah/update')}}" 
            data-original-title="description"
            data-type="textarea" 
            data-value="{{ $BarangMasukHibah->description }}">{{ trim($BarangMasukHibah->description) }}</a>
          </td>
        </tr>
      </tbody>
    </table>
    
    <div class="panel panel-success">
          <div class="panel-heading">Details </div>
          <input type="hidden" name="barangmasuk_hibah_id" id="barangmasuk_hibah_id" value="{{ $BarangMasukHibah->id}}" />
          <table id="datatable-details" class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap">
            <thead style="background: #3FD5C0;">
              <tr>
                <th>#</th>
                <th>Item</th>
                <th>Qty Acuan</th>
                <th>Qty Terima</th>
                <th>Reject</th>
                <th>Qty Sisa</th>
                <th>Hrg Sat (Rp.)</th>
                <th>Total Nilai (Rp.)</th>
                <th>Satuan</th>
                <th>WareHouse</th>
                <th></th>
              </tr>
            </thead>
          </table>

          <div class="panel-body">
            <table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column nowrap">
                <colgroup>
                  <col style="width: 155px;">
                  <col style="width: 10px;">
                  <col style="width: 10px;">
                  <col>
                  <col>
                  <col>
                  <col>
                </colgroup>
              <thead style="background: #3FD5C0;">
                <tr>
                  <th class="text-center">Item Barang</th>
                  <th class="text-center">Qty Acuan</th>
                  <th class="text-center">Qty Realisasi</th>
                  <th class="text-center">Harga (Rp.)</th>
                  <th class="text-center">Total (Rp.)</th>
                  <th class="text-center">Satuan</th>
                  <th class="text-center">Gudang</th>
                  <th class="text-center">Description</th>
                </tr>
              </thead>
              <tbody>
                @foreach($BarangMasukHibah->details->where('status','!=',1) as $key => $value)
                <tr>
                  <td>{{ $value->items->name }}</td>
                  <td class="text-right">
                    <a href="#" class="editable_details" 
                    data-pk="{{ $value->id}}" 
                    data-name="quantity_acuan" 
                    data-url="{{url('/inventory/barangmasuk_hibah_details/update')}}" 
                    data-original-title="Quantity"
                    data-type="text" 
                    data-value="{{ $value->quantity_acuan}}">
                      {{ $value->quantity_acuan }}
                    </a>
                  </td>
                  <td class="text-right">{{ is_null($value->quantity) ? 0 : $value->quantity }}</td>

                  <td class="text-right">
                    <a href="#" class="editable_details" 
                    data-pk="{{ $value->id}}" 
                    data-name="price" 
                    data-url="{{url('/inventory/barangmasuk_hibah_details/update')}}" 
                    data-original-title="Price"
                    data-type="text" 
                    data-value="{{ $value->price}}">
                      Rp. {{ number_format($value->price,0,',','.') }}
                    </a>
                  </td>
                  <td>
                    Rp. {{ number_format($value->price*$value->quantity_acuan,0,',','.') }}
                  </td>
                  <td>
                    
                    <a href="#" class="editable_details" 
                    data-pk="{{ $value->id}}" 
                    data-name="item_satuan_id" 
                    data-url="{{url('/inventory/barangmasuk_hibah_details/update')}}" 
                    data-original-title="Pilih Satuan"
                    data-type="select" 
                    data-value="{{ $value->item_satuan_id}}" 
                    data-source="{{url('/barangmasuk_hibah_details/satuan_source')}}">
                      {{ is_null($value->item_satuan) ? $value->item_satuan_id : $value->item_satuan->name }}
                    </a>
                  </td>
                  <td>
                    <a href="#" class="editable_details" 
                    data-pk="{{ $value->id}}" 
                    data-name="warehouse_id" 
                    data-url="{{url('/inventory/barangmasuk_hibah_details/update')}}" 
                    data-original-title="Pilih Warehouse"
                    data-type="select" 
                    data-value="{{ $value->warehouse_id}}" 
                    data-source="{{url('/barangmasuk_hibah_details/warehouse_source')}}">
                      {{ is_null($value->warehouse) ? $value->warehouse_id : $value->warehouse->name }}
                    </a>
                  </td>
                  <td>
                    <a href="#" class="editable_details" 
                    data-pk="{{ $value->id}}" 
                    data-name="description" 
                    data-url="{{url('/inventory/barangmasuk_hibah_details/update')}}" 
                    data-original-title="Description"
                    data-type="textarea" 
                    data-value="{{ $value->description}}">
                    {{ $value->Description }}</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ URL::asset('assets/global/plugins/datatables/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/global/plugins/datatables/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" 
type="text/javascript">
</script>
<script type="text/javascript" src="{{ URL::asset('assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.min.js')}}"></script>

<script type="text/javascript">
  var gentable = null;
  $(document).ready(function()
  {
    $.ajaxSetup({
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
          }
        }
      }
    );

      gentable = $('#datatable-details').DataTable({
      'searching':false,
      'ordering' : false,
      'autoWidth' : false,
      'paging' : false,
      "info": false,
      processing: true,
            ajax: "{{ url('/inventory/hod_inventory/barangmasuk_hibah/Getdetails/') }}/"+parseInt($('#barangmasuk_hibah_id').val()),
            columns:[
                   { data: 'nomor',name: 'nomor',"bSortable": false},
                   { data: 'item_name',name: 'item_name',"bSortable": false},
                   { data: 'quantity_acuan',name: 'quantity_acuan',"className":'text-right',"bSortable": false},
                   { data: 'quantity',name: 'quantity',"className":'text-right',"bSortable": false},
                   { data: 'quantity_reject',name: 'quantity_reject',"className":'text-right',"bSortable": false},
                   { data: 'quantity_sisa',name: 'quantity_sisa',"className":'text-right',"bSortable": false},
                   { data: 'price',name: 'price',"className":'text-right price',"bSortable": false},
                   { data: 'total',name: 'total',"className":'text-right total',"bSortable": false},
                   { data: 'item_satuan',name: 'item_satuan',"className":'text-center',"bSortable": false},
                   { data: 'warehouse_name',name: 'warehouse_name',"bSortable": false},

                  {
                          "className": "action text-center",
                          "data": null,
                          "bSortable": false,
                          "defaultContent": "" +
                          "<div class='' role='group'>" +
                          "  <button class='details btn btn-info btn-xs'><i class='fa fa-list'></i></button>" +
                          "</div>"
                    },
                   ],
            "columnDefs": [],
            "order": [[ 0, 'asc' ]]
      });

      sBody = $('#datatable-details tbody');

      sBody.on('click','.details',function()
      {
        var data = gentable.row($(this).parents('tr')).data();
        window.location.href="{{ url('/inventory/hod_inventory/barangmasuk_hibah/details_item/') }}/"+parseInt($('#barangmasuk_hibah_id').val())+'/'+data.warehouse_id+'/'+data.item_id+'/'+data.item_satuan_id;
        console.log(data);
      });
  });
</script>
@endsection