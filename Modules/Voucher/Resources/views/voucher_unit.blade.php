<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard </title>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
    <section class="content-header" style="display: none;">
      <h1>Data Voucher</h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">   

            <h3 class="box-title" style="display: none;">Detail Data Voucher</h3>           
              <!-- Main content -->
            <section class="invoice">

              <form action="{{ url('/')}}/voucher/update" method="post" name="form1" >
                <input type="hidden" name="voucher_id" value="{{ $voucher->id }}">
                {{ csrf_field() }}
              <!-- title row -->
              <div class="row">
                <div class="col-xs-12">
                  <h2 class="page-header">
                    <i class="fa fa-globe"></i> Voucher NO : <strong>{{ $voucher->no }}</strong>
                    <small class="pull-right">Dok No  : {{ $voucher->bap->no }}</small>
                  </h2>
                </div>
                <!-- /.col -->
              </div>

              <div class="row">
                <div class="col-xs-6">
                  <div class="form-group">
                    <span>Project</span>
                    <input type="text" class="form-control" value="{{ $voucher->bap->spk->project->name }}" readonly>
                  </div>
                  <div class="form-group">
                    <span>PT</span>
                    <input type="text" class="form-control" value="{{ $voucher->bap->spk->tender->rab->budget_tahunan->budget->pt->name }}" readonly>
                  </div>
                  <div class="form-group">
                    <span>Dibayarkan kepada</span>
                    <input type="text" class="form-control" value="{{ $voucher->bap->spk->rekanan->group->name }}" readonly>
                  </div>
                  <div class="form-group">
                    <span>Rekening Rekanan</span>
                    <select class="form-control" name="rekanan_rekening">
                      @foreach ( $voucher->bap->spk->rekanan->rekenings as $key3 => $value3 )
                      <option value="{{ $value3->id}}">{{ $value3->bank->name }} / {{ $value3->name }}-{{ $value3->no }}</option>
                      @endforeach
                    </select>
                  </div>
                  
                </div>
                <div class="col-xs-6">                  
                  <div class="form-group">
                    <span>Tanggal Voucher Dibuat</span>
                    <input type="text" class="form-control" value="{{ $voucher->created_at->format('d/m/Y')}}" id="tgl_voucher_dibuat" readonly>
                  </div>
                  <div class="form-group">
                    <span>Tanggal Voucher Diserahkan ke Keuangan</span>
                    <input type="text" class="form-control" value="{{ $voucher->created_at->format('d/m/Y')}}" id="diserahkan" readonly>
                  </div>
                  <div class="form-group">
                    <span>Tanggal Jatuh Tempo Voucher</span>
                    <input type="text" class="form-control" value="{{ $voucher->created_at->format('d/m/Y')}}" id="tempo" >
                  </div>
                  <div class="form-group">
                    <span>Tanggal Voucher Dicairkan</span>
                    <input type="text" class="form-control" value="{{ $voucher->created_at->format('d/m/Y')}}" id="pencairan" >
                  </div>
                </div>
              </div>
              <!-- /.row -->
              <div class="row">
                <div class="col-xs-12">
                  <table class="table table-bordered">
                    <thead class="head_table">
                      <tr>
                        <td>Unit</td>
                        <td>Keterangan</td>
                        <td>Nilai</td>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ( $voucher->bap->spk->details as $key => $value )
                        <tr>
                          <td>{{ $value->asset->name }}</td>
                          <td>
                            @if ( $value->asset_type == "Modules\Project\Entities\Unit")
                            Unit
                            @else
                            Project
                            @endif
                          </td>
                          <td>Rp. {{number_format($voucher->details->sum('nilai') / count($voucher->bap->spk->details ) ) }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-xs-12">

                  <a href="{{ url('/')}}/voucher/show?id={{ $voucher->id }}" class="btn btn-warning">Kembali</a>
                </div>
              </div>
               </form>
            </section>
            <!-- /.content -->
            </div>

            </form>
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
@include("voucher::app")

</body>
</html>
