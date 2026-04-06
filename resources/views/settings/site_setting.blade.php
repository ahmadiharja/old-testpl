@include('common.navigations.header');
            <style>
.text-black, b, h1, h2, h3, h4, h5, h6, .text-primary{
            color:#313E5B !important;
        }
        
        .form-check-label, .text-muted{
            font-weight:400 !important;
        }

.navbar .form-control {
    padding: .59rem 1.5rem;
    font-size: 0.9rem;
}
        @media only screen and (max-width:996px){
            .site-item {
                margin-top: 10px;
            } 
        }
    </style>
        <main class="main-vertical-layout">
            <div class="container-fluid">
                <section class="py-2 mb-5">
                    <div class="bg-white border rounded border-info rounded-4 pt-3">
                        <div class="d-flex flex-column justify-content-between align-items-center flex-sm-row px-4 mb-3">
                            
                        </div>
                        <div class="d-flex flex-column justify-content-between align-items-center flex-sm-row px-4 mb-3">
                            <div class="d-inline-block pb-2 border-bottom w-100">
                                <h5 class="text-primary mb-0">Site Settings</h5>
                            </div>
                            </div>
                        
                        <form method="post" class="p-4" enctype="multipart/form-data">
                            {{csrf_field()}}
                         <div class="row site p-0 pt-0 pt-md-0 mb-4">
                                    <div class="site-item col-12 col-md-6 d-flex align-items-center mb-4 mb-md-0">
                                        
                                        <figure class="m-0 border border-secondary rounded p-1 d-flex align-items-center justify-content-center" style="width: 125px; height: 125px;">
                                            <img src="{{url($settings['Site logo'])}}" alt="Site Logo" class="img-fluid" id="imagePreview" style="border-radius:5px"/>
                                        </figure>
                                        
                                        <div class=" ms-3">
                                            <input type="file" id="imageUpload" name="site_logo" accept="image/*" style="display: none;" />
                                            <button type="button" class="btn btn-info rounded-pill btn-sm mb-3" onclick="$(this).prev().click();">Choose Image</button><br>
                                            <p class="m-0" style="line-height: 0.8rem;"><small>max file size: 5mb</small></p>
                                            <p class="m-0"><small>jpg|png</small></p>
                                        </div>
                                        
                                    </div> 
                                        
                                    <div class="site-item col-12 col-md-6 d-flex align-items-center">
                                       
                                        <figure class="m-0 border border-secondary rounded p-1 d-flex align-items-center justify-content-center" style="width: 125px; height: 125px;">
                                            <img src="{{url($settings['favicon'])}}" alt="favicon" class="img-fluid" id="favicon_image" style="border-radius:5px"/>
                                        </figure>
                                        
                                        <div class=" ms-3">
                                            <input type="file" id="imageUpload2" name="favicon" accept="image/*" style="display: none;" />
                                            <button type="button" class="btn btn-info rounded-pill btn-sm mb-3" onclick="$(this).prev().click();">Choose Image</button><br>
                                            <p class="m-0" style="line-height: 0.8rem;"><small>max file size: 5mb</small></p>
                                            <p class="m-0"><small>jpg|png</small></p>
                                        </div>
                                        
                                    </div> 
                            </div>
                                    <div class="row gy-4">
                                        
                                        <div class="col-12">
                                            <div>
                                                <label class="form-label fw-semibold">Site Name</label>
                                                <input class="form-control" type="text" id="site-1" name="site" value="{{$settings['Site name']}}" required>
                                            </div>
                                        </div>
                                       
                                        
                                        <div class="col-12 col-md-6">
                                            <div><label class="form-label fw-semibold">Sender Email</label>
                                                <input class="form-control" type="email" id="site-2" name="email"  value="{{$smtp_details->senderemail}}"></div>
                                        </div>
                                        
                                        
                                        <div class="col-12 col-md-6">
                                            <div>
                                                <label class="form-label fw-semibold">Sender Name</label>
                                                <input class="form-control mb-1" type="text" id="site-3" name="sender" value="{{$smtp_details->sendername}}">
                                                <small class="text-muted" data-bs-target="#modal-1" data-bs-toggle="modal">For more SMTP settings, please click <a href="javascript:void(0)">here</a></small>
                                            </div>
                                        </div>
                                       
                                         <div class="col-2">
                                            <div class="d-grid">
                                                <button class="btn btn-info rounded-pill" type="submit" data-bs-dismiss="modal">Apply</button>
                                             </div>
                                        </div>
                                        
                                     </div>
                        </form>
                    </div>
                </section>
            </div>
        </main>

        
        <div class="modal fade" role="dialog" tabindex="-1" id="modal-1">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="d-flex align-items-center"><span class="d-inline-block flex-shrink-0 me-2"><svg width="28" height="30" viewBox="0 0 28 30" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M2.01331 13.96V19.9467C2.01331 25.9334 4.41331 28.3334 10.4 28.3334H17.5866C23.5733 28.3334 25.9733 25.9334 25.9733 19.9467V13.96" stroke="#049FD9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M14 15C16.44 15 18.24 13.0134 18 10.5734L17.12 1.66669H10.8933L9.99999 10.5734C9.75999 13.0134 11.56 15 14 15Z" stroke="#049FD9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M22.4133 15C25.1066 15 27.08 12.8134 26.8133 10.1334L26.44 6.46669C25.96 3.00002 24.6267 1.66669 21.1333 1.66669H17.0667L18 11.0134C18.2267 13.2134 20.2133 15 22.4133 15Z" stroke="#049FD9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M5.51997 15C7.71997 15 9.70663 13.2134 9.91997 11.0134L10.2133 8.06669L10.8533 1.66669H6.78663C3.2933 1.66669 1.95997 3.00002 1.47997 6.46669L1.11997 10.1334C0.853299 12.8134 2.82663 15 5.51997 15Z" stroke="#049FD9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M14 21.6667C11.7733 21.6667 10.6666 22.7734 10.6666 25V28.3334H17.3333V25C17.3333 22.7734 16.2266 21.6667 14 21.6667Z" stroke="#049FD9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</span>
                                                    <h5 class="fw-bold text-primary mb-0">SMTP Settings</h5>
                                                </div><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body py-4">
                                                <form method="post">
                                                    {{csrf_field()}}
                                                    <div class="row gy-4">
                                                        <div class="col-12 col-lg-6">
                                                            <div><label class="form-label fw-semibold">Host</label><input class="form-control" type="text" id="host" name="host" value="{{$smtp_details->host}}" placeholder=""></div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div><label class="form-label fw-semibold">Port</label><input class="form-control" type="text" id="port" name="port" value="{{$smtp_details->port}}" placeholder=""></div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div><label class="form-label fw-semibold">Username</label><input class="form-control" type="text" id="username" name="username" value="{{$smtp_details->username}}" placeholder=""></div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div><label class="form-label fw-semibold">Password</label><input class="form-control" type="text" id="password" name="password" value="{{$smtp_details->password}}" placeholder=""></div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div><label class="form-label fw-semibold">Sender Email</label><input class="form-control" type="text" id="sender_email" name="sender_email" value="{{$smtp_details->senderemail}}" placeholder=""></div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div><label class="form-label fw-semibold">Sender Name</label><input class="form-control" type="text" id="sender_name" name="sender_name" value="{{$smtp_details->sendername}}" placeholder=""></div>
                                                        </div>
                                                       
                                                        <div class="col-6">
                                                            <div class="d-grid"><button class="btn btn-outline-info rounded-pill" type="button" data-bs-dismiss="modal">Cancel</button></div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="d-grid"><button class="btn btn-info rounded-pill" type="submit">Save</button></div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
@include('common.navigations.footer');
<script>
    // JavaScript to handle image preview
    document.getElementById('imageUpload').addEventListener('change', function(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('imagePreview');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    });
    
    // JavaScript to handle image preview
    document.getElementById('imageUpload2').addEventListener('change', function(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('favicon_image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    });
</script>