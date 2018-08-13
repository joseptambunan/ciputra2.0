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
              <div class="col-md-6">
                {{ csrf_field() }}                  
                <div class="form-group">
                    <label for="exampleInputEmail1">No. SPK</label>
                    <input type="text" class="form-control" name="document" value="{{ $spk->no}}" readonly>
                </div>   
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama. SPK</label>
                    <input type="text" class="form-control" name="document" value="{{ $spk->name}}" readonly>
                </div>      
                <div class="form-group">
                  <a href="{{ url('/')}}/progress/create?id={{$spk->id}}" class="btn btn-primary">Buat Progress</a>
                  <a href="{{ url('/') }}/progress/" class="btn btn-warning">Kembali</a>
                </div>         
              </div>
              <div class="col-md-12">
                <center><h3>History Progress Lapangan</h3></center>
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
                    <tr style="background-color: grey;color:white;font-weight: bolder;">
                      <td>
                        Termin : {{ $value->termin }}
                        @php $total_termin = 0 ; @endphp
                        @foreach ( $spk->tender_rekanan->menangs->first()->details as $key8 => $value8 )
                        @php 
                          $itempekerjaan = \Modules\Pekerjaan\Entities\Itempekerjaan::find($value8->itempekerjaan_id);
                          $unitprogress  = \Modules\Project\Entities\UnitProgress::where("itempekerjaan_id",$itempekerjaan->id)->where("unit_id",$spk->tender_rekanan->menangs->first()->id)->get()->first();
                        @endphp
                          @foreach ( \Modules\Project\Entities\UnitProgressDetail::where("termyn",$value->termin)->where("unit_progress_id",$unitprogress->id)->get() as $key5 => $value5 )
                            @php $total_termin = $total_termin +  $value5->progress_percent; @endphp
                          @endforeach
                        @endforeach

                        @if ( $value->status == "1")
                          @if ( $total_termin > $value->progress)
                          <button class="btn btn-warning" onClick="updateProgress('{{$spk->id}}','{{ $value->id}}','{{ $value->termin}}')">Set Termin {{ $value->termin }} Selesai</button>
                          @endif
                        @endif

                      </td>
                      <td colspan="{{ ($minggu)}}"></td>
                    </tr>
                    @foreach ( $spk->tender_rekanan->menangs->first()->details as $key2 => $value2 )
                      @php 
                      $itempekerjaan = \Modules\Pekerjaan\Entities\Itempekerjaan::find($value2->itempekerjaan_id);
                      $unitprogress  = \Modules\Project\Entities\UnitProgress::where("itempekerjaan_id",$itempekerjaan->id)->where("unit_id",$spk->tender_rekanan->menangs->first()->id)->get()->first();
                      @endphp
                      <tr>
                        <td>{{ $itempekerjaan->name }}</td>
                        @foreach ( \Modules\Project\Entities\UnitProgressDetail::where("termyn",$value->termin)->where("unit_progress_id",$unitprogress->id)->get() as $key4 => $value4 )
                        <td>{{ $value4->progress_percent }} </td>
                        @endforeach
                      </tr>
                    @endforeach
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
@include("progress::app")
<script type="text/javascript">
  function updateProgress(spk_id,termin_id,termin) {
    if ( confirm("Apakah anda yakin ingin menyelesaikan termin ini ?")){
      var request = $.ajax({
        url : "{{ url('/')}}/progress/updatetermyn",
        dataType : "json",
        data : {
          spk_id : spk_id,
          termin : termin,
          termin_id : termin_id
        },
        type : "post"
      });

      request.done(function(data){
        if ( data.status == "0"){
          alert("Data telah diupdate");
        }
        
      })
    }else{
      return false;
    }
  }
</script>
</body>
</html>
