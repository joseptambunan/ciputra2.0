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

              <h3 class="box-title">Tambah Data Tender</h3>           
              <form action="{{ url('/')}}/tender/save" method="post" name="form1">
                {{ csrf_field() }}
                <div class="form-group">
                  <label>No. RAB</label>
                  <select class="form-control select2" name="tender_rab">
                    <option value="">(pilih nama tender)</option>
                    @foreach ( $workorder as $key => $value )                      
                      @foreach ( $value->rabs as $key2 => $value2  )
                        @if ( $value2->tenders->count() == 0 )
                        <option value="{{ $value2->id }}">{{ $value2->no }} / {{ $value2->name }} {{ $value2->pekerjaans->last()->itempekerjaan->parent->code or '' }} - {{ $value2->pekerjaans->last()->itempekerjaan->parent->name or '' }}</option>
                        @endif
                      @endforeach
                    @endforeach
                  </select>
                </div>
                    
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
              
              <!-- /.form-group -->
            </div>

            </form>
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
@include("rab::app")
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
</body>
</html>
