if (typeof filter_url === "undefined") { var filter_url = ""; }
if (typeof delete_url === "undefined") { var delete_url = ""; }

$(function () {
    if ($('.data-table').length) {
        var table = $('.data-table').DataTable({
            "pageLength": 25,
            responsive: true,
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                type: "POST",
                url: filter_url,
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                { data: 'title', name: 'title' },
                { data: 'subject', name: 'subject' },
                { data: 'action', name: 'action', orderable: false, searchable: false, class: "text-center" },
            ]
        });
    }

    $(document).on('click', '.delete', function () {
        var data_id = $(this).data("id");
        Swal.fire({
            title: "Delete email",
            text: "Are you sure you want to delete this email?",
            showCloseButton: true,
            confirmButtonText: "Yes, delete it",
            customClass: {
                confirmButton: "btn-danger",
            },
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: delete_url.replace('emailid', data_id),
                    data: { id: data_id },
                    success: function (data) {
                        if (typeof data !== "undefined") {
                            if (typeof data.status !== "undefined" && data.status == true) {
                                table.ajax.reload();
                                successToast(data.message);
                            } else {
                                errorToast(data.message);
                            }
                        } else {
                            errorToast("Oops! Something went wrong. Please try again.");
                        }
                    },
                    error: function (data) {
                        errorToast("Oops! Something went wrong. Please try again.");
                    }
                });
            }
        });
    });

    if ($("#body").length) {
        const editor = CKEDITOR.replace('body', {
            height: '300px',
            toolbarGroups: [
                { name: 'styles', groups: ['styles', 'Format', 'FontSize'] },
                { name: 'basicstyles', groups: ['basicstyles'] },
                { name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align'] },
                { name: 'links' },
                { name: 'colors', groups: ['TextColor', 'BGColor'] },
                { name: 'others' },
                { name: 'mode' },
            ],
            removeButtons: 'Font,Image,Flash,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe',
        });
        editor.on('change', function (evt) {
            const element = evt.editor.name;
            CKEDITOR.instances[element].updateElement();
            $("[name=" + element + "]").trigger('blur');
        });
    }

    // Setup validation
    if (typeof validate !== 'function' && $.fn.validate) {
        $(".email-form-validate").validate({
            rules: {
                title: {
                    required: true,
                    normalizer: function (value) { return $.trim(value); },
                    minlength: 2,
                    maxlength: 255
                },
                subject: {
                    required: true,
                    normalizer: function (value) { return $.trim(value); },
                    minlength: 2,
                    maxlength: 255
                },
                body: {
                    required: function () {
                        CKEDITOR.instances.body.updateElement();
                        var editorcontent = $('#body').val().replace(/<[^>]*>/gi, ''); // strip tags
                        var editor_value = $.trim(editorcontent.replace(/&nbsp;/g, ''));
                        return Number(editor_value) === 0;
                    },
                    normalizer: function (value) { return $.trim(value); },
                    checkCkeditorEmpty: '#body',
                },
            },
            messages: {
                title: {
                    required: "Please enter a Email Title",
                    minlength: jQuery.validator.format("At least {0} characters required"),
                    maxlength: jQuery.validator.format("Maximum {0} characters allowed")
                },
                subject: {
                    required: "Please enter a Email Subject",
                    minlength: jQuery.validator.format("At least {0} characters required"),
                    maxlength: jQuery.validator.format("Maximum {0} characters allowed")
                },
                body: {
                    required: "Please enter a Email Body content",
                },
            },
        });
    }
});
