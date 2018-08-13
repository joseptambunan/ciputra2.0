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
      <h1>Data Proyek <strong>{{ $project->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12"><h3 class="box-title">Detail Data Budget Global </h3></div>
   
            <!-- /.col -->
            <div class="col-md-12">

              <form action="{{ url('/')}}/budget/saveitem-budgetrevisi" method="post" name="form1" id="form1">  
                <div class="form-group">                  
                  <button type="submit" class="btn btn-info">Submit</button>
                  <a class="btn btn-warning" href="{{ url('/')}}/budget/show-budgetrevisi?id={{ $budget->id }}">Kembali</a>
                </div>
                {{ csrf_field() }}
                <input type="hidden" name="budget_id" id="budget_id" value="{{ $budget->id }}">
                <table class="table">
                  <thead class="head_table">
                    <tr>
                      <td>COA</td>
                      <td>Item Pekerjaan</td>
                      <td>Volume</td>
                      <td>Satuan</td>
                      <td>Nilai(Rp)</td>
                      <td>Subtotal(Rp)</td>
                    </tr>
                  </thead>
                  <tbody id="itemlist">
                    <tr>
                      <td></td>
                      <td></td>
                      @php $start=0; $total = 0; $total_volume = 0 ; $total_nilai=0; @endphp
                      @foreach ( $itempekerjaan->child_item as $key3 => $value3 )        
                      @if ( count($value3->child_item) > 0 )
                        @php
                          $budgettw = \Modules\Budget\Entities\BudgetDetail::where("itempekerjaan_id",$value3->child_item->first()->id)->where("budget_id",$budget->id)->get();
                        @endphp
                        @if ( count($budgettw) > 0 )
                          @php 
                            $total = $total + ( $budgettw->first()->volume * $budgettw->first()->nilai );
                            $total_volume = $total_volume + $budgettw->first()->volume;
                            $total_nilai = $total_nilai + $budgettw->first()->nilai;
                            $start++; 
                          @endphp
                        @endif
                      @endif
                      @endforeach
                      <td>{{ number_format($total_volume) }}</td>
                      <td>unit</td>
                      @if ( $total_volume == "0" || $total == "0")
                      <td>0</td>
                      @else
                      <td>{{ number_format(round($total/$total_volume)) }}</td>
                      @endif
                      <td>{{ number_format($total) }}</td>
                    </tr>
                    @php $start=0; @endphp
                    @foreach ( $itempekerjaan->child_item as $key3 => $value3 )        
                      @if ( count($value3->child_item) > 0 )

                        <tr>
                          <td><strong> {{ $value3->child_item->first()->code }} </strong></td>
                          <td>{{ $value3->child_item->first()->name }}</td>
                          @php
                            $budgettw = \Modules\Budget\Entities\BudgetDetail::where("itempekerjaan_id",$value3->child_item->first()->id)->where("budget_id",$budget->id)->get();
                           @endphp
                            @if ( count($budgettw) > 0 )
                               <td><input type='hidden' class='form-control' name='budgetdetail[{{ $start }}]' value='{{ $budgettw->first()->id }}'/><input type='hidden' class='form-control' name='item_id[{{ $start }}]' value='{{ $value3->child_item->first()->id }}'/><input type='text' class='form-control' name='Volume_[{{ $start }}]' value='{{ number_format($budgettw->first()->volume) }}'/></td>
                              <td><input type='text' class='form-control' name='satuan_[{{ $start }}]' value='{{ $budgettw->first()->satuan }}'/></td>
                              <td><input type='text' class='form-control nilai_budget' name='nilai_[{{ $start }}]' value='{{ number_format($budgettw->first()->nilai) }}'/></td>
                              <td><input type='text' class='form-control' name='unit_[{{ $start }}]' value='{{ number_format($budgettw->first()->nilai * $budgettw->first()->volume) }}' readonly /></td>
                            @else
                               <td><input type='hidden' class='form-control' name='budgetdetail[{{ $start }}]' value=''/><input type='hidden' class='form-control' name='item_id[{{ $start }}]' value='{{ $value3->child_item->first()->id }}'/><input type='text' class='form-control' name='Volume_[{{ $start }}]' value=''/></td>
                              <td><input type='text' class='form-control' name='satuan_[{{ $start }}]' value=''/></td>
                              <td><input type='text' class='form-control' name='nilai_[{{ $start }}]' value=''/></td>
                              <td><input type='text' class='form-control nilai_budget' name='unit_[{{ $start }}]' value='' readonly /></td>
                            @endif
                            @php $start++; @endphp
                         
                        </tr>                        
                      @else                         
                          <tr>
                            <td><strong> {{ $value3->first()->code }} </strong></td>
                            <td>{{ $value3->first()->name }} </td>
                            <td></td>
                            <td><input type='text' class='form-control' name='satuan_[{{ $start }}]' value=''/></td>
                            <td><input type='text' class='form-control' name='nilai_[{{ $start }}]' value=''/></td>
                          </tr>
                          @php $start++; @endphp
                    @endif
                  @endforeach
                  </tbody>
                </table>
              </form>
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
@include("pt::app")

</body>
</html>
