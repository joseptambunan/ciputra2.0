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
</script>