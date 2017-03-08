<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Month', 'Expenses', 'Income'],
            @foreach($data as $item)
                ['{{$item->month}}',{{(int)$item->expenses}},{{(int)$item->income}}],
            @endforeach
        ]);

        var options = {
            curveType: 'function',
            legend: { position: 'bottom' },
            colors: ['red', 'green'],
            chartArea:{left:'{{$chart[0]}}',top:'{{$chart[1]}}',width:'{{$chart[2]}}',height:'{{$chart[3]}}'}
        };

        var chart = new google.visualization.LineChart(document.getElementById('income_expense_curves'));

        chart.draw(data, options);
    }
</script>