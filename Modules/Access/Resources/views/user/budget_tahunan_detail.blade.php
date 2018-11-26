<!DOCTYPE html>
<html>
@include('user.header')
<body class="hold-transition sidebar-mini">
<div class="wrapper">
 
  <!-- /.navbar -->
  @include('user.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Project <strong>{{ $project->name or '' }}</strong></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/') }}/user/project/?id={{ $project->id or ''}}">Document</a></li>
              <li class="breadcrumb-item active">Budget</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      <a href="{{ url('/') }}/access/" class="btn btn-warning">Back</a>
      @if ( isset($approval->histories) )
        @if ( $approval->histories->where("user_id",$user->id)->where("approval_action_id",1)->count() > 0 )
        <a href="#" class="btn btn-info" onclick="setapproved('6')" data-toggle="modal" data-target="#myModal">Approve</a>
        <a href="#" class="btn btn-danger" onclick="setapproved('7')" data-toggle="modal" data-target="#myModal">Reject</a>
        @elseif ( $approval->histories->where("user_id",$user->id)->where("approval_action_id",6)->count() > 0 )
          <span class="badge badge-success" style="font-size:20px;">Approved</span>
        @elseif ( $approval->histories->where("user_id",$user->id)->where("approval_action_id",7)->count() > 0 )
          <span class="badge badge-danger" style="font-size:20px;">Rejected</span>
        @endif
      @endif
    </section>

    <!-- Main content -->
    <input type="hidden" name="project_id" id="project_id" value="{{ $project->id or ''}}"/>
    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id or ''}}"/>
    <input type="hidden" name="budget_id" id="budget_id" value="{{ $budget->id or ''}}"/>
    <input type="hidden" name="approval_item" id="approval_item" value="{{ $budget->id or ''}}"/>
    <input type="hidden" name="cash_flow_monthly" id="cash_flow_monthly" value="{{ $array_monthly_cf}}"/>
    <input type="hidden" name="budget_unit_monthly" id="budget_unit_monthly" value="{{ $array_monthly_co}}"/>
    <input type="hidden" name="budget_unit_all" id="budget_unit_all" value="{{ $array_monthly_total}}"/>
    <section class="content" style="font-size:17px;">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Data Document</h3>
            
            </div>
            <!-- /.card-header -->
            <div class="card-body  table-responsive">
              <div class="col-md-12 table-responsive">
                <div class="row">
                  <div class="col-md-6">             
                    <form action="{{ url('/')}}/budget/cashflow/update-cashflow" method="post" name="form1">
                      {{ csrf_field() }}
                      <input type="hidden" name="budget_id" id="budget_id" value="{{ $budget_tahunan->budget->id }}">
                      <input type="hidden" name="budget_tahunan_id" id="budget_tahunan_id" value="{{ $budget_tahunan->id }}">
                      <div class="form-group">
                        <label>No. Budget Global</label>
                        <input type="text" class="form-control" value="{{ $budget_tahunan->budget->no }}" disabled>
                      </div>
                      <div class="form-group">
                        <label>No. Budget</label>
                        <input type="text" class="form-control" value="{{ $budget_tahunan->no }}" disabled>
                      </div>
                      <div class="form-group">
                        <label>Project / Kawasan</label>
                        <input type="text" class="form-control" value="{{ $budget_tahunan->budget->project->name }} / {{ $budget_tahunan->budget->kawasan->name or ''}}" disabled>
                      </div>       
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Nilai(Rp)</label>
                        <input type="text" class="form-control" value="{{ number_format($budget_tahunan->nilai) }}" disabled>
                      </div> 
                      <div class="form-group">
                        <label>Tahun Anggaran</label>
                        <input type="text" name="year" class="form-control" value="{{ $budget_tahunan->tahun_anggaran}}" disabled>
                      </div>
                      <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="description" id="description" class="form-control">
                      </div>
                    </div>
                </div>
              </div>
              <div class="col-md-12 table-responsive">
                <table class="table-bordered table">
                  <thead class="header_1">
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
                      <td colspan="3" style="text-align: right">Total SPK + CO YTD</td>
                      <td style="text-align: right;;color:white;font-weight: bolder;"> Rp. {{ number_format($budget_tahunan->nilai)}}</td>
                    </tr>
                    <tr style="background-color: grey;color:white;font-weight: bolder;">
                      <td colspan="3" style="text-align: right">Total Budget Cash Out SPK DevCost YTD</td>
                      <td style="text-align: right;;color:white;font-weight: bolder;">Rp. <span id="label_cash_flow_devcost_spk">{{ number_format(0,2)}}</span></td>
                    </tr>
                    <tr style="background-color: grey;color:white;font-weight: bolder;">
                      <td colspan="3" style="text-align: right">Total Budget Cash Out SPK ConCost YTD</td>
                      <td style="text-align: right;;color:white;font-weight: bolder;">Rp. <span id="label_cash_flow_concost_spk"> {{ number_format(0,2)}}</span></td>
                    </tr>
                    <tr style="background-color: grey;color:white;font-weight: bolder;">
                      <td colspan="3" style="text-align: right">Total Cash Out Carry Over</td>
                      <td style="text-align: right;;color:white;font-weight: bolder;">Rp. <span id="label_cash_flow_co"> {{ number_format($budget_tahunan->nilai_carry_over)}}</span></td>
                    </tr>
                    <tr style="background-color: grey;color:white;font-weight: bolder;">
                      <td colspan="3" style="text-align: right">Total Cash Out</td>
                      <td style="text-align: right;;color:white;font-weight: bolder;"> Rp. <span id="label_cash_flow"></span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-12 table-responsive">
                <div class="card-header d-flex p-0">
                  <ul class="nav nav-tabs">                
                    <li class="nav-item active"><a class="nav-link active" href="#tab_1" data-toggle="tab">Item Pekerjaan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Cash Flow</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Budget Carry Over</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">Cash Flow Carry Over</a></li>
                    @if ( $budget_tahunan->budget->kawasan != "" )
                    <li class="nav-item"><a class="nav-link" href="#tab_5" data-toggle="tab">Budget Pengembangan Unit</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab_6" data-toggle="tab">Cash Flow Budget Pengembangan Unit</a></li>
                    @endif
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane active table-responsive" id="tab_1">
                        
                        <table class="table" style="padding: 0" id="example3">
                          <thead class="header_1">
                            <tr>
                              <td>COA</td>
                              <td>Item Pekerjaan</td>
                              <td>Volume</td>
                              <td>Satuan</td>
                              <td>Harga Satuan(Rp)</td>
                              <td>Subtotal(Rp)</td>
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
 
                        <table  class="table table-responsive table-bordered" style="padding: 0">
                          <thead class="header_1">
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
                            @php $item_bln = 0; $total_cf = 0; @endphp
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
                                    <td>{{ number_format($nilai = (($value2->januari/100) * $spk ) + ( ($value2->februari/100) * $spk ) + ( ($value2->maret/100) * $spk ) + ( ($value2->april/100) * $spk ) + (($value2->mei/100) * $spk ) + ( ($value2->juni/100) * $spk ) + ( ($value2->juli/100) * $spk ) + ( ($value2->agustus/100) * $spk ) + ( ($value2->september/100) * $spk ) + ( ($value2->oktober/100) * $spk ) + ( ($value2->november/100) * $spk ) + ( ($value2->desember/100) * $spk ) ) }}</td>
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
                                  @php $total_cf = $total_cf + $nilai; @endphp
                                  @endforeach
                                @endif
                              @endif
                            @endforeach
        
                          </tbody>
                        </table>
                        <input type="hidden" id="total_budget_bln" value="{{ $item_bln }}">
                        <input type="hidden" id="total_budget_bln_co" value="{{ $budget_tahunan->nilai_carry_over }}">
                        <input type="hidden" id="total_cf_dv" value="{{ $total_cf }}">
                      </div>
                      <!-- /.tab-pane -->
                      <div class="tab-pane table-responsive" id="tab_3">
                        <h3>Total Carry Over : {{ number_format($carry_over)}}</h3>
                        <input type="hidden" name="carryover_budget_id" value="{{ $budget_tahunan->id }}">
                        {{ csrf_field() }}
                        <table class="table table-bordered">
                          <thead class="header_1">
                            <tr>
                              <td>COA Pekerjaan</td>
                              <td>Item Pekerjaan</td>
                              <td>No. SPK</td>
                              <td>Nilai SPK</td>
                              <td>Terbayar</td>
                              <td>Sisa Terbayar</td>
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
                              
                            @endforeach
                          </tbody>
                        </table>
                        @if ( count($array_cashflow) > 0  )
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        @endif

                      </div>

                      <div class="tab-pane table-responsive" id="tab_4">

                        <center><h4>Cash Flow Carry Over</h4></center>
                        <h3>Total Carry Over : {{ number_format($budget_tahunan->nilai_carry_over)}}</h3>
                        <input type="hidden" name="carryover_budget_id" value="{{ $budget_tahunan->id }}">
                        {{ csrf_field() }}
                        <table class="table table-bordered">
                          <thead class="header_1">
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
                          <thead class="header_1">
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
                          <thead class="header_1">
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
              </div>
              <div class="col-md-12 table-responsive">
                <center><h4>Grafik Budget Cash Out</h4></center>
                <div class="col-md-10">
                  <div class="chart">
                    <canvas id="lineChart" ></canvas>
                  </div>
                </div>
                <div class="col-md-8">
                  Keterangan : <br>
                  <table class="table table-bordered">
                    <thead class="header_1">
                      <tr>
                        <td>Keterangan</td>
                        <td>YTD</td>
                        <td>YTD Realiasasi</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><small style="background-color:rgba(60,141,188)">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</small>Total Cash Out Dev Cost</td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td><small style="background-color:rgba(255,51,51)">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</small>Total Cash Out Con Cost</td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td><small style="background-color:rgba(204,204,0)">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</small>Total Cash Flow</td>
                        <td></td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                  
                </div>
              </div>
              <div class="col-md-12 table-responsive">
                <table class="table table-bordered table-striped ">
                  <tr class="header_1">
                    <td>Username</td>
                    <td>Request At</td>
                    <td>Status</td>
                    <td>Time Left (days)</td>
                    <td>Keterangan</td>
                  </tr>
                  @if ( isset($approval->histories))
                  @foreach ( $approval->histories as $key2 => $value2 )
                  <tr>
                    <td>
                      @if ( $value2->approval_action_id == "6")
                      <input type="checkbox" name="approval_id" value="" id="" disabled checked> <strong>{{ $value2->user->user_name or '' }}</strong>
                      @else
                      <input type="checkbox" name="approval_id" value="" id="" disabled>{{ $value2->user->user_name or '' }}
                      @endif
                    </td>
                    <td>{{ $value2->created_at->format("d M Y ") }}</td>
                    <td>
                      @if ( $value2->approval_action_id == "7" )
                      <span class="reject"><strong>Reject</strong></span>
                      @elseif ( $value2->approval_action_id == "6")
                      <span class="approve"><strong>Approve</strong></span>
                      @else
                      <span class="waiting"><strong>Waiting</strong></span>
                      @endif
                    </td>
                    <td>
                      <strong>
                        @php
                        $str = $value2->created_at;
                        $str = strtotime(date("M d Y ")) - (strtotime($str));
                        echo ceil($str/3600/24);
                        @endphp
                      </strong>
                      (days)
                    </td>
                    <td>{{ $value2->description }}</td>
                  </tr>
                  @endforeach
                  @endif
                </table>
              </div>
            </div>
            <!-- /.card-body -->

          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.0-alpha
    </div>
    <strong>Copyright &copy; 2014-2018 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>


</div>
<!-- ./wrapper -->
@include('user.footer')

<script src="{{ url('/')}}/assets/plugins/jquery.number.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $( document ).ready(function() {
    $("#label_cash_flow_devcost_spk").text($("#total_cf_dv").val());
    //$("#label_cash_flow_devcost_spk").number(true,2);
    console.log(parseInt($("#label_cash_flow_devcost_spk").text()) , parseInt($("#label_cash_flow_concost_spk").text()) , parseInt($("#label_cash_flow_co").text()));
    var total_cash_out = parseInt($("#label_cash_flow_devcost_spk").text()) + parseInt($("#label_cash_flow_concost_spk").text()) + parseInt($("#label_cash_flow_co").text());
    $("#label_cash_flow").text(total_cash_out);
  });

  function setapproved(values){

    if ( values == "6" ){
      $("#title_approval").attr("style","color:blue");
      $("#title_approval").text("These budgets will be APPROVED by You");
    }else{
      $("#title_approval").attr("style","color:red");
      $("#title_approval").text("These budgets will be REJECTED by You");
    }
    $("#btn_save_budgets").attr("data-value",values);
    
  }

  function requestApproval(){
    var description = $("#description").val();
    if ( description == "" && $("#btn_save_budgets").attr("data-value") == "7"){
      alert("Silahkan isi keterangan terlebih dahulu");
      return false;
    }
    var request = $.ajax({
      url : "{{ url('/') }}/access/budget/approval/approval_budget_awal",
      data: {
          user_id : $("#user_id").val(),
          budget_id :$("#budget_id").val(),
          status : $("#btn_save_budgets").attr("data-value")
      },
      type :"get",
      dataType :"json"     
    });

    request.done(function(data){
      if ( data.status == "0"){
        window.location.reload();
      }else{
        alert("Error When Saving Approval");
        window.location.reload();
      }
    })
  }
</script>
@include("access::user.chart")
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br>
      </div>
      <div class="modal-body">
        <span id="title_approval"><strong></strong></span>
        <p></p>
        <div id="listdetail">
          <textarea name="description" id="description"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn_save_budgets" data-value="" onclick="requestApproval()">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</body>
</html>
