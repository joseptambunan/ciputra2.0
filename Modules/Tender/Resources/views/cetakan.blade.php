<!-- Cetakan Report -->
<style>
  #dvContents{
    font-size:8px;
  }

  @media print body {
    font-size:8px;
  }

  @media print {
    .result {page-break-after: always;}
  }

  @page { 
    size: landscape;
  }
</style>

@if ( $tender->penawarans->count() > 0 )
<div id="head_Content">
 
  <div id="dvContents" style="display: none;">
    <table width="100%" style="border-collapse:collapse" class='table' id='undangan_tender'>
      <tr>
        <td><img src="{{ url('/')}}/assets/dist/img/logo-ciputra_original.png" class="img-circle" alt="User Image"></td>
      </tr>
      <tr>
        <td>
          <table style="border:2px solid black;border-collapse: collapse;width:100%;height: 800px;vertical-align: top;" cellpadding="10" cellspacing="10">
            <tr>
              <td>
                <table style="width: 100%;">
                  <tr>
                    <td style="width:30%;">Paket Pekerjaan</td>
                    <td><u>{{ $tender->name }}</u></td>
                  </tr>
                  <tr>
                    <td style="width:30%;">Kawasan / Lokasi Pekerjaan</td>
                    <td><u>{{ $tender->rab->budget_tahunan->budget->kawasan->name or 'Fasiltas Umum'}}</u></td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table style="width: 100%;border:2px solid black;border-collapse: collapse;" border="1" cellpadding="10" cellspacing="10">
                  <thead>
                    <tr>
                      <td rowspan="2">Peserta Tender</td>
                      <td>OE</td>
                      <td>Penawaran Akhir </td>
                      <td rowspan="2">Waktu</td>
                      <td rowspan="2">Catatan</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>{{ $tender->penawaran1_date->format("d/m/Y") }}</td>
                    </tr>
                  </thead>
                  <tbody>
                    @php $nilai = 0; @endphp
                    @foreach( $tender->rekanans as $key => $value )
                      @if ( $value->penawarans->count() > 0 )
                        @php $nilai_penawaran = $value->penawarans->last()->nilai; @endphp
                      @else
                        @php $nilai_penawaran = 0; @endphp;
                      @endif
                    <tr>
                      <td>{{ $value->rekanan->name or '' }}</td>
                      <td>{{ number_format($tender->rab->nilai) }}</td>
                      <td>{{ number_format($nilai_penawaran) }}</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    @php $nilai = $nilai_penawaran + $nilai; @endphp
                    @endforeach
                    <tr>
                      <td>&nbsp;</td>
                      <td>Total Budget</td>
                      <td>{{ number_format($nilai)}}</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                @foreach ( $tender->rekanans as $key => $value )
                @if ( $value->is_recomendasi == 1 )
                  <i>Rekomendasi : <strong>{{ $value->rekanan->name }}</strong></i>
                @endif
                @endforeach
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>
</div>
@endif