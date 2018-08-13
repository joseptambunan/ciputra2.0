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
              <h3 class="box-title">Data SPK </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="{{ url('/')}}/progress/saveprogress" method="post" name="form1">
                <div class="form-group">
                    <label for="exampleInputEmail1">No. SPK</label>
                    <input type="text" class="form-control" name="document" value="{{ $spk->no}}" readonly>
                </div>   
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama. SPK</label>
                    <input type="text" class="form-control" name="document" value="{{ $spk->name}}" readonly>
                </div>  
                <div class="form-group">
                    <label for="exampleInputEmail1">Termin Ke </label>
                    <input type="text" class="form-control" value="{{ $termin_ke}}" readonly>
                </div>  
                <div class="form-group">
                    <label for="exampleInputEmail1">Minggu Ke </label>
                    <input type="text" class="form-control" value="{{ $spk->details->first()->details_with_vo->last()->unit_progress->details->last()->week + 1 }}" readonly>
                </div>      
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Buat Progress</button>
                  <a href="{{ url('/') }}/progress/show?id={{ $spk->id}}" class="btn btn-warning">Kembali</a>
                </div>   
                {{ csrf_field() }}                  
                <input type="hidden" class="form-control" name="spk_id" value="{{ $spk->id}}">
                <input type="hidden" class="form-control" name="termin_ke" value="{{ $termin_ke}}">
                <input type="hidden" class="form-control" name="week" value="{{ $spk->details->first()->details_with_vo->last()->unit_progress->details->last()->week }}">
                <div class="col-md-12">
                <center><h3>Tambah</h3></center>
                <hr>
                <table class="table table-bordered">
                  <thead class="head_table">
                    <tr>
                      <td>Item Pekerjaan</td>                      
                      @for ( $i=1; $i <= $minggu; $i++)
                      <td>Minggu {{ $i }}</td>
                      @endfor
                    </tr>
                  </thead>
                  <tbody>                    
                    @foreach ( $spk->termyn as $key => $value )
                    @if ( $value->status == "1")
                      <tr style="background-color: grey;color:white;font-weight: bolder;">
                        <td>Termin : {{ $value->termin }}</td>
                        <td colspan="{{ ($minggu)}}"></td>
                      </tr>
                      @foreach ( $spk->tender_rekanan->menangs->first()->details as $key2 => $value2 )
                        @php 
                        $itempekerjaan = \Modules\Pekerjaan\Entities\Itempekerjaan::find($value2->itempekerjaan_id);
                        @endphp
                        <tr>
                          <td>{{ $itempekerjaan->name }}</td>
                          @php $start = 0 ; @endphp                         
                          @for ( $i=1; $i <= $minggu; $i++)
                          <td>
                            @if ( $i <= $spk->details->last()->details_with_vo->last()->unit_progress->details->first()->week )
                            <span></span>
                            @else
                            <input type="text" name="progress_minggu_[{{ $itempekerjaan->id }}][{{$start}}]" class="progress form-control" style="width:100%;">
                            @php $start++; @endphp
                            @endif
                          </td>
                            
                          @endfor
                        </tr>
                      @endforeach
                    @endif
                    @endforeach
                  </tbody>
                </table>
                <label>Keterangan</label>
                <textarea name="description" rows="3" class="form-control"></textarea>
              </form>
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
@include("spk::app")
<script type="text/javascript">
  $(".progress").number(true,2);
</script>
</body>
</html>
