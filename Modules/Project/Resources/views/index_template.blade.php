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
      <h1>Data Kategori</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
   
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-6">
                <h3 class="header">Tambah Kategori</h3>
            	   <form action="{{ url('/')}}/project/add-template" method="post" name="form1">
                  <input type="hidden" name="unit_type" value="{{ $unit_type->id }}">
                  <input type="hidden" name="project_id" value="{{ $project->id }}">
                  {{ csrf_field() }}
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nama Type</label>
                      <input type="text" class="form-control" name="nama" value="{{ $unit_type->name }}" disabled>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Luas Bangunan(m2)</label>
                      <input type="text" class="form-control" name="lb" id="lb" max="{{ $unit_type->luas_bangunan}}" onKeyup="luasbangunan();" value="{{ $unit_type->luas_bangunan}}" disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Luas Tanah(m2)</label>
                    <input type="hidden" class="form-control" name="lt" id="lt" value="{{ $unit_type->luas_tanah }}">
                    <input type="text" class="form-control" value="{{ $unit_type->luas_tanah }}" disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tipe </label>  
                    <select class="form-control" id="master_tipe" name="master_tipe" onChange="settype();">
                      <option value="">(pilih kategori tipe)</option>
                      @foreach ( $category as $key => $value )
                      <option value="{{ $value->id }}">{{ $value->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group" id="subtype" style="display: none;">
                    <label for="exampleInputEmail1">Sub Tipe </label>  
                    <select class="form-control" name="tipe" id="tipe">
                      @foreach($category as $key => $value )
                        @php $start=0; @endphp
                        @foreach ( $value->details as $key2 => $value2 )
                          <option value="{{ $value2->id }}" class="sub {{ $value->id }} {{ $value->id }}_{{ $start }}">{{ $value2->sub_type }}</option>
                          @php $start++; @endphp
                        @endforeach
                      @endforeach
                    </select>
                  </div>
                  
                  <div class="box-footer">
                    @if ( $unit_type->luas_tanah > 0 )
                      @if ( $unit_category == null )
                        <i class="fa fa-refresh ld ld-spin" id="loading" style="display: none;"></i>
                        <button type="submit" class="submitbtn btn btn-primary" id="btn_submit">Simpan</button>
                      @endif
                        <a href="{{ url('/')}}/project/unit-type/?id={{ $project->id }}" class="submitbtn btn btn-warning">Kembali</a>
                      
                    @endif
                  </div>
              	</form>
              </div>
              <div class="col-md-12">
              <h4><strong>Kategori : {{ $unit_category->category_project->category_detail->category->name or '-'}} {{ $unit_category->category_project->category_detail->sub_type or '-'}}</strong></h4>
              @if ( $unit_category != "" )
                <h4><strong>HPP Con Cost: Rp. {{ number_format( $unit_category->nilai,2) }} /m2</strong></h4>  
                <a href="{{ url('/')}}/project/detail-template?id={{ $unit_category->id }}" class="btn btn-primary">Isi Harga</a>
              @endif
            	<table id="example3" class="table table-bordered table-hover table-responsive">
                <thead>
                <tr style="background-color: greenyellow;">
                  <th>Kode</th>
                  <th>Item Pekerjaan</th>
                  <th>Volume</th>
                  <th>Satuan</th>
                  <th>Nilai(Rp)</th>
                  <th>Subtotal(Rp)</th>
                  <th>Rp/ m2</th>
                </tr>
                </thead>
                <tbody>
                  @if ( $unit_category != null )
                    @foreach ( $unit_category->details as $key => $value )
                    @if ( $value->satuan == "%")
                    <tr>
                      <td>{{ $value->itempekerjaan->code or '-'}}</td>
                      <td><i>Prediksi Kenaikan Harga</i></td>
                      <td>{{ number_format($value->volume,2) }}</td>
                      <td>{{ $value->satuan or '-' }}</td>
                      <td>{{ number_format($value->nilai,2) }}</td>
                      <td>{{ number_format(($value->volume /100 ) * $value->nilai ,2) }}</td>    
                      <td>
                        @if ( $unit_type->luas_bangunan > 0 )
                        {{ number_format( (( $value->volume / 100 ) * $value->nilai ) / $unit_type->luas_bangunan ,2) }}
                        @endif
                      </td>                
                    </tr>
                    @else
                    <tr>
                      <td>{{ $value->itempekerjaan->code or '-'}}</td>
                      <td>{{ $value->itempekerjaan->name or '-' }}</td>
                      <td>{{ number_format($value->volume,2) }}</td>
                      <td>{{ $value->satuan or '-' }}</td>
                      <td>{{ number_format($value->nilai,2) }}</td>
                      <td>{{ number_format($value->volume * $value->nilai ,2) }}</td>    
                      <td>
                        @if ( $unit_type->luas_bangunan > 0 )
                        {{ number_format( ($value->volume * $value->nilai ) / $unit_type->luas_bangunan ,2) }}
                        @endif
                      </td>                
                    </tr>
                    @endif
                    @endforeach
                  @endif
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
  function luasbangunan() {

    if ( parseInt($("#lb").val()) > parseInt($("#lt").val()) ) {
      $("#submitbntn").attr("disabled", true);
    }else if ( parseInt($("#lb").val()) <= parseInt($("#lt").val()) ){
      $("#submitbntn").removeAttr("disabled");
    }else if ( parseInt($("#lb").val() == "0" )){
      $("#submitbntn").attr("disabled", true);
    }
  }

  $("#btn_submit").click(function(){
    $(".submitbtn").hide();
    $("#loading").show();
  });

  function settype(){
    $("#subtype").show();
    $(".sub").hide();
    $(".sub").removeAttr("selected");
    $("." + $("#master_tipe").val()).show();
    $("." + $("#master_tipe").val() + "_0").attr("selected","selected");
  }
</script>
</body>
</html>
