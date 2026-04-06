<form method="post">
    {{csrf_field()}}
    <input type="hidden" name="id" value="{{$item->id}}">
                                                    <div class="row gy-4">
                                                        <div class="col-12">
                                                            <div>
                                                                <label class="form-label fw-semibold">Workgroup Name</label>
                                                                {{Form::text('name', $item->name, ['required', 'class' => 'form-control', 'placeholder' => ''])}}
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div>
                                                                <label class="form-label fw-semibold">Address</label>
                                                                {{Form::text('address', $item->address, ['class' => 'form-control', 'placeholder' => ''])}}
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div>
                                                                <label class="form-label fw-semibold">Phone Number</label>
                                                                {{Form::number('phone', $item->phone, ['class' => 'form-control', 'placeholder' => ''])}}
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div>
                                                                <label class="form-label fw-semibold">Facilty</label>
                                                                {{Form::select('facility_id', $facilities, $item->facility_id, ['required', 'class' => 'form-select', 'placeholder' => '-- Select Facility --'])}}
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="d-grid">
                                                                <button class="btn btn-outline-info rounded-pill" type="button" data-bs-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="d-grid">
                                                                <button class="btn btn-info rounded-pill" type="submit">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>