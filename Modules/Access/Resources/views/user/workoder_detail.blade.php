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
              <li class="breadcrumb-item active">Workorder</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->      
      <a href="{{ url('/') }}/access/" class="btn btn-warning">Back</a>  
      @if ( $workorder->approval->histories->where("user_id",$user->id)->first()->approval_action_id == "1")    
      <a href="#" class="btn btn-info" onclick="setapproved('6')" data-toggle="modal" data-target="#myModal">Approve</a>
      <a href="#" class="btn btn-danger" onclick="setapproved('7')" data-toggle="modal" data-target="#myModal">Reject</a>
      @elseif ( $workorder->approval->histories->where("user_id",$user->id)->first()->approval_action_id == "6")  
      <span class="badge badge-success" style="font-size:20px;">Approved</span>  
      @endif
    </section>
    {{ csrf_field() }}
    <!-- Main content -->
    <input type="hidden" name="project_id" id="project_id" value="{{ $workorder->project->first()->id }}"/>
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
                  <td style="background-color: grey;"><span style="color:white"><strong>Workorder</strong></span></td>
                  <td>{{ $workorder->name }}</td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>No</strong></span></td>
                  <td>{{ $workorder->no }}</td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>Project</strong></span></td>
                  <td>{{ $workorder->project->name }}</td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>Dept. From</strong></span></td>
                  <td>{{ $workorder->departmentFrom->name }}</td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>Nilai Total</strong></span></td>
                  <td>{{ number_format($workorder->nilai) }}</td>
                </tr>
              </table><br>
            </div>
            <div class="card-body col-md-12">
              @php $nilai = 0 @endphp
                  @for ( $i=0; $i < count($workorder->parent_id); $i++ )
                  @php $nilai = $nilai + ($workorder->parent_id[$i]['subtotal']) @endphp
                  @endfor
              <table id="example3" class="table table-bordered">
                <thead class="header_1">
                  <tr>
                        <td>COA</td>
                        <td>Item Pekerjaan</td>
                        <td>No. Budget Tahunan</td>
                        <td>Volume</td>
                        <td>Satuan</td>
                        <td>Nilai(Rp)</td>
                        <td>Subtotal(Rp)</td>
                        <td>Delete</td>
                       </tr>
                </thead>
                  <tbody id="detail_item">
                       @foreach ( $workorder->detail_pekerjaan as $key => $value )
                       <tr>
                          <td>{{ $value->itempekerjaan->code or ''}}</td>
                          <td>{{ $value->itempekerjaan->name or ''}}</td>
                          <td>{{ $value->budget_tahunan->no}}</td>
                          <td>{{ number_format($value->volume)}}</td>
                          <td>{{ $value->itempekerjaan->details->satuan or ''}}</td>
                          <td>{{ number_format($value->nilai)}}</td>
                          <td>{{ number_format($value->volume * $value->nilai,2)}}</td>
                          <td>
                            <button type="button" class="btn btn-danger" onclick="removepekerjaan('{{ $value->id }}')">Hapus Pekerjaan</button>
                          </td>
                       </tr>
                       @endforeach
                     </tbody>
              </table>
              <br>
               @php $nilai = 0 @endphp
                @foreach ( $workorder_unit as $key2 => $value2 )
                @php $nilai = 0; @endphp
                @endforeach

              <table id="example3" class="table table-bordered">
                <thead>
                  <tr style="background-color: #17a2b8 ">
                    <th style="width: 10%;">No.</th>
                    <th>Blok/Unit</th>
                    <th>Luas Tanah</th>
                    <th>Luas Bangunan</th>
                    <th>Type</th>
                  </tr>
                </thead>
                <tbody>
                  @php $nilai = 0 @endphp
                  @foreach ( $workorder->details as $key2 => $value2 )
                  <tr>
                    <td>{{ $key2 + 1}}</td>
                    <td>{{ $value2->asset->name }}</td>
                    @if ( $value2->asset_type == "Modules\Project\Entities\Unit")
                    <td>{{ number_format($value2->asset->tanah_luas) }}</td>
                    @elseif ( $value2->asset_type == "Modules\Project\Entities\ProjectKawasan" )
                    <td>{{ number_format($value2->asset->lahan_luas) }}</td>
                    @else
                    <td>{{ number_format($value2->asset->luas) }}</td>
                    @endif
                    <td>{{ number_format($value2->asset->bangunan_luas) }}</td>
                    <td>{{ $value2->asset->type->name or '' }}</td>                 
                  </tr>
                  @endforeach
                  
                </tbody>
              </table>
            </div>

            <div class="col-md-6">
              <table class="table table-bordered table-striped">
                <tr class="header_1">
                  <td>Username</td>
                  <td>Request At</td>
                  <td>Status</td>
                  <td>Time Left (days)</td>
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
                </tr>
                @endforeach
                @endif
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
  $( document ).ready(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-Token': $('input[name=_token]').val()
          }
        });

        
    });

  function requestApproval(){
    if ( $("#btn_save_budgets").attr("data-value") == "7" && $("#description").val() == "" ){
      alert("Silahkan isi keterangan");
      return false;
    }
    var request = $.ajax({
      url : "{{ url('/')}}/access/workorder/approval",
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
      url : "{{ url('/')}}/access/approval/itempekerjaan/detail/",
      data :{
        parent_id : parent_id,
        workorder : $("#workorder_id").val()
      },
      type :"get",
      dataType :"json"
    });

    request.done(function(data){
      $("#detailist").html(data.html);
      $("#label_department").text(data.dept);
      $("#label_coa").text(data.coa);
      $("#label_name").text(data.names);
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
    <div class="modal-content" style="width: 153%;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br>
      </div>
      <div class="modal-body" style="padding:0px !important;">
        <span id="title_approval"><strong></strong></span>
        <p></p>
        &nbsp;<strong>Department : </strong><span id="label_department"></span><br>
        &nbsp;<strong>COA : </strong><span id="label_coa"></span><br>
        &nbsp;<strong>Item Name : </strong><span id="label_name"></span><br>
        <div id="listdetail">
            <table style="width: 100%;" class="table" >
              <thead>
                <tr style="background-color: #17a2b8;vertical-align: top;color:white; ">
                  <th style="vertical-align: top !important;">COA</th>
                  <th style="vertical-align: top !important;">Work Item</th>
                  <th style="vertical-align: top !important;">Volume</th>
                  <th style="vertical-align: top !important;">Unit</th>
                  <th>Uni Price (Rp)</th>
                  <th>Amount (Rp)</th>
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
