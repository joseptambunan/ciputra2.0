<script type="text/javascript">
	$( document ).ready(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-Token': $('input[name=_token]').val()
          }
        });
    });
    
	function removeescrow(id){
		if ( confirm("Apakah anda yakin ingin menghapus data ini ?")){
			var request = $.ajax({
				url : "{{ url('/')}}/escrow/delete",
				dataType : "json",
				data : {
					id : id
				},
				type : "post"
			});

			request.done(function(data){
				if ( data.status == "1"){
					alert("Data telah dihapus");
				}	
				window.location.reload();
			});
		}else{
			return false;
		}
	}
</script>