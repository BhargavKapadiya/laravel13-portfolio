@extends('layouts.admin')

@php
    $is_update = false;
    if (isset($blog) && !empty($blog)) {
        $is_update = true;
    }
@endphp

@section('title')
    {{ $is_update ? 'Edit' : 'Add' }} Blog
@endsection

@section('breadcrumb')
    <div class="navbar-nav align-items-center">
        <div class="nav-item navbar-search-wrapper mb-0">
            <h4 class="m-0">{{ $is_update ? 'Edit' : 'Add New' }} Blog</h4>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="POST" action="{{ $is_update ? route('admin.blogs.update', ['blog' => $blog->uid]) : route('admin.blogs.store') }}" class="form-horizontal   blog-form-validate" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @if ($is_update)
                                <input type="hidden" name="uid" value="{{ $blog->uid }}">
                                @method('PATCH')
                            @endif
                            <div class="row mb-3">
                                <div class="col-md-12 form-group">
                                    <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Title" name="title" id="title" value="{{ old('title', $is_update ? $blog->title : '') }}">
                                    @error('title')
                                        <label id="title-error" class="invalid-feedback" for="title" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12 form-group ckeditor">
                                    <label class="form-label" for="description"> Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Description" name="description" id="description" rows="10">{{ old('description', $is_update ? $blog->description : '') }}</textarea>
                                    @error('description')
                                        <label id="description-error" class="invalid-feedback" for="description" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="form-group col-md-6">
                                    <label for="image" class="form-label"> Image</label>
                                    <div class="">
                                        <div class="upload-item">
                                            <div class="upload-document {{ $is_update && $blog->image != '' ? 'show image' : '' }}">
                                                <img class="icon-edit" src="{{ Helper::assets('assets/images/icons/edit-icon.svg') }}">
                                                <img class="icon-pdf" src="{{ Helper::assets('assets/images/icons/pdf.svg') }}">
                                                <img src="{{ Helper::assets('assets/images/icons/add-square.svg') }}" class="img-fluid icon-plus" alt="">
                                                <img src="{{ $is_update && $blog->image != '' ? $blog->image_url : Helper::assets('assets/images/icons/add-square.svg') }}" class="img-fluid icon-image" alt="">
                                                <input type="file" name="image" class="form-control document is-required" data-error="image-errors" accept="image/*">
                                                @if ($is_update && $blog->image != '')
                                                    <input type="hidden" class="old" name="old_image" id="old_image" value="{{ $is_update && $blog->image != '' ? $blog->image : '' }}">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="image-errors">
                                            @error('image')
                                                <label id="image-error" class="invalid-feedback" for="image">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label class="form-label" for="page">Read time <small>(in minutes)</small> <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('time_spend') is-invalid @enderror" placeholder="Ex. 5" name="time_spend" id="time_spend" value="{{ old('time_spend', $is_update ? $blog->time_spend : '') }}">
                                    @error('time_spend')
                                        <label id="time_spend-error" class="invalid-feedback" for="time_spend" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12 form-group">
                                    <label class="form-label" for="page">Page/Meta title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror" placeholder="Title" name="meta_title" id="meta_title" value="{{ old('meta_title', $is_update ? $blog->meta_title : '') }}">
                                    @error('meta_title')
                                        <label id="meta_title-error" class="invalid-feedback" for="meta_title" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12 form-group">
                                    <label class="form-label" for="meta_description"> Meta description <span class="text-danger">*</span></label>
                                    <textarea rows="3" class="form-control @error('meta_desc') is-invalid @enderror" placeholder="Meta Description" name="meta_desc" id="meta_desc" rows="10">{{ old('meta_desc', $is_update ? $blog->meta_desc : '') }}</textarea>
                                    @error('meta_desc')
                                        <label id="meta_desc-error" class="invalid-feedback" for="meta_desc" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12 form-group">
                                    <label class="form-label" for="url">URL (Slug)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ route('blogs') }}/</span>
                                        </div>
                                        <input type="text" class="form-control @error('slug') is-invalid @enderror" placeholder="URL handle" name="slug" id="slug" value="{{ old('slug', $is_update ? $blog->slug : '') }}">
                                    </div>
                                    <small class="form-text text-muted">Created based on page title</small>

                                    @error('slug')
                                        <label id="slug-error" class="invalid-feedback" for="slug" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="">
                                <a href="{{ route('admin.blogs.index') }}"><button type="button" class="btn btn-danger mr-1 btn-min-width">Cancel</button></a>
                                <button type="submit" class="btn btn-primary btn-min-width">{{ $is_update ? 'Update' : 'Save' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script defer src="{{ Helper::assets('assets/libs/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script defer src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}" type="text/javascript"></script>
    <script defer src="{{ Helper::assets('assets/libs/validation/additional-methods.min.js') }}" type="text/javascript"></script>
@endsection

@section('script-bottom')
    <script type="text/javascript">
        var exists_url = "{{ route('admin.blogs.exists') }}";
        var image_upload_url = "{{ route('upload-ck-editor-images', ['_token' => csrf_token()]) }}";
    </script>
    <script defer src="{{ Helper::assets('assets/js/pages/admin/blogs.js') }}?v={{ config('constant.asset_version') }}" type="text/javascript"></script>
    <script defer src="{{ Helper::assets('assets/js/pages/upload-file.js') }}?v={{ config('constant.asset_version') }}" type="text/javascript"></script>
@endsection
