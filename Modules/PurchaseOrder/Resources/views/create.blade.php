<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard </title>
  @include("master/header")
  
    <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('/')}}/assets/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="{{ url('/')}}/assets/selectize/selectize.bootstrap3.css">

    <style>
        .panel-info>.panel-heading {
    color: white;
    background-color: #367fa9;
    border-color: #3c8dbc;
}
        .panel-info {
    border-color: #3c8dbc;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice{
    background-color: #3c8dbc;
    border-color: #367fa9; q
}
    </style>

    <style>
      * {
        box-sizing: border-box;
      }

      body {
        background-color: #f1f1f1;
      }

      h1 {
        text-align: center;  
      }
      /* Mark input boxes that gets an error on validation: */
      input.invalid,select.invalid,textarea.invalid{
        background-color: #ffdddd;
      }

      /* Hide all steps by default: */
      button:hover {
        opacity: 0.8;
      }

      #prevBtn {
        background-color: #bbbbbb;
      }

      /* Make circles that indicate the steps of the form: */
      .step {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbbbbb;
        border: none;  
        border-radius: 50%;
        display: inline-block;
        opacity: 0.5;
      }

      .step.active {
        opacity: 1;
      }

      /* Mark the steps that are finished and valid: */
      .step.finish {
        background-color: #4CAF50;
      }
      input[type=select-multiple]{
        width:33.3%;
      }

    .optionItem{
      width:24.5%;
    }
    .item{
      color: black;
      background-color: beige;
    }
    select{
      background-color: white;
    }
    </style>
</head>
<body id="body" class="hold-transition skin-blue sidebar-mini" style="visibility: hidden;">
<div class="wrapper">
  @include("master/sidebar_project")
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Purchase Order</h1>
    </section>
    <section class="content-header">
      <div class="" style="float: none">
        <button class="col-md-1 col-sm-2 btn btn-primary" onclick="location.href='{{ url('/')}}/purchaseorder/'" style="float: none; border-radius: 20px; padding-left: 0">
        <i class="fa fa-fw fa-arrow-left"></i>&nbsp;&nbsp;Back
        </button>
        <button class="col-md-1 col-sm-2 btn btn-primary" onclick="window.location.reload()" style="float: right; border-radius: 20px; padding-left: 0;">
          <i class="fa fa-fw fa-refresh"></i>&nbsp;&nbsp;Refresh
        </button>  
      </div>
    </section>
    <section class="content">
      
      <div class="box box-default">

        <div class="box-body">
          <div class="row">
            <div class="col-md-12">              
              <form id="regForm" action="{{ url('/')}}/tenderpurchaserequest/add-pengelompokan" method="post" name="form1">
                @csrf
                <div class="tab">
                  <h3 class="box-title">Tambah Purchase Order</h3>
                  <div class="form-group col-md-12">
                    <label class="col-md-12" style="padding-left:0">Rekanan</label>
                    <input name="idTender" value="" hidden>
                    <select id="item" class="form-input input col-md-12" name="item" required>
                    </select>
                  </div>
                  <div id="divItemPD" class="form-group col-md-12">
                    <label class="col-md-12" style="padding-left:0">Tender</label>
                    <select id="item_per_description" class=" input col-md-12" name="item_per_description[]" multiple="multiple" required style="width:100%">
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <label class="col-md-12" style="padding-left:0">Jumlah Term</label>
                    <input class="form-input col-md-12" type="number" name="term" min="1" value="1" onkeyup="changeDateTerm(this.value)" required>
                    <!-- <input id="satuan" class="item form-input input col-md-12" name="satuan" readonly> -->
                  </div>
                  <div class="form-group col-md-12">
                    <div id="divTerm" class="col-md-12">
                      <div id="term1" class="divSubTerm col-md-3">
                        <label class="col-md-12" style="padding-left:0">Tanggal Term 1</label>
                        <input id="inputTerm1" class="form-input col-md-12" type="date" name="term[]" value="{{date('Y-m-d')}}" min="{{date('Y-m-d')}}" onchange="filterDateTerm(1,this.value)">
                        <!-- <input id="satuan" class="item form-input input col-md-12" name="satuan" readonly> -->
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group col-md-12">
                    <label class="col-md-12" style="padding-left:0">Deskripsi </label>
                    <textarea id="description" class="form-input input col-md-12" name="deskripsi" style="height: 110px;"></textarea>
                  </div>
                </div>
                <button type="submit" class="col-md-1 btn btn-primary" >Simpan</button>
                  
                     
              </form>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-12">
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
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script type="text/javascript">

  $(document).ready(function(){  
      document.getElementById("body").style.visibility = "visible";
  });

  var term = 1;
  const divTerm = $("#divTerm")[0].innerHTML;
  console.log(divTerm);
  function changeDateTerm(value){
    var termNew = parseInt(value);

    if (value > term){
      bawah   = Math.floor(value/4);
      samping = value%4;
      selisih = parseInt(value)-parseInt(term);
      index = term;
      do{
        index++;
        selisih--;
        console.log(selisih);
        var tmp = divTerm;
        tmp = tmp.replace(/id="term1/g,'id="term'+index);
        tmp = tmp.replace(/Tanggal Term 1/g,'Tanggal Term '+index);
        tmp = tmp.replace("filterDateTerm(1",'filterDateTerm('+index);
        tmp = tmp.replace("inputTerm1",'inputTerm'+index);

        $("#divTerm").append(tmp);
      }while(selisih > 0);
    }else if(value < term){
        for(i=term;i>termNew;i--)
          if($(".divSubTerm")[$(".divSubTerm").length-1])
            $(".divSubTerm")[$(".divSubTerm").length-1].remove();
    }
    term = termNew;
  }
  function filterDateTerm(value,date){
    var jumlah = $(".divSubTerm").length;
    if (value !=jumlah){
      for(i=value+1;i<=jumlah;i++){
        console.log("#inputTerm"+i+" date "+date);

        $("#inputTerm"+i).attr('min',date);

      }
    }
  }
</script>


</body>
</html>
