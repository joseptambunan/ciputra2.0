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
              <form action="{{ url('/')}}/spk/update-date" method="post" name="form1">
              <input type="hidden" name="spk_id" value="{{ $spk->id }}">
              {{ csrf_field() }}
              <div class="form-group">
                <label>No SPK</label>
                <input type="text" value="{{ $spk->no }}" class="form-control" readonly>
              </div>
              <div class="form-group">
                <label>Nama SPK</label>
                <input type="text" value="{{ $spk->name }}" class="form-control" readonly>
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
              <div class="box-footer">
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
                <h2>Nilai : Rp. {{ number_format($spk->nilai)}}</h2>
                @if ( count($spk->termyn) <=0 )
                <h3 style="color:red"><strong>SPK ini belum memiliki bobot. Silahkan isi di kolom Progress Lapangan</strong></h3>
                @endif
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
             <div class="col-md-6">
              <h3>&nbsp;</h3>
              <div class="form-group">
                <label>Start Date</label>
                <input type="text" class="form-control" name="start_date" id="start_date" value="@if ( $spk->start_date != '' ) {{ $spk->start_date->format('d/m/Y') }} @endif" >
              </div> 
              <div class="form-group">
                <label>End Date</label>
                <input type="text" class="form-control" name="end_date" id="end_date" value="{{ $spk->finish_date->format('d/m/Y') }}" required>
              </div> 
              <div class="form-group">
                <label>Serah Terima 1</label>
                <input type="text" class="form-control" name="st_1" id="st_1" value="{{ $spk->st_1 }}" required>
              </div> 
              <div class="form-group">
                <label>Serah Terima 2</label>
                <input type="text" class="form-control" name="st_2" id="st_2" value="{{ $spk->st_2 }}" required>
              </div> 
              <div class="form-group">
                <label>Serah Terima 3</label>
                <input type="text" class="form-control" name="st_3" id="st_3" value="{{ $spk->st_3 }}" required>
              </div> 
            </div>
            </form>
            <!-- /.col -->

            <div class="col-md-12">
              <div class="nav-tabs-custom"> 
                <ul class="nav nav-tabs">                      
                  <li  class="active"><a href="#tab_1" data-toggle="tab">Data Pembayaran</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Item Pekerjaan</a></li>                
                  <li><a href="#tab_3" data-toggle="tab">Unit</a></li>            
                  <li><a href="#tab_4" data-toggle="tab">Progress Lapangan</a></li>
                  <li><a href="#tab_5" data-toggle="tab">Variation Order (VO)</a></li>
                  <li><a href="#tab_6" data-toggle="tab">BAP</a></li>
                </ul>
                <div class="tab-content">   
                  <div class="tab-pane active" id="tab_1">
                    <div class="row">
                      <div class="col-md-6">   
                        <h3 class="box-title">Detail Data Pembayaran</h3>           
                          <form action="{{ url('/')}}/spk/update-payment" method="post" name="form1">
                            <input type="hidden" name="spk_id" value="{{ $spk->id }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                              <label>DP Percent(%)</label>
                              <input type="text" value="{{ $spk->dp_percent }}" name="dp_percent" class="form-control">
                            </div>
                            <div class="form-group">
                              <label>Denda A(Rp)</label>
                              <input type="text" value="{{ $spk->denda_a }}" name="denda_a" id="denda_a" class="form-control">
                            </div>    
                            <div class="form-group">
                              <label>Denda B(Rp)</label>
                              <input type="text" value="{{ $spk->denda_b }}" name="denda_b" id="denda_b" class="form-control">
                            </div>  
                            <div class="form-group">
                              <label>Mata Uang</label>
                              <input type="text" value="{{ $spk->matauang }}" name="matauang" id="matauang" class="form-control">
                            </div>                              
                            <div class="form-group">
                              <label>Nilai Tukar</label>
                              <input type="text" value="{{ $spk->nilai_tukar }}" name="nilai_tukar" id="nilai_tukar" class="form-control">
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
                              <input type="text" value="{{ $spk->memo_cara_bayar }}" name="memo_cara_bayar" class="form-control">
                            </div> 
                            <div class="form-group">
                              <label>Cara Pembayaran</label>
                              <input type="text" value="{{ $spk->carapembayaran }}" name="carapembayaran" class="form-control">
                            </div>                             
                            <div class="form-group">
                              <label>Memo Lingkup Kerja</label>
                              <input type="text" value="{{ $spk->memo_lingkup_kerja }}" name="memo_lingkup_kerja" class="form-control">
                            </div>
                            <div class="form-group">
                              <label>Nilai Garansi</label>
                              <input type="text" value="{{ $spk->garansi_nilai }}" name="garansi_nilai" class="form-control">
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
                          <td>Nilai</td>
                          <td>Satuan</td>
                          <td>Subtotal</td>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ( $spk->tender_rekanan->menangs->first()->details as $key2 => $value2 )
                        @php 
                        $itempekerjaan = \Modules\Pekerjaan\Entities\Itempekerjaan::find($value2->itempekerjaan_id);
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
                        @foreach ( $spk->tender_rekanan->menangs as $key2 => $value2 )                        
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
                    <div class="form-group">
                      <label>Jumlah Progress</label>
                      <input type="text" value="" name="progress" id="progress" class="form-control">
                    </div>
                    <div class="form-group">
                      <button type="button" class="btn btn-primary" id="buat">Buat</button>
                      Total Persentase Termin : <strong><span id="summary_progress"></span></strong>
                    </div>
                    <form action="{{ url('/')}}/spk/create-termyn" method="post">
                      {{ csrf_field() }}
                      <input type="hidden" name="spk_termin_id" value="{{ $spk->id }}">
                      <div id="createtermyn"></div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="submit_termyn" style="display: none;">Simpan</button>
                      </div>
                    </form>
                    @else
                    <table class="table table-bordered">
                      <thead class="head_table">
                        <tr>
                          <td>COA</td>
                          <td>Item Pekerjaan</td>
                          <td>Tambah Progress</td>
                          @foreach ( $spk->termyn as $key3 => $value3)
                          <td>{{ $value3->termin }} (%)</td>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          @foreach ( $spk->termyn as $key3 => $value3)
                          <td>{{ $value3->progress }}</td>
                          @endforeach
                        </tr>
                        @foreach ( $spk->tender_rekanan->menangs->first()->details as $key2 => $value2 )
                        @php 
                        $itempekerjaan = \Modules\Pekerjaan\Entities\Itempekerjaan::find($value2->itempekerjaan_id);
                        @endphp
                        <tr>   
                          <td>{{ $itempekerjaan->code }}</td>                      
                          <td>{{ $itempekerjaan->name }}</td>
                          <td>
                            @if ( $spk->approval == "" )
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-primary" onclick="addprogress('{{ $itempekerjaan->id }}','{{ $itempekerjaan->name }}','{{ $value3->id}}','{{ count($spk->termyn) }}')">Add Bobot</button>
                            <button type="button" onclick="editbobot('{{ $itempekerjaan->id }}','{{ count($spk->termyn) }}')" class="btn btn-warning btn_edit1 btn_edit_{{$itempekerjaan->id}}">Edit</button>
                            <button type="button" onclick="savebobot('{{ $itempekerjaan->id }}','{{ count($spk->termyn) }}')" class="btn btn-success btn_edit2 btn_edit2_{{$itempekerjaan->id}}" style="display: none;">Edit</button>
                            @endif
                          </td>
                          @foreach ( $itempekerjaan->progress_termyn as $key3 => $value3)
                          <td>
                            <span class='labels labels_termin_{{$itempekerjaan->id}}' id='label_{{ $value3->id}}_{{count($itempekerjaan->progress_termyn) }}'>{{ $value3->percentage or '0.0' }}</span>
                            <input type="text" class="form-control inputs input_termin_{{$itempekerjaan->id}}" id="input_{{ $value3->id}}_{{count($itempekerjaan->progress_termyn) }}" style="display: none;" value="{{ $value3->percentage or '0.0' }}">
                            <input type="text" class="form-control" style="display: none;" value="{{ $value3->id }}" name="itemprogress">
                          </td>
                          @endforeach
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    @endif
                  </div>
                  <div class="tab-pane" id="tab_5"></div>
                  <div class="tab-pane" id="tab_6">
                    <a href="{{ url('/')}}/spk/add-bap?id={{$spk->id}}" class="btn btn-primary">Tambah BAP</a>
                    <table class="table-bordered table">
                      <thead class="head_table">
                        <tr>
                          <td>No. BAP</td>
                          <td>Nilai</td>
                          <td>Tanggal Dibuat</td>
                          <td>Dibuat Oleh</td>
                        </tr>
                      </thead>
                      
                    </table>
                  </div>
                </div>
              </div>
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
  <div class="modal  fade" id="modal-primary">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Data Progress</h4>
        </div>
        <div class="modal-body">
          <form action="{{ url('/')}}/spk/add-progress-detail" method="post" name="form1">
              <input type="hidden" name="item_id" id="item_id">
              <input type="hidden" name="spk_termin_id" id="spk_termin_id" value="{{ $spk->id}}">
              {{ csrf_field() }}
              <div class="form-group">
                <label>Item Pekerjaan</label>
                <input type="text" class="form-control" name="item_name" id="item_name" value="" readonly>
              </div>
              <table class="table table-bordered" id="table_detail_summary">
                <tr>                  
                  <td>Termin 1</td>
                  <td><input type="text" name="item[0]">%</td>                 
                </tr>
              </table>              
              <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-outline">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("spk::app")
<script type="text/javascript">
  function addprogress(itempekerjaan_id,itempekerjaan_name,termin_id,termin_count){
    $("#item_name").val(itempekerjaan_name);
    $("#item_id").val(itempekerjaan_id);
    $("#termin_id").val(termin_id);
    var html = "";
    for(var i=0; i < termin_count; i++ ){
        html  += "<label> Termin " + ( i + 1) + "</label>";
        html  += "<input type='text' class='form-control' name='termyn[" + i + "]' id='termyn_" + i + "' style='width:30%;' onkeyup='summary();'/><br>";
    }
    $("#table_detail_summary").html(html);
  }

  function editbobot(itempekerjaan_id,bobot){
    $(".labels").show();
    $(".inputs").hide();
    $(".btn_edit1").show();
    $(".btn_edit2").hide();

    $(".labels_termin_" + itempekerjaan_id).hide();
    $(".input_termin_" + itempekerjaan_id).show();
    $("#input_" + itempekerjaan_id + "_" + bobot).show();
    $(".btn_edit_" + itempekerjaan_id).hide();
    $(".btn_edit2_" + itempekerjaan_id).show();
  }

  function savebobot(id){
    var request = $.ajax({
      url : "{{ url('/')}}/spk/update-progress-detail",
      dataType : "json",
      data : {
        id : $('input[name="itemprogress[]"]').val()
      },
      type : "post"
    });

    request.done(function(data){
      if ( data.status == "0"){
        //alert("Bobot Progress Disimpan");
      }
      window.location.reload();
    })
  }
</script>
</body>
</html>
