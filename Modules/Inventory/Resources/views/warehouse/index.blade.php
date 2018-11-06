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
                      <span>Gudang</span>
                  </li>
              </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
              	@include('form.a',[
						'href'=> url('/inventory/warehouse/add_form'),
						'class'=>'pull-right',
						'caption' => 'Tambah' 
					])
              	<button class="btn btn-success" id="btn-pic" data-target="#modal_pic" data-toggle="modal"><i class="fa fa-plus"></i> PIC <i class="fa fa-user"></i></button>
              		@include('inventory::warehouse.datatable')

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
    <!-- Modal -->
<div class="modal fade" id="modal_pic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">PIC Warehouse</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="form-pic" method="post" action="{{ url('/inventory/warehouse/storePic') }}">
        	{{ csrf_field() }}
        	<input type="hidden" name="id_warehouses" id="id_warehouses" />
        	  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">PIC</label>
			    <div class="col-sm-10">
			    	<input type="hidden" name="id_pic" id="id_pic" />
			     	<input type="text" class="form-control user_typeahead" name="addpic" id="addpic" placeholder="PIC">
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
			    </div>
			  </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@include("master/footer_table")
@include('pluggins.alertify')
<link href="{{ URL::asset('assets/global/plugins/typeahead/typeahead.css') }}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{ URL::asset('assets/global/plugins/typeahead/typeahead.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/global/plugins/typeahead/bootstrap3-typeahead.min.js') }}"></script>
	<script type="text/javascript" charset="utf-8">
		var gentable = null;
		var arrwarehouse = [];
		$(document).ready(function() {
			var token = $('input[name=_token]').val();

			gentable = $('#table_data').DataTable({
				scrollY:        "300px",
		        scrollCollapse: true,
		        paging:         false,
		        "order": [[ 0, 'asc' ]]
			});

			var sBody = $('#table_data tbody');

			var sHead = $('#table_data thead');

			$('.check_all').click(function()
			{
				
				if($(this).is(':checked'))
				{
					console.log('hy');
					$('.check-pic').prop('checked',true);
					$('.check-pic').each(function(i,v)
					{
						arrwarehouse.push($(this).val());
					});
				}
				else
				{
					$('.check-pic').prop('checked',false);
					arrwarehouse = [];
				}
				$('#id_warehouses').val(JSON.stringify(arrwarehouse));
			});

			sBody.on('click','.details',function()
			{

				var id = parseInt($(this).attr('data-id'));
				window.location.href="{{ url('/inventory/warehouse/details') }}/"+id;
			}).
			on('click','.delete-link',function(){
				var trparent = $(this).parents('tr');
				var data = gentable.row($(this).parents('tr')).data();
				var id = parseInt($(this).attr('data-id'));

				$.confirm({
					title: 'Confirm Delete ?',
					icon: 'fa fa-warning',
					content: 'Are you sure delete " ' +data[2]+ ' " ?',
					autoClose: 'cancelAction|8000',
					buttons: {
						deleteUser: {
							text: 'Delete',
							btnClass: 'btn-red any-other-class',
							action: function () {
								$.post("{{ url('/inventory/warehouse/delete') }}", 
								{
									id:id,
									_token: token
								}, 
								function(data) {
									if(data)
									{
										trparent[0].remove();
										alertify.success('success deleted!',3);
									}
								});
							}
						},
						cancelAction: function () {
							
						}
					}
				});
			}).on('click','.check-pic',function()
			{
				if($(this).is(':checked'))
				{
					if(arrwarehouse.length > 0)
					{
						if(arrwarehouse.includes($(this).val()) == false)
						{
							arrwarehouse.push($(this).val());
						}
					}
					else
					{
						arrwarehouse.push($(this).val());
					}
				}
				else
				{
					if(arrwarehouse.includes($(this).val()) == true)
					{
						var index = arrwarehouse.indexOf($(this).val());
						arrwarehouse.splice(index,1);
					}
					
				}

				$('#id_warehouses').val(JSON.stringify(arrwarehouse));
			});

			$('#form-pic').submit(function(e)
			{
				 e.preventDefault();
              	  var alldata_send=$(this).serializeArray();

	              $.ajax({
	                type: 'POST',
	                url: $(this).attr('action'),
	                data: alldata_send,
	                dataType: 'json',
	                beforeSend:function(){
	                  alertify.success('Sending ...');
	                },
	                success:function(data){
	                  if(data)
	                  {
	                    
	                    alertify.success('success saved!',4);
	                    $('#form-pic').trigger('reset');
	                    $('input[type=hidden]').val('');
	                  }
	                  else
	                  {
	                    alertify.error('Failed saved!',3);
	                  }
	                },
	                error:function(xhr,status,errormessage)
	                {
	                },
	                complete:function()
	                {arrwarehouse = [];$('.check-pic').attr('checked',false);}
	              });
			});

			var sourceEngine = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    remote: {
                          url: '/inventory/getUsers/type_user?q=%QUERY%',
                          wildcard: '%QUERY%'
                      }
                  });
		      sourceEngine.initialize();
		      var $inputType = $('.user_typeahead');
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
		            return item.user_name;
		        }
		      });
		});
	</script>
</body>
</html>
