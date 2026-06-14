if (typeof is_front === "undefined") {
    var is_front = false;
}
if (typeof exists_url === "undefined") {
    var exists_url = "";
}
$(function () {
    $(".register-form-validate").validate({
        rules: {
            first_name: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                alpha: true,
                minlength: 2,
                maxlength: 50,
            },
            last_name: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                alpha: true,
                minlength: 2,
                maxlength: 50,
            },
            name: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                alpha: true,
                minlength: 2,
                maxlength: 50,
            },
            email: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                email: false,
                remote: {
                    type: "POST",
                    url: exists_url,
                    async: false,
                    beforeSend: function () {
                        $("#email").attr("disabled", true);
                    },
                    complete: function () {
                        $("#email").attr("disabled", false);
                    },
                    data: { id: $('input[name="id"]').val() },
                },
                maxlength: 255,
                checkEmail: true,
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
                minlength: 6,
                maxlength: 18,
            },
            terms: { required: true },
        },
        messages: {
            first_name: { required: "Please enter a first name" },
            last_name: { required: "Please enter a last name" },
            name: { required: "Please enter a full name" },
            email: {
                required: "Please enter an email address",
                remote: "This email address already exists!",
            },
            password: { required: "Please enter a password" },
            password_confirmation: {
                required: "Please enter a confirm password",
                equalTo: "Please enter same password as above",
            },
            terms: { required: "You must agree with the terms and conditions" },
        },
    });
});
