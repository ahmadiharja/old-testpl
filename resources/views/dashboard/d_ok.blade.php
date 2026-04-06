@include('common.navigations.header');

<main class="main-vertical-layout">
            <div class="container-fluid">
                <section class="py-2">
                    <div class="bg-white border rounded border-info rounded-4 pt-4">
                        <h4 class="text-primary mb-3 ps-4">Displays Ok</h4>
                        <div class="table-responsive rounded-4">
                            @if(count($d_ok_recent)==0)
                            <hr class="m-0">
                            <div class="text-center p-5">
                            <svg width="60" height="60" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
<circle opacity="0.2" cx="15" cy="15" r="15" fill="#27AE60"/>
<path d="M12.714 18.1771L10.0702 15.5333C9.92776 15.3908 9.73454 15.3108 9.53307 15.3108C9.3316 15.3108 9.13839 15.3908 8.99593 15.5333C8.85347 15.6757 8.77344 15.8689 8.77344 16.0704C8.77344 16.1702 8.79309 16.2689 8.83126 16.3611C8.86944 16.4533 8.92539 16.537 8.99593 16.6075L12.1807 19.7923C12.4778 20.0894 12.9578 20.0894 13.255 19.7923L21.3159 11.7313C21.4584 11.5889 21.5384 11.3957 21.5384 11.1942C21.5384 10.9927 21.4584 10.7995 21.3159 10.6571C21.1735 10.5146 20.9803 10.4346 20.7788 10.4346C20.5773 10.4346 20.3841 10.5146 20.2416 10.6571L12.714 18.1771Z" fill="#27AE60"/>
</svg>
<h6 class="mt-3">Nothing to check here!</h6>
                            </div>
                            @else
                            <table class="table mb-0 table-light">
                                <thead>
                                    <tr class="table-primary">
                                        <th class="fw-semibold">Display Name</th>
                                        <th class="fw-semibold">Location</th>
                                        <th class="fw-semibold">Error</th>
                                        <th class="fw-semibold">Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($d_ok_recent as $d)
                                    <tr>
                                        <td class="text-primary">{{$d->manufacturer}} {{$d->model}} ({{$d->serial}})</td>
                                       
                                        <td class="text-body">
                                             @if($d->workstation->workgroup->address!=NULL)
                                        {{$d->workstation->workgroup->address}}
                                        
                                        @if($d->workstation->workgroup->city!=NULL)
                                        , {{$d->workstation->workgroup->city}}
                                        @endif
                                        
                                        @if($d->workstation->workgroup->state!=NULL)
                                        , {{$d->workstation->workgroup->state}}
                                         @endif
                                            
                                        @endif
                                        </td>
                                        <td class="text-danger">
                                             @if ($errors = json_decode($d->errors, true))
                                            
                                            @foreach($errors as $error)
                                            {{$error}}
                                            @endforeach
                                            
                                            @endif
                                        </td>
                                        <td class="text-body">{{date_format(new DateTime($d->updated_at), 'd/m/Y, h:i A')}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-more px-1 py-0" aria-expanded="false" data-bs-toggle="dropdown" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-192 0 512 512" width="1em" height="1em" fill="currentColor" class="fs-5">
                                                        <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2023 Fonticons, Inc. -->
                                                        <path d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"></path>
                                                    </svg>
                                                    </button>
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-more"><a class="dropdown-item" href="#"><span class="d-inline-block me-2"><svg width="22" height="20" viewbox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.58 10C14.58 11.98 12.98 13.58 11 13.58C9.02004 13.58 7.42004 11.98 7.42004 10C7.42004 8.02001 9.02004 6.42001 11 6.42001C12.98 6.42001 14.58 8.02001 14.58 10Z" stroke="#049FD9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M11 18.27C14.53 18.27 17.82 16.19 20.11 12.59C21.01 11.18 21.01 8.81 20.11 7.4C17.82 3.8 14.53 1.72 11 1.72C7.47003 1.72 4.18003 3.8 1.89003 7.4C0.990027 8.81 0.990027 11.18 1.89003 12.59C4.18003 16.19 7.47003 18.27 11 18.27Z" stroke="#049FD9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>View Workgroup</a><a class="dropdown-item" href="#"><span class="d-inline-block me-2"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M10 1H8C3 1 1 3 1 8V14C1 19 3 21 8 21H14C19 21 21 19 21 14V12" stroke="#27AE60" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M15.04 2.02001L7.16 9.90001C6.86 10.2 6.56 10.79 6.5 11.22L6.07 14.23C5.91 15.32 6.68 16.08 7.77 15.93L10.78 15.5C11.2 15.44 11.79 15.14 12.1 14.84L19.98 6.96001C21.34 5.60001 21.98 4.02001 19.98 2.02001C17.98 0.0200086 16.4 0.660009 15.04 2.02001Z" stroke="#27AE60" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M13.91 3.14999C14.58 5.53999 16.45 7.40999 18.85 8.08999" stroke="#27AE60" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</span>Edit Workgroup</a><a class="dropdown-item" href="#"><span class="d-inline-block me-2"><svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M19 4.98001C15.67 4.65001 12.32 4.48001 8.98 4.48001C7 4.48001 5.02 4.58001 3.04 4.78001L1 4.98001" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M6.5 3.97L6.72 2.66C6.88 1.71 7 1 8.69 1H11.31C13 1 13.13 1.75 13.28 2.67L13.5 3.97" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M16.85 8.14001L16.2 18.21C16.09 19.78 16 21 13.21 21H6.79002C4.00002 21 3.91002 19.78 3.80002 18.21L3.15002 8.14001" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M8.33002 15.5H11.66" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M7.5 11.5H12.5" stroke="#EB5757" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</span>Delete Workgroup</a></div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-body" colspan="3">Showing {{count($d_ok_recent)}} of {{$d_ok}} entries</td>
                                        <td colspan="2">
                                            <nav>
                                                <ul class="pagination mb-0 justify-content-lg-end">
                                                    <li class="page-item disabled"><a class="page-link" aria-label="Previous" href="#"><span aria-hidden="true">«</span></a></li>
                                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                    <li class="page-item disabled"><a class="page-link" aria-label="Next" href="#"><span aria-hidden="true">»</span></a></li>
                                                </ul>
                                            </nav>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            @endif
                        </div>
                    </div>
                </section>
                            </div>
        </main>

@include('common.navigations.footer');