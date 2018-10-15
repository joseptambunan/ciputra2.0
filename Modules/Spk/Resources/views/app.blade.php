<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
	$(function () {
    $('#start_date').datepicker({
      "dateFormat" : "yy-mm-dd"
    });

     $('#end_date').datepicker({
      "dateFormat" : "yy-mm-dd",
      "minDate"    : "+" + $("#durasi").val() + "d"
    });

    $('#st_1').datepicker({
      "dateFormat" : "yy-mm-dd",
      "minDate"    : "+" + $("#durasi").val() + "d"
    });

    $('#st_2').datepicker({
      "dateFormat" : "yy-mm-dd"
    });

    $('#st_3').datepicker({
      "dateFormat" : "yy-mm-dd"
    });

    $("#denda_a").number(true);
    $("#denda_b").number(true);
    $("#dp_termin").number(true);

    for ( var i = 0; i < $("#total_termin").val(); i++ ){
      $( "#label_termyn_" + i).text($("#termyn_" + i).val());
      $( "#label_termyn_" + i).number(true,2);
    }
  });

  $( document ).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('input[name=_token]').val()
        }
      });

    console.log();
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

  function addprogress(itempekerjaan_id,itempekerjaan_name,termin_id,termin_count){
    $("#item_name").val(itempekerjaan_name);
    $("#item_id").val(itempekerjaan_id);
    $("#termin_id").val(termin_id);
    var html = "";
    for(var i=0; i < termin_count; i++ ){
        html  += "<label> Termin " + ( i + 1) + "</label>";
        html  += "<input type='text' class='form-control' name='termyn[" + i + "]' id='termyn_" + i + "' value='0' style='width:30%;' onkeyup='summary();' autocomplete='off'/><br>";
    }
    $("#table_detail_summary").html(html);
  }

  function editbobot(itempekerjaan_id,bobot){
    $(".labels").show();
    $(".inputs").hide();
    $(".btn_edit1").show();
    $(".btn_edit2").hide();

    $(".labels_termin_" + itempekerjaan_id).hide();
    $(".input_termin_" + itempekerjaan_id).show();
    $("#input_" + itempekerjaan_id + "_" + bobot).show();
    $(".btn_edit_" + itempekerjaan_id).hide();
    $(".btn_edit2_" + itempekerjaan_id).show();
  }

  function savebobot(id){
    var request = $.ajax({
      url : "{{ url('/')}}/spk/update-progress-detail",
      dataType : "json",
      data : {
        id : $('input[name="itemprogress[]"]').val()
      },
      type : "post"
    });

    request.done(function(data){
      if ( data.status == "0"){
        //alert("Bobot Progress Disimpan");
      }
      window.location.reload();
    })
  }

  function generatedptermin(){
    var html = "";
    for(var i=0; i < $("#dp_termin").val(); i++ ){
        html  += "<div class='form-group'>"; 
        html  += "<label> Termin " + ( i + 1) + "</label>";
        html  += "<input type='text' class='form-control nilai_budget' name='termyn[" + i + "]' id='termyn_" + i + "' style='width:30%;' onkeyup='summaryper();' value='0'/><br>";
        html  += "</div>";
    }

      html  += "<div class='form-group'>"; 
      html  += "<button type='submit' class='btn btn-primary'>Simpan</button>";
      html  += "</div>";
    $("#form1").html(html);
    $(".nilai_budget").number(true);
  }

  function summaryper(){
    var total = 0;
   
    for ( var i = 0; i < $("#dp_termin").val(); i++ ){
        total = parseInt(total) + parseInt($("#termyn_" + i).val());
        console.log($("#dp_termin").val(),  parseInt($("#termyn_" + i).val()));
    }
    $("#total_dp_percent").text(total);

  }

  function removeRetensi(id){
    if ( confirm("Apakah anda yakin ingin menghapus retensis ini ? ")){
      var request = $.ajax({
        url : "{{ url('/')}}/spk/delete-retensi",
        dataType : "json",
        data : {
          id : id
        },
        type : "post"
      });

      request.done(function(data){
        if ( data.status == "0"){          
          alert("Retensi telah dihapus");
        }
        window.location.reload();
      })
    }else{
      return false;
    }
  }

</script>