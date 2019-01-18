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
            <div class="col-md-6">              
              <h3 class="box-title">Tambah Data Budget Proyek</h3>
              <form action="/budget/save-budgetrevisi" method="post" name="form1">
                {{ csrf_field() }}
              <input type="hidden" name="project_id" value="{{ $project->id }}">
              <input type="hidden" name="budget_id" value="{{ $budget->id }}">
              <div class="form-group">
                <label>Budget Awal(Rp)</label>
                <input type="text" class="form-control" value="{{ $budget->no }}" readonly>
              </div>
              <div class="form-group">
                <label>Budget Nilai(Rp)</label>
                <input type="text" class="form-control" value="{{ number_format($budget->nilai) }}" readonly>
              </div>
              <div class="form-group">
                <label>Project</label>
                <input type="text" class="form-control" value="{{ $project->name }}" readonly>
              </div>
              <div class="form-group">
                <label>PT</label>
                <select class="form-control" name="pt_id" readonly>
                  @foreach ( $project->pt_user as $key => $value )
                    @if ( $value->pt->id == $budget->pt_id )
                      <option value="{{ $value->id }}" selected>{{ $value->pt->name }}</option>
                    @else
                      <option value="{{ $value->id }}">{{ $value->pt->name }}</option>
                    @endif
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Department</label>
                <select class="form-control" name="department" readonly>
                  @foreach ( $project->pt_user as $key => $value )
                    @foreach ( $value->pt->mapping as $key2 => $value2 )
                      @if ( $value2->department->id == $budget->department_id )
                      <option value="{{ $value2->department->id }}" selected>{{ $value2->department->name }}</option>
                      @else
                      <option value="{{ $value2->department->id }}">{{ $value2->department->name }}</option>
                      @endif
                    @endforeach
                  @endforeach
                </select>
              </div>
              
              <div class="form-group">
                <label>Start Date</label>
                <input type="text" class="form-control" name="start_date" id="start_date" value="{{ $budget->start_date->format('d/m/Y') }}" readonly>
              </div>
              <div class="form-group">
                <label>End Date</label>
                <input type="text" class="form-control" name="end_date" id="end_date" value="{{ $budget->end_date->format('d/m/Y') }}" readonly>
              </div>
              <div class="form-group">
                <label>Keterangan Date</label>
                <input type="text" class="form-control" name="description" autocomplete="off">
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
              </form>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-12">
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
@include("pt::app")
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  $(function () {
    $("#luas").number(true);
    $("#luas_brutto").number(true);
    $("#luas_netto").number(true);
    $('#start_date').datepicker({
      "dateFormat" : "yy-mm-dd"
    });

     $('#end_date').datepicker({
      "dateFormat" : "yy-mm-dd"
    });
  });

  function setkawasan(){
    if ( $("#iskawasan").is(":checked")){
      $("#kawasan").show();
    }else{
      $("#kawasan").hide();
    }
  }
</script>
</body>
</html>
