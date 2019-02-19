<!-- Select2 -->
<script src="{{ url('/')}}/assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script type="text/javascript">
$( document ).ready(function() {
	$(".select2").select2();
});

$("#btn_submit").click(function(){
	$("#btn_submit").hide();
	$("#loading").show();
});
</script>
