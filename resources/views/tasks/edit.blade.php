                                        <form method="post" action="{{url('update-task')}}" id="schedule_task_form">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="displays" value="{{$displays}}">
                                                    <input type="hidden" name="workstation2" value="{{$request->input('workstation2')}}">
                                                    <input type="hidden" name="workgroup2" value="{{$request->input('workgroup2')}}">
                                                    <input type="hidden" name="facility2" value="{{$request->input('facility2')}}">
                                                    {{Form::hidden('id', $task->id)}}
                                                    <div class="row gy-3">
                                                        <div class="col-12">
                                                            <div><label class="form-label fw-semibold">Task</label>
                                                            {{Form::select('tasktype', $tasktype, $task->type, ['class' => 'form-select', 'onchange' => 'task_type(this)', 'id'=> 'tasktype', 'placeholder' => '-- Select Task Type --'])}}
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div><label class="form-label fw-semibold">Schedule Type:</label>
                                                            {{Form::select('scheduletype', $scheduletype, $task->schtype, ['class' => 'form-select', 'onchange' => 'schedule_type(this)','id' =>'scheduletype', 'placeholder' => '-- Select Schedule Type --'])}}
                                                            </div>
                                                        </div>
                                                        <div class="col-12" id="testpaternId" style="display:none;">
                                                            <div><label class="form-label fw-semibold">Test Pattern:</label>
                                                            {{Form::select('testpattern', $testpattern, $task->testpattern, ['class' => 'form-select', 'placeholder' => '-- Select Test Pattern --'])}}
                                                            </div>
                                                        </div>
                                                        <div class="col-12 date-time-fields">
                                                            <div>
                                                                <div class="form-check mb-0">
                                                                    <input class="form-check-input" type="checkbox" id="formCheck-3" name="disabletask" @if ( $task->disabled == 1 ) checked @endif>
                                                                    <label class="form-check-label" for="formCheck-3">Disable Task</label>
                                                                </div>
                                                                <hr>
                                                                <p class="text-info mb-0">Specify the time, date(s) when the task will be performed</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 date-time-fields">
                                                            <div><label class="form-label fw-semibold">Start time:</label>
                                                            <!--<input class="form-control" type="time" name="starttime">-->
                                                            {{Form::time('starttime', $task->starttime,['class' => 'form-control' ])}}
                                                            </div>
                                                        </div>
                                                        <div class="col-12" id="perform_task_box" style="display:none;">
                                                            <label class="form-label fw-semibold">Perform this task</label>
                                                            <div id="daily_field_box" style="display: none;">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" id="formCheck-4" name="dailytask" value="1" @if ($task->daysofweek == '1;2;3;4;5;6;7' && $task->nthflag == 1) checked @endif>
                                                                    <label class="form-check-label" for="formCheck-4">Every day</label>
                                                                </div>
                                                                <div class="form-check mt-2">
                                                                    <input class="form-check-input" type="radio" id="formCheck-1" name="dailytask" value="2" @if ($task->daysofweek == '1;2;3;4;5' && $task->nthflag == 1 ) checked @endif>
                                                                    <label class="form-check-label" for="formCheck-1">on working days only</label>
                                                                </div>
                                                                <div class="d-flex mt-2">
                                                                    <div class="form-check flex-shrink-0">
                                                                        <input class="form-check-input" type="radio" id="formCheck-2" name="dailytask" value="3" @if ( $task->everynday != null && $task->nthflag == 0) checked @endif>
                                                                        <label class="form-check-label" for="formCheck-2">Every </label>
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <div class="form-control-wrapper form-control-icon-end position-relative form-control-every">
                                                                            <!--<input class="form-control" type="number" value="2" name="dayinmonth" min="2" max="30">-->
                                                                            {{Form::number('dayinmonth',$task->everynday?$task->everynday:2,['class'=>'form-control', 'id' => 'dayinmonth', 'min' => 2, 'max' => 30])}}
                                                                            <span class="d-inline-block position-absolute position-absolute-end top-50 translate-middle-y">-th day (2-30)</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="week_field_box" style="display:none;">
                                                                <div class="d-flex mt-2">
                                                                    <div class="form-check flex-shrink-0">
                                                                        <label class="form-check-label" for="formCheck-21">Every </label>
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <div class="form-control-wrapper form-control-icon-end position-relative form-control-every">
                                                                            <!--<input class="form-control" type="number" value="1" name="week">-->
                                                                            {{Form::number('week',$task->everynweek?$task->everynweek:1,['class'=>'form-control', 'id' => 'week'])}}
                                                                            <span class="d-inline-block position-absolute position-absolute-end top-50 translate-middle-y">week</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="monthly_field_box" style="display:none;">
                                                                <div class="d-flex mt-2">
                                                                    <div class="form-check flex-shrink-0">
                                                                        <input class="form-check-input" type="radio" id="formCheck-22" name="rdayinmonth" value="1" @if ( $task->dayofmonthdisplay != null && $task->nthflag == 1) checked @endif>
                                                                        <label class="form-check-label" for="formCheck-22">Day </label>
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <div class="form-control-wrapper form-control-icon-end position-relative form-control-every">
                                                                            <!--<input class="form-control" type="number" value="1" name="dayofmonth">-->
                                                                            {{Form::number('dayofmonth', $task->dayofmonth?$task->dayofmonth:1 ,['class' => 'form-control','id' => 'dayofmonth'])}}
                                                                            <span class="d-inline-block position-absolute position-absolute-end top-50 translate-middle-y"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            
                                                                <div class="d-flex mt-2">
                                                                    <div class="form-check flex-shrink-0">
                                                                        <input class="form-check-input" type="radio" id="formCheck-22" name="rdayinmonth" value="2" @if ( $task->weekofmonth != null && $task->nthflag == 0) checked @endif>
                                                                        <label class="form-check-label" for="formCheck-22">Or on the </label>
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <div class="form-control-wrapper form-control-icon-end position-relative form-control-every">
                                                                        {{Form::select('week_of_month',$weekly,$task->weekofmonth, ['class'=>'form-select selectpicker','data-style'=> 'btn btn-info btn-round', 'id'=>'week_of_month' ])}}
                                                                            <span class="d-inline-block position-absolute position-absolute-end top-50 translate-middle-y"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <div class="form-control-wrapper form-control-icon-end position-relative form-control-every">
                                                                        {{Form::select('dayofweek',$dayofweek,$task->dayofweek, ['class'=>'selectpicker','data-style'=> 'btn btn-info btn-round'])}}
                                                                            <span class="d-inline-block position-absolute position-absolute-end top-50 translate-middle-y"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex mt-2">
                                                                    <div class="form-check flex-shrink-0">
                                                                        <label class="form-check-label" for="formCheck-23">of following months: </label>
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <div class="form-control-wrapper form-control-icon-end position-relative form-control-every">
                                                                        {{Form::select('monthly[]',$monthly,$task->monthesdisplay, ['class' => 'form-select selectpicker', 'data-style' => 'btn btn-info btn-round', 'multiple'=> 'multiple', 'id'=>'monthly' ])}}
                                                                            <span class="d-inline-block position-absolute position-absolute-end top-50 translate-middle-y"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 week_field_box" style="display:none;">
                                                            <div><label class="form-label fw-semibold">Select weekdays:</label>
                                                            {{Form::select('weekdays[]',$dayofweek,$task->daysofweekdisplay, ['class' => 'form-select selectpicker', 'data-style' => 'btn btn-info btn-round', 'multiple'=> 'multiple', 'id'=>'weekdays' ])}}
                                                            </div>
                                                        </div>
                                                        <div class="col-12 date-time-fields date-field">
                                                            <div><label class="form-label fw-semibold">Start Date</label>
                                                            <!--<input class="form-control" type="date" name="startdate">-->
                                                            {{Form::date('startdate', $task->startdatedisplay ,['class' => 'form-control'])}}
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="d-grid"><button class="btn btn-outline-info rounded-pill" type="button" data-bs-dismiss="modal">Cancel</button></div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="d-grid"><button class="btn btn-info rounded-pill" type="submit">Save</button></div>
                                                        </div>
                                                    </div>
                                                </form>

                                                <script>
                                                    $(document).ready(function(){
                                                        schedule_type("#scheduletype");

                                                        $("#schedule_task_form").submit(function(e){
                                                            e.preventDefault();
                                                            var formData=new FormData(this);
        
         $.ajax({
            url: "{{url('update-task')}}",
            type: "POST",
            data:  formData,
            beforeSend: function(){ //alert('sending');
            },
            contentType: false,
            processData:false,
            success: function(data) { //alert(data);
                if ( ! data.success) {
                } else {
                    // ALL GOOD! just show the success message!
                    $("#modal-schedule-task").modal('hide');
                    if(window.tasks_table1!=undefined) window.tasks_table1.ajax.reload();
                    if(window.tasks_table2!=undefined) window.tasks_table2.ajax.reload();
                    if(window.calendar!=undefined) window.calendar.refetchEvents();
                }
            },
            error: function()  {
                //error
            } 	        
        });
                                                        });
                                                    });
                                                </script>