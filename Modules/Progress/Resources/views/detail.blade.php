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

  @include("master/sidebar_progress")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

    </section>

    <!-- Main content -->
    <section class="content">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data SPK </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-6">
                {{ csrf_field() }}                  
                <div class="form-group">
                    <label for="exampleInputEmail1">No. SPK</label>
                    <input type="text" class="form-control" name="document" value="{{ $spk->no}}" disabled>
                </div>   
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama. SPK</label>
                  <input type="text" class="form-control" name="document" value="{{ $spk->name}}" disabled>
                </div> 
                <div class="form-group">
                    <label for="exampleInputEmail1">Departement</label>
                    <input type="text" class="form-control" name="document" value="{{ $spk->tender->rab->budget_tahunan->budget->department->name or ''}}" disabled>
                </div>  
                <div class="form-group">
                  <label>Tanggal Mulai</label>
                  <input type="text" class="form-control" name="document" value="{{ $spk->start_date->format('d/M/Y')}}" disabled>
                </div> 
                <div class="form-group">
                  <label>Tanggal Selesai</label>
                  <input type="text" class="form-control" name="document" value="{{ $spk->finish_date->format('d/M/Y')}}" disabled>
                </div>   
                <div class="form-group">
                  <label>User PIC</label>
                  <input type="text" class="form-control" name="document" value="{{ $spk->user_pic->user_name or ''}}" disabled>
                </div> 
                <div class="form-group">
                  <a href="{{ url('/') }}/progress/" class="btn btn-warning">Kembali</a>
                </div>         
              </div>
              <div class="col-md-12">
                <center><h3>History Progress Lapangan</h3></center>
                <hr>
                <table class="table table-bordered">
                  <thead class="head_table">
                    <tr>
                      <td>Unit Name</td>                      
                      <td>Progress Saat Ini (%)</td>
                      <td>Tambah Progress</td>
                    </tr>                   

                  </thead>
                  <tbody>
                    <tr>
                      <td>Rata2</td>
                      <td>
                        @php $nilai=0; @endphp
                        @foreach ( $spk->tender->units as $key => $value )
                          @php $nilai = $nilai + ( $value->progress * count($spk->details) ); @endphp
                        @endforeach
                        {{ number_format($nilai / count($spk->tender->units) ,2) }} %
                      </td>
                      <td>&nbsp;</td>
                    </tr>
                    @foreach ( $spk->tender->units as $key => $value )
                   
                    <tr>
                      <td>{{ $value->rab_unit->asset->name }}</td>
                      <td>{{ number_format($value->progress * count($spk->details),2) }}</td>
                      <td><a class="btn btn-primary" href="{{ url('/')}}/progress/create?id={{ $value->id }}&spk={{ $spk->id }}">Tambah Progress</a></td>
                    </tr>
                   
                    @endforeach
                  </tbody>
                </table>
              </div>
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
@include("master/copyright")
  
<!-- Add the sidebar's background. This div must be placed
immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("progress::app")

</body>
</html>
