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
      <h1>Data Workorder <strong>{{ $workorder->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12"><h3 class="box-title">Detail Unit</h3></div>
   
            <!-- /.col -->
            <div class="col-md-12">
              <form action="{{ url('/')}}/workorder/save-units" method="post">
        <input type="hidden" name="workorder_unit_id" value="{{ $workorder->id }}">
                <div class="form-group">                  
                  <a class="btn btn-warning" href="{{ url('/')}}/workorder/detail/?id={{ $workorder->id }}">Kembali</a>
                  <button type="submit" class="btn btn-primary" id="btn_submit" disabled>Save changes</button>
                </div>
                {{ csrf_field() }}
                <table class="table-bordered table table-responsive">
                  <thead class="head_table">
                    <tr>
                      <td>Unit Name</td>
                      <td>Set to WO</td>
                      <td>Status Pembayaran</td>
                      <td>Tanggal Pembayaran</td>
                      <td>Target Pembangunan</td>
                    </tr>
                  </thead>
                  <tbody id="table_item">
                    @php $start=0; @endphp

                    @for ( $i=0; $i < count($workorder->budget_parent); $i++)
                      @if ( $workorder->budget_parent[$i] != null )
                        @if ( \Modules\Budget\Entities\BudgetTahunan::find($workorder->budget_parent[$i])->budget == null )
                        <tr>                
                          <td>{{ \Modules\Budget\Entities\BudgetTahunan::find($workorder->budget_parent[$i])->budget->project->name }}</td>
                          <td><input type="checkbox" class="disable_unit" name="asset[{{ $start}}]" value="{{ \Modules\Budget\Entities\BudgetTahunan::find($workorder->budget_parent[$i])->project->id }}" onClick="disablebtn('{{ \Modules\Budget\Entities\BudgetTahunan::find($workorder->budget_parent[$i])->project->id }}')"></td>
                        </tr>                  
                        @else
                        @php
                            $budgettahunan = \Modules\Budget\Entities\BudgetTahunan::find($workorder->budget_parent[$i]);
                        @endphp

                        @if ( $budgettahunan->budget->kawasan !=  null)
                          <tr>                
                            <td>{{ $budgettahunan->budget->kawasan->name or '' }}</td>
                            <td><input type="checkbox"  class="disable_unit" name="asset[{{ $start}}]" value="{{ $budgettahunan->budget->kawasan->id }}"  onClick="disablebtn('{{ $budgettahunan->budget->kawasan->id }}')"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>
                          @php 
                            $units_list = \Modules\Project\Entities\ProjectKawasan::find($budgettahunan->budget->kawasan->id)->units;
                          @endphp

                          @foreach ( $units_list as $key3 => $value3 )                  
                            @php $start++; @endphp
                            <tr>                
                              <td>{{ $value3->name }}</td>
                              <td><input class="disable_unit" type="checkbox" name="asset[{{ $start}}]" value="Unit_{{ $value3->id }}" onClick="disablebtn('{{ $value3->id }}')"></td>
                              <td>{{ $array[$value3->status]}}</td>
                              <td>
                                @if ( $value3->status == "2")
                                {{ $value3->updated_at->format('d/m/Y')}}
                                @endif
                              </td>
                              <td>
                                 @if ( $value3->status == "2")
                                  {{ date('d/m/Y', strtotime( $limit_bangun, strtotime($value3->updated_at)))  }}
                                 @php
                                  $date1 = new DateTime("now");
                                  $date2 = new DateTime($value3->updated_at);
                                  $interval = $date1->diff($date2);
                                 @endphp
                                 @if ( $interval->days > $standar_limit )<br>
                                  <span style="color:red;"><strong>0 hari tersisa</strong></span>
                                 @else
                                  <br> {{ $standar_limit - $interval->days }} hari tersisa
                                 @endif
                                 @endif
                              </td>
                            </tr>
                            @php $start++; @endphp
                          @endforeach
                        @endif

                        

                        @endif
                        @php $start++; @endphp
                      @endif
                    @endfor
                    
                    
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
<!-- Select2 -->
<script type="text/javascript">
  function disablebtn(id){
    var valor = [];
    $('input.disable_unit[type=checkbox]').each(function () {
        if (this.checked)
          valor.push($(this).val());
    });

    console.log(valor.length);

    if (valor.length < 1 ) {
      $("#btn_submit").attr("disabled","disabled");
    }else{
      $("#btn_submit").removeAttr("disabled");
    }
  }
</script>
</body>
</html>