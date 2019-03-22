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
              <h3 class="box-title">Data RAB dari WO <strong>{{ $workorder->no }}</strong> </h3><br/>
              Total Nilai Workorder : <strong>Rp. {{ number_format($workorder->nilai)}}</strong><br/>
              @if ( $workorder->approval != "" )
              Tanggal Approval : {{ date("d/M/Y", strtotime($workorder->approval->updated_at)) }}
              @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <a href="{{ url('/')}}/workorder/detail?id={{$workorder->id}}" class="btn btn-warning">Kembali</a>
   <!--            <a href="{{ url('/')}}/rab/add?id={{ $workorder->id }}" class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i>Tambah Data RAB</a> -->
              <table id="example2" class="table table-bordered table-hover">
                <thead class="head_table">
                <tr>
                  <th>No. Workorder </th>
                  <th>No. Rab</th>
                  <th>Pekerjaan</th>
                  <th>Dibuat oleh</th>
                  <th>Dokumen Pendukung</th>
                  <th>RAB / OE</th>
                  <th>Status Approval RAB / OE </th>
                  <th>Tender</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ( $workorder->detail_pekerjaan as $key => $value )
                  @php
                    $array = array (
                      "6" => array("label" => "Disetujui", "class" => "label label-success"),
                      "7" => array("label" => "Ditolak", "class" => "label label-danger"),
                      "1" => array("label" => "Dalam Proses", "class" => "label label-warning"),
                      "" => array("label" => "","class" => "")
                    )
                  @endphp
                  <tr>
                    <td>{{ $value->workorder->no }}</td>
                    <td>{{ $value->rab->no or ''}}</td>
                    <td>{{ $value->itempekerjaan->name }}</td>
                    <td>{{ \App\User::find($value->workorder->created_by)->user_name }}</td>
                    <td><a class="btn btn-info" href="{{ url('/')}}/workorder/dokument?id={{ $value->id }}">Detail Dokumen</a></td>
                    <td>
                      @if ( $value->rab == "" )
                        <a class="btn btn-primary" href="{{ url('/')}}/rab/savelink?id={{$value->id}}">Buat RAB</a>
                      @else
                        <a class="btn btn-primary" href="{{ url('/')}}/rab/detail?id={{$value->rab->id}}">Detail RAB</a>
                      @endif
                    </td>
                    <td>
                      @if ( $value->all_rab != "" )
                        @if ( $value->all_rab->approval != "")
                          <span class="{{ $array[$value->all_rab->approval->approval_action_id]['class'] }}">{{ $array[$value->all_rab->approval->approval_action_id]['label'] }} </span>
                        @endif
                      @endif
                    </td>
                    <td>
                       @if ( $value->all_rab != "" )
                        @if ( $value->all_rab->approval != "")
                          @if ( $value->all_rab->approval->approval_action_id == 6 )
                            @if ( count($value->all_rab->tenders) > 0 )                              
                              <a class="btn btn-primary" href="{{ url('/')}}/tender/detail/?id={{$value->all_rab->tenders->first()->id}}">Tender</a>
                            @else
                              <a class="btn btn-primary" href="{{ url('/')}}/rab/tender?id={{$value->all_rab->id}}">Tender</a>
                            @endif
                          @endif
                        @endif
                      @endif
                    </td>
                  </tr>
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
@include("rab::app")
</body>
</html>
