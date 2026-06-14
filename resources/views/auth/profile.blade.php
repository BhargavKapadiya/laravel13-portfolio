@extends('layouts.app')

@section('title') My profile @endsection


@section('css')
<link href="{{ Helper::assets('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
<div class="row page-title align-items-center">
    <div class="col-sm-6 col-xl-6">
        <h4 class="mb-1 mt-0 font-weight-medium">My Profile</h4>
    </div>
</div>
@endsection

@php
    $is_update = false;
    if(isset($user)){
        $is_update=true;
    }
    $Countries = Helper::getCountry();
@endphp

@section('content')
<div class="account-pages">
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-xl-6 mx-auto">
                <div class="card">
                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('save.profile') }}" class="account-form" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <h4 class="mb-3 mt-0 font-weight-medium">Update Profile</h4>
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name', $is_update ? $user->name : '') }}" class="form-control @if($errors->has('name')) is-invalid @endif" id="name" placeholder="Name" />

                                @if($errors->has('name'))
                                <label class="invalid-feedback" role="alert" style="display: inline-block;">{{ $errors->first('name') }}</label>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" value="{{ old('email', $is_update ? $user->email : '') }}" class="form-control @if($errors->has('email')) is-invalid @endif" id="email" placeholder="Email" disabled/>

                                @if($errors->has('email'))
                                <label class="invalid-feedback" role="alert" style="display: inline-block;">{{ $errors->first('email') }}</label>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Phone number<span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="form-group col-md-4 pr-md-0">
                                        <select class="select2-custom" id="country_code" name="country_code">
                                            <option value="">Select</option>
                                            @foreach ($Countries as $country)
                                            <option value="{{$country->isd_code}}" {{ old('country_code', ($is_update ? $user->country_code : '')) == $country->isd_code ? "selected" : "" }}>{{$country->isd_code}}</option>
                                            @endforeach
                                        </select>
                                        @error('country_code')
                                            <label id="country_code-error" class="invalid-feedback" for="country_code" style="display: inline-block;">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-8 form-group pl-md-0">
                                        <input type="phone_number" name="phone_number" value="{{ old('phone_number', ($is_update ? $user->phone_number : '')) }}" class="form-control @if($errors->has('phone_number')) is-invalid @endif" id="phone_number" placeholder="Phone number"/>

                                        @if($errors->has('phone_number'))
                                        <label class="invalid-feedback" role="alert" style="display: inline-block;">{{ $errors->first('phone_number') }}</label>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="photo" class="mb-0"> Profile picture</label>
                                <small class="form-text text-muted">Recommended size: Max 5MB. Accepted file formats: png, jpg and jpeg</small>
                                <div class="mt-3">
                                    <div class="upload-item">
                                        <div class="upload-document {{ $is_update && $user->photo != "" ? 'show image' : '' }}">
                                            <img class="icon-edit" src="{{Helper::assets('assets/images/icons/edit-icon.svg') }}">
                                            <img class="icon-pdf" src="{{Helper::assets('assets/images/icons/pdf.svg') }}">
                                            <img src="{{Helper::assets('assets/images/icons/add-square.svg')}}" class="img-fluid icon-plus" alt="">
                                            <img src="{{ $is_update && $user->photo != "" ? $user->photo_url : Helper::assets('assets/images/icons/add-square.svg') }}" class="img-fluid icon-image" alt="">
                                            <input type="file" name="photo" class="document is-required" data-error="photo-errors" accept="image/*">
                                            @if($is_update && $user->photo != "")
                                            <input type="hidden" class="old" name="old_photo" id="old_photo" value="{{ $is_update && $user->photo != "" ? $user->photo : "" }}">
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
                            {{-- <div class="">
                                <div class="upload-document-section">
                                    <div class="upload-multiple-file upload-section">
                                        <div class="upload-item" data-startingIndex="1">
                                            <div class="upload-document">
                                                <img class="icon-cross" src="{{Helper::assets('assets/images/icons/cross.svg') }}">
                                                <img class="icon-pdf" src="{{Helper::assets('assets/images/icons/pdf.svg') }}">
                                                <img src="{{Helper::assets('assets/images/icons/add-square.svg')}}" class="img-fluid icon-plus" alt="">
                                                <img src="{{Helper::assets('assets/images/icons/add-square.svg') }}" class="img-fluid icon-image" alt="">
                                                <input type="file" name="images[0][image]" class="document is-required" data-error="images-error" accept="image/*,">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="images-error"></div>
                                </div>
                            </div> --}}
                            <div class="mt-5 text-center">
                                <button type="submit" class="btn btn-primary btn-min-width">Update profile</button>
                            </div>
                        </form>
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end container -->
</div> <!-- end page -->
@endsection

@section('script')
<script defer src="{{ Helper::assets('assets/libs/select2/select2.full.min.js')}}"></script>
<script defer src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/validation/additional-methods.min.js') }}" type="text/javascript"></script>
@endsection

@section('script-bottom')
<script type="text/javascript">
    var exists_url = "{{ route('user.exists') }}";
</script>
<script defer src="{{ Helper::assets('assets/js/pages/account/account.js') }}?v={{config('constant.asset_version')}}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/js/pages/upload-file.js') }}?v={{config('constant.asset_version')}}" type="text/javascript"></script>
@endsection
