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
              <form action="{{ url('/')}}/kontraktor/tender/save-penawaran" method="post" name="form1" id="form1" enctype="multipart/form-data">
              <div class="col-md-6">    

                <h3 class="box-title"><strong>Data Tender</strong></h3>                        
                <div class="form-group">
                  <label><span style="font-size:20px;">No. Tender</span></label>
                  <input type="text" class="form-control" name="tender_name" value="{{ $tender->no }}" readonly>
                </div>
                <div class="form-group">
                  <label><span style="font-size:20px;">Keterangan</span></label>
                  <textarea name="description"  class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <label><span style="font-size:20px;">Dokumen Pendukung</span></label>
                  <input type="file" name="file_upload">
                </div>          
                <div class="form-group">
                  <a class="btn btn-warning" href="{{ url('/')}}/kontraktor/tender/detail?id={{$tender->id}}">Kembali</a>
                  <button type="button" class="btn btn-primary" onclick="submitform();">Simpan</button>
                </div>
              <!-- /.form-group -->
              </div>
             

              <div class="col-md-12">
                  {{ csrf_field() }}
                <input type="hidden" name="tender_rekanan" value="{{ $tender_rekanan->id }}">
                <input type="hidden" name="penawaran" value="{{ $penawaran }}">
                <table class="table table-bordered" style="font-size:20px;">
                  <thead class="head_table">
                    <tr>
                      <td rowspan="2">Item Pekerjaan</td>
                      <td colspan="4">Penawaran</td>
                    </tr>
                    <tr>
                      <td>Volume</td>
                      <td>Satuan</td>
                      <td>Nilai Satuan</td>
                      <td>Subtotal</td>
                    </tr>
                  </thead>
                  <tbody>
                    @php $start = 0; @endphp
                    @if ( $penawaran == "1")
                    @foreach ( $itempekerjaan->child_item as $key => $value )
                      <tr>                        
                          <td><span style="font-size:20px;"><strong>{{ $value->name }}</strong></span></td>
                          @if ( count(\Modules\Rab\Entities\RabPekerjaan::where("itempekerjaan_id",$value->id)->where("rab_unit_id",$tender->rab->units->first()->rab_id)->get()) > 0 )                          
                          @php 
                            $rabdetail = \Modules\Rab\Entities\RabPekerjaan::where("itempekerjaan_id",$value->id)->where("rab_unit_id",$tender->rab->units->first()->rab_id)->get();
                          @endphp                              
                          <td><span style="font-size:20px;">{{ $rabdetail->first()->volume }}</span></td> 
                          <td><span style="font-size:20px;">{{ $rabdetail->first()->satuan }}</span></td> 
                          <td>
                            <input type="text" class="form-control nilai_budget" name="input_nilai_[{{$start}}]" value="{{ rand(1,50000)}}">
                            <input type="hidden" class="form-control" name="input_rab_id[{{$start}}]" value="{{ $rabdetail->first()->id }}">
                            <input type="hidden" class="form-control" name="input_volume[{{$start}}]" value="{{ $rabdetail->first()->volume }}">
                            <input type="hidden" class="form-control" name="input_satuan[{{$start}}]" value="{{ $rabdetail->first()->satuan }}">
                          </td>  
                          @php $start++; @endphp
                          @endif  
                      </tr>
                      @foreach ( $value->child_item as $key2 => $value2 )
                        <tr>
                          <td><span style="font-size:20px;">{{ $value2->name }}</td>
                          @if ( count(\Modules\Rab\Entities\RabPekerjaan::where("itempekerjaan_id",$value2->id)->where("rab_unit_id",$tender->rab->units->first()->rab_id)->get()) > 0 )                          
                          @php 
                            $rabdetail = \Modules\Rab\Entities\RabPekerjaan::where("itempekerjaan_id",$value2->id)->where("rab_unit_id",$tender->rab->units->first()->rab_id)->get();
                          @endphp                              
                          <td><span style="font-size:20px;">{{ $rabdetail->first()->volume }}</span></td> 
                          <td><span style="font-size:20px;">{{ $rabdetail->first()->satuan }}</span></td> 
                          <td>
                            <input type="text" class="form-control nilai_budget" name="input_nilai_[{{$start}}]" value="{{ rand(1,50000)}}">
                            <input type="hidden" class="form-control" name="input_rab_id[{{$start}}]" value="{{ $rabdetail->first()->id }}">
                            <input type="hidden" class="form-control" name="input_volume[{{$start}}]" value="{{ $rabdetail->first()->volume }}">
                            <input type="hidden" class="form-control" name="input_satuan[{{$start}}]" value="{{ $rabdetail->first()->satuan }}">
                          </td>  
                          @php $start++; @endphp
                          @endif  
                        </tr>
                        @if ( count($value2->child_item) )
                          @foreach ( $value2->child_item as $key4 => $value4 )
                            @if ( count(\Modules\Rab\Entities\RabPekerjaan::where("itempekerjaan_id",$value4->id)->where("rab_unit_id",$tender->rab->units->first()->rab_id)->get()) > 0 )
                              @php 
                                $rabdetail = \Modules\Rab\Entities\RabPekerjaan::where("itempekerjaan_id",$value4->id)->where("rab_unit_id",$tender->rab->units->first()->rab_id)->get();

                              @endphp
                              <tr>
                                <td><span style="font-size:20px;">&nbsp;&nbsp;&nbsp;&nbsp;{{ $value4->name }}</span></td>
                                <td><span style="font-size:20px;">{{ $rabdetail->first()->volume }}</span></td> 
                                <td><span style="font-size:20px;">{{ $rabdetail->first()->volume }}</span></td> 
                                <td>
                                  <input type="text" class="form-control nilai_budget" name="input_nilai_[{{$start}}]" value="{{ rand(1,50000)}}">
                                  <input type="hidden" class="form-control" name="input_rab_id[{{$start}}]" value="{{ $rabdetail->first()->id }}">
                                  <input type="hidden" class="form-control" name="input_volume[{{$start}}]" value="{{ $rabdetail->first()->volume }}">
                                  <input type="hidden" class="form-control" name="input_satuan[{{$start}}]" value="{{ $rabdetail->first()->satuan }}">
                                </td> 
                              </tr>
                              @php $start++; @endphp
                            @endif
                          @endforeach
                                                   
                        @endif
                        </tr>
                      @endforeach                       
                      </tr>
                      <tr style="background-color: grey;">
                        <td colspan="5"></td>
                      </tr>
                    @endforeach
                    @endif
                  </tbody>
                </table>

                </form>
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
@include("kontraktor::app")
</body>
</html>
