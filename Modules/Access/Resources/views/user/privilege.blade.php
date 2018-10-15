<!DOCTYPE html>
<html>
@include('user.header')
<body class="hold-transition sidebar-mini">
<div class="wrapper">
 
  <!-- /.navbar -->
{{ csrf_field() }}
 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ url('/') }}/assets/users/dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">CIPUTRA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('/') }}/images/logo-ciputra_original.png" alt="logo" class="logo-default" style='height:57%' />
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ $user->user_name or '' }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">          
          <li class="nav-item">
            <a href="{{ url('/') }}/logout" class="nav-link">
              <i class="nav-icon fa fa-file"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        
      </div><!-- /.container-fluid -->      
    </section>

    <!-- Main content -->
    <section class="content" style="font-size:17px;">
      <div class="row">
        <div class="col-12">


          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Document</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered" style="font-size: 20px;">
                <tr>
                  <td>Pilih PT</td>
                  <td>
                    <select class="form-control" name="pt_id" id="pt_id">
                      @foreach($user->details as $key => $value )
                      <option value="{{ $value->id }}">{{ $value->mappingperusahaan->pt->name }}</option>
                      @endforeach
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>
                    <button class="btn btn-info" onclick="setlogin()">Submit</button>
                  </td>
                </tr>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.0-alpha
    </div>
    <strong>Copyright &copy; 2014-2018 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>


</div>
<!-- ./wrapper -->
@include('user.footer')
<script type="text/javascript">
   $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('input[name=_token]').val()
        }
    });

   function setlogin(){
      var request = $.ajax({
        url : "{{url('/')}}/user/privilege/set",
        dataType : "json",
        data : {
          pt_id : $("#pt_id").val()
        },
        type : "post"
      });

      request.done(function(data){
        window.location.href = data.url;
      });
   }
</script>
</body>
</html>
