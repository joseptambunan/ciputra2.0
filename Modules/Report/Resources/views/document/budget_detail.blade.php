<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>User QS | Dashboard</title>
  @include("master/header")
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include('master/sidebar_report')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Proyek <strong>{{ $budget->project->name }}</strong></h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Dokumen</h3>
              <h3>No. Budget : {{ $budget->no}}</h3>
              <h3 class="{{ $array[$budget->approval->approval_action_id]['class']}}">Status : {{ $array[$budget->approval->approval_action_id]['label'] }}</h3>
              <a href="{{ url('/')}}/report/document/budget/?id={{ $budget->project->id}}" class="btn btn-warning">Kembali</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-hover">
                <thead  class="head_table">
                <tr>
                  <th colspan="2">Nama</th>
                  <th>Keterangan</th>
                </tr>                
                </thead>
                <tbody>
                 <tr>
                    <td><strong><span style="font-size: 14px;"><strong>TOTAL BUDGET DEVELOPMENT COST</strong></span></strong></td>
                    <td><a href="{{ url('/')}}/report/document/budget/devcost/?id={{ $budget->id }}" class="btn btn-primary">Detail</a></td>
                    <td style="text-align: right;"><strong>Rp. {{ number_format($budget->total_dev_cost)}}</strong></td>
                  </tr>
                  <tr>
                    <td><strong><span style="font-size: 14px;"><strong>TOTAL BUDGET CONSTRUCTION COST</strong></span></strong></td>
                    <td><a href="{{ url('/')}}/report/document/budget/concost/?id={{ $budget->id }}" class="btn btn-primary">Detail</a></td>
                    <td style="text-align: right;"><strong>Rp. {{ number_format($budget->total_con_cost)}}</strong></td>
                  </tr>
                  <tr>
                    <td colspan="2"><strong><span style="font-size: 14px;">TOTAL BUDGET</span></strong></td>
                    <td style="text-align: right;"><strong>Rp. {{ number_format($budget->total_dev_cost + $budget->total_con_cost)}}</strong></td>
                  </tr>  
                  <tr style="background-color: grey;">
                    <td>&nbsp;</td>
                    <td style="color:white"><strong>Luas (m2)</strong></td>
                    <td style="color:white;"><strong>HPP Dev Cost (Rp/m2)</strong></td>
                  </tr>  
                  <tr>
                    <td>Brutto</td>
                    <td style="text-align: left;">{{ number_format($budget->project->luas)}} m2</td>
                    <td style="text-align: right;">{{ number_format($budget->total_dev_cost/$budget->project->luas) }}</td>
                  </tr> 
                  <tr>
                    <td>Netto</td>
                    <td style="text-align: left;">{{ number_format($budget->project->netto)}} m2 /<br> Eff. ({{ number_format($budget->project->efisiensi * 100,2) }}%) m2</td>
                    <td style="text-align: right;">{{ number_format($effisiensi_netto) }}</td>
                  </tr>     
                </tbody>
              </table><br>

              <table class="table table-bordered table-striped ">
                <thead class="head_table">
                  <td>Username</td>
                  <td>Request At</td>
                  <td>Status</td>
                  <td>Time Left (days)</td>
                  <td>Keterangan</td>
                </tr>
              </thead>
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

</body>
</html>
