@include('label_global')
@include('pluggins.alertify')
@include('form.general_form')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" />
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
          <a href="#">Daftar Penyusutan</a>
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
      @include('form.refresh')
    </h3>
</div>
    <div class="panel panel-success">
      <div class="panel-heading"><strong>Daftar Penyusutan Aktiva Tetap</strong></div>
      <div class="panel-body">
       <a href="{{ url('/asset/printReport') }}" class="btn btn-primary" ><i class="fa fa-print"></i></a>
        <p/>
        <table class="table table-bordered display table_master" id="table_master">
          <thead>
            <tr>
              <th>Barang</th>
              <th>Tanggal Perolehan</th>
              <th>Umur Ekonomis (Tahun)</th>
              <th>Nilai Ekonomis (Rp.)</th>
              <th>Nilai Perolehan(Rp.)</th>
              <th>Penyusutan (Rp.)</th>
              <th>Nilai Buku (Rp.)</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>

</div>

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
  var totalEkonomis = 0;

  $(document).ready(function()
  {

    gentable = $('#table_master').DataTable({
          "language": datatable_idUI,
        
          paging:false,
          processing: true,
          ajax: "{{ url('/asset/getPenyusutanAsset') }}",
          columns:[
                 { data: 'item_name',name: 'item_name',"className":"text-left","bSortable": false}, 
                 { data: 'tangal_perolehan',name: 'tangal_perolehan',"className":"text-left","bSortable": false },
                 { data: 'umur_asset',name: 'umur_asset',"className":"text-right","bSortable": false },              
                 { data: 'nilai_perkiraan_sisa',name: 'nilai_perkiraan_sisa',"className":"nie text-right","bSortable": false},                 
                 { data: 'nilai_perolehan',name: 'nilai_perolehan',"className":"nip text-right","bSortable": false},
                 { data: 'nilai_penyusutan',name: 'nilai_penyusutan',"className":"nipu text-right","bSortable": false},
                 { data: 'nilai_buku',name: 'nilai_buku',"className":"nibu text-right","bSortable": false}
          ],
          "columnDefs": [{ "visible": false, "targets": [0] }],
          "order": [[ 0, 'asc' ]],
          "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
            
            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
              //console.log(api.row(i).data().item_name);
              var lastval;
              if(group == api.row(i).data().item_name){
                  totalEkonomis+=parseFloat(api.row(i).data().nilai_perkiraan_sisa);
                  lastval = totalEkonomis;
                }
                else
                {
                  totalEkonomis = 0;
                  lastval = totalEkonomis;
                }
              if ( last !== group ) {

                  $(rows).eq( i ).before(
                      '<tr class="group success" rowspan="2"><td colspan="9" style="text-align:left;"><strong>'+group+'</strong></td></tr>'
                  );

                  last = group;
              }
          });
            
        },

        "initComplete":function(settings,json)
        {
            /*var api = this.api();
            var obj = $('.success').each(function(v,i){
              api.row(i).data().nilai_perkiraan_sisa;
            });*/
        },
        customize: function(doc){
            styles: {
                tableHeader:{
                    fillColor:"#F0F8FF"
                }
            }
          }
          
    });

    var tBody = $('#table_master tbody');

    $('#btn_refresh').click(function()
    {
        gentable.ajax.reload();
    });

    gentable.on('draw',function()
    {
      $('.nie').each(function()
      {
          fnSetAutoNumeric($(this));
      });

       $('.nip').each(function()
      {
          fnSetAutoNumeric($(this));
      });

        $('.nipu').each(function()
      {
          fnSetAutoNumeric($(this));
      });

         $('.nibu').each(function()
      {
          fnSetAutoNumeric($(this));
      });
    });



  });
</script>


