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
      <h1 style="text-align:center">Data Tender Purchase Request</h1>

    </section>
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12">
          @if(strcmp($user->user_login,"administrator")==0)
          <div class="box box-primary">
            <div class="box-header with-border" data-widget="collapse">
              <h3 class="box-title">
                List Siap Di Tenderkan &nbsp; &nbsp;  
                <span class="pull-right-container">
                  <small class="label pull-right bg-yellow"></small>
                </span>
              </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                  <i class="fa fa-plus"></i>
                </button>
              </div>
              
            </div>
            <!-- /.box-header -->
            <div class="box-header with-border" style="background-color:white">
              <div class="col-md-3">
                <button type="button" class="btn btn-block btn-primary btn-lg" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/add'">
                  <i class="fa fa-fw fa-plus"></i>
                  &nbsp;&nbsp;
                  Tambah Tender PR
                </button>
              </div>
            </div>
            <div class="box-body">
                <table id="ListSiapKelompok" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                    <thead>
                      <tr style="background-color: greenyellow;">
                        <th>No</th>
                        <th>Item</th>
                        <th>Brand</th>
                        <th>Quantity</th>
                        <th>Satuan</th>
                        <th>Desc</th>
                        <th>Action</th> 
                      </tr>
                      </thead>
                      <tbody>
                          @php($i=0)
                          @foreach($itemSiapTender as $v )
                          @php($i++)
  
                          <tr>
                            <td>{{$i}}</td>
                            <td>{{$v->itemName}}</td>
                            <td>{{$v->brandName}}</td>
                            <td>{{$v->quantity}}</td>
                            <td>{{$v->satuanName}}</td>
                            <td>{{$v->description}}</td>                            
                            <td>
                                <button type="button" class="btn btn-block btn-primary" onclick="location.href='http://localhost:81/tenderpurchaserequest/pengelompokanDetail/?id={{$v->id}}'" style="padding-left:0px">
                                  <i class="fa fa-fw fa-book"></i>
                                  &nbsp;
                                  Detail
                                  
                                </button>  
                            </td>
                          </tr>
                          @endforeach
        
                        </tbody>
                  </table>
            </div>
            
          </div>
          @endif
        </div>
      </div>
      
      <div class="row">
          <div class="col-md-12">
            @if(strcmp($user->user_login,"administrator")==0)
            <div class="box box-primary collapsed-box">
            @else
            <div class="box box-primary">
            @endif
              <div class="box-header with-border" data-widget="collapse">
                <h3 class="box-title">
                  List Telah Di Tenderkan &nbsp; &nbsp;  
                  <span class="pull-right-container">
                    <small class="label pull-right bg-yellow"></small>
                  </span>
                </h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    @if(strcmp($user->user_login,"administrator")==0)
                    <i class="fa fa-plus"></i>
                    @else
                    <i class="fa fa-minus"></i>
                    @endif
                  </button>
                </div>
              </div>
              @if(strcmp($user->user_login,"administrator")==0)
              <div class="box-body" style="display: none;">
              @else
              <div class="box-body">
              @endif
                  <table id="ListTelahKelompok" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                      <thead>
                        <tr style="background-color: greenyellow;">
                           <th>No</th>
                          <th>No Tender</th>
                          <th>Nama Tender</th>
                          <th>Tanggal Ambil Dokumen</th>
                          <th>Final Date</th>
                          <th>Harga Dokumen</th>
                          <th>Sumber</th> 
                          <th>Deskripsi</th> 
                          <th>Status</th> 
                          @if(strcmp($user->user_login,"approval1")==0)
                          <th>Aksi</th> 
                          @endif
                          <th>Detail</th>
                        </tr>
                        </thead>
                        <tbody>
                          @php($i=0)
                          @foreach($TPR as $v )
                          @php($i++)
  
                          <tr>
                            @if($v->approval_action_id !=2)
                            <td>{{$i}}</td>
                            <td>{{$v->no}}</td>
                            <td>{{$v->name}}</td>
                            <td>{{$v->ambil_doc_date}}</td>
                            <td>{{$v->final_date}}</td>
                            <td>{{$v->harga_dokumen}}</td>                            
                            <td>{{$v->sumber}}</td>                            
                            <td>{{$v->description}}</td>                            
                            <td>{{ucwords($v->status)}}</td>                            

                              @if(strcmp($user->user_login,"approval1")==0)
                              <td>
                                <button type="button" class="btn btn-block btn-primary" onclick="location.href='http://localhost:81/tenderpurchaserequest/approve-tender/?id={{$v->id}}'" style="padding-left:0px">
                                  <i class="fa fa-fw fa-book"></i>
                                  &nbsp;
                                  Approve
                                </button>  
                              </td>
                              @endif
                              
                              <td>
                                <button type="button" class="btn btn-block btn-primary" onclick="location.href='http://localhost:81/tenderpurchaserequest/detail/?id={{$v->id}}'" style="padding-left:0px">
                                  <i class="fa fa-fw fa-book"></i>
                                  &nbsp;
                                  Detail
                                </button>  
                              </td>
                            @endif
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
              </div>
              
            </div>
          </div>
        </div>
          <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include("master/footer_table")
@include("pt::app")
<script>
  
  $(function () {
    $('#ListSiapKelompok').DataTable();
    $('#ListTelahKelompok').DataTable();
  })

</script>
</body>
</html>
