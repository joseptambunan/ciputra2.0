<script type="text/javascript">
	$( document ).ready(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-Token': $('input[name=_token]').val()
          }
        });

        $(".nilai_budget").number(true);
    });

	function removepekerjaan(id){
		if ( confirm("Apakah anda yakin ingin menghapus data ini ? ")){
			var request = $.ajax({
				url : "{{ url('/')}}/budget/master/removepekerjaan",
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
			});
		}else{
			return false;
		}
	}

	function addpekerjaan(id){
		var request = $.ajax({
			url : "{{url('/')}}/budget/master/reload",
			dataType : "json",
			data : {
				id : id
			},
			type : "post"
		});

		request.done(function(data){
			if ( data.status == "0"){
				alert("Data telah diupdate");
			}
			window.location.reload();
		});
	}
</script>