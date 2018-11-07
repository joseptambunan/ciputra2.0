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
      <h1>Data Proyek <strong>{{ $project->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <a href="{{ url('/')}}/project/add-type?id={{ $project->id }}" class="btn-lg btn-primary"><i class="glyphicon glyphicon-plus-sign"></i>Tambah Type</a><br><br>
              <table id="example2" class="table table-bordered table-hover">   
              {{ csrf_field() }}              
              <thead class="head_table">
                <tr>
                  <td>No.</td>
                  <td>Kode Type</td>
                  <td>Nama Type</td>
                  <td>Kategori</td>
                  <td>Luas Bangunan(m2)</td>
                  <td>Luas Tanah(m2)</td>
                  <td>Elektrik(watt)</td>
                  <td>Detail</td>
                  <td colspan="2">Perubahan Data</td>
                </tr>
              </thead>
                <tbody>
                 @foreach ( $type as $key => $value )
                
                 <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                      <span id="label_{{ $value->id }}">{{ $value->kode }}</span>
                      <input type="text" name="input_kode{{ $value->id }}" id="input_kode{{ $value->id }}" style="display: none;" value="{{ $value->kode }}">
                    </td>
                    <td>
                      <span id="label_{{ $value->id }}">{{ $value->name }}</span><br>                      
                      Kategori : <strong>{{ $value->category->category_project->category_detail->category->name or '-'}} {{ $value->category->category_project->category_detail->sub_type or '-'}}</strong><br>
                      <input type="text" name="input_{{ $value->id }}" id="input_{{ $value->id }}" style="display: none;" value="{{ $value->name }}">
                    </td>
                    <td>
                      <span id="luas_{{ $value->id }}">{{ $value->luas_bangunan }}</span>
                      <input type="text" name="input_luas_{{ $value->id }}" id="input_luas_{{ $value->id }}" style="display: none;" value="{{ $value->luas_bangunan }}">
                    </td>
                    <td>
                      <span id="luastanah_{{ $value->id }}">{{ $value->luas_tanah }}</span>
                      <input type="text" name="input_luastanah_{{ $value->id }}" id="input_luastanah_{{ $value->id }}" style="display: none;" value="{{ $value->luas_tanah }}">
                    </td>
                    <td>
                      <span id="listrik_{{ $value->id }}">{{ $value->listrik }}</span>
                      <input type="text" name="input_listrik_{{ $value->id }}" id="input_listrik_{{ $value->id }}" style="display: none;" value="{{ $value->listrik }}">
                    </td>
                    <td><a href="{{ url('/')}}/project/templatepekerjaan/?id={{ $value->id }}" class="btn btn-success">Detail</a></td>
                    <td>
                      <button href="{{ url('/')}}/project/edit-blok?id={{ $value->id }}" class="btn btn-warning" id="btn_edit1_{{ $value->id }}" onclick="edittype('{{ $value->id }}')">Edit</button>
                       <button href="{{ url('/')}}/project/edit-blok?id={{ $value->id }}" class="btn btn-success" id="btn_edit2_{{ $value->id }}" onclick="savetype('{{ $value->id }}','{{ $value->name }}')" style="display: none;">Edit</button>
                    </td>
                    <td><button class="btn btn-danger" onclick="removeunit('{{ $value->id }}','{{ $value->name }}')">Delete</button></td>
                 </tr>
                 @endforeach
                </tbody>
              </table>
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
@include("project::app")
<script type="text/javascript">
  $('#example3').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false,
      fixedColumns:   {
          leftColumns: 4
      }
    });

  function removeunit(id,type) {
    if ( confirm("Apakah anda yakin ingin menghapus Type " + type + " ini")){
        var request = $.ajax({
          url : "{{ url('/')}}/project/delete-type",
          data : {
            id : id
          },
          dataType : "json",
          type : "post"
        });

        request.done(function(data){
          if ( data.status == "0"){
            alert("Data type " + type + " telah dihapus");
          }
          window.location.reload();
        })
    }else{  
      return false;
    }
  }

  function edittype(id){
    $("#label_" + id).hide();
    $("#luas_" + id).hide();
    $("#luastanah_" + id).hide();
    $("#listrik_" + id).hide();
    $("#btn_edit1_" + id).hide();

    $("#input_" + id).show();
    $("#input_luas_" + id).show();
    $("#input_luastanah_" + id).show();
    $("#input_listrik_" + id).show();
    $("#btn_edit2_" + id).show();
  }

  function savetype(id,name){
    var request = $.ajax({
      url : "{{ url('/')}}/project/update-type",
      dataType : "json",
      data : {
        id : id,
        name : $("#input_" + id).val(),
        luas : $("#input_luas_" +id).val(),
        luas_tanah : $("#input_luastanah_" +id).val(),
        listrik : $("#input_listrik_" +id).val()
      },
      type : "post"
    });

    request.done(function(data){
      if ( data.status == "0"){
        alert("Type " + name + " telah diganti ");
      }
      window.location.reload();
    })
  }
</script>
</body>
</html>
