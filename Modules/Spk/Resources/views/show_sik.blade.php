<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | SIK</title>
   @include("master/header")

  <link rel="stylesheet" href="{{ url('/')}}/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <section class="content-header">
      <h1>Data Surat Instruksi</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                <small></small>
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
              <form action="{{ url('/')}}/spk/sik-update" method="post" name="form1">
                {{ csrf_field() }}
                <input type="hidden" name="sik_id" id="sik_id"  value="{{ $suratinstruksi->id }}">

                <div class="form-group">
                  <label>No. SPK</label>
                  <input type="text" class="form-control" value="{{ $suratinstruksi->spk->no }}" disabled>
                </div>

                <div class="form-group">
                  <label>Perihal</label>
                  <input type="text" class="form-control" name="perihal" autocomplete="off" value="{{ $suratinstruksi->perihal }}">
                </div>

                <div class="form-group">
                  <textarea class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="content">{!! $suratinstruksi->content !!}</textarea>
                </div>

                <div class="form-group">
                  <button class="btn btn-primary" type="submit">Simpan</button>
                  <a href="{{ url('/')}}/spk/detail?id={{ $suratinstruksi->spk->id }}" class="btn btn-warning">Kembali</a>
                  <button class="btn btn-success" onClick="printsik();" type="button">Cetak</button>
                </div>
              </form>
            </div>

            <div class="box-body pad">
              <h3><center>Unit</center></h3>
              <table class="table table-bordered">
                <thead class="head_table">
                  <tr>
                    <td>Unit</td>
                    <td>Pekerjaan</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $suratinstruksi->spk->details as $key => $value )
                  <tr>
                    <td>{{ $value->asset->name }}</td>
                    <td>
                      <a href="{{ url('/')}}/spk/sik-unit?id={{ $value->id }}&sik={{ $suratinstruksi->id }}" class="btn btn-primary">Tambah VO</a>
                      <button class="btn btn-success" onClick="printvo();" type="button">Cetak</button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            @if ( count($suratinstruksi->vos) > 0 )
            <div class="box-body pad">
              <h3><center>Variation Order</center></h3>
              <table class="table table-bordered">
                <thead class="head_table">
                  <tr>
                    <td>Unit</td>
                    <td>Pekerjaan</td>
                    <td>Volume</td>
                    <td>Satuan</td>
                    <td>Nilai</td>
                    <td>Delete</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $suratinstruksi->vos as $key9 => $value9 )
                    @foreach ( $value9->details as $key10 => $value10 )
                    <tr>
                      <td>{{ $value10->spk_detail->asset->name }}</td>
                      <td>{{ $value10->unit_progress->itempekerjaan->name }}</td>
                      <td>{{ number_format($value10->unit_progress->volume,2) }}</td>
                      <td>{{ $value10->unit_progress->satuan }}</td>
                      <td>{{ number_format($value10->unit_progress->nilai,2) }}</td>
                      <td><button class="btn btn-danger" onclick="removeVo('{{ $value10->id }}')">Hapus</button></td>
                    </tr>
                    @endforeach
                  @endforeach
                </tbody>
              </table>
            </div>
            @endif

          </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
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
  <style type="text/css">
    @page {
      margin: 0px;
    }
  </style>
  <div id="head_content_sik">
    <div id="dvcontent_sik" class="result" style="display: none;">
      <table width="100%" style="border-collapse:collapse;" class='table' id='form_spk'>
        <tr>
          <td>@include("print.logo",['pt' => $suratinstruksi->spk->tender->rab->budget_tahunan->budget->pt ] )</td>
        </tr>
        <tr>
          <td colspan="2">
            <table width="100%" style="border-collapse: collapse;border:1px solid black;font-size:10px;" border="1px">
              <tr>
                <td width="50%;" style="vertical-align: top;">
                  <table width="100%" style="font-size:12px;">
                    <tr>
                      <td>Nomor SPK</td>
                      <td>:</td>
                      <td>{{ $suratinstruksi->spk->no }}</td>
                    </tr>
                    <tr>
                      <td>Lokasi Pekerjaan</td>
                      <td>:</td>
                      <td>
                        @if ( $suratinstruksi->spk->tender->rab->budget_tahunan->budget->kawasan != "" )
                          <u>{{ ucwords($suratinstruksi->spk->tender->rab->budget_tahunan->budget->kawasan->name) }}</u>
                        @else
                          <u>{{ ucwords($suratinstruksi->spk->project->name) }}</u>
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td>Jenis Pekerjaan</td>
                      <td>:</td>
                      <td><u>{{ $suratinstruksi->spk->itempekerjaan->name }}</u></td>
                    </tr>
                    <tr>
                      <td>Blok / Nomor </td>
                      <td>:</td>
                      <td>
                        @php $asset = ""; @endphp
                        @foreach ( $suratinstruksi->spk->details as $key => $value )
                          @php $asset .= $value->asset->name .","; @endphp
                        @endforeach
                        <u>{{ trim($asset,",")}}</u>
                      </td>
                    </tr>
                  </table>
                </td>
                <td width="50%">
                  <table width="100%">
                    <tr>
                      <td>
                        <center><h2 style="font-size:20px;"><strong>SURAT INSTRUKSI KONTRAK</strong></h2><hr></center>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <span>Nomor SIK   : <u>{{ $suratinstruksi->no or '-'}}</u></span><br>
                        <span>Tanggal SIK : <u>{{ date("d M Y", strtotime($suratinstruksi->created_at)) }}</u></span>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <table width="100%" style="font-size:10px;margin: 0" >
                    <tr>
                      <td>Ditujukan</td>
                      <td>:</td>
                      <td><input type="checkbox" name=""><i>Kontraktor</i></td>
                      <td><strong>{{ $suratinstruksi->spk->rekanan->group->name or '-'}}</strong></td>
                      <td>PIC</td>
                    </tr>
                    <tr>
                      <td>Tembusan</td>
                      <td>:</td>
                      <td><input type="checkbox" name=""><i>{{ $suratinstruksi->spk->tender->rab->budget_tahunan->budget->department->name or '-' }}</i></td>
                      <td><strong>{{ $suratinstruksi->spk->tender->rab->budget_tahunan->budget->pt->name or '-' }}</strong></td>
                      <td>PIC</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>:</td>
                      <td><input type="checkbox" name=""> <i>Quantity Surveyor</i></td>
                      <td><strong>{{ $suratinstruksi->spk->tender->rab->budget_tahunan->budget->pt->name or '-' }}</strong></td>
                      <td>PIC</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>:</td>
                      <td><input type="checkbox" name=""> <i>Arsip</i></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                  <div style="border:1px solid black;border-collapse: collapse;margin : 10px;">
                    <i>Instruksi ini adalah otorisasi untuk segera melaksanakan pekerjaan tersebut di bawah ini. Setiap pengajuan (klaim) untuk perubahan harga yang terjadi dianggap sah bila disertai dengan Variation Order yang ditanda tangani oleh kedua belah pihak. Pengajuan perubahan waktu harus diajukan secara tertulis kepada Project Manager</i>
                  </div>
                </td>
              </tr>
            </table>
            <br>
            <table width="100%" style="border-collapse: collapse;border:1px solid black;font-size: 10px;" border="1px">
              <tr>
                <td style="vertical-align: top;height: 570px;width: 100%;" colspan="2">
                  <h4><i><strong>Perihal : <u>{{ $suratinstruksi->perihal or ''}}</u></strong></i></h4>
                  <br><br>
                  Dengan Hormat
                  {!! $suratinstruksi->content !!}
                  <br><br>
                </td>
              </tr>
             <tr style="width: 100%;text-align: center;">
              @if ( $suratinstruksi->vos != "" )
               
                <td width="50%">
                  <span>Dibuat Oleh</span><br><br><br><br><br>
                  @foreach ( $suratinstruksi->spk->approval->histories as $key => $value )
                  @if ( $value->no_urut == 6 )
                    <u><span>{{ $value->user->user_name or '-'}}</span></u><br>
                    <strong>{{ $value->user->jabatan[0]["jabatan"]}}</strong>
                  @endif
                  @endforeach
                </td>
                <td>
                  <span>Dibuat Oleh</span><br><br><br><br><br>
                  @foreach ( $suratinstruksi->spk->approval->histories as $key => $value )
                  @if ( $value->no_urut == 5 )
                    <u><span>{{ $value->user->user_name or '-'}}</span></u><br>
                    <strong>{{ $value->user->jabatan[0]["jabatan"]}}</strong>
                  @endif
                  @endforeach
                </td>
                 
              @else
              <td width="50%">
                <span>Dibuat Oleh</span><br><br><br>
                @foreach ( $suratinstruksi->spk->approval->histories as $key => $value )
                @if ( $value->no_urut == 7 )
                  <u><span>{{ $value->user->user_name or '-'}}</span></u><br>
                  <strong>{{ $value->user->jabatan[0]["jabatan"]}}</strong>
                @endif
                @endforeach
              </td>
              <td>
                <span>Dibuat Oleh</span><br><br><br>
                @foreach ( $suratinstruksi->spk->approval->histories as $key => $value )
                @if ( $value->no_urut == 6 )
                  <u><span>{{ $value->user->user_name or '-'}}</span></u><br>
                  <strong>{{ $value->user->jabatan[0]["jabatan"]}}</strong>
                @endif
                @endforeach
              </td>
              @endif
             </tr>
             <tr>
              <td colspan="2"><strong><i>PENGAJUAN (KLAIM) ATAS SIK INI ADALAH 14 HARI KERJA TERHITUNG SEJAK TANGGAL PENERBITAN SIK</i></strong></td>
             </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td>@include("print.footer",['project' => $suratinstruksi->spk->project ] )</td>
        </tr>
      </table>
    </div>
  </div>

  <div id="head_content_vo">
    <div id="dvcontent_vo" class="result" style="display: none;">
      @if ( $suratinstruksi->vos != "" )
      <table width="100%" style="border-collapse:collapse;" class='table' id='form_spk'>
        <tr>
          <td>@include("print.logo",['pt' => $suratinstruksi->spk->tender->rab->budget_tahunan->budget->pt ] )</td>
        </tr>
        <tr>
          <td>
            <table width="100%" style="border-collapse: collapse;border:1px solid black" border="1px" cellpadding="5" cellspacing="5">
              <tr>
                <td><center>{{ $suratinstruksi->spk->tender->rab->budget_tahunan->budget->department->name or '-'}}</center> </td>
              </tr>
            </table><br>
            <table width="100%" style="border-collapse: collapse;border:1px solid black" border="1px">
              <tr>
                <td rowspan="2" width="50%;" style="vertical-align: top">
                  <table width="100%" style="margin:0px;font-size:12px;">
                    <tr>
                      <td>Pihak II</td>
                      <td>:</td>
                      <td>{{ $suratinstruksi->spk->rekanan->group->name or '-'}}</td>
                    </tr>
                    <tr>
                      <td>Pekerjaan</td>
                      <td>:</td>
                      <td>{{ $suratinstruksi->spk->itempekerjaan->name or '-'}}</td>
                    </tr>
                    <tr>
                      <td>Kawasan</td>
                      <td>:</td>
                      <td>
                        @if ( $suratinstruksi->spk->tender->rab->budget_tahunan->budget->kawasan != "")
                          {{ $suratinstruksi->spk->tender->rab->budget_tahunan->budget->kawasan->name or '-' }}
                        @else
                          {{ $suratinstruksi->spk->project->name or '-'}}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td>Blok / No</td>
                      <td>:</td>
                      <td>{{ $asset }}</td>
                    </tr>
                  </table>
                </td>
                <td width="50%;" style="vertical-align: top;text-align: center;margin: 0px;">
                  <span style="font-size:26px;"><strong>VO : {{ count($suratinstruksi->spk->total_vo) }}</strong></span>
                </td>
              </tr>
              <tr>
                <td width="50%;">
                  <table width="100%" style="font-size:10px;">
                    <tr>
                      <td><strong>Nomor SPK</strong></td>
                      <td>:</td>
                      <td>{{ $suratinstruksi->spk->no or '-'}}</td>
                    </tr>
                    <tr>
                      <td><strong>COA Pekerjaan</strong></td>
                      <td>:</td>
                      <td>{{ $suratinstruksi->spk->itempekerjaan->code or '-'}}</td>
                    </tr>
                    <tr>
                      <td><strong>Tanggal</strong></td>
                      <td>:</td>
                      <td>{{ $suratinstruksi->created_at->format("d M Y") }}</td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table><br>
            <table width="100%" style="border-collapse: collapse;border:1px solid black;font-size: 12px;" border="1px">
              <tr>
                <td>No.</td>
                <td>No SIK</td>
                <td>Item Pekerjaan</td>
                <td>Satuan</td>
                <td>Volume</td>
                <td>Harga Satuan</td>
                <td>Total Harga</td>
              </tr>
              @php $start = 1; $nilai = 0; @endphp
              @foreach( $suratinstruksi->units as $key => $value )
                @if ( count($value->items) > 0 )
                  @foreach ( $value->items as $key2 => $value2 )
                    <tr>
                      <td>{{ $start }}</td>
                      <td>{{ $suratinstruksi->no }}</td>
                      <td>{{ $value2->pekerjaan->name or '-'}} / {{ $value->spk_detail->asset->name or '-' }}</td>
                      <td>{{ $value2->unit_progress->satuan or 'ls'}}</td>
                      <td>{{ $value2->unit_progress->volume or '0' }}</td>
                      <td>{{ number_format($value2->unit_progress->nilai,2) }}</td>
                      <td>{{ number_format($value2->unit_progress->nilai * $value2->unit_progress->volume,2) }}</td>
                    </tr>
                    @php $start++; $nilai = $nilai + ($value2->unit_progress->nilai * $value2->unit_progress->volume); @endphp
                  @endforeach
                @endif
              @endforeach
              <tr>
                <td colspan="2">
                  Diajukan oleh<br><br><br><br>
                </td>
                <td colspan="2">
                  Disiapkan oleh<br><br><br><br>
                </td>
                <td colspan="2" style="text-align: right;">Nilai VO(Rp)</td>
                <td>{{ number_format($nilai,2) }}</td>
              </tr>
              <tr>
                <td colspan="6" style="text-align: right;">PPn(Rp)</td>
                <td>
                  @if ( $suratinstruksi->spk->rekanan->pkp_status == "2")
                    {{ number_format($ppn = $nilai * ($suratinstruksi->spk->rekanan->ppn / 100 ),2) }}
                  @else
                    {{ number_format($ppn = 0,2) }}
                  @endif
                </td>
              </tr>
              <tr>
                <td colspan="6" style="text-align: right;"><strong>Total VO(Rp)</strong></td>
                <td>{{ number_format($ppn + $nilai ,2) }}</td>
              </tr>
              <tr>
                <td colspan="6"><strong>Nilai Kontrak Awal(Rp)</strong></td>
                <td>{{ number_format($suratinstruksi->spk->nilai,2) }}</td>
              </tr>
              <tr>
                <td colspan="6"><strong>Nilai Pekerjaan +/-(VO) Kumulatif (Rp)</strong></td>
                <td>{{ number_format($nilai,2) }}</td>
              </tr>
              <tr>
                <td colspan="6"><strong>Nilai Kontrak setelah VO dikeluarkan (Rp)</strong></td>
                <td>{{ number_format($suratinstruksi->spk->nilai + $nilai,2) }}</td>
              </tr>
            </table><br>
            <table width="100%" border="1px" style="border-collapse: collapse;width: 100%;font-size: 12px;margin:0px;">
              <tr>
                <td style="text-transform: uppercase;vertical-align: top;">
                  <center><strong><span>PIHAK KEDUA</span></strong></center><br>
                  <center><span>{{ $suratinstruksi->spk->rekanan->group->name or '-' }}</span></span>
                </td>
                <td colspan="3">
                  <strong><center>PIHAK PERTAMA</strong></center><br>
                  <span><center>{{ $suratinstruksi->spk->tender->rab->budget_tahunan->budget->pt->name or '-' }}</center></span>
                </td>
              </tr> 
              <tr>
                <td style="width: 25%;">                      
                  <h1>&nbsp;</h1>
                  <h1>&nbsp;</h1>
                  <center><u>{{ $suratinstruksi->spk->rekanan->cp_name }}</u><br></span></center>
                  <center><span><strong>{{ $suratinstruksi->spk->rekanan->cp_jabatan}}</strong></span></center>
                </td>
                <td style="width: 25%;">
                  @if ( isset($list_ttd[2]))
                  <h1>&nbsp;</h1>
                  <h1>&nbsp;</h1>
                  <center><u>{{ $list_ttd[2]["user_name"] }}</u><br></span></center>
                  <center><span><strong>{{ $list_ttd[2]["user_jabatan"] }}</strong></span></center>
                  @endif
                </td>
                <td style="width: 25%;">
                  <h1>&nbsp;</h1>
                  <h1>&nbsp;</h1>
                  <center><u>{{ $list_ttd[1]["user_name"] }}</u><br></span></center>
                  <center><span><strong>{{ $list_ttd[1]["user_jabatan"] }}</strong></span></center>
                </td>
                <td style="width: 25%;">
                  <h1>&nbsp;</h1>
                  <h1>&nbsp;</h1>
                  <center><u>{{ $list_ttd[0]["user_name"] }}</u><br></span></center>
                  <center><span><strong>{{ $list_ttd[0]["user_jabatan"] }}</strong></span></center>
                </td>
              </tr>
              <tr>
                <td colspan="4">VO ini dapat dijadikan lampiran untuk tagihan termyn</td>
              </tr>                 
            </table>
          </td>
        </tr>
        <tr>
          <td>@include("print.footer",['project' => $suratinstruksi->spk->project ] )</td>
        </tr>
      </table>
      @endif
    </div>
  </div>
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("spk::app")
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })

  function removeVo(id){
    if ( confirm("Apakah anda yakin ingin menghapus VO ini ?")){
      var request = $.ajax({
        url : "{{ url('/')}}/spk/delete-vo",
        data : {
          id : id
        },
        type : "post",
        dataType : "json"
      });

      request.done(function(data){
        if ( data.status == "0"){
          alert("Data VO telah dihapus");
        }

        window.location.reload();
      })
    }else{
      return false;
    }
  }

  function printsik(){
    var myPrintContent = document.getElementById('head_content_sik');
    var myPrintWindow = window.open("", "");
    myPrintWindow.document.write(myPrintContent.innerHTML);
    myPrintWindow.document.getElementById('dvcontent_sik').style.display='block';
    myPrintWindow.document.close();
    myPrintWindow.focus();
    myPrintWindow.print();
    myPrintWindow.close();    
    return false;
  }

  function printvo(){
    var myPrintContent = document.getElementById('head_content_vo');
    var myPrintWindow = window.open("", "");
    myPrintWindow.document.write(myPrintContent.innerHTML);
    myPrintWindow.document.getElementById('dvcontent_vo').style.display='block';
    myPrintWindow.document.close();
    myPrintWindow.focus();
    myPrintWindow.print();
    myPrintWindow.close();    
    return false;
  }
</script>
</body>
</html>
