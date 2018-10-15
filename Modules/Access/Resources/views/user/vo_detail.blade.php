<!DOCTYPE html>
<html>
@include('user.header')
<style type="text/css">
  #example3 th,
    #example3 td {
        white-space: nowrap;
    }
    @media only screen and (max-width: 600px) {
      #example2{
        display: inline !important;
        font-size: 12px !important;
        padding: 0px !important;
      }

      #example1{
        display: none;
      }

      .vototal{
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
              <li class="breadcrumb-item"><a href="{{ url('/') }}/user/vo/?id{{ $project->id }}">VO</a></li>
              <li class="breadcrumb-item active">Detail</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->      
      <a href="{{ url('/') }}/user/vo/?id={{ $project->id }}"" class="btn btn-warning">Back</a>  
      @if ( $vo->approval->histories->where("user_id",$user->id)->first()->approval_action_id == "1")    
      <a href="#" class="btn btn-info" onclick="setvo('6')" data-toggle="modal" data-target="#myModal">Approve</a>
      <a href="#" class="btn btn-danger" onclick="setvo('7')" data-toggle="modal" data-target="#myModal">Reject</a>
      @endif
    </section>

    <!-- Main content -->
    <input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}"/>
    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}"/>
    <input type="hidden" name="vo_id" id="vo_id" value="{{ $vo->id }}"/>
    <section class="content" style="font-size:17px;">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="card-body table-responsive p-0">
              <table id="example2" style="display: none;" class="table table-bordered table-striped">
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>SPK</strong></span></td>
                  <td>{{ $vo->spk->no }} / <strong>{{ $vo->spk->tender->rab->workorder->detail_pekerjaan->first()->itempekerjaan->parent->name or ''}}</strong></td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>Nilai SPK</strong></span></td>
                  <td>{{ number_format($vo->spk->nilai) }}</strong></td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>VO Kumulatif Sebelumnya (Rp) </strong></span></td>
                  <td>0</td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>Nilai VO Sekarang(Rp)</strong></span></td>
                  <td>{{ number_format($vo->nilai) }}</td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>Total (Rp)</strong></span></td>
                  <td>{{ number_format( ($vo->spk->nilai + $vo->nilai) + $vo->nilai ) }}</td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>PPn (Rp)</strong></span></td>
                  <td>{{ number_format( $ppn =  0.1 * ($vo->spk->nilai + $vo->nilai) + $vo->nilai ) }}</td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>Grand Total (Rp)</strong></span></td>
                  <td>{{ number_format( $ppn + ( ($vo->spk->nilai + $vo->nilai) + $vo->nilai ) ) }}</td>
                </tr>
              </table><br>

               <table id="example1" class="table table-bordered table-striped">
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>SPK</strong></span></td>
                  <td>{{ $vo->spk->no }} / <strong>{{ $vo->spk->tender->rab->workorder->detail_pekerjaan->first()->itempekerjaan->parent->name or ''}}</strong></td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>Nilai (Rp) (Exclude PPn)</strong></span></td>
                  <td>{{ number_format($vo->spk->nilai) }}</td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>Nilai VO (Rp) (Exclude PPn)</strong></span></td>
                  <td>{{ number_format($vo->nilai) }} <a href="#" class="btn btn-info" data-toggle="modal" data-target="#myModal2">View Previos VO</a></td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>Sub Total (Rp) (Exclude PPn)</strong></span></td>
                  <td>{{ number_format($vo->spk->nilai + $vo->nilai) }}</td>
                </tr>
              </table><br>
              </div>
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
                  <td style="background-color: grey;"><span style="color:white"><strong>VO</strong></span></td>
                  <td><strong>{{ $vo->suratinstruksi->where("spk_id",$vo->suratinstruksi->spk->id)->get()->count() }}</strong></td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>SIK</strong></span></td>
                  <td>{{ $vo->suratinstruksi->no }}</td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>Rekanan</strong></span></td>
                  <td>{{ $vo->suratinstruksi->spk->tender_rekanan->rekanan->group->name }}</td>
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
        <div class="col-12">

          <!-- /.card -->
          <div class="card col-md-12">
              <div class="card-body table-responsive p-0">
              <table id="example3" class="table table-hover table-bordered">
                <thead>
                  <tr style="background-color: #17a2b8 ;color:white;">
                    <th>No.</th>
                    <th>Item Pekerjaan</th>
                    <th>Volume</th>
                    <th>Unit</th>
                    <th>Unit Price</th>
                    <th>Subtotal (Rp)</th>
                  </tr>
                </thead>
                <tbody style="background-color: white;">                  
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="5" style="background-color: grey;color:white;"><i>Total (Rp)</i></td>
                    <td style="text-align: right;">{{ number_format($vo->nilai) }} </td>
                  </tr>
                  <tr class="vototal">
                    <td colspan="5" style="background-color: grey;color:white;"><i>Sub Total (Rp)</i></td>
                    <td style="text-align: right;">{{ number_format(0.1 * $vo->nilai) }} </td>
                  </tr>
                  <tr class="vototal">
                    <td colspan="5" style="background-color: grey;color:white;"><i>Total (Rp)</i></td>
                    <td style="text-align: right;">{{ number_format(0.1 * $vo->nilai) }} </td>
                  </tr>
                  <tr class="vototal">
                    <td colspan="5" style="background-color: grey;color:white;"><i>PPn (Rp)</i></td>
                    <td style="text-align: right;">{{ number_format(0.1 * $vo->nilai) }} </td>
                  </tr>
                  <tr class="vototal">
                    <td colspan="5" style="background-color: grey;color:white;"><i>Grand Total (Rp)</i></td>
                    <td style="text-align: right;">{{ number_format($vo->nilai + (0.1 * $vo->nilai)) }}</td>
                  </tr>
                </tbody>
              </table>         
            <br><br>                    
            </div>
            <!-- /.card-body -->
          </div>
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
  function requestApproval(){
    var request = $.ajax({
      url : "{{ url('/')}}/user/vo/approval",
      data:{
        user_id: $("#user_id").val(),
        project_id : $("#project_id").val(),
        vo_id : $("#vo_id").val(),
        status : $("#btn_save_budgets").attr("data-value"),
        description : $("#description").val()
      },
      type :"get",
      dataType :"json"
    });

    request.done(function(data){
      if (data.status == "0"){
        window.location.reload();
      }else{
        alert("Error when saving Approval");
        window.location.reload();
      }
    });   
  }

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

  function viewdetail(parent_id){
    var request = $.ajax({
      url : "{{ url('/')}}/user/approval/itempekerjaan/detail/",
      data :{
        parent_id : parent_id,
        vo_id : $("#vo_id").val()
      },
      type :"get",
      dataType :"json"
    });

    request.done(function(data){
      $("#detailist").html(data.html);
      $("#label_department").text(data.dept);
      $("#label_coa").text(data.coa);
      $("#label_name").text(data.names);
    })
  }

  function setvo(values){
    var budget_id = $("input[name^='budget_id']").serializeArray();
    if ( values == "6" ){
      $("#title_approval").attr("style","color:blue");
      $("#title_approval").text("These VO will be APPROVED by You");
    }else{
      $("#title_approval").attr("style","color:red");
      $("#title_approval").text("These VO will be REJECTED by You");
    }
    $("#btn_save_budgets").attr("data-value",values);
   
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
            
        </div>
      </div>
      <div class="modal-footer">
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="myModal2">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br>
      </div>
      <div class="modal-body">
         <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">VO 1 </a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">VO 2</a></li>
                 </ul>
              </div><!-- /.card-header -->
              <div class="card-body tables">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <!-- List Approval Peserta Tender-->
                    <center><span style="font-size: 18px;" class="labeltable"><strong>VO 1</strong></span></center>
                    <div class="card-body table-responsive p-0">
                      <table class="table table-hover table-striped table-bordered">
                        <thead>
                          <tr style="background-color: #17a2b8 ;color:white;">
                            <th>No.</th>
                            <th>Item Pekerjaan</th>
                            <th>Volume</th>
                            <th>Unit</th>
                            <th>Unit Price</th>
                            <th>Subtotal (Rp)</th>
                          </tr>
                        </thead>
                        <tbody style="background-color: white;">                  
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="5" style="background-color: grey;"><i>Total (Rp)</i></td>
                            <td style="text-align: right;">{{ number_format($vo->nilai) }} </td>
                          </tr>
                          <tr>
                            <td colspan="5" style="background-color: grey;"><i>PPn (Rp)</i></td>
                            <td style="text-align: right;">{{ number_format(0.1 * $vo->nilai) }} </td>
                          </tr>
                          <tr>
                            <td colspan="5" style="background-color: grey;"><i>Grand Total (Rp)</i></td>
                            <td style="text-align: right;">{{ number_format($vo->nilai + (0.1 * $vo->nilai)) }}</td>
                          </tr>
                        </tbody>                     
                      </table>   
                  </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                      <!-- List Approval Peserta Tender-->
                      <center><span style="font-size: 18px;" class="labeltable"><strong>VO 2</strong></span></center>
                      <div class="card-body table-responsive p-0">
                        <table class="table table-hover table-striped table-bordered" id="detail_penawaran">
                            <thead>
                              <tr style="background-color: #17a2b8 ;color:white;">
                                <th>No.</th>
                                <th>Item Pekerjaan</th>
                                <th>Volume</th>
                                <th>Unit</th>
                                <th>Unit Price</th>
                                <th>Subtotal (Rp)</th>
                              </tr>
                            </thead>
                            <tbody style="background-color: white;">                  
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="5" style="background-color: grey;"><i>Total (Rp)</i></td>
                                <td style="text-align: right;">{{ number_format($vo->nilai) }} </td>
                              </tr>
                              <tr>
                                <td colspan="5" style="background-color: grey;"><i>PPn (Rp)</i></td>
                                <td style="text-align: right;">{{ number_format(0.1 * $vo->nilai) }} </td>
                              </tr>
                              <tr>
                                <td colspan="5" style="background-color: grey;"><i>Grand Total (Rp)</i></td>
                                <td style="text-align: right;">{{ number_format($vo->nilai + (0.1 * $vo->nilai)) }}</td>
                              </tr>
                              <tr>
                                <td colspan="5" style="background-color: grey;"><i>Terbilang</i></td>
                                <td style="text-align: right;">&nbsp;</td>
                              </tr>
                            </tbody>                       
                        </table>        
                      </div>
                  </div>
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
        
      </div>
      <div class="modal-footer">
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</body>
</html>
