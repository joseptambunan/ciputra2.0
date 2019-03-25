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

@if ( $spk->tender != "")
@if ( $spk->tender->penawarans->count() > 0 )
<div id="head_Content_tender">
 
  <div id="dvContents_tender" style="display: none;">
    <table  style="margin:0;padding:0;font-size:10px;width: 100%;border:2px solid black;border-collapse: collapse;" border="1" cellpadding="10" cellspacing="10">
      <tr>
        <td><img src="{{ url('/')}}/assets/dist/img/logo-ciputra_original.png" class="img-circle" alt="User Image"></td>
      </tr>
      <tr>
        <td>
         
          <table style="width: 100%;">
            <tr>
              <td style="width:30%;">Paket Pekerjaan</td>
              <td><u>{{ $spk->tender->name }}</u></td>
            </tr>
            <tr>
              <td style="width:30%;">Kawasan / Lokasi Pekerjaan</td>
              <td><u>{{ $spk->tender->rab->budget_tahunan->budget->kawasan->name or 'Fasiltas Umum'}}</u></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>
          <table style="margin:0;padding:0;font-size:10px;width: 100%;border:2px solid black;border-collapse: collapse;" border="1" cellpadding="10" cellspacing="10">
            <thead>
              <tr>
                <td rowspan="2">No.</td>
                <td rowspan="2">Item Pekerjaan</td>
                <td rowspan="2">Volume</td>
                <td rowspan="2">Satuan</td>
                <td colspan="{{ count($spk->tender->tender_approve) + 1 }}"><center>Harga Satuan</center></td>
                <td colspan="{{ count($spk->tender->tender_approve) + 1 }}"><center>Total Nilai(Rp)</center></td>
              </tr>
              <tr>                    
                <td>OE</td>                    
                @foreach ( $spk->tender->rekanans as $key1 => $value1 )
                @if ( $value1->approval->approval_action_id != "" )
                  @if ( $value1->approval->approval_action_id == "6")
                <td>{{ $value1->rekanan->group->name}}</td>
                @endif
                @endif
                @endforeach

                <td>OE</td>
                @foreach ( $spk->tender->rekanans as $key1 => $value2 )
                @if ( $value2->approval->approval_action_id != "" )
                  @if ( $value2->approval->approval_action_id == "6")
                  <td>{{ $value2->rekanan->group->name}}</td>
                  @endif
                @endif
                @endforeach
              </tr>
            </thead>
            <tbody>
              @php $nilai_oe_total = 0; @endphp
              @foreach($spk->tender->rab->pekerjaans as $key => $value )
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $value->itempekerjaan->name }}</td>
                <td>{{ $value->volume }}</td>
                <td>{{ $value->satuan }}</td>
                <td>{{ number_format($value->nilai )}}</td>
                @foreach ( $spk->tender->rekanans as $key1 => $value1 )
                  @if ( $value1->approval->approval_action_id != "" )
                    @if ( $value1->approval->approval_action_id == "6")
                      <td>
                        @if ( count($value1->penawarans) < ( (count($spk->tender->penawarans) / count($spk->tender->rekanans) / 3 )))
                          <span>Rp. {{ number_format(0) }}</span>
                        @else
                          <span>
                            @foreach ( $value1->penawarans->last()->details as $key4 => $value4)
                              @if ( $value4->rab_pekerjaan_id == $value->id )
                                {{ number_format($value4->nilai )}}
                              @else
                                {{ number_format(0)}}
                              @endif
                            @endforeach
                          </span>
                        @endif
                      </td>
                    @endif
                  @endif
                @endforeach
                <td>{{ number_format($value->nilai * $value->volume )}}</td>
                 @foreach ( $spk->tender->rekanans as $key1 => $value1 )
                  @if ( $value1->approval->approval_action_id != "" )
                    @if ( $value1->approval->approval_action_id == "6")
                      <td>
                        @if ( count($value1->penawarans) < ( (count($spk->tender->penawarans) / count($spk->tender->rekanans) / 3 )))
                          <span>Rp. {{ number_format(0) }}</span>
                        @else
                          <span>
                            @foreach ( $value1->penawarans->last()->details as $key5 => $value5)
                               @if ( $value4->rab_pekerjaan_id == $value->id )
                                {{ number_format($value5->nilai * $value5->volume )}}
                              @else
                                {{ number_format(0)}}
                              @endif
                            @endforeach
                          </span>
                        @endif
                      </td>
                    @endif
                  @endif
                @endforeach
              </tr>
              @endforeach
            </tbody>
          </table>
        </td>
      </tr>
    </table>
  </div>
</div>
@endif
@endif