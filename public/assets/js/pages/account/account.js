$(document).ready(function () {
    $(".account-form").validate({
        rules: {
            first_name: { required: true, normalizer: function (value) { return $.trim(value) }, alpha: true, minlength: 2, maxlength: 255 },
            last_name: { required: true, normalizer: function (value) { return $.trim(value) }, alpha: true, minlength: 2, maxlength: 255 },
            name: { required: true, normalizer: function (value) { return $.trim(value) }, alpha: true, minlength: 2, maxlength: 255 },
            email: { required: true, normalizer: function (value) { return $.trim(value) }, email: false, remote: { type: "POST", url: exists_url, async: false, beforeSend: function () { $("#email").attr('disabled', true) }, complete: function () { $("#email").attr('disabled', false) }, data: { id: $('input[name="id"]').val() } }, maxlength: 255, checkEmail: true },
            country_code: { required: true, normalizer: function (value) { return $.trim(value) } },
            phone_number: { required: true, normalizer: function (value) { return $.trim(value) }, digits: true, minlength: 7, maxlength: 15, },
            photo: { required: { depends: function () { if ($("#old_photo").length && $("#old_photo").val() != "") { return false; } return true; } }, normalizer: function (value) { return $.trim(value) }, extension: "jpg|jpeg|png", filesize: 5000000 },
        },
        messages: {
            first_name: { required: "Please enter a first name" },
            last_name: { required: "Please enter a last name" },
            name: { required: "Please enter a full name" },
            email: { required: "Please enter an email address", remote: "This email address already exists!" },
            country_code: { required: "Please select country code" },
            phone_number: { required: "Please enter a contact number", minlength: $.validator.format("Please enter at least {0} digits."), maxlength: $.validator.format("Maximum {0} digits allowed."), },
            photo: { required: "Please upload a profile picture", extension: "Only allowed JPG or PNG image format.", filesize: "Photo size must be less than or equal to 5MB" },
        }
    });
});
