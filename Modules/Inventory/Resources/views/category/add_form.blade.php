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
			                  	<span>Tambah</span>
			                  </li>
			              </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
              	<strong>Tambah Kategori</strong>
              	@include('form.a',[
						'href'=> url('/inventory/category/index'),
						'class'=>'pull-right',
						'caption' => 'Kembali' 
					])
              	<hr/>
<form method="post" id="id-SaveForm" action="{{ url('/inventory/category/create') }}" class="form-horizontal form-label-left">
	
	<div class="item form-group">
	    <label class="control-label col-md-3 col-sm-3 col-xs-12">Kategori Atasan</label>
	    <div class="col-md-7 col-sm-7 col-xs-12">
	    	{{ csrf_field() }}
	    	<select class='form-control' name="parent_id" id="parent_id">
			</select>
	    </div>
  	</div>

  	<div class="item form-group">
	    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama</label>
	    <div class="col-md-7 col-sm-7 col-xs-12">
	    	<input type='text' id='name' name='name' class='form-control' />
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
{!! JsValidator::formRequest('Modules\Inventory\Http\Requests\RequestCategory', '#id-SaveForm') !!}
<script type="application/javascript">
var fnRefreshSelect = function()
{
	var strHtml='';
	strHtml+="<option value='0'>-- Pilih --</option>";
	$.get("{{ url('/inventory/category/getparent') }}",function(data,status)
	{
		$(data).each(function(i,v){
			strHtml+="<option value='"+v.id+"'>"+v.name+"</option>";
		});

		$('#parent_id').find('option').remove().end().append(strHtml);
	});
}

$(document).ready(function()
{
	fnRefreshSelect();
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
				if(get.return=='1')
				{
					alertify.success('success saved!',3);
					$('#id-SaveForm').trigger('reset');
				}

				return false;
			},
			error:function(xhr,status,message)
			{
				
			},
			complete:function()
			{
				$('#id-SaveForm input').removeAttr('disabled');
				
				fnRefreshSelect();
			}
		});
	});
});
</script>
</body>
</html>