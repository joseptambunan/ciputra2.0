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
            <div class="col-md-12"><h3 class="box-title">Detail Data HPP</h3></div>
   
            <!-- /.col -->
            <div class="col-md-12   table-responsive">

                <div class="form-group">                  
                  <a class="btn btn-warning" href="{{ url('/')}}/report/project/detail/?id={{ $project->id }}">Kembali</a>
                </div>
                {{ csrf_field() }}
                <table class="table">
                  <thead class="head_table">
                    <tr>
                      <td>Tanggal</td>
                      <td>Budget</td>
                      <td>Luas EREM(m2)</td>
                      <td>Luas Book(m2)</td>
                      <td>Luas Netto(m2)</td>
                      <td>HPP(Rp/m2)</td>
                    </tr>
                  </thead>
                  <tbody id="itemlist">
                    @foreach ( $project->hpp_update as $key => $value )                    
                    <tr>
                      <td>{{ $value->updated_at->format('d/m/Y') }}</td>
                      <td>{{ number_format($value->nilai_budget) }}</td>
                      <td>{{ number_format($value->luas_erem) }}</td>
                      <td>{{ number_format($value->luas_book) }}</td>
                      <td>{{ number_format($value->netto) }}</td>
                      <td>
                        @if ( $value->netto <= 0 )
                        {{ number_format(0,2)}}
                        @else
                        {{ number_format($value->nilai_budget / $value->netto,2) }}
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>

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
@include("pt::app")
<!-- Select2 -->

</body>
</html>
