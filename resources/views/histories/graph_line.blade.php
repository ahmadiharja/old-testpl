<!-- Lines -->
@if ($graph['lines']) 
<script>
    var data = [];
    var shapes = []; // horizontal lines
    @if (isset($graph['horizontals'])) 
        @foreach ($graph['horizontals'] as $hline)
            var shape = {
                type: 'line',
                x0: 0,
                y0: {{ $hline['level'] }},
                x1: 1,
                xref: 'paper',
                y1: {{ $hline['level'] }},
                line: {
                    color: '{{App\Http\Controllers\HistoriesController::hex2rgb($hline['color'])}}',
                    width: 2
                }
            };
            shapes.push(shape);
        @endforeach
    @endif
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

        @php
            $lineType = isset($line['type'])? $line['type'] : 'line';
        @endphp

        var line = {
            x: [{{ implode(',', $x) }}],
            y: [{{ implode(',', $y) }}],
            name: '{{ isset($line['name'])?$line['name']:'' }}',
            @if ($lineType == 'line') 
            mode: 'lines',
            line: {
                color: '{{App\Http\Controllers\HistoriesController::hex2rgb($line['color'])}}',
                width: 2
            }
            @else
            mode: 'markers',
            marker: {
                color: '{{App\Http\Controllers\HistoriesController::hex2rgb($line['color'])}}',
                size: 8
            }
            @endif
        };
        data.push(line);
    @endforeach  

    
    
    var layout = {
        title: '{{ isset($graph['name'])?$graph['name']:'' }}',
        shapes: shapes
    };
    Plotly.newPlot('graph_{{$i}}_{{$j}}', data, layout, {responsive: true})
</script>
@endif