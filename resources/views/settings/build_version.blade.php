@include('common.navigations.header')
        
        <main class="main-vertical-layout">
            <div class="container-fluid">
                <section class="py-4">
                    
                    <div>
                    <div class="bg-white border rounded border-info rounded-4 pt-4">
                        <div class="d-flex flex-column justify-content-between align-items-center flex-sm-row px-4 mb-3">
                            <div>
                                <h5 class="text-primary mb-0">Build New Version</h5>
                            </div>
                        </div>
                        
                        <div>
                            <div class="card2" style="padding-left:10px; padding-right:10px;">
                            <hr class="mb-0">
                                        </div>
                                        <div class="tab-content mt-2">

                                            <div class="tab-pane p-4 active" role="tabpanel" id="tab-3">
                                            <form method="post" action="{{url('create-build')}}">
                                                {{csrf_field()}}
                                                    <div class="row gy-3">
                                                        
                                                        <div class="row mt-2">
                                                         <div class="col-12 col-md-6">
                                                            <table class="table table-bordered">
                                                                <thead></thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Current version</td>
                                                                        <td>
                                                                            <span id="current_version">{{CommonHelper::appVersion('')}}</span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Next version</td>
                                                                        <td>
                                                                        <span id="next_version" style="color:green"></span>
                                                                        <input type="hidden" name="next_version" id="hidden_next_version" />
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        
                                                       <div class="col-12 mb-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" value="build" name="type" checked id="build"/>&nbsp;
                                                                <label class="form-check-label fw-semibold" for="build">Build Number</label>
                                                            </div>
                                                        </div>
                                                        
                                                       <div class="col-12 mb-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" value="minor" name="type" id="build2"/>&nbsp;
                                                                <label class="form-check-label fw-semibold" for="build2">Minor</label>
                                                            </div>
                                                        </div>
                                                        
                                                       <div class="col-12 mb-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" value="major" name="type" id="build3"/>&nbsp;
                                                                <label class="form-check-label fw-semibold" for="build3">Major</label>
                                                            </div>
                                                        </div>
                                                        
                                                       <div class="col-12 col-lg-6 mb-3">
                                                            <div class="form-check">
                                                                <textarea class="form-control" name="comment" id="comment" placeholder="Enter Build Comment..."></textarea>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-12 col-lg-12">
                                                        <button class="btn btn-info rounded-pill btn-sm mb-3" type="submit" id="smtp-update">Update</button>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>
                                       
                    </div>
                        </div>
                    </div>
                    </div>
                </section>
            </div>
        </main>

@include('common.navigations.footer')
<script>
    $(document).ready(function() {
        
        $('input[type=radio][name=type]').change(function() {
            var current_version = $('#current_version').html();
            var v = current_version.split('.');
            if (this.value == 'build') {
                v[2] = parseInt(v[2]) + 1;
            } else if (this.value == 'minor') {
                v[1] = parseInt(v[1]) + 1;
                v[2] = 0;
            } else if (this.value == 'major') {
                v[0] = parseInt(v[0]) + 1;
                v[1] = v[2] = 0;
            }
            $('#next_version').html(v[0]+'.'+v[1]+'.'+v[2]);
            $('#hidden_next_version').val($('#next_version').html());
        });

        $('#build').trigger('change');
    });
</script>
