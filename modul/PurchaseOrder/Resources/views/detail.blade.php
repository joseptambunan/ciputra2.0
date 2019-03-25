<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
</head>
<style type="text/css">
    #DetilModal .modal-dialog {
        width: 90vw;
    }
    #DetilTerm .modal-dialog {
        width: 20vw;
    }
    .table-align-right{
        text-align: right;
        font-weight: normal;

    }
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
        vertical-align : middle;
    }
</style>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="modal fade" id="DetilModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h3 id="modal-header-h3" style="text-align:center">Detail PO di Item No. </h3>
        </div>
        <div class="modal-body">
            <table id="ListPOPR" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>No. Purchase Request</th>
                        <th>No. Budget Tahunan</th>
                        <th>Departemen</th>
                        <th>Quantity</th>
                        <th>Satuan</th>
                        <th>Urgent</th>
                        <th>Tanggal Di Butuhkan</th>
                    </tr>
                </thead>
                <tbody id="tbodyPOPR">
                    <tr>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Content Header (Page header) -->
    
    <section class="content-header">
      <h1 style="text-align:center">Detail Purchase Order</h1>
    </section>
    <section class="content-header">
      <div class="" style="float: none">
        <button class="col-lg-1 col-md-2 col-sm-2 btn btn-primary" onclick="location.href='{{ url('/')}}/purchaseorder'" style="float: none; border-radius: 20px; padding-left: 0">
        <i class="fa fa-fw fa-arrow-left"></i>&nbsp;&nbsp;Back
        </button>
        <button class="col-lg-1 col-md-2 col-sm-2 btn btn-primary" onclick="window.location.reload()" style="float: right; border-radius: 20px; padding-left: 0;">
          <i class="fa fa-fw fa-refresh"></i>&nbsp;&nbsp;Refresh
        </button>  
      </div>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">

                <div class="box-header with-border" data-widget="collapse">
                    <h3 class="box-title text-center">
                          Data Purchase Order Detail
                    </h3>
                    <div class="box-tools pull-right">
                        <!-- <button type="button" class="btn btn-primary" id="btn-approve" data-value="{{ $PO_umum->id }}">
                            <i class="fa fa-fw fa-check"></i>Setuju
                          </button> -->
                        @if(strcmp($user->user_login,"administrator")==0)
                            @if($PO_umum->approval[0]->approval_action_id == 1)
                                <button type="button" class="btn btn-block btn-primary" onclick="location.href='{{ url('/')}}/purchaseorder/request_approve_detail?id={{ $PO_umum->id }}'">
                                        <i class="fa fa-fw fa-send-o"></i> Request Approval 
                                </button>
                            @elseif($PO_umum->approval[0]->approval_action_id == 2)
                                <button type="button" class="btn btn-block btn-primary" onclick="location.href='{{ url('/')}}/purchaseorder/undo_request_approve_detail?id={{ $PO_umum->id }}'">
                                        <i class="fa fa-fw fa-send-o"></i> Undo Request Approval 
                                </button>
                            @endif
                        @endif
                    </div>
                  
                </div>
                <div class="box-body" style="">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Nomo PO</th><th>{{$PO_umum->no}}</th>
                        </tr>
                        <tr>
                          <th>Nomo Tender</th><th>{{$PO_umum->tender_menang->tender->no}}</th>
                        </tr>
                        <tr>
                          <th>Nomor Penawaran</th><th>{{ $PO_umum->tender_menang->penawaran->no }}</th>
                        </tr>
                         <tr>
                          <th>Supplier</th><th>{{ $PO_umum->vendor->name }}</th>
                        </tr>
                        <tr>
                          <th>Deskripsi</th><th>{{$PO_umum->description}}</th>
                        </tr>
                      </thead>
                      
                    </table>

                    <a href="{{ url('/purchaseorder/cetakpdf',$PO_umum->id) }}" class="btn btn-primary pull-left"><i class="fa fa-print"></i> Cetak Dokumen</a>
                    

                </div>
            </div>
        </div>
    </div>
    <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border" data-widget="collapse">
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="box-body">
                  <table id="ListTelahKelompok" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                      <thead style="background-color: greenyellow;">
                        <tr >
                          <th class="table-align-right">No</th>
                          <th>Item</th>
                          <th>Brand</th>
                          <th>Satuan</th>
                          <th class="text-right">Quantity</th>
                          <th class="text-right">Harga Satuan (Rp.)</th>
                          <!-- <th class="text-right">Disc. (%)</th> -->
                          <th class="text-right">Total (Rp.)</th>
                          <th class="text-right">PPN (%)</th>
                          <!-- <th class="text-right">PPH (%)</th> -->
                        </tr>
                        </thead>
                        <tbody>
                          <?php
                            $totalppn =0;
                            $totalpph=0;
                            $subtotal = 0;
                            $total_disc = 0;
                          ?>
                            @foreach($PO_umum->details as $key => $v)
                              <tr>
                                <td class="table-align-right">{{$key+1}}</td>
                                <th>{{ $v->item->item->name }}</th>
                                <td>{{ $v->brand->name }}</td>
                                <td>{{ $v->satuan->name }}</td>
                                <td class="table-align-right">{{$v->quantity}}</td>
                                
                                <td class="table-align-right">{{number_format($v->harga_satuan,2,".",",")}}</td>
                                <!-- <td class="table-align-right">{{$v->discon}}</td> -->
                                <td class="table-align-right">
                                  {{ number_format(($v->harga_satuan*$v->quantity),2,".",",") }}
                                </td>
                                <td class="text-right">{{ $v->ppn }}</td>

                                <!-- <td class="text-right">{{$v->pph}}</td> -->
                                
                              </tr>
                              <?php
                                $diskon = $v->discon/100*($v->harga_satuan*$v->quantity);
                                $total_disc += $diskon;
                                $sbtotal = $v->harga_satuan*$v->quantity;
                                $subtotal += $sbtotal-$diskon;

                                $totalppn += $v->ppn/100*($sbtotal-$diskon);
                                $totalpph += $v->pph/100*($sbtotal-$diskon);
                              ?>
                            @endforeach()
                        </tbody>
                    </table>
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="text-right col-md-5">SubTotal (Rp.)</th><th class="text-right col-md-4">{{ number_format($subtotal,2,".",",") }}</th><th class="col-md-1"></th>
                        </tr>
                        <!-- <tr>
                          <th class="text-right">Total Disc. (Rp.)</th><th class="text-right">{{ number_format($total_disc,2,".",",") }}</th>
                        </tr> -->
                        <!-- <tr>
                          <th class="text-right">SubTotal Dikurangi Diskon (Rp.)</th><th class="text-right">{{ number_format($subtotal-$total_disc,2,".",",") }}</th>
                        </tr> -->
                        <tr>
                          <th class="text-right">Total PPN (Rp.)</th><th class="text-right">{{ number_format($totalppn,2,".",",") }}</th><th></th>
                        </tr>
                         <!-- <tr>
                          <th class="text-right">Total PPH (Rp.)</th><th class="text-right">{{ number_format($totalpph,2,".",",") }}</th>
                        </tr> -->
                        <tr>
                          <th class="text-right">Grand Total (Rp.)</th><th class="text-right">{{ number_format(($subtotal)+$totalppn,2,".",",") }}</th><th></th>
                        </tr>
                      </thead>
                    </table>
              </div>
              
            </div>
          </div>
        </div>
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
<!--@include("pt::app")-->
</body>
<script type="text/javascript">
  $.ajaxSetup({
      headers: {
        'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
      }
    });
    function changeDetilModal(val){
        document.getElementById("modal-header-h3").innerHTML  = "Detail PO di Item No. "+val;
        console.log(val);
        var url = "{{ url('/')}}/purchaseorder/getDetilPOPR";
        var item = $("#tbodyPOPR");
        var send1 = val;
        console.log(url + '/' + send1);
        var getjson = $.getJSON(url + '/' + send1, function (data) {
            item.addClass("item");
            item.empty();
            for(var i = 0; i <= data.length ; i++){
                if(i<data.length){
                    var tr        = document.createElement("tr");
                    tr.value      = data[i].id;
                    tr.innerHTML  = "<tr>"
                                    +"<td>"+[i+1]+"</td>"
                                    +"<td>"+data[i].purchaserequest_no+"</td>"
                                    +"<td>"+data[i].btNo+"</td>"
                                    +"<td>"+data[i].departement_name+"</td>"
                                    +"<td>"+data[i].quantity+"</td>"
                                    +"<td>"+data[i].satuan+"</td>"
                                    +"<td>"+data[i].urgent+"</td>"
                                    +"<td>"+data[i].date_dibutuhkan+"</td>"
                                    +"</tr>";
                    item.append(tr);
                }else
                    item.removeClass("item");
                }
            document.getElementById("divTender").style.visibility = "visible";
        }); 
    }

    $(document).ready(function()
    {
        $('#btn-approve').click(function()
        {
            var obj = $(this);
            var _data = { id:parseInt($(this).attr('data-value')) };
            var _url = "{{ url('/purchaseorder/approve') }}";

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
</html>
