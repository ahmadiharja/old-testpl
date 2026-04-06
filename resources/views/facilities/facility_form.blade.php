 <form method="post">
     {{csrf_field()}}
                     <input type="hidden" name="id" value="{{$item->id}}">
                                                <div class="row gy-4">
                                                        <div class="col-12">
                                                            <div><label class="form-label fw-semibold">facility Name</label>
                                                                {{Form::text('name', $item->name, ['required', 'class' => 'form-control', 'placeholder' => 'Facility name'])}}
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div><label class="form-label fw-semibold">Description</label>
                                                                {{Form::text('description', $item->description, ['class' => 'form-control', 'placeholder' => 'Description'])}}
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div><label class="form-label fw-semibold">Location</label>
                                                                {{Form::text('location', $item->location, ['class' => 'form-control', 'placeholder' => 'Location'])}}
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div><label class="form-label fw-semibold">Timezone</label>
                                                                {!! Timezone::selectForm($item->timezone, '-- Select a timezone --', ['required' => 'true', 'class' => 'form-control', 'name' => 'timezone', 'id' => 'timezone']) !!}
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