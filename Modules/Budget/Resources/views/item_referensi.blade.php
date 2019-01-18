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
      <h1>Data Proyek <strong>{{ $budgetdetail->budget->project->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <h4><strong>{{ $itempekerjaan->code }} - {{ $itempekerjaan->name }} : Rp. {{ number_format($budgetdetail->nilai * $budgetdetail->volume ) }}</strong></h4><hr>
              <h3 class="box-title">Detail Data Referensi Budget Proyek</h3>                  
              <form action="{{ url('/')}}/budget/item-save" method="post" name="form1" id="form1"> 
              <input type="hidden" class="form-control" name="budget_detail_id" value="{{ $budgetdetail->id }}"> 
              <div class="form-group">
                <label>Volume</label>
                <input type="text" class="nilai_budget form-control" name="volume" id="volume" value="{{ number_format($budgetdetail->volume ) }}" onKeyUp="showbar();" required>
              </div>
              <div class="form-group">
                <label>Nilai Harga Satuan</label>
                <input type="text" class="nilai_budget form-control" name="nilai" id="nilai" value="{{ number_format($budgetdetail->nilai ) }}" onKeyUp="showbar();" required>
              </div> 
              <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" name="Keterangan" >{{ $budgetdetail->description }}</textarea>
              </div>          
              <div class="form-group">
                <i class="fa fa-refresh ld ld-spin" id="loading" style="display: none;"></i>                
                <button class="btn btn-info submitbtn" type="submit" onClick="loadingbar();">Simpan</button>
                <a class="btn btn-warning submitbtn" href="{{ url('/')}}/budget/detail?id={{ $budgetdetail->budget->id }}">Kembali</a>
              </div>
            </div>

            <div class="col-md-6">             
              <div class="form-group table-responsive">
                <table class="table table-bordered">
                  <thead class="head_table">
                    <tr>
                      <td>Data Pusat</td>
                      <td>Terendah</td>
                      <td>Tertinggi</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Rp. {{ number_format($itempekerjaan->nilai_master_satuan) }} / {{ $itempekerjaan->details->satuan or  '' }}</td>
                      <td>
                       <span> Rp. {{number_format($itempekerjaan->nilai_lowest_library["nilai"],2)}} / {{ $itempekerjaan->details->satuan or  '' }}</span><br>
                       <span>Proyek : {{ $itempekerjaan->nilai_lowest_library["project_id"] }}</span>
                      </td>
                      <td>
                        <span>Rp. {{number_format($itempekerjaan->nilai_max_library["nilai"],2)}} / {{ $itempekerjaan->details->satuan or  '' }}</span><br>
                        <span>Proyek : {{ $itempekerjaan->nilai_lowest_library["project_id"] }}</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
   
            <!-- /.col -->
            <div class="col-md-12">
              {{ csrf_field() }}
              <input type="hidden" name="budget_id" id="budget_id" value="{{ $budgetdetail->id }}">
              <table class="table">
                <thead class="head_table">
                  <tr>
                    <td>Harga Satuan</td>
                    <td>Proyek</td>
                    <td>Gunakan</td>
                  </tr>
                </thead>
                <tbody id="itemlist">
                  @foreach ( $itempekerjaan->harga as $key => $value )
                  <tr>
                    <td>{{ number_format($value->nilai,2) }}</td>
                    <td>{{ $value->project->name or '' }}</td>
                    <td><input type="radio" onclick="setnilai('{{ $value->nilai}}')">Set sebagai Budget</td>
                  </tr>
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
@include("budget::app")
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  function setnilai(nilai){
    $("#nilai").val(nilai);
  }

  function loadingbar(){
    $("#loading").show();
    $(".submitbtn").hide();
  }

  function showbar(){    
    $("#loading").hide();
    $(".submitbtn").show();
  }
</script>
</script>
</body>
</html>
