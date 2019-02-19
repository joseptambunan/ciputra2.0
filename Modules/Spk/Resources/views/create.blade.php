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
            <div class="col-md-6">   

              <h3 class="box-title">Detail Data SPK</h3>      
              <input type="hidden" name="total_termin" id="total_termin" value="{{ $spk->progresses->first()->itempekerjaan->item_progress->count() }}">     
              <form action="{{ url('/')}}/spk/update-date" method="post" name="form1">
              <input type="hidden" name="spk_id" id="spk_id" value="{{ $spk->id }}">
              {{ csrf_field() }}
              <div class="form-group">
                <label>No SPK</label>
                <input type="text" value="{{ $spk->no }}" class="form-control" readonly>
              </div>
              <div class="form-group">
                <label>Nama SPK</label>
                <input type="text" value="{{ $spk->name }}" name="spk_name" class="form-control">
              </div>    
              <div class="form-group">
                <label>Rekanan</label>
                <input type="text" value="{{ $spk->rekanan->group->name }}" class="form-control" readonly>
              </div>  
              <div class="form-group">
                <label>Jenis SPK</label>
                @php
                  $arrayStatus = array("0" => "Tender", "1" => "Penawaran Langsung")
                @endphp
                <input type="text" class="form-control" name="workorder_durasi" value="{{ $arrayStatus[$spk->is_instruksilangsung]}}" readonly>
              </div>  
              <div class="form-group">
                <label>COA PPh : <strong>{{ $spk->coa_pph_default_id }} %</strong></label>
                @php $array_pph = array(2,3,4,6); @endphp
                <select class='form-control' name='coa_pph' id='coa_pph' class="form-control">
                  @foreach ( $array_pph as $key4 => $value4 )
                    @if ( $value4 == $spk->coa_pph_default_id )
                      <option value='{{ $value4}}' selected>{{ $value4}} %</option>
                    @endif
                      <option value='{{ $value4}}' >{{ $value4}} %</option>
                    @endforeach
                </select>
              </div> 
              @if ( $spk->approval != "" )
                @if ( $spk->approval->approval_action_id == 6 )
                    @if ( $spk->pic_id == NULL )
                      <div class="form-group">
                        <span id="loading_pic" style="display: none;"><strong>Loading...</strong></span>
                        <label>PIC</label>
                          <select class="form-control" name="pic_id" id="pic_id">
                            @foreach ( $user_pic as $key => $value )
                              <option value="{{ $value['user_id']}}">{{ $value['user_name'] }}</option>
                            @endforeach
                          </select><br>
                        <button type="button" class="btn btn-primary" onClick="setPic()">Simpan</button>
                      </div>    
                    @endif   
                @endif
              @endif
              <div class="box-footer">
                @if ( $spk->rekanan->supps->count() > 0 )
                  <a class="btn bg-purple" href="{{ url('/')}}/spk/supp/show?id={{$spk->id}}">SUPP</a>
                  @if ( $spk->approval == "" )
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <button type="button" class="btn btn-info" onclick="approval('{{ $spk->id }}');">Request Approval</button>
                  @else
                    @php
                      $array = array (
                        "6" => array("label" => "Disetujui", "class" => "label label-success"),
                        "7" => array("label" => "Ditolak", "class" => "label label-danger"),
                        "1" => array("label" => "Dalam Proses", "class" => "label label-warning"),
                        "" => array("label" => "","class" => "")
                      )
                    @endphp
                    <span class="{{ $array[$spk->approval->approval_action_id]['class'] }}">{{ $array[$spk->approval->approval_action_id]['label'] }}</span>
                  @endif
                  <a class="btn btn-warning" href="{{ url('/')}}/spk/">Kembali</a>
                  @if ( $spk->approval != "" )
                  <a href="{{ url('/')}}/spk/approval_history?id={{ $spk->id }}" class="btn btn-success">Approval History</a>
                    @if ( $spk->approval->approval_action_id == "6")
                    <button class="btn btn-info" type="button" onclick="printspk();">Cetak SPK</button>
                    @endif                  
                  @php
                    $array = array (
                      "6" => array("label" => "Disetujui", "class" => "label label-success"),
                      "7" => array("label" => "Ditolak", "class" => "label label-danger"),
                      "1" => array("label" => "Dalam Proses", "class" => "label label-warning"),
                      "" => array("label" => "","class" => "")
                    )
                  @endphp

                  
                  @if ( count($spk->termyn) <=0 )
                  <h3 style="color:red"><strong>SPK ini belum memiliki bobot. Silahkan isi di kolom Progress Lapangan</strong></h3>
                  @endif
                  
                  @endif
                  <h2>Nilai  : Rp. {{ number_format($spk->nilai)}}</h2>
                  <h2>Nilai VO : Rp. {{ number_format($spk->nilai_vo)}}</h2>
                  <h2>Nilai SPK (Excl. PPN) : Rp. {{ number_format($spk->nilai_vo + $spk->nilai) }}
                  <h2>PIC : <strong>{{ $spk->user_pic->user_name or '' }}</strong></h2>
                @else
                <h3 style="color:red;"><strong>Rekanan ini belum memiliki SUPP.<br> Silahkan isi form SUPP menggunakan <a href="{{ url('/')}}/spk/supp/?id={{$spk->id}}" class="btn btn-info">Tombol ini.</a></strong></h3>
                @endif
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
             <div class="col-md-6">
              <h3>&nbsp;</h3>
              <div class="form-group">
                <label>Start Date</label> 
                <input type="hidden" id="durasi" name="durasi" value="{{ $spk->tender->durasi }}">
                <input type="text" class="form-control" name="start_date" id="start_date" value="{{ $spk->start_date->format('d/m/Y') }}" autocomplete="off" required >
              </div> 
              <div class="form-group">
                <label>End Date ( Rencana Durasi : <strong>{{ $spk->tender->durasi}}</strong> Hari Kalender )</label>
                <input type="text" class="form-control" name="end_date" id="end_date" value="@if ( $spk->finish_date != null ) {{ $spk->finish_date->format('d/m/Y') }}  @endif" autocomplete="off" required>
              </div> 
              
              <div class="form-group">
                <label>Serah Terima 1</label>
                <input type="text" class="form-control" name="st_1" id="st_1"  value="@if ( $spk->st_1 != null ) {{ $spk->st_1 }}  @endif" autocomplete="off" readonly>
              </div> 
              @if ( count($spk->retensis) > 0 )
              <div class="form-group">
                <label>Serah Terima 2</label>
                <input type="text" class="form-control" name="st_2" id="st_2" value="@if ( $spk->st_2 != null ) {{ $spk->st_2 }}  @endif" autocomplete="off" readonly required>
              </div> 
              <div class="form-group">
                <label>Serah Terima 3</label>
                <input type="text" class="form-control" name="st_3" id="st_3" value="@if ( $spk->st_3 != null ) {{ $spk->st_3 }}  @endif" readonly>
              </div> 
              @else
              <div class="form-group">
                <h4>Harap isi retensi sebelum mengisi data serah terima</h4>
              </div>
              @endif
            </div>
            </form>
            <!-- /.col -->

                <div class="col-md-12">
                  @if ( $spk->rekanan->supps->count() > 0 )
                  <div class="nav-tabs-custom"> 
                    <ul class="nav nav-tabs">                      
                      <li class="active"><a href="#tab_7" data-toggle="tab">Data DP</a></li>
                      <li><a href="#tab_8" data-toggle="tab">Retensi</a></li>
                      <li><a href="#tab_1" data-toggle="tab">Data Pembayaran</a></li>
                      <li><a href="#tab_2" data-toggle="tab">Item Pekerjaan</a></li>                
                      <li><a href="#tab_3" data-toggle="tab">Unit</a></li>            
                      <li><a href="#tab_4" data-toggle="tab">Progress Lapangan</a></li>
                      <li><a href="#tab_5" data-toggle="tab">Variation Order (VO)</a></li>
                      <li><a href="#tab_6" data-toggle="tab">BAP</a></li>
                    </ul>
                    <div class="tab-content"> 
                      <div class="tab-pane" id="tab_8">
                        <div class="row">
                          <div class="col-md-12">  

                            <form action="{{ url('/')}}/spk/save-retensi" method="post" name="form1">
                              <input type="hidden" class="form-control" name="spk_id" value="{{ $spk->id }}">
                              {{ csrf_field() }}
                              @if ( count($spk->retensis) <= 0 )
                                <div class="form-group"> 
                                  <label>Retensi Persen</label>
                                  <input type="text" class="form-control" name="retensi" autocomplete="off">
                                </div>
                                <div class="form-group"> 
                                  <label>Hari</label>
                                  <input type="text" class="form-control" name="hari" autocomplete="off">
                                </div>
                                <div class="form-group"> 
                                  <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                              @else
                                @if ( $spk->retensis->sum("percent") < "0.05")
                                  <div class="form-group"> 
                                    <label>Retensi Persen</label>
                                    <input type="text" class="form-control" name="retensi" autocomplete="off">
                                  </div>
                                  <div class="form-group"> 
                                    <label>Hari</label>
                                    <input type="text" class="form-control" name="hari" autocomplete="off">
                                  </div>
                                  <div class="form-group"> 
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                  </div>
                                @endif
                              @endif

                             
                            </form>

                            <table class="table table-bordered">
                              <thead class="head_table">
                                <tr>
                                  <td>Retensi</td>
                                  <td>Hari</td>
                                  <td>Hapus</td>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($spk->retensis as $key => $value )
                                <tr>
                                  <td>{{ $value->percent * 100 }} %</td>
                                  <td>{{ $value->hari }}</td>
                                  <td>
                                    @if ( $spk->approval == "" )
                                    <button type="button" class="btn btn-danger" onclick="removeRetensi('{{ $value->id }}')">Hapus</button>
                                    @else
                                      @if ( $spk->approval->approval_action_id != "6")
                                        <button type="button" class="btn btn-danger" onclick="removeRetensi('{{ $value->id }}')">Hapus</button>
                                      @endif
                                    @endif
                                  </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane active" id="tab_7">
                        <div class="row">
                          <div class="col-md-12">                        
                            <h4><strong>Type DP : {{ $spk->type->description or '' }}</strong></h4>
                            <h4><strong>DP      : Rp. {{ number_format(( $spk->dp_percent / 100 ) * ($spk->nilai + $spk->nilai_vo )) }}</strong></h4>


                        @if ( $spk->approval != "" )
                          @if ( $spk->approval->approval_action_id == "7")
                            @if ( $spk->baps->count() <= 0 )
                            <form action="{{ url('/')}}/spk/update-dp" method="post" name="form1">
                              <input type="hidden" name="spk_id" value="{{ $spk->id }}">
                              {{ csrf_field() }}
                              <div class="form-group">
                                <select class="form-control" name="dp_type">
                                  @foreach ( $spktype as $key3 => $value3 )
                                  <option value="{{ $value3->id }}">{{ $value3->description }}</option>
                                  @endforeach
                                </select>
                              </div>
                              
                              <div class="form-group">
                                <label>DP Percent(%)</label>
                                <input type="text" value="{{ $spk->dp_percent }}" name="dp_percent" class="form-control" autocomplete="off">
                              </div>
                              
                              <div class="box-footer">                               
                                   @if ( $spk->approval != "" )
                                  <button type="submit" class="btn btn-primary">Simpan</button>                 
                                @endif
                            
                              </div>
                            </form>
                            @endif
                            
                            @if ( $spk->spk_type_id == "1")
                              @if ( $spk->dp_percent != "" )
                              <h3>DP : {{ number_format(($spk->dp_percent * $spk->nilai)/100,2 )}}</h3>
                              @if ( count($spk->dp_pengembalians) <= 0 )
                              <div class="form-group">
                                  <label>Jumlah Periode Pengembalian DP</label>
                                  <input type="number" value="" name="dp_termin" id="dp_termin" class="form-control" max="4"> 
                                  <button type="button" class="btn btn-info" onClick="generatedptermin();">Generate</button>
                              </div>  
                              @endif
                              @endif
                            @else
                            Minimum Progress : {{ $spk->min_progress_dp or '0'}} %
                            <form action="{{ url('/')}}/spk/minprogress" method="post" name="form1">
                              {{ csrf_field()}}
                              <input type="hidden" name="spk_id" value="{{ $spk->id }}">
                              <div class="form-group">
                                <label>Minimum Progress</label>
                                <input type="text" class="form-control" name="min_progress_dp" autocomplete="off">
                              </div>
                              <div class="form-group">
                                 <button type="submit" class="btn btn-info" onClick="generatedptermin();">Simpan</button>
                              </div>
                            </form>
                            @endif
                            
                            <form action="{{url('/')}}/spk/save-dp" method="post">
                              {{ csrf_field() }}
                              <input type="hidden" name="spk_id_dp" id="spk_id_dp" value="{{ $spk->id }}"> 
                              <div id="form1">
                              </div>
                            </form>
                            <span id="total_dp_percent"></span> %<br>
                          @endif
                        @else
                            @if ( $spk->baps->count() <= 0 )
                            <form action="{{ url('/')}}/spk/update-dp" method="post" name="form1">
                              <input type="hidden" name="spk_id" value="{{ $spk->id }}">
                              {{ csrf_field() }}
                              <div class="form-group">
                                <select class="form-control" name="dp_type">
                                  @foreach ( $spktype as $key3 => $value3 )
                                  <option value="{{ $value3->id }}">{{ $value3->description }}</option>
                                  @endforeach
                                </select>
                              </div>
                              
                              <div class="form-group">
                                <label>DP Percent(%)</label>
                                <input type="text" value="{{ $spk->dp_percent }}" name="dp_percent" class="form-control" autocomplete="off">
                              </div>
                              
                              <div class="box-footer">
                                
                                  <button type="submit" class="btn btn-primary">Simpan</button>                 
                                
                              </div>
                            </form>
                            @endif
                            
                            @if ( $spk->spk_type_id == "1")
                              @if ( $spk->dp_percent != "" )
                              <h3>DP : {{ number_format(($spk->dp_percent * $spk->nilai)/100,2 )}}</h3>
                              @if ( count($spk->dp_pengembalians) <= 0 )
                              <div class="form-group">
                                  <label>Jumlah Periode Pengembalian DP</label>
                                  <input type="number" value="" name="dp_termin" id="dp_termin" class="form-control" max="4"> 
                                  <button type="button" class="btn btn-info" onClick="generatedptermin();">Generate</button>
                              </div>  
                              @endif
                              @endif
                            @else
                            Minimum Progress : {{ $spk->min_progress_dp or '0'}} %
                            <form action="{{ url('/')}}/spk/minprogress" method="post" name="form1">
                              {{ csrf_field()}}
                              <input type="hidden" name="spk_id" value="{{ $spk->id }}">
                              <div class="form-group">
                                <label>Minimum Progress</label>
                                <input type="text" class="form-control" name="min_progress_dp" autocomplete="off">
                              </div>
                              <div class="form-group">
                                 <button type="submit" class="btn btn-info" onClick="generatedptermin();">Simpan</button>
                              </div>
                            </form>
                            @endif
                            
                            <form action="{{url('/')}}/spk/save-dp" method="post">
                              {{ csrf_field() }}
                              <input type="hidden" name="spk_id_dp" id="spk_id_dp" value="{{ $spk->id }}"> 
                              <div id="form1">
                              </div>
                            </form>
                            <span id="total_dp_percent"></span> %<br>
                        @endif
                            <table class="table table-bordered">
                              <thead class="head_table">
                                <tr>
                                  <td>Periode</td>
                                  <td>Pembayaran ke </td>
                                  <td>Percentage (%)</td>
                                  <td>Percentage Kumulatif(%)</td>
                                  <td>Subtotal(Rp)</td>
                                  <td>Subtotal Kumulatif(Rp)</td>
                                </tr>
                              </thead>
                              <tbody>
                                @php $percent_kumulatif = 0; $total_kumulatif = 0 ; @endphp
                                @foreach ( $spk->dp_pengembalians as $key8 => $value8 )
                                @php
                                  $percent_kumulatif = $percent_kumulatif + $value8->percent;
                                  $total_kumulatif   =  (( $percent_kumulatif / 100 ) * ( ( $spk->dp_percent / 100 ) * $spk->nilai)) ;
                                @endphp
                                <tr>
                                  <td>{{ $key8 + 1 }}</td>
                                  <td>{{ $key8 + 2 }}</td>
                                  <td>{{ $value8->percent }}</td>
                                  <td>{{ number_format($percent_kumulatif,2) }} %</td>
                                  <td>{{ number_format($value8->percent * (($spk->dp_percent * $spk->nilai) / 100) / 100 ,2) }}</td>
                                  <td>{{ number_format($total_kumulatif,2) }}</td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div> 
                      <div class="tab-pane" id="tab_1">
                        <div class="row">
                          <div class="col-md-6">   
                            <h3 class="box-title">Detail Data Pembayaran</h3>           
                              <form action="{{ url('/')}}/spk/update-payment" method="post" name="form1">
                                <input type="hidden" name="spk_id" value="{{ $spk->id }}">
                                {{ csrf_field() }}
                                
                                <div class="form-group">
                                  <label>Denda A(Rp)</label>
                                  <input type="text" value="{{ $spk->denda_a }}" name="denda_a" id="denda_a" class="form-control" autocomplete="off">
                                </div>    
                                <div class="form-group">
                                  <label>Denda B(Rp)</label>
                                  <input type="text" value="{{ $spk->denda_b }}" name="denda_b" id="denda_b" class="form-control" autocomplete="off">
                                </div>  
                                <div class="form-group">
                                  <label>Mata Uang</label>
                                  <input type="text" value="{{ $spk->matauang }}" name="matauang" id="matauang" class="form-control" autocomplete="off">
                                </div>                              
                                <div class="form-group">
                                  <label>Nilai Tukar</label>
                                  <input type="text" value="{{ $spk->nilai_tukar }}" name="nilai_tukar" id="nilai_tukar" class="form-control" autocomplete="off">
                                </div>
                                <div class="form-group">
                                  <label>Jenis Kontrak</label>
                                  <select class='form-control' name='jenis_kontrak' id='jenis_kontrak' class="form-control">
                                    <option value='FIXED PRICE & LUMPSUM'>FIXED PRICE & LUMPSUM</option>
                                    <option value='FIXED PRICE'>FIXED PRICE</option>
                                    <option value='LUMPSUM'>LUMPSUM</option>
                                    <option value='REMEASURE'>REMEASURE</option>
                                  </select>
                                </div>

                                <div class="form-group">
                                  <label>Memo Cara Bayar</label>
                                  <input type="text" value="{{ $spk->memo_cara_bayar }}" name="memo_cara_bayar" class="form-control" autocomplete="off">
                                </div> 
                                <div class="form-group">
                                  <label>Cara Pembayaran</label>
                                  <input type="text" value="{{ $spk->carapembayaran }}" name="carapembayaran" class="form-control" autocomplete="off">
                                </div>                             
                                <div class="form-group">
                                  <label>Memo Lingkup Kerja</label>
                                  <input type="text" value="{{ $spk->memo_lingkup_kerja }}" name="memo_lingkup_kerja" class="form-control" autocomplete="off">
                                </div>
                                <div class="form-group">
                                  <label>Nilai Garansi</label>
                                  <input type="text" value="{{ $spk->garansi_nilai }}" name="garansi_nilai" class="form-control" autocomplete="off">
                                </div>
                                <div class="box-footer">
                                  @if ( $spk->approval == "" )
                                    <button type="submit" class="btn btn-primary">Simpan</button>                               
                                  
                                  @endif
                                </div>
                              </form>
                              <!-- /.form-group -->
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane" id="tab_2">
                        <table class="table table-bordered">
                          <thead class="head_table">
                            <tr>
                              <td>COA</td>
                              <td>Item Pekerjaan</td>
                              <td>Volume</td>
                              <td>Harga Satuan</td>
                              <td>Satuan</td>
                              <td>Subtotal</td>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ( $spk->tender_rekanan->menangs->first()->details as $key2 => $value2 )
                            @php 
                              $itempekerjaan = \Modules\Pekerjaan\Entities\Itempekerjaan::find($value2->itempekerjaan_id);
                              $rab = \Modules\Rab\Entities\RabPekerjaan::where("itempekerjaan_id",$itempekerjaan->id)->first();
                            @endphp
                            <tr>
                              <td>{{ $itempekerjaan->code }}</td>
                              <td>{{ $itempekerjaan->name }}</td>
                              <td>{{ $value2->volume }}</td>
                              <td>{{ number_format($value2->nilai) }}</td>
                              <td>{{ $value2->satuan }}</td>
                              <td>{{ number_format($value2->volume * $value2->nilai) }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>

                      <div class="tab-pane" id="tab_3">
                        <table class="table table-bordered">
                          <thead class="head_table">
                            <tr>
                              <td>Unit Name</td>
                              <td>Type</td>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ( $spk->details as $key2 => $value2 )                        
                            <tr>
                              <td>{{ $value2->asset->name }}</td>
                              <td>{{ $value2->asset_type}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      <div class="tab-pane" id="tab_4">
                        @if ( count($spk->termyn) <=0 )
                        <h3>Item Coa ini belum disetting di master progress Item Pekerjaan.</h3>
                          @if ( count($spk->progresses->last()->itempekerjaan->item_progress) > 0  )
                            <button type="button" class="btn btn-primary" onclick="setprogress('{{ $spk->id}}')">Buat Progress</button>
                          @endif
                        @else
                        <table class="table table-bordered">
                          <thead class="head_table">
                            <tr>
                              <td>COA</td>
                              <td>Item Pekerjaan</td>
                              <td>Bobot(%)</td>
                              <td>Prog. Lap.(%)</td>
                              <td>Total Prog.(%)</td>
                              @foreach ( $spk->termyn as $key3 => $value3)
                              @if ( $key3 > 0)
                              <td>T-{{ $value3->termin  }} (%)</td>
                              @endif
                              @endforeach
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>
                                @php $nilai = 0; @endphp
                                @foreach ( $spk->list_pekerjaan as $key11 => $value11 )
                                    @php $nilai = $value11['bobot_coa'] + $nilai; @endphp
                                @endforeach
                                {{ number_format($nilai,2) }} %
                              </td>
                              <td>
                                @php $nilai = 0; @endphp
                                @foreach ( $spk->tender->units as $key => $value )
                                  @php 
                                    $nilai = $nilai + $value->progress;
                                  @endphp
                                @endforeach
                                {{ number_format($nilai,2) }} %
                              </td>                          
                              <td>
                                
                              </td>

                              @foreach ( $spk->termyn as $key3 => $value3)
                              @if ( $key3 > 0 )
                              <td><span>{{ number_format($value3->progress,2) }} %</span></td>
                              @endif

                              @endforeach
                            </tr>
                            @php $bobot = 0;  @endphp
                            
                            @foreach ( $spk->list_pekerjaan as $key11 => $value11 )
                            <tr>
                              <td>{{ $value11['pekerjaan_coa'] }}</td>
                              <td>{{ $value11['pekerjaan_name'] }}</td>
                              <td>{{ number_format($value11['bobot_coa'],2) }}</td>
                              <td>{{ number_format($rata2 = $spk->progresses->where("itempekerjaan_id",$value11['itempekerjaan_id'])->avg('progresslapangan_percent') * 100 ,2) }}</td>
                              @if ( $rata2 != "0" )
                                <td>{{ number_format( ($rata2 / 100 ) * $value11['bobot_coa'], 2) }} % </td>
                              @else
                                <td></td>
                              @endif
                              @foreach ( $value11['termyn'] as $key12 => $value12 )
                                @if ( $value12 == "0")
                                  <td> {{ number_format( ( $value12 * $value11['bobot_coa'] ) / 100, 2 ) }} </td>
                                @else
                                  <td><strong> {{ number_format( ( $value12 * $value11['bobot_coa'] ) / 100, 2 ) }} </strong></td>
                                  @if ( isset($termyn[$key12]))
                                  @php                                                                      
                                    $termyn[$key12] = $termyn[$key12] + (( $value12 * $value11['bobot_coa'] ) / 100);
                                  @endphp
                                  @endif
                                @endif
                                <input type="hidden" id="termyn_{{$key12}}" value="{{ $termyn[$key12] }}" name="">
                              @endforeach
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                        @endif
                      </div>
                      <div class="tab-pane" id="tab_5">
                        <a href="{{ url('/')}}/spk/sik-create?id={{ $spk->id }}" class="btn btn-primary">Tambah Surat Instruksi </a>
                        <table class="table table-bordered">
                          <thead class="head_table">
                            <tr>
                              <td>No. SIK</td>
                              <td>Tanggal</td>
                              <td>VO</td>
                              <td>Persentase Terhadap SPK</td>
                              <td>Detail</td>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ( $spk->suratinstruksis as $key7 => $value7 )
                            <tr>
                              <td>{{ $value7->no }}</td>
                              <td>{{ $value7->created_at->format("d/m/Y")}}</td>
                              <td>
                                @if ( count($value7->vos) > 0 )
                                  @foreach ( $value7->vos as $key8 => $value8)
                                    {{ number_format($value8->nilai,2) }}
                                  @endforeach
                                @endif
                              </td>
                              <td>@if ( count($value7->vos) > 0 )
                                  @foreach ( $value7->vos as $key8 => $value8)
                                    {{ number_format(($value8->nilai / $spk->nilai ) * 100 ,2) }}
                                  @endforeach
                                @endif</td>
                              <td><a href="{{ url('/')}}/spk/sik-show?id={{ $value7->id}}" class="btn btn-warning">Detail</a></td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      <div class="tab-pane" id="tab_6">
                        <span>Total Nilai BAP = <strong>Rp. {{ number_format($nilai_bap)}}</strong></span><br/>
                        @if ( count($spk->retensis) <= "0" )
                        <h3><i>Harap isi retensi di tab RETENSI terlebih dahulu</i></h3>
                        @else
                        <a href="{{ url('/')}}/spk/add-bap?id={{$spk->id}}" class="btn btn-primary">Tambah BAP</a>
                        @endif

                        @if ( $spk->baps != "")
                        <button class="btn btn-info" onclick="cetakallbap();">Cetak Daftar BAP</button>
                        @endif
                        <table class="table-bordered table">
                          <thead class="head_table">
                            <tr>
                              <td>No. BAP</td>
                              <td>Nilai</td>
                              <td>Dibuat Oleh</td>
                              <td>Tanggal</td>
                              <td>Voucher</td>
                            </tr>
                          </thead>
                          <tbody>
                            @php $before = 0; @endphp
                            @foreach($spk->baps as $key => $value )                      

                            <tr>
                              <td>{{ $value->no }}</td>
                              <td>{{ number_format($value->nilai_bap_2 - $before,2) }}</td>
                              <td>{{ \App\User::find($value->created_by)->user_name }}</td>
                              <td>{{ $value->created_at }}</td>
                              <td>
                                <a href="{{ url('/')}}/spk/detail-bap?id={{ $value->id }}" class="btn btn-primary">Detail</a>
                                <button class="btn btn-warning" onClick="printbap('{{ $value->id }}');">Cetak BAP</button>                           
                              </td>
                            </tr>
                            @php 
                            $before = $value->nilai_bap_2 ; 
                            @endphp
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>                 

                  @endif
                </div>
            
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
@include("master/copyright")

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!--Report -->
@if ( $spk->approval != "" )
@if ( $spk->approval->approval_action_id == 6 )
@include("spk::cetakan")
@include("spk::cetakan_bap")
@include("spk::cetakan_termyn")
@endif
@endif

@include("master/footer_table")
@include("spk::app")
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script type="text/javascript">

</script>
</body>
</html>
