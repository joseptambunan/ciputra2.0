<script type="text/javascript">
	function removesatuan(id){
		if ( confirm("Apakah anda yakin ingin menghapus satuan ini ? ")){
			var request = $.ajax({
				url : "{{ url('/')}}/satuan/destroy",
				dataType : "json",
				data : {
					id : id
				},
				type : "post"
			});

			request.done(function(data){
				if ( data.status == "0"){
					alert("Data satuan telah dihapus");
				}
				window.location.reload();
			})
		}else{
			return false;
		}
	}
</script>