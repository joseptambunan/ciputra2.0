  <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard </title>
  @include("master/header")
  
    <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('/')}}/assets/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="{{ url('/')}}/assets/selectize/selectize.bootstrap3.css">

    <style>
        .panel-info>.panel-heading {
    color: white;
    background-color: #367fa9;
    border-color: #3c8dbc;
}
        .panel-info {
    border-color: #3c8dbc;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice{
    background-color: #3c8dbc;
    border-color: #367fa9; q
}
.select2-container .select2-search--inline .select2-search__field{
      padding-left: 12px;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__rendered li{
      width: 100%
    }

    .dataTables_scroll
    {
        overflow:auto;
    }
    </style>

    <style>
      * {
        box-sizing: border-box;
      }

      body {
        background-color: #f1f1f1;
      }

      h1 {
        text-align: center;  
      }
      /* Mark input boxes that gets an error on validation: */
      input.invalid,select.invalid,textarea.invalid{
        background-color: #ffdddd;
      }

      /* Hide all steps by default: */
      button:hover {
        opacity: 0.8;
      }

      #prevBtn {
        background-color: #bbbbbb;
      }

      /* Make circles that indicate the steps of the form: */
      .step {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbbbbb;
        border: none;  
        border-radius: 50%;
        display: inline-block;
        opacity: 0.5;
      }

      .step.active {
        opacity: 1;
      }

      /* Mark the steps that are finished and valid: */
      .step.finish {
        background-color: #4CAF50;
      }
      input[type=select-multiple]{
        width:33.3%;
      }

    .optionItem{
      width:24.5%;
    }
    .item{
      color: black;
      background-color: beige;
    }
    select{
      background-color: white;
    }
    </style>
</head>
<body id="body" class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  @include("master/sidebar_project")
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Tambah Pengelompokan PR {{ $project->name }}</h1>
    </section>
    <section class="content-header">
      <div class="" style="float: none">
        <button class="col-lg-1 col-md-2 col-sm-2 btn btn-primary" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/pengelompokan'" style="float: none; border-radius: 20px; padding-left: 0">
        <i class="fa fa-fw fa-arrow-left"></i>&nbsp;&nbsp;Back
        </button>
        <button class="col-lg-1 col-md-2 col-sm-2 btn btn-primary" onclick="window.location.reload()" style="float: right; border-radius: 20px; padding-left: 0;">
          <i class="fa fa-fw fa-refresh"></i>&nbsp;&nbsp;Refresh
        </button>  
      </div>
    </section>
    <section class="content">
      <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">

              <form class="form-horizontal" method="post" action="{{ url('/')}}/tenderpurchaserequest/add-pengelompokan">
                @csrf
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">PO Lampirkan</label>
                  <div class="col-sm-5">
                    <div class="input-group">
                      <input type="hidden" name="id_po_lampiran" id="id_po_lampiran" />
                      <input type="text" class="form-control" id="no_po_lampiran" name="no_po_lampiran" readonly="true" />
                      <div class="input-group-addon"><button type="button" id="btn-lampiran" data-toggle="modal" data-target="#myModal"><span class="fa fa-plus"></span></button></div>
                    </div>
                    
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Deskripsi</label>
                  <div class="col-sm-8">
                    <textarea class="form-control" name="description" id="description" required></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <input type="hidden" name="all_send" id="all_send" />
                    <button type="submit" class="btn btn-primary col-md-5"><i class="fa fa-send"></i> OK</button>
                  </div>
                </div>
              
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" class="check_all" id="check_all"> Check Semua
                      </label>
                    </div>
                  </div>
                </div>
                
              </form>

              
              <table id="table_details" class="table table-bordered table-striped dataTable" role="grid" >
                <thead style="background-color: greenyellow;">
                  <tr>
                    <th>category_name</th>
                    <th>No PR</th>
                    <th>Pilih</th>
                    <th>Item</th>
                    <th>Brand</th>
                    <th class="table-align-right">Quantity</th>
                    <th>Satuan</th> 
                    <th>Rekanan 1</th>
                    <th>Rekanan 2</th>
                    <th>Rekanan 3</th>
                  </tr>
                  </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
     <!--  <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <table id="table_summary" class="table table-striped dataTable" >
                <thead style="background-color: greenyellow;">
                  <tr>
                    <th>#</th>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Satuan</th>
                    <th></th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div> -->
    </section>
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>
  <div class="control-sidebar-bg"></div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">DATA PO YANG AKAN DI LAMPIRKAN</h4>
      </div>
      <div class="modal-body">
        <table id="table_lampiran_po" class="table table-bordered table-striped dataTable display" role="grid" width="100%">
                <thead style="background-color: greenyellow;">
                  <tr>
                    <th>Rekanan</th>
                    <th>No PO</th>
                    <th>Pilih</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($po_s as $key => $value)
                      <tr>
                        <td>{{ $value->vendor->name }}</td>
                        <td>{{ $value->no }}</td>
                        <td><div class="checkbox"><label><input type="checkbox" name="id_po" id="id_po"> Pilih</label></div></td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

@include("master/footer_table")
@include("form.general_form")
@include("pluggins.alertify")
<script type="text/javascript">

  var _render = function (data, type, row) {
        if (type == 'display') {
          return "<button type='button' class='button-delete btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></button>";
        }
        return data;
      };

  var table_group = null;
  var table_not_group = null;
  var table_lampiran = null;
  var arr_send = [];
  $(document).ready(function()
  {
      table_not_group = $('#table_details').DataTable({
          "processing": true,
          "serverSide": true,
          "ajax": "{{ url('/tenderpurchaserequest/itemSiapKelompok') }}",
          "columns":[
                      { data: 'category_name',name: 'category_name',"bSortable": true},
                      { data: 'prNo',name: 'prNo',"bSortable": false},
                      {
                      "className": "action text-center",
                      "data": null,
                      "bSortable": false,
                      "defaultContent": "" +
                      '<div class="checkbox">'+
                      '<label><input type="checkbox" class="add_item"> Check </label>'+
                      '</div>'},
                      { data: 'itemName',name: 'itemName',"bSortable": false},
                      { data: 'brandName',name: 'brandName',"bSortable": false},
                      { data: 'quantity',name:'quantity','sClass':'text-right',"bSortable": false},
                      { data: 'satuanName',name:'satuanName',"bSortable": false},
                      { data: 'rekanan1',name:'rekanan1',"bSortable": false},
                      { data: 'rekanan2',name:'rekanan2',"bSortable": false},
                      { data: 'rekanan3',name:'rekanan3',"bSortable": false}
                    ],
          scrollY: "600px",
          //scrollX:true,
          scrollCollapse: true,
          paging: false,
          "columnDefs": [
            { "visible": false, "targets": 0 }
          ],
        "order": [[ 0, 'asc' ]],
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group" style="background-color: #3FD5C0;""><td colspan="9"><strong>'+group+'</strong><div class="checkbox pull-right">'+
                      '<label><input type="checkbox" class="check_category" value="'+group+'"> Check </label>'+
                      '</div>'+'</td></tr>'
                    );
 
                    last = group;
                }
            } );
        },
        "initComplete": function(settings, json) {
          $('.group').nextUntil('.group').css( "display", "none" );
        }
      });

      $('#table_lampiran_po').DataTable({
        paging: false,
          "columnDefs": [
            { "visible": false, "targets": 0 }
          ],
        "order": [[ 0, 'asc' ]],
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group" style="background-color: #3FD5C0;""><td colspan="9"><strong>'+group+'</strong><div class="checkbox pull-right"></td></tr>'
                    );
 
                    last = group;
                }
            } );
        }
      });

      var sbody = $('#table_details tbody');
      sbody.on('click','.group',function()
      {
        $(this).nextUntil('.group').toggle();

      }).find('.group').each(function(i,v){
        var rowCount = $(this).nextUntil('.group').length;
        $(this).find('td:first').append($('<span />', { 'class': 'rowCount-grid' }).append($('<b />', { 'text': ' (' + rowCount + ')' })));
      });
      sbody.on('click','.add_item',function()
      {
          var tr = $(this).parents('tr');
          var data = table_not_group.row($(this).parents('tr')).data();
          if($(this).is(':checked'))
          {
              arr_send.push(data.id);
          }
          else
          {
            //if unchecked
            if(arr_send.includes(data.id) == true)
            {
              var index = arr_send.indexOf(data.id);
              arr_send.splice(index,1);
            }
          }

          var prev = tr.prev();
          if(prev.attr('class')== 'group')
          {
              var nextTr = prev.nextUntil('.group');
              if(nextTr.find('.add_item:checked').length == nextTr.find('.add_item').length)
                {
                  prev.find('.check_category').prop('checked',true);
                }
                else
                {
                  prev.find('.check_category').prop('checked',false);
                }
          }
          else
          {
              var prevUntil = tr.prevUntil('tr.group');
              var nextTrUntil = prevUntil.nextUntil('.group');
              var checkbox_not_checked = parseInt(parseInt(nextTrUntil.find('.add_item').length)+parseInt($(this).length));
              var checkbox_checked = parseInt(parseInt(nextTrUntil.find('.add_item:checked').length)+parseInt($(this).length));
              if(nextTrUntil.find('.add_item:checked').length == nextTrUntil.find('.add_item').length)
              {
                prevUntil.find('.check_category').prop('checked',true);
              }
              else
              {
                prevUntil.find('.check_category').prop('checked',false);
              }
          }

          $('#all_send').val(JSON.stringify(arr_send));
      })
      .on('click','.check_category',function()
        {
          var tr = $(this).parents('tr');
          var group_value = $(this).val();
          var table_data = table_not_group.data();
          var trChild = tr.nextUntil('.group');
          if($(this).is(':checked'))
          {
              trChild.find('input[type="checkbox"]').prop('checked',true);

              if(arr_send.length > 0)
              {
                $(table_data).each(function(i,v)
                {

                    if(group_value == v.category_name)
                    {
                      if(arr_send.includes(v.id) == false)
                      {
                        arr_send.push(v.id);
                      }
                    }
                    
                });
              }
              else
              {
                $(table_data).each(function(i,v)
                {
                   if(group_value == v.category_name)
                    {
                      
                        arr_send.push(v.id);
                    }
                });
              }
              
          }
          else
          {
            trChild.find('input[type="checkbox"]').prop('checked',false);
            $(table_data).each(function(i,v)
              {
                  if(group_value == v.category_name)
                  {
                    if(arr_send.includes(v.id) == true)
                    {
                      var index = arr_send.indexOf(v.id);
                      arr_send.splice(index,1);
                    }
                  }
              });
            
          }

          $('#all_send').val(JSON.stringify(arr_send));

        });

      $('#check_all').click(function()
      {
          var table_data = table_not_group.data();
          if($(this).is(':checked'))
          {
            sbody.find('input[type="checkbox"]').prop('checked',true);
            if(arr_send.length > 0)
            {
              $(table_data).each(function(i,v)
              {
                 if(arr_send.includes(v.id) == false)
                  {
                    arr_send.push(v.id);
                  }
              });
            }
            else
            {
              $(table_data).each(function(i,v)
              {
                 arr_send.push(v.id);
              });
            }
            
          }
          else
          {
            sbody.find('input[type="checkbox"]').prop('checked',false);
            arr_send = [];
          }

          $('#all_send').val(JSON.stringify(arr_send));
      });

      

     // jQuery('.dataTable').wrap('<div class="dataTables_scroll" />');
  });

</script>
</body>
</html>