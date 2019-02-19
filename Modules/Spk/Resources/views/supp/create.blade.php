<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard</title>
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
      <h1>Data Rekanan</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
   
            <!-- /.box-header -->
            <div class="box-body">
              <form action="{{ url('/')}}/spk/supp/store" method="post" name="form1">
              <input type="hidden" name="spk_id" value="{{ $spk->id}}">
              <div class="col-md-6">
                <h3 class="header">Data Rekanan</h3>
                  {{ csrf_field() }}                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Rekanan</label>
                    <input type="hidden" name="rekanan_id" value="{{ $spk->rekanan->group->id }}">
                    <input type="text" class="form-control" name="cp_name" value="{{ $spk->rekanan->group->name }}" autocomplete="off" disabled>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nama Wakil Rekanan</label>
                      <input type="hidden" class="form-control" name="cp_jabatan" value="{{ $spk->rekanan->group->cp_name }}" autocomplete="off" required>
                      <span>{{ $spk->rekanan->group->cp_name }}</span>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nama Wakil Rekanan 2</label>
                      <input type="hidden" class="form-control" name="cp_saksi" value="{{ $spk->rekanan->group->saksi_name }}" autocomplete="off" required>
                      <span>{{ $spk->rekanan->group->saksi_name }}</span>
                  </div>
                  <div class="box-footer">
                    <i class="fa fa-refresh ld ld-spin" id="loading" style="display: none;"></i>
                    @if ($spk->rekanan->group->cp_name != "")
                      <button type="submit" class="btn btn-primary" id="btn_submit">Simpan</button>
                    @else
                      <h4>Rekanan ini belum memiliki data wakil / saksi.</h4>
                    @endif
                    @if ( $spk->rekanan->supps->count() > 0 )
                    <a href="" class="btn btn-success">Download SUPP No. {{ $spk->rekanan->supps->last()->no or  ''}}</a>
                    @endif
                    <a href="{{ url('/')}}/spk/detail/?id={{$spk->id}}" class="btn btn-warning">Kembali</a>
                  </div>
                
              </div>
              <div class="col-md-6">
                <h3 class="header">Data Proyek</h3>                                
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama PT Proyek</label>
                    <input type="hidden" name="pt_id" value="{{ $spk->tender->rab->budget_tahunan->budget->pt->id or '' }}">
                    <input type="text" class="form-control" name="cp_name" value="{{ $spk->tender->rab->budget_tahunan->budget->pt->name or '' }} " autocomplete="off" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Wakil PT Proyek</label>  
                    <select class="form-control select2" name="penandatangan" required>
                      @foreach($spk->tender->rab->budget_tahunan->budget->pt->users as $key => $value )
                      <option value="{{ $value->id }}">{{ $value->user_name }}</option>
                      @endforeach
                    </select>                    
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Saksi Wakil PT Proyek</label>  
                    <select class="form-control select2" name="saksi" required>
                      @foreach($spk->tender->rab->budget_tahunan->budget->pt->users as $key => $value )
                        @foreach ( $value->jabatan as $key4 => $value4 )
                          @if ( $value4['pt_id'] == $spk->tender->rab->budget_tahunan->budget->pt->id )
                            @if ( $value4['level'] > 4 )
                              <option value="{{ $value->id }}">{{ $value->user_name }}</option>
                            @endif
                          @endif
                        @endforeach
                      @endforeach
                    </select>                    
                  </div>
              </div>
              </form>

            </div>

          </div>
          <!-- /.box-body -->
        </div>
      <!-- /.box -->
      </div>
      <!-- /.col -->
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
@include("spk::supp.app")
</body>
</html>
