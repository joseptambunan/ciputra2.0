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
      <h1>Data Negara</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="col-md-6">
              <h3 class="header">Tambah Tipe SPK</h3>
               <form action="{{ url('/')}}/spk/save-tipe" method="post" name="form1">
                {{ csrf_field() }}                  
                <div class="form-group">
                    <label for="exampleInputEmail1">Tipe</label>
                    <input type="text" class="form-control" name="tipe" required>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
              </form>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover">
                <thead>
                <tr style="background-color: greenyellow;">
                  <th>Tipe SPK </th>
                  <th>Hapus</th>
                </tr>
                </thead>
                <tbody>
                @foreach ( $spk_type as $key => $value )
                <tr>
                  <td>{{ $value->description }}</td>                  
                  <td><button onClick="removemaster('{{ $value->id }}')" class="btn btn-danger">Delete</button></td>
                </tr>
                @endforeach
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
  @include("master/copyright")
  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include("master/footer_table")
<script type="text/javascript">
   $( document ).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('input[name=_token]').val()
        }
      });
  });
   
  function removemaster(id){
    if ( confirm("Apakah anda ingin menghapus data ini ?")){
      var request = $.ajax({
        url : "{{ url('/')}}/spk/delete-tipe",
        dataType : "json",
        type : "post",
        data : {
          id : id
        }
      });

      request.done(function(data){
        if ( data.status == "0"){
          alert("Data telah dihapus");
        }

        window.location.reload();
      });
    }else{
      return false;
    }
  }
</script>
</body>
</html>
