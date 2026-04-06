<!-- Lines -->
@if ($graph['lines']) 
<script>
    var data = [];

    @foreach ($graph['lines'] as $line)
        @php
            $x = []; $y = [];
        @endphp
        @foreach ($line['points'] as $p)
            @php
                $x[] = $p['x'];
                $y[] = $p['y'];
            @endphp
        @endforeach  

       

        var line = {
            x: [{{ implode(',', $x) }}],
            y: [{{ implode(',', $y) }}],
            name: '{{ isset($line['name'])?$line['name']:'' }}',
            type: 'bar',
            marker: {
                color: '{{App\Http\Controllers\HistoriesController::hex2rgb($line['color'])}}'
            }
        };
        data.push(line);
    @endforeach  

    
    
    var layout = {
        title: '{{ isset($graph['name'])?$graph['name']:'' }}'
       
    };
    Plotly.newPlot('graph_{{$i}}_{{$j}}', data, layout, {responsive: true})
</script>
@endif