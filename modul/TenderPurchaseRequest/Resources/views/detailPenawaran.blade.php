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
      <h1 style="text-align:center">Detail Penawaran Supplier {{ $project->name }}</h1>
    </section>
    <section class="content-header">
      <div class="" style="float: none">
        <button class="col-lg-1 col-md-2 col-sm-2 btn btn-primary" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/index_penawaran'" style="float: none; border-radius: 20px; padding-left: 0">
        <i class="fa fa-fw fa-arrow-left"></i>&nbsp;&nbsp;Back
        </button>
        <button class="col-lg-1 col-md-2 col-sm-2 btn btn-primary" onclick="window.location.reload()" style="float: right; border-radius: 20px; padding-left: 0;">
          <i class="fa fa-fw fa-refresh"></i>&nbsp;&nbsp;Refresh
        </button>  
      </div>
    </section>
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h4>Detail Penawaran Tender</h4>
                <div class="box-header with-border" style="background-color:white">
                   @if($errors->any())
                    <h4 style="color: blue;">{{$errors->first()}}</h4>
                    @endif 
                  <table class="table">
                    <thead>
                      <tr>
                        <th>No Tender</th><th>{{ $getDataTender->no }}</th>
                      </tr>
                      <tr>

                        <th>Status Tender</th>
                        <th>
                          <?php 
                            if(count($checkStatus) > 0)
                            {
                              if(in_array(1,$checkStatus)){print "<strong style='color:green;'> APPROVED </strong>";}else{print "<strong style='color:yellow;'> DELIVERED </strong>";}
                            }
                            else
                            {
                              print "<strong style='color:black;'> OPEN </strong>";
                            }
                          ?>
                        </th>
                        <tr>
                            <th>Penawaran</th><th>{{ $penawaran }}</th>
                        </tr>

                        
                        @foreach($description_reject_approval_history as $key => $v)
                        <tr>
                            <th>Reject</th><th>{{ $v['name_supplier'] }}</th><th>{{ $v['description'] }}</th>
                        </tr>
                        @endforeach

                      </tr>
                      @if($checkPemenang != null)
                      <tr>
                        @if($checkPemenang->status_usulan)
                        <th>Usulan Pemenang Tender</th>
                        <th>{{ $checkPemenang->tender_purchase_request_group_rekanan_detail->rekanan->name }}</th>
                        @else
                        <th>Pemenang Tender</th>
                        <th>{{ $checkPemenang->tender_purchase_request_group_rekanan_detail->rekanan->name }}</th>
                        @endif
                      </tr>
                      @endif

                      @if(count($checkStatus) > 0)
                        @if(in_array(1,$checkStatus))
                        <tr>
                          <th>Pemenang Tender</th><th style="color:blue;">{{ $checkPemenang->tender_purchase_request_group_rekanan_detail->rekanan->name }}</th>
                        </tr>
                        @endif
                      @endif

                    </thead>
                  </table>
                  @if(strcmp($user->user_login,"administrator")==0)
                    @if(count($checkStatus) <= 0)
                    <form action="{{ url('/tenderpurchaserequest/request_approval_penawaran') }}" method="post" name="form_req_approval">
                      @csrf
                      <input type="hidden" name="tenderid" id="tenderid" value="{{ $getDataTender->id }}" />
                      <input type="hidden" name="rekananid" id="rekananid" value="" />
                      <input type="hidden" name="penawaran_ke" id="penawaran_ke" value="{{ $penawaran }}">
                      <button disabled="true" type="submit" id="btn_tunjuk_pemenang" class="btn btn-primary pull-right"><i class="fa fa-send-o"> Usulan Pemenang</i></button>
                      <div class="alert alert-default" role="alert">
                      <u style="color: blue;">Silahkan Klik Nama Rekanan Untuk Di usulkan sebagai pemenang Tender</u>
                    </div>
                    </form>
                    @endif
                    <!-- @if($checkStatus >= 0)
                      @if($checkPemenang != null)
                        <input type="hidden" name="id_tender" id="id_tender" value="{{ $getDataTender->id }}" /> 
                        <button  id="btn_approve" class="btn btn-primary"><i class="fa fa-check" data-id="{{ $checkPemenang->id }}"> Approve</i></button>
                        <button  id="btn_reject" class="btn btn-danger" data-toggle="modal" data-target="#myModal"><i class="fa fa-check" > Reject</i></button>
                      @endif
                    @endif -->
                  @endif
                  
                </div>
              </div>

              <div class="box-body" style="overflow-x: scroll;">
                <?php
                  $arr_temp_rekanan = [];
                ?>
                <table class="table table-bordered table-striped dataTable" id="table_comparison">
                    <thead style="background-color: greenyellow;">
                      <tr>
                        <th rowspan="2" style="width: 50%;"><button class="btn btn-default" disabled="true">Barang Penawaran</button></th>
                        <th rowspan="2">Volume</th>
                        <th rowspan="2">Satuan</th>
                        <th colspan="{{ count($data_rekanan) }}" class="text-center">Harga Satuan (Rp.)</th>
                        <th colspan="{{ count($data_rekanan) }}" class="text-center">Total Harga(Rp.)</th>
                        <th colspan="{{ count($data_rekanan) }}" class="text-center">Brand</th>
                    </tr>
                    <tr>
                      <?php
                          foreach($join_data_rekanan as $key => $value){
                              $split_value = explode("-", $value);
                            if($key < (count($join_data_rekanan)/3))
                            {
                              print "<th style='background-color: #0fdee8;'>".$split_value[0]."</th>";
                            }
                            else if($key == (count($join_data_rekanan)/3))
                            {
                              print "<th class='sum' data-ppn='".$split_value[2]."' style='background-color: #d578ed;'>".$split_value[0]."</th>";
                            }
                            else if($key >= ((count($join_data_rekanan)/3)*2))
                            {
                              print "<th class='sg' style='background-color: #6d77ea;'>".$split_value[0]."</th>";
                            }
                            else
                            {
                                print "<th class='sum' data-ppn='".$split_value[2]."'' style='background-color: #d578ed;'><input type='hidden' name='rekanan_id' id='rekanan_id' value='".$split_value[1]."' /><button class='btn btn-default klik_rekanan' type='button'>".$split_value[0]."</button></th>";
                            }
                            
                          }
                       ?>
                         
                    </tr>

                    </thead>

                    <tbody>
                      <?php

                       foreach ($result as $key => $value) {
                         # code...
                          print "<tr>";
                          print "<td>".$value['item_name']."</td>";
                          print "<td class='text-right'>".$value['volume']."</td>";
                          print "<td>".$value['satuan_name']."</td>";
                          foreach ($value['satuan_price'] as $k => $v) {
                              print "<td class='text-right money'>".$v."</td>";
                            
                          }
                          print "</tr>"; 
                       }
                     ?>
                    </tbody>
                    <tfoot>
                        <tr>
                          <th colspan="{{ (count($join_data_rekanan)/3)+3 }}" class="text-right">Sub Total</th>
                          @for($i=0; $i < count($join_data_rekanan)/3;$i++)

                            <th class="text-right sub_total money">
                            </th>
                          @endfor
                          <th colspan="{{ (count($join_data_rekanan)/3) }}"></th>
                        </tr>
                        <tr>
                          <th colspan="{{ (count($join_data_rekanan)/3)+3 }}" class="text-right">PPN (Rp.)</th>
                          @for($i=0; $i < count($join_data_rekanan)/3;$i++)
                            <th class="text-right ppn_value money">
                            </th>
                          @endfor
                          <th colspan="{{ (count($join_data_rekanan)/3) }}"></th>
                        </tr>

                        <tr>
                          <th colspan="{{ (count($join_data_rekanan)/3)+3 }}" class="text-right">Grand Total</th>
                          @for($i=0; $i < count($join_data_rekanan)/3;$i++)
                            <th class="text-right grand_total money">
                            </th>
                          @endfor
                          <th colspan="{{ (count($join_data_rekanan)/3) }}"></th>
                        </tr>
                    </tfoot>
                  </table>
              </div>
            </div>
          </div>
        </div>
          <!-- /.row -->

        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border" style="height: 50px">
                        <div>
                            <!-- <h4>Klarifikasi Penetapan Metode Pembayaran Tender</h4> -->
                            <h4>Detail Metode Pembayaran Tender</h4>
                        </div>
                    </div>
                    <div class="box-body">
                        <div>
                @foreach($tenderPembayaran as $key => $v)
                    <!-- <div>{{$v->tender_purchase_request_group_rekanan_detail->rekanan->name}} - {{$v->name_pembayaran}}</div> -->
                    @if( $v->name_pembayaran == 'termin')
                        <table class="table_pembayaran table table-bordered dataTable table-hover" id="table_pembayaran" style="margin-bottom: 30px">
                            <thead style="background-color: gray;">
                                <tr>
                                    <th rowspan="2">Supplier</th>
                                    <th rowspan="2">Metode</th>
                                    <th rowspan="2">DP</th>
                                    @if($v->lama_cicilan >= 1)
                                        @for($i=1; $i<= $v->lama_cicilan; $i++)
                                        <th rowspan="2">Termin {{$i}}</th>
                                        @endfor
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>{{$v->tender_purchase_request_group_rekanan_detail->rekanan->name}}</th>
                                    <th>{{$v->name_pembayaran}}</th>
                                    <th>{{$v->DP}}%</th>
                                    <?php
                                        $termin_pembayaran = DB::table('tender_purchase_request_penawaran_pembayaran_termin')->where('tender_purchase_request_penawaran_id',$v->id_penawaran)->get();
                                    ?>

                                    @foreach($termin_pembayaran as $key => $value)
                                        <th>{{$value->percentage}}%</th>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    @elseif($v->name_pembayaran == 'cod')
                        <table class="table_pembayaran table table-bordered dataTable" id="table_pembayaran">
                        <thead style="background-color:gray;">
                            <tr>
                                <th rowspan="2">Supplier</th>
                                <th rowspan="2">Metode</th>
                                <th rowspan="2">DP</th>
                                @if($v->lama_cicilan >= 1)
                                    @for($i=1; $i<= $v->lama_cicilan; $i++)
                                    <th rowspan="2">COD {{$i}}</th>
                                    @endfor
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>{{$v->tender_purchase_request_group_rekanan_detail->rekanan->name}}</th>
                                <th>{{$v->name_pembayaran}}</th>
                                <th>{{$v->DP}}%</th>
                                @for($i=1; $i<= $v->lama_cicilan; $i++)
                                    <th>
                                        <?php
                                            $termin_pembayaran = DB::table('tender_purchase_request_penawaran_pembayaran_cod')->join('items','items.id','tender_purchase_request_penawaran_pembayaran_cod.item_id')->join('item_satuans','item_satuans.id','tender_purchase_request_penawaran_pembayaran_cod.item_satuan_id')->where('tender_purchase_request_penawaran_id',$v->id_penawaran)->where('cod_ke',$i)->select('items.name as item_name','tender_purchase_request_penawaran_pembayaran_cod.quantity as quantity','item_satuans.name as satuan')->get();
                                        ?>
                                        @foreach($termin_pembayaran as $key => $value)
                                            <div>{{$value->item_name}} | {{$value->quantity}} {{$value->satuan}}</div>
                                        @endforeach
                                    </th>
                                @endfor               
                            </tr>
                        </tbody>
                    </table>
                    @endif
                @endforeach
                <a href="{{ url('/tenderpurchaserequest/penetapan',$getDataTender->id) }}" class="btn btn-primary pull-right"><i class="fa fa-edit"></i> Buat Penetapan Metode Pembayaran Tender</a>
                </div>
                       <!--  <div id="divSupplier" class="form-group">
                            <label class="col-md-3 control-label">DP (%)</label>
                            <div class="col-md-2">
                              <input type="number" name="percentage_dp" id="percentage_dp" class="form-control" value="0" step="any" min="0">
                            </div>
                            <div class="col-md-12"></div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Metode Sisa Pembayaran</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <select id="cara_bayar" class="form-control" name="cara_bayar" required>
                                            <option value="">Pilih</option>
                                            @foreach($metode_pembayaran as $value)
                                                <option value="{{$value->id}}">{{strtoupper($value->name)}}</option>
                                            @endforeach
                                        </select>
                                      <div class="input-group-addon">Termin</div>
                                      <input type="number" class="form-control text-right" id="termin" name="termin" value="1" step="any" min="1">
                                      <div class="input-group-addon" id="info_bayar"></div>
                                    </div>
                                </div>
                         </div> 

                         <div class="form-group">
                             <table class="table table-bordered dataTable" id="table_pembayaran">
                                <thead style="background-color: gray;">
                                    <tr>
                                        <th rowspan="2">item</th>
                                        <th rowspan="2">Deskripsi</th>
                                        <th id="cod_head" hidden>cod</th>
                                </thead>
                                <tbody>
                                    @foreach($item_tender as $key => $nilai)
                                    <tr>
                                        <td>{{$nilai->detail_pr->item_project->item->name}}</td>
                                        <td></td>
                                        <td class="cod_body" hidden=""><button type='button' class='button-cod btn btn-danger btn-xs'><i class='fa fa-list'></i> COD</button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                         </div> -->       
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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <form>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

@include("master/footer_table")
@include('pluggins.alertify')
@include('form.general_form')
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
      headers: {
        'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
      }
    });

    fnCliCkRekanan = function()
    {
       $(this).removeClass('btn-default').addClass('btn-primary');
    }
    var gentable = null;
    $(document).ready(function()
    {

        gentable = $('#table_comparison').DataTable({
          /*scrollY: "400px",
          scrollX:true,
          scrollCollapse: true,*/
          info:false,
          paging: false,
          searching:false,
          ordering:false,
         // fixedColumns: {leftColumns: 4},
          "footerCallback": function(row, data, start, end, display) {
                    var api = this.api();
                    api.columns('.sum', { page: 'current' }).every(function () {
                        var sum = api
                            .cells( null, this.index(), { page: 'current'} )
                            .render('display')
                            .reduce(function (a, b) {
                                var x = parseFloat(a) || 0;
                                var y = parseFloat(b) || 0;
                                return x + y;
                            }, 0);

                        $(this.footer()).html(sum);
                        fnSetAutoNumeric($(this.footer()));
                        fnSetMoney($(this.footer()),sum);
                    });
          },
          "initComplete": function(settings, json) {
            

            $('.sub_total').each(function(i,v)
            {
                var nilai = parseFloat($(this).autoNumeric('get'));
                var ppn_value = $('.sum').eq(i).attr('data-ppn');
                if(ppn_value == undefined)
                {
                  ppn_value = 0;
                }
                ppn_value = parseFloat(ppn_value/100*nilai);
                $('.ppn_value').eq(i).text(ppn_value);
                var grand_total = parseFloat(ppn_value+nilai);
                $('.grand_total').eq(i).text(grand_total);
            });

            fnSetAutoNumeric('.money');
            fnSetMoney('.money',$('.money').text());
          }
        });

        /*$('#btn_tunjuk_pemenang').click(function()
        {
            var obj = $(this);
            var _idtender = $('#id_tender').val();
            var _idrekanan = parseInt($(this).attr('data-value'));
            var _data = { idtender:_idtender,idrekanan:_idrekanan};
            var _url = "{{ url('/tenderpurchaserequest/tunjuk_pemenang') }}";

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
        });*/

        $('th:has(button)').click(function()
        {
            var trParent = $(this).parents('tr');
            trParent.find('button').removeClass('btn-primary').addClass('btn-default');
            $(this).find('button').removeClass('btn-default').addClass('btn-primary');
            var id_rekanan = parseInt($(this).find('input').val());
            $('#rekananid').val(id_rekanan);
            $('#btn_tunjuk_pemenang').removeAttr('disabled').removeClass('btn-default').addClass('btn-primary');
        });

        $('th:has(button)').dblclick(function()
        {
            $(this).find('button').removeClass('btn-primary').addClass('btn-default');
            $('#btn_tunjuk_pemenang').removeAttr('data-value').prop('disabled',true).removeClass('btn-primary').addClass('btn-default');
        });

        /*$('#btn_tunjuk_pemenang').click(function()
       {
          var obj = $(this);
          var _idrekanan = parseInt($(this).attr('data-value'));
          var _data = { idtender:parseInt($('#id_tender').val()),idrekanan:_idrekanan };
          var _url = "{{ url('/tenderpurchaserequest/request_approval_penawaran') }}";

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
       });*/
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


        $('#btn_approve').click(function()
        {
            alertify.confirm('Konfirmasi', 'Anda Yakin?', function(){ 
              alertify.success('Ok') 
            }
                , function(){ alertify.error('Batal')});
        });

        // $('#cara_bayar').change(function()
        //   {
        //     var txtBayar = $('#cara_bayar option:selected').text();
        //     $('#info_bayar').text('').text(txtBayar);
        //     if(txtBayar.toUpperCase() != 'COD')
        //     {
        //         $('#btn-cicil').show();
        //         $('#cod_head').hide();
        //         $('.cod_body').hide();
        //     }
        //     else
        //     {
        //         $('#btn-cicil').hide();
        //         $('#termin_cicil').val('[]');
        //         $('#cod_head').show();
        //         $('.cod_body').show();
        //     }

        // });

        $('.table_pembayaran').DataTable({
          scrollY: "500px",
          scrollX:true,
          scrollCollapse: true,
          paging: false,
          "columnDefs": [
            { "visible": false, "targets": 0 }
          ],
          "order": [[ 0, 'asc' ]],
        //   "drawCallback": function ( settings ) {
        //     var api = this.api();
        //     var rows = api.rows( {page:'current'} ).nodes();
        //     var last=null;
 
        //     api.column(0, {page:'current'} ).data().each( function ( group, i ) {
        //         if ( last !== group ) {
        //             $(rows).eq( i ).before(
        //                 '<tr class="group" style="background-color: #3FD5C0;""><td colspan="13"><strong>'+group+'</strong></td></tr>'
        //             );
 
        //             last = group;
        //         }
        //     } );
        // }
      });

       
        
    });
</script>
</body>
</html>
