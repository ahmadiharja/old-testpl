 @include('common.navigations.header')
        
        <main class="main-vertical-layout">
            <div class="container-fluid">
                <section class="py-4 mb-2">
                    <div class="bg-white border rounded border-info rounded-4 pt-0">
                        <div class="d-flex flex-column justify-content-between align-items-center flex-sm-row px-4 mb-3">
                            
                            <div class="mt-3 mt-sm-0">
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
                                                    <h5 class="fw-bold text-primary mb-0">Add/Edit Workgroups</h5>
                                                </div><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body py-4">
                                                <form method="post">
                                                    <div class="row gy-4">
                                                        <div class="col-12">
                                                            <div><label class="form-label fw-semibold">Workgroup Name</label><input class="form-control" type="text" id="name-2" name="name" placeholder="Danh"></div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div><label class="form-label fw-semibold">Address</label><input class="form-control" type="text" id="name-5" name="name" placeholder="Address"></div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div><label class="form-label fw-semibold">Phone Number</label><input class="form-control" type="text" id="name-4" name="name" placeholder="Phone Number"></div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div><label class="form-label fw-semibold">Facilty</label><select class="form-select">
                                                                    <option value="12" selected="">Danh</option>
                                                                    <option value="13">Danh</option>
                                                                    <option value="14">Danh</option>
                                                                </select></div>
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
                            </div>
                        </div>
                        
                        <form method="post" action="" class="p-4 pt-1">
                            {{csrf_field()}}
                                    <div class="row gy-4">
                                        <div class="col-12 col-lg-3">
                                        <div>
                                            <label class="form-label fw-semibold">Select Facility</label>
                                            <select class="form-select" name="facility" id="facility_field" onchange="fetch_workgroups(this);" required>
                                            <option value="">Please select</option>
                                                @if ($role!='super')
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
                                        <div class="col-12 col-lg-3">
                                        <div><label class="form-label fw-semibold">Select Workgroup</label>
                                            <select class="form-select" name="workgroup" id="workgroups_field" onchange="fetch_workstations(this)" required>
                                             <option value="" >Select Facility first</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                        <div><label class="form-label fw-semibold">Select Workstation</label>
                                            <select class="form-select" name="workstation" id="workstations_field" onchange="fetch_displays_checklist(this)" required>
                                             <option value="" >Select Workgroup first</option>
                                            </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 col-lg-3">
                                         <div>
                                             <label class="form-label fw-semibold">Select Display</label>
                                                <div class="dropdown show dropdown-select dropdown-arrow">
                                                    <button id="displays-dropdown" class="btn btn-light dropdown-toggle text-start d-flex justify-content-between align-items-center w-100" aria-expanded="true" data-bs-toggle="dropdown" data-bs-auto-close="outside" type="button" style="padding:.50rem 0.9rem!important; font-size: 0.9rem;">
                                                        Please select
                                                    </button>
                                                    <div class="dropdown-menu" data-bs-popper="none" id="displays_field" style="border-radius: 20px !important; padding-top:13px; padding-bottom:13px;">                    
                                                    </div>
                                                </div>
                                        </div>
                                        </div>
                                        <div class="col-md-2 ms-auto d-none">
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
                                    <a class="dropdown-item" href="{{url('reports/histories-reports?export_type=excel')}}" target="_blank">Download Excel</a>
                                    <a class="dropdown-item" href="{{url('reports/histories-reports?export_type=pdf')}}" target="_blank">Download PDF</a>
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
                                <form method="post">
                                    {{csrf_field()}}
                                    <div class="form-control-wrapper form-control-icon-start position-relative">
                                        <input class="bg-white form-control form-control-search rounded-pill" id="myTable-search" style="padding-left: 35px;" type="search" placeholder="Search">  
                                        <svg style="left:10px;" class="position-absolute position-absolute-start top-50 translate-middle-y" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M16.625 16.6249L13.1868 13.1867M13.1868 13.1867C13.775 12.5986 14.2415 11.9004 14.5598 11.132C14.8781 10.3636 15.0419 9.53998 15.0419 8.70825C15.0419 7.87653 14.8781 7.05294 14.5598 6.28453C14.2415 5.51611 13.775 4.81791 13.1868 4.22979C12.5987 3.64167 11.9005 3.17515 11.1321 2.85686C10.3637 2.53858 9.5401 2.37476 8.70837 2.37476C7.87665 2.37476 7.05307 2.53858 6.28465 2.85686C5.51624 3.17515 4.81804 3.64167 4.22992 4.22979C3.04216 5.41756 2.37488 7.02851 2.37488 8.70825C2.37488 10.388 3.04216 11.999 4.22992 13.1867C5.41768 14.3745 7.02863 15.0417 8.70837 15.0417C10.3881 15.0417 11.9991 14.3745 13.1868 13.1867Z" stroke="#32505B" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                                         
</div>
                                </form><!-- End: Form Input Icons -->
                            </div>
                        </div><!-- End: SEARCH -->
                    </div>
                    </div>
                 <section class="py-4 mb-5 pb-5">
                    <div class="bg-white border rounded border-info rounded-4 pt-0">
                       
                        <div class="table-responsive rounded-4">
                            <table class="table mb-0 table-light" id="myTable">
                                <thead>
                                    <tr class="table-primary">
                                        <th></th>
                                        <th class="fw-semibold">Task Name</th>
                                        <th class="fw-semibold">Pattern</th>
                                        <th class="fw-semibold">Display</th>
                                        <th class="fw-semibold">Workstation</th>
                                        <th class="fw-semibold">Wrokgroup</th>
                                        <th class="fw-semibold">Performed Date/Time</th>
                                        <th class="fw-semibold">Result</th>
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

<script>
    $(document).ready(function() {
    var table = $('#myTable').DataTable({
        "processing": true,      // Show loading indicator
        "serverSide": true,       // Enable server-side processing
        "searching": true,     // Disable the search box
        "lengthChange": false,   // Disable the "Show entries" dropdown
        "ajax": {
            "url": "{{url('list-histories')}}",  // URL to the script that provides data
            "type": "GET",               // Method type (GET or POST)
            "data": function(d) {
                d.facility_id = $('#facility_field').val();      // Facility ID
                d.workstation_id = $('#workstations_field').val(); // Workstation ID
                d.workgroup_id = $('#workgroups_field').val();     // Workgroup ID
                d.displays = [];
                $('#displays_field input[name="displays[]"]:checked').each(function() {
                    d.displays.push($(this).val());
                });
            },
            "dataSrc": function (json) {
                //alert(json);
                console.log(json);  // Log the response to the console
                return json.data;
            }
        },
        "columns": [
            { "data": "id", "visible": false },
                    { "data": "link", name: "name", className: "text-primary" },
                    { "data": "regulation", name: "regulation", className: "text-body" },
                    {
                        "data": "display.model",  // Show both manufacturer and model
                        "name": "display.model",
                        "className": "text-primary",
                        "render": function (data, type, row) {
                            // Combine manufacturer and model in one column
                            if(row.display.manufacturer==null) row.display.manufacturer='';
                            return '<a href="{{url("/")}}/display-settings/'+row.display.id+'">'+row.display.manufacturer + '  ' + row.display.model +' ('+row.display.serial+')</a>';
                            return row.display.manufacturer + '  ' + row.display.model+' ('+row.display.serial+')';
                        }
                    },
                    {
                        "data": "display.workstation.name",  // Show both manufacturer and model
                        "name": "display.workstation.name",
                        "className": "text-body",
                        "render": function (data, type, row) {
                            return '<a href="{{url("/")}}/workstations-info/'+row.display.workstation.id+'">'+ row.display.workstation.name +'</a>';
                        }
                    },
                    {
                        "data": "display.workstation.workgroup.name",  // Show both manufacturer and model
                        "name": "display.workstation.workgroup.name",
                        defaultContent: "",
                        "className": "text-body",
                        "render": function (data, type, row) {
                            return '<a href="{{url("/")}}/workgroups-info/'+row.display.workstation.workgroup.id+'">'+ row.display.workstation.workgroup.name +'</a>';
                        }
                    },
                    { "data": "time" , className: "text-body"},
                {
                    "data": "resultIcon",
                    "name": "result"
                },
                    
        ],
        order: [[6, 'DESC']],
    });

    $('#myTable-search').on('keyup change', function() {
        table.search(this.value).draw();  // Trigger global search on DataTable
    });

    @if(isset($_GET['keywords']))
    table.search($("#myTable-search").val()).draw();
    @endif

    window.table=table;

    $('#displays_field').on('change', 'input[name="displays[]"]', function() {
        window.table.ajax.reload();
    });
});

    function search_filters(th)
    {
        window.table.ajax.reload();
    }

     function fetch_workgroups(th)
    {
        search_filters(th);
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
        search_filters(th);
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
    
    function fetch_displays_checklist(th)
    {
        search_filters(th);
        var id=$(th).val();
        
        var formData=new FormData();
        formData.append('_token', '{{csrf_token()}}');
        formData.append('id', id);
        
        $.ajax({
            url: "<?php echo url('fetch-displays-checklist') ?>",
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

                    $(th).parent().parent().next().children().children().children('#displays-dropdown').text('Please select');
                }
            },
            error: function()  {
                //error
            } 	        
        });
    }
</script>