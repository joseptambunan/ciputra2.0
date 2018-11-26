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
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <a href="{{ url('/')}}/budget/cashflow/?id={{ $budget_tahunan->budget->id}}" class="btn btn-warning">Kembali</a>
                  @if ( $budget_tahunan->approval != "" )
                  <a class="btn btn-info" href="{{ url('/')}}/budget/cashflow/approval?id={{$budget_tahunan->id}}">Lihat History Approval</a><br>
                  @endif
                </div>      
             
            </div>
            <div class="col-md-6">

                <div class="form-group">
                  <label>Nilai(Rp)</label>
                  <input type="text" class="form-control" value="{{ number_format($budget->nilai) }}" readonly>
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
                    <td style="text-align: right;">Rp. {{ number_format($co_devcost = $budget_tahunan->nilai_carry_over_dev_cost)}}</td>
                    <td style="text-align: right;">Rp. {{ number_format($co_concost = $budget_tahunan->nilai_carry_over_con_cost)}}</td>
                    <td style="text-align: right;">Rp. {{ number_format($co_concost + $co_devcost) }}</td>
                  </tr>
                  <tr>
                    <td> Budget SPK Tahun Berjalan </td>
                    <td style="text-align: right;"> Rp. {{ number_format($budget_tahunan->total_dev_cost)}}</td>
                    <td style="text-align: right;"> Rp. {{ number_format($budget_tahunan->total_con_cost)}}</td>
                    <td style="text-align: right;"> Rp. {{ number_format($budget_tahunan->total_dev_cost + $budget_tahunan->total_con_cost) }}</td>
                  </tr>
                  <tr style="background-color: grey;color:white;font-weight: bolder;">
                    <td colspan="3" style="text-align: right">Total SPK + CO </td>
                    <td style="text-align: right;;color:white;font-weight: bolder;"> Rp. {{ number_format($budget_tahunan->nilai)}}</td>
                  </tr>
                  <tr style="background-color: grey;color:white;font-weight: bolder;">
                    <td colspan="3" style="text-align: right">Total Cash Flow Budget SPK DevCost Tahun Berjalan</td>
                    <td style="text-align: right;;color:white;font-weight: bolder;">Rp. <span id="label_cash_flow_spk">Rp. {{ number_format($budget_tahunan->nilai_carry_over_dev_cost)}}</span></td>
                  </tr>
                  <tr style="background-color: grey;color:white;font-weight: bolder;">
                    <td colspan="3" style="text-align: right">Total Cash Flow Budget SPK ConCost Tahun Berjalan</td>
                    <td style="text-align: right;;color:white;font-weight: bolder;">Rp. <span id="label_cash_flow_spk">Rp. {{ number_format($budget_tahunan->nilai_carry_over_con_cost)}}</span></td>
                  </tr>
                  <tr style="background-color: grey;color:white;font-weight: bolder;">
                    <td colspan="3" style="text-align: right">Total Cash Flow Carry Over</td>
                    <td style="text-align: right;;color:white;font-weight: bolder;"> Rp. {{ number_format($budget_tahunan->nilai_carry_over)}}</td>
                  </tr>
                  <tr style="background-color: grey;color:white;font-weight: bolder;">
                    <td colspan="3" style="text-align: right">Total Cash Flow</td>
                    <td style="text-align: right;;color:white;font-weight: bolder;"> Rp. <span id="label_cash_flow"></span></td>
                  </tr>
                </tbody>
              </table>
              
              <div class="nav-tabs-custom">
              
              <ul class="nav nav-tabs">                
                <li class="active"><a href="#tab_1" data-toggle="tab">Item Pekerjaan</a></li>
                <li><a href="#tab_2" data-toggle="tab">Cash Flow</a></li>
                <li><a href="#tab_3" data-toggle="tab">Budget Carry Over</a></li>
                <li><a href="#tab_4" data-toggle="tab">Cash Flow Carry Over</a></li>
                @if ( $budget_tahunan->budget->kawasan != "" )
                <li><a href="#tab_5" data-toggle="tab">Budget Pengembangan Unit</a></li>
                <li><a href="#tab_6" data-toggle="tab">Cash Flow Budget Pengembangan Unit</a></li>
                @endif
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
                                @if ( $budget_tahunan->approval->approval_action_id != 6 )
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
                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
                    Tambah Data
                  </button><br>
                  <table  class="table table-responsive table-bordered" style="padding: 0">
                    <thead class="head_table">
                      <tr>
                        <td>COA</td>
                        <td>Item Pekerjaan</td>
                        <td>Total Budget SPK(Rp)</td>
                        <td>Total Cash Flow(Rp)</td>
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
                              <td>{{ number_format( (($value2->januari/100) * $spk ) + ( ($value2->februari/100) * $spk ) + ( ($value2->maret/100) * $spk ) + ( ($value2->april/100) * $spk ) + (($value2->mei/100) * $spk ) + ( ($value2->juni/100) * $spk ) + ( ($value2->juli/100) * $spk ) + ( ($value2->agustus/100) * $spk ) + ( ($value2->september/100) * $spk ) + ( ($value2->oktober/100) * $spk ) + ( ($value2->november/100) * $spk ) + ( ($value2->desember/100) * $spk ) ) }}</td>
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
                                <button class="btn btn-warning" id="btn_edit1_{{ $value2->id }}" onclick="viewedit('{{ $value2->id }}')">Edit</button>
                                <button class="btn btn-success" id="btn_edit2_{{ $value2->id }}" onclick="saveedit('{{ $value2->id }}')" style="display: none;">Edit</button>
                                <button class="btn btn-danger" onclick="removeedit('{{ $value2->id }}')">Delete</button>
                              </td>
                            </tr>
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
                  <h3>Total Carry Over : {{ number_format($carry_over)}}</h3>
                  <form action="{{ url('/')}}/budget/save-carryover" method="post">
                  <input type="hidden" name="carryover_budget_id" value="{{ $budget_tahunan->id }}">
                  {{ csrf_field() }}
                  <table class="table table-bordered">
                    <thead class="head_table">
                      <tr>
                        <td>COA Pekerjaan</td>
                        <td>Item Pekerjaan</td>
                        <td>No. SPK</td>
                        <td>Nilai SPK</td>
                        <td>Terbayar</td>
                        <td>Sisa Terbayar</td>
                        <td>Set to Carry Over</td>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ( $array_cashflow as $key4 => $value4 )
                      <tr>
                        <td>{{ $value4['coa']}}</td>
                        <td>{{ $value4['pekerjaan']}}</td>
                        <td>{{ $value4['nospk']}}</td>
                        <td>{{ number_format($value4['nilaispk'])}}</td>
                        <td>{{ number_format($value4['bap'])}}</td>
                        <td>{{ number_format($value4['sisa'])}}</td>
                        <td>
                          <a href="{{ url('/') }}/spk/detail?id={{ $value4['id']}}" target="_blank" class="btn btn-info">Detail SPK</a> 
                          @if ( count(\Modules\Budget\Entities\BudgetCarryOver::where("spk_id",$value4['id'])->get()) > 0 )
                          @php
                            $id = \Modules\Budget\Entities\BudgetCarryOver::where("spk_id",$value4['id'])->get()->first();
                          @endphp
                          <button onclick="removecarry('{{ $id->id}}')" class="btn btn-danger">Delete</button>
                          @else
                          <input type="checkbox" name="settospk[{{$key4}}]" value="{{ $value4['id']}}" value="{{ $value4['id'] }}">
                          @endif
                          
                        </td>
                      @endforeach
                    </tbody>
                  </table>
                  @if ( count($array_cashflow) > 0  )
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  @endif
                </form>
                </div>

                <div class="tab-pane table-responsive" id="tab_4">
                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info-co">
                    Tambah Data
                  </button><br>
                  <center><h4>Cash Flow Carry Over</h4></center>
                  <h3>Total Carry Over : {{ number_format($budget_tahunan->nilai_carry_over)}}</h3>
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
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ( $budget_tahunan->carry_over as $key => $value )
                        @foreach ( $value->cash_flows as $key1 => $value1 )
                        <tr>
                          <td data-value="{{ $value->spk->id }}">{{ $value->spk->no or '' }}</td>
                          <td>{{ number_format($value->spk->nilai,2)}}</td>
                          <td>{{ number_format($value->spk->baps->sum("nilai_bap_2"),2) }}</td>
                          <td>{{ number_format( $sisa = $value->spk->nilai - $value->spk->baps->sum("nilai_bap_2"),2) }}</td>
                          <td>{{ number_format( $sisa * ( $value1->total / 100 ) ,2) }}</td>
                          <td>{{ number_format( $sisa * ( $value1->januari / 100 ) ,2) }}</td>
                          <td>{{ number_format( $sisa * ( $value1->februari / 100 ) ,2) }}</td>
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
                        </tr>
                        @endforeach
                      @endforeach
                    </tbody>
                  </table>
                </div>

                <div class="tab-pane table-responsive" id="tab_5">
                  <a type="button" class="btn btn-info" href="{{ url('/')}}/budget/budget_tahunan/cashflow-concost?id={{ $budget_tahunan->id }}">
                    Tambah Data
                  </a><br>
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
                          @if ( $value['group_cost'] == 2 )
                          <tr>
                            <td>{{ $value['code']}}</td>
                            <td>{{ $value['itempekerjaan']}}</td>
                            <td>{{ number_format($value['volume'])}}</td>
                            <td>{{ $value['satuan']}}</td>
                            <td>{{ number_format($value['nilai'])}}</td>
                            <td>{{ number_format($value['nilai'] * $value['volume'])}}</td>
                            <td>
                              @if ( $budget_tahunan->approval != "" )
                                @if ( $budget_tahunan->approval->approval_action_id != 6 )
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
                    </tbody>
                  </table>
                </div>

                <div class="tab-pane table-responsive" id="tab_6">
                  <h4>Cash Flow Pengembangan Unit</h4>
                  <table class="table table-bordered">
                    <thead class="head_table">
                      <tr>
                        <td>Unit Type</td>
                        <td>Total Unit</td>
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
                      @if ( $budget_tahunan->budget->kawasan != "" )
                        @foreach ( $budget_tahunan->budget_unit as $key => $value )
                          @foreach ( $value->details as $key2 => $value2 )
                            <tr>
                              <td>{{ $value->unit_type->name }}</td>
                              <td>{{ $value->total_unit }}</td>
                              <td>{{ number_format($value2->januari) }}</td>
                              <td>{{ number_format($value2->februari) }}</td>
                              <td>{{ number_format($value2->maret) }}</td>
                              <td>{{ number_format($value2->april) }}</td>
                              <td>{{ number_format($value2->mei) }}</td>
                              <td>{{ number_format($value2->juni) }}</td>
                              <td>{{ number_format($value2->juli) }}</td>
                              <td>{{ number_format($value2->agustus) }}</td>
                              <td>{{ number_format($value2->september) }}</td>
                              <td>{{ number_format($value2->oktober) }}</td>
                              <td>{{ number_format($value2->november) }}</td>
                              <td>{{ number_format($value2->desember) }}</td>
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
          <h4 class="modal-title">Info Modal</h4>
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
                  @if ( $value2->volume > 0 && $value2->nilai > 0 )
                  <option value="{{ $value2->itempekerjaans->id }}">{{ $value2->itempekerjaans->code }} - {{ $value2->itempekerjaans->name }}</option>
                  @endif
                @endforeach
              </select>
            </div> 
            <div class="form-group">
              <label>Nilai Budget(Rp)</label>
                @foreach ( $budget_tahunan->details as $key2 => $value2 )
                  @if ( $value2->volume > 0 && $value2->nilai > 0 )
                    <span style="display: none;" class="label_budget" id="label_budget_{{ $value2->itempekerjaans->id }}" data-value="{{ $value2->nilai * $value2->volume }}"><br>
                    <strong>{{ number_format( $value2->nilai * $value2->volume ,2)}}</strong>
                    </span>
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
                  <td><input type="text" name="januari" id="januari" style="width: 20%;" onKeyUp="countPercentage('januari')" value="0" autocomplete="off">%</td>
                  <td><span id="lbl_januari" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">Februari</td>
                  <td><input type="text" name="februari" id="februari" style="width: 20%;" onKeyUp="countPercentage('februari')" value="0" autocomplete="off">%</td>
                  <td><span id="lbl_februari" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">Maret</td>
                  <td><input type="text" name="maret" id="maret" style="width: 20%;" onKeyUp="countPercentage('maret')" value="0" autocomplete="off">%</td>
                  <td><span id="lbl_maret" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">April</td>
                  <td><input type="text" name="april" id="april" style="width: 20%;" onKeyUp="countPercentage('april')" value="0" autocomplete="off">%</td>
                  <td><span id="lbl_april" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">Mei</td>
                  <td><input type="text" name="mei" id="mei" style="width: 20%;" onKeyUp="countPercentage('mei')" value="0" autocomplete="off">%</td>
                  <td><span id="lbl_mei" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">Juni</td>
                  <td><input type="text" name="juni" id="juni" style="width: 20%;" onKeyUp="countPercentage('juni')" value="0" autocomplete="off">%</td>
                  <td><span id="lbl_juni" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">Juli</td>
                  <td><input type="text" name="juli" id="juli" style="width: 20%;" onKeyUp="countPercentage('juli')" value="0" autocomplete="off">%</td>
                  <td><span id="lbl_juli" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">Agustus</td>
                  <td><input type="text" name="agustus" id="agustus" style="width: 20%;" onKeyUp="countPercentage('agustus')" value="0" autocomplete="off">%</td>
                  <td><span id="lbl_agustus" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">September</td>
                  <td><input type="text" name="september" id="september" style="width: 20%;" onKeyUp="countPercentage('september')" value="0" autocomplete="off">%</td>
                  <td><span id="lbl_september" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">Oktober</td>
                  <td><input type="text" name="oktober" id="oktober" style="width: 20%;" onKeyUp="countPercentage('oktober')" value="0">%</td>
                  <td><span id="lbl_oktober" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;" >November</td>
                  <td><input type="text" name="november" id="november" style="width: 20%;" onKeyUp="countPercentage('november')" value="0" autocomplete="off">%</td>
                  <td><span id="lbl_november" data-value="0"></span></td>
                </tr>
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder;">Desember</td>
                  <td><input type="text" name="desember" id="desember" style="width: 20%;" onKeyUp="countPercentage('desember')" value="0" autocomplete="off">%</td>
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
          <h4 class="modal-title">Info Modal</h4>
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
                  <option value="{{ $value4->id}}">{{ $value4->spk->no }} / {{ $value4->spk->itempekerjaan->name }}</option>
                @endforeach
              </select>
            </div> 
            <div class="form-group">
              <label>Nilai Budget(Rp)</label>     
              @foreach ( $budget_tahunan->carry_over as $key4 => $value4 )
                @if ( $value4->spk != "")
                  <span style="display: none;" class="label_budget_co" id="label_budget_co_{{$value4->id}}" data-value="{{ $value4->spk->nilai - ( $value4->spk->nilai_bap * $value4->spk->nilai ) }} "><br>
                  <strong>{{ number_format($value4->spk->nilai - ( $value4->spk->nilai_bap * $value4->spk->nilai )) }}</strong>
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
                <td><input type="text" name="januari_co" id="januari_co" style="width: 20%;" onKeyUp="countPercentage('januari_co')" value="0" autocomplete="off">%</td>
                <td><span id="lbl_januari_co" data-value="0"></span></td>
              </tr>
              <tr>
                <td style="background-color: grey;color:white;font-weight: bolder;">Februari</td>
                <td><input type="text" name="februari_co" id="februari_co" style="width: 20%;" onKeyUp="countPercentage('februari_co')" value="0" autocomplete="off">%</td>
                <td><span id="lbl_februari_co" data-value="0"></span></td>
              </tr>
              <tr>
                <td style="background-color: grey;color:white;font-weight: bolder;">Maret</td>
                <td><input type="text" name="maret_co" id="maret_co" style="width: 20%;" onKeyUp="countPercentage('maret_co')" value="0" autocomplete="off">%</td>
                <td><span id="lbl_maret_co" data-value="0"></span></td>
              </tr>
              <tr>
                <td style="background-color: grey;color:white;font-weight: bolder;">April</td>
                <td><input type="text" name="april_co" id="april_co" style="width: 20%;" onKeyUp="countPercentage('april_co')" value="0" autocomplete="off">%</td>
                <td><span id="lbl_april_co" data-value="0"></span></td>
              </tr>
              <tr>
                <td style="background-color: grey;color:white;font-weight: bolder;">Mei</td>
                <td><input type="text" name="mei_co" id="mei_co" style="width: 20%;" onKeyUp="countPercentage('mei_co')" value="0" autocomplete="off">%</td>
                <td><span id="lbl_mei_co" data-value="0"></span></td>
              </tr>
              <tr>
                <td style="background-color: grey;color:white;font-weight: bolder;">Juni</td>
                <td><input type="text" name="juni_co" id="juni_co" style="width: 20%;" onKeyUp="countPercentage('juni_co')" value="0" autocomplete="off">%</td>
                <td><span id="lbl_juni_co" data-value="0"></span></td>
              </tr>
              <tr>
                <td style="background-color: grey;color:white;font-weight: bolder;">Juli</td>
                <td><input type="text" name="juli_co" id="juli_co" style="width: 20%;" onKeyUp="countPercentage('juli_co')" value="0" autocomplete="off">%</td>
                <td><span id="lbl_juli_co" data-value="0"></span></td>
              </tr>
              <tr>
                <td style="background-color: grey;color:white;font-weight: bolder;">Agustus</td>
                <td><input type="text" name="agustus_co" id="agustus_co" style="width: 20%;" onKeyUp="countPercentage('agustus_co')" value="0" autocomplete="off">%</td>
                <td><span id="lbl_agustus_co" data-value="0"></span></td>
              </tr>
              <tr>
                <td style="background-color: grey;color:white;font-weight: bolder;">September</td>
                <td><input type="text" name="september_co" id="september_co" style="width: 20%;" onKeyUp="countPercentage('september_co')" value="0" autocomplete="off">%</td>
                <td><span id="lbl_september_co" data-value="0"></span></td>
              </tr>
              <tr>
                <td style="background-color: grey;color:white;font-weight: bolder;">Oktober</td>
                <td><input type="text" name="oktober_co" id="oktober_co" style="width: 20%;" onKeyUp="countPercentage('oktober_co')" value="0">%</td>
                <td><span id="lbl_oktober_co" data-value="0"></span></td>
              </tr>
              <tr>
                <td style="background-color: grey;color:white;font-weight: bolder;" >November</td>
                <td><input type="text" name="november_co" id="november_co" style="width: 20%;" onKeyUp="countPercentage('november_co')" value="0" autocomplete="off">%</td>
                <td><span id="lbl_november_co" data-value="0"></span></td>
              </tr>
              <tr>
                <td style="background-color: grey;color:white;font-weight: bolder;">Desember</td>
                <td><input type="text" name="desember_co" id="desember_co" style="width: 20%;" onKeyUp="countPercentage('desember_co')" value="0" autocomplete="off">%</td>
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
  
</script>
</body>
</html>
