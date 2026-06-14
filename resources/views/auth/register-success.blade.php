@extends('layouts.app')

@section('content')
<div class="account-pages mb-md-2 mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-md-6 mx-auto">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-12 p-5 mx-auto text-center">
                                <div class="mx-auto mb-5 text-center">
                                    <a href="{{ url('/') }}">
                                        <img src="{{ Helper::assets('assets/images/logo.png') }}" class="site-logo" alt="Logo" />
                                    </a>
                                </div>
                                <div class="font-weight-medium mb-3 font-size-18">
                                    <div>{{ __('Verify Your Email') }}</div>
                                    <div class="text-primary">{{$user->user->email}}</div>
                                </div>
                                <div>
                                    <p>Your account has been successfully registered. To complete the verification process, please check your email.</p>
                                    <p>If you don’t receive a verification email in a few minutes, check your spam/junk folder to make sure it didn’t end up there.</p>
                                </div>
                            </div>
                        </div>

                    </div> <!-- end card-body -->
                </div><!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center font-size-16">
                        <span class="text-muted"><a href="{{-- route('email.resend') --}}" class="text-primary font-weight-medium mr-4 text-underline">{{ __('Resend email') }}</a></span>
                        <span class="text-grey ml-4">Return to <a href="{{ route('login') }}" class="text-primary font-weight-medium ml-1 text-underline">Sign in!</a></span>
                    </div> <!-- end col -->
                </div><!-- end row -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div><!-- end container -->
</div><!-- end page -->
@endsection
