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
              <h3 class="box-title">Data Pekerjaan {{ $unit_detail->unit_progress->itempekerjaan->name or ''}}</h3>
              <h3>Progress : <strong>{{ number_format($unit_detail->progress_percent * 100)}} %</strong></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <a href="{{url('/')}}/progress/tambah?id={{$unit_detail->unit_progress->id}}" class="btn btn-warning">Kembali</a>
                <center><h3>Photo</h3></center>
                <hr>
                <table class="table table-bordered">
                  <thead class="head_table">
                    <tr>
                      <td>Item Pekerjaan</td>           
                    </tr>
                  </thead>
                 <tbody>
                    @foreach ( $unit_detail->pictures as $key2 => $value2 )                   
                    <tr>                                
                        <td><img src="{{ url('/')}}/assets/spk/{{ $unit_detail->unit_progress->unit->tender->spks->first()->id}}/progress/{{$value2->picture}}" style="width: 400px;" /></td>   
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
@include("master/copyright")
  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("progress::app")
<script type="text/javascript">
  $(".progress").number(true,2);
</script>
</body>
</html>
