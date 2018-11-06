@include('label_global')
@include('pluggins.alertify')
<div id="div_content_page">
  <div class="portlet-body">
  <div class="page-bar">
    <ul class="page-breadcrumb">
      <li>
        <a href="#">Inventory</a>
        <i class="fa fa-arrow-circle-right"></i>
      </li>
      <li>
        <a href="#">Laporan</a>
         <i class="fa fa-arrow-circle-right"></i>
      </li>
      <li>
        <a href="#">Pemakaian Barang langsung</a>
      </li>
    </ul>
    <div class="page-toolbar">
      <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
        <i class="icon-calendar"></i>&nbsp;
          <span class="thin uppercase hidden-xs"></span>&nbsp;
        <i class="fa fa-angle-down"></i>
      </div>
    </div>
  </div>
  <h3 class="page-title">
      {{ $projectname }}
    </h3>
</div>

<div class="panel panel-success">
  <div class="panel-heading"><strong>Daftar Pemakaian Barang Langsung</strong></div>
  <div class="panel-body">
   @include('form.refresh')

      <form class="form-inline">
      <div class="form-group">
        <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
        <div class="input-group">
          <div class="input-group-addon">Mulai</div>
          <input type="text" class="form-control" id="exampleInputAmount" placeholder="Amount">
          <div class="input-group-addon">Sampai</div>
          <input type="text" class="form-control" id="exampleInputAmount" placeholder="Amount">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Transfer cash</button>
    </form>
     <!-- <button class="btn btn-primary" type="button" id="btn_cetak"><i class="fa fa-print"></i> Cetak</button> -->
    <p/>
    <table class="table table-bordered display table_master" id="table_master">
      <thead>
        <tr>
          <th>Peruntukan</th>
          <th>Barang</th>
          <th>Sumber</th>
          <th>Tujuan</th>
          <th>Satuan</th>
          <th>Total</th>
          <th>Deskripsi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
</div>
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

    $('#barangkeluar').addClass('active');
    $('.panel-success').outerHeight();
    gentable = $('#table_master').DataTable({
          fixedHeader: {
            header:true,
            headerOffset: $('#navMenu').outerHeight()
          },
          scrollY:        "300px",
          scrollCollapse: true,
          paging:         false,
          "language": datatable_idUI,
          processing: true,
          ajax: "{{ url('/laporan/getdaftarbarangpemakaian') }}",
          columns:[

                 { data: 'peruntukan',name: 'peruntukan',"bSortable": false},
                 { data: 'nama_barang',name: 'nama_barang',"className":"text-left","bSortable": false},
                 { data: 'sumber',name: 'sumber',"className":"text-left","bSortable": false},   
                 { data: 'ditujukan',name: 'ditujukan',"className":"text-left","bSortable": false},                
                 { data: 'satuan',name: 'satuan',"className":"text-left","bSortable": false},                 
                 { data: 'total',name: 'total',"className":"text-right","bSortable": false},
                  { data: 'deskripsi',name: 'deskripsi',"className":"text-left","bSortable": false},
                 
                ],
          "columnDefs": [
        {targets:[0],visible:false}
        ],
      "order": [[0,'asc']],//,
          "drawCallback": function ( settings ) {
              var api = this.api();
              var rows = api.rows( {page:'current'} ).nodes();
              var last=null;
              api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                  if ( last !== group ) {
                      $(rows).eq( i ).before(
                          '<tr class="group success"><td colspan="6" style="text-align:left;padding:10px;"><strong>'+group+'</strong></td></tr>'
                      );
   
                      last = group;
                  }
              });
          },
          
    });

    var tBody = $('#table_master tbody');

    
    $('#btn_cetak').click(function()
    {
      window.location.href="{{url('/laporan/printMinpemakaian')}}";
    });



    $('#btn_refresh').click(function()
    {
        gentable.ajax.reload();
    });

  });
</script>


