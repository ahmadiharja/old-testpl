<div class="row gy-3">
                                            
                                            <div class="col-12">
                                                <div>
                                                    <label class="form-label fw-semibold">Select Facility</label>
                                                    <select class="form-select" onchange="fetch_workgroups(this)" id="facilities_field">
                                                        <option value="">Please select</option>
                                                        @foreach($facilities as $facility)
                                                        <option value="{{$facility->id}}" @if($facility_id==$facility->id) selected @endif >{{$facility->name}}</option>
                                                        @endforeach
                                                    </select></div>
                                            </div>
                                            
                                            <div class="col-12">
                                                <div><label class="form-label fw-semibold">Select Workgroup</label>
                                                    <select class="form-select" onchange="fetch_workstations(this)" id="workgroups_field">
                                                        <option value="" >Select facility first</option>
                                                        @foreach($workgroups as $facility)
                                                        <option value="{{$facility->id}}" @if($workgroup_id==$facility->id) selected @endif >{{$facility->name}}</option>
                                                        @endforeach
                                                    </select></div>
                                            </div>
                                            <div class="col-12">
                                                <div><label class="form-label fw-semibold">Select Workstation</label>
                                                    <select class="form-select" onchange="fetch_displays(this)" id="workstations_field">
                                                        <option value="" >Select Workgroup first</option>
                                                        @foreach($workstations as $facility)
                                                        <option value="{{$facility->id}}" @if($workstation_id==$facility->id) selected @endif >{{$facility->name}}</option>
                                                        @endforeach
                                                    </select></div>
                                            </div>
                                            @if($display_id!='-1')
                                            <div class="col-12">
                                                <div><label class="form-label fw-semibold">Select Display</label>
                                                    <select class="form-select" id="displays_field" onchange="fetch_data(this)">
                                                        <option value="" >Select</option>
                                                    </select></div>
                                            </div>
                                            @endif
                                        </div>