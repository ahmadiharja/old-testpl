<form method="post" >
                                                    {{csrf_field()}}
    <input type="hidden" name="id" value="{{$alert->id}}">
                                                    <div class="row gy-4">
                                                        <div class="col-12">
                                                            <div><label class="form-label fw-semibold">Email</label>
                                                                {{Form::text('email', $alert->email, ['class' => 'form-control', 'placeholder' => 'Email'])}}
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1" name="actived" @if ($alert->actived == 1  ) checked @endif />&nbsp;
                                                              
                                                                <label class="form-check-label fw-semibold" for="actived">Enable </label></div>
                                                        </div>  
                                                        <div class="col-12">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1" name="daily_report" @if ($alert->daily_report == 1  ) checked @endif/>&nbsp;
                                                                
                                                                <label class="form-check-label fw-semibold" for="daily_report">Send Daily report </label></div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1" name="send_after_task" @if ($alert->send_after_task == 1  ) checked @endif/>&nbsp;
                                                                
                                                                <label class="form-check-label fw-semibold" for="send_after_task">Send email after every task </label></div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div><label class="form-label fw-semibold">Facility</label>
                                                                {{Form::select('facility_id', $facilities, $alert->facility_id, ['class' => 'form-control', 'placeholder' => '-- Select Facility --'])}}
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