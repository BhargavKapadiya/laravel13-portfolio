@extends('layouts.admin')

@php
    $is_update = false;
    if (isset($settings)) {
        $is_update = true;
    }
@endphp

@section('title')
    Edit {{ $page_title }}
@endsection

@section('breadcrumb')
    <div class="navbar-nav align-items-center">
        <div class="nav-item navbar-search-wrapper mb-0">
            <h4 class="m-0">Edit {{ $page_title }}</h4>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form class="form-horizontal edit-page-form-validate" method="post" action="{{ route('admin.save.pageContent') }}">
                            @csrf
                            <div class="row mb-3">
                                <div class="form-group ckeditor">
                                    <textarea class="hidden1" name="page_content" id="page_content">{{ $page_content }}</textarea>
                                </div>
                            </div>
                            <input type="hidden" name="file_name" value="{{ $file_name }}">
                            <input type="hidden" name="page_title" value="{{ $page_title }}">
                            <button id="save" class="btn btn-primary btn-min-width" type="submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script defer type="text/javascript" src="{{ Helper::assets('assets/libs/ckeditor/ckeditor.js') }}"></script>
    <script defer type="text/javascript" src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}"></script>
@endsection

@section('script-bottom')
    <script type="text/javascript">
        var image_upload_url = "{{ route('upload-ck-editor-images', ['_token' => csrf_token()]) }}";
    </script>
    <script defer type="text/javascript" src="{{ Helper::assets('assets/js/pages/admin/editPageContent.js') }}?v={{ config('constant.asset_version') }}"></script>
@endsection
