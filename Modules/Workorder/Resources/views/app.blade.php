<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">

  $( document ).ready(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-Token': $('input[name=_token]').val()
          }
        });
    });

  $(function () {
    $("#luas").number(true);
    $(".number").number(true);
    $(".nilai_budget").number(true);
    
    $('#start_date').datepicker({
      "dateFormat" : "yy-mm-dd"
    });

    $('#end_date').datepicker({
      "dateFormat" : "yy-mm-dd"
    });
  });

  $("#department_from").change(function(){
    $("#detail_item").html("");
    var request = $.ajax({
      url : "{{ url('/')}}/workorder/budget-tahunan",
      data : { 
        department_id : $("#department_from").val()
      },
      type : "post",
      dataType : "json"
    });

    request.done(function(data){
      $("#budget_tahunan").html(data.html);
    })
  });

  $("#budget_tahunan").change(function(){
    $("#tdsa").html("");
    var request = $.ajax({
      url : "{{ url('/')}}/workorder/budget-tahunan/item",
      dataType : "json",
      data : {
        id : $("#budget_tahunan").val()
      },
      type : "post"
    });

    request.done(function(data){
      //$("#tdsa").html(data.html);
      //$(".nilai_budgets").number(true);
    });
  });

  function removeunitswo(id){
  	if ( confirm("Apakah anda yakin ingin menghapus data ini ? ")){
  		var request = $.ajax({
  			url : "{{ url('/')}}/workorder/delete-unit",
	      dataType : "json",
	      data : {
	        id : id
	      },
	      type : "post"
  		});

  		request.done(function(data){
  			if ( data.status == "0"){
  				alert("Data telah dihapus");
  			}
  			window.location.reload();
  		})
  	}else{
  		return false;
  	}
  }

  function woapprove(id){
  	if ( confirm("Apakah anda yakin ingin merilis data ini ? ")){
  		var request = $.ajax({
  			url : "{{ url('/')}}/workorder/approve",
	      dataType : "json",
	      data : {
	        id : id
	      },
	      type : "post"
  		});

  		request.done(function(data){
  			if ( data.status == "0"){
  				alert("Workorder telah dirilis");
  			}
  			window.location.reload();
  		})
  	}else{
  		return false;
  	}
  }

 
</script>