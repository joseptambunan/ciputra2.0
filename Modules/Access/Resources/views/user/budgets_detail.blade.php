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
              <li class="breadcrumb-item"><a href="{{ url('/') }}\user\budget?id={{ $project->id}}">Budget</a></li>
              <li class="breadcrumb-item active">Detail</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      <a href="{{ url('/') }}\user\budget?id={{ $project->id}}" class="btn btn-warning">Back</a>
      <a href="#" class="btn btn-info" onclick="setapproved('6')" data-toggle="modal" data-target="#myModal">Approve</a>
      <a href="#" class="btn btn-danger" onclick="setapproved('7')" data-toggle="modal" data-target="#myModal">Reject</a>
    </section>

    <!-- Main content -->
    <input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}"/>
    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}"/>
    <section class="content" style="font-size:17px;">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Document <strong>Budget</strong></h3>
              
            
            </div>
            <!-- /.card-header -->
            
            <div class="card-body table-responsive">
              <table class="table table-bordered">
                <thead style="background-color: #17a2b8;color:white;font-weight: bolder;">
                <tr>
                  <th style="width: 20%;background-color: orange;color:black" rowspan="2">Kawasan</th>                  
                  <th style="width: 20%;background-color: orange;color:black;" rowspan="2">Status</th>
                  <th style="width: 20%;background-color: orange;color:black;"rowspan="2">Total  Budget (Rp)</th>
                  <td colspan="7"><center>Development Cost</center></td>
                  <td colspan="5" style="background-color: grey;"><center>Construction Cost</center></td>
                </tr>
                <tr>                   
                  <th>Subtotal<br>(Rp)</th>
                  <th style="width: 20%;">Budget<br>(Rp)</th>
                  <th>Faskot<br>(Rp)</th>
                  <th>L Tnh Bruto <br>(m2)</th>
                  <th>Hpp Bruto<br>(Rp/m2)</th>
                  <th>L Tnh Netto<br>(m2)</th>
                  <th>Hpp Netto<br>(Rp/m2)</th>
                  <th style="background-color: grey;">Budget(Rp)</th>
                  <th style="background-color: grey;">L Bang(m2)</th>
                  <th style="background-color: grey;">HPP(Rp/m2)</th>
                  <th style="background-color: grey;">Total Unit</th>
                  <th style="background-color: grey;">Total Type</th>
                </tr>
                </thead>
                <tbody id="content_kawasan" style="background-color: white;">
                  @foreach ( $project->kawasans as $key => $value )
                  @php $faskot =  ( ($value->lahan_luas / $project->luas) * $budget_faskot->total_dev_cost ) ; @endphp
                  <tr>
                    <td style="background-color: grey;color:white;"><strong>{!! ucwords($value->name) !!}</strong></td>
                    @if (  $value->budgets->count() > 0 )
                      @if ( $value->budgets->first()->self_approval->where("user_id",$user->id)->first()->approval_action_id == "6" )                      
                          <td style="background-color: green;"><span style="color:white" data-value="{{ $value->budgets->first()->id }}"><strong>Approved</strong></span></td>                      
                      @elseif (  $value->budgets->first()->self_approval->where("user_id",$user->id)->first()->approval_action_id == "7" )                      
                          <td style="background-color: red;"><span style="color:white"><strong>Approved</strong></span></td>                     
                      @else (  $value->budgets->first()->self_approval->where("user_id",$user->id)->first()->approval_action_id == "1" )                     
                          <td style="background-color: yellow;">
                            <input type="checkbox" name="budget_id" data-value="{{ $value->budgets->first()->id }}" data-label="{{ ucwords($value->name) }}" data-nominal="{{ number_format($value->total_budget_dev_cost + $faskot, 2 ) }}" value="{{ $value->budgets->first()->id }}" id="approved{{ $value->budgets->first()->id }}">Waiting for Approve</td>                      
                      
                      @endif
                    @else
                    <td>Budget Not Exist</td>
                    @endif
                    @php $subtotal = $faskot + $value->total_budget_dev_cost  @endphp
                    <td>{{ number_format($subtotal + $value->total_budget_con_cost) }}</td>
                    <td>{{ number_format( $subtotal) }}</td>
                    <td>{{ number_format($value->total_budget_dev_cost) }}</td>
                    <td>{{ number_format($faskot) }}</td>
                    <td>{{ number_format( $value->lahan_luas )}}</td>
                    <td>{{ number_format( ceil($value->dev_cost_budget_bruto)) }}</td>
                    <td>{{ number_format( $value->netto_kawasan) }}</td>
                    <td>{{ number_format( ceil($value->dev_cost_budget_netto)) }}</td>
                    <td>{{ number_format( $value->total_budget_con_cost ) }}</td>
                    <td>{{ number_format( $value->netto_bangunan) }}</td>
                    <td>
                      @if ( $value->total_budget_con_cost != '0' && $value->netto_kawasan != '0')
                        {{ number_format( round( $value->total_budget_con_cost / $value->netto_kawasan)) }}
                      @else
                        0
                      @endif
                    </td>
                    <td>{{ $value->units->count() }}</td>
                    <td>{{ count($value->blok_type) }}</td>
                  </tr>

                  @endforeach
                </tbody>
              </table><br>
              <div class="col-md-4 table-responsive">
              <table class="table table-bordered table-striped">
                <tr>
                  <td>Username</td>
                </tr>
                @foreach ( $approval as $key2 => $value2 )
                <tr>
                  <td>
                    @if ( $value2->approval_action_id == "6")
                    <input type="checkbox" name="approval_id" value="" id="" disabled checked> <strong>{{ $value2->user->user_name or '' }}</strong>
                    @else
                    <input type="checkbox" name="approval_id" value="" id="" disabled>{{ $value2->user->user_name or '' }}
                    @endif
                  </td>
                  <td>{{ $value2->description }}</td>
                </tr>
                @endforeach
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
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.4/js/dataTables.fixedColumns.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/fixedcolumns/3.0.2/css/dataTables.fixedColumns.css">
<script type="text/javascript">
  $(document).ready(function() {
    $('#example3').DataTable( {
        scrollY:        600,
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   {
          leftColumns: 3,
        }
    } );
  });

  function setapproved(values){
    var budget_id = $("input[name^='budget_id']").serializeArray();
    if ( values == "6" ){
      $("#title_approval").attr("style","color:blue");
      $("#title_approval").text("These budgets will be APPROVED by You");
    }else{
      $("#title_approval").attr("style","color:red");
      $("#title_approval").text("These budgets will be REJECTED by You");
    }
    $("#btn_save_budgets").attr("data-value",values);
    var html = "";
    for ( var i =0; i < budget_id.length > 0 ; i++ ){
      console.log($("#approved" + budget_id[i].value ).attr("data-value"));
      html += "<tr>";
      html += "<td>" + $("#approved" + budget_id[i].value ).attr("data-label") + "</td>";
      html += "<td>" + $("#approved" + budget_id[i].value ).attr("data-nominal") + "</td>";
      html += "<td><input type='text' name='description' class='form control' /></td>";
      html += "</tr>";
    }
    $("#devcost_preview_budget").html(html);
  }

  function requestApproval(){
    var budget_id = $("input[name^='budget_id']").serializeArray();
    var description = $("input[name^='description']").serializeArray();
    var request = $.ajax({
      url : "{{ url('/') }}/access/budget/approval",
      data: {
         user_id : $("#user_id").val(),
        budget_id : budget_id,
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
          <table style="width: 100%;height: 50%; overflow:scroll;">
            <thead>
              <tr style="background-color: #17a2b8;">
                <th>Kawasan</th>
                <th>DevCost</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody id="devcost_preview_budget">
              
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
