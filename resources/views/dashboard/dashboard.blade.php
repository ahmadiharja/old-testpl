@include('common.navigations.header')
<style>
    .accordion-body h6{
        color: #049fd9;
        font-weight: bold;
    }

    .accordion-body p{
        margin-bottom: 30px;
    }

    .accordion-button{
        color: #002247!important;
        font-size: 22px;
    }
</style>

{{-- <div class="float-right">
          <select class="form-control" name="period" id="period">
            <option value="1">Today so far</option>
            <option selected value="2">Last 7 days</option>
            <option value="3">This month</option>
            <option value="4">Last month</option>
            <option value="5">Last 30 days</option>
          </select>
        </div> --}}

        <main class="main-vertical-layout">
            <div class="container-fluid">
                <section class="py-4">
                    <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-4">
                        <a href="{{url('displays?type=ok')}}" style="text-decoration: none;">
                        <div class="col">
                            <div class="card card-stats">
                                <div class="card-body pt-0">
                                    <div class="d-flex h-100">
                                        <div class="flex-shrink-0">
                                            <div class="bg-white d-flex flex-column justify-content-center card-stats-icon rounded-4 rounded-top-0 px-2"><svg width="53" height="53" viewBox="0 0 53 53" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M31.127 6.73022H13.5445C6.07819 6.73022 4.20636 8.60205 4.20636 16.0683V29.4024C4.20636 36.8687 6.07819 38.7405 13.5445 38.7195H36.9318C44.398 38.7195 46.2699 36.8687 46.2699 29.3814V21.8731" stroke="#27AE60" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M25.2381 38.7405V48.7937" stroke="#27AE60" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M4.20636 29.8652H46.2699" stroke="#27AE60" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M15.7738 48.7937H34.7024" stroke="#27AE60" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M51.3175 12.1985C51.3175 14.1702 50.7654 16.0368 49.7927 17.6142C49.2406 18.5606 48.5308 19.4019 47.7158 20.0854C45.8755 21.7416 43.4568 22.7144 40.8016 22.7144C36.9633 22.7144 33.6245 20.6638 31.8105 17.6142C30.8378 16.0368 30.2857 14.1702 30.2857 12.1985C30.2857 8.88599 31.8105 5.91527 34.2292 3.99612C36.0431 2.55019 38.3303 1.68262 40.8016 1.68262C46.6116 1.68262 51.3175 6.38847 51.3175 12.1985Z" stroke="#27AE60" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M37.0159 12.1836L39.4183 15.143L44.5873 9.25415" stroke="#27AE60" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
</svg></div>
                                        </div>
                                        <div class="d-flex flex-column flex-grow-1 justify-content-center ms-3">
                                            <h3 class="fw-bold text-white mb-2">{{$d_ok}}</h3>
                                            <p class="text-white mt-0 mb-0">Displays Ok</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div></a>
                        <a href="{{url('displays?type=failed')}}" style="text-decoration: none;">
                        <div class="col">
                            <div class="card card-stats">
                                <div class="card-body pt-0">
                                    <div class="d-flex h-100">
                                        <div class="flex-shrink-0">
                                            <div class="bg-white d-flex flex-column justify-content-center card-stats-icon rounded-4 rounded-top-0 px-2"><svg width="51" height="51" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M29.127 6.73022H11.5444C4.07817 6.73022 2.20634 8.60205 2.20634 16.0683V29.4024C2.20634 36.8687 4.07817 38.7405 11.5444 38.7195H34.9317C42.398 38.7195 44.2698 36.8687 44.2698 29.3814V21.8731" stroke="#EB5757" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M23.2381 38.7405V48.7937" stroke="#EB5757" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M2.20634 29.8652H44.2698" stroke="#EB5757" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M13.7738 48.7937H32.7024" stroke="#EB5757" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M49.3175 12.1985C49.3175 13.0398 49.2123 13.8547 49.002 14.6434C48.7654 15.695 48.3448 16.7203 47.7927 17.6142C45.9787 20.6638 42.6399 22.7144 38.8016 22.7144C36.0937 22.7144 33.6488 21.689 31.8085 20.0064C31.0198 19.3229 30.3363 18.508 29.8105 17.6142C28.8378 16.0368 28.2857 14.1702 28.2857 12.1985C28.2857 9.3592 29.4162 6.75658 31.2565 4.86373C33.1756 2.892 35.8571 1.68262 38.8016 1.68262C41.9038 1.68262 44.7168 3.02344 46.6096 5.17919C48.2922 7.04576 49.3175 9.51694 49.3175 12.1985Z" stroke="#EB5757" stroke-width="3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M41.5094 9.41187L35.9623 14.9589" stroke="#EB5757" stroke-width="3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M36.0149 9.46436L41.5883 15.0114" stroke="#EB5757" stroke-width="3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</div>
                                        </div>
                                        <div class="d-flex flex-column flex-grow-1 justify-content-center ms-3">
                                            <h3 class="fw-bold text-white mb-2">{{$d_fail}}</h3>
                                            <p class="text-white mt-0 mb-0">Displays Not Ok</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div></a>
                        <a href="{{url('quality-assurance?tab=all-tasks')}}" style="text-decoration: none;">
                        <div class="col">
                            <div class="card card-stats">
                                <div class="card-body pt-0">
                                    <div class="d-flex h-100">
                                        <div class="flex-shrink-0">
                                            <div class="bg-white d-flex flex-column justify-content-center card-stats-icon rounded-4 rounded-top-0 px-2"><svg width="49" height="49" viewBox="0 0 49 49" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M25.3171 17.6101H36.9108" stroke="#049FD9" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M12.0892 17.6101L13.7454 19.2664L18.7142 14.2976" stroke="#049FD9" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M25.3171 33.0684H36.9108" stroke="#049FD9" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M12.0892 33.0684L13.7454 34.7246L18.7142 29.7559" stroke="#049FD9" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M17.875 46.5834H31.125C42.1667 46.5834 46.5833 42.1668 46.5833 31.1251V17.8751C46.5833 6.83342 42.1667 2.41675 31.125 2.41675H17.875C6.83334 2.41675 2.41667 6.83342 2.41667 17.8751V31.1251C2.41667 42.1668 6.83334 46.5834 17.875 46.5834Z" stroke="#049FD9" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</div>
                                        </div>
                                        <div class="d-flex flex-column flex-grow-1 justify-content-center ms-3">
                                            <h3 class="fw-bold text-white mb-2" id="due_tasks_stats">0</h3>
                                            <p class="text-white mt-0 mb-0">Due Tasks</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div></a>
                         <a href="{{url('workstations')}}" style="text-decoration: none;">
                        <div class="col">
                            <div class="card card-stats">
                                <div class="card-body pt-0">
                                    <div class="d-flex h-100">
                                        <div class="flex-shrink-0">
                                            <div class="bg-white d-flex flex-column justify-content-center card-stats-icon rounded-4 rounded-top-0 px-2"><svg width="48" height="45" viewBox="0 0 48 45" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M45.3325 19.0551L43.1683 28.286C41.3133 36.258 37.6475 39.4822 30.7575 38.8197C29.6533 38.7314 28.4608 38.5326 27.18 38.2235L23.47 37.3401C14.2612 35.1539 11.4125 30.6047 13.5767 21.3739L15.7408 12.121C16.1825 10.2439 16.7125 8.6097 17.375 7.26262C19.9587 1.91845 24.3533 0.483036 31.7292 2.22762L35.4171 3.08887C44.67 5.25304 47.4967 9.82429 45.3325 19.0551Z" stroke="#049FD9" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M30.7575 38.8198C29.3884 39.7473 27.6659 40.5202 25.5679 41.2048L22.0788 42.3531C13.3117 45.1798 8.69627 42.8169 5.84752 34.0498L3.02085 25.3269C0.194187 16.5598 2.53502 11.9223 11.3021 9.09561L14.7913 7.94728C15.6967 7.6602 16.5579 7.41728 17.375 7.2627C16.7125 8.60978 16.1825 10.2439 15.7409 12.121L13.5767 21.3739C11.4125 30.6048 14.2613 35.1539 23.47 37.3402L27.18 38.2235C28.4609 38.5327 29.6534 38.7314 30.7575 38.8198Z" stroke="#049FD9" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M25.4133 14.8372L36.1237 17.5534" stroke="#049FD9" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M23.2492 23.3835L29.6534 25.0177" stroke="#049FD9" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</div>
                                        </div>
                                        <div class="d-flex flex-column flex-grow-1 justify-content-center ms-3">
                                            <h3 class="fw-bold text-white mb-2">{{$workstations}}</h3>
                                            <p class="text-white mt-0 mb-0">Workstations</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </section>
                <section class="py-2">
                    <div class="bg-white border rounded border-info rounded-4 pt-4">
                        <h4 class="text-primary mb-0 ps-4">Displays Not Ok</h4>
                        <div class="table-responsive rounded-4">
                            @if($d_fail==0)
                            <hr class="m-0 mt-3">
                            <div class="text-center p-5">
                            <svg width="60" height="60" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
<circle opacity="0.2" cx="15" cy="15" r="15" fill="#27AE60"/>
<path d="M12.714 18.1771L10.0702 15.5333C9.92776 15.3908 9.73454 15.3108 9.53307 15.3108C9.3316 15.3108 9.13839 15.3908 8.99593 15.5333C8.85347 15.6757 8.77344 15.8689 8.77344 16.0704C8.77344 16.1702 8.79309 16.2689 8.83126 16.3611C8.86944 16.4533 8.92539 16.537 8.99593 16.6075L12.1807 19.7923C12.4778 20.0894 12.9578 20.0894 13.255 19.7923L21.3159 11.7313C21.4584 11.5889 21.5384 11.3957 21.5384 11.1942C21.5384 10.9927 21.4584 10.7995 21.3159 10.6571C21.1735 10.5146 20.9803 10.4346 20.7788 10.4346C20.5773 10.4346 20.3841 10.5146 20.2416 10.6571L12.714 18.1771Z" fill="#27AE60"/>
</svg>
<h6 class="mt-3">Nothing to check here!</h6>
                            </div>
                            @else
                            <span id="myTableDisplays-empty" style="display: none;;">
                            <hr class="m-0 mt-3">
                            <div class="text-center p-5">
                            <svg width="60" height="60" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
<circle opacity="0.2" cx="15" cy="15" r="15" fill="#27AE60"/>
<path d="M12.714 18.1771L10.0702 15.5333C9.92776 15.3908 9.73454 15.3108 9.53307 15.3108C9.3316 15.3108 9.13839 15.3908 8.99593 15.5333C8.85347 15.6757 8.77344 15.8689 8.77344 16.0704C8.77344 16.1702 8.79309 16.2689 8.83126 16.3611C8.86944 16.4533 8.92539 16.537 8.99593 16.6075L12.1807 19.7923C12.4778 20.0894 12.9578 20.0894 13.255 19.7923L21.3159 11.7313C21.4584 11.5889 21.5384 11.3957 21.5384 11.1942C21.5384 10.9927 21.4584 10.7995 21.3159 10.6571C21.1735 10.5146 20.9803 10.4346 20.7788 10.4346C20.5773 10.4346 20.3841 10.5146 20.2416 10.6571L12.714 18.1771Z" fill="#27AE60"/>
</svg>
<h6 class="mt-3">Nothing to check here!</h6>
                            </div>
                            </span>
                            <table class="table mb-0 mt-0 table-light" id="myTableDisplays">
                                <thead>
                                    <tr class="table-primary">
                                        <th></th>
                                        <th class="fw-semibold">Display Name</th>
                                        <th class="fw-semibold">Location</th>
                                        <th class="fw-semibold">Error</th>
                                        <th class="fw-semibold">Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                            @endif
                        </div>
                    </div>
                </section>
                <section class="py-4">
                    <div class="bg-white border rounded border-info rounded-4 pt-4">
                        <h4 class="text-primary mb-0 ps-4">Due Tasks</h4>
                        <div class="table-responsive rounded-4">
                        @if(0)
                            <hr class="m-0 mt-3">
                            <div class="text-center p-5">
                            <svg width="60" height="60" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
<circle opacity="0.2" cx="15" cy="15" r="15" fill="#27AE60"/>
<path d="M12.714 18.1771L10.0702 15.5333C9.92776 15.3908 9.73454 15.3108 9.53307 15.3108C9.3316 15.3108 9.13839 15.3908 8.99593 15.5333C8.85347 15.6757 8.77344 15.8689 8.77344 16.0704C8.77344 16.1702 8.79309 16.2689 8.83126 16.3611C8.86944 16.4533 8.92539 16.537 8.99593 16.6075L12.1807 19.7923C12.4778 20.0894 12.9578 20.0894 13.255 19.7923L21.3159 11.7313C21.4584 11.5889 21.5384 11.3957 21.5384 11.1942C21.5384 10.9927 21.4584 10.7995 21.3159 10.6571C21.1735 10.5146 20.9803 10.4346 20.7788 10.4346C20.5773 10.4346 20.3841 10.5146 20.2416 10.6571L12.714 18.1771Z" fill="#27AE60"/>
</svg>
<h6 class="mt-3">Nothing to check here!</h6>
                            </div>
                            @else
                            <span id="myTableTasks-empty" style="display: none;">
                            <hr class="m-0 mt-3">
                            <div class="text-center p-5">
                            <svg width="60" height="60" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
<circle opacity="0.2" cx="15" cy="15" r="15" fill="#27AE60"/>
<path d="M12.714 18.1771L10.0702 15.5333C9.92776 15.3908 9.73454 15.3108 9.53307 15.3108C9.3316 15.3108 9.13839 15.3908 8.99593 15.5333C8.85347 15.6757 8.77344 15.8689 8.77344 16.0704C8.77344 16.1702 8.79309 16.2689 8.83126 16.3611C8.86944 16.4533 8.92539 16.537 8.99593 16.6075L12.1807 19.7923C12.4778 20.0894 12.9578 20.0894 13.255 19.7923L21.3159 11.7313C21.4584 11.5889 21.5384 11.3957 21.5384 11.1942C21.5384 10.9927 21.4584 10.7995 21.3159 10.6571C21.1735 10.5146 20.9803 10.4346 20.7788 10.4346C20.5773 10.4346 20.3841 10.5146 20.2416 10.6571L12.714 18.1771Z" fill="#27AE60"/>
</svg>
<h6 class="mt-3">Nothing to check here!</h6>
                            </div>
                            </span>
                            <table class="table mb-0 table-light" id="myTableTasks">
                                <thead>
                                    <tr class="table-primary">
                                        <th></th>
                                        <th class="text-nowrap fw-semibold">Task Name</th>
                                        <th class="fw-semibold">Display</th>
                                        <th class="fw-semibold">Workstation</th>
                                        <th class="fw-semibold">Workgroup</th>
                                        <th class="fw-semibold">Task Type</th>
                                        <th class="text-nowrap fw-semibold">Schedule type</th>
                                        <th class="text-nowrap fw-semibold">Due Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                            @endif
                        </div>
                    </div>
                </section>
                <section class="py-2 pb-4">
                    <div class="bg-white border rounded border-info rounded-4 p-4">
                        <div class="d-flex align-items-center border-bottom pb-3 mb-4"><span class="d-inline-block flex-shrink-0 me-2"><svg width="30" height="28" viewbox="0 0 30 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21.6667 22.5734H16.3334L10.4001 26.52C9.52007 27.1067 8.33341 26.4801 8.33341 25.4134V22.5734C4.33341 22.5734 1.66675 19.9067 1.66675 15.9067V7.90666C1.66675 3.90666 4.33341 1.23999 8.33341 1.23999H21.6667C25.6667 1.23999 28.3334 3.90666 28.3334 7.90666V15.9067C28.3334 19.9067 25.6667 22.5734 21.6667 22.5734Z" stroke="#2E3192" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M15.0002 13.1466V12.8667C15.0002 11.96 15.5602 11.48 16.1202 11.0933C16.6669 10.72 17.2135 10.24 17.2135 9.35999C17.2135 8.13332 16.2268 7.14661 15.0002 7.14661C13.7735 7.14661 12.7869 8.13332 12.7869 9.35999" stroke="#2E3192" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M14.9942 16.3333H15.0062" stroke="#2E3192" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>
                            <h5 class="text-primary mb-0">How to connect the client computers to remote</h5>
                        </div>
                        <div class="mb-4">
                            <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
                                <div class="col">
                                    <div class="d-flex align-items-center"><span class="d-inline-block flex-shrink-0 me-2">
                                        <svg width="45" height="45" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M27.5 52.1355C13.9104 52.1355 2.86459 41.0896 2.86459 27.5C2.86459 13.9105 13.9104 2.86462 27.5 2.86462C41.0896 2.86462 52.1354 13.9105 52.1354 27.5C52.1354 41.0896 41.0896 52.1355 27.5 52.1355ZM27.5 6.30212C15.8125 6.30212 6.30209 15.8125 6.30209 27.5C6.30209 39.1875 15.8125 48.698 27.5 48.698C39.1875 48.698 48.6979 39.1875 48.6979 27.5C48.6979 15.8125 39.1875 6.30212 27.5 6.30212Z" fill="#049FD9"/>
                                            <path d="M20.625 49.8438H18.3333C17.3937 49.8438 16.6146 49.0646 16.6146 48.125C16.6146 47.1854 17.3479 46.4292 18.2875 46.4062C14.6896 34.1229 14.6896 20.8771 18.2875 8.59375C17.3479 8.57083 16.6146 7.81458 16.6146 6.875C16.6146 5.93542 17.3937 5.15625 18.3333 5.15625H20.625C21.175 5.15625 21.7021 5.43125 22.0229 5.86667C22.3437 6.325 22.4354 6.89792 22.2521 7.425C17.9437 20.3729 17.9437 34.6271 22.2521 47.5979C22.4354 48.125 22.3437 48.6979 22.0229 49.1563C21.7021 49.5688 21.175 49.8438 20.625 49.8438Z" fill="#049FD9"/>
                                            <path d="M34.375 49.8438C34.1917 49.8438 34.0083 49.8209 33.825 49.7521C32.9313 49.4542 32.4271 48.4688 32.7479 47.575C37.0563 34.6271 37.0563 20.3729 32.7479 7.40211C32.45 6.50836 32.9313 5.52294 33.825 5.22503C34.7417 4.92711 35.7042 5.40836 36.0021 6.30211C40.5625 19.9604 40.5625 34.9938 36.0021 48.6292C35.7729 49.3854 35.0854 49.8438 34.375 49.8438Z" fill="#049FD9"/>
                                            <path d="M27.5 39.4166C21.1063 39.4166 14.7354 38.5229 8.59375 36.7124C8.57083 37.6291 7.81458 38.3854 6.875 38.3854C5.93542 38.3854 5.15625 37.6062 5.15625 36.6666V34.3749C5.15625 33.8249 5.43125 33.2979 5.86667 32.977C6.325 32.6562 6.89792 32.5645 7.425 32.7479C20.3729 37.0562 34.65 37.0562 47.5979 32.7479C48.125 32.5645 48.6979 32.6562 49.1563 32.977C49.6146 33.2979 49.8667 33.8249 49.8667 34.3749V36.6666C49.8667 37.6062 49.0875 38.3854 48.1479 38.3854C47.2083 38.3854 46.4521 37.652 46.4292 36.7124C40.2646 38.5229 33.8938 39.4166 27.5 39.4166Z" fill="#049FD9"/>
                                            <path d="M48.125 22.3438C47.9417 22.3438 47.7583 22.3209 47.575 22.2521C34.6271 17.9438 20.35 17.9438 7.40209 22.2521C6.48542 22.55 5.52292 22.0688 5.225 21.175C4.95 20.2584 5.43125 19.2959 6.325 18.9979C19.9833 14.4375 35.0167 14.4375 48.6521 18.9979C49.5458 19.2959 50.05 20.2813 49.7292 21.175C49.5229 21.8854 48.8354 22.3438 48.125 22.3438Z" fill="#049FD9"/>
                                            </svg>
                                            
</span>
                                        <div>
                                            <h5 class="text-primary mb-0 mt-1">Url</h5>
                                            <input id="remote_url" type="hidden" value="{{url('/')}}">
                                            <p class="text-body mb-0">{{url('/')}}
                                            <a href="javascript:void(0)" onclick="copy_field('#remote_url')">
                                                                         <svg width="17" height="17" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M12.6666 10.2122V13.5372C12.6666 16.308 11.5583 17.4163 8.78742 17.4163H5.46242C2.69159 17.4163 1.58325 16.308 1.58325 13.5372V10.2122C1.58325 7.44134 2.69159 6.33301 5.46242 6.33301H8.78742C11.5583 6.33301 12.6666 7.44134 12.6666 10.2122Z" stroke="#049FD9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M17.4166 5.46217V8.78717C17.4166 11.558 16.3083 12.6663 13.5374 12.6663H12.6666V10.2122C12.6666 7.44134 11.5583 6.33301 8.78742 6.33301H6.33325V5.46217C6.33325 2.69134 7.44158 1.58301 10.2124 1.58301H13.5374C16.3083 1.58301 17.4166 2.69134 17.4166 5.46217Z" stroke="#049FD9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex align-items-center"><span class="d-inline-block flex-shrink-0 me-2">
                                        <svg width="45" height="45" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M27.5 29.2188C20.2354 29.2188 14.3229 23.3063 14.3229 16.0417C14.3229 8.77712 20.2354 2.86462 27.5 2.86462C34.7646 2.86462 40.6771 8.77712 40.6771 16.0417C40.6771 23.3063 34.7646 29.2188 27.5 29.2188ZM27.5 6.30212C22.1375 6.30212 17.7604 10.6792 17.7604 16.0417C17.7604 21.4042 22.1375 25.7813 27.5 25.7813C32.8625 25.7813 37.2396 21.4042 37.2396 16.0417C37.2396 10.6792 32.8625 6.30212 27.5 6.30212Z" fill="#049FD9"/>
                                            <path d="M47.1858 52.1354C46.2462 52.1354 45.467 51.3562 45.467 50.4167C45.467 42.5104 37.4003 36.0937 27.5003 36.0937C17.6003 36.0937 9.53369 42.5104 9.53369 50.4167C9.53369 51.3562 8.75452 52.1354 7.81494 52.1354C6.87536 52.1354 6.09619 51.3562 6.09619 50.4167C6.09619 40.6312 15.6983 32.6562 27.5003 32.6562C39.3024 32.6562 48.9045 40.6312 48.9045 50.4167C48.9045 51.3562 48.1253 52.1354 47.1858 52.1354Z" fill="#049FD9"/>
                                            </svg>
                                            
</span>
                                        <div>
                                            <h5 class="text-primary mb-0 mt-1">Login id</h5>
                                            <input id="remote_user" type="hidden" value="{{$user->sync_user}}">
                                            <p class="text-body mb-0">{{$user->sync_user}}
                                            <a href="javascript:void(0)" onclick="copy_field('#remote_user')">
                                                                         <svg width="17" height="17" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M12.6666 10.2122V13.5372C12.6666 16.308 11.5583 17.4163 8.78742 17.4163H5.46242C2.69159 17.4163 1.58325 16.308 1.58325 13.5372V10.2122C1.58325 7.44134 2.69159 6.33301 5.46242 6.33301H8.78742C11.5583 6.33301 12.6666 7.44134 12.6666 10.2122Z" stroke="#049FD9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M17.4166 5.46217V8.78717C17.4166 11.558 16.3083 12.6663 13.5374 12.6663H12.6666V10.2122C12.6666 7.44134 11.5583 6.33301 8.78742 6.33301H6.33325V5.46217C6.33325 2.69134 7.44158 1.58301 10.2124 1.58301H13.5374C16.3083 1.58301 17.4166 2.69134 17.4166 5.46217Z" stroke="#049FD9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex align-items-center"><span class="d-inline-block flex-shrink-0 me-2">
                                        <svg width="45" height="45" viewBox="0 0 45 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.25 18.75V15C11.25 8.79375 13.125 3.75 22.5 3.75C31.875 3.75 33.75 8.79375 33.75 15V18.75" stroke="#049FD9" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M22.5 34.6875C25.0888 34.6875 27.1875 32.5888 27.1875 30C27.1875 27.4112 25.0888 25.3125 22.5 25.3125C19.9112 25.3125 17.8125 27.4112 17.8125 30C17.8125 32.5888 19.9112 34.6875 22.5 34.6875Z" stroke="#049FD9" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M31.875 41.25H13.125C5.625 41.25 3.75 39.375 3.75 31.875V28.125C3.75 20.625 5.625 18.75 13.125 18.75H31.875C39.375 18.75 41.25 20.625 41.25 28.125V31.875C41.25 39.375 39.375 41.25 31.875 41.25Z" stroke="#049FD9" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            
</span>
                                        <div>
                                            <h5 class="text-primary mb-0 mt-1">Password</h5>
                                            <input id="remote_pass" type="hidden" value="{{$user->sync_password_raw}}">
                                            <p class="text-body mb-0">{{$user->sync_password_raw}}
                                            <a href="javascript:void(0)" onclick="copy_field('#remote_pass')">
                                                                         <svg width="17" height="17" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M12.6666 10.2122V13.5372C12.6666 16.308 11.5583 17.4163 8.78742 17.4163H5.46242C2.69159 17.4163 1.58325 16.308 1.58325 13.5372V10.2122C1.58325 7.44134 2.69159 6.33301 5.46242 6.33301H8.78742C11.5583 6.33301 12.6666 7.44134 12.6666 10.2122Z" stroke="#049FD9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M17.4166 5.46217V8.78717C17.4166 11.558 16.3083 12.6663 13.5374 12.6663H12.6666V10.2122C12.6666 7.44134 11.5583 6.33301 8.78742 6.33301H6.33325V5.46217C6.33325 2.69134 7.44158 1.58301 10.2124 1.58301H13.5374C16.3083 1.58301 17.4166 2.69134 17.4166 5.46217Z" stroke="#049FD9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">

                        <style>
                            .accordion-button::after{
                                margin-left: 10px;
                            }
                        </style>
                            <div class="accordion accordion-faq" role="tablist" id="accordion-1">
                            
                            <div class="accordion-item">
        <h2 class="accordion-header fw-normal" role="tab">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-11" aria-expanded="false" aria-controls="accordion-1 .item-11">
                Step-by-Step Guide
            </button>
        </h2>
        <div class="accordion-collapse collapse item-11" role="tabpanel" data-bs-parent="#accordion-1">
            <div class="accordion-body pt-0">
                <h6 class="mb-1">Step 1. Install PerfectLum Client Software:</h6>
                <p class="">Download and install the PerfectLum client software on the workstation that you want to connect. You can find the installation files on the QUBYX website <a href="https://qubyx.com/product/remote-server/" target="_blank" style="color:inherit;">https://qubyx.com/product/remote-server/</a></p>

                <h6 class="mb-1">Step 2. Configure Network Settings:</h6>
                <p class="">Some text goes here about this point. This is placeholder and will be replaced with actual text required to show here.</p>

                <h6 class="mb-1">Step 3. Launch PerfectLum Client:</h6>
                <p class="">Some text goes here about this point. This is placeholder and will be replaced with actual text required to show here.</p>

                <h6 class="mb-1">Step 4. Enter Server Details:</h6>
                <p class="">Some text goes here about this point. This is placeholder and will be replaced with actual text required to show here.</p>

                <h6 class="mb-1">Step 5. Authenticate:</h6>
                <p class="">Some text goes here about this point. This is placeholder and will be replaced with actual text required to show here.</p>

                <h6 class="mb-1">Step 6. Verify Connection:</h6>
                <p class="">Some text goes here about this point. This is placeholder and will be replaced with actual text required to show here.</p>

                <h6 class="mb-1">Step 7. Schedule Tasks:</h6>
                <p class="">Some text goes here about this point. This is placeholder and will be replaced with actual text required to show here.</p>

                <h6 class="mb-1">Step 8. Monitor and Manage:</h6>
                <p class="mb-0">Some text goes here about this point. This is placeholder and will be replaced with actual text required to show here.</p>
                <p></p>
            </div>
        </div>
    </div>

</div>

                        </div>
                        <div>
                            <div class="alert alert-info mb-0" role="alert" style="border-radius: 25px; border:0px;">
                                <h6 class="alert-heading text-info mt-2 mb-3">Additional Tips</h6>
                                <ul class="text-success mb-0 ps-4">
                                    <li class="mb-2">Regular Updates: Ensure that both the client and server software are regularly updated to the latest versions to benefit from new features and security improvements.</li>
                                    <li>Documentation: Refer to the PerfectLum user manual for detailed instructions and troubleshooting tips</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
@include('common.navigations.footer')

<script>
    
$(document).ready(function() {
    $.fn.dataTable.ext.errMode = 'none';

    
    var table2 = $('#myTableDisplays').DataTable({
        "processing": true,      // Show loading indicator
        "serverSide": true,       // Enable server-side processing
        "searching": true,     // Disable the search box
        "lengthChange": false,   // Disable the "Show entries" dropdown
        "ajax": {
            "url": "{{url('list-displays-failed')}}",  // URL to the script that provides data
            "type": "GET",
            "dataSrc": function (json) {
                //alert(json);
                console.log(json);  // Log the response to the console
                var totalFiltered = json.recordsFiltered;
                if(totalFiltered==0)
                {
                    $("#myTableDisplays-empty").show();
                    $("#myTableDisplays").hide();
                    $("div#myTableDisplays_wrapper").hide();
                }
                else
                {
                    $("#myTableDisplays-empty").hide();
                    $("#myTableDisplays").show();
                }
                return json.data;
            }
        },
        "columns": [
            { "data": "id", "visible": false },
            {
                        "data": null,  // Show both manufacturer and model
                        "name": "model",
                        "className": "text-primary",
                        "render": function (data, type, row) {
                            // Combine manufacturer and model in one column
                            //return row.display;
                            if(row.manufacturer==null) row.manufacturer='';
                            return '<a href="{{url("display-settings")}}/'+row.id+'">'+row.manufacturer + '  ' + row.model+' ('+row.serial+')</a>';
                        }
                    },
                    {
                        "data": null,  // Show both manufacturer and model
                        "name": "workstation.workgroup.address",
                        "className": "text-body",
                        "render": function (data, type, row) {
                            // Combine manufacturer and model in one column
                            //return row.display;
                            var address='';
                            if(row.workstation.workgroup.address!=null) address=row.workstation.workgroup.address;
                            if(row.workstation.workgroup.city!=null) address+=', '+row.workstation.workgroup.city;
                            if(row.workstation.workgroup.state!=null) address+=', '+row.workstation.workgroup.state;
                            return address;
                        }
                    },
        // {
        //   "data": "error",
        //   searchable: false,
        //   sortable: false,
        //   render: function(data, type, row) {
        //     return $("<textarea/>").html(data).text();
        //   }
        // },
        {
                        "data": null,  // Show both manufacturer and model
                        "name": "error_type",
                        "className": "text-danger",
                        searchable: false,
          sortable: false,
                        "render": function (data, type, row) {
                            // Combine manufacturer and model in one column
                            //return row.display;
                            var error=row.errors.replace(/&quot;/g, '"');
                            error=JSON.parse(error);
                            //alert(error);
                            if(row.lasthistory!='')
                            return '<a href="{{url('/')}}/histories/'+row.lasthistory+'" style="color:inherit; text-decoration:none;">'+error[0]+'</a>';
                            else return error[0];
                        }
                    },
                    {
                        "data": null,  // Show both manufacturer and model
                        "name": "updated_at",
                        "className": "text-body",
                        "render": function (data, type, row) {
                            // Combine manufacturer and model in one column
                            return formatDate(row.updated_at);
                        }
                    },
        {
          "data": "",
          searchable: false,
          sortable: false
        },
      ],
      order: [[4, 'DESC']]
    });

    var table = $('#myTableTasks').DataTable({
        "processing": true,      // Show loading indicator
        "serverSide": true,       // Enable server-side processing
        "searching": true,     // Disable the search box
        "lengthChange": false,   // Disable the "Show entries" dropdown
        "ajax": {
            "url": "{{url('list-due-tasks')}}",  // URL to the script that provides data
            "type": "GET",
            "data": function(d) {
                d.period_id = $('#period').val();
            },
            "dataSrc": function (json) {
                //alert(json);
                console.log(json);  // Log the response to the console
                var totalFiltered = json.recordsFiltered;
                $("#due_tasks_stats").text(totalFiltered);
                if(totalFiltered==0)
                {
                    $("#myTableTasks-empty").show();
                    $("#myTableTasks").hide();
                    $("div#myTableTasks_wrapper").hide();
                }
                else
                {
                    $("#myTableTasks-empty").hide();
                    $("#myTableTasks").show();
                }
                return json.data;
            }
        },
        "columns": [
                    { "data": "id", "visible": false },
                    { "data": "name", name: "name", 
                        "className": "text-primary", },
                    {
                        "data": null,  // Show both manufacturer and model
                        "name": "display.model",
                        "className": "text-body",
                        "render": function (data, type, row) {
                            // Combine manufacturer and model in one column
                            return row.display;
                            //if(row.display.manufacturer==null) row.display.manufacturer='';
                            //return row.display.manufacturer + '  ' + row.display.model+' ('+row.display.serial+')';
                        }
                    },
                    { "data": "workstation", name: "workstation", 
                        "className": "text-body", },
                    { "data": "workgroup", name: "workgroup", 
                        "className": "text-body", },
                    { "data": "name", name: "name", 
                        "className": "text-body", },
                    { "data": "schtype", name: "schtype", 
                        "className": "text-body", },
        {
  data: {
    _: 'duedate',        // display
    sort: 'duedate_sort' // sorting
  },
  name: 'duedate',
  className: 'text-body'
}
        ],
        order: [[7, 'DESC']]
    });
});
</script>

<script>
function toggleAll() {
    const allItems = document.querySelectorAll('.accordion-collapse');
    let isOpen = false;
    
    // Check if any one item is open
    allItems.forEach(item => {
        if (item.classList.contains('show')) {
            isOpen = true;
        }
    });
    
    // Toggle open/close all items based on the state
    allItems.forEach(item => {
        if (isOpen) {
            item.classList.remove('show');
            $(item).prev().children().attr('aria-expanded', 'false');
            $(item).prev().children().addClass('collapsed');
        } else {
            item.classList.add('show');
            $(item).prev().children().attr('aria-expanded', 'true');
            $(item).prev().children().removeClass('collapsed');
        }
    });
}
</script>