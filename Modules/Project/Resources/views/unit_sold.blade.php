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
              <form action="{{url('/')}}/workorder/savequick" method="post" name="form1">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">Set ke WO</button>
                <a class="btn btn-warning" href="{{ url('/')}}/project/detail/?id={{$project->id}}">Kembali</a>
              <h4>Rumah Sold belum SPK</h4>
              <table id="example2" class="table table-bordered">
                <thead class="head_table">
                  <tr>
                    <td>&nbsp;</td>
                    <td>No.</td>
                    <td>Kawasan</td>
                    <td>Blok</td>
                    <td>Unit No.</td>
                    <td>Type</td>
                    <td>Serah Terima</td>
                    <td>Pembayaran</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $array_unit as $key => $value )
                  <tr>
                    <td><input type="checkbox" name="unit[{{$key}}]" value="{{$value['id']}}"></td>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value['kawasan'] }}</td>
                    <td>{{ $value['blok'] }}</td>
                    <td>{{ $value['name'] }}</td>
                    <td>{{ $value['type']}}</td>
                    <td>{{ $value['serah_terima'] }}</td>
                    <td>{{ number_format($value['pembayaran'])}} %</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>              
              </form>
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

