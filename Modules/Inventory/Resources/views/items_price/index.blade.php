<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
      <h1>{{$project->name}}</h1>

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
                  	<span>Harga {{ is_null($items) ? '' : $items->name }}</span>
                  </li>
              </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">

              	<strong><span class="text-uppercase">
					@if($request->id)
						{{ $items->name }}
					@else
						Semua Harga Barang
					@endif
			</span></strong>
			<br/>
			@if($items != null)
			@include('form.a',[
						'href'=> url('/inventory/items/index').'?id='.$items->id,
						'class'=>'pull-left',
						'caption' => 'Kembali' 
					])
              	@include('form.a',[
						'href'=> url('/inventory/items_price/add_form').'?id='.$items->id,
						'class'=>'pull-right',
						'caption' => 'Tambah' 
					])
			@endif
					<br/>
					<hr/>
			@include('inventory::items_price.datatable')
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
@if($request->id)
<script type="text/javascript">
		  $.ajaxSetup({
    				headers: {
                  'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                }
    });
	$(document).ready(function()
	{
		$('#project_idcheck').change(function(){
			console.log($('#item_id').val());
			var strhtml="";
			$.ajax({
				url:"{{ url('/inventory/items_price/getComparePrice') }}",
				data: {_token : $('input[name=_token]').val(),project_id:$(this).val(),item_id:$('#item_id').val()},
				dataType:'json',
				type:'post',
				success:function(data)
				{
					if(data.length >0)
					{

						for(var i=0;i<data.length;i++)
						{
							strhtml+="<tr><td class='text-right'>"+data[i].price+"</td><td>"+data[i].satuan+"</td><td>"+data[i].date_price+"</td></tr>";
						}

					}
					else
					{
						strhtml="<tr><td colspan='3'>Empty</td></tr>";
					}
					$('#table_compare tbody').find('tr').remove().end().append(strhtml);
				}
			});
		});
	});
</script>
@endif
	<script type="text/javascript" >
		 $.ajaxSetup({
    				headers: {
                  'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
                }
    });
		var gentable = null;
		$(document).ready(function() {
			gentable = $('#table_data').DataTable({
				"columnDefs": [
            		{ "visible": false, "targets": 0 }
		        ],
		        "order": [[ 0, 'asc' ]],
		        "drawCallback": function ( settings ) {
			            var api = this.api();
			            var rows = api.rows( {page:'current'} ).nodes();
			            var last=null;
			 
			            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
			                if ( last !== group ) {
			                    $(rows).eq( i ).before(
			                        '<tr class="success group"><td colspan="5" style="text-align:left;padding:10px;"><strong>'+group+'</strong></td></tr>'
			                    );
			 
			                    last = group;
			                }
			            } );
        		}
			});
			

	
	$(".delete-link").click(function() {
		var id = $(this).attr("id");
		var tParent = $(this).parents("tr");
		var data = gentable.row(tParent).data();
		$.confirm({
			title: 'Confirm Delete ?',
			icon: 'fa fa-warning',
			content: 'Are you sure delete ?',
			autoClose: 'cancelAction|8000',
			buttons: {
				deleteUser: {
					text: 'Delete',
					btnClass: 'btn-red any-other-class',
					action: function () {
						$.post("{{ url('/inventory/items_price/delete') }}", 
						{
							id:id
						}, 
						function(data) {
							if(data)
							{
								alertify.success('success deleted!',3);
								tParent[0].remove();
								
							}
							
						});	
					}
				},
				cancelAction: function () {
					
				}
			}
		});
		return false;
	});

	$(".edit-link").click(function() {
		var id = $(this).attr("id");
		var edit_id = id;
		var token = $('input[name=_token]').val();
		
		$.confirm({
			title: 'Confirm Edit ?',
			icon: 'fa fa-edit',
			content: 'Are you sure edit ?',
			autoClose: 'cancelAction|8000',
			buttons: {
				deleteUser: {
					text: 'Edit',
					btnClass: 'btn btn-info',
					action: function () {
						window.location.href="{{ url('/inventory/items_price/edit_form') }}"+'?id='+edit_id;
					}
				},
				cancelAction: function () {}
			}
		});
		return false;
	});
});
	</script>

</body>
</html>
