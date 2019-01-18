<script type="text/javascript">
$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('input[name=_token]').val()
        }
  	});

  	$('.select2').select2();
});

function cekNpwp(){
	var request = $.ajax({
		url : "{{ url('/')}}/kontraktor/ceknpwp",
		dataType : "json",
		data : {
			npwp : $("#npwp").val()
		},
		type : "post"
	});	

	request.done(function(data){
		if ( data.status == 0 ){
			alert("Rekanan sudah didaftarkan");
		}else{
			if ( confirm("Rekanan belum didaftarkan. Apakah anda ingin menambah ke dalam rekanan ?")){
				var request2 = $.ajax({
					url : "{{ url('/')}}/kontraktor/store",
					dataType : "json",
					data : {
						npwp_no : $("#npwp").val()
					},
					type : "post"
				});

				request2.done(function(data){
					if ( data.status == "0"){
						window.location.href = "/kontraktor/detail/?id=" + data.id;
					}
				})
			}else{
				return false;
			}
		}
	});
}

</script>