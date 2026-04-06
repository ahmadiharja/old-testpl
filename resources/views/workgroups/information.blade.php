@include('common.navigations.header')
        
        <main class="main-vertical-layout">
           <div class="container-fluid">
               
               <section class="py-4 pb-0">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <a href="{{url('facility-info/'.$item->facility->id)}}">
                                <button class="btn btn-info btn-sm rounded-pill mt-0" type="button">Back to facility</button>
                            </a>
                        </div>
                        <div>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a class="breadcrumb-link" href="{{url('facility-info/'.$item->facility->id)}}"><span>{{$item->facility->name}}</span></a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{$item->name}}</li>
                            </ol>
                        </div>
                    </div>
                </section>
                
                <section class="py-4">
                    <div class="bg-white border rounded border-info rounded-4 pt-4">
                        <div class="d-flex flex-column justify-content-between align-items-center flex-sm-row px-4 mb-3">
                            <div>
                                <h5 class="text-primary mb-0">Workgroup</h5>
                                
                            </div>
                            
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
                         <hr class="mb-0">
                        <div class="table-responsive rounded-4">
                            <table class="table mb-0 table-light">
                                
                                <tbody>
                                    <tr>
                                        <td class="border-0">
                                            <div class="row">
                                                <div class="col-12"><b>Workgroup Name</b>
                                                    <br><span class="text-muted">{{$item->name}}</span></div>
                                            </div>
                                        </td>
                                        <td class="border-0" >
                                            <div class="row">
                                                <div class="col-12 font-weight-bold"><b>Facility</b>
                                                    
                                                    <br><span class="text-muted">{!!$item->facility->link!!}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-0">
                                            <div class="row">
                                                <div class="col-12 font-bold"><b>Address</b>
                                                    @if($item->address=='')
                                                    <br><span class="text-muted">-</span>
                                                    @else
                                                    <br><span class="text-muted">{{$item->address}}</span>
                                                @endif
                                                    </div>
                                            </div>
                                            </td>
                                        <td class="border-0">
                                             <div class="row">
                                                <div class="col-12 font-weight-bold"><b>Phone Number</b>
                                                    @if($item->phone=='')
                                                    <br><span class="text-muted">-</span>
                                                    @else
                                                    <br><span class="text-muted">{{$item->phone}}</span>
                                                 @endif</div>
                                            </div>
                                            </td>
                                    </tr>
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </section>
            </div>
            
            <div class="container-fluid">
                <section class="py-4">
                    <div class="bg-white border rounded border-info rounded-4 pt-4">
                        <div class="d-flex flex-column justify-content-between align-items-center flex-sm-row px-4 mb-3">
                            <div>
                                <h5 class="text-primary mb-0">{{$item->name}}'s Workstations</h5>
                            </div>
                            
                        </div>
                        <div class="table-responsive rounded-4">
                            <table class="table mb-0 table-light" style="width:100%;" id="myTable">
                                <thead>
                                    <tr class="table-primary">
                                        <td></td>
                                        <th class="fw-semibold"> Name</th>
                                        <th class="fw-semibold">Sleep Time</th>
                                       <th></th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <!--<tr>
                                        <td class="text-body" colspan="2">Showing 2 of 2 entries</td>
                                        <td colspan="1">
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
            </div>
        </main>
@include('common.navigations.footer')
@php
$delete_url=url('delete-workstation');
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
            "url": "{{url('list-workstations?workgroup_id='.$item->id)}}",  // URL to the script that provides data
            "type": "GET",               // Method type (GET or POST)
            "dataSrc": function (json) {
                //alert(json);
                console.log(json);  // Log the response to the console
                return json.data;
            },
        onSubmitData: function(d) {                
            d.workstation_id = '{{$item->id}}';
            return d;
        }
        },
        "columns": [
            { "data": "id", "visible": false },
            {
                        "data": null,  // Show both manufacturer and model
                        "name": "name",
                        "className": "text-primary",
                        "render": function (data, type, row) {
                            return '<a href="{{url("/")}}/workstations-info/'+row.id+'">'+row.name+'</a>';
                        }
                    },
                    { "data": "sleepTime", name: "sleep_time", "defaultContent":"Off", className: "text-body" },
           
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
                                                    @if($role!='user')<a class="dropdown-item" href="{{url('application-settings')}}/` + row.id + `"><span class="d-inline-block me-2"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="#049FD9" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M2 12.88V11.12C2 10.08 2.85 9.22 3.9 9.22C5.71 9.22 6.45 7.94 5.54 6.37C5.02 5.47 5.33 4.3 6.24 3.78L7.97 2.79C8.76 2.32 9.78 2.6 10.25 3.39L10.36 3.58C11.26 5.15 12.74 5.15 13.65 3.58L13.76 3.39C14.23 2.6 15.25 2.32 16.04 2.79L17.77 3.78C18.68 4.3 18.99 5.47 18.47 6.37C17.56 7.94 18.3 9.22 20.11 9.22C21.15 9.22 22.01 10.07 22.01 11.12V12.88C22.01 13.92 21.16 14.78 20.11 14.78C18.3 14.78 17.56 16.06 18.47 17.63C18.99 18.54 18.68 19.7 17.77 20.22L16.04 21.21C15.25 21.68 14.23 21.4 13.76 20.61L13.65 20.42C12.75 18.85 11.27 18.85 10.36 20.42L10.25 20.61C9.78 21.4 8.76 21.68 7.97 21.21L6.24 20.22C5.33 19.7 5.02 18.53 5.54 17.63C6.45 16.06 5.71 14.78 3.9 14.78C2.85 14.78 2 13.92 2 12.88Z" stroke="#049FD9" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
</svg></span>Settings</a>@endif
<a class="dropdown-item" href="{{url('workstations-info')}}/` + row.id + `">
                                                        <span class="d-inline-block me-2">
                                                            <svg width="22" height="20" viewbox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.58 10C14.58 11.98 12.98 13.58 11 13.58C9.02004 13.58 7.42004 11.98 7.42004 10C7.42004 8.02001 9.02004 6.42001 11 6.42001C12.98 6.42001 14.58 8.02001 14.58 10Z" stroke="#049FD9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M11 18.27C14.53 18.27 17.82 16.19 20.11 12.59C21.01 11.18 21.01 8.81 20.11 7.4C17.82 3.8 14.53 1.72 11 1.72C7.47003 1.72 4.18003 3.8 1.89003 7.4C0.990027 8.81 0.990027 11.18 1.89003 12.59C4.18003 16.19 7.47003 18.27 11 18.27Z" stroke="#049FD9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                                        </span>View Workstation
                                                    </a>
                                                    @if($role!='user')
<a class="dropdown-item" href="javascript:void(0)" onclick="delete_record(this, '`+row.id+`')"><span class="d-inline-block me-2"><svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M19 4.98001C15.67 4.65001 12.32 4.48001 8.98 4.48001C7 4.48001 5.02 4.58001 3.04 4.78001L1 4.98001" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M6.5 3.97L6.72 2.66C6.88 1.71 7 1 8.69 1H11.31C13 1 13.13 1.75 13.28 2.67L13.5 3.97" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M16.85 8.14001L16.2 18.21C16.09 19.78 16 21 13.21 21H6.79002C4.00002 21 3.91002 19.78 3.80002 18.21L3.15002 8.14001" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M8.33002 15.5H11.66" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M7.5 11.5H12.5" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</span>Delete Workstation</a>@endif
                                                  
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