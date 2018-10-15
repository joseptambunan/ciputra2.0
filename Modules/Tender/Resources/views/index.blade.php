<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Proyek {{ $project->name }}</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Tender</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <a href="{{ url('/')}}/tender/add" class="btn-lg btn-primary"><i class="glyphicon glyphicon-plus-sign"></i>Tambah Data Tender</a><br><br>
              <table id="example2" class="table table-bordered table-hover">
                <thead class="head_table">
                <tr>
                  <th>No. Tender </th>
                  <th>No. Rab</th>
                  <th>Pekerjaan</th>
                  <th>Nilai(Rp)</th>
                  <th>Dibuat oleh</th>
                  <th>Tanggal Dibuat</th>
                  <th>Detail</th>
                  <th>Status Pemenang</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ( $tenders as $key => $value )
                  <tr>
                    <td>{{ $value->no }}</td>
                    <td>{{ $value->rab->no }}</td>
                    <td>{{ \Modules\Pekerjaan\Entities\Itempekerjaan::find($value->rab->parent_id)->name }}</td>
                    <td>{{ number_format($value->rab->nilai) }}</td>
                    <td>{{ \App\User::find($value->created_by)->user_name }}</td>
                    <td>{{ $value->created_at }}</td>
                    <td><a href="{{ url('/')}}/tender/detail/?id={{ $value->id }}" class="btn btn-warning">Detail</a></td>
                    <td>
                      @if ( count($value->menangs) > 0 )
                        {{ $value->menangs->first()->rekanan->group->name }}                      
                        @if ( count($value->spks) <= 0 )
                          @if ( $value->approval->approval_action_id == "6")
                          <a href="{{ url('/')}}/spk/create/?id={{ $value->id }}" class="btn btn-info">Buat SPK</a>
                          @else
                          Menunggu Approval
                          @endif
                        @else                      
                          <a href="{{ url('/')}}/spk/detail/?id={{ $value->spks->first()->id }}" class="btn btn-info">Detail SPK</a>            
                        @endif
                      @else
                        Dalam Proses Tender
                      @endif
                    </td>
                  </tr>
                  @endforeach 
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("rab::app")
</body>
</html>
