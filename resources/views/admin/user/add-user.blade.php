@extends('layouts.admin')

@php
    $is_update = false;
    if (isset($user)) {
        $is_update = true;
    }
    $Countries = Helper::getCountry();
@endphp

@section('title')
    {{ $is_update ? 'Edit' : 'Add' }} user
@endsection

@section('css')
    <link href="{{ Helper::assets('assets/vendor/libs/select2/select2.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
    <div class="navbar-nav align-items-center">
        <div class="nav-item navbar-search-wrapper mb-0">
            <h4 class="m-0">{{ $is_update ? 'Edit' : 'Add New' }} User</h4>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="POST" action="{{ $is_update ? route('admin.user.update', $user->uid) : route('admin.user.store') }}" class="form-horizontal form-validate" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @if ($is_update)
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                @method('PUT')
                            @endif
                            <div class="row mb-3">
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ old('name', $is_update ? $user->name : '') }}">
                                    @error('name')
                                        <label id="name-error" class="invalid-feedback" for="name" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email', $is_update ? $user->email : '') }}" @if ($is_update) disabled @endif>
                                    @error('email')
                                        <label id="email-error" class="invalid-feedback" for="email" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="form-group col-md-6">
                                    <label class="form-label">Phone number <span class="text-danger">*</span></label>
                                    <div class="phone-wrapper">
                                        <div class="input-group phone-group">
                                            <select class="form-select select2-custom" id="country_code" name="country_code">
                                                <option value="">Select</option>
                                                @foreach ($Countries as $country)
                                                    <option value="{{ $country->isd_code }}" {{ old('country_code', $is_update ? $user->country_code : '') == $country->isd_code ? 'selected' : '' }}>
                                                        {{ $country->isd_code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="Phone number" value="{{ old('phone_number', $is_update ? $user->phone_number : '') }}">
                                        </div>
                                        @error('phone_number')
                                            <label id="phone_number-error" class="invalid-feedback" for="phone_number">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="photo" class="form-label"> Profile picture</label>
                                    <div class="">
                                        <div class="upload-item">
                                            <div class="upload-document {{ $is_update && $user->photo != '' ? 'show image' : '' }}">
                                                <img class="icon-edit" src="{{ Helper::assets('assets/images/icons/edit-icon.svg') }}">
                                                <img class="icon-pdf" src="{{ Helper::assets('assets/images/icons/pdf.svg') }}">
                                                <img src="{{ Helper::assets('assets/images/icons/add-square.svg') }}" class="img-fluid icon-plus" alt="">
                                                <img src="{{ $is_update && $user->photo != '' ? $user->photo_url : Helper::assets('assets/images/icons/add-square.svg') }}" class="img-fluid icon-image" alt="">
                                                <input type="file" name="photo" class="form-control document is-required" data-error="photo-errors" accept="image/*">
                                                @if ($is_update && $user->photo != '')
                                                    <input type="hidden" class="old" name="old_photo" id="old_photo" value="{{ $is_update && $user->photo != '' ? $user->photo : '' }}">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="photo-errors">
                                            @error('photo')
                                                <label id="photo-error" class="invalid-feedback" for="photo">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="">
                                <a href="{{ route('admin.user.index') }}"><button type="button" class="btn btn-danger mr-1 btn-min-width">Cancel</button></a>
                                <button type="submit" class="btn btn-primary btn-min-width">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script defer src="{{ Helper::assets('assets/vendor/libs/select2/select2.js') }}"></script>
    <script defer src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}" type="text/javascript"></script>
    <script defer src="{{ Helper::assets('assets/libs/validation/additional-methods.min.js') }}" type="text/javascript"></script>
@endsection

@section('script-bottom')
    <script type="text/javascript">
        var exists_url = "{{ route('admin.user.exists') }}";
    </script>
    <script defer src="{{ Helper::assets('assets/js/pages/admin/user.js') }}?v={{ config('constant.asset_version') }}" type="text/javascript"></script>
    <script defer src="{{ Helper::assets('assets/js/pages/upload-file.js') }}?v={{ config('constant.asset_version') }}" type="text/javascript"></script>
@endsection
