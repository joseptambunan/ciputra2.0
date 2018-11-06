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
            <div class="col-md-12"><h3 class="box-title">Detail Data Budget Proyek</h3></div>
            <div class="col-md-6">             
              
              <form action="{{ url('/')}}/budget/update-budget" method="post" name="form1">
              {{ csrf_field() }}
              <input type="hidden" name="project_id" id="project_id" value="{{ $budget->project->id }}">
              <input type="hidden" name="budget_id" id="budget_id" value="{{ $budget->id }}">
              <div class="form-group">
                <label>Project</label>
                <input type="text" class="form-control" value="{{ $budget->project->name }}" readonly>
              </div>
              <div class="form-group">
                <label>PT</label>
                <select class="form-control" name="department">
                  @foreach ( $budget->project->pt as $key => $value )
                      @if ( $value->pt->id == $budget->pt_id)
                        <option value="{{ $value->pt->id }}" selected>{{ $value->pt->name }}</option>
                      @else
                        <option value="{{ $value->pt->id }}">{{ $value->pt->name }}</option>
                      @endif
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Department</label>
                <select class="form-control" name="department">
                  @foreach ( $department as $key => $value )
                     @if ( $value->id == $budget->department_id)
                        <option value="{{ $value->id }}" selected>{{ $value->name }}</option>
                     @else
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                     @endif
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Kawasan</label>
                @if ( $budget->project_kawasan_id == "" )
                  <input type="checkbox" name="iskawasan" id="iskawasan" onClick="setkawasan();">
                  <select class="form-control" name="kawasan" id="kawasan" style="display: none;" >
                    @foreach ( $budget->project->kawasans as $key2 => $value2 )                    
                    <option value="{{ $value2->id }}">{{ $value2->name }}</option>
                    @endforeach 
                  </select>
                @else
                  <input type="checkbox" name="iskawasan" id="iskawasan" onClick="setkawasan();" checked>
                  <select class="form-control" name="kawasan" id="kawasan">
                    @foreach ( $budget->project->kawasans as $key2 => $value2 )
                    @if ( $value2->id == $budget->project_kawasan_id )
                    <option value="{{ $value2->id }}" selected>{{ $value2->name }}</option>
                    @else                    
                    <option value="{{ $value2->id }}">{{ $value2->name }}</option>
                    @endif
                    @endforeach 
                  </select>
                @endif
               
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Start Date</label>
                <input type="text" class="form-control" name="start_date" id="start_date" value="{{ $budget->start_date->format('d/m/Y') }}">
              </div>
              <div class="form-group">
                <label>End Date</label>
                <input type="text" class="form-control" name="end_date" id="end_date" value="{{ $budget->end_date->format('d/m/Y') }}">
              </div>
              <div class="form-group">
                <label>Keterangan Date</label>
                <input type="text" class="form-control" name="description" value="{{ $budget->description }}">
              </div>
              <div class="box-footer">
                @if ( $budget->approval == "" )
                <button type="submit" class="btn btn-primary">Simpan</button>                
                @endif
                <a class="btn btn-warning" href="{{ url('/')}}/budget/proyek/">Kembali</a>
                @if ( $budget->draft != "")
                <a href="{{ url('/')}}/budget/draft?id={{ $budget->id }}" class="btn btn-primary">Draft Budget Tambahan</a>
                @endif

                @if ( $budget->approval != "")
                <a href="{{ url('/')}}/budget/approval?id={{ $budget->id }}" class="btn btn-info">Approval History</a>
                @endif
              </div>
              </form>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-12">
              <h3>Nilai Dev Cost : Rp. {{ number_format($budget->total_dev_cost)}}</h3>
              <h3>Nilai Con Cost : Rp. {{ number_format($budget->total_con_cost)}}</h3>
              <h3>Nilai Budget   : Rp. {{ number_format($budget->nilai)}}</h3>
              <br>
              <div class="col-m-6">
                @if ( $budget->approval == "" )
                <a class="btn btn-primary" href="{{ url('/')}}/budget/item-budget?id={{ $budget->id }}">Tambah Item Pekerjaan</a>
                @else
                   @if ( $budget->approval->approval_action_id == "7" )
                      <a class="btn btn-primary" href="{{ url('/')}}/budget/item-budget?id={{ $budget->id }}">Tambah Item Pekerjaan</a>
                   @endif
                @endif
              </div><br><br>

              <table class="table" style="padding: 0" id="example3">
                <thead class="head_table">
                  <tr>
                    <td>COA</td>
                    <td>Item Pekerjaan</td>
                    <td>Volume</td>
                    <td>Satuan</td>
                    <td>Nilai(Rp)</td>
                    <td>Subtotal(Rp)</td>
                    <td colspan="2">Perubahan Data</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $budget->parent_ids as $key => $value )
                    @if ( count(\Modules\Pekerjaan\Entities\Itempekerjaan::where("code",$value)->get()) > 0 )
                      <tr>
                        <td><strong>{{  \Modules\Pekerjaan\Entities\Itempekerjaan::where("code",$value)->first()->code }}</strong></td>
                        <td><strong>{{  \Modules\Pekerjaan\Entities\Itempekerjaan::where("code",$value)->first()->name }}</strong></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      @php $item_1 = \Modules\Pekerjaan\Entities\Itempekerjaan::where("code",$value)->get(); @endphp
                      @foreach ( $item_1 as $key2 => $value2 )
                        @if ( count($value2->child_item) > 0 )                          
                           @foreach ( $value2->child_item as $key3 => $value3 )
                            @php $budgets = Modules\Budget\Entities\BudgetDetail::where("itempekerjaan_id",$value3->id)->where("budget_id",$budget->id)->first() @endphp

                            @if ( isset($budgets->volume))
                              @if ( $budgets->nilai != "0")
                              <tr class="item item_id_{{ $value3->id }}">
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ $value3->code }}</td>                             
                                <td>{{ $value3->name }}</td>
                                <td>
                                  <span id="label_volume_{{ $value3->id }}">{{ number_format($budgets->volume) }}</span>
                                  <input type="text" name="item_id_{{ $value3->id }}" id="item_id_{{ $value3->id }}" style="display: none;" class="form-control" value="{{ $budgets->id }}">
                                  <input type="hidden" name="item_pekerjaan_id_{{ $value3->id }}" id="item_pekerjaan_id_{{ $value3->id }}" style="display: none;" class="form-control" value="{{ $value3->id }}">
                                  <input type="text" name="volume_{{ $value3->id }}" id="volume_{{ $value3->id }}" style="display: none;" class="form-control" value="{{ $budgets->volume }}">
                                </td>
                                <td>
                                  <span id="label_satuan_{{ $value3->id }}">{{ $budgets->satuan }}</span>
                                  <input type="text" name="satuan_{{ $value3->id }}" id="satuan_{{ $value3->id }}" style="display: none;" class="form-control" value="{{ $budgets->satuan }}">
                                </td>
                                <td>
                                  <span id="label_nilai{{ $value3->id }}">{{ number_format($budgets->nilai) }}</span>
                                  <input type="text" name="nilai_{{ $value3->id }}" id="nilai_{{ $value3->id }}" style="display: none;" class="form-control" value="{{ $budgets->nilai }}">
                                </td>
                                <td>{{ number_format($budgets->nilai * $budgets->volume) }}</td>
                                <td>                                  
                                  @if ( $budget->approval == "")
                                  <a href="{{ url('/')}}/budget/edit-itembudget?id={{ $budget->id}}&item={{ $value3->parent_id }}" class="btn btn-warning">Edit</a>
                                  @else
                                    @if ( $budget->approval->approval_action_id == "7")
                                      <a href="{{ url('/')}}/budget/edit-itembudget?id={{ $budget->id}}&item={{ $value3->parent_id }}" class="btn btn-warning">Edit</a>
                                    @endif
                                  @endif
                                  <!--button class="btn btn-warning" id="btn_edit1_{{ $value3->id }}" onclick="editview('{{ $value3->id }}');">Edit</button>
                                  <button class="btn btn-success" id="btn_edit2_{{ $value3->id }}" onclick="saveedit('{{ $value3->id }}');" style="display: none;">Edit</button>
                                  <button class="btn btn-danger" id="btn_remove_{{ $value3->id }}" onclick="removeedit('{{ $value3->id }}');">Delete</button-->
                                </td>
                                <td>&nbsp;</td>
                              </tr>
                              @endif
                            @endif
                            @if ( count($value3->child_item) > 0 )
                              @foreach ( $value3->child_item as $key4 => $value4 )
                                @if (count(Modules\Budget\Entities\BudgetDetail::where("itempekerjaan_id",$value4->id)->where("budget_id",$budget->id)->get()) > 0 )
                                @php $budgets = Modules\Budget\Entities\BudgetDetail::where("itempekerjaan_id",$value4->id)->where("budget_id",$budget->id)->first() @endphp
                                <tr class="item item_id_{{ $value4->id }}">
                                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $value4->code }}</td>
                                  <td>{{ $value4->name }}</td>
                                  <td>
                                    <span id="label_volume_{{ $value4->id }}">{{ number_format($budgets->volume) }}</span>
                                    <input type="text" name="item_id_{{ $value4->id }}" id="item_id_{{ $budgets->id }}" style="display: none;" class="form-control" value="{{ $budgets->id }}">
                                    <input type="text" name="volume_{{ $value4->id }}" id="volume_{{ $budgets->id }}" style="display: none;" class="form-control" value="{{ $budgets->volume }}">
                                  </td>
                                  <td>
                                    <span id="label_satuan_{{ $value4->id }}">{{ $budgets->satuan }}</span>
                                    <input type="text" name="satuan_{{ $value4->id }}" id="satuan_{{ $value4->id }}" style="display: none;" class="form-control" value="{{ $budget->satuan }}">
                                  </td>
                                  <td>
                                    <span id="label_nilai{{ $value4->id }}">{{ number_format($budgets->nilai) }}</span>
                                    <input type="text" name="nilai_{{ $value4->id }}" id="nilai_{{ $budgets->id }}" style="display: none;" class="form-control" value="{{ $budgets->nilai }}">
                                  </td>
                                  <td>{{ number_format($budgets->nilai * $budgets->volume) }}</td>
                                  <td>
                                    @if ( $budget->approval == "" )
                                    <button class="btn btn-warning" id="btn_edit1_{{ $budgets->id }}" onclick="editview('{{ $budgets->id }}');">Edit</button>
                                    <button class="btn btn-success" id="btn_edit2_{{ $budgets->id }}" onclick="saveedit('{{ $budgets->id }}');" style="display: none;">Edit</button>
                                    <button class="btn btn-danger" id="btn_remove_{{ $value4->id }}" onclick="removeedit('{{ $budgets->id }}');">Delete</button>
                                    @else
                                      @if ( $budget->approval->approval_action_id == "7")
                                      <button class="btn btn-warning" id="btn_edit1_{{ $budgets->id }}" onclick="editview('{{ $budgets->id }}');">Edit</button>
                                      <button class="btn btn-success" id="btn_edit2_{{ $budgets->id }}" onclick="saveedit('{{ $budgets->id }}');" style="display: none;">Edit</button>
                                      <button class="btn btn-danger" id="btn_remove_{{ $budgets->id }}" onclick="removeedit('{{ $budgets->id }}');">Delete</button>
                                      @endif
                                    @endif
                                  </td>
                                  <td>&nbsp;</td>
                                </tr>
                                @endif
                              @endforeach
                            @endif
                           @endforeach 
                        @else 
                          <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ $value2->code }}</td>
                            <td>{{ $value2->name }}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>                  
                        @endif                        
                      @endforeach
                    @endif
                  @endforeach 
                </tbody>
              </table>
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
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("budget::app")

</body>
</html>
