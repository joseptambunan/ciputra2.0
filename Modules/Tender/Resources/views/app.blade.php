<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
$( document ).ready(function() {
    $.ajaxSetup({
      headers: {
          'X-CSRF-Token': $('input[name=_token]').val()
      }
    });

    $("#ambil_doc_date").datepicker({
        "dateformat" : "yy-mm-dd",
    });

    $("#aanwijzing_date").datepicker({
        "dateformat" : "yy-mm-dd"
    });

    $("#penawaran1_date").datepicker({
        "dateformat" : "yy-mm-dd"
    });

    $("#klarifikasi1_date").datepicker({
        "dateformat" : "yy-mm-dd"
    });

    $("#penawaran2_date").datepicker({
        "dateformat" : "yy-mm-dd"
    });

    $("#klarifikasi2_date").datepicker({
        "dateformat" : "yy-mm-dd"
    });

    $("#pengumuman_date").datepicker({
        "dateformat" : "yy-mm-dd"
    });
    $(".nilai_budget").number(true);

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
});

function removerekanan(id,name){
	if ( confirm("Apakah anda yakin ingin menghapus rekanan "+ name +" ini ? ")){
		var request = $.ajax({
			url : "{{ url('/')}}/tender/remove-rekanan",
			dataType : "json",
			data : {
				id : id
			},
			type : "post"
		});

		request.done(function(data){
			if ( data.status == "0"){
				alert("Rekanan " + name + " telah dihapus ");
				window.location.reload();
			}else{
				return false;
			}
		})
	}else{
		return false;
	}
}

function requestApproveRekanan(id,name){
	if ( confirm("Apakah anda yakin ingin merilis data rekanan " + name + " ini ?")){
		var request = $.ajax({
			url : "{{ url('/')}}/tender/approval-rekanan",
			dataType : "json",
			data : {
				id : id
			},
			type : "post"
		});

		request.done(function(data){
			if ( data.status == "0"){
				alert("Data Rekanan " + name +" ini telah dirilis ");
				window.location.reload();
			}else{
				window.location.reload();
			}
		})
	}else{	
		return false;
	}
}

function printspk(){
    var myPrintContent = document.getElementById('head_Content');
    var myPrintWindow = window.open("", "");
    myPrintWindow.document.write(myPrintContent.innerHTML);
    myPrintWindow.document.getElementById('dvContents').style.display='block';
    myPrintWindow.document.close();
    myPrintWindow.focus();
    myPrintWindow.print();
    myPrintWindow.close();    
    return false;
}

function generateTermyn(){
    var termyn = $("#sistem_pembayaran").val();
    var html = "";
    for ( var i = 1; i <= parseInt(termyn); i++ ){
        if ( i == 1 ){

            html += "<tr>";
            html += "<td>" + i + "</td>";
            html += "<td> Termyn ke " + i + " (DP)</td>";
            html += "<td><input type='text' class='form-control nilai_budget percent_termyn' name='termyn["+ i +"]' onKeyUp='countPercentage();' autocomplete='off' maxlength='2' required/></td>";
            html += "</tr>";
        }else{
            html += "<tr>";
            html += "<td>" + i + "</td>";
            html += "<td> Termyn ke " + i + "</td>";
            html += "<td><input type='text' class='form-control nilai_budget percent_termyn' name='termyn["+ i +"]' onKeyUp='countPercentage();' autocomplete='off' maxlength='2' required/></td>";
            html += "</tr>";

        }
    }
    $("#list_termyn").html(html);
    $(".nilai_budget").number(true);
}

function countPercentage(){
    var i = $("#limit_count").val();
    $(".percent_termyn").each(function() {
        if ( $(this).val() != ""){            
            i = parseInt(i) + parseInt($(this).val());
            if ( i > 100 ){
                alert("Percentage lebih dari 100% ");
                i = parseInt(i) - parseInt($(this).val());
                $(this).val(0);
            }
        }
    });
    $("#label_count").text(i);
    $("#label_count").number(true);
}

function generateRetensi(){
    var termyn = $("#retensi").val();
    var html = "";
    for ( var i = 1; i <= parseInt(termyn); i++ ){
        html += "<tr>";
        html += "<td>" + i + "</td>";        
        html += "<td><input type='text' class='form-control nilai_retensi percent_retensi' name='percent["+ i +"]' onKeyUp='countPercentage();' autocomplete='off' maxlength='1'/></td>";
        html += "<td><input type='text' class='form-control' name='waktu["+ i +"]' autocomplete='off'/></td>";
        html += "</tr>";
    }
    $("#list_retensi").html(html);
    $(".nilai_retensi").number(true,2);
}

function countRetensi(){
    var i = $("#limit_retensi").val();
    $(".percent_retensi").each(function() {
        if ( $(this).val() != ""){            
            i = parseInt(i) + parseInt($(this).val());
            if ( i > 5 ){
                alert("Percentage lebih dari 5% ");
                i = parseInt(i) - parseInt($(this).val());
                $(this).val(0);
            }
        }
    });
    $("#label_retensi").text(i);
    $("#label_retensi").number(true);
}

</script>