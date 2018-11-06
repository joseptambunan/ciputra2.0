@include('label_global')
@include('pluggins.datetimepicker_pluggin')
@include('pluggins.select2_pluggin')
@include('pluggins.datatable_pluggin')
@include('form.general_form')
@include('form.datatable_helper')
<script src="{{ URL::asset('assets/global/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
 <!--jquery ui-->
 <link href="{{ URL::asset('assets/global/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
<div class="col-sm-12">
	<h3>Barang Masuk Add</h3>
	@include('form.a',
				[
					'href' => url('barangmasuk_hibah/index'),
					'caption' => 'Back'
				])
		@include('form.refresh')
	<hr/>
</div>

<form action="{{ url('barangmasuk_hibah/create') }}" method="post" class="form-horizontal form-label-left" 
id="form_data">
	{{ csrf_field() }}
	<div class="item form-group">
	    <label class="control-label col-md-4 col-sm-4 col-xs-12">Dari Proyek</label>
	    <div class="col-md-5 col-sm-5 col-xs-12">
	     	<input type='text' id='from_project_id' name='from_project_id' class='form-control' value="" />
	     	<input type="hidden" id='mfrom_project_id' name="mfrom_project_id" class="form-control" value="0" />
	    </div>
  	</div>
  	<div class="item form-group">
	    <label class="control-label col-md-4 col-sm-4 col-xs-12">From PT</label>
	    <div class="col-md-5 col-sm-5 col-xs-12" id="addpt">
	     	<input type='text' id='from_pt_id' name='from_pt_id' class='form-control pt' value="" />
	     	<input type="hidden" id='mfrom_pt_id' name="mfrom_pt_id" class="form-control pt" value="0" />
	    </div>
  	</div>

  	<div class="item form-group">
	    <label class="control-label col-md-4 col-sm-4 col-xs-12">No Refrensi</label>
	    <div class="col-md-5 col-sm-5 col-xs-12">
	     	<input type='text' id='no_refrensi' name='no_refrensi' class='form-control' value="" />
	    </div>
  	</div>

  	<div class="item form-group">
	    <label class="control-label col-md-4 col-sm-4 col-xs-12">Jumlah Total</label>
	    <div class="col-md-3 col-sm-3 col-xs-12">
	    	<div class="input-group">
	     		<input type='text' id='quantity_acuan' name='quantity_acuan' class='form-control' />
	     		<div class="input-group-addon">Item</div>
	     	</div>
	    </div>
  	</div>

  	<div class="item form-group">
		<label class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Hibah  
		</label>
		<div class="col-md-5 col-sm-5 col-xs-12">
			<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
				<input type="text" class="form-control" name='tanggal_hibah' id='tanggal_hibah' readonly required value="<?php echo date('Y-m-d'); ?>">
				<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
			</div>	
		</div>
	</div>
  	<div class="item form-group">
		<label class="control-label col-md-4 col-sm-4 col-xs-12">Description 
		</label>
		<div class="col-md-5 col-sm-5 col-xs-12">
			<textarea name="description" id="description" style="height: 100px;width: 330px;"></textarea>
		</div>
	</div>	 
	<div class="form-group">
		<div class="col-md-6 col-md-offset-6">
			<button id="send-all" type="submit" class="btn btn-success">Next</button>
		</div>
	</div>
</form>

<script src="{{ URL::asset('vendor/jsvalidation/js/jsvalidation.min.js')}}" type='text/javascript'></script>
{!! JsValidator::formRequest('App\Http\Requests\RequestBarangMasukHibah', '#form_data') !!}
<script type="text/javascript">
//document ready function
var fnGetPt = function(project_id)
{	
	var strHtml='';
	if(parseInt(project_id) > 0)
	{
		
		strHtml+='<select name="from_pt_id" id="from_pt_id" class="form-control select2">';
		strHtml+="<option value='0'>Pilih</option>";
		$.get("{{ url('/barangmasuk_hibah/getPtExist') }}/"+project_id,function(data,status)
		{
			$(data).each(function(i,v){
				strHtml+="<option value='"+v.id+"'>"+v.name+', '+v.code+"</option>";
			});
			strHtml+='</select>';
			$('#addpt').find('input,select').remove().end().append(strHtml);
		});
	}
}

var fnTextPt = function()
{
	var strHtml='';
	strHtml+="<input type='text' id='from_pt_id' name='from_pt_id' class='form-control pt' />";
	strHtml+="<input type='hidden' id='mfrom_pt_id' name='mfrom_pt_id' class='form-control pt' value='0' />";
	$('#addpt').find('input,select').remove().end().append(strHtml);
}

 $(document).ready(function(){
     $('#form_data').submit(function(e){
              e.preventDefault();
              var alldata_send=$(this).serializeArray();

              $('#form_data input').attr("disabled", "disabled");

              $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: alldata_send,
                dataType: 'json',
                beforeSend:function(){
                },
                success:function(data){
                	if(data.return=='1')
                	{
                		$('#div_content').load('{{ url("/barangmasuk_hibah/add_details")}}/'+data.id);
                	}
                	else
                	{
                		
                	}
                },
                error:function(xhr,status,errormessage)
                {
                	
                },
                complete:function()
                {
                	$('#form_data input').removeAttr('disabled');
                  	$('.form-group').removeClass('has-success');
                }
              });
          });

     $('#item_id').change(function()
     {
		$.ajax({
		    type: 'POST',
		    url: "{{ url('barangmasuk_hibah/changeSatuan') }}",
		    data: {
					term: $('#item_id').val(),
					_token : $('input[name="_token"]').val()
				  },
		    dataType: 'json',
		    success:function(data){
		    	if(data.length > 0)
		    	{
		    		$('select[name^="item_satuan_id"] option[value="'+data[0].id+'"]').attr("selected","selected");
		    	}
		    	else
		    	{
		    		$('select[name^="item_satuan_id"] option[value=""]').attr("selected","selected");
		    	}

		    },
		    error:function(xhr,status,errormessage)
		    {},
		    complete:function()
		    {}
  		});
     });

      
      //autocomplete
	  $('#from_project_id').autocomplete({
            source: function (request, response) {
					$.ajax({
						url: "{{url('/barangmasuk_hibah/project_autocomplete')}}",
						type: 'POST',
						data: {
								term: $('#from_project_id').val(),
								_token : $('input[name="_token"]').val()
							},
						dataType: 'json',
						success: function (data) {
							response($.map(data, function (obj) {
									return {
										label: obj.name,
										value: obj.name+' ,'+obj.code,
										code :obj.code,
										id:obj.id
									}
								}));
							}
						});
					},
			change: function (event, ui) {
						if (ui.item != null) {
							$('#from_project_id').val(ui.item.label+' , '+ui.item.code);
							$('#mfrom_project_id').val(ui.item.id);
							fnGetPt(ui.item.id);
						}
						else
						{
							fnTextPt();
						}
					},
		   select: function (event, ui) {        
			          if (ui.item != null) {
							$('#from_project_id').val(ui.item.label+' , '+ui.item.code);
							$('#mfrom_project_id').val(ui.item.id);
							fnGetPt(ui.item.id);
						}
					else
						{
							fnTextPt();
						}
		          return false;
  			}
		}).data('ui-autocomplete')._renderItem = function (ul, item) {
					//location
			return ($('<li>').append('<a><strong>' + item.label + '</strong>, <strong>'+item.code+'</strong></a>').appendTo(ul));
		};
		//autocomplete
	  $('#from_pt_id').autocomplete({
            source: function (request, response) {
					$.ajax({
						url: "{{url('/barangmasuk_hibah/pt_autocomplete')}}",
						type: 'POST',
						data: {
								term: $('#from_pt_id').val(),
								_token : $('input[name="_token"]').val()
							},
						dataType: 'json',
						success: function (data) {
							response($.map(data, function (obj) {
									return {
										label: obj.name,
										value: obj.id
									}
								}));
							}
						});
					},
			change: function (event, ui) {
					if (ui.item != null) {
							$('#from_pt_id').val(ui.item.label);
							$('#mfrom_pt_id').val(ui.item.value);
						}
					}
		}).data('ui-autocomplete')._renderItem = function (ul, item) {
					//location
			return ($('<li>').append('<a><strong>' + item.label + '</strong></a>').appendTo(ul));
		};

  });
</script>