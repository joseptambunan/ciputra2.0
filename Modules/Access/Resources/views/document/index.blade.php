
<!DOCTYPE html>
<html>
@include('user.header')
<style type="text/css">
  #example3 th,
    #example3 td {
        white-space: nowrap;
    }
   
</style>
{{ csrf_field() }}
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
            <h1>Project</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Tables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->    
    <input type="hidden" name="approval_list" id="approval_list">
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Approval</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <a href="#" onclick="showsearch();" class="btn btn-success">Search</a>
              <button onclick="submitapprove();" class="btn btn-info">Submit</button><br/>
              <table class="table table-bordered table-striped searchbox" style="display: none;">
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>Tanggal</strong></span></td>
                  <td></td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>Proyek</strong></span></td>
                  <td>
                    <select name="search_proyek" id="search_proyek" class="form-control">
                      <option value="">(choose)</option>
                      @foreach ( $project as $key => $value )
                      <option value="{{ $value->id }}">{{ $value->name }}</option>
                      @endforeach
                    </select>
                  </td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>Nilai</strong></span></td>
                  <td>
                    <input type="radio" name="clause" id="more" checked> >= <br>
                    <input type="radio" name="clause" id="less"> <=
                    <input type="text" name="nominal" id="nominal" class="form-control">
                  </td>
                </tr>
                <tr>
                  <td style="background-color: grey;"><span style="color:white"><strong>Department</strong></span></td>
                  <td>
                    <select name="search_department" id="search_department" class="form-control">
                      @foreach ( $department as $key => $value )
                      <option value="{{ $value->id }}">{{ $value->name }}</option>
                      @endforeach
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><button onclick="search();" class="btn btn-success">Cari</button></td>
                </tr>
              </table><br>   
              <table class="table table-bordered" id="example3">
                <thead>
                    <tr class="header_1">
                      <th class="approve">Status Approval</th>                  
                      <th>Jenis Dokumen</th>
                      <th>Tanggal</th>
                      <th>Nomor Dokumen</th>
                      <th>Perihal Pekerjaan</th>
                      <th>Nilai(Rp)</th>
                      <th>Proyek</th>
                      <th>Kawasan</th>
                      <th>Department</th>
                      <th>Detail</th>
                    </tr>
                </thead>
                <tbody style="background-color: white;">
                    @foreach ( $approval as $key => $value )
                    @if ( $value->document_type != "App\TenderRekanan")
                    @php 
                      $arrayDocument = array(
                        "App\Budget" => array("label" => "Budget Awal", "url" => "budget" ),
                        "App\BudgetTahunan" => array("label" => "Budget Tahunan", "url" => "budget_tahunan" ),
                        "App\Workorder" => array("label" => "Workorder", "url" => "workorder" ),
                        "App\Rab" => array("label" => "RAB", "url" => "rab" ),
                        "App\Tender" => array("label" => "Tender", "url" => "tender" ),
                        "App\TenderKorespondensi" => array("label" => "Korespondensi" , "url" => "tender_korespondensi"),
                        "App\Spk" => array("label" => "Surat Perintah Kerja" , "url" => "spk")
                        );

                      $arrayKoresponend = array(
                        "udg" => "Undangan Penawaran dan Klarifikasi",
                        "sipp" => "Surat Instruksi Penunjukan Pemenang",
                        "pp" => "Surat Pemberitahuan Pemenang",
                        "sutk" => "Surat Ucapan Terima Kasih",
                        "spt" => "Surat Pembatalan Tender"
                      );

                      $arrayApproval = array(
                        "6" => array("label" => "Approved", "class" => "approve"),
                        "7" => array("label" => "Rejected", "class" => "reject")
                      )
                    @endphp
                    @if (isset($value->document->nilai))
                    <tr>
                      <td class="{{ $arrayApproval[$value->approval_action_id]['class'] }}">{{ $arrayApproval[$value->approval_action_id]['label'] }}</td>
                      <td>{{ $arrayDocument[$value->document_type]['label'] }}</td>
                      <td>{{ $value->created_at->format("d M Y") }}</td>
                      <td>{{ $value->document->no or '' }}</td>
                      @if ( $value->document_type != "App\TenderKorespondensi" )              
                      <td>{{ $value->document->description or '' }}</td>
                      <td>{{ number_format($value->document->nilai) }}</td>
                      @else
                      <td>{{ $arrayKoresponend[$value->document->type] }}</td>
                      <td></td>
                      @endif
                      
                      <td>{{ $value->document->project->first()->name or '' }}</td>
                      <td>{{ $value->document->kawasan->name or '' }}</td>
                      <td>{{ $value->document->department->code or '' }}</td>
                      <td><a href="{{ url('/')}}/user/{{ $arrayDocument[$value->document_type]['url'] }}/detail/?id={{ $value->document->id }}" class="btn btn-success">Detail</a></td>
                    </tr>
                    @endif
                    @endif
                    @endforeach

                </tbody>
                
              </table><br>        
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
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.4/js/dataTables.fixedColumns.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/fixedcolumns/3.0.2/css/dataTables.fixedColumns.css">
<script type="text/javascript">
  $(document).ready(function() {
    $('#example3').DataTable( {
        scrollY:        300,
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   {
          leftColumns: 3,
        }
    } );

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('input[name=_token]').val()
        }
    });
   
  });

  function checkapprove(status,doc_id){
      var list = $("#approval_list").val();
      if ( status == "R" ){
        var replace = list.replace("<>A," + doc_id, "");
        $("#approval_list").val(replace + "<>" +  status + "," + doc_id);
      }else{
        var replace = list.replace("<>R" + "," +  doc_id, "");
        $("#approval_list").val(replace + "<>" +  status + "," + doc_id);
      }
  }

  function submitapprove(){
      var request = $.ajax({
        url : "{{ url('/')}}/user/approval/all",
        dataType : "json",
        data : {
          approval_list : $("#approval_list").val(),
          token : $('input[name=_token]').val()
        },
        type : "post"
      });

      request.done(function(data){
        window.location.reload();
      })
  }
</script>
</body>
</html>
