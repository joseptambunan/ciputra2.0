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
      <h1>Tambah Tender Purchase Request</h1>
    </section>
    <section class="content-header">
      <div class="" style="float: none">
        <button class="col-md-1 col-sm-2 btn btn-primary" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/pengelompokan'" style="float: none; border-radius: 20px; padding-left: 0">
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
                  <h3 class="box-title">Input Pengelompokan</h3>
                  <div class="form-group col-md-6">
                    <label class="col-md-12" style="padding-left:0">Item</label>
                    @if(isset($itemBrand))
                    <input name="idTender" value="{{$idTender}}" hidden>
                    <select id="item" class="form-input input col-md-12" name="item" required style="background-color: #eee;cursor: not-allowed;">
                      @foreach ($item as $v)
                        <option value="{{$v->item_id}}" selected>{{$v->name}}</option>
                      @endforeach
                    </select>
                    @else
                    <select id="item" class="form-input input col-md-12" name="item" required>
                        <option value="" disabled selected>Pilih Item</option>
                        @foreach ($item as $v)
                          <option value="{{$v->item_id}}">{{$v->name}}</option>
                        @endforeach
                      </select>
                    @endif
                  </div>
                  <div id="divBrand" class="form-group col-md-6">
                    <label class="col-md-12" style="padding-left:0">Brand</label>
                    @if(isset($itemBrand))
                    <select id="brand" class="form-input input col-md-12" name="brand" required style="background-color: #eee;cursor: not-allowed;">
                        <option value="{{$itemTender->brand_id}}">{{$itemBrand}}</option>
                    </select>
                    @else
                    <select id="brand" class="form-input input col-md-12" name="brand" required>
                        <option value="" disabled selected>Pilih Brand</option>
                      </select>
                    @endif
                  </div>
                  <div id="divItemPD" class="form-group col-md-12">
                    <label class="col-md-12" style="padding-left:0">Item Berdasarkan Deskripsi Lengkap</label>
                    <select id="item_per_description" class=" input col-md-12" name="item_per_description[]" multiple="multiple" required style="width:100%">
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label class="col-md-12" style="padding-left:0">Jumlah dalam Satuan Terkecil</label>
                    <input id="jumlah" class="item form-input input col-md-12" name="jumlah" readonly style="cursor: not-allowed;">
                  </div>
                  <div class="form-group col-md-6">
                    <label class="col-md-12" style="padding-left:0">Satuan Terkecil Baru</label>
                    <select id="satuan" class="form-input item input col-md-12" name="satuan" required style="width:100%;cursor: not-allowed;" >
                    </select>

                    <!-- <input id="satuan" class="item form-input input col-md-12" name="satuan" readonly> -->
                  </div>
                  <div class="form-group col-md-12">
                    <label class="col-md-12" style="padding-left:0">Deskripsi </label>
                    @if(isset($itemBrand))
                    <textarea id="description" type="number" class="form-input input col-md-12" name="descriptionSpec" style="height: 110px;">{{$description}}</textarea>
                    @else
                    <textarea id="description" type="number" class="form-input input col-md-12" name="descriptionSpec" style="height: 110px;">Spesifikasi : </textarea>
                    @endif
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


  var jumlah_rekan_old = 0;
  
  $('.form-selectize-item1').select2();
  $("#item_per_description").select2({
    placeholder: "Pilih Item",
    //closeOnSelect: false

});
  function banyak_komparasi(val){
    console.log(selectizePro);
  }
  
  function f_list_item(){
        var jumlah_item_old =$(".sub_list_t_pr_p_d").length;
        var jumlah_item_new = $("#t_pr_p_d_jumlah").val();
        if(jumlah_item_new > jumlah_item_old){
            for(i=parseInt(jumlah_item_old)+1;i<=jumlah_item_new;i++){
                tmp = a.replace('Tender PR Penawaran Detail 1','Tender PR Penawaran Detail  '+i);
                tmp = tmp.replace('banyak_komparasi(1','banyak_komparasi('+i);
                tmp = tmp.replace('form-selectize-item1','form-selectize-item'+i);
                $("#list_t_pr_p_d").append(tmp);
                $(".form-selectize-item"+i).select2();

            }
        }else if(jumlah_item_new < jumlah_item_old){
            beda_item = jumlah_item_new-jumlah_item_old;
            for(i=jumlah_item_old;i>jumlah_item_new;i--)
                $(".sub_list_t_pr_p_d")[$(".sub_list_t_pr_p_d").length-1].remove();
        }
    }

  $(document).ready(function(){
    if("<?=isset($itemBrand)?>"){
      //$("#item").val() = 
      document.getElementById("item").disabled = true;
      document.getElementById("brand").disabled = true;
      document.getElementById("description").disabled = true;
      
      var item = $("#item_per_description");
        var send1 = $("#brand").val();
        var send2 = $("#item").val();
        var url = "{{ url('/')}}/tenderpurchaserequest/getPengelompokanItemD"+ '/' + send1+"-"+send2;
        console.log(url);
        console.log(item);
        document.getElementById("divItemPD").style.visibility = "hidden";

        var getjson = $.getJSON(url, function (data) {
            item.addClass("item");
            item.empty();
            // var option        = document.createElement("option");
            // option.value      = "";
            // option.innerHTML  = "Pilih brand";
            // option.setAttribute("disabled","true");
            // option.setAttribute("selected","true");
            // item.append(option);
            for(var i = 0; i <= data.length ; i++){
            if(i<data.length){
                var option        = document.createElement("option");
                option.value      = data[i].id;
                option.innerHTML  = "Departemen Code : "+data[i].code+" | No. PR : "+data[i].no+" | Deskripsi : "+data[i].description + " | Jumlah : "+data[i].quantity+" "+data[i].satuan;
                item.append(option);
            }else
                item.removeClass("item");
            }
            document.getElementById("divItemPD").style.visibility = "visible";

        }); 
        
    }else{   
      $('#item').change(function(){
          var url = "{{ url('/')}}/tenderpurchaserequest/getPengelompokanBrand";
          var item = $("#brand");
          var send = $(this).val();
          document.getElementById("divBrand").style.visibility = "hidden";
          var getjson = $.getJSON(url + '/' + send, function (data) {
              item.addClass("item");
              item.empty();
              var option        = document.createElement("option");
              option.value      = "";
              option.innerHTML  = "Pilih brand";
              option.setAttribute("disabled","true");
              option.setAttribute("selected","true");
              item.append(option);
              for(var i = 0; i <= data.length ; i++){
              if(i<data.length){
                  var option        = document.createElement("option");
                  option.value      = data[i].brand_id;
                  option.innerHTML  = data[i].name;
                  item.append(option);
              }else
                  item.removeClass("item");
              }
              document.getElementById("divBrand").style.visibility = "visible";
          }); 
      });
      $('#brand').change(function(){
        var item = $("#item_per_description");
        var send1 = $(this).val();
        var send2 = $("#item").val();
        var url = "{{ url('/')}}/tenderpurchaserequest/getPengelompokanItemD"+ '/' + send1+"-"+send2;
        console.log(url);
        console.log(item);
        document.getElementById("divItemPD").style.visibility = "hidden";

        var getjson = $.getJSON(url, function (data) {
            item.addClass("item");
            item.empty();
            // var option        = document.createElement("option");
            // option.value      = "";
            // option.innerHTML  = "Pilih brand";
            // option.setAttribute("disabled","true");
            // option.setAttribute("selected","true");
            // item.append(option);
            for(var i = 0; i <= data.length ; i++){
            if(i<data.length){
                var option        = document.createElement("option");
                option.value      = data[i].id;
                option.innerHTML  = "Departemen Code : "+data[i].code+" | No. PR : "+data[i].no+" | Deskripsi : "+data[i].description + " | Jumlah : "+data[i].quantity+" "+data[i].satuan;
                item.append(option);
            }else
                item.removeClass("item");
            }
            document.getElementById("divItemPD").style.visibility = "visible";

        }); 
      });
    }
    $('#item_per_description').change(function(){
        var item1 = $("#satuan");
        var item2 = $("#jumlah");
        var send1 = $(this).val();
        var url = "{{ url('/')}}/tenderpurchaserequest/getPengelompokanJumlah"+ '/' + send1;
        console.log(url);
        console.log(item);
        var getjson = $.getJSON(url, function (data) {
          item1.empty();
          item2[0].value = data.jumlah;
          var option        = document.createElement("option");
          option.value      = data.satuan_id;
          option.innerHTML  = data.satuan;
          item1.append(option);
        }); 
        

      });
      document.getElementById("body").style.visibility = "visible";
  });

</script>


</body>
</html>
