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
    $("#label_kode" + id).hide();

    $(".col-xs-4").hide();
    $("#div_" + id).show();
    $("#div_kode_" + id).show();

    $(".btn-warning").show();
    $(".btn-success").hide();
    $("#btn_status_" + id).hide();
    $("#btn_save_" + id).show();
    $("#div_" + id).focus()
  }

  function deleteDiv(id,div){
    if ( confirm("Apakah anda yakin ingin menghapus Division " + div)){
      var request = $.ajax({
        url : "/division/deletedivision",
        data : {
          id : id
        },
        type : "post",
        dataType : "json"
      });

      request.done(function(data){
        if (data.status == "0"){
          alert(" Division " + div + " telah dihapus");
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
      url : "/division/updatedivision",
      data : {
        id : id,
        name : $("#div_" + id).val(),
        code : $("#div_kode_" +id).val()
      },
      type : "post",
      dataType : "json"
    });

    request.done(function(data){
      if ( data.status == "0"){
        alert("Data Divisi " + div + " telah diganti dengan " + $("#div_" + id).val());
        window.location.reload();
      }else{
        alert("Penyimpanan data bermasalah");
        window.location.reload();
      }
    })
  }
</script>