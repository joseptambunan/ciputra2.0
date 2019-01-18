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
                      <td style="text-align: right;">Rp. <span id="label_cf_carryover_devcost">{{ ($co_devcost = $budget_tahunan->carry_nilai)}}</span></td>
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
                  <h3>Total Carry Over : {{ number_format($budget_tahunan->carry_nilai)}}</h3>
                  {{ csrf_field() }}
                  <table class="table table-bordered">
                    <thead class="header_1">
                      <tr>
                        <td>COA Pekerjaan</td>
                        <td>Item Pekerjaan</td>
                        <td>No. SPK</td>
                        <td>Nilai SPK</td>
                        <td>Terbayar</td>
                        <td>Rencana Terbayar</td>
                        <td>Nilai Carry Over Berikutnya</td>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ( $budget_tahunan->carry_over as $key4 => $value4 )
                      <tr>
                        <td>{{ $value4->spk->itempekerjaan->code }}</td>
                        <td>{{ $value4->spk->itempekerjaan->name }}</td>
                        <td>{{ $value4->spk->no}}</td>
                        <td>{{ number_format($value4->spk->nilai) }}</td>
                        <td>{{ number_format($value4->spk->nilai_bap)}}</td>
                        <td>{{ number_format( $value4->nilai_rencana)}}</td>
                        <td>{{ number_format(($value4->spk->nilai - $value4->spk->nilai_bap) - $value4->nilai_rencana)}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  
                </div>

                <div class="tab-pane table-responsive" id="tab_4">
                  
                  <center><h4>Cash Flow Carry Over</h4></center>
                  <h3>Total Carry Over : {{ number_format($budget_tahunan->carry_nilai)}}</h3>
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
   $("#label_cash_flow").text($("#total_budget_bln").val());
 
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
    var description = $("#description_2").val();
    alert(description);
    if ( description == "" && $("#btn_save_budgets").attr("data-value") == "7"){
      alert("Silahkan isi keterangan terlebih dahulu");
      return false;
    }
    var request = $.ajax({
      url : "{{ url('/') }}/access/budget_tahunan/approval",
      data: {
          user_id : $("#user_id").val(),
          budget_id :$("#budget_tahunan_id").val(),
          status : $("#btn_save_budgets").attr("data-value"),
          description : $("#description_2").val()
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
          <textarea name="description" id="description_2" cols="30" rows="5"></textarea>
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
