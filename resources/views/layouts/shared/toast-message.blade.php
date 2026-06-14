<link rel="stylesheet" type="text/css" href="{{ Helper::assets('assets/libs/toastr/toastr.min.css') }}">
<script defer src="{{ Helper::assets('assets/libs/toastr/toastr.min.js') }}"></script>
<script>
    function successToast(message) {
        toastr.options.tapToDismiss = 1;
        toastr.options.progressBar = 1;
        toastr.options.fadeOut = 5000;
        toastr.success(message);
    }

    function infoToast(message) {
        toastr.options.tapToDismiss = 1;
        toastr.options.progressBar = 1;
        toastr.options.fadeOut = 5000;
        toastr.info(message);
    }

    function warningToast(message) {
        toastr.options.tapToDismiss = 1;
        toastr.options.progressBar = 1;
        toastr.options.fadeOut = 5000;
        toastr.warning(message);
    }

    function errorToast(message) {
        toastr.options.tapToDismiss = 1;
        toastr.options.progressBar = 1;
        toastr.options.fadeOut = 5000;
        toastr.error(message);
    }
    $(document).ready(function() {
        @if (Session::has('success'))
            successToast("{{ Session::get('success') }}");
        @endif
        @if (Session::has('info'))
            infoToast("{{ Session::get('info') }}");
        @endif
        @if (Session::has('warning'))
            warningToast("{{ Session::get('warning') }}");
        @endif
        @if (Session::has('error'))
            errorToast("{{ Session::get('error') }}");
        @endif
    });
</script>
