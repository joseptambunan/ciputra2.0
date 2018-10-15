<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard </title>
  @include("master/header")
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
        select{
          background-color: white;
        }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  @include("master/sidebar_project")
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Purchase Request</h1>
    </section>
    <section class="content">
      <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">              
              <h3 class="box-title">Tambah Purchase Request</h3>
              <form action="{{ url('/')}}/purchaserequest/add-pr" method="post" name="form1">
                @csrf
              <div class="form-group col-md-3">
              <label class="col-md-12" style="padding-left:0">Department</label>
              <select class="form-input col-md-12" name="department"  id="department" onchange="isi_deskripsi_umum(this.value);filter_budget(this.value)" required style="background-color: #eee; cursor: not-allowed;">
                <option value="{{ $department->id }} - {{ $department->name}}" selected>{{ $department->id }} - {{ $department->name}}</option>
              </select>
              </div>
             <div class="form-group col-md-3">
              <label class="col-md-12" style="padding-left:0">Budget Tahunan</label>
              <select class="form-input col-md-12" list="data_department" name="budget_tahunan"  id="budget_tahunan" autocomplete="off" placeholder="Pilih Budget Tahunan" onchange="filter_itempekerjaan(this.value);">
                <option value="" selected disabled>Pilih Budget Tahunan</option>
                @foreach($budget_no as $key => $v )
                  <option value="{{ $v[1] }}">{{ $v[0]}}</option>
                @endforeach
              </select>
              </div>
              <div id="form_waktu_dibutuhkan" class="form-group col-md-3">
                <label class="col-md-12" style="padding-left:0">Waktu Transaksi</label>
                <input class="form-input col-md-12" type="date" name="waktu_transaksi" min="<?=$date?>" style="padding-left:15px" value="<?=$date?>" required>
              </div>
              <div id="form_waktu_dibutuhkan" class="form-group col-md-3">
                <label class="col-md-12" style="padding-left:0">Waktu dibutuhkan</label>
                <input class="form-input col-md-12" type="date" name="butuh_date" min="<?=$date?>" style="padding-left:15px" required> 
              </div>
              <div id="form_diskripsi_umum" class="form-group col-md-10">
                <label class="col-md-12" style="padding-left:0">Deskripsi Umum</label>
                <textarea name="deskripsi_umum" class="form-input col-md-12" required></textarea>
              </div>
              <div id="form_is_urgent" class="form-group col-md-2">
                <label class="col-md-12" style="padding-left:0">Mendadak (Urgent)</label>
                <div class="radio">
                  <label><input type="radio" name="is_urgent" value="1">Ya</label>
                </div>
                <div class="radio">
                  <label><input type="radio" name="is_urgent" value="0" checked>Tidak</label>
                </div>
              </div>
              <div class="form-group col-md-12">
                <label class="col-md-12" style="padding-left:0">Jumlah Item</label>
                <input id="jumlah_item" name="jumlah_item" type="number" class="form-input col-md-12" placeholder="Masukkan jumlah item" min="1" value="1" onkeyup ="f_list_item()" required>
              </div>
              <div id="list_item" class="col-md-12">
              <div class="sub_list_item form-group col-md-12 panel panel-info">
              <div class="form-group panel-heading"> Item 1 </div>
              <div class="form-group col-md-4">
                <label class="col-md-12" style="padding-left:0">Item</label>
                <select class="form-selectize-item1 col-md-12" list="data_item" name="item[]" placeholder="Pilih Item" onchange="filter_satuan(this.value,1);isi_deskripsi_item(this.value,1)" required>
                <option value="" selected disabled>Pilih Item</option>
                  @foreach($item as $key => $value )
                  <option value="{{ $value->id }} - {{ $value->name}}">{{ $value->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-3">
                <label class="col-md-12" style="padding-left:0">Brand</label>
                <select class="form-selectize-item1 col-md-12" list="data_brand" name="brand[]" autocomplete="off" placeholder="Pilih Brand" required>
                  <option value="" selected disabled>Pilih Brand</option>
                  @foreach($brand as $key => $value )
                  <option value="{{ $value->id }} - {{ $value->name}}">{{ $value->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-2">
                <label class="col-md-12" style="padding-left:0">Kuantitas</label>
                <input id="kuantitas1" name="kuantitas[]" type="number" class="form-input col-md-12" placeholder="Input" min="1" required>
              </div>
              <div class="form-group col-md-3">
                <label class="col-md-12" style="padding-left:0">Satuan</label>
                <select id="satuan_item1" name="satuan[]" class="form-input col-md-12" required>
                </select>
              </div>
              <div id="form_jumlah_komparasi_supplier" class="form-group col-md-12 ">
                <label class="col-md-12" style="padding-left:0">Jumlah Komparasi Supplier</label>
                <select id="" name="j_komparasi[]" class="form-input jumlah_komparasi1 col-md-12" onchange="banyak_komparasi(1)" required>
                  <option value="-1" selected disabled>Pilih jumlah suplier (1 - 3)</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>
              <div id="" class="form_komparasi_supplier_1_item1 form-group" hidden>
                <label class="col-md-12" style="padding-left:0">Komparasi Supplier 1</label>
                <select id="komparasi_supplier_1_" name="komparasi_supplier1[1]" class="form-input col-md-12" onchange="recomended_supplier(this.value, this.options[this.selectedIndex].text,1,1)" required>
                  <option selected disabled>Pilih Komparasi Supplier 1</option>
                  @foreach($rekanan_group as $key => $value )
                  <option value="{{ $value->id }}">{{ $value->name}}</option>
                  @endforeach
                </select>
              </div>
              <div id="" class="form_komparasi_supplier_2_item1 form-group" hidden>
                <label class="col-md-12" style="padding-left:0">Komparasi Supplier 2</label>
                <select id="komparasi_supplier_2" name="komparasi_supplier2[1]" class="form-input col-md-12" onchange="recomended_supplier(this.value, this.options[this.selectedIndex].text,2,1)">
                  <option selected disabled>Pilih Komparasi Supplier 2</option>
                  @foreach($rekanan_group as $key => $value )
                  <option value="{{ $value->id }}">{{ $value->name}}</option>
                  @endforeach
                </select>
              </div>
              <div id="" class="form_komparasi_supplier_3_item1 form-group" hidden>
                <label class="col-md-12" style="padding-left:0">Komparasi Supplier 3</label>
                <select id="komparasi_supplier_3" name="komparasi_supplier3[1]" class="form-input col-md-12" onchange="recomended_supplier(this.value, this.options[this.selectedIndex].text,3,1)" required>
                  <option selected disabled>Pilih Komparasi Supplier 3</option>
                  @foreach($rekanan_group as $key => $value )
                  <option value="{{ $value->id }}">{{ $value->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-12">
                <label class="col-md-12" style="padding-left:0">Item Pekerjaan</label>
                <select id="data_itempekerjaan1" class="data_itempekerjaan form-input col-md-12" name="coa[]" placeholder="Pilih Item Pekerjaan" required>
                  <option value="" selected disabled>Pilih Item Pekerjaan</option>
                  @foreach($itempekerjaan as $key => $value )
                  <option value="{{ $value->id }}">{{ $value->name}}</option>
                  @endforeach
                </select>
              </div>
              <div id="form_deskripsi_umum" class="form-group col-md-12">
                <label class="col-md-12" style="padding-left:0">Deskripsi Item</label>
                <textarea id="deskripsi_item1" name="deskripsi_item[]" class="form-input col-md-12" required></textarea>
              </div>
              </div>
              </div>
              <button type="submit" class="col-md-1 btn btn-primary">Simpan</button>              
              </form>
            </div>
            <div class="col-md-12">
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
@include("master/footer_table")
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="{{ url('/')}}/assets/selectize/selectize.min.js"></script>
@include("pt::app")
<script>
    const item_struct = $("#list_item");
    var list_recomended_supplier= [];
    const a=item_struct[0].innerHTML;
    var jumlah_item_old = 1;
    var list_satuan = <?php echo($item_satuan)?> ;
    var list_itempekerjaan = <?php echo($itempekerjaan)?> ;
    var list_item = <?php echo($item)?> ;
    var budget = <?=$budget?>;
    var budget_tahunan = <?=$budget_tahunan?>;
    var budget_tahunan_detail = <?=$budget_tahunan_detail?>;
    var input_budget = <?=$input_budget_tahunan?>;
    function banyak_komparasi(item){
        $(".form_komparasi_supplier_1_item"+item).removeClass('col-md-12 col-md-6 col-md-4');
        $(".form_komparasi_supplier_2_item"+item).removeClass('col-md-12 col-md-6 col-md-4');
        $(".form_komparasi_supplier_3_item"+item).removeClass('col-md-12 col-md-6 col-md-4');
        $(".form_komparasi_supplier_1_item"+item,".form_komparasi_supplier_2_item"+item,".form_komparasi_supplier_3_item"+item).prop('selectedIndex',0);
        $(".form_komparasi_supplier_1_item"+item).hide();
        $(".form_komparasi_supplier_2_item"+item).hide();
        $(".form_komparasi_supplier_3_item"+item).hide();
        for(i=1;i<=$(".jumlah_komparasi"+item).val();i++){
            $(".form_komparasi_supplier_"+i+"_item"+item).addClass('col-md-'+12/$(".jumlah_komparasi"+item).val());
            $(".form_komparasi_supplier_"+i+"_item"+item).show();
        }
        for(i=1;i<=3;i++)
            if($(".form_komparasi_supplier_"+i+"_item"+item).is(":hidden"))
                $('.form_komparasi_supplier_'+i+'_item'+item+'option:first').prop('selected',true);
        if($(".jumlah_komparasi"+item).val() == 2)
            list_recomended_supplier.splice(2,1);
        if($(".jumlah_komparasi"+item).val() == 1){
            list_recomended_supplier.splice(2,1);
            list_recomended_supplier.splice(1,1);
        }
    }
    function f_list_item(){
        var jumlah_item_old =$(".sub_list_item").length;
        var jumlah_item_new = $("#jumlah_item").val();
        if(jumlah_item_new > jumlah_item_old){
            for(i=parseInt(jumlah_item_old)+1;i<=jumlah_item_new;i++){
                tmp = a.replace('Item 1','Item '+i);
                tmp = tmp.replace('banyak_komparasi(1','banyak_komparasi('+i);
                tmp = tmp.replace('form_komparasi_supplier_1_item1','form_komparasi_supplier_1_item'+i);
                tmp = tmp.replace('form_komparasi_supplier_2_item1','form_komparasi_supplier_2_item'+i);
                tmp = tmp.replace('form_komparasi_supplier_3_item1','form_komparasi_supplier_3_item'+i);
                tmp = tmp.replace('satuan_item1','satuan_item'+i);
                tmp = tmp.replace('jumlah_komparasi1','jumlah_komparasi'+i);
                tmp = tmp.replace('filter_satuan(this.value,1','filter_satuan(this.value,'+i);
                tmp = tmp.replace('komparasi_supplier1[1','komparasi_supplier1['+i);
                tmp = tmp.replace('komparasi_supplier2[1','komparasi_supplier2['+i);
                tmp = tmp.replace('komparasi_supplier3[1','komparasi_supplier3['+i);
                tmp = tmp.replace('recomended_supplier(this.value, this.options[this.selectedIndex].text,1,1','recomended_supplier(this.value, this.options[this.selectedIndex].text,1,'+i);
                tmp = tmp.replace('recomended_supplier(this.value, this.options[this.selectedIndex].text,2,1','recomended_supplier(this.value, this.options[this.selectedIndex].text,2,'+i);
                tmp = tmp.replace('recomended_supplier(this.value, this.options[this.selectedIndex].text,3,1','recomended_supplier(this.value, this.options[this.selectedIndex].text,3,'+i);
                tmp = tmp.replace('deskripsi_item1','deskripsi_item'+i);
                tmp = tmp.replace('isi_deskripsi_item(this.value,1','isi_deskripsi_item(this.value,'+i);
                tmp = tmp.replace('kuantitas1','kuantitas'+i);
                tmp = tmp.replace(/form-selectize-item1/g,'form-selectize-item'+i);
                tmp = tmp.replace(/data_itempekerjaan1/g,'data_itempekerjaan'+i);
                $("#list_item").append(tmp);
                $(".form-selectize-item"+i).selectize();
                filter_itempekerjaan($("#budget_tahunan").val(),"data_itempekerjaan"+i);
            }
        }else if(jumlah_item_new < jumlah_item_old){
            beda_item = jumlah_item_new-jumlah_item_old;
            for(i=jumlah_item_old;i>jumlah_item_new;i--)
                $(".sub_list_item")[$(".sub_list_item").length-1].remove();
        }
        
    }
    function filter_budget(val){
      var val = val.substr(0,val.indexOf(" -"));
      console.log(val);
    }
    function recomended_supplier(val,txt,ind,item){
        list_recomended_supplier[ind] = [val,txt];
        for(var j = 1;j<=3;j++){

        $("select[name='komparasi_supplier"+j+"["+item+"]']").find('option').each(function(){
                $(this).attr("disabled",false);
        });
        }
        for(var i = 1;i<=3;i++){
            val = $("select[name='komparasi_supplier"+i+"["+item+"]']").val();
            if(val != null){
                for(var j = 1;j<=3;j++){
                    if(j != i){
                        $("select[name='komparasi_supplier"+j+"["+item+"]']").find('option').each(function(){
                            if($(this).val() == val){
                                $(this).attr("disabled",true);
                            }
                        });
                    }
                }
            }
        }
    }
    function create_componen_supplier(value,text){
        var div = document.createElement("div");
        var label = document.createElement("label");
        var input = document.createElement("input");
        input.name = "rs[]";
        input.type = "checkbox";
        input.value = value;
        label.innerHTML = text;
        label.innerHTML = input.outerHTML + label.innerHTML;
        div.classList.add("checkbox");
        div.innerHTML = label.outerHTML;
        return div;
    }
    function filter_satuan(val,item){
        var id_item = val.substr(0,val.indexOf(" -"));
        $("#satuan_item"+item).append(option);
        $("#satuan_item"+item).empty();
        for(var i = 0; i < list_satuan.length;i++){
            if(list_satuan[i].item_id == id_item){
                var option = document.createElement("option");
                option.value = list_satuan[i].id;
                option.innerHTML = list_satuan[i].name;
                $("#satuan_item"+item).append(option);
            }
        }
    }
    function filter_itempekerjaan(val,val2){
      // if(val != ""){
      //   val = val.substr(0,val.indexOf(" -"));
      //   $(".data_itempekerjaan").empty();
      //   var list_id_itempekerjaan = [];
      //   for(var i = 0; i<budget.length;i++)
      //     if(val == budget[i].department_id)
      //       for(var j = 0; j<budget_tahunan.length;j++)
      //         if(budget[i].id == budget_tahunan[j].id)
      //           for(var k = 0; k<budget_tahunan_detail.length;k++)
      //             if(budget_tahunan_detail[k].budget_tahunan_id == budget_tahunan[j].id)
      //               for(var l = 0; l<list_itempekerjaan.length;l++)
      //                 if(budget_tahunan_detail[k].itempekerjaan_id == list_itempekerjaan[l].id)
      //                   list_id_itempekerjaan.push(budget_tahunan_detail[k].itempekerjaan_id);
      //   list_id_itempekerjaan = list_id_itempekerjaan.sort((a, b) => a - b);
      //   var list_unique_id_itempekerjaan = [];
      //   $.each(list_id_itempekerjaan, function(i, el){
      //       if($.inArray(el, list_unique_id_itempekerjaan) === -1) list_unique_id_itempekerjaan.push(el);
      //   });
        
      //   $(".data_itempekerjaan").append("<option value='' selected disabled>Pilih Item Pekerjaan</option>");
      //   for(var i = 0; i<list_unique_id_itempekerjaan.length;i++){
      //     var tmp_id = list_itempekerjaan.findIndex(x => x.id==[list_unique_id_itempekerjaan[i]]);
      //     var tmp = document.createElement("option");
      //     tmp.value = list_itempekerjaan[tmp_id].id+" - "+list_itempekerjaan[tmp_id].name;
      //     tmp.innerHTML = list_itempekerjaan[tmp_id].name;
      //     $(".data_itempekerjaan").append(tmp);
      //   }
      // }
        if(val2){
          $("#"+val2).empty();
          var tmp       = document.createElement("option");
          tmp.value     = "";
          tmp.innerHTML = "Pilih Item Pekerjaan";
          tmp.setAttribute("disabled","true");
          tmp.setAttribute("selected","true");
          $("#"+val2).append(tmp);
          for(var i=0;i<budget.length;i++){
            if(budget[i].btId == val){
              var tmp       = document.createElement("option");
              tmp.value     = budget[i].btdItemPekerjaan;
              tmp.innerHTML = budget[i].ipName;
              console.log(tmp);
              $("#"+val2).append(tmp);
            }
          }
        }else{
          $(".data_itempekerjaan").empty();
          var tmp       = document.createElement("option");
          tmp.value     = "";
          tmp.innerHTML = "Pilih Item Pekerjaan";
          tmp.setAttribute("disabled","true");
          tmp.setAttribute("selected","true");
          $(".data_itempekerjaan").append(tmp);
          for(var i=0;i<budget.length;i++){
            if(budget[i].btId == val){
              var tmp       = document.createElement("option");
              tmp.value     = budget[i].btdItemPekerjaan;
              tmp.innerHTML = budget[i].ipName;
              console.log(tmp);
              $(".data_itempekerjaan").append(tmp);
            }
          }
        }
        console.log(val);
        console.log(budget[0]);
    }
    function isi_deskripsi_umum(val){
        $("textarea[name='deskripsi_umum']").val(val);
    }
    function isi_deskripsi_item(val,item){
        $("#deskripsi_item"+item).val(val);
    }
    $(".form-selectize").selectize();  
    $(".form-selectize-item1").selectize();


    $(document).ready(function(){
      var url = "{{ url('/')}}/purchaserequest/getBudgetTahunan";
      var item = $("#budget_tahunan");
      $('#department').change(function(){
        var send = parseInt($(this).val())+"|"+<?=$project->id?>;
        var getjson = $.getJSON(url + '/' + send, function (data) {
          item.addClass("item");
          item.empty();
          var option        = document.createElement("option");
          option.value      = "";
          option.innerHTML  = "Pilih Budget Tahunan";
          option.setAttribute("disabled","true");
          option.setAttribute("selected","true");
          item.append(option);
          for(var i = 0; i <= data.length ; i++){
            if(i<data.length){
              var option        = document.createElement("option");
              option.value      = data[i].id;
              option.innerHTML  = data[i].no;
              item.append(option);
            }else
              item.removeClass("item");
          }
          
        }); 
      });
    });
</script>
</body>
</html>
