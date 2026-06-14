@extends('layouts.app')

@section('title') Change password @endsection

@section('breadcrumb')
<div class="row page-title align-items-center">
    <div class="col-sm-6 col-xl-6">
        <h4 class="mb-1 mt-0 font-weight-medium">Change password</h4>
    </div>
</div>
@endsection

@section('content')
<div class="account-pages">
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-xl-6 mx-auto">
                <div class="card">
                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('user.update.password') }}" class="change-password-form-validation">
                            @csrf
                            <div class="form-group">
                                <label>Current password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control input-validate @if($errors->has('old_password')) is-invalid @endif" id="old_password" placeholder="*********" required="" name="old_password" data-error="old_password-error" aria-required="true" aria-invalid="false" value="{{ old('old_password') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text show-password" data-show-pass="old_password">
                                            <i class="icon-eye" role="button"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="old_password-error"></div>
                                @if($errors->has('old_password'))
                                <label id="old_password-error" class="invalid-feedback" for="old_password" style="display: inline-block;">{{ $errors->first('old_password') }}</label>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>New password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control input-validate @if($errors->has('password')) is-invalid @endif" id="password" placeholder="*********" required="" name="password" data-error="password-error" aria-required="true" aria-invalid="false" value="{{ old('password') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text show-password" data-show-pass="password">
                                            <i class="icon-eye" role="button"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="password-error"></div>
                                @if($errors->has('password'))
                                <label id="password-error" class="invalid-feedback" for="password" style="display: inline-block;">{{ $errors->first('password') }}</label>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Confirm password <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control input-validate @if($errors->has('password_confirmation')) is-invalid @endif" id="password_confirmation" placeholder="*********" required="" name="password_confirmation" data-error="password_confirmation-error" aria-required="true" aria-invalid="false" value="{{ old('password_confirmation') }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text show-password" data-show-pass="password_confirmation">
                                            <i class="icon-eye" role="button"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="password_confirmation-error"></div>
                                @if($errors->has('password_confirmation'))
                                <label id="password_confirmation-error" class="invalid-feedback" for="password_confirmation" style="display: inline-block;">{{ $errors->first('password_confirmation') }}</label>
                                @endif
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary btn-min-width">Update password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-bottom')
<script defer src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/js/pages/account/change-password.js') }}?v={{config('constant.asset_version')}}"></script>
@endsection
