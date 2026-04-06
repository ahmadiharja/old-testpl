<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body{font-family: DejaVu Sans;}
        .header {
            text-align: center;
        }

        .tab-content {
            margin-top: 30px;
        }

        .step-header {
            font-size: 20px;
            color: #2CA8FF;
            font-weight: 700;
            margin-top: 30px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>{{$item->name}}</h1>
        <div>Display Model: {{$item->display->model}} | Serial Number: {{$item->display->serial}}</div>
        <div>Workstation: {{$item->display->workstation->name}} | Workgroup: {{$item->display->workstation->workgroup->name}}</div>
        @if($item->getHeader('Sensor Model') !== '')
        <div>Sensor: {{ $item->getHeader('Sensor Manufacturer') }}, {{ $item->getHeader('Sensor Model') }} | Sensor Serial: {{ $item->getHeader('Sensor Serial') }}</div>
        @endif
        <div>(Performed Date: {{$item->getTimeDisplay()}})</div>
        <div>Result: {{$item->status_text}}</div>
    </div>
    <div class="tab-content">
        @foreach ($item->steps as $i => $step)
        @php
        if (!isset($step['scores']) AND !isset($step['questions']) AND !isset($step['comment']) AND isset($step['graphs']))
        {
            $flag=0;
            foreach ($step['graphs'] as $j => $graph1)
                if(!isset($graph['graph_'.$i.'_'.$j]) OR $graph['graph_'.$i.'_'.$j]=='') $flag=1;
                
            if($flag==1) continue;
        }
        @endphp
        <div class="tab-pane {{ $i==0 ? 'active' : ''}}" id="tab_step_{{$i}}">
            <div class="step-header"><b>{!!ucfirst($step['name'])!!}</b></div>
            <hr />
            @if (isset($step['scores']))
            <!-- Scores -->
            @include('histories.scores', ['scores' => $step['scores']])
            @endif

            @if (isset($step['questions']))
            <!-- Questions -->
            @include('histories.questions', ['questions' => $step['questions']])
            @endif

            @if (isset($step['comment']))
            <!-- Comments -->
            <div><b>Comment:</b> {!!$step['comment']!!}</div>
            @endif
            @if (isset($step['graphs']))
            <!-- Graphs -->
            <!--pre>{{print_r($step['graphs'],true)}}</pre-->
            @foreach ($step['graphs'] as $j => $graph1)
            @php
            if(!isset($graph['graph_'.$i.'_'.$j])) continue;
            @endphp
            <img src="{{$graph['graph_'.$i.'_'.$j]}}" width="100%" />
            @endforeach
            @endif


        </div>
        @endforeach
        
        @php $cj=0 @endphp
                    @foreach ($item->steps as $i => $step)
                    @php
                    if(!isset($step['comment'])) continue;
                    @endphp

                @if($cj==0)
                <section class="mb-4">
                    <div class="bg-white border rounded border-info rounded-4 pt-4">
                @endif

                        <div id="tab_step_{{$i}}">
                            <div class="px-4 mb-3">
                            <h5 class="text-primary mb-0">{!!ucfirst($step['name'])!!}</h5>
                            </div>
                            @if (isset($step['scores']))
                            <!-- Scores -->
                            @include('histories.scores', ['scores' => $step['scores']])
                            @endif

                            @if (isset($step['questions']))
                            <!-- Questions -->
                            @include('histories.questions', ['questions' => $step['questions']])
                            @endif

                            @if (isset($step['comment']))
                            <!-- Comments -->
                            <div><b>Comment:</b> {!!$step['comment']!!}</div>
                            @endif

                            @if (isset($step['graphs']))
                            <!-- Graphs -->
                            @include('histories.graphs', ['graphs' => $step['graphs'], 'step_id' => $i, 'history_id' => $item->id])
                            <!--pre>{{print_r($step['graphs'],true)}}</pre-->
                            @endif
                        </div>

                @if($cj==0)
                        </div>
                </section>
                @php $cj=1; @endphp
                @endif
                        @endforeach
                        
                @php $cj=0; @endphp
                    @foreach ($item->steps as $i => $step)
                    @php
                    if($step['name']!='Target & Results') continue;
                    @endphp

                @if($cj==0)
                <section class="mb-4">
                    <div class="bg-white border rounded border-info rounded-4 pt-4">
                @endif
                        <div id="tab_step_{{$i}}">
                            <div class="px-4 mb-3">
                            <h5 class="text-primary mb-0">{!!ucfirst($step['name'])!!}</h5>
                            </div>
                            @if (isset($step['scores']))
                            <!-- Scores -->
                            @include('histories.scores', ['scores' => $step['scores']])
                            @endif

                            @if (isset($step['questions']))
                            <!-- Questions -->
                            @include('histories.questions', ['questions' => $step['questions']])
                            @endif

                            @if (isset($step['comment']))
                            <!-- Comments -->
                            <div><b>Comment:</b> {!!$step['comment']!!}</div>
                            @endif

                            @if (isset($step['graphs']))
                            <!-- Graphs -->
                            @include('histories.graphs', ['graphs' => $step['graphs'], 'step_id' => $i, 'history_id' => $item->id])
                            <!--pre>{{print_r($step['graphs'],true)}}</pre-->
                            @endif
                        </div>

                @if($cj==0)
                        </div>
                </section>
                @php $cj=1; @endphp
                @endif
                        @endforeach
                        
                <section class="mb-4">
                    <div class="row gy-4 row-cols-1 row-cols-xl-2">
                        
                    @php $cj=0 @endphp
                                @foreach ($item->steps as $i => $step)
                    @php
                    if($step['name']!='luminance') continue;
                    @endphp

                    @if($cj==0)
                    <div class="col">
                            <div class="card card-light">
                    @endif

                        <div id="tab_step_{{$i}}">
                            <div class="card-header">
                                <h4 class="text-primary mb-0">{!!ucfirst($step['name'])!!}</h4>
                            </div>
                            @if (isset($step['scores']))
                            <!-- Scores -->
                            @include('histories.scores', ['scores' => $step['scores']])
                            @endif

                            @if (isset($step['questions']))
                            <!-- Questions -->
                            @include('histories.questions', ['questions' => $step['questions']])
                            @endif

                            @if (isset($step['comment']))
                            <!-- Comments -->
                            <div><b>Comment:</b> {!!$step['comment']!!}</div>
                            @endif

                            @if (isset($step['graphs']))
                            <!-- Graphs -->
                            @include('histories.graphs', ['graphs' => $step['graphs'], 'step_id' => $i, 'history_id' => $item->id])
                            <!--pre>{{print_r($step['graphs'],true)}}</pre-->
                            @endif
                        </div>

                        @if($cj==0)
                            </div>
                        </div>
                        @php $cj=1; @endphp
                        @endif
                        @endforeach
                            
                        @php $ch=0; @endphp
                            @foreach ($item->steps as $i => $step)
                    @php
                    if($step['name']!='corrections') continue;
                    @endphp

                    @if($cj==0)
                    <div class="col">
                            <div class="card card-light">
                    @endif

                        <div id="tab_step_{{$i}}">
                            <div class="card-header">
                                <h4 class="text-primary mb-0">{!!ucfirst($step['name'])!!}</h4>
                            </div>
                            @if (isset($step['scores']))
                            <!-- Scores -->
                            @include('histories.scores', ['scores' => $step['scores']])
                            @endif

                            @if (isset($step['questions']))
                            <!-- Questions -->
                            @include('histories.questions', ['questions' => $step['questions']])
                            @endif

                            @if (isset($step['comment']))
                            <!-- Comments -->
                            <div><b>Comment:</b> {!!$step['comment']!!}</div>
                            @endif

                            @if (isset($step['graphs']))
                            <!-- Graphs -->
                            @include('histories.graphs', ['graphs' => $step['graphs'], 'step_id' => $i, 'history_id' => $item->id])
                            <!--pre>{{print_r($step['graphs'],true)}}</pre-->
                            @endif


                        </div>
                        @if($cj==0)
                            </div>
                        </div>
                        @php $cj=1; @endphp
                        @endif
                        @endforeach
                        
                        @php $cj=0; @endphp
                            @foreach ($item->steps as $i => $step)
                    @php
                    if($step['name']!='jnd') continue;
                    @endphp

                    @if($cj==0)
                    <div class="col">
                        <div class="bg-white border rounded border-info rounded-4 pt-4">
                    @endif

                        <div id="tab_step_{{$i}}">
                            <div class="px-4 mb-3">
                            <h5 class="text-primary mb-0">{!!ucfirst($step['name'])!!}</h5>
                            </div>
                            @if (isset($step['scores']))
                            <!-- Scores -->
                            @include('histories.scores', ['scores' => $step['scores']])
                            <br>
                            @endif

                            @if (isset($step['questions']))
                            <!-- Questions -->
                            @include('histories.questions', ['questions' => $step['questions']])
                            @endif

                            @if (isset($step['comment']))
                            <!-- Comments -->
                            <div><b>Comment:</b> {!!$step['comment']!!}</div>
                            @endif

                            @if (isset($step['graphs']))
                            <!-- Graphs -->
                            @include('histories.graphs', ['graphs' => $step['graphs'], 'step_id' => $i, 'history_id' => $item->id])
                            <!--pre>{{print_r($step['graphs'],true)}}</pre-->
                            @endif
                        </div>

                        @if($cj==0)
                            </div>
                        </div>
                        @php $cj=1; @endphp
                        @endif
                        @endforeach
        
        @php $cj=0; @endphp
                            @foreach ($item->steps as $i => $step)
                    @php
                    if($step['name']!='dicom') continue;
                    @endphp

                    @if($cj==0)
                    <div class="col">
                        <div class="bg-white border rounded border-info rounded-4 pt-4">
                    @endif

                        <div id="tab_step_{{$i}}">
                            <div class="px-4 mb-3">
                            <h5 class="text-primary mb-0">{!!ucfirst($step['name'])!!}</h5>
                            </div>
                            @if (isset($step['scores']))
                            <!-- Scores -->
                            @include('histories.scores', ['scores' => $step['scores']])
                            <br>
                            @endif

                            @if (isset($step['questions']))
                            <!-- Questions -->
                            @include('histories.questions', ['questions' => $step['questions']])
                            @endif

                            @if (isset($step['comment']))
                            <!-- Comments -->
                            <div><b>Comment:</b> {!!$step['comment']!!}</div>
                            @endif

                            @if (isset($step['graphs']))
                            <!-- Graphs -->
                            @include('histories.graphs', ['graphs' => $step['graphs'], 'step_id' => $i, 'history_id' => $item->id])
                            <!--pre>{{print_r($step['graphs'],true)}}</pre-->
                            @endif
                        </div>

                        @if($cj==0)
                            </div>
                        </div>
                        @php $cj=1; @endphp
                        @endif
                        @endforeach
    </div>
    
    <div style="position:absolute; bottom:-20px; left:0px; right:0px; text-align:center; font-size:11px;">PerfectLum version: {{$version}}</div>
</body>

</html>