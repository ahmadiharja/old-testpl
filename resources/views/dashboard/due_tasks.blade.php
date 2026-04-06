@include('common.navigations.header');

<main class="main-vertical-layout">
            <div class="container-fluid">
                 <section class="py-4">
                    <div class="bg-white border rounded border-info rounded-4 pt-4">
                        <h4 class="text-primary mb-0 ps-4">All Tasks</h4>
                        <div class="table-responsive rounded-4">
                        @if(count($due_tasks_recents)==0)
                            <hr class="m-0">
                            <div class="text-center p-5">
                            <svg width="60" height="60" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
<circle opacity="0.2" cx="15" cy="15" r="15" fill="#27AE60"/>
<path d="M12.714 18.1771L10.0702 15.5333C9.92776 15.3908 9.73454 15.3108 9.53307 15.3108C9.3316 15.3108 9.13839 15.3908 8.99593 15.5333C8.85347 15.6757 8.77344 15.8689 8.77344 16.0704C8.77344 16.1702 8.79309 16.2689 8.83126 16.3611C8.86944 16.4533 8.92539 16.537 8.99593 16.6075L12.1807 19.7923C12.4778 20.0894 12.9578 20.0894 13.255 19.7923L21.3159 11.7313C21.4584 11.5889 21.5384 11.3957 21.5384 11.1942C21.5384 10.9927 21.4584 10.7995 21.3159 10.6571C21.1735 10.5146 20.9803 10.4346 20.7788 10.4346C20.5773 10.4346 20.3841 10.5146 20.2416 10.6571L12.714 18.1771Z" fill="#27AE60"/>
</svg>
<h6 class="mt-3">Nothing to check here!</h6>
                            </div>
                            @else
                            <table class="table mb-0 table-light" id="myTable">
                                <thead>
                                    <tr class="table-primary">
                                        <th></th>
                                        <th class="fw-semibold fw-semibold">Display</th>
                                        <th class="fw-semibold">Workstation</th>
                                        <th class="fw-semibold">Workgroup</th>
                                        <th class="fw-semibold">Facility</th>
                                        <th class="fw-semibold">Task Type</th>
                                        <th class="text-nowrap fw-semibold">Schedule type</th>
                                        <th class="text-nowrap fw-semibold">Due Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <!--<tr>
                                        <td class="text-body" colspan="5">Showing {{count($due_tasks_recents)}} of {{$due_tasks}} entries</td>
                                        <td colspan="2">
                                            <nav>
                                                <ul class="pagination mb-0 justify-content-lg-end">
                                                    <li class="page-item disabled"><a class="page-link" aria-label="Previous" href="javascript:void(0)"><span aria-hidden="true">«</span></a></li>
                                                    <li class="page-item active"><a class="page-link" href="javascript:void(0)">1</a></li>
                                                    <li class="page-item disabled"><a class="page-link" aria-label="Next" href="javascript:void(0)"><span aria-hidden="true">»</span></a></li>
                                                </ul>
                                            </nav>
                                        </td>
                                    </tr>-->
                                </tfoot>
                            </table>
                            @endif
                        </div>
                    </div>
                </section>
            </div>
 </main>

@include('common.navigations.footer')

@include('tasks.schedule_task_modal')

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
            "url": "{{url('list-tasks')}}",  // URL to the script that provides data
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
                        "data": null,  // Show both manufacturer and model
                        "name": "duedate",
                        "className": "text-body text-left",
                        "render": function (data, type, row) {
                            // Combine manufacturer and model in one column
                            return row.duedate;
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
                            return `<div class="dropdown">
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
</script>
