<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
	$(function () {
    $('#start_date').datepicker({
      "dateFormat" : "yy-mm-dd"
    });

     $('#end_date').datepicker({
      "dateFormat" : "yy-mm-dd"
    });

    $('#st_1').datepicker({
      "dateFormat" : "yy-mm-dd"
    });

    $('#st_2').datepicker({
      "dateFormat" : "yy-mm-dd"
    });

    $('#st_3').datepicker({
      "dateFormat" : "yy-mm-dd"
    });
  });

  $( document ).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('input[name=_token]').val()
        }
      });
  });

  $(function () {    
    $("#denda_a").number(true);
    $("#denda_b").number(true);
  });

  $("#buat").click(function(){
    var html = "";
    for(var i=0; i < $("#progress").val(); i++ ){
        html  += "<label> Termin " + ( i + 1) + "</label>";
        html  += "<input type='text' class='form-control' name='termyn[" + i + "]' id='termyn_" + i + "' style='width:30%;' onkeyup='summary();'/><br>";
    }
    $("#createtermyn").html(html);
    $("#submit_termyn").show();
  });

  function summary(){
    var total = $("#progress").val();
    var summary = 0;
    for(var i=0; i < $("#progress").val(); i++ ){
      summary = parseInt(($("#termyn_" + i ).val())) + parseInt(summary) ;
    }
    $("#summary_progress").text(summary);
  }

  function approval(id) {
    if ( confirm("Apakah anda yakin ingin merilis dokumen ini ?")){
      var request = $.ajax({
        url : "{{ url('/')}}/spk/approval",
        dataType : "json",
        type : "post",
        data : {
          id :id
        }
      });

      request.done(function(data){
        if ( data.status == "0"){
          alert("Dokumen telah dirilis");
        }
        window.location.reload();
      })
    }else{
      return false;
    }
  }

</script>