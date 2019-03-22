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
      <a href="{{ url('/') }}/access/workorder/detail?id={{ $workorder->id}}" class="btn btn-warning">Back</a>  
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
             
              
              <table id="example3" class="table table-bordered">
                <thead class="header_1">
                  <tr>
                    <td>Documen</td>
                    <td>Download</td>
                   </tr>
                </thead>
                <tbody id="detail_item">
                   @foreach ( $workorder_budget_detail->dokumen as $key => $value )
                   <tr>
                      <td>{{ $value->document_name }}</td>
                      <td><a href="#" class="btn btn-info">Download</a></td>                 
                   </tr>
                   @endforeach
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
  @include("master/copyright")


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

</body>
</html>
