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
      <h1>Data Tipe Bangunan</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
   
            <!-- /.box-header -->
            <div class="box-body">

              <div class="col-md-12">
              <h4><strong>Kategori : {{ $unit_category->category_project->category_detail->category->name or '-'}} {{ $unit_category->category_project->category_detail->sub_type or '-'}}</strong></h4>
              @if ( $unit_category != "" )
                <strong>HPP Con Cost : Rp.</strong> <span id="concost"> {{ number_format( $unit_category->nilai,2) }} </span>   /m2
              @endif            
              <form action="{{ url('/')}}/project/update-template" method="post" name="form1">
                <a href="{{ url('/')}}/project/templatepekerjaan/?id={{ $unit_category->unit_type->id }}" class="submitbtn btn btn-warning">Kembali</a>
                <button type="submit" class="btn btn-info" id="btn_submit">Simpan</button>   
                <input type="hidden" name="luas_bangunan" id="luas_bangunan" value="{{ $unit_category->unit_type->luas_bangunan }}"> 
                <input type="hidden" name="unit_category" value="{{ $unit_category->unit_type->id }}"> 
                {{ csrf_field() }}               
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
                      <tr>
                        <td>
                          @if ( $value->satuan != "%")
                          {{ $value->itempekerjaan->code or '-'}}
                          @endif
                        </td>
                        <td>
                          @if ( $value->satuan == "%")
                            <span><strong>Persentase Kenaikan Harga</strong></span>
                            <input type="hidden" class="form-control" name="id_[{{ $value->id }}]" value="{{ $value->id }}">
                          @else
                          <input type="hidden" class="form-control" name="id_[{{ $value->id }}]" value="{{ $value->id }}">
                          {{ $value->itempekerjaan->name or '-' }}
                          @endif
                        </td>
                        <td>                          
                            {{ $value->volume or '0'}}
                            <input type="hidden" class="form-control" id="volume_{{ $value->id }}" name="volume_[{{ $value->id }}]" value="{{ $value->volume }}" autocomplete="off">                         
                        </td>
                        <td>                   
                            @if ( $value->satuan == "%")
                              <input type="hidden" class="percent form-control" id="volume_{{ $value->id }}" name="volume_[{{ $value->id }}]" value="{{ $value->volume }}" autocomplete="off">
                                %
                              <input type="hidden" class="form-control" name="satuan_[{{ $value->id }}]" value="{{ $value->satuan }}" autocomplete="off">
                            @else
                            {{ $value->satuan or '-'}}
                            <input type="hidden" class="form-control" name="satuan_[{{ $value->id }}]" value="{{ $value->satuan }}" autocomplete="off">
                            @endif                         
                        </td>
                        <td>
                          @if ( $value->satuan != "%")
                          <input type="text" class="nilai_budget form-control" name="nilai_[{{ $value->id }}]" id="nilai_{{ $value->id }}" value="{{ number_format($value->nilai,2) }}" autocomplete="off" onKeyUp="calculcate('{{ $value->id}}','{{ $value->itempekerjaan->code }}')" required>
                          @else
                          <input type="hidden" class="nilai_percentage_val nilai_budget form-control" name="nilai_[{{ $value->id }}]" id="nilai_{{ $value->id }}" value="{{ number_format($value->nilai,2) }}" autocomplete="off" onKeyUp="calculcate('{{ $value->id}}','{{ $value->itempekerjaan->code }}')" required>
                          <input type="hidden" class="nilai_percentage form-control"  value="{{ number_format($value->nilai,2) }}" autocomplete="off" onKeyUp="calculcate('{{ $value->id}}','{{ $value->itempekerjaan->code }}')" required>
                          <span id="nilai_percentage"></span>
                          @endif
                        </td>
                        <td>
                          @if ( $value->satuan == "%")
                            <span class="sub_percentage" id="sub_total_{{ $value->id}}">{{ number_format($value->volume * $value->nilai ,2) }}</span>
                          @else
                            <span id="sub_total_{{ $value->id}}">{{ number_format($value->volume * $value->nilai ,2) }}</span>
                          @endif
                        </td>    
                        <td>
                          
                          @if ( $value->satuan == "%")
                            <input type="hidden" class="nilai_percentage_m2 sub_totalm2_" id="sub_totalm2_{{ $value->id}}" value="{{ ($value->volume * $value->nilai) }}">
                            <span class="subm2_percentage" id="subm2_{{ $value->id}}">{{ number_format($value->volume * $value->nilai ,2) }}</span>
                          @else
                          <input type="hidden" class="sub_totalm2_" id="sub_totalm2_{{ $value->id}}" value="{{ ( ($value->volume * $value->nilai ) / $unit_category->unit_type->luas_bangunan) }}">
                          <span id="subm2_{{ $value->id}}">
                            @if ( $unit_category->unit_type->luas_bangunan > 0 )
                              {{ number_format( ($value->volume * $value->nilai ) / $unit_category->unit_type->luas_bangunan ,2) }}
                            @endif
                          </span>
                          @endif
                        </td>                
                      </tr>
                      @endforeach
                    @endif
                  </tbody>
                </table>
                <i class="fa fa-refresh ld ld-spin" id="loading" style="display: none;"></i>
              </form>

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

  function calculcate(id,code){
    var volume = parseInt($("#volume_" + id).val());
    var nilai = parseInt($("#nilai_" + id).val());
    var subtotal = parseInt(volume * nilai);
    var m2 = parseInt($("#luas_bangunan").val());
    var hpp = parseInt(subtotal / m2 );
    var hpp_total = parseInt(0);
    $("#sub_total_" + id).text(subtotal);
    $("#sub_total_" +id).number(true,2);

    $("#subm2_" + id).text(hpp);    
    $("#subm2_" +id).number(true,2);
    $("#sub_totalm2_" + id).val(hpp);

    if ( code == 100 ){
      $("#nilai_percentage").text(subtotal); 
      $("#nilai_percentage").number(true,2); 
      $(".nilai_percentage_val").val(subtotal);

      var percent = parseInt($(".percent").val());
      var nilai_percent = parseInt(percent * subtotal ) / 100 ;
      var nilai_percent_m2 = parseInt(nilai_percent / m2);

      $(".nilai_percentage").val(nilai_percent);
      $(".sub_percentage").text(nilai_percent);
      $(".sub_percentage").number(true,2);

      $(".nilai_percentage_m2").val(nilai_percent_m2);
      $(".subm2_percentage").text(nilai_percent_m2);
      $(".subm2_percentage").number(true,2);
    }

    $( ".sub_totalm2_" ).each(function( index ) {
      console.log( $(this).val());
      if ( $(this).val() != "NaN"){        
        var tmp_hpp_total = parseInt(parseInt($(this).val()) + parseInt(hpp_total));
        hpp_total = tmp_hpp_total;
        
      }
    });
    console.log(hpp_total);

    $("#concost").text(hpp_total);
    $("#concost").number(true,2);
  }
</script>
</body>
</html>
