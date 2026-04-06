<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login | {{$settings['Site name']}}</title>
    <link rel="icon" type="image/png" href="{{url('favicon.png')}}">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Gilroy.css">
    <link rel="stylesheet" href="assets/css/Gilroy-RegularItalic.css">
    <link rel="stylesheet" href="assets/css/setup.css?v=1.1">
    <link rel="stylesheet" href="assets/css/styles.css?v=1.1">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
    margin-bottom: 0px;
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
                        <div class="col-md-4 m-auto mt-5">
                            <div class="bg-white border rounded border-info rounded-4 pt-4">
                        <div class="">
                        <h3 class="text-primary text-center mb-0 mt-2 ps-3">Welcome back!</h3>
                            </div>
                        <form method="post" class="mx-auto" id="login_form">
                            {{csrf_field()}}
                            
                            <div class="row gy-3 p-4">
                                <div class="col-12">
                                        <label class="form-label fw-semibold">Email / Username</label>
                                        <input class="form-control" type="text" name="email" placeholder="" required>
                                </div>
                                
                                <div class="col-12">
                                        <label class="form-label fw-semibold">Password</label>
                                        <div class="input-group">
                                            <div class="w-100 input-group-text form-control-wrapper form-control-icon-start form-control-icon-end position-relative p-0">
                                                <input class="form-control" type="password" name="password" placeholder="" required>
                                                <span class="position-absolute position-absolute-end top-50 translate-middle-y" onclick="show_pass(this)"><i class="fa fa-eye"></i></span>
                                            </div> 
                                        </div>
                                        <div class="text-right" style="text-align: right;">
                                            <a href="{{url('forgot-password')}}">Forgot Password?</a>
                                        </div>
                                </div>
                                
                                <div class="col-12">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="checkbox" name="remember" value="1" id="formCheck-4">
                                            <label class="form-check-label fw-semibold" for="formCheck-4">Remember me</label>
                                        </div>
                                </div>
                                                       
                                <div class="col-12 mt-3">
                                    <p class="alert alert-danger" id="login_error" style="display:none;">Error.</p>
                                    <p class="alert alert-success" id="login_success" style="display:none;">Success.</p>
                                    <button class="btn btn-info rounded-pill btn-sm mb-3 w-100" id="submit_btn" style="font-size: 17px;">Login</button>

                                    <center><a href="{{url('signup')}}">Create an Account</a></center>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</body>

</html>

<script>
    function show_pass(th)
    {
        var passwordField = $(th).prev();
        var fieldType = passwordField.attr('type') === 'password' ? 'text' : 'password';
        passwordField.attr('type', fieldType);
        $(th).children('i').toggleClass('fa-eye fa-eye-slash');
    }

       $("#login_form").submit(function(e){
       e.preventDefault();
        $("#login_error").hide();
        
        var formData=new FormData(this);
        
        $.ajax({
            url: "<?php echo url('login') ?>",
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
                    $("#submit_btn").text('Login');
                } else {
                    // ALL GOOD! just show the success message!
                    $("#login_success").text(data.msg);
                    $("#login_success").show();
                    window.location=data.next;
                }
            },
            error: function()  {
                //error
            } 	        
        });
    }); 
</script>   