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
      <h1>Data Proyek <strong>{{ $project->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <h3 class="box-title">Tambah Item Pekerjaan</h3>
              <h4>Project : <strong>{{ $budget_tahunan->budget->project->name }}</strong></h4>
              <h4>Kawasan :  <strong>{{ $budget_tahunan->budget->kawasan->name or '' }}</strong></h4>
              <button type="submit" class="btn btn-primary submitbtn" id="btn_submit">Simpan</button>
              <select class="select2" style="display: none;"></select>
              <a class="btn btn-warning" href="{{ url('/')}}/workorder/detail?id={{ $workorder->id}}">Kembali</a>
              @if ( $workorder->approval != "" )
                @if ( $workorder->approval_action_id == 7 )
                  <a href="{{ url('/')}}/workorder/non-budget?id={{$workorder->id}}&budget={{$budget_tahunan->id}}" class="btn btn-info">Item Pekerjaan non Budget</a>
                @endif
              @else
                <a href="{{ url('/')}}/workorder/non-budget?id={{$workorder->id}}&budget={{$budget_tahunan->id}}" class="btn btn-info">Item Pekerjaan non Budget</a>
              @endif
            </div>
            
            <!-- /.col -->
            <div class="col-md-12">
              <br>
              <div class="nav-tabs-custom">
              
              <ul class="nav nav-tabs">                
                <li class="active"><a href="#tab_1" data-toggle="tab">Item Pekerjaan</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active table-responsive" id="tab_1">
                  <form action="{{ url('/')}}/workorder/save-pekerjaan" method="post" name="form1" id="form1">
                    {{ csrf_field() }}
                  <input type="hidden" name="workorder_id" value="{{ $workorder->id }}">
                  <input type="hidden" name="budget_tahunan" value="{{ $budget_tahunan->id }}">
                  <table class="table" style="padding: 0" id="example3">
                    <thead class="head_table">
                      <tr>
                        <td>Set to WO</td>
                        <td>COA</td>
                        <td>Item Pekerjaan</td>
                        <td>Total Cashout <br>Budget SPK Tahun Berjalan </td>
                        <td>Sisa Cash Out <br>Budget SPK Tahun Berjalan </td>
                        <td>Volume</td>
                        <td>Satuan</td>
                        <td>Nilai(Rp)</td>
                        <td>Subtotal(Rp)</td>
                      </tr>
                    </thead>
                    <tbody>
                      @php $start = 0; @endphp
                      @foreach ( $budget_tahunan->total_parent_item as $key => $value )
                      @if ( $value['nilai'] > 0 && $value['volume'] > 0 && $value['cashout'] > 0 )
                        @php $itempekerjaan = \Modules\Pekerjaan\Entities\Itempekerjaan::find($value['id']); @endphp
                        <tr style="background-color: grey;color:white;font-weight: bolder">
                          <td>&nbsp;</td>
                          <td>{{ $itempekerjaan->code or ''}}</td>
                          <td>{{ $itempekerjaan->name or ''}}</td>
                          <td>
                            <input type="hidden" id="sum_{{$key}}" value="0">
                            <input type="hidden" name="limit_{{$key}}" id="limit_{{$key}}" value="{{  (($value['nilai'] * $value['volume']) * $value['cashout']) - $value['nilai_terpakai'] }}"/>
                            {{ number_format(($value['nilai'] * $value['volume']) * $value['cashout'],2 )}}
                          </td>
                          <td>{{ number_format( (($value['nilai'] * $value['volume']) * $value['cashout']) - $value['nilai_terpakai'],2) }}</td>
                          <td colspan="3"><span id="message_{{$key}}"></span></td>
                          <td><span id="total_{{$key}}"></span></td>
                        </tr>
                        @if ( $itempekerjaan->group_cost == 1 )
                          @foreach ( $itempekerjaan->child_item as $key2 => $value2 )
                            @php 
                            $explode = explode(".",$value2->code);
                            @endphp
                            @if ( count($explode) > 1 )
                              @if ( $explode[1] != "00")
                                <tr>
                                  <td><input type="checkbox" name="setwo[{{ $start}}]" value="{{ $start}}"></td>
                                  <td>{{ $value2->code or ''}}</td>
                                  <td>{{ $value2->name or ''}}</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>
                                    <input type="hidden" name="item_id[{{ $start}}]" class="form-control" value="{{ $value2->id or ''}}">
                                    <input type="text" name="volume[{{ $start}}]" id="volume_{{$start}}" class="form-control nilai_budget" value="{{ number_format($value2->volume,2) }}" onKeyUp="calculatewo('{{$start}}','{{$key}}')">
                                  </td>
                                  <td><input type="hidden" name="satuan[{{ $start}}]" class="form-control" value="{{ $value2->details->satuan or 'ls' }}"><input type="text" class="form-control" value="{{ $value2->details->satuan or 'ls' }}" readonly></td>
                                  @if ( count($value2->harga) > 0 )
                                  <td><input type="text" name="nilai[{{ $start}}]" id="nilai_{{$start}}" class="form-control nilai_budget" value="{{ number_format($value2->harga->last()->nilai,2)}}" onKeyUp="calculatewo('{{$start}}','{{$key}}')"></td>   
                                  @else                            
                                  <td><input type="text" name="nilai[{{ $start}}]" id="nilai_{{$start}}" class="form-control nilai_budget" value="0" onKeyUp="calculatewo('{{$start}}','{{$key}}')"></td>   
                                  @endif
                                  <td>
                                    <input type="hidden" class="subtotal_{{$key}}" id="subtotals_{{$start}}" value="0">
                                    <span id="subtotal_{{$start}}">0</span>
                                  </td>  
                                </tr>
                              @endif
                            @endif
                         
                          
                          @php $start++; @endphp
                          @endforeach
                        @else
                          <tr>
                            <td>
                              <input type="checkbox" name="setwo[{{ $start}}]" value="{{ $start}}">
                              <input type="hidden" name="item_id[{{ $start}}]" class="form-control" value="{{ $value2->id or ''}}">
                            </td>
                            <td>{{ $itempekerjaan->code or ''}}</td>
                            <td>{{ $itempekerjaan->name or ''}}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>
                              <input type="hidden" name="item_id[{{ $start}}]" class="form-control" value="{{ $itempekerjaan->id or ''}}">
                              <input type="text" name="volume[{{ $start}}]" id="volume_{{$start}}" class="form-control nilai_budget" value="{{ number_format($itempekerjaan->volume,2) }}" onKeyUp="calculatewo('{{$start}}','{{$key}}')">
                            </td>
                            <td><input type="hidden" name="satuan[{{ $start}}]" class="form-control" value="{{ $itempekerjaan->details->satuan or 'ls' }}"><input type="text" class="form-control" value="{{ $itempekerjaan->details->satuan or 'ls' }}" readonly></td>
                            @if ( count($itempekerjaan->harga) > 0 )
                            <td><input type="text" name="nilai[{{ $start}}]" id="nilai_{{$start}}" class="form-control nilai_budget" value="{{ number_format($itempekerjaan->harga->last()->nilai,2)}}" onKeyUp="calculatewo('{{$start}}','{{$key}}')"></td>   
                            @else                            
                            <td><input type="text" name="nilai[{{ $start}}]" id="nilai_{{$start}}" class="form-control nilai_budget" value="0" onKeyUp="calculatewo('{{$start}}','{{$key}}')"></td>   
                            @endif
                            <td>
                              <input type="hidden" class="subtotal_{{$key}}" id="subtotals_{{$start}}" value="0">
                              <span id="subtotal_{{$start}}">0</span>
                            </td>  
                          </tr>
                        @endif
                      @endif
                      @endforeach
                    </tbody>
                  </table>

                  <i class="fa fa-refresh ld ld-spin submitbtn" id="loading" style="display: none;"></i>

                  <!--a href="{{ url('/')}}/workorder/non-budget?id={{ $workorder->id }}&budget={{ $budget_tahunan->id}}" class="btn btn-info">Draft Budget Tambahan</a-->
                </div>
              </div>
              <!-- /.tab-content -->
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
 @include("master/copyright")
  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include("master/footer_table")
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
@include("workorder::app")
<script type="text/javascript">
  $("#btn_submit").click(function(){
    $(".submitbtn").hide();
    $("#loading").show();
    $("#form1").submit();
  });
</script>
</body>
</html>
