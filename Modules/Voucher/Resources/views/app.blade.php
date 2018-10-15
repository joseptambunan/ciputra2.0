<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
	$(function () {
    $('#tempo').datepicker({
      "dateFormat" : "yy-mm-dd"
    });

    $('#diserahkan').datepicker({
      "dateFormat" : "yy-mm-dd"
    });

    $('#pencairan').datepicker({
      "dateFormat" : "yy-mm-dd"
    });

    $("#tgl_faktur").datepicker({
      "dateFormat" : "yy-mm-dd"
    });

    $("#pph_percent").number(true,2);

  });

  $(function () {
    $('.select2').select2();
    $('[data-mask]').inputmask();
  });

   $( document ).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('input[name=_token]').val()
        }
      });
  });

  $("#tender_rab").change(function(){
    if ( $("#tender_rab").val() == "Bap"){
      $(".bap").show();
    }else{
      $(".bap").hide();
    }
  });

  $("#spm").click(function(){
    if ( $("#spm").is(":checked")){
      $("#btn_simpan").show();
    }else{
      $("#btn_simpan").hide();
    }
  });

  $("#bap").change(function(){
    var request = $.ajax({
      url : "{{ url('/')}}/voucher/checkbap",
      dataType : "json",
      data : {
        id : $("#bap").val()
      },
      type : "post"
    });

    request.done(function(data){
      if (data.status == "0"){
        $("#jenis_voucher").show();
        $("#voucher_type").val("retensi");
        
        if ( data.ppn == "0"){
          $("#ppn").hide();
        }else{
          $("#ppn").show();
        }

        if ( data.retensis == "0"){
          $("#label_retensi").text("Voucher Retensi sudah terbit");
          $("#retensi_checklist").hide();
        }else{
          $("#retensi_checklist").show();
          $("#label_retensi").text("");
        }

      }else{
        $("#jenis_voucher").hide();
        $("#voucher_type").val("general");
      }
    })
  });

  function getgeneral(values){
    $("#voucher_type").val(values);
  }
</script>