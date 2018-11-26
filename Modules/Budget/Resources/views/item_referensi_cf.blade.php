<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard </title>
  @include("master/header")
  <!-- Select2 -->  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="{{ url('/')}}/assets/bower_components/select2/dist/css/select2.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Proyek <strong>{{ $project->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <h4><strong>{{ $itempekerjaan->code }} - {{ $itempekerjaan->name }} </strong></h4><hr>
              <a href="{{ url('/')}}/budget/cashflow/revisi-item?id={{ $itempekerjaan->parent->code }}&budget={{ $budget_tahunan->id}}" class="btn btn-warning">Kembali</a>
            </div>

            <div class="col-md-6">             
              <div class="form-group table-responsive">
                <table class="table table-bordered">
                  <thead class="head_table">
                    <tr>
                      <td>Data Pusat</td>
                      <td>Terendah</td>
                      <td>Tertinggi</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Rp. {{ number_format($itempekerjaan->nilai_master_satuan) }} / {{ $itempekerjaan->details->satuan or  '' }}</td>
                      <td>
                       <span> Rp. {{number_format($itempekerjaan->nilai_lowest_library["nilai"],2)}} / {{ $itempekerjaan->details->satuan or  '' }}</span><br>
                       <span>Proyek : {{ $itempekerjaan->nilai_lowest_library["project_id"] }}</span>
                      </td>
                      <td>
                        <span>Rp. {{number_format($itempekerjaan->nilai_max_library["nilai"],2)}} / {{ $itempekerjaan->details->satuan or  '' }}</span><br>
                        <span>Proyek : {{ $itempekerjaan->nilai_lowest_library["project_id"] }}</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
   
            <!-- /.col -->
            <div class="col-md-12">
              {{ csrf_field() }}
              <input type="hidden" name="budget_id" id="budget_id" value="{{ $budget_tahunan->id }}">
              <table class="table">
                <thead class="head_table">
                  <tr>
                    <td>Harga Satuan</td>
                    <td>Proyek</td>
                    <td>Gunakan</td>
                  </tr>
                </thead>
                <tbody id="itemlist">
                  @foreach ( $itempekerjaan->harga as $key => $value )
                  <tr>
                    <td>{{ number_format($value->nilai,2) }}</td>
                    <td>{{ $value->project->name or '' }}</td>
                    <td><input type="radio" onclick="setnilai('{{ $value->nilai}}')">Set sebagai Budget</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              </form>
            </div>
            <!-- /.col -->
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

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("budget::app")
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  function setnilai(nilai){
    $("#nilai").val(nilai);
  }
</script>
</script>
</body>
</html>
