@extends('layouts.admin')

@section('title')
    Blogs
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
            <h4 class="m-0">Blogs</h4>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- DataTable with Buttons -->
        <div class="card">
            <div class="card-header p-3 d-flex justify-content-end">
                <a href="{{ route('admin.blogs.create') }}"><button type="button" class="btn btn-primary text-white"> Add New Blog</button></a>
            </div>

            <div class="card-datatable">
                <table class="datatables-basic table table-striped border-top data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Read time</th>
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
        var filter_url = "{{ route('admin.blogs.records') }}";
        var delete_url = "{{ route('admin.blogs.destroy', ['blog' => 'blogid']) }}";
    </script>
    <script defer src="{{ Helper::assets('assets/js/pages/admin/blogs.js') }}?v={{ config('constant.asset_version') }}" type="text/javascript"></script>
@endsection
