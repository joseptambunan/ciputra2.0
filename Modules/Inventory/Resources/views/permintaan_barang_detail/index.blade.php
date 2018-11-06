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
                      <a href="{{ url('/inventory/stock/view_stock') }}">Inventory</a>
                  </li>
                  <li>
                     <a href="{{ url('/inventory/permintaan_barang/index') }}">Permintaan Barang : {{ $permintaan->no }}</a>
                      
                  </li>
                  <li>
                    <span>Detail</span>
                  </li>
              </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
                @include('form.a',
                [
                  'href' => url('/inventory/permintaan_barang_detail/add_form').'?id='.$permintaan->id,
                  'caption' => 'Tambah'
                ])

              @include('form.a',
                [
                  'href' => url('/inventory/permintaan_barang/index'),
                  'caption' => 'Kembali'
                ])
                <hr/>
                <div class="panel panel-success">
                  <div class="panel-heading">Permintaan Barang NO <strong>: {{ $permintaan->no}}</strong>
                    @if(count($permintaan_barang_details) > 0 && $permintaan->confirm_by_requester == null)
                      <button class="btn btn-warning pull-right" id="btn-approve" data-value="{{ $permintaan->id}}"><i class="fa fa-check"></i> Approve</button>
                      <br/>
                      <br/>
                    @endif</div>

                  <div class="panel-body">
                    
                    <div class="col-lg-1 col-md-1 col-xs-1">
                      <strong>PT.</strong>
                      <br/>
                      <strong>SPK</strong>
                      <br/>
                      <strong>Keterangan</strong>
                    </div>
                    <div class="col-lg-5 col-md-5 col-xs-5">
                      <strong>: {{ $permintaan->pt->name }}</strong>
                      <br/>
                      <strong>: {{ $permintaan->spk->no or '-' }}</strong>
                      <br/>
                      <strong> : {{ $permintaan->description or '-' }}</strong>
                    </div>

                    <div class="col-lg-1 col-md-1 col-xs-1">
                      <strong>Pengguna</strong>
                      <br/>
                      <strong>Tanggal</strong>
                      <br/>
                      <strong>Status</strong>
                      
                    </div>
                    <div class="col-lg-5 col-md-5 col-xs-5">
                      <strong>: {{ $permintaan->user->user_name }}</strong>
                      <br/>
                      <strong>: {{ date('d-m-Y',strtotime($permintaan->date)) }}</strong>
                      <br/>
                      <strong>: {{ $permintaan->StatusPermintaan->name  or '-' }}</strong>
                    </div>

                  </div>
                </div>

                <table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column table_master" id="table_data">
  
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Barang</th>
                      <th>Qty</th>
                      <th>Satuan</th>
                      <th>Tanggal Dibutuhkan</th>
                      <th>Inventaris</th>
                      <th>Keterangan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($permintaan_barang_details as $key => $value)
                    <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>
                        <a href="#" class="editable_header" 
                          data-pk="{{ $value->id}}" 
                          data-name="item_id" 
                          data-url="{{url('/inventory/permintaan_barang_details/update')}}" 
                          data-original-title="Pilih"
                          data-type="select" 
                          data-value="{{ $value->item_id}}" 
                          data-source="{{ url('/inventory/permintaan_barang_detail/item_source') }}" 
                          data-placement="right">
                        
                          {{ $value->item->name or 'Kosong' }}

                        </a>
                      </td>
                      <td style='text-align:right'>
                        <a href="#" class="editable_header" 
                          data-pk="{{ $value->id}}" 
                          data-name="quantity" 
                          data-url="{{url('/inventory/permintaan_barang_details/update')}}"
                          data-type="text" 
                          data-value="{{ $value->quantity}}" data-placement="right">
                          {{ number_format($value->quantity, 2) }}
                        </a>
                      </td>
                      <td>
                        {{ $value->satuan->name or '-' }}
                      </td>
                      <td>
                        <a href="#" class="editable_header" 
                          data-pk="{{ $value->id}}" 
                          data-name="butuh_date" 
                          data-url="{{url('/inventory/permintaan_barang_details/update')}}"
                          data-type="date" 
                          data-value="{{ $value->butuh_date}}">
                          {{ date('d-m-Y', strtotime($value->butuh_date)) }}

                        </a>
                        </td>
                      <td>
                        {{ $value->StatusPermintaan->name or '-' }}
                      </td>
                      <td>
                        <a href="#" class="editable_header" 
                          data-pk="{{ $value->id}}" 
                          data-name="description" 
                          data-url="{{url('/inventory/permintaan_barang_details/update')}}"
                          data-type="textarea" 
                          data-value="{{ $value->description}}">{{ trim($value->description) }}</a>
                      </td>

                      <td align="center">
                        <button class="btn btn-primary btn-xs btn-edit"><i class="fa fa-edit"></i></button>
                          <button id="{{ $value->id }}" href="#" class="btn btn-danger btn-xs delete-link"> 
                            <i class="fa fa-trash-o"></i>
                          </button>
                        </td>
                  
                    </tr>
                  @endforeach
                  </tbody>
                </table>

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
<!-- ./wrapper -->

@include("master/footer_table")
@include('pluggins.alertify')
@include('pluggins.editable_plugin')
<script type="text/javascript" charset="utf-8">
  $.ajaxSetup({
    headers: {
                  'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                }
    });
  var gentable = null;
  $.fn.editable.defaults.mode = 'inline';
  $(document).ready(function() {
    gentable = $('#table_data').DataTable({
        scrollY:        "300px",
            scrollCollapse: true,
            paging:         false,
            "order": [[ 0, 'asc' ]]
      });

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('input[name=_token]').val()
        }
    });
    $('.editable_header').editable({
        disabled:true,
        ajaxOptions: {
            type: 'post',
            dataType: 'json'
        },
        success:function(data)
        {
          if(data.return==1)
          {
            alertify.success('success');
          }
        }
      }
    );

    $('.btn-edit').click(function()
    {
      $('.editable_header').editable('toggleDisabled');
    });

    var Tbody = $('#table_data tbody');

    Tbody.on('click','.delete-link',function()
    {
      var Tparent = $(this).parents('tr');
      var id = $(this).attr('id');
      var _url = "{{ url('/inventory/permintaan_barang_detail/delete') }}";

       $.confirm({
          title: 'Confirm Delete ?',
          icon: 'fa fa-warning',
          content: 'Are you sure delete ?',
          autoClose: 'cancelAction|8000',
          buttons: {
            deleteUser: {
              text: 'Delete',
              btnClass: 'btn-red any-other-class',
              action: function () {
                $.ajax({
                  type: 'POST',
                    url: _url,
                    data:  {id:id},
                    dataType:'json',
                    beforeSend:function(){
                      alertify.success('sending ...');
                    },
                    success:function(get)
                    {
                      if(get)
                      {
                        alertify.success('success deleted');
                        Tparent[0].remove();
                      }
                    },
                });
              }
            },
            cancelAction: function () {
              
            }
          }
    });
      
    });

    if($('#btn-approve').length)
    {
      $('#btn-approve').click(function()
      {
        var token = $('input[name=_token]').val();
        var id = parseInt($(this).attr('data-value'));
        var _datasend = {id:id,_token:token};
        var _url = "{{ url('/inventory/permintaan_barang/approve') }}";
        var objButton = $(this);
        $.ajax({
            type: 'POST',
              url: _url,
              data: _datasend,
              dataType: 'json',
              beforeSend:function(){
                alertify.success('sending ...');
              },
              success:function(get)
              {
                if(get)
                {
                  alertify.success('success approved');
                  window.location.href= "{{ url('/inventory/permintaan_barang/index') }}";
                }
              },
          });
      });
    }
    
  });
</script>
</body>
</html>
