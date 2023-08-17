<script>

    $(document).ready(function(){
        var data = [[1, {{ $graph_datas["Jan"] }}], [2, {{ $graph_datas["Feb"] }}], [3, {{ $graph_datas["Mar"] }}], [4, {{ $graph_datas["Apr"] }}], [5, {{ $graph_datas["May"] }}], [6, {{ $graph_datas["Jun"] }}], [7, {{ $graph_datas["Jul"] }}], [8, {{ $graph_datas["Aug"] }}], [9, {{ $graph_datas["Sept"] }}], [10, {{ $graph_datas["Oct"] }}],[11,{{ $graph_datas["Nov"] }}],[12,{{ $graph_datas["Dec"] }}]];

        $.plot('#demo-flot-bar', [data], {
            series: {
                bars: {
                    show: true,
                    barWidth: 0.6,
                    fill: true,
                    fillColor: {
                        colors: [{
                            opacity: 0.9
                        }, {
                            opacity: 0.9
                        }]
                    }
                }
            },
            colors: ['#ff0000'],
            yaxis: {
                ticks: 5,
                tickColor: 'rgba(0,0,0,.1)'
            },
            xaxis: {
                ticks: 7,
                tickColor: 'transparent'
            },
            grid: {
                hoverable: true,
                clickable: true,
                tickColor: '#eeeeee',
                borderWidth: 0
            },
            legend: {
                show: true,
                position: 'nw'
            },
            tooltip: {
                show: true,
                content: 'x: %x, y: %y'
            }
        });
    });


</script>