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
              <li class="breadcrumb-item"><a href="{{ url('/') }}\user\budget\?id={{ $project->id }}">Budget</a></li>
              <li class="breadcrumb-item active">Budget Tahunan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      <a href="{{ url('/') }}/user/budget/?id={{ $project->id}}" class="btn btn-warning">Back</a>
    </section>

    <!-- Main content -->
    <input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}"/>
    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}"/>
    <section class="content" style="font-size:17px;">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Document <strong>Budget Tahunan Project {{ $project->name }}</strong></h3>
              
            
            </div>
            

            <div class="card-body">
              <table id="example2" class="table table-bordered">
                <thead style="background-color: #17a2b8;color:white;font-weight: bolder;;">
                <tr>
                  <th>No</th>
                  <th>Tahun Anggaran</th>
                  <th>Project</th>
                  <th>Kawasan</th>
                  <th>Dev. Cost (Rp)</th>
                  <th>Con. Cost (Rp)</th>
                  <th>Total (Rp)</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody id="content_kawasan" style="background-color: white;">
                  @foreach($project->budget_tahunans as $key => $value )
                  <tr>
                    <td><input type="hidden" name="budget_id{{ $value->id }}" id="budget_id{{ $value->id}}" value="{{ $value->id }}">{{ $key + 1 }}</td>
                    <td>{{ $value->tahun_anggaran }}</td>
                    <td>{{ $project->name }}</td>
                    <td>
                      @if ( $value->budget->project_kawasan_id != '')
                      {{ ucwords($value->budget->kawasan->name) }}
                      @endif
                    </td>
                    <td>{{ number_format($devcost = $value->nilai )}}</td>
                    <td>{{ number_format($concost = $value->con_cos )}}</td>
                    <td>{{ number_format($devcost + $concost )}}</td>
                    <td>
                      @if ( $value->approval->histories->where("user_id",$user->id)->where("approval_action_id",1)->count() > 0 )
                        <a href="#" class="btn btn-success" onclick="setapproved('6','{{ $value->id }}')" data-toggle="modal" data-target="#myModal">Approve</a>
                        <a href="#" class="btn btn-danger" onclick="setapproved('7','{{ $value->id }}')" data-toggle="modal" data-target="#myModal">Reject</a>
                      @elseif ( $value->approval->histories->where("user_id",$user->id)->where("approval_action_id",6)->count() > 0 )
                        <span class="badge badge-success">Approved</span>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table><br>

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

  function setapproved(values,budget_id){
    if ( values == "6" ){
      $("#title_approval").attr("style","color:blue");
      $("#title_approval").text("These budgets will be APPROVED by You");
    }else{
      $("#title_approval").attr("style","color:red");
      $("#title_approval").text("These budgets will be REJECTED by You");
    }
    $("#btn_save_budgets").attr("data-value",values);
    $("#budget_id").val(budget_id);
  }
  
  function requestApproval(){    

    var request = $.ajax({
      url : "{{ url('/') }}/user/budget_tahunan/approval",
      data: {
        user_id : $("#user_id").val(),
        budget_id :$("#budget_id").val(),
        status : $("#btn_save_budgets").attr("data-value")
      },
      type :"get",
      dataType :"json"     
    });

    request.done(function(data){
      if ( data.status == "0"){
        window.location.reload();
      }else{
        alert("Error When Saving Approval");
        window.location.reload();
      }
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
        <input type="hidden" name="budget_id" id="budget_id">
        <textarea name="description" id="description"></textarea>
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
