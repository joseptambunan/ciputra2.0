<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('/')}}/assets/bower_components/select2/dist/css/select2.min.css">
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
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Workorder</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                Cari Workorder
              </button>
              <a href="{{ url('/')}}/workorder/add" class="btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i>Tambah Data Workorder</a>
              <table id="example2" class="table table-bordered table-hover">
                <thead class="head_table">
                <tr>
                  <th>No. Workorder </th>
                  <th>Nama Workorder</th>
                  <th>Jumlah Pekerjaan</th>
                  <th>Total Nilai(Rp)</th>
                  <th>Dibuat oleh</th>
                  <th>Tanggal Dibuat</th>
                  <th>Detail</th>
                  <th>Status Approval</th>
                  <th>RAB</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ( $workorder as $key => $value )
                    @if ( $value->all_budget > 0 )
                      @if ( $value->all_spk <= 0 )
                        <tr>
                          <td>{{ $value->no }}</td>
                          <td>{{ $value->name }}</td>
                          <td>{{ count($value->detail_pekerjaan)}}</td>
                          <td>{{ number_format($value->nilai) }}</td>
                          <td>{{ \App\User::find($value->created_by)->user_name }}</td>
                          <td>{{ date("d/M/Y", strtotime($value->date)) }}</td>
                          <td><a href="{{ url('/')}}/workorder/detail/?id={{ $value->id }}" class="btn btn-warning">Detail</a></td>
                          <td>
                            @if ( $value->approval != "" )
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
                          <td>
                            @if ( $value->approval != "" )
                              @if ( $value->approval->approval_action_id == "6" )
                                @if ( $value->details->count() > 0 && $value->detail_pekerjaan->count() > 0 )
                                  <a class="btn btn-warning" href="{{ url('/')}}/rab/?workorder_id={{ $value->id }}">{{ $value->rabs->count() }}RAB</a>
                                @else
                                <span>Workorder ini belum memiliki Unit / Pekerjaan</span>
                                @endif
                              @endif
                            @endif
                          </td>
                        </tr>
                      @endif
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

  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form method="post" name="form1" action="{{ url('/')}}/workorder/search">
            {{ csrf_field() }}
            <div class="col-md-12">
              <div class="form-group">
                <label>Item Pekerjaan</label><br/>       
                <select class="form-control select2" name="itempekerjaan">
                @foreach ( $itempekerjaan as $key => $value )
                  @if ( $value->parent_id == "" )
                    <option value="{{ $value->id}}">{{ $value->code }} - {{ $value->name }}</option>
                  @endif
                @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Nama Workorder</label>
                <input type="text" class="form-control" name="judul_pekerjaan" autocomplete="off">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Nilai Workorder</label>
                <input type="text" class="form-control" name="nilai" autocomplete="off">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Status Approval</label>
                <select class="form-control" name="status">
                  <option value="1">Dalam Proses</option>
                  <option value="6">Disetujui</option>
                  <option value="7">Ditolak</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Tanggal</label>
                <input type="text" class="form-control" name="tanggal_workorder" id="tanggal_workorder">
              </div>
            </div>  
            <div class="col-md-6">
              <div class="form-group">                
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>&nbsp;
                <button type="button" class="btn btn-primary">Save changes</button>
              </div> 
            </div>          
          </form>         
        </div>
        <div class="modal-footer">
            
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("workorder::app")
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
</body>
</html>
