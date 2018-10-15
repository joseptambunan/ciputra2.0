<!DOCTYPE html>
<html>
@include('user.header')
<style type="text/css">
  .master td{
    padding: 0px !important;
  }
  
  .vo .child {
    width: 100%;
    padding: 0px !important;
    margin-bottom:0px !important
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
              <li class="breadcrumb-item"><a href="{{ url('/') }}/user/project/?id={{ $project->id }}">Document</a></li>
              <li class="breadcrumb-item active">VO</li>
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
            <h3 class="card-title">Data SPK</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table  class="table table-bordered" >
                <thead>
                <tr style="background-color: #17a2b8;color:white;">
                  <th>No. SPK</th>
                  <th>Total Nilai(Rp)</th>
                  <th>Vo</th>
                  <th>Nilai VO (Rp)</th>
                  <th>Total Nilai(Rp)</th>
                  <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ( $project->spks as $key => $value)
                    <tr>
                      <td>{{ $value->no }} / <strong>{{ $value->tender->rab->workorder->detail_pekerjaan->first()->itempekerjaan->parent->name or ''}}</strong></td>
                      <td style="text-align: right;">{{ number_format($total_spk = $value->nilai + (0.1 * $value->nilai))}}</td>
                      <td>
                          @foreach ( $value->vos as $key1 => $value1 )                          
                            Vo : {{ $key + 1 }}                          
                          @endforeach
                      </td>
                      <td>
                          @foreach ( $value->vos as $key2 => $value2 )    
                            {{ number_format($value2->nilai) }}                      
                          @endforeach         
                      </td>
                      <td>
                          @foreach ( $value->vos as $key3 => $value3 )
                          {{ number_format($value3->nilai + $total_spk ) }}                            
                          @endforeach       
                      </td>
                      <td>                        
                          @foreach ( $value->vos as $key4 => $value4 )
                          <a class="btn btn-info" href="{{ url('/')}}/user/vo/detail/?id={{ $value4->id }}">Detail</a>                       
                          @endforeach
                      </td>
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

</body>
</html>
