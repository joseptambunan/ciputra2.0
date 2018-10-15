<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | SIK</title>
   @include("master/header")

  <link rel="stylesheet" href="{{ url('/')}}/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <section class="content-header">
      <h1>Data Surat Instruksi</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                <small></small>
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
              <form action="{{ url('/')}}/spk/sik-update" method="post" name="form1">
                {{ csrf_field() }}
                <input type="hidden" name="sik_id" id="sik_id"  value="{{ $suratinstruksi->id }}">

                <div class="form-group">
                  <label>No. SPK</label>
                  <input type="text" class="form-control" value="{{ $suratinstruksi->spk->no }}" disabled>
                </div>

                <div class="form-group">
                  <label>Perihal</label>
                  <input type="text" class="form-control" name="perihal" autocomplete="off" value="{{ $suratinstruksi->perihal }}">
                </div>

                <div class="form-group">
                  <textarea class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="content">{!! $suratinstruksi->content !!}</textarea>
                </div>

                <div class="form-group">
                  <button class="btn btn-primary" type="submit">Simpan</button>
                  <a href="{{ url('/')}}/spk/detail?id={{ $suratinstruksi->spk->id }}" class="btn btn-warning">Kembali</a>
                  
                </div>
              </form>
            </div>

            <div class="box-body pad">
              <h3><center>Unit</center></h3>
              <table class="table table-bordered">
                <thead class="head_table">
                  <tr>
                    <td>Unit</td>
                    <td>Pekerjaan</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $suratinstruksi->spk->details as $key => $value )
                  <tr>
                    <td>{{ $value->asset->name }}</td>
                    <td><a href="{{ url('/')}}/spk/sik-unit?id={{ $value->id }}&sik={{ $suratinstruksi->id }}" class="btn btn-primary">Tambah VO</a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            @if ( count($suratinstruksi->vos) > 0 )
            <div class="box-body pad">
              <h3><center>Variation Order</center></h3>
              <table class="table table-bordered">
                <thead class="head_table">
                  <tr>
                    <td>Unit</td>
                    <td>Pekerjaan</td>
                    <td>Volume</td>
                    <td>Satuan</td>
                    <td>Nilai</td>
                    <td>Delete</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $suratinstruksi->vos as $key9 => $value9 )
                    @foreach ( $value9->details as $key10 => $value10 )
                    <tr>
                      <td>{{ $value10->spk_detail->asset->name }}</td>
                      <td>{{ $value10->unit_progress->itempekerjaan->name }}</td>
                      <td>{{ number_format($value10->unit_progress->volume,2) }}</td>
                      <td>{{ $value10->unit_progress->satuan }}</td>
                      <td>{{ number_format($value10->unit_progress->nilai,2) }}</td>
                      <td><button class="btn btn-danger" onclick="removeVo('{{ $value10->id }}')">Hapus</button></td>
                    </tr>
                    @endforeach
                  @endforeach
                </tbody>
              </table>
            </div>
            @endif

          </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
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
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })

  function removeVo(id){
    if ( confirm("Apakah anda yakin ingin menghapus VO ini ?")){
      var request = $.ajax({
        url : "{{ url('/')}}/spk/delete-vo",
        data : {
          id : id
        },
        type : "post",
        dataType : "json"
      });

      request.done(function(data){
        if ( data.status == "0"){
          alert("Data VO telah dihapus");
        }

        window.location.reload();
      })
    }else{
      return false;
    }
  }
</script>
</body>
</html>
