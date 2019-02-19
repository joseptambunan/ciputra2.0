<script type="text/javascript">
 	$( document ).ready(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-Token': $('input[name=_token]').val()
          }
        });
    });

    function removeitem(id){
    	if ( confirm("Apakah anda yakin ingin menghapus data ini ?")){
    		var request = $.ajax({
    			url : "{{url('/')}}/tendermaster/delete",
    			dataType : "json",
    			data : {
    				id : id
    			},
    			type : "post"
    		});

    		request.done(function(data){
    			if ( data.status == 0 ){
    				alert("Data telah dihapus");
    			}
    			window.location.reload();
    		})
    	}else{
    		return false;
    	}
    }
</script>