<script src="{{ url('/')}}/assets/plugins/jquery.number.min.js"></script>
<script type="text/javascript">
	$(function(){
		$(".nilai_budget").number(true,2);
	})

	function submitform(){
		$("#form1").submit();
	}
</script>