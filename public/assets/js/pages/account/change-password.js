$(function () {
    $(".change-password-form-validation").validate({
        rules: {
            old_password: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                minlength: 8,
                maxlength: 18,
            },
            password: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                minlength: 8,
                maxlength: 18,
            },
            password_confirmation: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                equalTo: "#password",
            },
        },
        messages: {
            old_password: { required: "Please enter a current password" },
            password: { required: "Please enter a new password" },
            password_confirmation: {
                required: "Please enter a confirm password",
                equalTo: "Please enter same password as above",
            },
        },
    });
});
