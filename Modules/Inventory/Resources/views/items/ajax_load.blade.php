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
						$.post('{{ url('items/delete') }}', 
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
						$(".content-loader").load('{{ url('items/edit_form') }}'+'?id='+edit_id, function() {
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
	
	$(".harga-link").click(function() {
		var id = $(this).attr("id");
		var view_id = id;
		var token = $('input[name=_token]').val();
		
		$.confirm({
			title: 'Confirm Create Harga ?',
			icon: 'fa fa-pencil-square',
			content: 'Are you sure Create Harga Key ID '+view_id+ ' !',
			autoClose: 'cancelAction|8000',
			buttons: {
				deleteUser: {
					text: 'Create',
					btnClass: 'btn green',
					action: function () {
						$("#div_content_page").fadeToggle('fast');
						$("#div_content_page").load('{{ url('items_price/index') }}'+'?id='+view_id, function() {
							$("#div_content_page").fadeIn('fast');
						});
					}
				},
				cancelAction: function () {
					
				}
			}
		});
		return false;
	});
	
	$(".satuan-link").click(function() {
		var id = $(this).attr("id");
		var view_id = id;
		var token = $('input[name=_token]').val();
		
		$.confirm({
			title: 'Confirm Create Satuan ?',
			icon: 'fa fa-pencil-square',
			content: 'Are you sure Create Satuan Key ID '+view_id+ ' !',
			autoClose: 'cancelAction|8000',
			buttons: {
				deleteUser: {
					text: 'Create',
					btnClass: 'btn green',
					action: function () {
						$("#div_content_page").fadeToggle('fast');
						$("#div_content_page").load('{{ url('items_satuan/index') }}'+'?id='+view_id, function() {
							$("#div_content_page").fadeIn('fast');
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