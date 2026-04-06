@include('common.navigations.header');
        
        <style>
         .fc .fc-col-header-cell-cushion, .fc .fc-daygrid-day-number {
    color: inherit;
            text-decoration: inherit;
}
      .fc .fc-button {
           background-color: #049FD9 !important;
           color: white !important;
           padding: 0.5rem 1rem;
           border: none !important;
           text-transform: capitalize !important;
           border-radius:0 !important;
}
        .fc .fc-button-group > .fc-button:first-child{
            border-top-left-radius: 50px !important;
            border-bottom-left-radius: 50px !important;
        }
        
         .fc .fc-button-group >.fc-button:last-child{
            border-top-right-radius: 50px !important;
            border-bottom-right-radius: 50px !important;
        }
        
        .fc-direction-ltr .fc-toolbar > * > :not(:first-child){
            border-radius: 50px !important;
        }
        
         .fc .fc-button-group .fc-button:nth-child(2){
           
        }
        .fc-button:hover {
        background-color: #0056b3 !important; /* Darker blue on hover */
        color: white !important;
      }

      /* Reset focus/active state to avoid unwanted styles */
      .fc .fc-button:focus,
      .fc .fc-button:active {
        background-color: #049FD9 !important; /* Maintain blue on focus/active */
        color: white !important;
        box-shadow: none !important; /* Remove any unwanted focus outline */
      }
        
        .fc-toolbar-title {
            color: black;
            font-size: 1rem !important;
        }
        .fc-daygrid-day-number {
        color: black !important; /* Set date numbers to dark color */
      }

      .main-vertical-layout .nav-tabs .nav-link.active {
            background-color: transparent;
            border-left-color: transparent;
            border-top-color: transparent;
            border-right-color: transparent;
            border-bottom-width: 2px;
        }
    </style>
        <main class="main-vertical-layout">
            <div class="container-fluid">
                <div class="d-flex flex-column justify-content-between align-items-center flex-sm-row px-4 mb-3">
                <ul class="nav nav-tabs nav-tabs-settings" style="width: 100%;" role="tablist">
                                            
                 <!--<li class="nav-item" role="presentation"><a class="nav-link @if(!isset($_GET['tab']) OR $_GET['tab']=='') active @endif " role="tab" data-bs-toggle="tab" href="#tab-1">Display Calibration</a></li>-->
                 <li class="nav-item" role="presentation"><a class="nav-link @if(!isset($_GET['tab']) OR $_GET['tab']=='all-tasks') active @endif " role="tab" data-bs-toggle="tab" href="#tab-2">Schedule Tasks</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-3" onclick="initialise_calender()">Calendar</a></li>
                 </ul>
                    
                </div>
                
                
                <div class="tab-content mt-2">
                    
                <div class="tab-pane" role="tabpanel" id="tab-1">
                    
                @if($role!='user')
                    <section class="py-2 mb-4">
                    <div class="bg-white border rounded border-info rounded-4 pt-0">
                        
                       <form method="post" action="" class="p-4 pt-3">
                            {{csrf_field()}}
                                    <div class="row gy-4">
                                        <div class="col-12 col-lg-3">
                                        <div>
                                            <label class="form-label fw-semibold">Select Facility</label>
                                            <select class="form-select" name="facility" onchange="fetch_workgroups(this);" required>
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
                                         <div class="col-md-2 ms-auto">
                                            <div class="d-grid"><button class="btn btn-info btn-sm rounded-pill" type="submit" data-bs-dismiss="modal">Calibrate</button></div>
                                        </div>              
                                     </div>
                        </form>
                    </div>
                </section>
                @endif
                    
                
                <div class="row mb-3 mt-4">
                    <!--button-->
                    <div class="col-md-6">
                        <div class="btn-group">
                            <div class="dropdown d-inline-block dropdown-arrow"><button class="btn btn-info dropdown-toggle rounded-pill" aria-expanded="false" data-bs-toggle="dropdown" type="button"><span class="d-none d-lg-inline-block me-2"><svg width="16" height="15" viewbox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 11.333C5.93333 11.333 5.87333 11.3197 5.80667 11.293C5.62 11.2197 5.5 11.033 5.5 10.833V6.83301C5.5 6.55967 5.72667 6.33301 6 6.33301C6.27333 6.33301 6.5 6.55967 6.5 6.83301V9.62634L6.98 9.14634C7.17333 8.95301 7.49333 8.95301 7.68667 9.14634C7.88 9.33967 7.88 9.65967 7.68667 9.85301L6.35333 11.1863C6.26 11.2797 6.12667 11.333 6 11.333Z" fill="white"></path><path d="M6 11.3326C5.87334 11.3326 5.74667 11.286 5.64667 11.186L4.31333 9.85264C4.12 9.65931 4.12 9.33931 4.31333 9.14598C4.50667 8.95264 4.82667 8.95264 5.02 9.14598L6.35333 10.4793C6.54667 10.6726 6.54667 10.9926 6.35333 11.186C6.25333 11.286 6.12667 11.3326 6 11.3326Z" fill="white"></path><path d="M10 14.6663H6.00004C2.38004 14.6663 0.833374 13.1197 0.833374 9.49967V5.49967C0.833374 1.87967 2.38004 0.333008 6.00004 0.333008H9.33337C9.60671 0.333008 9.83337 0.559674 9.83337 0.833008C9.83337 1.10634 9.60671 1.33301 9.33337 1.33301H6.00004C2.92671 1.33301 1.83337 2.42634 1.83337 5.49967V9.49967C1.83337 12.573 2.92671 13.6663 6.00004 13.6663H10C13.0734 13.6663 14.1667 12.573 14.1667 9.49967V6.16634C14.1667 5.89301 14.3934 5.66634 14.6667 5.66634C14.94 5.66634 15.1667 5.89301 15.1667 6.16634V9.49967C15.1667 13.1197 13.62 14.6663 10 14.6663Z" fill="white"></path><path d="M14.6667 6.66633H12C9.72004 6.66633 8.83337 5.77967 8.83337 3.49967V0.833C8.83337 0.633 8.95337 0.446334 9.14004 0.373C9.32671 0.293 9.54004 0.339667 9.68671 0.479667L15.02 5.813C15.16 5.953 15.2067 6.173 15.1267 6.35967C15.0467 6.54633 14.8667 6.66633 14.6667 6.66633ZM9.83337 2.03967V3.49967C9.83337 5.21967 10.28 5.66633 12 5.66633H13.46L9.83337 2.03967Z" fill="white"></path></svg></span>Download&nbsp;</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{url('reports/display-calibration?export_type=excel')}}" target="_blank">Download Excel</a>
                                    <a class="dropdown-item" href="{{url('reports/display-calibration?export_type=pdf')}}" target="_blank">Download PDF</a>
                                </div>
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
                    
                <section class="py-2">
                    <div class="bg-white border rounded border-info rounded-4 pt-4">
                        <h4 class="text-primary mb-0 ps-4">Calibration Tasks</h4>
                 
                        <div class="table-responsive rounded-4">
                            <table class="table mb-0 table-light" id="myTable">
                                <thead>
                                    <tr class="table-primary">
                                        <th></th>
                                        <th class="fw-semibold">Display</th>
                                        <th class="fw-semibold">Workstation</th>
                                        <th class="fw-semibold">Wrokgroup</th>
                                        <th class="fw-semibold">Facility</th>
                                        <th class="fw-semibold">Task Type</th>
                                        <th class="fw-semibold">Schedule Type</th>
                                        <th class="fw-semibold">Due Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                   <!-- <tr>
                                        <td class="text-body" colspan="6">Showing 4 of 4 entries</td>
                                        <td colspan="2">
                                            <nav>
                                                <ul class="pagination mb-0 justify-content-lg-end">
                                                    <li class="page-item disabled"><a class="page-link" aria-label="Previous" href="#"><span aria-hidden="true">«</span></a></li>
                                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                    <li class="page-item"><a class="page-link" aria-label="Next" href="#"><span aria-hidden="true">»</span></a></li>
                                                </ul>
                                            </nav>
                                        </td>
                                    </tr>-->
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </section> 
                    <!--tab-1 end-->
                </div>
                     <div class="tab-pane @if(!isset($_GET['tab']) OR $_GET['tab']=='all-tasks') active @endif" role="tabpanel" id="tab-2">
                          <section class="py-2 mb-2">
                    <div class="bg-white border rounded border-info rounded-4 pt-0">
                        
                        <form method="post" action="" class="p-4 pt-3" id="schedule_task_form2">
                            {{csrf_field()}}
                                    <div class="row gy-4">
                                        <div class="col-12 col-lg-3">
                                        <div>
                                            <label class="form-label fw-semibold">Select Facility</label>
                                            <select class="form-select" name="facility2" id="facility_field2" onchange="fetch_workgroups2(this);" required>
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
                                            <select class="form-select" name="workgroup2" id="workgroups_field2" onchange="fetch_workstations2(this)">
                                             <option value="" >Select Facility first</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                        <div><label class="form-label fw-semibold">Select Workstation</label>
                                            <select class="form-select" name="workstation2" id="workstations_field2" onchange="fetch_displays_checklist2(this)">
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
                                                    <div class="dropdown-menu" data-bs-popper="none" id="displays_field2" style="border-radius: 20px !important; padding-top:13px; padding-bottom:13px;">                    
                                                    </div>
                                                </div>
                                        </div>
                                        </div>
                                         <div class="col-md-2 ms-auto">
                                            <div class="d-grid"><button class="btn btn-info btn-sm rounded-pill" type="submit" id="task_schedule_btn">Schedule</button></div>
                                        </div>              
                                     </div>
                        </form>
                    </div>
                </section>
                         
                
                         <div class="row mb-3 mt-4">
                    <!--button-->
                    <div class="col-md-6">
                        <div class="btn-group">
                            <div class="dropdown d-inline-block dropdown-arrow"><button class="btn btn-info dropdown-toggle rounded-pill" aria-expanded="false" data-bs-toggle="dropdown" type="button"><span class="d-none d-lg-inline-block me-2"><svg width="16" height="15" viewbox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 11.333C5.93333 11.333 5.87333 11.3197 5.80667 11.293C5.62 11.2197 5.5 11.033 5.5 10.833V6.83301C5.5 6.55967 5.72667 6.33301 6 6.33301C6.27333 6.33301 6.5 6.55967 6.5 6.83301V9.62634L6.98 9.14634C7.17333 8.95301 7.49333 8.95301 7.68667 9.14634C7.88 9.33967 7.88 9.65967 7.68667 9.85301L6.35333 11.1863C6.26 11.2797 6.12667 11.333 6 11.333Z" fill="white"></path><path d="M6 11.3326C5.87334 11.3326 5.74667 11.286 5.64667 11.186L4.31333 9.85264C4.12 9.65931 4.12 9.33931 4.31333 9.14598C4.50667 8.95264 4.82667 8.95264 5.02 9.14598L6.35333 10.4793C6.54667 10.6726 6.54667 10.9926 6.35333 11.186C6.25333 11.286 6.12667 11.3326 6 11.3326Z" fill="white"></path><path d="M10 14.6663H6.00004C2.38004 14.6663 0.833374 13.1197 0.833374 9.49967V5.49967C0.833374 1.87967 2.38004 0.333008 6.00004 0.333008H9.33337C9.60671 0.333008 9.83337 0.559674 9.83337 0.833008C9.83337 1.10634 9.60671 1.33301 9.33337 1.33301H6.00004C2.92671 1.33301 1.83337 2.42634 1.83337 5.49967V9.49967C1.83337 12.573 2.92671 13.6663 6.00004 13.6663H10C13.0734 13.6663 14.1667 12.573 14.1667 9.49967V6.16634C14.1667 5.89301 14.3934 5.66634 14.6667 5.66634C14.94 5.66634 15.1667 5.89301 15.1667 6.16634V9.49967C15.1667 13.1197 13.62 14.6663 10 14.6663Z" fill="white"></path><path d="M14.6667 6.66633H12C9.72004 6.66633 8.83337 5.77967 8.83337 3.49967V0.833C8.83337 0.633 8.95337 0.446334 9.14004 0.373C9.32671 0.293 9.54004 0.339667 9.68671 0.479667L15.02 5.813C15.16 5.953 15.2067 6.173 15.1267 6.35967C15.0467 6.54633 14.8667 6.66633 14.6667 6.66633ZM9.83337 2.03967V3.49967C9.83337 5.21967 10.28 5.66633 12 5.66633H13.46L9.83337 2.03967Z" fill="white"></path></svg></span>Download&nbsp;</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{url('reports/all-tasks?export_type=excel')}}" target="_blank">Download Excel</a>
                                    <a class="dropdown-item" href="{{url('reports/all-tasks?export_type=pdf')}}" target="_blank">Download PDF</a>
                                </div>
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
                                    <div class="form-control-wrapper form-control-icon-start position-relative">
                                        <input class="bg-white form-control form-control-search rounded-pill" id="myTable-search2" style="padding-left: 35px;" type="search" placeholder="Search">  
                                        <svg style="left:10px;" class="position-absolute position-absolute-start top-50 translate-middle-y" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M16.625 16.6249L13.1868 13.1867M13.1868 13.1867C13.775 12.5986 14.2415 11.9004 14.5598 11.132C14.8781 10.3636 15.0419 9.53998 15.0419 8.70825C15.0419 7.87653 14.8781 7.05294 14.5598 6.28453C14.2415 5.51611 13.775 4.81791 13.1868 4.22979C12.5987 3.64167 11.9005 3.17515 11.1321 2.85686C10.3637 2.53858 9.5401 2.37476 8.70837 2.37476C7.87665 2.37476 7.05307 2.53858 6.28465 2.85686C5.51624 3.17515 4.81804 3.64167 4.22992 4.22979C3.04216 5.41756 2.37488 7.02851 2.37488 8.70825C2.37488 10.388 3.04216 11.999 4.22992 13.1867C5.41768 14.3745 7.02863 15.0417 8.70837 15.0417C10.3881 15.0417 11.9991 14.3745 13.1868 13.1867Z" stroke="#32505B" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                                         
</div>
                                </form><!-- End: Form Input Icons -->
                            </div>
                        </div><!-- End: SEARCH -->
                    </div>
                    </div>
                         
                        <section class="py-2">
                        <div class="bg-white border rounded border-info rounded-4 pt-4">
                        <h4 class="text-primary mb-0 ps-4">All Tasks</h4>

                        <div class="table-responsive rounded-4">
                            <table class="table mb-0 table-light" id="scheduleTable">
                                <thead>
                                    <tr class="table-primary">
                                        <th></th>
                                        <th class="fw-semibold">Display</th>
                                        <th class="fw-semibold">Workstation</th>
                                        <th class="fw-semibold">Wrokgroup</th>
                                        <th class="fw-semibold">Facility</th>
                                        <th class="fw-semibold">Task Type</th>
                                        <th class="fw-semibold">Schedule Type</th>  
                                        <th class="fw-semibold">Due Date</th>
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
                        <!--tab 2 end-->
                    <div class="tab-pane" role="tabpanel" id="tab-3">
                        <section class="py-2">
                            <div class="bg-white border rounded border-info rounded-4 p-4">
                            <div id='fullCalendar' >
                            </div>
                        </div>
                        </section>
                        
                    </div> 
                    <!--tab 3 end-->
            </div>
            </div>
        </main>
@include('common.navigations.footer')
@include('tasks.schedule_task_modal')
<script src="{{url('https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js')}}"></script>
<script src="{{url('js/calendar.js')}}"></script>

<script>
    $(document).ready(function() {
        
        //$calendar = $('#fullCalendar').calendar();

        
    });
</script>

<script>
function initialise_calender()
    {
        today = new Date();
        y = today.getFullYear();
        m = today.getMonth();
        d = today.getDate();

        //$calendar = $('#fullCalendar').calendar();
        var calendarEl = document.getElementById('fullCalendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            timeFormat: 'H:mm',
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            defaultDate: today,
            selectable: true,
            selectHelper: true,
            editable: true,
            eventLimit: true,
            events: "{{url('calendar/events')}}",
            eventClick: function(calEvent, jsEvent, view) {
                @if($role!='user')
                console.log(calEvent);
                var task_id = calEvent.event._def.extendedProps.data.taskid;
                var isqa = calEvent.event._def.extendedProps.data.isqa;
                edit_task(this, task_id);
                //console.log(calEvent);
                    /*id = task_id;
                    if (!isqa) {
                        $.ajax({
                            type: 'GET',
                            url: '/tasks/' + id + '/edit',
                            success: function(res) {
                                $('.modal-body').html(res);
                                // show modal
                                $('#crud-modal').modal('show');
                            }
                        });
                    }*/
                    @endif
                    return true;
                },
                eventMouseover: function(calEvent, jsEvent, view) {
                    // Fill task information
                    // $.each(calEvent.data, function(key, value) {
                    //     $('#' + key).html(value);
                    // });
                    // change the border color just for fun
                    $(this).css('border-color', 'yellow');
                    $(this).css('border-style', 'inherit');

                
                },
                eventMouseout: function(calEvent, jsEvent, view) {
                    $(this).css('border-style', 'none');
                    $(this).css('border-color', 'none');
                },
                eventDrop: function(calEvent, delta, revertFunc, jsEvent, ui, view) {
                    console.log(calEvent);
                    console.log(calEvent.start.format());
                    console.log(delta);
                },
        });

        calendar.render();
        window.calendar=calendar;
        initEvents();
}

function initEvents() {
            // save button click invoke form submit
            $(document).on('click', '.modal-content .save-button', function(e) {
                $('.crud-form').submit();
            }); 
            
            // form submit (save or update item)
            $(document).on('submit', '.crud-form', function(e) {
                // prevent default submit action
                e.preventDefault();

                // reset all invalid fields before validate again
                resetInvalid();
                //Fetch form to apply custom Bootstrap validation
                
                var forms = $(".crud-form");
                // add class was-validated to form to show the error input
                forms.addClass('was-validated');
                if (forms[0].checkValidity() === false) {
                    //e.stopPropagation()
                    //notify('error', 'Error occurs. Please check the input');
                    // show error tooltip
                    $('select:invalid,input:invalid').first().each(function(){
                        this.reportValidity();
                    })
                    
                    return false;
                }
             
                // form valid, make ajax call (only send visible fields or hidden fields)
                var submitData = $(this).find('[type=hidden], :visible').serialize();
                
                var id = $('input[name=id]', $(this)).val();
                
                if (id) {
                    console.log(submitData);
                    $.ajax({
                        type: 'PUT',
                        url: '/tasks/' + id,
                        dataType: "json",
                        data: submitData, 
                        success: function(res) {
                            notify('success', 'Data saved successfully.')
                            $('#crud-modal').modal('hide');
                            reloadData();
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            if (xhr.status == 422) {
                                showValidationErrors(xhr.responseJSON);
                            }else if (xhr.status != 200) {
                                notify('error', 'Technical error occurs. Please try again')
                            }
                        }
                    });
                } 
            });
        
        }
        
        $("#schedule_task_form2").submit(function(e){
            e.preventDefault();
            create_task("#schedule_task_form2");
        });
    </script>
<script>
     function formatTimestamp(timestamp) {
    const date = new Date(timestamp * 1000); // Multiply by 1000 to convert seconds to milliseconds

    const day = ("0" + date.getDate()).slice(-2);
    const month = ("0" + (date.getMonth() + 1)).slice(-2); // Months are 0-indexed
    const year = date.getFullYear();
    
    const hours = ("0" + date.getHours()).slice(-2);
    const minutes = ("0" + date.getMinutes()).slice(-2);

    return `${day}/${month}/${year} ${hours}:${minutes}`;
}
    
    $(document).ready(function() {
    var table = $('#myTable').DataTable({
        "processing": true,      // Show loading indicator
        "serverSide": true,       // Enable server-side processing
        "searching": true,     // Disable the search box
        "lengthChange": false,   // Disable the "Show entries" dropdown
        "ajax": {
            "url": "{{url('list-displays-tasks')}}",  // URL to the script that provides data
            "type": "GET",               // Method type (GET or POST)
            "dataSrc": function (json) {
                //alert(json);
                console.log(json);  // Log the response to the console
                return json.data;
            }
        },
        "columns": [
                    { "data": "id", "visible": false },
                    {
                        "data": null,  // Show both manufacturer and model
                        "name": "display.model",
                        "className": "text-primary",
                        "render": function (data, type, row) {
                            // Combine manufacturer and model in one column
                            if(row.display.manufacturer==null) row.display.manufacturer='';
                            return row.display.manufacturer + '  ' + row.display.model+' ('+row.display.serial+')';
                        }
                    },
                    { "data": "display.workstation.name", name: "display.workstation.name",
                        "className": "text-body", },
                    { "data": "display.workstation.workgroup.name", name: "display.workstation.workgroup.name", 
                        "className": "text-body", },
                    { "data": "display.workstation.workgroup.facility.name", name: "display.workstation.workgroup.facility.name", 
                        "className": "text-body", },
                    { "data": "task_type.title", name: "type", 
                        "className": "text-body", },
                    { "data": "schedule_type.title", name: "type", 
                        "className": "text-body", },
                    
                    {
                        "data": null,  // Show both manufacturer and model
                        "name": "nextrun",
                        "className": "text-body",
                        "render": function (data, type, row) {
                            // Combine manufacturer and model in one column
                            if (row.nextrun && row.nextrun != 0) {
        return moment.unix(row.nextrun).format('DD/MM/YYYY HH:mm'); // Adjust this if needed
    }
    var date = row.startdate + ' ' + row.starttime;
    return moment(date).format('DD/MM/YYYY HH:mm');
                            if(row.startdate==null || row.nextrun==null || row.nextrun==0)
                                return '0';
                            else
                            return formatTimestamp(row.nextrun);
                        }
                    },
                    {
                        "data": null,  // Show both manufacturer and model
                        "name": "",
                        searchable: false,
                        sortable: false,
                        "render": function (data, type, row) {
                            return `@if($role!='user')<div class="dropdown">
                            <button class="btn btn-more px-1 py-0" aria-expanded="false" data-bs-toggle="dropdown" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-192 0 512 512" width="1em" height="1em" fill="currentColor" class="fs-5">
                                                        <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2023 Fonticons, Inc. -->
                                                        <path d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"></path>
                                                    </svg></button>
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-more">

<a class="dropdown-item" href="javascript:void(0)" onclick="edit_task(this, '`+row.id+`')">
    <span class="d-inline-block me-2">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M8 2V5" stroke="#049FD9" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M16 2V5" stroke="#049FD9" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M3.5 9.09009H20.5" stroke="#049FD9" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M21 8.5V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V8.5C3 5.5 4.5 3.5 8 3.5H16C19.5 3.5 21 5.5 21 8.5Z" stroke="#049FD9" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M15.6947 13.7H15.7037" stroke="#049FD9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M15.6947 16.7H15.7037" stroke="#049FD9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M11.9955 13.7H12.0045" stroke="#049FD9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M11.9955 16.7H12.0045" stroke="#049FD9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M8.29431 13.7H8.30329" stroke="#049FD9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M8.29431 16.7H8.30329" stroke="#049FD9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>


</span>Schedule Task</a>
<a class="dropdown-item" href="javascript:void(0)" onclick="delete_task(this, '`+row.id+`')" >
    <span class="d-inline-block me-2">
        <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M19 4.98001C15.67 4.65001 12.32 4.48001 8.98 4.48001C7 4.48001 5.02 4.58001 3.04 4.78001L1 4.98001" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M6.5 3.97L6.72 2.66C6.88 1.71 7 1 8.69 1H11.31C13 1 13.13 1.75 13.28 2.67L13.5 3.97" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M16.85 8.14001L16.2 18.21C16.09 19.78 16 21 13.21 21H6.79002C4.00002 21 3.91002 19.78 3.80002 18.21L3.15002 8.14001" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M8.33002 15.5H11.66" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M7.5 11.5H12.5" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</span>Delete Task</a></div>
                                        </div>@endif`;
                        }
                    },
        ]
    });

    $('#myTable-search').on('keyup change', function() {
        table.search(this.value).draw();  // Trigger global search on DataTable
    });

    @if(isset($_GET['keywords']))
    table.search($("#myTable-search").val()).draw();
    @endif

    window.table=table;
    window.tasks_table1=table;
});
    
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
    
     function fetch_displays_checklist(th){
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
    
    //delete task
    window.delete_id=0;
    function delete_task(th, id)
    {
        $("#modal-delete").modal('show');
        window.delete_id=id;
    }

    function confirm_delete(th)
    {
        var formData=new FormData();
        formData.append('_token', '{{csrf_token()}}');
        formData.append('id', window.delete_id);
                
        $.ajax({
            url: "<?php echo url('delete-task') ?>",
            type: "POST",
            data:  formData,
            beforeSend: function(){ //alert('sending');
                $(th).attr('disabled', true);
            },
            contentType: false,
            processData:false,
            success: function(data) { //alert(data);
                //success
                // here we will handle errors and validation messages
                $(th).attr('disabled', false);
                if ( ! data.success) {
                    notify('failed', data.msg);
                } else {
                    // ALL GOOD! just show the success message!
                    window.table.draw();
                    $("#modal-delete").modal('hide');
                    notify('success', data.msg);
                }
            },
            error: function()  {
                //error
            } 	        
        });
    }
    
    //schedule tasks
    $(document).ready(function() {
    var table = $('#scheduleTable').DataTable({
        "processing": true,      // Show loading indicator
        "serverSide": true,       // Enable server-side processing
        "searching": true,     // Disable the search box
        "lengthChange": false,   // Disable the "Show entries" dropdown
        "ajax": {
            "url": "{{url('list-tasks')}}",  // URL to the script that provides data
            "type": "GET",               // Method type (GET or POST)
            "data": function(d) {
                d.facility_id = $('#facility_field2').val();      // Facility ID
                d.workstation_id = $('#workstations_field2').val(); // Workstation ID
                d.workgroup_id = $('#workgroups_field2').val();     // Workgroup ID
                d.displays = [];
                $('#displays_field2 input[name="displays[]"]:checked').each(function() {
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
                    {
                        "data": null,  // Show both manufacturer and model
                        "name": "display",
                        "className": "text-primary",
                        "render": function (data, type, row) {
                            // Combine manufacturer and model in one column
                            return row.display;
                            if(row.display.manufacturer==null) row.display.manufacturer='';
                            return row.display.manufacturer + '  ' + row.display.model+' ('+row.display.serial+')';
                        }
                    },
                    { "data": "workstation", name: "workstation",
                        "className": "text-body", },
                    { "data": "workgroup", name: "workgroup",
                        "className": "text-body", },
                    { "data": "facility", name: "facility",
                        "className": "text-body", },
                    { "data": "name", name: "name",
                        "className": "text-body", },
                    { "data": "schtype", name: "schtype",
                        "className": "text-body", },
                    {
                    "data": "duedate",
                    "name": "due_date_sort",
                        "className": "text-body text-left",
                },
                    /*{
                        "data": null,  // Show both manufacturer and model
                        "name": "due_date_sort",
                        "className": "text-body text-left",
                        "render": function (data, type, row) {
    if (row.nextrun && row.nextrun != 0) {
        return moment.unix(row.nextrun).format('DD/MM/YYYY HH:mm'); // Adjust this if needed
    }
    var date = row.startdate + ' ' + row.starttime;
    return moment(date).format('DD/MM/YYYY HH:mm');
}
                    },*/
                    {
                        "data": null,  // Show both manufacturer and model
                        "name": "",
                        searchable: false,
                        sortable: false,
                        "render": function (data, type, row) {
                            return `@if($role!='user')<div class="dropdown">
                            <button class="btn btn-more px-1 py-0" aria-expanded="false" data-bs-toggle="dropdown" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-192 0 512 512" width="1em" height="1em" fill="currentColor" class="fs-5">
                                                        <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2023 Fonticons, Inc. -->
                                                        <path d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"></path>
                                                    </svg></button>
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-more">

<a class="dropdown-item" href="javascript:void(0)" onclick="edit_task(this, '`+row.id+`')">
    <span class="d-inline-block me-2">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M8 2V5" stroke="#049FD9" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M16 2V5" stroke="#049FD9" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M3.5 9.09009H20.5" stroke="#049FD9" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M21 8.5V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V8.5C3 5.5 4.5 3.5 8 3.5H16C19.5 3.5 21 5.5 21 8.5Z" stroke="#049FD9" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M15.6947 13.7H15.7037" stroke="#049FD9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M15.6947 16.7H15.7037" stroke="#049FD9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M11.9955 13.7H12.0045" stroke="#049FD9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M11.9955 16.7H12.0045" stroke="#049FD9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M8.29431 13.7H8.30329" stroke="#049FD9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M8.29431 16.7H8.30329" stroke="#049FD9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>


</span>Schedule Task</a>
<a class="dropdown-item" href="javascript:void(0)" onclick="delete_task(this, '`+row.id+`')" >
    <span class="d-inline-block me-2">
        <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M19 4.98001C15.67 4.65001 12.32 4.48001 8.98 4.48001C7 4.48001 5.02 4.58001 3.04 4.78001L1 4.98001" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M6.5 3.97L6.72 2.66C6.88 1.71 7 1 8.69 1H11.31C13 1 13.13 1.75 13.28 2.67L13.5 3.97" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M16.85 8.14001L16.2 18.21C16.09 19.78 16 21 13.21 21H6.79002C4.00002 21 3.91002 19.78 3.80002 18.21L3.15002 8.14001" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M8.33002 15.5H11.66" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M7.5 11.5H12.5" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</span>Delete Task</a></div>
                                        </div>@endif`;
                        }
                    },
        ],
        order: [[ 7, "desc" ]],
    });

    window.tasks_table=table;

    $('#myTable-search2').on('keyup change', function() {
        table.search(this.value).draw();  // Trigger global search on DataTable
    });

    @if(isset($_GET['keywords']))
    table.search($("#myTable-search2").val()).draw();
    @endif

    window.table=table;
    window.tasks_table2=table;
});

    function search_filters(th)
    {
        /*var facility=$("#facility_field2").find('option:selected').text();
        var workgroup=$("#workgroups_field2").find('option:selected').text();
        var workstation=$("#workstations_field2").find('option:selected').text();

        var facility_val=$("#facility_field2").val();
        var workgroup_val=$("#workgroups_field2").val();
        var workstation_val=$("#workstations_field2").val();

        var search='';
        if(workstation_val!='' && workstation_val!=null) search=workstation;
        else if(workgroup_val!='' && workgroup_val!=null) search=workgroup;
        else if(facility_val!='' && facility_val!=null) search=facility;
        $('#myTable-search2').val(search).trigger('keyup');*/

        window.tasks_table.ajax.reload();
    }

    $('#displays_field2').on('change', 'input[name="displays[]"]', function() {
        window.tasks_table.ajax.reload();
    });
    
    function fetch_workgroups2(th)
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
                    $("#workgroups_field2").empty();
                    $("#workgroups_field2").append(data.content);
                }
            },
            error: function()  {
                //error
            } 	        
        });
    }

     function fetch_workstations2(th){
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
                    $("#workstations_field2").empty();
                    $("#workstations_field2").append(data.content);
                }
            },
            error: function()  {
                //error
            } 	        
        });
    }
    
     function fetch_displays_checklist2(th){
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
                    $("#displays_field2").empty();
                    $("#displays_field2").append(data.content);

                    $(th).parent().parent().next().children().children().children('#displays-dropdown').text('Please select');
                }
            },
            error: function()  {
                //error
            } 	        
        });
    }
</script>