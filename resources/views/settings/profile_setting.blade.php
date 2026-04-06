@include('common.navigations.header');
   <style>

.navbar .form-control {
    padding: .59rem 1.5rem;
    font-size: 0.9rem;
}
        .btn-danger:hover{
            background-color: white;
            border-color: #049FD9;
            color: #049FD9;
            
}
        
        @media only screen and (max-width:996px)
        {
            .profile_box
            {
                text-align: center;
            }
        }
        
        .text-black, b, h1, h2, h3, h4, h5, h6, .text-primary{
            color:#313E5B !important;
        }
        
        .form-check-label{
            font-weight:400 !important;
        }
    </style>
                                        
        <main class="main-vertical-layout">
            
            <div class="container-fluid">
                <section class="py-2 mb-2">
                    <div class="bg-white border rounded border-info rounded-4 pt-4">
                        <div class="d-flex flex-column justify-content-between align-items-center flex-sm-row px-4 mb-3">
                            <div class="d-inline-block pb-2 border-bottom w-100">
                                <h5 class="text-primary mb-0 ">Edit Profile</h5>
                            </div>
                        </div>
                        
                        
                        
                        <form method="post" action="" class="p-4" enctype="multipart/form-data">
                            {{csrf_field()}}
                         <div class="row site p-0 mb-3 pt-1 pb-0">
                                   
                                    <div class="col-md-12 d-block d-md-flex align-items-center">
                                            <center>
                                            <figure class="m-0 border border-secondary rounded p-0 d-flex align-items-center justify-content-center" style="width: 125px; height: 125px; max-height:125px;">
                                                <img src="{{url($user->profile_image)}}" alt="Site Logo" class="img-fluid" id="profile_image" style="border-radius:5px; width:100%; height:125px; max-height:125px; object-fit:cover;"/></figure>
                                            </center>
                                        <div class="profile_box ms-3">
                                            <p class="mt-2">Profile Picture</p>
                                            <input type="file" id="imageUpload" name="profile_image" accept="image/*" style="display:none;" />
                                            <button type="button"  class="btn btn-info rounded-pill btn-sm mb-3" onclick="$(this).prev().click();">Choose Image</button>
                                            <button type="button" class="btn btn-danger rounded-pill btn-sm mb-3" onclick="remove_image(this)">Remove</button><br>
                                            <p  style="line-height: 0.8rem;"><small>Use JPEG, PNG, or GIF. Best size: 200x200 pixels. Keep it under 5MB</small></p>
                                            
                                        </div>
                                    </div>      
                            </div>
                        
                                    <div class="row gy-4">
                                         
                                        <div class="col-6 col-md-4">
                                            <div><label class="form-label fw-semibold">User Name</label><input class="form-control" type="text" id="site-1" name="username" value="{{$user->name}}" required></div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div><label class="form-label fw-semibold">Password</label><input class="form-control" type="password" id="site-2" name="password" placeholder=""></div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div><label class="form-label fw-semibold">Password Retype</label><input class="form-control" type="password" id="site-2" name="password2" placeholder=""></div>
                                        </div>
                                         <div class="col-6 col-md-6">
                                            <div><label class="form-label fw-semibold">Full Name</label><input class="form-control" type="text" id="site-2" name="fname" value="{{$user->fullname}}"></div>
                                        </div>
                                         <div class="col-6 col-md-6">
                                            <div><label class="form-label fw-semibold">Email</label><input class="form-control" type="email" id="site-2" name="email" value="{{$user->email}}"></div>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <div><label class="form-label fw-semibold">Facility</label><input class="form-control" type="text" id="site-1" name="name" placeholder="danh" disabled></div>
                                        </div>
                                         <div class="col-6 col-md-3">
                                            <div><label class="form-label fw-semibold">Workgroup</label><input class="form-control" type="text" id="site-1" name="name" placeholder="qbx rad" disabled></div>
                                        </div>
                                         <div class="col-6 col-md-3">
                                            <div><label class="form-label fw-semibold">User Level</label><input class="form-control" type="text" id="site-1" name="name" placeholder="Admin" disabled></div>
                                        </div>
                                         <div class="col-12 col-md-3">
                                            <div><label class="form-label fw-semibold">Timezone</label><input class="form-control" type="text" id="site-1" name="name" placeholder="Asia/Jakrata" disabled></div>
                                        </div>
                                        
                                         <div class="col-md-3">
                                            <div class="d-grid"><button class="btn btn-info btn-sm rounded-pill" type="submit" data-bs-dismiss="modal">Save Changes</button></div>
                                        </div>              
                                     </div>
                        </form>
                    </div>
                </section>
                 <section class="py-0 mb-5">
                    <div class="bg-white border rounded border-info rounded-4 pt-4">
                        <div class="d-flex flex-column justify-content-between align-items-center flex-sm-row px-4 mb-3">
                            <div class="d-inline-block pb-2 border-bottom w-100">
                                <h4 class="text-primary mb-0 ">Credentials To Connect The Workstations</h4>
                            </div>
                            
                        </div>
                        
                        <form method="post" action="" class="p-4">
                            {{csrf_field()}}
                                    <div class="row gy-4">
                                        <div class="col-6">
                                            <div><label class="form-label fw-semibold">Remote User</label>
                                                <input class="form-control" type="text" id="site-1" name="remote_user" value="{{$user->sync_user}}"></div>
                                        </div>
                                        
                                        <div class="col-6">
                                                            <div class=""><label class="form-label fw-semibold">Remote Password</label>
                                                                <div class="input-group">
                                                                    <div class="w-100 input-group-text form-control-wrapper form-control-icon-start form-control-icon-end position-relative p-0">
                                                                        <input class="form-control w-100" type="text" name="remote_password" value="{{$user->sync_password_raw}}" placeholder="" id="remote_password">
                                                                        <span class="position-absolute position-absolute-end top-50 translate-middle-y">
                                                                            <a href="javascript:void(0)" onclick="copy_field('#remote_password')">
                                                                         <svg width="17" height="17" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M12.6666 10.2122V13.5372C12.6666 16.308 11.5583 17.4163 8.78742 17.4163H5.46242C2.69159 17.4163 1.58325 16.308 1.58325 13.5372V10.2122C1.58325 7.44134 2.69159 6.33301 5.46242 6.33301H8.78742C11.5583 6.33301 12.6666 7.44134 12.6666 10.2122Z" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M17.4166 5.46217V8.78717C17.4166 11.558 16.3083 12.6663 13.5374 12.6663H12.6666V10.2122C12.6666 7.44134 11.5583 6.33301 8.78742 6.33301H6.33325V5.46217C6.33325 2.69134 7.44158 1.58301 10.2124 1.58301H13.5374C16.3083 1.58301 17.4166 2.69134 17.4166 5.46217Z" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</a>
                                                                        </span></div>
                                                                  
                                                                </div>
                                                            </div>
                                        </div>
                                        
                           
                                         <div class="col-md-2">
                                            <div class="d-grid"><button class="btn btn-info btn-sm rounded-pill" type="submit" data-bs-dismiss="modal">Update</button></div>
                                        </div>
                                         <div class="col-md-3">
                                            <div class="d-grid"><button class="btn btn-dark btn-sm rounded-pill" type="button" onclick="generate_password()" data-bs-dismiss="modal" style="background-color:#32505B;">Generate Password</button></div>
                                        </div>
                                     </div>
                        </form>
                    </div>
                </section>
            </div>
        </main>
@include('common.navigations.footer');
<script>
    function generate_password(length = 9)
    {
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let result = '';
    for (let i = 0; i < length; i++) {
        result += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    $("#remote_password").val(result);
    //return result;
    }
    // JavaScript to handle image preview
    document.getElementById('imageUpload').addEventListener('change', function(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('profile_image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    });
    
    function remove_image(th){
        
        var formData=new FormData();
        formData.append('_token', '{{csrf_token()}}');
        
        $.ajax({
            url: "<?php echo url('remove-image') ?>",
            type: "POST",
            data:  formData,
            beforeSend: function(){ //alert('sending');
                $("#submit_btn").attr('disabled', true);
            },
            contentType: false,
            processData:false,
            success: function(data) { //alert(data);
                //success
                // here we will handle errors and validation messages
                if ( ! data.success) {
                } else {
                    // ALL GOOD! just show the success message!
                    window.location='';
                }
            },
            error: function()  {
                //error
            } 	        
        });
        
    }
</script>