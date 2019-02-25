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
<div id="head_Content_spk">
  
  @if ( $ttd_pertama != "" )
  <div id="dvContents_spk" class="result" style="display: none;">
    <img src="{{ url('/')}}/assets/dist/img/logo-ciputra_original.png" class="img-circle" alt="User Image">
    <table width="100%" style="border-collapse:collapse" class='table' id='form_spk'>
      
      <tr>
        <td>
          <table border="1" width="100%" style="border:1px solid black; border-collapse: collapse;">
            <tr>
              <td width="50%;"><center>No. Spk</center></td>
              <td width="50%;"><center>{{ $spk->project->name }}</center></td>              
            </tr>
            <tr>
              <td width="50%;"><center>{{ $spk->no or '-'}}</center></td>
              <td width="50%;"><center>{{ $spk->tender->rab->budget_tahunan->budget->kawasan->name or 'Fasilitas Kota'}}</center></td>
            </tr>
          </table>
          <span>&nbsp;</span>
          <table width="100%" style="border:1px solid black; border-collapse: collapse;font-size:10px;" border="1">
            <tr>
              <td width="50%">PIHAK PERTAMA</td>
              <td width="50%">PIHAK KEDUA</td>
            </tr>
            <tr>
              <td width="50%">
                <span>{{ $ttd_pertama["user_name"] }}</span><br>
                <span>{{ $ttd_pertama["user_jabatan"]}}</span><br>
                <span><strong>{{ $spk->tender->rab->budget_tahunan->budget->pt->name }}</strong></span><br>
                <span><strong>{{ $spk->tender->rab->budget_tahunan->budget->pt->address }}</strong></span><br>
              </td>
              <td width="50%">
                <span>{{ $spk->rekanan->cp_name or '-' }}</span><br>
                <span>{{ $spk->rekanan->cp_jabatan or '-' }}</span><br>
                <span><strong>{{ $spk->rekanan->group->name or '-' }}</strong></span><br>
                <span><strong>{{ $spk->rekanan->surat_alamat or '-' }}</strong></span><br>
              </td>
            </tr>
          </table>
          <br>
          <span style="font-size:10px;">Dalam hal ini Pihak I memberikan Perintah Kerja Kepada Pihak II untuk melaksanakan Pekerjaan sebagai berikut : </span><br>
          <table width="100%" style="border:1px solid black; border-collapse: collapse;font-size:10px;" cellpadding="5" cellspacing="5" border="1">
            <tr>
              <td width="25%;">Jenis Pekerjaan</td>
              <td>
                {{ $spk->itempekerjaan->name or '-'}}
              </td>
            </tr>
            <tr>
              <td width="25%;">Lokasi Pekerjaan</td>
              <td>
                @foreach ( $spk->details as $key => $value )
                {{ $value->asset->name }} , 
                @endforeach
              </td>
            </tr>
            <tr>
              <td width="25%;">Waktu Pelaksanaan</td>
              <td>
                @if ( $spk->start_date != null && $spk->finish_date != null )
                  {{ $spk->start_date->format("d M Y")}} s/d {{ $spk->finish_date->format("d M Y")}} 
                @else
                  - 
                @endif
              </td>
            </tr>
            <tr>
              <!--
                PKP Status = 1 kena PPn
                PKP Status = 2 kena PPn 2 kali ppn normal
              -->
              <td width="25%;">Nilai Kontrak</td>
              <td>
                <span>DPP   : IDR {{ number_format($spk->nilai,2) }}</span><br>
                @if ( $spk->rekanan->pkp_status == "1" )
                <span>Ppn   : IDR {{ number_format(($spk->nilai * $ppn ) / 100 ,2 ) }}</span><br>
                <span>Total : IDR {{ number_format( $total =  $spk->nilai + (($spk->nilai * $ppn ) / 100) ,2 ) }}</span><br>
                @else                
                <span>Total : IDR {{ number_format( $total = $spk->nilai,2 ) }}</span><br>
                @endif
                <strong><i>{{ Terbilang::make($total)}} rupiah</i></strong>
              </td>
            </tr>
            <tr>
              <td width="25%;">Jenis Kontrak</td>
              <td>{{ strtoupper($spk->tender->sifat_tender)  }}</td>
            </tr>
            <tr>
              <td width="25%;">Retensi</td>
              <td>
               @foreach ( $spk->retensis as $key => $value )
                <span>Retensi {{ $key + 1 }} : <i>{{ $value->percent * 100 }}</i> selama <strong>{{ $value->hari }}</strong> hari <br></span>
               @endforeach
              </td>
            </tr>
            <tr>
              <td colspan="2" style="height: 300px;vertical-align: top;font-size:12px;">
                <h3><u>LINGKUP PEKERJAAN</u></h3>
                <ol>
                  <li>Pihak Kedua  bertanggung jawab sepenuhnya atas pekerjaan : <strong>{{ ucwords($spk->name) }} </strong></li>
                  <li>Pihak Pertama akan melakukan dan menyetujui hasil opname pekerjaan Pihak Kedua dilapangan sebelum dilakukan pembayaran untuk tiap termynnya.<strong></strong></li>
                  <li>Apabila terdapat perbedaan antar Gambar, BQ & spesifikasi teknis maka yang menentukan adalah pihak pertama</li>
                  <li>Segala salah interpretasi terhadap Gambar, spesifikasi teknis dan atau BQ akan menjadi tanggung jawab kontraktor sepenuhnya, kontraktor dianggap telah memahami.</li>
                </ol>
                <h3 style="margin:0;"><u>DASAR PENERBITAN KONTRAK YANG TIDAK TERPISAHKAN DARI SPK INI :</u></h3>
                
                <ol>
                  <li>Dokumen Tender: {{ $spk->tender->no or  '' }}
                    @foreach ( $spk->tender->tender_document as $key2 => $value2 )
                      {{ $value2->document_name }} tgl : {{ $value->updated_at->format("d/m/Y")}}
                    @endforeach
                  </li>
                  <li>Berita Acara Tender:
                     Anwizijng tgl : {{ $spk->tender->aanwijzing_date->format("d/M/Y") }}<br>
                     Klarifikasi tgl : {{ $spk->tender->klarifikasi1_date->format("d/m/Y") }}<br>
                     Rev BoQ tgl : {{ $spk->tender->penawaran2_date->format("d/m/Y") }}<br>
                     @if ( $spk->tender_rekanan->penawarans->count() > 1 )
                     Negoisasi tgl : {{ $spk->tender->klarifikasi2_date->format("d/m/Y") }}<br>
                     @else
                     Negoisasi tgl : {{ $spk->tender->klarifikasi1_date->format("d/m/Y") }}<br>
                     @endif
                  </li>
                  <li>Surat Penawaran kontraktor final tgl
                    @if ( $spk->tender_rekanan->penawarans->count() > 1 )
                     {{ $spk->tender->klarifikasi2_date->format("d/m/Y") }}
                    @else
                      {{ $spk->tender->klarifikasi1_date->format("d/m/Y") }}
                    @endif</li>
                  <li> Surat Penunjukan / Pemenang tender / SIPP No : {{ $sipp }} </li>
                  <li>SUPP No. : {{ $spk->rekanan->supps->last()->no or '-'}}</li>
                </ol>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>
          <table width="100%" style="border:1px solid black; border-collapse: collapse;font-size:10px;" border="1">
            <tr>
              <td>                
                <span>LAIN - LAIN  :</span>
                <p style="margin:0">
                  SPK ini menjadi bagian yang terikat dari dokumen kontrak dan surat penunjukan kontraktor beserta segala isinya 
                  Demikian Surat Perintah Kerja  ini  diberikan untuk dilaksanakan dengan sebaik-baiknya dan   dipergunakan sebagaimana mestinya. Lampirkan Struktur organisasi, K-3
                </p>
                <span style="text-align: right;">{{ $spk->project->city->name }},  {{ date("d/m/Y")}}</span>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>
          <table width="100%" border="1px" style="border-collapse: collapse;width: 100%;font-size:14px;">
            <tr>
              <td style="text-transform: uppercase;vertical-align: top;">
                <center><strong><span>PIHAK KEDUA</span></strong></center>
                <center><span>{{ $spk->rekanan->group->name or '-' }}</span></span>
              </td>
              <td colspan="3">
                <strong><center>PIHAK PERTAMA</strong></center>
                <span><center>{{ $spk->tender->rab->budget_tahunan->budget->pt->name or '-' }}</center></span>
              </td>
            </tr> 
            <tr>
              <td style="width: 50%;">
                @if ( isset($list_ttd[1]))
                <h1>&nbsp;</h1>
                <h1>&nbsp;</h1>
                <center><u>{{ $list_ttd[1]["user_name"] }}</u><br></span></center>
                <center><span><strong>{{ $list_ttd[1]["user_jabatan"] }}</strong></span></center>
                @endif
              </td>

            </tr>                 
          </table>
        </td>
      </tr>
      <tr>
        <td>@include("print.footer",['project' => $spk->project])</td>
      </tr>
    </table>
  </div>
  
  
  <div id="dvContents_spk_detail" class="result" style="display: none;">
    @if ( $spk->itempekerjaan != "")
    @if ( $spk->itempekerjaan->group_cost == "2")
    <table width="100%" style="border-collapse:collapse" class='table' id='form_spk'>
      <tr>
        <td>@include("print.logo",['pt' => $spk->tender->rab->budget_tahunan->budget->pt ] )</td>
      </tr>
      <tr>
        <td>          
          <table border="1" width="100%" style="border:1px solid black; border-collapse: collapse;" cellpadding="5" cellspacing="5">
            <tr>
              <td rowspan="2"><center>No. Spk</center></td>
              <td rowspan="2"><center>{{ $spk->project->name }}</center></td>
              <td>
                <center>
                  @if ($spk->rekanan->supps->count() > 0 )
                  {{ $spk->rekanan->supp->last()->no }}
                  @else
                  -
                  @endif
                </center>
              </td>
            </tr>
            <tr>
              <td><center>-</center></td>
            </tr>
            <tr>
              <td><center>{{ $spk->no or '-'}}</center></td>
              <td><center>{{ $spk->tender->rab->budget_tahunan->budget->kawasan->name or 'Fasilitas Kota'}}</center></td>
              <td><center>{{ $spk->tender->no or '-'}}</center></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>
          <table width="100%" border="1" style="border-collapse: collapse;border:1px solid black;">
            <tr>
              <td>No.</td>
              <td>Item Pekerjaan</td>
              <td>Unit ID</td>
              <td>Volume</td>
              <td>Satuan</td>
              <td>Nilai</td>
            </tr>
            @foreach ( $spk->details as $key => $value )
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $spk->itempekerjaan->name }}</td>
              <td>{{ $value->asset->name }}</td>
              <td>1</td>
              <td>Unit</td>
              <td>Rp. {{ number_format($value->nilai)}}</td>
            </tr>
            @endforeach
          </table>
        </td>
      </tr>
    </table>
    @endif
    @endif
  </div>
  @endif
</div>
