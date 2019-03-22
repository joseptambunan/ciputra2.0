<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard </title>
  @include("master/header")
    <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('/')}}/assets/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Proyek <strong>{{ $project->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <form action="{{ url('/') }}/tender/update" method="post" name="form1"> 
            <input type="hidden" name="aanwijzing_date_val" id="aanwijzing_date_val" value="{{ $data['aanwijzing_date']}}"> 
            <input type="hidden" name="penawaran1_date_val" id="penawaran1_date_val" value="{{ $data['penawaran1_date']}}"> 
            <input type="hidden" name="klarifikasi1_date_val" id="klarifikasi1_date_val" value="{{ $data['klarifikasi1_date']}}"> 
            <input type="hidden" name="penawaran2_date_val" id="penawaran2_date_val" value="{{ $data['penawaran2_date']}}"> 
            <input type="hidden" name="klarifikasi2_date_val" id="klarifikasi2_date_val" value="{{ $data['klarifikasi2_date']}}"> 
            <input type="hidden" name="pengumuman_date_val" id="pengumuman_date_val" value="{{ $data['penawaran3_date']}}"> 
            <div class="col-md-6">              
              <input type="hidden" name="tender_id" value="{{ $tender->id }}"> 
              <h3 class="box-title">Edit Data Tender</h3>           
                {{ csrf_field() }}
                <div class="form-group">
                  <label>No. RAB</label>
                  <input type="text" class="form-control" name="rab_id" value="{{ $tender->rab->no}}" readonly>
                  @if ( $tender->rab->approval != "" )
                  Approved at : <strong>{{ date("d/M/Y", strtotime($tender->rab->approval->updated_at)) }}</strong>
                  @endif
                </div>
                <div class="form-group">
                  <label>No. Tender</label>
                  <input type="text" class="form-control" name="tender_name" value="{{ $tender->no }}" readonly>
                </div> 
                <div class="form-group">
                  <label>Pekerjaan</label>
                  <input type="text" class="form-control" name="tender_name" value="{{ $itempekerjaan->code }} - {{ $itempekerjaan->name }}" readonly>
                </div>  
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" name="tender_name" value="{{ $tender->name }}" autocomplete="off" required>
                </div>  
                <div class="form-group">
                  <label>Durasi Pekerjaan(hari kalender)</label>
                  <input type="text" class="form-control" name="tender_durasi" value="{{ $tender->durasi }}" autocomplete="off" required>
                </div> 
                <div class="form-group">
                  <label>Harga Dokumen</label>
                  <input type="text" class="form-control nilai_budget" name="harga_dokumen" value="{{ $tender->harga_dokumen }}" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label>Jenis Tender</label>
                  <select class='form-control' name='jenis_kontrak' id='jenis_kontrak' class="form-control">
                    <option value='FIXED PRICE & LUMPSUM'>FIXED PRICE & LUMPSUM</option>
                    <option value='FIXED PRICE'>FIXED PRICE</option>
                    <option value='LUMPSUM'>LUMPSUM</option>
                    <option value='REMEASURE'>REMEASURE</option>
                  </select>
                  <p>&nbsp;</p>
                  @foreach ( $tendermaster as $key => $value )
                    @if ( $tender->kelas_id == $value->id )
                      <label><input type="radio" name="tender_type" class="flat-red" value="{{ $value->id}}" checked>{{ $value->name }}</label>
                    @else
                      <label><input type="radio" name="tender_type" class="flat-red" value="{{ $value->id}}">{{ $value->name }}</label>
                    @endif
                  @endforeach
                </div>
              
                <div class="form-group">
                  <a class="btn btn-success" href="{{ url('/')}}/rab/?workorder_id={{ $tender->rab->workorder_id}}">RAB</a>
                  <a class="btn btn-warning" href="{{ url('/')}}/tender">Kembali</a>
                  
                  @if ( $tender->approval != "" )
                    @if ( $tender->approval->approval_action_id == 7)
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    @else
                      @php
                        $array = array (
                          "6" => array("label" => "Disetujui", "class" => "label label-success"),
                          "7" => array("label" => "Ditolak", "class" => "label label-danger"),
                          "1" => array("label" => "Dalam Proses", "class" => "label label-warning")
                        )
                      @endphp
                      <span class="{{ $array[$tender->approval->approval_action_id]['class'] }}">{{ $array[$tender->approval->approval_action_id]['label'] }}</span>
                    @endif
                  @else
                    @if ( count($tender->penawarans) <= 0  )
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    @endif
                  @endif
                  
                  @if ( $tender->approval != "" )
                  <a href="{{ url('/')}}/tender/approval_history?id={{ $tender->id }}" class="btn btn-primary">Approval History</a>
                  @endif

                  @if ( $tender->menangs->count() > 0 )
                    <button class="btn btn-success" type="button" onClick="print('dvContents')">Cetak Dokumen Rekomendasi Tender</button>
                  @endif

                  @if ( $tender->aanwijing == "" )
                    <a class="btn btn-success" href="{{ url('/')}}/tender/aanwijing?id={{$tender->id}}">AanWijing</a>
                  @else
                    <a class="btn btn-success" href="{{ url('/')}}/tender/aanwijing/detail?id={{$tender->aanwijing->id}}">AanWijing</a>
                  @endif

                  @if ( $tender->aanwijing == "" )
                  <h4 style="color:red"><strong>Dokumen Aanwijing belum dibuat</strong></h4>
                  @endif
                </div>
              <!-- /.form-group -->              
            </div>
            <div class="col-md-6">      
              <h3>&nbsp;</h3> 
              <div class="form-group">
                <label>Tanggal Pengambilan Dokumen </label>
                <input type="text" id="ambil_doc_date" class="form-control" name="ambil_doc_date" value="@if ( $tender->ambil_doc_date != null ) {{ $tender->ambil_doc_date->format('d/M/Y') }} @endif" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Tanggal Aanwijing </label>
                <input type="text" id="aanwijzing_date" class="form-control" name="aanwijzing_date" value="@if ( $tender->aanwijzing_date != null ) {{ $tender->aanwijzing_date->format('d/M/Y') }} @endif" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Tanggal Penawaran Pertama </label>
                <input type="text" id="penawaran1_date" class="form-control" name="penawaran1_date" value="@if ( $tender->penawaran1_date != null ) {{ $tender->penawaran1_date->format('d/M/Y') }} @endif" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Tanggal Klarifikasi Pertama </label>
                <input type="text" id="klarifikasi1_date" class="form-control" name="klarifikasi1_date" value="@if ( $tender->klarifikasi1_date  != null ) {{ $tender->klarifikasi1_date->format('d/M/Y') }} @endif" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Tanggal Penawaran Kedua </label>
                <input type="text" id="penawaran2_date" class="form-control" name="penawaran2_date" value="@if ( $tender->penawaran2_date != null ) {{ $tender->penawaran2_date->format('d/M/Y') }} @endif" autocomplete="off" >
              </div>
              <div class="form-group">
                <label>Tanggal Klarifikasi Kedua </label>
                <input type="text" id="klarifikasi2_date" class="form-control" name="klarifikasi2_date" value="@if ( $tender->klarifikasi2_date != null ) {{ $tender->klarifikasi2_date->format('d/M/Y') }} @endif" autocomplete="off" >
              </div>
              <div class="form-group">
                <label>Tanggal Pengumuman Pemenang</label>
                <input type="text" id="pengumuman_date" class="form-control" name="pengumuman_date" value="@if ( $tender->pengumuman_date != null ) {{ $tender->pengumuman_date->format('d/M/Y') }} @endif" autocomplete="off">
              </div>

            </div>
            </form>
            <div class="col-md-12">                
              <div class="nav-tabs-custom">    
                <ul class="nav nav-tabs">                
                  <li  class="active"><a href="#tab_2" data-toggle="tab">1. Rekanan</a></li>
                  <li><a href="#tab_3" data-toggle="tab">2. Korespondensi</a></li>
                  <li><a href="#tab_4" data-toggle="tab">3. Penawaran</a></li>
                  <li><a href="#tab_5" data-toggle="tab">4. Unit</a></li>
                </ul>
                <div class="tab-content">                
                  <!-- /.tab-pane -->
                  <div class="tab-pane " id="tab_5">
                    <table class="table-bordered table">
                      <thead class="head_table">
                        <tr>
                          <td>Unit Name</td>
                          <td>Type</td>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ( $tender->units as $key => $value )
                        <tr>
                          <td>{{ $value->rab_unit->asset->name }}</td>
                          @if ( $value->rab_unit->asset_type == "\Modules\Project\Entities\Unit") 
                          <td>{{ $value->rab_unit->asset->type->name }}</td>
                          @else
                          <td>{{ $value->rab_unit->asset_type }}</td>
                          @endif
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane active" id="tab_2">                   
                    @if ( $tender->tender_document != "" )
                    <input type="hidden" name="disable_param" id="disable_param" value="{{ $tender->tender_document->count() }}">
                    @else
                    <input type="hidden" name="disable_param" id="disable_param" value="0">
                    @endif
                    @if ( count($tender->spks)<= 0  )
                      @if ( $tender->ambil_doc_date == "" || $tender->aanwijzing_date == "" || $tender->penawaran1_date == "")
                        <h3><i>Data Tanggal Penawaran belum diisi</i></h3>
                        @else
                        <a class="btn btn-info" href="{{ url('/')}}/tender/rekanan/referensi?id={{ $tender->id}}">
                          Tambah Rekanan
                        </a><br><br>                      
                      @endif
                    @endif

                    @php $start = 0; @endphp
                    @if ( $tender->tender_document->count() > 0 )
                    <form action="{{ url('/')}}/tender/update-document/" method="post" name="form1">  
                    <input type="hidden" name="tender_docs" value="{{ $tender->id }}">                   
                    {{ csrf_field() }}
                      @foreach($tender->tender_document as $key => $value )
                      @if ( $value->document_name != "Syarat=Syarat Khusus yang harus dilengkapi")
                        @if ( $value->rejected == "0" )
                          <input type="checkbox" class="paramdisable" name="check[{{$key}}]" value="{{ $value->document_name }}" checked disabled>{{ $value->document_name }}<br>
                          <input type="hidden" name="dokumen[{{$key}}]" value="{{ $value->id }}" disabled>
                          @php $start = $start + 1; @endphp
                        @else
                          <input type="checkbox" class="paramdisable" name="check[{{$key}}]" value="{{ $value->document_name }}">{{ $value->document_name }}<br>
                          <input type="hidden" name="dokumen[{{$key}}]" value="{{ $value->id }}">
                        @endif
                      @endif
                      @endforeach

                      @if ( $start <= 0 )
                      <button type="submit" class="btn btn-primary">Simpan</button>
                      @endif
                    </form>
                    @else
                    <form action="{{ url('/')}}/tender/approval-rekanan" method="post" name="form1">
                      {{ csrf_field() }}
                      <h4>Kelengkapan Dokumen</h4>
                      @if ( $tender->rab->workorder_budget_detail != "" )
                        @foreach ( $tender->rab->workorder_budget_detail->dokumen as $key => $value )                      
                          <input type="checkbox" name="dokumen[2]" style="display: none;" checked>
                          <input type="checkbox" class="paramdisable" checked disabled>{{ $value->document_name }}<br>
                        @endforeach
                      @else
                      <input type="checkbox" class="paramdisable" name="dokumen[0]" id="gambar" onclick="disablebtn('1')" value="Gambar Tender">Gambar Tender<br>
                      <input type="checkbox" class="paramdisable" name="dokumen[1]" id="bq" onclick="disablebtn('1')" value="BQ / Bill Item">BQ / Bill Item<br>
                      <input type="checkbox" class="paramdisable" name="dokumen[2]" id="spek" onclick="disablebtn('1')" value="Spesifikasi Teknis">Spesifikasi Teknis<br>
                      <input type="checkbox" class="paramdisable" name="dokumen[3]" id="syarat" onclick="disablebtn('1')" value="Syarat=Syarat Khusus yang harus dilengkapi" style="display: none;" checked><br><br>
                      @endif
                    @endif

                    <input type="hidden" name="tender_id" id="tender_id" value="{{ $tender->id }}">
                    <table class="table" style="width: 50%;">
                     <thead class="head_table">
                       <tr>
                        <td>Rekanan</td>
                        <td>Status</td>
                        <td>Delete</td>
                       </tr>
                     </thead>
                     <tbody>
                        @foreach ( $tender->rekanans as $key => $value )
                        <tr>
                          <td>{{ $value->rekanan->group->name }}</td>
                          <td>
                            @if ( $value->approval == null )
                            <input type="checkbox" class="paramdisable" name="rekanan_['{{$key}}']" value="{{ $value->id }}" >Request Approve
                            @else
                             @php
                              $array = array (
                                "6" => array("label" => "Disetujui", "class" => "label label-success"),
                                "7" => array("label" => "Ditolak", "class" => "label label-danger"),
                                "1" => array("label" => "Dalam Proses", "class" => "label label-warning")
                              )
                            @endphp
                            <span class="{{ $array[$value->approval->approval_action_id]['class'] }}">{{ $array[$value->approval->approval_action_id]['label'] }}</span>
                            @endif
                          </td>
                          <td>
                            @if ( $value->approval != null )
                              @if ( $value->approval->approval_action_id == "" )
                                @if ( count($tender->penawarans) <= 0 )
                                <button type="button" class="btn btn-danger" onclick="removerekanan('{{ $value->id }}','{{ $value->rekanan->group->name }}')">Delete</button>
                                @endif
                              @endif
                            @endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                      </table>
                      @if ( count($tender->spks)<= 0  )
                        @if ( count($tender->rekanans) > 0 )
                          <button type="submit" class="btn btn-primary"  >Submit</button><br>
                          <i>Harap pastikan kelengkapan dokumen dan checklist status approval sebelulmnya</i>
                        @endif
                      @endif
                    </form>
                  </div>
                  <div class="tab-pane" id="tab_3">
                    <table class="table table-bordered">
                      <thead class="head_table">
                        <tr>
                          <td>No.</td>
                          <td>Rekanan</td>
                          <td>Cetak Undangan</td>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ( $tender->rekanans as $key => $value )
                          @foreach ( $value->korespondensis as $key2 => $value2 )
                            <tr>
                              <td>{{ $value2->no }}</td>
                              <td>{{ $value->rekanan->group->name }}</td>
                              <td>
                                @if ( $value2->no != "" )
                                <button onClick="print('{{ $value2->id }}')" class="btn btn-primary">Cetak</button>
                                @endif
                              </td>
                            </tr>                        
                          @endforeach
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane" id="tab_4">

                    @if ( count($tender->tender_approve) > 0 )
                      @if ( (count($tender->tender_approve)) == count($tender->penawarans))
                      <a type="button" class="btn btn-info" href="{{ url('/')}}/tender/penawaran-addstep2?id={{ $tender->id}}">
                        Input Data Volume Terbaru
                      </a><br><br> 
                      @elseif ( (count($tender->tender_approve) * 2 ) == count($tender->penawarans))
                      <a type="button" class="btn btn-info" href="{{ url('/')}}/tender/penawaran-addstep3?id={{ $tender->id}}">
                        Input Data Volume Terbaru
                      </a><br><br> 

                      @endif
                    @endif
                    <table class="table table-bordered ">
                      <thead class="head_table">                          
                        <tr>
                          <td>Item Pekerjaan</td>
                          <td></td>
                          <td>Penawaran 1</td>
                          <td>Penawaran 2</td>
                          <td>Penawaran 3</td>
                        </tr>
                      </thead>
                      <tbody>
                        @if ( $tender->aanwijing != "" )
                          <tr>
                            <td>Item Pekerjaan</td>
                            <td></td>
                            <td>
                              @if ( count($tender->penawarans) > 1 || count($tender->spks) > 0 )
                              <a href="{{ url('/')}}/tender/detail-penawaran?id={{$tender->id}}&step=1" class="btn btn-warning">Detail</a>
                              @elseif ( count($tender->penawarans) == 1 )
                                @if ( count($tender->berita_acara) > 0 )
                                  @foreach ( $tender->berita_acara as $key => $value )    
                                    @if ( $value->step == 1)                              
                                      <a href="{{ url('/')}}/tender/berita_acara/show?id={{$value->id}}" class="btn btn-info">Berita Acara Pertama</a>
                                    @endif
                                  @endforeach
                                @else
                                <a href="{{ url('/')}}/tender/berita_acara?id={{$tender->id}}&step=1" class="btn btn-info">Berita Acara Pertama</a>
                                @endif
                              @endif
                            </td>
                            <td>                            
                              @if ( count($tender->penawarans) > 2 || count($tender->spks) > 0)
                              <a href="{{ url('/')}}/tender/detail-penawaran?id={{$tender->id}}&step=2" class="btn btn-warning">Detail</a>
                              @elseif( count($tender->penawarans) == 2 || count($tender->spks) > 0 )
                              <a href="{{ url('/')}}/tender/berita_acara?id={{$tender->id}}&step=1" class="btn btn-info">Berita Acara Kedua</a>
                              @endif
                            </td>
                            <td>                            
                              @if ( count($tender->spks) > 3 || count($tender->spks) > 0 )
                              <a href="{{ url('/')}}/tender/detail-penawaran?id={{$tender->id}}&step=3" class="btn btn-warning">Detail</a>
                              @endif
                            </td>
                          </tr>
                          @foreach( $tender->rekanans as $key2 => $value2)
                          @if ( $value2->approval != null)
                          @if ( $value2->approval->approval_action_id != "" )
                          @if ( $value2->approval->approval_action_id == "6")
                            <tr>
                              <td>{{ $value2->rekanan->group->name }}</td>
                              <td>&nbsp;</td>
                              @foreach ( $value2->penawarans as $key3 => $value3)
                              <td>
                                <span style="font-size: 14px;">
                                  @if ( $value3->details->sum("nilai") > 0 )
                                    Penawaran telah masuk
                                  @else
                                    Rekanan belum mengisi penawaran
                                  @endif
                                </span>                              
                              </td>
                              @endforeach
                              <td></td>
                            </tr>
                          @endif
                          @endif
                          @endif
                          @endforeach
                        @else
                        <tr>
                          <td colspan="5">Dokumen Aanwijing belum dibuat</td>
                        </tr>
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
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
  @include("master/copyright")

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->
@include("tender::cetakan")
@include("master/footer_table")
@include("tender::app")

<script type="text/javascript">
  function setpemenang(id,name){
    if ( confirm("Apakah anda yakin ingin menjadikan " + name + " sebagai pemenang tender ?")){
      var request = $.ajax({
        url : "{{ url('/')}}/tender/ispemenang",
        dataType : 'json',
        data : {
          id : id
        },
        type : "post"
      });

      request.done(function(data){
        if ( data.status == "0"){
            alert("Rekanan telah diajukan sebagai pemenang");
        } 
        window.location.reload();
      })
    }else{
      return false;
    }
  }

  function cetakanpengajuan(id){

  }

  function disablebtn(id){
    var valor = [];
    $('input.paramdisable[type=checkbox]').each(function () {
        if (this.checked)
          valor.push($(this).val());
    });

    console.log(valor.length);

    if (valor.length < parseInt( $("#disable_param").val()) + 4 ) {
      $("#btn_approval_rekanan").attr("disabled","disabled");
    }else{
      $("#btn_approval_rekanan").removeAttr("disabled");
    }
  }

  function print(data){
     var myPrintContent = document.getElementById('head_Content');
        var myPrintWindow = window.open("", "");
        myPrintWindow.document.write(myPrintContent.innerHTML);
        myPrintWindow.document.getElementById('dvContents').style.display='block'
        myPrintWindow.document.close();
        myPrintWindow.focus();
        myPrintWindow.print();
        myPrintWindow.close();    
        return false;
  }
</script>
@if ( $tender->spks->count() > 0 )
  @if (  $tender->spks->count() > 0 )
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
    <div id="dvContents_spk" class="result" style="display: none;">
    </div>
  </div>
  @endif
@endif
</body>
</html>
