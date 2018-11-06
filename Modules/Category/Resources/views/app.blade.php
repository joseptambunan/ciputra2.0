<script type="text/javascript">
	$(function () {
	    $("#luas").number(true);
	    $(".nilai_budget").number(true,2);
	 });

 	$( document ).ready(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-Token': $('input[name=_token]').val()
          }
        });
    });

	function remove(id){
		if ( confirm("Apakah anda yakin ingin menghapus data ini ? ")){
			var request = $.ajax({
				url : "{{ url('/')}}/category/delete",
				dataType : "json",
				data : {
					id : id
				},
				type : "post"
			});

			request.done(function(data){
				if ( data.status == "0" ){
					alert("Data telah dihapus");
				}
				window.location.reload();
			});
		}else{
			return false;
		}
	}

	function removedetail(id){
		if ( confirm("Apakah anda yakin ingin menghapus data ini ?")){
			var request = $.ajax({
				url : "{{ url('/')}}/category/delete-detail",
				data : {
					id : id
				},
				type : "post",
				dataType : "json"
			});

			request.done(function(data){
				if ( data.status == "0"){
					alert("Data telah dihapus");
				}
				window.location.reload();
			})
		}else {	
			return false;
		}
	}
</script>