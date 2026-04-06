@include('common.navigations.header')
@php
$load_ws_id=2252;
@endphp

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
<style>
  .divSaveMode{
    display: none;
  }
</style>

          <main class="main-vertical-layout">
            <div class="container-fluid">
                <section class="py-4">
                    <div class="row gy-4">
                        <div class="col-12 col-xl-4 d-none">
                            <div class="card card-light">
                                <div class="card-body">
                                    <h5 class="card-title">Select Workstation</h5>
                                    <hr>
                                        <div class="row gy-3">
                                            
                                            <div class="col-12">
                                              <div>
                                                <label class="form-label fw-semibold">Select Facility</label>
                                                <select class="form-select" name="facility" onchange="fetch_workgroups(this);" required>
                                                  <option value="">Please select</option>
                                                  @if (!$user->hasRole('super') )
                                                  @foreach($facilities as $fc)
                                                  <option value="{{$fc['id']}}">{{$fc['name']}}</option>
                                                  @endforeach
                                                  @else
                                                  @foreach($facilities as $fc)
                                                  <option value="{{$fc->id}}">{{$fc->name}}</option>
                                                  @endforeach
                                                  @endif
                                                </select>
                                              </div>
                                            </div>
                                            <div class="col-12">
                                                <div>
                                                  <label class="form-label fw-semibold">Select Workgroup</label>
                                                <select class="form-select" name="workgroup" id="workgroups_field" onchange="fetch_workstations(this)" required>
                                                  <option value="" >Select Facility first</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div>
                                                  <label class="form-label fw-semibold">Select Workstation</label>
                                                <select class="form-select" name="workstation" id="workstations_field" onchange="loadWorkstation('ws-'+this.value+'_anchor')" required>
                                                  <option value="" >Select Workgroup first</option>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xl-8">
                            <div class="card card-light">
                                <div class="card-body">
                                    <div>
                                        <ul class="nav nav-tabs nav-tabs-settings mb-4" role="tablist">
                                            <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-11">Application</a></li>
                                            <li class="nav-item" role="presentation"><a class="nav-link active" role="tab" data-bs-toggle="tab" href="#tab-2">Display Calibration</a></li>
                                             <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-31">Quality Assuarance</a></li>
                                             <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-41">Location</a></li>
                                        </ul>
                                        <div class="tab-content mt-2">
                                            <div class="tab-pane" role="tabpanel" id="tab-1">
                                                <form id="application">
                                                  {{csrf_field()}}
                                                  <input type="hidden" id="ws-app-id" name="ws-app-id" value="">
                                                    <div class="row gy-3">
                                                        <div class="col-12 col-lg-6">
                                                            <div><label class="form-label fw-semibold">Workgroup</label>
                                                                <select class="form-control" id="workgroup_id" name="workgroup_id">
                                                                    <option></option>
                                                                </select>
                                                                </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div><label class="form-label fw-semibold">Units of Length</label>
                                                                <select class="form-control" id="units" name="units">
                                                                    <option></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-12 col-lg-6">
                                                            <div><label class="form-label fw-semibold">Units of Luminanace</label>
                                                                <select class="form-control" id="LumUnits" name="LumUnits">
                                                                    <option></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                         <div class="col-12 col-lg-6">
                                                            <div><label class="form-label fw-semibold">Veiling Luminance</label>
                                                                <div class="input-group">
                                                                    <div class="w-100 input-group-text form-control-wrapper form-control-icon-start form-control-icon-end position-relative p-0">
                                                                        <input type="text" class="form-control" id="AmbientLight" name="AmbientLight" placeholder=""> &nbsp;&nbsp;
                                                                      
                                                                        <span class="position-absolute position-absolute-end top-50 translate-middle-y UnitsOfLuminanceText">cd/m<sup>2</sup></span></div>
                                                                        <span class="error-AmbientLight error text-danger"></span>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>
                                                       
                                                        <div class="col-12 col-lg-6">
                                                            <div><label class="form-label fw-semibold">Ambient Conditions Stable</label>
                                                               <select class="form-control" id="AmbientStable" name="AmbientStable">
                                                                    <option></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div>
                                                        <div class="form-check form-switch mb-0">
                                                            <input class="form-check-input rounded-pill" type="checkbox" value="1" name="PutDisplaysToEnergySaveMode" id="PutDisplaysToEnergySaveMode">
                                                            
                                                            <label class="form-check-label fw-semibold" for="formCheck-1">Enable Display Energy Save Mode</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <div class="col-12 col-lg-6 divSaveMode">
                                                            <div><label class="form-label fw-semibold">Start Energy Save Mode:</label>
                                                                {{Form::text('StartEnergySaveMode', '' ,['class' => 'form-control timepicker','id' => 'StartEnergySaveMode'])}}
                                                             </div>
                                                        </div>
                                                         <div class="col-12 col-lg-6 divSaveMode">
                                                            <div><label class="form-label fw-semibold">End Energy Save Mode:</label>
                                                                {{Form::text('EndEnergySaveMode', '' ,['class' => 'form-control timepicker','id' => 'EndEnergySaveMode'])}}
                                                             </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                        <button type="button" class="btn btn-info rounded-pill btn-sm mb-3 btn-save" id="save-app" data-action="app">Save Changes</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane active" role="tabpanel" id="tab-2">
                                                <form id="display-calibrate">
                                                {{csrf_field()}}
                                                  <input type="hidden" id="ws-dc-id" name="ws-dc-id" value="">
                                                    <div class="row gy-3">
                                                        <div class="col-12 col-lg-6">
                                                            <div><label class="form-label fw-semibold">Preset</label>
                                                                <select class="form-control" id="CalibrationPresents" name="CalibrationPresents">
                                                                    <option></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div><label class="form-label fw-semibold">Luminance Response</label>
                                                                 <select class="form-control" id="CalibrationType" name="CalibrationType">
                                                                     <option></option>
                                                                    </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-12 col-lg-6">
                                                            <div><label class="form-label fw-semibold">Color Temperature</label>
                                                                <select class="form-control select2" id="ColorTemperatureAdjustment" name="ColorTemperatureAdjustment" data-placeholder="native">
                                                                    <option></option>
                                                                </select>
                                                                <input type="hidden" id="AdjustColorTemperature" name="AdjustColorTemperature">
                                                                <div class="col-sm-12 pl-0">
                            <input type="text" placeholder="Enter custom value" class="form-control mt-1" name="ColorTemperatureAdjustment_ext" id="ColorTemperatureAdjustment_ext" style="display:none; width:100%;" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <div class="col-12 col-lg-6">
                                                            <div><label class="form-label fw-semibold">Max Luminance (FL)</label>
                                                                <div class="input-group">
                                                                    <div class="w-100 input-group-text form-control-wrapper form-control-icon-start form-control-icon-end position-relative p-0">
                                                                        <input class="form-control" type="text" autocomplete="off" placeholder="Select">
                                                                        <span class="position-absolute position-absolute-end top-50 translate-middle-y">fl</span></div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>
                                                       
                                                        <div class="col-12 col-lg-6">
                                                            <div><label class="form-label fw-semibold">Max Luminance (FL)</label>
                                                                <select class="form-control select2" id="WhiteLevel_u_extcombo" name="WhiteLevel_u_extcombo" data-placeholder="native">
                                                                    <option></option>
                                                                </select>
                                                            <input type="hidden" name="WhiteLevel" id="WhiteLevel" />
                                                                    <input type="hidden" name="SetWhiteLevel" id="SetWhiteLevel" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div><label class="form-label fw-semibold">Gamut</label>
                                                                <div class="input-group">
                                                                    <div class="w-100 input-group-text form-control-wrapper form-control-icon-start form-control-icon-end position-relative p-0">
                                                                        <input class="form-control" type="text" autocomplete="off" placeholder="Native">
                                                                        <span class="position-absolute position-absolute-end top-50 translate-middle-y">fl</span></div>
                                                                  
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="1" id="CreateICCICMProfile" name="CreateICCICMProfile">
                                                                <label class="form-check-label fw-semibold" for="CreateICCICMProfile">Create Display ICC Profile </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                        <button type="button" class="btn btn-info rounded-pill btn-sm mb-3 btn-save" id="save-dc" data-action="dc">Save Changes</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            
                                            </div><!--tab2 end-->
                                             <div class="tab-pane" role="tabpanel" id="tab-3">
                                                <form id="quality-assurance">
                                                {{csrf_field()}}
                                                    <input type="hidden" id="UsedClassificationForLastScheduling" name="UsedClassificationForLastScheduling" value="">
                                                    <input type="hidden" id="ws-qa-id" name="ws-qa-id" value="">
                                                    <div class="row gy-3">
                                                        <div class="col-12 col-lg-6">
                                                            <div><label class="form-label fw-semibold">Regulation</label>
                                                                <select class="form-control" id="UsedRegulation" name="UsedRegulation">
                                                                    <option></option>
                                                                </select>
                                                                <input type="hidden" id="UsedRegulationForLastScheduling" name="UsedRegulationForLastScheduling" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div><label class="form-label fw-semibold" id="labelRoomClass">Room Class</label>
                                                                <select class="form-control" id="UsedClassification" name="UsedClassification">
                                                                    <option></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-md-6">
                                                            <div><label class="form-label fw-semibold">Body-Region</label>
                                                                <input type="text" class="form-control" id="bodyRegion" name="bodyRegion">
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="AutoDailyTests" name="AutoDailyTests" value="1">
                                                                <label class="form-check-label fw-semibold" for="AutoDailyTests">Start daily tests automatically</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                        <button type="button" class="btn btn-info rounded-pill btn-sm mb-3 btn-save" id="save-qa" data-action="qa">Save Changes</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div><!--tab3 end-->
                                              <div class="tab-pane" role="tabpanel" id="tab-4">
                                                <form id="Location">
                                                {{csrf_field()}}
                                                <input type="hidden" id="ws-id" name="ws-id" value="">
                                                    <div class="row gy-3">
                                                        
                                                        <div class="col-6 col-md-6">
                                                            <div><label class="form-label fw-semibold">Facility</label>
                                                                <input type="text" class="form-control" id="Facility" name="Facility">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-md-6">
                                                            <div><label class="form-label fw-semibold">Department</label>
                                                               <input type="text" class="form-control" id="Department" name="Department">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-md-6">
                                                            <div><label class="form-label fw-semibold">Room</label>
                                                                 <input type="text" class="form-control" id="Room" name="Room">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-md-6">
                                                            <div><label class="form-label fw-semibold">Responsible Person</label>
                                                                <input type="text" class="form-control" id="ResponsiblePersonName" name="ResponsiblePersonName">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-md-6">
                                                            <div><label class="form-label fw-semibold">Address</label>
                                                                <input type="text" class="form-control" id="ResponsiblePersonCity" name="ResponsiblePersonCity">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-md-6">
                                                            <div><label class="form-label fw-semibold">City</label>
                                                                 <input type="text" class="form-control" id="ResponsiblePersonAddress" name="ResponsiblePersonAddress">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-md-6">
                                                            <div><label class="form-label fw-semibold">Email</label>
                                                                <input type="text" class="form-control" id="ResponsiblePersonEmail" name="ResponsiblePersonEmail">
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-md-6">
                                                            <div><label class="form-label fw-semibold">Phone Number</label>
                                                                <input type="text" class="form-control" id="ResponsiblePersonPhoneNumber" name="ResponsiblePersonPhoneNumber">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                        <button type="button" class="btn btn-info rounded-pill btn-sm mb-3 btn-save" id="save-location" data-action="location">Save Changes</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--final end-->
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xl-4">
                            <section class="py-0 pb-4">
                    <div class="bg-white border rounded border-info rounded-4 p-4">
                        <div class="d-flex align-items-center border-bottom pb-3 mb-4"><span class="d-inline-block flex-shrink-0 me-2"><svg width="30" height="28" viewbox="0 0 30 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21.6667 22.5734H16.3334L10.4001 26.52C9.52007 27.1067 8.33341 26.4801 8.33341 25.4134V22.5734C4.33341 22.5734 1.66675 19.9067 1.66675 15.9067V7.90666C1.66675 3.90666 4.33341 1.23999 8.33341 1.23999H21.6667C25.6667 1.23999 28.3334 3.90666 28.3334 7.90666V15.9067C28.3334 19.9067 25.6667 22.5734 21.6667 22.5734Z" stroke="#2E3192" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M15.0002 13.1466V12.8667C15.0002 11.96 15.5602 11.48 16.1202 11.0933C16.6669 10.72 17.2135 10.24 17.2135 9.35999C17.2135 8.13332 16.2268 7.14661 15.0002 7.14661C13.7735 7.14661 12.7869 8.13332 12.7869 9.35999" stroke="#2E3192" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M14.9942 16.3333H15.0062" stroke="#2E3192" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>
                            <h5 class="text-primary mb-0">How it works?</h5>
                        </div>
                        Global settings apply changes on every workstation you manage.
                    </div>
                </section>
                
                <section class="py-0 pb-4">
                    <div class="bg-white border rounded border-info rounded-4 p-4">
                        <a href="#" onclick="expand()">Expand All</a> | <a href="#" onclick="collapse()">Collapse All</a>
                        <div id="tree"></div>
                        </div>
                        </section>
                        
                        </div>
                    </div>
                </section>
            </div>
        </main>
@include('common.navigations.footer')

<script>
  function fetch_workgroups(th)
    {
       var id=$(th).val();
            
                var formData=new FormData();
                formData.append('_token', '{{csrf_token()}}');
               formData.append('id', id);
                
                
                $.ajax({
            url: "<?php echo url('fetch-groups') ?>",
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

     function fetch_workstations(th)
     {
        var id=$(th).val();
        
        var formData=new FormData();
        formData.append('_token', '{{csrf_token()}}');
        formData.append('id', id);
        
        $.ajax({
            url: "<?php echo url('fetch-workstations') ?>",
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
</script>

<script>
  var ws_id = '';
  var input_type = '';
  var startValue = 1.8;
  var slider = null;
  var ws_data = null;
  var ws_data_list = '';
  var current_unit = ''; // get the current lum units to calculate conversion
  function initSlideBar(startValue) {
    slider = document.getElementById('sliderRegular');
    noUiSlider.create(slider, {
      start: startValue,
      connect: [true, false],
      range: {
        min: 1.0,
        max: 2.8
      },
      step: 0.1,
      direction: 'ltr',
      tooltips: true,
      // snap:true, // ko cho slide

      // format: wNumb({
      //   decimals: 1,
      //   // thousand: '.',
      //   // suffix: ' (US $)',
      // })

    });
    slider.noUiSlider.on('update', function(values, handle) {
      $('#Gamma').val(values[handle]);
    });
  }

  $(document).ready(function() {
    // init events & input states
    initEvents();
    // load workstation 
    $("#tree").on("select_node.jstree",
      function(evt, data) {
        //if (data.node.type == 'workstation') 
        {
          enableForm(false);
          ws_id = data.node.id;
          input_type = data.node.type;
          loadWorkstation(ws_id, input_type);
        }

      }
    );

    // Handle tree selection event    


    var i = 0;
    
    $("#tree").on("changed.jstree",
        function(evt, data) {

            if (data.node && data.node.state.checkbox_disabled) {
                if (data.node.state.selected) {
                    notify('warning', 'Display is excluded. Task will not be added to this display!');
                }
            }

            ws_data_list = getTreeDisplayIds();
            console.log('ws_data_list=', ws_data_list);
        }
    );

    window.workstation_id=0;

    @if(isset($load_ws_id))
    ws_id = 'ws-{{$load_ws_id}}';
    input_type = 'workstations';

    window.workstation_id=ws_id;

    loadWorkstation(ws_id);
    @endif
  });

  function initEvents() {
    enableForm(false);

    // whitelevel and WhiteLevel_u_extcombo
    $('#WhiteLevel_u_extcombo').change(function() {

      $('#SetWhiteLevel').val($(this).val() == 'native' ? 'false' : 'true');


      if ($(this).val() && $(this).val() != 'native' && $(this).val() != 'custom') {
        $('#WhiteLevel').val($(this).val());
      }
      // Show custom input
      if ($(this).val() == 'custom') {
        $('#WhiteLevel_u_input').show();
        $('#WhiteLevel_u_input').focus();
      } else {
        $('#WhiteLevel_u_input').hide();
      }
    });

    // BlackLevel and BlackLevel_u_extcombo
    $('#BlackLevel_u_extcombo').change(function() {
      $('#SetBlackLevel').val($(this).val() == 'native' ? 'false' : 'true');

      if ($(this).val() && $(this).val() != 'native' && $(this).val() != 'custom') {
        $('#BlackLevel').val($(this).val());
      }

      // Show custom input
      if ($(this).val() == 'custom') {
        $('#BlackLevel_u_input').show();
        $('#BlackLevel_u_input').focus();
      } else {
        $('#BlackLevel_u_input').hide();
      }
    });

    // store custom value into WhiteLevel and BlackLevel
    $('#BlackLevel_u_input').change(function() {
      // black level: 0 <= value <= 10
      var value = $(this).val();



      if ($('#BlackLevel_u_extcombo').val() == 'custom') {
        if (value < 0 && value != '') {
          value = 0;
          $(this).val('0');
        }
        if (value > 10 && value != '') {
          value = 10;
          $(this).val('10');
        }
        if ($('#LumUnits').val() == 'fL') {
          value = fLtocd(value);
        }
        // alert(value);
        if (value && value > 0) {
          $('#BlackLevel').val(value);
        }
      }
    });

    $('#WhiteLevel_u_input').change(function() {

      // 50 <= value
      var value = $(this).val();



      if ($('#WhiteLevel_u_extcombo').val() == 'custom') {

        if (value < 50 && value != '') {
          value = 50;
          $(this).val('50');
        }

        if ($('#LumUnits').val() == 'fL') {
          value = fLtocd(value);
        }
        if (value && value > 0) {
          $('#WhiteLevel').val(value);
        }
      }
    });

    // PutDisplaysToEnergySaveMode
    $('#PutDisplaysToEnergySaveMode').change(function() {
      if ($(this).is(':checked')) {
        $('.divSaveMode').show();
      } else {
        $('.divSaveMode').hide();
      }
    });

    // // load display category based on Regulation
    $('#UsedRegulation').change(function() {
      $.ajax({
        type: 'GET',
        url: "{{url('app-settings/get/categories')}}?id=" + ws_id + '&regulation=' + $(this).val(),
        success: function(data) {


          $('#UsedClassification').empty();
          $.each(data, function(k, o) {
            $('#UsedClassification').append($('<option>').val(o.key).text(o.value));

            // Special case to hide body-region and change label
            if ($('#UsedRegulation').val() == 'DIN 6868-157') {
              $('#divbodyRegion').show();
              $('#labelRoomClass').html('Room Class');
            } else {
              $('#divbodyRegion').hide();
              $('#labelRoomClass').html('Display Category');
            }
          });
          // set selected value
          if ($('#UsedRegulation').val() == ws_data['UsedRegulation']) {
            $('#UsedClassification').val(ws_data['UsedClassification']);
          }
        }
      });
    });

    // Room Class changed
    $('#UsedClassification').change(function() {
      $('#UsedClassificationForLastScheduling').val($(this).val());
    });

    // Change unit of luminance
    $('#LumUnits').on('change', function() {
      // change label 
      $('.UnitsOfLuminanceText').text($('#LumUnits option:selected').text());
      $('#AmbientLight').val(convertcdfL($('#AmbientLight').val(), current_unit, $(this).val()));
      // convert white & black combo box
      $("#WhiteLevel_u_extcombo > option").each(function() {
        if (!isNaN(parseFloat(this.value))) {
          this.text = convertcdfL(this.value, current_unit, $(this).val());
        }
      });

      $("#BlackLevel_u_extcombo > option").each(function() {
        if (!isNaN(parseFloat(this.value))) {
          this.text = convertcdfL(this.value, current_unit, $(this).val());
        }
      });

      $('#BlackLevel_u_input').val(convertcdfL($('#BlackLevel_u_input').val(), current_unit, $(this).val())).change();
      $('#WhiteLevel_u_input').val(convertcdfL($('#WhiteLevel_u_input').val(), current_unit, $(this).val())).change();

      // set current unit
      current_unit = $(this).val();
    });



    // Preset changed
    $('#CalibrationPresents').on('change', function() {
      if ($(this).val() != "1") { // custom
        $('#divsliderRegular').hide();
        $('#WhiteLevel_u_extcombo').val('native').change();
        $('#BlackLevel_u_extcombo').val('native').change();
        $('#gamut_name').val('native').change();

        if ($(this).val() == "2") { // DICOM Gray
          $('#CalibrationType').val('DICOM').change();
          $('#ColorTemperatureAdjustment').val('native').change();


        } else if ($(this).val() == "3") { //DICOM + D65
          $('#CalibrationType').val('DICOM').change();
          $('#ColorTemperatureAdjustment').val('2');
        } else { //if($(this ).val() == "4"){ //CIE L* + D65
          $('#CalibrationType').val('CIE L*').change();
          $('#ColorTemperatureAdjustment').val('2');
        }
        $('#present').find('input[type=checkbox], select').prop('disabled', true);
      } else {
        $('#present').find('input[type=checkbox], select').prop('disabled', false);

      }
    });

    // set value for ColorTemperature when user input value
    // $('#ColorTemperatureAdjustment').on('change',function(){
    //   $('#ColorTemperature').val($(this).val());
    // });


    $('#CalibrationType').on('change', function() {
      if ($(this).val() == "Gamma") {
        $('#divsliderRegular').show();
      } else {
        $('#divsliderRegular').hide();
      }
    });


    // open custom text box 

    $('#ColorTemperatureAdjustment').on('change', function() {
      if ($(this).val() == "20") {
        $('#ColorTemperatureAdjustment_ext').show();
        $('#ColorTemperatureAdjustment_ext').focus();
      } else {
        $('#ColorTemperatureAdjustment_ext').hide();
      }
    });


    // Save buttons clicked
    // save information in Application tab
    $('.btn-save').on('click', function(obj, data) {
        var workstations_ids='{{$user_workstations}}';
      var wid_list = workstations_ids.split(',');
      //var wid_list = window.workstation_id;
      var ws_len = wid_list.length;
      //if(confirm('Do you want to save ' + ws_len + ' workstation?')){
      if(confirm('Do you want to update all workstations?')){
        
        // find the parent form
        var form = $(this.form);
        //$.LoadingOverlay("show");
        let disabled = $(form).find(":input:disabled").removeAttr("disabled");
        var submitData = $(form).serialize();
        disabled.attr("disabled", "disabled");

        for(var k=0;k<ws_len;k++){
          $.ajax({
            type: "POST",
            data: submitData,
            url: "{{url('app-settings/save')}}/" + $(this).data('action') + "/" + wid_list[k],
            success: function(data) {
              //$.LoadingOverlay("hide");
              //reloadTree();
            },
            error: function(xhr, ajaxOptions, thrownError) {
              if (xhr.status == 422) {
                showValidationErrors(xhr.responseJSON);
              }
              //$.LoadingOverlay("hide");
              notify('error', 'Error occurs.');
              // call custom function
            }
          }); 
        }
        setTimeout(function(){
            notify('success', 'Workstations updated successfully!');
        }, 3000);
              
      }
    });

  }

  function onloadEvents() {
    // set combobox WhiteLevel and BlackLevel
    $('#WhiteLevel_u_extcombo').val($('#WhiteLevel').val());
    $('#BlackLevel_u_extcombo').val($('#BlackLevel').val());

    if ($('#SetWhiteLevel').val() == 'false') {
      $('#WhiteLevel_u_extcombo').val('native');
    }

    if ($('#SetBlackLevel').val() == 'false') {
      $('#BlackLevel_u_extcombo').val('native');
    }

    $('#PutDisplaysToEnergySaveMode').trigger('change');
  }

  function loadWorkstation(ws_id) {
    window.workstation_id=ws_id;

    $.ajax({
      type: 'GET',
      url: "{{url('app-settings')}}/" + ws_id,
      success: function(data) {
        if (data.data && data.data != null && data.data != undefined && (!Array.isArray(data.data) || (Array.isArray(data.data) && data.data.length > 0))) {
          $('#ws_name').html('Workstation: ' + data.data.WorkstationName);
          // save to global variable
          ws_data = data.data;
          current_unit = ws_data['LumUnits'];
          // if more than one workstations selected then don't enable all
          if (data.workstations.length <= 1) {
            enableForm(true);
          } else {
            enableButton(true);
          }
          // enableForm(true);
          fillForm(data);

          // fill value for slider bar onload
          $('.noUi-tooltip').html($('#Gamma').val());

          startValue = $('#Gamma').val();
          if (slider != null) {
            slider.noUiSlider.set(startValue);
          } else {
            initSlideBar(startValue);
          }

          if ($('#AdjustColorTemperature').val() == "false") {
            $('#ColorTemperatureAdjustment').val('native');
          }

          onloadEvents();
        }
      }
    });
  }

  function enableForm(enabled) {
    $('form').find('input[type=text], select, input[type=button], button').val("");
    if (enabled) {
      $('form').find('input[type=text], select, input[type=checkbox], input[type=button], button').prop('disabled', false);
    } else {
      $('#application')[0].reset();
      $('#display-calibrate')[0].reset();
      $('#quality-assurance')[0].reset();
      $('#Location')[0].reset();

      $('form').find('input[type=text], select, input[type=checkbox], input[type=button], button').prop('disabled', true);
    }
  }
  function enableButton(enabled) {
    // $('form').find('input[type=text], select, input[type=button], button').val("");
    if (enabled) {
      $('form').find('input[type=button], button').prop('disabled', false);
    } else {
      $('form').find('input[type=button], button').prop('disabled', true);
    }
  }
  function getTreeDisplayIds() {
    var nodes = $("#tree").jstree('get_selected', true);
    var list_display_ids = '';
    for(i=0; i<nodes.length; i++) {
        var node = nodes[i];
        if (node.type == 'workstation' && !node.state.disabled && !node.state.disabled) {
            if (list_display_ids!='') list_display_ids += ',';
            // list_display_ids += node.id.replace('ws-','');
            list_display_ids += node.id;
        }
    }
    return list_display_ids;
}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.17/jstree.min.js" integrity="sha512-Rzhxh2sskKwa+96nRopp/hvGexBzEPG6mnFI6uRy059FZfksJJFYmqDFn050KUDhivXLsT6SvoaEf5iSp2SHjg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var tree;
    function expand() {
        $('#tree').jstree('open_all');
    }

    function collapse() {
        $('#tree').jstree('close_all');
    }
    function reloadTree() {
        tree.jstree("refresh");
    }
    function loadTree() {
        tree = $('#tree').jstree({
            'core': {

                "multiple": @if(isset($multiple) && $multiple) true @else false @endif,
                'data': {
                    "url": "{{url('load-tree')}}/{{isset($workstation_app)?$workstation_app:'Perfectlum'}}/{{isset($leaf)?$leaf:'di'}}",
                    /*"data" : function (node) {                            
                        return { "id" : node.id };
                    }*/
                }
            },
            "types": {
                "facility": {
                    "icon": "now-ui-icons business_bank"
                },
                "workgroup": {
                    "icon": "now-ui-icons shopping_shop"
                },
                "workstation": {
                    "icon": "now-ui-icons tech_laptop"
                },
                "display": {
                    "icon": "now-ui-icons tech_tv"
                },
                
            },
            "checkbox": {
                // "keep_selected_style": false
            },
            "plugins": [

                @if(isset($multiple) && $multiple)
                "checkbox",
                @endif

                "types",
                "html_data",
                "theme"
            ]
        });

    }

    $(document).ready(function() {
        loadTree();
        

    });
</script>