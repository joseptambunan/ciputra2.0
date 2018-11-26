<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard </title>
  @include("master/header")
  <!-- Select2 -->  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="{{ url('/')}}/assets/bower_components/select2/dist/css/select2.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Detail Data Library</h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <span class="box-title">Data Pekerjaan <strong>{{ $itempekerjaan->name }}</strong></span><br>
              <span class="box-title"><strong>Harga : </strong>{{ number_format($nilai_library_satuan,2) }} / {{ $itempekerjaan->details->satuan }}</span><br>
            </div>
            <!-- /.col -->
            <div class="col-md-12">
              <form action="{{ url('/')}}/pekerjaan/library-save" method="post" name="form1" id="form1">  
                <a href="{{ url('/') }}/pekerjaan/detail?id={{ $itempekerjaan->parent->id }}" class="btn btn-warning">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <br><br>
                {{ csrf_field() }}
                <input type="hidden" name="parent_id" id="parent_id" value="{{ $itempekerjaan->id }}">
                <table class="table">
                  <thead class="head_table">
                    <tr>
                      <td>Pembagi</td>
                      <td>COA</td>
                      <td>Item Pekerjaan</td>
                      <td>Satuan</td>
                      <td>Harga Satuan</td>
                      <td>Terendah</td>
                      <td>Tertinggi</td>
                    </tr>
                  </thead>
                  <tbody id="itemlist">
                    @php $start = 0; @endphp
                    @foreach ( $itempekerjaan->child_item as $key => $value )
                      @if ( $value->group_cost == 1 )
                        @foreach ( $value->child_item as $key2 => $value2 )
                          <tr {{ $class }}>
                            <td><label><input type="radio" name="tag" class="minimal" value="{{ $value->id}}" {{ $selected }}></label></td>
                            <td>{{ $value2->code }}</td>
                            <td>{{ $value2->name }}</td>
                            <td>{{ $value2->details->satuan }}</td>
                            <td>
                              <input type="hidden" class="form-control" name="item_id_[{{ $start}}]" value="{{ $value2->id}}">               
                              @if ( $start > 0 )
                              <input type="text" class="nilai_budgets form-control" name="nilai_[{{ $start}}]" value="{{ $value2->nilai_library }}" autocomplete="off">
                              @else
                              <input type="text" class="nilai_budgets form-control" name="nilai_[{{ $start}}]" value="{{ $nilai_library_satuan }}" autocomplete="off">
                              @endif         
                            </td>
                            <td>{{ number_format($value2->nilai_lowest_library,2) }}</td>
                            <td>{{ number_format($value2->nilai_max_library,2) }}</td>
                          </tr>
                          @php $start++; @endphp
                        @endforeach
                      @else

                      <!--Nilai yang diisi adalah nilai * volume -->
                        @if ( $value->tag == 1 )
                          @php  $class = "style=background-color:grey;color:white;font-weight:bolder"; $selected = "checked"; @endphp
                        @else
                          @php $class = ""; $selected = ""; @endphp
                        @endif
                        @if ( $value->group_cost == 2 )
                          <tr {{ $class }}>
                            <td><label><input type="radio" name="{{ $value->id }}" class="minimal" value="{{ $value->id}}" {{ $selected }}></label></td>
                            <td>{{ $value->code }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->details->satuan }}</td>
                            <td>
                              <input type="hidden" class="form-control" name="item_id_[{{ $start}}]" value="{{ $value->id}}">               
                              @if ( $start > 0 )
                              <input type="text" class="nilai_budgets form-control" name="nilai_[{{ $start}}]" value="{{ $value->nilai_library }}" autocomplete="off">
                              @else
                              <input type="text" class="nilai_budgets form-control" name="nilai_[{{ $start}}]" value="{{ $nilai_library_satuan }}" autocomplete="off">
                              @endif         
                            </td>
                            <td>{{ number_format($value->nilai_lowest_library,2) }}</td>
                            <td>{{ number_format($value->nilai_max_library,2) }}</td>
                          </tr>
                          @php $start++; @endphp
                          @foreach ( $value->child_item as $key2 => $value2 )
                          <tr {{ $class }}>
                            <td>&nbsp;</td>
                            <td>{{ $value2->code }}</td>
                            <td>{{ $value2->name }}</td>
                            <td>{{ $value2->details->satuan }}</td>
                            <td>
                              <input type="hidden" class="form-control" name="item_id_[{{ $start}}]" value="{{ $value2->id}}">               
                              @if ( $start > 0 )
                              <input type="text" class="nilai_budgets form-control" name="nilai_[{{ $start}}]" value="{{ $value2->nilai_library }}" autocomplete="off">
                              @else
                              <input type="text" class="nilai_budgets form-control" name="nilai_[{{ $start}}]" value="{{ $nilai_library_satuan }}" autocomplete="off">
                              @endif         
                            </td>
                            <td>{{ number_format($value2->nilai_lowest_library,2) }}</td>
                            <td>{{ number_format($value2->nilai_max_library,2) }}</td>
                          </tr>
                          @php $start++; @endphp
                          @endforeach
                        
                        @endif
                      @endif
                    @endforeach
                  </tbody>
                </table>
              </form>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->


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
@include("pekerjaan::app")
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
  });

  $(".nilai_budgets").number(true,2)
</script>
</body>
</html>
