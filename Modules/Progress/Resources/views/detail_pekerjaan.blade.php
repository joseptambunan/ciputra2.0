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
              @if ( $unit_progress->mulai_jadwal_date != "" && $unit_progress->selesai_jadwal_date != "" )
              <form action="{{ url('/')}}/progress/saveprogress" method="post" name="form1" enctype="multipart/form-data">
                <input type="hidden" name="unit_progress_id" value="{{ $unit_progress->id}}">
                <div class="form-group">
                    <label for="exampleInputEmail1">Unit</label>
                    <input type="text" class="form-control" name="unit_name" value="{{ $unit_progress->unit->rab_unit->asset->name or '' }}" disabled>
                </div>   
                <div class="form-group">
                    <label for="exampleInputEmail1">Item Pekerjaan</label>
                    <input type="text" class="form-control" name="item_pekerjaan" value="{{ $unit_progress->itempekerjaan->name or '' }}" disabled>
                </div>  
                <div class="form-group">
                    <label for="exampleInputEmail1">Progress s/d saat ini </label>
                    <input type="text" class="form-control nilai_budget" name="percent" value="{{ $unit_progress->progresslapangan_percent * 100 }}" autocomplete="off"  required >
                </div>  
                <div class="form-group table-responsive">
                  <label>Photo</label>
                  <table style="width: 100%;">
                    <tr>
                      @for ( $i=0; $i < 5 ; $i++)
                      <td>Photo ke {{ $i + 1}}</td>
                      @endfor
                    </tr>
                    <tr>
                      @for ( $i=0; $i < 5 ; $i++)
                      <td>
                        @if ( $i == 0 )
                        <input type="file" name="file_images[{{$i}}]" id="file_images_{{$i}}" onChange="readUrl('{{$i}}');" required><br/>
                        @else
                        <input type="file" name="file_images[{{$i}}]" id="file_images_{{$i}}" onChange="readUrl('{{$i}}');"><br/>
                        @endif
                        <img name="prev_iamges[{{$i}}]" id="prev_iamges_{{$i}}" style="width:300px;" alt="no-img" />
                      </td>
                      @endfor
                    </tr>
                  </table>                  
                </div>
                <div class="form-group">
                  <label>Keterangan</label>
                  <textarea class="form-control" name="description"></textarea>
                </div>
                <div class="form-group">
                  <label>Persetujuan</label>
                  <input type="checkbox" name="rekana_setuju" id="rekana_setuju" onClick="rekana_setuju();">Rekanan Setuju
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary" id="submit" style="display: none;">Simpan</button>
                  <a href="{{ url('/') }}/progress/create?id={{$unit_progress->unit_id}}&spk={{ $unit_progress->unit->tender->spks->first()->id or '' }}" class="btn btn-warning">Kembali</a>
                </div>   
                {{ csrf_field() }}                   
                
              </form>
              @endif
              <h4>History Progress</h4>
              <table class="table table-bordered">
                <thead class="head_table">
                  <tr>
                    <td>Tanggal</td>
                    <td>Percent</td>
                    <td>Photo</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $unit_progress->details as $key => $value )
                  <tr>
                    <td>{{ date("d/M/Y",strtotime($value->progress_date))}}</td>
                    <td>{{ number_format($value->progress_percent * 100,2)}}</td>
                    <td><a href="{{ url('/')}}/progress/photo/?id={{$value->id}}" class="btn btn-info">Photo</a></td>
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
