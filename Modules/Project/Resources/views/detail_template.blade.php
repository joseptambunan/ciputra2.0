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

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Proyek {{ $project->name }}</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
   
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-6">
                <h3 class="header">Edit Template Pekerjaan <strong>{{ $template->name }}</strong></h3>
            	   <form action="{{ url('/')}}/project/update-template" method="post" name="form1">
                  <input type="hidden" name="unit_type" value="{{ $template->unit_type_id }}">
                  <input type="hidden" name="template_id" value="{{ $template->id }}">
                  {{ csrf_field() }}                  
                  <div class="form-group">
                      <label for="exampleInputEmail1">Kode Template Pekerjaan</label>
                      <input type="text" class="form-control" name="code" value="{{ $template->code }}">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nama Template Pekerjaan</label>
                      <input type="text" class="form-control" name="nama" value="{{ $template->name }}">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Luas Bangunan(m2)</label>
                      <input type="text" class="form-control" name="lb" id="lb" max="{{ $template->luas_tanah}}" onKeyup="luasbangunan();" value="{{ $template->luasbangunan }}">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Luas Tanah(m2)</label>
                      <input type="hidden" class="form-control" name="lt" id="lt" value="{{ $template->luas_tanah }}">
                      <input type="text" class="form-control" value="{{ $template->luas_tanah }}" readonly>
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" id="submitbntn">Simpan</button>
                    <a class="btn btn-warning" href="{{ url('/')}}/project/templatepekerjaan/?id={{ $template->unit_type_id }}">Kembali</a>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
                      Tambah Item Pekerjaan
                    </button>
                  </div>
              	</form>
              </div>
              <div class="col-md-12">
              
            	<table id="example3" class="table table-bordered table-hover">
                <thead>
                <tr style="background-color: greenyellow;">
                  <th>Item Pekerjaan </th>
                  <th>Volume</th>
                  <th>Satuan</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ( $template->details as $key => $value )
                  <tr>
                    <td>{{ $value->itempekerjaan->name }}</td>
                    <td>{{ $value->volume }}</td>
                    <td>{{ $value->satuan }}</td>
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
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <form action="{{ url('/')}}/project/add-templatedetail" method="post" name="form1" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title">Item Pekerjaan</h4>
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Kode Template Pekerjaan</label>
            <select class="form-control" id="itemtemplate" name="idtemplate">
              <option value="">( pilih itempekerjaan )</option>
              @foreach ( $itempekerjaan as $key2 => $value2)
              @if ( $value2->group_cost == "2")
              <option value="{{ $value2->id }}">{{ $value2->name }}</option>
              @endif
              @endforeach
            </select>
          </div>
          <div class="form-group">
            
              {{ csrf_field()}}
            <input type="hidden" id="template_id" name="template_id" value="{{ $template->id }}">
            <table class="table">
              <tr>
                <td>Code</td>
                <td>Nama Pekerjaan</td>
                <td>Volume</td>
                <td>Satuan</td>
              </tr>
              <tbody id="table_item">
                
              </tbody>
            </table>
            
          </div>
        </div>
        <div class="modal-footer">
          
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("project::app")
<script type="text/javascript">
  function luasbangunan() {

    if ( parseInt($("#lb").val()) > parseInt($("#lt").val()) ) {
      $("#submitbntn").attr("disabled", true);
    }else if ( parseInt($("#lb").val()) <= parseInt($("#lt").val()) ){
      $("#submitbntn").removeAttr("disabled");
    }else if ( parseInt($("#lb").val() == "0" )){
      $("#submitbntn").attr("disabled", true);
    }
  }

  $("#itemtemplate").change(function(){
    var request = $.ajax({
      url : "{{ url('/')}}/project/itempekerjaan",
      dataType : "json",
      data : {
        id : $("#itemtemplate").val()
      },
      type : "post"
    });

    request.done(function(data){
      $("#table_item").html(data.html);
    })
  });
</script>
</body>
</html>
