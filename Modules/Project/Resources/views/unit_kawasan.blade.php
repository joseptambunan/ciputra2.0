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

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Proyek <strong>{{ $projectkawasan->project->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/')}}/project/kawasan/">Kawasan {{ $blok->kawasan->name }}</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/')}}/project/bloks/?id={{ $blok->kawasan->id}}">Blok {{ $blok->name }}</a></li>
                <li class="breadcrumb-item active">Unit</li>
              </ol>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <form action="{{ url('/')}}/project/unit/senderems" method="post" name="form1">
                <!-- <a href="{{ url('/')}}/project/add-unit?id={{ $blok->id }}" class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i>Tambah Unit</a> -->
                <input type="hidden" name="blok_id" id="blok_id" value="{{ $blok->id }}">
                <input type="hidden" name="unit_id" id="unit_id"> 

                <div class="col-xs-3">
                  <input type="text" class="form-control" name="total_unit" id="total_unit" placeholder="total unit yang akan dibangun">
                  <i class="fa fa-refresh ld ld-spin" id="loading" style="display: none;"></i><br/>
                  <button type="button" class="btn btn-info" onClick="generateunit();" id="btn_generate">Buat Unit</button><br/><br/>
                  <button class="btn btn-warning" type="submit">Simpan</button>
                  <button class="btn btn-danger" type="button" id="btn_del_unit">Delete</button><br><br>
                  <span>Total Unit : <strong>{{ count($blok->units)}}</strong></span><br/>
                  <span>Total Luas Tanah : <strong>{{ number_format($blok->total_tanah) }}</strong></span><br/>
                  <span>Total Luas Bangunan : <strong>{{ number_format($blok->total_bangunan )}}</strong></span><br><br>
                </div>
                <table id="example2" class="table table-bordered table-hover">   
                {{ csrf_field() }}              
                <thead style="background-color: greenyellow;">
                  <tr>   
                    <td>No.</td>              
                    <td>Unit No.</td>
                    <td>Type Unit</td>
                    <td>LB(m2)</td>
                    <td>LT(m2)</td>
                    <td>Kategori</td>
                    <td>Progress</td>
                    <td>Kirim ke EREMS</td>
                    <td>Status</td>
                    <td>Edit</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $blok->units as $key => $value )
                  
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->name }}</td>  
                    <td>{{ $value->type->name or '' }}</td>                    
                    <td>{{ number_format($value->bangunan_luas,2) }}</td>
                    <td>{{ number_format($value->tanah_luas,2) }}</td>
                    <td>
                      @if ( $value->is_sellable == 1 )
                        @if (  $value->tag_kategori == 'B' )
                          Bangunan               
                        @else
                          Kavling
                        @endif
                      @else
                        Tidak Dijual
                      @endif
                    </td>
                    <td>
                      @if ( count($value->progresses) > 0 ) 
                        @if ( $value->status == 7 )
                          ST 1 : <strong>{{ date("d/M/Y",strtotime($value->st_1)) }}</strong>
                        @else
                          ST 2 : <strong>{{ date("d/M/Y",strtotime($value->st_1)) }}</strong>
                        @endif
                      @else
                      0%
                      @endif
                    </td>
                    <td>
                      <input type="checkbox" name="unit_[{{$value->id}}]" id="unit_{{$value->id}}" onClick="addunitdelete('{{$value->id}}')" value="{{$value->id}}">
                    </td>
                    <td>
                      @if ( $value->status == 0 )
                        Draft P&D
                      @elseif ( $value->status == 1 )
                        Planning EREMS
                      @elseif ( $value->status == 3)
                        Stok
                      @elseif ( $value->status == 5 )
                        Sold
                      @endif
                    </td>
                     <td>        
                          @if ( $value->status < 3 )     
                            <input type="checkbox" name="delete_unit_{{$value->id}}" id="delete_unit_{{$value->id}}" onClick="addunitdelete('{{$value->id}}')"><span class="label label-danger">Delete </span> 
                          @endif        
                          <a class="btn btn-warning" href="{{ url('/')}}/project/edit-unit?id={{ $value->id }}">Detail</a>                        
                      </td>
                      
                  </tr>
                  @endforeach
                </tbody>
                </table>
              </form>
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
  <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Buat Unit</h4>
          </div>
          <div class="modal-body">
            <p>One fine body&hellip;</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("project::app")
<script type="text/javascript">
  $('#example3').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false,
      fixedColumns:   {
          leftColumns: 4
      }
  });

  function generateunit(){
    if ( confirm("Apakah anda yakin ingin membuat ini sebanyak " + $("#total_unit").val() + " unit ?")){
      $("#btn_generate").hide();
      $("#loading").show();
      var request = $.ajax({
        url : "{{url('/')}}/project/generateunit",
        dataType : "json",
        data : {
          blok : $("#blok_id").val(),
          total_unit : $("#total_unit").val()
        },
        type : "post"
      });

      request.done(function(data){
        $("#btn_generate").show();
        $("#loading").hide();

        if ( data.status == "0"){
          alert("Unit telah dibuat");
        }
        window.location.reload();
      })
    }else{
      return false;
    }
  }

</script>
</body>
</html>
