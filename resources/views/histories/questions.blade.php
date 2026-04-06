@php
    $hasAnswer = false;
    foreach ($questions as $question) {
        if ($question['answer'] != '') {
            $hasAnswer = true;
            break;
        }
    }
@endphp
<div class="table-responsive rounded-4 mb-4">
<table class="table table-sm mb-0 table-light" width="100%">
    @if ($hasAnswer)
    <thead>
    <tr class="table-primary">
        <th class="fw-semibold">Question</th>
        <th class="text-nowrap fw-semibold">Answer</th>
    </tr>
    </thead>
    @endif
    <tbody>
    @foreach ($questions as $question)
        <tr>
            <td class="text-nowrap text-primary">{!!$question['text']!!}</td>
            @if (isset($question['reverse']) AND (strtolower($question['answer']) == ($question['reverse'] == 'yes'? 'no': 'yes')))
            <td class="text-body"><span class="text-success"><b>{!!$question['answer']!!}</b></span></td>
            @else 
            <td class="text-body"><span class="text-danger"><b>{!!$question['answer']!!}</b></span></td>
            @endif
        </tr>                                            
    @endforeach 
    </tbody>
</table>
</div>