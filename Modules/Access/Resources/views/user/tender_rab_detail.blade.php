<!DOCTYPE html>
<html>
@include('user.header')
<style type="text/css">
  #example3 th,
    #example3 td {
        white-space: nowrap;
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
            <h1>Project <strong>{{ $rab->workorder->project->name or '' }}</strong></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/') }}/user/tender/detail?id={{ $tender->id }}">Tender</a></li>
              <li class="breadcrumb-item active">Detail</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->      
      <a href="{{ url('/') }}/user/tender/detail?id={{ $tender->id }}"" class="btn btn-warning">Back</a>  
      @if ( $rab->approval->histories->where("user_id",$user->id)->first()->approval_action_id == "1")    
      <a href="#" class="btn btn-info" onclick="setapproved('6')" data-toggle="modal" data-target="#myModal">Approve</a>
      <a href="#" class="btn btn-danger" onclick="setapproved('7')" data-toggle="modal" data-target="#myModal">Reject</a>
      @elseif ( $rab->approval->histories->where("user_id",$user->id)->first()->approval_action_id == "6")  
      <span class="badge badge-success">Approved</span>  
      @endif
    </section>

    <!-- Main content -->
    <input type="hidden" name="project_id" id="project_id" value="{{ $rab->workorder->budget_tahunan->budget->project->id }}"/>
    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}"/>
    <input type="hidden" name="rab_id" id="rab_id" value="{{ $rab->id }}"/>
    <section class="content" style="font-size:17px;">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Data RAB</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body col-md-6">
              <table id="example1" class="table table-bordered table-striped">               
                
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>No RAB</strong></span></td>
                  <td>{{ $rab->no }}</td>
                </tr>
                @if ( count($rab->blok_list) < 0 ) 
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>COA / Pekerjaan</strong></span></td>
                  <td>{{ $rab->pekerjaans->where("nilai",null)->first()->itempekerjaan->code }}/ {{ $rab->pekerjaans->where("nilai",null)->first()->itempekerjaan->name }}</td>
                </tr>
                @endif
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>Dept. From</strong></span></td>
                  <td>{{ $rab->workorder->departmentFrom->name }}</td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>Subtotal</strong></span></td>
                  <td>{{ number_format($rab->nilai) }}</td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>PPN</strong></span></td>
                  <td>{{ number_format($rab->nilai) }}</td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>Grand Total</strong></span></td>
                  <td>{{ number_format($rab->nilai) }}</td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>Lokasi</strong></span></td>
                  <td>                    
                    @foreach ( $rab->units as $key => $value )
                      @if ( $value->asset_type != "App\\Unit")
                      <span style="font-size: 15px;text-transform: uppercase"><strong>{{ $value->asset->name or '' }}</strong></span><br>
                      @endif
                     @endforeach
                    
                    @if ( count($rab->blok_list) > 0 ) 
                    @for ( $i=0; $i < count($rab->blok_list); $i++ )
                      <span style="font-size: 15px;text-transform: uppercase">{{ \App\Blok::find($rab->blok_list[$i])->kawasan->name }}/<strong>{{ \App\Blok::find($rab->blok_list[$i])->name }}</strong></span><br>
                    @endfor
                    @endif
                   
                  </td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>No. Workorder</strong></span></td>
                  <td>{{ $rab->workorder->no }}</td>
                </tr>
              </table><br>
            </div>
            <div class="card-body col-md-12">
              @foreach ( $rab->units as $key => $value )
              @if ( $value->asset_type != "App\\Unit")
                <table id="example3" class="table table-bordered">
                <thead>
                  <tr style="background-color: #17a2b8 ">
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

                  @foreach ( $rab->pekerjaans as $key => $value )
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
              @endif
              @endforeach
              

              @if ( count($rab->blok_list) > 0 )   
                <h4>Detail Blok</h4>             
                <table id="example3" class="table table-bordered">
                <thead>
                  <tr style="background-color: #17a2b8 ">
                    <th>Blok</th>
                    <th>Unit</th>
                  </tr>
                </thead>
                <tbody>
                  @for ( $i=0; $i < count($rab->blok_list); $i++ )
                  <tr>
                    <td><strong>{{ \App\Blok::find($rab->blok_list[$i])->name }}</strong></td> 
                    <td>
                      @php $nilai = 0; @endphp
                      @foreach ( $rab->units as $key => $value )                        
                          @if ( $value->asset->blok_id == $rab->blok_list[$i] )
                          @php $nilai = $nilai + 1;  @endphp
                          @endif                        
                        @endforeach
                      {{ $nilai }}
                    </td>                    
                  </tr>   
                        
                  @endfor
                </tbody>
              </table>      
              <h3>&nbsp</h3>

              <h4>Detail Template</h4> 
              <table id="example1" class="table table-bordered">
                <thead>
                  <tr style="background-color: #17a2b8 ">
                    <th>Template</th>
                    <th>Itempekerjaan</th>
                    <th>Volume</th>
                    <th>Unit</th>
                    <th>Nilai</th>
                  </tr>
                </thead>
                <tbody>
                  @for ( $i=0; $i < count($rab->template_pekerjaan); $i++ )
                  <tr>
                    <td colspan="5"><strong>{{ \App\Templatepekerjaan::find($rab->template_pekerjaan[$i])->name }}</strong></td>                    
                  </tr>   
                  @foreach ( \App\Templatepekerjaan::find($rab->template_pekerjaan[$i])->rab_budget as $key => $value ) 
                  <tr>
                    <td>&nbsp;</td>                    
                    <td>{{ \App\Itempekerjaan::find($value['itempekerjaan_id'])->name }}</td>
                    <td>{{ $value['itempekerjaan_id'] }}</td>                    
                    <td>{{ $value['satuan'] }}</td>
                    <td>{{ $value['nilai'] }}</td>
                  </tr>     
                  @endforeach         
                  @endfor
                </tbody>
                </table>               
              @endif
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

<script type="text/javascript">
  function requestApproval(){    

    var request = $.ajax({
      url : "{{ url('/') }}/user/rab/approval",
      data: {
        user_id : $("#user_id").val(),
        rab_id :$("#rab_id").val(),
        status : $("#btn_save_budgets").attr("data-value")
      },
      type :"get",
      dataType :"json"     
    });

    request.done(function(data){
      if ( data.status == "0"){
        window.location.reload();
      }else{
        alert("Error When Saving Approval");
        window.location.reload();
      }
    })
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

  function setapproved(values,budget_id){
    if ( values == "6" ){
      $("#title_approval").attr("style","color:blue");
      $("#title_approval").text("These RAB will be APPROVED by You");
    }else{
      $("#title_approval").attr("style","color:red");
      $("#title_approval").text("These RAB will be REJECTED by You");
    }
    $("#btn_save_budgets").attr("data-value",values);
    $("#budget_id").val(budget_id);
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
