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
      <h1>Data Purchase Order</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border" data-widget="collapse">
                <h3 class="box-title">
                    Data Purchase Order Detail
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
                                <input type="text" class="form-control" style="width:100%" value="{{$PO_POD->id}}" disabled="">
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
                                <input type="text" class="form-control" style="width:100%" value="{{$PO_POD->name}}" disabled="">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <br><br>
                        <div class="form-group">
                            <div class="col-md-12 input-group">
                                <div class="input-group-addon" style="width: 19%;text-align: right;">
                                    Brand
                                </div>
                                <input type="text" class="form-control" style="width:100%" value="{{$PO_POD->bName}}" disabled="">
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
                                <input type="text" class="form-control" style="width:100%" value="{{$PO_POD->quantity}}" disabled="">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <br><br>
                        <div class="form-group">
                            <div class="col-md-12 input-group">
                                <div class="input-group-addon" style="width: 19%;text-align: right;">
                                    Satuan
                                </div>
                                <input type="text" class="form-control" style="width:100%" value="{{$PO_POD->isName}}" disabled="">
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
                                <textarea type="text" class="form-control" style="width:100%" rows="6" disabled="">
                                    {{$PO_POD->description}}
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
<!--@include("pt::app")-->
</body>
</html>
