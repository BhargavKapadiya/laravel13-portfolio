$(function () {
    // Setup validation
    $(".reset-form-validate").validate({
        rules: {
            email: { required: true, normalizer: function (value) { return $.trim(value); }, email: false, checkEmail: true },
            password: { required: true, normalizer: function (value) { return $.trim(value); }, minlength: 8, maxlength: 18 },
            password_confirmation: { required: true, normalizer: function (value) { return $.trim(value); }, equalTo: "#password" },
        },
        messages: {
            email: { required: "Please enter an email address" },
            password: { required: "Please enter a password" },
            password_confirmation: { required: "Please enter a confirm password", equalTo: "Please enter same password as above" },
        },
    });
});
