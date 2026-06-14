<!doctype html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="{{ Helper::assets('assets') }}/" data-template="vertical-menu-template">

@include('layouts.admin.admin-head')

<body>
    <!-- Pre-loader -->
    <div id="preloader">
        <div id="status">
            <div class="sk-chase sk-primary">
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
    @yield('content')

    @include('layouts.admin.admin-footer-script')
    @include('layouts.shared.toast-message')
</body>

</html>
