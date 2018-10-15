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
              <li class="breadcrumb-item"><a href="{{ url('/') }}/user/project/?id={{ $project->id }}">Document</a></li>
              <li class="breadcrumb-item active">Workorder</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      <a href="{{ url('/') }}/user/project/?id={{ $project->id}}" class="btn btn-warning">Back</a>
    </section>

    <!-- Main content -->
    <input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}"/>
    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}"/>
    <section class="content" style="font-size:17px;">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Data Workorder</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr style="background-color: #17a2b8;color:white;">
                  <th>Nama</th>
                  <th>Status</th>
                  <th>Number</th>
                  <th>Nilai (Rp)</th>
                  <th>Dept. IN Charge</th>
                  <th>Dept. Support</th>
                  <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($workorders as $key => $value )
                  @if ( $value->approval->histories->where("user_id",$user->id)->count() > 0 )
                  <tr>
                    <td>{{ $value->name }}</td>
                      @if ( $value->approval->histories->where("user_id",$user->id)->first()->approval_action_id == "6" )                      
                          <td style="background-color: green;"><span style="color:white"><strong>Approved</strong></span></td>                      
                      @elseif ( $value->approval->histories->where("user_id",$user->id)->first()->approval_action_id == "7")                      
                          <td style="background-color: red;"><span style="color:white"><strong>Approved</strong></span></td>                     
                      @else (  $value->approval->histories->where("user_id",$user->id)->first()->approval_action_id == "1" )                     
                          <td style="background-color: yellow;">Waiting for Approve</td>          
                      
                      @endif
                    <td>{{ $value->no }}</td>
                    <td>{{ number_format($value->nilai,2)}}</td>
                    <td>{{ $value->departmentFrom->name }}</td>
                    <td>{{ $value->departmentTo->name }}</td>
                    <td><a href="{{ url('/')}}/user/workorder/detail/?id={{ $value->id }}" class="btn btn-info">Detail</a></td>
                  </tr>
                  @endif
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

</body>
</html>
