<!DOCTYPE html>
<html>
@include('user.header')
<body class="hold-transition sidebar-mini">
<div class="wrapper">
 
  <!-- /.navbar -->
  @include('user.sidebar')
  {{ csrf_field() }}
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Project <strong>{{ $budgetdetail->budget->project->name or '' }}</strong></h1>
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
      <a href="{{ url('/') }}/access/budget/devcost/?id={{ $budgetdetail->budget->id or '' }}" class="btn btn-warning">Back</a>
      @if ( $budgetdetail->approval != "" )
        @if ( $budgetdetail->approval->histories->where("user_id",$user->id)->first()->approval_action_id == "6")
            <span class="label label-success">APPROVED</span>
        @elseif ( $budgetdetail->approval->histories->where("user_id",$user->id)->first()->approval_action_id == "7")
            <span class="label label-danger">REJECTED</span>
        @else
        <span class="label label-warning">WAITING</span>
          <button type="button" class="btn btn-success" onClick="setapproved('6');" data-toggle="modal" data-target="#myModal">Approve</button>
          <button type="button" class="btn btn-danger" onClick="setapproved('7');" data-toggle="modal" data-target="#myModal">Reject</button>
        @endif
      @endif
    </section>

    <!-- Main content -->
    <input type="hidden" name="project_id" id="project_id" value="{{ $project->id or ''}}"/>
    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id or ''}}"/>
    <input type="hidden" name="approval_id" id="approval_id" value="{{ $budgetdetail->approval->id or ''}}"/>
    <input type="hidden" name="budget_detail_id" id="budget_detail_id" value="{{ $budgetdetail->id or ''}}"/>
    <section class="content" style="font-size:17px;">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <h4 class="card-title">Data No. Budget {{ $budgetdetail->budget->no }}</h4><br>
            <h4><strong>{{ $budgetdetail->itempekerjaan->code }}-{{ $budgetdetail->itempekerjaan->name }}</strong></h4>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table class="table table-bordered " style="width: 40%;">
                <thead style="background-color:#17a2b8;color:white;font-weight:bolder">
                  <tr>
                    <td>Volume</td>
                    <td>Satuan</td>
                    <td>Harga Satuan</td>
                    <td>Subtotal</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{ number_format($budgetdetail->volume )}}</td>
                    <td>{{ $budgetdetail->satuan }}</td>
                    <td>{{ number_format($budgetdetail->nilai)}}</td>
                    <td>{{ number_format($budgetdetail->nilai * $budgetdetail->volume )}}</td>
                  </tr>
                </tbody>
              </table><br>
              <table class="table table-bordered " style="width: 40%;">
                <thead style="background-color:#17a2b8;color:white;font-weight:bolder">
                  <tr>
                    <td>Data Pusat</td>
                    <td>Tertinggi</td>
                    <td>Terendah</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Rp. {{ number_format($budgetdetail->itempekerjaan->nilai_master_satuan) }} / {{ $budgetdetail->itempekerjaan->details->satuan or  '' }}</td>
                    <td>
                     <span> Rp. {{number_format($budgetdetail->itempekerjaan->nilai_lowest_library["nilai"],2)}} / {{ $budgetdetail->itempekerjaan->details->satuan or  '' }}</span><br>
                     <span>Proyek : {{ $budgetdetail->itempekerjaan->nilai_lowest_library["project_id"] }}</span>
                    </td>
                    <td>
                      <span>Rp. {{number_format($budgetdetail->itempekerjaan->nilai_max_library["nilai"],2)}} / {{ $budgetdetail->itempekerjaan->details->satuan or  '' }}</span><br>
                      <span>Proyek : {{ $budgetdetail->itempekerjaan->nilai_lowest_library["project_id"] }}</span>
                    </td>
                  </tr>
                </tbody>
              </table><br>
              <table id="example1"  class="table table-bordered table-striped">
                <thead style="background-color:#17a2b8;color:white;font-weight:bolder">
                <tr>
                  <td rowspan="2">No.</td>    
                  <td rowspan="2">Harga Satuan</td>       
                  <td rowspan="2">Proyek</td>
                </tr>
                </thead>
                <tbody>
                  @foreach( $budgetdetail->itempekerjaan->harga as $key => $value )
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ number_format($value->nilai) }}</td>
                    <td>{{ $value->project->name }}</td>
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
      url : "{{ url('/') }}/access/budget/approval/budget_item",
      data: {
          user_id : $("#user_id").val(),
          budget_detail_id :$("#budget_detail_id").val(),
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
