<script type="text/javascript">
  $(function () {
    $('[data-mask]').inputmask();
    $(".select2").select2();
  });

  $( document ).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('input[name=_token]').val()
        }
      });

    console.log();
  });

  $("#btn_submit").click(function(){
    $(".submitbtn").hide();
    $("#loading").show();

    var request = $.ajax({
      url : "{{ url('/')}}/rekanan/ceknpwp",
      dataType : "json",
      data : {
        npwp_no : $("#npwp").val()
      },
      type : "post"
    });

    request.done(function(data){
      if ( data.status == "0"){
        if (confirm("Rekanan belum didaftarkan. Apakah anda ingin mendaftarkannya ?")) {
          var request = $.ajax({
            url : "{{ url('/')}}/rekanan/store",
            dataType : "json",
            data : {
              npwp_no : $("#npwp").val()
            },
            type : "post"
          });

          request.done(function(data){
            if ( data.status == "0"){
              window.location.href = "{{ url('/')}}" + data.url;
            }

            $(".submitbtn").show();
            $("#loading").hide();

          })
          
        } else {
          $(".submitbtn").show();
          $("#loading").hide();
          return false;
        }       
      }else{
        alert("Rekanan sudah didaftarkan dengan nama " + data.nama);

          $(".submitbtn").show();
          $("#loading").hide();
      }

    });
  });

  function blacklist(id,status){
    if ( status == "1"){
        if (confirm("Apakah anda ingin memblack list rekanan ini ?")){
        var request = $.ajax({
          url : "{{ url('/')}}/rekanan/blacklist",
          dataType : "json",
          data : {
            id : id,
            status : status
          },
          type : "post"
        });

        request.done(function(data){
          if ( data.status == "0"){
            alert("Rekanan telah di blacklist");
            window.location.reload();
          }else{
            return false;
          }
        })
      }else{
        return false;
      }
    }else if ( status == "2"){
      if (confirm("Apakah anda ingin meremove black list rekanan ini ?")){
        var request = $.ajax({
          url : "{{ url('/')}}/rekanan/blacklist",
          dataType : "json",
          data : {
            id : id,
            status : status
          },
          type : "post"
        });

        request.done(function(data){
          if ( data.status == "0"){
            alert("Rekanan telah diterima kembali");
            window.location.reload();
          }else{
            return false;
          }
        })
      }else{
        return false;
      }
    }
    
  }

  function deletespesifikasi(id){
    if ( confirm("Apakah anda yakin ingin menghapus spesifikasi ini ?")){
      $("#delete_" + id).hide();
      var request = $.ajax({
        url : "{{ url('/')}}/rekanan/spesifikasi-delete",
        dataType : "json",
        data : {
          id : id
        },
        type : "post"
      });

      request.done(function(data){
        if ( data.status == "0"){
          alert("Data telah dihapus");
          window.location.reload();
        }
      })
    }else{
      $("#delete_" + show).hide();
      return false;
    }
  }
</script>