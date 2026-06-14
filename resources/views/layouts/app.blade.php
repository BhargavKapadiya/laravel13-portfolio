<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-wide" dir="ltr" data-theme="theme-default" data-assets-path="{{ Helper::assets('assets') }}/" data-template="front-pages">

@include('layouts.shared.head')

@php
    $user = null;
    if (Auth::guard('web')->check()) {
        $user = Auth::guard('web')->user();
    }
    $mobile = in_array(Route::currentRouteName(), ['app.terms-conditions', 'app.privacy-policy', 'app.about-us']) ? true : false;
@endphp

<body>

    @if (!$mobile)
        <!-- Pre-loader -->
        <div id="preloader">
            <div id="status">
                <div class="sk-chase sk-primary loader">
                    <div class="sk-chase-dot"></div>
                    <div class="sk-chase-dot"></div>
                    <div class="sk-chase-dot"></div>
                    <div class="sk-chase-dot"></div>
                    <div class="sk-chase-dot"></div>
                    <div class="sk-chase-dot"></div>
                </div>
                <div class="loading-text">Loading...</div>
            </div>
        </div>
        <!-- End Preloader-->
    @endif

    @yield('top-script')


    @if (!$mobile && !in_array(Route::currentRouteName(), ['login', 'register', 'password.request', 'password.reset']))
        @include('layouts.shared.nav', ['user' => $user])
    @endif
    @if (in_array(Route::currentRouteName(), ['login', 'register', 'password.request', 'password.reset']))
        @yield('content')
    @else
        <!-- ========== Left Sidebar Start ========== -->
        {{-- @include('layouts.shared.sidebar') --}}

        @yield('content')
        {{-- <div class="content-page {{ !$mobile ? 'py-3 mb-5' : 'mt-0 mb-2' }}">
                <div class="content">
                    <div class="container-fluid">
                    </div>
                </div>
            </div> --}}

        @if (!$mobile)
            @include('layouts.shared.footer')
        @endif
    @endif

    @if (!$mobile)
        @include('layouts.shared.footer-script', ['notificationjs' => true])
        @include('layouts.shared.toast-message')
    @endif
</body>

</html>
