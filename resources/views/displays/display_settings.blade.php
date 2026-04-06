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

.card .nav-tabs .nav-link{
    font-weight:300;
}

.card .nav-tabs .nav-link.active {
    font-weight:500;
}

.input-group-text{
    background-color:inherit;
}

.card .nav-tabs .nav-link:hover {
color: var(--bs-nav-tabs-link-active-color);
background-color: var(--bs-nav-tabs-link-active-bg);
border-color: var(--bs-nav-tabs-link-active-border-color);
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
        
        .text-right{
            text-align:right;
        }
    </style>
         <main class="main-vertical-layout">
            <div class="container-fluid">
                <section class="py-4">
                    <div class="row gy-4">
                        <div class="col-12 col-xl-4">
                            <div class="card card-light">
                                <div class="card-body">
                                    <h5 class="card-title">Select a Display</h5>
                                    <hr>
                                    <form method="post">
                                        @include('common.new_tree')
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xl-8">
                            <div class="card card-light">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                                        <div><h5 class="card-title">Display Settings</h5></div>
                                        <div class="text-right" id="display_name">
                                            
                                        </div>
                                    </div>
                                    <hr class="mb-0">
                                    <div>
                                        <ul class="nav nav-tabs nav-tabs-settings" role="tablist">
                                            <li class="nav-item" role="presentation"><a class="nav-link active" role="tab" data-bs-toggle="tab" href="#tab-1" onclick="$('#expense_chart').hide()">Settings</a></li>
                                            <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-2" onclick="$('#expense_chart').show()">Financial Status</a></li>
                                        </ul>
                                        <div class="tab-content mt-3">
                                            <div class="tab-pane active" role="tabpanel" id="tab-1">
                                                <form method="post" id="displaysetting">
                                                    {{csrf_field()}}
                                                <div class="row gy-3">
                                                        <div class="col-12">
                                                            <div><label class="form-label fw-semibold">Ignore Display</label>
                                                                <div class="form-check mb-0">
                                                                    <input class="form-check-input" type="checkbox" name="exclude" id="exclude" value="1">
                                                                    <label class="form-check-label fw-semibold" for="exclude">Exclude Display from Testing / Calibration</label></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div><label class="form-label fw-semibold">Calibration Upload</label>
                                                                
                                                                <div class="form-check mb-0">
                                                                    <input class="form-check-input" type="checkbox" id="CommunicationType" name="CommunicationType" value="1">
                                                                    <label class="form-check-label fw-semibold" for="CommunicationType">Use graphicboard LUTs only</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div><label class="form-label fw-semibold">Save Calibration to</label>
                                                                
                                                                <select class="form-select" id="lut_names" name="CurrentLUTIndex">
                                                                </select>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div><label class="form-label fw-semibold">Used Sensor</label>
                                                                <div class="form-check mb-0">
                                                                    <input class="form-check-input" type="checkbox" id="InternalSensor" name="InternalSensor" value="1">
                                                                    <label class="form-check-label fw-semibold" for="InternalSensor">Use internal sensor if possible</label></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div>
                                                                <label class="form-label fw-semibold">Display Model</label>
                                                                <input class="form-control" type="text" id="Model" name="Model" value="" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div>
                                                                <label class="form-label fw-semibold">Display Serial Number</label>
                                                                <input class="form-control" type="text" id="SerialNumber" name="SerialNumber" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div>
                                                                <label class="form-label fw-semibold">Display Manufacturer</label>
                                                                <input class="form-control" type="text" id="Manufacturer" name="Manufacturer" value="" >
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div><label class="form-label fw-semibold">Inventory Number</label>
                                                                <input class="form-control" type="text" id="InventoryNumber" name="InventoryNumber" value=""></div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div><label class="form-label fw-semibold">Type of Display</label>
                                                                <select class="form-select" name="display_type" id="TypeOfDisplay" name="TypeOfDisplay">
                                                                </select>
                                                               
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div><label class="form-label fw-semibold">Display Technology</label>
                                                                
                                                                <select class="form-select" id="DisplayTechnology" name="DisplayTechnology">
                                                                </select>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div><label class="form-label fw-semibold">Screen Size</label>
                                                                <input class="form-control" type="text" id="ScreenSize" name="ScreenSize" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div><label class="form-label fw-semibold">Revolution (h/v)</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-text form-control-wrapper form-control-icon-start form-control-icon-end position-relative p-0">
                                                                        <input class="form-control" type="text" autocomplete="off" id="ResolutionHorizontal" name="ResolutionHorizontal" value="" >
                                                                        <span class="position-absolute position-absolute-end top-50 translate-middle-y">px</span></div><span class="bg-transparent input-group-text">X</span>
                                                                    <div class="input-group-text form-control-wrapper form-control-icon-start form-control-icon-end position-relative p-0">
                                                                        <input class="form-control" type="text" autocomplete="off" id="ResolutionVertical" name="ResolutionVertical" value="">
                                                                        <span class="position-absolute position-absolute-end top-50 translate-middle-y">px</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div><label class="form-label fw-semibold">Backlight Stabilization</label>
                                                               
                                                                <select class="form-select" id="BacklightStabilization" name="BacklightStabilization">
                                                                </select>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div>
                                                                <label class="form-label fw-semibold">Installation Date</label>
                                                                {{Form::date('InstalationDate',null,['class' => 'form-control'])}}
                                                            </div>
                                                        </div>
                                                    
                                                        @if($role!='user')
                                                    <div class="col-12 col-lg-6 mt-3">
                                                        <button class="btn btn-info rounded-pill btn-sm mb-3" type="button" id="display_save">Save Changes</button>
                                                    </div>
                                                    @endif
</div>
                                                </form>
                                            </div>
                                            <div class="tab-pane" role="tabpanel" id="tab-2">
                                                <form method="post" id="financial_f">
                                                    {{csrf_field()}}
                                                <div class="row gy-3">
                                                       
                                                       <div class="col-12 col-lg-6">
                                                           <div>
                                                               <label class="form-label fw-semibold">Date Of Purchase / Lease:</label>
                                                               <!--<input class="form-control" type="date" value="">-->
                                                               {{Form::date('purchase_date', null, ['required', 'class' => 'form-control'])}}
                                                           </div>
                                                       </div>
                                                       <div class="col-12 col-lg-6">
                                                           <div><label class="form-label fw-semibold">Initial Value: </label>
                                                               <!--<input class="form-control" type="text" value="">-->
                                                               {{Form::text('initial_value', null, ['required', 'class' => 'form-control'])}}
                                                           </div>
                                                       </div>
                                                       <div class="col-12 col-lg-6">
                                                           <div><label class="form-label fw-semibold">Expected value at warranty period end: </label>
                                                               <!--<input class="form-control" type="text" value="">-->
                                                               {{Form::text('expected_value', null, ['class' => 'form-control'])}}
                                                            </div>
                                                       </div>
                                                       <div class="col-12 col-lg-6">
                                                           <div><label class="form-label fw-semibold">Annual straight line depreciation: </label>
                                                               <!--<input class="form-control" type="text" value="">-->
                                                               {{Form::text('annual_straight_line', null, ['class' => 'form-control'])}}
                                                            </div>
                                                       </div>
                                                       <div class="col-12 col-lg-6">
                                                           <div><label class="form-label fw-semibold">Monthly straight line depreciation: </label>
                                                               <!--<input class="form-control" type="text" value="" placeholder="">-->
                                                               {{Form::text('monthly_straight_line', null, ['class' => 'form-control'])}}
                                                            </div>
                                                       </div>
                                                        <div class="col-12 col-lg-6">
                                                           <div><label class="form-label fw-semibold">Current value:</label>
                                                               <!--<input class="form-control" type="text" value="" placeholder="">-->
                                                               {{Form::text('current_value', null, ['class' => 'form-control'])}}
                                                            </div>
                                                       </div>
                                                       <div class="col-12 col-lg-6">
                                                           <div><label class="form-label fw-semibold">Expected replacement date:</label>
                                                               <!--<input class="form-control" type="date" value="">-->
                                                               {{Form::date('expected_replacement_date', null, ['class' => 'form-control'])}}
                                                            </div>
                                                       </div>
                                                       @if($role!='user')
                                                       <div class="col-12 col-lg-12 mt-3">
                                                       <button class="btn btn-info rounded-pill btn-sm mb-3" type="button" id="save-financial">Save Changes</button>
                                                       </div>
                                                       @endif
                                                   </div>
                                                </form>
                                               
                                            </div>
                                            
                                        </div>
                                       
                                    </div><!--tab end-->
                                    
                                </div>
                               
                            </div>
                        </div>
                         <section class="py-2 d-none" id="expense_chart" style="display:none;">
                            <div class="row d-flex justify-content-end">
                            <div class="col-12 col-xl-8">
                                <div class="card card-light">   
                                    <div class="card-header">
                                 <h4 class="text-primary mb-0">Depreciation Expense</h4>
                                    </div>
                                    <div class="card-body ">
                                     <div><canvas data-bss-chart="{&quot;type&quot;:&quot;line&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;0&quot;,&quot;50&quot;,&quot;100&quot;,&quot;150&quot;,&quot;200&quot;,&quot;250&quot;,&quot;300&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Red Correction&quot;,&quot;backgroundColor&quot;:&quot;transparent&quot;,&quot;borderColor&quot;:&quot;#eb5757&quot;,&quot;data&quot;:[&quot;4500&quot;,&quot;5300&quot;,&quot;6250&quot;,&quot;7800&quot;,&quot;9800&quot;,&quot;15000&quot;],&quot;fill&quot;:false,&quot;borderWidth&quot;:&quot;1&quot;},{&quot;label&quot;:&quot;Green Correction&quot;,&quot;backgroundColor&quot;:&quot;transparent&quot;,&quot;borderColor&quot;:&quot;#27ae60&quot;,&quot;data&quot;:[&quot;4500&quot;,&quot;6300&quot;,&quot;6250&quot;,&quot;8800&quot;,&quot;9800&quot;,&quot;18000&quot;],&quot;fill&quot;:false,&quot;borderWidth&quot;:&quot;1&quot;},{&quot;label&quot;:&quot;Blue Correction&quot;,&quot;backgroundColor&quot;:&quot;transparent&quot;,&quot;borderColor&quot;:&quot;#049fd9&quot;,&quot;data&quot;:[&quot;2500&quot;,&quot;4300&quot;,&quot;5250&quot;,&quot;6800&quot;,&quot;8800&quot;,&quot;12000&quot;],&quot;fill&quot;:false,&quot;borderWidth&quot;:&quot;1&quot;}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:true,&quot;legend&quot;:{&quot;display&quot;:true,&quot;labels&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;,&quot;fontColor&quot;:&quot;#808080&quot;},&quot;position&quot;:&quot;top&quot;,&quot;reverse&quot;:false},&quot;title&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;,&quot;display&quot;:false},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;gridLines&quot;:{&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;drawOnChartArea&quot;:false},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#808080&quot;,&quot;fontStyle&quot;:&quot;normal&quot;,&quot;beginAtZero&quot;:true}}],&quot;yAxes&quot;:[{&quot;gridLines&quot;:{&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;drawOnChartArea&quot;:false},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#808080&quot;,&quot;fontStyle&quot;:&quot;normal&quot;,&quot;beginAtZero&quot;:true}}]}}}"></canvas></div>
                                    </div>
                                    </div>
                            </div>
                                </div>
                        </section> 
                        
                    </div>
                   
                </section>
            </div>
        </main>
@include('common.navigations.footer');

<script>
    $(document).ready(function(){
        //fetch_data("#displays_field", '{{$display_id}}');
        loadDisplay('{{$display_id}}');
        
        fetch_displays("#workstations_field");
        setTimeout(function(){
            $("#displays_field").val('{{$display_id}}');
        }, 500);
        setTimeout(function(){
            $("#displays_field").val('{{$display_id}}');
        }, 1000);
    });

    function loadDisplay(display_id) {
        var formData=new FormData();
        formData.append('_token', '{{csrf_token()}}');
        formData.append('id', display_id);
        
         $.ajax({
            url: "{{ url('displaysettings') }}/"+display_id,
            type: "POST",
            data:  formData,
            beforeSend: function(){ //alert('sending');
            },
            contentType: false,
            processData:false,
            success: function(data) { //alert(data);
                $('#display_name').html('Display: ' + data.data.treeText);
                fillForm(data);
                // set value for Monitor 
                $('#vResolutionHorizontal').text($('#ResolutionHorizontal').val() + "x" + $('#ResolutionVertical').val());
                $('#displayModel').text($('#Model').val());
                $('#displaySerial').text($('#SerialNumber').val());
            },
            error: function()  {
                //error
            } 	        
        });
    }

    // save button
  $('#display_save').on('click',function(obj,data){
    
    var displayid = '';
    displayid = '{{$display_id}}';
    
    if (displayid != ''){
          var submitData = $('#displaysetting').serialize();
 
          //$.LoadingOverlay("show");
          $.ajax({
            type: "POST",
            data: submitData ,
            url:  "{{url('displaysettings/save')}}/" + displayid,
            success: function(data){
              //$.LoadingOverlay("hide");
              $('#vResolutionHorizontal').text($('#ResolutionHorizontal').val() + "x" + $('#ResolutionVertical').val());
              $('#displayModel').text($('#Model').val());
              $('#displaySerial').text($('#SerialNumber').val());
              var old_display_name = $('#display_name').html();
              var new_display_name = old_display_name.substring(0, old_display_name.indexOf('(')) + " (" + $('#SerialNumber').val() + ")";
                  ///display_name
              $('#display_name').html(new_display_name);

                notify('success', 'Data saved successfully!');
              // reload tree view
              reloadTree();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                if (xhr.status == 422) {
                    showValidationErrors(xhr.responseJSON);
                }
                //$.LoadingOverlay("hide");
                notify('error', 'Error occurs.');
                // call custom function                
            }
          });
    }
    else {
      alert('Please select a display!');
      
      return false;
    }
  });

  $('#save-financial').on('click',function(obj,data){
    
    var displayid = '';
    displayid = '{{$display_id}}';
    
    if (displayid != ''){
        
        var purchaseDate = $('#financial_f input[name="purchase_date"]').val();

if (!purchaseDate) {
    alert('Please select a purchase date!');
    return false;
}

var purchaseDate = $('#financial_f input[name="initial_value"]').val();

if (!purchaseDate) {
    alert('Please enter initial value!');
    return false;
}
          
          //let disabled = $('#financial_f').find(":input:disabled").removeAttr("disabled");
          var submitData = $('#financial_f').serialize();
          //disabled.attr("disabled", "disabled");

          //$.LoadingOverlay("show");
          $.ajax({
            type: "POST",
            data: submitData ,
            url:  "{{url('displaysettings/save/finance')}}/" + displayid,
            success: function(data){
              //$.LoadingOverlay("hide");              
              console.log(data);
              notify('success', 'Data saved successfully!');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                if (xhr.status == 422) {
                    showValidationErrors(xhr.responseJSON);
                }
                //$.LoadingOverlay("hide");
                notify('error', 'Error occurs.');
                // call custom function
                 
            }
          });
    }
    else {
      alert('Please select a display!');
      
      return false;
    }
  });
    
    function fetch_data(th, id=0){
        var display_id=$(th).val();
        if(id!=0) display_id=id;

        if(display_id=='') return false;
        window.location="{{url('display-settings')}}/"+display_id;

        //loadDisplay(display_id);
        return true;
        
        var formData=new FormData();
        formData.append('_token', '{{csrf_token()}}');
        formData.append('id', display_id);
        
         $.ajax({
            url: "{{ url('fetch-data-settings') }}",
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
                    $("#settings_form_box").empty();
                    $("#settings_form_box").append(data.content);
                    
                    $("#financial_form_box").empty();
                    $("#financial_form_box").append(data.financial);
                    
                    $("#display_name").empty();
                    $("#display_name").append(data.display);
                    
                }
            },
            error: function()  {
                //error
            } 	        
        });
    }
    
     function fetch_workgroups(th){
       var id=$(th).val();
            
                var formData=new FormData();
                formData.append('_token', '{{csrf_token()}}');
               formData.append('id', id);
                
                
                $.ajax({
            url: "{{ url('fetch-groups') }}",
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
                    $("#workgroups_field").empty();
                    $("#workgroups_field").append(data.content);
                }
            },
            error: function()  {
                //error
            } 	        
        });
 }
    
    function fetch_workstations(th){
        var id=$(th).val();
        
        var formData=new FormData();
        formData.append('_token', '{{csrf_token()}}');
        formData.append('id', id);
        
        $.ajax({
            url: "{{ url('fetch-workstations') }}",
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
                    $("#workstations_field").empty();
                    $("#workstations_field").append(data.content);
                }
            },
            error: function()  {
                //error
            } 	        
        });
    }
    
    function fetch_displays(th){
        var id=$(th).val();
        
        var formData=new FormData();
        formData.append('_token', '{{csrf_token()}}');
        formData.append('id', id);
        
        $.ajax({
            url: "{{ url('fetch-displays') }}",
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
                    $("#displays_field").empty();
                    $("#displays_field").append(data.content);
                }
            },
            error: function()  {
                //error
            } 	        
        });
    }
</script>