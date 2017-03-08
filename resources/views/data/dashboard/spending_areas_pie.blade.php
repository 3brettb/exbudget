<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Work',     11],
            ['Eat',      2],
            ['Commute',  2],
            ['Watch TV', 2],
            ['Sleep',    7]
        ]);

        var options = {
            chartArea:{left:'{{$chart[0]}}',top:'{{$chart[1]}}',width:'{{$chart[2]}}',height:'{{$chart[3]}}'}
        };

        var chart = new google.visualization.PieChart(document.getElementById('spending_areas_pie'));

        chart.draw(data, options);
    }
</script>