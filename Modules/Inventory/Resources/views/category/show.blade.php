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
                      <span>Kategori</span>
                  </li>
              </ul>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-12">
              	<strong>Kategori</strong>
              	@include('form.a',[
						'href'=> url('/inventory/category/add_form'),
						'class'=>'pull-right',
						'caption' => 'Tambah' 
					])
				<hr/>
              	<div class="panel panel-success">
			  <!-- Default panel contents -->
			  <div class="panel-heading">Kategori</div>
			  <div class="panel-body">

			  	<div class="form-inline">
				  <div class="form-group">
				    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
				    <div class="input-group">
				      <div class="input-group-addon">Cari :</div>
				      {{ csrf_field() }}
				      <input type="text" class="form-control" id="input-search">
				      <input type="hidden" name="id" id="id_val" />
				      <input type="hidden" name="node_name" id="node_name" />
				    </div>
				  </div>
				  
				</div>
					<br/>
			   		<div class="form-group">
			            <button id="btn-edit" type="button" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</button>
				  		<button id="btn-delete" type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
		           </div>
		          
			  </div>

			  <!-- tree -->
			  <div id="tree"></div>
			</div>
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
@include('pluggins.bootstrap_tree_view')
@include('pluggins.alertify')
<script type="text/javascript">
	var genTree = null;
	var fnTreeView = function()
	{
		$.ajax({
			url : "{{ url('/inventory/category/getTreeCategories') }}",
			method : 'GET',
			dataType : 'json',
			success : function(data)
			{
				var arrData = [];
				for(var key in data)
				{
					 if (data.hasOwnProperty(key)) {
					        arrData.push(data[key]);
					    }
				};
				$('#tree').treeview(
						{
							  levels:1,
							  color: "#428bca",
					          expandIcon: "glyphicon glyphicon-plus",
					          collapseIcon: "glyphicon glyphicon-minus",
					          //nodeIcon: "glyphicon glyphicon-folder-close",
					          onhoverColor: '#b9deec',
					          selectedColor: '#FFFFFF',
					          searchResultColor: '#D9534F',
					          highlightSearchResults: true,
					          highlightSelected: true,
					          showTags: true,
					          showCheckbox: true,
					          tags: ['available'],
					          data: arrData,
					          onNodeChecked : function(event,node)
					          {
					          	//var checkVal = $('#id_val').val();
					          	$('#id_val').val(node.id);
					          	$('#node_name').val(node.name);
					          	/*if(checkVal != '')
					          	{
					          		console.log($(this).attr('class'));
					          	}
					          	else
					          	{
					          		$('#id_val').val(node.id);
					          	}*/
					          },
					          nodeUnchecked : function(event,node)
					          {
					          	//$('#id_val').val('');
					          }
							/*,
							,
							,selectedBackColor: '#428bca'
							,
							,enableLinks: false
							,
							,highlightSearchResults: true
							,showIcon: true
							*/
							//,backColor : 'green'
						}
					);
			}

		});
	}

	$(document).ready(function()
	{
		fnTreeView();

		$('#input-search').keyup(function(){
			var pattern = $(this).val();
			var options = {
				ignoreCase: true,
				exactMatch: false,
				revealResults: true,
			};
			$('#tree').treeview('search',[pattern,options]);
		});
		
		


		$('#btn-edit').click(function()
		{
			var edit_id = $('#id_val').val();
			if(edit_id != '')
			{
				window.location.href="{{ url('/inventory/category/edit_form') }}"+'?id='+edit_id;
			}
			
		});

		$('#btn-delete').click(function()
		{
			var del_id = $('#id_val').val();
			var node_name = $('#node_name').val();
			var token = $('input[name=_token]').val();
			if(del_id != '' && del_id != '0')
			{
				$.confirm({
					title: 'Confirm Delete ?',
					icon: 'fa fa-warning',
					content: 'Are you sure delete  ' +node_name+ ' !',
					autoClose: 'cancelAction|8000',
					buttons: {
						deleteUser: {
							text: 'Delete',
							btnClass: 'btn-red any-other-class',
							action: function () {
								$.post('{{ url("/inventory/category/delete") }}', 
								{
									id:del_id,
									_token: token
								}, 
								function(data) {
									if(data)
									{
										alertify.success('success deleted!',1);
										fnTreeView();
									}
								});
							}
						},
						cancelAction: function () {
							
						}
					}
				});
			}
		});
	});
</script>
</body>
</html>
