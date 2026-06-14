$(function () {
    // Setup validation
    if (typeof validate !== 'function' && $.fn.validate) {
        $(".settings-form-validate").validate({
            rules: {
                android_version: {
                    required: true,
                    normalizer: function (value) { return $.trim(value); },
                    number: true,
                },
                ios_version: {
                    required: true,
                    normalizer: function (value) { return $.trim(value); },
                    number: true,
                },
            },
            messages: {
                android_version: {
                    required: "Please enter android version",
                },
                ios_version: {
                    required: "Please enter IOS version",
                },
            }
        });
    }
});
