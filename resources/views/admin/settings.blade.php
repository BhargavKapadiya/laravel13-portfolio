@extends('layouts.admin')

@php
    $is_update = false;
    if (isset($settings)) {
        $is_update = true;
    }
@endphp

@section('title')
    Settings
@endsection

@section('breadcrumb')
    <div class="navbar-nav align-items-center">
        <div class="nav-item navbar-search-wrapper mb-0">
            <h4 class="m-0">Application settings</h4>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.save.settings') }}" class="form-horizontal settings-form-validate" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @if ($is_update)
                                <input type="hidden" name="id" value="{{ $settings->id }}">
                            @endif
                            <div class="row mb-3">
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="android_version"> Android Version <span class="text-danger"> * </span></label>
                                    <input type="text" class="form-control @error('android_version') is-invalid @enderror" placeholder="Android Version" name="android_version" id="android_version" value="{{ old('android_version', $is_update ? $settings->android_version : '') }}">
                                    @error('android_version')
                                        <label id="android_version-error" class="invalid-feedback" for="android_version" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="ios_version"> iOS Version <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('ios_version') is-invalid @enderror" placeholder="iOS Version" name="ios_version" id="ios_version" value="{{ old('ios_version', $is_update ? $settings->ios_version : '') }}">
                                    @error('ios_version')
                                        <label id="ios_version-error" class="invalid-feedback" for="ios_version" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="android_force_update">Android Force Update?</label><br>
                                    <label class="switch switch-square switch-lg switch-success">
                                        <input type="checkbox" id="android_force_update" name="android_force_update" class="switch-input android_force_update" value="1" data-error="android_force_update-error" {{ old('android_force_update', $is_update && $settings->android_force_update == 1 ?? 1) ? 'checked' : '' }}>
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on"> Yes </span>
                                            <span class="switch-off"> No </span>
                                        </span>
                                    </label>
                                    @error('android_force_update')
                                        <label id="android_force_update-error" class="invalid-feedback" for="android_force_update" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="ios_force_update">iOS Force Update?</label><br>
                                    <label class="switch switch-square switch-lg switch-success">
                                        <input type="checkbox" id="ios_force_update" name="ios_force_update" class="switch-input ios_force_update" value="1" data-error="ios_force_update-error" {{ old('ios_force_update', $is_update && $settings->ios_force_update == 1 ?? 1) ? 'checked' : '' }}>
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on"> Yes </span>
                                            <span class="switch-off"> No </span>
                                        </span>
                                    </label>
                                    @error('ios_force_update')
                                        <label id="ios_force_update-error" class="invalid-feedback" for="ios_force_update" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group col-md-6 mt-3">
                                    <label class="form-label" for="under_maintenance">Under maintenance (Android, iOS)</label><br>
                                    <label class="switch switch-square switch-lg switch-success">
                                        <input type="checkbox" id="under_maintenance" name="under_maintenance" class="switch-input under_maintenance" value="1" data-error="under_maintenance-error" {{ old('under_maintenance', $is_update && $settings->under_maintenance == 1 ?? 1) ? 'checked' : '' }}>
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on"> Yes </span>
                                            <span class="switch-off"> No </span>
                                        </span>
                                    </label>
                                    @error('under_maintenance')
                                        <label id="under_maintenance-error" class="invalid-feedback" for="under_maintenance" style="display: inline-block;">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="">
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-md btn-danger btn-min-width mr-1"> {{ __('Cancel') }} </a>
                                <button type="submit" class="btn btn-primary btn-min-width">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-bottom')
    <script type="text/javascript"></script>
    <script defer src="{{ Helper::assets('assets/js/pages/admin/settings.js') }}?v={{ config('constant.asset_version') }}" type="text/javascript"></script>
@endsection
