<form method="post">
{{csrf_field()}}
    <input type="hidden" name="id" value="{{$item->id}}">
                                                    <div class="row gy-4">
                                                        <div class="col-12">
                                                            <div>
                                                                <label class="form-label fw-semibold">Workstation Name</label>
                                                                {{Form::text('name', $item->name, ['required', 'class' => 'form-control', 'placeholder' => ''])}}
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div>
                                                                <label class="form-label fw-semibold">Workgroup</label>
                                                                {{Form::select('workgroup_id', $workgroups, $item->workgroup_id, ['required', 'class' => 'form-select', 'placeholder' => '-- Select Workgroup --'])}}
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