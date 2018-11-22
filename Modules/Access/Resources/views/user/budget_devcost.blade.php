<!DOCTYPE html>
<html>
@include('user.header')
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
            <h1>Project <strong>{{ $budgets->project->name or '' }}</strong></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/') }}/user/project/?id={{ $project->id or ''}}">Document</a></li>
              <li class="breadcrumb-item active">Budget</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      <a href="{{ url('/') }}/access/budget/detail/?id={{ $budgets->id or '' }}" class="btn btn-warning">Back</a>
      
    </section>

    <!-- Main content -->
    <input type="hidden" name="project_id" id="project_id" value="{{ $project->id or ''}}"/>
    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id or ''}}"/>
    <section class="content" style="font-size:17px;">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Data Document</h3>
            
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table  class="table table-bordered table-striped">
                <thead style="background-color:#17a2b8;color:white;font-weight:bolder">
                <tr>
                  <td rowspan="2">No.</td>    
                  <td rowspan="2">COA</td>       
                  <td rowspan="2">Item Pekerjaan</td>
                  <td rowspan="2">Volume</td>
                  <td rowspan="2">Satuan</td>
                  <td rowspan="2">Harga Satuan</td>
                  <td rowspan="2">Subtotal</td>
                  <td colspan="3">Referensi</td>
                  <td rowspan="2">Status</td>
                </tr>
                <tr>                  
                  <td>Nilai Terendah</td>
                  <td>Nilai Tertinggi</td>
                  <td>Referensi</td>
                </tr>
                </thead>
                <tbody>
                  @foreach( $budgets->details as $key => $value )
                  @if ( $value->itempekerjaan->group_cost == 1 )
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->itempekerjaan->code or '' }}</td>
                    <td>{{ $value->itempekerjaan->name or '' }}</td>
                    <td>{{ $value->volume or '' }}</td>
                    <td>{{ $value->satuan or '' }}</td>
                    <td>{{ number_format($value->nilai) }}</td>
                    <td>{{ number_format($value->nilai * $value->volume ) }}</td>
                    <td>
                       <span> Rp. {{number_format($value->itempekerjaan->nilai_lowest_library["nilai"],2)}} / {{ $value->satuan or  '' }}</span><br>
                       <span>Proyek : {{ $value->itempekerjaan->nilai_lowest_library["project_id"] }}</span>
                    </td>
                    <td>
                      <span>Rp. {{number_format($value->itempekerjaan->nilai_max_library["nilai"],2)}} / {{ $value->satuan }}</span><br>
                      <span>Proyek : {{ $value->itempekerjaan->nilai_lowest_library["project_id"] }}</span>
                    </td>
                    <td><a href="{{ url('/')}}/access/budget/referensi?id={{ $value->id }}" class="btn btn-warning">Referensi</a></td>
                    <td>
                      @if (  $value->approval->histories->where("user_id",$user->id)->first()->approval_action_id == "7" )
                        <span class="reject"><strong>Reject</strong></span>
                      @elseif (  $value->approval->histories->where("user_id",$user->id)->first()->approval_action_id == "6")
                        <span class="approve"><strong>Approve</strong></span>
                      @else
                        <span class="waiting"><strong>Waiting</strong></span>
                      @endif
                    </td>
                  </tr>
                  @endif
                  @endforeach
                </tbody>
              </table><br>
              <div class="col-md-4">

            </div>
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
<script type="text/javascript">
  function setapproved(values){

    if ( values == "6" ){
      $("#title_approval").attr("style","color:blue");
      $("#title_approval").text("These budgets will be APPROVED by You");
    }else{
      $("#title_approval").attr("style","color:red");
      $("#title_approval").text("These budgets will be REJECTED by You");
    }
    $("#btn_save_budgets").attr("data-value",values);
    
  }

  function requestApproval(){
    var description = $("#description").val()
    var request = $.ajax({
      url : "{{ url('/') }}/access/budget/approval/approval_budget_awal",
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
        <div id="listdetail">
          <textarea name="description" id="description"></textarea>
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
