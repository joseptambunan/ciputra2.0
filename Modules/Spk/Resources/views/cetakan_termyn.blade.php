<style type="text/css">
  #dvContents_spk{
    font-size:8px;
  }

  @media print body {
    font-size:8px;
  }

  @media print {
    .result {page-break-after: always;}
  }
</style>
<div id="head_content_allbap_sum">
  
  @if ( $ttd_pertama != "" )
    <div id="dvcontent_allbap_sum" class="result" style="display: none;">
    <table width="100%" style="border-collapse:collapse" class='table' id='form_spk'>
      <tr>
        <td><img src="{{ url('/')}}/assets/dist/img/logo-ciputra_original.png" class="img-circle" alt="User Image"></td>
      </tr>
      <tr>
        <td><h3><strong>Berita Acara Prestasi</strong></h3></td><br><br>
      </tr>
      <tr>
        <table style="margin: 0">
          <tr>
            <td>Termyn</td>
            <td>{{ $spk->baps->count() }}</td>
          </tr>
          <tr>
            <td>SPK</td>
            <td>{{ $spk->no or '' }}</td>
          </tr>
          <tr>
            <td>Pekerjaan</td>
            <td>{{ $spk->name or '' }}</td>
          </tr>
          <tr>
            <td>Lokasi</td>
            <td>
              @foreach($spk->details as $key => $value )
                {{ $value->asset->name or ''}},
              @endforeach
            </td>
          </tr>
          <tr>
            <td>Waktu Pelaksaan</td>
            <td>{{ $spk->start_date->format("d/M/Y")}} - {{ $spk->finish_date->format("d/M/Y")}}</td>
          </tr>
        </table>
      </tr>
      <tr>
        <td>
          <br/><br/>
            <table style="width: 100%;border:1px solid black;border-collapse: collapse;" border="1" cellspacing="3" cellpadding="3">
              <tr>
                <td>Item Pekerjaan</td>
                <td>Nilai SPK + VO</td>
                <td>Progress Lapangan Kumulatif</td>
                <td>Progress Pembayaran Kumulatif</td>
                <td>Pembayaran Kumulatif</td>
                <td>Pembayaran yang Lalu</td>
                <td>Total yang dibayarkan</td>
                <td>% dibayar</td>
              </tr>
                @php $before = 0; $latest = 0;$percentage_before = 0;$percent_dibayar = 0; @endphp
                @foreach ( $spk->baps as $key => $value )
                <tr>
                  <td>{{ $spk->name }}</td>
                  <td>{{ number_format($value->nilai_spk + $value->nilai_vo)}}</td>
                  <td>{{ number_format($value->percentage_lapangan)}} %</td>
                  <td>{{ number_format($persen = ($value->nilai_bap_2 / ($value->nilai_spk + $value->nilai_vo)) * 100 )}} %</td>
                  <td>{{ number_format($value->nilai_bap_2)}}</td>
                  <td>{{ number_format($before)}}</td>
                  <td>{{ number_format($value->nilai_bap_2 - $latest)}}</td>
                  <td>{{ number_format($persen - $percent_dibayar)}} %</td>
                  @php 
                    $before = $value->nilai_bap_2; 
                    $latest = $value->nilai_bap_2;
                    $percentage_before = $value->percentage_lapangan;  
                    $percent_dibayar = $persen;
                  @endphp
                </tr>
                @endforeach
            </table>
        </td>
      </tr>
      <tr>
        <td>
          <table style="width: 100%;border:1px solid;border-collapse: collapse;text-align: left;" border="1" cellspacing="5" cellpadding="5">
            <tr>
              <td>
                <br/><br/><br/>
                <u>{{ $spk->user->user_name or ''}}</u><br/>
                QS
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    </div>
  @endif
</div>