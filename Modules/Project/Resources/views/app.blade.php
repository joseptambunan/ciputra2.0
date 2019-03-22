<script type="text/javascript">

  $( document ).ready(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-Token': $('input[name=_token]').val()
          }
        });

        $("#lb").number(true,2);
        $("#lt").number(true,2);
        $(".nilai_budget").number(true);
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

  function removeKawasan(id,kawasan_name){
  if ( confirm("Apakah anda yakin ingin menghapus data ini ? ")){
    var request = $.ajax({
      url : "{{ url('/')}}/project/delete-kawasan",
      data : {
        id : id
      },
      dataType : "json",
      type : "post"
    });

    request.done(function(data){
      if ( data.status == "0"){
        alert("Data Kawasan " + kawasan_name + " telah dihapus");
      }
      window.location.reload();
    })
  }else{
    return false;
  }
}

function removeblok(id,name) {
    if ( confirm("Apakah anda yakin ingin menghapus blok " + name + " ini ? ")){
        var request = $.ajax({
            url : "{{ url('/')}}/project/delete-blok",
            dataType : "json",
            data : {
              id : id
            },
            type : "post"
        });

        request.done(function(data){
          if ( data.status == "0"){
            alert(" Blok " + name + " telah dihapus" );
          }
          window.location.reload();
        })
    }else{
      return false;
    }
  }

  function addunitdelete(id){
    if ( $("#delete_unit_" + id).is(":checked")){
      var unit_id = $("#unit_id").val();
      var add_unit_id = unit_id + "," + id;
      $("#unit_id").val(add_unit_id);
    }else{
      var unit_id = $("#unit_id").val();
      var replace_unit_id = unit_id.replace("," + id, "");
      $("#unit_id").val(replace_unit_id);
    }
  }

  $("#btn_del_unit").click(function(){
    if ( $("#unit_id").val() == "" ){
      alert("Unit yang dihapus tidak ada");
      return false;
    }else{
      var request = $.ajax({
        url : "{{ url('/')}}/project/delete-unit",
        dataType : "json",
        data : {
          unit_id : $("#unit_id").val()
        },
        type : "post"
      });

      request.done(function(data){
        if ( data.status == "0"){
          alert("Unit telah dihapus");
        }

        window.location.reload();
      });
    }
  });

  function removeGambar(id){
    if ( confirm("Apakah anda yakin ingin menghapus data ini ?")){
      var request = $.ajax({
        url : "{{ url('/')}}/project/spesifikasi-delete",
        dataType : "json",
        data : {
          id : id
        },
        type : "post"
      });

      request.done(function(data){
        if ( data.status == "0"){
          alert("Data telah dihapus");
        }

        window.location.reload();
      });
    }else{
      return false;
    }
  }
</script>