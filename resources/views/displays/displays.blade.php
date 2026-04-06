@include('common.navigations.header')

        <main class="main-vertical-layout">
            <div class="container-fluid">
                <section class="py-2 mb-2">
                    <div class="bg-white border rounded border-info rounded-4 pt-0 d-none">
                        <div class="d-flex flex-column justify-content-between align-items-center flex-sm-row px-4 mb-3">
                            
                            
                        </div>
                        
                        <form method="post" action="" class="p-4 pt-1">
                            {{csrf_field()}}
                                    <div class="row gy-4">
                                        <div class="col-12 col-lg-3">
                                        <div>
                                            <label class="form-label fw-semibold">Select Facility</label>
                                             @foreach($facilities as $facility)
                                            <select class="form-select" onchange="fetch_workgroups(this)">
                                                <option value="">Please select</option>
                                             <option value="{{$facility->id}}">{{$facility->name}}</option>
                                            </select>
                                             @endforeach
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                        <div>
                                            <label class="form-label fw-semibold">Select Workgroup</label>
                                            <select class="form-select" id="workgroups_field" onchange="fetch_workstations(this)" >
                                              <option value="">Select facility first</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                        <div>
                                            <label class="form-label fw-semibold">Select Workstation</label>
                                            <select class="form-select"  id="workstations_field" onchange="fetch_displays(this)">
                                             <option value="">Select Workgroup first</option>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                        <div>
                                            <label class="form-label fw-semibold">Select Display</label>
                                            <select class="form-select" id="displays_field">
                                             <option value="">Select </option>
                                            </select>
                                            </div>
                                        </div>
                                         <div class="col-md-2 ms-auto">
                                            <div class="d-grid"><button class="btn btn-info btn-sm rounded-pill" type="submit" data-bs-dismiss="modal">Apply</button></div>
                                        </div>              
                                     </div>
                        </form>
                    </div>
                </section>
                <div class="row">
                    <!--button-->
                    <div class="col-md-6">
                        <div class="dropdown d-inline-block dropdown-arrow"><button class="btn btn-info dropdown-toggle rounded-pill" aria-expanded="false" data-bs-toggle="dropdown" type="button"><span class="d-none d-lg-inline-block me-2"><svg width="16" height="15" viewbox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 11.333C5.93333 11.333 5.87333 11.3197 5.80667 11.293C5.62 11.2197 5.5 11.033 5.5 10.833V6.83301C5.5 6.55967 5.72667 6.33301 6 6.33301C6.27333 6.33301 6.5 6.55967 6.5 6.83301V9.62634L6.98 9.14634C7.17333 8.95301 7.49333 8.95301 7.68667 9.14634C7.88 9.33967 7.88 9.65967 7.68667 9.85301L6.35333 11.1863C6.26 11.2797 6.12667 11.333 6 11.333Z" fill="white"></path><path d="M6 11.3326C5.87334 11.3326 5.74667 11.286 5.64667 11.186L4.31333 9.85264C4.12 9.65931 4.12 9.33931 4.31333 9.14598C4.50667 8.95264 4.82667 8.95264 5.02 9.14598L6.35333 10.4793C6.54667 10.6726 6.54667 10.9926 6.35333 11.186C6.25333 11.286 6.12667 11.3326 6 11.3326Z" fill="white"></path><path d="M10 14.6663H6.00004C2.38004 14.6663 0.833374 13.1197 0.833374 9.49967V5.49967C0.833374 1.87967 2.38004 0.333008 6.00004 0.333008H9.33337C9.60671 0.333008 9.83337 0.559674 9.83337 0.833008C9.83337 1.10634 9.60671 1.33301 9.33337 1.33301H6.00004C2.92671 1.33301 1.83337 2.42634 1.83337 5.49967V9.49967C1.83337 12.573 2.92671 13.6663 6.00004 13.6663H10C13.0734 13.6663 14.1667 12.573 14.1667 9.49967V6.16634C14.1667 5.89301 14.3934 5.66634 14.6667 5.66634C14.94 5.66634 15.1667 5.89301 15.1667 6.16634V9.49967C15.1667 13.1197 13.62 14.6663 10 14.6663Z" fill="white"></path><path d="M14.6667 6.66633H12C9.72004 6.66633 8.83337 5.77967 8.83337 3.49967V0.833C8.83337 0.633 8.95337 0.446334 9.14004 0.373C9.32671 0.293 9.54004 0.339667 9.68671 0.479667L15.02 5.813C15.16 5.953 15.2067 6.173 15.1267 6.35967C15.0467 6.54633 14.8667 6.66633 14.6667 6.66633ZM9.83337 2.03967V3.49967C9.83337 5.21967 10.28 5.66633 12 5.66633H13.46L9.83337 2.03967Z" fill="white"></path></svg></span>Download&nbsp;</button>
                                <div class="dropdown-menu">
                                    @php
                                    $type='';
                                    if(isset($_GET['type'])) $type=$_GET['type'];
                                    @endphp
                                    <a class="dropdown-item" href="{{url('reports/displays?export_type=excel&type='.$type)}}" target="_blank">Download Excel</a>
                                    <a class="dropdown-item" href="{{url('reports/displays?export_type=pdf&type='.$type)}}" target="_blank">Download PDF</a>
                                </div>
                            </div>
                    </div>
                    
                <!-- Start: SEARCH -->
                    <div class="col-md-6 ml-auto">
                        <div class="offcanvas-xl offcanvas-top offcanvas-search" tabindex="-1" id="search">
                            <div class="offcanvas-header justify-content-end">
                                <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvas-search"></button></div>
                            <div class="offcanvas-body justify-content-end">
                                <!-- Start: Form Input Icons -->
                                    <div class="form-control-wrapper form-control-icon-start position-relative">
                                        <input class="bg-white form-control form-control-search rounded-pill" value="@if(isset($_GET['keywords'])){{$_GET['keywords']}}@endif" style="padding-left: 35px;" type="search" placeholder="Search" id="myTable-search">  
                                        <svg style="left:10px;" class="position-absolute position-absolute-start top-50 translate-middle-y" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M16.625 16.6249L13.1868 13.1867M13.1868 13.1867C13.775 12.5986 14.2415 11.9004 14.5598 11.132C14.8781 10.3636 15.0419 9.53998 15.0419 8.70825C15.0419 7.87653 14.8781 7.05294 14.5598 6.28453C14.2415 5.51611 13.775 4.81791 13.1868 4.22979C12.5987 3.64167 11.9005 3.17515 11.1321 2.85686C10.3637 2.53858 9.5401 2.37476 8.70837 2.37476C7.87665 2.37476 7.05307 2.53858 6.28465 2.85686C5.51624 3.17515 4.81804 3.64167 4.22992 4.22979C3.04216 5.41756 2.37488 7.02851 2.37488 8.70825C2.37488 10.388 3.04216 11.999 4.22992 13.1867C5.41768 14.3745 7.02863 15.0417 8.70837 15.0417C10.3881 15.0417 11.9991 14.3745 13.1868 13.1867Z" stroke="#32505B" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                                         
</div>
<!-- End: Form Input Icons -->
                            </div>
                        </div><!-- End: SEARCH -->
                    </div>
                    </div>
                 <section class="py-4 mb-5 pb-5">
                    <div class="bg-white border rounded border-info rounded-4 pt-4">
                    <h4 class="text-primary mb-0 ps-4">All Displays</h4>

                        <div class="table-responsive rounded-4">
                            <table class="table mb-0 table-light" id="myTable">
                                <thead>
                                    <tr class="table-primary">
                                        <th class="fw-semibold">ID</th>
                                        <th class="fw-semibold">Serial</th>
                                        <th class="fw-semibold">Display Name</th>
                                        <th class="fw-semibold">Inventory Number</th>
                                        <th class="fw-semibold">Workstation</th>
                                        <th class="fw-semibold">Workgroup</th>
                                        <th class="fw-semibold">Facility</th>
                                        <th class="fw-semibold">Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </section> 
            </div>
        </main>

@include('common.navigations.footer')
@php
$delete_url=url('delete-display');
@endphp
@include('common.delete_record')

<script>
    $(document).ready(function() {
    window.table = $('#myTable').DataTable({
        "processing": true,      // Show loading indicator
        "serverSide": true,       // Enable server-side processing
        "searching": true,     // Disable the search box
        "lengthChange": false,   // Disable the "Show entries" dropdown
        "ajax": {
            "url": "{{url('list-displays')}}",  // URL to the script that provides data
            "type": "GET",               // Method type (GET or POST)
            "dataSrc": function (json) {
                //alert(json);
                console.log(json);  // Log the response to the console
                return json.data;
            },
            "data": function(d) {
                d.type = "@if(isset($_GET['type'])){{$_GET['type']}}@endif";
            },
        },
        "columns": [
                    { "data": "id", "visible": false },
                    { "data": "serial", "serial": false, "visible": false },
                    {
                        "data": null,  // Show both manufacturer and model
                        "name": "model",
                        "className": "text-primary",
                        "render": function (data, type, row) {
                            // Combine manufacturer and model in one column
                            if(row.manufacturer==null) row.manufacturer='';
                            return '<a href="{{url("/")}}/display-settings/'+row.id+'">'+row.manufacturer + '  ' + row.model +' ('+row.serial+')</a>';
                            return row.manufacturer + '  ' + row.model+' ('+row.serial+')';
                        }
                    },
                    { "data": "inventoryNumber", searchable: false, sortable: false, "defaultContent":"", 
                        "className": "text-body", },
                    { "data": "workstation.name", name: "workstation.name", 
                        "className": "text-body", },
                    { "data": "workstation.workgroup.name", name: "workstation.workgroup.name", 
                        "className": "text-body", },
                    { "data": "workstation.workgroup.facility.name", name: "workstation.workgroup.facility.name", 
                        "className": "text-body", },
                    {
                        "data": null,  // Show both manufacturer and model
                        "name": "status",
                        "render": function (data, type, row) {
                            // Combine manufacturer and model in one column
                            if(row.status=='1')
                            return '<span class="badge bg-success badge-circle rounded-circle p-0"><svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.71402 8.17706L2.07022 5.53325C1.92776 5.39079 1.73454 5.31076 1.53307 5.31076C1.3316 5.31076 1.13839 5.39079 0.995929 5.53325C0.85347 5.67571 0.773438 5.86893 0.773438 6.0704C0.773438 6.17015 0.793086 6.26893 0.831261 6.36109C0.869437 6.45326 0.925391 6.537 0.995929 6.60754L4.18069 9.7923C4.47783 10.0894 4.95783 10.0894 5.25498 9.7923L13.3159 1.73135C13.4584 1.58889 13.5384 1.39567 13.5384 1.19421C13.5384 0.992738 13.4584 0.799522 13.3159 0.657062C13.1735 0.514603 12.9803 0.43457 12.7788 0.43457C12.5773 0.43457 12.3841 0.514603 12.2416 0.657062L4.71402 8.17706Z" fill="#27AE60"></path></svg></span>';
                            else if(row.status=='2')
                            return '<span class="badge bg-danger badge-circle rounded-circle p-0"><svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">\
<path d="M1.33398 1.33301L10.6667 10.6657" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>\
<path d="M1.33355 10.6657L10.6663 1.33301" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>\
</svg>\
</span>';
                        }
                    },
                    {
                        "data": null,  // Show both manufacturer and model
                        "name": "",
                        searchable: false,
                        sortable: false,
                        "render": function (data, type, row) {
                            return `@if($role!='user')<div class="dropdown"><button class="btn btn-more px-1 py-0" aria-expanded="false" data-bs-toggle="dropdown" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-192 0 512 512" width="1em" height="1em" fill="currentColor" class="fs-5">
                                                        <path d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"></path>
                                                    </svg></button>
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-more">

<a class="dropdown-item" href="{{url('display-settings/')}}/`+row.id+`"><span class="d-inline-block me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="#049FD9" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M2 12.8799V11.1199C2 10.0799 2.85 9.21994 3.9 9.21994C5.71 9.21994 6.45 7.93994 5.54 6.36994C5.02 5.46994 5.33 4.29994 6.24 3.77994L7.97 2.78994C8.76 2.31994 9.78 2.59994 10.25 3.38994L10.36 3.57994C11.26 5.14994 12.74 5.14994 13.65 3.57994L13.76 3.38994C14.23 2.59994 15.25 2.31994 16.04 2.78994L17.77 3.77994C18.68 4.29994 18.99 5.46994 18.47 6.36994C17.56 7.93994 18.3 9.21994 20.11 9.21994C21.15 9.21994 22.01 10.0699 22.01 11.1199V12.8799C22.01 13.9199 21.16 14.7799 20.11 14.7799C18.3 14.7799 17.56 16.0599 18.47 17.6299C18.99 18.5399 18.68 19.6999 17.77 20.2199L16.04 21.2099C15.25 21.6799 14.23 21.3999 13.76 20.6099L13.65 20.4199C12.75 18.8499 11.27 18.8499 10.36 20.4199L10.25 20.6099C9.78 21.3999 8.76 21.6799 7.97 21.2099L6.24 20.2199C5.33 19.6999 5.02 18.5299 5.54 17.6299C6.45 16.0599 5.71 14.7799 3.9 14.7799C2.85 14.7799 2 13.9199 2 12.8799Z" stroke="#049FD9" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

</span>Display Settings</a>
<a class="dropdown-item" href="javascript:void(0)" onclick="delete_record(this, '`+row.id+`')">
    <span class="d-inline-block me-2">
        <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M19 4.98001C15.67 4.65001 12.32 4.48001 8.98 4.48001C7 4.48001 5.02 4.58001 3.04 4.78001L1 4.98001" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M6.5 3.97L6.72 2.66C6.88 1.71 7 1 8.69 1H11.31C13 1 13.13 1.75 13.28 2.67L13.5 3.97" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M16.85 8.14001L16.2 18.21C16.09 19.78 16 21 13.21 21H6.79002C4.00002 21 3.91002 19.78 3.80002 18.21L3.15002 8.14001" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M8.33002 15.5H11.66" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M7.5 11.5H12.5" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</span>Delete Display</a></div>
                                        </div>@endif`;
                        }
                    },
        ]
    });

    $('#myTable-search').on('keyup change', function() {
        table.search(this.value).draw();  // Trigger global search on DataTable
    });
});
</script>

<script>
     function fetch_workgroups(th){
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
    
    function fetch_workstations(th){
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
    
    function fetch_displays(th){
        var id=$(th).val();
        
        var formData=new FormData();
        formData.append('_token', '{{csrf_token()}}');
        formData.append('id', id);
        
        $.ajax({
            url: "<?php echo url('fetch-displays') ?>",
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
    
    function display_settings(th, id)
    {
        
                var formData=new FormData();
                formData.append('_token', '{{csrf_token()}}');
                formData.append('id', id);
                
                $.ajax({
            url: "<?php echo url('display-settings') ?>",
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
                    
                }
            },
            error: function()  {
                //error
            } 	        
        });
         
    }
</script>


   
  