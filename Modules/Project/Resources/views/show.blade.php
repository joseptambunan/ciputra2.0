<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
</head>
<body class="hold-transition skin-blue sidebar-mini">
{{ csrf_field() }}
<div class="wrapper">
  @include("master/sidebar_project")
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Proyek : <strong>{{ $project->name }}</strong></h1>  
    </section>
   <!-- Main content -->
    <section class="content">
       <!-- Small boxes (Stat box) -->
      <div class="row">
       
        <!-- ./col -->
      </div>
      <!-- /.row -->

      <!-- Main row -->

      <div class="row">
       
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-12 connectedSortable">

          <!-- TO DO List -->
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">To Do List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead class="head_table">
                  <tr>
                    <td colspan="2">Pekerjaan</td>
                  </tr>
                </thead>
                <tbody id="todo_list">
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                </tbody>
              </table>

              <h4>Rumah Terjual belum SPK</h4>
              <table id="example2" class="table table-bordered">
                <thead class="head_table">
                  <tr>
                    <td>Serah Terima Dalam</td>
                    <td>Jumlah Unit</td>
                    <td>Detail</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $array_serah_terima as $key => $value )
                  <tr>
                    <td>{{ $key }} bln</td>
                    <td>{{ count($value['unit_id']) }} unit</td>
                    <td><a href="{{url('/')}}/project/unitsold?bln={{$key}}" class="btn btn-primary">Detail</a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.box -->
         

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>

<!-- ./wrapper -->



</body>
@include("master/footer")
<script type="text/javascript">
   $.ajaxSetup({
      headers: {
          'X-CSRF-Token': $('input[name=_token]').val()
      }
    });
  $( document ).ready(function() {
    var request = $.ajax({
      url : "{{ url('/')}}/project/todolist",
      dataType : "json",
      data : {
        id : $("#project_id").val()
      },
      type : "post"
    });

    request.done(function(data){
      $("#todo_list").html(data.html);
    })
  });
</script>
@include("report::chart")
</html>

