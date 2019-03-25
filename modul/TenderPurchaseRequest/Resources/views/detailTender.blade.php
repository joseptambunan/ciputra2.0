<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin QS | Dashboard</title>
  <link rel="stylesheet" href="{{ url('/')}}/assets/selectize/selectize.bootstrap3.css">
  @include("master/header")
  <style type="text/css">
    .table-align-right{
      text-align: right;
    }
    .optionItem{
      width:98%;
    }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <section class="content-header">
      <h1 style="text-align:center">Data Tender Purchase Request</h1>
    </section>
    <section class="content-header">
      <div class="" style="float: none">
        <button class="col-md-1 col-sm-2 btn btn-primary" onclick="location.href='{{ url('/')}}/tenderpurchaserequest'" style="float: none; border-radius: 20px; padding-left: 0">
        <i class="fa fa-fw fa-arrow-left"></i>&nbsp;&nbsp;Back
        </button>
        <button class="col-md-1 col-sm-2 btn btn-primary" onclick="window.location.reload()" style="float: right; border-radius: 20px; padding-left: 0;">
          <i class="fa fa-fw fa-refresh"></i>&nbsp;&nbsp;Refresh
        </button>  
      </div>
    </section>
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border" data-widget="collapse">
                <div >
                  
                </div>
                <div class="box-header with-border" style="background-color:white">
                  <div class="">
                    @if($tender_penawaran->approval[0]->approval_action_id !=6)
                    <button type="button" class="btn btn-primary col-md-3" id="btn-approve" data-value="{{ $tender_penawaran->id }}">
                    <i class="fa fa-fw fa-check"></i>
                    &nbsp;&nbsp;
                    Setuju
                    </button>
                    @endif
                  </div>
                  <div class="">
                     @if($tender_penawaran->approval[0]->approval_action_id !=4)
                    <button type="button" class="btn btn-primary col-md-3" id="btn-nexttawar" data-value="{{ $tender_penawaran->id }}">
                    <i class="fa fa-fw fa-arrow"></i>
                    &nbsp;&nbsp;
                    Lanjut Penawaran
                    </button>
                    @endif
                  </div>
                  <div class="">
                    <button type="button" class="btn btn-primary col-md-3" onclick="window.location.href='{{ url('/')}}/tenderpurchaserequest/add-nilai-penawaran?no={{ $id_penawaran_group }}&code={{ $tender_penawaran->no_tender }}'">
                    <i class="fa fa-fw fa-plus"></i>
                    &nbsp;&nbsp;
                    Tambah Penawaran di List ini
                    </button>
                  </div>
                  <div class="">
                    <button type="button" class="btn btn-primary col-md-3" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/kirim-penawaran?no={{ $id_penawaran_group }}&code={{ $tender_penawaran->no_tender }}'">
                    <i class="fa fa-fw fa-book"></i>
                    &nbsp;&nbsp;
                    Kirim / Cetak Penawaran
                    </button>
                  </div>
              </div>
              
                <table class="table">
                  <thead>
                    <tr>
                      <th>Rekanan</th><th>{{ $tender_penawaran->rekanan->name }}</th>
                    </tr>
                    <tr>
                      <th>Nomor Penawaran </th><th>{{ $tender_penawaran->no }}</th>
                    </tr>
                    <tr>
                      <th>Nomor Tender</th><th>{{ $tender_penawaran->no_tender }}</th>
                    </tr>
                  </thead>
                </table>
                <!-- <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse">  
                    <i class="fa fa-minus"></i>
                  </button>
                </div> -->
              </div>
              
              <div class="box-body">
                <input type="hidden" name="supplier" id="supplier" value="{{ $tender_penawaran->rekanan_id }}" />
                <input type="hidden" name="no_tender" id="no_tender" value="{{ $tender_penawaran->no_tender }}" />
                <table id="table_data" class="table table-bordered table-striped dataTable">
                      <thead style="background-color: #0cbdc5;">
                          <tr>
                            <th rowspan="2" class="text-center">No</th>
                            <th colspan="2" class="text-center">Permintaan</th>
                            <th rowspan="2" class="text-center">Qty</th>
                            <th rowspan="2" class="text-center">Satuan</th>
                          </tr>
                          <tr>
                            <th class="text-center">Item</th>
                            <th class="text-center">Brand</th>
                          </tr>
                       </thead>
                       <tbody>
                         @foreach($item_penawaran as $key => $value)
                          <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $value->item }}</td>
                            <td>{{ $value->brand }}</td>
                            <td>{{ $value->satuan_name }}</td>
                          </tr>
                         @endforeach
                       </tbody>
                  </table>

                  <table id="table_data" class="table table-bordered table-striped dataTable">
                      <thead style="background-color: greenyellow;">
                          <tr>
                            <th rowspan="2" class="text-center">No</th>
                            <th colspan="2" class="text-center">Ditawarkan</th>
                            <th rowspan="2" class="text-center">Satuan</th>
                            <th rowspan="2" class="text-center">Harga Satuan Incl. PPn (Rp.)</th>
                          </tr>
                          <tr>
                            <th class="text-center">Item</th>
                            <th class="text-center">Brand</th>
                          </tr>
                       </thead>
                       <tbody>
                         @foreach($tender_penawaran->details as $key => $value)
                          <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $value->item->name }}</td>
                            <td>{{ $value->brand->name }}</td>
                            <td>{{ $value->satuan->name }}</td>
                            <td class="text-right">{{ number_format($value->nilai,2,",",".")}}</td>
                          </tr>
                         @endforeach
                       </tbody>
                  </table>
              </div>
              
            </div>
          </div>
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
@include("pt::app")
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('/')}}/assets/selectize/selectize-modal.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
      headers: {
        'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
      }
    });

    $(document).ready(function()
    {
        $('#btn-approve').click(function()
        {
            var obj = $(this);
            var _data = { id:parseInt($(this).attr('data-value')) };
            var _url = "{{ url('/tenderpurchaserequest/approve_penawaran') }}";

            $.ajax({
              type:'post',
              url:_url,
              data:_data,
              dataType:'json',
              beforeSend:function()
              {
                  waitingDialog.show();
              },
              success:function(data)
              {
                  if(data)
                  {
                      alertify.success('Berhasil');
                      obj.remove();
                  }
              },
              complete:function()
              {
                  waitingDialog.hide();
              }
            });
        });

        $('#btn-nexttawar').click(function()
        {
            var obj = $(this);
            var _data = { id:parseInt($(this).attr('data-value')) };
            var _url = "{{ url('/tenderpurchaserequest/lanjut_tawar') }}";

            $.ajax({
              type:'post',
              url:_url,
              data:_data,
              dataType:'json',
              beforeSend:function()
              {
                  waitingDialog.show();
              },
              success:function(data)
              {
                  if(data)
                  {
                      alertify.success('Berhasil');
                      obj.remove();
                  }
              },
              complete:function()
              {
                  waitingDialog.hide();
              }
            });

        });
    });
</script>
</body>
</html>
