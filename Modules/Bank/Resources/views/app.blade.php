<script type="text/javascript">

  $( document ).ready(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-Token': $('input[name=_token]').val()
          }
        });
    });

  $('#example3').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false
    });

   function showedit(id){
    $(".labels").show();
    $("#label_" + id).hide();
    $("#label_masking_" + id).hide();
    $("#label_kota_" + id).hide();

    $(".col-xs-4").hide();
    $("#bank_" + id).show();
    $("#bank_masking_" + id).show();
    $("#city_id_" + id).show();

    $(".btn-warning").show();
    $(".btn-success").hide();
    $("#btn_status_" + id).hide();
    $("#btn_save_" + id).show();
    $("#bank_" + id).focus()
  }

  function deleteBank(id,bank){
    if ( confirm("Apakah anda yakin ingin menghapus Bank " + bank)){
      var request = $.ajax({
        url : "/bank/deletedbank",
        data : {
          id : id
        },
        type : "post",
        dataType : "json"
      });

      request.done(function(data){
        if (data.status == "0"){
          alert(" Bank " + bank + " telah dihapus");
          window.location.reload();
        }else{
          alert("Penghapusan data bermasalah");
          window.location.reload();
        }
      })
    }else{
      return false;
    }
  }

  function saveEdit(id,bank){
    var request = $.ajax({
      url : "/bank/updatebank",
      data : {
        id : id,
        name : $("#bank_" + id).val(),
        masking : $("#bank_masking_" + id).val(),
        kota : $("#city_id_" + id).val()
      },
      type : "post",
      dataType : "json"
    });

    request.done(function(data){
      if ( data.status == "0"){
        alert("Data Bank " + bank + " telah diganti dengan " + $("#bank_" + id).val());
        window.location.reload();
      }else{
        alert("Penyimpanan data bermasalah");
        window.location.reload();
      }
    })
  }

  
</script>