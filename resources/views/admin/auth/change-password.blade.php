@extends('layouts.admin')

@section('title')
    Change password
@endsection

@section('breadcrumb')
    <div class="navbar-nav align-items-center">
        <div class="nav-item navbar-search-wrapper mb-0">
            <h4 class="m-0">Change password</h4>
        </div>
    </div>
@endsection

@section('css-bottom')
    <link rel="stylesheet" href="{{ Helper::assets('assets/vendor/css/pages/page-auth.css') }}" />
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.update.password') }}" class="change-password-form-validation">
                            @csrf
                            <div class="row mb-3">
                                <div class="form-group form-password-toggle">
                                    <label class="form-label">Current password <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" class="form-control input-validate @if ($errors->has('old_password')) is-invalid @endif" id="old_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required="" name="old_password" data-error="old_password-error" aria-describedby="password" aria-required="true" aria-invalid="false" value="{{ old('old_password') }}">
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                    <div class="old_password-error"></div>
                                    @if ($errors->has('old_password'))
                                        <label id="old_password-error" class="invalid-feedback" for="old_password" style="display: inline-block;">{{ $errors->first('old_password') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="form-group form-password-toggle">
                                    <label class="form-label">New password <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" class="form-control input-validate @if ($errors->has('password')) is-invalid @endif" id="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required="" name="password" data-error="password-error" aria-describedby="password" aria-required="true" aria-invalid="false" value="{{ old('password') }}">
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                    <div class="password-error"></div>
                                    @if ($errors->has('password'))
                                        <label id="password-error" class="invalid-feedback" for="password" style="display: inline-block;">{{ $errors->first('password') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="form-group form-password-toggle">
                                    <label class="form-label">Confirm password <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" class="form-control input-validate @if ($errors->has('password_confirmation')) is-invalid @endif" id="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required="" name="password_confirmation" data-error="password_confirmation-error" aria-describedby="password" aria-required="true" aria-invalid="false" value="{{ old('password_confirmation') }}">
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                    <div class="password_confirmation-error"></div>
                                    @if ($errors->has('password_confirmation'))
                                        <label id="password_confirmation-error" class="invalid-feedback" for="password_confirmation" style="display: inline-block;">{{ $errors->first('password_confirmation') }}</label>
                                    @endif
                                </div>
                            </div>

                            <div class="">
                                <button type="submit" class="btn btn-primary">Update password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-bottom')
    <script defer src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}" type="text/javascript"></script>
    <script defer src="{{ Helper::assets('assets/js/pages/account/change-password.js') }}?v={{ config('constant.asset_version') }}"></script>
@endsection
