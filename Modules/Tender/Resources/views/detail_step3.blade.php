<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard </title>
  @include("master/header")
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('/')}}/assets/bower_components/select2/dist/css/select2.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Item Pekerjaan <strong>{{ $itempekerjaan->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <a href="{{ url('/')}}/tender/detail/?id={{ $tender->id }}" class="btn btn-warning">Kembali</a>

              <form action="{{ url('/')}}/tender/penawaran-save2" method="post" name="form1" enctype="multipart/form-data">
              <button type="submit" class="btn btn-primary">Simpan</button>
                <input type="hidden" name="tender_id" value="{{ $tender->id }}">
                {{ csrf_field() }}
                <table class="table table-bordered">
                  <thead class="head_table">
                   <tr>
                    <td>COA Pekerjaan</td>
                    <td>Item Pekerjaan</td>
                    <td>Volume</td>
                    <td>Satuan</td>
                    <td>Nilai</td>
                   </tr>
                  </thead>
                  <tbody>
                    @php $start=0; @endphp
                    @foreach( $tender->rab->pekerjaans as $key => $value )
                    <tr>
                      <td>{{ $value->itempekerjaan->code }}</td>
                      <td>{{ $value->itempekerjaan->name }}</td>
                      <td><input type="hidden" name="input_rab_id_[{{ $key}}]" class="form-control" value="{{ $value->id }}"><input  type="text" name="input_rab_volume_[{{ $key}}]" id="input_rab_volume_{{ $key}}" class="form-control" value="{{ $value->volume }}" style="width: 100%;"></td>
                      <td>
                        <input  type="hidden" name="input_rab_satuan_[{{ $key}}]"  id="input_rab_satuan_{{ $key}}" class="form-control" value="{{ $value->satuan }}" style="width: 100%;">
                        <input  type="text" class="form-control" value="{{ $value->satuan }}" style="width: 100%;" readonly>
                      </td>
                      <td><input type="text" name="input_rab_nilai_[{{ $key}}]"  id="input_rab_nilai_{{ $key}}" class="form-control vol" onKeyUp="showSummary('{{ $key}}')" readonly></td>
                    </tr>
                    @php $start = $key; @endphp
                    @endforeach
                  </tbody>
                </table>
              </form>
            </div>              
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  @include("master/copyright")
</div>
<!-- ./wrapper -->

@include("master/footer_table")
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/jquery.number.min.js"></script>
<script type="text/javascript">
  $(".vol").number(true);
</script>
@include("pekerjaan::app")
</body>
</html>
