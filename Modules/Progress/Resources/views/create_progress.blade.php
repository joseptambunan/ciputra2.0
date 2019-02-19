<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_progress")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <!-- Main content -->
    <section class="content">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data SPK </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="{{ url('/')}}/progress/saveprogress" method="post" name="form1">
                <input type="hidden" name="spk_id" value="{{ $spk->id }}">
                <input type="hidden" name="unit_id" value="{{ $unit->id }}">
                <input type="hidden" name="unitprogress" id="unitprogress" value="{{ $unitprogress->count() }}">
                <input type="hidden" name="start_date" id="start_date" value="{{ $spk->start_date->format('Y/m/d') }}">   
                <input type="hidden" name="finish_date" id="finish_date" value="{{ $spk->finish_date->format('Y/m/d') }}">               
                <input type="hidden" name="durasi" id="durasi" value="{{ $spk->tender->durasi }}">
                <div class="form-group">
                    <label for="exampleInputEmail1">No. SPK</label>
                    <input type="text" class="form-control" name="document" value="{{ $spk->no}}" readonly>
                </div>   
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama. SPK</label>
                    <input type="text" class="form-control" name="document" value="{{ $spk->name}}" readonly>
                </div>  
                <div class="form-group">
                    <label for="exampleInputEmail1">Unit Name </label>
                    <input type="text" class="form-control" value="{{ $unit->rab_unit->asset->name }}" readonly>
                </div>                 
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <a href="{{ url('/') }}/progress/show?id={{ $spk->id}}" class="btn btn-warning">Kembali</a>
                </div>   
                {{ csrf_field() }}                  
                <div class="col-md-12">
                @if ( $unit->rab_unit->asset_type == "Modules\Project\Entities\Unit") 
                <table class="table table-bordered">
                  <thead class="head_table">
                    <tr>
                      <td>Escrow Name</td>
                      <td>Progress Saat Ini</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Pondasi</td>
                      <td>{{ number_format($unit->escrow_atap * 100 ,2) }} % </td>
                    </tr>
                    <tr>
                      <td>Atap</td>
                      <td>{{ number_format($unit->escrow_dinding * 100 ,2) }} % </td>
                    </tr>
                    <tr>
                      <td>Progress</td>
                      <td><span id="label_progress"></span></td>
                    </tr>
                  </tbody>
                </table>
                @endif 

                <table class="table table-bordered">
                  <thead class="head_table">
                    <tr>
                      <td>&nbsp;</td>
                      <td>Tanggal Mulai</td>
                      <td>Tanggal Selesai</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>SPK</td>
                      <td>{{ $spk->start_date->format("d/M/Y")}}</td>
                      <td>{{ $spk->finish_date->format("d/M/Y")}}</td>
                    </tr>
                    <tr>
                      <td>Fisik</td>
                      <td><span id="start_fisik">{{ $spk->start_date->format("d/M/Y")}}</span></td>
                      <td><span id="start_fisik">{{ $spk->finish_date->format("d/M/Y")}}</span></td>
                    </tr>
                  </tbody>
                </table>
 

                <center><h3>Progress</h3></center>
                <hr>
                <div class="table-responsive">
                  {{ csrf_field() }}                      
                  <input type="hidden" name="spk_progress_id" value="{{ $spk->id }}">
                  <input type="hidden" name="unit_progress_id" value="{{ $unit->id }}">
                <i class="fa fa-refresh ld ld-spin" id="loading" style="display: none;"></i>
                  <button type="button" onClick="simpanprogress()" class="btn btn-primary" id="btnsimpan">Simpan Jadwal Progress</button>
                  <table class="table table-bordered">
                    <thead class="head_table">
                      <tr>
                        <td>Item Pekerjaan</td>   
                        <td>Bobot RAB(%)</td> 
                        <td>Target Tanggal Mulai</td>
                        <td>Target Tanggal Selesai</td>
                        <td>Real Tanggal 100%</td>
                        <td>Delta Hari</td>  
                        <td>Progress s/d Lalu(%)</td>
                        <td>Progress s/d Skrg(%)</td>    
                        <td>Nilai Bobot(%)</td>    
                        <td>Tambah Progress</td>
                      </tr>
                    </thead>
                   <tbody>
                    @php $nilai = 0; $real_bobot = 0; @endphp

                      @foreach ( $unitprogress as $key2 => $value2 )
                        @if ( $value2->spkvo_unit->head_type != "Modules\Spk\Entities\Vo")
                        <tr style="{{ $arrayEscrow[$value2->itempekerjaan->escrow_id]['style'] }}">                                
                            <td>
                              <input type="hidden" name="unitprogress_id_[{{$key2}}]" value="{{ $value2->id}}">
                              {{ $value2->itempekerjaan->name }}<br> {{ $arrayEscrow[$value2->itempekerjaan->escrow_id]['label']  }}
                            </td> 
                            <td>{{ number_format($value2->bobot_rab * ($spk->details->count()),2) }} </td>
                            <td>
                              @if ( $value2->mulai_jadwal_date == NULL )
                                <input type="text" name="start_date_[{{$key2}}]" id="start_date_{{$key2}}" class="form-control start_date" value="">
                              @else
                                <input type="text" name="start_date_[{{$key2}}]" id="start_date_{{$key2}}" class="form-control start_date" value="{{ $value2->mulai_jadwal_date}}">                                
                              @endif
                            </td>
                            <td>
                              @if ( $value2->selesai_jadwal_date == NULL )                              
                                  <input type="text" name="end_date_[{{$key2}}]" id="end_date_{{$key2}}" class="form-control end_date" >
                              @else
                                <input type="text" name="end_date_[{{$key2}}]" id="end_date_{{$key2}}" class="form-control start_date" value="{{ $value2->selesai_jadwal_date}}"> 
                              @endif
                            </td>
                            <td>
                              @if ( $value2->selesai_actual_date == "" )

                              @else
                                {{ $value2->selesai_actual_date->format("d/M/Y")}}
                              @endif
                            </td>
                            <td>
                              
                            </td>
                            <td>{{ number_format($value2->progres_sebelumnya,2)}}</td> 
                            <td>
                              <input type="hidden" name="unit_progress_id[{{ $key2}}]" value="{{ $value2->id }}">
                              @if ( $value2->mulai_jadwal_date != "" && $value2->selesai_jadwal_date != "" )
                              <input type="hidden" class="form-control nilai_budget" name="progress_saat_ini_[{{ $key2}}]" value="{{ number_format($value2->progresslapangan_percent,2) * 100 }}" autocomplete="off" /> 
                              <span>{{ number_format($value2->progresslapangan_percent,2) * 100 }}</span>
                              @endif
                              </td>      
                            <td> {{ number_format ( $real_bobot_s = ( ( $value2->progresslapangan_percent * 100 ) / 100 ) * ( $value2->bobot_rab * ($spk->details->count())),2)}}</td> 
                            <td>
                               @if ( $value2->mulai_jadwal_date != "" && $value2->selesai_jadwal_date != "" )
                               <a href="{{ url('/')}}/progress/tambah?id={{$value2->id}}" class="btn btn-info">Tambah Progress</a>
                               @endif
                             </td>                               
                        </tr>   
                        @php $nilai = $nilai + ($value2->bobot_rab * ($spk->details->count()) ); $real_bobot = $real_bobot + $real_bobot_s; @endphp
                        @endif
                      @endforeach 
                      <tr>
                        <td>Total</td>
                        <td>{{ number_format($nilai,2) }} %</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input type="hidden" name="label_progress_val" id="label_progress_val" value="{{ number_format($real_bobot,2) }}"/>{{ number_format($real_bobot,2) }} %</td>
                        <td>&nbsp;</td>
                      </tr>                       
                    </tbody>
                  </table>
                </div>
                
                <label>Keterangan</label>
                <textarea name="description" rows="3" class="form-control"></textarea>

                <center><h3>Variation Order</h3></center>
                <hr>
                <table class="table table-bordered">
                  <thead class="head_table">
                    <tr>
                      <td>Item Pekerjaan</td>   
                      <td>Bobot</td>                      
                      <td>Target Tanggal Mulai</td>
                      <td>Target Tanggal Selesai</td>
                      <td>Real Tanggal 100%</td>
                      <td>Delta Hari</td>  
                      <td>Progress s/d Lalu(%)</td>
                      <td>Progress s/d Skrg(%)</td>    
                      <td>Nilai Bobot(%)</td>    
                    </tr>
                  </thead>
                 <tbody>
                  @php $nilai = 0; $real_bobot = 0; @endphp
                  @foreach ( $unitprogress as $key2 => $value2 )
                    @if ( $value2->spkvo_unit->head_type == "Modules\Spk\Entities\Vo")
                    <tr style="{{ $arrayEscrow[$value2->itempekerjaan->escrow_id]['style'] }}">                                
                        <td>
                          {{ $value2->itempekerjaan->name }}<br> {{ $arrayEscrow[$value2->itempekerjaan->escrow_id]['label']  }}
                        </td> 
                        <td>{{ number_format( $bobot = ( ($value2->volume * $value2->nilai ) / $spk->nilai_vo ) * 100 ,2) }}</td>
                       <td>
                            @if ( $value2->mulai_jadwal_date == NULL )
                              <input type="text" name="start_date_[{{$key2}}]" id="start_date_{{$key2}}" class="form-control start_date" value="">
                            @else
                              <input type="text" name="start_date_[{{$key2}}]" id="start_date_{{$key2}}" class="form-control start_date" value="{{ $value2->mulai_jadwal_date->format('d/M/Y')}}">                                
                            @endif
                          </td>
                          <td>
                            @if ( $value2->selesai_jadwal_date == NULL )                              
                                <input type="text" name="end_date_[{{$key2}}]" id="end_date_{{$key2}}" class="form-control end_date" >
                            @else
                              <input type="text" name="end_date_[{{$key2}}]" id="end_date_{{$key2}}" class="form-control start_date" value="{{ $value2->selesai_jadwal_date->format('d/M/Y')}}"> 
                            @endif
                          </td>
                          <td>
                            @if ( $value2->selesai_actual_date == "" )

                            @else
                              {{ $value2->selesai_actual_date->format("d/M/Y")}}
                            @endif
                          </td>
                          <td>
                            @php $beda = 0; @endphp
                            @if ( $value2->selesai_actual_date != "" && $value2->selesai_jadwal_date != "" )
                              @php
                                $start = new Datetime($value->selesai_jadwal_date);
                                $finish = new Datetime($value->selesai_actual_date);
                                $beda = $finish->diff($start)                       
                              @endphp
                              {{ $beda }}
                            @endif
                          </td>
                        <td>{{ number_format($value2->progres_sebelumnya,2)}}</td>  
                        <td>

                          <input type="hidden" name="unit_progress_id[{{ $key2}}]" value="{{ $value2->id }}">
                          <input type="text" class="form-control nilai_budget" name="progress_saat_ini_[{{ $key2}}]" value="{{ number_format($value2->progresslapangan_percent,2) * 100 }}" autocomplete="off" disabled /> 
                        </td>    
                        <td>{{ number_format( $value2->progresslapangan_percent * $bobot ) }} %</td>                                 
                    </tr>   
                    
                    @endif
                  @endforeach 
                   
                  </tbody>
                </table>
                <label>Keterangan</label>
                <textarea name="description" rows="3" class="form-control"></textarea>
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
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("progress::app")
<script type="text/javascript">
  $(".progress").number(true,2);
  $("#label_progress").text($("#label_progress_val").val() + " %");
  
  $(document).ready(function(){

    //$(".start_date").datepicker();
    //$(".end_date").datepicker();
    for ( var i=0; i < $("#unitprogress").val(); i++ ){

      $("#start_date_" + i).datepicker({
          minDate: new Date($("#start_date").val()),
          dateformat : 'yy/mm/dd'
      });

      $("#end_date_" + i).datepicker({
          maxDate: new Date($("#finish_date").val()),
          dateformat : 'yy/mm/dd'
      });
    }
    
  });

</script>
</body>
</html>
