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

        .ml-auto{
            margin-left: auto;
        }

        .mr-auto{
            margin-right: auto;
        }
    </style>
        <main class="main-vertical-layout">
            <div class="container-fluid">
                <section class="py-2 mb-5" style="width: 100%;">
                    <div class="bg-white border rounded border-info rounded-4 pt-3">
                        <div class="d-flex flex-column justify-content-between align-items-center flex-sm-row px-4 mb-3">
                            
                        </div>
                        <div class="d-flex flex-column justify-content-between align-items-center flex-sm-row px-4 mb-3">
                            <div class="d-inline-block pb-2 border-bottom w-100">
                                <h5 class="text-primary mb-0">Subscription</h5>
                            </div>
                            </div>
                        
                        <form method="post" class="p-4" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">
                    <div class="col-xl-6 ml-auto mr-auto">
                        <div class="row">
                            <div class="col-lg-6 pt-4">
                                <div class="login-form-wrap bg-ash round-6 mb-30 text-left p-3" style="border: 1px solid rgb(4, 159, 217); border-radius:20px;">
                                    <h3 class="fs-36 fw-semibold ls-3 mb-1 ri-user-line"> Monthly Plan</h3>
                                    <p class="mb-20">$2 USD Per Connected Workstation Per Month</p>
                                    <h2 class="fs-30 mb-20" style="color:rgb(4, 159, 217) !important;">$2 <small style="font-size:14px;">/ 1 Month</small></h2>
                                    <form class="login-form" action="#">
                                        
                                        <div class="form-group mb-10">
                                            <button class="btn btn-info rounded-pill" onclick="select_plan(this, '1')" type="button">
                                               Choose Plan
                                            </button>
                                        </div>
                                        </form>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="login-form-wrap bg-ash round-6 mb-30 text-left " style="border: 1px solid rgb(4, 159, 217); border-radius:22px;">
                                    <h5 class="p-2" style="color: white !important; background-color:rgb(4, 159, 217); text-align:center; border-top-left-radius:20px; border-top-right-radius:20px; font-size:15px;">Most Popular <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20" viewBox="0 0 16 17" fill="none"><path d="M6.49994 16.5004C6.34193 16.5012 6.18743 16.4538 6.0571 16.3644C5.92676 16.2751 5.8268 16.1481 5.77057 16.0004L4.52557 12.7629C4.50035 12.6977 4.46178 12.6384 4.41232 12.589C4.36286 12.5395 4.30362 12.5009 4.23838 12.4757L0.999941 11.2298C0.852423 11.1732 0.725541 11.0731 0.63604 10.9429C0.546538 10.8127 0.498626 10.6584 0.498626 10.5004C0.498626 10.3424 0.546538 10.1881 0.63604 10.0579C0.725541 9.92766 0.852423 9.82764 0.999941 9.77103L4.23744 8.52603C4.30268 8.50081 4.36193 8.46224 4.41138 8.41278C4.46084 8.36333 4.49941 8.30408 4.52463 8.23884L5.77057 5.0004C5.82718 4.85288 5.9272 4.726 6.05742 4.6365C6.18764 4.547 6.34193 4.49909 6.49994 4.49909C6.65795 4.49909 6.81225 4.547 6.94246 4.6365C7.07268 4.726 7.1727 4.85288 7.22932 5.0004L8.47432 8.2379C8.49953 8.30314 8.5381 8.36239 8.58756 8.41184C8.63702 8.4613 8.69627 8.49987 8.7615 8.52509L11.9803 9.76353C12.1338 9.82043 12.266 9.92327 12.359 10.058C12.452 10.1928 12.5012 10.3529 12.4999 10.5167C12.4976 10.6719 12.4486 10.8229 12.3595 10.95C12.2703 11.0772 12.1451 11.1746 11.9999 11.2298L8.76244 12.4748C8.6972 12.5 8.63795 12.5386 8.5885 12.588C8.53904 12.6375 8.50047 12.6967 8.47525 12.762L7.22932 16.0004C7.17308 16.1481 7.07312 16.2751 6.94279 16.3644C6.81245 16.4538 6.65796 16.5012 6.49994 16.5004Z" fill="white"></path><path d="M2.74994 6.0004C2.6573 6.0004 2.56684 5.97233 2.49047 5.91989C2.4141 5.86745 2.35541 5.79311 2.32213 5.70665L1.79525 4.33665C1.78383 4.30669 1.76621 4.27948 1.74354 4.25681C1.72086 4.23413 1.69365 4.21651 1.66369 4.20509L0.293691 3.67821C0.207247 3.64493 0.132915 3.58623 0.0804885 3.50986C0.0280618 3.43349 0 3.34303 0 3.2504C0 3.15777 0.0280618 3.06731 0.0804885 2.99094C0.132915 2.91457 0.207247 2.85588 0.293691 2.82259L1.66369 2.29571C1.69362 2.28424 1.72081 2.2666 1.74347 2.24393C1.76614 2.22127 1.78378 2.19408 1.79525 2.16415L2.31744 0.806339C2.34689 0.726403 2.39757 0.656002 2.46402 0.602705C2.53048 0.549407 2.6102 0.515228 2.69463 0.503839C2.79599 0.491518 2.89856 0.513386 2.98608 0.565977C3.0736 0.618567 3.14105 0.69887 3.17775 0.794152L3.70463 2.16415C3.7161 2.19408 3.73374 2.22127 3.75641 2.24393C3.77908 2.2666 3.80626 2.28424 3.83619 2.29571L5.20619 2.82259C5.29263 2.85588 5.36697 2.91457 5.41939 2.99094C5.47182 3.06731 5.49988 3.15777 5.49988 3.2504C5.49988 3.34303 5.47182 3.43349 5.41939 3.50986C5.36697 3.58623 5.29263 3.64493 5.20619 3.67821L3.83619 4.20509C3.80623 4.21651 3.77902 4.23413 3.75635 4.25681C3.73367 4.27948 3.71605 4.30669 3.70463 4.33665L3.17775 5.70665C3.14447 5.79311 3.08578 5.86745 3.00941 5.91989C2.93304 5.97233 2.84258 6.0004 2.74994 6.0004Z" fill="white"></path><path d="M12.4999 8.5004C12.3989 8.50037 12.3002 8.46972 12.2169 8.41248C12.1336 8.35524 12.0696 8.27411 12.0334 8.17978L11.3196 6.32446C11.3071 6.29177 11.2878 6.26208 11.263 6.23732C11.2383 6.21255 11.2086 6.19327 11.1759 6.18071L9.32057 5.46696C9.22631 5.43064 9.14526 5.36663 9.0881 5.28334C9.03094 5.20006 9.00034 5.10142 9.00034 5.0004C9.00034 4.89939 9.03094 4.80074 9.0881 4.71746C9.14526 4.63418 9.22631 4.57016 9.32057 4.53384L11.1759 3.82009C11.2086 3.80753 11.2383 3.78825 11.263 3.76349C11.2878 3.73872 11.3071 3.70903 11.3196 3.67634L12.0281 1.83415C12.0604 1.74704 12.1158 1.67032 12.1882 1.61215C12.2607 1.55399 12.3476 1.51656 12.4396 1.50384C12.5502 1.49045 12.6621 1.51439 12.7576 1.57185C12.8531 1.62931 12.9266 1.71701 12.9665 1.82103L13.6803 3.67634C13.6928 3.70903 13.7121 3.73872 13.7369 3.76349C13.7616 3.78825 13.7913 3.80753 13.824 3.82009L15.6793 4.53384C15.7736 4.57016 15.8546 4.63418 15.9118 4.71746C15.9689 4.80074 15.9995 4.89939 15.9995 5.0004C15.9995 5.10142 15.9689 5.20006 15.9118 5.28334C15.8546 5.36663 15.7736 5.43064 15.6793 5.46696L13.824 6.18071C13.7913 6.19327 13.7616 6.21255 13.7369 6.23732C13.7121 6.26208 13.6928 6.29177 13.6803 6.32446L12.9665 8.17978C12.9302 8.27411 12.8663 8.35524 12.783 8.41248C12.6997 8.46972 12.601 8.50037 12.4999 8.5004Z" fill="white"></path></svg></h5>
                                    <div class="p-3 pt-0">
                                    <h3 class="fs-36 fw-semibold ls-3 mb-1 ri-user-line"> 5 Years</h3>
                                    <p class="mb-20">$24 USD Per Connected Workstation Per Year (Save 2 Months!)</p>
                                    <h2 class="fs-30 mb-20" style="color:rgb(4, 159, 217) !important;">$24 <small style="font-size:14px;">/ 1 Year</small></h2>
                                    <form class="login-form" action="#">
                                        
                                        <div class="form-group mb-10">
                                            <button class="btn btn-info rounded-pill" onclick="select_plan(this, '2')" type="button">
                                               Choose Plan
                                            </button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                        </form>
                    </div>
                </section>
            </div>
        </main>

        <div class="modal fade" role="dialog" tabindex="-1" id="modal-plans">
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
                                                    <h5 class="fw-bold text-primary mb-0" id="modal_plan_title"></h5>
                                                </div><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body py-4">
                                                <form method="post">
                                                    {{csrf_field()}}
                                                    <div class="row gy-4">
                                                        <div class="col-12 col-lg-12">
                                                        <div><label class="form-label fw-semibold">No. of Workstations</label><input class="form-control" type="number" name="workstations"></div>
                                                        </div>
                                                        <div class="col-12 col-lg-12">
                                                        </div>
                                                       
                                                        <div class="col-6">
                                                            <div class="d-grid"><button class="btn btn-outline-info rounded-pill" type="button" data-bs-dismiss="modal">Cancel</button></div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="d-grid"><button class="btn btn-info rounded-pill" type="submit">Subscribe</button></div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

@include('common.navigations.footer');
<script>
    function select_plan(th, plan)
    {
        if(plan=='1')
        {
            $("#modal_plan_title").text('Monthly Plan');
        }
        else
        {
            $("#modal_plan_title").text('5 Years Plan');
        }
        $("#modal-plans").modal('show');
    }

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