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
      <h1>Data Proyek {{ $project->name }}</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data SPK </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead class="head_table">
                <tr>
                  <th>No. SPK </th>
                  <th>COA</th>
                  <th>Pekerjaan</th>
                  <th>Department From</th>
                  <th>Nilai</th>
                  <th>Tanggal</th>
                  <th>Detail</th>
                  <th>Status Approval</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ( $project->spks as $key => $value )
                  @if ( $value->tender != "" )
                  <tr>
                    <td>{{ $value->no }}</td>
                    <td>{{ $value->itempekerjaan->code or '' }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->tender->rab->workorder->departmentFrom->name or '' }}</td>
                    <td>{{ number_format($value->nilai) }}</td>
                    <td>{{ $value->date->format("d/M/Y") }}</td>
                    <td><a href="{{ url('/')}}/spk/detail?id={{ $value->id }}" class="btn btn-warning">Detail</td>
                    <td>
                      @if ( $value->approval == "" )
                      <button onclick="apprioval('{{ $value->id}}')" class="btn btn-primary">Request Approval</button>
                      @else
                      @php
                        $array = array (
                          "6" => array("label" => "Disetujui", "class" => "label label-success"),
                          "7" => array("label" => "Ditolak", "class" => "label label-danger"),
                          "1" => array("label" => "Dalam Proses", "class" => "label label-warning"),
                          "" => array("label" => "","class" => "")
                        )
                      @endphp
                      <span class="{{ $array[$value->approval->approval_action_id]['class'] }}">{{ $array[$value->approval->approval_action_id]['label'] }}</span>
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
@include("master/copyright")
  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("spk::app")
</body>
</html>
