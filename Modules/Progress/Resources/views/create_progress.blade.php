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
      <h1>Data Proyek {{ $project->name }}</h1>

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
                  <thead>
                    <tbody></tbody>
                  </thead>
                </table>  

                <center><h3>Progress</h3></center>
                <hr>
                <table class="table table-bordered">
                  <thead class="head_table">
                    <tr>
                      <td>Item Pekerjaan</td>   
                      <td>Bobot RAB(%)</td>   
                      <td>Progress s/d Lalu(%)</td>
                      <td>Progress s/d Skrg(%)</td>    
                      <td>Nilai Bobot(%)</td>    
                    </tr>
                  </thead>
                 <tbody>
                  @php $nilai = 0; $real_bobot = 0; @endphp
                    @foreach ( $unitprogress as $key2 => $value2 )
                      @if ( $value2->spkvo_unit->head_type != "Modules\Spk\Entities\Vo")
                      <tr style="{{ $arrayEscrow[$value2->itempekerjaan->escrow_id]['style'] }}">                                
                          <td>
                            {{ $value2->itempekerjaan->name }}<br> {{ $arrayEscrow[$value2->itempekerjaan->escrow_id]['label']  }}
                          </td> 
                          <td>{{ number_format($value2->bobot_rab * ($spk->details->count()),2) }} </td>
                          <td>{{ number_format($value2->progres_sebelumnya,2)}}</td>  

                          <td>

                            <input type="hidden" name="unit_progress_id[{{ $key2}}]" value="{{ $value2->id }}">
                            <input type="text" class="form-control nilai_budget" name="progress_saat_ini_[{{ $key2}}]" value="{{ number_format($value2->progresslapangan_percent,2) * 100 }}" autocomplete="off" /> 
                            </td>      
                          <td> {{ number_format ( $real_bobot_s = ( ( $value2->progresslapangan_percent * 100 ) / 100 ) * ( $value2->bobot_rab * ($spk->details->count())),2)}}</td>                                
                      </tr>   
                      @php $nilai = $nilai + ($value2->bobot_rab * ($spk->details->count()) ); $real_bobot = $real_bobot + $real_bobot_s; @endphp
                      @endif
                    @endforeach 
                    <tr>
                      <td>Total</td>
                      <td>{{ number_format($nilai,2) }} %</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td><input type="hidden" name="label_progress_val" id="label_progress_val" value="{{ number_format($real_bobot,2) }}"/>{{ number_format($real_bobot,2) }} %</td>
                    </tr>                       
                  </tbody>
                </table>
                <label>Keterangan</label>
                <textarea name="description" rows="3" class="form-control"></textarea>

                <center><h3>Variation Order</h3></center>
                <hr>
                <table class="table table-bordered">
                  <thead class="head_table">
                    <tr>
                      <td>Item Pekerjaan</td>   
                      <td>Bobot</td>
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
                        <td>{{ number_format($value2->progres_sebelumnya,2)}}</td>  
                        <td>

                          <input type="hidden" name="unit_progress_id[{{ $key2}}]" value="{{ $value2->id }}">
                          <input type="text" class="form-control nilai_budget" name="progress_saat_ini_[{{ $key2}}]" value="{{ number_format($value2->progresslapangan_percent,2) * 100 }}" autocomplete="off"/> 
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
@include("progress::app")
<script type="text/javascript">
  $(".progress").number(true,2);
  $("#label_progress").text($("#label_progress_val").val() + " %");
</script>
</body>
</html>
