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
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <a href="{{ url('/') }}/progress/show?id={{ $spk->id}}" class="btn btn-warning">Kembali</a>
                </div>   
                {{ csrf_field() }}   

                
                <input type="hidden" class="form-control" name="spk_id" value="{{ $spk->id}}">
                <input type="hidden" class="form-control" name="termin_ke" value="{{ $termin_ke}}">
                <div class="col-md-12">
                <center><h3>Tambah</h3></center>
                <hr>
                <table class="table table-bordered">
                  <thead class="head_table">
                    <tr>
                      <td>Item Pekerjaan</td>      
                      <td>Progress Lapangan</td>        
                    </tr>
                  </thead>
                 <tbody>
                    @foreach ( $spk->detail_units as $key2 => $value2 )
                   
                    <tr>                                
                        <td>{{ $value2->unit_progress->itempekerjaan->name }}</td>    
                        <td>
                          <input type="hidden" class="form-control" value="{{ $value2->unit_progress_id}}" name="unit_progress_id[{{$key2}}]"><input type="text" class="form-control progress" name="progress_percentage[{{$key2}}]" ></td>                                      
                    </tr>   
                    
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
