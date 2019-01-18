<!-- ChartJS -->
<script src="{{ url('/')}}/assets/bower_components/chart.js/Chart.js"></script>
<script type="text/javascript">
  $("#budget_update").text($("#tmp_budget").val());
  $("#hpp_update").text($("#tmp_hpp").val());

  /*$("#hpp_update").number(true);
  $("#budget_update").number(true);*/

  // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas);

    var areaChartCanvas1 = $('#areaChart1').get(0).getContext('2d')
    var areaChart1       = new Chart(areaChartCanvas1);
    var areaChartCanvas2 = $('#areaChart2').get(0).getContext('2d')
    var areaChart2       = new Chart(areaChartCanvas2);
    var areaChartCanvas3 = $('#areaChart3').get(0).getContext('2d')
    var areaChart3       = new Chart(areaChartCanvas3);


    var data_variabel_cash_out = [];
    if ($("#variabel_cash_out").val() != "" ){
      var string_variabel_cash_out = $("#variabel_cash_out").val();
      data_variabel_cash_out = string_variabel_cash_out.split(",");
    }

    var data_variabel_carry_over = [];
    if ($("#variabel_carry_over").val() != "" ){
      var string_variabel_carry_over = $("#variabel_carry_over").val();
      data_variabel_carry_over = string_variabel_carry_over.split(",");
    }

    var data_variabel_realiasasi = [];
    if ($("#variabel_realiasasi").val() != "" ){
      var string_variabel_realiasasi = $("#variabel_realiasasi").val();
      data_variabel_realiasasi = string_variabel_realiasasi.split(",");
    }

    var areaChartData = {
      labels  : ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli','Agustus','September','Oktober','November','Desember'],
      datasets: [
        {
          label               : 'Budget Cash Out',
          fillColor           : 'rgba(255, 0, 0, 1)',
          strokeColor         : 'rgba(255, 0, 0, 1)',
          pointColor          : 'rgba(255, 0, 0, 1)',
          pointStrokeColor    : '#ff0000',
          pointHighlightFill  : '#ff0000',
          pointHighlightStroke: 'rgba(255, 0, 0,1)',
          data                : data_variabel_cash_out
        },
        {
          label               : 'Budget Carry Over',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : data_variabel_carry_over
        },
        {
          label               : 'Realisasi',
          fillColor           : 'rgba(255, 255, 102,0.9)',
          strokeColor         : 'rgba(255, 255, 102,0.8)',
          pointColor          : '#ffff33',
          pointStrokeColor    : 'rgba(255, 255, 102,1)',
          pointHighlightFill  : '#ffff33',
          pointHighlightStroke: 'rgba(255, 255, 102,1)',
          data                : data_variabel_realiasasi
        }
      ]
    }

    var areaChartData1 = {
      labels  : ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli','Agustus','September','Oktober','November','Desember'],
      datasets: [
        {
          label               : 'Budget Cash Out',
          fillColor           : 'rgba(255, 0, 0, 1)',
          strokeColor         : 'rgba(255, 0, 0, 1)',
          pointColor          : 'rgba(255, 0, 0, 1)',
          pointStrokeColor    : '#ff0000',
          pointHighlightFill  : '#ff0000',
          pointHighlightStroke: 'rgba(255, 0, 0,1)',
          data                : data_variabel_carry_over
        }]
    };

    var areaChartData2 = {
      labels  : ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli','Agustus','September','Oktober','November','Desember'],
      datasets: [
        {
          label               : 'Budget Carry Over',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : data_variabel_carry_over
        }]
    };

    var areaChartData3 = {
      labels  : ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli','Agustus','September','Oktober','November','Desember'],
      datasets: [
        {
          label               : 'Realisasi',
          fillColor           : 'rgba(255, 255, 102,0.9)',
          strokeColor         : 'rgba(255, 255, 102,0.8)',
          pointColor          : '#ffff33',
          pointStrokeColor    : 'rgba(255, 255, 102,1)',
          pointHighlightFill  : '#ffff33',
          pointHighlightStroke: 'rgba(255, 255, 102,1)',
          data                : data_variabel_realiasasi
        }]
    };

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    };

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions);
    areaChart1.Line(areaChartData1, areaChartOptions);
    areaChart2.Line(areaChartData2, areaChartOptions);
    areaChart3.Line(areaChartData3, areaChartOptions);

    

</script>