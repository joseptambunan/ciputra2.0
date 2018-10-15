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
      <a href="{{ url('/') }}\user\project" class="btn btn-warning">Back</a>
      @if ( $tender->approval->histories->where("user_id",$user->id)->first()->approval_action_id == "1")    
      <a href="#" class="btn btn-info" onclick="setapproved('6')" data-toggle="modal" data-target="#myModal4">Approve</a>
      <a href="#" class="btn btn-danger" onclick="setapproved('7')" data-toggle="modal" data-target="#myModal4">Reject</a>
      @elseif ( $tender->approval->histories->where("user_id",$user->id)->first()->approval_action_id == "6")  
      <span class="badge bg-success" style="font-size:20px;">Approved</span>  
      @endif
    </section>

    <!-- Main content -->
    <input type="hidden" name="project_id" id="project_id" value="{{ $tender->rab->workorder->project->first()->id }}"/>
    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}"/>
    <input type="hidden" name="approval_id" id="approval_id" value="{{ $approval_id }}"/>    
    <input type="hidden" name="tender_id" id="tender_id" value="{{ $tender->id }}"/>
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
                      <td>{{ $tender->name }}</td>
                    </tr>               
                    <tr>
                      <td style="background-color: grey;"><span style="color:white"><strong>Project / Kawasan</strong></span></td>
                      <td>{{ $project->name or '' }} / {{ $tender->rab->workorder->budget_tahunan->budget->kawasan or '' }}</td>
                    </tr>
                     <tr>
                      <td style="background-color: grey;"><span style="color:white"><strong>Paket Pekerjaan</strong></span></td>
                      <td><a href="{{ url('/')}}/user/tender/workorder/?id={{ $tender->rab->workorder->id }}&tender={{ $tender->id }} ">Workorder : {{ $tender->rab->workorder->no or ''}}</a></td>
                    </tr>
                    <tr>
                      <td style="background-color: grey;"><span style="color:white"><strong>RAB</strong></span></td>
                      <td><a href="{{ url('/')}}/user/tender/rab/?id={{ $tender->rab->id }}&tender={{ $tender->id }} ">{{ $tender->rab->no }}</a></td>
                    </tr>
                    <tr>
                      <td style="background-color: grey;"><span style="color:white"><strong>Nilai ( Exc. Ppn )</strong></span></td>
                      <td>Rp. {{ number_format($tender->rab->nilai,2) }}</td>
                    </tr>
                  </table><br>
                </div>
              </div> 


              <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Penawaran Akhir </a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Detail Penawaran</a></li>
                 </ul>
              </div><!-- /.card-header -->
              <div class="card-body tables">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <!-- List Approval Peserta Tender-->
                    @if ( $request_tender_rekanan > 0 )  
                    <div class="card-body table-responsive p-0">
                      <table class="table table-hover table-striped table-bordered">
                        <tr>
                          <td colspan="4" style="background-color: grey;"><center>Daftar Rekanan</center></td>
                        </tr>
                        <tr style="background-color: #17a2b8 ">
                          <td style="padding-left: 0xp !important;">Rekanan</td>
                          <td>Address</td>
                          <td>Contact Number</td>
                          <td>Approval Status</td>
                        </tr>
                        @foreach($tender->rekanans as $key2 => $each )
                        @if ( $each->approval->histories->where("approval_id",$each->approval->id)->first()->approval_action_id == "1" )
                        <tr>
                            <td>{{ $each->rekanan->group->name }} </td>  
                            <td>{{ $each->rekanan->surat_alamat }} </td>  
                            <td>{{ $each->rekanan->telp }} </td>  
                            @if ( $each->approval->histories->where("approval_id",$each->approval->id)->first()->approval_action_id == "6" )
                            <td style="background-color: green;color:white;"><strong>APPROVED</strong></td>
                            @elseif ( $each->approval->histories->where("approval_id",$each->approval->id)->first()->approval_action_id == "1" )
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
                        @endif
                        @endforeach
                      </table>         
         
                    <br><br>    
                    @if ( $request_tender_rekanan > 0 )  
                    <button class="btn btn-info" onclick="requestRekanan()" data-toggle="modal" data-target="#myModal2">Send Approve</button>  
                    @endif
                    </div>
                    @endif

                    <!-- List Approval Penawaran Tender -->  
                    <center><span style="font-size: 18px;" class="labeltable"><strong>Rekap Penawaran Terakhir Rekanan</strong></span></center>
                    <div class="card-body table-responsive p-0">
                      <table id="example3" class="table table-hover table-bordered">
                        <thead>
                          <tr style="background-color: #17a2b8 ;color:white;">
                            <th>Rekanan</th>
                            <th>SPH</th>
                            <th>Contact Number</th>
                            <th>PIC</th>
                            <th>DPP</th>
                            <th>Ppn</th>
                            <th>Subtotal (Rp)</th>
                          </tr>
                        </thead>
                        <tbody style="background-color: white;">                  
                        @foreach($tender->rekanans as $key2 => $each )
                        <tr>
                            <td style="padding-left: 0px !important;">{{ $each->rekanan->group->name }}</td>  
                            <td>{{ count($each->penawarans) }}</td>
                            <td>{{ $each->rekanan->telp }} </td>  
                            <td>{{ $each->rekanan->cp_name }} </td> 
                            <td><span>@if (isset($each->penawarans->last()->nilai)) {{ number_format($each->penawarans->last()->nilai)  }} @endif</span></td> 
                            <td><span>@if (isset($each->penawarans->last()->nilai_ppn)){{ round($each->penawarans->last()->nilai_ppn) }} @endif</span></td> 
                            <td><span>@if (isset($each->penawarans->last()->nilai_total)){{ number_format($each->penawarans->last()->nilai_total) }} @endif</span></td>                                      
                        </tr>
                       
                        @endforeach
                      </tbody>
                      </table>         
                    <br><br>
                    <!-- List Approval Penawaran Tender -->             
                    </div>

                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                      <!-- List Approval Peserta Tender-->
                      <center><span style="font-size: 18px;" class="labeltable"><strong>Rekap Detail Penawaran (Exclude PPN)</strong></span></center>
                      <div class="card-body table-responsive p-0">
                        <table class="table table-hover table-striped table-bordered" id="detail_penawaran">
                          <tr style="background-color: #17a2b8;color:white;">
                            <td>Rekanan</td>
                            <td>SPH 1</td>
                            <td>SPH 2</td>
                            <td style="padding-left:2%;">SPH 3</td>
                            <td>Recomended Status</td>
                            <td style="width: 20%;">Actions</td>
                          </tr>
                          @php $approval_id = "" @endphp
                          @foreach($tender->rekanans as $key2 => $each )
                          @php $approval_id .=  $each->approval->id."," @endphp                          
                          <tr>
                              <td><span id="rekanan_{{ $each->approval->id }}">{{ $each->rekanan->group->name }}</span></td>
                              @foreach ( $each->penawarans as $key3 => $value3)
                              <td>{{ number_format($value3->nilai) }}</td>
                              @endforeach
                              <td style="background-color: white;">
                                @if ( $each->is_pemenang == "1" )                                
                                <span style="color: green"><strong>Recomended Winner</strong></span>
                                @endif
                              </td>
                              @if ( $each->approval->approval_action_id == "1" )
                                <td><button class="btn btn-success btn-sm approval" data-toggle="modal" data-target="#myModal3"  data-approval="{{ $each->approval->id }}" onclick="setapprove('6','{{ $each->approval->id }}')">Approve</button></td>
                              @elseif ( $each->approval->approval_action_id == "6" )
                                <td style="background-color: green;color:white;"><strong>Approved</strong></td>
                              @else
                                <td style="background-color: red;color:white;"><strong>Rejected</strong></td>
                              @endif
                          </tr>                          
                          @endforeach
                        </table>         
                    
                      <br><br>    
                      @if ( $request_tender_rekanan > 0 )  
                      <button class="btn btn-info" onclick="requestRekanan()" data-toggle="modal" data-target="#myModal2">Send Approve</button>  
                      @endif
                      </div>
                  </div>
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
              <div class="col-md-4">
              <table class="table table-bordered table-striped">
                <tr>
                  <td>Username</td>
                </tr>
                @foreach ( $approval as $key2 => $value2 )
                <tr>
                  <td>
                    @if ( $value2->approval_action_id == "6")
                    <input type="checkbox" name="approval_id" value="" id="" disabled checked> <strong>{{ $value2->user->user_name or '' }}</strong>
                    @else
                    <input type="checkbox" name="approval_id" value="" id="" disabled>{{ $value2->user->user_name or '' }}
                    @endif
                  </td>
                </tr>
                @endforeach
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
@include('project.user.tender_js')


<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br>
      </div>
      <div class="modal-body">
        <span id="title_approval"><strong></strong></span>
        <p></p>
        <span id="label_rekanan"></span>
        <div id="listdetail">
          <table style="width: 100%;height: 50%; overflow:scroll;">
            <thead>
              <tr style="background-color: #17a2b8;">
                <th>Penawaran 1</th>
                <th>Penawaran 2</th>
                <th>Penawaran 3</th>
              </tr>
            </thead>
            <tbody id="tender_preview_penawaran">
              
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn_save_budgets" data-value="" onclick="requestApproval()">Save changes</button>
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

<div class="modal fade" tabindex="-1" role="dialog" id="myModal3">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br>
      </div>
      <div class="modal-body">
        <input type="hidden" name="list_rekanan_approval_id" id="list_rekanan_approval_id" value="{{ $approval_id }}">
        <input type="hidden" name="rekanan_approval_id" id="rekanan_approval_id">
        <span id="title_approval_rekanan"><strong></strong></span>
        <p></p>
        <div id="listdetail">
            <textarea name="description" id="description" rows="6" cols="30"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn_approval" data-value="" onclick="requestPemenang()">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
</body>
</html>
