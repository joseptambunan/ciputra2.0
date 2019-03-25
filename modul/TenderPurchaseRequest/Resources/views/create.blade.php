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
      color: silver;
      background-color: silver;
    }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  @include("master/sidebar_project")
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Tambah Tender Purchase Request</h1>
    </section>
    <section class="content-header">
      <div class="" style="float: none">
        <button class="col-md-1 col-sm-2 btn btn-primary" onclick="location.href='{{ url('/')}}/tenderpurchaserequest/'" style="float: none; border-radius: 20px; padding-left: 0">
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
              <form id="regForm" action="{{ url('/')}}/tenderpurchaserequest/add-tpr" method="post" enctype="multipart/form-data" name="form1">
                @csrf
                <div class="tab">
                  <h3 class="box-title">Input Data Tender Purchase Request</h3>
                  <div class="form-group col-md-12">
                    <label class="col-md-12" style="padding-left:0">Name</label>
                    <input class="form-input input col-md-12" name="t_pr_name" placeholder="Input Name" required>
                  </div>
                  <!--
                  <div class="form-group col-md-3">
                    <label class="col-md-12" style="padding-left:0">Item</label>
                    <select id="item" class="form-input input col-md-12" name="t_pr_item" required>
                      <option value="" disabled selected>Pilih Item</option>
                    </select>
                  </div> -->
                  <div class="form-group col-md-12">
                    <label class="col-md-12" style="padding-left:0">Kelompok Tender</label>
                    <select id="tender_groups" class="form-input input col-md-12" name="t_pr_groups_id" required>
                      <option value="" disabled selected>Pilih Kelompok Tender</option>
                      @foreach($result_pengelompokan as $key => $v )
                      <option value="{{ $v['id'] }}">{{"No : ".$v['no']." | ".$v['desc']}}</option>
                      @endforeach
                    </select>
                  </div>

                  <!-- <div class="form-group col-md-3">
                    <label class="col-md-12" style="padding-left:0">Input Harga</label>
                    <input type="number" class="form-input input col-md-12" name="t_pr_harga" placeholder="Pilih Harga" required>
                  </div> -->
                  <div class="form-group col-md-6">
                    <label class="col-md-12" style="padding-left:0">Typy of Invitation Delivery</label>
                    <select class="form-input input col-md-12" name="t_pr_aanwijzing_type" required>
                        <option value="" disabled selected>Pilih Type Pengiriman Undangan</option>
                        <option value="Surat Cetak">Mail / Surat Cetak</option>
                        <option value="Email">Email / Surat Elektronik</option>
                        <option value="Telpon">Telephone / Telpon</option>
                        <option value="Fax">Fax</option>
                        
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label class="col-md-12" style="padding-left:0">Invitation Delivery Date</label>
                    <input type="date" class="form-input input col-md-12" name="t_pr_aanwijzing_date" 
                    onchange= "penawaran1.value = this.value;
                               klarifikasi_penawaran1.value = this.value;
                               penawaran2.value = autodate(this.value);
                               klarifikasi_penawaran2.value = penawaran2.value;
                               penawaran3.value = autodate(penawaran2.value);
                               final.value = penawaran3.value;
                               rekomendasi.value = penawaran3.value;
                               pengumuman.value = penawaran3.value;
                               " required>
                  </div>
                  <div class="form-group col-md-6">
                    <label class="col-md-12" style="padding-left:0">Penawaran 1 Date</label>
                    <input id="penawaran1" type="date" class="form-input input col-md-12" name="t_pr_penawaran1_date" onchange="klarifikasi_penawaran1.value = autodate(this.value)" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label class="col-md-12" style="padding-left:0">Klarifikasi 1 Date</label>
                    <input id="klarifikasi_penawaran1" type="date" class="form-input input col-md-12" name="t_pr_klarifikasi1_date" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label class="col-md-12" style="padding-left:0">Penawaran 2 Date</label>
                    <input id="penawaran2" type="date" class="form-input input col-md-12" name="t_pr_penawaran2_date" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label class="col-md-12" style="padding-left:0">Klarifikasi 2 Date</label>
                    <input id="klarifikasi_penawaran2" type="date" class="form-input input col-md-12" name="t_pr_klarifikasi2_date" required>
                  </div>
                  <div class="form-group col-md-12">
                    <label class="col-md-12" style="padding-left:0">Penawaran 3 Date</label>
                    <input id="penawaran3" type="date" class="form-input input col-md-12" name="t_pr_penawaran3_date" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label class="col-md-12" style="padding-left:0">Final Date</label>
                    <input id="final" type="date" class="form-input input col-md-12" name="t_pr_final_date" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label class="col-md-12" style="padding-left:0">Recommendation Date</label>
                    <input id="rekomendasi" type="date" class="form-input input col-md-12" name="t_pr_recommendation_date" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label class="col-md-12" style="padding-left:0">Pengumuman Date</label>
                    <input id="pengumuman" type="date" class="form-input input col-md-12" name="t_pr_pengumuman_date" required>
                  </div>
                  <div class="form-group col-md-12">
                    <label class="col-md-12" style="padding-left:0">Deskripsi</label>
                    <textarea type="number" class="form-input input col-md-12" name="t_pr_description" placeholder="Catatan Untuk Tender"></textarea>
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
<script src="{{ url('/')}}/assets/selectize/selectize.min.js"></script>
<script type="text/javascript">
  var jumlah_rekan_old = 0;
  
  $('.form-selectize-item1').selectize();
  
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
                $(".form-selectize-item"+i).selectize();

            }
        }else if(jumlah_item_new < jumlah_item_old){
            beda_item = jumlah_item_new-jumlah_item_old;
            for(i=jumlah_item_old;i>jumlah_item_new;i--)
                $(".sub_list_t_pr_p_d")[$(".sub_list_t_pr_p_d").length-1].remove();
        }
    }

  $(document).ready(function(){

    var url = "{{ url('/')}}/tenderpurchaserequest/getRab";
    var item = $("#item");

    $('#rab').change(function(){
      var send = $(this).val();
      var getjson = $.getJSON(url + '/' + send, function (data) {
        item.addClass("item");
        item.empty();
        var option        = document.createElement("option");
        option.value      = "";
        option.innerHTML  = "Pilih Item";
        option.setAttribute("disabled","true");
        option.setAttribute("selected","true");
        item.append(option);
        for(var i = 0; i <= data.length ; i++){
          if(i<data.length){
            var option        = document.createElement("option");
            option.value      = data[i].id;
            option.innerHTML  = data[i].description;
            item.append(option);
          }else
            item.removeClass("item");
        }
        
      }); 
    });
  });
  function autodate(val){
    tmp = new Date(val);
    tmp.setDate(tmp.getDate()+{{$auto_date_create_tender}});
    date = tmp.getDate();
    month = tmp.getMonth();
    if(date<10)
      date = '0'+date;
    if(month<10)
      month = '0'+month
    return(tmp.getFullYear()+"-"+month+"-"+date);
  }

</script>


</body>
</html>
