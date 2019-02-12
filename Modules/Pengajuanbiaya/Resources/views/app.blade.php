
<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="{{ url('/')}}/assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
	$(document).ready(function(){		
		$('#butuh_date').datepicker({
	      "dateFormat" : "yy-mm-dd",
	      "changeMonth": true,
	      "changeYear": true
	    });

	    $(".select2").select2();
	    $.ajaxSetup({
          headers: {
              'X-CSRF-Token': $('input[name=_token]').val()
          }
        });
        $(".nilai_budget").number(true);
	});

	$("#budget_tahunan").change(function(){
		$("#itempekerjaan_id").hide();
		$("#loadings").show();

		var request = $.ajax({
			url : "{{ url('/')}}/pengajuanbiaya/loaditempekerjaan",
			dataType : "json",
			data : {
				id : $("#budget_tahunan").val()
			},
			type : "post"
		});

		request.done(function(data){
			$("#itempekerjaan_id").show();
			$("#loadings").hide();
			if ( data.status == "0" ){
				$("#itempekerjaan_id").html(data.html);
				$(".select2").select2();
			}
		})
	});

	function removeitem(id){
    	if ( confirm("Apakah anda yakin inging menghapus item ini ?")){
    		var request = $.ajax({
    			url : "{{ url('/')}}/pengajuanbiaya/delete",
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
    		})
    	}else{
    		return false;
    	}
  	}
</script>