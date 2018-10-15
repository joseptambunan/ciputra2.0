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
      <h1>Data Escrow</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
   
            <!-- /.box-header -->
            <div class="box-body">

              <div class="col-md-6">
                <h3 class="header">Tambah Item Pekerjaan Escrow <strong>{{ $escrow->name }}</strong></h3>
                 <form action="{{ url('/')}}/escrow/update-itempekerjaan" method="post" name="form1">
                  <input type="hidden" name="escrow" value="{{ $escrow->id }}">
                  {{ csrf_field() }}                  
                  
                  <div class="form-group">
                      <label for="exampleInputEmail1">Item Pekerjaan</label>
                      <select class="form-control select2" name="itempekerjaan_id">
                        @foreach ( $itempekerjaan as $key => $value )
                          @if ( $value->group_cost == "2")
                            @php $explode = explode(".",$value->code); @endphp
                            @if ( count($explode) == "2"  && $value->escrow_id != $escrow->id )
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endif
                          @endif
                        @endforeach
                      </select>
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a class="btn btn-warning" href="{{ url('/')}}/escrow">Kembali</a>
                  </div>
                </form>
              </div>


              <div class="col-md-12">
            	<table id="example3" class="table table-bordered table-hover">
                <thead>
                <tr style="background-color: greenyellow;">
                  <th>Coa Pekerjaan</th>
                  <th>Nama Pekerjaan</th>
                  <th>Hapus</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ( $escrow->itempekerjaans as $key2 => $value2 )
                  <tr>
                    <td>{{ $value2->code }}</td>
                    <td>{{ $value2->name }}</td>
                    <td><button class="btn btn-danger" onClick="removeescrow('{{$value2->id }}')">Hapus</button></td>
                  </tr>
                  @endforeach
                </tbody>               
              </table>
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
@include("escrow::app")
</body>
</html>
