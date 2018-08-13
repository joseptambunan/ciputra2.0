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
                  @foreach ( $budget->project->pt_user as $key => $value )
                    @foreach ( $value->pt->mapping as $key2 => $value2 )
                      @if ( $value2->pt->id == $budget->pt_id)
                        <option value="{{ $value2->department->id }}" selected>{{ $value2->pt->name }}</option>
                      @else
                        <option value="{{ $value2->department->id }}">{{ $value2->pt->name }}</option>
                      @endif
                    @endforeach
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Department</label>
                <select class="form-control" name="department">
                  @foreach ( $budget->project->pt_user as $key => $value )
                    @foreach ( $value->pt->mapping as $key2 => $value2 )
                       @if ( $value2->department->id == $budget->department_id)
                          <option value="{{ $value2->department->id }}" selected>{{ $value2->department->name }}</option>
                       @else
                          <option value="{{ $value2->department->id }}">{{ $value2->department->name }}</option>
                       @endif
                    @endforeach
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
                    <option value="{{ $value2->id }}">{{ $value2->name }}</option>
                    @endforeach 
                  </select>
                @endif
               
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Start Date</label>
                <input type="text" class="form-control" name="start_date" id="start_date" value="{{ $budget->start_date }}">
              </div>
              <div class="form-group">
                <label>End Date</label>
                <input type="text" class="form-control" name="end_date" id="end_date" value="{{ $budget->end_date }}">
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
              </div>
              </form>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-12">
              <h3>Nilai : Rp. {{ number_format($budget->nilai)}}</h3>
              <br>
              <div class="col-m-6">
                @if ( $budget->approval == "" )
                <a class="btn btn-primary" href="{{ url('/')}}/budget/item-budget?id={{ $budget->id }}">Tambah Item Pekerjaan</a>
                @endif
                <select id="budget_coa_id">
                  <option value="">(pilih coa )</option>
                  @foreach ( $budget->parent_ids as $key => $value )
                    @if ( count(\Modules\Pekerjaan\Entities\Itempekerjaan::where("code",$value)->get()) > 0 )
                      @php $item = \Modules\Pekerjaan\Entities\Itempekerjaan::where("code",$value)->first(); @endphp;
                      <option value="{{ $item->id or '' }}">{{ $item->name or '' }}</option>
                      @if ( count($item->child_item) > 0 )
                        @foreach ( $item->child_item as $key2 => $value2 )
                          <option value="{{ $value2->id or '' }}">++ {{ $value2->name or '' }}</option>
                        @endforeach
                      @endif
                    @endif
                  @endforeach
                </select>
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
                            <tr class="item item_id_{{ $value3->id }}">
                              <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ $value3->code }}</td>
                              <td>{{ $value3->name }}</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            @if ( count($value3->child_item) > 0 )
                              @foreach ( $value3->child_item as $key4 => $value4 )
                                @if (count(Modules\Budget\Entities\BudgetDetail::where("itempekerjaan_id",$value4->id)->where("budget_id",$budget->id)->get()) > 0 )
                                @php $budgets = Modules\Budget\Entities\BudgetDetail::where("itempekerjaan_id",$value4->id)->where("budget_id",$budget->id)->first() @endphp
                                <tr class="item item_id_{{ $value4->id }}">
                                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $value4->code }}</td>
                                  <td>{{ $value4->name }}</td>
                                  <td>
                                    <span id="label_volume_{{ $value4->id }}">{{ number_format($budgets->volume) }}</span>
                                    <input type="text" name="item_id_{{ $value4->id }}" id="item_id_{{ $value4->id }}" style="display: none;" class="form-control" value="{{ $budget->id }}">
                                    <input type="text" name="volume_{{ $value4->id }}" id="volume_{{ $value4->id }}" style="display: none;" class="form-control" value="{{ $budget->volume }}">
                                  </td>
                                  <td>
                                    <span id="label_satuan_{{ $value4->id }}">{{ $budgets->satuan }}</span>
                                    <input type="text" name="satuan_{{ $value4->id }}" id="satuan_{{ $value4->id }}" style="display: none;" class="form-control" value="{{ $budget->satuan }}">
                                  </td>
                                  <td>
                                    <span id="label_nilai{{ $value4->id }}">{{ number_format($budgets->nilai) }}</span>
                                    <input type="text" name="nilai_{{ $value4->id }}" id="nilai_{{ $value4->id }}" style="display: none;" class="form-control" value="{{ $budget->nilai }}">
                                  </td>
                                  <td>{{ number_format($budgets->nilai * $budgets->volume) }}</td>
                                  <td>
                                    <button class="btn btn-warning" id="btn_edit1_{{ $value4->id }}" onclick="editview('{{ $value4->id }}');">Edit</button>
                                    <button class="btn btn-success" id="btn_edit2_{{ $value4->id }}" onclick="saveedit('{{ $value4->id }}');" style="display: none;">Edit</button>
                                    <button class="btn btn-danger" id="btn_remove_{{ $value4->id }}" onclick="removeedit('{{ $value4->id }}');">Delete</button>
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
