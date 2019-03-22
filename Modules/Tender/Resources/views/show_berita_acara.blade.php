<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{ url('/')}}/assets/plugins/timepicker/bootstrap-timepicker.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Tender</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
   
            <!-- /.box-header -->
            <div class="box-body">
              <form action="{{ url('/')}}/tender/berita_acara/update" method="post" name="form1" id="form1" enctype="multipart/form-data">
                <input type="hidden" name="berita_acara" value="{{ $berita_acara->id }}">
                {{ csrf_field() }}
                <h3 class="header">Berita Acara Klarifikasi {{ $berita_acara->step }}</h3> <br/>
                <div class="col-md-12">       	   
                  {{ csrf_field() }}                  
                  
                  <div class="form-group">
                    <label>Judul</label>
                    <input type="text" class="form-control" name="title" autocomplete="off" value="{{ $berita_acara->resume }}" required>
                  </div>       	
                  <div class="form-group">
                    <label>Content</label>
                    <textarea name="editor1" id="editor1" class="form-control" >{{ $berita_acara->content}}</textarea>
                  </div>
                  
                  <div class="form-group">                 
                    @if ( ($berita_acara->tender->approval != ""))
                    @if ( $berita_acara->tender->approval->approval_action_id == 7 ) 
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    @endif
                    @endif
                    <a href="{{ url('/')}}/tender/detail?id={{$berita_acara->tender->id}}" class="btn btn-warning">Kembali</a><br/>
                  </div>
                </div>
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
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
@include("tender::app")
<script type="text/javascript">
  $(function () {
    $(".select2").select2();
    $('.timepicker').timepicker({
      format: 'HH:mm'
    });
     CKEDITOR.replace( 'editor1' );
  });
</script>
</body>
</html>
