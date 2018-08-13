<script type="text/javascript">

$( document ).ready(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-Token': $('input[name=_token]').val()
          }
        });
});
  
$("#item_coa").change(function(){
    var request = $.ajax({
      url : "{{ url('/')}}/rab/pekerjaan",
      dataType : "json",
      data : {
      	id : $("#item_coa").val(),
        workorder : $("#workorder").val()
      },
      type : "post"
    });

    request.done(function(data){
    	$("#itempekerjaan").html(data.html);
    })
});

function apprioval(id){
  if ( confirm("Apakah anda yakin ingin merilis data ini ?")){
    var request = $.ajax({
      url : "{{ url('/')}}/rab/approval",
      dataType : "json",
      data : {
        id : id
      },
      type : "post"
    });

    request.done(function(data){
      if ( data.status == "0"){
        alert("Dokumen telah dirilis");
      }
      window.location.reload();
    });
  }else{
    return false;
  }
}
</script>