<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard </title>
  @include("master/header")
    <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('/')}}/assets/bower_components/select2/dist/css/select2.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Proyek <strong>{{ $project->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">   
              <h3 class="box-title">Edit Data Tender</h3>           
                {{ csrf_field() }}
                <div class="form-group">
                  <label>No. RAB</label>
                  <input type="text" class="form-control" name="rab_id" value="{{ $tender->rab->no}}" readonly>
                </div>
                <div class="form-group">
                  <label>No. Tender</label>
                  <input type="text" class="form-control" name="tender_name" value="{{ $tender->no }}" readonly>
                </div> 
                <div class="form-group">
                  <label>Pekerjaan</label>
                  <input type="text" class="form-control" name="tender_name" value="{{ \Modules\Pekerjaan\Entities\Itempekerjaan::find($tender->rab->parent_id)->name }}" readonly>
                </div>              
                <div class="form-group">
                  <a class="btn btn-warning" href="{{ url('/')}}/tender">Kembali</a>
                </div>
              <!-- /.form-group -->
            </div>

            <div class="col-md-12">
               <div class="nav-tabs-custom">    
                  <ul class="nav nav-tabs">                
                    <li  class="active"><a href="#tab_2" data-toggle="tab">Rekanan</a></li>
                    <li><a href="#tab_3" data-toggle="tab">Korespondensi</a></li>
                    <li><a href="#tab_4" data-toggle="tab">Penawaran</a></li>
                  </ul>
                  <div class="tab-content">                
                    <!-- /.tab-pane -->
                    <div class="tab-pane active" id="tab_2">
                      @if ( count($tender->menangs) <= 0 )
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
                        Tambah Rekanan
                      </button><br><br> 
                      @endif
                      <table class="table" style="width: 50%;">
                         <thead class="head_table">
                           <tr>
                            <td>Rekanan</td>
                            <td>Status</td>
                            <td>Delete</td>
                           </tr>
                         </thead>
                         <tbody>
                            @foreach ( $tender->rekanans as $key => $value )
                            <tr>
                              <td>{{ $value->rekanan->group->name }}</td>
                              <td>
                                @if ( $value->approval == "" )
                                <button class="btn btn-primary" onclick="requestApproveRekanan('{{ $value->id }}','{{ $value->rekanan->group->name }}')">Request Approve</button>
                                @else
                                 @php
                                  $array = array (
                                    "6" => array("label" => "Disetujui", "class" => "label label-success"),
                                    "7" => array("label" => "Ditolak", "class" => "label label-danger"),
                                    "1" => array("label" => "Dalam Proses", "class" => "label label-warning")
                                  )
                                @endphp
                                <span class="{{ $array[$value->approval->approval_action_id]['class'] }}">{{ $array[$value->approval->approval_action_id]['label'] }}</span>
                                @endif
                              </td>
                              <td>
                                @if ( count($tender->penawarans) <= 0 )<button type="button" class="btn btn-danger" onclick="removerekanan('{{ $value->id }}','{{ $value->rekanan->group->name }}')">Delete</button>
                                @endif
                                </td>
                            </tr>
                            @endforeach
                         </tbody>
                       </table>
                    </div>
                    <div class="tab-pane" id="tab_3">
                      <table class="table">
                        <thead>
                          <tr>
                            <td>No.</td>
                            <td>Rekanan</td>
                            <td>Undangan</td>
                            <td></td>
                          </tr>
                        </thead>
                      </table>
                    </div>
                    <div class="tab-pane" id="tab_4">
                      @if ( count($tender->menangs) <= 0 )
                      @if ( (count($tender->rekanans)) == count($tender->penawarans))
                      <a type="button" class="btn btn-info" href="{{ url('/')}}/tender/penawaran-addstep2?id={{ $tender->id}}">
                        Input Data Volume Terbaru
                      </a><br><br> 
                      @elseif ( (count($tender->rekanans) * 2 ) == count($tender->penawarans))
                      <a type="button" class="btn btn-info" href="{{ url('/')}}/tender/penawaran-addstep3?id={{ $tender->id}}">
                        Input Data Volume Terbaru
                      </a><br><br> 

                      @endif
                      @endif
                      <table class="table">
                        <thead class="head_table">
                          <tr>
                            <td>Item Pekerjaan</td>
                            <td>Nilai(Rp)</td>
                            <td>Penawaran 1</td>
                            <td>Penawaran 2</td>
                            <td>Penawaran 3</td>
                            <td>Pemenang</td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><strong>Owner Estimate</strong></td>
                            <td><h3>{{ number_format($tender->rab->nilai) }}</h3></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          @foreach ( $tender->rekanans as $key => $value )

                            @if ( $value->approval != "" )
                            @if ( $value->approval->approval_action_id == "6")
                            <tr>
                              <td>{{ $value->rekanan->group->name }}</td>
                              <td>
                                @if ( count($tender->menangs) <= 0 )
                                  @if ( count($value->penawarans) <= 0 )
                                    <a href="{{ url('/')}}/tender/penawaran-add?id={{$value->id}}" class="btn btn-primary">Tambah Penawaran</a>
                                  @elseif ( count($value->penawarans) == 2 && $value->penawarans[1]->nilai == "0" )
                                    <a href="{{ url('/')}}/tender/penawaran-step2?id={{$value->penawarans[1]->id}}" class="btn btn-primary">Tambah Penawaran</a>
                                  @elseif ( count($value->penawarans) == 3 && $value->penawarans[2]->nilai == "0" )
                                    <a href="{{ url('/')}}/tender/penawaran-step3?id={{$value->penawarans[2]->id}}" class="btn btn-primary">Tambah Penawaran</a>
                                  @endif
                                @endif
                               </td>
                              @foreach ( $value->penawarans as $key3 => $value3)
                              <td><h3>{{ number_format($value3->nilai) }}</h3></td>
                              @endforeach
                              @if ( count($value->penawarans) == 3 && $value->penawarans[2]->nilai != "0" )
                              <td>
                                 @if ( count($tender->menangs) <= 0 )
                                 <button onclick="setpemenang('{{$value->id}}','{{ $value->rekanan->group->name }}')" class="btn btn-primary" href="{{ url('/')}}/tender/ispemenang?id={{$value->id}}">Jadikan Pemenang</button>
                                 @else
                                  @if ( $value->is_pemenang == 1 )
                                    @foreach ( $value->menangs as $key7 => $value7 )
                                    @php
                                      $array = array (
                                        "6" => array("label" => "Disetujui", "class" => "label label-success"),
                                        "7" => array("label" => "Ditolak", "class" => "label label-danger"),
                                        "1" => array("label" => "Dalam Proses", "class" => "label label-warning")
                                      )
                                    @endphp
                                    <span class="{{ $array[$value7->approval->approval_action_id]['class'] }}">{{ $array[$value7->approval->approval_action_id]['label'] }}</span>
                                    @endforeach
                                  @endif
                                 @endif
                              </td>
                              @endif
                            </tr>
                            @endif
                            @endif
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
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
  <div class="modal fade" id="modal-default">
    <form action="{{ url('/')}}/tender/save-rekanans" method="post">
    <input type="hidden" value="{{ $tender->id }}" name="tender_id" value="{{ $tender->id }}">
    {{ csrf_field() }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Default Modal</h4>
        </div>

        <div class="modal-body">

          <table class="table" id="example2">
            <thead class="head_table">
              <tr>
                <td>Rekanan</td>
                <td><input type="checkbox" value="" id="unit_rab_all" onclick="checkall();"> Set to Tender</td>
              </tr>
            </thead>
            <tbody>
               @foreach($rekanan as $key => $value )
                <tr>
                  <td>{{ $value->group->name }}</td>
                  <td><input type="checkbox" name="rekanan[{{$key}}]" value="{{ $value->id}}"></td>
                </tr>
               @endforeach
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    </form>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("tender::app")
<script type="text/javascript">
  function setpemenang(id,name){
    if ( confirm("Apakah anda yakin ingin menjadikan " + name + " sebagai pemenang tender ?")){
      var request = $.ajax({
        url : "{{ url('/')}}/tender/ispemenang",
        dataType : 'json',
        data : {
          id : id
        },
        type : "post"
      });

      request.done(function(data){
        if ( data.status == "0"){
            alert("Rekanan telah diajukan sebagai pemenang");
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
