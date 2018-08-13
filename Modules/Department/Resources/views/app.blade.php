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
    $("#label_dept_" +id).hide();    

    $(".col-xs-4").hide();
    $("#dept_" + id).show();
    $("#dept_code_" +id).show();

    $(".btn-warning").show();
    $(".btn-success").hide();
    $("#btn_status_" + id).hide();
    $("#btn_save_" + id).show();
    $("#dept_" + id).focus()
  }

  function deleteDept(id,dept){
    if ( confirm("Apakah anda yakin ingin menghapus Department " + dept)){
      var request = $.ajax({
        url : "/department/deletedepartment",
        data : {
          id : id
        },
        type : "post",
        dataType : "json"
      });

      request.done(function(data){
        if (data.status == "0"){
          alert(" Department " + dept + " telah dihapus");
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

  function saveEdit(id,dept){
    var request = $.ajax({
      url : "/department/updatedepartment",
      data : {
        id : id,
        name : $("#dept_" + id).val(),
        code : $("#dept_code_" +id).val()
      },
      type : "post",
      dataType : "json"
    });

    request.done(function(data){
      if ( data.status == "0"){
        alert("Data Department " + dept + " telah diganti dengan " + $("#dept_" + id).val());
        window.location.reload();
      }else{
        alert("Penyimpanan data bermasalah");
        window.location.reload();
      }
    })
  }
</script>