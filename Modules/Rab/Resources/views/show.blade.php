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
      <h1>Data Proyek</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <input type="hidden" name="workorder" id="workorder" value="{{ $rab->workorder->id }}">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">   

              <h3 class="box-title">Edit Data Rab</h3>           
              <form action="{{ url('/')}}/rab/update" method="post" name="form1">
                {{ csrf_field() }}
              <input type="hidden" name="rab_id" value="{{ $rab->id }}">
              <div class="form-group">
                <label>No. Workorder</label>
                <input type="text" class="form-control" name="workorder_name" value="{{ $rab->workorder->no }}" readonly>
              </div> 
              <div class="form-group">
                <label>No. RAB</label>
                <input type="text" class="form-control" name="workorder_name" value="{{ $rab->no }}" readonly>
              </div> 
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="workorder_name" value="{{ $rab->name }}" readonly>
              </div>             
              <!-- /.form-group -->
              <div class="form-group">
                <a class="btn btn-warning" href="{{ url('/')}}/rab/?workorder_id={{ $rab->workorder->id }}">Kembali</a>
              </div>
            </div>
            <!-- /.col -->

            </form>
            <!-- /.col -->

          </div>
          <div class="nav-tabs-custom">
    
              <h3><strong>Nilai RAB Rp {{ number_format($rab->nilai)}}</strong></h3>
              <ul class="nav nav-tabs">                
                <li><a href="#tab_3" data-toggle="tab">Item Pekerjaan</a></li>
                <li  class="active"><a href="#tab_2" data-toggle="tab">Unit</a></li>
              </ul>
              <div class="tab-content">                
                <!-- /.tab-pane -->
                <div class="tab-pane " id="tab_3">
                  @if ( count($rab->units) > 0 && count($rab->pekerjaans) <= 0 )
                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
                    Tambah Item Pekerjaan
                  </button><br><br>                  
                  @endif

                   <table class="table table-bordered">
                     <thead class="head_table">
                       <tr>
                        <td>COA Pekerjaan</td>
                        <td>Item Pekerjaan</td>
                        <td>Volume</td>
                        <td>Unit</td>
                        <td>Satuan</td>
                        <td>Perubahan Data</td>
                       </tr>
                     </thead>
                     @if ( $itempekerjaan != "" )
                     <tbody>                          
                      <tr>
                        <td><strong>{{ $itempekerjaan->code }}</strong></td>
                        <td><strong>{{ $itempekerjaan->name }}</strong></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      @foreach ( $itempekerjaan->child_item as $key3 => $value3 )
                      <tr>
                        <td><strong>{{ $value3->code }}</strong></td>
                        <td>{{ $value3->name }}</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      @if ( count($value3->child_item) > 0 )
                        @foreach ( $value3->child_item as $key4 => $value4 )
                        <tr class="class_{{ $value3->id}}">
                          <td><strong>{{ $value4->code }}</strong></td>
                          <td>{{ $value4->name }}</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                          @if ( count($value4->child_item) > 0 )
                            @foreach ( $value4->child_item as $key5 => $value5 )
                            @php
                              $rabdetail = \Modules\Rab\Entities\RabPekerjaan::where("rab_unit_id",$rab->id)->where("itempekerjaan_id",$value5->id)->get()->first()
                            @endphp
                            <tr class="class_{{ $value3->id}}">
                              <td><strong>{{ $value5->code }}</strong></td>
                              <td>                                    
                                  {{ $value5->name }}                             
                              </td>
                              <td>
                                <span class="labels" id="label_rab_volume_{{ $rabdetail->id }}">{{ $rabdetail->volume }}</span>
                                <input class="values" type="text" id="input_rab_volume_{{ $rabdetail->id}}" value="{{ $rabdetail->volume }}" style="display: none;">
                              </td>
                              <td>
                                <span class="labels" id="label_rab_nilai_{{ $rabdetail->id }}">{{ $rabdetail->nilai }}</span>
                                <input class="values" type="text" id="input_rab_nilai_{{ $rabdetail->id}}" value="{{ $rabdetail->nilai }}" style="display: none;">
                              </td>
                              <td>
                                <span class="labels" id="label_rab_satuan_{{ $rabdetail->id }}">{{ $rabdetail->satuan }}</span>
                                <input class="values" type="text" id="input_rab_satuan_{{ $rabdetail->id}}" value="{{ $rabdetail->satuan }}" style="display: none;">
                              </td>
                              <td>
                                <button class="btn-edit1 btn btn-warning" onclick="viewdite('{{ $rabdetail->id }}')" id="btn_edit_{{ $rabdetail->id}}">Edit</button>
                                <button class="btn-edit2 btn btn-success" onclick="saveedit('{{ $rabdetail->id }}')" style="display: none;" id="btn_edit2_{{ $rabdetail->id }}">Edit</button>
                              </td>
                            </tr>
                            @endforeach
                          @endif
                        @endforeach
                      @endif
                      @endforeach
                    </tbody>
                    @endif
                  </table>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane active" id="tab_2">
                 <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
                    Tambah Unit
                  </button><br><br>
                  <table class="table">
                     <thead class="head_table">
                       <tr>
                        <td>Unit</td>
                        <td>Delete</td>
                       </tr>
                     </thead>
                     <tbody>
                        @foreach ( $rab->units as $key => $value )
                        <tr>
                          <td>{{ $value->asset->name }}</td>
                          <td><button type="button" class="btn btn-danger" onclick="removeunit('{{ $value->id }}')">Delete</button></td>
                        </tr>
                        @endforeach
                     </tbody>
                   </table>
                </div>
              </div>
              <!-- /.tab-content -->
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
  <div class="modal fade" id="modal-info">

    <form action="{{ url('/')}}/rab/save-pekerjaan" method="post">
      <input type="hidden" name="rab" id="rab" value="{{ $rab->id }}">
      {{ csrf_field() }}
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Unit</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Pilih Unit</label>
              <select class="form-control" id="item_coa">
                <option value="">( pilih item pekerjaan )</option>
                @foreach ( $rab->workorder->parent_id as $key => $value )
                <option value="{{ \Modules\Pekerjaan\Entities\Itempekerjaan::where('code',$value['coa_code'])->get()->first()->id }}">{{ \Modules\Pekerjaan\Entities\Itempekerjaan::where("code",$value['coa_code'])->get()->first()->name }}</option>
                @endforeach
              </select>
            </div>
            <table class="table">
              <thead class="head_table">
                <tr>
                  <td>COA Pekerjaam</td>
                  <td>Item Pekerjaan</td>
                  <td>Volume</td>
                  <td>Satuan</td>
                  <td>Nilai</td>
                </tr>
              </thead>
              <tbody id="itempekerjaan">
                
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
      <!-- /.modal-dialog -->
    </form>

  </div>
  <!-- /.modal -->

  <div class="modal fade" id="modal-default">
    <form action="{{ url('/')}}/rab/save-units" method="post">
    <input type="hidden" value="{{ $rab->id }}" name="rab_unit_id">
    {{ csrf_field() }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Default Modal</h4>
        </div>

        <div class="modal-body">

          <table class="table">
            <thead class="head_table">
              <tr>
                <td>Unit</td>
                <td>keterangan</td>
                <td><input type="checkbox" value="" id="unit_rab_all" onclick="checkall();"> Select All</td>
              </tr>
            </thead>
            <tbody>
               @foreach ( $rab->workorder->details as $key => $value )
                  @if ( count(\Modules\Rab\Entities\RabUnit::where("rab_id",$rab->id)->where("asset_id",$value->asset_id)->get()) <= 0 )
                 <tr>
                    <td>{{ $value->asset->name }}</td>
                    <td>Fasilitas Kota</td>
                    <td>
                      <input type="checkbox" value="{{ $value->asset_id }}" class="rab_unit" name="unit_rab_[{{$key}}]">
                      <input type="hidden" value="{{ $value->asset_type }}" name="unit_rab_type_[{{$key}}]">
                    </td>
                 </tr>
                 @endif
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
@include("rab::app")
<!-- Select2 -->
<script type="text/javascript">
  function checkall() {
    if ( $("#unit_rab_all").is(":checked")){
      $(".rab_unit").attr("checked","checked");
    }else{
      $(".rab_unit").removeAttr("checked");
    }
  }

  function removeunit(id){
    if ( confirm("Apakah anda yakin ingin menghapus unit ini ?")){
      var request = $.ajax({
        url : "{{ url('/')}}/rab/delete-unit",
        data : {
          id : id
        },
        type : "post",
        dataType : "json"
      });

      request.done(function(data){
        if ( data.status == "0"){
          alert("Data unit telah dihapus ");
        }
        window.location.reload();
      })
    }else{
      return false;
    }
  }

  function viewdite(id){
    $(".labels").show();
    $("#label_rab_volume_" + id ).hide();
    $("#label_rab_nilai_" + id ).hide();
    $("#label_rab_satuan_" + id ).hide();
    $("#btn_edit_" + id).hide();
    $(".values").hide();
    $(".btn-edit1").show();

    $(".btn-edit2").hide();
    $("#input_rab_volume_" + id ).show();
    $("#input_rab_nilai_" + id ).show();
    $("#input_rab_satuan_" + id ).show();
    $("#btn_edit2_" + id).show();
    $("#btn_edit_" + id).hide();
  }

  function saveedit(id){
    var request = $.ajax({
      url : "/rab/saveedit",
      dataType : "json",
      data : {
        id : id,
        volume : $("#input_rab_volume_" + id ).val(),
        nilai : $("#input_rab_nilai_" + id ).val(),
        satuan : $("#input_rab_satuan_" + id ).val()
      },
      type : "post"
    });

    request.done(function(data){
      if ( data.status == "0"){
        alert("Data telah diupdate");
      }
      window.location.reload();
    })
  }

  function summary(id){
    var summary = parseInt($("#volume_" + id).val()) * parseInt($("#nilai_" + id).val());
    if ( summary == "NaN"){
      $("#total_" + id).text("");
    }else{
      $("#total_" + id).text(summary);
      $("#total_" + id).number(true);
    }
  }
</script>
</body>
</html>
