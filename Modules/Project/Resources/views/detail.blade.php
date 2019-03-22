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

  @include("master/sidebar")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data PT <strong>{{ $pt->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">              
              <h3 class="box-title">Edit Data PT</h3>
              <form action="{{ url('/')}}/pt/update-pt" method="post" name="form1">
                <input type="hidden" class="form-control" name="ptid" value="{{ $pt->id }}">
                {{ csrf_field() }}
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="name" value="{{ $pt->name }}">
              </div>
              <div class="form-group">
                <label>Code</label>
                <input type="text" class="form-control" name="code" value="{{ $pt->code }}">
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" name="alamat" rows="3" >{{ $pt->address }}</textarea>
              </div>
              <div class="form-group">
                <label>Kota</label>
                <select class="form-control select2 " name="kota" id="kota">
                  @foreach($city as $key => $value )
                  @if ( $pt->city_id == $value->id )
                    <option value="{{ $value->id }}" selected>{{ $value->name}}</option>
                  @else
                    <option value="{{ $value->id }}">{{ $value->name}}</option>
                  @endif
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Telepon</label>
                <input type="text" class="form-control" name="telepon" value="{{ $pt->phone }}">
              </div>
              <div class="form-group">
                <label>NPWP</label>
                <input type="text" name="npwp" class="form-control" value="{{ $pt->npwp }}">
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="keterangan" rows="3">{{ $pt->description }}</textarea>
              </div>              
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ url('/')}}/pt" class="btn btn-info">Kembali</a>
              </div>
              </form>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-12">
              <div class="nav-tabs-custom">
                
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Rekening</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                      Tambah Rekening
                      </button><br>
                      <!-- nav-tabs-custom -->
                      <div class="col-md-12">
                          <table id="example3" class="table table-bordered table-hover">
                            <thead>
                            <tr style="background-color: greenyellow;">
                              <th>Bank </th>
                              <th>Nomor Rekening</th>
                              <th>Perubahan Data</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ( $pt->rekenings as $key => $value )
                            <tr>
                              <td>
                                <span class="labels" id="label_{{ $value->id}}">{{ $value->bank->name }}</span>
                                <select class="form-control" name="bank" id="bank_{{ $value->id }}" style="display: none">
                                  @foreach( $bank as $key3 => $value3)
                                  @if ( $value3->id == $value->bank_id )
                                  <option value="{{ $value3->id}}" selected>{{ $value3->name }}</option>
                                  @else
                                  <option value="{{ $value3->id}}">{{ $value3->name }}</option>
                                  @endif                                  
                                  @endforeach
                                </select>                       
                              </td>  
                              <td>
                                <span class="labels" id="label_rek_{{ $value->id}}">{{ $value->rekening }}</span>
                                <input type="text" id="rek_bang_{{ $value->id }}" style="display: none;" value="{{ $value->rekening}}" data-attribute="{{ $value->id }}" class="form-control col-xs-4">
                              </td>                  
                              <td>
                                <button class="btn btn-warning" id="btn_status_{{ $value->id }}" onclick="showedit('{{ $value->id}}');">Ubah</button>
                                <button class="btn btn-success" id="btn_save_{{ $value->id }}" onclick="saveEdit('{{ $value->id}}','{{ $value->name}}');" style="display: none;">Ubah</button>
                                <button href="#" onclick="deleteRek('{{ $value->id}}')" class="btn btn-danger">Hapus</button>
                              </td>
                            </tr>
                            @endforeach
                          </table>
                      </div>
                    <br><br>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                      <!-- /.form-group -->
                      <h2 class="page-header">Tambah Proyek</h2>
                      <form action="{{ url('/')}}/pt/add-proyek" method="post" name="form1">
                      {{ csrf_field() }}
                      <input type="hidden" class="form-control" name="pt_proyek" value="{{ $pt->id }}">
                      <div class="form-group">
                          <label for="exampleInputEmail1">Proyek</label>
                          
                      </div>
                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                      </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div>
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
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Rekening</h4>
        </div>
        <div class="modal-body">
          <form action="{{ url('/')}}/pt/add-rekening" method="post" name="form1">
            {{ csrf_field() }}
            <input type="hidden" name="pt_id" id="pt_id" value="{{ $pt->id }}">
            <div class="form-group">
                <label>Bank</label>
                <select class="form-control" name="bank">
                  @foreach( $bank as $key2 => $value2)
                  <option value="{{ $value2->id}}">{{ $value2->name }}</option>
                  @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Nomor Rekening</label>
                <input type="text" class="form-control" name="rekening">
            </div>  
            <div class="modal-footer">         
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
<!-- ./wrapper -->

@include("master/footer_table")
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script type="text/javascript">
  $(function () {
    $('.select2').select2();
  });
</script>
@include("pt::app")
</body>
</html>
