<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
      <h1 style="text-align:center">Data Penawaran Tender {{ $project->name }}</h1>
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
      
      
        <div class="row">
        <div class="col-md-12">
         
          <div class="box box-primary">
            <!-- /.box-header -->
              <div class="box-header with-border" style="background-color:white">
                <div class="col-md-4">
                  <button type="button" class="btn btn-block btn-primary btn-lg" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/add-nilai-penawaran'">
                  <i class="fa fa-fw fa-plus"></i>
                  &nbsp;&nbsp;
                  Tambah Penawaran
                  </button>
                </div>
              </div>
              <div class="box-body">
                <table id="ListSiapKelompok" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                    <thead>
                      <tr style="background-color: greenyellow;">
                        <th>No Tender</th>
                        <th>Penawaran</th>
                        <th></th>
                      </tr>
                      </thead>
                      
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
@include('form.general_form')
<script type="text/javascript">
  var gentable = null;
  var fnLabel = function(data,type,row)
    {
      var retVal = "";
      if (type == 'display') {

          retVal ="<strong'> Penawaran "+data+" </strong>";
        
      }
      return retVal;
    }
  $(document).ready(function()
  {
      gentable = $('#ListSiapKelompok').DataTable(
      {
            scrollY:"300px",
            scrollCollapse: true,
            paging:false,
            processing: true,
            ajax: "{{ url('/tenderpurchaserequest/getDataPenawaran') }}",
            columns:[
                    { data: 'no_tender',name: 'no_tender',"bSortable": true},
                    { data: 'penawaran',name: 'penawaran',render:fnLabel,"bSortable": false},
                    { "className": "action text-center",
                      "data": null,
                      "bSortable": false,
                      "defaultContent": "" +
                      "<div class='' role='group'>" +
                      "<button type='button' class='btn btn-success btn-xs detail' rel='tooltip' data-toggle='tooltip' data-placement='left' title='Detail'><i class='fa fa-list'></i></button>" +
                      "</div>"}
            ],
            "columnDefs": [{ "visible": false, "targets": 0 }],
            "order": [[ 0, 'asc' ]],
            "drawCallback": function ( settings ) {
                  var api = this.api();
                  var rows = api.rows( {page:'current'} ).nodes();
                  var last=null;
       
                  api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                      if ( last !== group ) {
                          $(rows).eq( i ).before(
                              '<tr style="background-color: #3FD5C0;" class="group"><td colspan="2"><strong>No Tender : '+group+'</strong></td></tr>'
                          );

                          last = group;
                      }
                  } );
              },
              "initComplete": function(settings, json) {
                $('.group').nextUntil('.group').css( "display", "none" );
              }
      });

      var tbody = $('#ListSiapKelompok tbody');
      tbody.on('click','.group',function()
      {
        $(this).nextUntil('.group').toggle();

      }).find('.group').each(function(i,v){
        var rowCount = $(this).nextUntil('.group').length;
        $(this).find('td:first').append($('<span />', { 'class': 'rowCount-grid' }).append($('<b />', { 'text': ' (' + rowCount + ')' })));
      });
      
      // tbody.on('click','.detail',function()
      // {
      //     var data_no_tender = $(this).attr('data-value');
      //     window.location.href="{{ url('/tenderpurchaserequest/detailTender') }}"+"?id="+data_no_tender;
      //     //window.location.href="{{ url('/tenderpurchaserequest/detailFasePenawaran') }}"+"/"+data.id;
      // });

      tbody.on('click','.detail',function()
      {
          var trparent = $(this).parents('tr');
          var data = gentable.row(trparent).data();
          window.location.href="{{ url('/tenderpurchaserequest/detailTender') }}"+"?id="+data.no_tender+"&penawaran="+data.penawaran;
      });

      gentable.on('draw',function()
      {
        tbody.find('.money').each(function()
        {
            fnSetAutoNumeric($(this));
            fnSetMoney($(this),$(this).text());
        });
      })
  });
</script>
</body>
</html>
