@extends('layouts.admin', ['withLoader' => true])

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    <div class="navbar-nav align-items-center">
        <div class="nav-item navbar-search-wrapper mb-0">
            <h4 class="m-0">Dashboard</h4>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Card Border Shadow -->
        <div class="row">

            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-primary h-100">
                    <a href="{{ route('admin.user.index') }}">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2 pb-1">
                                <div class="avatar me-2">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bxs-user"></i></span>
                                </div>
                                <h4 class="ms-1 mb-0">{{ isset($userCount) ? $userCount : 0 }}</h4>
                            </div>
                            <p class="mb-1">Total Users</p>
                            <p class="mb-0">
                                {{-- <span class="fw-medium me-1">+18.2%</span> --}}
                                <small class="text-muted">Click to view details</small>
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-warning h-100">
                    <a href="{{ route('admin.enquiry.index') }}">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2 pb-1">
                                <div class="avatar me-2">
                                    <span class="avatar-initial rounded bg-label-warning"><i class="bx bxs-phone-incoming"></i></span>
                                </div>
                                <h4 class="ms-1 mb-0">{{ isset($enquiryCount) ? $enquiryCount : 0 }}</h4>
                            </div>
                            <p class="mb-1">Enquiries</p>
                            <p class="mb-0">
                                {{-- <span class="fw-medium me-1">-8.7%</span> --}}
                                <small class="text-muted">Click to view details</small>
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!--/ Card Border Shadow -->
    </div>
@endsection

@section('script')
@endsection

@section('script-bottom')
@endsection
