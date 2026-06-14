<!-- Core JS -->

<!-- build:js assets/vendor/js/core.js -->
<script src="{{ Helper::assets('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ Helper::assets('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ Helper::assets('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ Helper::assets('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ Helper::assets('assets/vendor/libs/hammer/hammer.js') }}"></script>
<script src="{{ Helper::assets('assets/vendor/libs/i18n/i18n.js') }}"></script>
<script src="{{ Helper::assets('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
<script src="{{ Helper::assets('assets/vendor/js/menu.js') }}"></script>
<!-- build End -->

<!-- Vendors JS -->
@yield('script')

<!-- Main JS -->
<script src="{{ Helper::assets('assets/js/main.js') }}"></script>
<script src="{{ Helper::assets('assets/js/custom.js') }}"></script>

<!-- Page JS -->
@yield('script-bottom')

<script type="text/javascript">
    var assetUrl = "{{ Helper::assets('assets/') }}";
</script>

@if (isset($notificationjs) && $notificationjs)
    <script defer type="text/javascript">
        var get_notification_link = "{{ route('admin.notifications') }}";
    </script>
    <script defer src="{{ Helper::assets('assets/js/pages/notification.js') }}"></script>
@endif
