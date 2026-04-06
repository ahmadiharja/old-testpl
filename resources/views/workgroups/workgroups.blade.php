@include('common.navigations.header');
        <main class="main-vertical-layout">
            <div class="container-fluid">
            <div class="row mt-0">
                    <!--button-->
                    <div class="col-md-6">
                        <div class="dropdown d-inline-block dropdown-arrow"><button class="btn btn-info dropdown-toggle rounded-pill" aria-expanded="false" data-bs-toggle="dropdown" type="button"><span class="d-none d-lg-inline-block me-2"><svg width="16" height="15" viewbox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 11.333C5.93333 11.333 5.87333 11.3197 5.80667 11.293C5.62 11.2197 5.5 11.033 5.5 10.833V6.83301C5.5 6.55967 5.72667 6.33301 6 6.33301C6.27333 6.33301 6.5 6.55967 6.5 6.83301V9.62634L6.98 9.14634C7.17333 8.95301 7.49333 8.95301 7.68667 9.14634C7.88 9.33967 7.88 9.65967 7.68667 9.85301L6.35333 11.1863C6.26 11.2797 6.12667 11.333 6 11.333Z" fill="white"></path><path d="M6 11.3326C5.87334 11.3326 5.74667 11.286 5.64667 11.186L4.31333 9.85264C4.12 9.65931 4.12 9.33931 4.31333 9.14598C4.50667 8.95264 4.82667 8.95264 5.02 9.14598L6.35333 10.4793C6.54667 10.6726 6.54667 10.9926 6.35333 11.186C6.25333 11.286 6.12667 11.3326 6 11.3326Z" fill="white"></path><path d="M10 14.6663H6.00004C2.38004 14.6663 0.833374 13.1197 0.833374 9.49967V5.49967C0.833374 1.87967 2.38004 0.333008 6.00004 0.333008H9.33337C9.60671 0.333008 9.83337 0.559674 9.83337 0.833008C9.83337 1.10634 9.60671 1.33301 9.33337 1.33301H6.00004C2.92671 1.33301 1.83337 2.42634 1.83337 5.49967V9.49967C1.83337 12.573 2.92671 13.6663 6.00004 13.6663H10C13.0734 13.6663 14.1667 12.573 14.1667 9.49967V6.16634C14.1667 5.89301 14.3934 5.66634 14.6667 5.66634C14.94 5.66634 15.1667 5.89301 15.1667 6.16634V9.49967C15.1667 13.1197 13.62 14.6663 10 14.6663Z" fill="white"></path><path d="M14.6667 6.66633H12C9.72004 6.66633 8.83337 5.77967 8.83337 3.49967V0.833C8.83337 0.633 8.95337 0.446334 9.14004 0.373C9.32671 0.293 9.54004 0.339667 9.68671 0.479667L15.02 5.813C15.16 5.953 15.2067 6.173 15.1267 6.35967C15.0467 6.54633 14.8667 6.66633 14.6667 6.66633ZM9.83337 2.03967V3.49967C9.83337 5.21967 10.28 5.66633 12 5.66633H13.46L9.83337 2.03967Z" fill="white"></path></svg></span>Download&nbsp;</button>
                                <div class="dropdown-menu">
                                    @php
                                    $type='';
                                    if(isset($_GET['type'])) $type=$_GET['type'];
                                    @endphp
                                    <a class="dropdown-item" href="{{url('reports/workgroups?export_type=excel')}}" target="_blank">Download Excel</a>
                                    <a class="dropdown-item" href="{{url('reports/workgroups?export_type=pdf')}}" target="_blank">Download PDF</a>
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
                        <div class="d-flex flex-column justify-content-between align-items-center flex-sm-row px-4 mb-0">
                            <div>
                                <h4 class="text-primary mb-0">Workgroups</h4>
                            </div>
                            <div class="mt-3 mt-sm-0">
                                @if($role!='user')
                                <button class="btn btn-info rounded-pill" onclick="workgroup_form(this, 'create')" type="button" data-bs-target="#modal-1" data-bs-toggle="modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="-32 0 512 512" width="1em" height="1em" fill="currentColor" class="fs-5 me-2">
                                        <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2023 Fonticons, Inc. -->
                                        <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"></path>
                                    </svg>Add Workgroup
                                </button>
                                @endif
                            </div>
                        </div>
                        <div class="table-responsive rounded-4">
                            <table class="table mb-0 table-light" id="myTable">
                                <thead>
                                    <tr class="table-primary">
                                        <th></th>
                                        <th class="fw-semibold">Name</th>
                                        <th class="fw-semibold">Address</th>
                                        <th class="fw-semibold">Phone</th>
                                        <th class="fw-semibold">Facility</th>
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
                                            <div class="modal-body py-4" id="workgroup_form_box">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

@include('common.navigations.footer')
@php
$delete_url=url('delete-workgroup');
@endphp
@include('common.delete_record')

<script>
    $(document).ready(function() {
    var table = $('#myTable').DataTable({
        "processing": true,      // Show loading indicator
        "serverSide": true,       // Enable server-side processing
        "searching": true,     // Disable the search box
        "lengthChange": false,   // Disable the "Show entries" dropdown
        "ajax": {
            "url": "{{url('list-workgroups')}}",  // URL to the script that provides data
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
                        "data": "name",  // Show both manufacturer and model
                        "name": "name",
                        "className": "text-primary",
                        "render": function (data, type, row) {
                            return '<a href="{{url("/")}}/workgroups-info/'+row.id+'">'+ row.name +'</a>';
                        }
                    },
                    { "data": "address", name: "address", className: "text-body" },
                    { "data": "phone", name: "phone", className: "text-left text-body" },
                    { "data": "facility.name", name: "facility.name", className: "text-body" },
                    {
                        "data": null,  // Show both manufacturer and model
                        "name": "",
                        searchable: false,
                        sortable: false,
                        "render": function (data, type, row) {
                            return `<div class="dropdown"><button class="btn btn-more px-1 py-0" aria-expanded="false" data-bs-toggle="dropdown" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-192 0 512 512" width="1em" height="1em" fill="currentColor" class="fs-5">
                                                        <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2023 Fonticons, Inc. -->
                                                        <path d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"></path>
                                                    </svg></button>
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-more">
                                                    <a class="dropdown-item" href="{{url('workgroups-info')}}/` + row.id + `">
                                                        <span class="d-inline-block me-2">
                                                            <svg width="22" height="20" viewbox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.58 10C14.58 11.98 12.98 13.58 11 13.58C9.02004 13.58 7.42004 11.98 7.42004 10C7.42004 8.02001 9.02004 6.42001 11 6.42001C12.98 6.42001 14.58 8.02001 14.58 10Z" stroke="#049FD9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M11 18.27C14.53 18.27 17.82 16.19 20.11 12.59C21.01 11.18 21.01 8.81 20.11 7.4C17.82 3.8 14.53 1.72 11 1.72C7.47003 1.72 4.18003 3.8 1.89003 7.4C0.990027 8.81 0.990027 11.18 1.89003 12.59C4.18003 16.19 7.47003 18.27 11 18.27Z" stroke="#049FD9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                                        </span>View Workgroup
                                                    </a>
                                                    @if($role!='user')
                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="workgroup_form(this, 'edit', '`+row.id+`')" data-bs-target="#modal-1" data-bs-toggle="modal">
                                                    <span class="d-inline-block me-2"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10 1H8C3 1 1 3 1 8V14C1 19 3 21 8 21H14C19 21 21 19 21 14V12" stroke="#27AE60" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M15.04 2.02001L7.16 9.90001C6.86 10.2 6.56 10.79 6.5 11.22L6.07 14.23C5.91 15.32 6.68 16.08 7.77 15.93L10.78 15.5C11.2 15.44 11.79 15.14 12.1 14.84L19.98 6.96001C21.34 5.60001 21.98 4.02001 19.98 2.02001C17.98 0.0200086 16.4 0.660009 15.04 2.02001Z" stroke="#27AE60" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M13.91 3.14999C14.58 5.53999 16.45 7.40999 18.85 8.08999" stroke="#27AE60" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</span>Edit Workgroup</a>
<a class="dropdown-item" href="javascript:void(0)" onclick="delete_record(this, '`+row.id+`')"><span class="d-inline-block me-2"><svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M19 4.98001C15.67 4.65001 12.32 4.48001 8.98 4.48001C7 4.48001 5.02 4.58001 3.04 4.78001L1 4.98001" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M6.5 3.97L6.72 2.66C6.88 1.71 7 1 8.69 1H11.31C13 1 13.13 1.75 13.28 2.67L13.5 3.97" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M16.85 8.14001L16.2 18.21C16.09 19.78 16 21 13.21 21H6.79002C4.00002 21 3.91002 19.78 3.80002 18.21L3.15002 8.14001" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M8.33002 15.5H11.66" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M7.5 11.5H12.5" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</span>Delete Workgroup</a>
@endif
</div>
                                            </div>`;
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
});
</script>

<script>
    function workgroup_form(th, action, id='0')
    {
        var formData=new FormData();
        formData.append('_token', '{{csrf_token()}}');
        formData.append('id', id);
        
         $.ajax({
            url: "{{url('workgroup-form')}}",
            type: "POST",
            data:  formData,
            beforeSend: function(){ //alert('sending');
            },
            contentType: false,
            processData:false,
            success: function(data) { //alert(data);
                if ( ! data.success) {
                } else {
                    // ALL GOOD! just show the success message!
                    $("#workgroup_form_box").empty();
                    $("#workgroup_form_box").append(data.content);
                }
            },
            error: function()  {
                //error
            } 	        
        });
    }
</script>