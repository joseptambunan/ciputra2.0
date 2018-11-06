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
      <h1>BARANG</h1>

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
                      <a href="{{ url('/inventory/items/index') }}">Barang</a>
                  </li>
                  <li>
                  	<span>Edit</span>
                  </li>
              </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
              	<strong>Edit Barang</strong>

              	@include('form.a',[
						'href'=> url('/inventory/items/index'),
						'class'=>'pull-right',
						'caption' => 'Kembali' 
					])
					<hr/>
<form method="post" id="id-SaveForm" action="{{ url('/inventory/items/edit') }}" autocomplete="off" class="form-horizontal form-label-left">
	{{ csrf_field() }}
	<input type="hidden" name="id" id="id" value="{{ $item->id }}" />
		<div class="item form-group">
			    <label class="control-label col-md-3 col-sm-3 col-xs-12">Kategori</label>
			    <div class="col-md-7 col-sm-7 col-xs-12">
			    	<select class='form-control select2' name="item_category_id" id="item_category_id">
						<option value="">Pilih</option>
						@foreach($item_categories as $key => $value)
							<option value='{{ $value->id }}' {{ ($value->id==$item->item_category_id) ? 'selected' : '' }}>{{ $value->name }}</option>
						@endforeach
					</select>
			    </div>
		  	</div>

		  	<div class="item form-group">
			    <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Kategori</label>
			    <div class="col-md-7 col-sm-7 col-xs-12">
			    	<select class='form-control' name="sub_item_category_id" id="sub_item_category_id">

						<option value="" id="append_here">Sub Kategori</option>
						@foreach($subcategories as $key => $value)
							<option value='{{ $value->id }}' {{ ($value->id==$item->sub_item_category_id) ? 'selected' : '' }}>{{ $value->name }}</option>
						@endforeach
				</select>
			    </div>
		  	</div>


		  	<div class="item form-group">
			    <label class="control-label col-md-3 col-sm-3 col-xs-12">Brand / Merek</label>
			    <div class="col-md-7 col-sm-7 col-xs-12">
			    	<select class='form-control select2' name="brand_id" id="brand_id">
					<option value="">Pilih</option>
					@foreach($brands as $key => $value)
						<option value='{{ $value->id }}' {{ ($value->id==$item->item_category_id) ? 'selected' : '' }}>{{ $value->name }}</option>
					@endforeach
				</select>
			    </div>
		  	</div>

		  	<div class="item form-group">
			    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Barang</label>
			    <div class="col-md-7 col-sm-7 col-xs-12">
			    	<input type='text' id='name' name='name' value='{{ $item->name }}' class='form-control' />
			    </div>
		  	</div>

		  	<div class="item form-group">
			    <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode Barang</label>
			    <div class="col-md-7 col-sm-7 col-xs-12">
			    	<input type='text' value="{{ $item->kode }}" class='form-control' readonly="true" />
			    </div>
		  	</div>

		  
		  	
		  	

		  	 <div class="item form-group">
			    <label class="control-label col-md-3 col-sm-3 col-xs-12">Deskripsi</label>
			    <div class="col-md-7 col-sm-7 col-xs-12">
			    	<textarea class='form-control' name="description" id="description" cols="45" rows="5">{{ $item->description }}</textarea>
			    </div>
		  	</div>
		  
		  <div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-3">
								<button id="send" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Perubahan</button>
								
								
							</div>
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

<script type="text/javascript">


$(document).ready(function()
{
	
	$('#item_category_id').change(function()
	{
		var _url = "{{ url('/inventory/item/getSubCategories') }}"
		$.ajax({
			type:'POST',
			data: {id:$(this).val(),_token : $('input[name=_token]').val()},
			url : _url,
			dataType : 'json',
			beforeSend:function()
			{
				$('#sub_category').hide();
			},
			success : function(data)
			{
				var strHtml = '<option value="">Sub Kategori</option>';
				$(data).each(function(i,v)
				{
					strHtml+='<option value="'+v.id+'">'+v.name+'</option>';
					console.log(v);
				});
				console.log(strHtml);
				$('#sub_item_category_id').find('option').remove().end().append(strHtml);//.append(strHtml);
			},
			complete:function()
			{
				$('#sub_category').show();
			}
		});
	});
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
			{},
			success:function(get)
			{
				if(get)
				{
					alertify.success('success saved!',2);
					window.location.href="{{ url('/inventory/items/index') }}";
				}

				return false;
			},
			error:function(xhr,status,message)
			{
				alertify.error('Gagal');
			},
			complete:function()
			{
				$('.has-success').removeClass('has-success');
				$('#id-SaveForm input').removeAttr('disabled');
			}
		});
	});

	/*$('.set_select2').select2({
		width:100
	});*/

});
</script>
</body>
</html>