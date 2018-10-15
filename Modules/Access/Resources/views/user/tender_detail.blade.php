<!DOCTYPE html>
<html>
@include('user.header')

<style type="text/css">
    #example3 th,
    #example3 td {
        white-space: nowrap;
    }
   
    @media only screen and (max-width: 600px) {
      .table {
        font-size :12px;
      }

      #label_rekap_penawaran {
        display: none;
      }
    
      .labeltable{
        font-size: 12px !important;
      }
     
      .card-body.tables{
        padding:0px !important;
      }

      .nav.nav-pills.ml-auto.p-2{
        font-size: 12px;
      }

      #detail_penawaran{
        font-size: 12px !important;
      }

      #example3_filter{
        display: none;
      }
    }
</style>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
 
  <!-- /.navbar -->
  @include('user.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Project <strong>{{ $project->name or '' }}</strong></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item">Tender</li>
              <li class="breadcrumb-item active">Project {{ $tender->rab->workorder->project->first()->name or '' }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      
    </section>

    <!-- Main content -->
    <input type="hidden" name="project_id" id="project_id" value="{{ $tender->rab->workorder->project->first()->id }}"/>
    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}"/>
    <input type="hidden" name="approval_id" id="approval_id" value="{{ $approval_id }}"/>    
    <input type="hidden" name="tender_id" id="tender_id" value="{{ $tender->id }}"/>
    <input type="hidden" name="apporval_value" id="apporval_value">
    {{ csrf_field() }}
    <section class="content" style="font-size:17px;">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Document <strong>Tender</strong></h3>
              
            
            </div>
            <!-- /.card-header -->
            
            <div class="card-body">
              <div class="col-md-6">
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover table-striped table-bordered">
                    <tr>
                      <td style="background-color: grey;"><span style="color:white"><strong>No. Dokument</strong></span></td>
                      <td>{{ $tender->no }}</td>
                    </tr>               
                    <tr>
                      <td style="background-color: grey;"><span style="color:white"><strong>Project / Kawasan</strong></span></td>
                      <td>{{ $tender->rab->workorder->project->first()->name or '' }} </td>
                    </tr>
                     <tr>
                      <td style="background-color: grey;"><span style="color:white"><strong>Paket Pekerjaan</strong></span></td>
                      <td><a href="{{ url('/')}}/user/workorder/detail?id={{ $tender->rab->workorder->id }}">Workorder : {{ $tender->rab->workorder->no or ''}}</a></td>
                    </tr>
                    <tr>
                      <td style="background-color: grey;"><span style="color:white"><strong>RAB</strong></span></td>
                      <td><a href="{{ url('/')}}/user/rab/detail/?id={{ $tender->rab->id }}">{{ $tender->rab->no }}</a></td>
                    </tr>
                    <tr>
                      <td style="background-color: grey;"><span style="color:white"><strong>Nilai ( Exc. Ppn )</strong></span></td>
                      <td>Rp. {{ number_format($tender->rab->nilai,2) }}</td>
                    </tr>
                  </table><br>
                </div>
              </div> 

              
              <div class="col-md-12">

                <form action="{{ url('/')}}/access/tender/document/save" method="post" name="form1">
                  {{ csrf_field() }}

                <input type="hidden" name="tender_docs" value="{{ $tender->id }}">
                <table class="table table-hover table-striped table-bordered">
                  <tr style="background-color: #17a2b8;color:white; ">
                    <td colspan="2">Checked By</td>
                    @if ( $tender->tender_document->count() > 0 )
                    @foreach($tender->tender_document->first()->document_approval as $key2 => $value2 )
                    <td>{{ $value2->user->user_name }}</td>
                    @endforeach
                    @endif
                  </tr>
                  @foreach ( $tender->tender_document as $key => $value )
                  <tr>
                    <td style="background-color: grey;"><strong><span style="color:white">Jenis Dokumen</span></strong></td>
                    <td>{{ $value->document_name }}</td>
                    @foreach($value->document_approval as $key2 => $value2 )
                    <td>
                      @if ( $value2->user_id == $user->id )
                        @if ( $value2->status == 1 )
                          <input  type="radio" name="status[{{$key}}]" id="approved{{$value2->id}}" value="6" checked>
                          <span class="badge bg-success"><strong>Approve</strong></span><br>
                          <input  type="radio" name="status[{{$key}}]" id="rejected{{$value2->id}}" value="7">
                          <span class="badge bg-danger"><strong>Rejected</strong></span><br>
                          <input type="hidden" name="document_id[{{ $key  }}]" value="{{ $value2->id }}">

                        @elseif ( $value2->status == null )
                          <span>Belum Proses</span>
                        @else
                           @if ( $value2->status == "6")
                            <span class="label label-success">Diterima</span>
                            @else
                            <span class="label label-danger">Ditolak</span>
                            @endif
                        @endif
                      @else
                        @if ( $value2->status == "6")
                        <span class="label label-success">Diterima</span>
                        @elseif ( $value2->status == "7")
                        <span class="label label-danger">Ditolak</span>
                        @elseif ( $value2->status == "1")
                        <span class="label label-warning">Dalam Proses</span>
                        @elseif ( $value2->status == null )
                        <span>Belum Proses</span>
                        @endif         
                      
                      @endif
                    </td>
                    @endforeach
                  </tr>
                  @endforeach
                </table>

                @if ( $tender->check_rejected > 0 )
                  <button type="submit" class="btn btn-primary">Simpan</button>
                @endif
                </form>

              </div>

              <h3><u><center>Unit</center></u></h3>
              <table class="table-bordered table">

                <tbody>
                  
                  <tr>
                    @foreach ( $tender->units as $key => $value )
                    <td>
                      {{ $value->rab_unit->asset->name }}
                      @if ( $value->rab_unit->asset_type == "Modules\Project\Entities\Unit")<br>
                      <span> Type : {{ $value->rab_unit->asset->type->name }} </span><br>
                      <span> LT : {{ $value->rab_unit->asset->type->luas_tanah }} m</span><br>
                      <span> LB : {{ $value->rab_unit->asset->type->luas_bangunan }} m</span><br>
                      @endif
                    </td>
                    @endforeach
                  </tr>
                 
                </tbody>
              </table>

              <h3><u><center>Item Pekerjaan</center></u></h3>
              <div class="col-md-12">
               
                  
                <table class="table table-bordered">
                <thead>
                  <tr style="background-color: #17a2b8;color:white; ">
                    <th>COA</th>
                    <th>Work Item</th>
                    <th>Volume</th>
                    <th>Unit</th>
                    <th>Nilai</th>
                    <th>Subtotal (Rp)</th>
                  </tr>
                </thead>
                <tbody>
                  <tr style="background-color: grey;color:white;">
                  @foreach ( $tender->rab->pekerjaans as $key => $value )
                  @if ( $value->nilai != '')
                  <tr>
                    <td>{{ $value->itempekerjaan->code }}</td>
                    <td>{{ $value->itempekerjaan->name }}</td>
                    <td>{{ $value->volume }}</td>
                    <td>{{ $value->satuan }}</td>
                    <td>{{ number_format($value->nilai) }}</td>
                    <td>{{ number_format($value->nilai * $value->volume ) }}</td>                    
                  </tr>
                  @endif
                  @endforeach
                </tbody>
              </table>
                  
           
              </div>
              <h3><u><center>Rekanan</center></u></h3>
              <div class="col-md-12">
              <table class="table table-hover table-striped table-bordered">
                <tr>
                  <td colspan="4" style="background-color: grey;color:white;font-weight: bolder;"><center>Daftar Rekanan</center></td>
                </tr>
                <tr style="background-color: #17a2b8 ">
                  <td style="padding-left: 0xp !important;">Rekanan</td>
                  <td>Address</td>
                  <td>Contact Number</td>
                  <td>Approval Status</td>
                </tr>
                @foreach($tender->rekanans as $key2 => $each )
                
                <tr>
                    <td>{{ $each->rekanan->group->name }} </td>  
                    <td>{{ $each->rekanan->surat_alamat }} </td>  
                    <td>{{ $each->rekanan->telp }} </td>  
                    @if ( $each->approval->histories->where("approval_id",$each->approval->id)->where("user_id",$user->id)->first()->approval_action_id == "6" )
                    <td style="background-color: green;color:white;"><strong>APPROVED</strong></td>
                    @elseif ( $each->approval->histories->where("approval_id",$each->approval->id)->where("user_id",$user->id)->first()->approval_action_id == "7" )
                    <td style="background-color: red;color:white;"><strong>REJECTED</strong></td>
                    @elseif ( $each->approval->histories->where("approval_id",$each->approval->id)->where("user_id",$user->id)->first()->approval_action_id == "1" )
                    <td style="background-color: white;color:white;">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="approve{{$each->approval->id}}" id="approved{{$each->approval->id}}" value="6" checked>
                        <span class="badge bg-success"><strong>Approve</strong></span><br>
                        <input class="form-check-input" type="radio" name="approve{{$each->approval->id}}" id="rejected{{$each->approval->id}}" value="7">
                        <span class="badge bg-danger"><strong>Rejected</strong></span><br>
                      </div>
                    </td>
                    @endif 
                </tr>
               
                @endforeach
              </table>
              <br><br>    

              @if ( $request_tender_rekanan > 0 )  
                @if ( $tender->check_rejected == "0" )
                  <button class="btn btn-info" onclick="requestRekanan()" data-toggle="modal" data-target="#myModal2">Send Approve</button> 
                @endif 
              @endif 
              </div> <br> 
              <div class="col-md-12">
                <table class="table table-bordered">
                  <thead style="background-color: #17a2b8;color:white;font-weight: bolder; ">
                    <tr>
                      <td>Item Pekerjaan</td>
                      <td></td>
                      <td>Penawaran 1</td>
                      <td>Penawaran 2</td>
                      <td>Penawaran 3</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Item Pekerjaan</td>
                      <td></td>
                      <td>
                        <a href="{{ url('/')}}/access/tender/detail-penawaran?id={{$tender->id}}&step=1" class="btn btn-warning">Detail</a>
                      </td>
                      <td>
                        <a href="{{ url('/')}}/access/tender/detail-penawaran?id={{$tender->id}}&step=2" class="btn btn-warning">Detail</a>
                      </td>
                      <td>
                        <a href="{{ url('/')}}//access/tender/detail-penawaran?id={{$tender->id}}&step=3" class="btn btn-warning">Detail</a>
                      </td>
                    </tr>
                    @foreach( $tender->rekanans as $key2 => $value2)
                      <tr>
                        <td>{{ $value2->rekanan->group->name }} {{ $value2->id }}</td>
                         <td>
                          @if ( count($tender->menangs) <= 0 )
                           
                          @else
                            @if ( $value2->is_pemenang == "2")
                            <strong><h3>Pemenang Tender</h3></strong>
                            @else
                              
                              @if ( $value2->is_pemenang == "0")
                              <button href="{{ url('/')}}" class="btn btn-primary" onClick="setujuipemenang('{{ $value2->id }}')">Setujui sebagai Pemenang</button>        
                              @endif                                                            
                              
                              @if ( $value2->is_pemenang == "3")
                              <strong>Ditolak sebagai pemenang</strong>
                              @endif
                             
                              @if ( $value2->is_recomendasi == "1")
                              <i>Rekomendasi</i>
                              @endif 
                             
                            @endif
                          @endif
                         </td>
                        @foreach ( $value2->penawarans as $key3 => $value3)
                        <td>
                          <span style="font-size: 14px;">{{ number_format($value3->nilai) }}</span>
                         
                        </td>
                        @endforeach
                      
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>  
            <!-- ./card -->
              <div class="col-md-12">
              <table class="table table-bordered table-striped">
                <tr class="header_1">
                  <td style="width: 15%;">Username</td>
                  <td style="width: 15%;">Request At</td>
                  <td style="width: 15%;">Status</td>
                  <td style="width: 15%;">Time Left (days)</td>
                  <td>Reason</td>
                </tr>
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
                  <td>@if ( $value2->approval_action_id == "7")
                    {{ $value2->description or  '' }}
                  @endif</td>
                </tr>
                @endforeach
                @endif
              </table>
            </div>

            </div>
            <!-- /.card-body -->

          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.0-alpha
    </div>
    <strong>Copyright &copy; 2014-2018 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>


</div>
<!-- ./wrapper -->
@include('user.footer')
@include('access::user.tender_js')

<script type="text/javascript">
  $(document).ready(function() {
    $('#example3').DataTable( {
        scrollY:        300,
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   {
          leftColumns: 1,
        }
    } );
  });

  function disablebtn(id){
    var valor = [];
    $('input.paramdisable[type=checkbox]').each(function () {
        if (this.checked)
          valor.push($(this).val());
    });

    console.log(valor.length);

    if (valor.length < 4 ) {
      $("#btn_approval_rekanan").attr("disabled","disabled");
    }else{
      $("#btn_approval_rekanan").removeAttr("disabled");
    }
  }

</script>
<div class="modal fade" tabindex="-1" role="dialog" id="myModal4">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br>
      </div>
      <div class="modal-body">
        <span id="title_approvaled"><strong></strong></span>
        <p></p>
        <div id="listdetail">
            <textarea name="description" id="description" rows="6" cols="30"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn_saved_tendered" data-value="" onclick="requestTender()">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="myModal2">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br>
      </div>
      <div class="modal-body">
        <span id="title_approval"><strong>Preview Approve</strong></span>
        <p></p>
        <table style="width: 100%;" class="table table-striped table-bordered"> 
          <thead style="background-color: #17a2b8 ">
          <tr>
            <td>Name</td>
            <td>Status</td>
            <td>Description</td>
          </tr>
        </thead>
        <tbody id="bodylist">
          @foreach($tender->rekanans as $key2 => $each )
            @if ( $each->approval->histories->where("approval_id",$each->approval->id)->first()->approval_action_id == "1" )
            <tr>
              <td>{{ $each->rekanan->group->name }}</td>
              <td id="status{{$each->approval->id}}"></td>
              <td><input type="text" name="description" id="description{{ $each->approval->id }}"></td>
            </tr>    
            @endif
          @endforeach
        </tbody>
        </table>
        <input type="hidden" name="apporval_value" id="apporval_value">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="btn_save_budgets" data-value="" onclick="requestRekananApproval()">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</body>
</html>
