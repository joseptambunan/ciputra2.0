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
      <h1>Data Proyek <strong>{{ $budget->budget->project->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12"><h3 class="box-title">Detail Data Budget Tahunan</h3></div>
   
            <!-- /.col -->
            <div class="col-md-12">

              <form action="{{ url('/')}}/budget/cashflow/save-item" method="post" name="form1" id="form1">  
                <div class="form-group">                  
                  <button type="submit" class="btn btn-info">Submit</button>
                  <a class="btn btn-warning" href="{{ url('/')}}/budget/cashflow/detail-cashflow?id={{ $budget->id }}">Kembali</a>
                </div>
                {{ csrf_field() }}
                <input type="hidden" name="budget_id" id="budget_id" value="{{ $budget->id }}">
                <table class="table">
                  <thead class="head_table">
                    <tr>
                      <td>COA</td>
                      <td>Item Pekerjaan</td>
                      <td>Nilai Budget Global</td>
                      <td>Volume</td>
                      <td>Satuan</td>
                      <td>Nilai</td>
                    </tr>
                  </thead>
                  <tbody id="itemlist">
                   @php $start=0; @endphp
                    @foreach ( $itempekerjaan->child_item as $key3 => $value3 )        
                      @if ( count($value3->child_item) > 0 )

                        <tr>
                          <td><strong> {{ $value3->child_item->first()->code }} </strong></td>
                          <td>{{ $value3->child_item->first()->name }}</td>
                          @php
                            $budgettw = \Modules\Budget\Entities\BudgetDetail::where("itempekerjaan_id",$value3->child_item->first()->id)->where("budget_id",$budget->budget->id)->get();
                            $budgetth = Modules\Budget\Entities\BudgetTahunanDetail::where("itempekerjaan_id",$value3->child_item->first()->id)->where("budget_tahunan_id",$budget->id)->get();
                           @endphp
                            @if ( count($budgettw) > 0 )
                                <td><input type='hidden' class='form-control' name='budgetdetail[{{ $start }}]' value='{{ $budgettw->first()->id }}'/>{{ number_format($budgettw->first()->nilai * $budgettw->first()->volume) }}</td>
                            @else
                                <td><input type='hidden' class='form-control' name='budgetdetail[{{ $start }}]' value=''/>0</td>
                            @endif

                            @if ( count($budgetth) > 0 )
                                <td><input type='hidden' class='form-control' name='item_id[{{ $start }}]' value='{{ $value3->child_item->first()->id }}'/><input type='text' class='form-control' name='Volume_[{{ $start }}]' value='{{ $budgetth->first()->volume }}'/></td>
                                <td><input type='text' class='form-control' name='satuan_[{{ $start }}]' value='{{ $budgetth->first()->satuan }}'/></td>
                                <td><input type='text' class='form-control' name='nilai_[{{ $start }}]' value='{{ $budgetth->first()->nilai }}'/></td>
                            @else
                               <td><input type='hidden' class='form-control' name='item_id[{{ $start }}]' value='{{ $value3->child_item->first()->id }}'/><input type='text' class='form-control' name='Volume_[{{ $start }}]' value=''/></td>
                              <td><input type='text' class='form-control' name='satuan_[{{ $start }}]' value=''/></td>
                              <td><input type='text' class='form-control' name='nilai_[{{ $start }}]' value=''/></td>
                            @endif
                            @php $start++; @endphp
                         
                        </tr>                        
                      @else                         
                          <tr>
                            <td><strong> {{ $value3->first()->code }} </strong></td>
                            <td></td>
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
  @include("master/copyright")

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("pt::app")
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</body>
</html>
