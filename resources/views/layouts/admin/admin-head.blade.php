<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ env('APP_NAME') }} | @yield('title')</title>

    <meta name="description" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="canonical" href="{{ URL::current() }}" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ Helper::assets('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ Helper::assets('assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ Helper::assets('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ Helper::assets('assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ Helper::assets('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ Helper::assets('assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ Helper::assets('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ Helper::assets('assets/css/custom-style.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ Helper::assets('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ Helper::assets('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ Helper::assets('assets/vendor/libs/spinkit/spinkit.css') }}" />

    <!-- Vendor -->
    @yield('css')

    <!-- Page CSS -->
    @yield('css-bottom')

    <!-- Helpers -->
    <script src="{{ Helper::assets('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ Helper::assets('assets/vendor/js/template-customizer.js') }}"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ Helper::assets('assets/js/config.js') }}"></script>

    <script type="text/javascript">
        (function() {
            window.onpageshow = function(event) {
                if (event.persisted) {
                    window.location.reload();
                }
            };
        })();
    </script>
</head>
