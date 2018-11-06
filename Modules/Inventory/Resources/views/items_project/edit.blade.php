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
                      <a href="{{ url('/inventory/stock/view_stock') }}">Inventory</a>
                  </li>
                  <li>
                      <a href="{{ url('/inventory/items/index') }}">Barang Proyek</a>
                  </li>
                  <li>
                  	<span>Edit</span>
                  </li>
              </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
              	<strong>Tambah Barang Proyek</strong>

              	@include('form.a',[
						'href'=> url('/inventory/items_project/index'),
						'class'=>'pull-right',
						'caption' => 'Kembali' 
					])
					<hr/>
<form method="post" id="id-SaveForm" action="{{ url('/inventory/items_project/update') }}" autocomplete="off" class="form-horizontal form-label-left">
	{{ csrf_field() }}
			<input type="hidden" id="id" name="id" value="{{$item->id}}" />
		  	<div class="item form-group">
			    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Barang / Kode</label>
			    <div class="col-md-7 col-sm-7 col-xs-12">
			    	<select class='form-control select2' name="item_id" id="item_id">
						<option value="">Pilih</option>
						@foreach($items as $key => $value)
							<option value='{{ $value->id }}' {{ $value->id==$item->item_id ? 'selected="true"' : '' }}>{{ $value->name." / ".$value->kode }}</option>
						@endforeach
					</select>
			    </div>
		  	</div>

		  	<div class="item form-group">
			   <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
			    <div class="col-md-7 col-sm-7 col-xs-12">
		  	<div class="checkbox">
			    <label>
			      <input type="checkbox" name='satuan_warning' id='satuan_warning' value="1"  {{ ($item->satuan_warning) ? 'checked="true"' : '' }}> Aktifkan Pemberitahuan
			    </label>
			  </div>
			</div>
		</div>
		  	
		  	<div class="item form-group">
			   <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
			    <div class="col-md-7 col-sm-7 col-xs-12">
		  	<div class="checkbox">
			    <label>
			      <input type='checkbox' name='is_inventory' id='is_inventory' {{ ($item->is_inventory) ? 'checked="true"' : '' }} /> Inventaris
			    </label>
			  </div>
			</div>
		</div>

		<div class="item form-group">
			   <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
			    <div class="col-md-7 col-sm-7 col-xs-12">
			  <div class="checkbox">
			    <label>
			      <input type='checkbox' name='is_consumable' id='is_consumable' {{ ($item->is_consumable) ? 'checked="true"' : '' }} /> Pakai Habis
			    </label>
			  </div>
			</div>
		</div>

			  <div class="item form-group">
			    <label class="control-label col-md-3 col-sm-3 col-xs-12">Stok Min.</label>
			    <div class="col-md-7 col-sm-7 col-xs-12">
			    	<input type='number' id='stock_min' name='stock_min' value="{{$item->stock_min}}" class='form-control' value="0" required style='width:50%'/>
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
@include('pluggins.select2_pluggin')
<script type="text/javascript">
$(document).ready(function()
{
	$('select').select2();
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
					alertify.success('success simpan!',2);
					window.location.href="{{ url('/inventory/items_project/index') }}";
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

});
</script>
</body>
</html>