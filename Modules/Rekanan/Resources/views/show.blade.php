<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar")

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
              <div class="col-md-6">
                <form action="{{ url('/')}}/rekanan/update" method="post" name="form1" id="form1" enctype="multipart/form-data">
                <input type="hidden" value="{{ $rekanan_group->id }}" name="rekanan_group_id">
                <input type="hidden" name="images" id="images" value="{{ $rekanan_group->npwp_image}}">
                <h3 class="header">Data Grup Rekanan</h3>            	   
                  {{ csrf_field() }}                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $rekanan_group->name or '' }}" autocomplete="off" >
                  </div>                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">NPWP</label>
                    <input value="{{ $rekanan_group->npwp_no or ''}}" type="text" name="npwp" id="npwp" class="form-control" autocomplete="off" data-inputmask='"mask":"99.999.999.9-999.999"' data-mask disabled>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" class="form-control" name="email" id="email" autocomplete="off" value="{{ $email or ''}}" required>
                  </div> 
                  <div class="form-group">
                    <label for="exampleInputEmail1">Alamat Koresponden</label>
                    <textarea class="form-control" rows="5" cols="30" name="alamat">{{ $rekanan_group->npwp_alamat}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Kota</label>
                    <select class="form-control select2" name="kota">
                      @foreach($city as $key => $value)
                        @if ( $rekanan_group->rekanans->count() > 0 )
                          @if ( $value->id == $rekanan_group->rekanans->first()->surat_kota )
                            <option value="{{ $value->id }}" selected>{{ $value->name }}</option>
                          @else
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                          @endif
                        @else
                          <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endif
                      @endforeach
                    </select>
                  </div> 
                  <div class="form-group">
                    <label>Kategori PPh Rekanan : {{ $rekanan_group->pph_percent}} %</label>
                    <select class="form-control" name="pph" id="pph">
                      <option value="2">Kecil (2%)</option>
                      <option value="3">Sedang (3%)</option>
                      <option value="3">Besar (3%)</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Sertifikat Rekanan</label>
                    <input type="file" name="sertifikat" id="sertifikat">
                  </div>
                  <div class="form-group">
                    <label>Status PKP</label>
                    @if ( $rekanan_group->coa_ppn == "1")
                    <input type="checkbox" name="pkp" id="pkp" checked>
                    @else
                    <input type="checkbox" name="pkp" id="pkp">
                    @endif
                  </div>
                  <div class="box-footer">
                  <i class="fa fa-refresh ld ld-spin" id="loading" style="display: none;"></i>
                    <button type="submit" class="btn btn-primary submitbtn" id="btn_submit_1">Simpan</button>
                    @if ( $rekanan_group->inactive_at == "")
                    <button type="button" class="btn btn-danger submitbtn" onclick="blacklist('{{ $rekanan_group->id}}','1')">Black List</button>
                    @else
                    <button type="button" class="btn btn-success" onclick="blacklist('{{ $rekanan_group->id}}','2')">Remove Black List</button>
                    @endif
                    <a href="{{ url('/')}}/rekanan/all" class="submitbtn btn btn-warning">Kembali</a>
                  </div> 
                </form>             	
              </div>
              <div class="col-md-6">
                <h3>Kontak</h3>
                <span>Nama Personal Tertera di Perjanjian : {{ $rekanan_group->cp_name or '---'}} </span><br>
                <span>Jabatan : {{ $rekanan_group->cp_jabatan or '---'}} </span><br>
                <br><br>
                <span>Nama Saksi : {{ $rekanan_group->saksi_name or '---'}} </span><br>
                <span>Jabatan : {{ $rekanan_group->saksi_jabatan or '---'}} </span><br>
                <br>
                <span>Sertifikat</span><br>
                <img src="{{ url('/')}}/assets/rekanan/{{ $rekanan_group->id }}/{{ $rekanan_group->npwp_image}}" style="width: 300px;border:1px solid black;" alt="no-images"><br><br><br>
                @if ( $rekanan_group->inactive_at == "")
                  <div class="alert alert-success alert-dismissible">
                    <h4><i class="icon fa fa-check"></i> Status!</h4>
                    Rekanan
                  </div>
                @else
                  <div class="alert alert-danger alert-dismissible">
                    <h4><i class="icon fa fa-check"></i> Status!</h4>
                    <strong>Black List</strong> at {{ $rekanan_group->inactive_at->format("d/m/Y") }}
                  </div>
                @endif
              </div>
              <div class="col-md-12">
                  <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" style="background-color: yellow;">Klasifikasi / Spesialis Pekerjaan</a></li>
                    <li><a href="#tab_2" data-toggle="tab" style="background-color: yellow;">Rekanan Detail</a></li>                   
                    <li><a href="#tab_3" data-toggle="tab" style="background-color: yellow;">Hak Akses</a></li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active table-responsive" id="tab_1">
                      <div class="col-md-6">
                      <center><h3><strong>Klasifikasi / Spesialis Pekerjaan</strong></h3></center>
                        <form action="{{ url('/')}}/rekanan/spesifikasi-add" method="post" name="form2" id="form2" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <input type="hidden" name="rekanan_group_id" value="{{ $rekanan_group->id}}">
                          <input type="hidden" name="iamges" value="{{ $rekanan_group->npwp_image}}">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Klasifikasi / Spesialis Pekerjaan</label>
                            <select class="form-control select2" name="itempekerjaan">
                              @foreach($itempekerjaan as $key => $value)
                              @if ( $value->group_cost == "1")
                                @if ( $value->parent_id == null )
                                  <option value="{{ $value->id }}">{{ $value->code }} / {{ $value->name }}</option>
                                @endif
                              @elseif ( $value->group_cost == "2")
                                @if ( $value->parent_id == null )
                                  <option value="{{ $value->id }}">{{ $value->code }} / {{ $value->name }}</option>   
                                @endif
                              @endif
                              @endforeach
                            </select>
                          </div> 
                          <div class="box-footer">
                              <button type="submit" class="btn btn-primary">Simpan</button>
                          </div> 
                        </form>
                      </div>

                      <table class="table table-bordered">
                        <thead class="head_table">
                          <tr>
                            <td>Klasifikasi / Spesialis Pekerjaan</td>
                            <td>Keterangan</td>
                            <td>Action</td>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ( $rekanan_group->spesifikasi as $key => $value )
                          <tr>
                            <td>{{ $value->itempekerjaan->code}} / {{ $value->itempekerjaan->name }}</td>
                            <td>{!! $value->description !!} </td>
                            <td><button class="btn btn-danger" onclick="deletespesifikasi('{{ $value->id }}')" id="delete_{{ $value->id}}">Delete</button></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane table-responsive" id="tab_2">
                      <table class="table table-bordered">
                        <thead class="head_table">
                          <tr>
                            <td>Nama</td>
                            <td>Alamat</td>
                            <td>Kode Pos</td>
                            <td>Telepon</td>
                            <td>Fax</td>
                            <td>Email</td>
                            <td>Nama Kontak Person</td>
                            <td>Jabatan</td>
                            <td>Nama Saksi</td>
                            <td>Jabatan</td>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ( $rekanan_group->rekanans as $key => $value )
                            <tr>
                              <td>{{ $value->name or ''}}</td>
                              <td>{{ $value->surat_alamat or ''}}</td>
                              <td>{{ $value->surat_kodepos or ''}}</td>
                              <td>{{ $value->telp or ''}}</td>
                              <td>{{ $value->fax or ''}}</td>
                              <td>{{ $value->email or ''}}</td>
                              <td>{{ $value->cp_name or ''}}</td>
                              <td>{{ $value->cp_jabatan or ''}}</td>
                              <td>{{ $value->saksi_name or ''}}</td>
                              <td>{{ $value->saksi_jabatan or ''}}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3">
                      @if ( $rekanan_group->user_rekanan != "" )
                      <form action="{{ url('/')}}/rekanan/user-update" method="post" name="form3" id="form3" enctype="multipart/form-data">
                        <input type="hidden" value="{{ $rekanan_group->id }}" name="rekanan_group_id">
                        <input type="hidden" value="{{ $rekanan_group->user_rekanan->id }}" name="user_rekanan_group_id">                        
                        <input type="hidden" class="form-control" name="email_2" id="email_2" value="{{ $email}}" autocomplete="off" required>
                        <h3 class="header">Data User Rekanan</h3>                
                          {{ csrf_field() }}                  
                          <div class="form-group">
                            <label for="exampleInputEmail1">User Login</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $rekanan_group->user_rekanan->user_login or '' }}" autocomplete="off" >
                          </div>                  
                          <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" name="password" id="password" class="form-control" autocomplete="off">
                          </div> 
                          
                          <div class="box-footer">
                          <i class="fa fa-refresh ld ld-spin" id="loading_2" style="display: none;"></i>
                            <button type="submit" class="btn btn-primary submitbtn" id="btn_submit_2">Simpan</button>
                          </div> 
                      </form> 
                      @else
                      <form action="{{ url('/')}}/rekanan/user-add" method="post" name="form4" id="form4" enctype="multipart/form-data">
                        <input type="hidden" value="{{ $rekanan_group->id }}" name="rekanan_group_id">
                        <input type="hidden" class="form-control" name="email_2" id="email_2" autocomplete="off" value="{{ $email }}" required>
                        <h3 class="header">Data User Rekanan</h3>                
                          {{ csrf_field() }}                  
                          <div class="form-group">
                            <label for="exampleInputEmail1">User Login</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $rekanan_group->user_rekanan->user_login or '' }}" autocomplete="off" >
                          </div>                  
                          <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" name="password" id="password" class="form-control" autocomplete="off">
                          </div> 
                          
                          <div class="box-footer">
                            <i class="fa fa-refresh ld ld-spin" id="loading_2" style="display: none;"></i>
                            <button type="submit" class="btn btn-primary submitbtn_2" id="btn_submit_2">Simpan</button>
                          </div> 
                      </form> 
                      @endif
                    </div>
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div>  
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
      </div>
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
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
@include("rekanan::app")
<script type="text/javascript">
  $("#btn_submit_1").click(function(){
     $(".submitbtn").hide();
      $("#loading").show();
  })

  $("#btn_submit_2").click(function(){
      $(".submitbtn_2").hide();
      $("#loading_2").show();
  });

  $("#email").keyup(function(){
    $("#email_2").val($("#email").val());
  });
</script>
</body>
</html>
