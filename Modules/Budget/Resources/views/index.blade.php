<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
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
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <a href="{{ url('/')}}/budget/add-budget?id={{ $project->id }}" class="btn-lg btn-primary"><i class="glyphicon glyphicon-plus-sign"></i>Tambah Budget</a><br><br>
              <table class="table table-bordered" style="width: 50%;">
                <tr>
                  <td style="background-color: grey;color:white;font-weight: bolder" colspan="3">Budget Dev Cost</td>
                </tr>
                <tr>
                  <td colspan="3">
                    @php $total = 0; @endphp
                    @foreach ( $budget as $key => $value )
                    @if ( $value->deleted_at == "" )
                      @php $total = $total + $value->total_dev_cost;@endphp
                    @endif
                    @endforeach
                   <h3>Rp. {{ number_format($total)}}</h3></td>
                </tr>
                <tr>
                  <td  style="background-color: grey;color:white;font-weight: bolder">&nbsp;</td>
                  <td style="background-color: grey;color:white;font-weight: bolder">Luas</td>
                  <td style="background-color: grey;color:white;font-weight: bolder"><center>HPP</center></td>
                </tr>
                <tr>
                  <td>Brutto</td>
                  <td>Luas Brutto  : {{ number_format($project->luas) }} m2</td>
                  <td>Rp. {{ number_format($total/$project->luas,2)}}/m2</td>
                </tr>
                <tr>
                  <td>Netto</td>
                  <td>Luas Netto  : {{ number_format($project->netto) }} m2</td>                  
                  @if ( $project->netto == "0")
                  <td>Rp. {{ number_format(0,2)}}/m2</td>
                  @else
                  <td>Rp. {{ number_format($total/$project->netto,2)}}/m2</td>
                  @endif
                </tr>
              </table>             
              
              
              <table id="example2" class="table table-bordered table-hover">   
              {{ csrf_field() }}              
              <thead class="head_table">
                <tr>
                  <td>Nomor Budget</td>
                  <td>Nilai DevCost(Rp)</td>
                  <td>Department</td>
                  <td>Project</td>
                  <td>Kawasan</td>
                  <td>Start Date</td>
                  <td>End Date</td>                  
                  <!--td>Status</td-->
                  <td>Detail</td>
                  <td>Revisi</td>
                  <td>Approval</td>
                </tr>
              </thead>
              <tbody>
                @php $nilai = 0; @endphp
                @foreach ( $budget as $key => $value )
                @if ( $value->deleted_at == "")

                @php
                  $array = array (
                    "6" => array("label" => "Disetujui", "class" => "label label-success"),
                    "7" => array("label" => "Ditolak", "class" => "label label-danger"),
                    "1" => array("label" => "Dalam Proses", "class" => "label label-warning")
                  )
                @endphp
                <tr>
                  <td>{{ $value->no }}</td>
                  <td>{{ number_format($value->total_dev_cost) }}</td>
                  <td>{{ $value->department->name }}</td>
                  <td>{{ $value->project->name }}</td>
                  <td>{{ $value->kawasan->name or '' }}</td>
                  <td>{{ $value->start_date}}</td>
                  <td>{{ $value->end_date }}</td>                  
                  <!--td>Status</td-->
                  <td>
                    <a class="btn btn-warning" href="{{ url('/')}}/budget/detail?id={{ $value->id }}">Detail</a>                   
                  </td>
                  <td>
                    @if ( count(\Modules\Budget\Entities\Budget::where("parent_id",$value->id)->get()) <= 0 )
                    <a class="btn btn-success" href="{{ url('/')}}/budget/revisibudget?id={{ $value->id }}">Revisi</a>
                    @else
                    <a class="btn btn-success" href="{{ url('/')}}/budget/list-budgetrevisi?id={{ $value->id }}">Daftar Revisi</a>
                    @endif
                  </td>
                  <td>
                     @if ( $value->approval != "" )
                      <span class="{{ $array[$value->approval->approval_action_id]['class'] }}">{{ $array[$value->approval->approval_action_id]['label'] }}</span>
                      @if ( $value->approval->approval_action_id == "6")
                      <a class="btn btn-primary" href="{{ url('/')}}/budget/cashflow/?id={{ $value->id }}">Budget Cash Flow</a>
                      @elseif ( $value->approval->approval_action_id == "7") 
                      <button class="btn btn-info" href="{{ url('/')}}/budget/approval" onclick="updateapproval('{{ $value->id }}','{{ $value->approval->id }}')">Request Approval</button>
                      @endif
                    @else
                    <button class="btn btn-info" href="{{ url('/')}}/budget/approval" onclick="requestapproval('{{ $value->id }}')">Request Approval</button>
                    @endif
                  </td>
                </tr>
                @endif
                @endforeach
              </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
@include("project::app")
<script type="text/javascript">
  $('#example3').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false,
      fixedColumns:   {
          leftColumns: 4
      }
    });

  function requestapproval(id){
    if ( confirm("Apakah anda yakin ingin merilis budget ini ? ")){
      var request = $.ajax({
        url : "{{ url('/')}}/budget/approval-add",
        data : {
          id : id
        },
        type : "post",
        dataType : "json"
      });

      request.done(function(data){
        if ( data.status == "0" ){
          alert("Budget telah dirilis ");
          window.location.reload();
        }else{
          return false;
        }
      })
    }else{
      return false;
    }
  }

  function updateapproval(id,approval_id){
    if ( confirm("Apakah anda yakin ingin merilis budget ini ? ")){
      var request = $.ajax({
        url : "{{ url('/')}}/budget/approval-update",
        data : {
          id : id,
          approval_id : approval_id
        },
        type : "post",
        dataType : "json"
      });

      request.done(function(data){
        if ( data.status == "0" ){
          alert("Budget telah dirilis ");
          window.location.reload();
        }else{
          return false;
        }
      });

    }else{
      return false;
    }
  }
</script>
</body>
</html>
