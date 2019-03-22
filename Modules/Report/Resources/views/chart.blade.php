<!-- ChartJS -->
<script src="{{ url('/')}}/assets/bower_components/chart.js/Chart.js"></script>
<script type="text/javascript">
 var str_budget_cashout = $("#budget_cashout").val();
 var arr_budget_cashout = str_budget_cashout.split(",");

 var str_budget_carryover = $("#budget_carryover").val();
 var arr_budget_carryover  = str_budget_carryover.split(",");

 var str_real_bulanan = $("#real_bulanan").val();
 var arr_real_bulanan  = str_real_bulanan.split(",");

 var areaChartData = {
    labels  : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul','Agu', 'Sep','Okt','Nov','Des'],
    datasets: [
      {
        label               : 'Cash Out',
        fillColor           : 'rgba(255, 0, 0, 1)',
        strokeColor         : 'rgba(255, 0, 0, 1)',
        pointColor          : 'rgba(255, 0, 0, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : arr_budget_cashout
      },
      {
        label               : 'Carry Over',
        fillColor           : 'rgba(0, 0, 255, 1)',
        strokeColor         : 'rgba(0, 0, 255, 1)',
        pointColor          : 'rgba(0, 0, 255, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : arr_budget_carryover
      },
      {
        label               : 'Real',
        fillColor           : 'rgba(255, 255, 0, 1)',
        strokeColor         : 'rgba(255, 255, 0, 1)',
        pointColor          : 'rgba(255, 255, 0, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : arr_real_bulanan
      }
    ]
  }

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
  }

  //Create the line chart
  //areaChart.Line(areaChartData, areaChartOptions)

  var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
  var lineChart                = new Chart(lineChartCanvas)
  var lineChartOptions         = areaChartOptions
  lineChartOptions.datasetFill = false
  lineChart.Line(areaChartData, lineChartOptions)
</script>