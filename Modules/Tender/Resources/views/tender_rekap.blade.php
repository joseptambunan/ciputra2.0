<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard </title>
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
      <h1>Data Tender <strong>{{ $tender->rab->pekerjaans->first()->itempekerjaan->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">              
              <a href="{{ url('/')}}/tender/detail/?id={{ $tender->id }}" class="btn btn-warning">Kembali</a>
              <table class="table table-bordered ">
                <thead class="head_table">
                  <tr>
                    <td rowspan="2">No.</td>
                    <td rowspan="2">Item Pekerjaan</td>
                    <td rowspan="2">Volume</td>
                    <td rowspan="2">Satuan</td>
                    <td colspan="{{ count($tender->tender_approve) + 1 }}"><center>Harga Satuan</center></td>
                    <td colspan="{{ count($tender->tender_approve) + 1 }}"><center>Total Nilai(Rp)</center></td>
                  </tr>
                  <tr>                    
                    <td>OE</td>                    
                    @foreach ( $tender->rekanans as $key1 => $value1 )
                    @if ( $value1->approval->approval_action_id != "" )
                      @if ( $value1->approval->approval_action_id == "6")
                    <td>{{ $value1->rekanan->group->name}}</td>
                    @endif
                    @endif
                    @endforeach

                    <td>OE</td>
                    @foreach ( $tender->rekanans as $key1 => $value2 )
                    @if ( $value2->approval->approval_action_id != "" )
                      @if ( $value2->approval->approval_action_id == "6")
                      <td>{{ $value2->rekanan->group->name}}</td>
                      @endif
                    @endif
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                  @php $nilai_oe_total = 0; @endphp
                  @foreach($tender->rab->pekerjaans as $key => $value )
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->itempekerjaan->name }}</td>
                    
                    @foreach ( $tender->rekanans->take(1) as $key1 => $value2 )
                    @if ( count($value2->penawarans) > 0 )
                     @if ( $value2->approval->approval_action_id != "" )
                      @if ( $value2->approval->approval_action_id == "6")
                        @foreach ( $value2->penawarans as $key2 => $value3 )
                        @if ( $key2 == $step )

                          @if (isset(\Modules\Tender\Entities\TenderPenawaranDetail::where("tender_penawaran_id",$value3->id)->where("rab_pekerjaan_id",$value->id)->get()->first()->nilai))
                            <td style="text-align: right;">{{ number_format(\Modules\Tender\Entities\TenderPenawaranDetail::where("tender_penawaran_id",$value3->id)->where("rab_pekerjaan_id",$value->id)->get()->first()->volume,2)  }}</td>
                            
                          @endif
                        @endif
                        @endforeach
                      @endif
                      @endif
                      @endif
                    @endforeach
                    
                    <td>{{ $value->satuan }}</td>
                    <td style="text-align: right;">{{ number_format($value->nilai) }}</td>
                    @foreach ( $tender->rekanans as $key1 => $value2 )
                    @if ( count($value2->penawarans) > 0 )
                     @if ( $value2->approval->approval_action_id != "" )
                      @if ( $value2->approval->approval_action_id == "6")
                        @foreach ( $value2->penawarans as $key2 => $value3 )
                        @if ( $key2 == $step )

                          @if (isset(\Modules\Tender\Entities\TenderPenawaranDetail::where("tender_penawaran_id",$value3->id)->where("rab_pekerjaan_id",$value->id)->get()->first()->nilai))
                            <td style="text-align: right;">{{ number_format(\Modules\Tender\Entities\TenderPenawaranDetail::where("tender_penawaran_id",$value3->id)->where("rab_pekerjaan_id",$value->id)->get()->first()->nilai,2)  }}</td>
                            
                          @endif
                        @endif
                        @endforeach
                      @endif
                      @endif
                    @else
                    
                    @endif
                    @endforeach

                    <td style="text-align: right;">{{ number_format($value->nilai * $value->volume,2) }}</td>
                    @foreach ( $tender->rekanans as $key1 => $value2 )
                    @if ( count($value2->penawarans) > 0 )
                      @if ( $value2->approval->approval_action_id != "" )
                        @if ( $value2->approval->approval_action_id == "6")
                          @foreach ( $value2->penawarans as $key2 => $value3 )
                          @if ( $key2 == $step )

                            @if (isset(\Modules\Tender\Entities\TenderPenawaranDetail::where("tender_penawaran_id",$value3->id)->where("rab_pekerjaan_id",$value->id)->get()->first()->nilai))
                              <td style="text-align: right;">{{ number_format(\Modules\Tender\Entities\TenderPenawaranDetail::where("tender_penawaran_id",$value3->id)->where("rab_pekerjaan_id",$value->id)->get()->first()->nilai * \Modules\Tender\Entities\TenderPenawaranDetail::where("tender_penawaran_id",$value3->id)->where("rab_pekerjaan_id",$value->id)->get()->first()->volume,2 )  }}</td>
                              
                            @endif
                          @endif
                          @endforeach
                        @endif
                      @endif
                    @else
                    
                    @endif
                    @endforeach
                    @php $nilai_oe_total =  $nilai_oe_total + ( $value->nilai * $value->volume ); @endphp
                  </tr>
                  @endforeach
                  
                  <tr>                   

                    <td colspan="{{ 5 + count($tender->tender_approve) }}" style="text-align: right;"><strong><i>Subtotal</i></strong></td>
                    <td style="text-align: right;">{{ number_format($nilai_oe_total)}}</td>
                    @foreach ( $tender->rekanans as $key3 => $value3 )
                      @if ( count($value3->penawarans) > 0 )
                        @foreach ( $value3->penawarans as $key4 => $value4 )
                          @if ( $key4 == $step )
                          <td style="text-align: right;">{{ number_format($value4->nilai) }}</td>
                          @endif
                        @endforeach
                      @else
                      @endif
                    @endforeach
                  </tr>
                  <tr>                   
                    <td colspan="{{ 5 + count($tender->tender_approve) }}" style="text-align: right;"><strong><i>Pembulatan</i></strong></td>
                    <td style="text-align: right;">{{ number_format($nilai_oe_total)}}</td>
                     @foreach ( $tender->rekanans as $key3 => $value3 )
                      @if ( count($value3->penawarans) > 0 )
                        @foreach ( $value3->penawarans as $key4 => $value4 )
                          @if ( $key4 == $step )
                          <td style="text-align: right;">{{ number_format($value4->nilai) }}</td>
                          @endif
                        @endforeach
                      @else
                      @endif
                     @endforeach
         
                  </tr>
                  <tr>
                    <td colspan="{{ 5 + count($tender->tender_approve) }}" style="text-align: right;"><strong><i>PPn</i></strong></td>
                    <td style="text-align: right;">{{ number_format($nilai_oe_total * 0.1 )}}</td>
                       @foreach ( $tender->rekanans as $key3 => $value3 )
                       @if ( count($value3->penawarans) > 0 )
                        @foreach ( $value3->penawarans as $key4 => $value4 )
                          @if ( $key4 == $step )
                            @if ( $value3->rekanan->pkp_status == "1" )
                              <td style="text-align: right;">{{ number_format($ppn = 0) }}</td>
                            @else
                              <td style="text-align: right;">{{ number_format($ppn = 0.1 * $value4->nilai) }}</td>
                            @endif
                          @endif
                        @endforeach
                        @else
                        @endif
                      @endforeach
                   
                  </tr>
                  <tr>
                    <td colspan="{{ 5 + count($tender->tender_approve) }}" style="text-align: right;"><strong><i>Grand Total</i></strong></td>
                    <td style="text-align: right;">{{ number_format($nilai_oe_total + ($nilai_oe_total * 0.1 )) }}</td>
                    @foreach ( $tender->rekanans as $key3 => $value3 )
                      @if ( count($value3->penawarans) > 0 )
                        @foreach ( $value3->penawarans as $key4 => $value4 )
                          @if ( $key4 == $step )
                            @if ( $value3->rekanan->pkp_status == "1" )
                              <td style="text-align: right;">{{ number_format($value4->nilai) }}</td>
                            @else
                              <td style="text-align: right;">{{ number_format( ($value4->nilai * 0.1 ) + $value4->nilai ) }}</td>
                            @endif
                          @endif
                        @endforeach
                      @else
                      @endif
                    @endforeach
                  </tr>
                </tbody>
              </table>
              <h4>Dokumen Pendukung</h4>
              <table class="table table-bordered">
                <thead class="head_table">
                  <tr>
                    <th>Rekanan</th>
                    <th>Nama Dokumen</th>
                    <th>Download</th>
                  </tr>
                </thead>
                <tbody>                  
                  @foreach( $tender->rekanans as $key3 => $value4 )
                    @foreach ( $value4->penawarans as $key5 => $value5 )
                      @if ( $key5 == $step)
                      <tr>
                        <td>{{ $value5->rekanan->rekanan->group->name }}</td>
                        <td>{{ $value5->file_attachment }}</td>
                        <td>
                          @if ( $value5->file_attachment != "")
                          <a class="btn btn-success" href="{{ url('/') }}/tender/download/?id={{ $value5->id}}">Download</a>
                          @endif
                        </td>
                      </tr>
                      @endif
                    @endforeach
                  @endforeach
                </tbody>
              </table>
            </div>
            <hr>
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

  



</div>
<!-- ./wrapper -->

@include("master/footer_table")
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/jquery.number.min.js"></script>
<script type="text/javascript">
  $(".vol").number(true);
</script>
@include("pekerjaan::app")
</body>
</html>
