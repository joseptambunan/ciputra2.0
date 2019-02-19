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
      <h1>Data Bank</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
   
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-6">
                <h3 class="header">Tambah User</h3>
            	   <form action="{{ url('/')}}/user/add-user" method="post" name="form1">
                  {{ csrf_field() }}                  
                  <div class="form-group">
                      <label for="exampleInputEmail1">Username</label>
                      <input type="text" class="form-control" name="username" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Userlogin</label>
                      <input type="text" class="form-control" name="userlogin" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Rekanan</label>
                      <select class="form-control" name="isrekanan">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" class="form-control" name="email" autocomplete="off">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Phone</label>
                      <input type="text" class="form-control" name="phone" autocomplete="off">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Password</label>
                      <input type="text" class="form-control" name="password" autocomplete="off">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <textarea name="description" rows="3" class="form-control"></textarea>
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
              	</form>
              </div>
              <div class="col-md-12">
            	<table id="example3" class="table table-bordered table-hover">
                <thead>
                <tr style="background-color: greenyellow;">
                  <th>Username </th>
                  <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                @foreach ( $usermaster as $key => $value )
                <tr>
                  <td>
                  	<span class="labels" id="label_{{ $value->id}}">{{ $value->user_name }}</span>                  	
                  </td>                   
                  <td>
                  	<a class="btn btn-warning" href="{{ url('/')}}/user/detail?id={{ $value->id}}">Detail</a>
                  </td>
                </tr>
                @endforeach
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

@include("master/copyright")

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("bank::app")
</body>
</html>
