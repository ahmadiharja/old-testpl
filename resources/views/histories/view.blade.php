@include('common.navigations.header')
<style type="text/css">/* Chart.js */
@-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}
</style>
<style> @-webkit-keyframes loadingoverlay_animation__rotate_right { to { -webkit-transform : rotate(360deg); transform : rotate(360deg); } } @keyframes loadingoverlay_animation__rotate_right { to { -webkit-transform : rotate(360deg); transform : rotate(360deg); } } @-webkit-keyframes loadingoverlay_animation__rotate_left { to { -webkit-transform : rotate(-360deg); transform : rotate(-360deg); } } @keyframes loadingoverlay_animation__rotate_left { to { -webkit-transform : rotate(-360deg); transform : rotate(-360deg); } } @-webkit-keyframes loadingoverlay_animation__fadein { 0% { opacity   : 0; -webkit-transform : scale(0.1, 0.1); transform : scale(0.1, 0.1); } 50% { opacity   : 1; } 100% { opacity   : 0; -webkit-transform : scale(1, 1); transform : scale(1, 1); } } @keyframes loadingoverlay_animation__fadein { 0% { opacity   : 0; -webkit-transform : scale(0.1, 0.1); transform : scale(0.1, 0.1); } 50% { opacity   : 1; } 100% { opacity   : 0; -webkit-transform : scale(1, 1); transform : scale(1, 1); } } @-webkit-keyframes loadingoverlay_animation__pulse { 0% { -webkit-transform : scale(0, 0); transform : scale(0, 0); } 50% { -webkit-transform : scale(1, 1); transform : scale(1, 1); } 100% { -webkit-transform : scale(0, 0); transform : scale(0, 0); } } @keyframes loadingoverlay_animation__pulse { 0% { -webkit-transform : scale(0, 0); transform : scale(0, 0); } 50% { -webkit-transform : scale(1, 1); transform : scale(1, 1); } 100% { -webkit-transform : scale(0, 0); transform : scale(0, 0); } } 
</style>
        <main class="main-vertical-layout">
            <div class="container-fluid">
                <section class="py-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <!--<button histories@exportPDF class="btn btn-info rounded-pill me-2 me-lg-3" type="button">Print</button>-->
                            <form action="{{url('histories/export/pdf')}}" method="post" id="print_pdf_form">
                                {{csrf_field()}}
            {{Form::hidden('id', $item->id)}}
            {{Form::hidden('graph', '', ['id'=>'graph'])}}
            <button onclick="printPDF()" type="button" class="btn btn-info rounded-pill me-2 me-lg-3" id="limit-update">Print</button>
                            </form>
                        </div>
                        <div>
                            <ol class="breadcrumb mb-0 d-none">
                                <li class="breadcrumb-item"><a class="breadcrumb-link" href="#"><span>danh154</span></a></li>
                                <li class="breadcrumb-item"><a class="breadcrumb-link" href="#"><span>qbx rad&nbsp;</span></a></li>
                                <li class="breadcrumb-item"><a class="breadcrumb-link" href="#"><span>Marcs-MacBook</span></a></li>
                                <li class="breadcrumb-item"><a class="breadcrumb-link" href="#"><span>Apple Color LCD (00000000)</span></a></li>
                            </ol>
                        </div>
                    </div>
                </section>
                <section class="mb-4">
                    <div class="card card-light">
                        <div class="card-header d-md-flex justify-content-between align-items-center">
                            <h5 class="text-primary mb-0">{{$item->name}} {!!$item->resultIcon!!}</h5>
                            <p class="text-body mb-0">(Performed Date: {{$item->getTimeDisplay()}})</p>
                        </div>
                        <div class="card-body cd2">
                            <div class="row gy-4 row-cols-2 row-cols-md-4">
                                @foreach ($item->header as $name => $value)
                                <div class="col">
                                    <h6 class="text-primary mb-0">{{ $name !== 'Serial Number' ? $name : 'Display Serial Number' }}</h6>
                                    <p class="mb-0">{{$value}}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
                @php $cj=0 @endphp
                    @foreach ($item->steps as $i => $step)
                    @php
                    //if(!isset($step['questions'])) continue;
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
                                <!--<div class="px-4">
                                    <div><canvas data-bss-chart="{&quot;type&quot;:&quot;bubble&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;0&quot;,&quot;50&quot;,&quot;100&quot;,&quot;150&quot;,&quot;200&quot;,&quot;250&quot;,&quot;300&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Red Correction&quot;,&quot;backgroundColor&quot;:&quot;transparent&quot;,&quot;borderColor&quot;:&quot;#eb5757&quot;,&quot;borderWidth&quot;:&quot;1&quot;,&quot;data&quot;:[{&quot;x&quot;:&quot;&quot;,&quot;y&quot;:&quot;4500&quot;,&quot;r&quot;:&quot;&quot;},{&quot;x&quot;:&quot;&quot;,&quot;y&quot;:&quot;5300&quot;,&quot;r&quot;:&quot;&quot;},{&quot;x&quot;:&quot;&quot;,&quot;y&quot;:&quot;6250&quot;,&quot;r&quot;:&quot;&quot;},{&quot;x&quot;:&quot;&quot;,&quot;y&quot;:&quot;7800&quot;,&quot;r&quot;:&quot;&quot;},{&quot;x&quot;:&quot;&quot;,&quot;y&quot;:&quot;9800&quot;,&quot;r&quot;:&quot;&quot;}]},{&quot;label&quot;:&quot;Green Correction&quot;,&quot;backgroundColor&quot;:&quot;transparent&quot;,&quot;borderColor&quot;:&quot;#27ae60&quot;,&quot;borderWidth&quot;:&quot;1&quot;,&quot;data&quot;:[{&quot;x&quot;:&quot;&quot;,&quot;y&quot;:&quot;4500&quot;,&quot;r&quot;:&quot;&quot;},{&quot;x&quot;:&quot;&quot;,&quot;y&quot;:&quot;6300&quot;,&quot;r&quot;:&quot;&quot;},{&quot;x&quot;:&quot;&quot;,&quot;y&quot;:&quot;6250&quot;,&quot;r&quot;:&quot;&quot;},{&quot;x&quot;:&quot;&quot;,&quot;y&quot;:&quot;8800&quot;,&quot;r&quot;:&quot;&quot;},{&quot;x&quot;:&quot;&quot;,&quot;y&quot;:&quot;9800&quot;,&quot;r&quot;:&quot;&quot;},{&quot;x&quot;:&quot;&quot;,&quot;y&quot;:&quot;18000&quot;,&quot;r&quot;:&quot;&quot;}]},{&quot;label&quot;:&quot;Blue Correction&quot;,&quot;backgroundColor&quot;:&quot;transparent&quot;,&quot;borderColor&quot;:&quot;#049fd9&quot;,&quot;borderWidth&quot;:&quot;1&quot;,&quot;data&quot;:[{&quot;x&quot;:&quot;&quot;,&quot;y&quot;:&quot;2500&quot;,&quot;r&quot;:&quot;&quot;},{&quot;x&quot;:&quot;&quot;,&quot;y&quot;:&quot;4300&quot;,&quot;r&quot;:&quot;&quot;},{&quot;x&quot;:&quot;&quot;,&quot;y&quot;:&quot;5250&quot;,&quot;r&quot;:&quot;&quot;},{&quot;x&quot;:&quot;&quot;,&quot;y&quot;:&quot;6800&quot;,&quot;r&quot;:&quot;&quot;},{&quot;x&quot;:&quot;&quot;,&quot;y&quot;:&quot;8800&quot;,&quot;r&quot;:&quot;&quot;},{&quot;x&quot;:&quot;&quot;,&quot;y&quot;:&quot;12000&quot;,&quot;r&quot;:&quot;&quot;}]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:true,&quot;legend&quot;:{&quot;display&quot;:true,&quot;labels&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;,&quot;fontColor&quot;:&quot;#808080&quot;},&quot;position&quot;:&quot;top&quot;,&quot;reverse&quot;:false},&quot;title&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;,&quot;display&quot;:false},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;gridLines&quot;:{&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;drawOnChartArea&quot;:false},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#808080&quot;,&quot;fontStyle&quot;:&quot;normal&quot;,&quot;beginAtZero&quot;:true}}],&quot;yAxes&quot;:[{&quot;gridLines&quot;:{&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;drawOnChartArea&quot;:false},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#808080&quot;,&quot;fontStyle&quot;:&quot;normal&quot;,&quot;beginAtZero&quot;:true}}]}}}"></canvas></div>
                                </div>-->
                                
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
                                <!--<div class="px-4">
                                    <div><canvas data-bss-chart="{&quot;type&quot;:&quot;line&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;0&quot;,&quot;100&quot;,&quot;200&quot;,&quot;300&quot;,&quot;400&quot;,&quot;500&quot;,&quot;600&quot;,&quot;700&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Target&quot;,&quot;backgroundColor&quot;:&quot;transparent&quot;,&quot;borderColor&quot;:&quot;#27ae60&quot;,&quot;data&quot;:[&quot;4500&quot;,&quot;5300&quot;,&quot;6250&quot;,&quot;7800&quot;,&quot;9800&quot;,&quot;15000&quot;],&quot;fill&quot;:false,&quot;borderWidth&quot;:&quot;1&quot;},{&quot;label&quot;:&quot;Measured&quot;,&quot;backgroundColor&quot;:&quot;transparent&quot;,&quot;borderColor&quot;:&quot;#049fd9&quot;,&quot;data&quot;:[&quot;4500&quot;,&quot;6300&quot;,&quot;6250&quot;,&quot;8800&quot;,&quot;9800&quot;,&quot;18000&quot;],&quot;fill&quot;:false,&quot;borderWidth&quot;:&quot;1&quot;},{&quot;label&quot;:&quot;+10%&quot;,&quot;backgroundColor&quot;:&quot;transparent&quot;,&quot;borderColor&quot;:&quot;#eb5757&quot;,&quot;data&quot;:[&quot;2500&quot;,&quot;4300&quot;,&quot;5250&quot;,&quot;6800&quot;,&quot;8800&quot;,&quot;12000&quot;],&quot;fill&quot;:false,&quot;borderWidth&quot;:&quot;1&quot;},{&quot;label&quot;:&quot;-10%&quot;,&quot;backgroundColor&quot;:&quot;transparent&quot;,&quot;borderColor&quot;:&quot;#ffb844&quot;,&quot;data&quot;:[&quot;2500&quot;,&quot;4300&quot;,&quot;5250&quot;,&quot;6800&quot;,&quot;8800&quot;,&quot;12000&quot;],&quot;fill&quot;:false,&quot;borderWidth&quot;:&quot;1&quot;}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:true,&quot;legend&quot;:{&quot;display&quot;:true,&quot;labels&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;,&quot;fontColor&quot;:&quot;#808080&quot;},&quot;position&quot;:&quot;top&quot;,&quot;reverse&quot;:false},&quot;title&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;,&quot;display&quot;:false},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;gridLines&quot;:{&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;drawOnChartArea&quot;:false},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#808080&quot;,&quot;fontStyle&quot;:&quot;normal&quot;,&quot;beginAtZero&quot;:true}}],&quot;yAxes&quot;:[{&quot;gridLines&quot;:{&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;drawOnChartArea&quot;:false},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#808080&quot;,&quot;fontStyle&quot;:&quot;normal&quot;,&quot;beginAtZero&quot;:true}}]}}}"></canvas></div>
                                </div>-->
                    </div>
                </section>
            </div>
        </main>
    
<script src="{{url('js/chartjs.min.js')}}"></script>
<script src="{{url('js/chartjs-plugin-annotation.min.js')}}"></script>
@include('common.navigations.footer')
<script>
    function printPDF() {
        var canvas = document.getElementsByTagName('canvas');
        var graph = {};
        for (var canvas of canvas) {
            if (canvas.getContext) {
                var ctx = canvas.getContext("2d");
                var myImage = canvas.toDataURL("image/png");
                graph[canvas.id] = myImage;
                // document.getElementById('graph').value = myImage;
            }
        }
        console.log('graph', graph)
        document.getElementById('graph').value = JSON.stringify(graph);
        $("#print_pdf_form").submit();
    }
</script>