<script src="https://unpkg.com/ionicons@4.2.4/dist/ionicons.js"></script>
<!-- jQuery -->
<script src="{{ url('/') }}/assets/users/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('/') }}/assets/users/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="{{ url('/') }}/assets/users/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('/') }}/assets/users/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- SlimScroll -->
<script src="{{ url('/') }}/assets/users/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{ url('/') }}/assets/users/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{ url('/') }}/assets/users/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('/') }}/assets/users/dist/js/demo.js"></script>

<!-- ChartJS 1.0.1 -->
<script src="{{ url('/') }}/assets/users/plugins/chartjs2/Chart.min.js"></script>
<script>
  /*$(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
  });*/
</script>
<script type="text/javascript">
  function setapproved(values){
    var budget_id = $("input[name^='budget_id']").serializeArray();
    if ( values == "6" ){
      $("#title_approval").attr("style","color:blue");
      $("#title_approval").text("These workorder will be APPROVED by You");
    }else{
      $("#title_approval").attr("style","color:red");
      $("#title_approval").text("These workorder will be REJECTED by You");
    }
    $("#btn_save_budgets").attr("data-value",values);
   
  }

  
</script>