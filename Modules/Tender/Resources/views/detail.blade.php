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
                </div>
              
                <div class="form-group">
                  <a class="btn btn-warning" href="{{ url('/')}}/tender">Kembali</a>
                  @if ( count($tender->spks)<= 0  )
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  @endif
                  @if ( $tender->approval != "" )
                  <a href="{{ url('/')}}/tender/approval_history?id={{ $tender->id }}" class="btn btn-info">Approval History</a>
                  @endif

                  @if ( $tender->rekanans != "" )
                    <button class="btn btn-success" type="button" onClick="print('dvContents')">Cetak Form Pengajuan Tender</button>
                  @endif
                </div>
              <!-- /.form-group -->              
            </div>
            <div class="col-md-6">      
              <h3>&nbsp;</h3> 
              <div class="form-group">
                <label>Tanggal Pengambilan Dokumen </label>
                <input type="text" id="ambil_doc_date" class="form-control" name="ambil_doc_date" value="@if ( $tender->ambil_doc_date != null ) {{ $tender->ambil_doc_date->format('d/m/Y') }} @endif" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Tanggal Aanwijing </label>
                <input type="text" id="aanwijzing_date" class="form-control" name="aanwijzing_date" value="@if ( $tender->aanwijzing_date != null ) {{ $tender->aanwijzing_date->format('d/m/Y') }} @endif" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Tanggal Penawaran Pertama </label>
                <input type="text" id="penawaran1_date" class="form-control" name="penawaran1_date" value="@if ( $tender->penawaran1_date != null ) {{ $tender->penawaran1_date->format('d/m/Y') }} @endif" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Tanggal Klarifikasi Pertama </label>
                <input type="text" id="klarifikasi1_date" class="form-control" name="klarifikasi1_date" value="@if ( $tender->klarifikasi1_date  != null ) {{ $tender->klarifikasi1_date->format('d/m/Y') }} @endif" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Tanggal Penawaran Kedua </label>
                <input type="text" id="penawaran2_date" class="form-control" name="penawaran2_date" value="@if ( $tender->penawaran2_date != null ) {{ $tender->penawaran2_date->format('d/m/Y') }} @endif" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Tanggal Klarifikasi Kedua </label>
                <input type="text" id="klarifikasi2_date" class="form-control" name="klarifikasi2_date" value="@if ( $tender->klarifikasi2_date != null ) {{ $tender->klarifikasi2_date->format('d/m/Y') }} @endif" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label>Tanggal Pengumuman Pemenang</label>
                <input type="text" id="pengumuman_date" class="form-control" name="pengumuman_date" value="@if ( $tender->pengumuman_date != null ) {{ $tender->pengumuman_date->format('d/m/Y') }} @endif" autocomplete="off">
              </div>

            </div>
            </form>
            <div class="col-md-12">                
              <div class="nav-tabs-custom">    
                <ul class="nav nav-tabs">                
                  <li  class="active"><a href="#tab_2" data-toggle="tab">Rekanan</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Korespondensi</a></li>
                  <li><a href="#tab_4" data-toggle="tab">Penawaran</a></li>
                  <li><a href="#tab_5" data-toggle="tab">Unit</a></li>
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

                    <input type="hidden" name="disable_param" id="disable_param" value="{{ $tender->rekanans->count() }}">
                    @if ( count($tender->spks)<= 0  )
                      @if ( $tender->ambil_doc_date == "" || $tender->aanwijzing_date == "" || $tender->penawaran1_date == "")
                        <h3><i>Data Tanggal Penawaran belum diisi</i></h3>
                        @else
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
                          Tambah Rekanan
                        </button><br><br>                      
                      @endif
                    @endif

                      @if ( $tender->tender_document->count() > 0 )
                      <form action="{{ url('/')}}/tender/update-document/" method="post" name="form1">  
                      <input type="hidden" name="tender_docs" value="{{ $tender->id }}">                   
                      {{ csrf_field() }}
                        @foreach($tender->tender_document as $key => $value )
                          @if ( $value->rejected == "0" )
                            <input type="checkbox" class="paramdisable" name="check[{{$key}}]" value="{{ $value->document_name }}" checked disabled>{{ $value->document_name }}<br>
                            <input type="hidden" name="dokumen[{{$key}}]" value="{{ $value->id }}" disabled>
                          @else
                            <input type="checkbox" class="paramdisable" name="check[{{$key}}]" value="{{ $value->document_name }}">{{ $value->document_name }}<br>
                            <input type="hidden" name="dokumen[{{$key}}]" value="{{ $value->id }}">
                          @endif
                        @endforeach
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </form>
                      @else
                      <form action="{{ url('/')}}/tender/approval-rekanan" method="post" name="form1">
                        {{ csrf_field() }}
                        <h4>Kelengkapan Dokumen</h4>
                        <input type="checkbox" class="paramdisable" name="dokumen[0]" id="gambar" onclick="disablebtn('1')" value="Gambar Tender">Gambar Tender<br>
                        <input type="checkbox" class="paramdisable" name="dokumen[1]" id="bq" onclick="disablebtn('1')" value="BQ / Bill Item">BQ / Bill Item<br>
                        <input type="checkbox" class="paramdisable" name="dokumen[2]" id="spek" onclick="disablebtn('1')" value="Spesifikasi Teknis">Spesifikasi Teknis<br>
                        <input type="checkbox" class="paramdisable" name="dokumen[3]" id="syarat" onclick="disablebtn('1')" value="Syarat=Syarat Khusus yang harus dilengkapi">Syarat-syarat Khusus yang harus dilengkapi<br><br>
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
                              <input type="checkbox" class="paramdisable" name="rekanan_['{{$key}}']" value="{{ $value->id }}" onclick="disablebtn('1')">Request Approve
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
                          @if ( $tender->rekanans != "" )
                            <button type="submit" class="btn btn-primary" id="btn_approval_rekanan" disabled>Submit</button><br>
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
                        <tr>
                          <td>Item Pekerjaan</td>
                          <td></td>
                          <td>
                            <a href="{{ url('/')}}/tender/detail-penawaran?id={{$tender->id}}&step=1" class="btn btn-warning">Detail</a>
                          </td>
                          <td>
                            <a href="{{ url('/')}}/tender/detail-penawaran?id={{$tender->id}}&step=2" class="btn btn-warning">Detail</a>
                          </td>
                          <td>
                            <a href="{{ url('/')}}/tender/detail-penawaran?id={{$tender->id}}&step=3" class="btn btn-warning">Detail</a>
                          </td>
                        </tr>
                        @foreach( $tender->rekanans as $key2 => $value2)
                        @if ( $value2->approval != null)
                        @if ( $value2->approval->approval_action_id != "" )
                        @if ( $value2->approval->approval_action_id == "6")
                          <tr>
                            <td>{{ $value2->rekanan->group->name }} {{ $value2->id }}</td>
                             <td>
                              @if ( count($tender->menangs) <= 0 )
                                @if ( count($value2->penawarans) <= 0 )
                                  <a href="{{ url('/')}}/tender/penawaran-add?id={{$value2->id}}" class="btn btn-primary">Tambah Penawaran</a>
                                @elseif ( count($value2->penawarans) == 2 && $value2->penawarans[1]->nilai == "0" )
                                  <a href="{{ url('/')}}/tender/penawaran-step2?id={{$value2->penawarans[1]->id}}" class="btn btn-primary">Tambah Penawaran</a>
                                @elseif ( count($value2->penawarans) == 3 && $value2->penawarans[2]->nilai == "0" )
                                  <a href="{{ url('/')}}/tender/penawaran-step3?id={{$value2->penawarans[2]->id}}" class="btn btn-primary">Tambah Penawaran</a>                                  

                                @elseif ( count($value2->penawarans) == 3 && $value2->penawarans[2]->nilai > 0 )
                                <a class="btn btn-primary" onclick="setpemenang('{{ $value2->id }}','{{ $value2->rekanan->group->name }}')">Jadikan Pemenang</a>
                                @endif
                            
                              @else
                                @if ( $value2->is_pemenang == "1")
                                  Diajukan Sebagai Pemenang
                                @endif
                              @endif
                             </td>
                            @foreach ( $value2->penawarans as $key3 => $value3)
                            <td>
                              <span style="font-size: 14px;">{{ number_format($value3->nilai) }}</span>
                              @if ( $value3->nilai > 0 )
                              <a class="btn btn-info" href="{{ url('/')}}/tender/penawaran-edit?id={{$value3->id}}">Edit</a>
                              @endif
                            </td>
                            @endforeach
                            <td></td>
                          </tr>
                        @endif
                        @endif
                        @endif
                        @endforeach
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
  <div class="modal fade" id="modal-default">
    <form action="{{ url('/')}}/tender/save-rekanans" method="post">
    <input type="hidden" value="{{ $tender->id }}" name="tender_id" value="{{ $tender->id }}">
    {{ csrf_field() }}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Default Modal</h4>
        </div>

        <div class="modal-body">

          <table class="table" id="example2">
            <thead class="head_table">
              <tr>
                <td>Rekanan</td>
                <td><input type="checkbox" value="" id="unit_rab_all" onclick="checkall();"> Set to Tender</td>
              </tr>
            </thead>
            <tbody>
               @foreach($rekanan as $key => $value )
                <tr>
                  <td>{{ $value->group->name }}</td>
                  <td><input type="checkbox" name="rekanan[{{$key}}]" value="{{ $value->id}}"></td>
                </tr>
               @endforeach
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    </form>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</div>
<!-- ./wrapper -->

<!-- Cetakan Report -->
<style>
  @media print {
    .result {
      @page{
        page-break-after: always;
        /*size: auto;*/
        size: 297mm 210mm;
        margin:0;
      }
     }

  } 
</style>
<div id="head_Content">
 
  <div id="dvContents" style="display: none;">
    <table width="100%" style="border-collapse:collapse" class='table' id='undangan_tender'>
      <tr>
        <td>@include("print.logo",['pt' => $tender->rab->budget_tahunan->budget->pt ] )</td>
      </tr>
      <tr>
        <td>
          <table>
            <tr>
              <td>Nomor Surat</td>
              <td>:</td>
              <td>{{ $tender->no }}</td>
            </tr>
            <tr>
              <td>Nomor Tender</td>
              <td>:</td>
              <td>{{ $tender->no }}</td>
            </tr>
            <tr>
              <td>Nomor Surat</td>
              <td>:</td>
              <td>{{ $tender->no }}</td>
            </tr>
            <tr>
              <td>Nomor Surat</td>
              <td>:</td>
              <td>{{ $tender->no }}</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>
</div>


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
</body>
</html>
