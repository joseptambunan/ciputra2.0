<!DOCTYPE html>
<html>
@include('user.header')

<style type="text/css">
    #example3 th,
    #example3 td {
        white-space: nowrap;
    }
   
    @media only screen and (max-width: 600px) {
      .table {
        font-size :12px;
      }

      #label_rekap_penawaran {
        display: none;
      }
    
      .labeltable{
        font-size: 12px !important;
      }
     
      .card-body.tables{
        padding:0px !important;
      }

      .nav.nav-pills.ml-auto.p-2{
        font-size: 12px;
      }

      #detail_penawaran{
        font-size: 12px !important;
      }

      #example3_filter{
        display: none;
      }
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
            <h1>Project <strong>{{ $tender_korespondensi->tender_rekanan->tender->rab->workorder->project->first()->name or '' }}</strong></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item">Tender Korespondensi</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      <a href="{{ url('/') }}\user\project" class="btn btn-warning">Back</a>
      @if ( $tender_korespondensi->approval->histories->where("user_id",$user->id)->first()->approval_action_id == "1")    
      <a href="#" class="btn btn-info" onclick="setapprovedrequest('6')" data-toggle="modal" data-target="#myModal4">Approve</a>
      <a href="#" class="btn btn-danger" onclick="setapprovedrequest('7')" data-toggle="modal" data-target="#myModal4">Reject</a>
      @elseif ( $tender_korespondensi->approval->histories->where("user_id",$user->id)->first()->approval_action_id == "6")  
      <span class="badge bg-success" style="font-size:20px;">Approved</span>  
      @endif
    </section>

    <!-- Main content -->
    <input type="hidden" name="approval_history" id="approval_history" value="{{ $tender_korespondensi->approval->histories->where('user_id',$user->id)->first()->id }}">
    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
    <input type="hidden" name="status" id="status" value="6">
    {{ csrf_field() }}
    <section class="content" style="font-size:17px;">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Document <strong>Tender Korespondensi</strong></h3>
              
            
            </div>
            <!-- /.card-header -->
            
            <div class="card-body">
              <div class="col-md-6">
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover table-striped table-bordered">
                    <tr>
                      <td style="background-color: grey;"><span style="color:white"><strong>No. Surat</strong></span></td>
                      <td>{{ $tender_korespondensi->no  or ''}}</td>
                    </tr>               
                    <tr>
                      <td style="background-color: grey;"><span style="color:white"><strong>Type</strong></span></td>
                      <td>{{ $type or '' }} </td>
                    </tr>
                     <tr>
                      <td style="background-color: grey;"><span style="color:white"><strong>Rekanan</strong></span></td>
                      <td>{{ $tender_korespondensi->tender_rekanan->rekanan->group->name or '' }}</td>
                    </tr>
                    <tr>
                      <td style="background-color: grey;"><span style="color:white"><strong>Alamat</strong></span></td>
                      <td>{{ $tender_korespondensi->tempat_undangan }}</td>
                    </tr>
                    <tr>
                      <td style="background-color: grey;"><span style="color:white"><strong>Tanggal</strong></span></td>
                      <td>Rp{{ $tender_korespondensi->date }}</td>
                    </tr>
                  </table><br>
                </div>
              </div> 

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
@include('project.user.tender_js')

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

  function requestTenderKoresponden(){
    var request = $.ajax({
      url : "{{ url('/')}}/user/tender_korespondensi/approval/",
      data : {
        user_id : $("#user_id").val(),
        approval : $("#approval_history").val(),
        status : $("#status").val()
      },
      type : "post",
      dataType : "json"
    });

    request.done(function(data){
      window.location.reload();
    })
  }

  function setapprovedrequest(values){
    if ( values == "6" ){
      $("#title_approvaleds").attr("style","color:blue");
      $("#title_approvaleds").text("These Tender will be APPROVED by You");
    }else{
      $("#title_approvaleds").attr("style","color:red");
      $("#title_approvaleds").text("These Tender will be REJECTED by You");
    }
    $("#status").val(values);
  }

</script>
<div class="modal fade" tabindex="-1" role="dialog" id="myModal4">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br>
      </div>
      <div class="modal-body">
        <span id="title_approvaleds"><strong></strong></span>
        <p></p>
        <div id="listdetail">
            <textarea name="description" id="description" rows="6" cols="30"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn_saved_tendered" data-value="" onclick="requestTenderKoresponden()">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</body>
</html>
