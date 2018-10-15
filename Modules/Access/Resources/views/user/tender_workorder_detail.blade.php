<!DOCTYPE html>
<html>
@include('user.header')
<style type="text/css">
  #example3 th,
    #example3 td {
        white-space: nowrap;
    }
   
</style>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
 
  <!-- /.navbar -->
  @include('user.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Project <strong>{{ $project->name or '' }}</strong></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/') }}/user/workorder/?id{{ $project->id }}">Workorder</a></li>
              <li class="breadcrumb-item active">Workorder {{ $workorder->no or '' }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->      
      <a href="{{ url('/') }}/user/tender/detail/?id={{ $tender->id }}"" class="btn btn-warning">Kembali</a>  
      @if ( $workorder->self_approval->where("user_id",$user->id)->first()->approval_action_id == "1")    
      <a href="#" class="btn btn-info" onclick="setapproved('6')" data-toggle="modal" data-target="#myModal">Approve</a>
      <a href="#" class="btn btn-danger" onclick="setapproved('7')" data-toggle="modal" data-target="#myModal">Reject</a>
      @endif
    </section>

    <!-- Main content -->
    <input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}"/>
    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}"/>
    <input type="hidden" name="workorder_id" id="workorder_id" value="{{ $workorder->id }}"/>
    <section class="content" style="font-size:17px;">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Data Workorder</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body col-md-4">
              <table id="example1" class="table table-bordered table-striped">
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>Nama</strong></span></td>
                  <td>{{ $workorder->name }}</td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>No</strong></span></td>
                  <td>{{ $workorder->no }}</td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>Dept. From</strong></span></td>
                  <td>{{ $workorder->departmentFrom->name }}</td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>Nilai</strong></span></td>
                  <td>{{ number_format($workorder->estimasi_nilaiwo) }}</td>
                </tr>
              </table><br>
            </div>
            <div class="card-body col-md-12">
              <table id="example3" class="table table-bordered">
                <thead>
                  <tr style="background-color: #17a2b8 ">
                    <th style="width: 10%;">Dept.</th>
                    <th>COA</th>
                    <th>Work Item</th>
                    <th>Volume</th>
                    <th>Unit</th>
                    <th>Unit Price (Rp)</th>
                    <th>Subtotal (Rp)</th>
                    <th>Detail</th>
                  </tr>
                </thead>
                <tbody>
                  @for ( $i=0; $i < count($workorder->parent_id); $i++ )
                  <tr>
                    <td>{{ $workorder->parent_id[$i]['deptcode'] }}</td>
                    <td>{{ $workorder->parent_id[$i]['coa_code'] }}</td>
                    <td>{{ $workorder->parent_id[$i]['item_name'] }}</td>
                    <td>{{ number_format($workorder->parent_id[$i]['volume']) }}</td>
                    <td>{{ $workorder->parent_id[$i]['satuan'] }}</td>
                    <td>{{ number_format($workorder->parent_id[$i]['unitprice'],2) }}</td>
                    <td>{{ number_format($workorder->parent_id[$i]['subtotal'],2) }}</td>
                    <td><button class="btn btn-info" onclick="viewdetail({{ $workorder->parent_id[$i]['id'] }})" data-toggle="modal" data-target="#myModal2">Detail</button></td>
                  </tr>
                  @endfor
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->

          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.0-alpha
    </div>
    <strong>Copyright &copy; 2014-2018 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>


</div>
<!-- ./wrapper -->
@include('user.footer')
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.4/js/dataTables.fixedColumns.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/fixedcolumns/3.0.2/css/dataTables.fixedColumns.css">
<script type="text/javascript">
  $(document).ready(function() {
    $('#example3').DataTable( {
        scrollY:        300,
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   {
          leftColumns: 1,
        }
    } );
  });
</script>
<script type="text/javascript">
  function requestApproval(){
    var request = $.ajax({
      url : "{{ url('/')}}/user/workorder/approval",
      data:{
        user_id: $("#user_id").val(),
        project_id : $("#project_id").val(),
        workorder_id : $("#workorder_id").val(),
        status : $("#btn_save_budgets").attr("data-value"),
        description : $("#description").val()
      },
      type :"get",
      dataType :"json"
    });

    request.done(function(data){
      if (data.status == "0"){
        window.location.reload();
      }else{
        alert("Error when saving Approval");
        window.location.reload();
      }
    });   
  }

  $(document).ready(function() {
    $('#example3').DataTable( {
        scrollY:        300,
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   {
          leftColumns: 1,
        }
    } );
  });

  function viewdetail(parent_id){
    var request = $.ajax({
      url : "{{ url('/')}}/user/approval/itempekerjaan/detail/",
      data :{
        parent_id : parent_id,
        workorder : $("#workorder_id").val()
      },
      type :"get",
      dataType :"json"
    });

    request.done(function(data){
      $("#detailist").html(data.html);
    })
  }
</script>
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br>
      </div>
      <div class="modal-body">
        <span id="title_approval"><strong></strong></span>
        <p></p>
        <div id="listdetail">
            <textarea name="description" id="description" rows="6" cols="30"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn_save_budgets" data-value="" onclick="requestApproval()">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="myModal2">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br>
      </div>
      <div class="modal-body" style="padding:0px !important;">
        <span id="title_approval"><strong></strong></span>
        <p></p>
        <div id="listdetail">
            <table style="width: 100%;" class="table" >
              <thead>
                <tr style="background-color: #17a2b8  ">
                  <th>Work Item</th>
                  <th>Volume</th>
                  <th>Unit</th>
                  <th>Price</th>
                  <th>UnitPrice</th>
                </tr>
              </thead>
              <tbody id="detailist">
                
              </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn_save_budgets" data-value="" onclick="requestApproval()">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</body>
</html>
