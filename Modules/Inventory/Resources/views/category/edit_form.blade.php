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
      <h1>Kategori</h1>

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
			                      <a href="{{ url('/inventory/category/index') }}">Kategori</a>
			                  </li>
			                  <li>
			                  	<span>Edit</span>
			                  </li>
			              </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
              	<strong>Edit Kategori : {{ $categories->name }}</strong>
              	@include('form.a',[
						'href'=> url('/inventory/category/index'),
						'class'=>'pull-right',
						'caption' => 'Kembali' 
					])
              	<hr/>
<form method="post" id="id-SaveForm" action="{{ url('/inventory/category/edit') }}" class="form-horizontal form-label-left">
	{{ csrf_field() }}
	<input type='hidden' id='id' name='id' value='{{ $categories->id }}' />
	<div class="item form-group">
	    <label class="control-label col-md-3 col-sm-3 col-xs-12">Kategori Atasan</label>
	    <div class="col-md-7 col-sm-7 col-xs-12">
	    	
	    	<select class='form-control' name="parent_id" id="parent_id">
					<option value="0">Pilih</option>
					@foreach($ItemCategory as $key => $value)
						<option value="{{ $value->id }}" {{ ($categories->parent_id == $value->id) ? 'selected' : '' }}>{{ $value->name }}</option>
					@endforeach
				</select>
			</select>
	    </div>
  	</div>

  	<div class="item form-group">
	    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama</label>
	    <div class="col-md-7 col-sm-7 col-xs-12">
	    	<input type='text' id='name' name='name' class='form-control' value="{{ $categories->name }}" />
	    </div>
  	</div>
	
	<div align="center">
		<button type="submit" class="btn btn-success green showtoast" name="btn-save" id="showtoast">
			<span class="fa fa-save"></span> Simpan Perubahan
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
{!! JsValidator::formRequest('Modules\Inventory\Http\Requests\RequestEditCategory', '#id-SaveForm') !!}
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
			beforeSend:function()
			{
				
			},
			success:function(get)
			{
				if(get)
				{
					alertify.success('success saved!',3);
					$('#id-SaveForm').trigger('reset');
					window.location.href="{{ url('/inventory/category/index') }}";
				}

				return false;
			},
			error:function(xhr,status,message)
			{
				
			},
			complete:function()
			{
				$('#id-SaveForm input').removeAttr('disabled');
			}
		});
	});
});
</script>
</body>
</html>