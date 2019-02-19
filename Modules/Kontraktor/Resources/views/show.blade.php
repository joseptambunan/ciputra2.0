<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | User Rekanan</title>
  @include("master/header")
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Rekanan Proyek <strong> {{ $project->name }}</strong></h1>

      <a href="{{ url('/')}}/kontraktor" class="btn btn-warning">Kembali</a>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">

              <h3 class="profile-username text-center">{{ $rekanan_group->name or '' }} </h3>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Contact Person</b>
                </li>
                <li class="list-group-item">
                  <b>Email</b>
                  {{ $email }}
                </li>
                <li class="list-group-item">
                  <b>Telepon</b>
                  {{ $telepon }}
                </li>
              </ul>
              Status : <span></span>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Perusahaan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i>NPWP</strong>
              <p class="text-muted">{{ $rekanan_group->npwp_no or '' }}</p>
              <hr>
              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                <p class="text-muted">
                  @if ( $rekanan_group->rekanans != "" )
                    {{ $rekanan_group->rekanans->first()->surat_alamat or '' }}
                  @endif
                </p>
              <hr>
              <strong><i class="fa fa-pencil margin-r-5"></i> Spesifikasi</strong>
              <p>
                @foreach ( $rekanan_group->spesifikasi as $key => $value )
                  <span class="label label-danger">UI Design</span>
                @endforeach
              </p>
              <hr>
              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
              <p>{{ $rekanan_group->description or ''}}</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Data Umum</a></li>
              <li><a href="#spec" data-toggle="tab">Spesifikasi</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <form action="{{ url('/')}}/kontraktor/update" method="post" name="form1" enctype="multipart/form-data">
                  <input type="hidden" name="rekanan_group_id" id="rekanan_group_id" value="{{ $rekanan_group->id }}">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label>Nama Perusahaan (*)</label>
                    <input type="text" class="form-control" name="nama_perusahaan" value="{{ $rekanan_group->name or '' }} " required>
                  </div>
                  <div class="form-group">
                    <label>Alamat Perusahaan (*)</label>
                    <textarea class="form-control" name="alamat_perusahaan" rows="5" cols="30" required>
                      @if ( $rekanan_group->rekanans != "" )
                        {{ $rekanan_group->rekanans->first()->surat_alamat or '' }}
                      @endif
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label>Telepon Perusahaan (*)</label>
                    <input type="text" class="form-control" name="telp_perusahaan" value="{{ $telepon }}" required>
                  </div>
                  <div class="form-group">
                    <label>Email Perusahaan (*)</label>
                    <input type="email" class="form-control" name="email_perusahaan" value="{{ $email }}" required>
                  </div>
                  <div class="form-group">
                    <label>Kota Perusahaan (*)</label>
                    <select class="form-control select2" name="kota">
                      @foreach( $country as $key => $value )
                        @foreach( $value->provinces as $key2 => $value2)
                          @foreach( $value2->cities as $key3 => $value3)
                            @if ( $value3->id == $project->city_id )
                              <option value="{{ $value3->id}}" selected>{{ $value3->name }}</option>
                            @else
                              <option value="{{ $value3->id}}">{{ $value3->name }}</option>
                            @endif
                          @endforeach
                        @endforeach
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Upload File NPWP (*)</label>                    
                    <input type="file" name="npwp" id="npwp">
                  </div>
                   <div class="form-group">
                    <label>Upload CV (*)</label>                    
                    <input type="file" name="cv" id="cv" required>
                  </div>
                  <div class="form-group">
                    <label>PKP Status</label>
                    @if ( $rekanan_group->rekanans->count() > 0 )
                      @if ( $rekanan_group->rekanans->first()->cv != "" )
                        <input type="checkbox" name="pkp" id="pkp" checked>
                      @else
                        <input type="checkbox" name="pkp" id="pkp">
                      @endif
                    @else
                      <input type="checkbox" name="pkp" id="pkp">
                    @endif
                  </div>
                  <div class="form-group">
                    <label>Keterangan Perusahaan</label>
                    <textarea class="form-control" name="description" rows="5" cols="30" required>{{ $rekanan_group->description or ''}}</textarea>
                  </div>
                  <div class="footer">
                    <button class="btn btn-info" type="submit">Simpan</button>
                  </div>
                </form>
                <span><i>(*) kolom harus diisi</i></span>
              </div>
              <!-- /.tab-pane -->
              <div class=" tab-pane table-responsive" id="spec">
                <table class="table table-bordered">
                  <thead class="head_table">
                    <tr>
                      <td></td>
                    </tr>
                  </thead>
                </table>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  
  @include("master/copyright")

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include("master/footer_table")

<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
</body>
</html>
