<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  @include("master/header")
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar")
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Negara <strong>{{ $country->name }}</strong></h1>
    
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Provinsi</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Kota</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                      <!-- nav-tabs-custom -->
                      <h2 class="page-header">Tambah Provinsi</h2>
                      <form action="{{ url('/')}}/country/add-province" method="post" name="form1">
                      {{ csrf_field() }}
                      <input type="hidden" class="form-control" name="country" value="{{ $country->id }}">
                      <div class="form-group">
                          <label for="exampleInputEmail1">Provinsi</label>
                          <input type="text" class="form-control" name="province" autocomplete="off">
                      </div>
                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                      </form><br><br>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                      <!-- /.form-group -->
                      <h2 class="page-header">Tambah Kota</h2>
                      <form action="{{ url('/')}}/country/add-city" method="post" name="form1">
                      {{ csrf_field() }}
                      <input type="hidden" class="form-control" name="country" value="{{ $country->id }}">
                      <div class="form-group">
                          <label for="exampleInputEmail1">Provinsi</label>
                          <select class="form-control" name="province">
                              @foreach ( $country->provinces as $key => $value )
                              <option value="{{ $value->id }}">{{ $value->name }}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputEmail1">Kota</label>
                          <input type="text" class="form-control" name="city" autocomplete="off">
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
            <div class="col-md-12">
              <br>
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr style="background-color: greenyellow;">
                  <th>Provinsi</th>
                  <th>Perubahan Data</th>
                </tr>
                </thead>
                <tbody>
                @foreach ( $country->provinces as $key => $value )
                  <tr>
                    <td onclick="showhide('{{ $value->id }}')" id='btn_{{ $value->id }}' data-status='1'>
                      <span class="labels" id="label_prov_{{ $value->id }}"><h3>{{ $value->name }}</h3></span>
                      <input type="text" id="province_{{ $value->id}}" style="display: none" class="form-control col-xs-4" value="{{ $value->name}}" data-attribute="{{ $value->id }}">
                    </td>
                    <td>
                      <button class="btn-sm btn-warning" id="btn_provubah_{{ $value->id }}" onclick="updateProvince('{{ $value->id }}')">Ubah</button>
                      <button class="btn-sm btn-success" id="btn_provedit_{{ $value->id }}" onclick="updProvince('{{ $value->id }}','{{ $value->name }}')" style="display: none;">Ubah</button>
                      <button class="btn-sm btn-danger" onclick="deleteProvince('{{ $value->id }}','{{ $value->name }}')">Hapus</button>
                    </td>
                  </tr>
                  @foreach ( $value->cities as $key2 => $value2 )
                  <tr>
                    <td>
                      <span class="labels" id="label_{{ $value2->id }}">&nbsp;&nbsp;{{ $value2->name }}</span>
                      <input type="text" id="city_{{ $value2->id}}" style="display: none" class="form-control col-xs-4" value="{{ $value2->name}}" data-attribute="{{ $value2->id }}">
                    </td>
                    <td>
                      <button class="btn-sm btn-warning" id="btn_ubah_{{ $value2->id }}" onclick="updateCity('{{ $value2->id }}')">Ubah</button>
                      <button class="btn-sm btn-success" id="btn_edit_{{ $value2->id }}" onclick="updCitie('{{ $value2->id }}','{{ $value2->name }}')" style="display: none;">Ubah</button>
                      <button class="btn-sm btn-danger" onclick="deleteCity('{{ $value2->id }}','{{ $value2->name }}')">Hapus</button>
                    </td>
                  </tr>
                  @endforeach
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.col -->
            
          </div>
          <!-- /.row -->
        </div>
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
@include("country::app")
</body>
</html>
