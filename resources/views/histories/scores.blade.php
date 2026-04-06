<div class="table-responsive rounded-4">
<table class="table table-sm mb-0 table-light" width="100%">
    <thead>
    <tr class="table-primary">
        <th class="fw-semibold">Items</th>
        <th class="text-nowrap fw-semibold">Target Settings</th>
        <th class="fw-semibold">Results</th>
        <th class="fw-semibold"></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($scores as $score)
        <tr>
            <td class="text-nowrap text-primary">{!!$score['name']!!}</td>
            <td class="text-body">{!!$score['limit']?$score['limit']:'-'!!}</td>
            <td class="text-nowrap text-body">{!!$score['measured']!!}</td>
            <td class="text-body">{!!$score['answer']==0 ? '<span class=text-danger><b>Not OK</b></span>' : ($score['answer']==1?'<span class=text-success><b>OK</b></span>':'-')!!}</td>
        </tr>                                            
    @endforeach 
    </tbody>
</table>
</div>