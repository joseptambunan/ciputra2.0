<script type="text/javascript">

  $( document ).ready(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-Token': $('input[name=_token]').val()
          }
        });

        $(".nilai_budget").number(true);
    });

  function setkawasan(){
    if ( $("#iskawasan").is(":checked")){
      $("#kawasan").show();
    }else{
      $("#kawasan").hide();
    }
  }

  function updatebudgetdetail(id){
    $("#label_volume_" +id).hide();
    $("#label_nilai_" +id).hide();
    $("#btn_edit1_" +id).hide();

    $("#input_volume_" +id).show();
    $("#input_nilai_" +id).show();
    $("#btn_edit_" +id).show();
  }

  function savebudgetdetail(id){
    var request = $.ajax({
      url : "/budget/item-saveedit",
      data : {
        id : id,
        nilai : $("#input_nilai_" +id).val(),
        volume : $("#input_volume_" +id).val()
      },
      type : "post",
      dataType : "json"
    });

    request.done(function(data){
      alert("Data budget telah diganti");
    });

    window.location.reload();

  }

  function deletebudgetdetail(id){
    if ( confirm("Apakah anda yakin ingin menghapus data ini ? ")){
        var request = $.ajax({
          url : "/budget/delete-itembudget",
          data : {
            id : id
          },
          type : "post",
          dataType : "json"
        });

        request.done(function(data){
          alert("Data budget telah diganti");
        });
        window.location.reload();

    }else{
      return false;
    }
  }

  function removeedit(id){
    if ( confirm("Apakah anda yakin ingin menghapus data ini ? ")){
      var request = $.ajax({
        url : "/budget/delete-itembudget",
        dataType : "json",
        data : {
          id : id
        },
        type : "post"
      });

      request.done(function(data){
        if ( data.status == "0" ){
          alert("Item Budget telah dihapus ");
        }
        window.location.reload();
      })
    }else{
      return false;
    }
  }

  function editview(id){
    $("#label_volume_" + id).hide();
    $("#label_satuan_" + id).hide();
    $("#label_nilai" + id).hide();

    $("#volume_" + id).show();
    $("#satuan_" + id).show();
    $("#nilai_" + id).show();

    $("#btn_edit1_" + id).hide();
    $("#btn_edit2_" + id).show();
  }

  function saveedit(id){
    var request = $.ajax({
      url : "/budget/update-itembudget",
      dataType : "json",
      data : {
        id : $("#item_id_" +id).val(),
        volume : $("#volume_" +id).val(),
        satuan : $("#satuan_" +id).val(),
        nilai : $("#nilai_" +id).val(),
        itempekerjaan : $("#item_pekerjaan_id_" + id).val(),
        budget_id : $("#budget_id").val()
      },
      type : "post"
    });

    request.done(function(data){
        if ( data.status == "0"){
          alert("Data telah diupdate");
          window.location.reload();
        }else{
          window.location.reload();
        }
    })
  }

  $("#budget_coa_id").change(function(data){
    if ( $("#budget_coa_id").val() == "" ){
      $(".item").show();
    }else{
      $(".item").hide();
      $(".item_id_" + $("#budget_coa_id").val()).show();
    }
  })

  function requestapprove(id){
    if ( confirm("Apakah anda yakin ingin merilis budget cash flow ini ?")){
        var request = $.ajax({
          url : "{{ url('/')}}/budget/cashflow/approval",
          dataType : "json",
          data : {
            id : id
          },
          type : "post"
        });

        request.done(function(data){
          if ( data.status == "0"){
            alert("Budget Cashflow telah dirilis");
          }else{
            return false;
          }
          window.location.reload();
        });

    }else{
      return false;
    }
    
  }

  $(function(){
    $("#label_cash_flow_spk").text($("#total_budget_bln").val());
    $("#label_cash_flow_spk").number(true);

    var total_cash_flow_spk = parseInt($("#total_budget_bln").val());
    var total_budget_bln_co = parseInt($("#total_budget_bln_co").val());
    var total_cash_flow = parseInt(total_cash_flow_spk + total_budget_bln_co);
    $("#label_cash_flow").text(total_cash_flow);
    $("#label_cash_flow").number(true);

  });

  $("#item_id_monthly").change(function(){
    $(".label_budget").hide();
    $("#label_budget_" + $("#item_id_monthly").val()).show();
    $("#total_sub").val("0");
  });

  $("#item_id_monthly_co").change(function(){
    $(".label_budget_co").hide();
    $("#label_budget_co_" + $("#item_id_monthly_co").val()).show();
    $("#total_sub_co_").val("0");
  })

  function viewedit(id){
    $("#label_januari_" + id).hide();
    $("#label_februari_" + id).hide();
    $("#label_maret_" + id).hide();
    $("#label_april_" + id).hide();
    $("#label_mei_" + id).hide();
    $("#label_juni_" + id).hide();
    $("#label_juli_" + id).hide();
    $("#label_agustus_" + id).hide();
    $("#label_september_" + id).hide();
    $("#label_oktober_" + id).hide();
    $("#label_november_" + id).hide();
    $("#label_desember_" + id).hide();
    $("#btn_edit1_" +id).hide();

    $("#januari_" + id).show();
    $("#februari_" + id).show();
    $("#maret_" + id).show();
    $("#april_" + id).show();
    $("#mei_" + id).show();
    $("#juni_" + id).show();
    $("#juli_" + id).show();
    $("#agustus_" + id).show();
    $("#september_" + id).show();
    $("#oktober_" + id).show();
    $("#november_" + id).show();
    $("#desember_" + id).show();
    $("#btn_edit2_" +id).show();
  }

  function saveedit(id){

  var request = $.ajax({
    url : "{{ url('/')}}/budget/cashflow/update-monthly",
    data : {
      id : $("#monthly_id_" + id).val(),
      jan : $("#januari_" + id).val(),
      feb : $("#februari_" + id).val(),
      mar : $("#maret_" + id).val(),
      apr : $("#april_" + id).val(),
      mei : $("#mei_" + id).val(),
      jun : $("#juni_" + id).val(),
      jul : $("#juli_" + id).val(),
      agu : $("#agustus_" + id).val(),
      sept : $("#september_" + id).val(),
      okt : $("#oktober_" + id).val(),
      nov : $("#november_" + id).val(),
      des : $("#desember_" + id).val()
    },
    type : "post",
    dataType : "json"
  });

  request.done(function(data){
    if ( data.status == "0"){
      alert("Data telah diganti");
    }

    window.location.reload();
  })
}

  function removeedit(id){
  if ( confirm("Apakah anda yakin ingin menghapus data ini ? ")){
    var request = $.ajax({
      url : "{{ url('/')}}/budget/cashflow/delete-monthly",
      data : {
        id : id 
      },
      type : "post",
      dataType : "json"
    });

    request.done(function(data){
      if ( data.status == "0"){
        alert("data telah dihapus");
      }
      window.location.reload();
    })

  }else{
    return false;
  }
}

function removecarry(id){
  if ( confirm("Apakah anda yakin ingin menghapus data ini ?")){
    var request = $.ajax({
      url : "{{ url('/')}}/budget/delete-carryover",
      data : {
        id : id 
      },
      type : "post",
      dataType : "json"
    });

    request.done(function(data){
      if ( data.status == "0"){
        alert("data telah dihapus");
      }
      window.location.reload();
    })
  }else{
    return false;
  }
}

function countPercentage(bln,co){
  //console.log(bln);
  var percent = parseInt($("#"+bln).val());
  var sub2 = parseInt($("#label_budget_" + $("#item_id_monthly").val()).attr("data-value"));
  var sub = percent * ( parseInt(sub2)) / 100;
  var total = parseInt($("#total_sub" + co).val());


  /*if ( total > sub2 ){
    alert("Persentase Budget Bulanan sudah 100 %");
    $("#btn_save_bln").hide();
    
  }else{
    
  }*/

    if ( sub != "NaN"){    
      $("#lbl_"+bln).text(sub);
      $("#lbl_"+bln).attr("data-value",sub);
      $("#lbl_"+bln).number(true); 
      $("#sisa_budget").text(sub2 - total);   
      $("#sisa_budget").number(true);   
    }
  
    $("#total_sub").val( parseInt($("#lbl_januari").attr("data-value")) + parseInt($("#lbl_februari").attr("data-value")) + parseInt($("#lbl_maret").attr("data-value")) + parseInt($("#lbl_april").attr("data-value")) + parseInt($("#lbl_mei").attr("data-value")) + parseInt($("#lbl_juni").attr("data-value")) + parseInt($("#lbl_juli").attr("data-value")) + parseInt($("#lbl_agustus").attr("data-value")) + parseInt($("#lbl_september").attr("data-value")) + parseInt($("#lbl_oktober").attr("data-value")) + parseInt($("#lbl_november").attr("data-value")) + parseInt($("#lbl_desember").attr("data-value")) );
    $("#lbl_budget_text").text($("#total_sub").val());
    $("#lbl_budget_text").number(true);

    var totals = ( parseInt($("#januari").val()) + parseInt($("#februari").val()) + parseInt($("#maret").val()) + parseInt($("#april").val()) + parseInt($("#mei").val()) + parseInt($("#juni").val()) + parseInt($("#juli").val()) + parseInt($("#agustus").val()) + parseInt($("#september").val()) + parseInt($("#oktober").val()) + parseInt($("#november").val()) + parseInt($("#desember").val()) );
    //console.log(totals);
    if ( totals != "NaN"){
      $("#lbl_percent_text").text(totals);
    }

    if ( parseInt($("#lbl_percent_text").text()) > 100 ){
      alert("Persentase Budget Bulanan sudah 100 %");
      $("#btn_save_bln").attr("style","display:none");
      $("#lbl_percent_text").text(parseInt(totals) - $("#" + bln).val());
      $("#" + bln).val("0");
    }else{
      $("#btn_save_bln").show();
    }


}

$("#btn_save_bln").click(function(){
  $("#loading_cf_bar").text("Loading");
  $("#btn_save_bln").hide();

  var request = $.ajax({
      url : "{{ url('/')}}/budget/cashflow/save-monthly",
      data : {
        budget_tahunan_id : $("#budget_tahunan_id").val(),
        item_id_monthly : $("#item_id_monthly").val(),
        januari : $("#januari").val(),
        februari : $("#februari").val(),
        maret : $("#maret").val(),
        april : $("#april").val(),
        mei : $("#mei").val(),
        juni : $("#juni").val(),
        juli : $("#juli").val(),
        agustus : $("#agustus").val(),
        september : $("#september").val(),
        oktober : $("#oktober").val(),
        november : $("#november").val(),
        desember : $("#desember").val()
      },
      type : "post",
      dataType : "json"
  });

  request.done(function(data){
    alert("Data telah disimpan");
    window.location.reload();
  })
});

function getCarryOverDC(){
  $("#carry_over_dc").text("loading...");

  var request = $.ajax({
    url : "{{ url('/')}}/budget/carryoverdc",
    dataType : "json",
    data : {
      id : $("#budget_tahunan_id").val()
    },
    type : "post"
  });

  request.done(function(data){
      $("#carry_over_dc").text(data.nilai);
      
      if ( $("#carry_over_cc").text() != "loading..."){
        var carryovercc = parseInt($("#carry_over_cc").text());
        var carryoverdc = parseInt($("#carry_over_dc").text());
        var carryover = carryoverdc + carryovercc;
        $("#carry_over_total").text(carryover);
      }else{
        $("#carry_over_total").text(0);
      }

      $("#carry_over_dc").number(true);
      $("#carry_over_total").number(true);
  });
}

function getCarryOvercc(){
  $("#carry_over_cc").text("loading...");
  var request = $.ajax({
    url : "{{ url('/')}}/budget/carryovercc",
    dataType : "json",
    data : {
      id : $("#budget_tahunan_id").val()
    },
    type : "post"
  });

  request.done(function(data){
      $("#carry_over_cc").text(data.nilai);

      if ( $("#carry_over_cc").text() != "loading..."){
        var carryovercc = parseInt($("#carry_over_cc").text());
        var carryoverdc = parseInt($("#carry_over_dc").text());
        var carryover = carryoverdc + carryovercc;
        $("#carry_over_total").text(carryover);
      }else{
        $("#carry_over_total").text(0);
      }

      $("#carry_over_cc").number(true);
      $("#carry_over_total").number(true);
      
  });
}

function getRencanaDC(){
  $("#rencana_spk_dc").text("loading...");
  var request = $.ajax({
    url : "{{ url('/')}}/budget/rencanadc",
    dataType : "json",
    data : {
      id : $("#budget_tahunan_id").val()
    },
    type : "post"
  });

  request.done(function(data){
      $("#carry_over_cc").text(data.nilai);
      $("#carry_over_cc").number(true);
  });
}

function getRencanaCC(){
  $("#rencana_spk_cc").text("loading...");
}

function getCarryOverCashOutDC(){
  $("#label_cf_carryover_devcost").text("loading...");
}

function getCarryOverCashOutCC(){
  $("#label_cf_carryover_concost").text("loading...");
}

function getRencanaCashOutDC(){
  $("#label_cash_flow").text("loading...");
}

function getRencanaCashoutCC(){
  $("#label_cash_flow_co").text("loading...");
}
</script>