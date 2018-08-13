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
      <h1>Data Proyek <strong>{{ $budget->project->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12"><h3 class="box-title">Data Budget Tahunan</h3></div>
            <div class="col-md-6">             
              
              <form action="{{ url('/')}}/budget/cashflow/add-cashflow" method="post" name="form1">
              {{ csrf_field() }}
              <input type="hidden" name="budget_id" id="budget_id" value="{{ $budget->id }}">
              <div class="form-group">
                <label>No. Budget</label>
                <input type="text" class="form-control" value="{{ $budget->no }}" readonly>
              </div>
              <div class="form-group">
                <label>Nilai(Rp)</label>
                <input type="text" class="form-control" value="{{ number_format($budget->nilai) }}" readonly>
              </div> 
              <div class="form-group">
                <label>Tahun Anggaran</label>
                <select name="tahun_anggaran" class="form-control">
                  @for($i=2018; $i <= 2018; $i++ )
                  <option value="{{ $i }}">{{ $i }}</option>
                  @endfor
                </select>
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <input type="text" name="description" id="description" class="form-control">
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ url('/')}}/budget/proyek/" class="btn btn-warning">Kembali</a>
              </div>      
              </form>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-12">


              <table class="table" style="padding: 0" id="example3">
                <thead class="head_table">
                  <tr>
                    <td>No.</td>
                    <td>No. Budget</td>
                    <td>Nilai</td>
                    <td>Tahun</td>
                    <td>Detail</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $budget->budget_tahunans as $key => $value )
                  @php
                    $array = array (
                      "6" => array("label" => "Disetujui", "class" => "label label-success"),
                      "7" => array("label" => "Ditolak", "class" => "label label-danger"),
                      "1" => array("label" => "Dalam Proses", "class" => "label label-warning")
                    )
                  @endphp
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->no }}</td>
                    <td>{{ number_format($value->nilai )}}</td>
                    <td>{{ $value->tahun_anggaran}}</td>
                    <td>
                      @if ( $value->approval != "" )
                       <span class="{{ $array[$value->approval->approval_action_id]['class'] }}">{{ $array[$value->approval->approval_action_id]['label'] }}</span>
                      @else
                      <button class="btn btn-success" onclick="requestapprove('{{ $value->id }}')">Request Approve</button>
                      @endif
                      <a href="{{ url('/')}}/budget/cashflow/detail-cashflow?id={{ $value->id }}" class="btn btn-warning">Detail</a>
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
@include("budget::app")

</body>
</html>
