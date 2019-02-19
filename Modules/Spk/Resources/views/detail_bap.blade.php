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



              <div class="row">
                <!-- accepted payments column -->
                <!-- /.col -->
                <form action="{{ url('/')}}/spk/save-bap" method="post" name="form1">
                <input type="hidden" name="spk_bap" value="{{ $spk->id }}">
                <input type="hidden" name="spk_bap_termin" value="{{ $spk->baps->count() + 1 }}">
                {{ csrf_field() }}
                @php $dps = 0; @endphp
                <div class="col-xs-6">
                  <p class="lead">Detail Nilai</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Termin: </th>
                        <td style="text-align: right">{{ $bap->termin }}</td>
                      </tr>
                      <tr>
                        <th>Progress Termin Sebelumnya</th>
                        <td style="text-align: right">
                          {{ number_format($bap->percentage_sebelumnyas ,2)  }} %
                        </td>
                      </tr>
                      <tr>
                        <th>Progress Termin Dibayar</th>
                        <td style="text-align: right">
                         {{ number_format( ($bap->nilai_bap_2 / ($spk->nilai + $bap->nilai_vo) ) * 100  ,2) }} %
                        </td>
                      </tr>
                      <tr>
                        <th>Progress Lapangan</th>
                        <td style="text-align: right">{{ number_format($bap->percentage_lapangan,2) }} %</td>
                      </tr>
                      <tr>
                        <td colspan="2"><hr style="border:3px solid;margin-top:0px;margin-bottom:0px !important;"></td>
                      </tr>
                      <tr>
                        <th>Nilai SPK</th>
                        <td style="text-align: right">RP. {{ number_format($spk->nilai,2)}}</td>
                      </tr>
                      <tr>
                        <th>Nilai VO  </th>
                        <td style="text-align: right">Rp. {{ number_format($bap->nilai_vo,2) }}<br>
                        <hr style="border:1px solid;margin-top:0px;margin-bottom:0px !important;"></td>
                      </tr>
                      <tr>
                        <th>Nilai SPK + VO</th>
                        <td style="text-align: right">Rp. {{ number_format( $spk->nilai + $bap->nilai_vo,2)}}</td>
                      </tr>
                      <tr>
                        <th>Nilai PPN SPK + VO</th>                       
                        <td style="text-align: right">Rp. {{ number_format($ppn_kumulatif = ( $spk->nilai + $bap->nilai_vo ) * $ppn ,2) }}</td>          
                      </tr>

                      <tr>
                        <th>&nbsp;</th>
                        <td><hr style="border:1px solid;margin-top:0px;margin-bottom:0px !important;"></td>
                      </tr>

                      <tr>
                        <th>Total Kontrak</th>
                        <td style="text-align: right">Rp. {{ number_format((  $spk->nilai + $bap->nilai_vo ) + $ppn_kumulatif , 2) }}</td>
                      </tr>

                       <tr>
                        <td colspan="2"><hr style="border:3px solid;margin-top:0px;margin-bottom:0px !important;"></td>
                      </tr>

                      <tr>
                        <th>Nilai Kumulatif BAP 1</th>
                        <td style="text-align: right">Rp. {{ number_format( $bap->nilai_bap_1 ,2) }}</td>
                      </tr>

                      
                      <tr>
                        <th>Retensi</th>
                        <td style="text-align: right">Rp. {{ number_format($bap->nilai_retensi,2) }}</td>
                      </tr>
                      <tr>
                        <td colspan="2"> <hr style="border:3px solid;margin-top:0px;margin-bottom:0px !important;"></td>
                      </tr>
                      <tr>
                        <th>Nilai Setelah Retensi Dikurangi</th>
                        <td style="text-align: right">
                          <span>Rp. {{ number_format($nilai_setelah_retensi = $bap->nilai_bap_1 - $bap->nilai_retensi ,2) }}</span>
                        </td>
                      </tr>
                   
                    @if ( $spk->spk_type_id == "1")
                    <tr>
                      <th>Nilai DP Dibayar</th>
                      <td style="text-align: right">RP. {{ number_format($spk->nilai_dp, 2) }}</td>
                    </tr>
                    @else
                    <tr>
                      <th>Nilai DP Dibayar</th>
                      <td style="text-align: right">RP. {{ number_format($spk->nilai_dp, 2) }}</td>
                    </tr>
                    @endif
                    <tr>
                      <th>Nilai DP Dikembalikan</th>
                      <td style="text-align: right">Rp. {{ number_format($bap->nilai_dp,2) }}</td>
                    </tr>
                    
                    <tr>
                        <td colspan="2"> <hr style="border:3px solid;margin-top:0px;margin-bottom:0px !important;"></td>
                      </tr>
                    <tr>
                      <th>Nilai Kumulatif BAP 2</th>
                      <td style="text-align: right">Rp. {{ number_format( $bap->nilai_bap_2 ,2) }}
                      
                      </td>
                    </tr>
                    <tr>
                      <th>PPN Setelah Nilai Kumulatif BAP 2</th>
                      <td style="text-align: right;">Rp. {{ number_format ( $nilai_kumulatif_ppn_bap2 = $bap->nilai_bap_2 * $ppn  ,2) }}</td>
                    </tr>
                     
                    <tr>
                      <th>Nilai Sertifikat sampai saat ini </th>
                      <td style="text-align: right;">Rp. {{ number_format( $pembayaran_saat_ini =  $bap->nilai_bap_2 + ($bap->nilai_bap_2 * $ppn), 2)}}</td>
                    </tr>

                    <tr>
                      <th>Nilai BAP Sebelumnya</th>
                      <td style="text-align: right;">Rp. {{  number_format($bap->nilai_sebelumnya,2)}}</td>
                    </tr>

                    <tr>
                      <th>Nilai BAP 3</th>
                      <td style="text-align: right;">Rp. {{  number_format($pembayaran_saat_ini - $bap->nilai_sebelumnya,2)}}</td>
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
                        <input type="text" id="admin" name="admin" class="form-control" onkeyup="countPph();countTerbayar();" value="{{ number_format($bap->nilai_administrasi,2) }}" style="width:50%">
                      </td>
                    </tr>

                    <tr>
                      <td>Potongan Denda</td>
                      <td>
                        <input type="text" id="denda" name="denda" class="form-control" onkeyup="countPph();countTerbayar();" value="{{ number_format($bap->nilai_denda,2) }}" style="width:50%">
                      </td>
                    </tr>

                    <tr>
                      <td>Potongan Selisih Debit Kredit</td>
                      <td>
                        <input type="text" id="selisih" name="selisih" class="form-control" onkeyup="countPph();countTerbayar();" value="{{ number_format($bap->nilai_selisih,2) }}" style="width:50%">
                      </td>
                    </tr>

                    <tr>
                      <td>Potongan Dana Talangan</td>
                      <td>
                        <input type="text" id="talangan" name="talangan" class="form-control" onkeyup="countPph();countTerbayar();" value="{{ number_format($bap->nilai_talangan,2) }}" style="width:50%">
                      </td>
                    </tr>


                    <tr>
                      <td>Total yang Bisa Dibayar</td>
                      <td style="text-align: right">
                        <span id="total_dibayar">{{ number_format(  $pembayaran_saat_ini - ( $bap->nilai_administrasi + $bap->nilai_selisih + $bap->nilai_denda + $bap->nilai_sebelumnya) ,2) }}</span>
                      </td>
                    </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-6" style="display: none">
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
                        <td>{{ $value5->asset->name }}</td>
                        <td>
                          {{ $value5->progress }}
                          <input type="hidden" value="{{ $value5->progress }}" name="progress_summary">
                          @foreach ( $value5->details_with_vo as $key7 => $value7 )
                            <li>{{ $value7->unit_progress->itempekerjaan->name }}</li>
                          @endforeach
                        </td>
                        <td>
                            <span>Input BAP Persentase</span>
                            @foreach ( $value5->details_with_vo as $key6 => $value6 )
                            <input type="hidden" class="form-control" name="spkvo_unit_id[{{$key6}}]" value="{{ $value6->unit_progress_id }}">
                            <input type="hidden" class="form-control" name="terbayar_percent[{{$key6}}]" value="">
                            @endforeach
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              
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
