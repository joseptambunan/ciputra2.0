<!DOCTYPE html>
<html>
@include('user.header')
<body class="hold-transition sidebar-mini">
<div class="wrapper">
 
  <!-- /.navbar -->
  @include('user.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content" style="font-size:17px;">
      <div class="row">
        <div class="col-12">


          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Project <strong>{{ $project->name or  ''}}</strong></h3>
              <a href="{{ url('/') }}/user/report" class="btn btn-warning">Back</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered" style="font-size: 20px;">
                <thead>
                <tr style="background-color: #17a2b8  ">
                  <th>No.</th>
                  <th>Jenis Document</th>
                  <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>HPP Development Cost</td>
                    <td>
                      <a href="{{ url('/')}}/user/report/hpp/devcost/summary?id={{ $project->id }}" class="btn btn-info">Report with Summary</a>
                      <a href="{{ url('/')}}/user/report/hpp/devcost/detail?id={{ $project->id }}" class="btn btn-success">Report with Detail Summary</a>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>HPP Construction Cost</td>
                    <td>
                      <a href="{{ url('/')}}/user/report/hpp/concost/summary/?id={{ $project->id }}" class="btn btn-info">Report with Summary</a>
                      <a href="{{ url('/')}}/user/report/hpp/concost/detail/?id={{ $project->id }}" class="btn btn-success">Report with Detail Summary</a>
                    </td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Cost Report</td>
                    <td>
                      <a href="{{ url('/')}}/user/report/costreport/?id={{ $project->id }}" class="btn btn-info">Report</a>
                    </td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>Kontrak by Kontraktor</td>
                    <td>
                      <a href="{{ url('/')}}/user/report/kontrak/kontraktor?id={{ $project->id }}" class="btn btn-info">Report </a>
                    </td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>Kontrak by Proyek</td>
                    <td>
                      <a href="{{ url('/')}}/user/report/kontrak/proyek?id={{ $project->id }}" class="btn btn-info">Report </a>
                    </td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td>Kontrak by Pekerjaan</td>
                    <td>
                      <a href="{{ url('/')}}/user/report/kontrak/pekerjaan?id={{ $project->id }}" class="btn btn-info">Report </a>
                    </td>
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

</body>
</html>
