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

  @include("master/sidebar")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Approval <strong>{{ $user->user_name }}</strong></h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
   
            <!-- /.col -->
            <div class="col-md-12">

                <form action="{{ url('/')}}/user/approvalde" method="post">
                <div class="form-group">                  
                  <a class="btn btn-warning" href="{{ url('/')}}/user/detail/?id={{ $user->id }}">Kembali</a>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                {{ csrf_field() }}
                <input type="hidden" name="pt_id" value="{{$project_pt->project_pts->pt->id}}">
                <input type="hidden" name="project_id" value="{{$project_pt->project_pts->project->id}}">
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <h4>PT : <strong>{{ $project_pt->project_pts->pt->name or '' }}</strong></h4>
                <h4>Project : <strong>{{ $project_pt->project_pts->project->name or '' }}</strong></h4>
                <table class="table">
                  <thead class="head_table">
                    <tr>
                        <td>Document</td>
                        <td colspan="2">Min Nilai Document(Rp)</td>
                        <td colspan="2">Max Nilai Document(Rp)</td>
                        <td>Nomor Urut</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td colspan="5"><input type="checkbox" name="all_check" id="all_check" onclick="allcheck()"> Pilih Semua</td>
                    </tr>
                    @foreach ( $document as $key => $value )
                    <tr>
                      <td>
                        <input type="hidden" name="document_[{{$key}}]" value="{{$value->head_type }}" >
                        <input type="checkbox" name="check_[{{$key}}]" class="approval"> Approve
                        {{ $value->head_type }}
                      </td>
                      <td>
                        <select class="form-control" name="param_min[{{$key}}]">
                          <option value="=">=</option>
                          <option value=">">></option>
                          <option value="<"><</option>
                        </select>
                      </td>
                      <td><input type="text" name="min_value_[{{$key}}]" class="nilai_budgets form-control" autocomplete="off"></td>
                      <td>
                        <select class="form-control" name="param_max[{{$key}}]">
                          <option value="=">=</option>
                          <option value=">">></option>
                          <option value="<"><</option>
                        </select>
                      </td>
                      <td><input type="text" name="max_value_[{{$key}}]" class="nilai_budgets form-control" autocomplete="off"></td>
                      <td>
                        <select class="form-control" name="urut[{{$key}}]">
                          @foreach ( $uniq as $key2 => $value2 )
                          <option value="{{ $value2 }}">{{ $value2 }}</option>
                          @endforeach
                        </select>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                </form>
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
@include("pt::app")
<!-- Select2 -->
<script type="text/javascript">
  function allcheck(){
    if ( $("#all_check").is(":checked")){
      $(".approval").attr("checked","checked");
    }else{
      $(".approval").removeAttr("checked");
    }
  }

  $(".nilai_budgets").number(true,2);
</script>
</body>
</html>
