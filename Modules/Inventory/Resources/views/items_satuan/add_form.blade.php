<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
  <link href="{{ URL::asset('assets/global/plugins/typeahead/typeahead.css') }}" type="text/css" />
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include("master/sidebar")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>SATUAN</h1>

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
                  	 <a href="{{ url('/inventory/items_satuan/index').'?id='.$items->id }}">Satuan {{ $items->name }}</a>
                  	
                  </li>
                  <li>
                  	<span>Tambah</span>
                  </li>
              </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
              	<strong>Tambah Satuan {{ $items->name }}</strong>
              	@include('form.a',[
						'href'=> url('/inventory/items_satuan/index').'?id='.$items->id,
						'class'=>'pull-right',
						'caption' => 'Kembali' 
					])
					<hr/>

	<form method="post" id="id-SaveForm" action="{{ url('/inventory/items_satuan/create') }}" autocomplete="off" class="form-horizontal form-label-left">
			{{ csrf_field() }}
			<div class="item form-group">
			    <label class="control-label col-md-3 col-sm-3 col-xs-12">Satuan</label>
			    <div class="col-md-7 col-sm-7 col-xs-12">
			    	<input type='text' style='width:50%' id='name' name='name' class='form-control' />
			    </div>
		  	</div>

		  	<div class="item form-group">
			    <label class="control-label col-md-3 col-sm-3 col-xs-12">Konversi</label>
			    <div class="col-md-7 col-sm-7 col-xs-12">
			    	<input type='number' id='konversi' name='konversi' class='form-control' style='width:50%' value="1" />
			    </div>
		  	</div>
		  	
			<input type='hidden' id='item_id' name='item_id' class='form-control' value='{{ $items->id }}' />
			<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-3">
								<button id="send" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
								
								
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
<script src="{{ URL::asset('vendor/jsvalidation/js/jsvalidation.min.js')}}" type='text/javascript'></script>
{!! JsValidator::formRequest('Modules\Inventory\Http\Requests\RequestItemSatuan', '#id-SaveForm') !!}
<script type="text/javascript" src="{{ URL::asset('assets/global/plugins/typeahead/bootstrap3-typeahead.min.js') }}"></script>
<script type="application/javascript">

$(document).ready(function()
{
	$('#name').typeahead({
		source : function(query,result)
		{
			$.ajax({
				url:"{{ url('/inventory/items_satuan/typeSatuan') }}",
				data:{_token:$('input[name=_token]').val(),terms:query},
				dataType:'json',
				type:'post',
				success:function(data)
				{
					result($.map(data,function(item){
						return item;
					}));
				}
			});
		},
		updater:function(item)
		{
			//console.log(item);
			return item;
		}
	});

	$('#id-SaveForm').submit(function(e)
	{
		e.preventDefault();

		var url 	= $(this).attr('action');
		var data 	= $(this).serialize();
		//$('#id-SaveForm input').attr('disabled','disabled');
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
					alertify.success('success saved!',2);
					$('#id-SaveForm').trigger('reset');
				}

				return false;
			},
			error:function(xhr,status,message)
			{
				alertify.error('Gagal');
			},
			complete:function()
			{
				//$('#id-SaveForm input').removeAttr('disabled');
				$('.has-success').removeClass('has-success');
			}
		});
	});


});
</script>
</body>
</html>