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
    $("#label_rek_" + id).hide();

    $(".col-xs-4").hide();
    $("#bank_" + id).show();
    $("#rek_bang_" +id).show();

    $(".btn-warning").show();
    $(".btn-success").hide();
    $("#btn_status_" + id).hide();
    $("#btn_save_" + id).show();
    $("#rek_bang_" + id).focus();
    $("#rek_bang_" + id).show();
  }

  function deleteRek(id){
    if ( confirm("Apakah anda yakin ingin menghapus Rekening ini ? ")){
      var request = $.ajax({
        url : "/pt/delete-rekening",
        data : {
          id : id
        },
        type : "post",
        dataType : "json"
      });

      request.done(function(data){
        if (data.status == "0"){
          alert(" Rekening telah dihapus");
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

  function saveEdit(id,div){
    var request = $.ajax({
      url : "/pt/update-rekening",
      data : {
        id : id,
        bank : $("#bank_" + id).val(),
        rekening : $("#rek_bang_" +id).val()
      },
      type : "post",
      dataType : "json"
    });

    request.done(function(data){
      if ( data.status == "0"){
        alert("Data Rekening telah diganti");
        window.location.reload();
      }else{
        alert("Penyimpanan data bermasalah");
        window.location.reload();
      }
    })
  }

  $("#kota").change(function(){
      
  })
</script>