<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
  <style type="text/css">
    .table-align-right{
      text-align: right;
    }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <section class="content-header">
        <h1 style="text-align:center">Data Detil dari Pengelompokan Tender PR </h1>
    </section>
    <section class="content-header">
      <div class="" style="float: none">
        @if($back == "tenderpurchaserequest")
        <button class="col-md-1 col-sm-2 btn btn-primary" onclick="location.href='{{ url('/')}}/tenderpurchaserequest'" style="float: none; border-radius: 20px; padding-left: 0">
        @else
        <button class="col-md-1 col-sm-2 btn btn-primary" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/pengelompokan'" style="float: none; border-radius: 20px; padding-left: 0">
        @endif
        <i class="fa fa-fw fa-arrow-left"></i>&nbsp;&nbsp;Back
        </button>
        <button class="col-md-1 col-sm-2 btn btn-primary" onclick="window.location.reload()" style="float: right; border-radius: 20px; padding-left: 0;">
          <i class="fa fa-fw fa-refresh"></i>&nbsp;&nbsp;Refresh
        </button>  
      </div>
    </section>
    <section class="content">
      <!-- Info boxes -->

      <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border" data-widget="collapse">
                <h3 class="box-title">
                    Data Pengelompokan Tender PR
                </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                    </button>
                </div>
                </div>
                <div class="box-body" style="">
                    <div class="left col-md-12">
                        <div class="form-group">
                            <div class="col-md-12 input-group">
                                <div class="input-group-addon" style="width: 50%;text-align: right;">
                                    Id
                                </div>
                                <input type="text" class="form-control" style="width:100%" value="{{$itemUmum[0]->id}}" disabled>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <br>
                    </div>
                    
                    <div class="left col-md-4">
                        <div class="form-group">
                            <div class="col-md-12 input-group">
                                <div class="input-group-addon" style="width: 19%;text-align: right;">
                                    Item
                                </div>
                                <input type="text" class="form-control" style="width:100%" value="{{$itemUmum[0]->itemName}}" disabled>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <br><br>
                        <div class="form-group">
                            <div class="col-md-12 input-group">
                                <div class="input-group-addon" style="width: 19%;text-align: right;">
                                    Brand
                                </div>
                                <input type="text" class="form-control" style="width:100%" value="{{$itemUmum[0]->brandName}}" disabled>
                            </div>
                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="right col-md-4">
                        <div class="form-group">
                            <div class="col-md-12 input-group">
                                <div class="input-group-addon" style="width: 19%;text-align: right;">
                                    Quantity
                                </div>
                                <input type="text" class="form-control" style="width:100%" value="{{$itemUmum[0]->quantity}}" disabled>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <br><br>
                        <div class="form-group">
                            <div class="col-md-12 input-group">
                                <div class="input-group-addon" style="width: 19%;text-align: right;">
                                    Satuan
                                </div>
                                <input type="text" class="form-control" style="width:100%" value="{{$itemUmum[0]->satuanName}}" disabled>
                            </div>
                            <!-- /.input group -->
                        </div>
                        
                    </div>
                    <div class="right col-md-4">
                        <div class="form-group">
                            <div class="col-md-12 input-group">
                                <div class="input-group-addon" style="width: 19%;text-align: right;">
                                    Description
                                </div>
                                <textarea type="text" class="form-control" style="width:100%" rows="6" disabled>
                                    {{$itemUmum[0]->description}}
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border" data-widget="collapse">
              <h3 class="box-title">
                List Item &nbsp;	&nbsp;	
                <span class="pull-right-container">
                  {{-- <small class="label pull-right bg-yellow">{{count($itemSiapKelompok)}}</small> --}}
                </span>
              </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                  <i class="fa fa-plus"></i>
                </button>
              </div>
              
            </div>
            <!-- /.box-header -->
                @if(strcmp($user->user_login,"administrator")==0 && $status_approve != 6)
            <div class="box-header with-border" style="background-color:white">
              <div class="col-md-3">
                <button type="button" class="btn btn-block btn-primary btn-lg" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/pengelompokanAdd/?id={{$itemUmum[0]->id}}'">
                  <i class="fa fa-fw fa-plus"></i>
                  &nbsp;&nbsp;
                  Tambah Item Kedalam Kelompok Ini
                </button>
              </div>
            </div>
                @endif
            <div class="box-body">
                <table id="ListSiapKelompok" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                    <thead>
                      <tr style="background-color: greenyellow;">
                        <th class="table-align-right">No</th>
                        <th class="table-align-right">No PR</th>
                        <th>Departemen</th>
                        <th>Coa</th>
                        <th class="table-align-right">Quantity</th> 
                        <th>Satuan</th> 
                        <th class="table-align-right">Quantity Baru</th> 
                        <th>Satuan Baru</th> 
                      </tr>
                      </thead>
                      <tbody>
                        @php($i=0)
                        @php($itemQuantity = (array)$itemQuantity)
                        @foreach($itemDetil as $v )
                            @php($i++)

                            <tr>
                            <td class="table-align-right">{{$i}}</td>
                            <td class="table-align-right">{{$v->prNo}}</td>
                            <td>{{$v->dName}}</td>
                            <td>{{$v->ipName}}</td>
                            <td class="table-align-right">{{$v->prdQuantity}}</td>
                            <td>{{$v->isName}}</td>
                            <td class="table-align-right">{{$itemQuantity[$i-1]}}</td>
                            <td>{{$itemSatuanTerkecil->name}}</td>
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
