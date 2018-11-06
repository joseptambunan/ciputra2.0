@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{ url('/') }}/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection
@section('content')
<!--ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="#">Home</a></li>
  <li role="presentation"><a href="#">Profile</a></li>
  <li role="presentation"><a href="#">Messages</a></li>
</ul-->

<div class="panel panel-success">
  <div class="panel-heading"><strong>Approval Permintaan Barang</strong></div>
  <div class="panel-body">
    <button class="btn btn-success" type="button" id="btn_refresh"><i class="fa fa-refresh"></i> Refresh</button>
    <p/>
    <table class="table table-bordered display table_master" id="table_master">
      <thead>
        <tr>
          <th>Permintaan Barang</th>
          <th>Item</th>
          <th>Tanggal Butuh</th>
          <th>Qty</th>
          <th>Stock On Hand</th>
          <th>Stock Avaible</th>
          <th>Satuan Permintaan</th>
          <th></th>
        </tr>
      </thead>
    </table>
  </div>
</div>
@endsection
@section('scripts')
<script src="{{ url('/')}}/assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ url('/')}}/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
</script>
<script type="text/javascript">
  var gentable = null;
  var notify = null;
  var datatable_idUI = {
    "sProcessing":   "Sedang memproses...",
    "sLengthMenu":   "Tampilkan _MENU_ entri",
    "sZeroRecords":  "[tidak ada data]",
    "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
    "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
    "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
    "sInfoPostFix":  "",
    "sSearch":       "Cari: ",
    "sUrl":          "",
    "oPaginate": {
        "sFirst":    "Pertama",
        "sPrevious": "Sebelumnya",
        "sNext":     "Selanjutnya",
        "sLast":     "Terakhir"
    }
}
  $(document).ready(function()
  {
    $('#permintaan').addClass('active');

    $('.panel-success').outerHeight();
    
    gentable = $('#table_master').DataTable({
          fixedHeader: {
            header:true,
            headerOffset: $('#navMenu').outerHeight()
          },
          "language": datatable_idUI,
          processing: true,
          ajax: "{{ url('/inventory/hod_inventory/getListApprovalPermintaanbarang') }}",
          columns:[

                 { data: 'no',name: 'no',"bSortable": true},
                 { data: 'item_name',name: 'item_name','className':'text-left',"bSortable": false},
                 
                 { data: 'butuh_date',name: 'butuh_date','className':'text-center',"bSortable": false},                 
                 { data: 'total_permintaan_afterkonversi',name: 'total_permintaan_afterkonversi',"className":"text-right","bSortable": true},
                 { data: 'stock_afterkonversi',name: 'stock_afterkonversi',"className":"text-right","bSortable": false},
                 { data: 'stock_avaible',name: 'stock_avaible',"className":"text-right","bSortable": false},
                 
                 { data: 'satuan_name',name: 'satuan_name',"className":"text-center","bSortable": false},
                 
                {
                  "className": "action text-center",
                  "data": null,
                  "bSortable": false,
                  "defaultContent": "" +
                  "<div class='' role='group'>" +
                  "<button class='details btn btn-success btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='right' title='Details'><i class='fa fa-list-alt'></i></button>"+
                  "</div>"
                }
          ],
          "columnDefs": [{ "visible": false, "targets": [0] }],
          "order": [[ 0, 'asc' ]],
          "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
              if ( last !== group ) {
                  $(rows).eq( i ).before(
                      '<tr class="group success" rowspan="2"><td colspan="6"><strong>'+group+'</strong></td><td><button class="approve btn btn-info" rel="tooltip" data-toggle="tooltip" data-placement="left" title="Approve"><i class="fa fa-check-square"></i></button> </td></tr>'
                  );

                  last = group;
              }
          });
            
        }
    });

    var tBody = $('#table_master tbody');

    tBody.on('click','.approve',function(){
        var data =  gentable.row($(this).parents('tr').next('tr')).data();
        console.log(data);
        var _datasend = {
          'id':data.permintaanbarang_id,
          'item_satuan_id':data.id_satuan_akhir,
          'item_id' : data.item_id,
          'stock_on_hand':data.stock_afterkonversi,
          'stock_avaible':data.stock_avaible,
          'quantity_butuh':data.total_permintaan_afterkonversi,
          'tanggal_butuh':data.butuh_date,
          _token:$('input[name=_token]').val()
        };
        
        var _url = "{{ url('/inventory/hod_inventory/approvePermintaanbarang') }}"

          $.ajax({
                type: 'POST',
                url: _url,
                data: _datasend,
                dataType: 'json',
                beforeSend:function(){
                  //code here
                  notify = new PNotify({text:'Sending Request ...'});
                },
                success:function(data){
                  if(data)
                  {
                      notify.update({
                             title: "Success",
                             text: "Approved "
                          });
                      gentable.ajax.reload();
                  }
                },
                error:function(xhr,status,errormessage)
                {
                      notify.update({
                             title: "Error",
                             text: "Terjadi Kesalahan "+xhr.statusText
                          });
                }
            });
    }).
    on('click','.details',function(){
        var data =  gentable.row($(this).parents('tr')).data();
        var permintaan_id = data.permintaanbarang_id;
        window.location.href="{{('/inventory/hod_inventory/detailsPermintaan')}}"+"/"+permintaan_id;
    });

    $('#btn_refresh').click(function()
    {
        gentable.ajax.reload();
    });

  });
</script>
@endsection