@foreach ($graphs as $j => $graph) 
    @php
        $ymax = isset($graph['ymax'])?$graph['ymax']:0;
        $ymin = isset($graph['ymin'])?$graph['ymin']:0;
    @endphp

    @if ($graph['type'] == 'spect') 
        <img src="/graph/spect/{{$history_id}}/{{$step_id}}/{{$j}}" />
    @else 
        
        <div id="graph_{{$i}}_{{$j}}" style="width: 500px"></div>
        <!-- Lines -->
        @if ($graph['lines']) 
            @section('content-script')
               @include('histories.graph_'.$graph['type'], ['graph' => $graph])
                
            @append
        @endif 
    @endif
@endforeach

