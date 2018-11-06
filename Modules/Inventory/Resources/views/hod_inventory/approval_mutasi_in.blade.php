@extends('layouts.master')
@section('css')
<link href="{{ URL::asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/global/plugins/datatables/fixedHeader.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="panel panel-success">
  <div class="panel-heading"><strong>Approval Mutasi IN</strong></div>
  <div class="panel-body">
    
    <!--button class="btn btn-success" type="button" id="btn_refresh"><i class="fa fa-refresh"></i> Refresh</button-->
    <p/>
    {{ csrf_field() }}
    <table class="table table-bordered display table_master" id="table_data">
      <thead>
        <tr>
          <th class="text-center">Perolehan</th>
          <th class="text-center">Sumber</th>
          <th class="text-center">Pemberi</th>
          <th class="text-center">Penerima</th>
          <th class="text-center">Item</th>
          <th class="text-center">Qty</th>
          <th class="text-center">Satuan</th>
          <th class="text-center">Tanggal</th>
          <th></th>
        </tr>
      </thead>
    </table>
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ URL::asset('assets/global/plugins/datatables/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/global/plugins/datatables/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
<script type="text/javascript">
  var genTable = null;
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

    $('#mutasiin').addClass('active');
    $('.panel-success').outerHeight();

    genTable = $('#table_data').DataTable(
      {
         fixedHeader: {
            header:true,
            headerOffset: $('#navMenu').outerHeight()
          },
          "language": datatable_idUI,
          processing: true,
              ajax: "{{ url('/inventory/hod_inventory/getApprovalMutasiIn') }}",
              columns:[
                  { data: 'is_from',name: 'is_from',"className":"text-center","bSortable": true},
                  { data: 'source',name: 'source',"className":"text-center","bSortable": false},
                  { data: 'giver',name: 'giver',"className":"text-center","bSortable": false},
                  { data: 'recipient',name: 'recipient',"className":"text-center","bSortable": false},
                  { data: 'item_name',name: 'item_name',"className":"text-center","bSortable": false},
                  { data: 'qty',name: 'qty',"className":"text-right","bSortable": false},
                  { data: 'satuan',name: 'satuan',"className":"text-center","bSortable": false},
                  {data:'date',name:'date',"className":"text-center","bSortable": false},
                 {
                    "className": "action text-center",
                      "data": null,
                      "bSortable": false,
                      "defaultContent": "" +
                      "<div class='' role='group'>" +
                      "<button class='approve btn btn-info btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='left' title='Setujui'><i class='fa fa-check-square'></i></button> "+
                      "<button class='details btn btn-success btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='right' title='Details'><i class='fa fa-list-alt'></i></button>"+

                      "</div>"
                    }
              ],
               "columnDefs": [{targets:[0],visible:false}],
               "order": [[0,'asc']],
              "drawCallback": function ( settings ) {
                  var api = this.api();
                  var rows = api.rows( {page:'current'} ).nodes();
                  var last=null;
                  api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                      if ( last !== group ) {
                          $(rows).eq( i ).before(
                              '<tr class="group success"><td colspan="9" style="text-align:left;padding:10px;"><strong>'+group+'</strong></td></tr>'
                          );
       
                          last = group;
                      }
                  });
              }
      });

    var tBody = $('#table_data tbody');

    tBody.on('click','.approve',function(){
      var data =  genTable.row($(this).parents('tr')).data();       
        
        var id = data.id;
        var _datasend = {'id':id,_token:$('input[name=_token]').val()};
        var _url = "{{ url('/inventory/hod_inventory/approveMutasiIn') }}"

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
                      genTable.ajax.reload();
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
    });

    $('#btn_refresh').click(function()
    {
        genTable.ajax.reload();
    });

  });
</script>
@endsection