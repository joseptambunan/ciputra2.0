<script type="text/javascript">

  $( document ).ready(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-Token': $('input[name=_token]').val()
          }
        });
    });

  $(function () {
    $('.select2').select2();
  });

  function deleteCoa(id){
    if ( confirm("Apakah anda yakin ingin menghapus pekerjaan ini ? ")){
        var request = $.ajax({
          url : "/pekerjaan/delete-pekerjaan",
          data : {
            id : id
          },
          dataType : "json",
          type : "post"
        });

        request.done(function(data){
          if ( data.status == "0"){
            window.location.href = "/pekerjaan";
          }else{
            window.location.reload();
          }
        });
    }else{
      return false;
    }
  }

  function showhide(id){
    if ($("#btn_" + id).attr("data-attribute") == "1"){
      $(".class_" + id).hide(1000);
      $("#btn_" + id).attr("data-attribute","0");
    }else{
      $(".class_" + id).show(1000);
      $("#btn_" + id).attr("data-attribute","1");
    }
  }

  $('#example3').DataTable({
    "search" : false,
    "paging" : false,
    "fixedHeader": true,
    "scrollX": true,
    "scrollY": 800,
    "ordering" : false
  });

  $(function () {
    $('.select2').select2();
  });


  function setItem(item_id,item_name,coa,satuan){
    $("#item_name").val(item_name);
    $("#item_id").val(item_id);
  }
</script>