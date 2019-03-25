<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
  <style type="text/css">
    .table-align-right{
      text-align: right;
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
      <h1 style="text-align:center">Pengelompokan Purchase Request</h1>

    </section>
    <section class="content-header">
      <div class="" style="float: none">
        <button class="col-lg-1 col-md-2 col-sm-2 btn btn-primary" onclick="location.href='{{ url('/')}}/'" style="float: none; border-radius: 20px; padding-left: 0" disabled>
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
            <div class="box-header with-border" >
              <h3 class="box-title">
               
              </h3>
              <div class="box-tools pull-right">
                
              </div>         
            </div>
            <!-- /.box-header -->
            

            <div class="box-body">
               <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home"> List Belum Di Kelompokkan</a></li>
                <li><a data-toggle="tab" href="#menu1">List Telah Dikelompokkan</a></li>
               </ul>
              <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                   @if(strcmp($user->user_login,"administrator")==0)
                    <div class="box-header with-border" style="background-color:white">
                      <div class="col-md-4">
                        <button type="button" class="btn btn-block btn-primary btn-md" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/pengelompokanAdd'">
                          <i class="fa fa-fw fa-plus"></i> Tambah Kelompok PR </button>
                      </div>
                    </div>
                    @endif
                  <table id="ListBelumKelompok" class="table table-bordered table-striped dataTable display" role="grid" width="100%;">
                    <thead>
                      <tr style="background-color: greenyellow;">
                        <th>No PR</th>
                        <th>Departemen</th>
                        <th>Kategori</th>
                        <th>Kode Item</th>
                        <th>Item</th>
                        <th>Brand</th>
                        <th class="table-align-right">Quantity</th>
                        <th>Satuan</th>
                      </tr>
                      </thead>

                  </table>
                </div>
                <div id="menu1" class="tab-pane fade">
                  <input type="hidden" name="all_item_send" id="all_item_send" value="" />
                  @if(strcmp($user->user_login,"administrator")==0)
                    <div class="box-header with-border" style="background-color:white">
                      
                      <div class="col-md-3">
                        <button type="button" class="btn btn-block btn-primary btn-md" id="btn-req-approval" data-url="{{ url('/tenderpurchaserequest/request_apprval_tprg_from_index') }}">
                          <i class="fa fa-fw fa-send"></i> Request Approval</button>
                      </div>
                      <div class="col-md-3">
                        <button type="button" class="btn btn-block btn-warning btn-md" id="btn-undo-approval" data-url="{{ url('/tenderpurchaserequest/request_undo_tprg_from_index')}}">
                          <i class="fa fa-fw fa-reply"></i> Undo Approval</button>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="check_all_item" id="check_all_item" class="check_all_item" /> Check All
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endif
                    @if(strcmp($user->user_login,"approval1")==0)
                    <div class="box-header with-border" style="background-color:white">
                      
                      <div class="col-md-3">
                        <button type="button" class="btn btn-block btn-primary btn-md" id="btn-approve" data-url="{{ url('/tenderpurchaserequest/request_approve_tprg_from_index') }}">
                          <i class="fa fa-fw fa-send"></i>Approve</button>
                      </div>
                      <div class="col-md-3">
                        <button type="button" class="btn btn-block btn-warning btn-md" id="btn-undo-approve" data-url="{{ url('/tenderpurchaserequest/request_undoApprove_tprg_from_index')}}">
                          <i class="fa fa-fw fa-reply"></i> Undo Approve</button>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="check_all_item" id="check_all_item" class="check_all_item" /> Check All
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endif
                  <table id="ListTelahKelompok" class="table table-bordered table-striped dataTable display" role="grid" width="100%">
                      <thead style="background-color: greenyellow;">
                        <tr>
                          <th>No Group Tender</th>
                          <th>Kategori</th>
                          <th>Kode Item</th>
                          <th>Item</th>
                          <th>Brand</th>
                          <th class="table-align-right">Quantity</th>
                          <th>Satuan</th>
                          <th>Status</th>
                        </tr>
                        </thead>
                    </table>
                </div>
              </div>
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

  <div class="control-sidebar-bg"></div>
</div>

@include("master/footer_table")
@include('pluggins.alertify')
<script type="text/javascript">
   $.ajaxSetup({
    headers: {
      'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
    }
  });
   $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});
  var table_group = null;
  var arr_item_checked = [];
  $(function () {

   
    $('#ListBelumKelompok').DataTable(
      {
          scrollY: "800px",
          //scrollX:true,
          scrollCollapse: true,
          paging: false,
          processing: true,
          ajax: "{{ url('/tenderpurchaserequest/getPRBelumKelompok') }}",
          columns:[
                 { data: 'prNo',name: 'prNo',"bSortable": true},
                 {data: 'departmentName',name:'departmentName',"bSortable":true},
                 {data: 'categori',name:'categori',"bSortable":true},
                 {data: 'kodeitem',name:'kodeitem',"bSortable":true},
                 {data: 'itemName',name:'itemName',"bSortable":true},
                 {data: 'brandName',name:'brandName',"bSortable":true},
                 {data: 'quantity',name:'quantity','sClass':'text-right',"bSortable":true},
                 {data: 'satuanName',name:'satuanName',"bSortable":true}
          ],
          "columnDefs": [
            { "visible": false, "targets": [0] }
          ],
        "order": [[ 0, 'desc' ]],
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group" style="background-color: #3FD5C0;"><td colspan="7"><strong>'+group+'</strong></td></tr>'
                    );
 
                    last = group;
                }
            });
        },
        "initComplete": function(settings, json) {
          $('.group').nextUntil('.group').css( "display", "none" );
        },
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
      });

    var tbody = $('#ListBelumKelompok tbody');
      tbody.on('click','.group',function()
      {
        $(this).nextUntil('.group').toggle();

      }).find('.group').each(function(i,v){
        var rowCount = $(this).nextUntil('.group').length;
        $(this).find('td:first').append($('<span />', { 'class': 'rowCount-grid' }).append($('<b />', { 'text': ' (' + rowCount + ')' })));
      });

    var url_oe_detail ="{{ url('/tenderpurchaserequest/pengelompokanDetail') }}"+"?id=";
    var fnLabelStatus = function(data,type,row)
    {
      var retVal = "";
      if (type == 'display') {

        if(data=="approved")
        {
          retVal ="<strong style='color:green;'> APPROVED </strong>";
        }else if(data=="delivered")
        {
          retVal ="<strong style='color:yellow;'> DELIVERED </strong>";
        }else if(data=="partial approved")
        {
          retVal ="<strong style='color:#40E0D0;'> PARTIAL APPROVED </strong>";
        }else if(data=="open")
        {
          retVal ="<strong style='color:black;'> OPEN</strong>";
        }else if(data=="rejected")
        {
          retVal ="<strong style='color:red;'> REJECTED </strong>";
        }
      }
      return retVal;

    }
    table_group = $('#ListTelahKelompok').DataTable({
          scrollY: "800px",
          //scrollX:true,
          scrollCollapse: true,
          paging: false,
          ajax: "{{ url('/tenderpurchaserequest/getPRSudahKelompok') }}",
          columns:[
                 { data: 'no',name: 'no',"bSortable": true},
                 {data: 'category',name:'category',"bSortable":true},
                 {data: 'kode_barang',name:'kode_barang',"bSortable":true},
                 {data: 'item_name',name:'item_name',"bSortable":true},
                 {data: 'brand',name:'brand',"bSortable":true},
                 {data: 'qty',name:'qty','sClass':'text-right',"bSortable":true},
                 {data: 'satuan',name:'satuan',"bSortable":true},
                 {data: 'status',name:'status',render:fnLabelStatus,"bSortable":true}
          ],
          "columnDefs": [
            { "visible": false, "targets": 0 }
          ],
        "order": [[ 0, 'desc' ]],
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    
                    $(rows).eq( i ).before('<tr class="group" style="background-color: #3FD5C0;"><td colspan="10"><strong><div class="checkbox check_item"><label><input type="checkbox" name="check_item" id="check_item" class="check_item" value="'+group+'" />'+group+"   "+'</strong></label></div><a href="'+url_oe_detail+group+'" class="btn btn-primary btn-xs pull-right" rel="tooltip" data-toggle="tooltip" data-placement="left" title="Details"><i class="fa fa-list"></i></a>&nbsp;</td></tr>');

                    last = group;
                }
            });
        },
        "initComplete": function(settings, json) {
          $('.group').nextUntil('.group').css( "display", "none" );
        }
    });



    var sBody = $('#ListTelahKelompok tbody');
      sBody.on('click','.group',function()
      {
        $(this).nextUntil('.group').toggle();

      }).find('.group').each(function(i,v){
        var rowCount = $(this).nextUntil('.group').length;
        $(this).find('td:first').append($('<span />', { 'class': 'rowCount-grid' }).append($('<b />', { 'text': ' (' + rowCount + ')' })));
      });

    $(document).on('click','.check_all_item',function()
    {
        if($(this).is(':checked'))
        {
          sBody.find('.check_item').prop('checked',true);
          sBody.find('input.check_item').each(function(i,v)
          {
              arr_item_checked.push($(this).val());
          });
        }
        else
        {
          sBody.find('.check_item').prop('checked',false);
          arr_item_checked = [];
        }

        $('#all_item_send').val(JSON.stringify(arr_item_checked));
        
    });

    sBody.on('click','input.check_item',function()
    {
        var nilai_item = $(this).val();
        if($(this).is(':checked'))
        {

            if(arr_item_checked.length > 0)
            {
              if(arr_item_checked.includes(nilai_item) == false)
              {
                arr_item_checked.push(nilai_item);
              }
            }
            else
            {
              arr_item_checked.push(nilai_item);
            }
            console.log('check item dengan nilai '+nilai_item);
        }else
        {

          if(arr_item_checked.includes(nilai_item) == true)
          {
              var index = arr_item_checked.indexOf(nilai_item);
              arr_item_checked.splice(index,1);

              console.log('uncheck item dengan nilai'+nilai_item);
          }
        }

        $('#all_item_send').val(JSON.stringify(arr_item_checked));
    });

    $('#btn-req-approval').click(function()
    {

          var _data_sendApproval = {id : $('#all_item_send').val()};
          $.ajax({
              type: 'POST',
              url: $(this).attr('data-url'),
              data: _data_sendApproval,
              dataType: 'json',
              beforeSend:function(){
                waitingDialog.show();
              },
              success:function(data){
                if(data)
                {
                    alertify.success('success!',4);
                    table_group.ajax.reload();
                }
                else
                {
                  alertify.error('Gagal, Periksa Kembali Data Anda');
                }
              },
              error:function(xhr,status,errormessage)
              {
              },
              complete:function()
              {arr_item_checked = [];$('.check_item,.check_all_item').prop('checked',false);waitingDialog.hide();}
            });
    });

    $('#btn-undo-approval').click(function()
    {
        var _data_sendUndo = {id : $('#all_item_send').val()};
        $.ajax({
              type: 'POST',
              url: $(this).attr('data-url'),
              data: _data_sendUndo,
              dataType: 'json',
              beforeSend:function(){
                waitingDialog.show();
              },
              success:function(data){
                if(data)
                {
                    alertify.success('success !',4);
                    table_group.ajax.reload();
                }
                else
                {
                  alertify.error('Gagal, Periksa Kembali Data Anda');
                }
              },
              error:function(xhr,status,errormessage)
              {
              },
              complete:function()
              {arr_item_checked = [];$('.check_item,.check_all_item').prop('checked',false);waitingDialog.hide();}
            });
    });

    $('#btn-approve').click(function()
    {

          var _data_sendApproval = {id : $('#all_item_send').val()};
          $.ajax({
              type: 'POST',
              url: $(this).attr('data-url'),
              data: _data_sendApproval,
              dataType: 'json',
              beforeSend:function(){
                waitingDialog.show();
              },
              success:function(data){
                if(data)
                {
                    alertify.success('success!',4);
                    table_group.ajax.reload();
                }
                else
                {
                  alertify.error('Gagal, Periksa Kembali Data Anda');
                }
              },
              error:function(xhr,status,errormessage)
              {
              },
              complete:function()
              {arr_item_checked = [];$('.check_item,.check_all_item').prop('checked',false);waitingDialog.hide();}
            });
    });

    $('#btn-undo-approve').click(function()
    {
        var _data_sendUndo = {id : $('#all_item_send').val()};
        $.ajax({
              type: 'POST',
              url: $(this).attr('data-url'),
              data: _data_sendUndo,
              dataType: 'json',
              beforeSend:function(){
                waitingDialog.show();
              },
              success:function(data){
                if(data)
                {
                    alertify.success('success !',4);
                    table_group.ajax.reload();
                }
                else
                {
                  alertify.error('Gagal, Periksa Kembali Data Anda');
                }
              },
              error:function(xhr,status,errormessage)
              {
              },
              complete:function()
              {arr_item_checked = [];$('.check_item,.check_all_item').prop('checked',false);waitingDialog.hide();}
            });

    });

   
  });
</script>
</body>
</html>