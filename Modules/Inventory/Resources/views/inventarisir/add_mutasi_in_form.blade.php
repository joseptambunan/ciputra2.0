<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin QS | Dashboard</title>
  @include("master/header")
  <link href="{{ URL::asset('assets/global/plugins/typeahead/typeahead.css') }}" rel="stylesheet" type="text/css" />
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
			                <a href="{{ url('/inventory/permintaan_barang/index') }}">Permintaan Barang</a>
			            </li>
			            <li>
			            	<a href="{{ url('/inventory/barang_keluar/index').'?id='.$barangkeluar->permintaanbarang->id }}">Barang Keluar {{ $barangkeluar->no }}</a>
			            </li>
			            <li>
			            	<span>Mutasi IN</span>
			            </li>
			        </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
              	@include('form.a',[
			'href'=> is_null($barangkeluar) ? url('/inventory/inventarisir/index') : url('/inventory/inventarisir/index').'?id='.$barangkeluar->id, 
			'caption' => ' Batal' 
		])
		<hr/>
              	<form method="post" id="id-SaveForm" method="post" class="form-horizontal form-label-left" action="{{ url('/inventory/inventarisir/create') }}" autocomplete="off">
		{{ csrf_field() }}
		<input type="hidden" name="barangkeluar_id" id="barangkeluar_id" value="{{ is_null($barangkeluar) ? null : $barangkeluar->id }}" />
		

		  		
		  		<div class="item form-group">
	              <label class="control-label col-md-3 col-sm-3 col-xs-12">Pemberi</label>
	              <div class="col-md-4 col-sm-4 col-xs-12">
	                <div class="input-group">
	                  <input type="hidden" name="id_pic_giver" value="0" id="id_pic_giver" />
	                  <input type="text" name="giver" id="giver" class="form-control typeaHead" />
	                  <div class="input-group-addon">
	                   <i class="fa fa-user"></i>
	                  </div>
	                </div>
	              </div>
	            </div>

	             <div class="item form-group">
	              <label class="control-label col-md-3 col-sm-3 col-xs-12">Penerima</label>
	              <div class="col-md-4 col-sm-4 col-xs-12">
	                <div class="input-group">
	                  <input type="hidden" name="id_pic_recipient" value="0" id="id_pic_recipient" />
	                  <input type="text" name="pic_recipient" id="pic_recipient" class="form-control typeaHead" />
	                  <div class="input-group-addon">
	                    <i class="fa fa-user"></i>
	                  </div>
	                </div>
	              </div>
	            </div>

	            <div class="form-group">
		  			<label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal</label>
		  			 <div class="col-md-4 col-sm-4 col-xs-12">
		  			 	<div class="input-group datePicker_">
		  			 		<div class="input-group-addon" ><i class="fa fa-calendar"></i></div>
		  			 			<input type="text" class="form-control date " name='date' id='date' value="{{ date('Y-m-d') }}">
		  			 	</div>
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
@include("master/footer_table")
<script type="text/javascript" src="{{ URL::asset('assets/global/plugins/typeahead/typeahead.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/global/plugins/typeahead/bootstrap3-typeahead.min.js') }}"></script>
@include('pluggins.alertify')
@include('pluggins.datetimepicker_pluggin')
<script src="{{ URL::asset('vendor/jsvalidation/js/jsvalidation.min.js')}}" type='text/javascript'></script>
{!! JsValidator::formRequest('Modules\Inventory\Http\Requests\RequestAddInventarisir', '#id-SaveForm') !!}
<script type="text/javascript">
	$(document).ready(function()
	{
		//lookup PIC
      var sourceEngine = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    remote: {
                          url: '/inventory/getUsers/type_user?q=%QUERY%',
                          wildcard: '%QUERY%'
                      }
                  });

      sourceEngine.initialize();

      var $inputType = $('.typeaHead');

      $inputType.typeahead({
        items : 4,
        source : sourceEngine.ttAdapter(),
        displayText : function(item)
        {
            return item.user_name;
        },
        updater: function(item)
        {
            $('input[name='+$(this)[0].$element[0].name+']').prev().val(item.id);
            //$('#id_pic_giver').val(item.id);
            //console.log($(this)[0].$element.context;
            return item.user_name;
        }
      });

		$('#id-SaveForm').submit(function(e)
		{
			e.preventDefault();
			var _datasend = $(this).serialize();
			var _url = $(this).attr('action');
			$('#id-SaveForm input').attr("disabled", "disabled");
			
              $.ajax({
	                type: 'POST',
	                url: _url,
	                data: _datasend,
	                dataType: 'json',
	                beforeSend:function(){
	                	alertify.success('sending ...');
	                },
	                success:function(data){
	                	if(data.return=='1')
	                	{
	                		alertify.success("Success");
	                		window.location.href="{{ url('/inventory/inventarisir/index')}}"+"?id="+$('#barangkeluar_id').val();
	                	}
	                	else
	                	{
	                		alertify.error("Warning ,Mohon periksa kembali data-data anda");
	                	}
	                },
	                error:function(xhr,status,errormessage)
	                {},
	                complete:function()
	                {
	                	$('#id-SaveForm input').removeAttr('disabled');
	                  	$('.form-group').removeClass('has-success');
	                }
              });
		});
	});
</script>
</body>
</html>