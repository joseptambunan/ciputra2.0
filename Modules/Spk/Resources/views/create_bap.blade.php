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

                <div class="col-xs-8">

                  <p class="lead">Detail Nilai</p>



                  <div class="table-responsive">

                    <table class="table">

                      <tr>

                        <th style="width:50%">Termin: </th>

                        <td style="text-align: right;">{{ $spk->baps->count() + 1 }}</td>

                      </tr>

                      <tr>

                        <th>Progress Termin Sebelumnya</th>

                        <td style="text-align: right;">

                          

                          {{ number_format($spk->progress_sebelumnya) }} %
                          <input type="hidden" name="percentage_sebelumnya" value="{{ $spk->progress_sebelumnya }}">
                        </td>

                      </tr>

                      <tr>

                        @if ( $spk->progresses->sum('progresslapangan_percent')  == "0.0")

                        <th>Progress Termin DP </th>

                        <td style="text-align: right;">{{ $spk->dp_percent }} %
                        <input type="hidden" name="percentage" value="0">
                        </td>

                        @else

                        <th>Progress Termin Dibayar</th>
                          @if ( $spk->bap == "1")
                            <td style="text-align: right;">{{ $spk->bap * 100 }} % 
                              <input type="hidden" name="percentage" value="{{  $spk->bap * 100 }}"></td>
                          @else
                            <td style="text-align: right;">{{ $spk->spk_real_termyn }} % <input type="hidden" name="percentage" value="{{  $spk->spk_real_termyn }}"></td>
                          @endif
                        @endif

                      </tr>

                      <tr>

                        <th>Progress Lapangan</th>

                        <td style="text-align: right;">{{ number_format($spk->lapangan) }} % <input type="hidden" name="percentage_lapangan" value="{{  $spk->lapangan }}"></td>

                      </tr>
                      <tr>
                        <td colspan="2"><hr style="border:3px solid;margin-top:0px;margin-bottom:0px !important;"></td>
                      </tr>
                      <tr>

                        <th>Nilai SPK</th>

                        <td style="text-align: right;">RP. {{ number_format($spk->nilai)}}</td>

                      </tr>

                      <tr>

                        <th>Nilai VO Sampai dengan ke-{{ $spk->baps->count() + 1 }}</th>
<input type="hidden" name="bap_vo" value="{{ $spk->nilai_vo }}">
                        <td style="text-align: right;">Rp. {{ number_format($spk->nilai_vo) }}<br>
                        <hr style="border:1px solid;margin-top:0px;margin-bottom:0px !important;"></td>

                      </tr>
                      <tr>
                        <td colspan="2"></td>
                      </tr>
                      <tr>

                        <th>Nilai SPK + VO</th>

                        <td style="text-align: right;">Rp. {{ number_format($spk->nilai_kumulatif)}}</td>

                      </tr>
                      @if ( $spk->rekanan->group->pkp_status == 1 )
                      <tr>

                        <th>Nilai PPN SPK + VO</th>
                        
                        <td style="text-align: right;">Rp. {{ number_format($ppn_kumulatif = $spk->nilai_kumulatif * $ppn) }}</td>

                      </tr>
                      @else
                      <tr>

                        <th>Nilai PPN SPK + VO</th>                        
                        <td style="text-align: right;">Rp. {{ number_format($ppn_kumulatif = $spk->nilai_kumulatif * 0 ) }}</td>

                      </tr>
                      @endif
                      <tr>
                        <th>&nbsp;</th>
                        <td><hr style="border:1px solid;margin-top:0px;margin-bottom:0px !important;"></td>
                      </tr>

                      <tr>

                        <th>Total Kontrak</th>

                        <td style="text-align: right;">
                        Rp. {{ number_format($spk->nilai_kumulatif + $ppn_kumulatif) }}</td>

                      </tr>


                      <tr>
                        <td colspan="2"><hr style="border:3px solid;margin-top:0px;margin-bottom:0px !important;"></td>
                      </tr>

                      <tr>

                        <th>Nilai Kumulatif BAP 1</th>
                        @if ( $spk->bap == "1")
                          <td style="text-align: right;">Rp. {{ number_format( $nilai_bap_1 =  $spk->nilai_kumulatif * $spk->bap) }}</td>
                          <input type="hidden" name="nilai_bap_1" value="{{ $nilai_bap_1 }}">
                          <input type="hidden" name="percentage" value="{{ $spk->bap }}">
                        @else
                          <td style="text-align: right;">Rp. {{ number_format( $nilai_bap_1 =  ($spk->nilai_kumulatif) * ($spk->spk_real_termyn / 100 )) }}</td>
                          <input type="hidden" name="nilai_bap_1" value="{{ $nilai_bap_1 }}">
                          <input type="hidden" name="percentage" value="{{ $spk->spk_real_termyn }}">
                        @endif
                      </tr>



                      @if(($spk->retensis->count()) AND (!$spk->st1_date))

                      <tr>

                        <th>Retensi</th>

                        <td style="text-align: right;">
                          @if ( $spk->bap == "1")
                          <span>Rp. {{ number_format( $retensi = 0) }}</span>
                          <input type="hidden" name="nilai_retensi" value="{{ $retensi }}">
                          @else
                          <span>Rp. {{ number_format( $retensi = (($spk->nilai_kumulatif) * ($spk->spk_real_termyn / 100 )) * ($spk->retensis->sum('percent'))) }}</span>
                          <input type="hidden" name="nilai_retensi" value="{{ $retensi }}">
                          @endif

                          <hr style="border:1px solid;margin-top:0px;margin-bottom:0px !important;">
                        </td>

                      </tr>



                      <tr>

                        <th>Nilai Setelah Dikurangi Retensi</th>

                        <td style="text-align: right;">
                          @if ( $spk->bap == "1")
                          <span>Rp. {{ number_format( $nilai_setelah_retensi = (($spk->nilai_kumulatif) * ($spk->bap))- $retensi) }}</span>
                          @else
                          <span>Rp. {{ number_format( $nilai_setelah_retensi = (($spk->nilai_kumulatif) * ($spk->spk_real_termyn / 100 ))- $retensi) }}</span>
                          @endif
                        </td>

                      </tr>

                    @else

                    <tr>

                      <th>Retensi</th>
                      @if ( $spk->bap == "1")
                      <td style="text-align: right;">Rp. {{ number_format( $retensi = 0) }}</td>
                      <input type="hidden" name="nilai_retensi" value="{{ $nilai_setelah_retensi = ( $spk->nilai_kumulatif * $spk->bap ) - $retensi }}">
                      <hr style="border:1px solid;margin-top:0px;margin-bottom:0px !important;">
                      @else
                      <td style="text-align: right;">Rp. {{ number_format( $retensi = $spk->nilai_lapangan * $spk->retensis->first()->percent) }}
                        <hr style="border:1px solid;margin-top:0px;margin-bottom:0px !important;">
                      <input type="hidden" name="nilai_retensi" value="{{ $nilai_setelah_retensi }}">
                      </td>
                      @endif
                    </tr>
                    <tr>
                      <th>Nilai Setelah Dikurangi Retensi</th>
                      <td style="text-align: right;">Rp. {{ number_format( $nilai_setelah_retensi = $spk->nilai_lapangan - $retensi) }}</td>
                    </tr>
                    @endif



                    @php $dps = 0; @endphp

                    @if ( $spk->spk_type_id == "1")

                    <tr>

                      <th>Nilai DP Dibayar</th>

                      <td style="text-align: right;">Rp {{ number_format(($spk->nilai * $spk->dp_percent / 100)) }}</td>

                    </tr>

                    <tr>
                      <th>Nilai DP Dikembalikan</th>
                      <td style="text-align: right;"><input type='hidden' name="nilai_pengembalian" value="{{$spk->nilai_pengembalian}}" />Rp. {{ number_format($spk->nilai_pengembalian)}}</td>
                    </tr>

                    <tr>
                      <th> Nilai Kumulatif BAP 2 </th>
                      <td style="text-align: right;">Rp.
                        {{ number_format( $total2 = ( $nilai_setelah_retensi + ($spk->nilai * $spk->dp_percent / 100)) - $spk->nilai_pengembalian)}}
                        <input type="hidden" name="nilai_bap_2" value="{{ $total2 }}">
                      </td>
                    </tr>
                    @else
                      @if ( $spk->baps->count() == 0 )
                        <tr>
                          <th>Nilai DP Dibayar</th>
                          <td style="text-align: right;">
                            @php $dps = ($spk->dp_percent / 100 ) * $spk->nilai; @endphp  
                            Rp. {{ number_format($dps) }} <br>   
                          </td>
                        </tr>
                        <tr>
                          <th>Nilai DP Dikembalikan</th>
                          <td style="text-align: right;"><input type='hidden' name="nilai_pengembalian" value="{{ $spk->nilai_pengembalian * 0 }}" />Rp. {{ number_format($spk->nilai_pengembalian)}}</td>
                        </tr>

                        <tr>
                          <th> Nilai Kumulatif BAP 2 </th>
                          <td style="text-align: right;">Rp.
                            {{ number_format( $total2 = ( $nilai_setelah_retensi + ( ($spk->nilai * $spk->dp_percent / 100) ) ) - $spk->nilai_pengembalian)}}
                            <input type="hidden" name="nilai_bap_2" value="{{ $total2 }}">
                          </td>
                        </tr>
                      @else
                        <tr>
                          <th>Nilai DP Dibayar</th>
                          <td style="text-align: right;">
                            @php $dps = ($spk->dp_percent / 100 ) * $spk->nilai; @endphp  
                            Rp. {{ number_format($dps * 0 ) }} <br>   
                          </td>
                        </tr>
                        <tr>
                          <th>Nilai DP Dikembalikan</th>
                          <td style="text-align: right;"><input type='hidden' name="nilai_pengembalian" value="{{ $spk->nilai_pengembalian * 0 }}" />Rp. {{ number_format($spk->nilai_pengembalian * 0)}}</td>
                        </tr>

                        <tr>
                          <th> Nilai Kumulatif BAP 2 </th>
                          <td style="text-align: right;">Rp.
                            {{ number_format( $total2 = ( $nilai_setelah_retensi + ( ($spk->nilai * $spk->dp_percent / 100) * 0) ) - $spk->nilai_pengembalian)}}
                            <input type="hidden" name="nilai_bap_2" value="{{ $total2 }}">
                          </td>
                        </tr>
                      @endif
                    @endif
                    <tr>

                        <th>PPN Setelah Nilai Kumulatif BAP 2</th>

                        <td style="text-align: right;">Rp. {{ number_format ( ( $total2 * $ppn )) }}</td>

                      </tr>



                      <tr>

                        <th>Nilai Sertifikat sampai saat ini</th>                        

                        <td style="text-align: right;">

                          Rp. {{ number_format(($total2 * $ppn) + $total2) }}
                          <input type="hidden" name="nilai_bap_3" value="{{ ($total2 * $ppn) + $total2 }}">
                        </td>                                         

                      </tr>

                      <tr>

                        <th>Nilai BAP Sebelumnya</th>
                        
                        <td style="text-align: right;">Rp. {{ number_format($nilai_sebelumnya) }}</td>
                    
                      </tr>

                      <tr>
                      <th>Nilai BAP 3</th>
                      <td style="text-align: right;">Rp. {{  number_format( $nilai_bap_3 = (($total2 * $ppn) + $total2) - $nilai_sebelumnya)}}</td>
                      <input type="" name="">
                      </tr>

                      @if($spk->rekanan->piutangs->count())
                      <tr>
                        <th>Potongan Piutang</th>
                        <td style="text-align: right;">
                          <input type="number" id="piutang" name="piutang" max="{{ $spk->rekanan->piutang }}" class="form-control" placeholder="Max {{ $spk->rekanan->piutang }}" value="0">
                        </td>
                      </tr>
                      @endif
                      <tr>
                        <td>Potongan Administrasi</td>
                        <td style="text-align: right;">
                          <input type="number" id="admin" name="admin" class="form-control" value="0" style="width:50%">
                        </td>
                      </tr>
                      <tr>
                        <td>Potongan Denda</td>
                        <td style="text-align: right;">
                          <input type="number" id="denda" name="denda" class="form-control" value="0" style="width:50%">
                        </td>
                      </tr>
                      <tr>
                        <td>Potongan Selisih Debit Kredit</td>
                        <td style="text-align: right;">
                          <input type="number" id="selisih" name="selisih" class="form-control" value="0" style="width:50%">
                        </td>
                      </tr>
                      <tr>
                        <td>Potongan Dana Talangan</td>
                        <td style="text-align: right;">
                          <input type="number" id="talangan" name="talangan" class="form-control" value="0" style="width:50%">
                        </td>
                      </tr>
                      <tr>
                        <td>Total yang Bisa Dibayar</td>
                        <td style="text-align: right;">
                          @if ( $spk->baps->count() == "0")
                          <span id="total_dibayar">{{ number_format( $total_bisa_dibayar =  $spk->nilai_bap_sekarang + ($spk->nilai_bap_sekarang * $ppn )) }}</span>
                          <input type="hidden" name="nilai_bap_dibayar" value="{{ $spk->nilai_bap_sekarang + ($spk->nilai_bap_sekarang * $ppn) }}">

                          @else
                          <span id="total_dibayar">{{ number_format( $total_bisa_dibayar = (($total2 * $ppn) + $total2 ) - $nilai_sebelumnya ) }}</span>
                          <input type="hidden" name="nilai_bap_dibayar" value="{{ ( ($total2 * $ppn) + $total2 ) - ( $spk->nilai_total_sebelumnya  ) }}">
                          @endif
                        </td>

                      </tr>

                    </table>

                  </div>

                </div>

                <!-- /.col -->

                <div class="col-md-6" style="display: none;">

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

              <div class="row no-print">

                <div class="col-xs-12">

                  @if ( $total_bisa_dibayar > 0 )
                  <button type="submit" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit BAP
                  @else
                  <h3><span style="color:red"><strong>BAP Tidak bisa diproses karena progress lapangan tidak memenuhi syarat </strong></span></h3>
                  Alasan :
                  <ul>
                    @if ( $spk->nilai_pengembalian > $spk->nilai_setelah_retensi )
                    <li>Nilai Pengembalian DP lebih besar dari Nilai BAP setelah retensi</li>
                    @endif
                  </ul>
                  @endif
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





        $("#total_dibayar").number(true);

      }

</script>

</body>

</html>

