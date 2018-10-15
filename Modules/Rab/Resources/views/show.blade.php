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
                @if ( $rab->approval != "")
                <a class="btn btn-primary" href="{{ url('/')}}/rab/approval_history?id={{ $rab->id }}">Approval History</a>
                @endif
              </div>
            </div>
            <!-- /.col -->

            </form>
            <!-- /.col -->

          </div>
          <div class="nav-tabs-custom">

              <h3><strong>Nilai Workorder Rp {{ number_format($rab->workorder->nilai)}}</strong></h3>
              <h3><strong>Nilai RAB Rp {{ number_format($rab->nilai) }} </strong></h3>
              <ul class="nav nav-tabs">                
                <li><a href="#tab_3" data-toggle="tab">Item Pekerjaan</a></li>
                <li  class="active"><a href="#tab_2" data-toggle="tab">Unit</a></li>
              </ul>
              <div class="tab-content">                
                <!-- /.tab-pane -->
                <div class="tab-pane " id="tab_3">

                  @if ( $rab->approval == "" )
                    @if ( count($rab->units) > 0 && count($rab->pekerjaans) <= 0 )
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
                      Tambah Item Pekerjaan
                    </button><br><br>
                    @elseif ( count($rab->pekerjaans) > 0 )
                    <button type="button" class="btn btn-danger" onclick="deletepekerjaans('{{ $rab->id}}')">Hapus Pekerjaan</button>
                    @endif
                  @else
                    @php
                      $array = array (
                        "6" => array("label" => "Disetujui", "class" => "label label-success"),
                        "7" => array("label" => "Ditolak", "class" => "label label-danger"),
                        "1" => array("label" => "Dalam Proses", "class" => "label label-warning")
                      )
                    @endphp
                    <span class="{{ $array[$rab->approval->approval_action_id]['class'] }}">  
                          {{ $array[$rab->approval->approval_action_id]['label'] }}
                    </span>
                    @if ( $rab->approval->approval_action_id == "7")
                      <button type="button" class="btn btn-danger" onclick="deletepekerjaans('{{ $rab->id}}')">Hapus Pekerjaan</button>
                    @else
                    
                    @endif
                  @endif<br><br>

                  <table class="table table-bordered">
                   <thead class="head_table">
                     <tr>
                      <td>COA Pekerjaan</td>
                      <td>Item Pekerjaan</td>
                      <td>Volume</td>
                      <td>Sat</td>
                      <td>Hrg Sat</td>
                      <td>Subtotal</td>
                      <td>Bobot(%)</td>
                      <td>Perubahan Data</td>
                     </tr>
                   </thead>                     
                   <tbody>   
                    <tr>
                      <td>{{ $rab->pekerjaans->first()->itempekerjaan->parent->code or '' }}</td>
                      <td colspan="4">{{ $rab->pekerjaans->first()->itempekerjaan->parent->name or ''}}</td>
                      <td></td>
                      <td>
                        @php $total=0; @endphp
                        @foreach($rab->pekerjaans as $key => $value ) 
                        @php
                          $total = $total + ( (($value->nilai * $value->volume) / ( $rab->nilai / $rab->units->count()) ) * 100 ); 
                        @endphp
                        @endforeach

                        {{ $total }}    
                      </td>
                    </tr>

                    @foreach($rab->pekerjaans as $key => $value )                       
                    <tr>
                      <td><strong>{{ $value->itempekerjaan->code }}</strong></td>
                      <td><strong>{{ $value->itempekerjaan->name }}</strong></td>
                      <td>
                        <span class="labels" id="label_rab_volume_{{ $value->id }}">{{ number_format($value->volume,2) }}</span>
                        <input class="values" type="text" id="input_rab_volume_{{ $value->id}}" value="{{ $value->volume }}" style="display: none;">
                      </td>
                      <td>
                        <span class="labels" id="label_rab_satuan_{{ $value->id }}">{{ $value->satuan }}</span>
                        <input class="values" type="text" id="input_rab_satuan_{{ $value->id}}" value="{{ $value->satuan }}" style="display: none;">
                      <td>
                        <span class="labels" id="label_rab_nilai_{{ $value->id }}">{{ number_format($value->nilai,2) }}</span>
                        <input class="values" type="text" id="input_rab_nilai_{{ $value->id}}" value="{{ $value->nilai }}" style="display: none;">
                      </td>
                      </td>
                      <td>
                        <span class="labels" id="label_rab_nilai_{{ $value->id }}">{{ number_format($value->nilai * $value->volume,2) }}</span>
                        <input class="values" type="text" id="input_rab_nilai_{{ $value->id}}" value="{{ $value->nilai * $value->volume}}" style="display: none;">
                      </td>
                       <td>
                        <span class="labels" id="label_rab_nilai_{{ $value->id }}"> {{ number_format((($value->nilai * $value->volume) / ( $rab->nilai / $rab->units->count() ) * 100),2) }}</span>
                        <input class="values" type="text" id="input_rab_nilai_{{ $value->id}}" value="{{ $value->nilai * $value->volume}}" style="display: none;">
                      </td>
                      <td>
                        @if ( $rab->approval == "" )
                        <button class="btn-edit1 btn btn-warning" onclick="viewdite('{{ $value->id }}')" id="btn_edit_{{ $value->id}}">Edit</button>
                        <button class="btn-edit2 btn btn-success" onclick="saveedit('{{ $value->id }}')" style="display: none;" id="btn_edit2_{{ $value->id }}">Edit</button>
                        @else
                          @if ( $rab->approval->approval_action_id == "7")
                          <button class="btn-edit1 btn btn-warning" onclick="viewdite('{{ $value->id }}')" id="btn_edit_{{ $value->id}}">Edit</button>
                          <button class="btn-edit2 btn btn-success" onclick="saveedit('{{ $value->id }}')" style="display: none;" id="btn_edit2_{{ $value->id }}">Edit</button>
                          @endif
                        @endif
                      </td>
                    </tr>  
                    @endforeach

                  </tbody>
                </table>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane active" id="tab_2">
                  @if ( $rab->approval == "" )
                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
                    Tambah Unit
                  </button><br><br>
                  @else
                    @if ( $rab->approval->approval_action_id == "7")
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
                    Tambah Unit
                    </button><br><br>
                    @endif
                  @endif
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
                          <td>{{ $value->asset->name or '' }}</td>
                          <td>
                            @if ( $rab->approval == "" )
                            <button type="button" class="btn btn-danger" onclick="removeunit('{{ $value->id }}')">Delete</button>
                            @else
                              @if ( $rab->approval->approval_action_id == "7")
                                <button type="button" class="btn btn-danger" onclick="removeunit('{{ $value->id }}')">Delete</button>
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
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Pekerjaan</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Pilih Item Pekerjaan</label>
              <select class="form-control" id="item_coa">
                <option value="">( pilih item pekerjaan )</option>
                @foreach ( $rab->workorder->parent_id as $key => $value )
                @if ( $value['total_budget'] == "0" )
                <option value="">{{ \Modules\Pekerjaan\Entities\Itempekerjaan::where("code",$value['coa_code'])->get()->first()->name }}</option>
                @else
                <option value="{{ \Modules\Pekerjaan\Entities\Itempekerjaan::where('code',$value['coa_code'])->get()->first()->id }}">{{ \Modules\Pekerjaan\Entities\Itempekerjaan::where("code",$value['coa_code'])->get()->first()->name }}</option>
                @endif
                @endforeach
              </select>
            </div>
            <div class="form-group" style="display: none;">
              <label></label>
              <select class="form-control" id="item_child_coa">
                
              </select>
            </div>
            <h4>Budget Terpakai : <strong><span id="budget_total"></span></strong></h4>
            <h4>Budget Tersisa : <strong><span id="budget_tersisa"></span></strong></h4>
            <input type="hidden" id="budget_total_val" value="" name="">
            <input type="hidden" id="budget_tahunan_id" name="budget_tahunan_id" >
            <input type="hidden" id="budget_tersisa_val" name="">
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
                <td><!--input type="checkbox" value="" id="unit_rab_all" onclick="checkall();"--></td>
              </tr>
            </thead>
            <tbody>
              @foreach ( $rab->workorder->details as $key => $value )
                @if ( $value->asset_type == "Modules\Project\Entities\Project")
                  @if ( count(\Modules\Rab\Entities\RabUnit::where("rab_id",$rab->id)->where("asset_id",$value->asset_id)->get()) <= 0 )
                  <tr>
                    <td>{{ $value->asset->name or ''}}</td>
                    <td>Fasilitas Kota</td>
                    <td>
                      <input type="checkbox" value="{{ $value->asset_id }}" class="rab_unit" name="unit_rab_[{{$key}}]">
                      <input type="hidden" value="{{ $value->asset_type }}" name="unit_rab_type_[{{$key}}]">
                    </td>
                 </tr>
                  @endif
                @elseif ( $value->asset_type == "Modules\Project\Entities\ProjectKawasan")
                  @if ( count(\Modules\Rab\Entities\RabUnit::where("rab_id",$rab->id)->where("asset_id",$value->asset_id)->get()) <= 0 )
                  <tr>
                    <td>{{ $value->asset->name or ''}}</td>
                    <td>Kawasan</td>
                    <td>
                      <input type="checkbox" value="{{ $value->asset_id }}" class="rab_unit" name="unit_rab_[{{$key}}]">
                      <input type="hidden" value="{{ $value->asset_type }}" name="unit_rab_type_[{{$key}}]">
                    </td>
                 </tr>
                 @endif
                @endif
              @endforeach
              @foreach ( $project->unittype as $key3 => $value3)
                <tr>
                  <td>{{ $value3->name }}</td>
                  <td>Unit Type</td>
                  <td>
                    <input type="radio" name="type" value="{{ $value3->id }}" onClick="conCostSelect('{{ $value3->id }}')">
                  </td>
               </tr>
              @endforeach
              @foreach ( $rab->workorder->details as $key4 => $value4 )
                <tr class="type type_{{ $value4->asset->type->id or '' }}" style="display: none;">
                  <td>{{ $value4->asset->name }}</td>
                  <td>{{ $value4->asset->type->name or ''}}</td>
                  <td>
                    <input type="checkbox" name="unit_rab_[{{$value4->asset_id}}]" value="{{ $value4->asset_id }}">Pilih ke RAB
                    <input type="hidden" value="{{ $value4->asset_type }}" name="unit_rab_type_[{{$value4->asset_id}}]">
                  </td>
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
@include("rab::app")
<!-- Select2 -->
<script type="text/javascript">

</script>
</body>
</html>
