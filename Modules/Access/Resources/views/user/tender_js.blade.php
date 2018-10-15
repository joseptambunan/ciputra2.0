<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.4/js/dataTables.fixedColumns.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/fixedcolumns/3.0.2/css/dataTables.fixedColumns.css">
<script type="text/javascript">
  $(document).ready(function() {
    $('#example3').DataTable( {
        scrollY:        300,
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   {
          leftColumns: 1,
        }
    } );

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('input[name=_token]').val()
        }
    });
   
  });


  function viewdetail(tender_id,rekanan_id){
    var request = $.ajax({
        url : "{{ url('/') }}/access/tender_penawaran/",
        data : {
          tender_id : tender_id,
          rekanan_id : rekanan_id
        },
        type : "get",
        dataType : "json"
    });

    request.done(function(data){
        $("#tender_preview_penawaran").html(data.html);
    })
  }

  function requestApproval(){
    var budget_id = $("input[name^='budget_id']").serializeArray();
    var description = $("input[name^='description']").serializeArray();
    var request = $.ajax({
      url : "{{ url('/') }}/access/budget/approval",
      data: {
         user_id : $("#user_id").val(),
        budget_id : budget_id,
        status : $("#btn_save_budgets").attr("data-value")
      },
      type :"get",
      dataType :"json"     
    });

    request.done(function(data){
      if ( data.status == "0"){
        window.location.reload();
      }else{
        alert("Error When Saving Approval");
        window.location.reload();
      }
    })
  }

  function requestRekanan(){
    var approval_id = $("#approval_id").val();
    var split_approval_id = approval_id.split(",");
    var apporval_value = "";
    for ( var i =0; i < split_approval_id.length; i++ ){
      if ( $("#approved" + split_approval_id[i]).is(":checked")){
        $("#status"+ split_approval_id[i]).attr("style","background-color:green;color:white")
        $("#status"+ split_approval_id[i]).html("<strong>Approve</strong>");
        apporval_value += split_approval_id[i] + "<>" + "6" +"==";
      }else{
        $("#status"+ split_approval_id[i]).attr("style","background-color:red;color:white")
        $("#status"+ split_approval_id[i]).html("<strong>Rejected</strong>");
        apporval_value += split_approval_id[i] + "<>" + "7" +"==";
      }
      
    }
    $("#apporval_value").val(apporval_value);
  }

  function requestRekananApproval(){
    var apporval_value = $("#apporval_value").val();
    var description = $("input[name^='description']").serializeArray();
    var request = $.ajax({
        url : "{{ url('/')}}/access/tender/rekanan/approve/",
        dataType : "json",
        data :{
          description : description,
          apporval_value : apporval_value,
          tender_id : $("#tender_id").val(),
          approval_id : $("#approval_id").val()
        },
        type : "get"
    });

    request.done(function(){
        window.location.reload();
    })
  }

 function setapprove(values,approval_id){
    console.log($(".approval").attr("data-approval"));
    if ( values == "6" ){
      $("#title_approval_rekanan").attr("style","color:blue");
      $("#title_approval_rekanan").text( $("#rekanan_" + approval_id ).text() + " will be APPROVED by You");
    }else{
      $("#title_approval_rekanan").attr("style","color:red");
      $("#title_approval_rekanan").text( $("#rekanan_" + approval_id ).text() + " will be REJECTED by You");
    }
    $("#btn_approval").attr("data-value",values);
    $("#rekanan_approval_id").val(approval_id);
  }

  function requestPemenang(){
    var request = $.ajax({
      url : "{{ url('/') }}/access/tender/menang",
      data: {
          rekanan_approval_id : $("#rekanan_approval_id").val(),
          list_rekanan_approval_id : $("#list_rekanan_approval_id").val(),
          status : $("#btn_approval").attr("data-value"),
          user_id : $("#user_id").val()
      },
      type :"post",
      dataType :"json"     
    });

    request.done(function(data){
      if ( data.status == "0"){
        window.location.reload();
      }else{
        alert("Error When Saving Approval");
        window.location.reload();
      }
    })
  }

  function setapproved(values,budget_id){
    if ( values == "6" ){
      $("#title_approvaled").attr("style","color:blue");
      $("#title_approvaled").text("These Tender will be APPROVED by You");
    }else{
      $("#title_approvaled").attr("style","color:red");
      $("#title_approvaled").text("These Tender will be REJECTED by You");
    }
    $("#btn_saved_tendered").attr("data-value",values);
  }

   function requestTender(){
    var approval_id = $("#approval_id").val();
    var split_approval_id = approval_id.split(",");
    var apporval_value = "";

    for ( var i =0; i < split_approval_id.length; i++ ){
      if ( !($("#approved" + split_approval_id[i]).is(":checked")) ){
        apporval_value += split_approval_id[i] + "<>" + "7" +"==";
      }else{
        apporval_value += split_approval_id[i] + "<>" + "6" +"==";
      }
      
    }
    $("#apporval_value").val(apporval_value);

    var request = $.ajax({
      url : "{{ url('/') }}/access/tender/approved",
      data: {
          tender_id : $("#tender_id").val(),
          status : $("#btn_saved_tendered").attr("data-value"),
          user_id : $("#user_id").val(),
          rekanan : $("#apporval_value").val()
      },
      type :"post",
      dataType :"json"     
    });

    request.done(function(data){
      if ( data.status == "0"){
        window.location.reload();
      }else{
        alert("Error When Saving Approval");
        //window.location.reload();
      }
    });
  }

  function setujuipemenang(id){
    if ( confirm("Apakah anda yakin ingin menentukan dia sebagai pemenang")){
      var request = $.ajax({
        url : "{{ url('')}}/access/tender/menang",
        dataType : "json",
        data : {
          id : id
        },
        type : "post"
      });

      request.done(function(data){
        if ( data.status == "0"){
        alert("Pemenang telah dipilih");
        window.location.reload();
        }
      });
    }else{
      return false;
    }
  }
</script>