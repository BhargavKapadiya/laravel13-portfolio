$(function () {
    $(".forgot-form-validate").validate({
        rules: { email: { required: true, normalizer: function (value) { return $.trim(value) }, email: false, checkEmail: true } },
        messages: { email: { required: "Please enter an email address" } },
    });
});
