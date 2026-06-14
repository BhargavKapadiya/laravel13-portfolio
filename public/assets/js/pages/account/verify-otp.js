if (typeof verified_send_otp_url === "undefined") { var verified_send_otp_url = ""; }
if (typeof verified_otp_url === "undefined") { var verified_otp_url = ""; }

let timerOn = true;
let timerId;

document.addEventListener("paste", function (e) {
    if (e.target.type === "text") {
        var data = e.clipboardData.getData('Text');
        data = data.split('');
        [].forEach.call(document.querySelectorAll("input[id*='digit-']"), (node, index) => {
            node.value = data[index];
        });
    }
});

$(function () {
    if ($(".otp-form-validate").length) {
        $(".otp-form-validate").validate({
            rules: {
                otp: {
                    required: true,
                    normalizer: function (value) { return $.trim(value) },
                    digits: true,
                    minlength: 4,
                    maxlength: 4
                },
                digit_1: {
                    required: true,
                    normalizer: function (value) { return $.trim(value) },
                    digits: true,
                },
                digit_2: {
                    required: true,
                    normalizer: function (value) { return $.trim(value) },
                    digits: true,
                },
                digit_3: {
                    required: true,
                    normalizer: function (value) { return $.trim(value) },
                    digits: true,
                },
                digit_4: {
                    required: true,
                    normalizer: function (value) { return $.trim(value) },
                    digits: true,
                },
            },
            messages: {
                otp: { required: "Please enter otp" },
                digit_1: { required: "Please enter code" },
                digit_2: { required: "Please enter code" },
                digit_3: { required: "Please enter code" },
                digit_4: { required: "Please enter code" },
            }
        });
    }

    $(document).on('click', '.go-back', function () {
        $('.register-form, .login-form').show();
        $('.otp-form').hide();
        $('.otp-sent').val(0);
    });

    $('.send-otp:not(.btn-visible)').hide();

    if ($('.timer-countdown').length) {
        timerOn = true;
        clearTimeout(timerId);
        timer(120);
    }

    $(document).on('click', '.send-otp', function (e) {
        e.preventDefault();
        var _this = $(this);
        var $form = $('.register-form-validate, .forgot-form-validate');
        if ($form) {
            var validator = $form.validate();
        }

        validator.form();

        setTimeout(function () {
            if ($(".otp-form-validate").length || $form.valid()) {
                $(".email").html($("#email").val());
                $.ajax({
                    type: 'post',
                    url: verified_send_otp_url,
                    data: $('form').serialize(),
                    dataType: 'json',
                    beforeSend: function () { $(_this).prop('disabled', true); $(_this).find('.indicator-label').hide(); $(_this).find('.indicator-progress').show(); },
                    complete: function () { $(_this).prop('disabled', false); $(_this).find('.indicator-label').show(); $(_this).find('.indicator-progress').hide(); },
                    success: function (result) {
                        if (result.status == true) {
                            $("html, body").animate({ scrollTop: 0 }, "slow");
                            $('.timer-countdown').show();
                            $('.send-otp:not(.btn-visible)').hide();
                            if (typeof result.data !== "undefined" && result.data != null && typeof result.data.redirect !== "undefined") {
                                $(_this).prop('disabled', true);
                                location.href = result.data.redirect;
                            } else {
                                timerOn = true;
                                clearTimeout(timerId);
                                timer(120);
                                $('.otp-sent').val(1);
                                $('.register-form,.login-form').hide();
                                $('.otp-form').show();
                            }
                            successToast(result.message);
                        } else {
                            if (result.message) {
                                errorToast(result.message);
                            }
                        }
                    }
                });
            }
        }, 300);
    });

    $(document).on('click', '.verify-otp', function (e) {
        e.preventDefault();
        var _this = $(this);
        var $form = $('.login-form-validate, .register-form-validate, .forgot-form-validate, .otp-form-validate');
        if ($form) {
            var validator = $form.validate();
        }

        validator.form();

        setTimeout(function () {
            if ($form.valid()) {
                $.ajax({
                    type: 'post',
                    url: verified_otp_url,
                    data: $('form').serialize(),
                    dataType: 'json',
                    beforeSend: function () { $(_this).prop('disabled', true); $(_this).find('.indicator-label').hide(); $(_this).find('.indicator-progress').show(); },
                    complete: function () { $(_this).prop('disabled', false); $(_this).find('.indicator-label').show(); $(_this).find('.indicator-progress').hide(); },
                    success: function (result) {
                        if (result.status == true) {
                            $(_this).prop('disabled', true);
                            if (typeof result.data !== "undefined" && result.data != null && typeof result.data.redirect !== "undefined") {
                                location.href = result.data.redirect;
                            } else if ($('.register-form-validate').length) {
                                $('.register-form-validate').trigger('submit');
                            } else if ($('.login-form-validate').length) {
                                $('.login-form-validate').trigger('submit');
                            }
                            successToast(result.message);
                        } else {
                            if (result.message) {
                                errorToast(result.message);
                            }
                        }
                    }
                });
            }
        });
    });

    $('.digit-group').find('input').each(function () {
        $(this).attr('maxlength', 1); // Ensure only 1 character per input
        $(this).on('keyup', function (e) {
            var parent = $($(this).parents('.digit-group'));
            if (e.key === 'Backspace' || e.key === 'ArrowLeft') {
                var prev = parent.find('input#' + $(this).data('previous'));
                if (prev.length) {
                    prev.focus().select(); // Move focus and select the previous input
                }
            } else if ((e.key >= '0' && e.key <= '9') || (e.key.toLowerCase() >= 'a' && e.key.toLowerCase() <= 'z') || e.key === 'ArrowRight') {
                var next = parent.find('input#' + $(this).data('next'));
                if (next.length) {
                    next.focus().select();
                } else {
                    $(".verify-otp").trigger("click");
                }
            }
        });
    });
});

function timer(remaining) {
    var m = Math.floor(remaining / 60);
    var s = remaining % 60;

    m = m < 10 ? '0' + m : m;
    s = s < 10 ? '0' + s : s;
    document.querySelector('.timer-countdown').innerHTML = m + ':' + s;
    remaining -= 1;

    if (remaining >= 0 && timerOn) {
        timerId = setTimeout(function () {
            timer(remaining);
        }, 1000);
        return;
    }

    if (!timerOn) {
        // Do validate stuff here
        return;
    }

    timerOn = false;
    $('.send-otp').show();
    $('.timer-countdown').hide();
}
