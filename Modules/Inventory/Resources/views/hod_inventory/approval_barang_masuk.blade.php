@extends('layouts.master')
@section('css')
<link href="{{ URL::asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/global/plugins/datatables/fixedHeader.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<!--ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="#">Home</a></li>
  <li role="presentation"><a href="#">Profile</a></li>
  <li role="presentation"><a href="#">Messages</a></li>
</ul-->

<div class="panel panel-success">
  <div class="panel-heading"><strong>Approval Barang Masuk Hibah</strong></div>
  <div class="panel-body">
    <button class="btn btn-success" type="button" id="btn_refresh"><i class="fa fa-refresh"></i> Refresh</button>
    <p/>
    <table class="table table-bordered display table_master" id="table_data">
      <thead>
        <tr>
          <th rowspan="2">#</th>
          <th rowspan="2">Nomor</th>
          <th colspan="2" style="text-align:center;">DARI</th>
          <th rowspan="2">Tanggal</th>
          <th rowspan="2">Total</th>
          <th rowspan="2">Masuk</th>
          <th rowspan="2">Tolak</th>
          <th rowspan="2">Status</th>
          <th rowspan="2">Aksi</th>
          <th rowspan="2"></th>
          <th rowspan="2"></th>
        </tr>
        <tr>
          <th class="text-center">Proyek</th>
          <th class="text-center">PT</th>
          <th style="display: none;"></th>
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
  var fnSelisih = function(data,type,row)
  {
    var retVal = "<label><i class='fa fa-check'></i></label>";
    if (type == 'display') {
      if(parseInt(data)>0)
      {
        retVal = "<label><i class='fa fa-plus'></i>"+data+"</label>";
      }
    }
    return retVal;
  }
  var fnLabelStatus = function(data,type,row)
  {
    var retVal = "";
    if (type == 'display') {

      if(parseInt(data)==2)
      {
        retVal ="<label>Approved</label>";
      }
      else if(parseInt(data)==1)
      {
        retVal ="<label>Delivered</label>";
      }
      else
      {
        retVal = "<label>Open</label>";
      }
    }
    return retVal;
  }
  var fnCheckStatus = function(data, type, row)
  {
    var retVal = "<button class='approve btn btn-info btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='left' title='Click to Approve'>Approve</button>  <button class='undelivered btn btn-warning btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='top' title='Click to UnDelivered' style='color:black;'> UnDelivered</button>";
    if (type == 'display') {
      if(parseInt(data)>1)
      {
        retVal ="<button class='unapprove  btn btn-success btn-xs' rel='tooltip' data-toggle='tooltip' data-placement='left' title='Click to UnApprove'>UnApprove</button>";
      }
    }
    return retVal;
  }
  var gentable = null;
  $(document).ready(function(){

    $('#barangmasuk').addClass('active');
    gentable = $('#table_data').DataTable(
    {
      //scrollY:        "300px",
        //scrollX:        true,
        //scrollCollapse: true,
        //paging:         false,
          processing: true,
          ajax: "{{ url('/inventory/hod_inventory/getApprovalBarangMasukHibah') }}",
          columns:[
                 { data: 'nomor',name: 'nomor',"bSortable": false},
                 { data: 'no',name: 'no',"bSortable": false},
         { data: 'from_project_name',name: 'from_project_name',"bSortable": false},
                 { data: 'from_pt_name',name: 'from_pt_name',"bSortable": false},
                 
         { data: 'tanggal_hibah',name: 'tanggal_hibah',"bSortable": false},
         { data: 'total',name: 'total',"className":"text-right","bSortable": false},
         { data: 'diisi',name: 'diisi',"className":"text-right","bSortable": false},
          { data: 'reject',name: 'reject',"className":"text-right","bSortable": false},
         
         { data: 'status',name:'status',render:fnLabelStatus,"className":"text-center","bSortable":false},
         { data: 'status',name: 'status',render:fnCheckStatus,"bSortable": false},
         { data: 'selisih',name: 'selisih',render:fnSelisih,"className":"text-center","bSortable": false},
          {
            "className": "action text-center",
            "data": null,
            "bSortable": false,
            "defaultContent": "" +
            "<div class='' role='group'>" +
            
            
            "<button type=\"button\" class=\"btn btn-success btn-xs detail\" rel='tooltip' data-toggle='tooltip' data-placement='top' title='Detail'><i class='fa fa-list'></i>" +
            "<span class=\"sr-only\">Action</span></button>" +
            "</div>"
      }
          ],
          "columnDefs": [],
          "order": [[ 0, 'asc' ]]//,
          //fixedColumns :{leftColumns:1}
        });

      var sbody = $('#table_data tbody');

      sbody.on('click','.approve',function(){
          var data = gentable.row($(this).parents('tr')).data();
          var _datasend ={'id':data.id,_token:$('input[name=_token]').val()};
          var _url = "{!! url('/inventory/barangmasuk_hibah/approve') !!}"
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
       }).on('click','.unapprove',function(){
            var data = gentable.row($(this).parents('tr')).data();
            var _datasend ={'id':data.id,_token:$('input[name=_token]').val()};
            var _url = "{!! url('/inventory/barangmasuk_hibah/unapprove') !!}"
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
                   text: "UnApproved, Silahkan Edit "
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
                },
                complete:function()
                {}
          });
      }).on('click','.undelivered',function()
       {
            var data = gentable.row($(this).parents('tr')).data();
            var _datasend ={'id':data.id,_token:$('input[name=_token]').val()};
            var _url = "{!! url('/inventory/hod_inventory/barangmasuk/undelivered') !!}"
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
                       text: "UnDelivered, Silahkan Edit "
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
                },
                complete:function()
                {}
          });

       }).on('click','.detail',function()
      {
          var data = null;
          data = gentable.row($(this).parents('tr')).data();
          window.location.href="{{ url('/inventory/hod_inventory/barangmasuk_hibah/details/') }}/"+data.id;
      }).
      on('click','.tambah_item',function()
      {   
          var getItem = null;
          getItem = gentable.row($(this).parents('tr')).data();
          $('#div_content').load("{{ url('/inventory/barangmasuk_hibah/add_details')}}/"+getItem.id);
      })
      .on('click','.delete',function()
      {
          var getItem = null;
          getItem = gentable.row($(this).parents('tr')).data();
          $.confirm({
      title: 'Confirm Delete ?',
      icon: 'fa fa-warning',
      content: 'Are you sure delete Key ID ' +getItem.id+ ' !',
      autoClose: 'cancelAction|8000',
      buttons: {
        deleteUser: {
          text: 'Delete',
          btnClass: 'btn-red any-other-class',
          action: function () {
            $.post("{{ url('/inventory/barangmasuk_hibah/delete') }}", 
            {
              id:getItem.id,
              _token: $('input[name=_token]').val()
            }, 
            function(data) {
              if(data.return=='1')
              {
                gentable.ajax.reload();
              }
            }); 
            
          }
        },
        cancelAction: function () {
          
        }
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