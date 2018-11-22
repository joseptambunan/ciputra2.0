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
            <h1>Project <strong>{{ $project->name or '' }}</strong></h1>
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
      <a href="{{ url('/') }}/access/" class="btn btn-warning">Back</a>
      @if ( isset($approval->histories) )
        @if ( $approval->histories->where("user_id",$user->id)->where("approval_action_id",1)->count() > 0 )
        <a href="#" class="btn btn-info" onclick="setapproved('6')" data-toggle="modal" data-target="#myModal">Approve</a>
        <a href="#" class="btn btn-danger" onclick="setapproved('7')" data-toggle="modal" data-target="#myModal">Reject</a>
        @elseif ( $approval->histories->where("user_id",$user->id)->where("approval_action_id",6)->count() > 0 )
          <span class="badge badge-success" style="font-size:20px;">Approved</span>
        @elseif ( $approval->histories->where("user_id",$user->id)->where("approval_action_id",7)->count() > 0 )
          <span class="badge badge-danger" style="font-size:20px;">Rejected</span>
        @endif
      @endif
    </section>

    <!-- Main content -->
    <input type="hidden" name="project_id" id="project_id" value="{{ $project->id or ''}}"/>
    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id or ''}}"/>
    <input type="hidden" name="budget_id" id="budget_id" value="{{ $budget->id or ''}}"/>
    <input type="hidden" name="approval_item" id="approval_item" value="{{ $budget->id or ''}}"/>
    <section class="content" style="font-size:17px;">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Data Document</h3>
            
            </div>
            <!-- /.card-header -->
            <div class="card-body  table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                <tr style="background-color: #17a2b8">
                  <th colspan="2"><center>Nama</center></th>
                  <th><center>Keterangan</center></th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><strong><span style="font-size: 14px;"><strong>TOTAL BUDGET DEVELOPMENT COST</strong></span></strong></td>
                    <td><a href="{{ url('/')}}/access/budget/devcost/?id={{ $budget->id }}" class="btn btn-primary">Detail</a></td>
                    <td style="text-align: right;"><strong>Rp. {{ number_format($budget->total_dev_cost)}}</strong></td>
                  </tr>
                  <tr>
                    <td><strong><span style="font-size: 14px;"><strong>TOTAL BUDGET CONSTRUCTION COST</strong></span></strong></td>
                    <td><a href="{{ url('/')}}/access/budget/concost/?id={{ $budget->id }}" class="btn btn-primary">Detail</a></td>
                    <td style="text-align: right;"><strong>Rp. {{ number_format($budget->total_con_cost)}}</strong></td>
                  </tr>
                  <tr>
                    <td colspan="2"><strong><span style="font-size: 14px;">TOTAL BUDGET</span></strong></td>
                    <td style="text-align: right;"><strong>Rp. {{ number_format($budget->total_dev_cost + $budget->total_con_cost)}}</strong></td>
                  </tr>  
                  <tr style="background-color: grey;">
                    <td>&nbsp;</td>
                    <td style="color:white"><strong>Luas (m2)</strong></td>
                    <td style="color:white;"><strong>HPP Dev Cost (Rp/m2)</strong></td>
                  </tr>  
                  <tr>
                    <td>Brutto</td>
                    <td style="text-align: left;">{{ number_format($budget->project->luas)}} m2</td>
                    <td style="text-align: right;">{{ number_format($budget->total_dev_cost/$budget->project->luas) }}</td>
                  </tr> 
                  <tr>
                    <td>Netto</td>
                    <td style="text-align: left;">{{ number_format($budget->project->netto)}} m2 /<br> Eff. ({{ number_format($budget->project->efisiensi * 100,2) }}%) m2</td>
                    <td style="text-align: right;">{{ number_format($effisiensi_netto) }}</td>
                  </tr>     
                </tbody>
              </table><br>
              <div class="col-md-12 table-responsive">

              <table class="table table-bordered table-striped ">
                <tr class="header_1">
                  <td>Username</td>
                  <td>Request At</td>
                  <td>Status</td>
                  <td>Time Left (days)</td>
                  <td>Keterangan</td>
                </tr>
                @if ( isset($approval->histories))
                @foreach ( $approval->histories as $key2 => $value2 )
                <tr>
                  <td>
                    @if ( $value2->approval_action_id == "6")
                    <input type="checkbox" name="approval_id" value="" id="" disabled checked> <strong>{{ $value2->user->user_name or '' }}</strong>
                    @else
                    <input type="checkbox" name="approval_id" value="" id="" disabled>{{ $value2->user->user_name or '' }}
                    @endif
                  </td>
                  <td>{{ $value2->created_at->format("d M Y ") }}</td>
                  <td>
                    @if ( $value2->approval_action_id == "7" )
                    <span class="reject"><strong>Reject</strong></span>
                    @elseif ( $value2->approval_action_id == "6")
                    <span class="approve"><strong>Approve</strong></span>
                    @else
                    <span class="waiting"><strong>Waiting</strong></span>
                    @endif
                  </td>
                  <td>
                    <strong>
                      @php
                      $str = $value2->created_at;
                      $str = strtotime(date("M d Y ")) - (strtotime($str));
                      echo ceil($str/3600/24);
                      @endphp
                    </strong>
                    (days)
                  </td>
                  <td>{{ $value2->description }}</td>
                </tr>
                @endforeach
                @endif
              </table>
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
    var description = $("#description").val();
    if ( description == "" && $("#btn_save_budgets").attr("data-value") == "7"){
      alert("Silahkan isi keterangan terlebih dahulu");
      return false;
    }
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
