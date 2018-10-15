<script type="text/javascript">

$( document ).ready(function() {
  $.ajaxSetup({
      headers: {
          'X-CSRF-Token': $('input[name=_token]').val()
      }
    });

  $(".nilai_budgets").number(true);
});
  
$("#item_coa").change(function(){
  if ( $("#item_coa").val() == "" ){
    $("#itempekerjaan").html("");
    alert("Budget Tahunan belum diapprove untuk Pekerjaan ini ");
    return false;
  }

  $("#budget_total").html("0");
  $("#budget_total_val").val();
  var request = $.ajax({
    url : "{{ url('/')}}/rab/childcoa",
    dataType : "json",
    data : {
    	id : $("#item_coa").val(),
      workorder : $("#workorder").val()
    },
    type : "post"
  });

  request.done(function(data){
  	$("#itempekerjaan").html(data.html);
    $("#budget_total").html(data.budget);
    $("#budget_total").number(true);
    $("#budget_total_val").val(data.budget);
    $("#budget_tahunan_id").val(data.budget_tahunan_id);
    $("#budget_tersisa_val").val(data.budget_tersisa);
    $("#budget_tersisa").text(data.budget_tersisa);
    $("#budget_tersisa").number(true);
    $(".nilai_budget").number(true);
  });
});

$("#item_child_coa").change(function(){
    var request = $.ajax({
      url : "{{ url('/')}}/rab/pekerjaan",
      dataType : "json",
      data : {
        id : $("#item_child_coa").val(),
        workorder : $("#workorder").val()
      },
      type : "post"
    });

    request.done(function(data){
      $("#itempekerjaan").html(data.html);
      $(".nilai_budgets").number(true);
    })
});

function apprioval(id){
  if ( confirm("Apakah anda yakin ingin merilis data ini ?")){
    var request = $.ajax({
      url : "{{ url('/')}}/rab/approval",
      dataType : "json",
      data : {
        id : id
      },
      type : "post"
    });

    request.done(function(data){
      if ( data.status == "0"){
        alert("Dokumen telah dirilis");
      }
      window.location.reload();
    });
  }else{
    return false;
  }
}

  function checkall() {
    if ( $("#unit_rab_all").is(":checked")){
      $(".rab_unit").attr("checked","checked");
    }else{
      $(".rab_unit").removeAttr("checked");
    }
  }

  function removeunit(id){
    if ( confirm("Apakah anda yakin ingin menghapus unit ini ?")){
      var request = $.ajax({
        url : "{{ url('/')}}/rab/delete-unit",
        data : {
          id : id
        },
        type : "post",
        dataType : "json"
      });

      request.done(function(data){
        if ( data.status == "0"){
          alert("Data unit telah dihapus ");
        }
        window.location.reload();
      })
    }else{
      return false;
    }
  }

  function viewdite(id){
    $(".labels").show();
    $("#label_rab_volume_" + id ).hide();
    $("#label_rab_nilai_" + id ).hide();
    $("#label_rab_satuan_" + id ).hide();
    $("#btn_edit_" + id).hide();
    $(".values").hide();
    $(".btn-edit1").show();

    $(".btn-edit2").hide();
    $("#input_rab_volume_" + id ).show();
    $("#input_rab_nilai_" + id ).show();
    $("#input_rab_satuan_" + id ).show();
    $("#btn_edit2_" + id).show();
    $("#btn_edit_" + id).hide();
  }

  function saveedit(id){
    var request = $.ajax({
      url : "/rab/saveedit",
      dataType : "json",
      data : {
        id : id,
        volume : $("#input_rab_volume_" + id ).val(),
        nilai : $("#input_rab_nilai_" + id ).val(),
        satuan : $("#input_rab_satuan_" + id ).val()
      },
      type : "post"
    });

    request.done(function(data){
      if ( data.status == "0"){
        alert("Data telah diupdate");
      }
      window.location.reload();
    })
  }

  function summary(id){
    var summary = parseInt($("#volume_" + id).val()) * parseInt($("#nilai_" + id).val());
    if ( summary == "NaN"){
      $("#total_" + id).text("");
    }else{
      $("#total_" + id).text(summary);
      $("#total_" + id).number(true);
    }
  }

  function conCostSelect(id){
    $(".type").hide();
    $(".type_" + id).show();
  }

  function deletepekerjaans(id){
    if ( confirm("Apakah anda yakin ingin menghapus pekerjaan RAB ini ? ")){
      var request = $.ajax({
        url : "{{ url('/')}}/rab/delete-pekerjaan",
        data : {
          id : id
        },
        type : "post",
        dataType : "json"
      });

      request.done(function(data){
        if ( data.status == "0"){
          alert("Pekerjaan telah dihapus");
        }
        window.location.reload();
        return false;
      })
    }else{
      return false;
    }
  }
</script>