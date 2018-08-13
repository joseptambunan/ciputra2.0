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
    <section class="content-header">
      <h1>Data SPK</h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">   

            <h3 class="box-title">Detail Data BAP</h3>           
              <!-- Main content -->
            <section class="invoice">
              <!-- title row -->
              <div class="row">
                <div class="col-xs-12">
                  <h2 class="page-header">
                    <i class="fa fa-globe"></i> SPK NO : <strong>{{ $spk->no }}</strong>
                    <small class="pull-right">Tanggal  : {{ $spk->date }}</small>
                  </h2>
                </div>
                <!-- /.col -->
              </div>

              <!-- Table row -->
              <div class="row">
                <div class="col-xs-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <td>COA</td>
                        <td>Item Pekerjaan</td>
                        <td>Volume</td>
                        <td>Nilai</td>
                        <td>Satuan</td>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ( $spk->tender_rekanan->menangs->first()->details as $key2 => $value2 )
                        @php 
                        $itempekerjaan = \Modules\Pekerjaan\Entities\Itempekerjaan::find($value2->itempekerjaan_id);
                        @endphp
                        <tr>
                          <td>{{ $itempekerjaan->code }}</td>
                          <td>{{ $itempekerjaan->name }}</td>
                          <td>{{ $value2->volume }}</td>
                          <td>{{ number_format($value2->nilai) }}</td>
                          <td>{{ $value2->satuan or 'ls' }}</td>
                        </tr>
                      @endforeach                 
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <!-- /.col -->
                <form action="{{ url('/')}}/spk/save-bap" method="post" name="form1">
                <input type="hidden" name="spk_bap" value="{{ $spk->id }}">
                <input type="hidden" name="spk_bap_termin" value="{{ $spk->baps->count() + 1 }}">
                {{ csrf_field() }}
                <div class="col-xs-6">
                  <p class="lead">Detail Nilai</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Termin: </th>
                        <td>{{ $spk->baps->count() + 1 }}</td>
                      </tr>
                      <tr>
                        <th>Progress Termin Sebelumnya</th>
                        <td>
                          @php $total = 0; @endphp
                          @foreach ( $spk->termyn as $key => $value )
                            @if ( $value->termin < ($spk->baps->count() + 1) )
                              {{ $total = $total + $value->progress }} %
                            @endif
                          @endforeach
                          {{ $total }} %
                        </td>
                      </tr>
                      <tr>
                        <th>Progress Termin Minimum</th>
                        <td>
                          @foreach ( $spk->termyn as $key => $value )
                          @if ( $value->termin == ($spk->baps->count() + 1) )
                            {{ $value->progress }} %
                          @endif
                          @endforeach
                        </td>
                      </tr>
                      <tr>
                        <th>Progress Lapangan</th>
                        <td>{{ $spk->progresses->sum('progresslapangan_percent') }} %</td>
                      </tr>
                      <tr>
                        <th>Nilai SPK</th>
                        <td>RP. {{ number_format($spk->nilai,2)}}</td>
                      </tr>
                      <tr>
                        <th>Nilai VO Sampai dengan ke-{{ $spk->vos->count() }}</th>
                        <td>Rp. {{ number_format($spk->nilai_vo,2) }}</td>
                      </tr>
                      <tr>
                        <th>Nilai SPK + VO</th>
                        <td>Rp. {{ number_format($spk->nilai_kumulatif,2)}}</td>
                      </tr>
                      <tr>
                        <th>Nilai PPN SPK + VO</th>
                        <td>Rp. {{ number_format($ppn_kumulatif = $spk->nilai_kumulatif * 0.1 ,2) }}</td>
                      </tr>

                      <tr>
                        <th>Total Kontrak</th>
                        <td>Rp. {{ number_format($spk->nilai_kumulatif + $ppn_kumulatif , 2) }}</td>
                      </tr>

                      <tr>
                        <th>Nilai BAP Sekarang</th>
                        <td>Rp. {{ number_format($spk->nilai_lapangan ,2) }}</td>
                      </tr>

                      @if(($spk->retensis->count()) AND (!$spk->st1_date))
                      <tr>
                        <th>Retensi</th>
                        <td>
                          <input type='text' class='form-control' style="width:50%" value="{{ number_format($spk->nilai_retensi ,2) }}" readonly="readonly" />
                        </td>
                      </tr>

                      <tr>
                        <th>Nilai Setelah Retensi Dikurangi</th>
                        <td>
                          <input type='text' id="nilai_setelah_retensi" class='form-control' style="width:50%" value="{{ number_format(($nilai_setelah_retensi = $spk->nilai_lapangan - $spk->nilai_retensi) ,2) }}" data-value="{{ $nilai_setelah_retensi - ($spk->baps()->latest()->first() ? $spk->baps()->latest()->first()->nilai_sertifikat : 0) }}" readonly="readonly" />
                        </td>
                      </tr>
                    @else
                    <tr>
                      <th>Retensi</th>
                      <td>Rp. {{ number_format($spk->nilai_lapangan - $spk->nilai_bap_sertifikat) }}</td>
                    </tr>
                    @endif
                    <tr>
                      <th>Nilai DP Dibayar</th>
                      <td>RP. {{ number_format($spk->nilai_dp, 2) }}</td>
                    </tr>
                    <tr>
                        <th>PPN Setelah Retensi</th>
                        <td>Rp. {{ number_format( $spk->nilai_ppn + $spk->nilai_ppn_vo ,2) }}</td>
                      </tr>

                      <tr>
                        <th>Total BAP Sekarang</th>
                        <td>Rp. {{ number_format( ($include_ppn = $spk->nilai_lapangan - ( $spk->st1_date ? 0 : $spk->nilai_retensi) + $spk->nilai_ppn) ,2) }} 
                          <input type="hidden" id="include_ppn" value="{{ $include_ppn}}">
                        </td>
                      </tr>

                      <tr>
                        <th>Nilai BAP Sebelumnya</th>
                        <td>Rp. {{ number_format($spk->nilai_bap,2) }}</td>
                      </tr>

                      <tr>
                        <th>Nilai BAP Sekarang include PPN</th>
                        <td>Rp. {{ number_format( $sekarang = ($include_ppn - $spk->nilai_bap) ,2) }}</td>
                      </tr>

                      @if($spk->rekanan->piutangs->count())
                      <tr>
                        <th>Potongan Piutang</th>
                        <td>
                          <input type="number" id="piutang" name="piutang" max="{{ $spk->rekanan->piutang }}" class="form-control" placeholder="Max {{ $spk->rekanan->piutang }}" onkeyup="countPph();countTerbayar();" value="0">
                        </td>
                      </tr>
                      @endif
                      <tr>
                        <td>Potongan Administrasi</td>
                        <td>
                          <input type="number" id="admin" name="admin" class="form-control" onkeyup="countPph();countTerbayar();" value="0" style="width:50%">
                        </td>
                      </tr>

                      <tr>
                        <td>Potongan Denda</td>
                        <td>
                          <input type="number" id="denda" name="denda" class="form-control" onkeyup="countPph();countTerbayar();" value="0" style="width:50%">
                        </td>
                      </tr>

                      <tr>
                        <td>Potongan Selisih Debit Kredit</td>
                        <td>
                          <input type="number" id="selisih" name="selisih" class="form-control" onkeyup="countPph();countTerbayar();" value="0" style="width:50%">
                        </td>
                      </tr>

                      <tr>
                        <td>Total yang Bisa Dibayar</td>
                        <td>
                          <span id="total_dibayar">0.00</span>
                          <input type="hidden" id="total_total_dibayar" class="form-control" value="{{ number_format( 0 ,2) }}" style="width:50%">
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                  <table class="table table-bordered">
                    <thead class="head_table">
                      <tr>
                        <td>Unit</td>
                        <td>Progress Lapangan</td>
                        <td>Persentase Dibayar</td>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ( $spk->details as $key5 => $value5 )
                      <tr>
                        <td>{{ $value5->asset_name }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-xs-12">
                  <button type="submit" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit BAP
                  </button>
                </div>
              </div>
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
@include("spk::app")
<script type="text/javascript">
  function countPph()
  {
      var a = parseFloat($("#nilai_setelah_retensi").attr("data-value"));
        var b = 0;
        console.log(a);

      $('.percent').each(function()
      {
          b += parseFloat($(this).val());

          console.log(b);
        });

      console.log(a,b);
      var c = a * b / 100;
      $("#pph").val(c);
  }

  function countTerbayar()
      {
        var a = parseFloat($("#include_ppn").val());

        @if($spk->rekanan->piutangs->count())
          var b = parseFloat($("#piutang").val());
        @else
          var b = 0;
        @endif

        //var c = parseFloat($("#pph").val());
        var c = parseFloat(0);
        var d = parseFloat($("#admin").val());
        var e = parseFloat($("#denda").val());
        var f = parseFloat($("#selisih").val());
        
        if ($("#piutang").val() == "") 
        {
          $("#piutang").val("0");
          countTerbayar();
          return false;
        }

        if ($("#pph").val() == "") 
        {
          $("#pph").val("0");
          countTerbayar();
          return false;
        }

        if ($("#admin").val() == "") 
        {
          $("#admin").val("0");
          countTerbayar();
          return false;
        }

        if ($("#denda").val() == "") 
        {
          $("#denda").val("0");
          countTerbayar();
          return false;
        }

        if ($("#selisih").val() == "") 
        {
          $("#selisih").val("0");
          countTerbayar();
          return false;
        }

        if (b > {{ $spk->rekanan->piutang }}) 
        {
          $("#piutang").val("{{ $spk->rekanan->piutang }}");
          countTerbayar();
        }

        var g = a - b - c - d - e - f;

        console.log(a,b,c,d,e,f);

        $("#total_dibayar").text(g);
        $("#total_total_dibayar").val(g);
        if(g < 0)
        {
          $("#showtoast").attr("disabled","disabled");
        }else{
          $("#showtoast").removeAttr("disabled");
        }


        $("#total_dibayar").number(true,2);
      }
</script>
</body>
</html>
