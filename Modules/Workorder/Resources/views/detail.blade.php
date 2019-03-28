<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard </title>
  @include("master/header")
    <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('/')}}/assets/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Workorder</h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">   
              <select class="select2" style="display: none;"></select>
              <h3 class="box-title">Tambah Data Workorder</h3>           
              <form action="{{ url('/')}}/workorder/update" method="post" name="form1">
                {{ csrf_field() }}
              <input type="hidden" name="workorder_id" value="{{ $workorder->id }}">
              <input type="hidden" name="project_id" value="{{ $project->id }}">
              <div class="form-group">
                <label>No. Workorder</label>
                <input type="text" class="form-control" name="workorder_name" value="{{ $workorder->no }}" readonly>
              </div>  
              <div class="form-group">
                <label>Department In Charge</label>
                <select class="form-control" name="department_from" id="department_from">
                  <option value="">( pilih departemen ) </option>
                  @foreach ( $department as $key => $value )
                   
                      @if ( $value->id == $workorder->department_from )
                      <option value="{{ $value->id}}" selected>{{ $value->name }}</option>
                      @else
                       <option value="{{ $value->id}}">{{ $value->name }}</option>
                      @endif
                  @endforeach
                </select>
              </div>  
              <div class="form-group">
                <label>Department Support</label>
                <select class="form-control" name="department_to">
                  @foreach ( $department as $key => $value )
                   @if ( $value->id == $workorder->department_from )
                      <option value="{{ $value->id}}" selected>{{ $value->name }}</option>
                      @else                      
                      <option value="{{ $value->id}}">{{ $value->name }}</option>
                      @endif
                  @endforeach
                </select>
              </div>  
              <div class="form-group">
                <label>Nilai Workorder(Rp)</label>
                <h3><strong>{{ number_format($workorder->nilai) }}</strong></h3>
              </div>
                               
              <div class="box-footer">
                @if ( count($workorder->detail_pekerjaan) > 0 && count($workorder->details) > 0 )
                  @if ( $workorder->approval == "" )
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-info" onclick="woapprove('{{ $workorder->id }}')">Request Approve</button>
                  @else
                    @php
                      $array = array (
                        "6" => array("label" => "Disetujui", "class" => "label label-success"),
                        "7" => array("label" => "Ditolak", "class" => "label label-danger"),
                        "1" => array("label" => "Dalam Proses", "class" => "label label-warning")
                      )
                    @endphp
                    <span class="{{ $array[$workorder->approval->approval_action_id]['class'] }}">{{ $array[$workorder->approval->approval_action_id]['label'] }}</span>
                    <a href="{{ url('/')}}/workorder/approval_history/?id={{ $workorder->id}}" class="btn btn-primary">History Approval</a>
                    @if ( $workorder->approval->approval_action_id == "7")
                      <button type="button" class="btn btn-info" onclick="woupdapprove('{{ $workorder->id }}')">Request Approve</button>
                    @elseif ( $workorder->approval->approval_action_id == "6")
                      <a class="btn btn-info" href="{{ url('/')}}/rab/?workorder_id={{$workorder->id}}">RAB</a>
                    @endif
                  @endif
                @else
                <ul>
                  <li>Workorder harus memiliki pekerjaan</li>
                  <li>Workorder harus memiliki unit</li>
                </ul>
                <button type="submit" class="btn btn-primary">Simpan</button>
                @endif
                <a href="{{ url('/')}}/workorder" class="btn btn-warning">Kembali</a>
                
              </div>
              
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
             <div class="col-md-6">
              <h3>&nbsp;</h3>
              <div class="form-group">
                <label>Start Date</label>
                <input type="text" class="form-control" name="start_date" id="start_date" autocomplete="off" value="{{  date('d/M/Y', strtotime($workorder->date)) }}" required>
              </div> 
              <div class="form-group">
                <label>Keterangan</label>
                <input type="text" class="form-control" name="workorder_description" value="{{ $workorder->description }}">
              </div> 
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="workorder_name" value="{{ $workorder->name }}" required>
              </div>
            </div>
            </form>
            <!-- /.col -->
          </div>
          <div class="nav-tabs-custom">
              
              <ul class="nav nav-tabs">                
                <li class="active"><a href="#tab_3" data-toggle="tab">1. Item Pekerjaan</a></li>
                <li><a href="#tab_2" data-toggle="tab">2. Unit</a></li>
              </ul>
              <div class="tab-content">                
                <!-- /.tab-pane -->
                <div class="tab-pane active table-responsive" id="tab_3">
                    @if ( $workorder->approval == "" )
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
                      Tambah Item Pekerjaan
                    </button>
                    @else
                      @if ( $workorder->approval->approval_action_id == "7")
                         <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
                            Tambah Item Pekerjaan
                          </button>
                      @endif
                    @endif<br>
                    <table class="table table-bordered">
                     <thead class="head_table">
                       <tr>
                        <td>COA</td>
                        <td>Item Pekerjaan</td>
                        <td>No. Budget Tahunan</td>
                        <td>Volume</td>
                        <td>Satuan</td>
                        <td>Nilai(Rp)</td>
                        <td>Subtotal(Rp)</td>
                        <td>Status Dokumen</td>
                        <td>Delete</td>
                       </tr>
                     </thead>
                     <tbody id="detail_item">
                       @foreach ( $workorder->detail_pekerjaan as $key => $value )
                         @if ( $value->budget_tahunan != "" )
                         <tr>
                            <td>{{ $value->itempekerjaan->code or ''}}</td>
                            <td>{{ $value->itempekerjaan->name or ''}}</td>
                            <td>{{ $value->budget_tahunan->no}}</td>
                            <td>{{ number_format($value->volume)}}</td>
                            <td>{{ $value->itempekerjaan->details->satuan or ''}}</td>
                            <td>{{ number_format($value->nilai)}}</td>
                            <td>{{ number_format($value->volume * $value->nilai,2)}}</td>
                            <td>
                              @if ( count($value->dokumen) > 0 )
                                <h3>Sudah</h3>                              
                              @endif
                                <a href="{{ url('/')}}/workorder/dokument?id={{$value->id}}" class="btn btn-info">Upload</a>
                            </td>
                            <td>
                              @if ( $workorder->approval != "")
                                @if ( $workorder->approval->approval_action_id == 7 ) 
                                <button class="btn btn-success" data-toggle="modal" data-target="#modal-default" onClick="updateWorkorder('{{$value->id}}','{{ $value->volume }}','{{$value->nilai}}','{{ $value->itempekerjaan->name }}')">Edit</button>
                                <small class="label pull-right bg-red"><i class="fa fa-fw fa-remove" onclick="removepekerjaan('{{ $value->id }}')">&nbsp;</i></small>
                                @elseif ( $workorder->approval->approval_action_id == 6)
                                @endif
                              @else 
                                <button class="btn btn-success" data-toggle="modal" data-target="#modal-editwo" onClick="updateWorkorder('{{$value->id}}','{{ $value->volume }}','{{$value->nilai}}','{{ $value->itempekerjaan->name }}')">Edit</button>
                                <i class="fa fa-fw fa-remove" onclick="removepekerjaan('{{ $value->id }}')"></i>
                              @endif
                            </td>
                         </tr>
                         @endif
                       @endforeach
                     </tbody>
                   </table> 
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane table-responsive" id="tab_2">
                  @if ( $workorder->approval == "" )
                    @if ( count($workorder->budget_parent) > 0 )
                    <a class="btn btn-info" href="{{ url('/')}}/workorder/unit?id={{ $workorder->id}}">
                        Tambah Unit
                    </a>
                    @else
                    <h4>Silahkan pilih Item Pekerjaan terlebih dahulu</h4>
                    @endif
                  @else
                    @if ( $workorder->approval->approval_action_id == "7")
                      <a class="btn btn-info" href="{{ url('/')}}/workorder/unit?id={{ $workorder->id}}">
                        Tambah Unit
                    </a>
                    @endif
                  @endif<br>
                  <table class="table table-bordered">
                     <thead class="head_table">
                       <tr>
                        <td>No.</td>
                        <td>Asset Type</td>
                        <td>Nama</td>
                        <td>Delete</td>
                       </tr>
                     </thead>
                     <tbody id="detail_item">
                       
                       @foreach ( $workorder->details as $key => $value )
                        <tr>
                          <td>{{ $key + 1 }}</td>
                          <td>{{ str_replace("Modules\Project\Entities","",$value->asset_type) }}</td>
                          <td>
                            {{ $value->asset->name or ''}}
                            @if ( $value->asset_type == "Modules\Project\Entities\Unit")
                              @if ( $value->asset->type != "")
                                {{ $value->asset->type->name or '' }}
                              @endif
                            @endif
                          </td>
                          <td>
                            @if ( $workorder->approval == "" )
                            <button class="btn btn-danger" onclick="removeunitswo('{{ $value->id }}')">Delete</button>
                            @else
                              @php
                                $array = array (
                                  "6" => array("label" => "Disetujui", "class" => "label label-success"),
                                  "7" => array("label" => "Ditolak", "class" => "label label-danger"),
                                  "1" => array("label" => "Dalam Proses", "class" => "label label-warning")
                                )
                              @endphp
                              <span class="{{ $array[$workorder->approval->approval_action_id]['class'] }}">{{ $array[$workorder->approval->approval_action_id]['label'] }}</span>
                              @if ( $workorder->approval->approval_action_id == 7 )
                                <button class="btn btn-danger" onclick="removeunitswo('{{ $value->id }}')">Delete</button>
                              @endif
                            @endif
                          </td>
                       </tr>
                       @endforeach
                     </tbody>
                   </table> 
                </div>
              </div>
              <!-- /.tab-content -->
            </div
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
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <form action="{{ url('/')}}/workorder/choose-budget" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label>Fasilitas Kota / Cluster</label>            
              {{ csrf_field() }}
            <input type="hidden" name="workoder_par_id" value="{{ $workorder->id}}">
            <select class="form-control" name="budget_tahunan" id="budget_tahunan" required>
              <option value="">( pilih Fasilitas Kota / Cluster)</option>
              @foreach ( $workorder->departmentFrom->budgets as $key => $value )
              @if ( $value->deleted_at == "")
                @if ( $value->project_id == $project->id )
                  @foreach ( $value->budget_tahunans as $key2 => $value2 )
                  @if ( $value2->approval != "" )
                    @if ( $value2->approval->approval_action_id == 6 )
                      @if ( $value2->tahun_anggaran == date('Y') && $value2->nilai != "")
                        <option value="{{ $value2->id }}">{{ $value2->budget->kawasan->name or 'Fasilitas Kota'}}</option>
                      @endif
                    @endif
                  @endif
                  @endforeach
                @endif
              @endif
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <table id="tdsa">
              
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Pilih</button>
        </div>
      </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <div class="modal fade" id="modal-editwo">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit WO</h4>
        </div>
        <div class="modal-body">
          <form action="{{ url('/')}}/workorder/updatepekerjaan" method="post" name="form1">
            <input type="hidden" name="wokorder_detailpekerjaan_id" id="wokorder_detailpekerjaan_id">
            {{ csrf_field() }}
            <div class="form-group">
              <label>Item Pekerjaan</label>
              <input type="text" class="form-control" name="itempekerjaan_id" id="itempekerjaan_id" disabled>
            </div>
            <div class="form-group">
              <label>Volume</label>
              <input type="text" class="form-control" name="volume" id="volume" autocomplete="off" required>
            </div>
            <div class="form-group">
              <label>Nilai</label>
              <input type="text" class="form-control" name="nilai" id="nilai" autocomplete="off" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
          </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <!-- /.modal -->
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("workorder::app")
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<script type="text/javascript">

  $(function(){
    $('#start_date').datepicker({
      "dateFormat" : "yy-mm-dd"
    });
  })

  function disablebtn(id){
    var valor = [];
    $('input.disable_unit[type=checkbox]').each(function () {
        if (this.checked)
          valor.push($(this).val());
    });

    console.log(valor.length);

    if (valor.length < 1 ) {
      $("#btn_submit").attr("disabled","disabled");
    }else{
      $("#btn_submit").removeAttr("disabled");
    }
  }

  function removepekerjaan(id){
    if ( confirm("Apakah anda yakin ingin menghapus data ini ? ")){
      var request = $.ajax({
        url : "{{ url('/')}}/workorder/deletepekerjaan",
        data : {
          id : id
        },
        dataType : "json",
        type : "post"
      });

      request.done(function(data){
        if ( data.status == "0"){
          alert("Data telah dihapus");
        }

        window.location.reload();
      })
    }else{
      return false;
    }
  }

  function updateWorkorder(id,volume,nilai,pekerjaan){
    $("#wokorder_detailpekerjaan_id").val(id);
    $("#volume").val(volume);
    $("#nilai").val(nilai);
    $("#nilai").number(true);
    $("#itempekerjaan_id").val(pekerjaan)
  }

  updateWorkorder('{{$value->id}}','{{ $value->volume }}','{{$value->nilai}}')
</script>
</body>
</html>
