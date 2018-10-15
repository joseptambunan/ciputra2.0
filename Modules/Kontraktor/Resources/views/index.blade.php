<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Kontraktor</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('/') }}/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/') }}/assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('/') }}/assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('/') }}/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/') }}/assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ url('/') }}/assets/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
    .head_table{
      background-color: #009688;
      color:white;
      font-weight: bolder;
    }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

    </nav>
  </header>
  <aside class="main-sidebar">
    @include("kontraktor::sidebar")  
  </aside>

  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h5>Selamat Datang , <strong>{{ $rekanan->name }}</strong></h5>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- TO DO List -->              
              <div class="box-header">
                <i class="ion ion-clipboard"></i>
                @if ( count($rekanan->rekanans) > 0 )
                  @foreach ( $rekanan->rekanans as $key2 => $value2)
                    @foreach ( $value2->tender_rekanans as $key3 => $value3 )
                      <h3 class="box-title">Anda Memiliki undangan tender di bawah ini</h3>                       
                    @endforeach
                  @endforeach
                @endif               
              </div>
              <!-- /.box-header -->
              <div class="box-body col-md-3">
                <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
                <ul class="todo-list">
                  @if ( count($rekanan->rekanans) > 0 )
                    @foreach ( $rekanan->rekanans as $key2 => $value2)
                      @foreach ( $value2->tender_rekanans as $key3 => $value3 )
                        @if ( count($value3->tender->spks) == "0")
                        <li><span class="text"><a href="{{ url('/')}}/kontraktor/tender/detail?id={{ $value3->tender->id}}">{{ $value3->tender->no }}</a></span></li> 
                        @endif
                      @endforeach
                    @endforeach
                  @endif                                      
                </ul>
              </div>
              <!-- /.box-body -->  
              <br><br><br>
              <h3 class="box-title"><strong><center>Data SPK</center></strong></h3>
              <table id="example2" class="table table-bordered table-hover table-responsive">
                <thead class="head_table">
                <tr>
                  <th>No.</th>
                  <th>No Spk.</th>
                  <th>Item Pekerjaan</th>
                  <th>Project</th>
                  <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ( $rekanan->spks as $key => $value )
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->no }}</td>
                    <td>{{ \Modules\Pekerjaan\Entities\Itempekerjaan::find($value->itempekerjaan)->name }}</td>
                    <td>{{ $value->project->name }}</td>
                    <td><a class="btn btn-primary" href="{{ url('/')}}/kontraktor/spk/detail?id={{$value->id}}">Detail</a></td>
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

@include("kontraktor::footer")
</body>
</html>
