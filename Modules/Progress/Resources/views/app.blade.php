<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
	$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('input[name=_token]').val()
        }
      });

    $(".nilai_budget").number(true,2);
  });

	function updateProgress(spk_id,termin_id,termin) {
    if ( confirm("Apakah anda yakin ingin menyelesaikan termin ini ?")){
      var request = $.ajax({
        url : "{{ url('/')}}/progress/updatetermyn",
        dataType : "json",
        data : {
          spk_id : spk_id,
          termin : termin,
          termin_id : termin_id
        },
        type : "post"
      });

      request.done(function(data){
        if ( data.status == "0"){
          alert("Data telah diupdate");
        }
        
      })
    }else{
      return false;
    }
  }

  function simpanprogress(){
    $("#loading").show();
    $("#btnsimpan").hide();    

    var unitprogress_id_ = $( "[name^='unitprogress_id_']" );
    var start_date = $( "[name^='start_date_']" ).serializeArray();
    var end_date = $( "[name^='end_date_']" ).serializeArray();
    var i =0;
    var status = 0;
    console.log("Start : " + status);
    $("[name^='unitprogress_id_']").each(function() {
      if ( start_date[i].value != "" && end_date[i].value != "" ){
          var request = $.ajax({
          url : "{{ url('/')}}/progress/saveschedule",
          dataType : "json",
          data : {
            id : $(this).val(),
            start_date : start_date[i].value,
            end_date : end_date[i].value,
            unit_id : $("#unit_progress_id").val(),
            spk_progress_id : $("#spk_progress_id").val()
          },
          type  : "post"
        });

        request.done(function(data){
          console.log(data.status,status);
          if ( data.status == "0" ){
            status++;
          }
        });

        i++;
      }
      
    });
    console.log("Finish : " + status);
    if ( status > 0 ){
      alert("Jadwal telah dibuat");
    }
    //window.location.reload();
   
  }

  function readUrl(input,id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#prev_iamges_' + id).attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
  }

  $("#file_images_0").change(function(){
        readUrl(this,0);
  });

  $("#file_images_1").change(function(){
        readUrl(this,1);
  });

  $("#file_images_2").change(function(){
        readUrl(this,2);
  });

  $("#file_images_3").change(function(){
        readUrl(this,3);
  });

  $("#file_images_4").change(function(){
        readUrl(this,4);
  });

  $("#rekana_setuju").click(function(){
    if ( $("#rekana_setuju").is(":checked")){
      $("#submit").show();
    }else{
      $("#submit").hide();
    }
  })

</script>