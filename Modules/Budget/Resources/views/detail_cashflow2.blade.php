<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard </title>
  @include("master/header")
  <!-- Select2 -->  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="{{ url('/')}}/assets/bower_components/select2/dist/css/select2.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Proyek <strong>{{ $budget->project->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12"><h3 class="box-title">Detail Data Budget Tahunan Proyek</h3></div>
            <div class="col-md-6">             
              <form action="{{ url('/')}}/budget/cashflow/update-cashflow" method="post" name="form1">
                {{ csrf_field() }}
                <input type="hidden" name="budget_id" id="budget_id" value="{{ $budget->id }}">
                <input type="hidden" name="budget_tahunan_id" id="budget_tahunan_id" value="{{ $budget_tahunan->id }}">
                <div class="form-group">
                  <label>No. Budget Global</label>
                  <input type="text" class="form-control" value="{{ $budget->no }}" readonly>
                </div>
                <div class="form-group">
                  <label>No. Budget</label>
                  <input type="text" class="form-control" value="{{ $budget_tahunan->no }}" readonly>
                </div>
                <div class="form-group">
                <label>Project / Kawasan</label>
                <input type="text" class="form-control" value="{{ $budget->project->name }} / {{ $budget->kawasan->name or ''}}" readonly>
              </div> 
                <div class="box-footer">
                  @if ( $budget_tahunan->approval != "" )
                    @if (  $budget_tahunan->approval->approval_action_id == 7 )
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    @endif
                  @else                    
                      <button type="submit" class="btn btn-primary">Simpan</button>
                  @endif
                  <a href="{{ url('/')}}/budget/cashflow/?id={{ $budget_tahunan->budget->id}}" class="btn btn-warning">Kembali</a>
                  @if ( $budget_tahunan->approval != "" )
                  <a class="btn btn-info" href="{{ url('/')}}/budget/cashflow/approval?id={{$budget_tahunan->id}}">Lihat History Approval</a><br>
                  @endif
                </div>      
             
            </div>
            <div class="col-md-6">

                <div class="form-group">
                  <label>Nilai(Rp)</label>
                  <input type="text" class="form-control" value="{{ number_format($budget_tahunan->nilai) }}" readonly>
                </div> 
                <div class="form-group">
                  <label>Tahun Anggaran</label>
                  <select name="tahun_anggaran" class="form-control">
                    @for($i=$start_date; $i <= $end_date; $i++ )
                      @if ( $budget_tahunan->tahun_anggaran == $i )
                        <option value="{{ $i }}" selected>{{ $i }}</option>
                      @else
                        <option value="{{ $i }}">{{ $i }}</option>
                      @endif
                    @endfor
                  </select>
                </div>
                <div class="form-group">
                  <label>Keterangan</label>
                  <input type="text" name="description" id="description" class="form-control">
                </div>
            </div>
             </form>
            <!-- /.col -->
            <div class="col-md-12 table-responsive">
              <table class="table-bordered table">
                <thead class="head_table">
                  <tr>
                    <td>Uraian</td>
                    <td>Dev Cost</td>
                    <td>Con Cost</td>
                    <td>Subtotal</td>
                  </tr>
                  
                </thead>
                <tbody>
                  <tr>
                    <td>CarryOver</td>
                    <td style="text-align: right;">Rp. {{ number_format($nilai_sisa_dev_cost)}}</td>
                    <td style="text-align: right;">Rp. {{ number_format($nilai_sisa_con_cost)}}</td>
                    <td style="text-align: right;">Rp. {{ number_format($nilai_sisa_dev_cost + $nilai_sisa_con_cost) }}</td>
                  </tr>
                  
                  <tr>
                    <td> Budget SPK Tahun Berjalan </td>
                    <td style="text-align: right;"> Rp. {{ number_format($budget_tahunan->total_dev_cost)}}</td>
                    <td style="text-align: right;"> Rp. {{ number_format($budget_tahunan->total_con_cost)}}</td>
                    <td style="text-align: right;"> Rp. {{ number_format($budget_tahunan->total_dev_cost + $budget_tahunan->total_con_cost) }}</td>
                  </tr>
                  <tr style="background-color: grey;color:white;font-weight: bolder;">
                    <td style="text-align: right">Total Rencana ( SPK + CO ) </td>
                    <td style="text-align: right;;color:white;font-weight: bolder;"> Rp. {{ number_format($total1 = $nilai_sisa_dev_cost + $budget_tahunan->total_dev_cost)}}</td>
                    <td style="text-align: right">Rp. {{ number_format($total2 = $nilai_sisa_con_cost + $budget_tahunan->total_con_cost )}} </td>
                    <td style="text-align: right;;color:white;font-weight: bolder;"> Rp. {{ number_format($total1 + $total2 )}}</td>
                  </tr>
                  
                  <tr>
                    <td><i>Rencana Cash Out CarryOver</i></td>
                    <td style="text-align: right;">Rp. <span id="label_cf_carryover_devcost">{{ ($co_devcost = $budget_tahunan->carry_nilai_dev_cost)}}</span></td>
                    <td style="text-align: right;">Rp. <span id="label_cf_carryover_concost">{{ ($co_concost = $budget_tahunan->carry_nilai_con_cost)}}</span></td>
                    <td style="text-align: right;">Rp. <span id="label_cf_carryover_label_cf_carryover">{{ ($co_concost + $co_devcost) }}</span></td>
                  </tr>
                  <tr>
                    <td> <i>Rencana Cash Out SPK</i> </td>
                    <td style="text-align: right;"> Rp. <span id="label_cash_flow">0</span></td>
                    <td style="text-align: right;"> Rp. <span id="label_cash_flow_co">{{ ($budget_tahunan->nilai_cash_out_con_cost) }}</span></td>
                    <td style="text-align: right;"> Rp. <span id="label_cash_flow_all">0</span></td>
                  </tr>
                   <tr style="background-color: grey;color:white;font-weight: bolder;">
                    <td style="text-align: right">Total Rencana Cash Out ( SPK + CO )</td>
                    <td style="text-align: right;;color:white;font-weight: bolder;"> Rp. <span id="label_total_co_devcost"></span></td>
                    <td style="text-align: right">Rp. <span id="label_total_co_concost"></span> </td>
                    <td style="text-align: right;;color:white;font-weight: bolder;"> Rp.  <span id="label_total_co_all"></span></td>
                  </tr>
                  
                </tbody>
              </table>
              <br>              
              <table class="table table-bordered">
                <thead class="head_table">
                  <tr>
                    <td>DC</td>
                    <td>Jan</td>
                    <td>Feb</td>
                    <td>Mar</td>
                    <td>Apr</td>
                    <td>Mei</td>
                    <td>Jun</td>
                    <td>Jul</td>
                    <td>Agu</td>
                    <td>Sep</td>
                    <td>Okt</td>
                    <td>Nov</td>
                    <td>Des</td>
                  </tr>
                  <tr>
                    <td>CC</td>
                    <td>Jan</td>
                    <td>Feb</td>
                    <td>Mar</td>
                    <td>Apr</td>
                    <td>Mei</td>
                    <td>Jun</td>
                    <td>Jul</td>
                    <td>Agu</td>
                    <td>Sep</td>
                    <td>Okt</td>
                    <td>Nov</td>
                    <td>Des</td>
                  </tr>
                </thead>
              </table>

              <div class="nav-tabs-custom">
              
              <ul class="nav nav-tabs">                
                <li class="active"><a href="#tab_1" data-toggle="tab">Renc. Bdgt Pek. Thn Berjalan (DC)</a></li>
                <li><a href="#tab_2" data-toggle="tab">Cash Out Thn Berjalan (DC)</a></li>
                 @if ( $budget_tahunan->budget->kawasan != "" )
                <li><a href="#tab_5" data-toggle="tab">Renc. Bdgt Pek. Thn Berjalan (CC)</a></li>
                <li><a href="#tab_6" data-toggle="tab">Cash Out Thn Berjalan (CC)</a></li>
                @endif
                <li><a href="#tab_3" data-toggle="tab">Subtotal C. Over</a></li>
                <li><a href="#tab_4" data-toggle="tab">Subtotal Cash Out C. Over</a></li>
               
              </ul>
              <div class="tab-content">
                <div class="tab-pane active table-responsive" id="tab_1">
                  @if ( $budget_tahunan->approval != "" )
                    @if ( $budget_tahunan->approval->approval_action_id == "6")
                      <span class="label-success">Approved</span>
                    @elseif ( $budget_tahunan->approval->approval_action_id == "7")
                      <span class="label-danger">Budget anda ditolak</span><br><br>                      
                    @endif

                  @else
                 
                  @endif
                  <table class="table" style="padding: 0" id="example3">
                    <thead class="head_table">
                      <tr>
                        <td>COA</td>
                        <td>Item Pekerjaan</td>
                        <td>Volume</td>
                        <td>Satuan</td>
                        <td>Harga Satuan(Rp)</td>
                        <td>Subtotal(Rp)</td>
                        <td colspan="2">Perubahan Data</td>
                      </tr>
                    </thead>
                    <tbody>
                      @if ( $budget_tahunan->total_parent_item != "" )
                        @foreach ( $budget_tahunan->total_parent_item as $key => $value )
                          @if ( $value['group_cost'] == 1 )
                          <tr>
                            <td>{{ $value['code']}}</td>
                            <td>{{ $value['itempekerjaan']}}</td>
                            <td>{{ number_format($value['volume'])}}</td>
                            <td>{{ $value['satuan']}}</td>
                            <td>{{ number_format($value['nilai'])}}</td>
                            <td>{{ number_format($value['nilai'] * $value['volume'])}}</td>
                            <td>
                              @if ( $budget_tahunan->approval != "" )
                                @if ( $budget_tahunan->approval->approval_action_id == 7 )
                                  <a href="{{ url('/')}}/budget/cashflow/revisi-item?id={{ $value['code'] }}&budget={{ $budget_tahunan->id }}" class="btn btn-warning">Edit Cash Flow</a>
                                @endif
                              @else
                                <a href="{{ url('/')}}/budget/cashflow/revisi-item?id={{ $value['code'] }}&budget={{ $budget_tahunan->id }}" class="btn btn-warning">Edit Cash Flow</a>
                              @endif
                            </td>
                          </tr>
                          @endif
                        @endforeach
                      @endif
                    </tbody>
                  </table>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane table-responsive" id="tab_2">
                  {{ csrf_field()}}
                  @if ( $budget_tahunan->approval != "" )
                    @if (  $budget_tahunan->approval->approval_action_id == 7 )
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
                        Tambah Data
                      </button><br>
                    @endif
                  @else

                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
                        Tambah Data
                      </button><br>
                   
                  @endif
                  <table  class="table table-responsive table-bordered" style="padding: 0">
                    <thead class="head_table">
                      <tr>
                        <td>COA</td>
                        <td>Item Pekerjaan</td>
                        <td>Total Budget SPK(Rp)</td>
                        <td>Total Cash Out(Rp)</td>
                        <td>Jan</td>
                        <td>Feb</td>
                        <td>Mar</td>
                        <td>Apr</td>
                        <td>Mei</td>
                        <td>Juni</td>
                        <td>Jul</td>
                        <td>Ags</td>
                        <td>Sept</td>
                        <td>Okt</td>
                        <td>Nov</td>
                        <td>Des</td>
                        <td>Perubahan Data</td>
                      </tr>
                    </thead>
                    <tbody>
                      @php $item_bln = 0; @endphp
                      @foreach ( $budget_tahunan->details as $key => $value )
                        @if ( $value->volume > 0 && $value->nilai > 0 )
                        @php 
                          $budgetcf = \Modules\Budget\Entities\BudgetTahunanPeriode::where("budget_id",$budget_tahunan->id)->where("itempekerjaan_id",$value->itempekerjaans->id)->get();
                        @endphp
                          @if ( count($budgetcf) > 0 )
                            @foreach ( $budgetcf as $key2 => $value2 )
                            <tr>
                              <td>
                                <input type="hidden" name="item_id_{{ $value->itempekerjaans->code }}" value="{{ $value->itempekerjaans->code}}">
                                <input type="hidden" id="monthly_id_{{ $value2->id }}" value="{{ $value2->id }}">
                                {{ $value->itempekerjaans->code }}
                              </td>
                              <td>{{ $value->itempekerjaans->name }}</td>
                              <td>{{ number_format($spk = $value->volume * $value->nilai )}}</td>
                              <td>{{ number_format( $total_cash_out = (($value2->januari/100) * $spk ) + ( ($value2->februari/100) * $spk ) + ( ($value2->maret/100) * $spk ) + ( ($value2->april/100) * $spk ) + (($value2->mei/100) * $spk ) + ( ($value2->juni/100) * $spk ) + ( ($value2->juli/100) * $spk ) + ( ($value2->agustus/100) * $spk ) + ( ($value2->september/100) * $spk ) + ( ($value2->oktober/100) * $spk ) + ( ($value2->november/100) * $spk ) + ( ($value2->desember/100) * $spk ) ) }}</td>
                              <td>
                                <span id="label_januari_{{ $value2->id}}">{{ number_format(( $value2->januari / 100 ) * $spk) }}</span>
                                <input type="text" id="januari_{{ $value2->id}}" style="display: none;width: 80%;" value=" {{  $value2->januari }} ">
                              </td>
                              <td>
                                <span id="label_februari_{{ $value2->id}}">{{ number_format(( $value2->februari / 100 ) * $spk)}}</span>
                                <input type="text" id="februari_{{ $value2->id}}" style="display: none;width: 80%;" value="{{  $value2->februari }}">
                              </td>
                              <td>
                                <span id="label_maret_{{ $value2->id}}">{{ number_format(( $value2->maret / 100 ) * $spk) }}</span>
                                <input type="text" id="maret_{{ $value2->id}}" style="display: none;width: 80%;" value=" {{  $value2->maret }} ">
                              </td>
                              <td>
                                <span id="label_april_{{ $value2->id}}">{{ number_format(( $value2->april / 100 ) * $spk ) }}</span>
                                <input type="text" id="april_{{ $value2->id}}" style="display: none;width: 80%;" value=" {{  $value2->april }} ">
                              </td>
                              <td>
                                <span id="label_mei_{{ $value2->id}}">{{ number_format(( $value2->mei / 100 ) * $spk ) }}</span>
                                <input type="text" id="mei_{{ $value2->id}}" style="display: none;width: 80%;" value=" {{  $value2->mei }} ">
                              </td>
                              <td>
                                <span id="label_juni_{{ $value2->id}}">{{ number_format(( $value2->juni / 100 ) * $spk )}}</span>
                                <input type="text" id="juni_{{ $value2->id}}" style="display: none;width: 80%;" value=" {{  $value2->juni}} ">
                              </td>
                              <td>
                                <span id="label_juli_{{ $value2->id}}">{{ number_format(( $value2->juli / 100 ) * $spk ) }}</span>
                                <input type="text" id="juli_{{ $value2->id}}" style="display: none;width: 80%;" value=" {{  $value2->juli }} ">
                              </td>
                              <td>
                                <span id="label_agustus_{{ $value2->id}}">{{ number_format(( $value2->agustus / 100 ) *  $spk ) }}</span>
                                <input type="text" id="agustus_{{ $value2->id}}" style="display: none;width: 80%;" value=" {{  $value2->agustus }} ">
                              </td>
                              <td>
                                <span id="label_september_{{ $value2->id}}">{{ number_format(( $value2->september / 100 ) * $spk ) }}</span>
                                <input type="text" id="september_{{ $value2->id}}" style="display: none;width: 80%;" value=" {{ $value2->september }} ">
                              </td>
                              <td>
                                <span id="label_oktober_{{ $value2->id}}">{{ number_format(( $value2->oktober / 100 ) *  $spk ) }}</span>
                                <input type="text" id="oktober_{{ $value2->id}}" style="display: none;width: 80%;" value=" {{  $value2->oktober }} ">
                              </td>
                              <td>
                                <span id="label_november_{{ $value2->id}}">{{ number_format(( $value2->november / 100 ) * $spk ) }}</span>
                                <input type="text" id="november_{{ $value2->id}}" style="display: none;width: 80%;" value=" {{  $value2->november }} ">
                              </td>
                              <td>
                                <span id="label_desember_{{ $value2->id}}">{{ number_format(( $value2->desember /100) * $spk ) }}</span>
                                <input type="text" id="desember_{{ $value2->id}}" style="display: none;width: 80%;" value=" {{  $value2->desember}} ">
                              </td>
                              <td>
                                @if ( $budget_tahunan->approval != "" )
                                  @if (  $budget_tahunan->approval->approval_action_id == 7 )
                                  <button class="btn btn-warning" id="btn_edit1_{{ $value2->id }}" onclick="viewedit('{{ $value2->id }}')">Edit</button>
                                  <button class="btn btn-success" id="btn_edit2_{{ $value2->id }}" onclick="saveedit('{{ $value2->id }}')" style="display: none;">Edit</button>
                                  <button class="btn btn-danger" onclick="removeedit('{{ $value2->id }}')">Delete</button>
                     
                                  @endif
                                @else
                                <button class="btn btn-warning" id="btn_edit1_{{ $value2->id }}" onclick="viewedit('{{ $value2->id }}')">Edit</button>
                                <button class="btn btn-success" id="btn_edit2_{{ $value2->id }}" onclick="saveedit('{{ $value2->id }}')" style="display: none;">Edit</button>
                                <button class="btn btn-danger" onclick="removeedit('{{ $value2->id }}')">Delete</button>
                                @endif
                              </td>
                            </tr>
                            @php $item_bln = $item_bln + $total_cash_out; @endphp
                            @endforeach
                          @endif
                        @endif
                        
                      @endforeach
  
                    </tbody>
                  </table>
                  <input type="hidden" id="total_budget_bln" value="{{ $item_bln }}">
                  <input type="hidden" id="total_budget_bln_co" value="{{ $budget_tahunan->nilai_carry_over }}">
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                  @if ( $budget_tahunan->approval != "" )
                    @if (  $budget_tahunan->approval->approval_action_id == 7 )
                      <a class="btn btn-info" href="{{ url('/')}}/budget/add-carryover/?id={{ $budget_tahunan->id}}">Tambah Carry Over</a>
                    @endif
                  @else
                  <a class="btn btn-info" href="{{ url('/')}}/budget/add-carryover/?id={{ $budget_tahunan->id}}">Tambah Carry Over</a>
                  @endif
                  <h3>Total Carry Over : {{ number_format($budget_tahunan->carry_nilai)}}</h3>
                  {{ csrf_field() }}
                  <table class="table table-bordered">
                    <thead class="head_table">
                      <tr>
                        <td>No.SPK</td>
                        <td>COA Pekerjaan</td>
                        <td>Item Pekerjaan</td>
                        <td>No. SPK</td>
                        <td>Nilai SPK</td>
                        <td>Terbayar</td>
                        <td>Rencana Terbayar</td>
                        <td>Nilai Carry Over Berikutnya</td>
                        <td>Action</td>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ( $budget_tahunan->carry_over as $key4 => $value4 )
                      @if ($value4->spk->nilai != "" )
                      <tr>
                        <td>{{ $value->spk->no or '' }}</td>
                        <td>{{ $value4->spk->itempekerjaan->code or '' }}</td>
                        <td>{{ $value4->spk->itempekerjaan->name or '' }}</td>
                        <td>{{ $value4->spk->no}}</td>
                        <td>{{ number_format($value4->spk->nilai + $value4->spk->nilai_vo) }}</td>
                        <td>{{ number_format($value4->spk->terbayar_verified / 1.1)}}</td>
                        <td>{{ number_format( $value4->nilai_rencana)}}</td>
                        <td>{{ number_format(( ($value4->spk->nilai + $value4->spk->nilai_vo) - $value4->spk->terbayar_verified) - $value4->nilai_rencana)}}</td>
                        <td><button class="btn btn-danger" onClick="removeco('{{ $value4->id }}')">Hapus</button></td>
                      </tr>
                      @endif
                      @endforeach
                    </tbody>
                  </table>
                  
                </div>

                <div class="tab-pane table-responsive" id="tab_4">
                  @if ( $budget_tahunan->approval != "" )
                    @if (  $budget_tahunan->approval->approval_action_id == 7 )
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info-co">
                        Tambah Data
                      </button><br>
                    @endif
                  @endif
                  <center><h4>Cash Flow Carry Over</h4></center>
                  <h3>Total Carry Over : {{ number_format($budget_tahunan->carry_nilai)}}</h3>
                  <form action="{{ url('/')}}/budget/save-carryover" method="post">
                  <input type="hidden" name="carryover_budget_id" value="{{ $budget_tahunan->id }}">
                  {{ csrf_field() }}
                  <table class="table table-bordered">
                    <thead class="head_table">
                      <tr>
                        <td>No. SPK(Rp)</td>
                        <td>Nilai SPK(Rp)</td>
                        <td>Terbayar(Rp)</td>
                        <td>Sisa Bayar(Rp)</td>
                        <td>Total Dibayar(Rp)</td>
                        <td>Januari(Rp)</td>
                        <td>Februari(Rp)</td>
                        <td>Maret(Rp)</td>
                        <td>April(Rp)</td>
                        <td>Mei(Rp)</td>
                        <td>Juni(Rp)</td>
                        <td>Juli(Rp)</td>
                        <td>Agustus(Rp)</td>
                        <td>September(Rp)</td>
                        <td>Oktober(Rp)</td>
                        <td>November(Rp)</td>
                        <td>Desember(Rp)</td>
                        <td>Action</td>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ( $budget_tahunan->carry_over as $key => $value )
                        @foreach ( $value->cash_flows as $key1 => $value1 )
                        @if ( $value->hutang_bayar != "" )
                          @php $sisa = $value->hutang_bayar; @endphp
                        @else
                        @php  $sisa = ( $value->spk->nilai + $value->spk->nilai_vo) - ($value->spk->terbayar_verified /1.1);  @endphp
                        @endif
                        <tr>
                          <td data-value="{{ $value->spk->id }}">{{ $value->spk->no or '' }}</td>
                          <td>{{ number_format($value->spk->nilai,2)}}</td>
                          <td>{{ number_format($value->spk->terbayar_verified,2) }}</td>
                          <td>{{ number_format($sisa,2) }}</td>
                          <td>{{ number_format( $sisa * ( $value1->total / 100 ) ,2) }}</td>
                          <td>{{ number_format( $sisa * ( $value1->januari / 100 ) ,2) }}</td>
                          <td>{{ $sisa }}{{ number_format( $sisa * ( $value1->februari / 100 ) ,2) }}</td>
                          <td>{{ number_format( $sisa * ( $value1->maret / 100 ) ,2) }}</td>
                          <td>{{ number_format( $sisa * ( $value1->april / 100 ) ,2) }}</td>
                          <td>{{ number_format( $sisa * ( $value1->mei / 100 ) ,2) }}</td>
                          <td>{{ number_format( $sisa * ( $value1->juni / 100 ) ,2) }}</td>
                          <td>{{ number_format( $sisa * ( $value1->juli / 100 ) ,2) }}</td>
                          <td>{{ number_format( $sisa * ( $value1->agustus / 100 ) ,2) }}</td>
                          <td>{{ number_format( $sisa * ( $value1->september / 100 ) ,2) }}</td>
                          <td>{{ number_format( $sisa * ( $value1->oktober / 100 ) ,2) }}</td>
                          <td>{{ number_format( $sisa * ( $value1->november / 100 ) ,2) }}</td>
                          <td>{{ number_format( $sisa * ( $value1->desember / 100 ) ,2) }}</td>   
                          <td><button class="btn btn-danger" onClick="removecoco('{{ $value1->id }}')">Hapus</button></td>       
                        </tr>
                        @endforeach
                      @endforeach
                    </tbody>
                  </table>
                </div>

                <div class="tab-pane table-responsive" id="tab_5">
                  
                  <h4>Budget Pengembangan Unit</h4>
                  <table class="table table-bordered">
                    <thead class="head_table">
                      <tr>
                        <td>COA</td>
                        <td>Item Pekerjaan</td>
                        <td>Volume</td>
                        <td>Satuan</td>
                        <td>Harga Satuan(Rp)</td>
                        <td>Subtotal(Rp)</td>
                        <td colspan="2">Perubahan Data</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tbody>
                      @if ( $budget_tahunan->total_parent_item != "" )
                        @foreach ( $budget_tahunan->total_parent_item as $key => $value )
                          @if ( $value['group_cost'] == 2 && $value['volume'] > 0 )
                          <tr>
                            <td>{{ $value['code']}}</td>
                            <td>{{ $value['itempekerjaan']}}</td>
                            <td>{{ number_format($value['volume'])}}</td>
                            <td>{{ $value['satuan']}}</td>
                            <td>{{ number_format($value['nilai'] )}}</td>
                            <td>{{ number_format($value['nilai'] *  $value['volume'])}}</td>
                            <td>
                              @if ( $budget_tahunan->approval != "" )
                                @if ( $budget_tahunan->approval->approval_action_id != 6 )
                                  <a href="{{ url('/')}}/budget/cashflow/viewitemconcost?id={{ $budget_tahunan->id }}" class="btn btn-warning">Set Unit / Tahun</a>
                                @endif
                              @else
                                <a href="{{ url('/')}}/budget/cashflow/viewitemconcost?id={{ $budget_tahunan->id }}" class="btn btn-warning">Set Unit / Tahun</a>
                              @endif
                            </td>
                          </tr>
                          @endif
                        @endforeach
                      @endif
                    </tbody>
                    </tbody>
                  </table>
                </div>

                <div class="tab-pane table-responsive" id="tab_6">
                  <h4>Cash Flow Pengembangan Unit</h4>
                  <table class="table table-bordered">
                    <thead class="head_table">
                      <tr>
                        <td>Unit Type</td>
                        <td>LB/LT</td>
                        <td>Set Cash Out</td>
                        <td>Harga Satuan</td>
                        <td>Total Unit</td>
                        <td>Total Cashout / tahun</td>
                        <td>Jan</td>
                        <td>Feb</td>
                        <td>Mar</td>
                        <td>Apr</td>
                        <td>Mei</td>
                        <td>Juni</td>
                        <td>Jul</td>
                        <td>Ags</td>
                        <td>Sept</td>
                        <td>Okt</td>
                        <td>Nov</td>
                        <td>Des</td>
                      </tr>
                    </thead>
                    <tbody>
                      @if ( $budget_tahunan->budget->kawasan != "" )
                        @foreach ( $budget_tahunan->budget_unit as $key => $value )
                          @foreach ( $value->details as $key2 => $value2 )
                            <tr>
                              <td>{{ $value->unit_type->name }}</td>
                              <td>{{ $value->unit_type->luas_bangunan }} / {{ $value->unit_type->luas_tanah }}</td>
                              <td></td>
                              <td>{{ number_format($value->harga_satuan)}}</td>
                              <td>{{ $value->total_unit }}</td>
                              <td style="background-color: #009688;color:white;font-weight: bolder;">&nbsp;</td>
                              <td>
                                @if ( $value2->januari > 0 ) 
                                  @php $class = "btn-primary"; $disabled= "" ; @endphp
                                @else
                                  @php $class = "btn-danger"; $disabled = "disabled"; @endphp
                                @endif
                                <button class="btn {{ $class }}" onclick="setCashOut('{{ $value2->id }}','{{ $value->harga_satuan }}','{{ $value2->januari}}','januari','{{ $value->unit_type->luas_bangunan }}')" data-toggle="modal" data-target="#modal-info-unit" {{ $disabled }}>{{ number_format($value2->januari) }}</button>
                              </td>
                              <td>
                                @if ( $value2->februari > 0 ) 
                                  @php $class = "btn-primary"; $disabled= "" ; @endphp
                                @else
                                  @php $class = "btn-danger"; $disabled = "disabled"; @endphp
                                @endif

                                <button class="btn {{ $class }}" onclick="setCashOut('{{ $value2->id }}','{{ $value->harga_satuan }}','{{ $value2->februari}}','februari','{{ $value->unit_type->luas_bangunan }}')" data-toggle="modal" data-target="#modal-info-unit" {{ $disabled }} >{{ number_format($value2->februari) }}</button>
                              </td>
                              <td>
                                @if ( $value2->maret > 0 ) 
                                  @php $class = "btn-primary"; $disabled= "" ; @endphp
                                @else
                                  @php $class = "btn-danger"; $disabled = "disabled"; @endphp
                                @endif

                                <button class="btn {{ $class }}" onclick="setCashOut('{{ $value2->id }}','{{ $value->harga_satuan }}','{{ $value2->maret}}','maret','{{ $value->unit_type->luas_bangunan }}')" data-toggle="modal" data-target="#modal-info-unit" {{ $disabled }}>{{ number_format($value2->maret) }}</button>
                              </td>
                              <td>
                                @if ( $value2->april > 0 ) 
                                  @php $class = "btn-primary"; $disabled= "" ; @endphp
                                @else
                                  @php $class = "btn-danger"; $disabled = "disabled"; @endphp
                                @endif
                                <button class="btn {{ $class }}" onclick="setCashOut('{{ $value2->id }}','{{ $value->harga_satuan }}','{{ $value2->april}}','april','{{ $value->unit_type->luas_bangunan }}')" data-toggle="modal" data-target="#modal-info-unit" {{ $disabled }}>{{ number_format($value2->april) }}</button>
                              </td>
                              <td>
                                @if ( $value2->mei > 0 ) 
                                  @php $class = "btn-primary"; $disabled= "" ; @endphp
                                @else
                                  @php $class = "btn-danger"; $disabled = "disabled"; @endphp
                                @endif
                                <button class="btn {{ $class }}" onclick="setCashOut('{{ $value2->id }}','{{ $value->harga_satuan }}','{{ $value2->mei}}','mei','{{ $value->unit_type->luas_bangunan }}')" data-toggle="modal" data-target="#modal-info-unit" {{ $disabled }}>{{ number_format($value2->mei) }}</button>
                              </td>
                              <td>
                                @if ( $value2->juni > 0 ) 
                                  @php $class = "btn-primary"; $disabled= "" ; @endphp
                                @else
                                  @php $class = "btn-danger"; $disabled = "disabled"; @endphp
                                @endif
                                <button class="btn {{ $class }}" onclick="setCashOut('{{ $value2->id }}','{{ $value->harga_satuan }}','{{ $value2->juni}}','juni','{{ $value->unit_type->luas_bangunan }}')" data-toggle="modal" data-target="#modal-info-unit" {{ $disabled }}>{{ number_format($value2->juni) }}</button>
                              </td>
                              <td>
                                @if ( $value2->juli > 0 ) 
                                  @php $class = "btn-primary"; $disabled= "" ; @endphp
                                @else
                                  @php $class = "btn-danger"; $disabled = "disabled"; @endphp
                                @endif

                                <button class="btn {{ $class }}" onclick="setCashOut('{{ $value2->id }}','{{ $value->harga_satuan }}','{{ $value2->juli}}','juli','{{ $value->unit_type->luas_bangunan }}')" data-toggle="modal" data-target="#modal-info-unit" {{ $disabled }}>{{ number_format($value2->juli) }}</button>
                              </td>
                              <td>
                                @if ( $value2->agustus > 0 ) 
                                  @php $class = "btn-primary"; $disabled= "" ; @endphp
                                @else
                                  @php $class = "btn-danger"; $disabled = "disabled"; @endphp
                                @endif

                                <button class="btn {{ $class }}" onclick="setCashOut('{{ $value2->id }}','{{ $value->harga_satuan }}','{{ $value2->agustus}}','agustus','{{ $value->unit_type->luas_bangunan }}')" data-toggle="modal" data-target="#modal-info-unit" {{ $disabled }}>{{ number_format($value2->agustus) }}</button>
                              </td>
                              <td>
                                @if ( $value2->september > 0 ) 
                                  @php $class = "btn-primary"; $disabled= "" ; @endphp
                                @else
                                  @php $class = "btn-danger"; $disabled = "disabled"; @endphp
                                @endif

                                <button class="btn {{ $class }}" onclick="setCashOut('{{ $value2->id }}','{{ $value->harga_satuan }}','{{ $value2->september}}','september','{{ $value->unit_type->luas_bangunan }}')" data-toggle="modal" data-target="#modal-info-unit" {{ $disabled }}>{{ number_format($value2->september) }}</button>
                              </td>
                              <td>
                                @if ( $value2->oktober > 0 ) 
                                  @php $class = "btn-primary"; $disabled= "" ; @endphp
                                @else
                                  @php $class = "btn-danger"; $disabled = "disabled"; @endphp
                                @endif

                                <button class="btn {{ $class }}" onclick="setCashOut('{{ $value2->id }}','{{ $value->harga_satuan }}','{{ $value2->oktober}}','oktober','{{ $value->unit_type->luas_bangunan }}')" data-toggle="modal" data-target="#modal-info-unit" {{ $disabled }}>{{ number_format($value2->oktober) }}</button>
                              </td>
                              <td>
                                @if ( $value2->november > 0 ) 
                                  @php $class = "btn-primary"; $disabled= "" ; @endphp
                                @else
                                  @php $class = "btn-danger"; $disabled = "disabled"; @endphp
                                @endif

                                <button class="btn {{ $class }}" onclick="setCashOut('{{ $value2->id }}','{{ $value->harga_satuan }}','{{ $value2->november}}','november','{{ $value->unit_type->luas_bangunan }}')" data-toggle="modal" data-target="#modal-info-unit" {{ $disabled }}>{{ number_format($value2->november) }}</button>
                              </td>
                              <td>
                                @if ( $value2->desember > 0 ) 
                                  @php $class = "btn-primary"; $disabled= "" ; @endphp
                                @else
                                  @php $class = "btn-danger"; $disabled = "disabled"; @endphp
                                @endif
                                <button class="btn {{ $class }}" onclick="setCashOut('{{ $value2->id }}','{{ $value->harga_satuan }}','{{ $value2->desember}}','desember','{{ $value->unit_type->luas_bangunan }}')" data-toggle="modal" data-target="#modal-info-unit" {{ $disabled }}>{{ number_format($value2->desember) }}</button>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3" style="background-color: grey;font-weight: bolder;color:white;">Rencana SPK / tahun</td>
                              <td colspan="2" style="background-color: grey;font-weight: bolder;color:white;">Rp. {{ number_format($value->harga_satuan * $value->volume )}}</td>
                              <td  style="background-color: #009688;color:white;font-weight: bolder;">{{ number_format($value2->nilai_cash_out_bulanan['januari'] + $value2->nilai_cash_out_bulanan['februari'] + $value2->nilai_cash_out_bulanan['maret'] + $value2->nilai_cash_out_bulanan['april'] + $value2->nilai_cash_out_bulanan['mei'] + $value2->nilai_cash_out_bulanan['juni'] + $value2->nilai_cash_out_bulanan['juli'] + $value2->nilai_cash_out_bulanan['agustus'] + $value2->nilai_cash_out_bulanan['september'] + 
                              $value2->nilai_cash_out_bulanan['oktober'] + $value2->nilai_cash_out_bulanan['november'] + $value2->nilai_cash_out_bulanan['desember']) }}</td>
                              <td>{{ number_format($value2->nilai_cash_out_bulanan['januari']) }}</td>
                              <td>{{ number_format($value2->nilai_cash_out_bulanan['februari']) }}</td>
                              <td>{{ number_format($value2->nilai_cash_out_bulanan['maret']) }}</td>
                              <td>{{ number_format($value2->nilai_cash_out_bulanan['april']) }}</td>
                              <td>{{ number_format($value2->nilai_cash_out_bulanan['mei']) }}</td>
                              <td>{{ number_format($value2->nilai_cash_out_bulanan['juni']) }}</td>
                              <td>{{ number_format($value2->nilai_cash_out_bulanan['juli']) }}</td>
                              <td>{{ number_format($value2->nilai_cash_out_bulanan['agustus']) }}</td>
                              <td>{{ number_format($value2->nilai_cash_out_bulanan['september']) }}</td>
                              <td>{{ number_format($value2->nilai_cash_out_bulanan['oktober']) }}</td>
                              <td>{{ number_format($value2->nilai_cash_out_bulanan['november']) }}</td>
                              <td>{{ number_format($value2->nilai_cash_out_bulanan['desember']) }}</td>
                            </tr>
                          @endforeach
                        @endforeach
                      @endif
                    </tbody>
                  </table>
                </div>
              <!-- /.tab-content -->
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

  <div class="modal fade" id="modal-info">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Cash Out</h4>
        </div>
        <div class="modal-body">
          <form action="{{ url('/')}}/budget/cashflow/save-monthly" method="post" name="formacasd">

            <input type="hidden" name="budget_tahunan_id" id="budget_tahunan_id" value="{{ $budget_tahunan->id }}">
            <div class="form-group">
              <span id="loading_cf_bar"></span>
              <button type="button" class="btn btn-info" id="btn_save_bln">Save changes</button>
              <label>Item Pekerjaan</label>
              <select class="form-control" id="item_id_monthly" name="item_id_monthly" required>
                <option value="">(pilih item pekerjaan)</option>
                @foreach ( $budget_tahunan->details as $key2 => $value2 )
                @if ( $value2->nilai_periode == 0 )
                  @if ( $value2->itempekerjaans->group_cost == 1 )
                    @if ( $value2->volume > 0 && $value2->nilai > 0 )
                    <option value="{{ $value2->itempekerjaans->id }}">{{ $value2->itempekerjaans->code }} - {{ $value2->itempekerjaans->name }}</option>
                    @endif
                  @endif
                @endif
                @endforeach
              </select>
            </div> 
            <div class="form-group">
              <label>Nilai Budget(Rp)</label>
                @foreach ( $budget_tahunan->details as $key2 => $value2 )
                  @if ( $value2->volume > 0 && $value2->nilai > 0 )
                    @if ( $value2->itempekerjaans->group_cost == 1 )
                    <span style="display: none;" class="label_budget" id="label_budget_{{ $value2->itempekerjaans->id }}" data-value="{{ $value2->nilai * $value2->volume }}"><br>
                    <strong>{{ number_format( $value2->nilai * $value2->volume ,2)}}</strong>
                    </span>
                    @endif
                  @endif
                @endforeach<br>
              <label>Sisa(Rp)</label><br>
              <span id="sisa_budget"></span>
            </div> 
            <table style="width: 100%;" class="table">    
                <tr class="head_table">
                  <td></td>
                  <td>% <span id="lbl_percent_text"></span></td>
                  <td><input type="hidden" id="total_sub"/> Rp. <span id="lbl_budget_text"></span></td>

                </tr>                
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">Januari</td>
                  <td><input type="text" name="januari" id="januari" style="width: 20%;" onKeyUp="countPercentage('januari','')" value="0" autocomplete="off">%</td>
                  <td><span id="lbl_januari" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">Februari</td>
                  <td><input type="text" name="februari" id="februari" style="width: 20%;" onKeyUp="countPercentage('februari','')" value="0" autocomplete="off">%</td>
                  <td><span id="lbl_februari" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">Maret</td>
                  <td><input type="text" name="maret" id="maret" style="width: 20%;" onKeyUp="countPercentage('maret','')" value="0" autocomplete="off">%</td>
                  <td><span id="lbl_maret" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">April</td>
                  <td><input type="text" name="april" id="april" style="width: 20%;" onKeyUp="countPercentage('april','')" value="0" autocomplete="off">%</td>
                  <td><span id="lbl_april" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">Mei</td>
                  <td><input type="text" name="mei" id="mei" style="width: 20%;" onKeyUp="countPercentage('mei','')" value="0" autocomplete="off">%</td>
                  <td><span id="lbl_mei" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">Juni</td>
                  <td><input type="text" name="juni" id="juni" style="width: 20%;" onKeyUp="countPercentage('juni','')" value="0" autocomplete="off">%</td>
                  <td><span id="lbl_juni" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">Juli</td>
                  <td><input type="text" name="juli" id="juli" style="width: 20%;" onKeyUp="countPercentage('juli','')" value="0" autocomplete="off">%</td>
                  <td><span id="lbl_juli" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">Agustus</td>
                  <td><input type="text" name="agustus" id="agustus" style="width: 20%;" onKeyUp="countPercentage('agustus','')" value="0" autocomplete="off">%</td>
                  <td><span id="lbl_agustus" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">September</td>
                  <td><input type="text" name="september" id="september" style="width: 20%;" onKeyUp="countPercentage('september','')" value="0" autocomplete="off">%</td>
                  <td><span id="lbl_september" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">Oktober</td>
                  <td><input type="text" name="oktober" id="oktober" style="width: 20%;" onKeyUp="countPercentage('oktober','')" value="0">%</td>
                  <td><span id="lbl_oktober" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;" >November</td>
                  <td><input type="text" name="november" id="november" style="width: 20%;" onKeyUp="countPercentage('november','')" value="0" autocomplete="off">%</td>
                  <td><span id="lbl_november" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">Desember</td>
                  <td><input type="text" name="desember" id="desember" style="width: 20%;" onKeyUp="countPercentage('desember','')" value="0" autocomplete="off">%</td>
                  <td><span id="lbl_desember" data-value="0"></span></td>
                </tr>
                                    
            </table>
          
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Close</button>

        </div>
         <div class="alert alert-warning alert-dismissible">                    
          <h4><i class="icon fa fa-warning"></i> Alert!</h4>
          Harap Input Budget Bulanan dengan percentase.
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

   <div class="modal fade" id="modal-info-co">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Carry Over</h4>
        </div>
        <div class="modal-body">
          <form action="{{ url('/')}}/budget/cashflow/save-monthlyco" method="post" name="form1">
            {{ csrf_field()}}
            <input type="hidden" name="budget_tahunan_id" value="{{ $budget_tahunan->id }}">
            <div class="form-group">
              <button type="submit" class="btn btn-info" id="btn_save_bln_2">Save changes</button>
              <label>COA Spk</label>
              <select class="form-control" id="item_id_monthly_co" name="item_id_monthly_co" required>
                <option value="">(pilih spk)</option>
                @foreach ( $budget_tahunan->carry_over as $key4 => $value4 )
                  <option value="{{ $value4->id}}">{{ $value4->spk->no }} / {{ $value4->spk->itempekerjaan->name or '' }}</option>
                @endforeach
              </select>
            </div> 
            <div class="form-group">
              <label>Nilai Budget(Rp)</label>     
              @foreach ( $budget_tahunan->carry_over as $key4 => $value4 )
                @if ( $value4->spk != "")
                  <br>
                  <span style="display: none;" class="label_budget_co" id="label_budget_co_{{$value4->id}}" data-value="{{ $value4->nilai_rencana}} ">{{ number_format($value4->nilai_rencana)}}</strong>
                  </span>
                @endif
              @endforeach<br>         
              <label>Sisa(Rp)</label><br>
              <span id="sisa_budget_co"></span>
            </div> 
            <table style="width: 100%;" class="table">    
              <tr class="head_table">
                <td></td>
                <td>% <span id="lbl_percent_text"></span></td>
                <td><input type="hidden" id="total_sub_co"/> Rp. <span id="lbl_budget_text"></span></td>

              </tr>                
              <tr>
                <td style="background-color: grey;color:white;font-weight: bolder;">Januari</td>
                <td><input type="text" name="januari_co" id="januari_co" style="width: 20%;" onKeyUp="countPercentage('januari_co','_co')" value="0" autocomplete="off">%</td>
                <td><span id="lbl_januari_co" data-value="0"></span></td>
              </tr>
              <tr>
                <td style="background-color: grey;color:white;font-weight: bolder;">Februari</td>
                <td><input type="text" name="februari_co" id="februari_co" style="width: 20%;" onKeyUp="countPercentage('februari_co','_co')" value="0" autocomplete="off">%</td>
                <td><span id="lbl_februari_co" data-value="0"></span></td>
              </tr>
              <tr>
                <td style="background-color: grey;color:white;font-weight: bolder;">Maret</td>
                <td><input type="text" name="maret_co" id="maret_co" style="width: 20%;" onKeyUp="countPercentage('maret_co','_co')" value="0" autocomplete="off">%</td>
                <td><span id="lbl_maret_co" data-value="0"></span></td>
              </tr>
              <tr>
                <td style="background-color: grey;color:white;font-weight: bolder;">April</td>
                <td><input type="text" name="april_co" id="april_co" style="width: 20%;" onKeyUp="countPercentage('april_co','_co')" value="0" autocomplete="off">%</td>
                <td><span id="lbl_april_co" data-value="0"></span></td>
              </tr>
              <tr>
                <td style="background-color: grey;color:white;font-weight: bolder;">Mei</td>
                <td><input type="text" name="mei_co" id="mei_co" style="width: 20%;" onKeyUp="countPercentage('mei_co','_co')" value="0" autocomplete="off">%</td>
                <td><span id="lbl_mei_co" data-value="0"></span></td>
              </tr>
              <tr>
                <td style="background-color: grey;color:white;font-weight: bolder;">Juni</td>
                <td><input type="text" name="juni_co" id="juni_co" style="width: 20%;" onKeyUp="countPercentage('juni_co','_co')" value="0" autocomplete="off">%</td>
                <td><span id="lbl_juni_co" data-value="0"></span></td>
              </tr>
              <tr>
                <td style="background-color: grey;color:white;font-weight: bolder;">Juli</td>
                <td><input type="text" name="juli_co" id="juli_co" style="width: 20%;" onKeyUp="countPercentage('juli_co','_co')" value="0" autocomplete="off">%</td>
                <td><span id="lbl_juli_co" data-value="0"></span></td>
              </tr>
              <tr>
                <td style="background-color: grey;color:white;font-weight: bolder;">Agustus</td>
                <td><input type="text" name="agustus_co" id="agustus_co" style="width: 20%;" onKeyUp="countPercentage('agustus_co','_co')" value="0" autocomplete="off">%</td>
                <td><span id="lbl_agustus_co" data-value="0"></span></td>
              </tr>
              <tr>
                <td style="background-color: grey;color:white;font-weight: bolder;">September</td>
                <td><input type="text" name="september_co" id="september_co" style="width: 20%;" onKeyUp="countPercentage('september_co','_co')" value="0" autocomplete="off">%</td>
                <td><span id="lbl_september_co" data-value="0"></span></td>
              </tr>
              <tr>
                <td style="background-color: grey;color:white;font-weight: bolder;">Oktober</td>
                <td><input type="text" name="oktober_co" id="oktober_co" style="width: 20%;" onKeyUp="countPercentage('oktober_co','_co')" value="0">%</td>
                <td><span id="lbl_oktober_co" data-value="0"></span></td>
              </tr>
              <tr>
                <td style="background-color: grey;color:white;font-weight: bolder;" >November</td>
                <td><input type="text" name="november_co" id="november_co" style="width: 20%;" onKeyUp="countPercentage('november_co','_co')" value="0" autocomplete="off">%</td>
                <td><span id="lbl_november_co" data-value="0"></span></td>
              </tr>
              <tr>
                <td style="background-color: grey;color:white;font-weight: bolder;">Desember</td>
                <td><input type="text" name="desember_co" id="desember_co" style="width: 20%;" onKeyUp="countPercentage('desember_co','_co')" value="0" autocomplete="off">%</td>
                <td><span id="lbl_desember_co" data-value="0"></span></td>
              </tr>                                    
            </table>            
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Close</button>

        </div>
         <div class="alert alert-warning alert-dismissible">                    
          <h4><i class="icon fa fa-warning"></i> Alert!</h4>
          Harap Input Budget Bulanan dengan percentase.
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal-info-unit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Cash Out</h4>
        </div>
        <div class="modal-body">
          <form action="{{ url('/')}}/budget/cashflow/save-cashouttype" method="post" name="formacasd">
            {{csrf_field()}}
            <button id="btn_save_bln_unit" class="btn btn-info">Simpan</button>
            <input type="hidden" name="budget_unit_id" id="budget_unit_id">
            <input type="hidden" name="budget_unit_nilai" id="budget_unit_nilai">
            <input type="hidden" name="budget_unit_bulan" id="budget_unit_bulan">
            <div class="form-group">
              <label>Nilai Budget(Rp)</label>                
                <span id="nilai_budget_unit"></span><br>
              <label>Sisa(Rp)</label><br>     
                <span id="sisa_budget_unit"></span><br>
            </div> 
            <table style="width: 100%;" class="table">    
                <tr class="head_table">
                  <td></td>
                  <td>% <span id="lbl_percent_text_unit"></span></td>
                  <td><input type="hidden" id="total_sub_unit" value="0" /> Rp. <span id="lbl_budget_text_unit"></span></td>

                </tr>                
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">Januari</td>
                  <td><input type="text" class="label_unit_1" name="januari_unit" id="januari_unit" style="width: 20%;" onKeyUp="countPercentageUnit('januari_unit','')" value="0" autocomplete="off" data-urut='1'>%</td>
                  <td><span id="lbl_januari_unit" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">Februari</td>
                  <td><input type="text" class="label_unit_1" name="februari_unit" id="februari_unit" style="width: 20%;" onKeyUp="countPercentageUnit('februari_unit','')" value="0" autocomplete="off" data-urut='1'>%</td>
                  <td><span id="lbl_februari_unit" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">Maret</td>
                  <td><input type="text" class="label_unit_1" name="maret_unit" id="maret_unit" style="width: 20%;" onKeyUp="countPercentageUnit('maret_unit','')" value="0" autocomplete="off" data-urut='1'>%</td>
                  <td><span id="lbl_maret_unit" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">April</td>
                  <td><input type="text" class="label_unit_1" name="april_unit" id="april_unit" style="width: 20%;" onKeyUp="countPercentageUnit('april_unit','')" value="0" autocomplete="off" data-urut='1'>%</td>
                  <td><span id="lbl_april_unit" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">Mei</td>
                  <td><input type="text" class="label_unit_1" name="mei_unit" id="mei_unit" style="width: 20%;" onKeyUp="countPercentageUnit('mei_unit','')" value="0" autocomplete="off" data-urut='1'>%</td>
                  <td><span id="lbl_mei_unit" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">Juni</td>
                  <td><input type="text" class="label_unit_1" name="juni_unit" id="juni_unit" style="width: 20%;" onKeyUp="countPercentageUnit('juni_unit','')" value="0" autocomplete="off" data-urut='1'>%</td>
                  <td><span id="lbl_juni_unit" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">Juli</td>
                  <td><input type="text" class="label_unit_1" name="juli_unit" id="juli_unit" style="width: 20%;" onKeyUp="countPercentageUnit('juli_unit','')" value="0" autocomplete="off" data-urut='1'>%</td>
                  <td><span id="lbl_juli_unit" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">Agustus</td>
                  <td><input type="text" class="label_unit_1" name="agustus_unit" id="agustus_unit" style="width: 20%;" onKeyUp="countPercentageUnit('agustus_unit','')" value="0" autocomplete="off" data-urut='1'>%</td>
                  <td><span id="lbl_agustus_unit" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">September</td>
                  <td><input type="text" class="label_unit_1" name="september_unit" id="september_unit" style="width: 20%;" onKeyUp="countPercentageUnit('september_unit','')" value="0" autocomplete="off" data-urut='1'>%</td>
                  <td><span id="lbl_september_unit" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">Oktober</td>
                  <td><input type="text" class="label_unit_1" name="oktober_unit" id="oktober_unit" style="width: 20%;" onKeyUp="countPercentageUnit('oktober_unit','')" value="0" data-urut='1'>%</td>
                  <td><span id="lbl_oktober_unit" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;" >November</td>
                  <td><input type="text" class="label_unit_1" name="november_unit" id="november_unit" style="width: 20%;" onKeyUp="countPercentageUnit('november_unit','')" value="0" autocomplete="off" data-urut='1'>%</td>
                  <td><span id="lbl_november_unit" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">Desember</td>
                  <td><input type="text" class="label_unit_1" name="desember_unit" id="desember_unit" style="width: 20%;" onKeyUp="countPercentageUnit('desember_unit','')" value="0" autocomplete="off" data-urut='1'>%</td>
                  <td><span id="lbl_desember_unit" data-value="0"></span></td>
                </tr>
                                    
            </table>
          
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Close</button>

        </div>
         <div class="alert alert-warning alert-dismissible">                    
          <h4><i class="icon fa fa-warning"></i> Alert!</h4>
          Harap Input Budget Bulanan dengan percentase.
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <!-- /.content-wrapper -->
@include("master/copyright")

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("budget::app")

<script type="text/javascript">
  console.log(($("#total_budget_bln").val()));
  //$("#label_cash_flow").text($("#total_budget_bln").val());
 
  var co_devcost = parseInt($("#label_cash_flow").text());
  var co_concost = parseInt($("#label_cash_flow_co").text());
  var co_all = co_devcost + co_concost;

  var tot_cf_devcost = parseInt($("#label_cf_carryover_devcost").text()) + parseInt($("#label_cash_flow").text());
  var tot_cf_concost = parseInt($("#label_cf_carryover_concost").text()) + parseInt($("#label_cash_flow_co").text());
  var tot_cf = tot_cf_concost + tot_cf_devcost;

  $("#label_total_co_devcost").text(tot_cf_devcost);
  $("#label_total_co_concost").text(tot_cf_concost);
  $("#label_total_co_all").text(tot_cf);
  $("#label_cash_flow_all").text(co_all); 
  $("#label_cash_flow").number(true);
  $("#label_cash_flow_all").number(true); 
  $("#label_cash_flow_co").number(true);
  $("#label_cf_carryover_devcost").number(true);
  $("#label_cf_carryover_concost").number(true); 
  $("#label_cf_carryover_label_cf_carryover").number(true);
  $("#label_total_co_devcost").number(true);
  $("#label_total_co_concost").number(true);
  $("#label_total_co_all").number(true);

  function setCashOut(id,harga_satuan,nilai,bulan,luas_bangunan){
    $("#budget_unit_id").val(id);
    $("#budget_unit_nilai").val(nilai);
    $("#budget_unit_bulan").val(bulan);

    var volume = parseInt(nilai) * parseInt(luas_bangunan);
    var total_budget = parseInt(volume) * parseInt(harga_satuan); 
    console.log(total_budget);
    $("#nilai_budget_unit").text(total_budget);
    $("#nilai_budget_unit").number(true);
    $("#budget_unit_nilai").attr("data-value",total_budget);

    var request = $.ajax({
      url : "{{ url('/')}}/budget/item-viewconcost",
      dataType : "json",
      data : {
        id : id,
        bulan : $("#budget_unit_bulan").val()
      },
      type : "post"
    });

    request.done(function(data){
      if ( data.status == "0"){
        var percent = parseInt(data.total) / 100 ;
        var subexist = total_budget * percent;
        $("#januari_unit").val(data.array_cashout.januari);
        $("#februari_unit").val(data.array_cashout.februari);
        $("#maret_unit").val(data.array_cashout.maret);
        $("#april_unit").val(data.array_cashout.april);
        $("#mei_unit").val(data.array_cashout.mei);
        $("#juni_unit").val(data.array_cashout.juni);
        $("#juli_unit").val(data.array_cashout.juli);
        $("#agustus_unit").val(data.array_cashout.agustus);
        $("#september_unit").val(data.array_cashout.september);
        $("#oktober_unit").val(data.array_cashout.oktober);
        $("#november_unit").val(data.array_cashout.november);
        $("#desember_unit").val(data.array_cashout.desember);
        $("#lbl_percent_text_unit").text(data.total);
        $("#lbl_budget_text_unit").text(subexist);
        $("#lbl_budget_text_unit").number(true);

        
      }else{
        $("#januari_unit").val(0);
        $("#februari_unit").val(0);
        $("#maret_unit").val(0);
        $("#april_unit").val(0);
        $("#mei_unit").val(0);
        $("#juni_unit").val(0);
        $("#juli_unit").val(0);
        $("#agustus_unit").val(0);
        $("#september_unit").val(0);
        $("#oktober_unit").val(0);
        $("#november_unit").val(0);
        $("#desember_unit").val(0);
        $("#lbl_percent_text_unit").text(0);
        $("#lbl_budget_text_unit").text(0);

        $("#lbl_januari_unit").text(0);
        $("#lbl_februari_unit").text(0);
        $("#lbl_maret_unit").text(0);
        $("#lbl_april_unit").text(0);
        $("#lbl_mei_unit").text(0);
        $("#lbl_juni_unit").text(0);
        $("#lbl_juli_unit").text(0);
        $("#lbl_agustus_unit").text(0);
        $("#lbl_september_unit").text(0);
        $("#lbl_oktober_unit").text(0);
        $("#lbl_november_unit").text(0);
        $("#lbl_desember_unit").text(0);
        $("#sisa_budget_unit").text("");
      }
    });

    

  }

  function countPercentageUnit(bln,co){
    //console.log(bln);
    var percent = parseInt($("#"+bln).val());
    var sub2 = parseInt($("#budget_unit_nilai").attr("data-value"));
    var sub = percent * ( parseInt(sub2)) / 100;
    var total = parseInt($("#total_sub_unit").val());
    console.log(percent,sub2,sub,total);

    /*if ( total > sub2 ){
      alert("Persentase Budget Bulanan sudah 100 %");
      $("#btn_save_bln").hide();
      
    }else{
      
    }*/

      if ( sub != "NaN"){    
        $("#lbl_"+bln+"").text(sub);
        $("#lbl_"+bln+"").attr("data-value",sub);
        $("#lbl_"+bln+"").number(true); 
        $("#sisa_budget_unit").text(sub2 - total);   
        $("#sisa_budget_unit").number(true);   
      }
    
      $("#total_sub_unit").val( parseInt($("#lbl_januari_unit").attr("data-value")) + parseInt($("#lbl_februari_unit").attr("data-value")) + parseInt($("#lbl_maret_unit").attr("data-value")) + parseInt($("#lbl_april_unit").attr("data-value")) + parseInt($("#lbl_mei_unit").attr("data-value")) + parseInt($("#lbl_juni_unit").attr("data-value")) + parseInt($("#lbl_juli_unit").attr("data-value")) + parseInt($("#lbl_agustus_unit").attr("data-value")) + parseInt($("#lbl_september_unit").attr("data-value")) + parseInt($("#lbl_oktober_unit").attr("data-value")) + parseInt($("#lbl_november_unit").attr("data-value")) + parseInt($("#lbl_desember_unit").attr("data-value")) );
      $("#lbl_budget_text_unit").text($("#total_sub_unit").val());
      $("#lbl_budget_text_unit").number(true);

      var totals = ( parseInt($("#januari_unit").val()) + parseInt($("#februari_unit").val()) + parseInt($("#maret_unit").val()) + parseInt($("#april_unit").val()) + parseInt($("#mei_unit").val()) + parseInt($("#juni_unit").val()) + parseInt($("#juli_unit").val()) + parseInt($("#agustus_unit").val()) + parseInt($("#september_unit").val()) + parseInt($("#oktober_unit").val()) + parseInt($("#november_unit").val()) + parseInt($("#desember_unit").val()) );
      //console.log(totals);
      if ( totals != "NaN"){
        $("#lbl_percent_text_unit").text(totals);
      }

      if ( parseInt($("#lbl_percent_text_unit").text()) > 100 ){
        alert("Persentase Budget Bulanan sudah 100 %");
        $("#btn_save_bln_unit").attr("style","display:none");
        $("#lbl_percent_text_unit").text(parseInt(totals) - $("#" + bln).val());
        $("#" + bln).val("0");
      }else{
        $("#btn_save_bln_unit").show();
      }


  }

  function removeco(id){
    if ( confirm("Apakah anda yakin ingin menghapus data ini ")){
      var request = $.ajax({
        url : "{{ url('/')}}/budget/cashflow/removeco",
        dataType : "json",
        data : {
          id : id
        },
        type : "post"
      });

      request.done(function(data){
        if ( data.status == "0"){
          alert("Data telah dihapus");
        }
        window.location.reload();
      });
    }else{
      return false;
    }
  }

  function removecoco(id){
    if ( confirm("Apakah anda yakin ingin menghapus data ini ")){
      var request = $.ajax({
        url : "{{ url('/')}}/budget/cashflow/removecoco",
        dataType : "json",
        data : {
          id : id
        },
        type : "post"
      });

      request.done(function(data){
        if ( data.status == "0"){
          alert("Data telah dihapus");
        }
        window.location.reload();
      });
    }else{
      return false;
    }
  }

</script>
</body>
</html>
