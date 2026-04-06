<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Forgot Password | {{$settings['Site name']}}</title>
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
                        <h3 class="text-primary text-center mb-0 mt-2 ps-3">Reset Password</h3>
                            </div>
                        <form method="post" class="mx-auto" id="login_form">
                            {{csrf_field()}}
                            
                            <div class="row gy-3 p-4" id="reset_box">
                                <div class="col-12">
                                        <label class="form-label fw-semibold">Email / Username</label>
                                        <input class="form-control" type="text" name="email" placeholder="" required>
                                </div>
                                                       
                                <div class="col-12 mt-3">
                                    <p class="alert alert-danger" id="login_error" style="display:none;">Error.</p>
                                    <p class="alert alert-success" id="login_success" style="display:none;">Success.</p>
                                    <button class="btn btn-info rounded-pill btn-sm mb-3 w-100" id="submit_btn" style="font-size: 17px;">Submit</button>

                                    <center><a href="{{url('login')}}">Login now</a></center>
                                </div>
                            </div>

                            <div class="row gy-3 p-4" id="success_box" style="display: none;">
                                <div class="col-12">
                                    <p class="alert alert-success">We have e-mailed you a password reset link! Please follow the email to reset your password.</p>
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
       $("#login_form").submit(function(e){
       e.preventDefault();
        $("#login_error").hide();
        
        var formData=new FormData(this);
        
        $.ajax({
            url: "<?php echo url('reset-password/email') ?>",
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
                console.log(data);
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
                    if(data.success=='passwords.user')
                    {
                        $("#login_error").text("We can't find a user with this e-mail address.");
                        $("#login_error").show();
                        $("#submit_btn").attr('disabled', false);
                        $("#submit_btn").text('Submit');
                    }
                    else
                    {
                        $("#reset_box").hide();
                        $("#success_box").show();
                    }
                    //window.location=data.next;
                }
            },
            error: function()  {
                //error
            } 	        
        });
    }); 
</script>   