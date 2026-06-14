@extends('layouts.admin')

@php
    $is_update = false;
    if (isset($email)) {
        $is_update = true;
    }
@endphp
@section('title')
    {{ $is_update ? 'Edit' : 'Add' }} Email Template
@endsection

@section('breadcrumb')
    <div class="navbar-nav align-items-center">
        <div class="nav-item navbar-search-wrapper mb-0">
            <h4 class="m-0">{{ $is_update ? 'Edit' : 'Add New' }} Email Content</h4>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="POST" action="{{ $is_update ? route('admin.email.update', ['email' => $email->uid]) : route('admin.email.store') }}" class="form-horizontal   email-form-validate" autocomplete="off">
                            @csrf
                            @if ($is_update)
                                @method('PATCH')
                                <input type="hidden" name="uid" value="{{ $email->uid }}">
                            @endif
                            <div class="row mb-3">
                                <div class="form-group col">
                                    <label class="form-label">Email Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Email Title" name="title" id="title" value="{{ old('title', $is_update ? $email->title : '') }}">

                                    @error('title')
                                        <label id="title-error" class="invalid-feedback" for="title" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group col">
                                    <label class="form-label">Email Subject <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror" placeholder="Email subject" name="subject" id="subject" value="{{ old('subject', $is_update ? $email->subject : '') }}">

                                    @error('subject')
                                        <label id="subject-error" class="invalid-feedback" for="subject" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group col ckeditor">
                                    <label class="form-label">Email Body <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('body') is-invalid @enderror" placeholder="Email body" name="body" id="body">{{ old('body', $is_update ? $email->body : '') }}</textarea>

                                    @error('body')
                                        <label id="body-error" class="invalid-feedback" for="body" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="">
                                <a href="{{ route('admin.email.index') }}"><button type="button" class="btn btn-danger mr-1 btn-min-width">Cancel</button></a>
                                <button type="submit" class="btn btn-primary btn-min-width">{{ $is_update ? 'Update' : 'Save' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script-bottom')
    <script type="text/javascript">
        var image_upload_url = "{{ route('upload-ck-editor-images', ['_token' => csrf_token()]) }}";
    </script>
    <script defer src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}" type="text/javascript"></script>
    <script defer src="{{ Helper::assets('assets/libs/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script defer src="{{ Helper::assets('assets/js/pages/admin/email_template.js') }}?v={{ config('constant.asset_version') }}" type="text/javascript"></script>
@endsection
