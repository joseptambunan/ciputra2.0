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

  @include("master/sidebar_project")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{ $project->name }}</h1>

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
			                      <a href="{{ url('/inventory/warehouse/index') }}">Gudang</a>
			                  </li>
			                  <li>
			                  	<span>Tambah</span>
			                  </li>
			              </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
              	<strong>Tambah Permintaan Barang</strong>
              	@include('form.a',[
						'href'=> url('/inventory/warehouse/index'),
						'class'=>'pull-right',
						'caption' => 'Kembali' 
					])
              	<hr/>
<form method="post" id="id-SaveForm" action="{{ url('/inventory/warehouse/create') }}" class="form-horizontal form-label-left">
	<div class="item form-group">
	    <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode</label>
	    <div class="col-md-7 col-sm-7 col-xs-12">
	    	{{ csrf_field() }}
	    	<input style="width: 50%" type='text' id='code' name='code' class='form-control'  />
	    </div>
  	</div>

  	<div class="item form-group">
	    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama</label>
	    <div class="col-md-7 col-sm-7 col-xs-12">
	    	<input style="width: 50%" type='text' id='name' name='name' class='form-control'  />
	    </div>
  	</div>

  	<div class="item form-group">
	    <label class="control-label col-md-3 col-sm-3 col-xs-12">Department</label>
	    <div class="col-md-7 col-sm-7 col-xs-12">
	    	<select  class='form-control select2' name='department_id' id='department_id'>
					<option value="">Pilih</option>
					@foreach($departments as $key => $value)
						<option value='{{ $value->id }}'>({{ $value->code }}) - {{ $value->name }}</option>
					@endforeach
				</select>
	    </div>
  	</div>

  	<div class="item form-group">
	    <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat</label>
	    <div class="col-md-7 col-sm-7 col-xs-12">
	    	<textarea class="form-control" name="address" id="address"></textarea>
	    </div>
  	</div>

	<div class="item form-group">
	    <label class="control-label col-md-3 col-sm-3 col-xs-12">Kota</label>
	    <div class="col-md-7 col-sm-7 col-xs-12">
	    	<select class='form-control select2' name='city_id' id='city_id'>
					<option value="">Pilih</option>
					@foreach($cities as $key => $value)
						<option value='{{ $value->id }}'>({{ $value->zipcode }}) - {{ $value->name }}</option>
					@endforeach
				</select>
	    </div>
  	</div>
	
	<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-3">
								<button id="send" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
								<button id="reset" type="reset" class="btn btn-warning"><i class="fa fa-times"></i> Reset</button>
								
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
@include('pluggins.select2_pluggin')
<script src="{{ URL::asset('vendor/jsvalidation/js/jsvalidation.min.js')}}" type='text/javascript'></script>
{!! JsValidator::formRequest('Modules\Inventory\Http\Requests\RequestWarehouse', '#id-SaveForm') !!}
<script type="application/javascript">
	$(document).ready(function()
	{
		$('select').select2();
		$('#id-SaveForm').submit(function(e)
		{
			e.preventDefault();
			var _data = $(this).serialize();
			var _url = $(this).attr("action");

			$.ajax({
				type:'post',
				url:_url,
				data:_data,
				dataType:'json',
				success:function(data)
				{
					if(data)
					{
						alertify.success('success',3);
						window.location.href = "{{ url('/inventory/warehouse/index') }}";
					}
				},
				error:function(xhr,status,message)
				{
					alertify.error('Gagal');
				}
			});
		});
	});
</script>
</body>
</html>
