  <!-- jQuery -->
<script src="{{ url('/') }}/assets/users/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('/') }}/assets/users/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="{{ url('/') }}/assets/users/plugins/chartjs-old/Chart.min.js"></script>
<!-- FastClick -->
<script src="{{ url('/') }}/assets/users/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{ url('/') }}/assets/users/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('/') }}/assets/users/dist/js/demo.js"></script>
<!-- page script -->
  <script type="text/javascript">
      $(function () {
      var val_cf = $("#cash_flow_monthly").val();
      var split_cf = val_cf.split(",");

      var val_co = $("#budget_unit_monthly").val();
      var split_co = val_co.split(",");

      var val_all = $("#budget_unit_all").val();
      var split_all = val_all.split(",");

      var areaChartData = {
        labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July','Agustus','September','Oktober','November','Desember'],
        datasets: [
          {
            label               : 'Cash Out Bulanan Dev Cost',
            fillColor           : 'rgba(60,141,188,0.9)',
            strokeColor         : 'rgba(60,141,188,0.8)',
            pointColor          : '#1b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#1b8bba',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : split_cf
          },
          {
            label               : 'Cash Out Bulanan Con Cost',
            fillColor           : 'rgba(255,51,51,0.9)',
            strokeColor         : 'rgba(255,51,51,0.8)',
            pointColor          : 'rgba(255,51,51)',
            pointStrokeColor    : 'rgba(255,51,51,1)',
            pointHighlightFill  : 'rgba(255,51,51)',
            pointHighlightStroke: 'rgba(255,51,51,1)',
            data                : split_co
          },
          {
            label               : 'Total Cash Flow',
            fillColor           : 'rgba(204,204,0,0.9)',
            strokeColor         : 'rgba(204,204,0,0.8)',
            pointColor          : 'rgba(204,204,0)',
            pointStrokeColor    : 'rgba(204,204,0,1)',
            pointHighlightFill  : 'rgba(204,204,0)',
            pointHighlightStroke: 'rgba(204,204,0,1)',
            data                : split_all
          },
          {
            label               : 'Cash Out Bulanan Dev Cost',
            fillColor           : 'rgba(60,141,188,0.9)',
            strokeColor         : 'rgba(60,141,188,0.8)',
            pointColor          : '#1b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#1b8bba',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : split_cf
          },
          {
            label               : 'Cash Out Bulanan Con Cost',
            fillColor           : 'rgba(255,51,51,0.9)',
            strokeColor         : 'rgba(255,51,51,0.8)',
            pointColor          : 'rgba(255,51,51)',
            pointStrokeColor    : 'rgba(255,51,51,1)',
            pointHighlightFill  : 'rgba(255,51,51)',
            pointHighlightStroke: 'rgba(255,51,51,1)',
            data                : split_co
          },
          {
            label               : 'Total Cash Flow',
            fillColor           : 'rgba(204,204,0,0.9)',
            strokeColor         : 'rgba(204,204,0,0.8)',
            pointColor          : 'rgba(204,204,0)',
            pointStrokeColor    : 'rgba(204,204,0,1)',
            pointHighlightFill  : 'rgba(204,204,0)',
            pointHighlightStroke: 'rgba(204,204,0,1)',
            data                : split_all
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
      
      var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
      var lineChart                = new Chart(lineChartCanvas)
      var lineChartOptions         = areaChartOptions
      lineChartOptions.datasetFill = false
      lineChart.Line(areaChartData, lineChartOptions)

    });
  </script>
