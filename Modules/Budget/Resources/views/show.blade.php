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
      <h1>Data Proyek <strong>{{ $budget->project->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12"><h3 class="box-title">Detail Data Budget Proyek</h3></div>
            <div class="col-md-6">             
              
              <form action="{{ url('/')}}/budget/update-budget" method="post" name="form1">
              {{ csrf_field() }}
              <input type="hidden" name="project_id" id="project_id" value="{{ $budget->project->id }}">
              <input type="hidden" name="budget_id" id="budget_id" value="{{ $budget->id }}">
              <div class="form-group">
                <label>Proyek</label>
                <input type="text" class="form-control" value="{{ $budget->project->name }}" readonly>
              </div>
              <div class="form-group">
                <label>PT</label>
                <select class="form-control" name="department">
                 @if ( $user->project_pt_users != "" )
                    @foreach ( $user->project_pt_users as $key2 => $value2 )
                      @foreach ( $project->pt as $key => $value )
                        @if ( $value2->pt_id == $value->pt->id )
                          <option value="{{ $value->pt->id }}">{{ $value->pt->name }}</option>
                        @endif
                      @endforeach
                    @endforeach
                  @endif
                </select>
              </div>
              <div class="form-group">
                <label>Departemen</label>
                <select class="form-control" name="department">
                  @foreach ( $department as $key => $value )
                     @if ( $value->id == $budget->department_id)
                        <option value="{{ $value->id }}" selected>{{ $value->name }}</option>
                     @else
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                     @endif
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Kawasan</label>
                @if ( $budget->project_kawasan_id == "" )
                  <input type="checkbox" name="iskawasan" id="iskawasan" onClick="setkawasan();">
                  <select class="form-control" name="kawasan" id="kawasan" style="display: none;" >
                    @foreach ( $budget->project->kawasans as $key2 => $value2 )                    
                    <option value="{{ $value2->id }}">{{ $value2->name }}</option>
                    @endforeach 
                  </select>
                @else
                  
                  @if ( $budget->approval != "" )
                    @if ( $budget->approval->approval_action_id == 6 )
                    <input type="checkbox" name="iskawasan" id="iskawasan" onClick="setkawasan();" checked disabled>
                    <select class="form-control" name="kawasan" id="kawasan" disabled>
                      @foreach ( $budget->project->kawasans as $key2 => $value2 )
                      @if ( $value2->id == $budget->project_kawasan_id )
                      <option value="{{ $value2->id }}" selected>{{ $value2->name }}</option>
                      @else                    
                      <option value="{{ $value2->id }}">{{ $value2->name }}</option>
                      @endif
                      @endforeach 
                    </select>
                    @else
                      <input type="checkbox" name="iskawasan" id="iskawasan" onClick="setkawasan();" checked>
                      <select class="form-control" name="kawasan" id="kawasan" disabled>
                      @foreach ( $budget->project->kawasans as $key2 => $value2 )
                        @if ( $value2->id == $budget->project_kawasan_id )
                          <option value="{{ $value2->id }}" selected>{{ $value2->name }}</option>
                        @else                    
                          <option value="{{ $value2->id }}">{{ $value2->name }}</option>
                        @endif
                      @endforeach 
                      </select>
                    @endif
                  @else
                    <input type="checkbox" name="iskawasan" id="iskawasan" onClick="setkawasan();" checked>
                    <select class="form-control" name="kawasan" id="kawasan">
                    @foreach ( $budget->project->kawasans as $key2 => $value2 )
                      @if ( $value2->id == $budget->project_kawasan_id )
                        <option value="{{ $value2->id }}" selected>{{ $value2->name }}</option>
                      @else                    
                        <option value="{{ $value2->id }}">{{ $value2->name }}</option>
                      @endif
                    @endforeach 
                    </select>
                  @endif
                @endif
               
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Start Date</label>
                <input type="text" class="form-control" name="start_date" id="start_date" value="{{ $budget->start_date->format('d/m/Y') }}">
              </div>
              <div class="form-group">
                <label>End Date</label>
                <input type="text" class="form-control" name="end_date" id="end_date" value="{{ $budget->end_date->format('d/m/Y') }}">
              </div>
              <div class="form-group">
                <label>Keterangan Date</label>
                <input type="text" class="form-control" name="description" value="{{ $budget->description }}">
              </div>
              <div class="box-footer">
                @if ( $budget->approval == "" )
                <button type="submit" class="btn btn-primary">Simpan</button>                
                @endif
                <a class="btn btn-warning" href="{{ url('/')}}/budget/proyek/">Kembali</a>
                @if ( $budget->draft != "")
                <a href="{{ url('/')}}/budget/draft?id={{ $budget->id }}" class="btn btn-primary">Draft Budget Tambahan</a>
                @endif

                @if ( $budget->approval != "")
                <a href="{{ url('/')}}/budget/approval?id={{ $budget->id }}" class="btn btn-info">Approval History</a>
                @endif
              </div>
              </form>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-12 table-responsive">
              <h3>Nilai Dev Cost ( SPK + Sisa Renc. ): Rp. {{ number_format($budget->total_dev_cost)}}</h3>
              <h3>Nilai Con Cost ( SPK + Sisa Renc. ): Rp. {{ number_format($budget->total_con_cost)}}</h3>
              <h3>Nilai Budget Sisa Renc. (DC) : Rp. {{ number_format($budget->total_rencana_dev_cost)}}</h3>
              <h3>Nilai Budget Sisa Renc. (CC) : Rp. {{ number_format($budget->total_rencana_con_cost)}}</h3>
              <br>
              
            <table class="table" style="padding: 0" id="example3">
                <thead class="head_table">
                  <tr>
                    <td>COA</td>
                    <td>Item Pekerjaan</td>
                    <td>Volume</td>
                    <td>Satuan</td>
                    <td>Harga Satuan(Rp)</td>
                    <td>Subtotal(Rp)</td>
                    <td>Perubahan Data</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $budget->details as $key => $value )
                  @if ( $value->volume > 0 )
                    @php $class = "class_1"; @endphp
                  @else
                    @php $class = "class_0"; @endphp
                  @endif
                   <tr class="nilai {{ $class }}">
                    <td>
                      <input type="hidden" name="item_pekerjaan_id_{{ $value->id }}" id="item_pekerjaan_id_{{ $value->id }}" style="display: none;" class="form-control" value="{{ $value->itempekerjaan->id }}">
                      <input type="text" name="item_id_{{ $value->id }}" id="item_id_{{ $value->id }}" style="display: none;" class="form-control" value="{{ $value->id }}">
                      @if ( $value->itempekerjaan->code == "225.01" || $value->itempekerjaan->code == "225.04" || $value->itempekerjaan->code == "225.05" )                    
                      {{ $value->itempekerjaan->code or '' }}
                      @else
                      {{ $value->itempekerjaan->code or '' }}
                      @endif
                    </td>
                    <td>{{ $value->itempekerjaan->name }}</td>
                    <td>
                      <span id="label_volume_{{ $value->id }}">{{ number_format($value->volume) }}</span>
                      <input type="text" name="volume_{{ $value->id }}" id="volume_{{ $value->id }}" style="display: none;" class="form-control" value="{{ $value->volume }}">
                    </td>
                    <td>{{ $value->itempekerjaan->details->satuan or 'ls' }}</td>
                    <td>
                      <span id="label_nilai{{ $value->id }}">{{ number_format($value->nilai,2) }}</span>
                      <input type="text" name="nilai_{{ $value->id }}" id="nilai_{{ $value->id }}" style="display: none;" class="form-control" value="{{ $value->nilai }}">
                    </td>
                    <td>{{ number_format($value->volume * $value->nilai,2)}}</td>
                    <td>
                       @if ( $budget->approval == "" )
                        <a class="btn btn-warning" id="btn_edit1_{{ $value->id }}" href="{{ url('/')}}/budget/referensi/?id={{ $value->id }}">Edit</a>
                        <button class="btn btn-success" id="btn_edit2_{{ $value->id }}" onclick="saveedit('{{ $value->id }}');" style="display: none;">Simpan</button>
                        @else
                          @if ( $budget->approval->approval_action_id == "7")
                            <a class="btn btn-warning" id="btn_edit1_{{ $value->id }}" href="{{ url('/')}}/budget/referensi/?id={{ $value->id }}">Edit</a>
                            <button class="btn btn-success" id="btn_edit2_{{ $value->id }}" onclick="saveedit('{{ $value->id }}');" style="display: none;">Simpan</button>
                          @else
                            @if ( $value->approval != "" )
                            <span class="{{ $array[$value->approval->approval_action_id]['class']}}">{{ $array[$value->approval->approval_action_id]["label"]}}</span>
                            @endif
                          @endif
                        @endif    
                    </td>
                  </tr>
                  @endforeach 
                </tbody>
              </table>
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
@include("budget::app")
<script type="text/javascript">
  $(function () {
      $('#example3').DataTable({
        'searching' : true,
        'paging' : false
      });
  });
  function showcoa(nilai){
    if ( nilai == 9 ){
      $(".nilai").show();
    }else if ( nilai == 1 ){
      $(".nilai").hide();
      $(".class_1").show();
    }else if ( nilai == 0 ){
      $(".nilai").hide();
      $(".class_0").show();
    }
  }
</script>
</body>
</html>
