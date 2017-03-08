<html>
  <head>
  </head>
  <body>
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Spending', 'Income'],
          ['January', 1534.13, 1200],
          ['February', 2370.42, 1500],
          ['March', 762.23, 1000]
        ]);

        var options = {
          curveType: 'function',
          legend: { position: 'bottom' },
          colors: ['red', 'green']
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
    <div id="income_expense_curves" style="width: 900px; height: 500px"></div>
  </body>
</html>