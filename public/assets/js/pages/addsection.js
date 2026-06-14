$(document).ready(function () {
    if (!!window.extraFieldValidations) {
        window.onload = function () {
            extraFieldValidations();
        }
    }

    if ($(".section-repeater").length > 0) {
        $(".section-repeater").each(function (index, element) {
            if ($(element).find(".r-group").length == 0) { addMoreSection($(element)); } else if ($(element).find(".r-group").length > 1) { $(element).attr('data-startIndex', $(element).find(".r-group").length); if (typeof $(element).attr('data-first-item-remove') !== 'undefined' && $(element).attr('data-first-item-remove') == "false") { $(element).find(".r-group").not(':first').find(".r-btnRemove").css('visibility', "visible") } else { $(element).find(".r-group .r-btnRemove").css('visibility', "visible") } }
        })
    }

    $(document).on('click', '.section-repeater .r-btnRemove', function () {
        var elem = $(this).closest(".r-group");
        var _parent = $(this).closest('.section-repeater');
        if ($(_parent).find(".r-group").length > 1) {
            if (typeof $(elem).data('id') !== "undefined" && $(_parent).find('.removed').length) {
                var remove_item = []; if ($(_parent).find('.removed').val() != "") { remove_item = JSON.parse($(_parent).find('.removed').val()) }
                remove_item.push($(elem).attr('data-id')); $(_parent).find('.removed').val(JSON.stringify(remove_item));
            }
            elem.remove();
        }
        if ($(_parent).find(".r-group").length > 1 && $(_parent).find('.no-records').length) { $(_parent).find('.no-records').removeClass('d-block').addClass('d-none') } else { $(_parent).find('.no-records').removeClass('d-none').addClass('d-block') }
        if ($(_parent).find(".r-group").length == 1) { $(_parent).find(".r-group:first .r-btnRemove:first").css('visibility', "hidden") }
        var srn = 1;
        $(_parent).find('.serial-no').each(function (i, e) { $(e).html(srn); srn++; });
    });

    $(document).on('click', '.section-repeater .r-btnAdd', function () { var _parent = $(this).closest('.section-repeater'); addMoreSection($(_parent)) });

});

function addMoreSection(_parent) {
    if (!!window.extraFieldValidations) {
        extraFieldValidations();
    }
    var isValid = true;
    $(_parent).find('input, textarea, select').each(function (i, e) { if (!$(this).valid()) { isValid = false } });
    if (!isValid) { return false; }
    if ($(_parent).closest('form').hasClass('check-form-validation') && !$(_parent).closest('form').valid()) { return false; }

    var startIndex = parseInt($(_parent).attr('data-startIndex'));
    var is_parent = false;
    if (!$(_parent).hasClass('sub-section')) { is_parent = true; }

    var clonedElement = null;
    if ($(_parent).find(".r-group").length > 0) {
        if ($(_parent).find('select.select2').length) { $(_parent).find('select.select2').select2('destroy') }
        if ($(_parent).find('select.multiselect').length) { $(_parent).find('select.multiselect').multiselect('destroy') }
        clonedElement = $(_parent).find(".r-group:first").clone();
        clonedElement.removeClass('d-none no-edit');
        clonedElement.removeAttr('data-id');
        clonedElement.find('.r-btnRemove').css('visibility', "visible");
        if (is_parent) { clonedElement.find('.section-repeater.sub-section .r-group').not(':first').remove(); clonedElement.find('.section-repeater.sub-section .r-group:first .r-btnRemove:first').css('visibility', "hidden") }
        clonedElement.find('input.id, .old, .view-doc, .invalid-feedback').remove();
        clonedElement.find('.custom-file-label').html('Choose file');
        clonedElement.find('.custom-file-image').attr('src', '#').hide();
        clonedElement.find('.custom-file-video, .custom-file-audio').hide().find('source').attr('src', '#');
        clonedElement.find('.custom-file-remove, .other').hide();
        clonedElement.find('.upload-image-box img').each(function (index, element) {
            $(element).attr('src', $(element).attr('data-src'));
        });
        if (clonedElement.find('.upload-multiple-file').length) { clonedElement.find('.upload-multiple-file .upload-item:not(:first)').remove() }
        clonedElement.find('input, textarea, select').each(function (index, element) {
            if (typeof $(element).attr('data-pattern') !== "undefined") { this.name = $(element).attr('data-pattern').replace(/\+\+/, startIndex) } else if (is_parent) { this.name = this.name.replace(/\[\d+\]\[+/, '[' + startIndex + '][') } else { this.name = this.name.replace(/\]\[\d+\]+/g, '][' + startIndex + ']') }
            if (this.type == 'checkbox' || this.type == "radio") { $(element).prop('checked', false); if (typeof $(element).attr('data-id-pattern') !== "undefined") { $(element).attr('id', $(element).attr('data-id-pattern').replace(/\+\+/, startIndex)); $(element).next('label').attr('for', this.id.replace(/\d+/, startIndex)) } else { $(element).attr('id', this.name.replace(/\[|\]/g, "")); $(element).next('label').attr('for', this.id.replace(/\d+/, startIndex)) } } else { this.value = "" }
            $(element).removeClass('is-invalid not-validate');
            $(element).prop('disabled', false);
        });

        if (clonedElement.find('.date-selectors').length) { createSingleDatePicker(clonedElement.find('.date-selectors')) }
        if (clonedElement.find('.date-select').length) { createDatePicker(clonedElement.find('.date-select')) }
        if (clonedElement.find('.time-select').length) { createDateTimePicker(clonedElement.find('.time-select')) }

        $(clonedElement).attr('data-id', startIndex);
        $(clonedElement).insertBefore($(_parent).find(".section-append:last"));

        if ($(_parent).find('select.multiselect').length) { clonedElement.find('select.multiselect.state').html(''); $(_parent).find('select.multiselect').each(function () { createMultiselect($(this)) }) }
        if ($(_parent).find('select.select2').length) { createSelect2($(_parent).find('select.select2')) }
    }

    startIndex++;
    $(_parent).attr('data-startIndex', startIndex);

    if ($(_parent).find(".r-group").length > 1 && $(_parent).find('.no-records').length) { $(_parent).find('.no-records').removeClass('d-block').addClass('d-none') } else { $(_parent).find('.no-records').removeClass('d-none').addClass('d-block') }

    var srn = 1;
    $(_parent).find('.serial-no').each(function (i, e) { $(e).html(srn); srn++; });

    var is_show = true;
    if (typeof $(_parent).attr('data-first-item-remove') !== 'undefined' && $(_parent).attr('data-first-item-remove') == "false") { is_show = false }

    if ($(_parent).find(".r-group").length > 1 && is_show) { $(_parent).find(".r-group:first .r-btnRemove:first").css('visibility', "visible") } else { $(_parent).find(".r-group:first .r-btnRemove:first").css('visibility', "hidden") }

    if (!!window.extraFieldValidations) {
        extraFieldValidations();
    }
}
