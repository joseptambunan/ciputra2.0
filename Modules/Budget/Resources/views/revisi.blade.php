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
                <select class="form-control" name="department" readonly>
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
                <select class="form-control" name="department" readonly>
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
                  <select class="form-control" name="kawasan" id="kawasan" style="display: none;" readonly>
                    @foreach ( $budget->project->kawasans as $key2 => $value2 )
                    <option value="{{ $value2->id }}">{{ $value2->name }}</option>
                    @endforeach 
                  </select>
                @else
                  <input type="checkbox" name="iskawasan" id="iskawasan" onClick="setkawasan();" checked>
                  <select class="form-control" name="kawasan" id="kawasan" readonly>
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
                <input type="text" class="form-control" name="start_date" id="start_date" value="{{ $budget->start_date->format('d/m/Y') }}" readonly>
              </div>
              <div class="form-group">
                <label>End Date</label>
                <input type="text" class="form-control" name="end_date" id="end_date" value="{{ $budget->end_date->format('d/m/Y') }}" readonly>
              </div>
              <div class="form-group">
                <label>Keterangan Date</label>
                <input type="text" class="form-control" name="description" value="{{ $budget->description }}" readonly>
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
              <h3>Nilai Budget  : Rp. {{ number_format($budget->nilai)}}</h3>
              <br>

              <div class="nav-tabs-custom">
              
              <ul class="nav nav-tabs">                
                <li><a href="#tab_1" data-toggle="tab">Item Pekerjaan Budget Awal</a></li>
                <li  class="active"><a href="#tab_2" data-toggle="tab">Item Pekerjaan Budget Revisi</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane" id="tab_1">
                    <table class="table" style="padding: 0" id="example3">
                        <thead class="head_table">
                          <tr>
                            <td>COA</td>
                            <td>Item Pekerjaan</td>
                            <td>Volume</td>
                            <td>Satuan</td>
                            <td>Nilai(Rp)</td>
                            <td>Subtotal(Rp)</td>
                            <td>Perubahan Data</td>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ( $parent->total_parent_item as $key => $value )
                            @if ( count(\Modules\Pekerjaan\Entities\Itempekerjaan::where("id",$value['id'])->get()) > 0 )
                              <tr>
                                <td><strong>{{  \Modules\Pekerjaan\Entities\Itempekerjaan::where("id",$value['id'])->first()->code }}</strong></td>
                                <td><strong>{{  \Modules\Pekerjaan\Entities\Itempekerjaan::where("id",$value['id'])->first()->name }}</strong></td>
                                <td>{{ number_format($value['volume'])}}</td>
                                <td>{{ $value['satuan']}}</td>
                                <td>{{ number_format($value['nilai'])}}</td>
                                <td>{{ number_format($value['total'])}}</td>
                                <td>
                                  <a class="btn btn-warning" href="{{ url('/')}}/budget/item-budgetrevisi?id={{$budget->id}}&coa={{ $value['id']}}">Edit Data Budget</a>
                                </td>
                              </tr>
                             
                            @endif
                          @endforeach 
                        </tbody>
                      </table>
                </div>
                <div class="tab-pane active" id="tab_2">
                  <table class="table" style="padding: 0" id="example3">
                        <a class="btn btn-primary" href="{{ url('/')}}/budget/item-revisi?id={{ $budget->id }}">Tambah Item Pekerjaan</a>
                        <thead class="head_table">
                          <tr>
                            <td>COA</td>
                            <td>Item Pekerjaan</td>
                            <td>Volume</td>
                            <td>Satuan</td>
                            <td>Nilai(Rp)</td>
                            <td>Subtotal(Rp)</td>
                            <td>Perubahan Data</td>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ( $budget->total_parent_item as $key => $value )
                            @if ( count(\Modules\Pekerjaan\Entities\Itempekerjaan::where("id",$value['id'])->get()) > 0 )
                              <tr>
                                <td><strong>{{  \Modules\Pekerjaan\Entities\Itempekerjaan::where("id",$value['id'])->first()->code }}</strong></td>
                                <td><strong>{{  \Modules\Pekerjaan\Entities\Itempekerjaan::where("id",$value['id'])->first()->name }}</strong></td>
                                <td>{{ number_format($value['volume'])}}</td>
                                <td>{{ $value['satuan']}}</td>
                                <td>{{ number_format(round($value['total'] / $value['volume']))}}</td>
                                <td>{{ number_format($value['total'])}}</td>
                                <td>
                                  <a class="btn btn-warning" href="{{ url('/')}}/budget/item-budgetrevisi?id={{$budget->id}}&coa={{ $value['id']}}">Edit Data Budget</a>
                                </td>
                              </tr>
                             
                            @endif
                          @endforeach 
                        </tbody>
                      </table>
                </div>
                <div class="tab-pane" id="tab_3"></div>
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
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("budget::app")

</body>
</html>
