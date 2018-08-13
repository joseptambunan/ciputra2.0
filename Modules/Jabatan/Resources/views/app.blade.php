<script type="text/javascript">

  $( document ).ready(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-Token': $('input[name=_token]').val()
          }
        });
    });

  function deleteJabatan(id,jabatanname){
    if ( confirm("Apakah anda yakin ingin menghapus jabatan " + jabatanname)){
      var request = $.ajax({
        url : "/jabatan/deletejabatan",
        data : {
          id : id
        },
        type : "post",
        dataType : "json"
      });

      request.done(function(data){
        if ( data.status == "0"){
          alert("Data Jabatan " + jabatanname + " telah dihapus");
          window.location.reload();
        }else{
          alert("Terjadi Kesalahan Data");
          window.location.reload();
        }
      })
    }else{
      return false;
    }
  }

  

  function showedit(id){
    $(".labels").show();
    $("#label_" + id).hide();
    $("#label_kode_" +id).hide();

    $(".col-xs-4").hide();
    $("#jabatan_" + id).show();
    $("#kode_jabatan_" +id ).show();

    $(".btn-warning").show();
    $(".btn-success").hide();
    $("#btn_status_" + id).hide();
    $("#btn_save_" + id).show();
  }

  function saveEdit(id,jabatanname){
    var request = $.ajax({
      url : "/jabatan/updatejabatan",
      data : {
        name : $("#jabatan_" + id).val(),
        id : id,
        code : $("#kode_jabatan_" +id).val()
      },
      type : "post",
      dataType : "json"
    });

    request.done(function(data){
      if ( data.status == "0"){
        alert("Data Jabatan " + jabatanname + " telah diganti dengan " + $("#jabatan_" +id).val());
        window.location.reload();
      }else{
        alert("Terjadi kesalahan data");
        window.location.reload();
      }
    })
  }
</script>