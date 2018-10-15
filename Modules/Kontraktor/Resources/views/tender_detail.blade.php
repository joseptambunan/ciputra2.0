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
      <span class="logo-lg"><b>Rekanan</b> {{ $user->rekanan->name }}</span>
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
              <h5>Selamat Datang , <strong>{{ $user->rekanan->name }}</strong></h5>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <h3 class="box-title"><strong>Data Tender</strong></h3>
              <div class="col-md-6">            
                
                <div class="form-group">
                  <label>No. Tender</label>
                  <input type="text" class="form-control" name="tender_name" value="{{ $tender->no }}" readonly>
                </div> 
                <div class="form-group">
                  <label>Pekerjaan</label>
                  <input type="text" class="form-control" name="tender_name" value="{{ $itempekerjaan->code }} - {{ $itempekerjaan->name }}" readonly>
                </div>              
                <div class="form-group">
                  <a class="btn btn-warning" href="{{ url('/')}}">Kembali</a>
                </div>
              <!-- /.form-group -->
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  @php
                    $arrayStatus = array("0" => array( "label" =>  "Dalam Proses Penawaran", "class" => "info-box bg-yellow" ), "1" => array("label" => "Pemenang", "class" => "info-box bg-success"),  "2" => array( "label" => "Ditolak", "class" => "label info-box bg-danger" ) )
                  @endphp
                  <div class="{{ $arrayStatus[$status]['class'] }}">
                    <div class="info-box-content" style="margin-left: 0px !important;">
                    <center><h3><strong>Status : {{ $arrayStatus[$status]['label'] }}</strong></h3></div></center>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="nav-tabs-custom">    
                  <ul class="nav nav-tabs">                
                    <li  class="active"><a href="#tab_2" data-toggle="tab">Pekerjaan</a></li>
                    <li><a href="#tab_3" data-toggle="tab">Unit</a></li>
                  </ul>
                </div>
                <div class="tab-content">         
                  <div class="tab-pane active" id="tab_2">

                    @if ( count($tender->menangs) <= 0 )
                      @if ( count($rekanan->penawarans) == 2 )
                      <a href="{{ url('/') }}/kontraktor/tender/add-penawaran2/?id={{ $rekanan->id }}" class="btn btn-primary">Tambah Penawaran</a><br><br> 
                      @elseif ( count($rekanan->penawarans) == 3 )
                      <a href="{{ url('/') }}/kontraktor/tender/add-penawaran3/?id={{ $rekanan->id }}" class="btn btn-primary">Tambah Penawaran</a><br><br> 
                      @elseif ( $rekanan->penawarans->count() == 0 )
                      <a href="{{ url('/') }}/kontraktor/tender/add-penawaran/?id={{ $rekanan->id }}" class="btn btn-primary">Tambah Penawaran</a>
                      @endif
                    @endif
                    

                    <table class="table table-bordered">
                      <thead class="head_table">
                        <tr>
                          <td>Item Pekerjaan</td>
                          <td>Penawaran 1</td>
                          <td>Penawaran 2</td>
                          <td>Penawaran 3</td>
                        </tr>
                        
                      </thead>
                      <tbody>                        
                        <tr>
                          <td>{{ \Modules\Pekerjaan\Entities\Itempekerjaan::find($tender->rab->parent_id)->name }}</td>
                          @foreach ( $rekanan->penawarans as $key => $value )
                          <td>
                            {{ number_format( $value->nilai )}}<br>
                            @if ( $value->nilai != "" )
                            <a class="btn btn-primary" href="{{ url('/')}}/kontraktor/tender/view-penawaran/?id={{ $value->id}}">Detail</a>
                            @endif
                          </td>
                          @endforeach
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane" id="tab_3">
                    <table class="table table-bordered">
                      <thead class="head_table">
                        <tr>
                          <td>Unit Name</td>
                          <td>Type</td>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ( $tender->units as $key => $value )
                          <tr>
                            <td>{{ $value->rab_unit->asset->name }}</td>
                            @if ( $value->rab_unit->asset_type == "\Modules\Project\Entities\Unit") 
                            <td>{{ $value->rab_unit->asset->type->name }}</td>
                            @else
                            <td>{{ $value->rab_unit->asset_type }}</td>
                            @endif
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                  </div>
                </div>
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

@include("kontraktor::footer")
</body>
</html>
