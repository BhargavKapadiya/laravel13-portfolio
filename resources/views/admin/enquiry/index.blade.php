@extends('layouts.admin')

@section('title')
    Enquiries
@endsection

@section('breadcrumb')
    <div class="navbar-nav align-items-center">
        <div class="nav-item navbar-search-wrapper mb-0">
            <h4 class="m-0">Enquiries</h4>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ Helper::assets('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ Helper::assets('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ Helper::assets('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet" href="{{ Helper::assets('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- DataTable with Buttons -->
        <div class="card">

            <div class="card-datatable">
                <table class="datatables-basic table table-striped border-top data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Received at</th>
                            <th>Actions</th>
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
        var filter_url = "{{ route('admin.enquiry.index') }}";
        var delete_url = "{{ route('admin.enquiry.destroy', ['enquiry' => 'enquiryid']) }}";
    </script>
    <script defer src="{{ Helper::assets('assets/js/pages/admin/enquiry.js') }}?v={{ config('constant.asset_version') }}" type="text/javascript"></script>
@endsection
