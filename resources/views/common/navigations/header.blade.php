<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>{{$title}} | PerfectLum</title>
    
    <link rel="icon" type="image/png" href="{{url('favicon.png')}}">
    
    <link rel="stylesheet" href="{{url('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/Gilroy.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/Gilroy-RegularItalic.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/setup.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/styles.css')}}">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="{{url('assets/css/custom.css')}}">
</head>

<body data-sidebar-size="{{$user->sidebar}}">
    <section class="vertical-layout">
        <nav class="navbar navbar-expand-md bg-white navbar-vertical-layout py-3">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <a class="navbar-brand d-lg-none ms-2 me-2" href="{{url('dashboard')}}">
                        <img class="h-auto" src="{{url($settings['Site logo'])}}" alt="Perfectlum Logo" width="40" height="51">
                    </a>
                    <button class="btn d-inline-flex d-lg-none navbar-burger p-0" type="button" data-bs-target="#offcanvas-menu" data-bs-toggle="offcanvas">
                        <span class="visually-hidden">Toggle navigation</span>
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    @if($title=='Dashboard')
                    <div class="d-none d-lg-block ms-xl-4">
                        <div class="d-flex align-items-center">
                            <h5 class="fw-semibold text-primary mb-0 text-capitalize" style="color: #049FD9 !important;">Welcome {{explode(' ', $user->fullname)[0]}}</h5><img class="flex-shrink-0 ms-2" width="20" height="20" src="assets/img/hand.png">
                        </div>
                        <p class="text-muted mb-0">{{$title}}</p>
                    </div>
                    @else
                    <div class="d-none d-lg-block ms-xl-4">
                    <p class="text-muted fw-bold mb-0">{{$title}}</p>
                    </div>
                    @endif
                </div>
                <div class="d-flex align-items-center">
                    <div class="me-2 me-lg-3">
                        <!-- Start: SEARCH -->
                        <div class="offcanvas-xl offcanvas-top offcanvas-search" tabindex="-1" id="offcanvas-search">
                            <div class="offcanvas-header justify-content-end"><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvas-search"></button></div>
                            <div class="offcanvas-body">
                                <!-- Start: Form Input Icons -->
                                <form method="get" action="{{url('search')}}">
                                    <div class="form-control-wrapper form-control-icon-end position-relative">
                                        <input class="bg-white form-control form-control-search rounded-pill" type="text" name="keywords" placeholder="Search">
                                        <svg class="position-absolute position-absolute-end top-50 translate-middle-y" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M16.625 16.6249L13.1868 13.1867M13.1868 13.1867C13.775 12.5986 14.2415 11.9004 14.5598 11.132C14.8781 10.3636 15.0419 9.53998 15.0419 8.70825C15.0419 7.87653 14.8781 7.05294 14.5598 6.28453C14.2415 5.51611 13.775 4.81791 13.1868 4.22979C12.5987 3.64167 11.9005 3.17515 11.1321 2.85686C10.3637 2.53858 9.5401 2.37476 8.70837 2.37476C7.87665 2.37476 7.05307 2.53858 6.28465 2.85686C5.51624 3.17515 4.81804 3.64167 4.22992 4.22979C3.04216 5.41756 2.37488 7.02851 2.37488 8.70825C2.37488 10.388 3.04216 11.999 4.22992 13.1867C5.41768 14.3745 7.02863 15.0417 8.70837 15.0417C10.3881 15.0417 11.9991 14.3745 13.1868 13.1867Z" stroke="#32505B" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</div>
                                </form><!-- End: Form Input Icons -->
                            </div>
                        </div><!-- End: SEARCH -->
                        <button class="btn btn-primary d-inline-flex d-xl-none justify-content-center align-items-center btn-icon rounded-circle p-0 navbar-icon" type="button" data-bs-target="#offcanvas-search" data-bs-toggle="offcanvas"><svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M16.625 16.6249L13.1868 13.1867M13.1868 13.1867C13.775 12.5986 14.2415 11.9004 14.5598 11.132C14.8781 10.3636 15.0419 9.53998 15.0419 8.70825C15.0419 7.87653 14.8781 7.05294 14.5598 6.28453C14.2415 5.51611 13.775 4.81791 13.1868 4.22979C12.5987 3.64167 11.9005 3.17515 11.1321 2.85686C10.3637 2.53858 9.5401 2.37476 8.70837 2.37476C7.87665 2.37476 7.05307 2.53858 6.28465 2.85686C5.51624 3.17515 4.81804 3.64167 4.22992 4.22979C3.04216 5.41756 2.37488 7.02851 2.37488 8.70825C2.37488 10.388 3.04216 11.999 4.22992 13.1867C5.41768 14.3745 7.02863 15.0417 8.70837 15.0417C10.3881 15.0417 11.9991 14.3745 13.1868 13.1867Z" stroke="#32505B" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</button>
                    </div>
                    <!--<a class="btn btn-primary d-inline-flex justify-content-center align-items-center btn-icon rounded-circle p-0 navbar-icon me-2 me-lg-3" role="button" href="#"><svg width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M9.01997 1.90991C5.70997 1.90991 3.01997 4.59991 3.01997 7.90991V10.7999C3.01997 11.4099 2.75997 12.3399 2.44997 12.8599L1.29997 14.7699C0.589966 15.9499 1.07997 17.2599 2.37997 17.6999C6.68997 19.1399 11.34 19.1399 15.65 17.6999C16.86 17.2999 17.39 15.8699 16.73 14.7699L15.58 12.8599C15.28 12.3399 15.02 11.4099 15.02 10.7999V7.90991C15.02 4.60991 12.32 1.90991 9.01997 1.90991Z" stroke="#32505B" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/>
<path d="M10.8699 2.19994C10.5599 2.10994 10.2399 2.03994 9.90992 1.99994C8.94992 1.87994 8.02992 1.94994 7.16992 2.19994C7.45992 1.45994 8.17992 0.939941 9.01992 0.939941C9.85992 0.939941 10.5799 1.45994 10.8699 2.19994Z" stroke="#32505B" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M12.02 18.0601C12.02 19.7101 10.67 21.0601 9.02002 21.0601C8.20002 21.0601 7.44002 20.7201 6.90002 20.1801C6.36002 19.6401 6.02002 18.8801 6.02002 18.0601" stroke="#32505B" stroke-width="1.5" stroke-miterlimit="10"/>
</svg>
</a>-->

<div class="dropdown">
                    <a class="btn btn-primary d-inline-flex justify-content-center align-items-center btn-icon rounded-circle p-0 navbar-icon me-2 me-lg-3" aria-expanded="false" data-bs-toggle="dropdown" href="javascript:void(0)">
                    <svg width="22" height="22" viewbox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.995 14C12.6518 14 13.995 12.6569 13.995 11C13.995 9.34315 12.6518 8 10.995 8C9.33814 8 7.995 9.34315 7.995 11C7.995 12.6569 9.33814 14 10.995 14Z" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M0.994995 11.8799V10.1199C0.994995 9.07994 1.845 8.21994 2.895 8.21994C4.705 8.21994 5.445 6.93994 4.535 5.36994C4.015 4.46994 4.32499 3.29994 5.23499 2.77994L6.96499 1.78994C7.75499 1.31994 8.775 1.59994 9.245 2.38994L9.35499 2.57994C10.255 4.14994 11.735 4.14994 12.645 2.57994L12.755 2.38994C13.225 1.59994 14.245 1.31994 15.035 1.78994L16.765 2.77994C17.675 3.29994 17.985 4.46994 17.465 5.36994C16.555 6.93994 17.295 8.21994 19.105 8.21994C20.145 8.21994 21.005 9.06994 21.005 10.1199V11.8799C21.005 12.9199 20.155 13.7799 19.105 13.7799C17.295 13.7799 16.555 15.0599 17.465 16.6299C17.985 17.5399 17.675 18.6999 16.765 19.2199L15.035 20.2099C14.245 20.6799 13.225 20.3999 12.755 19.6099L12.645 19.4199C11.745 17.8499 10.265 17.8499 9.35499 19.4199L9.245 19.6099C8.775 20.3999 7.75499 20.6799 6.96499 20.2099L5.23499 19.2199C4.32499 18.6999 4.015 17.5299 4.535 16.6299C5.445 15.0599 4.705 13.7799 2.895 13.7799C1.845 13.7799 0.994995 12.9199 0.994995 11.8799Z" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg></a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-profile">
                            
                    @if($role=='super')
                    <a class="dropdown-item fw-semibold" href="{{url('facilities-management')}}"><span class="d-inline-block me-1"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M10.0001 18.3334C14.5834 18.3334 18.3334 14.5834 18.3334 10.0001C18.3334 5.41675 14.5834 1.66675 10.0001 1.66675C5.41675 1.66675 1.66675 5.41675 1.66675 10.0001C1.66675 14.5834 5.41675 18.3334 10.0001 18.3334Z" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M10 6.66675V10.8334" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M9.99561 13.3335H10.0031" stroke="#32505B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    </span>
    <span class="span2">Facilities</span></a>
    @else
                            <a class="dropdown-item fw-semibold" href="{{url('facility-info')}}"><span class="d-inline-block me-1"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M10.0001 18.3334C14.5834 18.3334 18.3334 14.5834 18.3334 10.0001C18.3334 5.41675 14.5834 1.66675 10.0001 1.66675C5.41675 1.66675 1.66675 5.41675 1.66675 10.0001C1.66675 14.5834 5.41675 18.3334 10.0001 18.3334Z" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M10 6.66675V10.8334" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M9.99561 13.3335H10.0031" stroke="#32505B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    </span>
    <span class="span2">Facility Information</span></a>
    @endif
    
    <a class="dropdown-item fw-semibold" href="{{url('workgroups')}}"><span class="d-inline-block me-2"><svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M1.5083 9.3501V13.0918C1.5083 16.8334 3.0083 18.3334 6.74997 18.3334H11.2416C14.9833 18.3334 16.4833 16.8334 16.4833 13.0918V9.3501" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M8.99999 10.0001C10.525 10.0001 11.65 8.75841 11.5 7.23341L10.95 1.66675H7.05832L6.49999 7.23341C6.34999 8.75841 7.47499 10.0001 8.99999 10.0001Z" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M14.2582 10.0001C15.9415 10.0001 17.1748 8.63341 17.0082 6.95841L16.7748 4.66675C16.4748 2.50008 15.6415 1.66675 13.4582 1.66675H10.9165L11.4998 7.50841C11.6415 8.88341 12.8832 10.0001 14.2582 10.0001Z" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M3.6999 10.0001C5.0749 10.0001 6.31657 8.88341 6.4499 7.50841L6.63324 5.66675L7.03324 1.66675H4.49157C2.30824 1.66675 1.4749 2.50008 1.1749 4.66675L0.949902 6.95841C0.783235 8.63341 2.01657 10.0001 3.6999 10.0001Z" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M8.99984 14.1667C7.60817 14.1667 6.9165 14.8584 6.9165 16.2501V18.3334H11.0832V16.2501C11.0832 14.8584 10.3915 14.1667 8.99984 14.1667Z" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    </span><span class="span2">Workgroups</span></a>
    
    <a class="dropdown-item fw-semibold" href="{{url('workstations')}}"><span class="d-inline-block me-2"><svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M18.05 7.69992L17.2333 11.1833C16.5333 14.1916 15.15 15.4083 12.55 15.1583C12.1333 15.1249 11.6833 15.0499 11.2 14.9333L9.79999 14.5999C6.32499 13.7749 5.24999 12.0583 6.06665 8.57493L6.88332 5.08326C7.04999 4.37493 7.24999 3.75826 7.49999 3.24993C8.47499 1.23326 10.1333 0.691592 12.9167 1.34993L14.3083 1.67493C17.8 2.49159 18.8667 4.21659 18.05 7.69992Z" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M12.55 15.1583C12.0334 15.5083 11.3834 15.8 10.5917 16.0583L9.27504 16.4917C5.96671 17.5583 4.22504 16.6667 3.15004 13.3583L2.08337 10.0667C1.01671 6.75833 1.90004 5.00833 5.20837 3.94167L6.52504 3.50833C6.86671 3.4 7.19171 3.30833 7.50004 3.25C7.25004 3.75833 7.05004 4.375 6.88337 5.08333L6.06671 8.575C5.25004 12.0583 6.32504 13.775 9.80004 14.6L11.2 14.9333C11.6834 15.05 12.1334 15.125 12.55 15.1583Z" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M10.5334 6.10815L14.5751 7.13315" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M9.7168 9.33325L12.1335 9.94992" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    </span><span class="span2">Workstations</span></a>
    
    <a class="dropdown-item fw-semibold" href="{{url('displays')}}"><span class="d-inline-block me-2"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M5.36675 1.66675H14.6251C17.5917 1.66675 18.3334 2.40841 18.3334 5.36675V10.6417C18.3334 13.6084 17.5917 14.3417 14.6334 14.3417H5.36675C2.40841 14.3501 1.66675 13.6084 1.66675 10.6501V5.36675C1.66675 2.40841 2.40841 1.66675 5.36675 1.66675Z" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M10 14.3501V18.3334" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M1.66675 10.8335H18.3334" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M6.25 18.3335H13.75" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    </span><span class="span2">Displays</span></a>
    
    @if($role=='super')
    <a class="dropdown-item fw-semibold" href="#"><span class="d-inline-block me-2"><svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M3.60841 16.4167C4.29175 15.6834 5.33342 15.7417 5.93342 16.5417L6.77508 17.6667C7.45008 18.5584 8.54175 18.5584 9.21675 17.6667L10.0584 16.5417C10.6584 15.7417 11.7001 15.6834 12.3834 16.4167C13.8667 18.0001 15.0751 17.4751 15.0751 15.2584V5.86675C15.0834 2.50841 14.3001 1.66675 11.1501 1.66675H4.85008C1.70008 1.66675 0.916748 2.50841 0.916748 5.86675V15.2501C0.916748 17.4751 2.13341 17.9917 3.60841 16.4167Z" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M4.74681 9.16667H4.75429" stroke="#32505B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M7.08203 9.16675H11.6654" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M4.74681 5.83341H4.75429" stroke="#32505B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M7.08203 5.8335H11.6654" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    </span><span class="span2">Subscription &amp; License</span></a>
    @endif
    
    <a class="dropdown-item fw-semibold" href="{{url('users-management')}}"><span class="d-inline-block me-2"><svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M8.15837 9.50008C10.4596 9.50008 12.325 7.6346 12.325 5.33341C12.325 3.03223 10.4596 1.16675 8.15837 1.16675C5.85718 1.16675 3.9917 3.03223 3.9917 5.33341C3.9917 7.6346 5.85718 9.50008 8.15837 9.50008Z" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M14.1667 12.6167L11.2167 15.5667C11.1 15.6834 10.9917 15.9 10.9667 16.0584L10.8084 17.1833C10.7501 17.5917 11.0334 17.875 11.4417 17.8167L12.5667 17.6583C12.725 17.6333 12.9501 17.525 13.0584 17.4084L16.0084 14.4584C16.5167 13.95 16.7584 13.3583 16.0084 12.6083C15.2667 11.8667 14.6751 12.1083 14.1667 12.6167Z" stroke="#32505B" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M13.7419 13.0417C13.9919 13.9417 14.6919 14.6417 15.5919 14.8917" stroke="#32505B" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M1 17.8333C1 14.6083 4.20836 12 8.15836 12C9.02502 12 9.85833 12.125 10.6333 12.3583" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    </span><span class="span2">Users</span></a>
    
    @if($role!='user')
    <a class="dropdown-item fw-semibold" href="{{url('alert-settings')}}"><span class="d-inline-block me-2"><svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M10 6.5V10.6667" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M10.0001 16.8417H4.95011C2.05844 16.8417 0.850107 14.775 2.25011 12.25L4.85011 7.56665L7.30011 3.16665C8.78344 0.49165 11.2168 0.49165 12.7001 3.16665L15.1501 7.57498L17.7501 12.2583C19.1501 14.7833 17.9334 16.85 15.0501 16.85H10.0001V16.8417Z" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M9.99561 13.1667H10.0031" stroke="#32505B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    </span><span class="span2">Alert Settings</span></a>
    @endif
    <a class="dropdown-item fw-semibold" href="{{url('global-settings')}}"><span class="d-inline-block me-2"><svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M10 6.5V10.6667" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M10.0001 16.8417H4.95011C2.05844 16.8417 0.850107 14.775 2.25011 12.25L4.85011 7.56665L7.30011 3.16665C8.78344 0.49165 11.2168 0.49165 12.7001 3.16665L15.1501 7.57498L17.7501 12.2583C19.1501 14.7833 17.9334 16.85 15.0501 16.85H10.0001V16.8417Z" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M9.99561 13.1667H10.0031" stroke="#32505B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    </span><span class="span2">Global Settings</span></a>

    @if($role=='super')
    <a class="dropdown-item fw-semibold" href="{{url('build-version')}}"><span class="d-inline-block me-2"><svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M3.60841 16.4167C4.29175 15.6834 5.33342 15.7417 5.93342 16.5417L6.77508 17.6667C7.45008 18.5584 8.54175 18.5584 9.21675 17.6667L10.0584 16.5417C10.6584 15.7417 11.7001 15.6834 12.3834 16.4167C13.8667 18.0001 15.0751 17.4751 15.0751 15.2584V5.86675C15.0834 2.50841 14.3001 1.66675 11.1501 1.66675H4.85008C1.70008 1.66675 0.916748 2.50841 0.916748 5.86675V15.2501C0.916748 17.4751 2.13341 17.9917 3.60841 16.4167Z" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M4.74681 9.16667H4.75429" stroke="#32505B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M7.08203 9.16675H11.6654" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M4.74681 5.83341H4.75429" stroke="#32505B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M7.08203 5.8335H11.6654" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    </span><span class="span2">Build New Version</span></a>
    @endif
    
    </div>
                    </div>

                    <div class="dropdown">
                        <a class="d-flex align-items-center text-decoration-none" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                        <img class="rounded-circle border-primary flex-shrink-0 border avatar-img me-lg-2" width="45" height="45" src="{{url($user->profile_image)}}">
                            <div class="d-none d-lg-block flex-grow-1">
                                <h6 class="text-nowrap fw-semibold text-success avatar-title mb-0 text-capitalize">{{explode(' ', $user->fullname)[0]}}</h6>
                                <p class="text-muted avatar-subtitle mb-0 text-capitalize" style="font-size: 14px;">{{$role}}
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="-64 0 512 512" width="0.9em" height="0.9em" fill="#049FD9" class="text-primary ms-1">
                                        <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2023 Fonticons, Inc. -->
                                        <path d="M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80V432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z"></path>
                                    </svg></p>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-profile">
    
    <a class="dropdown-item fw-semibold" href="{{url('profile-settings')}}"><span class="d-inline-block me-2"><svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M8.15837 9.50008C10.4596 9.50008 12.325 7.6346 12.325 5.33341C12.325 3.03223 10.4596 1.16675 8.15837 1.16675C5.85718 1.16675 3.9917 3.03223 3.9917 5.33341C3.9917 7.6346 5.85718 9.50008 8.15837 9.50008Z" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M14.1667 12.6167L11.2167 15.5667C11.1 15.6834 10.9917 15.9 10.9667 16.0584L10.8084 17.1833C10.7501 17.5917 11.0334 17.875 11.4417 17.8167L12.5667 17.6583C12.725 17.6333 12.9501 17.525 13.0584 17.4084L16.0084 14.4584C16.5167 13.95 16.7584 13.3583 16.0084 12.6083C15.2667 11.8667 14.6751 12.1083 14.1667 12.6167Z" stroke="#32505B" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M13.7419 13.0417C13.9919 13.9417 14.6919 14.6417 15.5919 14.8917" stroke="#32505B" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M1 17.8333C1 14.6083 4.20836 12 8.15836 12C9.02502 12 9.85833 12.125 10.6333 12.3583" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    </span><span class="span2">Profile Settings</span></a>
    
    <a class="dropdown-item fw-semibold" href="{{url('logout')}}"><span class="d-inline-block me-2"><svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M10 6.5V10.6667" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M10.0001 16.8417H4.95011C2.05844 16.8417 0.850107 14.775 2.25011 12.25L4.85011 7.56665L7.30011 3.16665C8.78344 0.49165 11.2168 0.49165 12.7001 3.16665L15.1501 7.57498L17.7501 12.2583C19.1501 14.7833 17.9334 16.85 15.0501 16.85H10.0001V16.8417Z" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M9.99561 13.1667H10.0031" stroke="#32505B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    </span><span class="span2">Logout</span></a>
    
    </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="offcanvas-lg offcanvas-start bg-white sidebar-vertical-layout h-100" tabindex="-1" id="offcanvas-menu">
            <div class="offcanvas-header">
                <a class="navbar-brand d-lg-none" href="{{url('dashboard')}}">
                    <img class="h-auto" src="{{url($settings['Site logo'])}}" alt="Avatar Logo" width="150" height="50">
                </a>
                <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvas-menu"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column h-100">
                <div class="d-none d-lg-flex flex-shrink-0 justify-content-between align-items-center sidebar-layout-brand p-3">
                    <a class="navbar-brand" href="{{url('dashboard')}}">
                        <img class="sidebar-logo-sm h-auto" src="{{url($settings['favicon'])}}" alt="Avatar Logo" width="40" height="51">
                        <img class="sidebar-logo-lg h-auto" src="{{url($settings['Site logo'])}}" alt="Avatar Logo" width="180" height="50">
                    </a>
                    <button class="btn btn-sidebar-toggle p-2" id="btn-sidebar-toggle" type="button" onclick="update_sidebar(this)">
                        <svg width="20" height="12" viewbox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1H19" stroke="#32505B" stroke-width="1.5" stroke-linecap="round"></path><path d="M1 6H19" stroke="#32505B" stroke-width="1.5" stroke-linecap="round"></path><path d="M1 11H19" stroke="#32505B" stroke-width="1.5" stroke-linecap="round"></path></svg></button>
                </div>
                <!--<div class="d-none d-lg-block flex-shrink-0 px-3 mb-4">
                    <a class="d-flex align-items-center avatar avatar-sidebar text-decoration-none" href="#"><img class="rounded-circle border-primary flex-shrink-0 border avatar-img" width="45" height="45" src="assets/img/young-latin-woman-smiling-confident-standing-street%201.png">
                        <div class="d-none d-lg-block flex-grow-1 ms-lg-2">
                            <h6 class="text-nowrap fw-semibold text-success avatar-title mb-0">Kathy Weber</h6>
                            <p class="text-nowrap text-muted avatar-subtitle mb-0">Admin</p>
                        </div>
                    </a>
                </div>-->
                <div class="flex-grow-1 overflow-y-auto">
                    <ul class="nav nav-tabs flex-column nav-menu">
                        <li class="nav-item"><a class="nav-link @if($title=='Dashboard') active @endif" href="{{url('dashboard')}}"> 
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M16 9H18C20 9 21 8 21 6V4C21 2 20 1 18 1H16C14 1 13 2 13 4V6C13 8 14 9 16 9Z" stroke="#32505B" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M4 21H6C8 21 9 20 9 18V16C9 14 8 13 6 13H4C2 13 1 14 1 16V18C1 20 2 21 4 21Z" stroke="#32505B" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M5 9C7.20914 9 9 7.20914 9 5C9 2.79086 7.20914 1 5 1C2.79086 1 1 2.79086 1 5C1 7.20914 2.79086 9 5 9Z" stroke="#32505B" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M17 21C19.2091 21 21 19.2091 21 17C21 14.7909 19.2091 13 17 13C14.7909 13 13 14.7909 13 17C13 19.2091 14.7909 21 17 21Z" stroke="#32505B" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
<span class="ms-2">Dashboard</span></a></li>
<li class="nav-item"><a class="nav-link @if($title=='Display Calibration') active @endif" href="{{url('display-calibration')}}"> 
    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M6.25998 1H15.73C16.38 1 16.96 1.02003 17.48 1.09003C20.25 1.40003 21 2.70001 21 6.26001V12.58C21 16.14 20.25 17.44 17.48 17.75C16.96 17.82 16.39 17.84 15.73 17.84H6.25998C5.60998 17.84 5.02998 17.82 4.50998 17.75C1.73998 17.44 0.98999 16.14 0.98999 12.58V6.26001C0.98999 2.70001 1.73998 1.40003 4.50998 1.09003C5.02998 1.02003 5.60998 1 6.25998 1Z" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M12.5801 7.32007H16.2601" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M5.73999 13.1099H5.75998H16.27" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M6 21H16" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M6.1947 7.30005H6.20368" stroke="#32505B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M9.49451 7.30005H9.50349" stroke="#32505B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
<span class="ms-2">Display Calibration</span></a></li>
<li class="nav-item"><a class="nav-link @if($title=='Quality Assurance') active @endif" href="{{url('quality-assurance')}}"> 
    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M19 9C19 10.45 18.57 11.78 17.83 12.89C16.75 14.49 15.04 15.62 13.05 15.91C12.71 15.97 12.36 16 12 16C11.64 16 11.29 15.97 10.95 15.91C8.96 15.62 7.25 14.49 6.17 12.89C5.43 11.78 5 10.45 5 9C5 5.13 8.13 2 12 2C15.87 2 19 5.13 19 9Z" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M21.25 18.4699L19.6 18.8599C19.23 18.9499 18.94 19.2299 18.86 19.5999L18.51 21.0699C18.32 21.8699 17.3 22.1099 16.77 21.4799L12 15.9999L7.23002 21.4899C6.70002 22.1199 5.68002 21.8799 5.49002 21.0799L5.14002 19.6099C5.05002 19.2399 4.76002 18.9499 4.40002 18.8699L2.75002 18.4799C1.99002 18.2999 1.72002 17.3499 2.27002 16.7999L6.17002 12.8999C7.25002 14.4999 8.96002 15.6299 10.95 15.9199C11.29 15.9799 11.64 16.0099 12 16.0099C12.36 16.0099 12.71 15.9799 13.05 15.9199C15.04 15.6299 16.75 14.4999 17.83 12.8999L21.73 16.7999C22.28 17.3399 22.01 18.2899 21.25 18.4699Z" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M12.58 5.98L13.17 7.15999C13.25 7.31999 13.46 7.48 13.65 7.51L14.72 7.68999C15.4 7.79999 15.56 8.3 15.07 8.79L14.24 9.61998C14.1 9.75998 14.02 10.03 14.07 10.23L14.31 11.26C14.5 12.07 14.07 12.39 13.35 11.96L12.35 11.37C12.17 11.26 11.87 11.26 11.69 11.37L10.69 11.96C9.96997 12.38 9.53997 12.07 9.72997 11.26L9.96997 10.23C10.01 10.04 9.93997 9.75998 9.79997 9.61998L8.96997 8.79C8.47997 8.3 8.63997 7.80999 9.31997 7.68999L10.39 7.51C10.57 7.48 10.78 7.31999 10.86 7.15999L11.45 5.98C11.74 5.34 12.26 5.34 12.58 5.98Z" stroke="#32505B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>        
<span class="ms-2">Quality Assurance</span></a></li>
<li class="nav-item"><a class="nav-link @if($title=='Histories & Reports' || $title=='History Information') active @endif" href="{{url('histories-reports')}}"> <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M6 11.2H13" stroke="#32505B" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M6 15.2H10.38" stroke="#32505B" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M8 5H12C14 5 14 4 14 3C14 1 13 1 12 1H8C7 1 6 1 6 3C6 5 7 5 8 5Z" stroke="#32505B" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M14 3.02002C17.33 3.20002 19 4.43002 19 9.00002V15C19 19 18 21 13 21H7C2 21 1 19 1 15V9.00002C1 4.44002 2.67 3.20002 6 3.02002" stroke="#32505B" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
<span class="ms-2">Histories &amp; Reports</span></a></li>

@if($role=='super')
                        <li class="nav-item"><a class="nav-link @if($title=='Site Settings') active @endif" href="{{url('site-settings')}}"> <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11 14C12.6569 14 14 12.6569 14 11C14 9.34315 12.6569 8 11 8C9.34315 8 8 9.34315 8 11C8 12.6569 9.34315 14 11 14Z" stroke="#32505B" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M1 11.8801V10.1201C1 9.08006 1.85 8.22006 2.9 8.22006C4.71 8.22006 5.45 6.94006 4.54 5.37006C4.02 4.47006 4.33 3.30006 5.24 2.78006L6.97 1.79006C7.76 1.32006 8.78 1.60006 9.25 2.39006L9.36 2.58006C10.26 4.15006 11.74 4.15006 12.65 2.58006L12.76 2.39006C13.23 1.60006 14.25 1.32006 15.04 1.79006L16.77 2.78006C17.68 3.30006 17.99 4.47006 17.47 5.37006C16.56 6.94006 17.3 8.22006 19.11 8.22006C20.15 8.22006 21.01 9.07006 21.01 10.1201V11.8801C21.01 12.9201 20.16 13.7801 19.11 13.7801C17.3 13.7801 16.56 15.0601 17.47 16.6301C17.99 17.5401 17.68 18.7001 16.77 19.2201L15.04 20.2101C14.25 20.6801 13.23 20.4001 12.76 19.6101L12.65 19.4201C11.75 17.8501 10.27 17.8501 9.36 19.4201L9.25 19.6101C8.78 20.4001 7.76 20.6801 6.97 20.2101L5.24 19.2201C4.33 18.7001 4.02 17.5301 4.54 16.6301C5.45 15.0601 4.71 13.7801 2.9 13.7801C1.85 13.7801 1 12.9201 1 11.8801Z" stroke="#32505B" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
<span class="ms-2">Site Settings</span></a></li>
@endif
                    </ul>
                </div>
            </div>
        </div>