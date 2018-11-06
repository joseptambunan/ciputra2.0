<script type="application/javascript">
$(document).ready(function(){
	$(".delete-link").click(function() {
		var id = $(this).attr("id");
		var del_id = id;
		var parent = $(this).parent("td").parent("tr");
		var token = $('input[name=_token]').val();
		
		$.confirm({
			title: 'Confirm Delete ?',
			icon: 'fa fa-warning',
			content: 'Are you sure delete Key ID ' +del_id+ ' !',
			autoClose: 'cancelAction|8000',
			buttons: {
				deleteUser: {
					text: 'Delete',
					btnClass: 'btn-red any-other-class',
					action: function () {
						$.post('{{ url('category/delete') }}', 
						{
							id:del_id,
							_token: token
						}, 
						function(data) {
							parent.fadeToggle('fast');
						});	
						
						$("#div_message").html('<div class="custom-alerts alert alert-warning fade in">Sucessfully delete on '+ formattedtoday +'</div>');
					}
				},
				cancelAction: function () {
					
				}
			}
		});
		return false;
	});
	
	$(".edit-link").click(function() {
		var id = $(this).attr("id");
		var edit_id = id;
		var token = $('input[name=_token]').val();
		
		$.confirm({
			title: 'Confirm Edit ?',
			icon: 'fa fa-edit',
			content: 'Are you sure edit Key ID '+edit_id+ ' !',
			autoClose: 'cancelAction|8000',
			buttons: {
				deleteUser: {
					text: 'Edit',
					btnClass: 'btn btn-info',
					action: function () {
						$(".content-loader").fadeToggle('fast');
						$(".content-loader").load('{{ url('category/edit_form') }}'+'?id='+edit_id, function() {
							$(".content-loader").fadeIn('fast');
							
							$("#btn-add").hide();
							$("#btn-view").show();
						});
					}
				},
				cancelAction: function () {
					
				}
			}
		});
		return false;
	});
});
</script>