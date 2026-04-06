<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Sign Up | {{$settings['Site name']}}</title>
    <link rel="icon" type="image/png" href="{{url('favicon.png')}}">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Gilroy.css">
    <link rel="stylesheet" href="assets/css/Gilroy-RegularItalic.css">
    <link rel="stylesheet" href="assets/css/setup.css?v=1.1">
    <link rel="stylesheet" href="assets/css/styles.css?v=1.1">

    <style>
        .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
font-weight: 500;
}   

.nav-link{
    padding-top: 15px;
    padding-bottom: 15px;
}

.nav-menu span, .dropdown-item2 span{
    padding-top: 3.3px;
}

.dropdown-item .span2{
    padding-top: 3.4px;
    display: inline-block;
}

.page-item .page-link{
    padding-bottom: 0px;
    font-weight: 500;
}

.fw-semibold{
    font-weight: 500 !important;
}

a{
    outline: 0;
}

.nav-menu .nav-link.active {
margin-bottom: 0;
border-left-color: #049FD9;
}

.active > .page-link, .page-link.active {
    background-color:#049FD9;
    border-color:#049FD9;
}

.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active, .nav-tabs .nav-link:hover {
color: #049FD9;
}

.nav-menu .nav-link.active svg path {
  fill: #049FD9;
  stroke: #049FD9;
}

.nav-menu .nav-link:hover svg path {
  stroke: #049FD9;
}

.card-stats{
    --bs-card-height: 165px;
}

.navbar-icon {
--bs-btn-bg: #f1fafe;
--bs-btn-border-color:#f1fafe;
border-color: #f1fafe;
}

.border-primary{
    border-color: #049FD9 !important;
}

.form-control-wrapper .form-control{
}

.form-control {
    padding: .59rem 1rem;
    font-size: 0.9rem;
    margin-bottom: 2px;
}

.btn.disabled, .btn:disabled, fieldset:disabled .btn{
    color: white;
}

.form-label{
    margin-bottom:.1rem;
}
    </style>
</head>

<body data-sidebar-size="wide">
    <section class="vertical-layout">
        <nav class="navbar navbar-expand-md bg-white2 navbar-vertical-layout py-3" style="width:100%; left:0px;">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <a class="navbar-brand d-lg-none ms-2 me-2" href="{{url('/')}}">
                        <img class="h-auto" src="{{url($settings['favicon'])}}" alt="Perfectlum Logo" width="40" height="51">
                    </a>
                    <div class="d-none d-lg-block ms-xl-4">
                        <div class="d-flex align-items-center">
                           <a href="{{url('/')}}">
                          <img class="h-auto" src="{{url($settings['Site logo'])}}" alt="Perfectlum Logo" width="150" height="50">
                           </a>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex align-items-center">
                    
                    <div class="me-2 me-lg-3">
                        <a href="{{url('login')}}"><button type="button" class="btn btn-info rounded-pill btn-sm w me-2">Login</button></a>
                        <a href="{{url('signup')}}"><button type="button" class="btn btn-info rounded-pill btn-sm ">Sign Up</button></a>
                    </div>
                </div>
                
            </div>
        </nav>
        
        <main class="d-flex align-items-center justify-content-center  main-vertical-layout m-auto">
            <div class="container">
                    <div class="row">
                        <div class="col-md-4 m-auto mt-5 mb-5 pb-5">
                            <div class="bg-white border rounded border-info rounded-4 pt-4">
                        <div class="">
                        <h3 class="text-primary text-center mb-0 mt-2 ps-3">Create an Account</h3>
                            </div>
                        <form method="post" class="mx-auto" id="login_form">
                            {{csrf_field()}}
                            
                            <div class="row gy-3 p-4">
                                <div class="col-12">
                                        <label class="form-label fw-semibold">Name</label>
                                        <input class="form-control" type="text" name="fullname" placeholder="" required>
                                </div>

                                <div class="col-12">
                                        <label class="form-label fw-semibold">Email</label>
                                        <input class="form-control" type="email" name="email" placeholder="" required>
                                </div>
                                
                                <div class="col-12">
                                        <label class="form-label fw-semibold">Username</label>
                                        <input class="form-control" type="text" name="username" placeholder="" required autocomplete="off">
                                </div>
                                
                                <div class="col-12">
                                        <label class="form-label fw-semibold">Password</label>
                                        <input class="form-control" type="password" name="password" placeholder="" required id="pass1" autocomplete="off">
                                        <span id="passwordValidationMessage" style="color:red; font-size:14px; line-height:10px;"></span>
                                </div>
                                
                                <div class="col-12">
                                        <label class="form-label fw-semibold">Confirm Password</label>
                                        <input class="form-control" type="password" name="password_confirmation" placeholder="" required id="pass2">
                                        <span id="passwordValidationMessage2" style="color:red; font-size:14px; line-height:10px;"></span>
                                </div>

                                <div class="col-12">
                                        <label class="form-label fw-semibold">Facility Name</label>
                                        <input class="form-control" type="text" name="facility_name" placeholder="" required>
                                </div>
                                
                                <div class="col-12">
                                        <label class="form-label fw-semibold">Workgroup Name</label>
                                        <input class="form-control" type="text" name="workgroup_name" placeholder="" required>
                                </div>
                                
                                <div class="col-12">
                                        <label class="form-label fw-semibold">Timezone</label>
                                        {!! Timezone::selectForm(old('timezone'), '-- Select a timezone --', ['required', 'class' => 'form-control form-select', 'name' => 'timezone', 'id' => 'timezone']) !!}
                                </div>

                                <div class="col-12">
                                    <label class="form-check-label">
                                        <input class="form-checkbox" required type="checkbox" name="tos" id="tos" {{ !old('tos') ?: 'checked' }}>
                                        <span class="form-check-sign"></span>
                                        I agree to the
                                        <a href="https://qubyx.com/en/terms-conditions" target=_blank>terms and conditions</a>.
                                    </label>
                                </div>
                                                       
                                <div class="col-12 mt-3">
                                    <p class="alert alert-danger" id="login_error" style="display:none;">Error.</p>
                                    <p class="alert alert-success" id="login_success" style="display:none;">Success.</p>
                                    <button class="btn btn-info rounded-pill btn-sm mb-3 w-100" id="submit_btn" style="font-size: 17px;">Submit</button>

                                    <center><a href="{{url('login')}}">Already have an Account? Login here.</a></center>
                                </div>
                            </div>
                                                    
                        </form>
                    </div>
                        </div>
                    </div>
            </div>
        </main>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/sidebar.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>-->
    <script src="assets/js/jquery.min.js"></script>
</body>

</html>

<!--<script type="text/javascript" src="https://remote.qbx.info/js/jstz.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.7/jstz.min.js"></script>
<script>
        $(document).ready(function() {
            // Get timezone from browser
            if (!$('#timezone').val()) {
                var tz = jstz.determine();
                var timezone = tz.name();
                $('#timezone').val(timezone).change();
            }
            
            $('#pass1').on('keyup', function() {
                let password = $(this).val();
                let message = '';

                // Check for minimum length
                if (password.length < 6) {
                    message += 'X Password must be at least 6 characters long.<br>';
                }
                
                // Check for at least one uppercase letter
                if (!/[A-Z]/.test(password)) {
                    message += 'X Password must contain at least one uppercase letter.<br>';
                }
                
                // Check for at least one lowercase letter
                if (!/[a-z]/.test(password)) {
                    message += 'X Password must contain at least one lowercase letter.<br>';
                }
                
                // Check for at least one digit
                if (!/[0-9]/.test(password)) {
                    message += 'X Password must contain at least one digit.<br>';
                }
                
                // Check for at least one special character
                if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
                    message += 'X Password must contain at least one special character.<br>';
                }

                // Show validation messages
                $('#passwordValidationMessage').html(message);
                if(message!='') $("#submit_btn").attr('disabled', true);
                else $("#submit_btn").attr('disabled', false);
            });

            $('#pass2').on('keyup', function() {
                let password = $('#pass1').val();
                let confirmPassword = $('#pass2').val();
                let message = '';

                // Check if passwords match
                if (password !== confirmPassword) {
                    message += 'X Passwords do not match.<br>';
                }

                // Show validation messages
                $('#passwordValidationMessage2').html(message);
                if(message!='') $("#submit_btn").attr('disabled', true);
                else $("#submit_btn").attr('disabled', false);
            });
        });   
    </script>

<script>
       $("#login_form").submit(function(e){
       e.preventDefault();
        $("#login_error").hide();
        
        var formData=new FormData(this);
        
        $.ajax({
            url: "{{url('create-account')}}",
            type: "POST",
            data:  formData,
            beforeSend: function(){ //alert('sending');
                $("#submit_btn").attr('disabled', true);
                $("#submit_btn").text('Please wait...');
            },
            contentType: false,
            processData:false,
            success: function(data) { //alert(data);
                //success
                // here we will handle errors and validation messages
                if ( ! data.success) {
                    $("#login_error").text(data.msg);
                    $("#login_error").show();
                    $("#submit_btn").attr('disabled', false);
                    $("#submit_btn").text('Submit');
                } else {
                    // ALL GOOD! just show the success message!
                    //$("#login_success").text(data.msg);
                    //$("#login_success").show();
                    window.location=data.next;
                }
            },
            error: function()  {
                //error
            } 	        
        });
    }); 
</script>   