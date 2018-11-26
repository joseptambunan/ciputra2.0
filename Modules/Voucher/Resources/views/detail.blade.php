<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard </title>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
    <section class="content-header" style="display: none;">
      <h1>Data Voucher</h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">   

            <h3 class="box-title" style="display: none;">Detail Data Voucher</h3>           
              <!-- Main content -->
            <section class="invoice">

              <form action="{{ url('/')}}/voucher/update" method="post" name="form1" >
                <input type="hidden" name="voucher_id" value="{{ $voucher->id }}">
                {{ csrf_field() }}
              <!-- title row -->
              <div class="row">
                <div class="col-xs-12">
                  <h2 class="page-header">
                    <i class="fa fa-globe"></i> Voucher NO : <strong>{{ $voucher->no }}</strong>
                    <small class="pull-right">Dok No  : {{ $voucher->bap->no }}</small>
                  </h2>
                </div>
                <!-- /.col -->
              </div>

              <div class="row">
                <div class="col-xs-6">
                  <div class="form-group">
                    <span>Project</span>
                    <input type="text" class="form-control" value="{{ $voucher->bap->spk->project->name }}" readonly>
                  </div>
                  <div class="form-group">
                    <span>PT</span>
                    <input type="text" class="form-control" value="{{ $voucher->bap->spk->project->pt->first()->name or '' }}" readonly>
                  </div>
                  <div class="form-group">
                    <span>Dibayarkan kepada</span>
                    <input type="text" class="form-control" value="{{ $voucher->bap->spk->rekanan->group->name }}" readonly>
                  </div>
                  <div class="form-group">
                    <span>Rekening Rekanan</span>
                    <select class="form-control" name="rekanan_rekening">
                      @foreach ( $voucher->bap->spk->rekanan->rekenings as $key3 => $value3 )
                      <option value="{{ $value3->id}}">{{ $value3->bank->name }} / {{ $value3->name }}-{{ $value3->no }}</option>
                      @endforeach
                    </select>
                  </div>
                  
                </div>
                <div class="col-xs-6">                  
                  <div class="form-group">
                    <span>Tanggal Voucher Dibuat</span>
                    <input type="text" class="form-control" value="{{ $voucher->created_at->format('d/m/Y')}}" id="tgl_voucher_dibuat" readonly>
                  </div>
                  <div class="form-group">
                    <span>Tanggal Voucher Diserahkan ke Keuangan</span>
                    <input type="text" class="form-control"  id="diserahkan" value="{{ date('Y-m-d')}}" readonly>
                  </div>
                  <div class="form-group">
                    <span>Tanggal Jatuh Tempo Voucher</span>
                    <input type="text" class="form-control" value="{{ $voucher->created_at->format('d/m/Y')}}" id="tempo" name="tempo" autocomplete="off">
                  </div>
                  <div class="form-group">
                    @if ( $voucher->bap->spk->lapangan < $voucher->bap->spk->pic_id )
                    <span>Tanggal Voucher Dicairkan / Giro diserahkan</span>
                    <input type="text" class="form-control" value="" id="pencairan" name="pencairan" autocomplete="off" disabled>
                    <p>Belum memenuhi progress lapangan minimal <i><strong><span style="color:red;">18 %</span></strong></i></p>
                    @else       
                    <span>Tanggal Voucher Dicairkan / Giro diserahkan</span>             
                    <div class="row">
                      <div class="col-3">
                        <input type="text" class="form-control" placeholder=".col-3" value="{{ date('m/d/Y')}}">
                      </div>
                      <div class="col-4">
                        <input type="text" class="form-control" placeholder=".col-4" value="BCA/0000/11/2018">
                      </div>
                    </div>
                    @endif
                  </div>
                </div>
              </div>
              <!-- /.row -->
              <div class="row">
                <div class="col-xs-12">
                  <table class="table table-bordered">
                    <thead class="head_table">
                      <tr>
                        <td>Kode</td>
                        <td>Keterangan</td>
                        <td>Nilai</td>
                      </tr>
                    </thead>
                    <tbody>
                      @if ( $voucher->head_type == "Bap")
                        @foreach( $voucher->details as $key => $value )
                        <tr>
                          <td>
                            @if ( $value->type == "Nilai PPh")
                             <select class="form-control" name="coa_pph" style="width: 30%;">
                                @for( $i = 0 ; $i < count($arraypph); $i++ )
                                <option value="{{ $arraypph[$i]['value']}}">{{ $arraypph[$i]['label']}}</option>
                                @endfor
                            @else
                            {{ $value->coa_id }}
                            @endif
                          </td>
                          <td>                            
                            {{ $value->type }}<br>
                            @if ( $value->head_type == "PPh")
                              <input type="hidden" name="id_detail" value="{{ $value->id }}">
                              <select name="pph" id="pph" style="width: 30%;">
                                @for( $i = 0 ; $i < count($arraypph); $i++ )
                                  <option value="{{ $arraypph[$i]['value']}}">{{ $arraypph[$i]['label']}}</option>
                                @endfor
                              </select>                              
                              <input type="text" name="pph_percent" id="pph_percent" value="{{  $voucher->bap->spk->rekanan->group->pph_percent }}" style="width: 10%" maxlength="4" /> %
                            @endif
                          </td>
                          @if ( $value->nilai < 0 )
                          @php $nilai = str_replace("-","",$value->nilai) @endphp
                          <td style="text-align: right;">Rp. ( {{ number_format($nilai,2) }} )</td>
                          @else
                          <td style="text-align: right;">Rp. {{ number_format($value->nilai,2 ) }}</td>
                          @endif
                        </tr>
                        @endforeach
                      @endif
                      <tr>
                        <td colspan="2" style="text-align: right;">Total</td>
                        <td style="text-align: right;">Rp. {{ number_format($voucher->details->sum('nilai'),2)}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-xs-12">

                  <a href="{{ url('/')}}/voucher" class="btn btn-warning">Kembali</a>
                  <button class="btn btn-primary" id="btn_update_pph" type="submit">Simpan</button>
                  <a href="{{ url('/')}}/voucher/detail-units?id={{ $voucher->id }}" class="btn btn-success">Detail Unit</a>
                </div>
              </div>
               </form>
            </section>
            <!-- /.content -->
            </div>

            </form>
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

</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("voucher::app")

</body>
</html>
