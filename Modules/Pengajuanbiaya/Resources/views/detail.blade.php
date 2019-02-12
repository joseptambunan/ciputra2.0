<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('/')}}/assets/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Pengajuan Biaya<strong> {{ $project->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
   
            <!-- /.box-header -->
            <div class="box-body">
              
              <div class="col-md-12 table-responsive">
                <div class="col-md-12"><h3 class="box-title">Tambah Pengajuan Biaya</h3></div>
                <div class="col-md-6">
                  <form action="{{ url('/')}}/pengajuanbiaya/updatedetail" method="post" name="form1"> 
                  {{csrf_field()}}
                  <input type="hidden" name="pengajuanbiaya_id" value="{{ $pengajuanbiaya->id }}">
                  <div class="form-group">
                    <label>No. Budget</label>
                    <select class="form-control select2" name="budget_tahunan" id="budget_tahunan">
                      <option>(pilih budget)</option>
                      @foreach ( $project->budget_tahunans as $key => $value )
                        @if ( $value->id == $pengajuanbiaya->budget_tahunan->id )
                          <option value="{{ $value->id }}" selected>{{ $value->no }}</option>
                        @else                          
                          <option value="{{ $value->id }}">{{ $value->no }}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Department</label>
                    <input type="text" name="budget" class="form-control" value="{{ $pengajuanbiaya->budget_tahunan->budget->department->name}}">
                  </div>
                  <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" class="form-control" name="judul" value="{{ $pengajuanbiaya->description}}">
                  </div>
                  <div class="form-group">
                    <label>Tanggal Dibutuhkan</label>
                    <input type="text" class="form-control" name="butuh_date" id="butuh_date" value="{{ $pengajuanbiaya->butuh_date}}">
                  </div>
                  <div class="form-group" id="itempekerjaan_list">
                    <span id="loadings" style="display: none;">Loading...</span>
                    <label>Item Pekerjaan</label>
                    <select class="form-control select2" id="itempekerjaan_id" name="itempekerjaan_id">
                      @foreach ( $pengajuanbiaya->budget_tahunan->total_parent_item as $key => $value )
                        @if ( $value['volume'] > 0 && $value['nilai'] > 0 && $value['cashout'] > 0 )
                          <option value="">{{ $value['itempekerjaan']}}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    @if ( $pengajuanbiaya->doc_bayar_status == "" )
                      <button class="btn btn-primary" type="submit">Simpan</button>
                    @endif
                    <a href="{{ url('/')}}/pengajuanbiaya" class="btn btn-warning">Kembali</a>
                  </div>
                  </form> 
                </div>                       
              </div>

              <div class="col-md-12 table-responsive">
                Nilai : <strong>Rp. {{ number_format($pengajuanbiaya->nilai,2)}}</strong>
                <h4>Rincian Pengajuan Biaya</h4>                
                <table class="table table-bordered">
                  <thead class="head_table">
                    <tr>
                      <td>No.</td>
                      <td>Uraian Pekerjaan</td>
                      <td>Harga</td>
                      <td>Action</td>
                    </tr>
                  </thead>
                  <tbody>     
                    <form action="{{ url('/')}}/pengajuanbiaya/savedetail" method="post" name="form1">      
                    <input type="hidden" name="pengajuanbiaya_id" value="{{ $pengajuanbiaya->id}}">
                    {{csrf_field()}}       
                    <tr>
                      <td>&nbsp;</td>
                      <td><input type="text" class="form-control" name="uraian_pekerjaan" required></td>
                      <td><input type="text" class="nilai_budget form-control" name="harga_satuan" required></td>
                      <td>
                        <button class="btn btn-primary">Simpan</button>
                      </td>
                    </tr>
                    </form>  
                    @foreach($pengajuanbiaya->details as $key2 => $value2 )
                    <tr>
                      <td>{{ $key2 + 1 }}</td>
                      <td>{{ $value2->description }}</td>
                      <td>{{ number_format($value2->nilai)}}</td>
                      <td><button class="btn btn-danger" onClick="removeitem('{{$value2->id}}')">Hapus</button></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
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
@include("pengajuanbiaya::app")
</body>
</html>
