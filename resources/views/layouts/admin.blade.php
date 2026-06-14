<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="{{ Helper::assets('assets') }}/" data-template="vertical-menu-template">

@include('layouts.admin.admin-head')

<body>
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

    <!-- Layout wrapper Start-->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Left Sidebar Start -->
            @include('layouts.admin.admin-sidebar')
            <!-- Left Sidebar End -->

            <!-- Layout container Start -->
            <div class="layout-page">
                <!-- Navbar Start -->
                @include('layouts.admin.admin-nav', ['menuIcon' => true])
                <!-- Navbar End -->

                <!-- Content wrapper Start -->
                <div class="content-wrapper">
                    <!-- Content Start -->
                    @yield('content')
                    <!-- Content End -->

                    <!-- Footer Start -->
                    @include('layouts.admin.admin-footer')
                    <!-- Footer End -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper End -->

            </div>
            <!-- Layout container End -->

        </div>

        <!-- Overlay Start -->
        <div class="layout-overlay layout-menu-toggle"></div>
        <!-- Overlay End -->

        <!-- Drag Target Area To SlideIn Menu On Small Screens Start -->
        <div class="drag-target"></div>
        <!-- Drag Target Area To SlideIn Menu On Small Screens End -->

    </div>
    <!-- Layout wrapper End-->

    @include('layouts.admin.admin-footer-script', ['notificationjs' => true])

    @include('layouts.shared.toast-message')
</body>

</html>
