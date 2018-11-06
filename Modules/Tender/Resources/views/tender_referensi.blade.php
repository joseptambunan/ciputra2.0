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

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Tender <strong>{{ $tender->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">

            <div class="col-md-6">
              <table class="table">
                <thead class="head_table" >
                  <tr>
                    <td>Nama Rekanan</td>
                    <td>Spesifikasi</td>
                    <td>Hapus</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $tender->rekanans as $key => $value )
                  <tr>
                    <td>{{ $value->rekanan->name }}</td>
                    <td>
                        @foreach ( $value->rekanan->group->spesifikasi as $key2 => $value2 )
                         {{ $value2->itempekerjaan->name }}, 
                        @endforeach
                      </ul>
                    </td>
                    <td>                      
                        <button type="button" class="btn btn-danger" onclick="removerekanan('{{ $value->id }}','{{ $value->rekanan->group->name }}')">Delete</button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            
            <!-- /.col -->
            <div class="col-md-12 table-responsive">

              <form action="">
                <div class="form-group">
                  <label>Form Pekerjaan</label>
                  <select class="form-control select2" name="itempekerjaan" id="itempekerjaan">
                    <option value="all">(semua jenis pekerjaan)</option>
                    @foreach($pekerjaan as $key => $value )
                      @if ( $value->parent_id == null )
                      <option value="{{ $value->id}}">{{ $value->code }} {{ $value->name}}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
              </form>

              <form action="{{ url('/')}}/tender/save-rekanans" method="post">
              <button type="button" class="btn btn-info" id="btn_rekanan">Cari Rekanan</button>
              <button type="submit" class="btn btn-primary" id="btn_submit" disabled>Simpan</button>                 
              <a class="btn btn-warning" href="{{ url('/')}}/tender/detail/?id={{ $tender->id }}">Kembali</a>
              <input type="hidden" value="{{ $tender->id }}" name="tender_id" value="{{ $tender->id }}">
                {{ csrf_field() }}
              <h3><strong><center>Daftar Rekanan yang tersedia</center></strong></h3>
              <table class="table table-bordered" id="example2">
                  <thead class="head_table">
                    <tr>
                      <td>Nama</td>
                      <td>Spesifikasi</td>
                      <td>Set to Tender</td>
                    </tr>
                  </thead>
                  <tbody id="list_rekanan">
                    @php $start = 0; @endphp
                    @foreach($rekanan_group as $key => $value )
                      @if ( count($value->spesifikasi) > 0 )
                        @foreach ( $value->spesifikasi as $key2 => $value2 )
                          @if ( $value2->itempekerjaan->id == $itemkerjan->id )
                          @foreach ( $value->rekanans as $key3 => $value3)
                          @if ( $value3->kelas_id == "null")
                          <tr>
                            <td>{{ $value3->name }} ( Holding )</td>
                            <td>{{ $value2->itempekerjaan->name }}</td>
                            <td><input type="checkbox" name="rekanan[{{$start}}]" value="{{ $value3->id}}"></td>
                          </tr>
                          @else
                          <tr>
                            <td>{{ $value3->name }}</td>
                            <td>{{ $value2->itempekerjaan->name }}</td>
                            <td><input type="checkbox" name="rekanan[{{$start}}]" value="{{ $value3->id}}"></td>
                          </tr>
                          @endif
                          @php $start++; @endphp
                          @endforeach
                        @endif
                        @endforeach
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
  @include("master/copyright")
  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("tender::app")

<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script type="text/javascript">
  $(function () {
    $(".select2").select2();
    if ( $("#list_rekanan").html() != "" ){
        $("#btn_submit").removeAttr("disabled");
    }
  });

  $("#btn_rekanan").click(function(){
    $("#list_rekanan").html("Loading...");
    if ( $("#itempekerjaan").val() != "" ){
      var request = $.ajax({
        url : "{{ url('/')}}/tender/rekanan/cari",
        data : {
          itempekerjaan : $("#itempekerjaan").val()
        },
        type : "post",
        dataType : "json"
      });

      request.done(function(data){
        if ( data.status == "0"){
          $("#btn_submit").removeAttr("disabled");
          $("#list_rekanan").html(data.html);
          $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : false,
            'info'        : true,
            'autoWidth'   : false
          });
        }else{
          $("#list_rekanan").html("Tidak ada rekanan yang tersedia");
        }
      });
    }else{
      var request = $.ajax({
        url : "{{ url('/')}}/tender/rekanan/all",
        data : {
          itempekerjaan : "all"
        },
        type : "post",
        dataType : "json"
      });

      request.done(function(data){
        if ( data.status == "0"){
          $("#btn_submit").removeAttr("disabled");
          $("#list_rekanan").html(data.html);
          $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : false,
            'info'        : true,
            'autoWidth'   : false
          });
        }else{
          $("#list_rekanan").html("Tidak ada rekanan yang tersedia");
        }
      });
    }
  });

</script>
</body>
</html>
