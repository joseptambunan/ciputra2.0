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
      <h1>Data Proyek <strong>{{ $budget_tahunan->budget->project->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12"><h3 class="box-title">Detail Data Budget Tahunan</h3></div>

   
            <!-- /.col -->
            <div class="col-md-12">
              <form action="{{ url('/')}}/budget/save-carryover" method="post" name="form1" id="form1">  
                {{ csrf_field() }}
                <input type="hidden" name="budget_id" id="budget_id" value="{{ $budget_tahunan->id }}">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ url('/')}}/budget/cashflow/detail-cashflow?id={{ $budget_tahunan->id}}" class="btn btn-warning">Kembali</a>
                <table class="table" id="example1">
                  <thead class="head_table">
                    <tr>
                      <td>COA Pekerjaan</td>
                      <td>Item Pekerjaan</td>
                      <td>No. SPK</td>
                      <td>Nama SPK</td>
                      <td>Nilai SPK</td>
                      <td>Terbayar</td>
                      <td>Sisa Terbayar</td>
                      <td>Set to Carry Over</td>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ( $array_spk_co as $key => $value )
                    <tr>
                      <td>{{ $value['coa'] }}</td>
                      <td>{{ $value['nama_pekerjaan']}}</td>
                      <td>{{ $value['no_spk']}}</td>
                      <td>{{ $value['nama_spk']}}</td>
                      <td style="text-align: right;">{{ number_format( $value['nilai_spk']) }}</td>
                      <td style="text-align: right;">{{ number_format( $value['terbayar']) }}</td>
                      <td style="text-align: right;">{{ number_format( $value['nilai_spk'] - $value['terbayar'])  }}</td>
                      <td><input type="checkbox" name="settospk[{{$key}}]" value="{{ $value['id_spk'] }}">set to carry_over</td>
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

</body>
</html>
