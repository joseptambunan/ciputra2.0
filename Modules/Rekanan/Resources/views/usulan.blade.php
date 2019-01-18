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
                <a href="{{ url('/')}}/rekanan/" class="btn btn-primary">Kembali</a>
              </div>
              <div class="col-md-12">
                <form action="{{ url('/')}}/rekanan/usulan/save" method="post" name="form1" id="form1">
                {{ csrf_field()}}
              	<table id="example3" class="table table-bordered table-hover">
                  <thead>
                  <tr style="background-color: greenyellow;">
                    <th>Nama</th>
                    <th>Proyek</th>
                    <th>Spesifikasi</th>
                    <th>Detail</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php $start = 0; @endphp
                    @foreach( $rekanan_group as $key => $value )
                      @if ( $value->rekanans->count() > 0 )
                        @foreach ( $value->rekanans as $key2 => $value2)
                          @if ( $value2->gabung_date == NULL )
                            <tr>
                              <td>{{ $value->name or ''}}</td>
                              <td>{{ $value->project->name or ''}}</td>
                              <td>
                                @foreach ( $value->spesifikasi as $key3 => $value3 )
                                  {{ $value3->itempekerjaan->name }}
                                @endforeach
                              </td>
                              <td><input type="checkbox" name="status_[{{$start}}]" value="{{ $value2->id}}">Approve</td>
                            </tr>
                            @php $start++; @endphp
                          @endif
                        @endforeach
                      @endif
                    @endforeach
                  </tbody>
                </table>
                <button class="btn btn-info" type="submit">Simpan</button>
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
