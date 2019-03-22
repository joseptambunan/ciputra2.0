
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
      <h1>Data Workorder <strong>{{ $workorder_pekerjaan->workorder->name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <h3 class="box-title">Detail Dokumen</h3>
              <form action="{{ url('/')}}/workorder/save-document" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="workorder_budget_id" value="{{ $workorder_pekerjaan->id }}">
                <div class="form-group">
                  <div class="col-xs-4">
                    <div class="form-group">
                      <label>Nama Dokumen</label>
                      <select class="form-control" name="document_name">                      
                        <option value="Gambar Tender">Gambar Tender</option>
                        <option value="BQ / Bill Item">BQ / Bill Item</option>
                        <option value="Spesifikasi Teknis">Spesifikasi Teknis</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <input type="file" name="upload" required><i><strong>(file yang diupload hanya bertype *.doc, *.docx, *.xls, *.xlsx, *.jpg, *.jpeg, *.png, *.pdf, dan autocad)</strong></i>
                    </div>                    
                    <input type="hidden" name="workorder_unit_id" value="{{ $workorder_pekerjaan->id }}">
                    <div class="form-group">                  
                      <a class="btn btn-warning" href="{{ url('/')}}/workorder/detail/?id={{ $workorder_pekerjaan->workorder->id }}">Kembali</a>
                      @if ( $workorder_pekerjaan->workorder->approval != "")
                        @if ( $workorder_pekerjaan->workorder->approval_action_id == 7 )
                          <button type="submit" class="btn btn-primary">Save changes</button>
                        @endif
                      @else
                      <button type="submit" class="btn btn-primary">Save changes</button>
                      @endif
                    </div>
                  </div>
                </div>
              </form>
            </div>
   
            <!-- /.col -->
            <div class="col-md-12">
              	
                <table id="example2" class="table-bordered table table-responsive">
                  <thead class="head_table">
                    <tr>
                      <td>Nama Dokumen</td>
                      <td>File</td>
                      <td>Action</td>
                    </tr>
                  </thead>
                  <tbody id="table_item">
                   	@foreach ( $workorder_pekerjaan->dokumen as $key => $value )
                   	<tr>
                   		<td>{{ $value->document_name }}</td>
                   		<td><a class="btn btn-info" href="#">Download</a></td>
                   		<td>
                        @if ( $workorder_pekerjaan->workorder->approval != "")
                          @if ( $workorder_pekerjaan->workorder->approval->approval_action_id == 7)
                            <button class="btn btn-danger" onClick="removeDokumen('{{ $value->id }}')">Delete</button>
                          @endif
                        @else
                          <button class="btn btn-danger" onClick="removeDokumen('{{ $value->id }}')">Delete</button>
                        @endif
                      </td>
                   	</tr>
                   	@endforeach
                  </tbody>
                </table>
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
@include("workorder::app")
<!-- Select2 -->
<script type="text/javascript">
  function disablebtn(id){
    var valor = [];
    $('input.disable_unit[type=checkbox]').each(function () {
        if (this.checked)
          valor.push($(this).val());
    });

    console.log(valor.length);

    if (valor.length < 1 ) {
      $("#btn_submit").attr("disabled","disabled");
    }else{
      $("#btn_submit").removeAttr("disabled");
    }
  }

  $(document).ready( function () {
    $('#example1').DataTable({
      
    });
  });
</script>
</body>
</html>
