@extends('layouts.master_asset')
@section('title','Periode OpName')
@section('css')
<link rel="stylesheet" href="{{ url('/') }}/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection
@section('content')
<div class="panel panel-success">
      <div class="panel-heading"><strong>Daftar Periode Opname asset</strong></div>
      <div class="panel-body">
        <p/>
        <a href="{{ url('/inventory/opname/create_period') }}" class="btn btn-success" ><i class="fa fa-plus"></i> Tambah</a>
        <table id="table_data" class="table table-bordered display table_master">
             <!--colgroup>
              <col width="10%">
              <col width="25%">
              <col width="5%">
            </colgroup-->
                <thead style="background-color: #3FD5C0;">
                  <tr>
                    <th class="text-center">Mulai</th>
                    <th class="text-center">Akhir</th>
                    <th class="text-center">Gudang</th>
                    <th class="text-center">Deskripsi</th>
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
<script type="text/javascript">
      var gentable = null;
      $(document).ready(function()
      {
        $('#stop').addClass('active');

          $.ajaxSetup({
              headers: {
                  'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
              }
          });

          gentable = $('#table_data').DataTable(
          {
      
              processing: true,
              ajax: "{{ url('/inventory/opname/getPeriods') }}",
              columns:[
                     { data: 'start_opname','className':'text-center',name: 'start_opname',"bSortable": false},
                     { data: 'end_opname',name: 'end_opname','className':'text-center',"bSortable": false},
                      { data: 'warehouse_name',name: 'warehouse_name','className':'text-center',"bSortable": false},
                     { data: 'description',name: 'description',"bSortable": false},
                      {
                        "className": "action text-center",
                        "data": null,
                        "bSortable": false,
                        "defaultContent": "" +
                        "<div class='' role='group'>" +
                        " <button class='next btn btn-primary btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='right' title='Lanjut'><i class='fa fa-mail-forward'></i></button>" +
                        "<button class='delete btn btn-danger btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='right' title='Hapus'><i class='fa fa-trash-o'></i></button>" +
                        "<button type=\"button\" class=\"btn btn-success btn-xs detail\" rel='tooltip' data-toggle='tooltip' data-placement='top' title='Detail'><i class='fa fa-list'></i>" +
                        "<span class=\"sr-only\">Action</span></button>" +

                        "</div>"
                  }
              ],
              "columnDefs": [],
              "order": [[ 0, 'asc' ]]//,
          //fixedColumns :{leftColumns:1}
          });

          var tBody = $('#table_data tbody');

          tBody.on('click','.delete',function(){
            var data =  gentable.row($(this).parents('tr')).data();
              var periode_id = data.id;
              var _url = "{{ url('/inventory/period/opname_delete') }}";
              alertify.confirm('Konfirmasi', 'Anda yakin ingin menghapus?', function(){ 
                    $.ajax({
                      type:'post',
                      dataType:'json',
                      data:{id:periode_id},
                      url:_url,
                      beforeSend:function()
                      {
                        alertify.success('Sending ...');
                      },
                      success:function(data)
                      {
                          if(data.return =='1')
                          {
                            alertify.success('Success deleted');
                            gentable.ajax.reload();
                          }
                      }
                  });
                }
                , function(){ alertify.error('Batal')}).set('labels',{ok:'Yakin',cancel:'Tidak'});
              
              
          }).
          on('click','.detail',function(){
              var data =  gentable.row($(this).parents('tr')).data();
              var periode_id = data.id;
              window.location.href="{{ url('/inventory/opname/assets') }}/"+periode_id;
          }).
          on('click','.next',function()
          {
              var data =  gentable.row($(this).parents('tr')).data();
              var periode_id = data.id;
              window.location.href = "{{ url('/inventory/opname/scan_qr_code/') }}/"+periode_id;
          });
      });
    </script>
@endsection