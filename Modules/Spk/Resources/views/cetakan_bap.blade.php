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
<div id="head_Content_bap_">
  
  @if ( $ttd_pertama != "" )
  <div id="dvContents_bap_" class="result" style="display: none;">
    <table width="100%" style="border-collapse:collapse" class='table' id='form_spk'>
      <tr>
        <td><img src="{{ url('/')}}/assets/dist/img/logo-ciputra_original.png" class="img-circle" alt="User Image"></td>
      </tr>
      <tr>
        <td>
          <table border="1" width="100%" style="border:1px solid black; border-collapse: collapse;" cellpadding="5" cellspacing="5">
            <tr>
              <td><center>{{ $spk->tender->rab->budget_tahunan->budget->department->name or ''}}</center></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>
          <table style="width: 100%;border: 1px solid black;border-collapse: collapse;font-size:10px;margin: 0" border="1" cellpadding="1" cellspacing="1">
            <tr>
              <td style="width: 10%">Nomor SPK</td>
              <td style="width: 40%">{{ $spk->no or '' }}</td>
              <td rowspan="3" style="vertical-align: center;width: 50%;"><center><h3 style="font-size:35px;margin:0;"><strong>SERTIFIKAT PEMBAYARAN</strong></h3></center></td>
            </tr>
            <tr>
              <td>Proyek</td>
              <td>{{ $spk->tender->rab->budget_tahunan->budget->project->name or ''}}</td>
            </tr>
            <tr>
              <td>Kontraktor</td>
              <td>{{ $spk->rekanan->name or ''}}</td>
            </tr>
            <tr>
              <td>Pekerjaan</td>
              <td>{{ $spk->name or '' }}</td>
              <td rowspan="3">
                <table style="width: 100%;">
                  <tr>
                    <td>Termyn ke </td>
                    <td><span id="termyn_bap"></span></td>
                  </tr>
                  <tr>
                    <td>Tanggal</td>
                    <td><span id="tgl_bap"></span></td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>Blok / Name</td>
              <td>
                @foreach ( $spk->details as $key => $value )
                  {{ $value->asset->name or '' }},
                @endforeach
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>
          <br><br>
          <table style="width: 100%;border:1px solid black;border-collapse: collapse;" border="1" cellspacing="5" cellpadding="5">
            <tr>
              <td style="width: 50%;">Nilai SPK</td>
              <td style="width: 50%;"><span id="nilai_spk" class="number_align number_bap"></span></td>
            </tr>
            <tr>
              <td style="width: 50%;">Nilai Vo</td>
              <td style="width: 50%;"><span id="nilai_vo" class="number_align number_bap"></span></td>
            </tr>
            <tr>              
              <td style="width: 50%;"><strong>Nilai SPK + VO</strong></td>
              <td style="width: 50%;"><span id="total_spk_vo" class="number_align number_bap"></span></td>
            </tr>
            <tr>              
              <td style="width: 50%;">Nilai PPN + SPK + VO  </td>
              <td style="width: 50%;"><span id="ppn" class="number_align number_bap"></span></td>
            </tr>
            <tr>              
              <td style="width: 50%;"><strong>Nilai Kontrak</strong> </td>
              <td style="width: 50%;"><span id="total_nilai_kontrak" class="number_align number_bap"></span></td>
            </tr>
            <tr class="dp" style="display: none;">              
              <td style="width: 50%;">Nilai DP </td>
              <td style="width: 50%;"><span id="total_nilai_dp" class="number_align number_bap"></span></td>
            </tr>           
            <tr class="termyn" style="display: none;">              
              <td style="width: 50%;">Nilai Kumulatif BAP </td>
              <td style="width: 50%;"><span id="total_nilai_bap" class="number_align number_bap"></span></td>
            </tr>
            <tr>              
              <td style="width: 50%;">PPN Setelah Nilai Kumulatif BAP  </td>
              <td style="width: 50%;"><span id="ppn_nilai" class="number_align number_bap"></span></td>
            </tr>
            <tr>
              <td style="width: 50%;"><strong>Nilai Sertifikat </strong></td>
              <td style="width: 50%;"><span id="total_nilai_bap_ppn" class="number_align number_bap"></span></td>
            </tr>
            <tr>
              <td style="width: 50%;"><strong>Nilai BAP sebelumnya</strong></td>
              <td style="width: 50%;"><span id="total_bap_sebelumnya" class="number_align number_bap"></span></td>
            </tr>
            <tr>
              <td style="width: 50%;"><strong>Total yang bisa dibayar</strong></td>
              <td style="width: 50%;"><span id="total_dibayar" class="number_align number_bap"></span></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>
          <br/><br/>
          <table style="border:1px solid black;width: 100%;border-collapse: collapse;" border="1" cellpadding="5" cellspacing="5">
            <tr>
              <td style="width: 30%">
                <br/><br/><br/>
                <center><u><span id="bap_created_by"></span></u><br/></center>
                <center><span>QS</span></center>
              </td>
              <td style="width: 30%">
                <br/><br/><br/>
                <center><u><span>{{ $list_ttd_bap[6]['username']}}</span></u><br/></center>
                <center>{{ $list_ttd_bap[6]['jabatan'] }}</center>
              </td>
              <td style="width: 30%">
                <br/><br/><br/>
                <center><u><span>{{ $list_ttd_bap[5]['username']}}</span></u><br/></center>
                <center>{{ $list_ttd_bap[5]['jabatan'] }} </center>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>
  
  
  
  @endif
</div>
