@extends('layouts.admin')

@section('title')
    Users
@endsection

@section('css')
    <link rel="stylesheet" href="{{ Helper::assets('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ Helper::assets('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ Helper::assets('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet" href="{{ Helper::assets('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ Helper::assets('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
@endsection

@section('breadcrumb')
    <div class="navbar-nav align-items-center">
        <div class="nav-item navbar-search-wrapper mb-0">
            <h4 class="m-0">Users</h4>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- DataTable with Buttons -->
        <div class="card">
            <div class="card-header p-3 d-flex justify-content-end">
                <a href="{{ route('admin.user.create') }}"> <button type="button" class="btn btn-primary text-white"> Add New User </button> </a>
            </div>

            <div class="card-datatable">
                <table class="datatables-basic table table-striped border-top data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone number</th>
                            <th>Status</th>
                            <th class="not-export">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ Helper::assets('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script defer src="{{ Helper::assets('assets/libs/sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
@endsection

@section('script-bottom')
    <script type="text/javascript">
        var filter_url = "{{ route('admin.user.index') }}";
        var delete_url = "{{ route('admin.user.destroy', ['user' => 'userid']) }}";
        var block_url = "{{ route('admin.user.block') }}";
    </script>
    <script defer src="{{ Helper::assets('assets/js/pages/admin/user.js') }}?v={{ config('constant.asset_version') }}" type="text/javascript"></script>
@endsection
