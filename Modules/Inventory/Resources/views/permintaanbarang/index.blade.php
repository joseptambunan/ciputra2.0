<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
                      <a href="{{ url('/inventory/inventory/stock/view_stock') }}">Inventory</a>
                  </li>
                  <li>
                      <span>Permintaan Barang</span>
                  </li>
              </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
                <strong>Data Permintaan Barang</strong>
                @include('form.a',
                [
                  'href' => url('/inventory/permintaan_barang/add_form'),
                  'class'=>'pull-right',
                  'caption' => 'Tambah'
                ])
                
                <hr/>
                 
                  <form id="frmprint" method="post" name="formprint" action="{{ url('/inventory/permintaan_barang/print') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="permintaan_barang_id" id="permintaan_barang_id" value="0" />
                  </form>


                  <table class="table table-striped table-bordered table-hover table-responsive table-checkable nowrap stripe row-border order-column table_master" id="table_data">
                    
                    <thead style="background-color: #3FD5C0;">
                      <tr>
                        <th>#</th>
                        <th>No</th>
                        <th>Departemen</th>
                        <th>Status</th>
                        <th>Barang Keluar</th>
                        <th>Detail</th>
                        <th>Persetujuan</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    
                      @foreach($permintaans as $key => $each)
                      <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $each->no }}</td>

                        <td>{{ $each->department->name or 'not found' }}</td>

                        <td>
                          {{ is_null($each->StatusPermintaan) ? '-' :  $each->StatusPermintaan->name}}
                        </td>

                        <td align="center">
                          
                          <?php
                            $totalqty_permintaanbarang = is_null($each->details) ? 0 : $each->details->sum('quantity');
                            $totalqty_barangkeluar =0;
                            if($totalqty_permintaanbarang <= 0)
                            {
                              $totalqty_barangkeluar =1;
                            }
                            
                            $arr_issent = [];
                            $list_is_sent = [];
                            if(!is_null($each->details))
                            {
                              foreach ($each->details as $key => $value) {
                              # code...
                                if(!is_null($value->barangkeluar_detail))
                                {
                                  $totalqty_barangkeluar += $value->barangkeluar_detail->sum('quantity');
                                  

                                  foreach ($value->barangkeluar_detail as $key => $bkd) {
                                    # code...
                                    if(!$bkd->is_sent)
                                    {
                                      array_push($arr_issent, $value->id);
                                    }
                                  }
                                }
                                if(in_array($value->id, $arr_issent))
                                {
                                  array_push($list_is_sent,true);
                                }else
                                {
                                  array_push($list_is_sent,false);
                                }
                              }

                              $selisih = $totalqty_permintaanbarang - $totalqty_barangkeluar;
                              if($selisih == 0)
                              {
                                  if(in_array(false, $list_is_sent))
                                  {
                                    ?>
                                    @include('form.a_color',
                                    [
                                      'href' => url('/inventory/barang_keluar/index').'?id='.$each->id,
                                      'caption' => $each->barangkeluars->count().' BK',
                                      'class' => 'btn-warning btn-xs'
                                    ])
                                    <?php
                                    //$arr_issent = [];
                                  }
                                  else
                                  {
                                    ?>
                                    @include('form.a_color',
                                    [
                                      'href' => url('/inventory/barang_keluar/index').'?id='.$each->id,
                                      'caption' => $each->barangkeluars->count().' BK',
                                      'class' => 'btn-primary btn-xs'
                                    ])
                                    <?php
                                  }
                                }
                                else
                                {
                                
                                  ?>
                                  @include('form.a_color',
                                  [
                                    'href' => url('/inventory/barang_keluar/index').'?id='.$each->id,
                                    'caption' => $each->barangkeluars->count().' BK',
                                    'class' => 'btn-danger btn-xs'
                                  ])
                                  <?php
                                  
                                }
                            }
                            else
                            {
                              print "-";
                            }
                            
                          ?>
                          
                        </td>

                        <td align="center">
                          @include('form.a',
                              [
                                'href' => url('/inventory/permintaan_barang_detail/index').'?id='.$each->id,
                                'caption' => $each->details->count().' Detail',
                                'class' => 'btn-primary btn-xs'
                              ])
                        </td>
                        
                        <td align="center">
                          @if($each->details->count() > 0)
                            @if( $each->confirm_by_requester != 1 )
                              <button class="btn btn-info btn-xs btn-approve" data-value="{{ $each->id }}" type="button"><i class="fa fa-check"> Approve</i></button>
                            @else
                              <button class="btn btn-success btn-xs" type="button"><i class="fa fa-check"> Approved</i></button>
                            @endif
                          @else
                            -
                          @endif
                        </td>
                        <td align="center">
                          <button id="{{ $each->id }}" href="#" class="btn btn-primary btn-xs edit-link"> 
                            <i class="fa fa-edit"></i>
                          </button>
                         
                          <button id="{{ $each->id }}" href="#" class="btn btn-danger btn-xs delete-link"> 
                            <i class="fa fa-trash-o"></i>
                          </button>
                          <button class="btn btn-primary btn-xs btn-print" data-value="{{ $each->id }}" type="button"><i class="fa fa-print"></i></button>
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
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
  $('#table_data').DataTable(
    {
      scrollY: "300px",
      //scrollX:true,
      scrollCollapse: true,
      paging: false,
      /*    fixedColumns:   {
              leftColumns: 2
          },*/
          "order": [[ 0, 'asc' ]]
    });

  $(".delete-link").click(function() {
    var id = $(this).attr("id");
    var del_id = id;
    var parent = $(this).parent("td").parent("tr");
    var token = $('input[name=_token]').val();
    $.confirm({
      title: 'Confirm Delete ?',
      icon: 'fa fa-warning',
      content: 'Are you sure delete Key ID ' +del_id+ ' !',
      autoClose: 'cancelAction|8000',
      buttons: {
        deleteUser: {
          text: 'Delete',
          btnClass: 'btn-red any-other-class',
          action: function () {
            $.post("{{ url('/inventory/permintaan_barang/delete') }}", 
            {
              id:del_id,
              _token: token
            }, 
            function(data) {
              parent.fadeToggle('fast');
              alertify.success('success delete');
            });
            
            
          }
        },
        cancelAction: function () {
          
        }
      }
    });
    return false;
  });

  var sBody = $('#table_data tbody');

  sBody.on('click','.btn-print',function(){
    var id_permintaan = $(this).attr('data-value');
    $('#permintaan_barang_id').val(id_permintaan);
    $('#frmprint').submit();
  }).
  on('click','.btn-approve',function()
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
              objButton.removeClass('btn-info btn-approve').addClass('btn-success').text('').append('<i class="fa fa-check"></i>').text('Approved');
            }
          },
      });

  }).on('click','.edit-link',function()
  {
      var id = $(this).attr('id');
      var url = "{{ url('/inventory/permintaan_barang/edit_form') }}";
      window.location.href = url+'?id='+id;
  });

});
</script>
</body>
</html>
