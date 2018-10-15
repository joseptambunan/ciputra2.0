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
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->      
      <a href="{{ url('/') }}" class="btn btn-warning">Kembali</a>
    </section>

    <!-- Main content -->
    <input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}"/>
    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}"/>
    <section class="content" style="font-size:17px;">
      <div class="row">
        <div class="col-12">


          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Document</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered" style="font-size: 20px;">
                <thead>
                <tr style="background-color: #17a2b8  ">
                  <th>Document</th>
                  <th>Total</th>
                  <th>Waiting</th>
                  <th>Approved</th>
                  <th>Rejected</th>
                  <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Budget <span id="baloon_budget" class="badge badge-info right" style="display: none;"></span></td>
                    <td id="document_budget_total"></td>
                    <td id="document_budget_waiting"></td>
                    <td id="document_budget_approve"><span style="color: blue;" id="label_budget_approve"><strong></strong></span></td>
                    <td id="document_budget_rejected"><span style="color: red;" id="label_budget_rejected"><strong></strong></span></td>
                    <td id="document_budget_detail"><a href="{{ url('/') }}/user/budget/?id={{ $project->id }}" class="btn btn-primary btn-xs">Detail</a></td>
                  </tr>
                   <tr>
                    <td>Budget Tahunan <span id="baloon_budget_tahunan" class="badge badge-info right" style="display: none;"></span></td>
                    <td id="document_budget_tahunan_total"></td>
                    <td id="document_budget_tahunan_waiting"></td>
                    <td id="document_budget_tahunan_approve"><span style="color: blue;" id="label_budget_tahunan_approve"><strong></strong></span></td>
                    <td id="document_budget_tahunan_rejected"><span style="color: red;" id="label_budget_tahunan_rejected"><strong></strong></span></td>
                    <td id="document_budget_tahunan_detail"><a href="{{ url('/') }}/user/budget_tahunan/?id={{ $project->id }}" class="btn btn-primary btn-xs">Detail</a></td>
                  </tr>
                  <tr>
                    <td>Workorder <span id="baloon_workorder" class="badge badge-info right" style="display: none;"></td>
                    <td id="document_workorder_total"></td>
                    <td id="document_workorder_waiting"></td>
                    <td id="document_workorder_approve"><span style="color: blue;" id="label_workorder_approve"><strong></strong></span></td>
                    <td id="document_workorder_rejected"><span style="color: red;" id="label_workorder_rejected"><strong></strong></span></td>
                    <td id="document_workorder_detail"><a href="{{ url('/') }}/user/workorder/?id={{ $project->id }}" class="btn btn-primary btn-xs">Detail</a></td>
                  </tr>
                  <tr>
                    <td>RAB <span id="baloon_rab" class="badge badge-info right" style="display: none;"></td>
                    <td id="document_rab_total"></td>
                    <td id="document_rab_waiting"></td>
                    <td id="document_rab_approve"><span style="color: blue;" id="label_rab_approve"><strong></strong></span></td>
                    <td id="document_rab_rejected"><span style="color: red;" id="label_rab_rejected"><strong></strong></span></td>
                    <td id="document_rab_detail"><a href="{{ url('/') }}/user/rab/?id={{ $project->id }}" class="btn btn-primary btn-xs">Detail</a></td>
                  </tr>
                  <tr>
                    <td>Tender</td>
                    <td id="document_tender_total"></td>
                    <td id="document_tender_waiting"></td>
                    <td id="document_tender_approve"><span style="color: blue;" id="label_tender_approve"><strong></strong></span></td>
                    <td id="document_tender_rejected"><span style="color: red;" id="label_tender_rejected"><strong></strong></span></td>
                    <td id="document_tender_detail"><a href="{{ url('/') }}/user/tender/?id={{ $project->id }}" class="btn btn-primary btn-xs">Detail</a></td>
                  </tr>
                  <tr>
                    <td>SPK</td>
                    <td id="document_spk_total"></td>
                    <td id="document_spk_waiting"></td>
                    <td id="document_spk_approve"><span style="color: blue;" id="label_spk_approve"><strong></strong></span></td>
                    <td id="document_spk_rejected"><span style="color: red;" id="label_spk_rejected"><strong></strong></span></td>
                    <td id="document_spk_detail"><a href="{{ url('/') }}/user/spk/?id={{ $project->id }}" class="btn btn-primary btn-xs">Detail</a></td>
                  </tr>
                  <tr>
                    <td>VO</td>
                    <td id="document_vo_total"></td>
                    <td id="document_vo_waiting"></td>
                    <td id="document_vo_approve"></td>
                    <td id="document_vo_rejected"></td>
                    <td id="document_vo_detail"><a href="{{ url('/') }}/user/vo/?id={{ $project->id }}" class="btn btn-primary btn-xs">Detail</a></td>
                  </tr>
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
<script type="text/javascript">
  setInterval(function(){ 
    var request = $.ajax({
      url : "/user/approval_summary/",
      dataType:"json",
      data:{
        project_id : $("#project_id").val(),
        user_id : $("#user_id").val()
      },
      type : "get"
    });

    request.done(function(data){
      /*if ( data.request_budget != '0' ){
          $("#baloon_budget").show();
          $("#baloon_budget").text(data.request_budget);
      }*/
      $("#document_budget_total").html(data.total_request_budget);
      $("#label_budget_approve").text(data.approval_budget);
      $("#label_budget_rejected").text(data.rejected_budget); 
      $("#document_budget_waiting").html(data.request_budget);


      /*
      if ( data.request_workorder != '0'){
        $("#baloon_workorder").show();
        $("#baloon_workorder").text(data.request_workorder);
      }*/

      $("#document_workorder_total").html(data.total_request_workorder);
      $("#document_workorder_waiting").html(data.request_workorder);
      $("#label_workorder_approve").text(data.approval_workorder);
      $("#label_workorder_rejected").text(data.rejected_workoder);

      $("#document_tender_total").html(data.total_request_tender);
      $("#document_tender_waiting").html(data.request_tender);
      $("#label_tender_approve").text(data.approval_tender);
      $("#label_tender_rejected").text(data.rejected_tender);

      $("#document_spk_total").html(data.total_request_spk);
      $("#document_spk_waiting").html(data.request_spk);
      $("#label_spk_approve").text(data.approval_spk);
      $("#label_spk_rejected").text(data.rejected_spk);

      $("#document_budget_tahunan_total").html(data.total_request_budget);
      $("#document_budget_tahunan_waiting").html(data.request_budget_tahunan);
      $("#label_budget_tahunan_approve").text(data.approval_budget_tahunan);
      $("#label_budget_tahunan_rejected").text(data.rejected_budget_tahunan);

      $("#document_rab_total").html(data.total_request_rab);
      $("#document_rab_waiting").html(data.request_rab);
      $("#label_rab_approve").text(data.approval_rab);
      $("#document_rab_rejected").text(data.rejected_rab);
    });

  }, 3000);
</script>
</body>
</html>
