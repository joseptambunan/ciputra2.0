<script type="text/javascript">

    $( document ).ready(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-Token': $('input[name=_token]').val()
          }
        });
    });

    function deletept(id) {
      if ( confirm("Apakah anda yakin ingin menghapus hak akses user di project ini ?")){
        var request = $.ajax({
          url : "{{ url('/')}}/user/delete-user",
          data : {
            id : id
          },
          type : "post",
          dataType : "json"
        });

        request.done(function(data){
          if ( data.status == "0"){
            alert("Data telah dihapus");
            window.location.reload();
          }else{
            window.location.reload();
          }
        });
      }else{
        return false;
      }
    }

    function editpt(id){
      $("#label_project_" + id).hide();
      $("#label_pt_" + id).hide();
      $("#btn_edit_" + id).hide();


      $("#project_name_" + id).show();
      $("#pt_name" + id).show();
      $("#btn_save_" + id).show();
    }

    function savept(id){
      var request = $.ajax({
        url : "{{ url('/')}}/user/update-project",
        dataType : "json",
        data : {
          pt_name : $("#pt_name" + id).val(),
          project_name_ : $("#project_name_" + id).val(),
          id : $("#user_project_pt_" + id).val(),
        },
        type : "post"
      });

      request.done(function(data){
        if ( data.status == "0"){
          alert("Data telah diganti");
        }else{
          alert("Data Bermasalah");
        }
        window.location.reload();
      });
    }

    function deleteApproval(id){
      if ( confirm("Apakah anda yakin ingin meghapus approval ini ?")){
        var request = $.ajax({
          url : "{{ url('/')}}/user/delete-approval",
          data : {
            id : id
          },
          dataType : "json",
          type : "post"
        });

        request.done(function(data){
          if ( data.status == "0"){
            alert("Data telah dihapus");
          }

          window.location.reload();
        })
      }else{
        return false;
      }
    }

    $("#jabatan").change(function(){
      if ( $("#jabatan").val() <= 5 ){
        $("#input_dept").hide();
      }else{
        $("#input_dept").show();
      }

      $(".pt").hide();
      $(".pt_" + $("#project_pt").val()).show();

      if ( $("#jabatan").val() == "10" ){
        $(".pt").attr("checked","checked");
      }else{
        $(".pt").removeAttr("checked");
      }
    })
</script>