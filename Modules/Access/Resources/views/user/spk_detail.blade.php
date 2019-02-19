<!DOCTYPE html>
<html>
@include('user.header')
<style type="text/css">
  .card-title{
    font-weight: bolder;
  }

  @media only screen and (max-width: 600px) {
    .annwijin {
      font-size: 12px !important;
    }
    .annwijin td{
      width : 100px !important;
    }
  }

   @media only screen and (min-width: 600px) {
       .annwijin td{
      width : 130px !important;
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
              <li class="breadcrumb-item active">SPK</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      <a href="{{ url('/') }}/access/" class="btn btn-warning">Back</a>
      @if ( $status == "")
      <a href="#" class="btn btn-info" onclick="setapproved('6')" data-toggle="modal" data-target="#myModal">Approve</a>
      <a href="#" class="btn btn-danger" onclick="setapproved('7')" data-toggle="modal" data-target="#myModal">Reject</a>
      @else
      {!! $status  !!}
      @endif
    </section>

    <!-- Main content -->
    <input type="hidden" name="project_id" id="project_id" value="{{ $spk->project_id }}"/>
    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}"/>
    <input type="hidden" name="spk_id" id="spk_id" value="{{ $spk->id }}"/>
    <section class="content" style="font-size:17px;">
      <div class="row">
        <div class="col-md-6">
          <div class="card">

            <!-- /.card-header -->
            <div class="card-body">
               <table id="example1" class="table table-bordered table-striped">

                  <tr>
                    <td style="background-color: grey;color:white;"><strong>Kawasan</strong></td>
                    <td>{{ $spk->tender->rab->budget_tahunan->budget->kawasan->name or '' }}</td>
                  </tr>
                  <tr>
                    <td style="background-color: grey;color:white;"><strong>PT</strong></td>
                    <td>{{ $project->pt_user->first()->pt->name }}</td>
                  </tr>
                  <tr>
                    <td style="background-color: grey;color:white;"><strong>Jenis Pekerjaan</strong></td>
                    <td>{{ $spk->name or ''}}</td>
                  </tr>
                  <tr>
                    <td style="background-color: grey;color:white;"><i>Total Nilai    (Rp)</i></td>
                    <td><strong>{{ number_format($spk->nilai + ( 0.1 * $spk->nilai)) }}</strong></td>
                  </tr>
                  <tr>
                    <td style="background-color: grey;color:white;"><strong>Department</strong></td>
                    <td>{{ $spk->tender->rab->workorder->detail_pekerjaan->first()->itempekerjaan->department->code or '' }} </td>
                  </tr>
                  <tr>
                    <td style="background-color: grey;color:white;"><strong>Lokasi</strong></td>
                    <td>
                      @if ( isset($spk->tender->rab->workorder->budget_tahunan->kawasan->name))
                      {{ $spk->tender->rab->workorder->budget_tahunan->kawasan->name }}
                      @else
                      {{ $spk->project->name or '' }}
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td style="background-color: grey;color:white;"><strong>Waktu Pelaksanaan</strong></td>
                    <td>{{ $spk->tender->rab->workorder->durasi }} Day / Hari</td>
                  </tr>
                </table><br>
            </div>
            <!-- /.card-body -->

          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->

        <div class="col-md-6">
          <div class="card">
       
            <!-- /.card-header -->
            <div class="card-body">
               <table id="example1" class="table table-bordered table-striped">
                  <tr>
                    <td style="background-color: grey;color:white;"><strong>SPK</strong></td>
                    <td>{{ $spk->no }}</td>
                  </tr>
                  <tr>
                    <td style="background-color: grey;color:white;"><strong>Tanggal</strong></td>
                    <td>{{  $spk->created_at->format('d M Y') }}</td>
                  </tr>
                  <tr>
                    <td style="background-color: grey;color:white;"><strong>PT</strong></td>
                    <td>{{ $spk->tender_rekanan->rekanan->name }}</td>
                  </tr>
                  <tr>
                    <td style="background-color: grey;color:white;"><strong>SUPP</strong></td>
                    <td>000{{ $spk->rekanan->supps->last()->no or ''}}</td>
                  </tr>
                </table><br>      
            </div>
            <!-- /.card-body -->

          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->

      </div>
      <!-- /.row -->
      <div class="row">
        
        <div class="col-md-6">
          <div class="card">
       
            <!-- /.card-header -->
            <div class="card-body">
               <table id="example1" class="table table-bordered table-striped annwijin">
                  <tr>
                    <td style="background-color: grey;color:white;"><strong>Tender No </strong></td>
                    <td>{{ $spk->tender->no or '' }}</td>
                  </tr>
                  <tr>
                    <td style="background-color: grey;color:white;"><strong>Document</strong></td>
                    <td>
                      @foreach ( $spk->tender->tender_document as $key => $value )
                      <li>{{ $value->document_name or ''}}</li>
                      @endforeach
                    </td>
                  </tr>
                  <tr>
                    <td style="background-color: grey;color:white;"><strong>Aan Wijing</strong></td>
                    <td>{{ $spk->tender->aanwijzing_date->format('d M Y')}}</td>
                  </tr>
                  @foreach ( $spk->tender_rekanan->penawarans as $key => $value )
                  <tr>
                    <td style="background-color: grey;color:white;"><strong>Penawaran ke {{ $key + 1 }}</strong></td>                    
                    <td>
                      {{ $value->date->format("d/m/Y") }}
                      <br>
                      
                      @if ( $key == 0 )
                      Klarifikasi ke 1 : <strong>{{ $spk->tender->klarifikasi1_date->format("d/m/Y") }}</strong> 
                      @elseif ( $key == 1)
                      Klarifikasi ke 2 : <strong>{{ $spk->tender->klarifikasi2_date->format("d/m/Y") }}</strong>
                      @else
                      Klarifikasi ke 3 : <strong>{{ $spk->tender->pengumuman_date->format("d/m/Y") }}</strong>
                      @endif
                     
                    </td>
                  </tr>
                  @endforeach
                  
                </table><br>      
            </div>
            <!-- /.card-body -->

          </div>
          <!-- /.card -->
        </div>

        <div class="col-md-6">
          <div class="card">

            <!-- /.card-header -->
            <div class="card-body">
               <table id="example1" class="table table-bordered table-striped annwijin">
                  <tr>
                    <td style="background-color: grey;color:white;"><strong>DPP (Rp)</strong></td>
                    <td>{{ number_format($spk->nilai) }}</td>
                  </tr>
                  <tr>
                    <td style="background-color: grey;color:white;"><strong>PPN (Rp)</strong></td>
                    <td>{{ number_format($ppn = ( 0.1 * $spk->nilai ) )}}</td>
                  </tr>
                  <tr>
                    <td style="background-color: grey;color:white;"><i>Total Nilai (Rp)</i></td>
                    <td>{{ number_format($spk->nilai + $ppn) }}</td>
                  </tr>
                   <tr>
                    <td style="background-color: grey;color:white;"><i>Terbilang</i></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td style="background-color: grey;color:white;"><strong>Jenis Kontrak</strong></td>
                    <td>{{ $spk->jenis_kontrak}}</td>
                  </tr>
                  
                </table><br>  
                <span><strong>Metode Pembayaran</strong></span><br>
                <p>{!! $spk->memo_cara_bayar !!}</p>
    
            </div>
           
        <!-- /.col -->
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
<script type="text/javascript">
  function setapproved(id){
    if ( id == "6"){
      $("#title_approval").attr("style","color:blue;font-weight:bolder");
      $("#title_approval").html("<strong>You will be Approve this SPK.</strong>");
    }else{
      $("#title_approval").attr("style","color:red;font-weight:bolder");
      $("#title_approval").html("<strong>You will be Reject this SPK.</strong>");
    }
    $("#approval_value").val(id);
  }

  function requestApproval(){
    if ( $("#approval_value").val() == "7" ){
      if ( $("#description").val() == "" ){
        alert("Harap isi keterangan terlebih dahulu");
        return false;
      }
    }

    var request = $.ajax({
       url : "{{ url('/') }}/access/spk/approve/",
       dataType : "json",
       data : {
          approve : $("#approval_value").val(),
          user_id : $("#user_id").val(),
          project_id : $("#project_id").val(),
          spk_id : $("#spk_id").val(),
          description : $("#description").val()
       },
       type : "get"
    })

    request.done(function(data){
      if ( data.status == "0"){
        window.location.reload();
      }
    })
  }
</script>
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br>
      </div>
      <div class="modal-body">
        <span id="title_approval"><strong></strong></span>
        <p></p>
        <div id="listdetail">
            <input type="hidden" name="approval_value" id="approval_value" value="">
            <textarea name="description" id="description" rows="6" cols="30"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn_save_budgets" data-value="" onclick="requestApproval()">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</body>
</html>
