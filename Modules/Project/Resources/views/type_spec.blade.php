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
      <h1>Data Kategori</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
   
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-6">
                <h3 class="header">Tambah Gambar Type <strong>{{ $unit_type->name }}</strong></h3>
                  <input type="hidden" name="unit_type" value="{{ $unit_type->id }}">
                  <input type="hidden" name="project_id" value="{{ $project->id }}">
                  {{ csrf_field() }}
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nama Type</label>
                      <input type="text" class="form-control" name="nama" value="{{ $unit_type->name }}" disabled>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Luas Bangunan(m2)</label>
                      <input type="text" class="form-control" name="lb" id="lb" max="{{ $unit_type->luas_bangunan}}" onKeyup="luasbangunan();" value="{{ $unit_type->luas_bangunan}}" disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Luas Tanah(m2)</label>
                    <input type="hidden" class="form-control" name="lt" id="lt" value="{{ $unit_type->luas_tanah }}">
                    <input type="text" class="form-control" value="{{ $unit_type->luas_tanah }}" disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Listrik(watt) </label>  
                    <input type="text" class="form-control" value="{{ $unit_type->listrik or '' }}" disabled>
                  </div>
                 
                  <div class="box-footer">  
                    @if ( $unit_type->approval != "" )
                      @if ( $unit_type->approval->approval_action_id == 7 )                      
                      <button class="btn btn-success" data-toggle="modal" data-target="#modal-default" type="button">Upload Gambar</button>
                      @endif
                    @else
                      <button class="btn btn-success" data-toggle="modal" data-target="#modal-default" type="button">Upload Gambar</button>
                    @endif         
                    <a href="{{ url('/')}}/project/templatepekerjaan/?id={{ $unit_type->id }}" class="submitbtn btn btn-warning">Kembali</a>
                  </div>
              </div>
              <div class="col-md-12 table-responsive">
                <table class="table table-bordered">
                  <thead class="head_table">
                    <tr>
                      <td>Gambar</td>
                      <td>File</td>
                      <td>Actions</td>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ( $unit_type->specifications as $key => $value )
                    
                    @if ( $value->file != "" )
                      @php
                        $gambar = explode("/",$value->file);
                        $filename = explode("/",$value->file);
                        $icon = $gambar[3];
                        $download = $filename[3];
                      @endphp
                    @else
                      @php $icon = ""; $download = ""; @endphp
                    @endif
                    <tr>
                      <td>{{ $value->jenis_gambar->specification or '' }}</td>
                      <td><img src="{{ url('/')}}/storage/planning/{{ $unit_type->id }}/{{ $icon }}" style="width: 200px;"></td>
                      <td>
                        <a href="{{ url('/')}}/storage/planning/{{ $unit_type->id }}/{{ $download }}" target="_blank" class="btn btn-success">Download</a>
                        @if ( $unit_type->approval != "" )
                          @if ( $unit_type->approval->approval_action_id == 7 )                      
                            <button type="button" class="btn btn-danger" onclick="removeGambar('{{$value->id}}')">Delete</button>
                          @endif
                        @else
                          <button type="button" class="btn btn-danger" onclick="removeGambar('{{$value->id}}')">Delete</button>
                        @endif
                      </td>
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
  @include("master/copyright")
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Upload File</h4>
        </div>
        <div class="modal-body">
          <form action="{{ url('/')}}/project/spesifikasi-savetemplate" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="unit_type_id" value="{{ $unit_type->id}}">
            <div class="form-group">
              <label>Jenis Gambar</label>
              <select class="form-control" name="type_spec">
                @foreach ( $type_spec as $key => $value )
                <option value="{{ $value->id}}">{{ $value->specification }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>File</label>
              <input type="file" name="filename" id="filename" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
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

  $("#btn_submit").click(function(){
    $(".submitbtn").hide();
    $("#loading").show();
  });

  function settype(){
    $("#subtype").show();
    $(".sub").hide();
    $(".sub").removeAttr("selected");
    $("." + $("#master_tipe").val()).show();
    $("." + $("#master_tipe").val() + "_0").attr("selected","selected");
  }
</script>
</body>
</html>
