<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Merek / Brand</h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
             <ul class="breadcrumb">
                  <li>
                      <a href="{{ url('/inventory/inventory/stock/view_stock') }}">Inventory</a>
                  </li>
                  <li>
                      <a href="{{ url('/inventory/brand/index') }}">Brand</a>
                  </li>
                  <li>
                  	<span>Tambah</span>
                  </li>
              </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">

                <strong>Tambah Brand</strong>  
                @include('form.a',[
            'href'=> url('/inventory/brand/index'),
            'class'=>'pull-right',
            'caption' => 'Kembali' 
          ])
        <hr/>
				<form method="post" id="id-SaveForm" action="{{ url('/inventory/brand/create') }}" autocomplete="off" class="form-horizontal form-label-left">
					{{ csrf_field() }}

          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Brand</label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <input type='text' id='name' name='name' class='form-control' required />
            </div>
          </div>
					
          <div align="center">
            <button type="submit" class="btn btn-success green showtoast" name="btn-save" id="showtoast">
              <span class="fa fa-save"></span> Simpan
            </button>
        </div>
				
				</form>

</div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
@include("master/footer_table")
@include('pluggins.alertify')
<script src="{{ URL::asset('vendor/jsvalidation/js/jsvalidation.min.js')}}" type='text/javascript'></script>
{!! JsValidator::formRequest('Modules\Inventory\Http\Requests\RequestBrand', '#id-SaveForm') !!}
<script type="application/javascript">
$(document).ready(function()
{
	$('#id-SaveForm').submit(function(e)
	{
		
		e.preventDefault();
		var url 	= $(this).attr('action');
		var data 	= $(this).serialize();
		$('#id-SaveForm input').attr('disabled','disabled');
		$.ajax({
			type:'POST',
			dataType:'json',
			url:url,
			data:data,
			success:function(get)
			{
				if(parseInt(get.return)==1)
				{
					 alertify.success('success',3);
					 $('#id-SaveForm').trigger('reset');
				}
        else
        {
          alertify.error(get.errMsg);
        }

				return false;
			},
			error:function(xhr,status,message)
			{},
			complete:function()
			{
        $('.has-success').removeClass('has-success');
				$('#id-SaveForm input').removeAttr('disabled');
			}
		});
	});
});
</script>
</body>
</html>
{{ csrf_field() }}
<form method="post" id="id-EditForm" action="{{ url('brand/edit') }}">
	<input type='hidden' id='id' name='id' value='{{ $brands->id }}' />
	<table class='table'>
		
		<tr>
			<td>Name </td>
			<td>
				<input type='text' id='name' name='name' class='form-control' placeholder='Name' required value='{{ $brands->name }}' />
			</td>
		</tr>

	</table>
</form>

<div align="center">
	<btn type="button" class="btn green showtoast" name="btn-save" id="showtoast" onclick='getSave();'>
		<span class="fa fa-save"></span> Update
	</btn>
</div>

<script type="application/javascript">
function getSave() 
{
	var id = $("#id").val();
	var name = $("#name").val();
	var token = $('input[name=_token]').val();
	
	var field_name = "";

	$("#id-EditForm").find('input, select, textarea').each
	(
		function(i, field)
		{
			if($(field).val() == '')
			{
			   field_name += field.name + ', ';
			}
		}
	);

	if (field_name != '') 
	{
		$("#div_message").html('<div class="custom-alerts alert alert-danger fade in">Please fill value on ( '+field_name+')</div>');
		return false;
	}
	else {
		$.post("{{ url('brand/edit') }}", 
			{ 
				id: id,
				name: name,
				_token: token
			},
			function(data) 
			{
				if(data)
				{
					alertify.success('success updated!',2);
					$("#div_content_page").load('{{ url('brand/index') }}'+'?update=1', function()
					{
						$("#div_content_page").fadeIn('fast');
						
					});
				}
				
			}
		);
		return false;
	}
}
</script>