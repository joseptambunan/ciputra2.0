@extends('layouts.master')
@section('css')
<link href="{{ URL::asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/global/plugins/datatables/fixedHeader.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<div class="panel panel-success">
  <div class="panel-heading"><strong>Daftar Barang Keluar</strong></div>
  <div class="panel-body">
    <button class="btn btn-success" type="button" id="btn_refresh"><i class="fa fa-refresh"></i> Refresh</button>
    <p/>
    <table class="table table-bordered display table_master" id="table_data">
    <thead>
      <tr>
        <th>#</th>
        <th>Nomor</th>
        <th>Item</th>
        <th>Qty Pinjam</th>
        <th >Qty Kembali</th>
        <th>Satuan</th>
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
<script src="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" 
type="text/javascript">
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
    $('#pengembalianbarang').addClass('active');
    $('.panel-success').outerHeight();
    gentable = $('#table_data').DataTable(
    {
      //scrollY:        "300px",
        //scrollX:        true,
        //scrollCollapse: true,
        //paging:         false,
          processing: true,
          ajax: "{{ url('/inventory/hod_inventory/getDaftarPengembalianbarang') }}",
          columns:[
                 { data: 'nomor',name: 'nomor',"bSortable": false},
                 { data: 'no',name: 'no',"bSortable": false},
                { data: 'item_name',name: 'item_name',"bSortable": false},
                 { data: 'qty_pinjam',name: 'qty_pinjam','sClass': 'text-right',"bSortable": false},
                 { data: 'qty_kembali',name: 'qty_kembali','sClass': 'text-right',"bSortable": false},
                { data: 'item_satuan',name: 'item_satuan','sClass': 'text-right',"bSortable": false},
                {
                  "className": "action text-center",
                  "data": null,
                  "bSortable": false,
                  "defaultContent": "" +
                  "<div class='' role='group'>" +
                  /*"<button type='button' class='btn btn-success btn-xs detail' rel='tooltip' data-toggle='tooltip' data-placement='right' title='Detail'><i class='fa fa-list'></i></button>" +
                  "<span class=\"sr-only\">Action</span>" +*/
                  "</div>"
            }
          ],
          "columnDefs": [{ "visible": false, "targets": 1 }],
          "order": [[ 0, 'asc' ]],
          "drawCallback": function ( settings ) {
                var api = this.api();
                var rows = api.rows( {page:'current'} ).nodes();
                var last=null;
     
                api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                    if ( last !== group ) {
                        $(rows).eq( i ).before(
                            "<tr class='group success'>"+
                            "<td colspan='5' style='text-align:left;padding:10px;'><strong> Nomor Refrensi : "+group+"</strong></td>"+
                            "<td class='text-right'>"+
                            "</td></tr>");
                            last = group;
                    }
                } );
            }
        });

    var sbody = $('#table_data tbody');

      sbody.on('click','.detail',function()
      {
          var data = gentable.row($(this).closest('tr').next('tr')).data();
          $('#div_content').load("{{ url('/inventory/pengembalian_barang/details/')}}/"+data.barangkeluar_id);
      }).on('click','.approve',function()
      {
          var data = gentable.row($(this).closest('tr').next('tr')).data();
          var _datasend ={'id':data.id,_token:$('input[name=_token]').val()};
          var _url = "{!! url('/inventory/hod_inventory/approve_pengembalianbarang') !!}"
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
                if(data.return)
                {
                  notify.update({
                     title: "Success",
                     text: "Approved "
                  });
                  gentable.ajax.reload();
                }
                else
                {
                  notify.update({
                 title: "Error",
                 text: "Terjadi Kesalahan"
              });
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
        //tooltip
      $('body').tooltip({
        selector: '[rel=tooltip]'
      });

    $('#btn_refresh').click(function()
    {
        gentable.ajax.reload();
    });

  });
</script>

@endsection
